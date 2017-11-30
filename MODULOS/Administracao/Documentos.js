function cargarVistaDocumentos(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Documentos", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDDocumentos",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Cargo",
                                        body: webix.copy(formADDDocumentos)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", disabled:true, width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdDocumentos").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdDocumentos').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um documento" });
                                    }
                                }

                            }
                            ,{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdDocumentos").clearAll();
                                    $$("idDTEdDocumentos").load(BASE_URL + "Cdocumentos/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdDocumentos",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "tdnome", editor: "text", header: ["Nome Documento", { content: "textFilter" }], width: 400, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "tdvalor", editor: "text", header: ["Valor", { content: "textFilter" }], width: 200, validate: webix.rules.isNumber(), sort: "int" }
                            ],
                            save: BASE_URL + "Cdocumentos/crud",
                            url: BASE_URL + "Cdocumentos/read",
                            pager: "pagerDocumentos"
                        }, {
                            view: "pager", id: "pagerDocumentos",
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
var formADDDocumentos = {
    view: "form",
    id: "idformADDDocumentos",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome Documento', name: "tdnome", id: "idtext_tdnome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Valor', name: "tdvalor", id: "idtext_tdvalor", validate: "isNumber", validateEvent: "key" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdDocumentos').add({
                            tdnome: $$("idtext_tdnome").getValue(),
                            tdvalor: $$("idtext_tdvalor").getValue()
                        });
                        $$("idwinADDDocumentos").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDDocumentos").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};