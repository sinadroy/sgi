function cargarVistaComunicados_Intranet(itemID) {
    //var f = new Date();
    //f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear()

    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Comunicados", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Publicar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDComunicados_Intranet",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Cargo",
                                        body: webix.copy(formADDComunicados_Intranet)
                                    }).show();
                                }
                            }, {
                                view: "button", type: "danger", id: "idbtn_Apagar_Candidato", value: "Apagar", disabled: false, width: 120, height: 50, click: function () {
                                    var idSelecionado = $$('idDTEdComunicados_Intranet').getSelectedId();
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdComunicados_Intranet').remove(idSelecionado);
                                                    //actualizar todas las grid
                                                    $$("idDTEdComunicados_Intranet").clearAll();
                                                    $$("idDTEdComunicados_Intranet").load(BASE_URL + "CComunicados/read");
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                    }

                                }

                            },
                            {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdComunicados_Intranet").clearAll();
                                    $$("idDTEdComunicados_Intranet").load(BASE_URL + "CComunicados/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdComunicados_Intranet",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "comTitulo", editor: "text", header: ["T&iacutetulo", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "comConteudo", editor: "text", header: ["Conteudo", { content: "textFilter" }], width: 620, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "comData", header: ["Data", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "comHora", header: ["hora", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                            ],
                            on: {
                                "onAfterAdd": function (id, data) {
                                    $$("idDTEdComunicados_Intranet").clearAll();
                                    $$("idDTEdComunicados_Intranet").load(BASE_URL + "CComunicados/read");
                                },
                                "onAfterUpdate": function (id, data) {
                                    $$("idDTEdComunicados_Intranet").clearAll();
                                    $$("idDTEdComunicados_Intranet").load(BASE_URL + "CComunicados/read");
                                }
                            },
                            resizeColumn:true,
                            save: BASE_URL + "CComunicados/crud",
                            url: BASE_URL + "CComunicados/read",
                            pager: "pagerComunicados_Intranet"
                        }, {
                            view: "pager", id: "pagerComunicados_Intranet",
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
var formADDComunicados_Intranet = {
    view: "form",
    id: "idformADDComunicados_Intranet",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'T&iacutetulo', name: "comTitulo", id: "idtext_comTitulo", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "textarea", row:5, height: 110, label: 'Conte&uacute;do', name: "comConteudo", id: "idtext_comConteudo", validate: "isNotEmpty", validateEvent: "blur" },
                //{ view: "datepicker", label: "Data", labelPosition: "top", name: "apeiData", id: "idDate_planificacao_data", stringResult: true, width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                //{ view: "datepicker", type: "time", format: "%H:%i:%s", id: "idTime_planificacao_hora", label: 'Hora', labelPosition: "top", name: "apeiHora", width: 120, validate: "isNotEmpty", validateEvent: "blur" },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var f = new Date();
                        $$('idDTEdComunicados_Intranet').add({
                            comTitulo: $$("idtext_comTitulo").getValue(),
                            comConteudo: $$("idtext_comConteudo").getValue(),
                            comData: f.getFullYear() + "/" + (f.getMonth()) + "/" + f.getDate(),
                            comHora: f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds(),
                        });
                        $$("idwinADDComunicados_Intranet").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDComunicados_Intranet").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};