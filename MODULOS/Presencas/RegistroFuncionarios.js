function cargarVistaRegistroFuncionarios(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Controle de Ponto", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        cols: [
                            {
                                view: "button", type: "standard", value: "Actualizar", width: 170, click: function () {
                                    $$('idDTEdRegistroFuncionarios').load(BASE_URL + "cRegistro_Funcionarios/read");
                                }
                            },
                            {}
                        ]
                    },
                        {
                            view: "datatable",
                            id: "idDTEdRegistroFuncionarios",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: false,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", css: "rank", width: 30, sort: "int" },
                                { id: "fNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "fApelido", editor: "text", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "fBI_Passaporte", editor: "text", header: ["BI/Passaporte", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "rfData", editor: "text", header: ["Data", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "rfEntrada", editor: "text", header: ["Entrada", { content: "textFilter" }], width: 70, sort: "string" },
                                { id: "rfEstado_Entrada", editor: "text", header: ["Estado Entrada", { content: "selectFilter" }], width: 170, sort: "string" },
                                { id: "rfSaida", editor: "text", header: ["Sa&iacute;da", { content: "textFilter" }], width: 70, sort: "string" },
                                { id: "rfEstado_Saida", editor: "text", header: ["Estado Sa&iacute;da", { content: "selectFilter" }], width: 170, sort: "string" },
                            ],
                            url: BASE_URL + "cRegistro_Funcionarios/read",
                            pager: "pagerRegistroFuncionarios"
                        }, {
                            view: "pager", id: "pagerRegistroFuncionarios",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            },
        ]
    });
}