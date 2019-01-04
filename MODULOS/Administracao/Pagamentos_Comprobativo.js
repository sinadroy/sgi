function cargarVistaPag_Comp(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Pagamentos Comp.", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDPag_Comp",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Pagamento",
                                        body: webix.copy(formADDPag_Comp)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", disabled: false, width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdPag_Comp").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdPag_Comp').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um documento" });
                                    }
                                }

                            }
                            , {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdPag_Comp").clearAll();
                                    $$("idDTEdPag_Comp").load(BASE_URL + "CPagamentos_Comprobativo/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdPag_Comp",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "pc_nome", header: ["Nome", { content: "textFilter" }], width: 300, sort: "string" },
                                { id: "pc_descricao", header: ["Descrição", { content: "textFilter" }], width: 200, sort: "string" },
                            ],
                            save: BASE_URL + "CPagamentos_Comprobativo/crud",
                            url: BASE_URL + "CPagamentos_Comprobativo/read",
                            pager: "pagerPag_Comp"
                        }, {
                            view: "pager", id: "pagerPag_Comp",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            },
            // Pagamentos Comprobativo - Preçarios
            {
                header: "Editar Pagamentos Comp. / Preçario", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDPag_Comp_Prec",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Preçario",
                                        body: webix.copy(formADDPag_Comp_Prec)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", disabled: false, width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdPag_Comp_Prec").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdPag_Comp_Prec').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um documento" });
                                    }
                                }

                            }
                            , {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdPag_Comp_Prec").clearAll();
                                    $$("idDTEdPag_Comp_Prec").load(BASE_URL + "CPagamentos_Comprobativo_Prec/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdPag_Comp_Prec",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "pc_nome", header: ["Tipo Pagamento", { content: "textFilter" }], width: 300, sort: "string" },
                                { id: "precnome", header: ["Preçario", { content: "textFilter" }], width: 300, sort: "string" },
                            ],
                            save: BASE_URL + "CPagamentos_Comprobativo_Prec/crud",
                            url: BASE_URL + "CPagamentos_Comprobativo_Prec/read",
                            pager: "pagerPag_Comp"
                        }, {
                            view: "pager", id: "pagerPag_Comp",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Cargo
var formADDPag_Comp = {
    view: "form",
    id: "idformADDPag_Comp",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "pc_nome", id: "idText_pc_nome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Descrição', name: "pc_descricao", id: "idText_pc_descricao", validate: "isNotEmpty", validateEvent: "blur" },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        if($$("idText_pc_nome").getValue()){
                            $$('idDTEdPag_Comp').add({
                                pc_nome: $$("idText_pc_nome").getValue(),
                                pc_descricao: $$("idText_pc_descricao").getValue()
                            });
                            $$("idwinADDPag_Comp").close();
                            $$("idDTEdPag_Comp").clearAll();
                            $$("idDTEdPag_Comp").load(BASE_URL + "CPagamentos_Comprobativo/read");
                        } else
                        {
                            webix.message({ type: "error", text: "Erro ao validar dados." });
                        }
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDPag_Comp").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

// Pag Comp Precario
var formADDPag_Comp_Prec = {
    view: "form",
    id: "idformADDPag_Comp_Prec",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "combo", 
                    label: 'Tipo Pagamento', 
                    name: "pc_nome", 
                    id: "idCombo_pc_nome", 
                    labelPosition: "top", 
                    options: { 
                        body: { 
                            template: "#pc_nome#", 
                            yCount: 7, 
                            url: BASE_URL + "CPagamentos_Comprobativo/read" 
                        } 
                    },
                },
                {
                    view: "combo", 
                    label: 'Preçario', 
                    name: "precnome", 
                    id: "idCombo_precnome", 
                    labelPosition: "top", 
                    options: { 
                        body: { 
                            template: "#precnome#", 
                            yCount: 7, 
                            url: BASE_URL + "CPrecarios/read" 
                        } 
                    },
                }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        if($$("idCombo_pc_nome").getValue() && $$("idCombo_precnome").getValue()){
                            // $$('idDTEdPag_Comp_Prec').add({
                            //     pagamentos_comprobativo_id: $$("idCombo_pc_nome").getValue(),
                            //     precario_id: $$("idCombo_precnome").getValue()
                            // });
                            let envio = "pagamentos_comprobativo_id=" + $$("idCombo_pc_nome").getValue() + "&precario_id=" + $$("idCombo_precnome").getValue() + "&webix_operation=insert";
                            let r = webix.ajax().sync().post(BASE_URL + "CPagamentos_Comprobativo_Prec/crud", envio);
                            if(r.responseText == 'true'){
                                webix.message({ type: "success", text: "Dados inseridos com sucesso." });
                            }else{
                                webix.message({ type: "error", text: "Erro ao inserir dados, o record ja existe." });
                            }
                            $$("idwinADDPag_Comp_Prec").close();
                            $$("idDTEdPag_Comp_Prec").clearAll();
                            $$("idDTEdPag_Comp_Prec").load(BASE_URL + "CPagamentos_Comprobativo_Prec/read");
                        } else
                        {
                            webix.message({ type: "error", text: "Erro ao validar dados." });
                        }
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDPag_Comp_Prec").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};