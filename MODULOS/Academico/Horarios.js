function cargarVistaHorarios(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Editar Horario", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        rows: [
                            {
                                cols: [
                                    {
                                        view: "combo", width: 80, id: "idCBal",
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
                                        view: "combo", width: 130, id: "idCBn",
                                        label: 'Nivel', name: "nNome",
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
                                        view: "combo", width: 130, id: "idCBc",
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
                                        view: "combo", width: 80, id: "idCBs",
                                        label: 'Semestre', name: "sNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#sNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CSemestres/read"
                                            }
                                        }
                                    },
                                    {
                                        view: "combo", width: 110, id: "idCBp",
                                        label: 'Periodos', name: "pNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#pNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CPeriodos/read"
                                            }
                                        }
                                    },
                                    {
                                        view: "combo", width: 100, id: "idCBac",
                                        label: 'Ano Curricular', name: "acNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#acNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CAno_Curricular/read"
                                            }
                                        }
                                    },
                                    {
                                        view: "combo", width: 120, id: "idCBt",
                                        label: 'Turma', name: "tNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#tNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CTurmas/read"
                                            }
                                        }
                                    },
                                    {
                                        view: "combo", width: 100, id: "idCBses",
                                        label: 'Sess&atilde;o', name: "sesNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#sesNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CSessao/read"
                                            }
                                        }
                                    },

                                    {
                                        view: "button", type: "form", disabled: false, value: "Localizar", width: 100, click: function () {
                                            //var idSelecionado = $$("idDTEdHorarios").getSelectedId(false,true);
                                            var idal = $$("idCBal").getValue();
                                            var idn = $$("idCBn").getValue();
                                            var idc = $$("idCBc").getValue();
                                            var ids = $$("idCBs").getValue();
                                            var idp = $$("idCBp").getValue();
                                            var idac = $$("idCBac").getValue();
                                            var idt = $$("idCBt").getValue();
                                            var idses = $$("idCBses").getValue();

                                            $$("idDTEdHorarios").clearAll();
                                            $$("idDTEdHorarios").load(BASE_URL + "cHorarios/read?alAno=" + idal +
                                                "&nNome=" + idn +
                                                "&cNome=" + idc +
                                                "&sNome=" + ids +
                                                "&pNome=" + idp +
                                                "&acNome=" + idac +
                                                "&tNome=" + idt +
                                                "&sesNome=" + idses);
                                            //tabla de prof por disciplionas
                                            $$("idDTEdProfessores_Disciplinas_Horarios").clearAll();
                                            $$("idDTEdProfessores_Disciplinas_Horarios").load(BASE_URL + "cProfessores_Disciplinas/readXncpact?nNome=" + idn +
                                                "&cNome=" + idc +
                                                //"&sNome=" + ids +
                                                "&pNome=" + idp +
                                                "&acNome=" + idac +
                                                "&tNome=" + idt);
                                            //activar boton planificar
                                            $$("idBtnPlanificar").enable();
                                            //actualizar los datos del combo disciplina
                                            //idCBdNome
                                            /*$$("idCBdNome").load(BASE_URL + "cDisciplinas/readXacncps?nNome=" + idn +
                                                "&cNome=" + idc +
                                                //"&sNome=" + ids +
                                                "&pNome=" + idp +
                                                "&acNome=" + idac +
                                                "&sNome=" + ids);
                                                */
                                            //$$("idCBdNome").bind($$("idListaDisciplinas"));
                                        }

                                    },
                                    {}
                                ]
                            },
                            {
                                cols: [
                                    {
                                        view: "button", type: "danger", disabled: false, value: "Iniciar/Apagar", width: 150, click: function () {
                                            var idal = $$("idCBal").getValue();
                                            var idn = $$("idCBn").getValue();
                                            var idc = $$("idCBc").getValue();
                                            var ids = $$("idCBs").getValue();
                                            var idp = $$("idCBp").getValue();
                                            var idac = $$("idCBac").getValue();
                                            var idt = $$("idCBt").getValue();
                                            var idses = $$("idCBses").getValue();

                                            if (idal && idn && idc && ids && idp && idac && idt && idses) {
                                                webix.confirm({
                                                    title: "Confirmação",
                                                    type: "confirm-warning",
                                                    ok: "Sim", cancel: "Nao",
                                                    text: "Est&aacute; seguro que deseja apagar a informa&ccedil;&atilde;o actual para comenzar a planificar este horario?",
                                                    callback: function (result) {
                                                        if (result) {
                                                            var envio = "alAno=" + idal +
                                                                "&nNome=" + idn +
                                                                "&cNome=" + idc +
                                                                "&sNome=" + ids +
                                                                "&pNome=" + idp +
                                                                "&acNome=" + idac +
                                                                "&tNome=" + idt +
                                                                "&sesNome=" + idses;
                                                            var r = webix.ajax().sync().post(BASE_URL + "cHorarios/Iniciar_Apagar", envio);
                                                            if (r.responseText == "true") {
                                                                $$("idDTEdHorarios").clearAll();
                                                                $$("idDTEdHorarios").load(BASE_URL + "cHorarios/read?alAno=" + idal +
                                                                    "&nNome=" + idn +
                                                                    "&cNome=" + idc +
                                                                    "&sNome=" + ids +
                                                                    "&pNome=" + idp +
                                                                    "&acNome=" + idac +
                                                                    "&tNome=" + idt +
                                                                    "&sesNome=" + idses);
                                                                webix.message("Os dados foram apagados com sucesso");
                                                            } else {
                                                                webix.message({ type: "error", text: "Erro apagando dados" });
                                                            }
                                                        }
                                                    }
                                                });
                                            } else {
                                                webix.message({ type: "error", text: "Erro, faltam por selecionar algums campos" });
                                            }
                                        }

                                    },
                                    /* {
                                         view: "button", type: "form", value: "Planificar", width: 100, click: function () {
                                             var idn = $$("idCBn").getValue();
                                             var idc = $$("idCBc").getValue();
                                             var ids = $$("idCBs").getValue();
                                             var idp = $$("idCBp").getValue();
                                             var idac = $$("idCBac").getValue();
                                             var idt = $$("idCBt").getValue();
                                             var idses = $$("idCBses").getValue();
                                             if (idn && idc && ids && idp && idac && idt && idses) {
                                                 webix.ui({
                                                     view: "window",
                                                     id: "idwinADDHorarios",
                                                     width: 500,
                                                     position: "center",
                                                     modal: true,
                                                     head: "Planifica&ccedil;&atilde;o",
                                                     body: webix.copy(formADDHorarios)
                                                 }).show();
                                                 //cargar info del combo disciplina
                                                 //idCBdNome
                                                 //var idal = $$("idCBal").getValue();
                                                 //$$("idCBdNome").clearAll();
                                                 
                                                 //$$("idDTEdRegime").clearAll();
                                                 //$$("idDTEdRegime").load(BASE_URL + "cRegime/read");
                                             } else {
                                                 webix.message({ type: "error", text: "Erro, faltam por selecionar algums campos" });
                                             }
                                         }
                                     },*/
                                    {
                                        view: "richselect", width: 100, yCount: 7, id: "idCBdaNome",
                                        label: 'Dia Semana', name: "daNome", labelPosition: "top",
                                        value: 1, options: [
                                            { id: 1, value: "2ºFeira" },
                                            { id: 2, value: "3ºFeira" },
                                            { id: 3, value: "4ºFeira" },
                                            { id: 4, value: "5ºFeira" },
                                            { id: 5, value: "6ºFeira" }
                                        ]
                                    },
                                    {
                                        view: "combo", width: 100, id: "idCBtaNome",
                                        label: 'Tempo Aula', name: "taNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#taNome#",
                                                yCount: 7,
                                                url: BASE_URL + "ctemposaulas/read"
                                            }
                                        }
                                    },
                                    {
                                        view: "combo", width: 250, id: "idCBdNome",
                                        label: 'Disciplina', name: "dNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#dNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CDisciplinas/read"
                                        }
                                    },
                                        /*ready: function () {
                                            var idn = $$("idCBn").getValue();
                                            var idc = $$("idCBc").getValue();
                                            var ids = $$("idCBs").getValue();
                                            var idp = $$("idCBp").getValue();
                                            var idac = $$("idCBac").getValue();
                                            this.clearAll();
                                            $$('idCBdNome').load(BASE_URL + "cDisciplinas/readXacncps?nNome=" + idn +
                                                "&cNome=" + idc +
                                                //"&sNome=" + ids +
                                                "&pNome=" + idp +
                                                "&acNome=" + idac +
                                                "&sNome=" + ids);
                                            this.select(this.getFirstId());
                                        }*/

                                    },
                                    {
                                        view: "button", id: "idBtnPlanificar", disabled: true, value: "Planificar", type: "standard", width: "100", click: function () {
                                            var idal = $$("idCBal").getValue();
                                            var idn = $$("idCBn").getValue();
                                            var idc = $$("idCBc").getValue();
                                            var ids = $$("idCBs").getValue();
                                            var idp = $$("idCBp").getValue();
                                            var idac = $$("idCBac").getValue();
                                            var idt = $$("idCBt").getValue();
                                            var idses = $$("idCBses").getValue();

                                            var daNome = $$("idCBdaNome").getValue();
                                            var taNome = $$("idCBtaNome").getValue();
                                            var dNome = $$("idCBdNome").getValue();

                                            if (idn && idc && ids && idp && idac && idt && idses && daNome && taNome && dNome) {
                                                var envio = "alAno=" + idal +
                                                    "&nNome=" + idn +
                                                    "&cNome=" + idc +
                                                    "&sNome=" + ids +
                                                    "&pNome=" + idp +
                                                    "&acNome=" + idac +
                                                    "&tNome=" + idt +
                                                    "&sesNome=" + idses +
                                                    "&daNome=" + daNome +
                                                    "&taNome=" + taNome +
                                                    "&dNome=" + dNome;
                                                var r = webix.ajax().sync().post(BASE_URL + "CHorarios/update", envio);
                                                if (r.responseText == "true") {
                                                    webix.message("Dados inseridos com sucesso");
                                                    //this.getTopParentView().hide(); //hide window
                                                    $$("idDTEdHorarios").clearAll();
                                                    $$("idDTEdHorarios").load(BASE_URL + "cHorarios/read?alAno=" + idal +
                                                        "&nNome=" + idn +
                                                        "&cNome=" + idc +
                                                        "&sNome=" + ids +
                                                        "&pNome=" + idp +
                                                        "&acNome=" + idac +
                                                        "&tNome=" + idt +
                                                        "&sesNome=" + idses);
                                                } else {
                                                    webix.message({ type: "error", text: "Erro inserindo dados" });
                                                }
                                            }
                                            else
                                                webix.message({ type: "error", text: "Falta selecionar algums campos" });
                                        }
                                    },
                                    {}
                                ]
                            }
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdHorarios",
                            select: true,
                            editable: false,
                            columns: [
                                { id: "id", header: "", css: "rank", width: 30, sort: "int" },
                                { id: "taNome", editor: "text", header: "Tempo", width: 170, sort: "int" },
                                { id: "f2", editor: "text", header: "2ºFeira", width: 170, sort: "string" },
                                { id: "f3", editor: "text", header: "3ºFeira", width: 170, sort: "string" },
                                { id: "f4", editor: "text", header: "4ºFeira", width: 170, sort: "string" },
                                { id: "f5", editor: "text", header: "5ºFeira", width: 170, sort: "string" },
                                { id: "f6", editor: "text", header: "6ºFeira", width: 170, sort: "string" }
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
                            url: BASE_URL + "cHorarios/read",
                            //pager: "pagerHorarios"
                        },
                        {
                            //header:"Professores", body:{
                            rows: [{
                                view: "datatable",
                                id: "idDTEdProfessores_Disciplinas_Horarios",
                                select: true,
                                editable: false,
                                columns: [
                                    { id: "id", header: "", css: "rank", width: 30, sort: "int" },
                                    { id: "disciplinas_id", hidden: true, header: "disciplinas_id", css: "rank", width: 30, sort: "int" },
                                    { id: "dNome", header: "Disciplina", width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                    { id: "dCodigo", header: "C&oacute;digo", width: 70, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                    { id: "ProfessorP", editor: "combo", header: "Prof. Principal", width: 150, template: "#ProfessorP#", options: BASE_URL + "CProfessores_Disciplinas/readPP" },
                                    { id: "ProfessorA1", editor: "combo", header: "Prof. Assistente1", width: 150, template: "#ProfessorA1#", options: BASE_URL + "CProfessores_Disciplinas/readPA1" },
                                    { id: "ProfessorA2", editor: "combo", header: "Prof. Assistente2", width: 150, template: "#ProfessorA2#", options: BASE_URL + "CProfessores_Disciplinas/readPA2" },
                                    { id: "dQuantidadesHoras", header: "Quant. Horas", width: 150, validate: "isNotEmpty", validateEvent: "blur", sort: "int" },
                                    { id: "dQuantidadesHorasXsemanas", header: "Horas Semanais", width: 150, validate: "isNotEmpty", validateEvent: "blur", sort: "int" }
                                ],

                                url: BASE_URL + "cProfessores_Disciplinas/readXncpact",
                                pager: "pagerProfessores_Disciplinas_Horarios"
                            }, {
                                    view: "pager", id: "pagerProfessores_Disciplinas_Horarios",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 16,
                                    group: 10
                                }]
                        }
                    ]
                }
            }
        ]
    });
}
//Adicionar Horarios
var formADDHorarios = {
    view: "form",
    id: "idformADDHorarios",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "richselect", width: 250, yCount: 7, id: "idCBdaNome",
                    label: 'Dia Semana', name: "daNome",
                    value: 1, options: [
                        { id: 1, value: "2ºFeira" },
                        { id: 2, value: "3ºFeira" },
                        { id: 3, value: "4ºFeira" },
                        { id: 4, value: "5ºFeira" },
                        { id: 5, value: "6ºFeira" }
                    ]
                },
                {
                    view: "combo", width: 250, id: "idCBtaNome",
                    label: 'Tempo Aula', name: "taNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#taNome#",
                            yCount: 7,
                            url: BASE_URL + "ctemposaulas/read"
                        }
                    }
                },
                {
                    view: "combo", width: 250, id: "idCBdNome",
                    label: 'Disciplina', name: "dNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#dNome#",
                            yCount: 7,
                            url: BASE_URL + "CDisciplinas/read"
                        }
                    },

                }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var idal = $$("idCBal").getValue();
                        var idn = $$("idCBn").getValue();
                        var idc = $$("idCBc").getValue();
                        var ids = $$("idCBs").getValue();
                        var idp = $$("idCBp").getValue();
                        var idac = $$("idCBac").getValue();
                        var idt = $$("idCBt").getValue();
                        var idses = $$("idCBses").getValue();

                        var daNome = $$("idformADDHorarios").getValues().daNome;
                        var taNome = $$("idformADDHorarios").getValues().taNome;
                        var dNome = $$("idformADDHorarios").getValues().dNome;

                        if (idn && idc && ids && idp && idac && idt && idses && daNome && taNome && dNome) {
                            var envio = "alAno=" + idal +
                                "&nNome=" + idn +
                                "&cNome=" + idc +
                                "&sNome=" + ids +
                                "&pNome=" + idp +
                                "&acNome=" + idac +
                                "&tNome=" + idt +
                                "&sesNome=" + idses +
                                "&daNome=" + daNome +
                                "&taNome=" + taNome +
                                "&dNome=" + dNome;
                            var r = webix.ajax().sync().post(BASE_URL + "CHorarios/update", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdHorarios").clearAll();
                                $$("idDTEdHorarios").load(BASE_URL + "cHorarios/read?alAno=" + idal +
                                    "&nNome=" + idn +
                                    "&cNome=" + idc +
                                    "&sNome=" + ids +
                                    "&pNome=" + idp +
                                    "&acNome=" + idac +
                                    "&tNome=" + idt +
                                    "&sesNome=" + idses);
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
                        $$("idwinADDHorarios").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    },
    /*on: {
        "onAfterRender": function () {
            var idac = $$("idCBac").getValue();
            var idn = $$("idCBn").getValue();
            var idc = $$("idCBc").getValue();
            var idp = $$("idCBp").getValue();
            var ids = $$("idCBs").getValue();

            //$$("idCBdNome").clearAll();
            $$("idCBdNome").load(BASE_URL + "CDisciplinas/readXacncps?acNome=" + idac +
                "&nNome=" + idn +
                "&cNome=" + idc +
                "&pNome=" + idp +
                "&sNome=" + ids);
        }
    }*/
};

/*$$("idCBdNome").load(BASE_URL + "CDisciplinas/readXacncps?acNome=" + idac +
                "&nNome=" + idn +
                "&cNome=" + idc +
                "&pNome=" + idp +
                "&sNome=" + ids);
                */