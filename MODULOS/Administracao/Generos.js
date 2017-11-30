function cargarVistaGeneros(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Generos", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDGeneros",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Dados",
                                        body: webix.copy(formADDGeneros)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdGeneros").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdGeneros").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cGeneros/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdGeneros").clearAll();
                                                        $$("idDTEdGeneros").load(BASE_URL + "cGeneros/read");
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
                                    $$("idDTEdGeneros").clearAll();
                                    $$("idDTEdGeneros").load(BASE_URL + "cGeneros/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdGeneros",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "gNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "gCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "int" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.gNome && data.gCodigo) {
                                        var envio = "id=" + id +
                                            "&gNome=" + data.gNome +
                                            "&gCodigo=" + data.gCodigo;
                                        var r = webix.ajax().sync().post(BASE_URL + "cGeneros/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdGeneros").clearAll();
                                            $$("idDTEdGeneros").load(BASE_URL + "cGeneros/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdGeneros").clearAll();
                                        $$("idDTEdGeneros").load(BASE_URL + "cGeneros/read");
                                    }

                                }

                            },
                            url: BASE_URL + "cGeneros/read",
                            pager: "pagerGeneros"
                        }, {
                            view: "pager", id: "pagerGeneros",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Generos
var formADDGeneros = {
    view: "form",
    id: "idformADDGeneros",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "gNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "gCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var gnome = $$("idformADDGeneros").getValues().gNome;
                        var gcodigo = $$("idformADDGeneros").getValues().gCodigo;
                        if (gnome && gcodigo) { //validate form
                            var envio = "gNome=" + gnome +
                                "&gCodigo=" + gcodigo;
                            var r = webix.ajax().sync().post(BASE_URL + "cGeneros/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdGeneros").load(BASE_URL + "cGeneros/read");
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
                        $$("idwinADDGeneros").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};