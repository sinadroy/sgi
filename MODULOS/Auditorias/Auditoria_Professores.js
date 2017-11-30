function cargarVistaAuditoria_Professores(itemID) {
    //var f = new Date();
    //f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear()
    var i = 0;
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Modulo Professores", body: {
                    rows: [
                        {
                            view: "form", scroll: false,
                            cols: [
                                {
                                    view: "search", label: 'Pesquisar', labelPosition: "left", name: "x", id: "idText_search_audpro", placeholder: "texto a pesquisar...",
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            i = 0;
                                            $$("idDTEdAuditoria_Professores").clearAll();
                                            $$("idDTEdAuditoria_Professores").load(BASE_URL + "CAuditorias_Professores/read_search?i=0&l=25" + "&x=" + this.getValue());
                                        }
                                    }
                                },
                                {
                                    view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                        $$("idDTEdAuditoria_Professores").clearAll();
                                        $$("idDTEdAuditoria_Professores").load(BASE_URL + "CAuditorias_Professores/read?i=0&l=25");
                                    }
                                },
                                {}
                            ]

                        }, {
                            view: "datatable",
                            id: "idDTEdAuditoria_Professores",
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
                                { id: "audDescricao", editor: "text", header: ["Descri&ccedil;&atilde;o", { content: "textFilter" }], width: 900, validate: webix.rules.isNotEmpty(), sort: "string" },
                            ],
                            resizeColumn: true,
                            on: {
                                "onAfterAdd": function (id, data) {
                                    $$("idDTEdAuditoria_Professores").clearAll();
                                    $$("idDTEdAuditoria_Professores").load(BASE_URL + "CAuditorias_Professores/read");
                                },
                                "onAfterUpdate": function (id, data) {
                                    $$("idDTEdAuditoria_Professores").clearAll();
                                    $$("idDTEdAuditoria_Professores").load(BASE_URL + "CAuditorias_Professores/read");
                                }
                            },
                            save: BASE_URL + "CAuditorias_Professores/crud",
                            url: BASE_URL + "CAuditorias_Professores/read?i=0&l=25",
                            //pager: "pagerAuditoria_Professores"
                        }, 
                        {
                            cols: [
                                {
                                    view: "button", type: "standard", value: "<<", width: 120, click: function () {
                                        i = (i > 0) ? i - 25 : 0;
                                        if ($$('idText_search_audpro').getValue()) {
                                            $$("idDTEdAuditoria_Professores").clearAll();
                                            $$("idDTEdAuditoria_Professores").load(BASE_URL + "CAuditorias_Professores/read_search?l=25&i=" + i + "&x=" + $$('idText_search_audpro').getValue());
                                        } else {
                                            $$("idDTEdAuditoria_Professores").clearAll();
                                            $$("idDTEdAuditoria_Professores").load(BASE_URL + "CAuditorias_Professores/read?l=25&i=" + i);
                                        }
                                    }
                                }, {
                                    view: "button", type: "standard", value: ">>", width: 120, click: function () {
                                        i = i + 25;
                                        if ($$('idText_search_audpro').getValue()) {
                                            $$("idDTEdAuditoria_Professores").clearAll();
                                            $$("idDTEdAuditoria_Professores").load(BASE_URL + "CAuditorias_Professores/read_search?l=25&i=" + i + "&x=" + $$('idText_search_audpro').getValue());
                                        } else {
                                            $$("idDTEdAuditoria_Professores").clearAll();
                                            $$("idDTEdAuditoria_Professores").load(BASE_URL + "CAuditorias_Professores/read?l=25&i=" + i);
                                        }
                                    }
                                },
                                {}
                            ]
                        }
                    ]
                }
            }
        ]
    });
}