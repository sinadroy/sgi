function cargarVistaMatricula_Distribuicao_Turmas(itemID) {
    function Nota_css(value) {
        if (value == "Reprovado")
            return "vermelho_css";
        else
            return "verde_css"
    }
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Estudantes e Turmas ", body: {
                    //id:"Niveis de Acessos",
                    id: "idMatricula_Distribuicao_Turmas",
                    rows: [
                        {
                            //view:"flexlayout",
                            type: "line",
                            responsive: "idMatricula_Distribuicao_Turmas",
                            rows: [
                                {
                                    cols: [
                                        {
                                            rows: [
                                                {
                                                    view: "richselect", width: 300, id: "idMDT_CB_nNome",
                                                    label: 'Nivel', name: "nNome",
                                                    labelPosition: "top",
                                                    options: {
                                                        body: {
                                                            template: "#nNome#",
                                                            yCount: 7,
                                                            url: BASE_URL + "cNiveis/read"
                                                        }
                                                    },
                                                },
                                                {
                                                    view: "richselect", width: 300, id: "idMDT_CB_cNome",
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
                                                    view: "richselect", width: 300, id: "idMDT_CB_pNome",
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
                                                    view: "button", type: "form", value: "Perquisar", width: 120, click: function () {
                                                        //var idSelecionado = $$("idDTEdHorarios").getSelectedId(false,true);
                                                        var nNome = $$("idMDT_CB_nNome").getValue();
                                                        var cNome = $$("idMDT_CB_cNome").getValue();
                                                        var pNome = $$("idMDT_CB_pNome").getValue();
                                                        if (nNome && cNome && pNome) {
                                                            $$("idDTEdMatricula_Distribuicao_Turmas").clearAll();
                                                            $$("idDTEdMatricula_Distribuicao_Turmas").load(BASE_URL + "CAcademica_Matricula/readXancp?nNome=" + nNome +
                                                                "&cNome=" + cNome +
                                                                "&pNome=" + pNome);
                                                        }

                                                        //Actualizar combo turma
                                                        $$("idCBt").getList().clearAll();
                                                        $$("idCBt").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + nNome +
                                                                "&cNome=" + cNome +
                                                                "&pNome=" + pNome);
                                                    }
                                                },
                                            ]
                                        },
                                        {},
                                        {
                                            rows: [
                                                {},
                                                {
                                                    view: "button", type: "standard", value: "Atribuir", width: 120, click: function () {

                                                    }
                                                }
                                            ]
                                        },
                                        {},
                                        {
                                            rows: [
                                                {},
                                                {
                                                    view: "richselect", width: 120, id: "idCBt",
                                                    label: 'Turma', name: "tNome",
                                                    labelPosition: "top",
                                                    options: {
                                                        body: {
                                                            template: "#tNome#",
                                                            yCount: 7,
                                                            url: BASE_URL + "CTurmas/readXncp"
                                                        }
                                                    }
                                                },
                                                {
                                                    view: "button", type: "form", value: "Perquisar", width: 120, click: function () {
                                                        //var idSelecionado = $$("idDTEdHorarios").getSelectedId(false,true);
                                                        var nNome = $$("idLI_CB_nNome_lci").getValue();
                                                        var cNome = $$("idLI_CB_cNome_lci").getValue();
                                                        var pNome = $$("idLI_CB_pNome_lci").getValue();
                                                        if (nNome && cNome && pNome) {
                                                            $$("idDTInscricao").clearAll();
                                                            $$("idDTInscricao").load(BASE_URL + "cCandidatos/readDInscricaoXncp?nNome=" + nNome +
                                                                "&cNome=" + cNome +
                                                                "&pNome=" + pNome);
                                                        }

                                                    }
                                                },
                                            ]
                                        }
                                    ]
                                },
                                {
                                    cols: [
                                        {
                                            rows: [
                                                {
                                                    view: "datatable",
                                                    id: "idDTEdMatricula_Distribuicao_Turmas",
                                                    columns: [
                                                        { id: "cid", header: "cid", hidden: true, css: "rank", width: 50, sort: "int" },
                                                        { id: "sel", header: ["Selec.", { content: "masterCheckbox" }], checkValue: 'on', uncheckValue: 'off', template: "{common.checkbox()}", width: 50 },
                                                        { id: "orden", header: "Nº", css: "rank", width: 50, sort: "int" },
                                                        { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                                        //{ id: "cNomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                                        { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                                        { id: "cBI_Passaporte", header: ["cBI_Passaporte", { content: "textFilter" }], width: 170, sort: "string" },
                                                    ],
                                                    select: "row", //editable: true, editaction: "click",
                                                    //save: BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso/crud",
                                                    url: BASE_URL + "CAcademica_Matricula/readXancp",
                                                    pager: "pagerMatricula_Distribuicao_Turmas"
                                                }, {
                                                    view: "pager", id: "pagerMatricula_Distribuicao_Turmas",
                                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                                    size: 25,
                                                    group: 10
                                                }
                                            ]
                                        },
                                        {
                                            rows: [
                                                {
                                                    view: "datatable",
                                                    id: "idDTEdMatricula_Distribuicao_Turmas2",
                                                    columns: [
                                                        { id: "cid", header: "cid", hidden: true, css: "rank", width: 50, sort: "int" },
                                                        { id: "orden", header: "Nº", css: "rank", width: 50, sort: "int" },
                                                        { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                                        //{ id: "cNomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                                        { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                                        { id: "cBI_Passaporte", header: ["cBI_Passaporte", { content: "textFilter" }], width: 170, sort: "string" },
                                                    ],
                                                    select: "row", //editable: true, editaction: "click",
                                                    //save: BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso/crud",
                                                    url: BASE_URL + "CAcademica_Matricula/readXancp",
                                                    pager: "pagerMatricula_Distribuicao_Turmas"
                                                }, {
                                                    view: "pager", id: "pagerMatricula_Distribuicao_Turmas",
                                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                                    size: 25,
                                                    group: 10
                                                }
                                            ]
                                        }
                                    ]
                                },

                            ]
                        },
                    ]
                }
            }
        ]
    });

}

