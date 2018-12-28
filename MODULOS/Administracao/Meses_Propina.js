function cargarVistaMeses_Propina(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Licenciatura / Meses Propina / Multas", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdMeses_Propina").clearAll();
                                    $$("idDTEdMeses_Propina").load(BASE_URL + "Cmeses_propina/read");
                                }
                            },
                            {},
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDMultas",
                                        width: 300,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Dados",
                                        body: webix.copy(formADDMultas)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$('idDTEdMultas_Propina').getSelectedId();
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdMultas_Propina').remove(idSelecionado);
                                                    //actualizar la grid
                                                    $$("idDTEdMultas_Propina").clearAll();
                                                    $$("idDTEdMultas_Propina").load(BASE_URL + "cmultas_propina/read");
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro uma linha" });
                                    }
                                }
                            },
                            {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdMultas_Propina").clearAll();
                                    $$("idDTEdMultas_Propina").load(BASE_URL + "cmultas_propina/read");
                                }
                            },
                        ]

                    }, {
                            cols: [
                                {
                                    rows: [
                                        {
                                            view: "datatable",
                                            //title:"Meses Propina",
                                            id: "idDTEdMeses_Propina",
                                            //autowidth:true,
                                            //autoConfig:true,
                                            select: true,
                                            editable: true,
                                            //editaction:"dblclick",
                                            columns: [
                                                { id: "id", header: "Nº", hidden: false, css: "rank", width: 50, sort: "int" },
                                                { id: "mesEstado", header: "Estado", checkValue: 'on', uncheckValue: 'off', template: "{common.checkbox()}", width: 120 },
                                                { id: "mesNome", header: "Meses", width: 300, sort: "string" },
                                                //{ id: "otCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" }
                                            ],
                                            save: BASE_URL + "Cmeses_propina/crud",
                                            url: BASE_URL + "Cmeses_propina/read",
                                            pager: "pagerMeses_Propina"
                                        }, {
                                            view: "pager", id: "pagerMeses_Propina",
                                            template: "{common.prev()} {common.pages()} {common.next()}",
                                            size: 25,
                                            group: 10
                                        }
                                    ]
                                }, {
                                    rows: [
                                        {
                                            view: "datatable",
                                            //title:"Multa Porcento",
                                            id: "idDTEdMultas_Propina",
                                            //autowidth:true,
                                            //autoConfig:true,
                                            select: true,
                                            editable: true,
                                            //editable:true,
                                            //editaction:"dblclick",
                                            columns: [
                                                { id: "id", header: "Nº", hidden: false, css: "rank", width: 50, sort: "int" },
                                                //{ id: "mp_data_inicio", header: "Data Inicio", checkValue: 'on', uncheckValue: 'off', template: "{common.checkbox()}", width: 120 },
                                                { id: "mesnome", header: ["Meses", { content: "selectFilter" }], width: 100, sort: "string" },
                                                { id: "mp_data_inicio", editor:"date", format:"%Y-%M-%d", header: "Data Inicio", width: 100, sort: "string" },
                                                { id: "mp_data_fin", editor:"date", format:"%Y-%M-%d", header: "Data Fim", width: 100, sort: "string" },
                                                { id: "mp_porciento", editor:"text", header: "Multa %", width: 100, sort: "string" },
                                            ],
                                            save: BASE_URL + "cmultas_propina/crud",
                                            url: BASE_URL + "cmultas_propina/read",
                                            pager: "pagerMultas_Propina"
                                        }, {
                                            view: "pager", id: "pagerMultas_Propina",
                                            template: "{common.prev()} {common.pages()} {common.next()}",
                                            size: 25,
                                            group: 10
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            },
            {
                header: "Mestrado / Meses Propina / Multas", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdMeses_Propina_mestrado").clearAll();
                                    $$("idDTEdMeses_Propina_mestrado").load(BASE_URL + "Cmeses_propina_mestrado/read");
                                }
                            },
                            {},
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDMultas_mestrado",
                                        width: 300,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Dados",
                                        body: webix.copy(formADDMultas_mestrado)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$('idDTEdMultas_Propina_mestrado').getSelectedId();
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdMultas_Propina_mestrado').remove(idSelecionado);
                                                    //actualizar la grid
                                                    $$("idDTEdMultas_Propina_mestrado").clearAll();
                                                    $$("idDTEdMultas_Propina_mestrado").load(BASE_URL + "cmultas_propina_mestrado/read");
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro uma linha" });
                                    }
                                }
                            },
                            {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdMultas_Propina_mestrado").clearAll();
                                    $$("idDTEdMultas_Propina_mestrado").load(BASE_URL + "cmultas_propina_mestrado/read");
                                }
                            },
                        ]

                    }, {
                            cols: [
                                {
                                    rows: [
                                        {
                                            view: "datatable",
                                            //title:"Meses Propina",
                                            id: "idDTEdMeses_Propina_mestrado",
                                            //autowidth:true,
                                            //autoConfig:true,
                                            select: true,
                                            editable: true,
                                            //editaction:"dblclick",
                                            columns: [
                                                { id: "id", header: "Nº", hidden: false, css: "rank", width: 50, sort: "int" },
                                                { id: "mesEstado", header: "Estado", checkValue: 'on', uncheckValue: 'off', template: "{common.checkbox()}", width: 120 },
                                                { id: "mesNome", header: "Meses", width: 300, sort: "string" },
                                                //{ id: "otCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" }
                                            ],
                                            save: BASE_URL + "Cmeses_propina_mestrado/crud",
                                            url: BASE_URL + "Cmeses_propina_mestrado/read",
                                            pager: "pagerMeses_Propina_mestrado"
                                        }, {
                                            view: "pager", id: "pagerMeses_Propina_mestrado",
                                            template: "{common.prev()} {common.pages()} {common.next()}",
                                            size: 25,
                                            group: 10
                                        }
                                    ]
                                }, {
                                    rows: [
                                        {
                                            view: "datatable",
                                            //title:"Multa Porcento",
                                            id: "idDTEdMultas_Propina_mestrado",
                                            //autowidth:true,
                                            //autoConfig:true,
                                            select: true,
                                            editable: true,
                                            //editable:true,
                                            //editaction:"dblclick",
                                            columns: [
                                                { id: "id", header: "Nº", hidden: false, css: "rank", width: 50, sort: "int" },
                                                //{ id: "mp_data_inicio", header: "Data Inicio", checkValue: 'on', uncheckValue: 'off', template: "{common.checkbox()}", width: 120 },
                                                { id: "mesnome", header: ["Meses", { content: "selectFilter" }], width: 100, sort: "string" },
                                                { id: "mp_data_inicio", editor:"date", format:"%Y-%M-%d", header: "Data Inicio", width: 100, sort: "string" },
                                                { id: "mp_data_fin", editor:"date", format:"%Y-%M-%d", header: "Data Fim", width: 100, sort: "string" },
                                                { id: "mp_porciento", editor:"text", header: "Multa %", width: 100, sort: "string" },
                                            ],
                                            save: BASE_URL + "Cmultas_propina_mestrado/crud",
                                            url: BASE_URL + "Cmultas_propina_mestrado/read",
                                            pager: "pagerMultas_Propina_mestrado"
                                        }, {
                                            view: "pager", id: "pagerMultas_Propina_mestrado",
                                            template: "{common.prev()} {common.pages()} {common.next()}",
                                            size: 25,
                                            group: 10
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            }
        ]
    });
}

