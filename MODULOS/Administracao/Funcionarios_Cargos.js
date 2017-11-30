function cargarVistaFuncionarios_Cargos(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Cargos", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDFuncionarios_Cargos",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Cargo",
                                        body: webix.copy(formADDFuncionarios_Cargos)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdFuncionarios_Cargos").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdFuncionarios_Cargos').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                    }
                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdFuncionarios_Cargos").clearAll();
                                    $$("idDTEdFuncionarios_Cargos").load(BASE_URL + "cFuncionarios_Cargos/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdFuncionarios_Cargos",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "carNome", editor: "text", header: ["Nome Cargo", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "carCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" }
                            ],
                            save: BASE_URL + "cFuncionarios_Cargos/crud",
                            url: BASE_URL + "cFuncionarios_Cargos/read",
                            pager: "pagerFuncionarios_Cargos"
                        }, {
                            view: "pager", id: "pagerFuncionarios_Cargos",
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
var formADDFuncionarios_Cargos = {
    view: "form",
    id: "idformADDFuncionarios_Cargos",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "carNome", id: "idtext_carNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "carCodigo", id: "idtext_carCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdFuncionarios_Cargos').add({
                            carNome: $$("idtext_carNome").getValue(),
                            carCodigo: $$("idtext_carCodigo").getValue()
                        });
                        $$("idwinADDFuncionarios_Cargos").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDFuncionarios_Cargos").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};