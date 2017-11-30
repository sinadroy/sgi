function cargarVistaBase_Dados(itemID) {
    var f = new Date();
    //f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear()

    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Hist&oacute;rico de Backups", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Backup", width: 100, click: function () {
                                    $$('idDTEdBase_Dados').add({
                                        bNome: "db-backup_" + f.getDate() + "-" + (f.getMonth()) + "-" + f.getFullYear() + "_" + f.getHours() + f.getMinutes() + f.getSeconds(),
                                        data: f.getFullYear() + "-" + (f.getMonth()) + "-" + f.getDate(),
                                        hora: f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds(),
                                    });
                                    var nome_arquivo = "db-backup_" + f.getDate() + "-" + (f.getMonth()) + "-" + f.getFullYear() + "_" + f.getHours() + f.getMinutes() + f.getSeconds();
                                    //var r = webix.ajax().sync().post(BASE_URL + "CBackup/backup", envio);
                                    webix.send(BASE_URL + "CBackup/backup",{bNome:nome_arquivo}, "POST");
                                    //webix.send(BASE_URL + "CExportar_Dados_Excel/Dados_Inscricao", null, "GET");
                                    //Actualizar
                                    $$("idDTEdBase_Dados").clearAll();
                                    $$("idDTEdBase_Dados").load(BASE_URL + "CBackup/read");
                                }
                            },
                            {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdBase_Dados").clearAll();
                                    $$("idDTEdBase_Dados").load(BASE_URL + "CBackup/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdBase_Dados",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: false,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "bNome", header: ["Nome Arquivo", { content: "textFilter" }], width: 350, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "data", header: ["Data", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "hora", header: ["hora", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                            ],
                            save: BASE_URL + "CBackup/crud",
                            url: BASE_URL + "CBackup/read",
                            pager: "pagerBase_Dados"
                        }, {
                            view: "pager", id: "pagerBase_Dados",
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