//Adicionar Multa
var formADDMultas = {
    view: "form",
    id: "idformADDMultas",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "richselect", width: 300,
                    label: 'Mes', name: "mesNome",
                    options: {
                        body: {
                            template: "#mesNome#",
                            yCount: 7,
                            url: BASE_URL + "Cmeses_propina/read"
                        }
                    }
                },
                { view: "datepicker", label: "Data Inicio", name: "dinicio", id: "iddinicio", stringResult: true },
                { view: "datepicker", label: "Data Fim", name: "dfim", id: "iddfim", stringResult: true },

                { view: "counter", label: "Multa Porcento %", name: "mporcento", value: 0, id: "idcounter_mporcento" },
                {
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                //convertir de nome para id os meses
                                var mesNome;
                                if(isNaN($$("idformADDMultas").getValues().mesNome)){
                                    var envio = "mesnome=" + $$("idformADDMultas").getValues().mesNome;
                                    var r = webix.ajax().sync().post(BASE_URL + "cmultas_propina/mreadIdXMes", envio);
                                    mesNome = r.responseText;
                                }else
                                    mesNome = $$("idformADDMultas").getValues().mesNome;

                                var dinicio = $$("idformADDMultas").getValues().dinicio;
                                var dfim = $$("idformADDMultas").getValues().dfim;
                                var mporcento = $$("idformADDMultas").getValues().mporcento ? $$("idformADDMultas").getValues().mporcento : 0;

                                if (mesNome && dinicio && dfim) { //validate form
                                    var envio = "mesnome=" + mesNome +
                                        "&mp_data_inicio=" + dinicio +
                                        "&mp_data_fin=" + dfim +
                                        "&mp_porciento=" + mporcento +
                                        "&webix_operation=insert";
                                    var r = webix.ajax().sync().post(BASE_URL + "cmultas_propina/crud", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdMultas_Propina").load(BASE_URL + "cmultas_propina/read");
                                    } else {
                                        webix.message({ type: "error", text: "Erro inserindo dados" });
                                    }
                                }
                                else
                                    webix.message({ type: "error", text: "Erro validando dados" });
                            }
                        },
                        {
                            view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                $$("idwinADDMultas").close();
                            }
                        }
                    ]
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

