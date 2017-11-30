function cargarVistaFinancas_Bancos(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Bancos", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDFinancas_Bancos",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Banco",
                                        body: webix.copy(formADDFinancas_Bancos)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdFinancas_Bancos").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdFinancas_Bancos').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                    }
                                }

                            }, {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdFinancas_Bancos").clearAll();
                                    $$("idDTEdFinancas_Bancos").load(BASE_URL + "CFinancas_Bancos/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdFinancas_Bancos",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "bancNome", editor: "text", header: ["Nome Banco", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "bancCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "bancDescricao", editor: "text", header: ["Descri&ccedil;&atilde;o", { content: "textFilter" }], width: 300, validate: webix.rules.isNotEmpty(), sort: "string" },
                            ],
                            on: {
                                "onAfterAdd": function (id, data) {
                                    $$("idDTEdFinancas_Bancos").clearAll();
                                    $$("idDTEdFinancas_Bancos").load(BASE_URL + "CFinancas_Bancos/read");
                                },
                                "onAfterUpdate": function (id, data) {
                                    $$("idDTEdFinancas_Bancos").clearAll();
                                    $$("idDTEdFinancas_Bancos").load(BASE_URL + "CFinancas_Bancos/read");
                                }
                            },
                            save: BASE_URL + "CFinancas_Bancos/crud",
                            url: BASE_URL + "CFinancas_Bancos/read",
                            pager: "pagerFinancas_Bancos"
                        }, {
                            view: "pager", id: "pagerFinancas_Bancos",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }, {
                header: "Editar Contas", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDFinancas_Contas",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Conta",
                                        body: webix.copy(formADDFinancas_Contas)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdFinancas_Contas").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdFinancas_Contas').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                    }
                                }

                            }, {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdFinancas_Contas").clearAll();
                                    $$("idDTEdFinancas_Contas").load(BASE_URL + "CFinancas_Contas/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdFinancas_Contas",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "contNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "contNumero", editor: "text", header: ["Numero", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "contNatureza", editor: "text", header: ["Natureza", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "contDescricao", editor: "text", header: ["Descri&ccedil;&atilde;o", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "bancNome", editor: "richselect", header: ["Banco", { content: "textFilter" }], width: 150, template: "#bancNome#", options: BASE_URL + "CFinancas_Bancos/read" },
                            ],
                            on: {
                                "onAfterAdd": function (id, data) {
                                    $$("idDTEdFinancas_Contas").clearAll();
                                    $$("idDTEdFinancas_Contas").load(BASE_URL + "CFinancas_Contas/read");
                                },
                                "onAfterUpdate": function (id, data) {
                                    $$("idDTEdFinancas_Contas").clearAll();
                                    $$("idDTEdFinancas_Contas").load(BASE_URL + "CFinancas_Contas/read");
                                }//onDataUpdate
                            },
                            save: BASE_URL + "CFinancas_Contas/crud",
                            url: BASE_URL + "CFinancas_Contas/read",
                            pager: "pagerFinancas_Contas"
                        }, {
                            view: "pager", id: "pagerFinancas_Contas",
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
var formADDFinancas_Bancos = {
    view: "form",
    id: "idformADDFinancas_Bancos",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "bancNome", id: "idtext_bancNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "bancCodigo", id: "idtext_bancCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                //bancDescricao
                { view: "text", label: 'Descri&ccedil;&atilde;o', name: "bancDescricao", id: "idtext_bancDescricao" },
                //{ view: "richselect", label: 'Habilita&ccedil;&atilde;o Literária', name: "hlfNome", id: "idhlfNome", options: { body: { template: "#hlfNome#", yCount: 7, url: BASE_URL + "CHabilitacoes_Literarias_Candidatos/read" } } }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdFinancas_Bancos').add({
                            bancNome: $$("idtext_bancNome").getValue(),
                            bancCodigo: $$("idtext_bancCodigo").getValue(),
                            bancDescricao: $$("idtext_bancDescricao").getValue(),
                        });
                        $$("idDTEdFinancas_Bancos").clearAll();
                        $$("idDTEdFinancas_Bancos").load(BASE_URL + "CFinancas_Bancos/read");
                        $$("idwinADDFinancas_Bancos").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDFinancas_Bancos").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
var formADDFinancas_Contas = {
    view: "form",
    id: "idformADDFinancas_Contas",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "contNome", id: "idtext_contNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Numero', name: "contNumero", id: "idtext_contNumero", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Natureza', name: "contNatureza", id: "idtext_contNatureza", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Descri&ccedil;&atilde;o', name: "contDescricao", id: "idtext_contDescricao" },
                { view: "richselect", label: 'Banco', name: "bancNome", id: "idbancNome", options: { body: { template: "#bancNome#", yCount: 7, url: BASE_URL + "CFinancas_Bancos/read" } } }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdFinancas_Contas').add({
                            contNome: $$("idtext_contNome").getValue(),
                            contNumero: $$("idtext_contNumero").getValue(),
                            contNatureza: $$("idtext_contNatureza").getValue(),
                            contDescricao: $$("idtext_contDescricao").getValue(),
                            bancNome: $$("idbancNome").getValue(),
                        });
                        $$("idDTEdFinancas_Contas").clearAll();
                        $$("idDTEdFinancas_Contas").load(BASE_URL + "cFinancas_Contas/read");
                        $$("idwinADDFinancas_Contas").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDFinancas_Contas").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};