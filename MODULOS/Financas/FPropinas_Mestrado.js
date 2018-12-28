function cargarVistaFPropinas_mestrado(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 850,
        cells: [
            {
                //regime e sessao na BD
                header: "Pagamentos de Propinas Mestrado", body: {

                    rows: [
                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    cols: [
                                        {
                                            view: "richselect", /*width: 80,*/ id: "idCBal_Propinas_mestrado",
                                            label: 'Ano Lectivo de Ingresso', name: "alAno",
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
                                            //readIDxBI
                                            view: "text", label: 'Localizar por BI', name: "cBI_Passaporte", id: "idText_cBI_Passaporte_Propinas_mestrado", labelPosition: "top",
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    var envio = "bi=" + this.getValue();
                                                    var r = webix.ajax().sync().post(BASE_URL + "cCandidatos/Existe_BI", envio);
                                                    if ($$('idCBal_Propinas_mestrado').getValue() !== "") {
                                                        if (r.responseText == "false")
                                                            webix.message({ type: "error", text: "O BI inserido n&atilde;o &eacute; v&aacute;lido" });
                                                        else {
                                                            var envio = "bi=" + this.getValue();
                                                            var rper = webix.ajax().sync().post(BASE_URL + "CEstudantes/Get_PeriodoXEstudante_id", envio);
                                                            if (rper.responseText == '2') {
                                                                var envio = "bi=" + this.getValue() + "&alAno=" + $$('idCBal_Propinas_mestrado').getValue();
                                                                var r1 = webix.ajax().sync().post(BASE_URL + "Cpagamentos_propina_mestrado/Existe_Pagamento", envio);

                                                                $$("idDTPropinas_mestrado").clearAll();
                                                                $$("idDTPropinas_mestrado").load(BASE_URL + "Cpagamentos_propina_mestrado/readX?bi=" + this.getValue() + "&alano=" + $$('idCBal_Propinas_mestrado').getValue());
                                                            } else
                                                                webix.message({ type: "error", text: "O BI corresponde a um estudante do curso regular" });

                                                        }
                                                    } else
                                                        webix.message({ type: "error", text: "Falta selecionar ano lectivo." });

                                                    //$$("idDTPropinas").clearAll();
                                                    //$$("idDTPropinas").load(BASE_URL + "Cpagamentos_propina/readX?bi=" + this.getValue());
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
                                                $$("idDTPropinas_mestrado").clearAll();
                                                $$("idDTPropinas_mestrado").load(BASE_URL + "Cpagamentos_propina_mestrado/read");
                                                //$$("idText_cBI_Passaporte_Propinas").setValue("");
                                            }
                                        },
                                        {
                                            view: "button", type: "form", value: "Pagar", width: 120, height: 50, click: function () {
                                                var rowId = $$("idDTPropinas_mestrado").getSelectedId(false, true);
                                                var record = $$("idDTPropinas_mestrado").getItem(rowId);

                                                if (rowId) {
                                                    if ($$('idCBal_Propinas_mestrado').getValue() !== "" || $$('idText_cBI_Passaporte_Propinas_mestrado').getValue() !== "") {
                                                        if (record.ppValor !== '0') {
                                                            webix.message({ type: "error", text: "Este pagamento ja foi feito" });
                                                        } else {
                                                            webix.ui({
                                                                view: "window",
                                                                id: "id_win_Pag_Proopinas_mestrado",
                                                                width: 600,
                                                                position: "center",
                                                                modal: true,
                                                                move: true,
                                                                head: "Pagamento de Propina",
                                                                body: webix.copy(formADDPagamentoPropinas_mestrado)
                                                            }).show();
                                                            //optener id apartir del bi
                                                            var envio = "bi=" + record.cBI_Passaporte;//this.getValue();
                                                            var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxBI", envio);
                                                            var candidato_id = rbi.responseText;
                                                            //cargar Nome do candidato
                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var rnc = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeCompletoXID", envio);
                                                            var nome_completo_candidato = rnc.responseText;
                                                            $$("idText_cNome_Propinas_mestrado").setValue(nome_completo_candidato);
                                                            //cargar bi
                                                            $$("idText_cBI_Propinas_mestrado").setValue(record.cBI_Passaporte);
                                                            //ver porciento de multa a cobrar
                                                            var envio = "mes_a_pagar=" + record.mesNome + "&ano_a_pagar=" + $$('idCBal_Propinas_mestrado').getText(); //this.getValue();
                                                            var rporc = webix.ajax().sync().post(BASE_URL + "Cmultas_propina_mestrado/read_porciento", envio);
                                                            var multa_pc_pagar = rporc.responseText;
                                                            $$("idText_mp_porciento_mestrado").setValue(multa_pc_pagar);
                                                            //cargar valor total a pagar
                                                            var envio = "bi=" + record.cBI_Passaporte + "&mes_a_pagar=" + record.mesNome + "&ano_a_pagar=" + $$('idCBal_Propinas_mestrado').getText(); //this.getValue();
                                                            var rprop = webix.ajax().sync().post(BASE_URL + "Cpagamentos_propina_mestrado/readXvalor_propina", envio);
                                                            var total_pagar = rprop.responseText;
                                                            $$("idText_fpcValor_Propinas_mestrado").setValue(total_pagar);
                                                            $$("idText_fpcValor_Propinas_mestrado").disable();
                                                            //cargar id para enviar al salvar datos
                                                            $$("idText_id_Propinas_mestrado").setValue(record.id);
                                                            //cargar ano lectivo para enviar
                                                            $$("idText_alAno_Propinas_mestrado").setValue($$('idCBal_Propinas_mestrado').getValue());
                                                            //cargar mes a pagar
                                                            $$("idText_mesNome_Propinas_mestrado").setValue(record.mesNome);
                                                            //cargar id del estudiante
                                                            $$("idText_eid_Propinas_mestrado").setValue(record.eid);

                                                        }
                                                    } else
                                                        webix.message({ type: "error", text: "Deve seleccionar primeiro ano lectivo e BI" });
                                                } else
                                                    webix.message({ type: "error", text: "Deve seleccionar primeiro uma linha" });
                                            }
                                        },
                                        {
                                            view: "button", width: 120, value: "Reimprimir Comprovativo", click: function () {
                                                //criar PDF
                                                var idSelecionado = $$("idDTPropinas_mestrado").getSelectedId(false, true);
                                                var record = $$("idDTPropinas_mestrado").getItem(idSelecionado);
                                                //var bancNome = $$("idCombo_bancNome_Propinas").getValue();
                                                //var contNumero = $$("idCombo_contNumero_Propinas").getValue();
                                                //var ffpNome = $$("idCombo_ffpNome_Propinas").getValue();
                                                var alAno = record.alAno;
                                                var mesNome = record.mesNome;
                                                var eid = record.eid;

                                                if (idSelecionado && alAno && mesNome && eid) {
                                                    var envio = "id=" + idSelecionado +
                                                        "&anos_lectivos_id=" + alAno +
                                                        "&mesNome=" + mesNome +
                                                        "&Estudantes_id=" + eid +
                                                        "&utilizadores_id=" + user_sessao +
                                                        "&bi=" + record.cBI_Passaporte +
                                                        "&mes_a_pagar=" + record.mesNome +
                                                        "&ano_a_pagar=" + $$('idCBal_Propinas_mestrado').getText();
                                                    //registrar pagamento
                                                    var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Propina_mestrado_Comprovativo_REIMP/imprimir", envio);
                                                    if (r.responseText == "true") {
                                                        webix.message("PDF criado com sucesso");
                                                        //Carregar PDF
                                                        webix.ui({
                                                            view: "window",
                                                            id: "idWinPDF_Propinas_mestrado_Comprobativo_Reimp",
                                                            height: 600,
                                                            width: 700,
                                                            left: 50, top: 50,
                                                            move: true,
                                                            modal: false,
                                                            //head:"This window can be moved",
                                                            head: {
                                                                view: "toolbar", cols: [
                                                                    { view: "label", label: "Finan&ccedil;as Comprovativo de Propina" },
                                                                    { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDF_Propinas_mestrado_Comprobativo_Reimp').close(); } }
                                                                ]
                                                            },
                                                            body: {
                                                                //template:"Some text"
                                                                template: '<div id="idPDF_Propinas_mestrado_Comprobativo_Reimp" style="width:690px;  height:590px"></div>'
                                                            }
                                                        }).show();
                                                        PDFObject.embed("../../relatorios/Financas_Propina_mestrado_Comprovativo_Reimp.pdf", "#idPDF_Propinas_mestrado_Comprobativo_Reimp");

                                                        //actualizar grid
                                                        var campo_bi = $$("idText_cBI_Passaporte_Propinas_mestrado").getValue();
                                                        if (campo_bi) {
                                                            $$("idDTPropinas_mestrado").clearAll();
                                                            $$("idDTPropinas_mestrado").load(BASE_URL + "Cpagamentos_propina_mestrado/readX?bi=" + campo_bi);
                                                        } else {
                                                            $$("idDTPropinas_mestrado").clearAll();
                                                            $$("idDTPropinas_mestrado").load(BASE_URL + "Cpagamentos_propina_mestrado/read");
                                                        }
                                                    } else {
                                                        webix.message({ type: "error", text: "Erro atualizando dados" });
                                                    }
                                                } else {
                                                    webix.message({ type: "error", text: "Deve selecionar os campos obrigatorio" });
                                                }
                                            }
                                        },
                                        //Cancelar_Pagamento
                                        {
                                            view: "button", type: "danger", value: "Cancelar Pag.", disabled: true, id: "idbtn_cancelar_pag_mestrado", width: 120, height: 50, click: function () {
                                                var idSelecionado = $$("idDTPropinas_mestrado").getSelectedId(false, true);
                                                var record = $$("idDTPropinas_mestrado").getItem(idSelecionado);
                                                if (idSelecionado) {
                                                    var envio = "id=" + idSelecionado + "&cNome=" + record.cNome +
                                                        "&cApelido=" + record.cApelido + "&cBI_Passaporte=" + record.cBI_Passaporte +
                                                        "&utilizadores_id=" + user_sessao;
                                                    var rpag = webix.ajax().sync().post(BASE_URL + "Cpagamentos_propina_mestrado/cancelar_pagamento", envio);
                                                    if (rpag.responseText == "true") {
                                                        webix.message("Pagamento cancelado com sucesso");
                                                        $$("idDTPropinas_mestrado").clearAll();
                                                        $$("idDTPropinas_mestrado").load(BASE_URL + "Cpagamentos_propina_mestrado/read");
                                                    }
                                                } else {
                                                    webix.message({ type: "error", text: "Deve selecionar primeiro um pagamento" });
                                                }
                                            }
                                        },
                                        {
                                            view: "button", type: "form", value: "Imp. Dividas", width: 120, height: 50, click: function () {
                                                webix.ui({
                                                    view: "window",
                                                    id: "id_win_dividas_mestrado",
                                                    width: 900,
                                                    height: 750,
                                                    position: "center",
                                                    modal: true,
                                                    move: true,
                                                    head: "Dividas Propinas Mestrado",
                                                    body: webix.copy(form_dividas_mestrado)
                                                }).show();
                                            }
                                        },
                                        {}
                                    ]
                                }
                            ]

                        }, {
                            view: "datatable",
                            id: "idDTPropinas_mestrado",
                            select: "row", /*editable: true, editaction: "click",*/
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "eid", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "cid", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                //{ id: "fpc_id", header: "fpc_id", hidden: true, css: "rank", width: 30, sort: "int" },

                                { id: "ord", header: "Nº", width: 60, sort: "int" },
                                { id: "alAno", header: ["Ano Lectivo", { content: "textFilter" }], width: 100, sort: "int" },
                                {
                                    id: "mesNome", header: ["Mes", { content: "selectFilter" }], width: 170, sort: "string",
                                    template: function (obj) {
                                        if (obj.ppValor == 0)
                                            return "<span style='color:red;'>" + obj.mesNome + "</span>";
                                        else
                                            return "<span style='color:green;'>" + obj.mesNome + "</span>";

                                    },
                                },
                                { id: "ppValor", header: "Valor", width: 100, sort: "int" },
                                { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "cBI_Passaporte", header: ["BI-Pass.", { content: "textFilter" }], width: 170, sort: "strig" },
                                { id: "ppData", header: ["Data", { content: "textFilter" }], width: 170, sort: "strig" },
                                { id: "ppHora", header: ["Hora", { content: "textFilter" }], width: 170, sort: "strig" },
                            ],
                            url: BASE_URL + "Cpagamentos_propina_mestrado/read",
                            pager: "pagerDadosPropinas_mestrado"
                        }, {
                            view: "pager", id: "pagerDadosPropinas_mestrado",
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
        $$("idbtn_cancelar_pag_mestrado").enable();
    }
}
//Pagamento de Inscricao
var formADDPagamentoPropinas_mestrado = {
    view: "form",
    id: "idformADDPagamentoPropinas_mestrado",
    borderless: true,
    elements: [
        {
            cols: [
                { view: "text", label: 'Nome Completo', name: "cNome", id: "idText_cNome_Propinas_mestrado", readonly: true },
                { view: "text", label: 'BI/Passaporte', name: "cBI", id: "idText_cBI_Propinas_mestrado", readonly: true },
            ]
        },
        {
            cols: [
                {
                    view: "combo", label: 'Banco', name: "bancNome", id: "idCombo_bancNome_Propinas_mestrado", labelPosition: "top", options: { body: { template: "#bancNome#", yCount: 7, url: BASE_URL + "CFinancas_Bancos/read" } },
                    on: {
                        "onChange": function (newv, oldv) {
                            //ACTUALIZAR COMBO CONTAS
                            $$("idCombo_contNumero_Propinas_mestrado").getList().clearAll();
                            $$("idCombo_contNumero_Propinas_mestrado").getList().load(BASE_URL + "CFinancas_Contas/readXbanco?id=" + this.getValue());
                        }
                    }
                },
                { view: "combo", label: 'Conta', name: "contNumero", id: "idCombo_contNumero_Propinas_mestrado", labelPosition: "top", options: { body: { template: "#contNumero#", yCount: 7, url: BASE_URL + "CFinancas_Contas/read" } } },
            ]
        },
        {
            cols: [
                {
                    view: "combo", label: 'Forma Pagamento', name: "ffpNome", id: "idCombo_ffpNome_Propinas_mestrado", labelPosition: "top", options: { body: { template: "#ffpNome#", yCount: 7, url: BASE_URL + "CFinancas_Forma_Pagamento/read" } },
                    on: {
                        "onChange": function (newv, oldv) {
                            //ACTUALIZAR COMBO CONTAS
                            if (this.getValue() == "2") //TPA
                                $$("idText_fpcRefPagamento_Propinas_mestrado").disable();
                            else
                                $$("idText_fpcRefPagamento_Propinas_mestrado").enable();
                        }
                    }
                },
                { view: "text", label: 'Referência Pagamento', name: "fpcRefPagamento", id: "idText_fpcRefPagamento_Propinas_mestrado", validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                { view: "text", label: 'id', name: "id", id: "idText_id_Propinas_mestrado", hidden: true },
                { view: "text", label: 'alAno', name: "id", id: "idText_alAno_Propinas_mestrado", hidden: true },
                { view: "text", label: 'mesNome', name: "id", id: "idText_mesNome_Propinas_mestrado", hidden: true },
                { view: "text", label: 'eid', name: "id", id: "idText_eid_Propinas_mestrado", hidden: true },

                { view: "text", label: 'Multa %', name: "mp_porciento", id: "idText_mp_porciento_mestrado", readonly: true, disabled: true, validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Valor a Pagar (Kz)', name: "fpcValor", id: "idText_fpcValor_Propinas_mestrado", readonly: true, validate: "isNotEmpty", validateEvent: "blur" },
            ]
        },
        {
            cols: [
                {
                    view: "button", value: "Salvar", click: function () {
                        //criar PDF
                        idSelecionado = $$("idText_id_Propinas_mestrado").getValue();
                        var bancNome = $$("idCombo_bancNome_Propinas_mestrado").getValue();
                        var contNumero = $$("idCombo_contNumero_Propinas_mestrado").getValue();
                        var ffpNome = $$("idCombo_ffpNome_Propinas_mestrado").getValue();
                        var alAno = $$("idText_alAno_Propinas_mestrado").getValue();
                        var mesNome = $$("idText_mesNome_Propinas_mestrado").getValue();
                        var eid = $$("idText_eid_Propinas_mestrado").getValue();

                        if (idSelecionado && bancNome && contNumero && ffpNome) {
                            var envio = "id=" + idSelecionado +
                                "&ppValor=" + $$("idText_fpcValor_Propinas_mestrado").getValue() +
                                "&anos_lectivos_id=" + alAno +
                                "&mesNome=" + mesNome +
                                "&Estudantes_id=" + eid +
                                "&utilizadores_id=" + user_sessao +
                                "&Financas_Forma_Pagamento_id=" + ffpNome +
                                "&Financas_Contas_id=" + contNumero +
                                "&bancNome=" + bancNome +
                                "&fpcRefPagamento=" + $$("idText_fpcRefPagamento_Propinas_mestrado").getValue() +
                                "&cNome=" + $$("idText_cNome_Propinas_mestrado").getValue() +
                                "&bi=" + $$("idText_cBI_Propinas_mestrado").getValue() +
                                "&webix_operation=update";
                            //registrar pagamento
                            var rpag = webix.ajax().sync().post(BASE_URL + "Cpagamentos_propina_mestrado/crud", envio);
                            if (rpag.responseText == "true") {
                                var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Propina_mestrado_Comprovativo/imprimir", envio);
                                if (r.responseText == "true") {
                                    webix.message("PDF criado com sucesso");
                                    //Carregar PDF
                                    webix.ui({
                                        view: "window",
                                        id: "idWinPDF_Propinas_Comprobativo_mestrado",
                                        height: 600,
                                        width: 700,
                                        left: 50, top: 50,
                                        move: true,
                                        modal: false,
                                        //head:"This window can be moved",
                                        head: {
                                            view: "toolbar", cols: [
                                                { view: "label", label: "Finan&ccedil;as Comprovativo de Propina" },
                                                { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDF_Propinas_Comprobativo_mestrado').close(); } }
                                            ]
                                        },
                                        body: {
                                            //template:"Some text"
                                            template: '<div id="idPDF_Propinas_mestrado_Comprobativo" style="width:690px;  height:590px"></div>'
                                        }
                                    }).show();
                                    PDFObject.embed("../../relatorios/Financas_Propina_mestrado_Comprovativo.pdf", "#idPDF_Propinas_mestrado_Comprobativo");
                                    //actualizar grid
                                    $$("idDTPropinas_mestrado").clearAll();
                                    $$("idDTPropinas_mestrado").load(BASE_URL + "Cpagamentos_propina_mestrado/readX?bi=" + $$("idText_cBI_Propinas_mestrado").getValue());
                                    //fechar a windows e limpar todo
                                    $$("id_win_Pag_Proopinas_mestrado").close();
                                } else {
                                    webix.message({ type: "error", text: "Erro atualizando dados" });
                                }
                            } else {
                                webix.message({ type: "error", text: "Erro ao actualizar pagamento" });
                            }
                        } else {
                            webix.message({ type: "error", text: "Deve selecionar os campos obrigatorio" });
                        }
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("id_win_Pag_Proopinas_mestrado").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

var form_dividas_mestrado = {
    view: "form",
    id: "idform_dividas_mestrado",
    borderless: true,
    elements: [
        {
            cols: [
                {
                    view: "richselect", width: 100, id: "id_CB_alAno_LD_mestrado",
                    label: 'Ano Lectivo', name: "alAno",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#alAno#",
                            yCount: 7,
                            url: BASE_URL + "CAnos_Lectivos/read"
                        }
                    }, on: {
                        "onChange": function (newv, oldv) {
                            var al = $$("id_CB_alAno_LD_mestrado").getValue();
                            var n = $$("id_CB_nNome_LD_mestrado").getValue();
                            var c = $$("id_CB_cNome_LD_mestrado").getValue();
                            var p = $$("id_CB_pNome_LD_mestrado").getValue();
                            var ac = $$("id_CB_acNome_LD_mestrado").getValue();

                            if (n && c && p && ac) {
                                $$("id_CB_tNome_LD_mestrado").getList().clearAll();
                                $$("idLI_CB_tNome_LD_mestrado").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                            }
                        }
                    }
                },
                {
                    view: "richselect", width: 150, id: "id_CB_nNome_LD_mestrado",
                    label: 'Nivel', name: "nNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#nNome#",
                            yCount: 7,
                            url: BASE_URL + "cNiveis/read"
                        }
                    },
                    on: {
                        "onChange": function (newv, oldv) {

                            var n = $$("id_CB_nNome_LD_mestrado").getValue();
                            var c = $$("id_CB_cNome_LD_mestrado").getValue();
                            var p = $$("id_CB_pNome_LD_mestrado").getValue();
                            var ac = $$("id_CB_acNome_LD_mestrado").getValue();

                            if (n) {
                                $$("id_CB_cNome_LD_mestrado").getList().clearAll();
                                $$("id_CB_cNome_LD_mestrado").getList().load(BASE_URL + "Ccursos/readXn?nNome=" + this.getValue());
                            }

                            if (n && c && p && ac) {
                                $$("id_CB_tNome_L_mestrado").getList().clearAll();
                                $$("id_CB_tNome_LD_mestrado").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                            }
                        }
                    }
                },
                {
                    view: "richselect", /*width: 450,*/ id: "id_CB_cNome_LD_mestrado",
                    label: 'Curso', name: "cNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#cNome#",
                            yCount: 7,
                            url: BASE_URL + "cCursos/read"
                        }
                    },
                    on: {
                        "onChange": function (newv, oldv) {
                            var n = $$("id_CB_nNome_LD_mestrado").getValue();
                            var c = $$("id_CB_cNome_LD_mestrado").getValue();
                            var p = $$("id_CB_pNome_LD_mestrado").getValue();
                            var ac = $$("id_CB_acNome_LD_mestrado").getValue();

                            if (n && c && p && ac) {
                                $$("id_CB_tNome_LD_mestrado").getList().clearAll();
                                $$("id_CB_tNome_LD_mestrado").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                            }

                        }
                    }
                },
                {
                    view: "richselect", width: 125, value: 2, disabled: true, id: "id_CB_pNome_LD_mestrado",
                    label: 'Periodo', name: "pNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#pNome#",
                            yCount: 7,
                            url: BASE_URL + "cPeriodos/read"
                        }
                    },
                    on: {
                        "onChange": function (newv, oldv) {
                            var n = $$("id_CB_nNome_LD_mestrado").getValue();
                            var c = $$("id_CB_cNome_LD_mestrado").getValue();
                            var p = $$("id_CB_pNome_LD_mestrado").getValue();
                            var ac = $$("id_CB_acNome_LD_mestrado").getValue();

                            if (n && c && p && ac) {
                                $$("id_CB_tNome_LD_mestrado").getList().clearAll();
                                $$("id_CB_tNome_LD_mestrado").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                            }

                        }
                    }
                }
            ]
        },
        {
            cols: [

                {
                    view: "richselect", width: 100, id: "id_CB_acNome_LD_mestrado",
                    label: 'Ano Curricular', name: "acNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#acNome#",
                            yCount: 7,
                            url: BASE_URL + "CAno_Curricular/read"
                        }
                    }, on: {
                        "onChange": function (newv, oldv) {
                            var n = $$("id_CB_nNome_LD_mestrado").getValue();
                            var c = $$("id_CB_cNome_LD_mestrado").getValue();
                            var p = $$("id_CB_pNome_LD_mestrado").getValue();
                            var ac = $$("id_CB_acNome_LD_mestrado").getValue();

                            if (n && c && p && ac) {
                                $$("id_CB_tNome_LD_mestrado").getList().clearAll();
                                $$("id_CB_tNome_LD_mestrado").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                            }

                        }
                    }
                },
                {
                    view: "richselect", width: 150, id: "id_CB_tNome_LD_mestrado",
                    label: 'Turma', name: "tNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#tNome#",
                            yCount: 7,
                            url: BASE_URL + "CTurmas/read"
                        }
                    }
                },
                {
                    view: "richselect", width: 150, id: "id_CB_mesNome_LD_mestrado",
                    label: 'Mês', name: "mesNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#mesNome#",
                            yCount: 7,
                            url: BASE_URL + "Cmeses_propina_mestrado/read"
                        }
                    }
                },
                {
                    view: "button", type: "form", value: "Perquisar", width: 120, click: function () {
                        //var idSelecionado = $$("idDTEdHorarios").getSelectedId(false,true);
                        var al = $$("id_CB_alAno_LD_mestrado").getValue();
                        var alt = $$("id_CB_alAno_LD_mestrado").getText();
                        var n = $$("id_CB_nNome_LD_mestrado").getValue();
                        var c = $$("id_CB_cNome_LD_mestrado").getValue();
                        var p = $$("id_CB_pNome_LD_mestrado").getValue();

                        var ac = $$("id_CB_acNome_LD_mestrado").getValue();
                        var t = $$("id_CB_tNome_LD_mestrado").getValue();
                        var m = $$("id_CB_mesNome_LD_mestrado").getValue();
                        var mt = $$("id_CB_mesNome_LD_mestrado").getText();

                        if (al && n && c && p && ac && t && m) {
                            $$("idDTDividas_mestrado").clearAll();
                            $$("idDTDividas_mestrado").load(BASE_URL + "Cpagamentos_propina_mestrado/read_dividas_turmas?al=" + al +
                                "&alt=" + alt +
                                "&n=" + n +
                                "&c=" + c +
                                "&p=" + p +
                                "&ac=" + ac +
                                "&t=" + t +
                                "&m=" + m +
                                "&mt=" + mt);
                        }

                    }
                },
                {
                    view: "button", type: "standard", value: "Imprimir", disabled: false, width: 120, height: 50, click: function () {
                        //criar PDF
                        var al = $$("id_CB_alAno_LD_mestrado").getValue();
                        var alt = $$("id_CB_alAno_LD_mestrado").getText();
                        var n = $$("id_CB_nNome_LD_mestrado").getValue();
                        var c = $$("id_CB_cNome_LD_mestrado").getValue();
                        var p = $$("id_CB_pNome_LD_mestrado").getValue();
                        var ac = $$("id_CB_acNome_LD_mestrado").getValue();
                        var t = $$("id_CB_tNome_LD_mestrado").getValue();
                        var mid = $$("id_CB_mesNome_LD_mestrado").getValue();
                        var m = $$("id_CB_mesNome_LD_mestrado").getText();

                        if (al && n && c && p && ac && t && m) {
                            var envio = "al="+ al + "&alt=" + alt + "&n=" + n + "&c=" + c + "&p=" + p + "&ac=" + ac + "&t=" + t + "&mid=" + mid + "&mt=" + m + "&utilizador=" + user_sessao;
                            var r = webix.ajax().sync().post(BASE_URL + "Cfinancas_propinas_dividas_mestrado_imp/imprimir", envio);
                            if (r.responseText == "true") {
                                webix.message("PDF criado com sucesso");
                                //Carregar PDF
                                webix.ui({
                                    view: "window",
                                    id: "idWinPDFLD_mestrado",
                                    height: 600,
                                    width: 700,
                                    left: 50, top: 50,
                                    move: true,
                                    modal: true,
                                    //head:"This window can be moved",
                                    head: {
                                        view: "toolbar", cols: [
                                            { view: "label", label: "Listas Dividas Propinas Mestrado" },
                                            { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFLD_mestrado').close(); } }
                                        ]
                                    },
                                    body: {
                                        //template:"Some text"
                                        template: '<div id="idPDFLD" style="width:690px;  height:590px"></div>'
                                    }
                                }).show();
                                PDFObject.embed("../../relatorios/Lista_Est_Dividas_Propinas_Mestrado.pdf", "#idPDFLD");


                            } else {
                                webix.message({ type: "error", text: "Erro atualizando dados" });
                            }

                        } else {
                            webix.message({ type: "error", text: "Deve selecionar primeiro n&iacute;vel, curso, per&iacute;odo, ano curricular e turma" });
                        }
                    }
                },
                {}
            ]
        },
        /* GRID */
        {
            view: "datatable",
            id: "idDTDividas_mestrado",
            select: "row", /*editable: true, editaction: "click",*/
            columns: [
                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                { id: "eid", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                { id: "cid", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                { id: "ord", header: "Nº", width: 60, sort: "int" },
                { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                { id: "cBI_Passaporte", header: ["BI-Pass.", { content: "textFilter" }], width: 170, sort: "strig" },
                { id: "divida", header: ["Dívida Actual", { content: "textFilter" }], width: 170, sort: "int" },
            ],
            //url: BASE_URL + "Cpagamentos_propina/read",
            pager: "pagerDividas_mestrado"
        }, {
            view: "pager", id: "pagerDividas_mestrado",
            template: "{common.prev()} {common.pages()} {common.next()}",
            size: 15,
            group: 10
        },
        {
            cols: [
                {},
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("id_win_dividas_mestrado").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
