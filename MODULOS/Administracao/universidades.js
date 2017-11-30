function cargarVistaUniversidades(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Universidades", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDUniversidades",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Tipo Aula",
                                        body: webix.copy(formADDUniversidades)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdUniversidades").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdUniversidades').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro uma linha" });
                                    }
                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdUniversidades").clearAll();
                                    $$("idDTEdUniversidades").load(BASE_URL + "cuniversidades/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdUniversidades",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "univNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 400, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "univCodigo", editor: "text", header: ["Código", { content: "textFilter" }], width: 200, validate: webix.rules.isNumber(), sort: "int" },
                                { id: "paNome", editor: "richselect", header: ["País", { content: "textFilter" }], width: 200, template: "#paNome#", options: BASE_URL + "cpaises/read", sort: "string" }
                            ],
                            /*on: {
                                "onChange": function (newv, oldv) {
                                    $$("idDTEdUniversidades").clearAll();
                                    $$("idDTEdUniversidades").load(BASE_URL + "cuniversidades/read");
                                }
                            },*/
                            save: BASE_URL + "cuniversidades/crud",
                            url: BASE_URL + "cuniversidades/read",
                            pager: "pageruniv"
                        }, {
                            view: "pager", id: "pageruniv",
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
var formADDUniversidades = {
    view: "form",
    id: "idformADDUniversidades",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "univNome", id: "idtext_univNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Código', name: "univCodigo", id: "idtext_univCodigo", validate: "isNumber", validateEvent: "key" },
                {
                    view: "combo", width: 300, id:"idcb_panome_fadd",
                    label: 'Pa&iacute;s', name: "paNome",
                    value: 1, options: {
                        body: {
                            template: "#paNome#",
                            yCount: 7,
                            url: BASE_URL + "CPaises/read"
                        }
                    }
                },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdUniversidades').add({
                            univNome: $$("idtext_univNome").getValue(),
                            univCodigo: $$("idtext_univCodigo").getValue(),
                            paNome: $$("idcb_panome_fadd").getValue()
                        });
                        $$("idwinADDUniversidades").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDUniversidades").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};