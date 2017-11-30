function cargarVistaInscricao_2_sessao(itemID) {
    function Estado_css(value) {
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
                header: "Atribui&ccedil;&atilde;o Segunda Sess&atilde;o", body: {
                    //id:"Niveis de Acessos",
                    id: "idInscricao_2_sessao",
                    rows: [
                        {
                            //view:"flexlayout",
                            type: "line",
                            responsive: "idInscricao_2_sessao",
                            rows: [
                                {
                                    view: "toolbar", elements: [
                                        {
                                            rows: [
                                                {
                                                    cols: [
                                                        {
                                                            view: "richselect", width: 80, id: "idCBal_I2S1",
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
                                                            view: "richselect", width: 130, id: "idCBn_I2S",
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
                                                            view: "richselect", width: 300, id: "idCBc_I2S",
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
                                                            view: "richselect", width: 110, id: "idCBp_I2S",
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
                                                            view: "text", width: 100, id: "idNota_Minima",
                                                            label: 'Nota M&iacute;nima', name: "Nota_Minima",
                                                            //type: 'password',
                                                            labelWidth: 100,
                                                            labelPosition: "top",
                                                        },
                                                        { view: "label", width: 30, label: '<' },
                                                        {
                                                            view: "text", width: 150, disabled: true, id: "idNota_Minima_Actual",
                                                            label: 'Nota M&iacute;nima Actual', name: "Nota_Minima_Actual",
                                                            //type: 'password',
                                                            labelWidth: 150,
                                                            labelPosition: "top",
                                                        },

                                                        //{ view: "datepicker", label: "Data", labelPosition: "top", name: "fData_Inicio", stringResult: true, width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                                                        //{ view: "datepicker", type: "time", format: "%H:%i:%s", id: "idTimeEntrada", label: 'Hora Entrada', labelPosition: "top", name: "taHoraInicio", width: 120, validate: "isNotEmpty", validateEvent: "blur" },
                                                        {
                                                            view: "button", type: "form", value: "Pesquisar", disabled: false, id: "btnCarregar2_I2S", width: 100, click: function () {
                                                                var alAno = $$('idCBal_I2S1').getValue();
                                                                var nNome = $$('idCBn_I2S').getValue();
                                                                var cNome = $$('idCBc_I2S').getValue();
                                                                var pNome = $$('idCBp_I2S').getValue();
                                                                var Nota_Minima = $$('idNota_Minima').getValue();
                                                                //cargar nota Minima Actual
                                                                var envio = "nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                                var r = webix.ajax().sync().post(BASE_URL + "CNiveisCursos/read_nota_minima", envio);
                                                                $$('idNota_Minima_Actual').setValue(r.responseText);

                                                                if (alAno && nNome && cNome && pNome && Nota_Minima) {
                                                                    //actualizar grid para imprimir listas apartir de los campos de busqueda
                                                                    $$("idDTEdInscricao_2_sessao").clearAll();
                                                                    $$("idDTEdInscricao_2_sessao").load(BASE_URL + "CAcademica_Inscricao_2_sessao/readX?alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&Nota_Minima=" + Nota_Minima);
                                                                    $$('btnAtribuir_I2S').enable();
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                                }
                                                            }
                                                        },
                                                    ]
                                                },
                                                {
                                                    cols: [
                                                        {
                                                            view: "button", type: "danger", value: "Atribuir", disabled: true, id: "btnAtribuir_I2S", width: 100, click: function () {
                                                                var alAno = $$('idCBal_I2S1').getValue();
                                                                var nNome = $$('idCBn_I2S').getValue();
                                                                var cNome = $$('idCBc_I2S').getValue();
                                                                var pNome = $$('idCBp_I2S').getValue();
                                                                var Nota_Minima = $$('idNota_Minima').getValue();

                                                                if (alAno && nNome && cNome && pNome && Nota_Minima) {
                                                                    var envio = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&Nota_Minima=" + Nota_Minima;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Inscricao_2_sessao/atribuir", envio);
                                                                    if (r.responseText == "true") {
                                                                        webix.message("Dados atribuidos com sucesso");
                                                                        $$("idDTEdInscricao_2_sessao").clearAll();
                                                                        $$("idDTEdInscricao_2_sessao").load(BASE_URL + "CAcademica_Inscricao_2_sessao/readX?alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&Nota_Minima=" + Nota_Minima);
                                                                    } else {
                                                                        webix.message({ type: "error", text: "Erro ao atribuir" });
                                                                    }
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                                }
                                                                this.disable();
                                                            }
                                                        },
                                                        {
                                                            view: "button", type: "standard", label: "Exportar Dados", width: 120, click: function () {
                                                                //webix.toExcel($$("idDTEdMatricula"));
                                                                var al = $$('idCBal_I2S1').getValue();
                                                                var nNome = $$('idCBn_I2S').getValue();
                                                                var cNome = $$('idCBc_I2S').getValue();
                                                                var pNome = $$('idCBp_I2S').getValue();
                                                                var nota_minima = $$('idNota_Minima').getValue();

                                                                if (al && nNome && cNome && pNome && nota_minima) {
                                                                    var f = new Date();
                                                                    var data = f.getDate() + "-" + (f.getMonth() + 1) + "-" + f.getFullYear();
                                                                    var hora = f.getHours() + "-" + f.getMinutes() + "-" + f.getSeconds();
                                                                    webix.cdn = PRO_URL + "webix";
                                                                    webix.toExcel($$("idDTEdInscricao_2_sessao"), {
                                                                        filterHTML: true,
                                                                        filename: "I2s" + al + "_" + cNome + "_" + pNome + "_" + nota_minima + "_" + data + "_" + hora,
                                                                        name: "I2s_" + cNome + ">" + nota_minima,
                                                                        /*columns: {
        
                                                                        }*/
                                                                    });
                                                                }else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                                }
                                                            }
                                                        },
                                                    ]
                                                }

                                            ]
                                        }
                                    ]
                                },
                                {
                                    view: "datatable",
                                    id: "idDTEdInscricao_2_sessao",
                                    columns: [
                                        { id: "orden", header: "Nº", css: "rank", width: 50, sort: "int" },
                                        { id: "cSessao", header: ["Sessão", { content: "textFilter" }], css: "rank", width: 80 },
                                        { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cNomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cBI_Passaporte", header: ["cBI_Passaporte", { content: "textFilter" }], width: 170, sort: "string" },
                                        {
                                            id: "apecNota", editor: "text", header: "Nota", width: 170, sort: "int", format: webix.Number.numToStr({
                                                groupDelimiter: ",",
                                                groupSize: 2,
                                                decimalDelimiter: ",",
                                                decimalSize: 2
                                            })
                                        },
                                        { id: "condicionado", hidden: true, header: ["Condicionado", { content: "masterCheckbox" }], checkValue: 'on', uncheckValue: 'off', template: "{common.checkbox()}", width: 100 },
                                        { id: "condicionadoExcel", header: "Condicionado", width: 100, sort: "string" },
                                        {
                                            id: "estado", header: ["Estado", { content: "textFilter" }],
                                            template: function (obj) {
                                                var nNome = $$('idCBn_I2S').getValue();
                                                var cNome = $$('idCBc_I2S').getValue();
                                                var pNome = $$('idCBp_I2S').getValue();
                                                var envio = "nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome;
                                                var r = webix.ajax().sync().post(BASE_URL + "CNiveisCursos/read_nota_minima", envio);
                                                if (parseFloat(obj.apecNota) >= parseFloat(r.responseText) || obj.condicionadoExcel == "Sim")
                                                    return "Admitido";
                                                else
                                                    return "Não Admitido";
                                            },
                                            width: 140, sort: "string", //css:{"color":"#B51454"}
                                            cssFormat: Estado_css
                                        },
                                        { id: "apecCodigoBarra", header: "apecCodigoBarra", hidden: true, css: "rank", width: 50 },
                                        
                                    ],
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", //editable: true, editaction: "click",
                                    //save: BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso/crud",
                                    url: BASE_URL + "CAcademica_Inscricao_2_sessao/readX",
                                    pager: "pagerInscricao_2_sessao"
                                }, {
                                    view: "pager", id: "pagerInscricao_2_sessao",
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
                header: "Listas Segunda Sess&atilde;o", body: {
                    //id:"Niveis de Acessos",
                    id: "idListas_Inscricao_2_sessao",
                    rows: [
                        {
                            //view:"flexlayout",
                            type: "line",
                            responsive: "idListas_Inscricao_2_sessao",
                            rows: [
                                {
                                    view: "toolbar", elements: [
                                        {
                                            rows: [
                                                {
                                                    cols: [
                                                        {
                                                            view: "richselect", width: 80, id: "idCBal_LI2S",
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
                                                            view: "richselect", width: 130, id: "idCBn_LI2S",
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
                                                            view: "richselect", width: 300, id: "idCBc_LI2S",
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
                                                            view: "richselect", width: 110, id: "idCBp_LI2S",
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
                                                            view: "button", type: "form", value: "Pesquisar", disabled: false, id: "btnCarregar2_LI2S", width: 100, click: function () {
                                                                var alAno = $$('idCBal_LI2S').getValue();
                                                                var nNome = $$('idCBn_LI2S').getValue();
                                                                var cNome = $$('idCBc_LI2S').getValue();
                                                                var pNome = $$('idCBp_LI2S').getValue();
                                                                //var Nota_Minima = $$('idNota_Minima').getValue();

                                                                if (alAno && nNome && cNome && pNome) {
                                                                    //actualizar grid para imprimir listas apartir de los campos de busqueda
                                                                    $$("idDTEdListas_Inscricao_2_sessao").clearAll();
                                                                    $$("idDTEdListas_Inscricao_2_sessao").load(BASE_URL + "CAcademica_Inscricao_2_sessao/readXatribuidos?alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome);
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                                }
                                                            }
                                                        }, {
                                                            view: "button", type: "standard", value: "Imprimir", disabled: false, id: "btnImprimir2_LI2S", width: 100, click: function () {
                                                                var alAno = $$('idCBal_LI2S').getValue();
                                                                var nNome = $$('idCBn_LI2S').getValue();
                                                                var cNome = $$('idCBc_LI2S').getValue();
                                                                var pNome = $$('idCBp_LI2S').getValue();

                                                                if (alAno && nNome && cNome && pNome) {
                                                                    var envio = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&utilizador=" + user_sessao;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Inscricao_2_sessao_IMP/imprimir", envio);
                                                                    if (r.responseText == "true") {
                                                                        webix.message("PDF criado com sucesso");
                                                                        //Carregar PDF
                                                                        webix.ui({
                                                                            view: "window",
                                                                            id: "idWinPDFListas_Resultados",
                                                                            height: 600,
                                                                            width: 950,
                                                                            left: 50, top: 50,
                                                                            move: true,
                                                                            modal: true,
                                                                            //head:"This window can be moved",
                                                                            head: {
                                                                                view: "toolbar", cols: [
                                                                                    { view: "label", label: "Imprimir" },
                                                                                    { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFListas_Resultados').close();" }
                                                                                ]
                                                                            },
                                                                            body: {
                                                                                //template:"Some text"
                                                                                template: '<div id="idPDFListas_Resultados" style="width:940px;  height:590px"></div>'
                                                                            }
                                                                        }).show();
                                                                        PDFObject.embed("../../relatorios/Academica_Inscricao_2_sessao_IMP.pdf", "#idPDFListas_Resultados");
                                                                    } else {
                                                                        webix.message({ type: "error", text: "Erro ao imprimir dados" });
                                                                    }
                                                                } else {
                                                                    webix.message({ type: "error", text: "Faltam campos por seleccionar" });
                                                                }

                                                            }
                                                        }, {
                                                            view: "button", type: "form", value: "Comprovativo", width: 120, height: 50, click: function () {
                                                                //criar PDF
                                                                var idSelecionado = $$("idDTEdListas_Inscricao_2_sessao").getSelectedId(false, true);
                                                                if (idSelecionado) {
                                                                    //PREPATAT DATA E HORA
                                                                    var d = new Date();
                                                                    var dataActual = d.getFullYear() + "" + (d.getMonth() + 1) + "" + d.getDate();
                                                                    var horaActual = d.getHours() + "" + d.getMinutes() + "" + d.getSeconds();

                                                                    var envio = "id=" + idSelecionado + "&data=" + dataActual + "&hora=" + horaActual + "&utilizadores_id=" + user_sessao;
                                                                    var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Inscricao_2S_Comprovativo_IMP/imprimir", envio);
                                                                    if (r.responseText == "true") {
                                                                        webix.message("PDF criado com sucesso");
                                                                        //Carregar PDF
                                                                        webix.ui({
                                                                            view: "window",
                                                                            id: "idWinPDFCP_Comprobativo",
                                                                            height: 600,
                                                                            width: 700,
                                                                            left: 50, top: 50,
                                                                            move: true,
                                                                            modal: true,
                                                                            //head:"This window can be moved",
                                                                            head: {
                                                                                view: "toolbar", cols: [
                                                                                    { view: "label", label: "Comprovativo de Inscri&ccedil;&atilde;o" },
                                                                                    { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFCP_Comprobativo').close(); } }
                                                                                ]
                                                                            },
                                                                            body: {
                                                                                //template:"Some text"
                                                                                template: '<div id="idPDFCP_Comprobativo" style="width:690px;  height:590px"></div>'
                                                                            }
                                                                        }).show();
                                                                        PDFObject.embed("../../relatorios/Financas_Pagamentos_Inscricao_2S_Comprovativo_IMP.pdf", "#idPDFCP_Comprobativo");


                                                                    } else {
                                                                        webix.message({ type: "error", text: "Erro atualizando dados" });
                                                                    }

                                                                } else {
                                                                    webix.message({ type: "error", text: "Deve selecionar um Candidato" });
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
                                    id: "idDTEdListas_Inscricao_2_sessao",
                                    columns: [
                                        { id: "orden", header: "Nº", css: "rank", width: 50, sort: "int" },
                                        {
                                            id: "cEstado", header: ["Estado", { content: "selectFilter" }], width: 170, sort: "string",
                                            template: function (obj) {
                                                if (obj.cEstado == "Espera de Pagamento")
                                                    return "<span style='color:red;'>" + obj.cEstado + "</span>";
                                                else
                                                    return "<span style='color:green;'>" + obj.cEstado + "</span>";

                                            },
                                        },
                                        { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cNomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cBI_Passaporte", header: ["cBI_Passaporte", { content: "textFilter" }], width: 170, sort: "string" },
                                        {
                                            id: "apecNota", editor: "text", header: "Nota 1º Sessão", width: 120, format: webix.Number.numToStr({
                                                groupDelimiter: ",",
                                                groupSize: 2,
                                                decimalDelimiter: ",",
                                                decimalSize: 2
                                            })
                                        },
                                       /* {
                                            id: "estado", header: "Estado 1º Sessão",
                                            template: function (obj) { if (obj.apecNota >= 10) return "Aprovado"; else return "Reprovado"; },
                                            width: 170, sort: "string", //css:{"color":"#B51454"}
                                            cssFormat: Estado_css
                                        }, */
                                        { id: "apecCodigoBarra", header: "apecCodigoBarra", hidden: true, css: "rank", width: 50 },
                                        { id: "cSessao", header: "Sess&atilde;o", css: "rank", width: 70 },
                                    ],
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", //editable: true, editaction: "click",
                                    //save: BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso/crud",
                                    url: BASE_URL + "CAcademica_Inscricao_2_sessao/readXatribuidos",
                                    pager: "pagerListas_Inscricao_2_sessao"
                                }, {
                                    view: "pager", id: "pagerListas_Inscricao_2_sessao",
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
var formTipoDocImprimir = {
    view: "form",
    id: "idformTipoDocImprimir",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "select", value: 2, label: "Grupo Resultado", id: "idCombo_tipo_doc", options: [
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
                        var alAno = $$('idCBal_LR').getValue();
                        var nNome = $$('idCBn_LR').getValue();
                        var cNome = $$('idCBc_LR').getValue();
                        var pNome = $$('idCBp_LR').getValue();
                        var tipo_doc = $$('idCombo_tipo_doc').getValue();

                        var envio = "alAno=" + alAno + "&nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&utilizador=" + user_sessao + "&tipo_doc=" + tipo_doc;
                        if (nNome !== "" && cNome !== "" && pNome !== "" && alAno !== "") {
                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso_IMP/imprimir", envio);
                            if (r.responseText == "true") {
                                webix.message("PDF criado com sucesso");
                                //Carregar PDF
                                webix.ui({
                                    view: "window",
                                    id: "idWinPDFListas_Resultados",
                                    height: 600,
                                    width: 950,
                                    left: 50, top: 50,
                                    move: true,
                                    modal: true,
                                    //head:"This window can be moved",
                                    head: {
                                        view: "toolbar", cols: [
                                            { view: "label", label: "Imprimir" },
                                            { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFListas_Resultados').close();" }
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