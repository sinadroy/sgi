//var codigo_foto;
function cargarVistaCargar_pautas(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        //autoheight:true,
        height: 900,
        cells: [
            {
                header: "Cargar Pautas", body: {
                    rows: [
                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    rows: [
                                        {
                                            view: "form", rows: [
                                                {
                                                    rows: [
                                                        {
                                                            cols: [
                                                                {
                                                                    view: "richselect", width: 80, id: "idLI_CB_alAno_cp",
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
                                                                    view: "richselect", width: 200, id: "idLI_CB_nNome_cp",
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

                                                                            var n = $$("idLI_CB_nNome_cp").getValue();
                                                                            var c = $$("idLI_CB_cNome_cp").getValue();
                                                                            var p = $$("idLI_CB_pNome_cp").getValue();
                                                                            var ac = $$("idLI_CB_acNome_cp").getValue();

                                                                            if (n) {
                                                                                $$("idLI_CB_cNome_cp").getList().clearAll();
                                                                                $$("idLI_CB_cNome_cp").getList().load(BASE_URL + "Ccursos/readXn?nNome=" + this.getValue());
                                                                            }

                                                                            if (n && c && p && ac) {
                                                                                $$("id_cb_cp").setValue('');
                                                                                $$("id_cb_cp").getList().clearAll();
                                                                                $$("id_cb_cp").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac);
                                                                            }
                                                                        }
                                                                    }
                                                                },
                                                                {
                                                                    view: "richselect", width: 500, id: "idLI_CB_cNome_cp",
                                                                    label: 'Curso', name: "cNome",
                                                                    labelPosition: "top",
                                                                    options: {
                                                                        body: {
                                                                            template: "#cNome#",
                                                                            yCount: 7,
                                                                            url: BASE_URL + "cCursos/read"
                                                                        }
                                                                    },
                                                                    on: {
                                                                        "onChange": function (newv, oldv) {
                                                                            var n = $$("idLI_CB_nNome_cp").getValue();
                                                                            var c = $$("idLI_CB_cNome_cp").getValue();
                                                                            var p = $$("idLI_CB_pNome_cp").getValue();
                                                                            var ac = $$("idLI_CB_acNome_cp").getValue();

                                                                            if (n && c && p && ac) {
                                                                                $$("id_cb_cp").setValue('');
                                                                                $$("id_cb_cp").getList().clearAll();
                                                                                $$("id_cb_cp").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac);
                                                                            }

                                                                        }
                                                                    }
                                                                },
                                                                {}
                                                            ]
                                                        },
                                                        {
                                                            cols: [

                                                                {
                                                                    view: "richselect", width: 125, id: "idLI_CB_pNome_cp",
                                                                    label: 'Periodo', name: "pNome",
                                                                    labelPosition: "top",
                                                                    options: {
                                                                        body: {
                                                                            template: "#pNome#",
                                                                            yCount: 7,
                                                                            url: BASE_URL + "cPeriodos/read"
                                                                        }
                                                                    },
                                                                    on: {
                                                                        "onChange": function (newv, oldv) {
                                                                            var n = $$("idLI_CB_nNome_cp").getValue();
                                                                            var c = $$("idLI_CB_cNome_cp").getValue();
                                                                            var p = $$("idLI_CB_pNome_cp").getValue();
                                                                            var ac = $$("idLI_CB_acNome_cp").getValue();

                                                                            if (n && c && p && ac) {
                                                                                $$("id_cb_cp").setValue('');
                                                                                $$("id_cb_cp").getList().clearAll();
                                                                                $$("id_cb_cp").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac);
                                                                            }

                                                                        }
                                                                    }
                                                                },
                                                                {
                                                                    view: "richselect", width: 100, id: "idLI_CB_acNome_cp",
                                                                    label: 'Ano Curricular', name: "acNome",
                                                                    labelPosition: "top",
                                                                    options: {
                                                                        body: {
                                                                            template: "#acNome#",
                                                                            yCount: 7,
                                                                            url: BASE_URL + "CAno_Curricular/read"
                                                                        }
                                                                    }, on: {
                                                                        "onChange": function (newv, oldv) {
                                                                            var n = $$("idLI_CB_nNome_cp").getValue();
                                                                            var c = $$("idLI_CB_cNome_cp").getValue();
                                                                            var p = $$("idLI_CB_pNome_cp").getValue();
                                                                            var ac = $$("idLI_CB_acNome_cp").getValue();

                                                                            if (n && c && p && ac) {
                                                                                $$("id_cb_cp").setValue('');
                                                                                $$("id_cb_cp").getList().clearAll();
                                                                                $$("id_cb_cp").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac);
                                                                            }

                                                                        }
                                                                    }
                                                                },
                                                                {
                                                                    view: "richselect", width: 200, id: "id_cb_dgnome_cp",
                                                                    label: 'Geração', name: "dgnome",
                                                                    labelPosition: "top",
                                                                    options: {
                                                                        body: {
                                                                            template: "#dgnome#",
                                                                            yCount: 7,
                                                                            url: BASE_URL + "CDisciplinas_Geracao/read"
                                                                        }
                                                                    },
                                                                    on: {
                                                                        "onChange": function (newv, oldv) {
                                                                            var n = $$("idLI_CB_nNome_cp").getValue();
                                                                            var c = $$("idLI_CB_cNome_cp").getValue();
                                                                            var p = $$("idLI_CB_pNome_cp").getValue();
                                                                            var ac = $$("idLI_CB_acNome_cp").getValue();
                                                                            var g = $$("id_cb_dgnome_cp").getValue();

                                                                            if (n && c && p && ac && g) {
                                                                                $$("id_cb_cp").setValue('');
                                                                                $$("id_cb_cp").getList().clearAll();
                                                                                
                                                                                $$("id_cb_cp").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p_g?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac + "&dgNome=" + g);
                                                                            }

                                                                        }
                                                                    }
                                                                },
                                                                {
                                                                    view: "richselect", width: 370, id: "id_cb_cp",
                                                                    label: 'Disciplina', name: "dnome",
                                                                    labelPosition: "top",
                                                                    options: {
                                                                        body: {
                                                                            template: "#dnome#",
                                                                            yCount: 7,
                                                                            url: BASE_URL + "CDisciplinas/read"
                                                                        }
                                                                    }
                                                                },

                                                                {
                                                                    view: "button", type: "form", value: "Pesquisar", width: 110, click: function () {
                                                                        var al = $$("idLI_CB_alAno_cp").getValue();
                                                                        var n = $$("idLI_CB_nNome_cp").getValue();
                                                                        var c = $$("idLI_CB_cNome_cp").getValue();
                                                                        var p = $$("idLI_CB_pNome_cp").getValue();
                                                                        var ac = $$("idLI_CB_acNome_cp").getValue();
                                                                        var d = $$("id_cb_cp").getValue();
                                                                        var g = $$("id_cb_dgnome_cp").getValue();

                                                                        if (al && n && c && p && ac && d && g) {
                                                                            $$("idDTcp").clearAll();
                                                                            $$("idDTcp").load(BASE_URL + "cpautas/readXdisciplina?n=" + n + "&c=" + c + "&p=" + p + "&al=" + al + "&d=" + d + "&al=" + al + "&g=" + g);
                                                                            //activar exportar
                                                                            $$('idbtn_Exportar_Pauta_Prof').enable();
                                                                        } else
                                                                            webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });

                                                                    }
                                                                },
                                                                {}
                                                            ]
                                                        }
                                                    ]

                                                }
                                            ]


                                        },
                                        {
                                            view: "form", rows: [
                                                {
                                                    cols: [
                                                        /* {
                                                             view: "uploader", label: 'Carregar Pauta', type: "iconButton", icon: "upload",
                                                             name: "files", //accept: "application/vnd.ms-excel",
                                                             height: 50, width: 150,
                                                              upload: BASE_URL + "Cpautas_excel/readPauta"
                                                         },*/
                                                        {
                                                            view: "uploader", label: 'Importar Pauta', type: "standard", icon: "upload",
                                                            name: "files", //accept: "application/vnd.ms-excel",
                                                            width: 150,
                                                            upload: BASE_URL + "cpauta_professor/importar?user="+user_sessao
                                                        },
                                                        {
                                                            view: "button", type: "form", id: "idbtn_Exportar_Pauta_Prof", value: "Exportar Pauta", disabled: true, width: 120, click: function () {
                                                                var al = $$("idLI_CB_alAno_cp").getText();
                                                                var n = $$("idLI_CB_nNome_cp").getText();
                                                                var c = $$("idLI_CB_cNome_cp").getText();
                                                                var p = $$("idLI_CB_pNome_cp").getText();
                                                                var ac = $$("idLI_CB_acNome_cp").getText();
                                                                var d = $$("id_cb_cp").getText();
                                                                var idd = $$("id_cb_cp").getValue();

                                                                if (al && n && c && p && ac && d) {
                                                                    //get codigo disciplina
                                                                    var r1 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_codigo", "idd=" + idd);
                                                                    var cod = r1.responseText;
                                                                    //
                                                                    var r2 = webix.ajax().sync().post(BASE_URL + "CDisciplinas_Geracao/get_dgnome", "idd=" + idd);
                                                                    var g = r2.responseText;
                                                                    
                                                                    var env = [];
                                                                    env["al"] = al;
                                                                    env["n"] = n;
                                                                    env["c"] = c;
                                                                    env["p"] = p;
                                                                    env["ac"] = ac;
                                                                    env["idd"] = idd;
                                                                    env["d"] = d;
                                                                    env["cod"] = cod;
                                                                    env["g"] = g;
                                                                    webix.send(BASE_URL + "cpauta_professor/exportar", env, "GET");
                                                                } else
                                                                    webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });

                                                            }
                                                        },
                                                        {}
                                                    ]
                                                }
                                            ]
                                        },
                                    ]

                                },
                                /*{
                                    cols: [

                                        {
                                            view: "button", type: "standard", value: "Imprimir", disabled: false, width: 120, height: 50, click: function () {
                                                //criar PDF
                                                var nNome = $$("idLI_CB_nNome_cp").getValue();
                                                var cNome = $$("idLI_CB_cNome_cp").getValue();
                                                var pNome = $$("idLI_CB_pNome_cp").getValue();
                                                var ac = $$("idLI_CB_acNome_cp").getValue();
                                                var t = $$("idLI_CB_tNome_cp").getValue();

                                                if (nNome && cNome && pNome && ac && t) {
                                                    var envio = "nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&ac=" + ac + "&t=" + t + "&utilizador=" + user_sessao;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cAcademica_Listas_Gerais_IMP/imprimir", envio);
                                                    if (r.responseText == "true") {
                                                        webix.message("PDF criado com sucesso");
                                                        //Carregar PDF
                                                        webix.ui({
                                                            view: "window",
                                                            id: "idWinPDFcp",
                                                            height: 600,
                                                            width: 700,
                                                            left: 50, top: 50,
                                                            move: true,
                                                            modal: true,
                                                            //head:"This window can be moved",
                                                            head: {
                                                                view: "toolbar", cols: [
                                                                    { view: "label", label: "Listas Gerais" },
                                                                    { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFcp').close(); } }
                                                                ]
                                                            },
                                                            body: {
                                                                //template:"Some text"
                                                                template: '<div id="idPDFcp" style="width:690px;  height:590px"></div>'
                                                            }
                                                        }).show();
                                                        PDFObject.embed("../../relatorios/Listas_Gerais.pdf", "#idPDFcp");


                                                    } else {
                                                        webix.message({ type: "error", text: "Erro atualizando dados" });
                                                    }

                                                } else {
                                                    webix.message({ type: "error", text: "Deve selecionar primeiro n&iacute;vel, curso, per&iacute;odo, ano curricular e turma" });
                                                }
                                            }
                                        },
                                        {
                                            view: "button", type: "form", id: "idbtn_Exportar_Dadoscp", value: "Exportar Dados", disabled: true, width: 120, height: 50, click: function () {
                                                webix.toExcel($$("idDTInscricaocp"), {
                                                    filename: "pauta",
                                                    //name: "Ranks",
                                                    
                                                });
                                            }
                                        },
                                        {
                                            view: "button", type: "standard", value: "Actualizar", width: 120, height: 50, click: function () {
                                                $$("idDTcp").clearAll();
                                                $$("idDTcp").load(BASE_URL + "CEstudantes/read");
                                            }
                                        },
                                        {}
                                    ]
                                }
                                */
                            ]

                        }, {
                            view: "datatable",
                            id: "idDTcp",
                            select: "row", /*editable: true, editaction: "click",*/
                            columns: [
                                { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                                //{ id: "eData_Matricula", header: "Data Mat.", css: "rank", width: 60, sort: "int" },
                                { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cNomes", header: "Nomes", width: 170, sort: "string" },
                                { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cBI_Passaporte", editor: "text", header: ["BI-Pass.", { content: "textFilter" }], width: 150, sort: "strig" },

                                //{ id: "dNome", header: ["Disciplina", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "pp1", header: ["pp1", { content: "textFilter" }], width: 50, sort: "int" },
                                { id: "pp2", header: ["pp2", { content: "textFilter" }], width: 50, sort: "int" },
                                { id: "pp3", header: ["pp3", { content: "textFilter" }], width: 50, sort: "int" },
                                { id: "ef", header: ["ef", { content: "textFilter" }], width: 50, sort: "int" },
                                { id: "recurso", header: ["recurso", { content: "textFilter" }], width: 60, sort: "int" },
                                { id: "especial", header: ["especial", { content: "textFilter" }], width: 60, sort: "int" },
                                {
                                    id: "estado", header: ["Estado", { content: "selectFilter" }], width: 100, sort: "string",
                                    template: function (obj) {
                                        if (obj.estado == "Reprovado")
                                            return "<span style='color:red;'>" + obj.estado + "</span>";
                                        else
                                            return "<span style='color:green;'>" + obj.estado + "</span>";

                                    },
                                },
                            ],
                            resizeColumn: true,
                            //url: BASE_URL + "cpautas/read",
                            pager: "pagercp"
                        }, {
                            view: "pager", id: "pagercp",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
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
    if (r.responseText == "Administradores") {
        //$$("idbtn_Exportar_DadosLG").enable();
        //$$("idbtn_Apagar_Cursos_PretendidosTM").enable();
        //$$("idbtn_Exportar_DadosTM").enable();
    }
    /* if (user_sessao == "admin") {
         $$("idbtn_Apagar_Candidato").enable();
         $$("idbtn_Apagar_Cursos_Pretendidos").enable();
     }*/
}



