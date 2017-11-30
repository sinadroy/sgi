var formLogin_dpto_dosi = {
    view: "form",
    id: "idformLogin_dpto_dosi",
    borderless: true,
    elements: [
        { view: "text", label: 'Usu&aacute;rio', name: "login" },
        { view: "text", label: 'Senha', name: "senha", type: "password" },
        {
            view: "button", value: "Entrar", hotkey: "enter", click: function () {
                if (this.getParentView().validate()) { //validate form
                    var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/validar", "action=login&login=" + $$("idformLogin_dpto_dosi").getValues().login + "&senha=" + $$("idformLogin_dpto_dosi").getValues().senha);
                    if (r.responseText == "true") {
                        this.getTopParentView().hide(); //hide window
                        var r2 = webix.ajax().sync().post(BASE_URL + "Cchefes_departamentos_utilizadores/dt_se_chefe_departamento", "login=" + $$("idformLogin_dpto_dosi").getValues().login);
                        if (r2.responseText == "true") {
                            webix.message("A carregar programas...");
                            //cargar windows com combo pa seleccionar disciplina y Pautas
                            webix.ui({
                                view: "window",
                                id: "idwin_dpto_dosi",
                                width: 1200,
                                height: 600,
                                position: "center",
                                modal: true,
                                //head: "Pautas Professores",
                                head: {
                                    view: "toolbar", cols: [
                                        { view: "label", label: "Planificação das aulas por disciplinas do departamento" },
                                        {
                                            view: "button", type: "danger", label: 'X', width: 50, align: 'right', click: function () {//"$$('idwin_Pautas_Professores').close();" }
                                                $$('idwin_dpto_dosi').close();
                                                var redirect = BASE_URL + 'welcome/logout';
                                                window.location = redirect;
                                            }
                                        }
                                    ]
                                },
                                body: webix.copy(form_dpto_dosi)
                            }).show();

                            var r_idu = webix.ajax().sync().post(BASE_URL + "cutilizadores/getid", "login=" + $$("idformLogin_dpto_dosi").getValues().login);
                            var r_dpto = webix.ajax().sync().post(BASE_URL + "Cchefes_departamentos_utilizadores/read_dpto_id", "idu=" + r_idu.responseText);
                            //actualizar nivels por dpto
                            $$("id_CB_nNome_pdd").getList().clearAll();
                            $$("id_CB_nNome_pdd").getList().load(BASE_URL + "cniveis/read_dpto?dpto=" + r_dpto.responseText);
                            //actualizar cursos por dpto
                            $$("id_CB_cNome_pdd").getList().clearAll();
                            $$("id_CB_cNome_pdd").getList().load(BASE_URL + "ccursos/read_dpto?dpto=" + r_dpto.responseText);
                            //$$("idLI_CB_nNome_ld").getList().load(BASE_URL + "cdisciplinas/read_dpto?dpto=" + r_dpto.responseText);

                        } else
                            webix.message({ type: "error", text: "Usuário incorretos, não é chefe de departamento" });

                    } else
                        webix.message({ type: "error", text: "Dados incorretos" });
                }
                else
                    webix.message({ type: "error", text: "Dados incorretos" });
            }
        },
        {
            view: "button", value: "Cancel", name: "cancel", type: "danger", click: function () {
                $$("idformLogin_dpto_dosi").clear();
                this.getTopParentView().hide(); //hide window
            }
        }
    ],
    rules: {
        "senha": webix.rules.isNotEmpty,
        "login": webix.rules.isNotEmpty
    },
    elementsConfig: {
        labelPosition: "top",
    }
};

webix.ui({
    view: "window",
    //view: "popup",
    id: "winLogin_dpto_dosi",
    width: 300,
    position: "center",
    modal: false,
    head: "Dados de Usu&aacute;rio",
    //body:webix.copy(form)
    body: formLogin_dpto_dosi
});

