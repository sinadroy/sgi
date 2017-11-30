var formLogin_planif_prof = {
    view: "form",
    id: "idformLogin_planif_prof",
    borderless: true,
    elements: [
        { view: "text", label: 'Usu&aacute;rio', name: "login" },
        { view: "text", label: 'Senha', name: "senha", type: "password" },
        {
            view: "button", value: "Entrar", hotkey: "enter", click: function () {
                if (this.getParentView().validate()) { //validate form
                    var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/validar", "action=login&login=" + $$("idformLogin_planif_prof").getValues().login + "&senha=" + $$("idformLogin_planif_prof").getValues().senha);
                    if (r.responseText == "true") {
                        this.getTopParentView().hide(); //hide window
                        var r2 = webix.ajax().sync().post(BASE_URL + "cutilizadores/Existe_ProfXUsuario", "login=" + $$("idformLogin_planif_prof").getValues().login);
                        if (r2.responseText == "true") {
                            webix.message("A carregar planificações Professor...");
                            //cargar windows com combo pa seleccionar disciplina y Pautas
                            webix.ui({
                                view: "window",
                                id: "idwin_planif_prof",
                                width: 1200,
                                height: 700,
                                position: "center",
                                modal: true,
                                //head: "Pautas Professores",
                                head: {
                                    view: "toolbar", cols: [
                                        { view: "label", label: "Planificações Professores" },
                                        {
                                            view: "button", type: "danger", label: 'X', width: 50, align: 'right', click: function () {//"$$('idwin_Pautas_Professores').close();" }
                                                $$('idwin_planif_prof').close();
                                                var redirect = BASE_URL + 'welcome/logout';
                                                window.location = redirect;
                                            }
                                        }
                                    ]
                                },
                                body: webix.copy(form__planif_prof)
                            }).show();
                            //cargar datos
                            //read_DiscXProf
                            var r3 = webix.ajax().sync().post(BASE_URL + "cutilizadores/Get_ProfXUsuario", "login=" + $$("idformLogin_planif_prof").getValues().login);

                            //id del usuario que se logueo
                            $$('id_usuario_planif_prof').setValue(r3.responseText);
                            //nome usuario
                            $$('usuario_planif_prof').setValue($$("idformLogin_planif_prof").getValues().login);

                            $$("id_cb_dNome_planif_prof").getList().clearAll();
                            $$("id_cb_dNome_planif_prof").getList().load(BASE_URL + "cprofessores_disciplinas/read_DiscXProf?id=" + r3.responseText);
                        } else
                            webix.message({ type: "error", text: "Usuário incorretos, não é docente" });

                    } else
                        webix.message({ type: "error", text: "Dados incorretos" });
                }
                else
                    webix.message({ type: "error", text: "Dados incorretos" });
            }
        },
        {
            view: "button", value: "Cancel", name: "cancel", type: "danger", click: function () {
                $$("idformLogin_planif_prof").clear();
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
    id: "winLogin_planif_prof",
    width: 300,
    position: "center",
    modal: false,
    head: "Dados de Usu&aacute;rio",
    //body:webix.copy(form)
    body: formLogin_planif_prof
});

var form__planif_prof = {
    view: "form",
    id: "idform__planif_prof",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "form", rows: [
                        {
                            view: "form", rows: [
                                {
                                    rows: [
                                        {
                                            cols: [
                                                {
                                                    view: "text", width: 80, id: "id_CB_alAno_planif_prof",
                                                    label: 'Ano Lec.', name: "alAno",
                                                    labelPosition: "top",
                                                    disabled: true,
                                                },
                                                {
                                                    view: "text", width: 200, id: "id_CB_nNome_planif_prof",
                                                    label: 'Nivel', name: "nNome",
                                                    labelPosition: "top",
                                                    disabled: true,
                                                },
                                                {
                                                    view: "text", width: 500, id: "id_CB_cNome_planif_prof",
                                                    label: 'Curso', name: "cNome",
                                                    labelPosition: "top",
                                                    disabled: true,
                                                },
                                                {}
                                            ]
                                        },
                                        {
                                            cols: [

                                                {
                                                    view: "text", width: 125, id: "id_CB_pNome_planif_prof",
                                                    label: 'Periodo', name: "pNome",
                                                    labelPosition: "top",
                                                    disabled: true,
                                                },
                                                {
                                                    view: "text", width: 100, id: "id_CB_acNome_planif_prof",
                                                    label: 'Ano Curricular', name: "acNome",
                                                    labelPosition: "top",
                                                    disabled: true,
                                                },
                                                {
                                                    view: "richselect", width: 370, id: "id_cb_dNome_planif_prof",
                                                    label: 'Disciplina', name: "dNome",
                                                    labelPosition: "top",
                                                    options: {
                                                        body: {
                                                            template: "#dNome#",
                                                            yCount: 7,
                                                            url: BASE_URL + "CDisciplinas/read"
                                                        }
                                                    },
                                                    on: {
                                                        "onChange": function (newv, oldv) {
                                                            var d = $$("id_cb_dNome_planif_prof").getValue();
                                                            if (d) {
                                                                //ano_lectivo
                                                                var r2 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_ano_lectivo", "idd=" + d + "&idp=" + $$('id_usuario_planif_prof').getValue());
                                                                $$('id_CB_alAno_planif_prof').setValue(r2.responseText);
                                                                //Nivel
                                                                var r3 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_nivel", "idd=" + d + "&idp=" + $$('id_usuario_planif_prof').getValue());
                                                                $$('id_CB_nNome_planif_prof').setValue(r3.responseText);
                                                                //Curso
                                                                var r4 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_curso", "idd=" + d + "&idp=" + $$('id_usuario_planif_prof').getValue());
                                                                $$('id_CB_cNome_planif_prof').setValue(r4.responseText);
                                                                //Periodo
                                                                var r5 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_periodo", "idd=" + d + "&idp=" + $$('id_usuario_planif_prof').getValue());
                                                                $$('id_CB_pNome_planif_prof').setValue(r5.responseText);
                                                                //Ano Curricular
                                                                var r6 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_ano_curricular", "idd=" + d + "&idp=" + $$('id_usuario_planif_prof').getValue());
                                                                $$('id_CB_acNome_planif_prof').setValue(r6.responseText);
                                                                //
                                                                //var r7 = webix.ajax().sync().post(BASE_URL + "Cplanificacoes_prof/read_temas", "idd=" + d);
                                                                $$("id_cb_temnome_planif_prof").getList().clearAll();
                                                                $$("id_cb_temnome_planif_prof").getList().load(BASE_URL + "Cplanificacoes_prof/read_temas?idd=" + d);
                                                            }
                                                        }
                                                    }
                                                },

                                                {
                                                    view: "richselect", width: 370, id: "id_cb_temnome_planif_prof",
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
                                                    view: "button", type: "form", value: "Pesquisar", width: 110, click: function () {
                                                        var d = $$("id_cb_dNome_planif_prof").getValue();
                                                        var tema_id = $$('id_cb_temnome_planif_prof').getValue();

                                                        if (d) {
                                                            $$("idDTplanif_prof").clearAll();
                                                            $$("idDTplanif_prof").load(BASE_URL + "Cplanificacoes_prof/read_x?idd=" + d + "&tema_id=" + tema_id);
                                                        } else
                                                            webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });

                                                    }
                                                },
                                                { view: "label", name: "usuario", id: "id_usuario_planif_prof", width: 110, hidden: true },
                                                { view: "label", name: "usuario nome", id: "usuario_planif_prof", hidden: true },
                                                {}
                                            ]
                                        }
                                    ]

                                }
                            ]


                        },
                    ]

                },
                {
                    view: "form", rows: [
                        {
                            cols: [
                                {
                                    view: "button", type: "form", value: "Adicionar", width: 110, click: function () {
                                        webix.ui({
                                            view: "window",
                                            id: "idwin_planif_prof_add",
                                            width: 1200,
                                            height: 700,
                                            position: "center",
                                            modal: true,
                                            //head: "Pautas Professores",
                                            head: {
                                                view: "toolbar", cols: [
                                                    { view: "label", label: "Adicionar Planificações" },
                                                    {
                                                        view: "button", type: "danger", label: 'X', width: 50, align: 'right', click: function () {//"$$('idwin_Pautas_Professores').close();" }
                                                            $$('idwin_planif_prof_add').close();
                                                            //var redirect = BASE_URL + 'welcome/logout';
                                                            //window.location = redirect;
                                                        }
                                                    }
                                                ]
                                            },
                                            body: webix.copy(form_planif_prof_add)
                                        }).show();
                                    }
                                },
                                {
                                    view: "button", type: "standard", value: "Editar", width: 110, click: function () {
                                        var idSelecionado = $$("idDTplanif_prof").getSelectedId(false, true);
                                        if (idSelecionado) {
                                            webix.ui({
                                                view: "window",
                                                id: "idwin_planif_prof_ed",
                                                width: 1200,
                                                height: 700,
                                                position: "center",
                                                modal: true,
                                                //head: "Pautas Professores",
                                                head: {
                                                    view: "toolbar", cols: [
                                                        { view: "label", label: "Adicionar Planificações" },
                                                        {
                                                            view: "button", type: "danger", label: 'X', width: 50, align: 'right', click: function () {//"$$('idwin_Pautas_Professores').close();" }
                                                                $$('idwin_planif_prof_ed').close();
                                                                //var redirect = BASE_URL + 'welcome/logout';
                                                                //window.location = redirect;
                                                            }
                                                        }
                                                    ]
                                                },
                                                body: webix.copy(form_planif_prof_ed)
                                            }).show();
                                            // cargar datos
                                            var record = $$("idDTplanif_prof").getItem(idSelecionado);
                                            $$('id_text_id').setValue(record.id);
                                            $$('id_cb_temnome_planif_prof_ed').setValue(record.temas_id);
                                            $$('id_cb_tanome_planif_prof_ed').setValue(record.tipo_aulas_id);
                                            $$('id_text_stnome_ed').setValue(record.stnome);
                                            $$('id_text_stobservacao_ed').setValue(record.stobservacao);

                                        } else
                                            webix.message({ type: "error", text: "Deve seleccionar primeiro uma linha." });
                                    }
                                },
                                {
                                    view: "button", type: "danger", value: "Apagar", width: 110, click: function () {
                                        var idSelecionado = $$("idDTplanif_prof").getSelectedId(false, true);
                                        if (idSelecionado) {
                                            var envio = "id=" + idSelecionado;
                                            var r = webix.ajax().sync().post(BASE_URL + "Cplanificacoes_prof/delete_subtema", envio);
                                            if (r.responseText == "true") {
                                                webix.message("Dados actualizados com sucesso");
                                                //actualizar grid si los campos estan seleccionados
                                                var d = $$("id_cb_dNome_planif_prof").getValue();
                                                var tema_id = $$('id_cb_temnome_planif_prof').getValue();
                                                if (d) {
                                                    $$("idDTplanif_prof").clearAll();
                                                    $$("idDTplanif_prof").load(BASE_URL + "Cplanificacoes_prof/read_x?idd=" + d + "&tema_id=" + tema_id);
                                                } else
                                                    webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });
                                            } else {
                                                webix.message({ type: "error", text: "Erro apagando dados" });
                                            }
                                        } else
                                            webix.message({ type: "error", text: "Deve seleccionar primeiro uma linha." });
                                    }
                                },
                                {}
                            ]
                        }
                    ]
                },
                {
                    view: "datatable",
                    id: "idDTplanif_prof",
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
                    pager: "pager_planif_prof"
                }, {
                    view: "pager", id: "pager_planif_prof",
                    template: "{common.prev()} {common.pages()} {common.next()}",
                    size: 25,
                    group: 10
                }
            ]
        },
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

