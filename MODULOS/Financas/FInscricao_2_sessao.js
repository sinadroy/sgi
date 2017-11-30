function cargarVistaFInscricao_2_sessao(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Pagamentos de Inscri&ccedil;&atilde;o", body: {

                    rows: [
                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    cols: [
                                        {
                                            view: "text", label: 'Localizar Codigo de Barra', name: "fppcCodigoBarra", id: "idCombo_CB_2S", labelPosition: "top", options: { body: { template: "#fppcCodigoBarra#", yCount: 7, url: BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb" } },
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    var envio = "cb=" + this.getValue();
                                                    var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxCodigo_Barra", envio);
                                                    var candidato_id = rbi.responseText;
                                                    if (this.getValue !== "") {
                                                        if (candidato_id !== "false") {
                                                            var envio2 = "cid=" + candidato_id + "&tpag=2";
                                                            var rexiste = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/existe_pag", envio2);
                                                            if (rexiste.responseText == "true") {
                                                                //levantar interface de pagamento
                                                                //if (this.getValue() !== "") {
                                                                webix.ui({
                                                                    view: "window",
                                                                    id: "id_Win_Pag_Insc_2S",
                                                                    width: 600,
                                                                    position: "center",
                                                                    modal: true,
                                                                    head: "Pagamento de Inscri&ccedil;&atilde;o",
                                                                    body: webix.copy(formADDPagamentoInscricao_2S)
                                                                }).show();

                                                                //cargar Nome do candidato
                                                                var envio = "cb=" + candidato_id; //this.getValue();
                                                                var r1 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeCompletoXcb", envio);
                                                                var nome_completo_candidato = r1.responseText;
                                                                $$("idText_cNome_2S").setValue(nome_completo_candidato);
                                                                //cargar BI
                                                                var envio = "cb=" + candidato_id;//this.getValue();
                                                                var r2 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readBIxCB", envio);
                                                                var bi_candidato = r2.responseText;
                                                                $$("idText_cBI_2S").setValue(bi_candidato);

                                                                //idCodigo_Barra_Selecionado = this.getValue();//$$("idCombo_CB").getValue();
                                                                //Actualizar grid da windows
                                                                $$("idDTFormPagamentoInscricao_2S").clearAll();
                                                                $$("idDTFormPagamentoInscricao_2S").load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/read_ncpXid2?id=" + candidato_id/*this.getValue()*/);
                                                                //actualizar valor total a pagar
                                                                var envio = "cb=" + candidato_id;//this.getValue();
                                                                var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb_valor_total_inscricao_2S", envio);
                                                                var total_pagar = r.responseText;
                                                                $$("idText_fpcValor_2S").setValue(total_pagar);
                                                                $$("idText_fpcValor_2S").disable();
                                                                //mandar este valor para que despues sea mandado para mFinancas_Inscricao_Comprobativo
                                                                $$("idText_id_2S").setValue(candidato_id/*this.getValue()*/);
                                                            } else
                                                                webix.message({ type: "error", text: "O Candidato actual n&atilde;o tem divida" });
                                                        } else
                                                            webix.message({ type: "error", text: "O BI inserido n&atilde;o &eacute; v&aacute;lido" });

                                                        //}
                                                    }

                                                }
                                            }
                                        }, {
                                            //readIDxBI
                                            view: "text", label: 'Localizar por BI', name: "cBI_Passaporte", id: "idText_cBI_Passaporte_2S", labelPosition: "top",
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    //cargar el id seleccionado
                                                    var envio = "bi=" + this.getValue();
                                                    var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxBI", envio);
                                                    var candidato_id = rbi.responseText;
                                                    if (this.getValue !== "") {
                                                        if (candidato_id !== "false") {
                                                            var envio2 = "cid=" + candidato_id + "&tpag=2";
                                                            var rexiste = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/existe_pag", envio2);
                                                            if (rexiste.responseText == "true") {
                                                                //levantar interface de pagamento
                                                                webix.ui({
                                                                    view: "window",
                                                                    id: "id_Win_Pag_Insc_2S",
                                                                    width: 600,
                                                                    position: "center",
                                                                    modal: true,
                                                                    head: "Pagamento de Inscri&ccedil;&atilde;o",
                                                                    body: webix.copy(formADDPagamentoInscricao_2S)
                                                                }).show();

                                                                //cargar Nome do candidato
                                                                var envio = "id=" + candidato_id; //this.getValue();
                                                                var r1 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeCompletoXID", envio);
                                                                var nome_completo_candidato = r1.responseText;
                                                                if (nome_completo_candidato !== "")
                                                                    $$("idText_cNome_2S").setValue(nome_completo_candidato);
                                                                //cargar BI
                                                                var envio = "id=" + candidato_id; //this.getValue();
                                                                var r2 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readBIxID", envio);
                                                                var bi_candidato = r2.responseText;
                                                                $$("idText_cBI_2S").setValue(bi_candidato);

                                                                //idCodigo_Barra_Selecionado = this.getValue();//$$("idCombo_CB").getValue();
                                                                //Actualizar grid da windows
                                                                $$("idDTFormPagamentoInscricao_2S").clearAll();
                                                                $$("idDTFormPagamentoInscricao_2S").load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/read_ncpXid3?id=" + candidato_id/*this.getValue()*/);
                                                                //actualizar valor total a pagar
                                                                var envio = "id=" + candidato_id; //this.getValue();
                                                                var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb_valor_total_inscricao_2S1", envio);
                                                                var total_pagar = r.responseText;
                                                                $$("idText_fpcValor_2S").setValue(total_pagar);
                                                                $$("idText_fpcValor_2S").disable();
                                                                //mandar este valor para que despues sea mandado para mFinancas_Inscricao_Comprobativo
                                                                $$("idText_id_2S").setValue(candidato_id/*this.getValue()*/);
                                                            } else
                                                                webix.message({ type: "error", text: "O Candidato actual n&atilde;o tem divida" });
                                                        } else
                                                            webix.message({ type: "error", text: "O BI inserido n&atilde;o &eacute; v&aacute;lido" });

                                                    }


                                                }
                                            }
                                        },
                                        {}
                                    ]
                                },
                                {
                                    cols: [
                                        {
                                            view: "button", type: "standard", value: "Actualizar", width: 120, height: 50, click: function () {
                                                $$("idDTInscricao_2S").clearAll();
                                                $$("idDTInscricao_2S").load(BASE_URL + "CFinancas_Pagamentos_Inscricao_2S/read");
                                                //actualizar boton de codigo de barra
                                                //$$("idCombo_CB").getList().clearAll();
                                                //$$("idCombo_CB").getList().load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb");
                                            }
                                        },
                                        {
                                            view: "button", type: "form", value: "Reimprimir Comprovativo", width: 120, height: 50, click: function () {
                                                var idSelecionado = $$("idDTInscricao_2S").getSelectedId(false, true);
                                                if (idSelecionado) {
                                                    //
                                                    var record = $$("idDTInscricao_2S").getItem($$("idDTInscricao_2S").getSelectedId(false, true));
                                                    //
                                                    //var envio_candidato_id = "id=" + idSelecionado;
                                                    //var rec = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/read_estado_pagamento", envio_candidato_id);
                                                    if (record.cEstado2s == "Espera de Pagamento") {
                                                        webix.message({ type: "error", text: "Erro, Ainda n&atilde;o fez pagamento" });
                                                    } else
                                                        if (record.cEstado2s == "Inscrição aceite") {
                                                            //total a pagar
                                                            var envio = "id=" + idSelecionado; //tiene que ser el candidato_id
                                                            var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb_valor_total_inscricao_2S_REIMP", envio);
                                                            var total_pagar = r.responseText;

                                                            var envio = "id=" + idSelecionado +
                                                                "&utilizadores_id=" + user_sessao + 
                                                                "&total_pagar=" + total_pagar;
                                                            var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Inscricao_2S_Comprovativo_REIMP/imprimir", envio);
                                                            if (r.responseText == "true") {
                                                                webix.message("PDF criado com sucesso");
                                                                //Carregar PDF
                                                                webix.ui({
                                                                    view: "window",
                                                                    id: "idWinPDFCP_Comprobativo_2s_RI",
                                                                    height: 600,
                                                                    width: 700,
                                                                    left: 50, top: 50,
                                                                    move: true,
                                                                    modal: false,
                                                                    //head:"This window can be moved",
                                                                    head: {
                                                                        view: "toolbar", cols: [
                                                                            { view: "label", label: "Finan&ccedil;as Comprovativo de Inscri&ccedil;&atilde;o 2S" },
                                                                            { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFCP_Comprobativo_2s_RI').close(); } }
                                                                        ]
                                                                    },
                                                                    body: {
                                                                        //template:"Some text"
                                                                        template: '<div id="idPDFCP_Comprobativo_2s_RI" style="width:690px;  height:590px"></div>'
                                                                    }
                                                                }).show();
                                                                PDFObject.embed("../../relatorios/Financas_Inscricao_2S_Comprovativo_REIMP.pdf", "#idPDFCP_Comprobativo_2s_RI");


                                                            } else {
                                                                webix.message({ type: "error", text: "Erro ao carregar dados" });
                                                            }
                                                        }
                                                    //
                                                } else {
                                                    webix.message({ type: "error", text: "Deve selecionar primeiro um candidato" });
                                                }
                                            }
                                        },
                                        {}
                                    ]
                                }
                            ]

                        }, {
                            view: "datatable",
                            id: "idDTInscricao_2S",
                            select: "row", /*editable: true, editaction: "click",*/
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", width: 60, sort: "int" },
                                {
                                    id: "cEstado2s", header: ["Estado", { content: "selectFilter" }], width: 170, sort: "string",
                                    template: function (obj) {
                                        if (obj.cEstado2s == "Espera de Pagamento")
                                            return "<span style='color:red;'>" + obj.cEstado2s + "</span>";
                                        else
                                            return "<span style='color:green;'>" + obj.cEstado2s + "</span>";

                                    },
                                },
                                {
                                    id: "alAno", header: ["Ano Lectivo", { content: "textFilter" }], width: 100, sort: "int",
                                    /*  template: function (obj) {
                                          if (obj.cEstado == "Espera de Pagamento")
                                              return "<span style='color:red;'>" + obj.cEstado + "</span>";
                                          else
                                              return "<span style='color:green;'>" + obj.cEstado + "</span>";
             
                                      },*/
                                },

                                { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cNomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cBI_Passaporte", editor: "text", header: ["BI-Pass.", { content: "textFilter" }], width: 170, sort: "strig" },

                            ],
                            url: BASE_URL + "CFinancas_Pagamentos_Inscricao_2S/read",
                            pager: "pagerCDadosInscricao_2S"
                        }, {
                            view: "pager", id: "pagerCDadosInscricao_2S",
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
//Pagamento de Inscricao
var formADDPagamentoInscricao_2S = {
    view: "form",
    id: "idformADDPagamentoInscricao_2S",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "datatable",
                    height: 300,
                    id: "idDTFormPagamentoInscricao_2S",
                    select: "row",
                    columns: [
                        { id: "id", header: "", css: "rank", width: 30, sort: "int" },
                        { id: "nNome", /*editor: "text",*/ header: "Nivel", width: 120, sort: "strig" },
                        { id: "cNome", /*editor: "text",*/ header: "Curso", width: 180, sort: "strig" },
                        { id: "pNome", /*editor: "text",*/ header: "Per&iacute;odo", width: 120, sort: "strig" },
                        { id: "ncPreco_Inscricao2s", editor: "text", header: "Pre&ccedil;o Inscri&ccedil;&atilde;o", width: 120, sort: "int" },
                    ],
                    url: BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/read_ncpXid2",
                    //pager: "pagerCDadosInscricao"
                },
                //{ view: "text", label: 'Nome', name: "sesNome", validate: "isNotEmpty", validateEvent: "blur" },
                //{ view: "text", label: 'C&oacute;digo', name: "sesCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                { view: "text", label: 'Nome Completo', name: "cNome", id: "idText_cNome_2S", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'BI/Passaporte', name: "cBI", id: "idText_cBI_2S", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                {
                    view: "combo", label: 'Banco', name: "bancNome", id: "idCombo_bancNome_2S", labelPosition: "top", options: { body: { template: "#bancNome#", yCount: 7, url: BASE_URL + "CFinancas_Bancos/read" } },
                    on: {
                        "onChange": function (newv, oldv) {
                            //ACTUALIZAR COMBO CONTAS
                            $$("idCombo_contNumero_2S").getList().clearAll();
                            $$("idCombo_contNumero_2S").getList().load(BASE_URL + "CFinancas_Contas/readXbanco?id=" + this.getValue());
                        }
                    }
                },
                { view: "combo", label: 'Conta', name: "contNumero", id: "idCombo_contNumero_2S", labelPosition: "top", options: { body: { template: "#contNumero#", yCount: 7, url: BASE_URL + "CFinancas_Contas/read" } } },
            ]
        },
        {
            cols: [
                {
                    view: "combo", label: 'Forma Pagamento', name: "ffpNome", id: "idCombo_ffpNome_2S", labelPosition: "top", options: { body: { template: "#ffpNome#", yCount: 7, url: BASE_URL + "CFinancas_Forma_Pagamento/read" } },
                    on: {
                        "onChange": function (newv, oldv) {
                            //ACTUALIZAR COMBO CONTAS
                            if (this.getValue() == "2") //TPA
                                $$("idText_fpcRefPagamento_2S").disable();
                            else
                                $$("idText_fpcRefPagamento_2S").enable();
                        }
                    }
                },
                { view: "text", label: 'Referência Pagamento', name: "fpcRefPagamento", id: "idText_fpcRefPagamento_2S", validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                {},
                { view: "text", label: 'id', name: "id", id: "idText_id_2S", hidden: true, validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Valor a Pagar (Kz)', name: "fpcValor", id: "idText_fpcValor_2S", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                {
                    view: "button", value: "Salvar", click: function () {
                        //criar PDF
                        //var cb = $$("idText_id_2S").getValue();
                        var idSelecionado = $$("idText_id_2S").getValue();;
                        /*  if (cb) {
                              var envio_cb = "cb=" + cb;
                              var r_cb = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxCB", envio_cb);
                              idSelecionado = r_cb.responseText;
                          } else {
                              var envio = "bi=" + $$('idText_cBI_Passaporte_2S');
                              var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxBI", envio);
                              var idSelecionado = rbi.responseText;
                          }
                          */
                        var bancNome = $$("idCombo_bancNome_2S").getValue();
                        var contNumero = $$("idCombo_contNumero_2S").getValue();
                        var ffpNome = $$("idCombo_ffpNome_2S").getValue();

                        if (idSelecionado && bancNome && contNumero) {
                            var envio = "id=" + idSelecionado +
                                "&total_pagar=" + $$("idText_fpcValor_2S").getValue() +
                                "&bancNome=" + bancNome +
                                "&contNumero=" + contNumero +
                                "&ffpNome=" + ffpNome +
                                "&fpcRefPagamento=" + $$("idText_fpcRefPagamento_2S").getValue() +
                                "&utilizadores_id=" + user_sessao;
                            var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Inscricao_2S_Comprovativo/imprimir", envio);
                            if (r.responseText == "true") {
                                webix.message("PDF criado com sucesso");
                                //Carregar PDF
                                webix.ui({
                                    view: "window",
                                    id: "idWinPDFCP_Comprobativo_2S",
                                    height: 600,
                                    width: 700,
                                    left: 50, top: 50,
                                    move: true,
                                    modal: false,
                                    //head:"This window can be moved",
                                    head: {
                                        view: "toolbar", cols: [
                                            { view: "label", label: "Finan&ccedil;as Comprovativo de Inscri&ccedil;&atilde;o" },
                                            { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFCP_Comprobativo_2S').close(); } }
                                        ]
                                    },
                                    body: {
                                        //template:"Some text"
                                        template: '<div id="idPDFCP_Comprobativo_2S" style="width:690px;  height:590px"></div>'
                                    }
                                }).show();
                                PDFObject.embed("../../relatorios/Financas_Inscricao_2S_Comprovativo.pdf", "#idPDFCP_Comprobativo_2S");
                                //apagar pagamento pendiente
                                var envio_bi = "bi=" + idSelecionado;
                                var r2 = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/delete", envio_bi);
                                if (r2.responseText == "true") {
                                    webix.message("Pagamento registrado com sucesso");
                                    //actualizar grid
                                    $$("idDTInscricao_2S").clearAll();
                                    $$("idDTInscricao_2S").load(BASE_URL + "CFinancas_Pagamentos_Inscricao_2S/read");
                                    //limpar codigo de barra
                                    //$$("idCombo_CB").setValue();
                                    //$$("id_win_inscricao_add").close();
                                } else
                                    webix.message({ type: "error", text: "Erro eliminando pagamento pendiente" });
                                //fechar a windows e limpar todo
                                //$$("idCombo_CB_2S").getList().clearAll();
                                //$$("idCombo_CB_2S").getList().load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb");
                                //$$("id_win_inscricao_add_2S").close();
                                //limpar codigo de barra
                                if ($$("idCombo_CB_2S").getValue() !== "") {
                                    $$("idCombo_CB_2S").setValue("");
                                }
                                if ($$("idText_cBI_Passaporte_2S").getValue() !== "") {
                                    $$("idText_cBI_Passaporte_2S").setValue("");
                                }
                                //$$("idCombo_CB_2S").setValue("");
                                $$("id_Win_Pag_Insc_2S").close();

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
                        //$$("idCombo_CB").getList().clearAll();
                        //$$("idCombo_CB").getList().load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb");
                        //$$("id_win_inscricao_add").close();
                        //limpar codigo de barra

                        //$$("id_Win_Pag_Insc_2S").close();
                        if ($$("idCombo_CB_2S").getValue() !== "") {
                            $$("idCombo_CB_2S").setValue("");
                        }
                        if ($$("idText_cBI_Passaporte_2S").getValue() !== "") {
                            $$("idText_cBI_Passaporte_2S").setValue("");
                        }
                        $$("id_Win_Pag_Insc_2S").close();
                        //$$("idCombo_CB_2S").setValue("");
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
