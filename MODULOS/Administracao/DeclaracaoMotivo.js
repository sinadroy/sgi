function cargarVistaDeclaracaoMotivo(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Motivo", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDDeclaracaoMotivo",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Motivo",
                                        body: webix.copy(formADDDeclaracaoMotivo)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdDeclaracaoMotivo").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdDeclaracaoMotivo').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro uma linha" });
                                    }
                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdDeclaracaoMotivo").clearAll();
                                    $$("idDTEdDeclaracaoMotivo").load(BASE_URL + "CDeclaracaoMotivo/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdDeclaracaoMotivo",
                            select: true,
                            editable: false,
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "mnome", editor: "text", header: ["Motivo", { content: "textFilter" }], width: 400, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "mcodigo", editor: "text", header: ["Código", { content: "textFilter" }], width: 200, validate: webix.rules.isNumber(), sort: "int" }
                            ],
                            save: BASE_URL + "CDeclaracaoMotivo/crud",
                            url: BASE_URL + "CDeclaracaoMotivo/read",
                            pager: "pagerDeclaracaoMotivo"
                        }, {
                            view: "pager", id: "pagerDeclaracaoMotivo",
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
var formADDDeclaracaoMotivo = {
    view: "form",
    id: "idformADDDeclaracaoMotivo",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Motivo', name: "mnome", id: "idtext_mnome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Código', name: "mcodigo", id: "idtext_mcodigo", validate: "isNumber", validateEvent: "key" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdDeclaracaoMotivo').add({
                            mnome: $$("idtext_mnome").getValue(),
                            mcodigo: $$("idtext_mcodigo").getValue()
                        });
                        $$("idwinADDDeclaracaoMotivo").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDDeclaracaoMotivo").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};