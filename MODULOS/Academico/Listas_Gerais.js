//var codigo_foto;
function cargarVistaListas_Gerais(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        //autoheight:true,
        height: 900,
        cells: [
            {
                header: "Listas Estudantes", body: {
                    rows: [
                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    cols: [
                                        {
                                            view: "richselect", width: 150, id: "idLI_CB_nNome_lciTM",
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

                                                    var n = $$("idLI_CB_nNome_lciTM").getValue();
                                                    var c = $$("idLI_CB_cNome_lciTM").getValue();
                                                    var p = $$("idLI_CB_pNome_lciTM").getValue();
                                                    var ac = $$("idLI_CB_acNome_lciTM").getValue();

                                                    if (n) {
                                                        $$("idLI_CB_cNome_lciTM").getList().clearAll();
                                                        $$("idLI_CB_cNome_lciTM").getList().load(BASE_URL + "Ccursos/readXn?nNome=" + this.getValue());
                                                    }

                                                    if (n && c && p && ac) {
                                                        $$("idLI_CB_tNome_lciTM").getList().clearAll();
                                                        $$("idLI_CB_tNome_lciTM").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                                    }
                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 450, id: "idLI_CB_cNome_lciTM",
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
                                                    var n = $$("idLI_CB_nNome_lciTM").getValue();
                                                    var c = $$("idLI_CB_cNome_lciTM").getValue();
                                                    var p = $$("idLI_CB_pNome_lciTM").getValue();
                                                    var ac = $$("idLI_CB_acNome_lciTM").getValue();

                                                    if (n && c && p && ac) {
                                                        $$("idLI_CB_tNome_lciTM").getList().clearAll();
                                                        $$("idLI_CB_tNome_lciTM").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                                    }

                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 125, id: "idLI_CB_pNome_lciTM",
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
                                                    var n = $$("idLI_CB_nNome_lciTM").getValue();
                                                    var c = $$("idLI_CB_cNome_lciTM").getValue();
                                                    var p = $$("idLI_CB_pNome_lciTM").getValue();
                                                    var ac = $$("idLI_CB_acNome_lciTM").getValue();

                                                    if (n && c && p && ac) {
                                                        $$("idLI_CB_tNome_lciTM").getList().clearAll();
                                                        $$("idLI_CB_tNome_lciTM").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
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
                                            view: "richselect", width: 100, id: "idLI_CB_acNome_lciTM",
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
                                                    var n = $$("idLI_CB_nNome_lciTM").getValue();
                                                    var c = $$("idLI_CB_cNome_lciTM").getValue();
                                                    var p = $$("idLI_CB_pNome_lciTM").getValue();
                                                    var ac = $$("idLI_CB_acNome_lciTM").getValue();

                                                    if (n && c && p && ac) {
                                                        $$("idLI_CB_tNome_lciTM").getList().clearAll();
                                                        $$("idLI_CB_tNome_lciTM").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                                    }

                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 170, id: "idLI_CB_tNome_lciTM",
                                            label: 'Turma', name: "tNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#tNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CTurmas/read"
                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 170, id: "idLI_CB_sNome_lciTM",
                                            label: 'Semestre', name: "sNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#sNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CSemestres/read"
                                                }
                                            }
                                        },
                                        {
                                            view: "button", type: "form", value: "Perquisar", width: 120, click: function () {
                                                //var idSelecionado = $$("idDTEdHorarios").getSelectedId(false,true);
                                                var nNome = $$("idLI_CB_nNome_lciTM").getValue();
                                                var cNome = $$("idLI_CB_cNome_lciTM").getValue();
                                                var pNome = $$("idLI_CB_pNome_lciTM").getValue();

                                                var ac = $$("idLI_CB_acNome_lciTM").getValue();
                                                var t = $$("idLI_CB_tNome_lciTM").getValue();
                                                var s = $$("idLI_CB_sNome_lciTM").getValue();

                                                if (nNome && cNome && pNome && ac && t) {
                                                    $$("idDTInscricaoLG").clearAll();
                                                    $$("idDTInscricaoLG").load(BASE_URL + "CEstudantes/readXturma2?n=" + nNome +
                                                        "&c=" + cNome +
                                                        "&p=" + pNome +
                                                        "&ac=" + ac +
                                                        "&t=" + t +
                                                        "&s=" + s);
                                                }

                                            }
                                        },
                                        {}
                                    ]
                                },
                                {
                                    cols: [

                                        {
                                            view: "button", type: "standard", value: "Imprimir", disabled: false, width: 120, click: function () {
                                                //criar PDF
                                                var nNome = $$("idLI_CB_nNome_lciTM").getValue();
                                                var cNome = $$("idLI_CB_cNome_lciTM").getValue();
                                                var pNome = $$("idLI_CB_pNome_lciTM").getValue();
                                                var ac = $$("idLI_CB_acNome_lciTM").getValue();
                                                var t = $$("idLI_CB_tNome_lciTM").getValue();
                                                var s = $$("idLI_CB_sNome_lciTM").getValue();

                                                if (nNome && cNome && pNome && ac && t) {
                                                    var envio = "nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&ac=" + ac + "&t=" + t + "&s=" + s + "&utilizador=" + user_sessao;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cAcademica_Listas_Gerais_IMP/imprimir", envio);
                                                    if (r.responseText == "true") {
                                                        webix.message("PDF criado com sucesso");
                                                        //Carregar PDF
                                                        webix.ui({
                                                            view: "window",
                                                            id: "idWinPDFLG",
                                                            height: 600,
                                                            width: 700,
                                                            left: 50, top: 50,
                                                            move: true,
                                                            modal: true,
                                                            //head:"This window can be moved",
                                                            head: {
                                                                view: "toolbar", cols: [
                                                                    { view: "label", label: "Listas Gerais" },
                                                                    { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFLG').close(); } }
                                                                ]
                                                            },
                                                            body: {
                                                                //template:"Some text"
                                                                template: '<div id="idPDFLG" style="width:690px;  height:590px"></div>'
                                                            }
                                                        }).show();
                                                        PDFObject.embed("../../relatorios/Listas_Gerais.pdf", "#idPDFLG");


                                                    } else {
                                                        webix.message({ type: "error", text: "Erro atualizando dados" });
                                                    }

                                                } else {
                                                    webix.message({ type: "error", text: "Deve selecionar primeiro n&iacute;vel, curso, per&iacute;odo, ano curricular e turma" });
                                                }
                                            }
                                        },
                                        {
                                            view: "button", type: "form", id: "idbtn_Exportar_DadosLG", value: "Exportar Dados", disabled: true, width: 120, click: function () {
                                                webix.toExcel($$("idDTInscricaoLG"), {
                                                    filename: "ListasGerais",
                                                    //name: "Ranks",
                                                    /*   columns: {
                                                           "rank": { header: "Rank", width: 50 },
                                                           "title": { header: "Title", width: 200 }
                                                       }*/
                                                });
                                            }
                                        },
                                        {
                                            view: "button", type: "standard", value: "Actualizar", width: 120, click: function () {
                                                $$("idDTInscricaoLG").clearAll();
                                                $$("idDTInscricaoLG").load(BASE_URL + "CEstudantes/read");
                                            }
                                        },
                                        {
                                            template: "<div style='width:100%;text-align:center; color:red'>NOTA: Se um estudante não aparece, verificar seu estado nas finançãs.</div>",
                                            height: 30
                                        },
                                        //{}
                                    ]
                                }
                            ]

                        }, {
                            view: "datatable",
                            id: "idDTInscricaoLG",
                            select: "row", /*editable: true, editaction: "click",*/
                            columns: [
                                { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                                //{ id: "eData_Matricula", header: "Data Mat.", css: "rank", width: 60, sort: "int" },
                                {
                                    id: "eEstado_Matricula", header: ["Estado", { content: "selectFilter" }], width: 170, sort: "string",
                                    template: function (obj) {
                                        if (obj.eEstado_Matricula == "Conf.Mat.Esp.Pag")
                                            return "<span style='color:red;'>" + obj.eEstado_Matricula + "</span>";
                                        else
                                            return "<span style='color:green;'>" + obj.eEstado_Matricula + "</span>";

                                    },
                                },
                                { id: "e_num_univ", header: ["Num. Univ.", { content: "textFilter" }], width: 140, sort: "string" },
                                { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cNomes", header: "Nomes", width: 170, sort: "string" },
                                { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cBI_Passaporte", editor: "text", header: ["BI-Pass.", { content: "textFilter" }], width: 150, sort: "strig" },

                                { id: "nNome", header: ["N&iacute;vel", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "curso", header: ["Curso", { content: "textFilter" }], width: 400, sort: "string" },
                                { id: "pNome", header: ["Per&iacute;odo", { content: "textFilter" }], width: 100, sort: "string" },

                            ],
                            resizeColumn: true,
                            url: BASE_URL + "CEstudantes/read",
                            pager: "pagerCDadosInscricaoLG"
                        }, {
                            view: "pager", id: "pagerCDadosInscricaoLG",
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
        $$("idbtn_Exportar_DadosLG").enable();
        //$$("idbtn_Apagar_Cursos_PretendidosTM").enable();
        //$$("idbtn_Exportar_DadosTM").enable();
    }
    /* if (user_sessao == "admin") {
         $$("idbtn_Apagar_Candidato").enable();
         $$("idbtn_Apagar_Cursos_Pretendidos").enable();
     }*/
}
//Adicionar DadosPesoais
var formADDDadosPesoaisTM = {
    view: "tabview",
    id: "id_form_inscricao_addTM",
    //height:900,
    cells: [{
        header: "Pessoais", body: {
            view: "form",
            id: "idformADDDadosPesoaisTM",
            height: 450,
            borderless: true,
            elements: [
                {
                    cols: [{
                        rows: [
                            { view: "text", label: 'Nome', name: "cNome", id: "idcNomeTM", validate: "isNotEmpty", validateEvent: "blur" },
                            { view: "text", label: 'Apelido', name: "cApelido", id: "idcApelidoTM", validate: "isNotEmpty", validateEvent: "blur" },
                            { view: "datepicker", label: "Data Nascimento", name: "cData_Nascimento", id: "idcData_NascimentoTM", stringResult: true },
                            { view: "richselect", label: 'Nacionalidade', name: "ngNome", id: "idngNomeTM", value: 1, options: { body: { template: "#ngNome#", yCount: 7, url: BASE_URL + "CNacionalidades_Geral/read" } } },
                            { view: "richselect", label: 'Municipio Nascimento', name: "munNascimento", id: "idNascimento_Municipios_idTM", options: { body: { template: "#munNascimento#", yCount: 7, url: BASE_URL + "CMunicipios/readMN" } } },
                            { view: "datepicker", label: "BI Data Emiss&atilde;o", name: "cBI_Data_Emissao", id: "idcBI_Data_EmissaoTM", stringResult: true },
                            { view: "text", label: 'Nome Pai', name: "cNome_Pai", id: "idcNome_PaiTM", validate: "isNotEmpty", validateEvent: "blur" },
                            { view: "richselect", label: 'Necessita educa&ccedil;&atilde;o especial', name: "neeNome", id: "idneeNomeTM", value: 1, options: { body: { template: "#neeNome#", yCount: 7, url: BASE_URL + "CNecessita_Educacao_Especial/read" } } },
                            {}
                        ]
                    }, {
                            rows: [
                                { view: "text", label: 'Nomes', name: "cNomes", id: "idcNomesTM" },
                                { view: "richselect", label: 'Genero', name: "gNome", id: "idgNomeTM", value: 1, options: { body: { template: "#gNome#", yCount: 7, url: BASE_URL + "CGeneros/read" } } },
                                { view: "richselect", label: 'Estado Civil', name: "ecNome", id: "idecNomeTM", value: 1, options: { body: { template: "#ecNome#", yCount: 7, url: BASE_URL + "CEstado_Civil/read" } } },
                                {
                                    view: "richselect", label: 'Provincia Nascimento', name: "provNascimento", id: "idNascimento_Provincias_idTM", options: { body: { template: "#provNascimento#", yCount: 7, url: BASE_URL + "CProvincias/readPN" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            $$("idcBI_Lugar_Emissao_Provincia_idTM").setValue(this.getValue());
                                            //alert(this.getValue());
                                            $$("idNascimento_Municipios_idTM").setValue("");
                                            $$("idNascimento_Municipios_idTM").getList().clearAll();
                                            $$("idNascimento_Municipios_idTM").getList().load(BASE_URL + "cMunicipios/readXProvincia?id=" + this.getValue());
                                        }
                                    }
                                },
                                { view: "text", label: 'BI/Passaporte', name: "cBI_Passaporte", id: "idcBI_PassaporteTM", validate: "isNotEmpty", validateEvent: "blur" },
                                { view: "richselect", disabled: true, label: 'BI Provincia Emiss&atilde;o', name: "cBI_Lugar_Emissao_Provincia_id", id: "idcBI_Lugar_Emissao_Provincia_idTM", options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read" } } },
                                { view: "text", label: 'Nome Mae', name: "cNome_Mae", id: "idcNome_MaeTM", validate: "isNotEmpty", validateEvent: "blur" },
                                {}
                            ]
                        }
                    ]
                }, {
                    cols: [{},
                        {
                            view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                $$("id_win_TM_add").close();
                            }
                        }
                    ]
                }
            ],
            elementsConfig: {
                labelPosition: "top",
            }
        }
    },
        {
            header: "Profissionais", body: {
                view: "form",
                id: "idformADDDadosProfissionaisTM",
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", label: 'Trabalhador', name: "trabNome", id: "idtrabNomeTM", value: 2, options: { body: { template: "#trabNome#", yCount: 10, url: BASE_URL + "CTrabalhador/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            if (this.getText() == "Não") {
                                                $$("idtilNomeTM").disable();
                                                $$("iddlLocal_TrabalhoTM").disable();
                                                $$("idproNomeTM").disable();
                                                $$("idotNomeTM").disable();
                                                $$("iddlCargoTM").disable();
                                            } else {
                                                $$("idtilNomeTM").enable();
                                                $$("iddlLocal_TrabalhoTM").enable();
                                                $$("idproNomeTM").enable();
                                                $$("idotNomeTM").enable();
                                                $$("iddlCargoTM").enable();
                                            }
                                        }
                                    }
                                },

                                {
                                    view: "richselect", label: 'Tipo Institui&ccedil;&atilde;o', name: "tilNome", id: "idtilNomeTM", disabled: true, options: { body: { template: "#tilNome#", yCount: 7, url: BASE_URL + "CTipo_Instituicao_Laboral/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            if (this.getText() == "Privada") {
                                                $$("idotNomeTM").disable();
                                            }
                                        }
                                    }
                                },
                                { view: "text", label: 'Local de Trabalho', name: "dlLocal_Trabalho", disabled: true, id: "iddlLocal_TrabalhoTM", },
                                {}
                            ]
                        }, {
                                rows: [
                                    { view: "richselect", label: 'Profiss&atilde;o', name: "proNome", id: "idproNomeTM", disabled: true, options: { body: { template: "#proNome#", yCount: 10, url: BASE_URL + "CProfissao/read" } } },
                                    { view: "richselect", label: 'Organismo Tutela', name: "otNome", id: "idotNomeTM", disabled: true, options: { body: { template: "#otNome#", yCount: 7, url: BASE_URL + "COrganismos_Tutela/read" } } },
                                    { view: "text", label: 'Cargo', name: "dlCargo", id: "iddlCargoTM", disabled: true },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [{},
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_TM_add").close();
                                }
                            }
                        ]
                    }
                ],
                elementsConfig: {
                    labelPosition: "top",
                }
            }
        }, {
            header: "Acad&eacute;micos", body: {
                view: "form",
                id: "idformADDDadosAcademicosTM",
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", label: 'Pa&iacute;s de Forma&ccedil;&atilde;o', name: "paNome", id: "idFormacao_paNomeTM", value: 1, options: { body: { template: "#paNome#", yCount: 10, url: BASE_URL + "CPaises/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idFormacao_provNomeTM").setValue("");
                                            $$("idFormacao_provNomeTM").getList().clearAll();
                                            $$("idFormacao_provNomeTM").getList().load(BASE_URL + "CProvincias/readXP?id=" + this.getValue());
                                        }
                                    }
                                },
                                {
                                    view: "richselect", label: 'Habilita&ccedil;&atilde;o Literária', name: "hlfNome", id: "idhlfNomeTM", options: { body: { template: "#hlfNome#", yCount: 7, url: BASE_URL + "CHabilitacoes_Literarias_Candidatos/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idFormacao_efNomeTM").setValue("");
                                            $$("idFormacao_efNomeTM").getList().clearAll();
                                            $$("idFormacao_efNomeTM").getList().load(BASE_URL + "CEscola_Formacao/readXtipo?tipo=" + this.getValue());
                                        }
                                    }
                                },
                                //{ view: "text", label: 'Op&ccedil;&atilde;o', name: "Opcao", id: "idOpcao" },
                                { view: "richselect", label: 'Op&ccedil;&atilde;o', name: "opcNome", id: "idOpcaoTM", options: { body: { template: "#opcNome#", yCount: 10, url: BASE_URL + "COpcao/read" } } },
                                {
                                    view: "text", label: 'M&eacute;dia', name: "Media", id: "idMediaTM", format: webix.Number.numToStr({
                                        groupDelimiter: ",",
                                        groupSize: 2,
                                        decimalDelimiter: ",",
                                        decimalSize: 2
                                    }),
                                    validate: "isNumber", validateEvent: "key"
                                },
                                {}
                            ]
                        }, {
                                rows: [
                                    { view: "richselect", label: 'Provincia', name: "provNome", id: "idFormacao_provNomeTM", value: 1, options: { body: { template: "#provNome#", yCount: 10, url: BASE_URL + "CProvincias/read" } } },
                                    //{ view: "text", label: 'Escola', name: "Escola", id: "idEscola" },
                                    {
                                        view: "richselect", label: 'Escola', name: "efNome", id: "idFormacao_efNomeTM", options: { body: { template: "#efNome#", yCount: 10, url: BASE_URL + "CEscola_Formacao/read" } },
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                //code
                                                $$("idOpcaoTM").setValue("");
                                                $$("idOpcaoTM").getList().clearAll();
                                                $$("idOpcaoTM").getList().load(BASE_URL + "COpcao/readXtipo?escola=" + this.getValue());
                                            }
                                        }
                                    },
                                    //{ view: "text", label: 'Ano', name: "Ano", id: "idAno" },
                                    { view: "counter", label: "Ano", name: "Ano", value: 2016, id: "idAnoTM", validate: "isNumber", validateEvent: "key" },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [{},
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_TM_add").close();
                                }
                            }
                        ]
                    }
                ],
                elementsConfig: {
                    labelPosition: "top",
                }
            }
        }, {
            header: "Endere&ccedil;o/Contacto", body: {
                view: "form",
                id: "idformADDDadosOutrosTM",
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", label: 'Pais', name: "paNome", id: "idpaNomeTM", value: 1, options: { body: { template: "#paNome#", yCount: 10, url: BASE_URL + "CPaises/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idprovNomeTM").setValue("");
                                            $$("idprovNomeTM").getList().clearAll();
                                            $$("idprovNomeTM").getList().load(BASE_URL + "cProvincias/readXP?id=" + this.getValue());
                                        }
                                    }
                                },
                                {
                                    view: "richselect", id: "idmunNomeTM", label: 'Municipio', name: "munNome", options: { body: { template: "#munNome#", yCount: 7, url: BASE_URL + "CMunicipios/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idbaiNomeTM").setValue("");
                                            $$("idbaiNomeTM").getList().clearAll();
                                            $$("idbaiNomeTM").getList().load(BASE_URL + "cBairros/readXMunicipio?id=" + this.getValue());
                                        }
                                    }
                                },
                                { view: "text", label: 'Telefone', name: "cTelefone", id: "idcTelefoneTM" },
                                {}
                            ]
                        }, {
                                rows: [
                                    {
                                        view: "richselect", id: "idprovNomeTM", label: 'Provincia', name: "provNome", options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read" } },
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                //code
                                                //alert(this.getValue());
                                                $$("idmunNomeTM").setValue("");
                                                $$("idmunNomeTM").getList().clearAll();
                                                $$("idmunNomeTM").getList().load(BASE_URL + "cMunicipios/readXProvincia?id=" + this.getValue());
                                            }
                                        }
                                    },
                                    { view: "richselect", id: "idbaiNomeTM", label: 'Comuna', name: "baiNome", options: { body: { template: "#baiNome#", yCount: 7, url: BASE_URL + "CBairros/read" } } },
                                    { view: "text", label: 'E-Mail', name: "cEmail", id: "idcEmailTM" },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [{},
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_TM_add").close();
                                }
                            }
                        ]
                    }
                ],
                elementsConfig: {
                    labelPosition: "top",
                }
            }
        }, {
            header: "Matricula", body: {
                view: "form",
                id: "idformADDDadosMatriculaTM",
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", /*width: 130,*/ id: "idCBn",
                                    label: 'Nivel', name: "nNome",
                                    labelPosition: "top",
                                    options: {
                                        body: {
                                            template: "#nNome#",
                                            yCount: 7,
                                            url: BASE_URL + "CNiveis/read"
                                        }
                                    },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            var n = $$("idCBn").getValue();
                                            var c = $$("idCBc").getValue();
                                            var p = $$("idCBp").getValue();
                                            var ac = $$("idCBac").getValue();
                                            if (n && c && p && ac) {
                                                $$("idCBt").getList().clearAll();
                                                $$("idCBt").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                            }

                                        }
                                    }
                                },
                                {
                                    view: "richselect", /*width: 110,*/ id: "idCBp",
                                    label: 'Periodos', name: "pNome",
                                    labelPosition: "top",
                                    options: {
                                        body: {
                                            template: "#pNome#",
                                            yCount: 7,
                                            url: BASE_URL + "CPeriodos/read"
                                        }
                                    },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            var n = $$("idCBn").getValue();
                                            var c = $$("idCBc").getValue();
                                            var p = $$("idCBp").getValue();
                                            var ac = $$("idCBac").getValue();
                                            if (n && c && p && ac) {
                                                $$("idCBt").getList().clearAll();
                                                $$("idCBt").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                            }

                                        }
                                    }
                                },
                                {
                                    view: "richselect", /*width: 80,*/ id: "idCBs",
                                    label: 'Semestre', name: "sNome",
                                    labelPosition: "top",
                                    options: {
                                        body: {
                                            template: "#sNome#",
                                            yCount: 7,
                                            url: BASE_URL + "CSemestres/read"
                                        }
                                    }
                                },
                                {
                                    view: "richselect", /*width: 80,*/ id: "idCBal_ing",
                                    label: 'Ano Lectivo de Ingresso', name: "alAno",
                                    labelPosition: "top",
                                    options: {
                                        body: {
                                            template: "#alAno#",
                                            yCount: 7,
                                            url: BASE_URL + "CAnos_Lectivos/read"
                                        }
                                    }
                                },
                                {}
                            ]
                        }, {
                                rows: [
                                    {
                                        view: "richselect", /*width: 130,*/ id: "idCBc",
                                        label: 'Curso', name: "cNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#cNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CCursos/read"
                                            }
                                        },
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                var n = $$("idCBn").getValue();
                                                var c = $$("idCBc").getValue();
                                                var p = $$("idCBp").getValue();
                                                var ac = $$("idCBac").getValue();
                                                if (n && c && p && ac) {
                                                    $$("idCBt").getList().clearAll();
                                                    $$("idCBt").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                                }

                                            }
                                        }
                                    },
                                    {
                                        view: "richselect", /*width: 100,*/ id: "idCBac",
                                        label: 'Ano Curricular', name: "acNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#acNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CAno_Curricular/read"
                                            }
                                        },
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                $$("idCBs").setValue("");
                                                $$("idCBs").getList().clearAll();
                                                $$("idCBs").getList().load(BASE_URL + "CAno_Curricular/dt_semestres?ac=" + this.getValue());

                                                var n = $$("idCBn").getValue();
                                                var c = $$("idCBc").getValue();
                                                var p = $$("idCBp").getValue();
                                                var ac = $$("idCBac").getValue();
                                                if (n && c && p && ac) {
                                                    $$("idCBt").getList().clearAll();
                                                    $$("idCBt").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                                }
                                            }
                                        }
                                    },
                                    {
                                        view: "richselect", /*width: 120,*/ id: "idCBt",
                                        label: 'Turma', name: "tNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#tNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CTurmas/read"
                                            }
                                        }
                                    },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [
                            {
                                view: "button", type: "form", value: "Salvar", click: function () {
                                    //ver si ya existe el bi en la BD
                                    var envio = "bi=" + $$('idcBI_PassaporteTM').getValue();
                                    var rebi = webix.ajax().sync().post(BASE_URL + "CCandidatos/Existe_BI", envio);
                                    if (rebi.responseText == "true") {
                                        webix.message({ type: "error", text: "Erro, Ja existe um Candidato com este BI na Base de Dados" });
                                    } else {
                                        var BI_ESTUDANTE = $$("idcBI_PassaporteTM").getValue();
                                        var profissao = ($$("idproNomeTM").getValue()) ? $$("idproNomeTM").getValue() : 1;
                                        //var y = new Date;
                                        /* var ano_actual = y.getFullYear();
                                        var envio = "alAno=" + ano_actual;
                                        var r = webix.ajax().sync().post(BASE_URL + "CAnos_Lectivos/GetID", envio);
                                        var ano_id = r.responseText;
                                        if (ano_id !== "false") {
                                        */
                                        if ($$("idcNomeTM").getValue() && $$("idcApelidoTM").getValue() && $$("idcBI_PassaporteTM").getValue() &&
                                            $$("idcBI_Data_EmissaoTM").getValue() && $$("idhlfNomeTM").getValue() && $$("idFormacao_efNomeTM").getValue() &&
                                            $$("idOpcaoTM").getValue() && $$("idMediaTM").getValue() && $$("idAnoTM").getValue() &&
                                            $$("idpaNomeTM").getValue() && $$("idprovNomeTM").getValue() && $$("idmunNomeTM").getValue() && $$("idbaiNomeTM").getValue() &&
                                            $$("idNascimento_Provincias_idTM").getValue() && $$("idNascimento_Municipios_idTM").getValue() &&
                                            // Dados de Matricula
                                            $$("idCBn").getValue() && $$("idCBp").getValue() && $$("idCBs").getValue() &&
                                            $$("idCBc").getValue() && $$("idCBac").getValue() && $$("idCBt").getValue()) {

                                            $$('idDTEdDadosPesoaisTM').add({
                                                cNome: $$("idcNomeTM").getValue(),
                                                cNomes: $$("idcNomesTM").getValue(),
                                                cApelido: $$("idcApelidoTM").getValue(),
                                                gNome: $$("idgNomeTM").getValue(),
                                                ngNome: $$("idngNomeTM").getValue(),
                                                cNome_Mae: $$("idcNome_MaeTM").getValue(),
                                                cBI_Data_Emissao: $$("idcBI_Data_EmissaoTM").getValue(),
                                                ecNome: $$("idecNomeTM").getValue(),
                                                cData_Nascimento: $$("idcData_NascimentoTM").getValue(),
                                                provNascimento: $$("idNascimento_Provincias_idTM").getValue(),
                                                munNascimento: $$("idNascimento_Municipios_idTM").getValue(),
                                                cNome_Pai: $$("idcNome_PaiTM").getValue(),
                                                cBI_Passaporte: $$("idcBI_PassaporteTM").getValue(),
                                                provEmissao: $$("idcBI_Lugar_Emissao_Provincia_idTM").getValue(),
                                                neeNome: $$("idneeNomeTM").getValue(),
                                                //Profissionais
                                                proNome: profissao,
                                                tilNome: ($$("idtilNomeTM").getValue()) ? $$("idtilNomeTM").getValue() : 1,
                                                dlLocal_Trabalho: $$("iddlLocal_TrabalhoTM").getValue(),
                                                trabNome: $$("idtrabNomeTM").getValue(),
                                                otNome: ($$("idotNomeTM").getValue()) ? $$("idotNomeTM").getValue() : 1,
                                                dlCargo: $$("iddlCargoTM").getValue(),
                                                //Academicos
                                                paFormacao: $$("idFormacao_paNomeTM").getValue(),
                                                provFormacao: $$("idFormacao_provNomeTM").getValue(),
                                                hlfNome: $$("idhlfNomeTM").getValue(),
                                                Opcao: $$("idOpcaoTM").getValue(),
                                                Media: $$("idMediaTM").getValue(),
                                                efNome: $$("idFormacao_efNomeTM").getValue(),
                                                Ano: $$("idAnoTM").getValue(),
                                                //Localizacao
                                                paNome: $$("idpaNomeTM").getValue(),
                                                provNome: $$("idprovNomeTM").getValue(),
                                                munNome: $$("idmunNomeTM").getValue(),
                                                baiNome: $$("idbaiNomeTM").getValue(),
                                                cTelefone: $$("idcTelefoneTM").getValue(),
                                                cEmail: $$("idcEmailTM").getValue(),
                                                //outros dados
                                                ano: $$("idCBal_ing").getValue(),//ano_id,
                                                usuario: user_sessao,
                                                //dados de matricula
                                                nNome: $$("idCBn").getValue(),
                                                curso: $$("idCBc").getValue(),
                                                pNome: $$("idCBp").getValue(),
                                                acNome: $$("idCBac").getValue(),
                                                sNome: $$("idCBs").getValue(),
                                                tNome: $$("idCBt").getValue(),

                                                //alIngreso: $$("idCBal_ing").getValue(),
                                            });


                                            //
                                            webix.extend($$("app"), webix.ProgressBar);
                                            function show_progress_bar(delay) {
                                                $$("app").disable();
                                                $$("app").showProgress({
                                                    type: "top",
                                                    delay: delay,
                                                    hide: true
                                                });
                                                setTimeout(function () {
                                                    //retardar pdf
                                                    //cargar comprobativo
                                                    //PREPATAT DATA E HORA
                                                    var d = new Date();
                                                    var dataActual = d.getFullYear() + "" + (d.getMonth() + 1) + "" + d.getDate();
                                                    var horaActual = d.getHours() + "" + d.getMinutes() + "" + d.getSeconds();
                                                    //var anoLectivoIngresso = $$("idCBal_ing").getValue();

                                                    var envio = "bi=" + BI_ESTUDANTE + "&data=" + dataActual + "&hora=" + horaActual + "&utilizadores_id=" + user_sessao;
                                                    var r = webix.ajax().sync().post(BASE_URL + "Cacademica_confirmacao_comprobativo/imprimir", envio);
                                                    if (r.responseText == "true") {
                                                        webix.message("PDF criado com sucesso");
                                                        //Carregar PDF
                                                        webix.ui({
                                                            view: "window",
                                                            id: "idWinPDFCP_ComprobativoCF",
                                                            height: 600,
                                                            width: 700,
                                                            left: 50, top: 50,
                                                            move: true,
                                                            modal: true,
                                                            //head:"This window can be moved",
                                                            head: {
                                                                view: "toolbar", cols: [
                                                                    { view: "label", label: "Comprovativo de Inscri&ccedil;&atilde;o" },
                                                                    { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFCP_ComprobativoCF').close(); } }
                                                                ]
                                                            },
                                                            body: {
                                                                //template:"Some text"
                                                                template: '<div id="idPDF_ComprobativoCF" style="width:690px;  height:590px"></div>'
                                                            }
                                                        }).show();
                                                        PDFObject.embed("../../relatorios/Academica_Confirmacao_Comprobativo.pdf", "#idPDF_ComprobativoCF");


                                                    } else {
                                                        webix.message({ type: "error", text: "Erro ao cargar PDF" });
                                                    }

                                                    $$("app").enable();
                                                }, delay);
                                            }

                                            setTimeout(show_progress_bar(4000), 4000);




                                            $$("id_win_TM_add").close();
                                        } else {
                                            webix.message({ type: "error", text: "Algums campos s&atilde;o obrigatorios" });
                                        }

                                    }
                                }
                            },
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_TM_add").close();
                                }
                            }
                        ]
                    }
                ],
                elementsConfig: {
                    labelPosition: "top",
                }
            }
        }
    ]
};
//editar
var formEDDadosPesoaisTM = {
    view: "tabview",
    id: "id_form_inscricao_edTM",
    //height:900,
    cells: [{
        header: "Pessoais", body: {
            view: "form",
            id: "idformEDDadosPesoaisTM",
            height: 450,
            borderless: true,
            elements: [
                {
                    cols: [
                        {
                            rows: [
                                { view: "text", label: 'Nome', name: "cNome", id: "idcNomeTM", validate: "isNotEmpty", validateEvent: "blur" },
                                { view: "text", label: 'Apelido', name: "cApelido", id: "idcApelidoTM", validate: "isNotEmpty", validateEvent: "blur" },
                                { view: "datepicker", label: "Data Nascimento", name: "cData_Nascimento", id: "idcData_NascimentoTM", stringResult: true },
                                { view: "richselect", label: 'Nacionalidade', name: "ngNome", id: "idngNomeTM", options: { body: { template: "#ngNome#", yCount: 7, url: BASE_URL + "CNacionalidades_Geral/read" } } },
                                { view: "richselect", label: 'Municipio Nascimento', name: "munNascimento", id: "idNascimento_Municipios_idTM", options: { body: { template: "#munNascimento#", yCount: 7, url: BASE_URL + "CMunicipios/readMN" } } },
                                { view: "datepicker", label: "BI Data Emiss&atilde;o", name: "cBI_Data_Emissao", id: "idcBI_Data_EmissaoTM", stringResult: true },
                                { view: "text", label: 'Nome Pai', name: "cNome_Pai", id: "idcNome_PaiTM", validate: "isNotEmpty", validateEvent: "blur" },
                                { view: "richselect", label: 'Necessita educa&ccedil;&atilde;o especial', name: "neeNome", id: "idneeNomeTM", options: { body: { template: "#neeNome#", yCount: 7, url: BASE_URL + "CNecessita_Educacao_Especial/read" } } },
                                {}
                            ]
                        }, {
                            rows: [
                                { view: "text", label: 'Nomes', name: "cNomes", id: "idcNomesTM", validate: "isNotEmpty", validateEvent: "blur" },
                                { view: "richselect", label: 'Genero', name: "gNome", id: "idgNomeTM", options: { body: { template: "#gNome#", yCount: 7, url: BASE_URL + "CGeneros/read" } } },
                                { view: "richselect", label: 'Estado Civil', name: "ecNome", id: "idecNomeTM", options: { body: { template: "#ecNome#", yCount: 7, url: BASE_URL + "CEstado_Civil/read" } } },
                                { view: "richselect", label: 'Provincia Nascimento', name: "provNascimento", id: "idNascimento_Provincias_idTM", options: { body: { template: "#provNascimento#", yCount: 7, url: BASE_URL + "CProvincias/readPN" } } },
                                { view: "text", label: 'BI/Passaporte', name: "cBI_Passaporte", id: "idcBI_PassaporteTM", validate: "isNotEmpty", validateEvent: "blur" },
                                { view: "richselect", label: 'BI Provincia Emiss&atilde;o', name: "cBI_Lugar_Emissao_Provincia_id", id: "idcBI_Lugar_Emissao_Provincia_idTM", options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read" } } },
                                { view: "text", label: 'Nome Mae', name: "cNome_Mae", id: "idcNome_MaeTM", validate: "isNotEmpty", validateEvent: "blur" },
                                {}
                            ]
                        }
                    ]
                }, {
                    cols: [{},
                        {
                            view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                $$("id_win_inscricao_edTM").close();
                            }
                        }
                    ]
                }
            ],
            elementsConfig: {
                labelPosition: "top",
            }
        }
    },
        {
            header: "Profissionais", body: {
                view: "form",
                id: "idformADDDadosProfissionaisTM",
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", label: 'Trabalhador', name: "trabNome", id: "idtrabNomeTM", options: { body: { template: "#trabNome#", yCount: 10, url: BASE_URL + "CTrabalhador/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            if (this.getValue() == 2) {
                                                $$("idtilNomeTM").disable();
                                                $$("iddlLocal_TrabalhoTM").disable();
                                                $$("idproNomeTM").disable();
                                                $$("idotNomeTM").disable();
                                                $$("iddlCargoTM").disable();
                                            } else {
                                                $$("idtilNomeTM").enable();
                                                $$("iddlLocal_TrabalhoTM").enable();
                                                $$("idproNomeTM").enable();
                                                $$("idotNomeTM").enable();
                                                $$("iddlCargoTM").enable();
                                            }
                                        }
                                    }
                                },

                                { view: "richselect", label: 'Tipo Institui&ccedil;&atilde;o', name: "tilNome", id: "idtilNomeTM", disabled: true, options: { body: { template: "#tilNome#", yCount: 7, url: BASE_URL + "CTipo_Instituicao_Laboral/read" } } },
                                { view: "text", label: 'Local de Trabalho', name: "dlLocal_Trabalho", disabled: true, id: "iddlLocal_TrabalhoTM", },
                                {}
                            ]
                        }, {
                                rows: [
                                    { view: "richselect", label: 'Profiss&atilde;o', name: "proNome", id: "idproNomeTM", disabled: true, options: { body: { template: "#proNome#", yCount: 10, url: BASE_URL + "CProfissao/read" } } },
                                    { view: "richselect", label: 'Organismo Tutela', name: "otNome", id: "idotNomeTM", disabled: true, options: { body: { template: "#otNome#", yCount: 7, url: BASE_URL + "COrganismos_Tutela/read" } } },
                                    { view: "text", label: 'Cargo', name: "dlCargo", id: "iddlCargoTM", disabled: true },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [{},
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_inscricao_edTM").close();
                                }
                            }
                        ]
                    }
                ],
                elementsConfig: {
                    labelPosition: "top",
                }
            }
        }, {
            header: "Acad&eacute;micos", body: {
                view: "form",
                id: "idformADDDadosAcademicosTM",
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", label: 'Pa&iacute;s de Forma&ccedil;&atilde;o', name: "paNome", id: "idFormacao_paNomeTM", options: { body: { template: "#paNome#", yCount: 10, url: BASE_URL + "CPaises/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idFormacao_provNomeTM").setValue("");
                                            $$("idFormacao_provNomeTM").getList().clearAll();
                                            $$("idFormacao_provNomeTM").getList().load(BASE_URL + "CProvincias/readXP?id=" + this.getValue());
                                        }
                                    }
                                },
                                {
                                    view: "richselect", label: 'Habilita&ccedil;&atilde;o Literária', name: "hlfNome", id: "idhlfNomeTM", options: { body: { template: "#hlfNome#", yCount: 7, url: BASE_URL + "CHabilitacoes_Literarias_Candidatos/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idFormacao_efNomeTM").setValue("");
                                            $$("idFormacao_efNomeTM").getList().clearAll();
                                            $$("idFormacao_efNomeTM").getList().load(BASE_URL + "CEscola_Formacao/readXtipo?tipo=" + this.getValue());
                                        }
                                    }
                                },
                                //{ view: "text", label: 'Op&ccedil;&atilde;o', name: "Opcao", id: "idOpcao" },
                                { view: "richselect", label: 'Op&ccedil;&atilde;o', name: "opcNome", id: "idOpcao2TM", options: { body: { template: "#opcNome#", yCount: 10, url: BASE_URL + "COpcao/read" } } },
                                {
                                    view: "text", label: 'M&eacute;dia', name: "Media", id: "idMediaTM", format: webix.Number.numToStr({
                                        groupDelimiter: ",",
                                        groupSize: 2,
                                        decimalDelimiter: ",",
                                        decimalSize: 2
                                    }),
                                    validate: "isNumber", validateEvent: "key"
                                },
                                {}
                            ]
                        }, {
                                rows: [
                                    { view: "richselect", label: 'Provincia', name: "provNome", id: "idFormacao_provNomeTM", options: { body: { template: "#provNome#", yCount: 10, url: BASE_URL + "CProvincias/read" } } },
                                    //{ view: "text", label: 'Escola', name: "Escola", id: "idEscola" },
                                    {
                                        view: "richselect", label: 'Escola', name: "efNome", id: "idFormacao_efNomeTM", options: { body: { template: "#efNome#", yCount: 10, url: BASE_URL + "CEscola_Formacao/read" } },
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                //code
                                                //$$("idOpcao2").setValue("");
                                                //$$("idOpcao2").getList().clearAll();
                                                //$$("idOpcao2").getList().load(BASE_URL + "COpcao/readXtipo?escola=" + this.getValue());
                                            }
                                        }
                                    },
                                    //{ view: "text", label: 'Ano', name: "Ano", id: "idAno" },
                                    { view: "counter", label: "Ano", name: "Ano", id: "idAnoTM", validate: "isNumber", validateEvent: "key" },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [{},
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_inscricao_edTM").close();
                                }
                            }
                        ]
                    }
                ],
                elementsConfig: {
                    labelPosition: "top",
                }
            }
        }, {
            header: "Endere&ccedil;o/Contacto", body: {
                view: "form",
                id: "idformADDDadosOutrosTM",
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", label: 'Pais', name: "paNome", id: "idpaNomeTM", options: { body: { template: "#paNome#", yCount: 10, url: BASE_URL + "CPaises/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idprovNomeTM").setValue("");
                                            $$("idprovNomeTM").getList().clearAll();
                                            $$("idprovNomeTM").getList().load(BASE_URL + "cProvincias/readXP?id=" + this.getValue());
                                        }
                                    }
                                },
                                {
                                    view: "richselect", id: "idmunNomeTM", label: 'Municipio', name: "munNome", options: { body: { template: "#munNome#", yCount: 7, url: BASE_URL + "CMunicipios/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idbaiNomeTM").setValue("");
                                            $$("idbaiNomeTM").getList().clearAll();
                                            $$("idbaiNomeTM").getList().load(BASE_URL + "cBairros/readXMunicipio?id=" + this.getValue());
                                        }
                                    }
                                },
                                { view: "text", label: 'Telefone', name: "cTelefone", id: "idcTelefoneTM" },
                                {}
                            ]
                        }, {
                                rows: [
                                    {
                                        view: "richselect", id: "idprovNomeTM", label: 'Provincia', name: "provNome", options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read" } },
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                //code
                                                //alert(this.getValue());
                                                $$("idmunNomeTM").setValue("");
                                                $$("idmunNomeTM").getList().clearAll();
                                                $$("idmunNomeTM").getList().load(BASE_URL + "cMunicipios/readXProvincia?id=" + this.getValue());
                                            }
                                        }
                                    },
                                    { view: "richselect", id: "idbaiNomeTM", label: 'Comuna', name: "baiNome", options: { body: { template: "#baiNome#", yCount: 7, url: BASE_URL + "CBairros/read" } } },
                                    { view: "text", label: 'E-Mail', name: "cEmail", id: "idcEmailTM" },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [
                            {},
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_inscricao_edTM").close();
                                }
                            }
                        ]
                    }
                ],
                elementsConfig: {
                    labelPosition: "top",
                }
            }
        },
        {
            header: "Matricula", body: {
                view: "form",
                id: "idformEDDadosMatriculaTM",
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", id: "idcbnivel", label: 'Nivel', name: "nNome",
                                    options: {
                                        body: {
                                            template: "#nNome#", yCount: 7, url: BASE_URL + "CNiveis/read"
                                        }
                                    },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            var n = $$("idcbnivel").getValue();
                                            var c = $$("idCBc").getValue();
                                            var p = $$("idCBpED").getValue();
                                            var ac = $$("idCBac").getValue();
                                            if (n && c && p && ac) {
                                                $$("idCBt").getList().clearAll();
                                                $$("idCBt").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                            }
                                        }
                                    }
                                },

                                {
                                    view: "richselect", /*width: 110,*/ id: "idCBpED",
                                    label: 'Periodos', name: "pNome",
                                    labelPosition: "top",
                                    options: {
                                        body: {
                                            template: "#pNome#",
                                            yCount: 7,
                                            url: BASE_URL + "CPeriodos/read"
                                        }
                                    },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            var n = $$("idcbnivel").getValue();
                                            var c = $$("idCBc").getValue();
                                            var p = $$("idCBpED").getValue();
                                            var ac = $$("idCBac").getValue();
                                            if (n && c && p && ac) {
                                                $$("idCBt").getList().clearAll();
                                                $$("idCBt").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                            }
                                        }
                                    }
                                },
                                {
                                    view: "richselect", /*width: 80,*/ id: "idCBs",
                                    label: 'Semestre', name: "sNome",
                                    labelPosition: "top",
                                    options: {
                                        body: {
                                            template: "#sNome#",
                                            yCount: 7,
                                            url: BASE_URL + "CSemestres/read"
                                        }
                                    }
                                },



                                {}
                            ]
                        }, {
                                rows: [
                                    {
                                        view: "richselect", /*width: 130,*/ id: "idCBc",
                                        label: 'Curso', name: "cNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#cNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CCursos/read"
                                            }
                                        },
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                var n = $$("idcbnivel").getValue();
                                                var c = $$("idCBc").getValue();
                                                var p = $$("idCBpED").getValue();
                                                var ac = $$("idCBac").getValue();
                                                if (n && c && p && ac) {
                                                    $$("idCBt").getList().clearAll();
                                                    $$("idCBt").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                                }
                                            }
                                        }
                                    },
                                    {
                                        view: "richselect", /*width: 100,*/ id: "idCBac",
                                        label: 'Ano Curricular', name: "acNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#acNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CAno_Curricular/read"
                                            }
                                        },
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                $$("idCBs").setValue("");
                                                $$("idCBs").getList().clearAll();
                                                $$("idCBs").getList().load(BASE_URL + "CAno_Curricular/dt_semestres?ac=" + this.getValue());

                                                var n = $$("idcbnivel").getValue();
                                                var c = $$("idCBc").getValue();
                                                var p = $$("idCBpED").getValue();
                                                var ac = $$("idCBac").getValue();
                                                if (n && c && p && ac) {
                                                    $$("idCBt").getList().clearAll();
                                                    $$("idCBt").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                                }
                                            }
                                        }
                                    },
                                    {
                                        view: "richselect", /*width: 120,*/ id: "idCBt",
                                        label: 'Turma', name: "tNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#tNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CTurmas/read"
                                            }
                                        }
                                    },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [
                            {
                                view: "button", type: "form", value: "Salvar", click: function () {
                                    var idSelecionado = $$("idDTEdDadosPesoaisTM").getSelectedId(false, true);
                                    var profissao = ($$("idproNomeTM").getValue()) ? $$("idproNomeTM").getValue() : 1;
                                    var y = new Date;
                                    var ano_actual = y.getFullYear();
                                    var envio = "alAno=" + ano_actual;
                                    var r = webix.ajax().sync().post(BASE_URL + "CAnos_Lectivos/GetID", envio);
                                    var ano_id = r.responseText;
                                    if (idSelecionado) {
                                        //$$('idDTEdDadosPesoais').upd({
                                        var cNome = $$("idcNomeTM").getValue();
                                        var cNomes = $$("idcNomesTM").getValue();
                                        var cApelido = $$("idcApelidoTM").getValue();
                                        var gNome = $$("idgNomeTM").getValue();
                                        var ngNome = $$("idngNomeTM").getValue();
                                        var cNome_Mae = $$("idcNome_MaeTM").getValue();
                                        var cBI_Data_Emissao = $$("idcBI_Data_EmissaoTM").getValue();
                                        var ecNome = $$("idecNomeTM").getValue();
                                        var cData_Nascimento = $$("idcData_NascimentoTM").getValue();
                                        var provNascimento = $$("idNascimento_Provincias_idTM").getValue();
                                        var munNascimento = $$("idNascimento_Municipios_idTM").getValue();
                                        var cNome_Pai = $$("idcNome_PaiTM").getValue();
                                        var cBI_Passaporte = $$("idcBI_PassaporteTM").getValue();
                                        var provEmissao = $$("idcBI_Lugar_Emissao_Provincia_idTM").getValue();
                                        var neeNome = $$("idneeNomeTM").getValue();
                                        //Profissionais
                                        var proNome = profissao;
                                        var tilNome = $$("idtilNomeTM").getValue();
                                        var dlLocal_Trabalho = $$("iddlLocal_TrabalhoTM").getValue();
                                        var trabNome = $$("idtrabNomeTM").getValue();
                                        var otNome = $$("idotNomeTM").getValue();
                                        var dlCargo = $$("iddlCargoTM").getValue();
                                        //Academicos
                                        var paFormacao = $$("idFormacao_paNomeTM").getValue();
                                        var provFormacao = $$("idFormacao_provNomeTM").getValue();
                                        var hlfNome = $$("idhlfNomeTM").getValue();
                                        var Opcao = $$("idOpcao2TM").getValue();
                                        var Media = $$("idMediaTM").getValue();
                                        var efNome = $$("idFormacao_efNomeTM").getValue();
                                        var Ano = $$("idAnoTM").getValue();
                                        //Localizacao
                                        var paNome = $$("idpaNomeTM").getValue();
                                        var provNome = $$("idprovNomeTM").getValue();
                                        var munNome = $$("idmunNomeTM").getValue();
                                        var baiNome = $$("idbaiNomeTM").getValue();
                                        var cTelefone = $$("idcTelefoneTM").getValue();
                                        var cEmail = $$("idcEmailTM").getValue();
                                        //outros dados
                                        var ano = ano_id;
                                        var usuario = user_sessao;
                                        //});
                                        var envio = "webix_operation=update" + "&id=" + idSelecionado + "&cNome=" + cNome + "&cNomes=" + cNomes + "&cApelido=" + cApelido + "&gNome=" + gNome + "&ngNome=" + ngNome + "&cNome_Mae=" + cNome_Mae +
                                            "&cBI_Data_Emissao=" + cBI_Data_Emissao + "&ecNome=" + ecNome + "&cData_Nascimento=" + cData_Nascimento + "&provNascimento=" + provNascimento +
                                            "&munNascimento=" + munNascimento + "&cNome_Pai=" + cNome_Pai + "&cBI_Passaporte=" + cBI_Passaporte + "&provEmissao=" + provEmissao +
                                            "&neeNome=" + neeNome +
                                            //Profissionais
                                            "&proNome=" + proNome + "&tilNome=" + tilNome + "&dlLocal_Trabalho=" + dlLocal_Trabalho + "&trabNome=" + trabNome + "&otNome=" + otNome + "&dlCargo=" + dlCargo +
                                            //Academicos
                                            "&paFormacao=" + paFormacao + "&provFormacao=" + provFormacao + "&hlfNome=" + hlfNome + "&Opcao=" + Opcao + "&Media=" + Media + "&efNome=" + efNome + "&Ano=" + Ano +
                                            //Localizacao
                                            "&paNome=" + paNome + "&provNome=" + provNome + "&munNome=" + munNome + "&baiNome=" + baiNome + "&cTelefone=" + cTelefone + "&cEmail=" + cEmail + "&ano=" + ano +
                                            //usuarios
                                            "&usuario=" + usuario;

                                        var r = webix.ajax().sync().post(BASE_URL + "CCandidatos/crud", envio);
                                        if (r.responseText == "true") {
                                            //actualizar dados de estudantes
                                            var nNome = $$("idcbnivel").getValue();
                                            var cNome = $$("idCBc").getValue();
                                            var pNome = $$("idCBpED").getValue();
                                            var acNome = $$("idCBac").getValue();
                                            var sNome = $$("idCBs").getValue();
                                            var tNome = $$("idCBt").getValue();

                                            var envio = "Candidatos_id=" + idSelecionado + "&nNome=" + nNome + "&cNome=" + cNome +
                                                "&pNome=" + pNome + "&acNome=" + acNome + "&sNome=" + sNome + "&tNome=" + tNome +
                                                "&webix_operation=update";
                                            var rest = webix.ajax().sync().post(BASE_URL + "CEstudantes/crud", envio);
                                            if (rest.responseText == "true")
                                                webix.message("Dados actualizados com sucesso");
                                            else
                                                webix.message({ type: "error", text: "Erro ao actualizar estudante" });
                                        } else {
                                            webix.message({ type: "error", text: "Erro ao actualizar dados" });
                                        }
                                        $$("idDTEdDadosPesoaisTM").clearAll();
                                        $$("idDTEdDadosPesoaisTM").load(BASE_URL + "cCandidatos/readDPE");
                                        $$("idDTEdDadosProfisionaisTM").clearAll();
                                        $$("idDTEdDadosProfisionaisTM").load(BASE_URL + "cCandidatos/readDPROE");
                                        $$("idDTEdDadosAcademicosTM").clearAll();
                                        $$("idDTEdDadosAcademicosTM").load(BASE_URL + "cCandidatos/readDACAE");
                                        $$("idDTEdDadosLocalizacaoTM").clearAll();
                                        $$("idDTEdDadosLocalizacaoTM").load(BASE_URL + "cCandidatos/readDLOCE");

                                        $$("id_win_inscricao_edTM").close();
                                    }
                                    else {
                                        webix.message({ type: "error", text: "O ano actual n&atilde;o est&aacute; activo para inscri&ccedil;&atilde;o" });
                                    }
                                }
                            },
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_inscricao_edTM").close();
                                }
                            }
                        ]
                    }
                ],
                elementsConfig: {
                    labelPosition: "top",
                }
            }
        }
    ]
}