var form_planif_prof_ed = {
    view: "form",
    id: "idform_planif_prof_ed",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'id', hidden: true, id: "id_text_id", name: "id" },
                {
                    view: "richselect", width: 370, id: "id_cb_temnome_planif_prof_ed",
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
                { view: "text", label: 'Aula', id: "id_text_stnome_ed", name: "stnome" },
                {
                    view: "richselect", width: 370, id: "id_cb_tanome_planif_prof_ed",
                    label: 'Tipo Aula', name: "tanome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#tanome#",
                            yCount: 7,
                            url: BASE_URL + "Cplanificacoes_prof/read_tipo_aulas"
                        }
                    },
                },
                { view: "text", label: 'Observação', id: "id_text_stobservacao_ed", name: "stobservacao" },

            ]

        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var id = $$("id_text_id").getValue();
                        var stnome = $$("id_text_stnome_ed").getValue();
                        var stobservacao = $$("id_text_stobservacao_ed").getValue();
                        var temas_id = $$("id_cb_temnome_planif_prof_ed").getValue();
                        var tipo_aulas_id = $$("id_cb_tanome_planif_prof_ed").getValue();

                        if (id && stnome && temas_id && tipo_aulas_id) { //validate form
                            var envio = "id=" + id +
                                "&stnome=" + stnome +
                                "&temas_id=" + temas_id +
                                "&tipo_aulas_id=" + tipo_aulas_id +
                                "&stobservacao=" + stobservacao;
                            var r = webix.ajax().sync().post(BASE_URL + "Cplanificacoes_prof/update_subtema", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados actualizados com sucesso");
                                //actualizar grid si los campos estan seleccionados
                                var d = $$("id_cb_dNome_planif_prof").getValue();
                                var tema_id = $$('id_cb_temnome_planif_prof').getValue();

                                if (d) {
                                    $$("idDTplanif_prof").clearAll();
                                    $$("idDTplanif_prof").load(BASE_URL + "Cplanificacoes_prof/read_x?idd=" + d + "&tema_id=" + tema_id);
                                } else
                                    webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });
                                //
                                $$("idwin_planif_prof_ed").close();
                            } else {
                                webix.message({ type: "error", text: "Erro actualizando dados" });
                            }
                        }
                        else
                            webix.message({ type: "error", text: "Dados incorretos" });
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwin_planif_prof_ed").close();
                    }
                }
            ]
        }
    ],
    rules: {
        "stnome": webix.rules.isNotEmpty
    },
    elementsConfig: {
        labelPosition: "top",
    }
};



