function cargarVistaResultados_Exame_Acesso(itemID) {

    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Resultados", body: {
                    //id:"Niveis de Acessos",
                    id: "idResultados_Exame_Acesso",
                    rows: [
                        {
                            //view:"flexlayout",
                            type: "line",
                            responsive: "idResultados_Exame_Acesso",
                            rows: [
                                {
                                    view: "form", scroll: false, elements: [
                                        {
                                            cols: [
                                                {},
                                                {
                                                    rows: [
                                                        /*{
                                                            cols: [
                                                                {
                                                                    view: "richselect", width: 300, id: "id_CB_cNome_rea",
                                                                    label: 'Curso', name: "cNome",
                                                                    labelPosition: "top",
                                                                    options: {
                                                                        body: {
                                                                            template: "#cNome#",
                                                                            yCount: 7,
                                                                            url: BASE_URL + "cCursos/read"
                                                                        }
                                                                    },
                                                                },
                                                                {
                                                                    view: "combo", width: 300, id: "idLI_CB_pNome_rea",
                                                                    label: 'Periodo', name: "pNome",
                                                                    labelPosition: "top",
                                                                    options: {
                                                                        body: {
                                                                            template: "#pNome#",
                                                                            yCount: 7,
                                                                            url: BASE_URL + "cPeriodos/read"
                                                                        }
                                                                    }
                                                                },
                                                            ]
                                                        },*/
                                                        {
                                                            cols: [
                                                                /*{
                                                                    view: "richselect", width: 300, id: "id_atcNome_rea",
                                                                    label: 'Sala', name: "atcNome",
                                                                    labelPosition: "top",
                                                                    options: {
                                                                        body: {
                                                                            template: "#atcNome#",
                                                                            yCount: 7,
                                                                            url: BASE_URL + "CAcademica_Turmas_Ingreso/read"
                                                                        }
                                                                    }
                                                                },*/
                                                                {
                                                                    view: "text", width: 300, id: "idCodigo_Barra",
                                                                    label: 'C&oacute;digo Barra', name: "Codigo_Barra",
                                                                    type: 'password',
                                                                    labelWidth: 100,
                                                                    labelPosition: "top",
                                                                    on: {
                                                                        "onChange": function (newv, oldv) {
                                                                            //determinar se o usuario logeado pertence ao nivel de acesso administradores?
                                                                            var nivel_acesso = webix.ajax().sync().post(BASE_URL + "Cutilizadores/readAcesso", "usuario=" + user_sessao);
                                                                            //cargar primero curso, periodo y sala

                                                                            // var c = $$('id_CB_cNome_rea').getValue();
                                                                            // var p = $$('idLI_CB_pNome_rea').getValue();
                                                                            // var s = $$('id_atcNome_rea').getValue();

                                                                            //alert(nivel_acesso.responseText);
                                                                            var cNome = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso/readNome", "nivel_acesso=" + nivel_acesso.responseText + "&cb=" + this.getValue() /* + "&cNome=" + c + "&pNome=" + p + "&atcNome=" + s */);
                                                                            var cNomes = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso/readNomes", "nivel_acesso=" + nivel_acesso.responseText + "&cb=" + this.getValue() /* + "&cNome=" + c + "&pNome=" + p + "&atcNome=" + s */);
                                                                            var cApelido = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso/readApelido", "nivel_acesso=" + nivel_acesso.responseText + "&cb=" + this.getValue() /* + "&cNome=" + c + "&pNome=" + p + "&atcNome=" + s */);
                                                                            var cBI = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso/readBI", "nivel_acesso=" + nivel_acesso.responseText + "&cb=" + this.getValue() /* + "&cNome=" + c + "&pNome=" + p + "&atcNome=" + s */);

                                                                            var nivel = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso/readNivel", "cb=" + this.getValue() /* + "&cNome=" + c + "&pNome=" + p + "&atcNome=" + s */);
                                                                            var curso = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso/readCurso", "cb=" + this.getValue() /* + "&cNome=" + c + "&pNome=" + p + "&atcNome=" + s */);
                                                                            var periodo = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso/readPeriodo", "cb=" + this.getValue() /* + "&cNome=" + c + "&pNome=" + p + "&atcNome=" + s */);
                                                                            var turma = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso/readTurma", "nivel_acesso=" + nivel_acesso.responseText + "&cb=" + this.getValue() /* + "&cNome=" + c + "&pNome=" + p + "&atcNome=" + s */);
                                                                            var nota = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso/readNota", "cb=" + this.getValue() /* + "&cNome=" + c + "&pNome=" + p + "&atcNome=" + s */);

                                                                            if (cNome && cNomes && cApelido && cBI && nivel && curso && periodo && turma && nota /* && c && p && s */) {
                                                                                $$("idREA_Nome_Valor").setValue(cNome.responseText);
                                                                                $$("idREA_Nomes_Valor").setValue(cNomes.responseText);
                                                                                $$("idREA_Apelido_Valor").setValue(cApelido.responseText);
                                                                                $$("idREA_BI_Valor").setValue(cBI.responseText);

                                                                                $$("idREA_Nivel_Valor").setValue(nivel.responseText);
                                                                                $$("idREA_Curso_Valor").setValue(curso.responseText);
                                                                                $$("idREA_Periodo_Valor").setValue(periodo.responseText);
                                                                                $$("idREA_Sala_Valor").setValue(turma.responseText);

                                                                                $$("idCounter_Nota").setValue(nota.responseText);

                                                                                if ($$('idCodigo_Barra').getValue() !== "") {
                                                                                    var pre = webix.ajax().sync().post(BASE_URL + "CAcademica_Presencas_Exame_Acesso/readXpresente", "cb=" + this.getValue() /* + "&cNome=" + c + "&pNome=" + p + "&atcNome=" + s */);
                                                                                    presente = pre.responseText;

                                                                                    if (presente !== "true")
                                                                                        webix.message({ type: "error", text: "Candidato ausente ao exame de acesso" });

                                                                                    if (/*nota.responseText == 0 &&*/presente == "true")
                                                                                        $$("idCounter_Nota").enable();
                                                                                    else
                                                                                        $$("idCounter_Nota").disable();
                                                                                }


                                                                            } else
                                                                                webix.message({ type: "error", text: "N&atilde;o foi pos&iacute;vel carregar a informa&ccedil;&atilde;o na Base de Dados" });
                                                                        }
                                                                    },
                                                                },
                                                                {}
                                                            ]
                                                        },
                                                        { height: 30 },
                                                        {
                                                            cols: [
                                                                { view: "label", id: "idREA_Nome", label: "Nome: ", width: 100, inputWidth: 100 },
                                                                { view: "label", id: "idREA_Nome_Valor", label: "", width: 300, inputWidth: 100 },
                                                                //{},
                                                                { view: "label", id: "idREA_Nivel", label: "N&iacute;vel:", width: 50, inputWidth: 50 },
                                                                { view: "label", id: "idREA_Nivel_Valor", label: "", width: 300, inputWidth: 50 },
                                                                {}
                                                            ]
                                                        },
                                                        { height: 10 },
                                                        {
                                                            cols: [
                                                                { view: "label", id: "idREA_Nomes", label: "Nomes: ", width: 100, inputWidth: 100 },
                                                                { view: "label", id: "idREA_Nomes_Valor", label: "", width: 300, inputWidth: 100 },
                                                                //{},
                                                                { view: "label", id: "idREA_Curso", label: "Curso: ", width: 50, inputWidth: 50 },
                                                                { view: "label", id: "idREA_Curso_Valor", label: "", width: 300, inputWidth: 50 },
                                                                {}
                                                            ]
                                                        },
                                                        { height: 10 },
                                                        {
                                                            cols: [
                                                                { view: "label", id: "idREA_Apelido", label: "Apelido: ", width: 100, inputWidth: 100 },
                                                                { view: "label", id: "idREA_Apelido_Valor", label: "", width: 300, inputWidth: 100 },
                                                                //{},
                                                                { view: "label", id: "idREA_Periodo", label: "Per&iacute;odo: ", width: 50, inputWidth: 50 },
                                                                { view: "label", id: "idREA_Periodo_Valor", label: "", width: 300, inputWidth: 50 },
                                                                {}
                                                            ]
                                                        },
                                                        { height: 10 },
                                                        {
                                                            cols: [
                                                                { view: "label", id: "idREA_BI", label: "BI/Passaporte: ", width: 100, inputWidth: 100 },
                                                                { view: "label", id: "idREA_BI_Valor", label: "", width: 300, inputWidth: 100 },
                                                                //{},
                                                                { view: "label", id: "idREA_Sala", label: "Sala: ", width: 50, inputWidth: 50 },
                                                                { view: "label", id: "idREA_Sala_Valor", label: "", width: 300, inputWidth: 50 },
                                                                {}
                                                            ]
                                                        },
                                                        { height: 30 },
                                                        {
                                                            cols: [
                                                                { width: 110 },
                                                                { view: "counter", label: "Nota_Exame", id: "idCounter_Nota", width: 200, align: "center", labelWidth: 100 },
                                                                {}
                                                            ]
                                                        },
                                                        { height: 30 },
                                                        {
                                                            cols: [
                                                                {
                                                                    view: "button", type: "form", value: "Salvar", width: 100, click: function () {
                                                                        //determinar se o usuario logeado pertence ao nivel de acesso administradores?
                                                                        var nivel_acesso = webix.ajax().sync().post(BASE_URL + "Cutilizadores/readAcesso", "usuario=" + user_sessao);

                                                                        var cb = $$('idCodigo_Barra').getValue();
                                                                        var nota = $$('idCounter_Nota').getValue();
                                                                        var bi = $$('idREA_BI_Valor').getValue();
                                                                        // var c = $$('id_CB_cNome_rea').getValue();
                                                                        // var p = $$('idLI_CB_pNome_rea').getValue();
                                                                        // var s = $$('id_atcNome_rea').getValue();
                                                                        if (cb && /*nota &&*/ bi /* && c && p && s */) {
                                                                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso/crud", "webix_operation=update&cb=" + cb + "&apecNota=" + nota + "&user_sessao=" + user_sessao + "&bi=" + bi /* + "&cNome=" + c + "&pNome=" + p + "&atcNome=" + s */ + "&na=" + nivel_acesso.responseText);
                                                                            if (r.responseText == "true") {
                                                                                webix.message("Dados inseridos com sucesso");
                                                                                //limpar componentes
                                                                                $$("idCodigo_Barra").setValue("");

                                                                                $$("idREA_Nome_Valor").setValue("");
                                                                                $$("idREA_Nomes_Valor").setValue("");
                                                                                $$("idREA_Apelido_Valor").setValue("");
                                                                                $$("idREA_BI_Valor").setValue("");

                                                                                $$("idREA_Nivel_Valor").setValue("");
                                                                                $$("idREA_Curso_Valor").setValue("");
                                                                                $$("idREA_Periodo_Valor").setValue("");
                                                                                $$("idREA_Sala_Valor").setValue("");
                                                                            } else
                                                                                webix.message({ type: "error", text: "Erro inserindo dados" });
                                                                        } else
                                                                            webix.message({ type: "error", text: "Erro faltam dados" });
                                                                    }
                                                                },
                                                                {},
                                                                {
                                                                    view: "button", type: "danger", value: "Cancelar", width: 100, click: function () {
                                                                        $$("idCodigo_Barra").setValue("");

                                                                        $$("idREA_Nome_Valor").setValue("");
                                                                        $$("idREA_Nomes_Valor").setValue("");
                                                                        $$("idREA_Apelido_Valor").setValue("");
                                                                        $$("idREA_BI_Valor").setValue("");

                                                                        $$("idREA_Nivel_Valor").setValue("");
                                                                        $$("idREA_Curso_Valor").setValue("");
                                                                        $$("idREA_Periodo_Valor").setValue("");
                                                                        $$("idREA_Sala_Valor").setValue("");

                                                                        $$("idCounter_Nota").enable();
                                                                    }
                                                                },
                                                                {}
                                                            ]
                                                        }
                                                    ]
                                                },
                                                {}
                                            ]
                                        }
                                    ]
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