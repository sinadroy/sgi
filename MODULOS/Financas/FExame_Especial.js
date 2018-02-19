function cargarVistaFExame_Especial(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Pagamentos Exame Recurso", body: {

                    rows: [
                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    cols: [
                                        { view: "text", label: 'BI / Passaporte (Estudantes)', name: "cbi_passaporte", id: "idtext_bi_fexr", width: 300, labelPosition: "top" },
                                        {
                                            view: "button", type: "form", value: "Carregar", width: 120, click: function () {

                                                var bi = $$("idtext_bi_fexr").getValue();

                                                var envio = "bi=" + bi;
                                                var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxBI", envio);
                                                var candidato_id = rbi.responseText;

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeCompletoXID", envio);
                                                var nome_completo_candidato = r1.responseText;
                                                $$("idtext_nome_completo_fexr").setValue(nome_completo_candidato);

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Nivel_NomeXCandidato_id", envio);
                                                var nivel = r1.responseText;
                                                $$("idtext_nnome_fexr").setValue(nivel);

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Curso_NomeXCandidato_id", envio);
                                                var curso = r1.responseText;
                                                $$("idtext_cnome_fexr").setValue(curso);

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Periodo_NomeXCandidato_id", envio);
                                                var periodo = r1.responseText;
                                                $$("idtext_pnome_fexr").setValue(periodo);

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_AC_NomeXCandidato_id", envio);
                                                var ac = r1.responseText;
                                                $$("idtext_acnome_fexr").setValue(ac);

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Semestre_NomeXCandidato_id", envio);
                                                var s = r1.responseText;
                                                $$("idtext_snome_fexr").setValue(s);

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Turma_NomeXCandidato_id", envio);
                                                var t = r1.responseText;
                                                $$("idtext_tnome_fexr").setValue(t);
                                            }
                                        },
                                        {}
                                    ]
                                }, {
                                    cols: [
                                        { view: "text", label: 'Nome Completo', name: "cnome", id: "idtext_nome_completo_fexr", readonly: true, disabled: true, width: 350, labelPosition: "top" },
                                        { view: "text", label: 'Nível', name: "nnome", id: "idtext_nnome_fexr", readonly: true, disabled: true, width: 200, labelPosition: "top" },
                                        { view: "text", label: 'Curso', name: "cnome", id: "idtext_cnome_fexr", readonly: true, disabled: true, width: 400, labelPosition: "top" },
                                        { view: "text", label: 'Período', name: "pnome", id: "idtext_pnome_fexr", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                                        //{ view: "text", label: 'Nível', name: "nnome", id: "idtext_nnome", readonly: true, width: 400, labelPosition:"top"},
                                        {}
                                    ]
                                },
                                {
                                    cols: [
                                        { view: "text", label: 'Ano Curricular', name: "acnome", id: "idtext_acnome_fexr", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                                        { view: "text", label: 'Semestre Actual', name: "snome", id: "idtext_snome_fexr", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                                        { view: "text", label: 'Turma Actual', name: "tnome", id: "idtext_tnome_fexr", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                                        {
                                            view: "button", type: "form", value: "Pagar", width: 120, click: function () {
                                                var envio = "bi=" + $$('idtext_bi_fexr').getValue();
                                                var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxBI", envio);
                                                var candidato_id = rbi.responseText;
                                                if ($$('idtext_bi_fexr').getValues !== "") {
                                                    if (candidato_id !== "false") {
                                                        //levantar interface de pagamento
                                                        webix.ui({
                                                            view: "window",
                                                            id: "id_win_fexr",
                                                            width: 600,
                                                            position: "center",
                                                            modal: true,
                                                            head: "Pagamento Exame Recurso",
                                                            body: webix.copy(formADDPagFEXR)
                                                        }).show();

                                                        //cargar Nome do candidato
                                                        var envio = "id=" + candidato_id; //this.getValue();
                                                        var r1 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeCompletoXID", envio);
                                                        var nome_completo_candidato = r1.responseText;
                                                        $$("idText_cNome_fexr").setValue(nome_completo_candidato);

                                                        //cargar BI
                                                        var envio = "id=" + candidato_id; //this.getValue();
                                                        var r2 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readBIxID", envio);
                                                        var bi_candidato = r2.responseText;
                                                        $$("idText_cBI_fexr").setValue(bi_candidato);


                                                        //Actualizar grid da windows
                                                        $$("idDTFormFEXR").clearAll();
                                                        $$("idDTFormFEXR").load(BASE_URL + "CFinancas_Pagamentos_Pendientes_Documentos/read_ncpXid_fd?id=" + candidato_id/*this.getValue()*/);

                                                        // obtener id de niveis_cursos
                                                        let envio1 = "n=" + $$('idtext_nnome_fexr').getValue() + "&c=" + $$('idtext_cnome_fexr').getValue() + "&p=" + $$('idtext_cnome_fexr').getValue();
                                                        let rncp = webix.ajax().sync().post(BASE_URL + "CNiveisCursos/read_x_ncp_nomes", envio1);
                                                        let id_ncp = rncp.responseText;

                                                        //actualizar valor total a pagar
                                                        var envio2 = "id_ncp=" + id_ncp;
                                                        var r3 = webix.ajax().sync().post(BASE_URL + "CPagamentos_Comprobativo_Prec/read_precario_exame_recurso", envio2);
                                                        var total_pagar = r3.responseText;
                                                        $$("idText_fceValor_fexr").setValue(total_pagar);
                                                        $$("idText_fceValor_fexr").disable();
                                                        //mandar este valor para que despues sea mandado para mFinancas_Inscricao_Comprobativo
                                                        // cargar efeito na janela de pagamento
                                                        // $$("idText_efeito").setValue($$('idCB_mnome_ed').getValue());
                                                        // $$("idText_td").setValue($$('idCB_tdnome_ed').getValue());
                                                        $$("idText_id_fexr").setValue(candidato_id);

                                                        // cargar disciplinas por nivel curso periodo
                                                        // Nivel id
                                                        var envio = "id=" + candidato_id; //this.getValue();
                                                        var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_NivelXCandidato_id", envio);
                                                        var nivel = r1.responseText;
                                                        // Curso id
                                                        var envio = "id=" + candidato_id; //this.getValue();
                                                        var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_CursoXCandidato_id", envio);
                                                        var curso = r1.responseText;
                                                        // Periodo id
                                                        var envio = "id=" + candidato_id; //this.getValue();
                                                        var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_PeriodoXCandidato_id", envio);
                                                        var periodo = r1.responseText;
                                                        // Ano Curricular id
                                                        var envio = "id=" + candidato_id; //this.getValue();
                                                        var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_ACXCandidato_id", envio);
                                                        var ac = r1.responseText;

                                                        var envio_combo_dic = "nNome=" + nivel + "&cNome=" + curso + "&pNome=" + periodo + "&acNome=" + ac;
                                                        $$("idCB_dNome_fexr").getList().clearAll();
                                                        $$("idCB_dNome_fexr").getList().load(BASE_URL + "CDiscilplinas/readXancp?"+envio_combo_dic);
                                                        
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
                                                $$("idDTEdFEXR").clearAll();
                                                $$("idDTEdFEXR").load(BASE_URL + "CFinancas_exame_recurso/read");
                                            }
                                        },
                                        {}
                                    ]
                                },
                                {
                                    view: "datatable",
                                    id: "idDTEdFEXR",
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
                                    url: BASE_URL + "CFinancas_exame_recurso/read",
                                    pager: "pagerFEXR"
                                }, {
                                    view: "pager", id: "pagerFEXR",
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
var formADDPagFEXR = {
    view: "form",
    id: "idformADDPagFEXR",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "datatable",
                    height: 150,
                    id: "idDTFormFEXR",
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
                { view: "text", label: 'Nome Completo', name: "cNome", id: "idText_cNome_fexr", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'BI/Passaporte', name: "cBI", id: "idText_cBI_fexr", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                {
                    view: "combo", label: 'Banco', name: "bancNome", id: "idCombo_bancNome_fexr", labelPosition: "top", options: { body: { template: "#bancNome#", yCount: 7, url: BASE_URL + "CFinancas_Bancos/read" } },
                    on: {
                        "onChange": function (newv, oldv) {
                            //ACTUALIZAR COMBO CONTAS
                            $$("idCombo_contNumero_fexr").getList().clearAll();
                            $$("idCombo_contNumero_fexr").getList().load(BASE_URL + "CFinancas_Contas/readXbanco?id=" + this.getValue());
                        }
                    }
                },
                { view: "combo", label: 'Conta', name: "contNumero", id: "idCombo_contNumero_fexr", labelPosition: "top", options: { body: { template: "#contNumero#", yCount: 7, url: BASE_URL + "CFinancas_Contas/read" } } },
            ]
        },
        {
            cols: [
                {
                    view: "combo", label: 'Forma Pagamento', name: "ffpNome", id: "idCombo_ffpNome_fexr", labelPosition: "top", options: { body: { template: "#ffpNome#", yCount: 7, url: BASE_URL + "CFinancas_Forma_Pagamento/read" } },
                    on: {
                        "onChange": function (newv, oldv) {
                            //ACTUALIZAR COMBO CONTAS
                            if (this.getValue() == "2") //TPA
                                $$("idText_fpcRefPagamento_fexr").disable();
                            else
                                $$("idText_fpcRefPagamento_fexr").enable();
                        }
                    }
                },
                { view: "text", label: 'Referência Pagamento', name: "fpcRefPagamento", id: "idText_fpcRefPagamento_fexr", validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                {
                    view: "combo", id: "idCB_dNome_fexr",
                    label: 'Disciplina', name: "dNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#dNome#",
                            yCount: 7,
                            url: BASE_URL + "CDisciplinas/read"
                        }
                    },
                },
                // { view: "text", label: 'efeito', name: "efeito", id: "idText_efeito", hidden: true, validate: "isNotEmpty", validateEvent: "blur" },
                // { view: "text", label: 'efeito', name: "efeito", id: "idText_td", hidden: true, validate: "isNotEmpty", validateEvent: "blur" },

                { view: "text", label: 'Valor a Pagar (Kz)', name: "fpcValor", id: "idText_fceValor_fexr", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
            // oculto
        { view: "text", label: 'id', name: "id", id: "idText_id_fexr", hidden: true, validate: "isNotEmpty", validateEvent: "blur" },

        {
            cols: [
                {
                    view: "button", value: "Salvar", click: function () {
                        //criar PDF
                        idSelecionado = $$("idText_id_fexr").getValue();
                        var cNome = $$('idText_cNome_fexr').getValue();
                        var cBI = $$('idText_cBI_fexr').getValue();
                        var bancNome = $$('idCombo_bancNome_fexr').getValue();
                        var contNumero = $$('idCombo_contNumero_fexr').getValue();
                        var ffpNome = $$('idCombo_ffpNome_fexr').getValue();
                        var fpcRefPagamento = $$("idText_fpcRefPagamento_fexr").getValue();
                        var fpcValor = $$("idText_fceValor_fexr").getValue();

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
                            let rfc = webix.ajax().sync().post(BASE_URL + "CFinancas_exame_recurso/crud", envio_rfc);
                            if (rfc.responseText == "true") {
                                webix.message("Pagamento registrado com sucesso");
                                // criar PDF

                                var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Exame_Recurso_Comprobativo/imprimir", envio_rfc);
                                if (r.responseText == "true") {
                                    webix.message("PDF criado com sucesso");
                                    //Carregar PDF
                                    webix.ui({
                                        view: "window",
                                        id: "idWinPDF_Comprobativo_fexr",
                                        height: 600,
                                        width: 700,
                                        left: 50, top: 50,
                                        move: true,
                                        modal: false,
                                        //head:"This window can be moved",
                                        head: {
                                            view: "toolbar", cols: [
                                                { view: "label", label: "Finan&ccedil;as Comprovativo Exame Recurso." },
                                                { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDF_Comprobativo_fexr').close(); } }
                                            ]
                                        },
                                        body: {
                                            //template:"Some text"
                                            template: '<div id="idPDF_Comprobativo_fexr" style="width:690px;  height:590px"></div>'
                                        }
                                    }).show();
                                    PDFObject.embed("../../relatorios/Financas_Exame_Recurso_Comprovativo.pdf", "#idPDF_Comprobativo_fexr");
                                    //fechar a windows e limpar todo
                                    if ($$("idtext_bi_fexr").getValue() !== "") {
                                        $$("idtext_bi_fexr").setValue("");
                                    }
                                    $$("id_win_fexr").close();

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
                        if ($$("idtext_bi_fexr").getValue() !== "") {
                            $$("idtext_bi_fexr").setValue("");
                        }
                        $$("id_win_fexr").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
