function cargarVistaTurmas_Ingreso(itemID) {
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
                                            view: "richselect",
                                            label: 'Ano Lectivo',
                                            name: "alAno",
                                            id: "idalAno_s",
                                            width: 160,
                                            //value: ,
                                            options: {
                                                body: {
                                                    template: "#alAno#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CAnos_Lectivos/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    $$("idDTEdTurmas_Ingreso").clearAll();
                                                    $$("idDTEdTurmas_Ingreso").load(BASE_URL + "CAcademica_Turmas_Ingreso/read?al=" + this.getValue());
                                                }
                                            }
                                        },
                                        {
                                            view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                                //
                                                webix.ui({
                                                    view: "window",
                                                    id: "idwinADDSalas",
                                                    width: 500,
                                                    position: "center",
                                                    modal: true,
                                                    head: "Adicionar Tipo Aula",
                                                    body: webix.copy(formADDSalas)
                                                }).show();
                                                /*
                                                $$('idDTEdTurmas_Ingreso').add({
                                                    atcNome: "Sala X",
                                                    atcCodigo: "00",
                                                    atcCapacidade: 50,
                                                    atcLocalizacao: "Bloco X",
                                                    alAno: $$('idalAno_s').getValue()
                                                });
                                                setTimeout('', 3000);
                                                $$("idDTEdTurmas_Ingreso").clearAll();
                                                $$("idDTEdTurmas_Ingreso").load(BASE_URL + "CAcademica_Turmas_Ingreso/read?al=" + $$('idalAno_s').getValue());
                                                */
                                                // para obter ano lectivo actual
                                                //var envio = "ngNome=" + record.ngNome;
                                                var rng = webix.ajax().sync().get(BASE_URL + "CAnos_Lectivos/ano_lectivo_actual");
                                                $$("idcb_al_addsalas").setValue(rng.responseText);
                                                $$("idcb_al_addsalas").disable();
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
                                                $$("idDTEdTurmas_Ingreso").load(BASE_URL + "CAcademica_Turmas_Ingreso/read?al=" + $$('idalAno_s').getValue());
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
                                        { id: "ord", header: "No.", css: "rank", width: 50 },
                                        { id: "alAno", editor: "richselect", header: ["Ano Lectivo", { content: "textFilter" }], css: "rank", width: 100, template: "#alAno#", options: BASE_URL + "CAnos_Lectivos/read" },
                                        { id: "atcNome", editor: "text", header: ["Nome", { content: "textFilter" }], css: "rank", width: 200 },
                                        { id: "atcCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 100 },
                                        { id: "atcCapacidade", editor: "text", header: ["Capacidade", { content: "textFilter" }], css: "rank", width: 100 },
                                        //{ id: "atcData", editor: "date", header: "Data", css: "rank", width: 100 },
                                        //{id:"fBI_Provincia_Emissao",editor:"richselect",header:"BI Prov Emiss&atilde;o", width:140,template:"#provNome#",options:BASE_URL+"CProvincias/read"},
                                        { id: "atcLocalizacao", editor: "text", header: ["localiza&ccedil;&atilde;o", { content: "textFilter" }], css: "rank", width: 500 }
                                    ],
                                    resizeColumn: true,
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", //editable: true, editaction: "click",
                                    save: BASE_URL + "CAcademica_Turmas_Ingreso/crud",
                                    url: BASE_URL + "CAcademica_Turmas_Ingreso/read",
                                    pager: "pagerTurmas_Ingreso"
                                }, {
                                    view: "pager", id: "pagerTurmas_Ingreso",
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
                                            view: "combo", width: 80, id: "idCB_planificacao_al",
                                            label: 'Ano Lec.', name: "alAno",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#alAno#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CAnos_Lectivos/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                        $$("idCB_planificacao_t").getList().clearAll();
                                                        $$("idCB_planificacao_t").getList().load(BASE_URL + "CAcademica_Turmas_Ingreso/read?al=" + this.getValue());
        
                                                }
                                            }
                                        },
                                        {
                                            view: "combo", width: 130, id: "idCB_planificacao_n",
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
                                            view: "combo", width: 300, id: "idCB_planificacao_c",
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
                                            view: "combo", width: 130, id: "idCB_planificacao_p",
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
                                            view: "combo", width: 120, id: "idCB_planificacao_t",
                                            label: 'Sala', name: "atcNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#atcNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CAcademica_Turmas_Ingreso/read"
                                                }
                                            }
                                        },
                                        { view: "datepicker", label: "Data", labelPosition: "top", name: "apeiData", id: "idDate_planificacao_data", stringResult: true, width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                                        { view: "datepicker", type: "time", format: "%H:%i:%s", id: "idTime_planificacao_hora", label: 'Hora', labelPosition: "top", name: "apeiHora", width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                                        {}
                                    ]
                                },
                                {
                                    cols: [
                                        {
                                            view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                                var alAno = $$('idCB_planificacao_al').getValue();
                                                var nNome = $$('idCB_planificacao_n').getValue();
                                                var cNome = $$('idCB_planificacao_c').getValue();
                                                var pNome = $$('idCB_planificacao_p').getValue();
                                                var atcNome = $$('idCB_planificacao_t').getValue();
                                                var apeiData = $$('idDate_planificacao_data').getValue();
                                                var apeiHora = $$('idTime_planificacao_hora').getValue();
                                                if (alAno && nNome && cNome && pNome && atcNome && apeiData && apeiHora) {
                                                    $$('idDTEdPlanificacao_Ingreso').add({
                                                        alAno: alAno,
                                                        nNome: nNome,
                                                        cNome: cNome,
                                                        pNome: pNome,
                                                        atcNome: atcNome,
                                                        //atcLocalizacao : $$('idCB_planificacao_n').getValue(),
                                                        apeiData: apeiData,
                                                        apeiHora: apeiHora,
                                                    });
                                                    setTimeout('', 3000);
                                                    $$("idDTEdPlanificacao_Ingreso").clearAll();
                                                    $$("idDTEdPlanificacao_Ingreso").load(BASE_URL + "CAcademica_Planificacao_Exame_Ingreso/read");
                                                } else {
                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                }
                                                //limpiar componentes
                                                $$('idCB_planificacao_al').setValue('');
                                                $$('idCB_planificacao_n').setValue('');
                                                $$('idCB_planificacao_c').setValue('');
                                                $$('idCB_planificacao_p').setValue('');
                                                $$('idCB_planificacao_t').setValue('');
                                            }
                                        },
                                        {
                                            view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                                var id = $$('idDTEdPlanificacao_Ingreso').getSelectedId();
                                                if (id)
                                                    $$('idDTEdPlanificacao_Ingreso').remove(id);
                                            }
                                        },
                                        {
                                            view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                                $$("idDTEdPlanificacao_Ingreso").clearAll();
                                                $$("idDTEdPlanificacao_Ingreso").load(BASE_URL + "CAcademica_Planificacao_Exame_Ingreso/read");
                                                //
                                                $$("idCB_planificacao_t").getList().clearAll();
                                                $$("idCB_planificacao_t").getList().load(BASE_URL + "CAcademica_Turmas_Ingreso/read");
                                                //
                                                $$("idCB_planificacao_p").getList().clearAll();
                                                $$("idCB_planificacao_p").getList().load(BASE_URL + "CPeriodos/read");
                                                //
                                                $$("idCB_planificacao_c").getList().clearAll();
                                                $$("idCB_planificacao_c").getList().load(BASE_URL + "CCursos/read");
                                            }
                                        },
                                        {}
                                    ]
                                }, {
                                    cols: [
                                        {
                                            view: "richselect",
                                            label: 'Pesquisar por Ano Lectivo:',
                                            labelWidth: 190,
                                            name: "alAno",
                                            id: "idalAno_planif",
                                            width: 270,
                                            //value: ,
                                            options: {
                                                body: {
                                                    template: "#alAno#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CAnos_Lectivos/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    $$("idDTEdPlanificacao_Ingreso").clearAll();
                                                    $$("idDTEdPlanificacao_Ingreso").load(BASE_URL + "CAcademica_Planificacao_Exame_Ingreso/read?al=" + this.getValue());
                                                }
                                            }
                                        },
                                        {}
                                    ]
                                },
                                {
                                    view: "datatable",
                                    id: "idDTEdPlanificacao_Ingreso",
                                    // height: 300,
                                    columns: [
                                        { id: "orden", header: "Nº", css: "rank", width: 50 },
                                        { id: "id", header: "ID", hidden: true, css: "rank", width: 50 },

                                        { id: "alAno", editor: "richselect", header: "Ano Lectivo", css: "rank", width: 100, template: "#alAno#", options: BASE_URL + "CAnos_Lectivos/read" },
                                        { id: "nNome", editor: "text", header: "N&iacute;vel", css: "rank", width: 200 },
                                        { id: "cNome", editor: "text", header: "Curso", width: 200 },
                                        { id: "pNome", editor: "text", header: "Per&iacute;odo", css: "rank", width: 100 },
                                        { id: "atcNome", editor: "text", header: "Sala", css: "rank", width: 200 },
                                        // { id: "atcLocalizacao", editor: "text", header: "Localiza&ccedil;&atilde;o", css: "rank", width: 300 },
                                        { id: "apeiData", editor: "date", header: "Data", css: "rank", width: 100 },
                                        { id: "apeiHora", editor: "date", header: "Hora", css: "rank", width: 100 },
                                    ],
                                    resizeColumn: true,
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", //editable: true, editaction: "click",
                                    save: BASE_URL + "CAcademica_Planificacao_Exame_Ingreso/crud",
                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Ingreso/read",
                                    pager: "pagerPlanificacao_Ingreso"
                                }, {
                                    view: "pager", id: "pagerPlanificacao_Ingreso",
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

                                                                    $$("idDTEdPlanificacao_Exame_Candidatos").clearAll();
                                                                    $$("idDTEdPlanificacao_Exame_Candidatos").load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/read?al=" + this.getValue());
                                                                    //actualizar salas
                                                                    $$("idCBt").getList().clearAll();
                                                                    $$("idCBt").getList().load(BASE_URL + "CAcademica_Turmas_Ingreso/read?al=" + this.getValue());
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
                                                                    url: BASE_URL + "CAcademica_Turmas_Ingreso/read"
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
                                                                    $$("idCB_Datas_Planificadas").getList().load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/readDatasPlanificadasXancpt?alAno=" + alAno +
                                                                        "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome);
                                                                    //cargar datos de la Hora
                                                                    $$("idCB_Horas_Planificadas").getList().clearAll();
                                                                    $$("idCB_Horas_Planificadas").getList().load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/readHorasPlanificadasXancpt?alAno=" + alAno +
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
                                                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/readDatasPlanificadasXancpt"
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
                                                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/readHorasPlanificadasXancpt"
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
                                                                var apeiData = $$('idCB_Datas_Planificadas').getText();
                                                                var apeiHora = $$('idCB_Horas_Planificadas').getText();

                                                                if (alAno && nNome && cNome && pNome && atcNome && apeiData && apeiHora) {
                                                                    //cargar total de Candidatos
                                                                    var envio1 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/totalCandidatosXNiveisCursosPeriodo", envio1);
                                                                    var totalCandidatos = r.responseText;
                                                                    $$("idlabel_total_candidatos_valor").setValue(totalCandidatos);
                                                                    //cargar capacidade da turma
                                                                    var envio2 = "turma=" + atcNome;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Turmas_Ingreso/readCapacidadeTurma", envio2);
                                                                    var capacidadeTurma = r.responseText;
                                                                    $$("idlabel_capacidade_turma_valor").setValue(capacidadeTurma);

                                                                    //total de candidatos colocados dentro de la turma
                                                                    var envio3 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome + "&apeiData=" + apeiData + "&apeiHora=" + apeiHora;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/totalCandidatosColocadosXNiveisCursosPeriodo", envio3);
                                                                    var candidatosColocados = r.responseText;
                                                                    $$("idlabel_candidatos_colocados_valor").setValue(candidatosColocados);
                                                                    //total de candidatos nao colocados
                                                                    var envio4 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/totalCandidatosNaoColocadosGeral", envio4);
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
                                                                        var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/atrinuirCandidatosTurma", envio);
                                                                        //var totalCandidatos = r.responseText;
                                                                        if (r.responseText == "true") {
                                                                            $$("idDTEdPlanificacao_Exame_Candidatos").clearAll();
                                                                            $$("idDTEdPlanificacao_Exame_Candidatos").load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/read");
                                                                            //actualizar los labels
                                                                            //cargar total de Candidatos
                                                                            var envio1 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/totalCandidatosXNiveisCursosPeriodo", envio1);
                                                                            var totalCandidatos = r.responseText;
                                                                            $$("idlabel_total_candidatos_valor").setValue(totalCandidatos);
                                                                            //cargar capacidade da turma
                                                                            var envio2 = "turma=" + atcNome;
                                                                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Turmas_Ingreso/readCapacidadeTurma", envio2);
                                                                            var capacidadeTurma = r.responseText;
                                                                            $$("idlabel_capacidade_turma_valor").setValue(capacidadeTurma);

                                                                            //total de candidatos colocados dentro de la turma
                                                                            var envio3 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome + "&apeiData=" + apeiData + "&apeiHora=" + apeiHora;
                                                                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/totalCandidatosColocadosXNiveisCursosPeriodo", envio3);
                                                                            var candidatosColocados = r.responseText;
                                                                            $$("idlabel_candidatos_colocados_valor").setValue(candidatosColocados);
                                                                            //total de candidatos nao colocados
                                                                            var envio4 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/totalCandidatosNaoColocadosGeral", envio4);
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
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/totalCandidatosXNiveisCursosPeriodo", envio1);
                                                                    var totalCandidatos = r.responseText;
                                                                    $$("idlabel_total_candidatos_valor").setValue(totalCandidatos);
                                                                    //cargar capacidade da turma
                                                                    var envio2 = "turma=" + atcNome;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Turmas_Ingreso/readCapacidadeTurma", envio2);
                                                                    var capacidadeTurma = r.responseText;
                                                                    $$("idlabel_capacidade_turma_valor").setValue(capacidadeTurma);

                                                                    //total de candidatos colocados dentro de la turma
                                                                    var envio3 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome + "&apeiData=" + apeiData + "&apeiHora=" + apeiHora;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/totalCandidatosColocadosXNiveisCursosPeriodo", envio3);
                                                                    var candidatosColocados = r.responseText;
                                                                    $$("idlabel_candidatos_colocados_valor").setValue(candidatosColocados);
                                                                    //total de candidatos nao colocados
                                                                    var envio4 = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/totalCandidatosNaoColocadosGeral", envio4);
                                                                    var candidatos_nao_colocados = r.responseText;
                                                                    $$("idlabel_candidatos_nao_colocados_valor").setValue(candidatos_nao_colocados);

                                                                }
                                                                $$("idDTEdPlanificacao_Exame_Candidatos").clearAll();
                                                                $$("idDTEdPlanificacao_Exame_Candidatos").load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/read");
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
                                    id: "idDTEdPlanificacao_Exame_Candidatos",
                                    // height: 300,
                                    columns: [
                                        { id: "orden", header: "Nº", css: "rank", width: 50 },
                                        { id: "id", header: "ID", hidden: true, css: "rank", width: 50 },

                                        { id: "alAno", header: ["Ano Lectivo", { content: "selectFilter" }], css: "rank", width: 100 },
                                        { id: "nNome", header: ["N&iacute;vel", { content: "selectFilter" }], css: "rank", width: 200 },
                                        { id: "cNome", header: ["Curso", { content: "selectFilter" }], width: 300 },
                                        { id: "pNome", header: ["Per&iacute;odo", { content: "selectFilter" }], css: "rank", width: 100 },
                                        { id: "atcNome", header: ["Sala", { content: "selectFilter" }], css: "rank", width: 200 },
                                        // { id: "atcLocalizacao", editor: "text", header: "Localiza&ccedil;&atilde;o", css: "rank", width: 300 },
                                        { id: "apeiData", header: ["Data", { content: "textFilter" }], css: "rank", width: 100 },
                                        { id: "apeiHora", header: ["Hora", { content: "textFilter" }], css: "rank", width: 100 },
                                        { id: "totalCandidatos", header: ["Q.Cand.", { content: "textFilter" }], css: "rank", width: 100 },
                                    ],
                                    resizeColumn: true,
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", //editable: true, editaction: "click",
                                    //save: BASE_URL + "CAcademica_Planificacao_Exame_Ingreso/crud",
                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/read",
                                    pager: "pagerPlanificacao_Exame_Candidatos"
                                }, {
                                    view: "pager", id: "pagerPlanificacao_Exame_Candidatos",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 25,
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
                                                                    //actualizar salas
                                                                    $$("idCBt_ls").getList().clearAll();
                                                                    $$("idCBt_ls").getList().load(BASE_URL + "CAcademica_Turmas_Ingreso/read?al=" + this.getValue());
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
                                                                    url: BASE_URL + "CAcademica_Turmas_Ingreso/read"
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
                                                                    $$("idCB_Datas_Planificadas_ls").getList().load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/readDatasPlanificadasXancpt?alAno=" + alAno +
                                                                        "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome);
                                                                    //cargar datos de la Hora
                                                                    $$("idCB_Horas_Planificadas_ls").getList().clearAll();
                                                                    $$("idCB_Horas_Planificadas_ls").getList().load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/readHorasPlanificadasXancpt?alAno=" + alAno +
                                                                        "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome);
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar nesta linha" });
                                                                }
                                                            }
                                                        },
                                                        {},
                                                    ]
                                                },
                                                {
                                                    cols: [
                                                        {
                                                            view: "richselect", width: 120, id: "idCB_Datas_Planificadas_ls", disabled: true,
                                                            label: 'Data', name: "apeiData",
                                                            labelPosition: "top",
                                                            options: {
                                                                body: {
                                                                    template: "#apeiData#",
                                                                    yCount: 7,
                                                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/readDatasPlanificadasXancpt"
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
                                                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/readHorasPlanificadasXancpt"
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
                                                                    $$("idDTEdPlanificacao_Listas_Salas").clearAll();
                                                                    $$("idDTEdPlanificacao_Listas_Salas").load(BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/read22?alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&atcNome=" + atcNome + "&apeiData=" + apeiData + "&apeiHora=" + apeiHora);
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
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Distribuicao_Candidatos_IMP/imprimir", envio);
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
                                                                        PDFObject.embed("../../relatorios/Academica_Distribuicao_Candidatos_IMP.pdf", "#idPDFDistribuicao_Candidatos");


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

                                                                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Candidatos_Codigo_Barra_IMP/imprimir", envio);
                                                                            if (r.responseText == "true") {
                                                                                webix.message("PDF criado com sucesso");
                                                                                //Carregar PDF
                                                                                webix.ui({
                                                                                    view: "window",
                                                                                    id: "idWinPDFCodigo_Barra",
                                                                                    height: 600,
                                                                                    width: 950,
                                                                                    left: 50, top: 50,
                                                                                    move: true,
                                                                                    modal: true,
                                                                                    //head:"This window can be moved",
                                                                                    head: {
                                                                                        view: "toolbar", cols: [
                                                                                            { view: "label", label: "Imprimir" },
                                                                                            { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFCodigo_Barra').close();" }
                                                                                        ]
                                                                                    },
                                                                                    body: {
                                                                                        //template:"Some text"
                                                                                        template: '<div id="idPDFCodigo_Barra" style="width:940px;  height:590px"></div>'
                                                                                    }
                                                                                }).show();
                                                                                PDFObject.embed("../../relatorios/Academica_Candidatos_Codigo_Barra_IMP.pdf", "#idPDFCodigo_Barra");


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
                                    id: "idDTEdPlanificacao_Listas_Salas",
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
                                    resizeColumn: true,
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
                                    url: BASE_URL + "CAcademica_Planificacao_Exame_Candidatos/read22",
                                    pager: "pagerPlanificacao_Listas_Salas"
                                }, {
                                    view: "pager", id: "pagerPlanificacao_Listas_Salas",
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
//Adicionar Salas
var formADDSalas = {
    view: "form",
    id: "idformADDSalas",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "atcNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "atcCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "counter", label: 'Capacidade', name: "atcCapacidade", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'localização', name: "atcLocalizacao", validate: "isNotEmpty", validateEvent: "blur" },
                {
                    view: "combo", width: 300,
                    label: 'Ano Lectivo', name: "alAno",
                    id: "idcb_al_addsalas",
                    options: {
                        body: {
                            template: "#alAno#",
                            yCount: 7,
                            url: BASE_URL + "canos_lectivos/read"
                        }
                    }
                },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var atcNome = $$("idformADDSalas").getValues().atcNome;
                        var atcCodigo = $$("idformADDSalas").getValues().atcCodigo;
                        var atcCapacidade = $$("idformADDSalas").getValues().atcCapacidade;
                        var atcLocalizacao = $$("idformADDSalas").getValues().atcLocalizacao;
                        var alAno = $$("idformADDSalas").getValues().alAno;
                        if (atcNome && atcCodigo && !isNaN(atcCapacidade) && atcLocalizacao && alAno) { //validate form
                            $$('idDTEdTurmas_Ingreso').add({
                                atcNome:  atcNome,
                                atcCodigo: atcCodigo,
                                atcCapacidade: atcCapacidade,
                                atcLocalizacao: atcLocalizacao,
                                alAno: alAno
                            });
                            webix.message("Dados inseridos com sucesso");
                            $$("idDTEdTurmas_Ingreso").clearAll();
                            $$("idDTEdTurmas_Ingreso").load(BASE_URL + "CAcademica_Turmas_Ingreso/read?al=" + $$('idalAno_s').getValue());
                            $$('idwinADDSalas').close();
                        }
                        else
                            webix.message({ type: "error", text: "Erro ao inserir dados" });
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDSalas").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};