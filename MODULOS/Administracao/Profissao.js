function cargarVistaProfissao(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Profiss&atilde;o", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDProfissao",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Profiss&atilde;o",
                                        body: webix.copy(formADDProfissao)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdProfissao").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdProfissao').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                    }
                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdProfissao").clearAll();
                                    $$("idDTEdProfissao").load(BASE_URL + "CProfissao/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdProfissao",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "proNome", editor: "text", header: ["Nome Profiss&atilde;o", { content: "textFilter" }], width: 300, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "proCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 100, validate: webix.rules.isNotEmpty(), sort: "string" },
                            ],
                            save: BASE_URL + "CProfissao/crud",
                            url: BASE_URL + "CProfissao/read",
                            pager: "pagerProfissao"
                        }, {
                            view: "pager", id: "pagerProfissao",
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
var formADDProfissao = {
    view: "form",
    id: "idformADDProfissao",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "proNome", id: "idtext_proNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "proCodigo", id: "idtext_proCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdProfissao').add({
                            proNome: $$("idtext_proNome").getValue(),
                            proCodigo: $$("idtext_proCodigo").getValue()
                        });
                        $$("idwinADDProfissao").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDProfissao").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};