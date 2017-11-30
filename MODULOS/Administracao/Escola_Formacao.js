function cargarVistaEscola_Formacao(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Escola", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDEscola_Formacao",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Cargo",
                                        body: webix.copy(formADDEscola_Formacao)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdEscola_Formacao").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdEscola_Formacao').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                    }
                                }

                            }, {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdEscola_Formacao").clearAll();
                                    $$("idDTEdEscola_Formacao").load(BASE_URL + "cEscola_Formacao/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdEscola_Formacao",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "efNome", editor: "text", header: ["Nome Escola", { content: "textFilter" }], width: 350, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "efCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 100, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "efCodigoNome", editor: "text", header: ["C&oacute;d. Nome", { content: "textFilter" }], width: 100, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "hlfNome", editor: "richselect", header: ["Habilita&ccedil;&otilde;es Lit.", { content: "textFilter" }], width: 150, template: "#hlfNome#", options: BASE_URL + "CHabilitacoes_Literarias_Candidatos/read" },
                            ],
                            resizeColumn:true,
                            save: BASE_URL + "cEscola_Formacao/crud",
                            url: BASE_URL + "cEscola_Formacao/read",
                            pager: "pagerEscola_Formacao"
                        }, {
                            view: "pager", id: "pagerEscola_Formacao",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }, {
                header: "Editar Op&ccedil;&atilde;o", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDOpcao",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Op&ccedil;&atilde;o",
                                        body: webix.copy(formADDOpcao)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdOpcao").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdOpcao').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                    }
                                }

                            }, {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdOpcao").clearAll();
                                    $$("idDTEdOpcao").load(BASE_URL + "cOpcao/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdOpcao",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "opcNome", editor: "text", header: ["Nome Op&ccedil;&atilde;o", { content: "textFilter" }], width: 350, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "opcCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 100, validate: webix.rules.isNotEmpty(), sort: "string" },
                                //{ id: "hlfNome", editor: "richselect", header: ["Habilita&ccedil;&otilde;es Lit.", { content: "textFilter" }], width: 150, template: "#hlfNome#", options: BASE_URL + "CHabilitacoes_Literarias_Candidatos/read" },
                            ],
                            resizeColumn:true,
                            save: BASE_URL + "cOpcao/crud",
                            url: BASE_URL + "cOpcao/read",
                            pager: "pagerOpcao"
                        }, {
                            view: "pager", id: "pagerOpcao",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            },{
                header: "Escola/Op&ccedil;&atilde;o", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDEscola_Opcao",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Rela&ccedil;&atilde;o",
                                        body: webix.copy(formADDEscola_Opcao)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdEscola_Opcao").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdEscola_Opcao').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                    }
                                }

                            }, {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdEscola_Opcao").clearAll();
                                    $$("idDTEdEscola_Opcao").load(BASE_URL + "CEscola_Formacao_Opcao/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdEscola_Opcao",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "opcid", hidden:true, header: "", css: "rank", width: 30, sort: "int" },
                                { id: "efid", hidden:true, header: "", css: "rank", width: 30, sort: "int" },
                                //{ id: "efNome", editor: "text", header: ["Nome Escola", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                //{ id: "opcNome", editor: "text", header: ["Nome Op&ccedil;&atilde;o", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "efNome", editor: "richselect", header: ["Nome Escola", { content: "textFilter" }], width: 350, template: "#efNome#", options: BASE_URL + "CEscola_Formacao/read" },
                                { id: "opcNome", editor: "richselect", header: ["Nome Op&ccedil;&atilde;o", { content: "textFilter" }], width: 350, template: "#opcNome#", options: BASE_URL + "COpcao/read" },
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    $$("idDTEdEscola_Opcao").clearAll();
                                    $$("idDTEdEscola_Opcao").load(BASE_URL + "CEscola_Formacao_Opcao/read");
                                }
                            },
                            save: BASE_URL + "CEscola_Formacao_Opcao/crud",
                            url: BASE_URL + "CEscola_Formacao_Opcao/read",
                            pager: "pagerEscola_Opcao"
                        }, {
                            view: "pager", id: "pagerEscola_Opcao",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Cargo
var formADDEscola_Formacao = {
    view: "form",
    id: "idformADDEscola_Formacao",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "efNome", id: "idtext_efNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "efCodigo", id: "idtext_efCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo Nome', name: "efCodigoNome", id: "idtext_efCodigoNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "richselect", label: 'Habilita&ccedil;&atilde;o Literária', name: "hlfNome", id: "idhlfNome", options: { body: { template: "#hlfNome#", yCount: 7, url: BASE_URL + "CHabilitacoes_Literarias_Candidatos/read" } } }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdEscola_Formacao').add({
                            efNome: $$("idtext_efNome").getValue(),
                            efCodigo: $$("idtext_efCodigo").getValue(),
                            efCodigoNome: $$("idtext_efCodigoNome").getValue(),
                            hlfNome: $$("idhlfNome").getValue(),
                        });
                        $$("idDTEdEscola_Formacao").clearAll();
                        $$("idDTEdEscola_Formacao").load(BASE_URL + "cEscola_Formacao/read");
                        $$("idwinADDEscola_Formacao").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDEscola_Formacao").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
var formADDOpcao = {
    view: "form",
    id: "idformADDOpcao",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "opcNome", id: "idtext_opcNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "opcCodigo", id: "idtext_opcCodigo", validate: "isNotEmpty", validateEvent: "blur" },
               // { view: "richselect", label: 'Habilita&ccedil;&atilde;o Literária', name: "hlfNome", id: "idhlfNome", options: { body: { template: "#hlfNome#", yCount: 7, url: BASE_URL + "CHabilitacoes_Literarias_Candidatos/read" } } }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdOpcao').add({
                            opcNome: $$("idtext_opcNome").getValue(),
                            opcCodigo: $$("idtext_opcCodigo").getValue(),
                            //hlfNome: $$("idhlfNome").getValue(),
                        });
                        $$("idDTEdOpcao").clearAll();
                        $$("idDTEdOpcao").load(BASE_URL + "cOpcao/read");
                        $$("idwinADDOpcao").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDOpcao").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
var formADDEscola_Opcao = {
    view: "form",
    id: "idformADDEscola_Opcao",
    borderless: true,
    elements: [
        {
            rows: [
                //{ view: "text", label: 'Nome', name: "efNome", id: "idtext_efNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "richselect", label: 'Escola', name: "efNome", id: "idefNome", options: { body: { template: "#efNome#", yCount: 7, url: BASE_URL + "CEscola_Formacao/read" } } },
                { view: "richselect", label: 'Op&ccedil;&atilde;o', name: "opcNome", id: "idopcNome", options: { body: { template: "#opcNome#", yCount: 7, url: BASE_URL + "COpcao/read" } } }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdEscola_Opcao').add({
                            efNome: $$("idefNome").getValue(),
                            opcNome: $$("idopcNome").getValue(),
                            //hlfNome: $$("idhlfNome").getValue(),
                        });
                        $$("idDTEdEscola_Opcao").clearAll();
                        $$("idDTEdEscola_Opcao").load(BASE_URL + "CEscola_Formacao_Opcao/read");
                        $$("idwinADDEscola_Opcao").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDEscola_Opcao").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};