var form_dpto_dosi = {
    view: "form",
    id: "idform_dpto_dosi",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "form", rows: [
                        {
                            rows: [
                                {
                                    cols: [
                                        {
                                            view: "richselect", width: 200, id: "id_CB_nNome_pdd",
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

                                                    var n = $$("id_CB_nNome_pdd").getValue();
                                                    var c = $$("id_CB_cNome_pdd").getValue();
                                                    var p = $$("id_CB_pNome_pdd").getValue();
                                                    var ac = $$("id_CB_acNome_pdd").getValue();
                                                    var g = $$("id_cb_dgnome_pdd").getValue();

                                                    if (n && c && p && ac && g) {
                                                        $$("id_cb_d_pdd").setValue('');
                                                        $$("id_cb_d_pdd").getList().clearAll();

                                                        $$("id_cb_d_pdd").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p_g?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac + "&dgNome=" + g);
                                                    }

                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 500, id: "id_CB_cNome_pdd",
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
                                                    var n = $$("id_CB_nNome_pdd").getValue();
                                                    var c = $$("id_CB_cNome_pdd").getValue();
                                                    var p = $$("id_CB_pNome_pdd").getValue();
                                                    var ac = $$("id_CB_acNome_pdd").getValue();
                                                    var g = $$("id_cb_dgnome_pdd").getValue();

                                                    if (n && c && p && ac && g) {
                                                        $$("id_cb_d_pdd").setValue('');
                                                        $$("id_cb_d_pdd").getList().clearAll();
                                                        $$("id_cb_d_pdd").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p_g?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac + "&dgNome=" + g);
                                                    }
                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 125, id: "id_CB_pNome_pdd",
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
                                                    var n = $$("id_CB_nNome_pdd").getValue();
                                                    var c = $$("id_CB_cNome_pdd").getValue();
                                                    var p = $$("id_CB_pNome_pdd").getValue();
                                                    var ac = $$("id_CB_acNome_pdd").getValue();
                                                    var g = $$("id_cb_dgnome_pdd").getValue();

                                                    if (n && c && p && ac && g) {
                                                        $$("id_cb_d_pdd").setValue('');
                                                        $$("id_cb_d_pdd").getList().clearAll();
                                                        $$("id_cb_d_pdd").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p_g?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac + "&dgNome=" + g);
                                                    }

                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 100, id: "id_CB_acNome_pdd",
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
                                                    var n = $$("id_CB_nNome_pdd").getValue();
                                                    var c = $$("id_CB_cNome_pdd").getValue();
                                                    var p = $$("id_CB_pNome_pdd").getValue();
                                                    var ac = $$("id_CB_acNome_pdd").getValue();
                                                    var g = $$("id_cb_dgnome_pdd").getValue();

                                                    if (n && c && p && ac && g) {
                                                        $$("id_cb_d_pdd").setValue('');
                                                        $$("id_cb_d_pdd").getList().clearAll();
                                                        $$("id_cb_d_pdd").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p_g?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac + "&dgNome=" + g);
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
                                            view: "richselect", width: 200, id: "id_cb_dgnome_pdd",
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
                                                    var n = $$("id_CB_nNome_pdd").getValue();
                                                    var c = $$("id_CB_cNome_pdd").getValue();
                                                    var p = $$("id_CB_pNome_pdd").getValue();
                                                    var ac = $$("id_CB_acNome_pdd").getValue();
                                                    var g = $$("id_cb_dgnome_pdd").getValue();

                                                    if (n && c && p && ac && g) {
                                                        $$("id_cb_d_pdd").setValue('');
                                                        $$("id_cb_d_pdd").getList().clearAll();
                                                        $$("id_cb_d_pdd").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p_g?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac + "&dgNome=" + g);
                                                    }

                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 370, id: "id_cb_d_pdd",
                                            label: 'Disciplina', name: "dnome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#dnome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CDisciplinas/read"
                                                }
                                            },
                                            on:{
                                                "onChange": function (nrev, oldv){
                                                    $$("id_cb_temnome_pdd").getList().clearAll();
                                                    $$("id_cb_temnome_pdd").getList().load(BASE_URL + "Cplanificacoes_prof/read_temas?idd=" + this.getValue());
                                                }
                                            }
                                        },

                                        {
                                            view: "richselect", width: 370, id: "id_cb_temnome_pdd",
                                            label: 'Tema', name: "temnome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#temnome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "Cplanificacoes_prof/read_temas"
                                                }
                                            },
                                        },

                                        {
                                            view: "button", type: "form", value: "Perquisar", width: 110, click: function () {
                                                var d = $$("id_cb_d_pdd").getValue();
                                                var tema_id = $$('id_cb_temnome_pdd').getValue();

                                                if (d) {
                                                    $$("idDTdpto_dosi").clearAll();
                                                    $$("idDTdpto_dosi").load(BASE_URL + "Cplanificacoes_prof/read_x?idd=" + d + "&tema_id=" + tema_id);
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
                
                {
                    view: "datatable",
                    id: "idDTdpto_dosi",
                    select: "row", /*editable: true, editaction: "click",*/
                    editable: false,
                    columns: [
                        { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                        { id: "temas_id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                        { id: "tipo_aulas_id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                        { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                        { id: "temnome", header: ["Tema", { content: "textFilter" }], width: 300, sort: "string" },
                        { id: "temhoras", header: ["Horas", { content: "textFilter" }], width: 80, sort: "int" },
                        { id: "stnome", header: ["Aula", { content: "textFilter" }], width: 300, sort: "string" },
                        { id: "tanome", header: ["Tipo Aula", { content: "textFilter" }], width: 150, sort: "string" },
                        { id: "stobservacao", header: ["Observação", { content: "textFilter" }], width: 300, sort: "string" },
                    ],
                    resizeColumn: true,
                    //url: BASE_URL + "cpautas/read",
                    pager: "pager_dpto_dosi"
                }, {
                    view: "pager", id: "pager_dpto_dosi",
                    template: "{common.prev()} {common.pages()} {common.next()}",
                    size: 15,
                    group: 5
                }
            ]
        },
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
