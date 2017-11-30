function cargarVistaDeclaracaoMestradoConfiguracao(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Dados Declaração", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDDeclaracaoMestradoConfiguracao",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Motivo",
                                        body: webix.copy(formADDDeclaracaoMestradoConfiguracao)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdDeclaracaoMotivo").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdDeclaracaoMotivo').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro uma linha" });
                                    }
                                }

                            }, {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdDeclaracaoMestradoConfiguracao").clearAll();
                                    $$("idDTEdDeclaracaoMestradoConfiguracao").load(BASE_URL + "Cdeclaracao_mestrado_configuracao/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdDeclaracaoMestradoConfiguracao",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "nnome", header: ["Nível", { content: "textFilter" }], width: 200, sort: "string" },
                                { id: "cnome", header: ["Curso", { content: "textFilter" }], width: 400, sort: "string" },
                                { id: "titulo_visto", editor: "text", header: ["Título Visto", { content: "textFilter" }], width: 250, sort: "string" },
                                { id: "nome_visto", editor: "text", header: ["Nome Visto", { content: "textFilter" }], width: 250, sort: "string" },
                                { id: "nome_asignatura", editor: "text", header: ["Nome Assignatura", { content: "textFilter" }], width: 250, sort: "string" },
                            ],
                            save: BASE_URL + "Cdeclaracao_mestrado_configuracao/crud",
                            url: BASE_URL + "Cdeclaracao_mestrado_configuracao/read",
                            pager: "pagerDeclaracao_Mestrado_Configuracao"
                        }, {
                            view: "pager", id: "pagerDeclaracao_Mestrado_Configuracao",
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
var formADDDeclaracaoMestradoConfiguracao = {
    view: "form",
    id: "idformADDDeclaracaoMestradoConfiguracao",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "richselect", id: "idcombo_nnome",
                    label: 'Nivel', name: "nNome",
                    value: 2, disabled: true,
                    options: {
                        body: {
                            template: "#nNome#",
                            yCount: 7,
                            url: BASE_URL + "cniveis/read"
                        }
                    }
                },
                {
                    view: "richselect", id: "idcombo_cnome",
                    label: 'Curso', name: "cNome",
                    options: {
                        body: {
                            template: "#cNome#",
                            yCount: 7,
                            url: BASE_URL + "ccursos/readXn?nNome=2"
                        }
                    }
                },
                { view: "text", label: 'Título Visto', name: "titulo_visto", id: "idtext_titulo_visto", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Nome Visto', name: "nome_visto", id: "idtext_nome_visto", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Nome Assignatura', name: "nome_asignatura", id: "idtext_nome_asignatura", validate: "isNotEmpty", validateEvent: "blur" },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdDeclaracaoMestradoConfiguracao').add({
                            nnome: $$("idcombo_nnome").getValue(),
                            cnome: $$("idcombo_cnome").getValue(),
                            titulo_visto: $$("idtext_titulo_visto").getValue(),
                            nome_visto: $$("idtext_nome_visto").getValue(),
                            nome_asignatura: $$("idtext_nome_asignatura").getValue(),
                        });
                        $$("idwinADDDeclaracaoMestradoConfiguracao").close();
                        //update grid
                        $$("idDTEdDeclaracaoMestradoConfiguracao").clearAll();
                        $$("idDTEdDeclaracaoMestradoConfiguracao").load(BASE_URL + "Cdeclaracao_mestrado_configuracao/read");   
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDDeclaracaoMestradoConfiguracao").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};