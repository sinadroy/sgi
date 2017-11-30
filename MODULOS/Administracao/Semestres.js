function cargarVistaSemestres(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Semestres", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDSemestres",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Dados",
                                        body: webix.copy(formADDSemestres)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdSemestres").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdSemestres").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cSemestres/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdSemestres").clearAll();
                                                        $$("idDTEdSemestres").load(BASE_URL + "cSemestres/read");
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
                                    $$("idDTEdSemestres").clearAll();
                                    $$("idDTEdSemestres").load(BASE_URL + "cSemestres/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdSemestres",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "sNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "sDescricao", editor: "text", header: ["Descr&ccedil;&atilde;o", { content: "textFilter" }], width: 170, sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.sNome) {
                                        var envio = "id=" + id +
                                            "&sNome=" + data.sNome +
                                            "&sDescricao=" + data.sDescricao;
                                        var r = webix.ajax().sync().post(BASE_URL + "cSemestres/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdSemestres").clearAll();
                                            $$("idDTEdSemestres").load(BASE_URL + "cSemestres/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdSemestres").clearAll();
                                        $$("idDTEdSemestres").load(BASE_URL + "cSemestres/read");
                                    }

                                }

                            },
                            url: BASE_URL + "cSemestres/read",
                            pager: "pagerSemestres"
                        }, {
                            view: "pager", id: "pagerSemestres",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Semestres
var formADDSemestres = {
    view: "form",
    id: "idformADDSemestres",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "sNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Descri&ccedil;&atilde;o', name: "sDescricao" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var nome = $$("idformADDSemestres").getValues().sNome;
                        var descricao = $$("idformADDSemestres").getValues().sDescricao;
                        if (nome) { //validate form
                            var envio = "sNome=" + nome +
                                "&sDescricao=" + descricao;
                            var r = webix.ajax().sync().post(BASE_URL + "cSemestres/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdSemestres").load(BASE_URL + "cSemestres/read");
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
                        $$("idwinADDSemestres").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};