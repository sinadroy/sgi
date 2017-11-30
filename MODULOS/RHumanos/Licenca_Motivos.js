function cargarVistaLicenca_Motivos(itemID) {
    //var f = new Date();
    //f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear()
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Listar Motivos", body: {
                    rows: [
                        {
                            view: "form", scroll: false,
                            cols: [
                                {
                                    view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                        $$("idDTEdLicenca_Motivos").clearAll();
                                        $$("idDTEdLicenca_Motivos").load(BASE_URL + "CLicencas_Motivos/read");
                                    }
                                },
                                {}
                            ]

                        }, {
                            view: "datatable",
                            id: "idDTEdLicenca_Motivos",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            //editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: 
                            [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "lmNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 350, sort: "string" },
                                { id: "lmCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 90, sort: "string" },
                            ],
                            on: {
                                "onAfterAdd": function (id, data) {
                                    $$("idDTEdLicenca_Motivos").clearAll();
                                    $$("idDTEdLicenca_Motivos").load(BASE_URL + "CLicencas_Motivos/read");
                                },
                                "onAfterUpdate": function (id, data) {
                                    $$("idDTEdLicenca_Motivos").clearAll();
                                    $$("idDTEdLicenca_Motivos").load(BASE_URL + "CLicencas_Motivos/read");
                                }
                            },
                            save: BASE_URL + "CLicencas_Motivos/crud",
                            url: BASE_URL + "CLicencas_Motivos/read",
                            pager: "pagerLicenca_Motivos"
                        }, {
                            view: "pager", id: "pagerLicenca_Motivos",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}