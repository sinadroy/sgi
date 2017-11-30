function cargarVistaNecessita_Educacao_Especial(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Educa&ccedil;&atilde;o Especial", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDNecessita_Educacao_Especial",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Educa&ccedil;&atilde;o Especial",
                                        body: webix.copy(formADDNecessita_Educacao_Especial)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdNecessita_Educacao_Especial").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdNecessita_Educacao_Especial').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                    }
                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdNecessita_Educacao_Especial").clearAll();
                                    $$("idDTEdNecessita_Educacao_Especial").load(BASE_URL + "CNecessita_Educacao_Especial/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdNecessita_Educacao_Especial",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "neeNome", editor: "text", header: ["Necessidade Educa&ccedil;&atilde;o Especial", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "neeCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" }
                            ],
                            save: BASE_URL + "CNecessita_Educacao_Especial/crud",
                            url: BASE_URL + "CNecessita_Educacao_Especial/read",
                            pager: "pagerNecessita_Educacao_Especial"
                        }, {
                            view: "pager", id: "pagerNecessita_Educacao_Especial",
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
var formADDNecessita_Educacao_Especial = {
    view: "form",
    id: "idformADDNecessita_Educacao_Especial",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "neeNome", id: "idtext_neeNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "neeCodigo", id: "idtext_neeCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdNecessita_Educacao_Especial').add({
                            neeNome: $$("idtext_neeNome").getValue(),
                            neeCodigo: $$("idtext_neeCodigo").getValue()
                        });
                        $$("idwinADDNecessita_Educacao_Especial").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDNecessita_Educacao_Especial").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};