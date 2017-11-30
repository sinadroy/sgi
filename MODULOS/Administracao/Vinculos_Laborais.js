function cargarVistaVinculos_Laborais(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Vinculos Laborais", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDVinculos_Laborais",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Vinculo Laboral",
                                        body: webix.copy(formADDVinculos_Laborais)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdVinculos_Laborais").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdVinculos_Laborais").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cVinculos_Laborais/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdVinculos_Laborais").clearAll();
                                                        $$("idDTEdVinculos_Laborais").load(BASE_URL + "cVinculos_Laborais/read");
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
                                    $$("idDTEdVinculos_Laborais").clearAll();
                                    $$("idDTEdVinculos_Laborais").load(BASE_URL + "cVinculos_Laborais/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdVinculos_Laborais",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "vlNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "vlCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.vlNome && data.vlCodigo) {
                                        var envio = "id=" + id +
                                            "&vlNome=" + data.vlNome +
                                            "&vlCodigo=" + data.vlCodigo;
                                        var r = webix.ajax().sync().post(BASE_URL + "cVinculos_Laborais/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdVinculos_Laborais").clearAll();
                                            $$("idDTEdVinculos_Laborais").load(BASE_URL + "cVinculos_Laborais/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdVinculos_Laborais").clearAll();
                                        $$("idDTEdVinculos_Laborais").load(BASE_URL + "cVinculos_Laborais/read");
                                    }

                                }

                            },
                            url: BASE_URL + "cVinculos_Laborais/read",
                            pager: "pagerVinculos_Laborais"
                        }, {
                            view: "pager", id: "pagerVinculos_Laborais",
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
var formADDVinculos_Laborais = {
    view: "form",
    id: "idformADDVinculos_Laborais",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "vlNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "vlCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var vlnome = $$("idformADDVinculos_Laborais").getValues().vlNome;
                        var vlcodigo = $$("idformADDVinculos_Laborais").getValues().vlCodigo;
                        if (vlnome && vlcodigo) { //validate form
                            var envio = "vlNome=" + vlnome +
                                "&vlCodigo=" + vlcodigo;
                            var r = webix.ajax().sync().post(BASE_URL + "cVinculos_Laborais/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdVinculos_Laborais").load(BASE_URL + "cVinculos_Laborais/read");
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
                        $$("idwinADDVinculos_Laborais").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};