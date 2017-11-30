function cargarVistaListas_Resultados_Exame_Acesso_2S(itemID) {
    function Nota_css(value) {
        if (value == "Não Admitido")
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
                header: "Listas Resultados Exame 2º Sess&atilde;o", body: {
                    //id:"Niveis de Acessos",
                    id: "idListas_Resultados_Exame_Acesso_2S",
                    rows: [
                        {
                            //view:"flexlayout",
                            type: "line",
                            responsive: "idListas_Resultados_Exame_Acesso_2S",
                            rows: [
                                {
                                    view: "toolbar", elements: [
                                        {
                                            rows: [
                                                {
                                                    cols: [
                                                        {
                                                            view: "richselect", width: 80, id: "idCBal_LR_2S",
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
                                                            view: "richselect", width: 130, id: "idCBn_LR_2S",
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
                                                            view: "richselect", width: 300, id: "idCBc_LR_2S",
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
                                                            view: "richselect", width: 130, id: "idCBp_LR_2S",
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
                                                            view: "button", type: "form", value: "Pesquisar", disabled: false, id: "btnCarregar2_ls_2S", width: 100, click: function () {
                                                                var alAno = $$('idCBal_LR_2S').getValue();
                                                                var nNome = $$('idCBn_LR_2S').getValue();
                                                                var cNome = $$('idCBc_LR_2S').getValue();
                                                                var pNome = $$('idCBp_LR_2S').getValue();

                                                                if (alAno && nNome && cNome && pNome) {
                                                                    //actualizar grid para imprimir listas apartir de los campos de busqueda
                                                                    $$("idDTEdListas_Resultados_Exame_2S").clearAll();
                                                                    $$("idDTEdListas_Resultados_Exame_2S").load(BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso_2S/readX?alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome);
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                                }
                                                            }
                                                        }, {
                                                            view: "button", type: "standard", value: "Imprimir", disabled: false, id: "btnImprimir2_ls", width: 100, click: function () {
                                                                var alAno = $$('idCBal_LR_2S').getValue();
                                                                var nNome = $$('idCBn_LR_2S').getValue();
                                                                var cNome = $$('idCBc_LR_2S').getValue();
                                                                var pNome = $$('idCBp_LR_2S').getValue();

                                                                if (alAno && nNome && cNome && pNome) {
                                                                    webix.ui({
                                                                        view: "window",
                                                                        id: "id_win_tipo_doc_imprimir_2S",
                                                                        width: 400,
                                                                        position: "center",
                                                                        modal: true,
                                                                        head: "Lista Resultados Exame de Acesso",
                                                                        body: webix.copy(formTipoDocImprimir_2S)
                                                                    }).show();
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                                }

                                                            }
                                                        },
                                                        {
                                                            view: "button", type: "danger", label: "Exportar Dados", width: 120, click: function () {
                                                                //webix.toExcel($$("idDTEdMatricula"));
                                                                var f = new Date();
                                                                var data = f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear();
                                                                var hora = f.getHours() + "-" + f.getMinutes() + "-" + f.getSeconds();
                                                                webix.cdn = PRO_URL + "webix";
                                                                webix.toExcel($$("idDTEdListas_Resultados_Exame_2S"), {
                                                                    filterHTML: true,
                                                                    filename: "Lista_Resultados_2s_" + data + "_" + hora,
                                                                    name: "Resultados 2s",
                                                                    columns: {
                                                                        "orden": { header: "Nº", width: 50 },
                                                                        "cNome": { header: "Nome", width: 170 },
                                                                        "cNomes": { header: "Nomes", width: 170 },
                                                                        "cApelido": { header: "Apelido", width: 170 },
                                                                        "Nome Completo": {
                                                                            header: "Nome Completo", width: 350,
                                                                            template: function (obj) {
                                                                                return obj.cNome + " " + obj.cNomes + " " + obj.cApelido;
                                                                            }
                                                                        },
                                                                        "cBI_Passaporte": { header: "BI Passaporte", width: 170 },
                                                                        "provNome": { header: "Provincia Formação", width: 170 },
                                                                        "apecNota": { header: "Nota", width: 70 },
                                                                        //"condicionadoExcel": { header: "Condicionado", width: 100 },
                                                                        "estado": {
                                                                            header: "Estado",
                                                                            template: function (obj) {
                                                                                var nNome = $$('idCBn_LR_2S').getValue();
                                                                                var cNome = $$('idCBc_LR_2S').getValue();
                                                                                var pNome = $$('idCBp_LR_2S').getValue();
                                                                                var envio = "nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                                var r = webix.ajax().sync().post(BASE_URL + "CNiveisCursos/read_nota_minima_2s", envio);
                                                                                if (parseFloat(obj.apecNota) >= parseFloat(r.responseText))
                                                                                    return "Admitido";
                                                                                else
                                                                                    return "Não Admitido";
                                                                            },
                                                                            width: 140, sort: "string", //css:{"color":"#B51454"}
                                                                            cssFormat: Nota_css
                                                                        },
                                                                    }
                                                                });
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
                                    id: "idDTEdListas_Resultados_Exame_2S",
                                    columns: [
                                        { id: "orden", header: "Nº", css: "rank", width: 50, sort: "int" },
                                        { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cNomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cBI_Passaporte", header: ["cBI_Passaporte", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "provNome", header: ["Provincia Forma&ccedil;&atilde;o ", { content: "selectFilter" }], width: 170, sort: "string" },
                                        {
                                            id: "apecNota", editor: "text", header: "Nota", width: 70, sort: "int", format: webix.Number.numToStr({
                                                groupDelimiter: ",",
                                                groupSize: 2,
                                                decimalDelimiter: ",",
                                                decimalSize: 2
                                            })
                                        },
                                        /*{
                                            id: "estado", header: ["Estado", { content: "selectFilter" }],
                                            template: function (obj) { if (obj.apecNota >= 10) return "Aprovado"; else return "Reprovado"; },
                                            width: 170, sort: "string", //css:{"color":"#B51454"}
                                            cssFormat: Nota_css
                                        },*/
                                        {
                                            id: "estado", header: ["Estado", { content: "textFilter" }],
                                            template: function (obj) {
                                                var nNome = $$('idCBn_LR_2S').getValue();
                                                var cNome = $$('idCBc_LR_2S').getValue();
                                                var pNome = $$('idCBp_LR_2S').getValue();
                                                var envio = "nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                var r = webix.ajax().sync().post(BASE_URL + "CNiveisCursos/read_nota_minima_2s", envio);
                                                if (parseFloat(obj.apecNota) >= parseFloat(r.responseText))
                                                    return "Admitido";
                                                else
                                                    return "Não Admitido";
                                            },
                                            width: 140, sort: "string", //css:{"color":"#B51454"}
                                            cssFormat: Nota_css
                                        },
                                        { id: "apecCodigoBarra", header: "apecCodigoBarra", hidden: true, css: "rank", width: 50 },
                                    ],
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", editable: true, editaction: "click",
                                    save: BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso_2S/crud",
                                    url: BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso_2S/readX",
                                    pager: "pagerListas_Resultados_Exame_2S"
                                }, {
                                    view: "pager", id: "pagerListas_Resultados_Exame_2S",
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
var formTipoDocImprimir_2S = {
    view: "form",
    id: "idformTipoDocImprimir_2S",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "select", value: 2, label: "Grupo Resultado", id: "idCombo_tipo_doc_2S", options: [
                        { value: "Aprovados", id: 1 },
                        { value: "Reprovados", id: 2 },
                        { value: "Todos", id: 3 }
                    ]
                },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        //criar PDF
                        var alAno = $$('idCBal_LR_2S').getValue();
                        var nNome = $$('idCBn_LR_2S').getValue();
                        var cNome = $$('idCBc_LR_2S').getValue();
                        var pNome = $$('idCBp_LR_2S').getValue();
                        var tipo_doc = $$('idCombo_tipo_doc_2S').getValue();

                        var envio = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&utilizador=" + user_sessao + "&tipo_doc=" + tipo_doc;
                        if (nNome !== "" && cNome !== "" && pNome !== "" && alAno !== "") {
                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso_IMP_2S/imprimir", envio);
                            if (r.responseText == "true") {
                                webix.message("PDF criado com sucesso");
                                //Carregar PDF
                                webix.ui({
                                    view: "window",
                                    id: "idWinPDFListas_Resultados_2S",
                                    height: 600,
                                    width: 950,
                                    left: 50, top: 50,
                                    move: true,
                                    modal: true,
                                    //head:"This window can be moved",
                                    head: {
                                        view: "toolbar", cols: [
                                            { view: "label", label: "Imprimir" },
                                            { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFListas_Resultados_2S').close();" }
                                        ]
                                    },
                                    body: {
                                        //template:"Some text"
                                        template: '<div id="idPDFListas_Resultados_2S" style="width:940px;  height:590px"></div>'
                                    }
                                }).show();
                                PDFObject.embed("../../relatorios/Academica_Listas_Resultados_Exame_Acesso_IMP_2S.pdf", "#idPDFListas_Resultados_2S");
                                //fechar janela
                                $$("id_win_tipo_doc_imprimir_2S").close()
                            } else {
                                webix.message({ type: "error", text: "Erro ao imprimir dados" });
                            }
                        } else {
                            webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                        }

                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("id_win_tipo_doc_imprimir_2S").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};