//var CODIGO_FOTO;
//fotografia
//var formADDFoto = {
function formFotoTM(CODIGO_FOTO) {
    var formADDFotoTM = {
        view: "form",
        id: "idformADDFotoTM",
        height: 550,
        borderless: true,
        elements: [{
            rows: [
                {
                    cols: [
                        {},
                        { view: "template", width: 480, template: '<div id="my_camera">' + '<img src=' + PRO_URL + 'Fotos/Candidatos/' + CODIGO_FOTO + '.jpg /></div>' },
                        {}
                    ]
                },
                {
                    cols: [
                        {
                            view: "button", value: "Activar Camera", type: "standard", click: function () {
                                Webcam.set({
                                    width: 480,
                                    height: 390,
                                    image_format: 'jpeg',
                                    jpeg_quality: 100
                                });
                                Webcam.attach('#my_camera');
                            }
                        },
                        {
                            view: "button", value: "Captura/Salvar", type: "form", click: function () {
                                var idSelecionado = $$("idDTEdDadosPesoaisTM").getSelectedId(false, true);
                                Webcam.snap(function (data_uri) {
                                    // display results in page
                                    document.getElementById('my_camera').innerHTML = '<img src="' + data_uri + '"/>';
                                    Webcam.upload(data_uri, BASE_URL + 'cCandidatos/salvarFoto?id=' + idSelecionado, function (code, text) {
                                        if (text !== "true") {
                                            webix.message({ type: "error", text: "Deve selecionar primeriro um Candidato" });
                                        } else {
                                            webix.message({ text: "Foto guardada com sucesso" });
                                        }

                                    });
                                });
                            }
                        },
                        {
                            view: "button", value: "Fechar", name: "fechar", type: "danger", click: function () {
                                //Webcam.off('set');
                                Webcam.reset();
                                //cargar foto
                                var idSelecionado = $$("idDTEdDadosPesoaisTM").getSelectedId(false, true);
                                var envio = "id=" + idSelecionado;
                                var r = webix.ajax().sync().post(BASE_URL + "cCandidatos/cargarFoto", envio);
                                var CODIGO_FOTO = r.responseText;
                                if (CODIGO_FOTO) {
                                    // idform_DP_superior_grid
                                    $$("idform_DP_superior_gridTM").removeView("id_template_fotoTM");
                                    $$("idform_DP_superior_gridTM").addView({ view: "template", id: "id_template_fotoTM", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Candidatos/' + CODIGO_FOTO + '.jpg /></div>' }, 2);
                                } else {
                                    $$("idform_DP_superior_gridTM").removeView("id_template_fotoTM");
                                    $$("idform_DP_superior_gridTM").addView({ view: "template", id: "id_template_fotoTM", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Candidatos/default.jpg /></div>' }, 2);
                                }

                                $$("idwinADDFotoCandidatosTM").close();
                            }
                        }
                    ]
                }

            ]
        }]
    };
    return formADDFotoTM;
}


