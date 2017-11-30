function cargarVistaFConfirmacao_Matricula(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Pagamentos de Confirma&ccedil;&atilde;o de Matr&iacute;cula", body: {

                    rows: [
                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    cols: [
                                        {
                                            view: "text", label: 'Localizar Codigo de Barra', name: "fppcCodigoBarra", id: "idCombo_CB", labelPosition: "top", options: { body: { template: "#fppcCodigoBarra#", yCount: 7, url: BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb" } },
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    //cargar el id seleccionado
                                                    var envio = "cb=" + this.getValue();
                                                    var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxCodigo_Barra", envio);
                                                    var candidato_id = rbi.responseText;
                                                    if (this.getValue !== "") {
                                                        if (candidato_id !== "false") {
                                                            //levantar interface de pagamento
                                                            webix.ui({
                                                                view: "window",
                                                                id: "id_win_inscricao_add",
                                                                width: 600,
                                                                position: "center",
                                                                modal: true,
                                                                head: "Pagamento de Confirma&ccedil;&atilde;o",
                                                                body: webix.copy(formADDPagamentoConfirmacao)
                                                            }).show();

                                                            //cargar Nome do candidato
                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeCompletoXID", envio);
                                                            var nome_completo_candidato = r1.responseText;
                                                            $$("idText_cNome").setValue(nome_completo_candidato);
                                                            //cargar BI
                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r2 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readBIxID", envio);
                                                            var bi_candidato = r2.responseText;
                                                            $$("idText_cBI").setValue(bi_candidato);

                                                            //idCodigo_Barra_Selecionado = this.getValue();//$$("idCombo_CB").getValue();
                                                            //Actualizar grid da windows
                                                            $$("idDTFormPagamentoInscricao").clearAll();
                                                            $$("idDTFormPagamentoInscricao").load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/read_ncpXid_CM?id=" + candidato_id/*this.getValue()*/);
                                                            //actualizar valor total a pagar
                                                            var envio = "cb=" + candidato_id; //this.getValue();
                                                            var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb_valor_total_confirmacao", envio);
                                                            var total_pagar = r.responseText;
                                                            $$("idText_fpcValor").setValue(total_pagar);
                                                            $$("idText_fpcValor").disable();
                                                            //mandar este valor para que despues sea mandado para mFinancas_Inscricao_Comprobativo
                                                            $$("idText_id").setValue(candidato_id/*this.getValue()*/);
                                                        } else
                                                            webix.message({ type: "error", text: "O BI inserido n&atilde;o &eacute; v&aacute;lido" });
                                                    }

                                                }
                                            }
                                        }, {
                                            //readIDxBI
                                            view: "text", label: 'Localizar por BI', name: "cBI_Passaporte", id: "idText_cBI_Passaporte", labelPosition: "top",
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    //cargar el id seleccionado
                                                    var envio = "bi=" + this.getValue();
                                                    var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxBI", envio);
                                                    var candidato_id = rbi.responseText;
                                                    if (this.getValue !== "") {
                                                        if (candidato_id !== "false") {
                                                            //levantar interface de pagamento
                                                            webix.ui({
                                                                view: "window",
                                                                id: "id_win_inscricao_add",
                                                                width: 600,
                                                                position: "center",
                                                                modal: true,
                                                                head: "Pagamento de Confirma&ccedil;&atilde;o",
                                                                body: webix.copy(formADDPagamentoConfirmacao)
                                                            }).show();

                                                            //cargar Nome do candidato
                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeCompletoXID", envio);
                                                            var nome_completo_candidato = r1.responseText;
                                                            $$("idText_cNome").setValue(nome_completo_candidato);
                                                            //cargar BI
                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r2 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readBIxID", envio);
                                                            var bi_candidato = r2.responseText;
                                                            $$("idText_cBI").setValue(bi_candidato);

                                                            //idCodigo_Barra_Selecionado = this.getValue();//$$("idCombo_CB").getValue();
                                                            //Actualizar grid da windows
                                                            $$("idDTFormPagamentoInscricao").clearAll();
                                                            $$("idDTFormPagamentoInscricao").load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/read_ncpXid_CM?id=" + candidato_id/*this.getValue()*/);
                                                            //actualizar valor total a pagar
                                                            var envio = "cb=" + candidato_id; //this.getValue();
                                                            var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb_valor_total_confirmacao", envio);
                                                            var total_pagar = r.responseText;
                                                            $$("idText_fpcValor").setValue(total_pagar);
                                                            $$("idText_fpcValor").disable();
                                                            //mandar este valor para que despues sea mandado para mFinancas_Inscricao_Comprobativo
                                                            $$("idText_id").setValue(candidato_id/*this.getValue()*/);
                                                        } else
                                                            webix.message({ type: "error", text: "O BI inserido n&atilde;o &eacute; v&aacute;lido" });
                                                    }


                                                }
                                            }
                                        },
                                        {},
                                        
                                    ]
                                },
                                {
                                    cols: [
                                        {
                                            view: "button", type: "standard", value: "Actualizar", width: 120, height: 50, click: function () {
                                                $$("idDTInscricao").clearAll();
                                                $$("idDTInscricao").load(BASE_URL + "CEstudantes/read_conf_mat_financas");
                                                //actualizar boton de codigo de barra
                                                //$$("idCombo_CB").getList().clearAll();
                                                //$$("idCombo_CB").getList().load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb");
                                                //limpar campos
                                                $$("idText_cBI_Passaporte").setValue("");
                                                $$("idCombo_CB").setValue("");
                                            }
                                        },
                                        {
                                            view: "button", type: "form", value: "Reimprimir Comprovativo", width: 120, height: 50, click: function () {
                                                var idSelecionado = $$("idDTInscricao").getSelectedId(false, true);
                                                if (idSelecionado) {
                                                    //
                                                    var envio_candidato_id = "id=" + idSelecionado;
                                                    var rec = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/read_estado_pagamento_estudantes", envio_candidato_id);
                                                    if (rec.responseText == "Conf.Mat.Esp.Pag") {
                                                        webix.message({ type: "error", text: "Erro, Ainda n&atilde;o fez pagamento" });
                                                    } else
                                                        if (rec.responseText == "Conf.Mat.Aceite") {
                                                            var envio = "id=" + idSelecionado +
                                                                "&utilizadores_id=" + user_sessao;
                                                            var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Confirmacao_Comprovativo_REIMP/imprimir", envio);
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
                                                                            { view: "label", label: "Finan&ccedil;as Comprovativo de Confirma&ccedil;&atilde;o" },
                                                                            { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFCP_Comprobativo').close(); } }
                                                                        ]
                                                                    },
                                                                    body: {
                                                                        //template:"Some text"
                                                                        template: '<div id="idPDFCP_Comprobativo" style="width:690px;  height:590px"></div>'
                                                                    }
                                                                }).show();
                                                                PDFObject.embed("../../relatorios/Financas_Confirmacao_Comprovativo_REIMP.pdf", "#idPDFCP_Comprobativo");


                                                            } else {
                                                                webix.message({ type: "error", text: "Erro ao carregar dados" });
                                                            }
                                                        }
                                                    //
                                                } else {
                                                    webix.message({ type: "error", text: "Deve selecionar primeiro um estudante" });
                                                }
                                            }
                                        },
                                        //Cancelar_Pagamento
                                        {
                                            view: "button", type: "danger", value: "Cancelar Pag.", disabled: true, id: "idbtn_cancelar_pag", width: 120, height: 50, click: function () {
                                                var idSelecionado = $$("idDTInscricao").getSelectedId(false, true);
                                                if (idSelecionado) {
                                                    /*
                                                    var envio_id_pag = "id=" + idSelecionado;
                                                    var rcid = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Candidatos/read_candidato_X_idpag", envio_id_pag);
                                                    var candidato_id = rcid.responseText;
                                                    */
                                                    var envio_candidato_id = "id=" + idSelecionado;
                                                    var rec = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/read_estado_pagamento", envio_candidato_id);
                                                    if (rec.responseText == "Espera de Pagamento") {
                                                        webix.message({ type: "error", text: "Erro, Ainda n&atilde;o fez pagamento" });
                                                    } else
                                                        if (rec.responseText == "Inscrição aceite") {
                                                            var envio = "id=" + idSelecionado +
                                                                "&utilizadores_id=" + user_sessao;
                                                            var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Candidatos/Cancelar_Pagamento", envio);
                                                            if (r.responseText == "true") {
                                                                webix.message("Pagamento cancelado com sucesso");
                                                                $$("idDTInscricao").clearAll();
                                                                $$("idDTInscricao").load(BASE_URL + "cCandidatos/readDInscricao_Financas");
                                                            } else {
                                                                webix.message({ type: "error", text: "Erro ao carregar dados" });
                                                            }
                                                        }
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
                            id: "idDTInscricao",
                            select: "row", /*editable: true, editaction: "click",*/
                            columns: [
                                { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                                //{ id: "eData_Matricula", header: "Data Mat.", css: "rank", width: 60, sort: "int" },
                                {
                                    id: "eEstado_Matricula", header: ["Estado", { content: "selectFilter" }], width: 170, sort: "string",
                                    template: function (obj) {
                                        if (obj.eEstado_Matricula == "Conf.Mat.Esp.Pag")
                                            return "<span style='color:red;'>" + obj.eEstado_Matricula + "</span>";
                                        else
                                            if(obj.eEstado_Matricula == "Conf.Mat.Aceite")
                                                return "<span style='color:green;'>" + obj.eEstado_Matricula + "</span>";
                                    },
                                },

                                { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cNomes", header: "Nomes", width: 170, sort: "string" },
                                { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cBI_Passaporte", editor: "text", header: ["BI-Pass.", { content: "textFilter" }], width: 150, sort: "strig" },
                            ],
                            url: BASE_URL + "CEstudantes/read_conf_mat_financas",
                            pager: "pagerCDadosConfirmacao"
                        }, {
                            view: "pager", id: "pagerCDadosConfirmacao",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }
                    ]
                }
            },

        ]
    });
    var envio = "usuario=" + user_sessao;
    var r = webix.ajax().sync().post(BASE_URL + "Cutilizadores/readAcesso", envio);
    if (r.responseText == "Administradores") {
        //$$("idbtn_cancelar_pag").enable();
    }
}
//Pagamento de Inscricao
var formADDPagamentoConfirmacao = {
    view: "form",
    id: "idformADDPagamentoConfirmacao",
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
                        { id: "nNome", header: "Nivel", width: 120, sort: "strig" },
                        { id: "cNome", header: "Curso", width: 250, sort: "strig" },
                        { id: "pNome", header: "Per&iacute;odo", width: 120, sort: "strig" },
                        { id: "ncPreco_Confirmacao", editor: "text", header: "Pre&ccedil;o Conf. Mat.", width: 120, sort: "int" },
                    ],
                    url: BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/mread_ncpXid_CM",
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
                            var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Confirmacao_Comprovativo/imprimir", envio);
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
                                PDFObject.embed("../../relatorios/Financas_Confirmacao_Comprovativo.pdf", "#idPDFCP_Comprobativo");
                                //apagar pagamento pendiente
                                var envio_bi = "bi=" + idSelecionado;
                                var r2 = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/delete", envio_bi);
                                if (r2.responseText == "true") {
                                    webix.message("Pagamento registrado com sucesso");
                                    //actualizar grid
                                    $$("idDTInscricao").clearAll();
                                    $$("idDTInscricao").load(BASE_URL + "CEstudantes/read_conf_mat_financas");
                                    //limpar codigo de barra
                                    //$$("idCombo_CB").setValue();
                                    //$$("id_win_inscricao_add").close();
                                } else
                                    webix.message({ type: "error", text: "Erro eliminando pagamento pendiente" });
                                //fechar a windows e limpar todo
                                //$$("idCombo_CB").setValue("");
                                if ($$("idCombo_CB").getValue() !== "") {
                                    $$("idCombo_CB").setValue("");
                                }
                                if ($$("idText_cBI_Passaporte").getValue() !== "") {
                                    $$("idText_cBI_Passaporte").setValue("");
                                }
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
                        if ($$("idCombo_CB").getValue() !== "") {
                            $$("idCombo_CB").setValue("");
                        }
                        if ($$("idText_cBI_Passaporte").getValue() !== "") {
                            $$("idText_cBI_Passaporte").setValue("");
                        }
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
