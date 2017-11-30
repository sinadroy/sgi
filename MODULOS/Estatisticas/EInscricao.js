function cargarVistaEInscricao(itemID) {
    //var f = new Date();
    //f.getDate() + "/" + (f.getMonth() + 1) + "/" + f.getFullYear()

    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Estat&iacute;sticas Inscri&ccedil;&atilde;o", body: {
                    view: "form", scroll: true,
                    rows: [
                        {
                            cols: [
                                {
                                    view: "richselect", width: 80, id: "id_CB_alAno_einsc",
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
                                    view: "button", type: "form", value: "Actualizar", width: 100, click: function () {
                                        var al = $$('id_CB_alAno_einsc').getText();

                                        $$("chartEstXCurso").clearAll();
                                        $$("chartEstXCurso").load(BASE_URL + "CCursos/Get_total_X_curso_estadistica?al=" + al);
                                        $$("idchart_est_periodo").clearAll();
                                        $$("idchart_est_periodo").load(BASE_URL + "CPeriodos/Get_total_X_periodo_estadistica?al=" + al);

                                    }
                                },
                                {}
                            ]
                        },
                        {
                            //view: "form", scroll: false,
                            cols: [
                                {
                                    rows: [
                                        {
                                            template: "<div style='width:100%;text-align:center'>Candidatos por curso</div>",
                                            height: 55
                                        },

                                        {
                                            css: "image",
                                            id: "chartEstXCurso",
                                            view: "chart",
                                            //width:600px;height:250px;
                                            width: 700,
                                            //autowidth: true,
                                            height: 250,
                                            type: "bar",
                                            value: "#quantidade#",
                                            label: "#quantidade#",
                                            color: "#color#",
                                            radius: 0,
                                            barWidth: 40,
                                            tooltip: {
                                                template: "#quantidade#"
                                            },
                                            xAxis: {
                                                //title: "Candidatos por curso",
                                                template: "'#codigo#",
                                                lines: true
                                            },
                                            padding: {
                                                left: 10,
                                                right: 10,
                                                top: 50
                                            },
                                            //data: dataset_colors
                                            url: BASE_URL + "CCursos/Get_total_X_curso_estadistica",
                                        },
                                    ]
                                },
                                {
                                    rows: [
                                        {
                                            template: "<div style='width:100%;text-align:center'>Estudantes por periodo</div>",
                                            height: 55
                                        },
                                        {
                                            css: "image",
                                            view: "chart",
                                            id: "idchart_est_periodo",
                                            type: "pie",
                                            autowidth: true,
                                            //borderless:true,
                                            border: true,
                                            value: "#quantidade#",
                                            color: "#color#",
                                            label: "#periodo#",
                                            pieInnerText: "#quantidade#",
                                            shadow: 0,
                                            //data: month_dataset
                                            url: BASE_URL + "CPeriodos/Get_total_X_periodo_estadistica",
                                        }
                                    ]
                                }
                            ]

                        },

                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    cols: [
                                        {
                                            view: "richselect", width: 80, id: "id_CB_alAno_egen",
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
                                            view: "richselect", width: 200, id: "id_CB_nNome_egen",
                                            label: 'Nivel', name: "nNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#nNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cNiveis/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    var n = this.getValue();

                                                    if (n) {
                                                        $$("id_CB_cNome_egen").getList().clearAll();
                                                        $$("id_CB_cNome_egen").getList().load(BASE_URL + "Ccursos/readXn?nNome=" + n);
                                                    }
                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 500, id: "id_CB_cNome_egen",
                                            label: 'Curso', name: "cNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#cNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cCursos/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {

                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 125, id: "id_CB_pNome_egen",
                                            label: 'Periodo', name: "pNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#pNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cPeriodos/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {

                                                }
                                            }
                                        },
                                        {
                                            view: "button", type: "form", value: "Actualizar", width: 100, click: function () {
                                                var al = $$('id_CB_alAno_egen').getText();
                                                var n = $$('id_CB_nNome_egen').getValue();
                                                var c = $$('id_CB_cNome_egen').getValue();
                                                var p = $$('id_CB_pNome_egen').getValue();

                                                $$("id_chart_est_sexo").clearAll();
                                                $$("id_chart_est_sexo").load(BASE_URL + "cgeneros/estudantes_x_sexo?al=" + al +
                                                    "&n=" + n +
                                                    "&c=" + c +
                                                    "&p=" + p);

                                                $$("chartEstXef").clearAll();
                                                $$("chartEstXef").load(BASE_URL + "Cestatisticas/estudantes_x_ef?al=" + al +
                                                    "&n=" + n +
                                                    "&c=" + c +
                                                    "&p=" + p);
                                            }
                                        },
                                        {}
                                    ]
                                },

                                {
                                    cols: [
                                        {
                                            rows: [
                                                {
                                                    template: "<div style='width:100%;text-align:center'>Candidatos por Escola de Formação</div>",
                                                    height: 30
                                                },
                                                {
                                                    css: "image",
                                                    id: "chartEstXef",
                                                    view: "chart",
                                                    //width:600px;height:250px;
                                                    width: 700,
                                                    //autowidth: true,
                                                    height: 250,
                                                    type: "bar",
                                                    value: "#quantidade#",
                                                    label: "#quantidade#",
                                                    color: "#color#",
                                                    radius: 0,
                                                    barWidth: 40,
                                                    tooltip: {
                                                        template: "#quantidade#"
                                                    },
                                                    xAxis: {
                                                        //title: "Candidatos por Escola de Formação",
                                                        template: "'#efCodigoNome#",
                                                        lines: true
                                                    },
                                                    padding: {
                                                        left: 10,
                                                        right: 10,
                                                        top: 50
                                                    },
                                                    //data: dataset_colors
                                                    url: BASE_URL + "Cestatisticas/estudantes_x_ef",
                                                },
                                            ]
                                        },
                                        {
                                            rows: [
                                                {
                                                    template: "<div style='width:100%;text-align:center'>Estudantes por Sexo</div>",
                                                    height: 30
                                                },
                                                {
                                                    css: "image",
                                                    view: "chart",
                                                    id: "id_chart_est_sexo",
                                                    type: "pie",
                                                    autowidth: true,
                                                    //borderless:true,
                                                    border: true,
                                                    value: "#quantidade#",
                                                    color: "#color#",
                                                    label: "#sexo#",
                                                    pieInnerText: "#quantidade#",
                                                    shadow: 0,
                                                    //data: month_dataset
                                                    url: BASE_URL + "cgeneros/estudantes_x_sexo",
                                                }
                                            ]
                                        }
                                    ]
                                }
                            ]
                        },

                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    cols: [
                                        {
                                            view: "richselect", width: 80, id: "id_CB_alAno_epf",
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
                                            view: "richselect", width: 200, id: "id_CB_nNome_epf",
                                            label: 'Nivel', name: "nNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#nNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cNiveis/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    var n = this.getValue();

                                                    if (n) {
                                                        $$("id_CB_cNome_epf").getList().clearAll();
                                                        $$("id_CB_cNome_epf").getList().load(BASE_URL + "Ccursos/readXn?nNome=" + n);
                                                    }
                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 500, id: "id_CB_cNome_epf",
                                            label: 'Curso', name: "cNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#cNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cCursos/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {

                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 125, id: "id_CB_pNome_epf",
                                            label: 'Periodo', name: "pNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#pNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cPeriodos/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {

                                                }
                                            }
                                        },
                                        {
                                            view: "button", type: "form", value: "Actualizar", width: 100, click: function () {
                                                var al = $$('id_CB_alAno_epf').getText();
                                                var n = $$('id_CB_nNome_epf').getValue();
                                                var c = $$('id_CB_cNome_epf').getValue();
                                                var p = $$('id_CB_pNome_epf').getValue();

                                                $$("chartEstXpf").clearAll();
                                                $$("chartEstXpf").load(BASE_URL + "Cestatisticas/estudantes_x_pf?al=" + al +
                                                    "&n=" + n +
                                                    "&c=" + c +
                                                    "&p=" + p);
                                            }
                                        },
                                        {}
                                    ]
                                },

                                {
                                    cols: [
                                        {
                                            rows: [
                                                {
                                                    template: "<div style='width:100%;text-align:center'>Candidatos por Provincia de Formação</div>",
                                                    height: 30
                                                },
                                                {
                                                    css: "image",
                                                    id: "chartEstXpf",
                                                    view: "chart",
                                                    //width:600px;height:250px;
                                                    //width: 700,
                                                    autowidth: true,
                                                    //autoheight: true,
                                                    height: 350,
                                                    type: "bar",
                                                    value: "#quantidade#",
                                                    label: "#quantidade#",
                                                    color: "#color#",
                                                    radius: 0,
                                                    barWidth: 30,
                                                    tooltip: {
                                                        template: "#quantidade#"
                                                    },
                                                    xAxis: {
                                                        //title: "Candidatos por Provincia de Formação",
                                                        template: "<div style='writing-mode: vertical-lr; transform: rotate(180deg);'><h4> #provCodigoNome# </h4></div>",
                                                        lines: true
                                                    },
                                                    padding: {
                                                        left: 10,
                                                        right: 10,
                                                        top: 50,
                                                        button: 200
                                                    },
                                                    //data: dataset_colors
                                                    url: BASE_URL + "Cestatisticas/estudantes_x_pf",
                                                }
                                            ]
                                        }
                                    ]
                                }
                            ]
                        },

                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    cols: [
                                        {
                                            view: "richselect", width: 80, id: "id_CB_alAno_epi",
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
                                            view: "richselect", width: 200, id: "id_CB_nNome_epi",
                                            label: 'Nivel', name: "nNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#nNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cNiveis/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    var n = this.getValue();

                                                    if (n) {
                                                        $$("id_CB_cNome_epi").getList().clearAll();
                                                        $$("id_CB_cNome_epi").getList().load(BASE_URL + "Ccursos/readXn?nNome=" + n);
                                                    }
                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 500, id: "id_CB_cNome_epi",
                                            label: 'Curso', name: "cNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#cNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cCursos/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {

                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 125, id: "id_CB_pNome_epi",
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
                                        {
                                            view: "button", type: "form", value: "Pesquisar", width: 100, click: function () {
                                                var al = $$('id_CB_alAno_epi').getText();
                                                var n = $$('id_CB_nNome_epi').getValue();
                                                var c = $$('id_CB_cNome_epi').getValue();
                                                var p = $$('id_CB_pNome_epi').getValue();

                                                $$("idDTEdidades").clearAll();
                                                $$("idDTEdidades").load(BASE_URL + "Cestatisticas/read_ii?al=" + al + "&n=" + n+"&c="+c+"&p="+p);
                                            }
                                        },
                                        {}
                                    ]
                                },
                                {
                                    view: "datatable",
                                    height: 300,
                                    id: "idDTEdidades",
                                    columns: [
                                        { id: "ord", header: "Nº", css: "rank", width: 100, sort: "int" },
                                        { id: "ii", header: ["Interv. Idade", { content: "selectFilter" }], width: 250, sort: "string" },
                                        { id: "total", header: ["Total", { content: "textFilter" }], width: 400, sort: "string" },

                                    ],
                                    resizeColumn: true,
                                    select: "row", //editable: true, editaction: "click",
                                    //save: BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso/crud",
                                    url: BASE_URL + "cestatisticas/read_ii",
                                    pager: "pagerii"
                                }, {
                                    view: "pager", id: "pagerii",
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