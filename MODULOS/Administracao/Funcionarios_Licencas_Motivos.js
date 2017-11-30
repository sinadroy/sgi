function cargarVistaFuncionarios_Licencas_Motivos(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Motivos", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDFuncionarios_Licencas_Motivos",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Motivo",
                                        body: webix.copy(formADDFuncionarios_Licencas_Motivos)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdFuncionarios_Licencas_Motivos").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdFuncionarios_Licencas_Motivos').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                    }
                                }

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdFuncionarios_Licencas_Motivos").clearAll();
                                    $$("idDTEdFuncionarios_Licencas_Motivos").load(BASE_URL + "cLicencas_Motivos/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdFuncionarios_Licencas_Motivos",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "lmNome", editor: "text", header: ["Motivo Licen&ccedil;a", { content: "textFilter" }], width: 300, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "lmCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 100, validate: webix.rules.isNotEmpty(), sort: "string" }
                            ],
                            save: BASE_URL + "cLicencas_Motivos/crud",
                            url: BASE_URL + "cLicencas_Motivos/read",
                            pager: "pagerFuncionarios_Licencas_Motivos"
                        }, {
                            view: "pager", id: "pagerFuncionarios_Licencas_Motivos",
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
var formADDFuncionarios_Licencas_Motivos = {
    view: "form",
    id: "idformADDFuncionarios_Licencas_Motivos",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "lmNome", id: "idtext_lmNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "lmCodigo", id: "idtext_lmCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdFuncionarios_Licencas_Motivos').add({
                            lmNome: $$("idtext_lmNome").getValue(),
                            lmCodigo: $$("idtext_lmCodigo").getValue()
                        });
                        $$("idwinADDFuncionarios_Licencas_Motivos").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDFuncionarios_Licencas_Motivos").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};