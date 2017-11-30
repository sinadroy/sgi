function cargarHabilitacoes_Literarias(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Habilita&ccedil;&otilde;es Literarias", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDHabilitacoes_Literarias",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Dados",
                                        body: webix.copy(formADDHabilitacoes_Literarias)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdHabilitacoes_Literarias").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdHabilitacoes_Literarias").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cHabilitacoes_Literarias/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdHabilitacoes_Literarias").clearAll();
                                                        $$("idDTEdHabilitacoes_Literarias").load(BASE_URL + "cHabilitacoes_Literarias/read");
                                                        webix.message("Os dados foram apagados com sucesso");
                                                    } else {
                                                        webix.message({ type: "error", text: "Erro apagando dados" });
                                                    }
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados" });
                                    }

                                }

                            }, {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdHabilitacoes_Literarias").clearAll();
                                    $$("idDTEdHabilitacoes_Literarias").load(BASE_URL + "cHabilitacoes_Literarias/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdHabilitacoes_Literarias",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "hlfNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "hlfCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.hlfNome && data.hlfCodigo) {
                                        var envio = "id=" + id +
                                            "&hlfNome=" + data.hlfNome +
                                            "&hlfCodigo=" + data.hlfCodigo;
                                        var r = webix.ajax().sync().post(BASE_URL + "cHabilitacoes_Literarias/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdHabilitacoes_Literarias").clearAll();
                                            $$("idDTEdHabilitacoes_Literarias").load(BASE_URL + "cHabilitacoes_Literarias/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdHabilitacoes_Literarias").clearAll();
                                        $$("idDTEdHabilitacoes_Literarias").load(BASE_URL + "cHabilitacoes_Literarias/read");
                                    }

                                }

                            },
                            url: BASE_URL + "cHabilitacoes_Literarias/read",
                            pager: "pagerHabilitacoes_Literarias"
                        }, {
                            view: "pager", id: "pagerHabilitacoes_Literarias",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Habilitacoes_Literarias
var formADDHabilitacoes_Literarias = {
    view: "form",
    id: "idformADDHabilitacoes_Literarias",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "hlfNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "hlfCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var hlfnome = $$("idformADDHabilitacoes_Literarias").getValues().hlfNome;
                        var hlfcodigo = $$("idformADDHabilitacoes_Literarias").getValues().hlfCodigo;
                        if (hlfnome && hlfcodigo) { //validate form
                            var envio = "hlfNome=" + hlfnome +
                                "&hlfCodigo=" + hlfcodigo;
                            var r = webix.ajax().sync().post(BASE_URL + "cHabilitacoes_Literarias/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdHabilitacoes_Literarias").load(BASE_URL + "cHabilitacoes_Literarias/read");
                            } else {
                                webix.message({ type: "error", text: "Erro inserindo dados" });
                            }
                        }
                        else
                            webix.message({ type: "error", text: "Erro validando dados" });
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDHabilitacoes_Literarias").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};