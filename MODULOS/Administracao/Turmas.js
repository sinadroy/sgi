function cargarVistaTurmas(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Turmas", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDTurmas",
                                        width: 630,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Dados",
                                        body: webix.copy(formADDTurmas)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdTurmas").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdTurmas").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cTurmas/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdTurmas").clearAll();
                                                        $$("idDTEdTurmas").load(BASE_URL + "cTurmas/read");
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
                                    $$("idDTEdTurmas").clearAll();
                                    $$("idDTEdTurmas").load(BASE_URL + "cTurmas/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdTurmas",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "nNome", editor: "richselect", header: "N&iacute;vel", width: 150, template: "#nNome#", options: BASE_URL + "CNiveis/read", sort: "string" },
                                { id: "cNome", editor: "richselect", header: "Curso", width: 300, template: "#cNome#", options: BASE_URL + "CCursos/read", sort: "string" },
                                { id: "acNome", editor: "richselect", header: "Ano Curricular", width: 130, template: "#acNome#", options: BASE_URL + "CAno_Curricular/read", sort: "string" },
                                { id: "pNome", editor: "richselect", header: "Per&iacute;odo", width: 150, template: "#pNome#", options: BASE_URL + "CPeriodos/read", sort: "string" },
                                { id: "sesNome", editor: "richselect", header: "Sess&atilde;o", width: 150, template: "#sesNome#", options: BASE_URL + "CSessao/read", sort: "string" },
                                { id: "tNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "tCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                {
                                    id: "tCapacidade", editor: "text", header: "Capacidade", width: 80, sort: "int", format: webix.Number.numToStr({
                                        //groupDelimiter: ",",
                                        groupSize: 3,
                                        //decimalDelimiter: ",",
                                        intSize: 3
                                    })
                                },
                                { id: "tDescricao", editor: "text", header: "Descri&ccedil;&atilde;o", width: 300, validate: webix.rules.isNotEmpty(), sort: "string" },

                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.nNome && data.cNome && data.acNome && data.pNome && data.sesNome && data.tNome && data.tCodigo && data.tCapacidade) {
                                        var idn;
                                        if (isNaN(data.nNome)) {
                                            var rn = webix.ajax().sync().post(BASE_URL + "cNiveis/GetID", "nNome=" + data.nNome);
                                            idn = rn.responseText;
                                        } else
                                            idn = data.nNome;

                                        var idc;
                                        if (isNaN(data.cNome)) {
                                            var rc = webix.ajax().sync().post(BASE_URL + "cCursos/GetID", "cNome=" + data.cNome);
                                            idc = rc.responseText;
                                        } else
                                            idc = data.cNome;

                                        var idac;
                                        if (isNaN(data.acNome)) {
                                            var rac = webix.ajax().sync().post(BASE_URL + "cAno_Curricular/GetID", "acNome=" + data.acNome);
                                            idac = rac.responseText;
                                        } else
                                            idac = data.acNome;

                                        var idp;
                                        if (isNaN(data.pNome)) {
                                            var rp = webix.ajax().sync().post(BASE_URL + "CPeriodos/GetID", "pNome=" + data.pNome);
                                            idp = rp.responseText;
                                        } else
                                            idp = data.pNome;

                                        var idses;
                                        if (isNaN(data.sesNome)) {
                                            var rses = webix.ajax().sync().post(BASE_URL + "cSessao/GetID", "sesNome=" + data.sesNome);
                                            idses = rses.responseText;
                                        } else
                                            idses = data.sesNome;

                                        var envio = "id=" + id +
                                            "&nNome=" + idn +
                                            "&cNome=" + idc +
                                            "&acNome=" + idac +
                                            "&sesNome=" + idses +
                                            "&tNome=" + data.tNome +
                                            "&tCodigo=" + data.tCodigo +
                                            "&tDescricao=" + data.tDescricao +
                                            "&pNome=" + idp +
                                            "&tCapacidade=" + data.tCapacidade;
                                        var r = webix.ajax().sync().post(BASE_URL + "cTurmas/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdTurmas").clearAll();
                                            $$("idDTEdTurmas").load(BASE_URL + "cTurmas/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdTurmas").clearAll();
                                        $$("idDTEdTurmas").load(BASE_URL + "cTurmas/read");
                                    }

                                }

                            },
                            url: BASE_URL + "cTurmas/read",
                            pager: "pagerTurmas"
                        }, {
                            view: "pager", id: "pagerTurmas",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Turmas
var formADDTurmas = {
    view: "form",
    id: "idformADDTurmas",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    cols: [{
                        rows: [
                            {
                                view: "richselect", width: 300,
                                label: 'N&iacute;vel', name: "nNome",
                                options: {
                                    body: {
                                        template: "#nNome#",
                                        yCount: 7,
                                        url: BASE_URL + "CNiveis/read"
                                    }
                                }
                            },
                            {
                                view: "richselect", width: 300,
                                label: 'Ano Curricular', name: "acNome",
                                options: {
                                    body: {
                                        template: "#acNome#",
                                        yCount: 7,
                                        url: BASE_URL + "CAno_Curricular/read"
                                    }
                                }
                            },
                            { view: "text", label: 'Nome', name: "tNome", validate: "isNotEmpty", validateEvent: "blur" },
                            { view: "textarea", label: 'Descri&ccedil;&atilde;o', name: "tDescricao", height: 100, validate: "isNotEmpty", validateEvent: "blur" }
                        ]
                    }, {
                            rows: [
                                {
                                    view: "richselect", width: 300,
                                    label: 'Curso', name: "cNome",
                                    options: {
                                        body: {
                                            template: "#cNome#",
                                            yCount: 7,
                                            url: BASE_URL + "CCursos/read"
                                        }
                                    }
                                },
                                {
                                    view: "richselect", width: 300,
                                    label: 'Per&iacute;odo', name: "pNome",
                                    options: {
                                        body: {
                                            template: "#pNome#",
                                            yCount: 7,
                                            url: BASE_URL + "CPeriodos/read"
                                        }
                                    }
                                },
                                { view: "text", label: 'C&oacute;digo', name: "tCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                                {
                                    view: "richselect", width: 300,
                                    label: 'Sessao', name: "sesNome",
                                    options: {
                                        body: {
                                            template: "#sesNome#",
                                            yCount: 7,
                                            url: BASE_URL + "CSessao/read"
                                        }
                                    }
                                },
                                { view: "counter", label: "Capacidade", name: "tCapacidade", value:30, id: "idcounter_tCapacidade"},
                            ]
                        }
                    ],
                }, {
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var nNome = $$("idformADDTurmas").getValues().nNome;
                                var cNome = $$("idformADDTurmas").getValues().cNome;
                                var acNome = $$("idformADDTurmas").getValues().acNome;
                                var pNome = $$("idformADDTurmas").getValues().pNome;
                                var tNome = $$("idformADDTurmas").getValues().tNome;
                                var tCodigo = $$("idformADDTurmas").getValues().tCodigo;
                                var tDescricao = $$("idformADDTurmas").getValues().tDescricao;
                                var sesNome = $$("idformADDTurmas").getValues().sesNome;
                                var capacidade = $$("idformADDTurmas").getValues().tCapacidade;
                                if (nNome && cNome && acNome && tNome && pNome && tCodigo && sesNome && capacidade) { //validate form
                                    var envio = "nNome=" + nNome +
                                        "&cNome=" + cNome +
                                        "&acNome=" + acNome +
                                        "&tNome=" + tNome +
                                        "&tCodigo=" + tCodigo +
                                        "&tDescricao=" + tDescricao +
                                        "&sesNome=" + sesNome +
                                        "&pNome=" + pNome +
                                        "&tCapacidade=" + capacidade;
                                    var r = webix.ajax().sync().post(BASE_URL + "cTurmas/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdTurmas").load(BASE_URL + "cTurmas/read");
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
                                $$("idwinADDTurmas").close();
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