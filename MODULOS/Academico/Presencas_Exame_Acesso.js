function cargarVistaPresencas_Exame_Acesso(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Presen&ccedil;as Exame", body: {
                    //id:"Niveis de Acessos",
                    id: "idPresencas_Exame_Acesso",
                    rows: [
                        {
                            //view:"flexlayout",
                            type: "line",
                            responsive: "idPresencas_Exame_Acesso",
                            rows: [
                                {
                                    view: "toolbar", elements: [
                                        {
                                            rows: [
                                                {
                                                    cols: [
                                                        {
                                                            view: "richselect", width: 80, id: "idCBal_Pres",
                                                            label: 'Ano Lec.', name: "alAno",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#alAno#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CAnos_Lectivos/read"
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 130, id: "idCBn_Pres",
                                                            label: 'N&iacute;vel', name: "nNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#nNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CNiveis/read"
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 300, id: "idCBc_Pres",
                                                            label: 'Curso', name: "cNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#cNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CCursos/read"
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 110, id: "idCBp_Pres",
                                                            label: 'Per&iacute;odo', name: "pNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#pNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CPeriodos/read"
                                                                }
                                                            }
                                                        },
                     
                                                        //{ view: "datepicker", label: "Data", labelPosition: "top", name: "fData_Inicio", stringResult: true, width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                                                        //{ view: "datepicker", type: "time", format: "%H:%i:%s", id: "idTimeEntrada", label: 'Hora Entrada', labelPosition: "top", name: "taHoraInicio", width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                                                        {
                                                            view: "button", type: "standard", value: "Pesquisar", disabled:false, id: "btnCarregar2_ls", width: 100, click: function () {
                                                                var alAno = $$('idCBal_Pres').getValue();
                                                                var nNome = $$('idCBn_Pres').getValue();
                                                                var cNome = $$('idCBc_Pres').getValue();
                                                                var pNome = $$('idCBp_Pres').getValue();

                                                                if (alAno && nNome && cNome && pNome) {
                                                                    //actualizar grid para imprimir listas apartir de los campos de busqueda
                                                                    $$("idDTEdPresencas_Exame").clearAll();
                                                                    $$("idDTEdPresencas_Exame").load(BASE_URL + "CAcademica_Presencas_Exame_Acesso/readX?alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome);
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                                }
                                                            }
                                                        },
                                                    ]
                                                },
                                                
                                            ]
                                        }
                                    ]
                                },
                                {
                                    view: "datatable",
                                    id: "idDTEdPresencas_Exame",
                                    columns: [
                                        { id: "orden", header: "Nº", css: "rank", width: 50, sort: "int" },
                                        { id: "cNome", header: ["Nome",{ content: "textFilter" }], width: 170, sort: "int" },
                                        { id: "cNomes", header: ["Nomes",{ content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cApelido", header: ["Apelido",{ content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cBI_Passaporte", header: ["cBI_Passaporte",{ content: "textFilter" }], width: 170, sort: "string" },
                                        { id:"apecEstado", header:["Ausentes",{content:"masterCheckbox" }], checkValue:'on', uncheckValue:'off', template:"{common.checkbox()}", width:80},
                                        { id: "apecCodigoBarra", header: "apecCodigoBarra", hidden: true, css: "rank", width: 50 },
                                    ],
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", editable: true, editaction: "click",
                                    save: BASE_URL + "CAcademica_Presencas_Exame_Acesso/crud",
                                    url: BASE_URL + "CAcademica_Presencas_Exame_Acesso/readX",
                                    pager: "pagerPresencas_Exame"
                                }, {
                                    view: "pager", id: "pagerPresencas_Exame",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 25,
                                    group: 10
                                }
                            ]
                        },
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