//Adicionar Multa
var formADDMultas_mestrado = {
    view: "form",
    id: "idformADDMultas_mestrado",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "richselect", width: 300,
                    label: 'Mes', name: "mesNome",
                    options: {
                        body: {
                            template: "#mesNome#",
                            yCount: 7,
                            url: BASE_URL + "Cmeses_propina_mestrado/read"
                        }
                    }
                },
                { view: "datepicker", label: "Data Inicio", name: "dinicio", id: "iddinicio", stringResult: true },
                { view: "datepicker", label: "Data Fim", name: "dfim", id: "iddfim", stringResult: true },

                { view: "counter", label: "Multa Porcento %", name: "mporcento", value: 0, id: "idcounter_mporcento" },
                {
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                //convertir de nome para id os meses
                                var mesNome;
                                if(isNaN($$("idformADDMultas_mestrado").getValues().mesNome)){
                                    var envio = "mesnome=" + $$("idformADDMultas_mestrado").getValues().mesNome;
                                    var r = webix.ajax().sync().post(BASE_URL + "cmultas_propina_mestrado/mreadIdXMes", envio);
                                    mesNome = r.responseText;
                                }else
                                    mesNome = $$("idformADDMultas_mestrado").getValues().mesNome;

                                var dinicio = $$("idformADDMultas_mestrado").getValues().dinicio;
                                var dfim = $$("idformADDMultas_mestrado").getValues().dfim;
                                var mporcento = $$("idformADDMultas_mestrado").getValues().mporcento ? $$("idformADDMultas_mestrado").getValues().mporcento : 0;

                                if (mesNome && dinicio && dfim) { //validate form
                                    var envio = "mesnome=" + mesNome +
                                        "&mp_data_inicio=" + dinicio +
                                        "&mp_data_fin=" + dfim +
                                        "&mp_porciento=" + mporcento +
                                        "&webix_operation=insert";
                                    var r = webix.ajax().sync().post(BASE_URL + "cmultas_propina_mestrado/crud", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdMultas_Propina_mestrado").load(BASE_URL + "cmultas_propina_mestrado/read");
                                    } else {
                                        webix.message({ type: "error", text: "Erro inserindo dados" });
                                    }
                                }
                                else
                                    webix.message({ type: "error", text: "Erro validando dados" });
                            }
                        },
                        {
                            view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                $$("idwinADDMultas_mestrado").close();
                            }
                        }
                    ]
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};