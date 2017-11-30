//var codigo_foto;
function cargarVistaRelatorios(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        //autoheight:true,
        height: 900,
        cells: [
            {
                header: "Disciplinas Relatorios", body: {
                    rows: [
                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    cols: [
                                        {
                                            view: "richselect", width: 80, id: "id_CB_alAno_ap",
                                            label: 'Ano Lec.', name: "alAno",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#alAno#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CAnos_Lectivos/read"
                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 150, id: "id_CB_nNome_ap",
                                            label: 'Nivel', name: "nNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#nNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cNiveis/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {

                                                    var n = $$("id_CB_nNome_ap").getValue();
                                                    var c = $$("id_CB_cNome_ap").getValue();
                                                    var p = $$("id_CB_pNome_ap").getValue();
                                                    var ac = $$("id_CB_acNome_ap").getValue();

                                                    if (n) {
                                                        $$("id_CB_cNome_ap").getList().clearAll();
                                                        $$("id_CB_cNome_ap").getList().load(BASE_URL + "Ccursos/readXn?nNome=" + this.getValue());
                                                    }
                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 450, id: "id_CB_cNome_ap",
                                            label: 'Curso', name: "cNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#cNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cCursos/read"
                                                }
                                            }
                                        },
                                        {}
                                    ]
                                },
                                {
                                    cols:[
                                        {
                                            view: "richselect", width: 125, id: "id_CB_pNome_ap",
                                            label: 'Periodo', name: "pNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#pNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cPeriodos/read"
                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 100, id: "id_CB_acNome_ap",
                                            label: 'Ano Curricular', name: "acNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#acNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CAno_Curricular/read"
                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 200, id: "id_cb_dgnome_ap",
                                            label: 'Geração', name: "dgnome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#dgnome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CDisciplinas_Geracao/read"
                                                }
                                            }
                                        },
                                        {
                                            view: "button", type: "form", value: "Pesquisar", width: 110, click: function () {
                                                var al = $$("id_CB_alAno_ap").getValue();
                                                var n = $$("id_CB_nNome_ap").getValue();
                                                var c = $$("id_CB_cNome_ap").getValue();
                                                var p = $$("id_CB_pNome_ap").getValue();
                                                var ac = $$("id_CB_acNome_ap").getValue();
                                                var g = $$("id_cb_dgnome_ap").getValue();

                                                if (al && n && c && p && ac && g) {
                                                    $$("idDTrelatorios").clearAll();
                                                    $$("idDTrelatorios").load(BASE_URL + "cestatisticas/get_disciplinas_relatorio?al="+al+"&n="+n+"&c="+c+"&p="+p+"&ac="+ac+"&g="+g);
                                                    //activar exportar
                                                    $$('idBtnImpPorDisciplinas').enable();
                                                    $$('idBtnExportarExcelRelatorio').enable();
                                                } else{
                                                    webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });
                                                    $$('idBtnImpPorDisciplinas').disable();
                                                    $$('idBtnExportarExcelRelatorio').disable();
                                                }
                                            }
                                        },
                                        {}
                                    ]
                                },
                                {
                                    cols: [

                                        {
                                            view: "button", type: "form", value: "Imprimir PDF", disabled: true, id:"idBtnImpPorDisciplinas", width: 140, click: function () {
                                                //criar PDF
                                                var al = $$("id_CB_alAno_ap").getValue();
                                                var n = $$("id_CB_nNome_ap").getValue();
                                                var c = $$("id_CB_cNome_ap").getValue();
                                                var p = $$("id_CB_pNome_ap").getValue();
                                                var ac = $$("id_CB_acNome_ap").getValue();
                                                var g = $$("id_cb_dgnome_ap").getValue();

                                                if (al && n && c && p && ac && g) {
                                                    var envio = "al=" + al + "&n=" + n + "&c=" + c + "&p=" + p + "&ac=" + ac + "&g=" + g;
                                                    var r = webix.ajax().sync().post(BASE_URL + "Cestatisticas_relatorios_imp/imprimir", envio);
                                                    if (r.responseText == "true") {
                                                        webix.message("PDF criado com sucesso");
                                                        //Carregar PDF
                                                        webix.ui({
                                                            view: "window",
                                                            id: "idWinPDFap",
                                                            height: 600,
                                                            width: 900,
                                                            left: 50, top: 50,
                                                            move: true,
                                                            modal: true,
                                                            //head:"This window can be moved",
                                                            head: {
                                                                view: "toolbar", cols: [
                                                                    { view: "label", label: "Disciplinas Relatorio" },
                                                                    { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFap').close(); } }
                                                                ]
                                                            },
                                                            body: {
                                                                //template:"Some text"
                                                                template: '<div id="idPDFap" style="width:890px;  height:590px"></div>'
                                                            }
                                                        }).show();
                                                        PDFObject.embed("../../relatorios/estatisticas_relatorio_disciplinas.pdf", "#idPDFap");


                                                    } else {
                                                        webix.message({ type: "error", text: "Erro atualizando dados" });
                                                    }

                                                } else {
                                                    webix.message({ type: "error", text: "Deve selecionar primeiro n&iacute;vel, curso, per&iacute;odo, ano curricular e geração" });
                                                }
                                            }
                                        },
                                        {
                                            view: "button", type: "standard", label: "Exportar Excel", disabled: true, id:"idBtnExportarExcelRelatorio", width: 120, click: function () {
                                                //webix.toExcel($$("idDTEdMatricula"));
                                                webix.cdn = PRO_URL + "webix";
                                                webix.toExcel($$("idDTrelatorios"), {
                                                    filename: "Estatisticas_Relatorio_Excel",
                                                    //name: "Ranks",
                                                    /*   columns: {
                                                           "rank": { header: "Rank", width: 50 },
                                                           "title": { header: "Title", width: 200 }
                                                       }*/
                                                });
                                            }
                                        },
                                        {}
                                    ]
                                }
                                
                            ]

                        },
                        {
                            view: "datatable",
                            id: "idDTrelatorios",
                            select: "row", /*editable: true, editaction: "click",*/
                            columns: [
                                { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 100, sort: "int" },
                                { id: "dnome", header: "Disciplina", width: 250, sort: "string" },
                                
                                { id: "mas1", header: "Mat.Masc.", width: 75, sort: "string" },
                                { id: "fem1", header: "Mat.Femi.", width: 75, sort: "string" },
                                { id: "total1", header: "Mat.Total", width: 75, sort: "string" },

                                { id: "mas2", header: "Rep.Masc.", width: 75, sort: "string" },
                                { id: "fem2", header: "Rep.Femi.", width: 75, sort: "string" },
                                { id: "total2", header: "Rep.Total", width: 75, sort: "string" },

                                { id: "mas3", header: "Apr.Masc.", width: 75, sort: "string" },
                                { id: "fem3", header: "Apr.Femi.", width: 75, sort: "string" },
                                { id: "total3", header: "Apr.Total", width: 75, sort: "string" },
                            ],
                            resizeColumn: true,
                            //url: BASE_URL + "cestatisticas/aproveitamento",
                            pager: "pagerRel"
                        }, {
                            view: "pager", id: "pagerRel",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 5
                        }
                    ]
                }

            }
        ]
    });
    //alert(user_sessao);
    //readAcesso
    var envio = "usuario=" + user_sessao;
    var r = webix.ajax().sync().post(BASE_URL + "Cutilizadores/readAcesso", envio);

}



