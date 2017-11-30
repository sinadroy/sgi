function cargarVistaEnderecos(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Paises", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDPaises",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Paises",
                                        body: webix.copy(formADDPaises)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdPaises").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdPaises").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cPaises/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdPaises").clearAll();
                                                        $$("idDTEdPaises").load(BASE_URL + "cPaises/read");
                                                        webix.message("Os dados foram apagados com sucesso");
                                                    } else {
                                                        webix.message({ type: "error", text: "Erro apagando dados" });
                                                    }
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados" });
                                    }

                                }

                            }, {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdPaises").clearAll();
                                    $$("idDTEdPaises").load(BASE_URL + "cPaises/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdPaises",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "",hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 50, sort: "int" },
                                { id: "paNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 350, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "paCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 90, validate: webix.rules.isNotEmpty(), sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.paNome && data.paCodigo) {
                                        var envio = "id=" + id +
                                            "&paNome=" + data.paNome +
                                            "&paCodigo=" + data.paCodigo;
                                        var r = webix.ajax().sync().post(BASE_URL + "cPaises/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdPaises").clearAll();
                                            $$("idDTEdPaises").load(BASE_URL + "cPaises/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdPaises").clearAll();
                                        $$("idDTEdPaises").load(BASE_URL + "cPaises/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cPaises/read",
                            pager: "pagerPaises"
                        }, {
                            view: "pager", id: "pagerPaises",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            }, {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Provincias", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDProvincias",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Provincias",
                                        body: webix.copy(formADDProvincias)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdProvincias").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdProvincias").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cProvincias/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdProvincias").clearAll();
                                                        $$("idDTEdProvincias").load(BASE_URL + "cProvincias/read");
                                                        webix.message("Os dados foram apagados com sucesso");
                                                    } else {
                                                        webix.message({ type: "error", text: "Erro apagando dados" });
                                                    }
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados" });
                                    }

                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdProvincias").clearAll();
                                    $$("idDTEdProvincias").load(BASE_URL + "cProvincias/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdProvincias",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "",hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 50, sort: "int" },
                                { id: "provNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 350, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "artigo", editor: "text", header: ["Artigo", { content: "textFilter" }], width: 90, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "provCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 90, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "provCodigoNome", editor: "text", header: ["C&oacute;d. Nome", { content: "textFilter" }], width: 120, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "paNome", editor: "richselect", header: ["Pa&iacute;s", { content: "textFilter" }], width: 300, template: "#paNome#", options: BASE_URL + "CPaises/read" },
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.provNome && data.artigo && data.provCodigo && data.provCodigoNome) {
                                        var envio = "id=" + id +
                                            "&provNome=" + data.provNome +
                                            "&artigo=" + data.artigo +
                                            "&provCodigo=" + data.provCodigo +
                                            "&provCodigoNome=" + data.provCodigoNome +
                                            "&paNome=" + data.paNome;
                                        var r = webix.ajax().sync().post(BASE_URL + "cProvincias/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdProvincias").clearAll();
                                            $$("idDTEdProvincias").load(BASE_URL + "cProvincias/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdProvincias").clearAll();
                                        $$("idDTEdProvincias").load(BASE_URL + "cProvincias/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cProvincias/read",
                            pager: "pagerProvincias"
                        }, {
                            view: "pager", id: "pagerProvincias",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            }, {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Municipios", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDMunicipios",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Municipios",
                                        body: webix.copy(formADDMunicipios)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdMunicipios").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdMunicipios").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cMunicipios/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdMunicipios").clearAll();
                                                        $$("idDTEdMunicipios").load(BASE_URL + "cMunicipios/read");
                                                        webix.message("Os dados foram apagados com sucesso");
                                                    } else {
                                                        webix.message({ type: "error", text: "Erro apagando dados" });
                                                    }
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados" });
                                    }

                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdMunicipios").clearAll();
                                    $$("idDTEdMunicipios").load(BASE_URL + "cMunicipios/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdMunicipios",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "",hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 50, sort: "int" },
                                { id: "munNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 350, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "munCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 90, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "provNome", editor: "richselect", header: "Provincia", width: 300, template: "#provNome#", options: BASE_URL + "CProvincias/read", sort: "string" },
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.munNome && data.munCodigo) {
                                        var envio = "id=" + id +
                                            "&munNome=" + data.munNome +
                                            "&munCodigo=" + data.munCodigo +
                                            "&Provincias_id=" + data.provNome;
                                        var r = webix.ajax().sync().post(BASE_URL + "cMunicipios/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdMunicipios").clearAll();
                                            $$("idDTEdMunicipios").load(BASE_URL + "cMunicipios/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdMunicipios").clearAll();
                                        $$("idDTEdMunicipios").load(BASE_URL + "cMunicipios/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cMunicipios/read",
                            pager: "pagerMunicipios"
                        }, {
                            view: "pager", id: "pagerMunicipios",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            }, {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Comuna", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDBairros",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Comuna",
                                        body: webix.copy(formADDBairros)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdBairros").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdBairros").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cBairros/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdBairros").clearAll();
                                                        $$("idDTEdBairros").load(BASE_URL + "cBairros/read");
                                                        webix.message("Os dados foram apagados com sucesso");
                                                    } else {
                                                        webix.message({ type: "error", text: "Erro apagando dados" });
                                                    }
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados" });
                                    }

                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdBairros").clearAll();
                                    $$("idDTEdBairros").load(BASE_URL + "cBairros/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdBairros",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "",hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 50, sort: "int" },
                                { id: "baiNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 350, sort: "string" },
                                { id: "baiCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 90, sort: "string" },
                                { id: "munNome", editor: "richselect", header: "Municipio", width: 300, template: "#munNome#", options: BASE_URL + "CMunicipios/read", sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    var idMun;
                                    if (isNaN(data.munNome)) {
                                        var r1 = webix.ajax().sync().post(BASE_URL + "cMunicipios/GetID", "munNome=" + data.munNome);
                                        idMun = r1.responseText;
                                    } else {
                                        idMun = data.munNome;
                                    }
                                    if (id && data.baiNome && data.baiCodigo) {
                                        var envio = "id=" + id +
                                            "&baiNome=" + data.baiNome +
                                            "&baiCodigo=" + data.baiCodigo +
                                            "&Municipios_id=" + idMun;
                                        var r = webix.ajax().sync().post(BASE_URL + "cBairros/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdBairros").clearAll();
                                            $$("idDTEdBairros").load(BASE_URL + "cBairros/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdBairros").clearAll();
                                        $$("idDTEdBairros").load(BASE_URL + "cBairros/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cBairros/read",
                            pager: "pagerBairros"
                        }, {
                            view: "pager", id: "pagerBairros",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Paises
var formADDPaises = {
    view: "form",
    id: "idformADDPaises",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "paNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "paCodigo", validate: "isNotEmpty", validateEvent: "blur" },

                {
                    //},{
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var panome = $$("idformADDPaises").getValues().paNome;
                                var pacodigo = $$("idformADDPaises").getValues().paCodigo;
                                if (panome && pacodigo) { //validate form
                                    var envio = "paNome=" + panome +
                                        "&paCodigo=" + pacodigo;
                                    var r = webix.ajax().sync().post(BASE_URL + "cPaises/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdPaises").load(BASE_URL + "cPaises/read");
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
                                $$("idwinADDPaises").close();
                            }
                        }
                    ]
                }
            ],
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
//Adicionar Provincias
var formADDProvincias = {
    view: "form",
    id: "idformADDProvincias",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "provNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Artigo', name: "artigo", value: 'de', validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "provCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo Nome', name: "provCodigoNome", validate: "isNotEmpty", validateEvent: "blur" },
                {
                    view: "combo", width: 300,
                    label: 'Pa&iacute;s', name: "paNome",
                    value: 1, options: {
                        body: {
                            template: "#paNome#",
                            yCount: 7,
                            url: BASE_URL + "CPaises/read"
                        }
                    }
                },
                {
                    //},{
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var provnome = $$("idformADDProvincias").getValues().provNome;
                                var artigo = $$("idformADDProvincias").getValues().artigo;
                                var provcodigo = $$("idformADDProvincias").getValues().provCodigo;
                                var provCodigoNome = $$("idformADDProvincias").getValues().provCodigoNome
                                var paNome = $$("idformADDProvincias").getValues().paNome;
                                if (provnome && provcodigo && provCodigoNome && paNome) { //validate form
                                    var envio = "provNome=" + provnome + "&artigo=" + artigo +
                                        "&paNome=" + paNome + "&provCodigo=" + provcodigo + "&provCodigoNome=" + provCodigoNome;
                                    var r = webix.ajax().sync().post(BASE_URL + "cProvincias/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdProvincias").load(BASE_URL + "cProvincias/read");
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
                                $$("idwinADDProvincias").close();
                            }
                        }
                    ]
                }
            ],
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
//Adicionar Municipios
var formADDMunicipios = {
    view: "form",
    id: "idformADDMunicipios",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "munNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "munCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                {
                    view: "combo", width: 300,
                    label: 'Provincia', name: "provNome",
                    value: 1, options: {
                        body: {
                            template: "#provNome#",
                            yCount: 7,
                            url: BASE_URL + "CProvincias/read"
                        }
                    }
                },
                {
                    //},{
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var munnome = $$("idformADDMunicipios").getValues().munNome;
                                var muncodigo = $$("idformADDMunicipios").getValues().munCodigo;
                                var provnome = $$("idformADDMunicipios").getValues().provNome;
                                if (munnome && muncodigo) { //validate form
                                    var envio = "munNome=" + munnome +
                                        "&munCodigo=" + muncodigo +
                                        "&Provincias_id=" + provnome;
                                    var r = webix.ajax().sync().post(BASE_URL + "cMunicipios/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdMunicipios").load(BASE_URL + "cMunicipios/read");
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
                                $$("idwinADDMunicipios").close();
                            }
                        }
                    ]
                }
            ],
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
//Adicionar Bairros
var formADDBairros = {
    view: "form",
    id: "idformADDBairros",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "baiNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "baiCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                {
                    view: "combo", width: 300,
                    label: 'Municipio', name: "munNome",
                    options: {
                        body: {
                            template: "#munNome#",
                            yCount: 7,
                            url: BASE_URL + "CMunicipios/read"
                        }
                    }
                },
                {
                    //},{
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var bainome = $$("idformADDBairros").getValues().baiNome;
                                var baicodigo = $$("idformADDBairros").getValues().baiCodigo;
                                var munnome = $$("idformADDBairros").getValues().munNome;
                                if (bainome && baicodigo && munnome) { //validate form
                                    var envio = "baiNome=" + bainome +
                                        "&baiCodigo=" + baicodigo +
                                        "&Municipios_id=" + munnome;
                                    var r = webix.ajax().sync().post(BASE_URL + "cBairros/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdBairros").load(BASE_URL + "cBairros/read");
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
                                $$("idwinADDBairros").close();
                            }
                        }
                    ]
                }
            ],
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};