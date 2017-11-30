var formLogin_planif_dpto = {
    view: "form",
    id: "idformLogin_planif_dpto",
    borderless: true,
    elements: [
        { view: "text", label: 'Usu&aacute;rio', name: "login" },
        { view: "text", label: 'Senha', name: "senha", type: "password" },
        {
            view: "button", value: "Entrar", /*hotkey: "enter",*/ click: function () {
                if (this.getParentView().validate()) { //validate form
                    var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/validar", "action=login&login=" + $$("idformLogin_planif_dpto").getValues().login + "&senha=" + $$("idformLogin_planif_dpto").getValues().senha);
                    if (r.responseText == "true") {
                        this.getTopParentView().hide(); //hide window
                        var r2 = webix.ajax().sync().post(BASE_URL + "Cchefes_departamentos_utilizadores/dt_se_chefe_departamento", "login=" + $$("idformLogin_planif_dpto").getValues().login);
                        if (r2.responseText == "true") {
                            webix.message("A carregar programas...");
                            //cargar windows com combo pa seleccionar disciplina y Pautas
                            webix.ui({
                                view: "window",
                                id: "idwin_planif_dpto",
                                width: 1200,
                                height: 600,
                                position: "center",
                                modal: true,
                                //head: "Pautas Professores",
                                head: {
                                    view: "toolbar", cols: [
                                        { view: "label", label: "Planificação Departamento" },
                                        {
                                            view: "button", type: "danger", label: 'X', width: 50, align: 'right', click: function () {//"$$('idwin_Pautas_Professores').close();" }
                                                $$('idwin_planif_dpto').close();
                                                var redirect = BASE_URL + 'welcome/logout';
                                                window.location = redirect;
                                            }
                                        }
                                    ]
                                },
                                body: webix.copy(form_planif_dpto)
                            }).show();
                            //cargar datos
                            $user = $$("idformLogin_planif_dpto").getValues().login;
                            $$("idDTdpto_planif").clearAll();
                            $$("idDTdpto_planif").load(BASE_URL + "cplanificacoes/read_x_chefe?chefe=" + $user);

                            $$("idtext_user1").setValue($user);

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
                $$("idformLogin_planif_dpto").clear();
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
    id: "winLogin_planif_dpto",
    width: 300,
    position: "center",
    modal: false,
    head: "Dados de Usu&aacute;rio",
    //body:webix.copy(form)
    body: formLogin_planif_dpto
});

var form_planif_dpto = {
    view: "form",
    id: "idform_planif_dpto",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "form", rows: [
                        {
                            cols: [
                                { view: "text", label: '', name: "user", id: "idtext_user1", hidden: true },
                                {
                                    view: "button", type: "danger", value: "Editar", width: 100, click: function () {
                                        var idSelecionado = $$("idDTdpto_planif").getSelectedId(false, true);
                                        if (idSelecionado) {
                                            webix.ui({
                                                view: "window",
                                                id: "id_win_edresposta",
                                                width: 300,
                                                position: "center",
                                                modal: true,
                                                head: "Editar Planiificação",
                                                body: webix.copy(form_editar_planif_dpto)
                                            }).show();
                                            //cargar el id
                                            $$("idtext_id").setValue(idSelecionado);
                                            var record = $$("idDTdpto_planif").getItem(idSelecionado);
                                            $$('idtext_presposta').setValue(record.presposta);
                                            $$('idtext_user2').setValue($$("idtext_user1").getValue());
                                        } else {
                                            webix.message({ type: "error", text: "Deve selecionar primeriro uma linha" });
                                        }
                                    }
                                },
                                {
                                    view: "button", type: "standard", value: "Actualizar", width: 110, click: function () {
                                        $$("idDTdpto_planif").clearAll();
                                        $$("idDTdpto_planif").load(BASE_URL + "cplanificacoes/read_x_chefe?chefe=" + $$("idformLogin_planif_dpto").getValues().login);
                                    }
                                },
                                {}
                            ]
                        }
                    ]
                },
                {
                    view: "datatable",
                    id: "idDTdpto_planif",
                    select: "row", /*editable: true, editaction: "click",*/
                    editable: false,
                    columns: [
                        { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                        { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                        { id: "pactividade", header: ["Actividade", { content: "textFilter" }], width: 200, sort: "string" },
                        { id: "psupervisor", header: ["Supervisor", { content: "textFilter" }], width: 200, sort: "string" },
                        { id: "pdatainicio", header: ["inicio", { content: "textFilter" }], width: 80, sort: "string" },
                        { id: "pdatafim", header: ["Fim", { content: "textFilter" }], width: 80, sort: "string" },
                        { id: "pdescricao", header: ["Descrição", { content: "textFilter" }], width: 500, sort: "string" },
                        { id: "presposta", header: ["Resposta", { content: "textFilter" }], width: 300, sort: "string" },
                        { id: "pestado", header: ["Estado", { content: "textFilter" }], width: 80, sort: "string" },
                    ],
                    resizeColumn: true,
                    //url: BASE_URL + "cplanificacoes/read_x_chefe?chefe=",
                    pager: "pager_planif_dpto"
                }, {
                    view: "pager", id: "pager_planif_dpto",
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


var form_editar_planif_dpto = {
    view: "form",
    id: "idform_editar_planif_dpto",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: '', name: "id", id: "idtext_id", hidden: true },
                { view: "text", label: '', name: "user", id: "idtext_user2", hidden: true },
                { view: "text", label: 'Resposta', name: "presposta", id: "idtext_presposta", validate: "isNotEmpty", validateEvent: "blur" },
                //{ view: "text", label: 'Código', name: "mcodigo", id: "idtext_mcodigo", validate: "isNumber", validateEvent: "key" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTdpto_planif').add({
                            id: $$("idtext_id").getValue(),
                            presposta: $$("idtext_presposta").getValue()
                        });
                        var envio = "id=" + $$("idtext_id").getValue() +
                            "&presposta=" + $$("idtext_presposta").getValue() +
                            "&webix_operation=update";
                        var r = webix.ajax().sync().post(BASE_URL + "cplanificacoes/crud", envio);
                        if (r.responseText == "true") {
                            webix.message("Dados actualizados com sucesso");
                            //actualizar grid
                            $$("idDTdpto_planif").clearAll();
                            $$("idDTdpto_planif").load(BASE_URL + "cplanificacoes/read_x_chefe?chefe=" + $$("idtext_user2").getValue());
                            //
                            $$("id_win_edresposta").close();
                        } else {
                            webix.message({ type: "error", text: "Erro inserindo dados" });
                        }
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("id_win_edresposta").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};