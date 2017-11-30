function cargarVistaAuditoria_Academica(itemID) {
    //var f = new Date();
    //f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear()

    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Modulo Acad&ecirc;mico", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdAuditoria_Academica").clearAll();
                                    $$("idDTEdAuditoria_Academica").load(BASE_URL + "CAuditorias_Academicas/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdAuditoria_Academica",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            //editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "audOperacao", editor: "text", header: ["Opera&ccedil;&atilde;o", { content: "textFilter" }], width: 250, validate: webix.rules.isNotEmpty(), sort: "string" },
                                //{ id: "audModulo", editor: "text", header: ["Modulo", { content: "selectFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "audSubModulo", editor: "text", header: ["Sub-Modulo", { content: "selectFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "audUsuario", editor: "text", header: ["Usu&aacute;rio", { content: "textFilter" }], width: 150, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "audData", header: ["Data", { content: "textFilter" }], width: 90, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "audHora", header: ["hora", { content: "textFilter" }], width: 80, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "audDescricao", editor: "text", header: ["Descri&ccedil;&atilde;o", { content: "textFilter" }], width: 600, validate: webix.rules.isNotEmpty(), sort: "string" },
                            ],
                            on:{
                                "onAfterAdd": function (id, data) {
                                    $$("idDTEdAuditoria_Academica").clearAll();
                                    $$("idDTEdAuditoria_Academica").load(BASE_URL + "CAuditorias_Academicas/read");
                                },
                                "onAfterUpdate": function (id, data) {
                                    $$("idDTEdAuditoria_Academica").clearAll();
                                    $$("idDTEdAuditoria_Academica").load(BASE_URL + "CAuditorias_Academicas/read");
                                }
                            },
                            save: BASE_URL + "CAuditorias_Academicas/crud",
                            url: BASE_URL + "CAuditorias_Academicas/read",
                            pager: "pagerAuditoria_Academica"
                        }, {
                            view: "pager", id: "pagerAuditoria_Academica",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}