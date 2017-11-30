function cargarVistatipo_aulas(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Tipo Aulas", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDTipoAulas",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Tipo Aula",
                                        body: webix.copy(formADDTipoAulas)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdTipoAulas").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdTipoAulas').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro uma linha" });
                                    }
                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdTipoAulas").clearAll();
                                    $$("idDTEdTipoAulas").load(BASE_URL + "Ctipo_aulas/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdTipoAulas",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "tanome", editor: "text", header: ["Tipo Aula", { content: "textFilter" }], width: 400, validate: webix.rules.isNotEmpty(), sort: "string" },
                                //{ id: "mcodigo", editor: "text", header: ["Código", { content: "textFilter" }], width: 200, validate: webix.rules.isNumber(), sort: "int" }
                            ],
                            save: BASE_URL + "Ctipo_aulas/crud",
                            url: BASE_URL + "Ctipo_aulas/read",
                            pager: "pagerta"
                        }, {
                            view: "pager", id: "pagerta",
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
var formADDTipoAulas = {
    view: "form",
    id: "idformADDTipoAulas",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Tipo Aula', name: "tanome", id: "idtext_tanome", validate: "isNotEmpty", validateEvent: "blur" },
                //{ view: "text", label: 'Código', name: "mcodigo", id: "idtext_mcodigo", validate: "isNumber", validateEvent: "key" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdTipoAulas').add({
                            tanome: $$("idtext_tanome").getValue()
                        });
                        $$("idwinADDTipoAulas").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDTipoAulas").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};