var form_planif_prof_add = {
    view: "form",
    id: "idform_planif_prof_add",
    borderless: true,
    elements: [
        {
            rows: [
                //{ view: "text", label: 'id', hidden: true, id: "id_text_ide", name: "id" },
                //{ view: "text", label: 'idd', hidden: true, id: "id_text_idd", name: "idd" },
                {
                    view: "richselect", width: 370, id: "id_cb_temnome_planif_prof_add",
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
                { view: "text", label: 'Aula', id: "id_text_stnome", name: "stnome" },
                {
                    view: "richselect", width: 370, id: "id_cb_tanome_planif_prof_add",
                    label: 'Tipo Aula', name: "tanome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#tanome#",
                            yCount: 7,
                            url: BASE_URL + "Cplanificacoes_prof/read_tipo_aulas"
                        }
                    },
                },
                { view: "text", label: 'Observação', id: "id_text_stobservacao", name: "stobservacao" },

            ]

        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {

                        var stnome = $$("id_text_stnome").getValue();
                        var stobservacao = $$("id_text_stobservacao").getValue();
                        var temas_id = $$("id_cb_temnome_planif_prof_add").getValue();
                        var tipo_aulas_id = $$("id_cb_tanome_planif_prof_add").getValue();

                        if (stnome && temas_id && tipo_aulas_id) { //validate form
                            var envio = "stnome=" + stnome +
                                "&temas_id=" + temas_id +
                                "&tipo_aulas_id=" + tipo_aulas_id +
                                "&stobservacao=" + stobservacao;
                            var r = webix.ajax().sync().post(BASE_URL + "Cplanificacoes_prof/insert_subtema", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                //actualizar grid si los campos estan seleccionados
                                var d = $$("id_cb_dNome_planif_prof").getValue();
                                var tema_id = $$('id_cb_temnome_planif_prof').getValue();

                                if (d) {
                                    $$("idDTplanif_prof").clearAll();
                                    $$("idDTplanif_prof").load(BASE_URL + "Cplanificacoes_prof/read_x?idd=" + d + "&tema_id=" + tema_id);
                                } else
                                    webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });
                                //
                                $$("idwin_planif_prof_add").close();
                            } else {
                                webix.message({ type: "error", text: "Erro actualizando dados" });
                            }
                        }
                        else
                            webix.message({ type: "error", text: "Dados incorretos" });
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwin_planif_prof_add").close();
                    }
                }
            ]
        }
    ],
    rules: {
        "stnome": webix.rules.isNotEmpty
    },
    elementsConfig: {
        labelPosition: "top",
    }
};