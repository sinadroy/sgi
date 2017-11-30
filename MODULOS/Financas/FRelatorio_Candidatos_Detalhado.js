function cargarVistaFRelatorio_Candidatos_Detalhado(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Pagamentos Detalhados", body: {

                    rows: [
                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    cols: [
                                        {
                                            view: "button", type: "standard", value: "Actualizar", width: 120, height: 50, click: function () {
                                                $$("idDTInscricao_Relatorios_Detalhado").clearAll();
                                                $$("idDTInscricao_Relatorios_Detalhado").load(BASE_URL + "CFinancas_Pagamentos_Candidatos_Detalhado/read");
                                            }
                                        },
                                        {}
                                    ]
                                }
                            ]

                        }, {
                            view: "datatable",
                            id: "idDTInscricao_Relatorios_Detalhado",
                            select: "row", /*editable: true, editaction: "click",*/
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", width: 60, sort: "int" },
                                { id: "fpcData", header: ["Data", { content: "textFilter" }], width: 90, sort: "string" },
                                { id: "fpcHora", header: ["Hora", { content: "textFilter" }], width: 70, sort: "string" },

                                { id: "cNome", header:"Nome Candidato", width: 120, sort: "string" },
                                { id: "cApelido", header:"Apelido Cand.", width: 120, sort: "string" },
                                { id: "cBI_Passaporte", header: ["BI/Passaporte",{ content: "textFilter" }], width: 120, sort: "string" },

                                { id: "ftpNome", header: ["Tipo Pag.", { content: "selectFilter" }], width: 110, sort: "string" },
                                { id: "bancNome", header: ["Banco", { content: "selectFilter" }], width: 80, sort: "string" },
                                { id: "contNome", header:"Nome Conta", width: 170, sort: "string" },
                                { id: "contNumero", header: ["N&uacute;mero Conta", { content: "textFilter" }], width: 130, sort: "string" },
                                { id: "ffpNome", header: ["Forma Pag.", { content: "textFilter" }], width: 90, sort: "string" },
                                { id: "fpcRefPagamento", header:"Referência Pag.", width: 115, sort: "strig" },
                                { id: "fpcValor", header:"Valor (kz)", width: 90, sort: "int" },

                                { id: "uNome", header:"Nome Func.", width: 120, sort: "string" },
                                { id: "cApelido", header:"Apelido Func.", width: 120, sort: "string" },
                                { id: "uUsuario", header:"Utilizador", width: 120, sort: "string" },
                            ],
                            url: BASE_URL + "CFinancas_Pagamentos_Candidatos_Detalhado/read",
                            pager: "pagerCDadosInscricao_Relatorios_Detalhado"
                        }, {
                            view: "pager", id: "pagerCDadosInscricao_Relatorios_Detalhado",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }
                    ]
                }
            },

        ]
    });
}
/*
//Pagamento de Inscricao
var formADDPagamentoInscricao = {
    view: "form",
    id: "idformADDPagamentoInscricao",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "datatable",
                    height: 300,
                    id: "idDTFormPagamentoInscricao",
                    select: "row",
                    columns: [
                        { id: "id", header: "", css: "rank", width: 30, sort: "int" },
                        { id: "nNome",  header: "Nivel", width: 120, sort: "strig" },
                        { id: "cNome",  header: "Curso", width: 120, sort: "strig" },
                        { id: "pNome",  header: "Per&iacute;odo", width: 120, sort: "strig" },
                        { id: "ncPreco_Inscricao", editor: "text", header: "Pre&ccedil;o Inscri&ccedil;&atilde;o", width: 120, sort: "int" },
                    ],
                    url: BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/read_ncpXid",
                    //pager: "pagerCDadosInscricao"
                },
                //{ view: "text", label: 'Nome', name: "sesNome", validate: "isNotEmpty", validateEvent: "blur" },
                //{ view: "text", label: 'C&oacute;digo', name: "sesCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                { view: "text", label: 'Nome Completo', name: "cNome", id: "idText_cNome", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'BI/Passaporte', name: "cBI", id: "idText_cBI", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                {
                    view: "combo", label: 'Banco', name: "bancNome", id: "idCombo_bancNome", labelPosition: "top", options: { body: { template: "#bancNome#", yCount: 7, url: BASE_URL + "CFinancas_Bancos/read" } },
                    on: {
                        "onChange": function (newv, oldv) {
                            //ACTUALIZAR COMBO CONTAS
                            $$("idCombo_contNumero").getList().clearAll();
                            $$("idCombo_contNumero").getList().load(BASE_URL + "CFinancas_Contas/readXbanco?id=" + this.getValue());
                        }
                    }
                },
                { view: "combo", label: 'Conta', name: "contNumero", id: "idCombo_contNumero", labelPosition: "top", options: { body: { template: "#contNumero#", yCount: 7, url: BASE_URL + "CFinancas_Contas/read" } } },
            ]
        },
        {
            cols: [
                {
                    view: "combo", label: 'Forma Pagamento', name: "ffpNome", id: "idCombo_ffpNome", labelPosition: "top", options: { body: { template: "#ffpNome#", yCount: 7, url: BASE_URL + "CFinancas_Forma_Pagamento/read" } },
                    on: {
                        "onChange": function (newv, oldv) {
                            //ACTUALIZAR COMBO CONTAS
                            if (this.getValue() == "2") //TPA
                                $$("idText_fpcRefPagamento").disable();
                            else
                                $$("idText_fpcRefPagamento").enable();
                        }
                    }
                },
                { view: "text", label: 'Referência Pagamento', name: "fpcRefPagamento", id: "idText_fpcRefPagamento", validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                {},
                { view: "text", label: 'id', name: "id", id: "idText_id", hidden: true, validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Valor a Pagar (Kz)', name: "fpcValor", id: "idText_fpcValor", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                {
                    view: "button", value: "Salvar", click: function () {
                        //criar PDF
                        idSelecionado = $$("idText_id").getValue();
                        var bancNome = $$("idCombo_bancNome").getValue();
                        var contNumero = $$("idCombo_contNumero").getValue();
                        var ffpNome = $$("idCombo_ffpNome").getValue();

                        if (idSelecionado && bancNome && contNumero) {
                            var envio = "id=" + idSelecionado +
                                "&total_pagar=" + $$("idText_fpcValor").getValue() +
                                "&bancNome=" + bancNome +
                                "&contNumero=" + contNumero +
                                "&ffpNome=" + ffpNome +
                                "&fpcRefPagamento=" + $$("idText_fpcRefPagamento").getValue() +
                                "&utilizadores_id=" + user_sessao;
                            var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Inscricao_Comprovativo/imprimir", envio);
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
                                    modal: false,
                                    //head:"This window can be moved",
                                    head: {
                                        view: "toolbar", cols: [
                                            { view: "label", label: "Finan&ccedil;as Comprovativo de Inscri&ccedil;&atilde;o" },
                                            { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFCP_Comprobativo').close(); } }
                                        ]
                                    },
                                    body: {
                                        //template:"Some text"
                                        template: '<div id="idPDFCP_Comprobativo" style="width:690px;  height:590px"></div>'
                                    }
                                }).show();
                                PDFObject.embed("../../relatorios/Financas_Inscricao_Comprovativo.pdf", "#idPDFCP_Comprobativo");
                                //apagar pagamento pendiente
                                var envio_bi = "bi=" + idSelecionado;
                                var r2 = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/delete", envio_bi);
                                if (r2.responseText == "true") {
                                    webix.message("Pagamento registrado com sucesso");
                                    //actualizar grid
                                    $$("idDTInscricao").clearAll();
                                    $$("idDTInscricao").load(BASE_URL + "cCandidatos/readDInscricao");
                                    //limpar codigo de barra
                                    //$$("idCombo_CB").setValue();
                                    //$$("id_win_inscricao_add").close();
                                } else
                                    webix.message({ type: "error", text: "Erro eliminando pagamento pendiente" });
                                //fechar a windows e limpar todo
                                $$("idCombo_CB").getList().clearAll();
                                $$("idCombo_CB").getList().load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb");
                                $$("id_win_inscricao_add").close();
                                //limpar codigo de barra
                                $$("idCombo_CB").setValue();
                                $$("id_win_inscricao_add").close();

                            } else {
                                webix.message({ type: "error", text: "Erro atualizando dados" });
                            }

                        } else {
                            webix.message({ type: "error", text: "Deve selecionar os campos obrigatorio" });
                        }
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        //limpar combo de codigo de barra para a proxima busca
                        //$$("idCombo_CB").setValue();
                        $$("idCombo_CB").getList().clearAll();
                        $$("idCombo_CB").getList().load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb");
                        $$("id_win_inscricao_add").close();
                        //limpar codigo de barra
                        $$("idCombo_CB").setValue();
                        $$("id_win_inscricao_add").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
*/
