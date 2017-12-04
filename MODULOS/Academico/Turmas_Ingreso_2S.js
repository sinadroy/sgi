function cargarVistaTurmas_Ingreso_2S(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Salas", body: {
                    //id:"Niveis de Acessos",
                    id: "Turma_Ingreso",
                    rows: [
                        {
                            //view:"flexlayout",
                            type: "line",
                            responsive: "Turma_Ingreso",
                            rows: [
                                {
                                    view: "toolbar", elements: [
                                        //{ view: "label", id: "idlabelTipoHorario", template: "Regime Horario" },
                                        {
                                            view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                                $$('idDTEdTurmas_Ingreso').add({
                                                    atcNome: "Sala X",
                                                    atcCodigo: "00",
                                                    atcCapacidade: 50,
                                                    atcLocalizacao: "Bloco X",
                                                });
                                                setTimeout('', 3000);
                                                $$("idDTEdTurmas_Ingreso").clearAll();
                                                $$("idDTEdTurmas_Ingreso").load(BASE_URL + "CAcademica_Turmas_Ingreso_2S/read");
                                            }
                                        },
                                        {
                                            view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                                var id = $$('idDTEdTurmas_Ingreso').getSelectedId();
                                                if (id)
                                                    $$('idDTEdTurmas_Ingreso').remove(id);
                                            }
                                        },
                                        {
                                            view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                                $$("idDTEdTurmas_Ingreso").clearAll();
                                                $$("idDTEdTurmas_Ingreso").load(BASE_URL + "CAcademica_Turmas_Ingreso_2S/read");
                                            }
                                        },
                                        {}
                                    ]
                                },
                                {
                                    view: "datatable",
                                    id: "idDTEdTurmas_Ingreso",
                                    columns: [
                                        { id: "id", header: "ID", hidden: true, css: "rank", width: 50 },
                                        { id: "atcNome", editor: "text", header: "Nome", css: "rank", width: 200 },
                                        { id: "atcCodigo", editor: "text", header: "C&oacute;digo", width: 100 },
                                        { id: "atcCapacidade", editor: "text", header: "Capacidade", css: "rank", width: 100 },
                                        //{ id: "atcData", editor: "date", header: "Data", css: "rank", width: 100 },
                                        //{id: "alAno", editor: "richselect", header: "Ano Lectivo", css: "rank", width: 100, template: "#alAno#", options: BASE_URL + "CAnos_Lectivos/read"},
                                        //{id:"fBI_Provincia_Emissao",editor:"richselect",header:"BI Prov Emiss&atilde;o", width:140,template:"#provNome#",options:BASE_URL+"CProvincias/read"},
                                        { id: "atcLocalizacao", editor: "text", header: "localiza&ccedil;&atilde;o", css: "rank", width: 300 }
                                    ],
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", editable: true, editaction: "click",
                                    save: BASE_URL + "CAcademica_Turmas_Ingreso_2S/crud",
                                    url: BASE_URL + "CAcademica_Turmas_Ingreso_2S/read",
                                    pager: "pagerTurmas_Ingreso_2S"
                                }, {
                                    view: "pager", id: "pagerTurmas_Ingreso_2S",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 25,
                                    group: 10
                                }
                            ]
                        },
                    ]
                }
            }, {
                //regime e sessao na BD
                header: "Planifica&ccedil;&atilde;o", body: {
                    //id:"Niveis de Acessos",
                    id: "Planificacao_Exame_Ingreso",
                    rows: [
                        {
                            //view:"flexlayout",
                            type: "line",
                            responsive: "Planificacao_Exame_Ingreso",
                            rows: [
                                {
                                    view: "toolbar", elements: [
                                        //{ view: "label", id: "idlabelTipoHorario", template: "Regime Horario" },
                                        {
                                            view: "combo", width: 80, id: "idCB_planificacao_al_2s",
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
                                            view: "combo", width: 130, id: "idCB_planificacao_n_2s",
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
                                            view: "combo", width: 300, id: "idCB_planificacao_c_2s",
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
                                            view: "combo", width: 130, id: "idCB_planificacao_p_2s",
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
                                        {
                                            view: "combo", width: 120, id: "idCB_planificacao_t_2s",
                                            label: 'Sala', name: "atcNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#atcNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CAcademica_Turmas_Ingreso_2S/read"
                                                }
                                            }
                                        },
                                        { view: "datepicker", label: "Data", labelPosition: "top", name: "apeiData", id: "idDate_planificacao_data_2s", stringResult: true, width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                                        { view: "datepicker", type: "time", format: "%H:%i:%s", id: "idTime_planificacao_hora_2s", label: 'Hora', labelPosition: "top", name: "apeiHora", width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                                        {}
                                    ]
                                },
                                {
                                    cols:[
                                        {
                                            view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                                var alAno = $$('idCB_planificacao_al_2s').getValue();
                                                var nNome = $$('idCB_planificacao_n_2s').getValue();
                                                var cNome = $$('idCB_planificacao_c_2s').getValue();
                                                var pNome = $$('idCB_planificacao_p_2s').getValue();
                                                var atcNome = $$('idCB_planificacao_t_2s').getValue();
                                                var apeiData = $$('idDate_planificacao_data_2s').getValue();
                                                var apeiHora = $$('idTime_planificacao_hora_2s').getValue();
                                                if (alAno && nNome && cNome && pNome && atcNome && apeiData && apeiHora) {
                                                    $$('idDTEdPlanificacao_Ingreso_2S').add({
                                                        alAno: alAno,
                                                        nNome: nNome,
                                                        cNome: cNome,
                                                        pNome: pNome,
                                                        atcNome: atcNome,
                                                        //atcLocalizacao : $$('idCB_planificacao_n_2s').getValue(),
                                                        apeiData: apeiData,
                                                        apeiHora: apeiHora,
                                                    });
                                                    setTimeout('', 3000);
                                                    $$("idDTEdPlanificacao_Ingreso_2S").clearAll();
                                                    $$("idDTEdPlanificacao_Ingreso_2S").load(BASE_URL + "CAcademica_Planificacao_Exame_Ingreso_2S/read");
                                                } else {
                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                }
                                            }
                                        },
                                        {
                                            view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                                var id = $$('idDTEdPlanificacao_Ingreso_2S').getSelectedId();
                                                if (id)
                                                    $$('idDTEdPlanificacao_Ingreso_2S').remove(id);
                                            }
                                        },
                                        {
                                            view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                                $$("idDTEdPlanificacao_Ingreso_2S").clearAll();
                                                $$("idDTEdPlanificacao_Ingreso_2S").load(BASE_URL + "CAcademica_Planificacao_Exame_Ingreso_2S/read");
                                                //
                                                $$("idCB_planificacao_t_2s").getList().clearAll();
                                                $$("idCB_planificacao_t_2s").getList().load(BASE_URL + "CAcademica_Turmas_Ingreso/read");
                                                //
                                                $$("idCB_planificacao_p_2s").getList().clearAll();
                                                $$("idCB_planificacao_p_2s").getList().load(BASE_URL + "CPeriodos/read");
                                                //
                                                $$("idCB_planificacao_c_2s").getList().clearAll();
                                                $$("idCB_planificacao_c_2s").getList().load(BASE_URL + "CCursos/read");
                                            }
                                        },
                                        {}
                                    ]
                                },
                                {
                                    view: "datatable",
                                    id: "idDTEdPlanificacao_Ingreso_2S",
                                    // height: 300,
                                    columns: [
                                        { id: "orden", header: "Nº", css: "rank", width: 50 },
                                        { id: "id", header: "ID", hidden: true, css: "rank", width: 50 },

                                        { id: "alAno", editor: "richselect", header: "Ano Lectivo", css: "rank", width: 100, template: "#alAno#", options: BASE_URL + "CAnos_Lectivos/read" },
                                        { id: "nNome", editor: "text", header: "N&iacute;vel", css: "rank", width: 200 },
                                        { id: "cNome", editor: "text", header: "Curso", width: 300 },
                                        { id: "pNome", editor: "text", header: "Per&iacute;odo", css: "rank", width: 100 },
                                        { id: "atcNome", editor: "text", header: "Sala", css: "rank", width: 200 },
                                        // { id: "atcLocalizacao", editor: "text", header: "Localiza&ccedil;&atilde;o", css: "rank", width: 300 },
                                        { id: "apeiData", editor: "date", header: "Data", css: "rank", width: 100 },
                                        { id: "apeiHora", editor: "date", header: "Hora", css: "rank", width: 100 },
                                    ],
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", //editable: true, editaction: "click",
                                    save: BASE_URL + "CAcademica_Planificacao_Exame_Ingreso_2S/crud",
                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Ingreso_2S/read",
                                    pager: "pagerPlanificacao_Ingreso_2S"
                                }, {
                                    view: "pager", id: "pagerPlanificacao_Ingreso_2S",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 25,
                                    group: 10
                                },
                            ]
                        },
                    ]
                }
            }, {
                //tab Planificacao para exame de ingreso
                header: "Distribui&ccedil;&atilde;o", body: {
                    //id:"Niveis de Acessos",
                    //id: "al",
                    rows: [
                        {
                            rows: [
                                {
                                    view: "toolbar", elements: [
                                        {
                                            rows: [
                                                {
                                                    cols: [
                                                        {
                                                            view: "richselect", width: 80, id: "idCBal",
                                                            label: 'Ano Lec.', name: "alAno",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#alAno#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CAnos_Lectivos/read"
                                                                }
                                                            }, on: {
                                                                "onChange": function (newv, oldv) {
                                                                    $$("idCB_Datas_Planificadas").setValue();
                                                                    $$("idCB_Datas_Planificadas").disable();
                                                                    $$("idCB_Horas_Planificadas").setValue();
                                                                    $$("idCB_Horas_Planificadas").disable();
                                                                    $$("btnCarregar2").disable();
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 130, id: "idCBn",
                                                            label: 'N&iacute;vel', name: "nNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#nNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CNiveis/read"
                                                                }
                                                            }, on: {
                                                                "onChange": function (newv, oldv) {
                                                                    $$("idCB_Datas_Planificadas").setValue();
                                                                    $$("idCB_Datas_Planificadas").disable();
                                                                    $$("idCB_Horas_Planificadas").setValue();
                                                                    $$("idCB_Horas_Planificadas").disable();
                                                                    $$("btnCarregar2").disable();
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 300, id: "idCBc",
                                                            label: 'Curso', name: "cNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#cNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CCursos/read"
                                                                }
                                                            }, on: {
                                                                "onChange": function (newv, oldv) {
                                                                    $$("idCB_Datas_Planificadas").setValue();
                                                                    $$("idCB_Datas_Planificadas").disable();
                                                                    $$("idCB_Horas_Planificadas").setValue();
                                                                    $$("idCB_Horas_Planificadas").disable();
                                                                    $$("btnCarregar2").disable();
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 130, id: "idCBp",
                                                            label: 'Per&iacute;odo', name: "pNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#pNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CPeriodos/read"
                                                                }
                                                            }, on: {
                                                                "onChange": function (newv, oldv) {
                                                                    $$("idCB_Datas_Planificadas").setValue();
                                                                    $$("idCB_Datas_Planificadas").disable();
                                                                    $$("idCB_Horas_Planificadas").setValue();
                                                                    $$("idCB_Horas_Planificadas").disable();
                                                                    $$("btnCarregar2").disable();
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 120, id: "idCBt",
                                                            label: 'Sala', name: "atcNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#atcNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CAcademica_Turmas_Ingreso_2S/read"
                                                                }
                                                            }, on: {
                                                                "onChange": function (newv, oldv) {
                                                                    $$("idCB_Datas_Planificadas").setValue();
                                                                    $$("idCB_Datas_Planificadas").disable();
                                                                    $$("idCB_Horas_Planificadas").setValue();
                                                                    $$("idCB_Horas_Planificadas").disable();
                                                                    $$("btnCarregar2").disable();
                                                                }
                                                            }
                                                        },

                                                        {
                                                            view: "button", type: "standard", value: "Carregar", width: 100, click: function () {
                                                                var alAno = $$('idCBal').getValue();
                                                                var nNome = $$('idCBn').getValue();
                                                                var cNome = $$('idCBc').getValue();
                                                                var pNome = $$('idCBp').getValue();
                                                                var atcNome = $$('idCBt').getValue();
                                                                if (alAno && nNome && cNome && pNome && atcNome) {
                                                                    //activar componentes da segunda linha
                                                                    $$("idCB_Datas_Planificadas").enable();
                                                                    $$("idCB_Horas_Planificadas").enable();
                                                                    $$("btnCarregar2").enable();
                                                                    //cargar datos de la fecha
                                                                    $$("idCB_Datas_Planificadas").getList().clearAll();
                                                                    $$("idCB_Datas_Planificadas").getList().load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/readDatasPlanificadasXancpt?alAno=" + alAno +
                                                                        "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome);
                                                                    //cargar datos de la Hora
                                                                    $$("idCB_Horas_Planificadas").getList().clearAll();
                                                                    $$("idCB_Horas_Planificadas").getList().load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/readHorasPlanificadasXancpt?alAno=" + alAno +
                                                                        "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome);
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar nesta linha" });
                                                                }
                                                            }
                                                        },
                                                        {},
                                                    ]
                                                }, {
                                                    cols: [
                                                        {
                                                            view: "richselect", width: 120, id: "idCB_Datas_Planificadas", disabled: true,
                                                            label: 'Data', name: "apeiData",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#apeiData#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/readDatasPlanificadasXancpt"
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 120, id: "idCB_Horas_Planificadas", disabled: true,
                                                            label: 'Hora', name: "apeiHora",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#apeiHora#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/readHorasPlanificadasXancpt"
                                                                }
                                                            }
                                                        },
                                                        //{ view: "datepicker", label: "Data", labelPosition: "top", name: "fData_Inicio", stringResult: true, width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                                                        //{ view: "datepicker", type: "time", format: "%H:%i:%s", id: "idTimeEntrada", label: 'Hora Entrada', labelPosition: "top", name: "taHoraInicio", width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                                                        {
                                                            view: "button", type: "standard", value: "Carregar", disabled: true, id: "btnCarregar2", width: 100, click: function () {
                                                                var alAno = $$('idCBal').getValue();
                                                                var nNome = $$('idCBn').getValue();
                                                                var cNome = $$('idCBc').getValue();
                                                                var pNome = $$('idCBp').getValue();
                                                                var atcNome = $$('idCBt').getValue();
                                                                //var apeiData = $$('idDate_planificacao_data_2s').getValue();
                                                                //var apeiHora = $$('idTime_planificacao_hora_2s').getValue();
                                                                var apeiData = $$('idCB_Datas_Planificadas').getText();
                                                                var apeiHora = $$('idCB_Horas_Planificadas').getText();

                                                                if (alAno && nNome && cNome && pNome && atcNome && apeiData && apeiHora) {
                                                                    //cargar total de Candidatos
                                                                    var envio1 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/totalCandidatosXNiveisCursosPeriodo", envio1);
                                                                    var totalCandidatos = r.responseText;
                                                                    $$("idlabel_total_candidatos_valor").setValue(totalCandidatos);
                                                                    //cargar capacidade da turma
                                                                    var envio2 = "turma=" + atcNome;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Turmas_Ingreso_2S/readCapacidadeTurma", envio2);
                                                                    var capacidadeTurma = r.responseText;
                                                                    $$("idlabel_capacidade_turma_valor").setValue(capacidadeTurma);

                                                                    //total de candidatos colocados dentro de la turma
                                                                    var envio3 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome + "&apeiData=" + apeiData + "&apeiHora=" + apeiHora;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/totalCandidatosColocadosXNiveisCursosPeriodo", envio3);
                                                                    var candidatosColocados = r.responseText;
                                                                    $$("idlabel_candidatos_colocados_valor").setValue(candidatosColocados);
                                                                    //total de candidatos nao colocados
                                                                    var envio4 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/totalCandidatosNaoColocadosGeral", envio4);
                                                                    var candidatos_nao_colocados = r.responseText;
                                                                    $$("idlabel_candidatos_nao_colocados_valor").setValue(candidatos_nao_colocados);

                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar nesta linha" });
                                                                }
                                                            }
                                                        },
                                                        {}
                                                    ]
                                                },
                                                { height: 10 },
                                                {
                                                    cols: [
                                                        { view: "label", id: "idlabel_total_candidatos", label: "Total Candidatos: ", width: 150, inputWidth: 100 },
                                                        { view: "label", id: "idlabel_total_candidatos_valor", label: "0", width: 50, inputWidth: 50 },
                                                        { view: "label", id: "idlabel_candidatos_colocados", label: "Candidatos colocados: ", width: 150, inputWidth: 200 },
                                                        { view: "label", id: "idlabel_candidatos_colocados_valor", label: "0", width: 50, inputWidth: 50 },
                                                        { view: "label", id: "idlabel_candidatos_nao_colocados", label: "Candidatos n&atilde;o colocados: ", width: 200, inputWidth: 100 },
                                                        { view: "label", id: "idlabel_candidatos_nao_colocados_valor", label: "0", width: 50, inputWidth: 50 },
                                                        { view: "label", id: "idlabel_capacidade_turma", label: "Capacidade sala: ", width: 150, inputWidth: 100 },
                                                        { view: "label", id: "idlabel_capacidade_turma_valor", label: "0", width: 50, inputWidth: 50 },
                                                        {}
                                                    ]
                                                },
                                                { height: 10 },
                                                {
                                                    cols: [
                                                        {
                                                            view: "button", type: "form", value: "Atribuir", width: 100, click: function () {
                                                                var alAno = $$('idCBal').getValue();
                                                                var nNome = $$('idCBn').getValue();
                                                                var cNome = $$('idCBc').getValue();
                                                                var pNome = $$('idCBp').getValue();
                                                                var atcNome = $$('idCBt').getValue();
                                                                var apeiData = $$('idCB_Datas_Planificadas').getText();
                                                                var apeiHora = $$('idCB_Horas_Planificadas').getText();

                                                                if (alAno && nNome && cNome && pNome && atcNome && apeiData && apeiHora) {
                                                                    //Atribuir
                                                                    var candidatos_colocados = $$('idlabel_candidatos_colocados_valor').getValue();
                                                                    var capacidade_turma = $$('idlabel_capacidade_turma_valor').getValue();
                                                                    var candidatos_nao_colocados = $$('idlabel_candidatos_nao_colocados_valor').getValue();
                                                                    if (candidatos_colocados == "0") {
                                                                        var envio = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome + "&apeiData=" + apeiData + "&apeiHora=" + apeiHora + "&capacidade_turma=" + capacidade_turma;
                                                                        var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/atrinuirCandidatosTurma", envio);
                                                                        //var totalCandidatos = r.responseText;
                                                                        if (r.responseText == "true") {
                                                                            $$("idDTEdPlanificacao_Exame_Candidatos_2S").clearAll();
                                                                            $$("idDTEdPlanificacao_Exame_Candidatos_2S").load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/read");
                                                                            //actualizar los labels
                                                                            //cargar total de Candidatos
                                                                            var envio1 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/totalCandidatosXNiveisCursosPeriodo", envio1);
                                                                            var totalCandidatos = r.responseText;
                                                                            $$("idlabel_total_candidatos_valor").setValue(totalCandidatos);
                                                                            //cargar capacidade da turma
                                                                            var envio2 = "turma=" + atcNome;
                                                                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Turmas_Ingreso_2S/readCapacidadeTurma", envio2);
                                                                            var capacidadeTurma = r.responseText;
                                                                            $$("idlabel_capacidade_turma_valor").setValue(capacidadeTurma);

                                                                            //total de candidatos colocados dentro de la turma
                                                                            var envio3 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome + "&apeiData=" + apeiData + "&apeiHora=" + apeiHora;
                                                                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/totalCandidatosColocadosXNiveisCursosPeriodo", envio3);
                                                                            var candidatosColocados = r.responseText;
                                                                            $$("idlabel_candidatos_colocados_valor").setValue(candidatosColocados);
                                                                            //total de candidatos nao colocados
                                                                            var envio4 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/totalCandidatosNaoColocadosGeral", envio4);
                                                                            var candidatos_nao_colocados = r.responseText;
                                                                            $$("idlabel_candidatos_nao_colocados_valor").setValue(candidatos_nao_colocados);

                                                                            webix.message("Candidatos inseridos na turma selecionada");
                                                                        }
                                                                        else
                                                                            webix.message({ type: "error", text: "Erro Inserindo dados, contactar Administrador" });
                                                                    } else
                                                                        webix.message({ type: "error", text: "N&atilde;o &eacute; posivel realizar atribui&ccedil;&atilde;o, turma em uso ou capacidade insuficiente" });
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar nesta linha" });
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                                                var alAno = $$('idCBal').getValue();
                                                                var nNome = $$('idCBn').getValue();
                                                                var cNome = $$('idCBc').getValue();
                                                                var pNome = $$('idCBp').getValue();
                                                                var atcNome = $$('idCBt').getValue();
                                                                var apeiData = $$('idCB_Datas_Planificadas').getText();
                                                                var apeiHora = $$('idCB_Horas_Planificadas').getText();

                                                                if (alAno && nNome && cNome && pNome && atcNome && apeiData && apeiHora) {
                                                                    //cargar total de Candidatos
                                                                    var envio1 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/totalCandidatosXNiveisCursosPeriodo", envio1);
                                                                    var totalCandidatos = r.responseText;
                                                                    $$("idlabel_total_candidatos_valor").setValue(totalCandidatos);
                                                                    //cargar capacidade da turma
                                                                    var envio2 = "turma=" + atcNome;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Turmas_Ingreso_2S/readCapacidadeTurma", envio2);
                                                                    var capacidadeTurma = r.responseText;
                                                                    $$("idlabel_capacidade_turma_valor").setValue(capacidadeTurma);

                                                                    //total de candidatos colocados dentro de la turma
                                                                    var envio3 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome + "&apeiData=" + apeiData + "&apeiHora=" + apeiHora;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/totalCandidatosColocadosXNiveisCursosPeriodo", envio3);
                                                                    var candidatosColocados = r.responseText;
                                                                    $$("idlabel_candidatos_colocados_valor").setValue(candidatosColocados);
                                                                    //total de candidatos nao colocados
                                                                    var envio4 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/totalCandidatosNaoColocadosGeral", envio4);
                                                                    var candidatos_nao_colocados = r.responseText;
                                                                    $$("idlabel_candidatos_nao_colocados_valor").setValue(candidatos_nao_colocados);

                                                                }
                                                                $$("idDTEdPlanificacao_Exame_Candidatos_2S").clearAll();
                                                                $$("idDTEdPlanificacao_Exame_Candidatos_2S").load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/read");
                                                            }
                                                        },
                                                        {}
                                                    ]

                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    view: "datatable",
                                    id: "idDTEdPlanificacao_Exame_Candidatos_2S",
                                    // height: 300,
                                    columns: [
                                        { id: "orden", header: "Nº", css: "rank", width: 50 },
                                        { id: "id", header: "ID", hidden: true, css: "rank", width: 50 },

                                        { id: "alAno", header: "Ano Lectivo", css: "rank", width: 100, template: "#alAno#", options: BASE_URL + "CAnos_Lectivos/read" },
                                        { id: "nNome", header: "N&iacute;vel", css: "rank", width: 200 },
                                        { id: "cNome", header: "Curso", width: 300 },
                                        { id: "pNome", header: "Per&iacute;odo", css: "rank", width: 100 },
                                        { id: "atcNome", header: "Sala", css: "rank", width: 200 },
                                        // { id: "atcLocalizacao", editor: "text", header: "Localiza&ccedil;&atilde;o", css: "rank", width: 300 },
                                        { id: "apeiData", header: "Data", css: "rank", width: 100 },
                                        { id: "apeiHora", header: "Hora", css: "rank", width: 100 },
                                        { id: "totalCandidatos", header: "Q.Cand.", css: "rank", width: 100 },
                                    ],
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", //editable: true, editaction: "click",
                                    //save: BASE_URL + "CAcademica_Planificacao_Exame_Ingreso/crud",
                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/read",
                                    pager: "pagerPlanificacao_Exame_Candidatos_2S"
                                }, {
                                    view: "pager", id: "pagerPlanificacao_Exame_Candidatos_2S",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 8,
                                    group: 10
                                },
                            ]

                        }
                    ]
                }
            }, {
                //tab Planificacao para exame de ingreso
                header: "Listas por Sala", body: {
                    //id:"Niveis de Acessos",
                    //id: "al",
                    rows: [
                        {
                            rows: [
                                {
                                    view: "toolbar", elements: [
                                        {
                                            rows: [
                                                {
                                                    cols: [
                                                        {
                                                            view: "richselect", width: 80, id: "idCBal_ls",
                                                            label: 'Ano Lec.', name: "alAno",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#alAno#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CAnos_Lectivos/read"
                                                                }
                                                            }, on: {
                                                                "onChange": function (newv, oldv) {
                                                                    $$("idCB_Datas_Planificadas_ls").setValue();
                                                                    $$("idCB_Datas_Planificadas_ls").disable();
                                                                    $$("idCB_Horas_Planificadas_ls").setValue();
                                                                    $$("idCB_Horas_Planificadas_ls").disable();
                                                                    $$("btnCarregar2_ls").disable();
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 130, id: "idCBn_ls",
                                                            label: 'N&iacute;vel', name: "nNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#nNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CNiveis/read"
                                                                }
                                                            }, on: {
                                                                "onChange": function (newv, oldv) {
                                                                    $$("idCB_Datas_Planificadas_ls").setValue();
                                                                    $$("idCB_Datas_Planificadas_ls").disable();
                                                                    $$("idCB_Horas_Planificadas_ls").setValue();
                                                                    $$("idCB_Horas_Planificadas_ls").disable();
                                                                    $$("btnCarregar2_ls").disable();
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 300, id: "idCBc_ls",
                                                            label: 'Curso', name: "cNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#cNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CCursos/read"
                                                                }
                                                            }, on: {
                                                                "onChange": function (newv, oldv) {
                                                                    $$("idCB_Datas_Planificadas_ls").setValue();
                                                                    $$("idCB_Datas_Planificadas_ls").disable();
                                                                    $$("idCB_Horas_Planificadas_ls").setValue();
                                                                    $$("idCB_Horas_Planificadas_ls").disable();
                                                                    $$("btnCarregar2_ls").disable();
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 130, id: "idCBp_ls",
                                                            label: 'Per&iacute;odo', name: "pNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#pNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CPeriodos/read"
                                                                }
                                                            }, on: {
                                                                "onChange": function (newv, oldv) {
                                                                    $$("idCB_Datas_Planificadas_ls").setValue();
                                                                    $$("idCB_Datas_Planificadas_ls").disable();
                                                                    $$("idCB_Horas_Planificadas_ls").setValue();
                                                                    $$("idCB_Horas_Planificadas_ls").disable();
                                                                    $$("btnCarregar2_ls").disable();
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 120, id: "idCBt_ls",
                                                            label: 'Sala', name: "atcNome",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#atcNome#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CAcademica_Turmas_Ingreso_2S/read"
                                                                }
                                                            }, on: {
                                                                "onChange": function (newv, oldv) {
                                                                    $$("idCB_Datas_Planificadas_ls").setValue();
                                                                    $$("idCB_Datas_Planificadas_ls").disable();
                                                                    $$("idCB_Horas_Planificadas_ls").setValue();
                                                                    $$("idCB_Horas_Planificadas_ls").disable();
                                                                    $$("btnCarregar2_ls").disable();
                                                                }
                                                            }
                                                        },

                                                        {
                                                            view: "button", type: "standard", value: "Carregar", width: 100, click: function () {
                                                                var alAno = $$('idCBal_ls').getValue();
                                                                var nNome = $$('idCBn_ls').getValue();
                                                                var cNome = $$('idCBc_ls').getValue();
                                                                var pNome = $$('idCBp_ls').getValue();
                                                                var atcNome = $$('idCBt_ls').getValue();
                                                                if (alAno && nNome && cNome && pNome && atcNome) {
                                                                    //activar componentes da segunda linha
                                                                    $$("idCB_Datas_Planificadas_ls").enable();
                                                                    $$("idCB_Horas_Planificadas_ls").enable();
                                                                    $$("btnCarregar2_ls").enable();
                                                                    //cargar datos de la fecha
                                                                    $$("idCB_Datas_Planificadas_ls").getList().clearAll();
                                                                    $$("idCB_Datas_Planificadas_ls").getList().load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/readDatasPlanificadasXancpt?alAno=" + alAno +
                                                                        "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome);
                                                                    //cargar datos de la Hora
                                                                    $$("idCB_Horas_Planificadas_ls").getList().clearAll();
                                                                    $$("idCB_Horas_Planificadas_ls").getList().load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/readHorasPlanificadasXancpt?alAno=" + alAno +
                                                                        "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome);
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar nesta linha" });
                                                                }
                                                            }
                                                        },
                                                        {},
                                                    ]
                                                }, {
                                                    cols: [
                                                        {
                                                            view: "richselect", width: 120, id: "idCB_Datas_Planificadas_ls", disabled: true,
                                                            label: 'Data', name: "apeiData",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#apeiData#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/readDatasPlanificadasXancpt"
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "richselect", width: 120, id: "idCB_Horas_Planificadas_ls", disabled: true,
                                                            label: 'Hora', name: "apeiHora",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#apeiHora#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/readHorasPlanificadasXancpt"
                                                                }
                                                            }
                                                        },
                                                        //{ view: "datepicker", label: "Data", labelPosition: "top", name: "fData_Inicio", stringResult: true, width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                                                        //{ view: "datepicker", type: "time", format: "%H:%i:%s", id: "idTimeEntrada", label: 'Hora Entrada', labelPosition: "top", name: "taHoraInicio", width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                                                        {
                                                            view: "button", type: "standard", value: "Pesquisar", disabled: true, id: "btnCarregar2_ls", width: 100, click: function () {
                                                                var alAno = $$('idCBal_ls').getValue();
                                                                var nNome = $$('idCBn_ls').getValue();
                                                                var cNome = $$('idCBc_ls').getValue();
                                                                var pNome = $$('idCBp_ls').getValue();
                                                                var atcNome = $$('idCBt_ls').getValue();
                                                                var apeiData = $$('idCB_Datas_Planificadas_ls').getText();
                                                                var apeiHora = $$('idCB_Horas_Planificadas_ls').getText();

                                                                if (alAno && nNome && cNome && pNome && atcNome && apeiData && apeiHora) {
                                                                    //actualizar grid para imprimir listas apartir de los campos de busqueda
                                                                    $$("idDTEdPlanificacao_Listas_Salas_2S").clearAll();
                                                                    $$("idDTEdPlanificacao_Listas_Salas_2S").load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/read22?alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome + "&apeiData=" + apeiData + "&apeiHora=" + apeiHora);
                                                                    //Activar los botones de imprimir
                                                                    $$("btnImprimirListaXSala").enable();
                                                                    $$("btnImprimirCB").enable();
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar nesta linha" });
                                                                }
                                                            }
                                                        },
                                                        {}
                                                    ]
                                                },
                                                { height: 10 },
                                                {
                                                    cols: [
                                                        {
                                                            view: "button", type: "standard", value: "Imprimir", id: "btnImprimirListaXSala", disabled: true, width: 100, click: function () {
                                                                //criar PDF
                                                                var alAno = $$('idCBal_ls').getValue();
                                                                var nNome = $$('idCBn_ls').getValue();
                                                                var cNome = $$('idCBc_ls').getValue();
                                                                var pNome = $$('idCBp_ls').getValue();
                                                                var atcNome = $$('idCBt_ls').getValue();
                                                                var apeiData = $$('idCB_Datas_Planificadas_ls').getText();
                                                                var apeiHora = $$('idCB_Horas_Planificadas_ls').getText();

                                                                var envio = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome + "&apeiData=" + apeiData + "&apeiHora=" + apeiHora + "&utilizador=" + user_sessao;
                                                                if (nNome !== "" && cNome !== "" && pNome !== "" && alAno !== "" && atcNome !== "" && apeiData !== "" && apeiHora !== "") {
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Distribuicao_Candidatos_2S_IMP/imprimir", envio);
                                                                    if (r.responseText == "true") {
                                                                        webix.message("PDF criado com sucesso");
                                                                        //Carregar PDF
                                                                        webix.ui({
                                                                            view: "window",
                                                                            id: "idWinPDFDistribuicao_Candidatos",
                                                                            height: 600,
                                                                            width: 950,
                                                                            left: 50, top: 50,
                                                                            move: true,
                                                                            modal: true,
                                                                            //head:"This window can be moved",
                                                                            head: {
                                                                                view: "toolbar", cols: [
                                                                                    { view: "label", label: "Imprimir" },
                                                                                    { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFDistribuicao_Candidatos').close();" }
                                                                                ]
                                                                            },
                                                                            body: {
                                                                                //template:"Some text"
                                                                                template: '<div id="idPDFDistribuicao_Candidatos" style="width:940px;  height:590px"></div>'
                                                                            }
                                                                        }).show();
                                                                        PDFObject.embed("../../relatorios/Academica_Distribuicao_Candidatos_2S_IMP.pdf", "#idPDFDistribuicao_Candidatos");


                                                                    } else {
                                                                        webix.message({ type: "error", text: "Erro ao imprimir dados" });
                                                                    }
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                                }
                                                            }
                                                        },
                                                        {
                                                            view: "button", type: "standard", value: "Gerar Código de Barra", disabled: true, id: "btnImprimirCB", width: 160, click: function () {
                                                                //criar PDF
                                                                var alAno = $$('idCBal_ls').getValue();
                                                                var nNome = $$('idCBn_ls').getValue();
                                                                var cNome = $$('idCBc_ls').getValue();
                                                                var pNome = $$('idCBp_ls').getValue();
                                                                var atcNome = $$('idCBt_ls').getValue();
                                                                var apeiData = $$('idCB_Datas_Planificadas_ls').getText();
                                                                var apeiHora = $$('idCB_Horas_Planificadas_ls').getText();

                                                                var envio = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome + "&apeiData=" + apeiData + "&apeiHora=" + apeiHora + "&utilizador=" + user_sessao;
                                                                if (nNome !== "" && cNome !== "" && pNome !== "" && alAno !== "" && atcNome !== "" && apeiData !== "" && apeiHora !== "") {

                                                                    //retardar y cargar progressbar
                                                                    webix.extend($$("app"), webix.ProgressBar);
                                                                    function show_progress_bar(delay) {
                                                                        $$("app").disable();
                                                                        $$("app").showProgress({
                                                                            type: "top",
                                                                            delay: delay,
                                                                            hide: true
                                                                        });
                                                                        setTimeout(function () {

                                                                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Candidatos_Codigo_Barra_2S_IMP/imprimir", envio);
                                                                            if (r.responseText == "true") {
                                                                                webix.message("PDF criado com sucesso");
                                                                                //Carregar PDF
                                                                                webix.ui({
                                                                                    view: "window",
                                                                                    id: "idWinPDFCodigo_Barra_2s",
                                                                                    height: 600,
                                                                                    width: 950,
                                                                                    left: 50, top: 50,
                                                                                    move: true,
                                                                                    modal: true,
                                                                                    //head:"This window can be moved",
                                                                                    head: {
                                                                                        view: "toolbar", cols: [
                                                                                            { view: "label", label: "Imprimir" },
                                                                                            { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFCodigo_Barra_2s').close();" }
                                                                                        ]
                                                                                    },
                                                                                    body: {
                                                                                        //template:"Some text"
                                                                                        template: '<div id="idPDFCodigo_Barra" style="width:940px;  height:590px"></div>'
                                                                                    }
                                                                                }).show();
                                                                                PDFObject.embed("../../relatorios/Academica_Candidatos_Codigo_Barra_2S_IMP.pdf", "#idPDFCodigo_Barra");


                                                                            } else {
                                                                                webix.message({ type: "error", text: "Erro ao imprimir dados" });
                                                                            }

                                                                            $$("app").enable();
                                                                        }, delay);
                                                                    }

                                                                    //setTimeout(show_progress_bar(4000), 4000);
                                                                    show_progress_bar(100);

                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                                }
                                                            }
                                                        },
                                                        {}
                                                    ]

                                                }
                                            ]
                                        }
                                    ]
                                },
                                {
                                    view: "datatable",
                                    id: "idDTEdPlanificacao_Listas_Salas_2S",
                                    columns: [
                                        // { id: "id", header: "ID", css: "rank", width: 50 },
                                        { id: "orden", header: "Nº", css: "rank", width: 50, sort: "int" },
                                        { id: "alAno", header: "Ano Lec.", width: 70, sort: "int" },
                                        { id: "nNome", header: "N&iacute;vel", width: 140, sort: "string" },
                                        { id: "curso", header: "Curso", width: 300, sort: "string" },
                                        { id: "pNome", header: "Per&iacute;odo", width: 100, sort: "string" },
                                        { id: "atcNome", header: "Sala", width: 90, sort: "string" },
                                        { id: "apeiData", header: "Data", width: 97, sort: "string" },
                                        { id: "apeiHora", header: "Hora", width: 90, sort: "string" },
                                        { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cNomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cBI_Passaporte", header: ["BI/Passaporte", { content: "textFilter" }], width: 170, sort: "strig" },
                                    ],
                                    /*   on: {
                                           "onAfterFilter": function () {
                                               var nNome = this.getFilter("nNome").value;
                                               var cNome = this.getFilter("curso").value;
                                               var pNome = this.getFilter("pNome").value;
                                               var alAno = this.getFilter("alAno").value;
                                               var atcNome = this.getFilter("atcNome").value;
                                               var apeiData = this.getFilter("apeiData").value;
                                               var apeiHora = this.getFilter("apeiHora").value;
                                               if (nNome !== "" && cNome !== "" && pNome !== "" && alAno !== "" && atcNome !== "" && apeiData !== "" && apeiHora !== "") {
                                                   $$("btnImprimirCB").enable();
                                                   $$("btnImprimirListaXSala").enable();
                                               } else {
                                                   $$("btnImprimirCB").disable();
                                                   $$("btnImprimirListaXSala").disable();
                                               }
                                           }
                                       },
                                       */
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", //editable: true, editaction: "click",
                                    //save: BASE_URL + "cHorario_Funcionarios/crud",
                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Candidatos_2S/read22",
                                    pager: "pagerPlanificacao_Listas_Salas_2S"
                                }, {
                                    view: "pager", id: "pagerPlanificacao_Listas_Salas_2S",
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