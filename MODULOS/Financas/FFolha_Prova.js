function cargarVistaFFolha_Prova(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Pagamentos Folha de Prova", body: {

                    rows: [
                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    cols: [
                                        { view: "text", label: 'BI / Passaporte (Estudantes)', name: "cbi_passaporte", id: "idtext_bi_ffp", width: 300, labelPosition: "top" },
                                        {
                                            view: "button", type: "form", value: "Carregar", width: 120, click: function () {

                                                var bi = $$("idtext_bi_ffp").getValue();

                                                var envio = "bi=" + bi;
                                                var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxBI", envio);
                                                var candidato_id = rbi.responseText;

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeCompletoXID", envio);
                                                var nome_completo_candidato = r1.responseText;
                                                $$("idtext_nome_completo_ffp").setValue(nome_completo_candidato);

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Nivel_NomeXCandidato_id", envio);
                                                var nivel = r1.responseText;
                                                $$("idtext_nnome_ffp").setValue(nivel);

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Curso_NomeXCandidato_id", envio);
                                                var curso = r1.responseText;
                                                $$("idtext_cnome_ffp").setValue(curso);

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Periodo_NomeXCandidato_id", envio);
                                                var periodo = r1.responseText;
                                                $$("idtext_pnome_ffp").setValue(periodo);

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_AC_NomeXCandidato_id", envio);
                                                var ac = r1.responseText;
                                                $$("idtext_acnome_ffp").setValue(ac);

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Semestre_NomeXCandidato_id", envio);
                                                var s = r1.responseText;
                                                $$("idtext_snome_ffp").setValue(s);

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Turma_NomeXCandidato_id", envio);
                                                var t = r1.responseText;
                                                $$("idtext_tnome_ffp").setValue(t);
                                            }
                                        },
                                        {}
                                    ]
                                }, {
                                    cols: [
                                        { view: "text", label: 'Nome Completo', name: "cnome", id: "idtext_nome_completo_ffp", readonly: true, disabled: true, width: 350, labelPosition: "top" },
                                        { view: "text", label: 'Nível', name: "nnome", id: "idtext_nnome_ffp", readonly: true, disabled: true, width: 200, labelPosition: "top" },
                                        { view: "text", label: 'Curso', name: "cnome", id: "idtext_cnome_ffp", readonly: true, disabled: true, width: 400, labelPosition: "top" },
                                        { view: "text", label: 'Período', name: "pnome", id: "idtext_pnome_ffp", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                                        //{ view: "text", label: 'Nível', name: "nnome", id: "idtext_nnome", readonly: true, width: 400, labelPosition:"top"},
                                        {}
                                    ]
                                },
                                {
                                    cols: [
                                        { view: "text", label: 'Ano Curricular', name: "acnome", id: "idtext_acnome_ffp", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                                        { view: "text", label: 'Semestre Actual', name: "snome", id: "idtext_snome_ffp", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                                        { view: "text", label: 'Turma Actual', name: "tnome", id: "idtext_tnome_ffp", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                                        {
                                            view: "button", type: "form", value: "Pagar", width: 120, click: function () {
                                                var envio = "bi=" + $$('idtext_bi_ffp').getValue();
                                                var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxBI", envio);
                                                var candidato_id = rbi.responseText;
                                                if ($$('idtext_bi_ffp').getValues !== "") {
                                                    if (candidato_id !== "false") {
                                                        //levantar interface de pagamento
                                                        webix.ui({
                                                            view: "window",
                                                            id: "id_win_ffp",
                                                            width: 600,
                                                            position: "center",
                                                            modal: true,
                                                            head: "Pagamento Folha de Prova",
                                                            body: webix.copy(formADDPagFFP)
                                                        }).show();

                                                        //cargar Nome do candidato
                                                        var envio = "id=" + candidato_id; //this.getValue();
                                                        var r1 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeCompletoXID", envio);
                                                        var nome_completo_candidato = r1.responseText;
                                                        $$("idText_cNome_ffp").setValue(nome_completo_candidato);

                                                        //cargar BI
                                                        var envio = "id=" + candidato_id; //this.getValue();
                                                        var r2 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readBIxID", envio);
                                                        var bi_candidato = r2.responseText;
                                                        $$("idText_cBI_ffp").setValue(bi_candidato);


                                                        //Actualizar grid da windows
                                                        $$("idDTFormFFP").clearAll();
                                                        $$("idDTFormFFP").load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Documentos/read_ncpXid_fd?id=" + candidato_id/*this.getValue()*/);

                                                        // obtener id de niveis_cursos
                                                        let envio1 = "n=" + $$('idtext_nnome_ffp').getValue() + "&c=" + $$('idtext_cnome_ffp').getValue() + "&p=" + $$('idtext_pnome_ffp').getValue();
                                                        let rncp = webix.ajax().sync().post(BASE_URL + "CNiveisCursos/read_x_ncp_nomes", envio1);
                                                        let id_ncp = rncp.responseText;

                                                        //actualizar valor total a pagar
                                                        var envio2 = "id_ncp=" + id_ncp;
                                                        var r3 = webix.ajax().sync().post(BASE_URL + "CPagamentos_Comprobativo_Prec/read_precario_folha_prova", envio2);
                                                        var total_pagar = r3.responseText;
                                                        $$("idText_fceValor_ffp").setValue(total_pagar);
                                                        $$("idText_fceValor_ffp").disable();
                                                        //mandar este valor para que despues sea mandado para mFinancas_Inscricao_Comprobativo
                                                        // cargar efeito na janela de pagamento
                                                        // $$("idText_efeito").setValue($$('idCB_mnome_ed').getValue());
                                                        // $$("idText_td").setValue($$('idCB_tdnome_ed').getValue());
                                                        $$("idText_id_ffp").setValue(candidato_id);
                                                    } else
                                                        webix.message({ type: "error", text: "O BI inserido n&atilde;o &eacute; v&aacute;lido" });
                                                }
                                            }
                                        },
                                        {}
                                    ]
                                },
                                {
                                    cols: [
                                        {
                                            view: "button", type : "standard", value: "Actualizar", width: 120, click: function () {
                                                $$("idDTEdFFP").clearAll();
                                                $$("idDTEdFFP").load(BASE_URL + "CFinancas_cartao/read");
                                            }
                                        },
                                        {}
                                    ]
                                },
                                {
                                    view: "datatable",
                                    id: "idDTEdFFP",
                                    //autowidth:true,
                                    //autoConfig:true,
                                    select: true,
                                    editable: false,
                                    //editable:true,
                                    //editaction:"dblclick",
                                    columns: [
                                        { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                        { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                        { id: "alAno", header: ["Ano Lectivo", { content: "textFilter" }], width: 70, sort: "int" },
                                        { id: "cbi_passaporte", header: ["BI/Passaporte", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cnome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cnomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },

                                        { id: "fc_data", header: ["Data", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "fc_hora", header: ["Hora", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "contNumero", header: ["Num. Conta", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "ffpNome", header: ["Forma pag.", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "fc_ref_pag", header: ["Ref. Pag.", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "fc_valor", header: ["Valor", { content: "textFilter" }], width: 80, sort: "int" },
                                    ],
                                    resizeColumn: true,
                                    url: BASE_URL + "CFinancas_folha_prova/read",
                                    pager: "pagerFFP"
                                }, {
                                    view: "pager", id: "pagerFFP",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 16,
                                    group: 10
                                }
                            ]

                        },
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
//Pagamento de cartao
var formADDPagFFP = {
    view: "form",
    id: "idformADDPagFFP",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "datatable",
                    height: 150,
                    id: "idDTFormFFP",
                    select: "row",
                    columns: [
                        { id: "id", header: "", css: "rank", width: 30, sort: "int" },
                        { id: "nNome", header: "Nivel", width: 120, sort: "strig" },
                        { id: "cNome", header: "Curso", width: 300, sort: "strig" },
                        { id: "pNome", header: "Per&iacute;odo", width: 120, sort: "strig" },
                        //{ id: "ncPreco_Confirmacao", editor: "text", header: "Pre&ccedil;o Conf. Mat.", width: 120, sort: "int" },
                    ],
                    url: BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/mread_ncpXid_CM",
                    //pager: "pagerCDadosInscricao"
                },
                //{ view: "text", label: 'Nome', name: "sesNome", validate: "isNotEmpty", validateEvent: "blur" },
                //{ view: "text", label: 'C&oacute;digo', name: "sesCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        },
        {
            cols: [
                { view: "text", label: 'Nome Completo', name: "cNome", id: "idText_cNome_ffp", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'BI/Passaporte', name: "cBI", id: "idText_cBI_ffp", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                {
                    view: "combo", label: 'Banco', name: "bancNome", id: "idCombo_bancNome_ffp", labelPosition: "top", options: { body: { template: "#bancNome#", yCount: 7, url: BASE_URL + "CFinancas_Bancos/read" } },
                    on: {
                        "onChange": function (newv, oldv) {
                            //ACTUALIZAR COMBO CONTAS
                            $$("idCombo_contNumero_ffp").getList().clearAll();
                            $$("idCombo_contNumero_ffp").getList().load(BASE_URL + "CFinancas_Contas/readXbanco?id=" + this.getValue());
                        }
                    }
                },
                { view: "combo", label: 'Conta', name: "contNumero", id: "idCombo_contNumero_ffp", labelPosition: "top", options: { body: { template: "#contNumero#", yCount: 7, url: BASE_URL + "CFinancas_Contas/read" } } },
            ]
        },
        {
            cols: [
                {
                    view: "combo", label: 'Forma Pagamento', name: "ffpNome", id: "idCombo_ffpNome_ffp", labelPosition: "top", options: { body: { template: "#ffpNome#", yCount: 7, url: BASE_URL + "CFinancas_Forma_Pagamento/read" } },
                    on: {
                        "onChange": function (newv, oldv) {
                            //ACTUALIZAR COMBO CONTAS
                            if (this.getValue() == "2") //TPA
                                $$("idText_fpcRefPagamento_ffp").disable();
                            else
                                $$("idText_fpcRefPagamento_ffp").enable();
                        }
                    }
                },
                { view: "text", label: 'Referência Pagamento', name: "fpcRefPagamento", id: "idText_fpcRefPagamento_ffp", validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                {},
                { view: "text", label: 'id', name: "id", id: "idText_id_ffp", hidden: true, validate: "isNotEmpty", validateEvent: "blur" },
                // { view: "text", label: 'efeito', name: "efeito", id: "idText_efeito", hidden: true, validate: "isNotEmpty", validateEvent: "blur" },
                // { view: "text", label: 'efeito', name: "efeito", id: "idText_td", hidden: true, validate: "isNotEmpty", validateEvent: "blur" },

                { view: "text", label: 'Valor a Pagar (Kz)', name: "fpcValor", id: "idText_fceValor_ffp", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                {
                    view: "button", value: "Salvar", click: function () {
                        //criar PDF
                        idSelecionado = $$("idText_id_ffp").getValue();
                        var cNome = $$('idText_cNome_ffp').getValue();
                        var cBI = $$('idText_cBI_ffp').getValue();
                        var bancNome = $$('idCombo_bancNome_ffp').getValue();
                        var contNumero = $$('idCombo_contNumero_ffp').getValue();
                        var ffpNome = $$('idCombo_ffpNome_ffp').getValue();
                        var fpcRefPagamento = $$("idText_fpcRefPagamento_ffp").getValue();
                        var fpcValor = $$("idText_fceValor_ffp").getValue();

                        if (idSelecionado && bancNome && contNumero && ffpNome && fpcValor) {
                            var envio_rfc = "id=" + idSelecionado +
                                "&bi=" + cBI +
                                "&fc_valor=" + fpcValor +
                                "&bancNome=" + bancNome +
                                "&contNumero=" + contNumero +
                                "&ffpNome=" + ffpNome +
                                "&fc_ref_pag=" + fpcRefPagamento +
                                "&utilizadores_id=" + user_sessao +
                                "&webix_operation=insert";
                            let rfc = webix.ajax().sync().post(BASE_URL + "CFinancas_folha_prova/crud", envio_rfc);
                            if (rfc.responseText == "true") {
                                webix.message("Pagamento registrado com sucesso");
                                // criar PDF

                                var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Folha_Prova_Comprobativo/imprimir", envio_rfc);
                                if (r.responseText == "true") {
                                    webix.message("PDF criado com sucesso");
                                    //Carregar PDF
                                    webix.ui({
                                        view: "window",
                                        id: "idWinPDF_Comprobativo_ffp",
                                        height: 600,
                                        width: 700,
                                        left: 50, top: 50,
                                        move: true,
                                        modal: false,
                                        //head:"This window can be moved",
                                        head: {
                                            view: "toolbar", cols: [
                                                { view: "label", label: "Finan&ccedil;as Comprovativo Folha Prova." },
                                                { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDF_Comprobativo_ffp').close(); } }
                                            ]
                                        },
                                        body: {
                                            //template:"Some text"
                                            template: '<div id="idPDF_Comprobativo_ffp" style="width:690px;  height:590px"></div>'
                                        }
                                    }).show();
                                    PDFObject.embed("../../relatorios/Financas_Folha_Prova_Comprovativo.pdf", "#idPDF_Comprobativo_ffp");
                                    //fechar a windows e limpar todo
                                    if ($$("idtext_bi_ffp").getValue() !== "") {
                                        $$("idtext_bi_ffp").setValue("");
                                    }
                                    $$("id_win_ffp").close();

                                } else {
                                    webix.message({ type: "error", text: "Erro ao criar comprobativo." });
                                }

                            } else {
                                webix.message({ type: "error", text: "Erro ao registrar dados em finanças." });
                            }
                        } else {
                            webix.message({ type: "error", text: "Deve selecionar os campos obrigatorio." });
                        }
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        //limpar combo de codigo de barra para a proxima busca
                        if ($$("idtext_bi_ffp").getValue() !== "") {
                            $$("idtext_bi_ffp").setValue("");
                        }
                        $$("id_win_ffp").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
