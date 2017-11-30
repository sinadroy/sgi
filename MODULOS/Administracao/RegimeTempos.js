function cargarVistaRegimeTempos(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Editar Regime", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDRegime",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Dados do Regime",
                                        body: webix.copy(formADDRegime)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdRegime").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdRegime").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cRegime/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdRegime").clearAll();
                                                        $$("idDTEdRegime").load(BASE_URL + "cRegime/read");
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
                                    $$("idDTEdRegime").clearAll();
                                    $$("idDTEdRegime").load(BASE_URL + "cRegime/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdRegime",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "sesNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "sesCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.sesNome && data.sesCodigo) {
                                        var envio = "id=" + id +
                                            "&sesNome=" + data.sesNome +
                                            "&sesCodigo=" + data.sesCodigo;
                                        var r = webix.ajax().sync().post(BASE_URL + "cRegime/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdRegime").clearAll();
                                            $$("idDTEdRegime").load(BASE_URL + "cRegime/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdRegime").clearAll();
                                        $$("idDTEdRegime").load(BASE_URL + "cRegime/read");
                                    }

                                }

                            },
                            url: BASE_URL + "cRegime/read",
                            pager: "pagerRegime"
                        }, {
                            view: "pager", id: "pagerRegime",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            },
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Tempos", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDtemposaulas",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Dados do Curso",
                                        body: webix.copy(formADDtemposaulas)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdtemposaulas").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdtemposaulas").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "ctemposaulas/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdtemposaulas").clearAll();
                                                        $$("idDTEdtemposaulas").load(BASE_URL + "ctemposaulas/read");
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
                                    $$("idDTEdtemposaulas").clearAll();
                                    $$("idDTEdtemposaulas").load(BASE_URL + "ctemposaulas/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdtemposaulas",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "taNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "taHoraInicio", editor: "text", header: "Hora Inicio", width: 110, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "taHoraFim", editor: "text", header: "Hora Fim", width: 100, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "sesNome", editor: "richselect", header: ["Regime",{ content: "textFilter" }], width: 200, template: "#sesNome#", options: BASE_URL + "CRegime/read", sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.taNome && data.taHoraInicio && data.taHoraFim && data.sesNome) {
                                        var idsesNome;
                                        if (isNaN(data.sesNome)) {
                                            var r1 = webix.ajax().sync().post(BASE_URL + "cRegime/GetID", "sesNome=" + data.sesNome);
                                            idsesNome = r1.responseText;
                                        } else
                                            idsesNome = data.sesNome;

                                        var envio = "id=" + id +
                                            "&taNome=" + data.taNome +
                                            "&taHoraInicio=" + data.taHoraInicio +
                                            "&taHoraFim=" + data.taHoraFim +
                                            "&sessao_id=" + idsesNome;
                                        var r = webix.ajax().sync().post(BASE_URL + "ctemposaulas/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdtemposaulas").clearAll();
                                            $$("idDTEdtemposaulas").load(BASE_URL + "ctemposaulas/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdtemposaulas").clearAll();
                                        $$("idDTEdtemposaulas").load(BASE_URL + "ctemposaulas/read");
                                    }

                                }

                            },

                            url: BASE_URL + "ctemposaulas/read",
                            pager: "pagertemposaulas"
                        }, {
                            view: "pager", id: "pagertemposaulas",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Grupos
var formADDRegime = {
    view: "form",
    id: "idformADDRegime",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "sesNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "sesCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var sesnome = $$("idformADDRegime").getValues().sesNome;
                        var sescodigo = $$("idformADDRegime").getValues().sesCodigo;
                        if (sesnome && sescodigo) { //validate form
                            //webix.message({ type:"error", text:"Entro ok" });
                            //if($$("idformADDNiveis").validate()){    
                            var envio = "sesNome=" + sesnome +
                                "&sesCodigo=" + sescodigo;
                            var r = webix.ajax().sync().post(BASE_URL + "cRegime/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdRegime").load(BASE_URL + "cRegime/read");
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
                        $$("idwinADDRegime").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
//ADICIONAR tempos de aulas
var formADDtemposaulas = {
    view: "form",
    id: "idformADDtemposaulas",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "taNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "datepicker", type: "time", format: "%H:%i:%s", label: 'Hora Inicio', name: "taHoraInicio", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "datepicker", type: "time", format: "%H:%i:%s", label: 'Hora Fim', name: "taHoraFim", validate: "isNotEmpty", validateEvent: "blur" },
                {
                    view: "combo", width: 300,
                    label: 'Regime', name: "sesNome",
                    options: {
                        body: {
                            template: "#sesNome#",
                            yCount: 7,
                            url: BASE_URL + "CRegime/read"
                        }
                    }
                },
                {
                    //},{
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var taNome = $$("idformADDtemposaulas").getValues().taNome;
                                var taHoraInicio = $$("idformADDtemposaulas").getValues().taHoraInicio;
                                var taHoraFim = $$("idformADDtemposaulas").getValues().taHoraFim;
                                var sesNome = $$("idformADDtemposaulas").getValues().sesNome;
                                if (taNome && taHoraInicio && taHoraFim && sesNome) { //validate form
                                    var envio = "taNome=" + taNome +
                                        "&taHoraInicio=" + taHoraInicio +
                                        "&taHoraFim=" + taHoraFim +
                                        "&sesNome=" + sesNome;
                                    var r = webix.ajax().sync().post(BASE_URL + "ctemposaulas/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdtemposaulas").load(BASE_URL + "ctemposaulas/read");
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
                                $$("idwinADDtemposaulas").close();
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