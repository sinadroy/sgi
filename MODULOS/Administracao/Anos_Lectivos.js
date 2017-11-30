function cargarVistaAnos_Lectivos(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Ano Lectivo", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDAnos_Lectivos",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Ano",
                                        body: webix.copy(formADDAnos_Lectivos)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdAnos_Lectivos").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada, se apagar um ano todos os dados deste ano ser&atilde;o eliminados",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdAnos_Lectivos').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um ano" });
                                    }
                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdAnos_Lectivos").clearAll();
                                    $$("idDTEdAnos_Lectivos").load(BASE_URL + "cAnos_Lectivos/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdAnos_Lectivos",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                
                                { id: "alAno", editor: "text", header: ["Ano Lectivo", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                //{ id: "carCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" }
                            ],
                            save: BASE_URL + "cAnos_Lectivos/crud",
                            url: BASE_URL + "CAnos_Lectivos/read",
                            pager: "pagerAnos_Lectivos"
                        }, {
                            view: "pager", id: "pagerAnos_Lectivos",
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
var formADDAnos_Lectivos = {
    view: "form",
    id: "idformADDAnos_Lectivos",
    borderless: true,
    elements: [
        {
            rows: [
                //{ view: "text", label: 'Ano Lectivo', name: "alAno", id: "idtext_alAno", validate: "isNumber", validateEvent: "blur" }
                { view: "counter", label: "Ano Lectivo", name: "alAno", value:2017, id: "idtext_alAno"},
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdAnos_Lectivos').add({
                            alAno: $$("idtext_alAno").getValue()
                        });
                        $$("idwinADDAnos_Lectivos").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDAnos_Lectivos").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};