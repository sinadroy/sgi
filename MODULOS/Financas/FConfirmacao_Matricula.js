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
                                            //readIDxBI
                                            view: "text", label: 'Localizar por BI', name: "cBI_Passaporte", id: "idText_cBI_PassaporteXXX", width: 300, labelPosition: "top",
                                            on: {
                                                //"onKey": function (newv, oldv) {
                                                //$$('idDTPCF').getFilter("nNome").setText('asd');
                                                //}
                                                /*
                                                "onChange": function (newv, oldv) {
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
                                                            //$$("idDTFormPagamentoInscricao").clearAll();
                                                            //$$("idDTFormPagamentoInscricao").load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/read_ncpXid_CM?id=" + candidato_id);
                                                            //actualizar valor total a pagar
                                                            var envio = "cb=" + candidato_id; //this.getValue();
                                                            var r = webix.ajax().sync().post(BASE_URL + "Cfinancas_pagamentos_confirmacao/readXcb_valor_total_confirmacao", envio);
                                                            var total_pagar = r.responseText;
                                                            $$("idText_fpcValor").setValue(total_pagar);
                                                            $$("idText_fpcValor").disable();
                                                            //mandar este valor para que despues sea mandado para mFinancas_Inscricao_Comprobativo
                                                            $$("idText_id").setValue(candidato_id);
                                                        } else
                                                            webix.message({ type: "error", text: "O BI inserido n&atilde;o &eacute; v&aacute;lido" });
                                                    }
                                                } */
                                            }
                                        },
                                        {
                                            view: "button", type: "form", value: "Pagar", width: 120, click: function () {
                                                //cargar el id seleccionado
                                                var envio = "bi=" + $$('idText_cBI_PassaporteXXX').getValue();
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
                                                        //$$("idDTFormPagamentoInscricao").clearAll();
                                                        //$$("idDTFormPagamentoInscricao").load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/read_ncpXid_CM?id=" + candidato_id/*this.getValue()*/);
                                                        //actualizar valor total a pagar
                                                        var envio = "cb=" + candidato_id; //this.getValue();
                                                        var r = webix.ajax().sync().post(BASE_URL + "Cfinancas_pagamentos_confirmacao/readXcb_valor_total_confirmacao", envio);
                                                        var total_pagar = r.responseText;
                                                        $$("idText_fpcValor").setValue(total_pagar);
                                                        $$("idText_fpcValor").disable();
                                                        //mandar este valor para que despues sea mandado para mFinancas_Inscricao_Comprobativo
                                                        $$("idText_id").setValue(candidato_id/*this.getValue()*/);
                                                    } else
                                                        webix.message({ type: "error", text: "O BI inserido n&atilde;o &eacute; v&aacute;lido" });
                                                }
                                            }
                                        },
                                        {},

                                    ]
                                },
                                {
                                    cols: [
                                        {
                                            view: "button", type: "standard", value: "Actualizar", width: 120, click: function () {
                                                $$("idDTPCF").clearAll();
                                                $$("idDTPCF").load(BASE_URL + "Cfinancas_pagamentos_confirmacao/read");
                                                //actualizar boton de codigo de barra
                                                //$$("idCombo_CB").getList().clearAll();
                                                //$$("idCombo_CB").getList().load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/readXcb");
                                                //limpar campos
                                                $$("idText_cBI_PassaporteXXX").setValue("");
                                            }
                                        },
                                        {
                                            view: "button", type: "form", value: "Reimp. Comprovativo", width: 150, click: function () {
                                                var idSelecionado = $$("idDTPCF").getSelectedId(false, true);
                                                if (idSelecionado) {
                                                    var record = $$("idDTPCF").getItem(idSelecionado);

                                                    //criar PDF
                                                    //idSelecionado = $$("idText_id").getValue();
                                                    //var bancNome = record.//$$("idCombo_bancNome").getValue();
                                                    var contNumero = record.contNumero;//$$("idCombo_contNumero").getValue();
                                                    var ffpNome = record.ffpNome;//$$("idCombo_ffpNome").getValue();
                                                    var sNome = record.snome;//$$("idCombo_sNome").getValue();
                                                    var cBI = record.cBI_Passaporte;//$$('idText_cBI').getValue();
                                                    var cnome = record.cNome+" "+record.cApelido;//$$('idText_cNome').getValue();
                                                    var rbi = webix.ajax().sync().post(BASE_URL + "CEstudantes/get_idXbi", "bi=" + cBI);
                                                    var Estudantes_id = rbi.responseText;

                                                    if (idSelecionado && contNumero && sNome && cBI && cnome && Estudantes_id) {
                                                        var rexiste = webix.ajax().sync().post(BASE_URL + "Cfinancas_pagamentos_confirmacao/Existe_Pagamento", "bi=" + cBI + "&s=" + sNome);
                                                        if (rexiste.responseText == "true") {
                                                            var envio = "id=" + idSelecionado +
                                                                "&total_pagar=" + record.fpdvalor +
                                                                "&utilizadores_id=" + user_sessao +
                                                                "&fpdrefpagamento=" + record.fpdrefpagamento +
                                                                "&Estudantes_id=" + Estudantes_id +
                                                                "&semestres_id=" + sNome +
                                                                "&Financas_Forma_Pagamento_id=" + ffpNome +
                                                                "&Financas_Contas_id=" + contNumero +
                                                                "&bi=" + cBI +
                                                                "&cnome=" + cnome +
                                                                "&webix_operation=insert";
                                                            //var r = webix.ajax().sync().post(BASE_URL + "Cfinancas_pagamentos_confirmacao/crud", envio);
                                                            //imp comprobativo
                                                            var rimp = webix.ajax().sync().post(BASE_URL + "Cfinancas_pagamento_confirmacao_comprovativo/imprimir", envio);

                                                            //if (r.responseText == "true") {
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
                                                                //Actualizar
                                                                //$$("idDTPCF").clearAll();
                                                                //$$("idDTPCF").load(BASE_URL + "Cfinancas_pagamentos_confirmacao/read");

                                                                if ($$("idText_cBI_PassaporteXXX").getValue() !== "") {
                                                                    $$("idText_cBI_PassaporteXXX").setValue("");
                                                                }
                                                            
                                                        } else
                                                            webix.message({ type: "error", text: "Não existe um pagamento de este semestre." })
                                                    } else {
                                                        webix.message({ type: "error", text: "Deve selecionar os campos obrigatorio" });
                                                    }
                                                } else
                                                    webix.message({ type: "error", text: "Deve selecionar primeiro um pagamento." });
                                            }
                                        },
                                        {}
                                    ]
                                }
                            ]

                        }, {
                            view: "datatable",
                            id: "idDTPCF",
                            select: "row", /*editable: true, editaction: "click",*/
                            columns: [
                                { id: "contNumero", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                { id: "ffpNome", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                { id: "fpdrefpagamento", header: "", css: "rank", hidden: true, width: 30, sort: "int" },

                                { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                                { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                //{ id: "cNomes", header: "Nomes", hidden: true, width: 170, sort: "string" },
                                { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cBI_Passaporte", editor: "text", header: ["BI-Pass.", { content: "textFilter" }], width: 150, sort: "strig" },
                                { id: "nNome", editor: "text", header: ["Nível", { content: "textFilter" }], width: 150, sort: "strig" },
                                { id: "curso", editor: "text", header: ["Curso", { content: "textFilter" }], width: 150, sort: "strig" },
                                { id: "pNome", editor: "text", header: ["Período", { content: "textFilter" }], width: 150, sort: "strig" },
                                { id: "snome", editor: "text", header: ["Semestre", { content: "textFilter" }], width: 80, sort: "strig" },
                                { id: "fpdvalor", editor: "text", header: ["Valor", { content: "textFilter" }], width: 100, sort: "int" },
                            ],
                            resizeColumn: true,
                            url: BASE_URL + "Cfinancas_pagamentos_confirmacao/read",
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
                { view: "combo", label: 'Semestre', name: "sNome", id: "idCombo_sNome", labelPosition: "top", options: { body: { template: "#sNome#", yCount: 7, url: BASE_URL + "CSemestres/read" } } },

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
                        var sNome = $$("idCombo_sNome").getValue();
                        var cBI = $$('idText_cBI').getValue();
                        var cnome = $$('idText_cNome').getValue();
                        var rbi = webix.ajax().sync().post(BASE_URL + "CEstudantes/get_idXbi", "bi=" + $$('idText_cBI').getValue());
                        var Estudantes_id = rbi.responseText;

                        if (idSelecionado && bancNome && contNumero && sNome) {
                            var rexiste = webix.ajax().sync().post(BASE_URL + "Cfinancas_pagamentos_confirmacao/Existe_Pagamento", "bi=" + cBI + "&s=" + sNome);
                            if (rexiste.responseText == "false") {
                                var envio = "id=" + idSelecionado +
                                    "&total_pagar=" + $$("idText_fpcValor").getValue() +
                                    "&utilizadores_id=" + user_sessao +
                                    "&fpdrefpagamento=" + $$("idText_fpcRefPagamento").getValue() +
                                    "&Estudantes_id=" + Estudantes_id +
                                    "&semestres_id=" + sNome +
                                    "&Financas_Forma_Pagamento_id=" + ffpNome +
                                    "&Financas_Contas_id=" + contNumero +
                                    "&bi=" + cBI +
                                    "&cnome=" + cnome +
                                    "&webix_operation=insert";
                                var r = webix.ajax().sync().post(BASE_URL + "Cfinancas_pagamentos_confirmacao/crud", envio);
                                //imp comprobativo
                                var rimp = webix.ajax().sync().post(BASE_URL + "Cfinancas_pagamento_confirmacao_comprovativo/imprimir", envio);

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
                                    //Actualizar
                                    $$("idDTPCF").clearAll();
                                    $$("idDTPCF").load(BASE_URL + "Cfinancas_pagamentos_confirmacao/read");

                                    if ($$("idText_cBI_PassaporteXXX").getValue() !== "") {
                                        $$("idText_cBI_PassaporteXXX").setValue("");
                                    }
                                    $$("id_win_inscricao_add").close();

                                } else {
                                    webix.message({ type: "error", text: "Erro atualizando dados" });
                                }
                            } else
                                webix.message({ type: "error", text: "Ja existe um pagamento de este semestre." })
                        } else {
                            webix.message({ type: "error", text: "Deve selecionar os campos obrigatorio" });
                        }
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        //limpar combo de codigo de barra para a proxima busca
                        //$$("idCombo_CB").setValue();
                        /*if ($$("idCombo_CB").getValue() !== "") {
                            $$("idCombo_CB").setValue("");
                        }*/
                        if ($$("idText_cBI_PassaporteXXX").getValue() !== "") {
                            $$("idText_cBI_PassaporteXXX").setValue("");
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
