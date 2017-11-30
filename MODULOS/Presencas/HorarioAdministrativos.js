function cargarVistaHorarioAdministrativos(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Horario", body: {
                    //id:"Niveis de Acessos",
                    id: "al",
                    rows: [
                        {
                            //view:"flexlayout",
                            type: "line",
                            responsive: "al",
                            cols: [
                                {
                                    rows: [
                                        {
                                            view: "toolbar", elements: [
                                                { view: "label", id: "idlabelTipoHorario", template: "Regime Horario" },
                                                {
                                                    view: "button", type: "form", value: "Adicionar", click: function () {
                                                        $$('idDTEdTipoHorario').add({
                                                            htNome: "Exemplo1",
                                                            htCodigo: "00",
                                                            htDescricao: "Exemplo1"
                                                        });
                                                    }
                                                },
                                                {
                                                    view: "button", type: "danger", value: "Apagar", click: function () {
                                                        var id = $$('idDTEdTipoHorario').getSelectedId();
                                                        if (id)
                                                            $$('idDTEdTipoHorario').remove(id);
                                                    }
                                                },
                                                {}
                                            ]
                                        },
                                        {
                                            view: "datatable",
                                            id: "idDTEdTipoHorario",
                                            columns: [
                                                // { id: "id", header: "ID", css: "rank", width: 50 },
                                                { id: "htNome", editor: "text", header: "Nome", css: "rank", width: 200 },
                                                { id: "htCodigo", editor: "text", header: "C&oacute;digo", width: 100 },
                                                { id: "htDescricao", editor: "text", header: "Descri&ccedil;&atilde;o", css: "rank", width: 200 }
                                            ],
                                            //height: true,
                                            //autowidth: true,
                                            select: "row", editable: true, editaction: "click",
                                            save: BASE_URL + "cHorario_Tipo/crud",
                                            url: BASE_URL + "cHorario_Tipo/read",
                                            pager: "pagerHorario_Tipo"
                                        }, {
                                            view: "pager", id: "pagerHorario_Tipo",
                                            template: "{common.prev()} {common.pages()} {common.next()}",
                                            size: 25,
                                            group: 10
                                        }
                                    ]
                                },{
                                    rows: [
                                        {
                                            view: "toolbar", elements: [
                                                { view: "label", id: "idlabelSessao", template: "Sess&otilde;es de Trabalho" },
                                               /* {
                                                    view: "button", type: "form", value: "Adicionar", click: function () {
                                                        $$('idDTEdSessao').add({
                                                            stNome: "Manhã",
                                                            stCodigo: "00"
                                                        });
                                                        //$$('idDTEdSessao').refresh();
                                                    }
                                                },
                                                {
                                                    view: "button", type: "danger", value: "Apagar", click: function () {
                                                        var id = $$('idDTEdSessao').getSelectedId();
                                                        if (id)
                                                            $$('idDTEdSessao').remove(id);
                                                    }
                                                },*/
                                                {}
                                            ]
                                        },
                                        {
                                            view: "datatable",
                                            id: "idDTEdSessao",
                                            columns: [
                                                // { id: "id", header: "ID", css: "rank", width: 50 },
                                                { id: "stNome", editor: "text", header: "Nome", css: "rank", width: 200 },
                                                { id: "stCodigo", editor: "text", header: "C&oacute;digo", width: 100 }
                                            ],
                                            //height: true,
                                            //autowidth: true,
                                            select: "row", //editable: true, editaction: "click",
                                            //save: BASE_URL + "cSessao_Trabalho_Administrativos/crud",
                                            url: BASE_URL + "cSessao_Trabalho_Administrativos/read",
                                            pager: "pagerSessao"
                                        }, {
                                            view: "pager", id: "pagerSessao",
                                            template: "{common.prev()} {common.pages()} {common.next()}",
                                            size: 25,
                                            group: 10
                                        }
                                    ]
                                },
                            ]
                        }, {
                            rows: [
                                {
                                    view: "toolbar", elements: [
                                        {
                                            rows: [
                                                {
                                                    cols: [
                                                        {},
                                                        { view: "label", id: "idlabelPlanificacao", template: "Regime por Sess&atilde;o" },
                                                        {}
                                                    ]
                                                },
                                                {
                                                    cols: [
                                                        {
                                                            view: "combo", width: 250, id: "idCBhtNome",
                                                            label: 'Regime', name: "htNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#htNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "cHorario_Tipo/read"
                                                                }
                                                            },
                                                        },
                                                        {
                                                            view: "combo", width: 250, id: "idCBstNome",
                                                            label: 'Sess&atilde;o', name: "stNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#stNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "cSessao_Trabalho_Administrativos/read"
                                                                }
                                                            },
                                                        },
                                                        { view: "datepicker", type: "time", format: "%H:%i:%s", id: "idTimeEntrada", label: 'Hora Entrada', labelPosition: "top", name: "taHoraInicio", validate: "isNotEmpty", validateEvent: "blur" },
                                                        { view: "datepicker", type: "time", format: "%H:%i:%s", id: "idTimeSaida", label: 'Hora Sa&iacute;da', labelPosition: "top", name: "taHoraFim", validate: "isNotEmpty", validateEvent: "blur" },
                                                        {
                                                            view: "button", type: "form", value: "Adicionar", click: function () {
                                                                $$('idDTEdPlanificacao').add({
                                                                    htNome: $$("idCBhtNome").getValue(),
                                                                    stNome: $$("idCBstNome").getValue(),
                                                                    Entrada: $$("idTimeEntrada").getValue(),
                                                                    Saida: $$("idTimeSaida").getValue()
                                                                });
                                                                $$("idDTEdPlanificacao").clearAll();
                                                                $$("idDTEdPlanificacao").load(BASE_URL + "cTipo_Horario_Sessao/read");
                                                            }
                                                        },
                                                        {
                                                            view: "button", type: "danger", value: "Apagar", click: function () {
                                                                var id = $$('idDTEdPlanificacao').getSelectedId();
                                                                if (id)
                                                                    $$('idDTEdPlanificacao').remove(id);
                                                            }
                                                        },
                                                    ]
                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    view: "datatable",
                                    id: "idDTEdPlanificacao",
                                    columns: [
                                        // { id: "id", header: "ID", css: "rank", width: 50 },
                                        { id: "htNome", header: "Regime", css: "rank", width: 200 },
                                        { id: "stNome", header: "Sess&atilde;o", width: 100 },
                                        { id: "Entrada", header: "Entrada", width: 100 },
                                        { id: "Saida", header: "Sa&iacute;da", width: 100 }
                                    ],
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", //editable: true, editaction: "click",
                                    save: BASE_URL + "cTipo_Horario_Sessao/crud",
                                    url: BASE_URL + "cTipo_Horario_Sessao/read",
                                    pager: "pagerPlanificacao"
                                }, {
                                    view: "pager", id: "pagerPlanificacao",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 25,
                                    group: 10
                                }
                            ]
                        },
                    ]
                }
            }, {
                //tab Administrativos Regime
                header: "Administrativos Regime", body: {
                    //id:"Niveis de Acessos",
                    //id: "al",
                    rows: [
                        {
                            rows: [
                                {
                                    view: "toolbar", elements: [
                                        {
                                            rows: [
                                                /*{
                                                    cols: [
                                                        {},
                                                        { view: "label", id: "idlabelPlanificacao", template: "Regime por Sess&atilde;o" },
                                                        {}
                                                    ]
                                                },*/
                                                {
                                                    cols: [
                                                        {
                                                            view: "combo", id: "idCBbi", label: 'Localizar por BI', labelPosition: "top", name: "BI_Passaporte",/*value:1,*/options: { body: { template: "#fBI_Passaporte#", yCount: 7, url: BASE_URL + "CFuncionarios/readBI" } },
                                                            on: {
                                                                "onChange": function (newv, oldv) {
                                                                    var fNome = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readNomeXID", "id=" + this.getValue());
                                                                    var fApelido = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readApelidoXID", "id=" + this.getValue());
                                                                    //if(r.responseText == "true"){
                                                                    $$("idComboFNome").setValue(fNome.responseText);
                                                                    $$("idComboFApelido").setValue(fApelido.responseText);
                                                                }
                                                            }
                                                        },
                                                        { view: "text", id: "idComboFNome", readonly: true, label: 'Nome', labelPosition: "top", name: "fNome" },
                                                        { view: "text", id: "idComboFApelido", readonly: true, label: 'Apelido', labelPosition: "top", name: "fApelido" },
                                                        {
                                                            view: "combo", id: "idCBhtNome2",
                                                            label: 'Regime', name: "htNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#htNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "cHorario_Tipo/read"
                                                                }
                                                            },
                                                        },
                                                        //{ view: "datepicker", type: "time", format: "%H:%i:%s", id: "idTimeEntrada", label: 'Hora Entrada', labelPosition: "top", name: "taHoraInicio", validate: "isNotEmpty", validateEvent: "blur" },
                                                        //{ view: "datepicker", type: "time", format: "%H:%i:%s", id: "idTimeSaida", label: 'Hora Sa&iacute;da', labelPosition: "top", name: "taHoraFim", validate: "isNotEmpty", validateEvent: "blur" },
                                                        {
                                                            view: "button", type: "form", value: "Adicionar", click: function () {
                                                                var bi = $$("idCBbi").getValue();
                                                                var htNome = $$("idCBhtNome2").getValue();
                                                                if (bi && htNome) {
                                                                    $$('idDTEdAR').add({
                                                                        BI_Passaporte: bi,
                                                                        htNome: htNome,
                                                                    });
                                                                    $$("idDTEdAR").clearAll();
                                                                    $$("idDTEdAR").load(BASE_URL + "cHorario_Funcionarios/read");
                                                                    //webix.message("Dados adicionados com sucesso");
                                                                }else
                                                                webix.message({ type: "error", text: "Erro, faltam por selecionar algums campos" });
                                                            }
                                                        },
                                                        {
                                                            view: "button", type: "danger", value: "Apagar", click: function () {
                                                                var id = $$('idDTEdAR').getSelectedId();
                                                                if (id)
                                                                    $$('idDTEdAR').remove(id);
                                                            }
                                                        },
                                                    ]
                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    view: "datatable",
                                    id: "idDTEdAR",
                                    columns: [
                                        // { id: "id", header: "ID", css: "rank", width: 50 },
                                        { id: "fNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "fNomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "fApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "fBI_Passaporte", header: ["BI-Pass.", { content: "textFilter" }], width: 170, sort: "strig" },
                                        { id: "htNome", header: ["Regime", { content: "selectFilter" }], css: "rank", width: 200, sort: "strig" }
                                    ],
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", //editable: true, editaction: "click",
                                    save: BASE_URL + "cHorario_Funcionarios/crud",
                                    url: BASE_URL + "cHorario_Funcionarios/read",
                                    pager: "pagerAR"
                                }, {
                                    view: "pager", id: "pagerAR",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 25,
                                    group: 10
                                }
                            ]

                        }
                    ]
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