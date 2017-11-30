function cargarVistaOrganismos_Tutela(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Organismo", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDOrganismos_Tutela",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Cargo",
                                        body: webix.copy(formADDOrganismos_Tutela)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdOrganismos_Tutela").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdOrganismos_Tutela').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                    }
                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdOrganismos_Tutela").clearAll();
                                    $$("idDTEdOrganismos_Tutela").load(BASE_URL + "COrganismos_Tutela/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdOrganismos_Tutela",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "otNome", editor: "text", header: ["Nome Organismo", { content: "textFilter" }], width: 300, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "otCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" }
                            ],
                            save: BASE_URL + "COrganismos_Tutela/crud",
                            url: BASE_URL + "COrganismos_Tutela/read",
                            pager: "pagerOrganismos_Tutela"
                        }, {
                            view: "pager", id: "pagerOrganismos_Tutela",
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
var formADDOrganismos_Tutela = {
    view: "form",
    id: "idformADDOrganismos_Tutela",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "otNome", id: "idtext_otNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "otCodigo", id: "idtext_otCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdOrganismos_Tutela').add({
                            otNome: $$("idtext_otNome").getValue(),
                            otCodigo: $$("idtext_otCodigo").getValue()
                        });
                        $$("idwinADDOrganismos_Tutela").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDOrganismos_Tutela").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};