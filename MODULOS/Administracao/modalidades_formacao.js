function cargarVista_modalidade_formacao(itemID) {
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
                                        id: "idwinADDmodalidade_formacao",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Tipo Aula",
                                        body: webix.copy(formADDmodalidade_formacao)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdmodalidade_formacao").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdmodalidade_formacao').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro uma linha" });
                                    }
                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdmodalidade_formacao").clearAll();
                                    $$("idDTEdmodalidade_formacao").load(BASE_URL + "CModalidades_Formacao/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdmodalidade_formacao",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "mfNome", editor: "text", header: ["Modalidade", { content: "textFilter" }], width: 400, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "mfCodigo", editor: "text", header: ["Código", { content: "textFilter" }], width: 200, validate: webix.rules.isNumber(), sort: "int" }
                            ],
                            save: BASE_URL + "CModalidades_Formacao/crud",
                            url: BASE_URL + "CModalidades_Formacao/read",
                            pager: "pagermf"
                        }, {
                            view: "pager", id: "pagermf",
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
var formADDmodalidade_formacao = {
    view: "form",
    id: "idformADDmodalidade_formacao",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Modalidade', name: "mfNome", id: "idtext_mfNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Código', name: "mfCodigo", id: "idtext_mfCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdmodalidade_formacao').add({
                            mfNome: $$("idtext_mfNome").getValue(),
                            mfCodigo: $$("idtext_mfCodigo").getValue()
                        });
                        $$("idwinADDmodalidade_formacao").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDmodalidade_formacao").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};