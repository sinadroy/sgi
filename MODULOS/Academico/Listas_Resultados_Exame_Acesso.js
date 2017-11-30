function cargarVistaListas_Resultados_Exame_Acesso(itemID) {
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
                header: "Listas Resultados Exame", body: {
                    //id:"Niveis de Acessos",
                    id: "idListas_Resultados_Exame_Acesso",
                    rows: [
                        {
                            //view:"flexlayout",
                            type: "line",
                            responsive: "idListas_Resultados_Exame_Acesso",
                            rows: [
                                {
                                    view: "toolbar", elements: [
                                        {
                                            rows: [
                                                {
                                                    cols: [
                                                        {
                                                            view: "richselect", width: 80, id: "idCBal_LR",
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
                                                            view: "richselect", width: 130, id: "idCBn_LR",
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
                                                            view: "richselect", width: 300, id: "idCBc_LR",
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
                                                            view: "richselect", width: 130, id: "idCBp_LR",
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
                                                            view: "button", type: "form", value: "Pesquisar", disabled: false, id: "btnCarregar2_ls", width: 100, click: function () {
                                                                var alAno = $$('idCBal_LR').getValue();
                                                                var nNome = $$('idCBn_LR').getValue();
                                                                var cNome = $$('idCBc_LR').getValue();
                                                                var pNome = $$('idCBp_LR').getValue();

                                                                if (alAno && nNome && cNome && pNome) {
                                                                    //actualizar grid para imprimir listas apartir de los campos de busqueda
                                                                    $$("idDTEdListas_Resultados_Exame").clearAll();
                                                                    $$("idDTEdListas_Resultados_Exame").load(BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso/readX?alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome);
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                                }
                                                            }
                                                        }, {
                                                            view: "button", type: "standard", value: "Imprimir", disabled: false, id: "btnImprimir2_ls", width: 100, click: function () {
                                                                var alAno = $$('idCBal_LR').getValue();
                                                                var nNome = $$('idCBn_LR').getValue();
                                                                var cNome = $$('idCBc_LR').getValue();
                                                                var pNome = $$('idCBp_LR').getValue();

                                                                if (alAno && nNome && cNome && pNome) {
                                                                    webix.ui({
                                                                        view: "window",
                                                                        id: "id_win_tipo_doc_imprimir",
                                                                        width: 400,
                                                                        position: "center",
                                                                        modal: true,
                                                                        head: "Lista Resultados Exame de Acesso",
                                                                        body: webix.copy(formTipoDocImprimir1)
                                                                    }).show();
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                                }

                                                            }
                                                        },
                                                        {
                                                            view: "button", type: "form", label: "Exportar Dados", width: 120, click: function () {
                                                                //webix.toExcel($$("idDTEdMatricula"));
                                                                var f = new Date();
                                                                var data = f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear();
                                                                var hora = f.getHours() + "-" + f.getMinutes() + "-" + f.getSeconds();
                                                                webix.cdn = PRO_URL + "webix";
                                                                webix.toExcel($$("idDTEdListas_Resultados_Exame"), {
                                                                    filterHTML: true,
                                                                    filename: "Lista_Resultados_" + data + "_" + hora,
                                                                    name: "Resultados",
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
                                                                        "condicionadoExcel": { header: "Condicionado", width: 100 },
                                                                        "estado": {
                                                                            header: "Estado",
                                                                            template: function (obj) {
                                                                                var nNome = $$('idCBn_LR').getValue();
                                                                                var cNome = $$('idCBc_LR').getValue();
                                                                                var pNome = $$('idCBp_LR').getValue();
                                                                                var envio = "nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                                var r = webix.ajax().sync().post(BASE_URL + "CNiveisCursos/read_nota_minima", envio);
                                                                                if (parseInt(obj.apecNota) >= parseInt(r.responseText) || obj.condicionadoExcel == "Sim")
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
                                    id: "idDTEdListas_Resultados_Exame",
                                    columns: [
                                        { id: "orden", header: "Nº", css: "rank", width: 50, sort: "int" },
                                        { id: "apecid", header: "apecid", hidden: true, width: 50, sort: "int" },
                                        { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cNomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cBI_Passaporte", header: ["cBI_Passaporte", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "provNome", header: ["Provincia Formação", { content: "selectFilter" }], width: 170, sort: "string" },
                                        {
                                            id: "apecNota", editor: "text", header: "Nota", width: 70, sort: "int", format: webix.Number.numToStr({
                                                groupDelimiter: ",",
                                                groupSize: 2,
                                                decimalDelimiter: ",",
                                                decimalSize: 2
                                            })
                                        },
                                        //new
                                        { id: "condicionado", header: ["Condicionado", { content: "masterCheckbox" }], checkValue: 'on', uncheckValue: 'off', template: "{common.checkbox()}", width: 100 },
                                        { id: "condicionadoExcel", header: "Condicionado", hidden: true, width: 100 },
                                        {
                                            id: "estado", header: ["Estado", { content: "textFilter" }],
                                            template: function (obj) {
                                                var nNome = $$('idCBn_LR').getValue();
                                                var cNome = $$('idCBc_LR').getValue();
                                                var pNome = $$('idCBp_LR').getValue();
                                                var envio = "nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                var r = webix.ajax().sync().post(BASE_URL + "CNiveisCursos/read_nota_minima", envio);
                                                if (parseFloat(obj.apecNota) >= parseFloat(r.responseText) || obj.condicionado == "on")
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
                                    save: BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso/crud",
                                    url: BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso/readX",
                                    pager: "pagerListas_Resultados_Exame"
                                }, {
                                    view: "pager", id: "pagerListas_Resultados_Exame",
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
var formTipoDocImprimir1 = {
    view: "form",
    id: "idformTipoDocImprimir",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "counter", label: "Idade M&iacute;nima", name: "idade_minima", value: 0, id: "id_idade_minima", validate: "isNumber", validateEvent: "key" },
                { view: "counter", label: "Idade M&aacute;xima", name: "idade_maxima", value: 100, id: "id_idade_maxima", validate: "isNumber", validateEvent: "key" },
                { view: "richselect", label: 'Provincia Forma&ccedil;&atilde;o', name: "provNome", id: "idFormacao_provNome_lrea1", options: { body: { template: "#provNome#", yCount: 10, url: BASE_URL + "CProvincias/read" } } },
                {
                    view: "select", value: 2, label: "Grupo Resultado", id: "idCombo_tipo_doc1", options: [
                        { value: "Admitidos", id: 1 },
                        { value: "Não Admitidos", id: 2 },
                        { value: "Todos", id: 3 }
                    ]
                },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        //criar PDF
                        var alAno = $$('idCBal_LR').getValue();
                        var nNome = $$('idCBn_LR').getValue();
                        var cNome = $$('idCBc_LR').getValue();
                        var pNome = $$('idCBp_LR').getValue();
                        var tipo_doc = $$('idCombo_tipo_doc1').getValue();

                        var provFormacao = $$("idFormacao_provNome_lrea1").getValue();
                        var idade_minima = $$("id_idade_minima").getValue();
                        var idade_maxima = $$("id_idade_maxima").getValue();

                        if (idade_minima < idade_maxima && isNaN(idade_minima) == false && isNaN(idade_maxima) == false) {
                            var envio = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&utilizador=" + user_sessao +
                                "&tipo_doc=" + tipo_doc + "&provFormacao=" + provFormacao + "&idade_minima=" + idade_minima + "&idade_maxima=" + idade_maxima;
                            if (nNome !== "" && cNome !== "" && pNome !== "" && alAno !== "") {
                                var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso_IMP/imprimir", envio);
                                if (r.responseText == "true") {
                                    webix.message("PDF criado com sucesso");
                                    //Carregar PDF
                                    webix.ui({
                                        view: "window",
                                        id: "idWinPDFListas_Resultados_1S",
                                        height: 600,
                                        width: 950,
                                        left: 50, top: 50,
                                        move: true,
                                        modal: true,
                                        //head:"This window can be moved",
                                        head: {
                                            view: "toolbar", cols: [
                                                { view: "label", label: "Imprimir" },
                                                { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFListas_Resultados_1S').close();" }
                                            ]
                                        },
                                        body: {
                                            //template:"Some text"
                                            template: '<div id="idPDFListas_Resultados" style="width:940px;  height:590px"></div>'
                                        }
                                    }).show();
                                    PDFObject.embed("../../relatorios/Academica_Listas_Resultados_Exame_Acesso_IMP.pdf", "#idPDFListas_Resultados");
                                    //fechar janela
                                    $$("id_win_tipo_doc_imprimir").close()
                                } else {
                                    webix.message({ type: "error", text: "Erro ao imprimir dados" });
                                }
                            } else {
                                webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                            }
                        } else {
                            webix.message({ type: "error", text: "Erro nas idades" });
                        }
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("id_win_tipo_doc_imprimir").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};