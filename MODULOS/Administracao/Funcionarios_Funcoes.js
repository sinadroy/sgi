function cargarVistaFuncionarios_Funcoes(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Fun&ccedil;&otilde;es", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDFuncionarios_Funcoes",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Fun&ccedil;&atilde;o",
                                        body: webix.copy(formADDFuncionarios_Funcoes)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdFuncionarios_Funcoes").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdFuncionarios_Funcoes').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                    }
                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdFuncionarios_Funcoes").clearAll();
                                    $$("idDTEdFuncionarios_Funcoes").load(BASE_URL + "cFuncionarios_Funcoes/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdFuncionarios_Funcoes",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "funcNome", editor: "text", header: ["Nome Fun&ccedil;&atilde;o", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "funcCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 200, validate: webix.rules.isNotEmpty(), sort: "string" }
                            ],
                            save: BASE_URL + "cFuncionarios_Funcoes/crud",
                            url: BASE_URL + "cFuncionarios_Funcoes/read",
                            pager: "pagerFuncionarios_Funcoes"
                        }, {
                            view: "pager", id: "pagerFuncionarios_Funcoes",
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
var formADDFuncionarios_Funcoes = {
    view: "form",
    id: "idformADDFuncionarios_Funcoes",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "funcNome", id: "idtext_funcNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "funcCodigo", id: "idtext_funcCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdFuncionarios_Funcoes').add({
                            funcNome: $$("idtext_funcNome").getValue(),
                            funcCodigo: $$("idtext_funcCodigo").getValue()
                        });
                        $$("idwinADDFuncionarios_Funcoes").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDFuncionarios_Funcoes").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};