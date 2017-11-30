function cargarVistaAno_Curricular(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Ano Curricular", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDAno_Curricular",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Dados do Ano",
                                        body: webix.copy(formADDAno_Curricular)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdAno_Curricular").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdAno_Curricular").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cAno_Curricular/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdAno_Curricular").clearAll();
                                                        $$("idDTEdAno_Curricular").load(BASE_URL + "cAno_Curricular/read");
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
                                    $$("idDTEdAno_Curricular").clearAll();
                                    $$("idDTEdAno_Curricular").load(BASE_URL + "cAno_Curricular/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdAno_Curricular",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "acNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "acCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.acNome && data.acCodigo) {
                                        var envio = "id=" + id +
                                            "&acNome=" + data.acNome +
                                            "&acCodigo=" + data.acCodigo;
                                        var r = webix.ajax().sync().post(BASE_URL + "cAno_Curricular/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdAno_Curricular").clearAll();
                                            $$("idDTEdAno_Curricular").load(BASE_URL + "cAno_Curricular/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdAno_Curricular").clearAll();
                                        $$("idDTEdAno_Curricular").load(BASE_URL + "cAno_Curricular/read");
                                    }

                                }

                            },
                            url: BASE_URL + "cAno_Curricular/read",
                            pager: "pagerAno_Curricular"
                        }, {
                            view: "pager", id: "pagerAno_Curricular",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Niveis
var formADDAno_Curricular = {
    view: "form",
    id: "idformADDAno_Curricular",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "acNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "acCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var acnome = $$("idformADDAno_Curricular").getValues().acNome;
                        var accodigo = $$("idformADDAno_Curricular").getValues().acCodigo;
                        if (acnome && accodigo) { //validate form
                            var envio = "acNome=" + acnome +
                                "&acCodigo=" + accodigo;
                            var r = webix.ajax().sync().post(BASE_URL + "cAno_Curricular/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdAno_Curricular").load(BASE_URL + "cAno_Curricular/read");
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
                        $$("idwinADDAno_Curricular").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};