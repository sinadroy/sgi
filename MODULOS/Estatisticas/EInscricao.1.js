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
                    view: "form", scroll: false,
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
                                    view: "richselect", width: 200, id: "id_CB_nNome_einsc",
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
                                                $$("id_CB_cNome_einsc").getList().clearAll();
                                                $$("id_CB_cNome_einsc").getList().load(BASE_URL + "Ccursos/readXn?nNome=" + n);
                                            }
                                        }
                                    }
                                },
                                {
                                    view: "richselect", width: 500, id: "id_CB_cNome_einsc",
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
                                {}
                            ]

                        },
                        {
                            //view: "form",
                            cols: [
                                {
                                    view: "richselect", width: 125, id: "id_CB_pNome_einsc",
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
                                    view: "richselect", width: 100, id: "id_CB_acNome_einsc",
                                    label: 'Ano Curricular', name: "acNome",
                                    labelPosition: "top",
                                    options: {
                                        body: {
                                            template: "#acNome#",
                                            yCount: 7,
                                            url: BASE_URL + "CAno_Curricular/read"
                                        }
                                    }, on: {
                                        "onChange": function (newv, oldv) {
                                            
                                        }
                                    }
                                },
                                {
                                    view: "button", type: "form", value: "Actualizar", width: 100, click: function () {
                                        var al = $$('id_CB_alAno_einsc').getText();
                                        var n = $$('id_CB_nNome_einsc').getText();
                                        var c = $$('id_CB_cNome_einsc').getText();
                                        var p = $$('id_CB_pNome_einsc').getText();
                                        var ac = $$('id_CB_acNome_einsc').getText();

                                        $$("chartEstXCurso").clearAll();
                                        $$("chartEstXCurso").load(BASE_URL + "CCursos/Get_total_X_curso_estadistica?al=" + al +
                                            "&n=" + n +
                                            "&c=" + c +
                                            "&p=" + p +
                                            "&ac=" + ac);
                                    }
                                },
                                {}
                            ]
                        },
                        {
                            cols: [
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
                                        title: "Candidatos por curso",
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
                                {
                                    rows: [
                                        {
                                            css: "image",
                                            view: "chart",
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
                                        }, {
                                            template: "<div style='width:100%;text-align:center'>Estudantes por periodo</div>",
                                            height: 30
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            cols: [
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
                                        title: "Candidatos por Provincia",
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
                                {
                                    rows: [
                                        {
                                            css: "image",
                                            view: "chart",
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
                                        }, {
                                            template: "<div style='width:100%;text-align:center'>Estudantes por Sexo</div>",
                                            height: 30
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            }
        ]
    });
}