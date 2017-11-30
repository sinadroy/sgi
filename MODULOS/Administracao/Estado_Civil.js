function cargarEstado_Civil(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Estado Civil", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDEstado_Civil",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Dados",
                                        body: webix.copy(formADDEstado_Civil)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdEstado_Civil").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdEstado_Civil").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cEstado_Civil/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdEstado_Civil").clearAll();
                                                        $$("idDTEdEstado_Civil").load(BASE_URL + "cEstado_Civil/read");
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
                                    $$("idDTEdEstado_Civil").clearAll();
                                    $$("idDTEdEstado_Civil").load(BASE_URL + "cEstado_Civil/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdEstado_Civil",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "ecNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "ecCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "int" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.ecNome && data.ecCodigo) {
                                        var envio = "id=" + id +
                                            "&ecNome=" + data.ecNome +
                                            "&ecCodigo=" + data.ecCodigo;
                                        var r = webix.ajax().sync().post(BASE_URL + "cEstado_Civil/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdEstado_Civil").clearAll();
                                            $$("idDTEdEstado_Civil").load(BASE_URL + "cEstado_Civil/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdEstado_Civil").clearAll();
                                        $$("idDTEdEstado_Civil").load(BASE_URL + "cEstado_Civil/read");
                                    }

                                }

                            },
                            url: BASE_URL + "cEstado_Civil/read",
                            pager: "pagerEstado_Civil"
                        }, {
                            view: "pager", id: "pagerEstado_Civil",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Estado_Civil
var formADDEstado_Civil = {
    view: "form",
    id: "idformADDEstado_Civil",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "ecNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "ecCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var ecnome = $$("idformADDEstado_Civil").getValues().ecNome;
                        var eccodigo = $$("idformADDEstado_Civil").getValues().ecCodigo;
                        if (ecnome && eccodigo) { //validate form
                            var envio = "ecNome=" + ecnome +
                                "&ecCodigo=" + eccodigo;
                            var r = webix.ajax().sync().post(BASE_URL + "cEstado_Civil/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdEstado_Civil").load(BASE_URL + "cEstado_Civil/read");
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
                        $$("idwinADDEstado_Civil").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};