function formFoto_M(CODIGO_FOTO) {
    var formADDFoto = {
        view: "form",
        id: "idformADDFoto",
        height: 550,
        borderless: true,
        elements: [{
            rows: [
                {
                    cols: [
                        {},
                        { view: "template", width: 480, template: '<div id="my_camera">' + '<img src=' + PRO_URL + 'Fotos/Candidatos/' + CODIGO_FOTO + '.jpg /></div>' },
                        {}
                    ]
                },
                {
                    cols: [
                        {
                            view: "button", value: "Activar Camera", type: "standard", click: function () {
                                Webcam.set({
                                    width: 480,
                                    height: 390,
                                    image_format: 'jpeg',
                                    jpeg_quality: 100
                                });
                                Webcam.attach('#my_camera');
                            }
                        },
                        {
                            view: "button", value: "Captura/Salvar", type: "form", click: function () {
                                //var idSelecionado = $$("idDTEdMatricula").getSelectedId(false, true);
                                var rowId = $$("idDTEdMatricula").getSelectedId(false, true);
                                var record = $$("idDTEdMatricula").getItem(rowId);
                                var idSelecionado = record.cid;

                                Webcam.snap(function (data_uri) {
                                    // display results in page
                                    document.getElementById('my_camera').innerHTML = '<img src="' + data_uri + '"/>';
                                    Webcam.upload(data_uri, BASE_URL + 'cCandidatos/salvarFoto?id=' + idSelecionado, function (code, text) {
                                        if (text !== "true") {
                                            webix.message({ type: "error", text: "Deve selecionar primeriro um Candidato" });
                                        } else {
                                            webix.message({ text: "Foto guardada com sucesso" });
                                        }

                                    });
                                });
                            }
                        },
                        {
                            view: "button", value: "Fechar", name: "fechar", type: "danger", click: function () {
                                //Webcam.off('set');
                                Webcam.reset();
                                //cargar foto
                                //var idSelecionado = $$("idDTEdMatricula").getSelectedId(false, true);
                                var rowId = $$("idDTEdMatricula").getSelectedId(false, true);
                                var record = $$("idDTEdMatricula").getItem(rowId);
                                var idSelecionado = record.cid;

                                var envio = "id=" + idSelecionado;
                                var r = webix.ajax().sync().post(BASE_URL + "cCandidatos/cargarFoto", envio);
                                var CODIGO_FOTO = r.responseText;
                                if (CODIGO_FOTO) {
                                    // idform_DP_superior_grid
                                    $$("idform_DP_superior_grid_M").removeView("id_template_foto_M");
                                    $$("idform_DP_superior_grid_M").addView({ view: "template", id: "id_template_foto_M", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Candidatos/' + CODIGO_FOTO + '.jpg /></div>' }, 2);
                                } else {
                                    $$("idform_DP_superior_grid_M").removeView("id_template_foto_M");
                                    $$("idform_DP_superior_grid_M").addView({ view: "template", id: "id_template_foto_M", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Candidatos/default.jpg /></div>' }, 2);
                                }

                                $$("idwinADDFotoCandidatos_M").close();
                            }
                        }
                    ]
                }

            ]
        }]
    };
    return formADDFoto;
}
