function cargarVistaAvaliacoes(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Planificação Avaliações", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADD_avaliacoes",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Planificação",
                                        body: webix.copy(formADD_avaliacoes)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", disabled: false, width: 100, click: function () {
                                    var idSelecionado = $$("idDTEd_avaliacoes").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEd_avaliacoes').remove(idSelecionado);
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um documento" });
                                    }
                                }

                            }
                            , {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEd_avaliacoes").clearAll();
                                    $$("idDTEd_avaliacoes").load(BASE_URL + "Ccalendarios_avaliacoes/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEd_avaliacoes",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "alAno", header: ["Ano Lectivo", { content: "textFilter" }], width: 200, sort: "string" },
                                { id: "ca_data_inicio", editor: "date", header: ["Data Inicio", { content: "textFilter" }], width: 300, sort: "string" },
                                { id: "ca_data_fim", editor: "date", header: ["Data Fim", { content: "textFilter" }], width: 200, sort: "string" },
                                { id: "ava_nome", header: ["Avaliação", { content: "textFilter" }], width: 200, sort: "string" },
                            ],
                            save: BASE_URL + "Ccalendarios_avaliacoes/crud",
                            url: BASE_URL + "Ccalendarios_avaliacoes/read",
                            pager: "pager_avaliacoes"
                        }, {
                            view: "pager", id: "pager_avaliacoes",
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
var formADD_avaliacoes = {
    view: "form",
    id: "idformADD_avaliacoes",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "richselect", id: "idCombo_al",
                    label: 'Ano Lectivo', name: "alAno",
                    options: {
                        body: {
                            template: "#alAno#",
                            yCount: 7,
                            url: BASE_URL + "canos_lectivos/read"
                        }
                    },
                },
                {
                    view: "richselect", id: "idCombo_ava",
                    label: 'Avaliação', name: "ava_nome",
                    options: {
                        body: {
                            template: "#ava_nome#",
                            yCount: 7,
                            url: BASE_URL + "Ccalendarios_tipo_avaliacoes/read"
                        }
                    },
                },
                { view:"datepicker", label:"Data Inicio", name:"ca_data_inicio", id:"iddp_di", stringResult:true, format:"%Y-%M-%d" },
                { view:"datepicker", label:"Data Fim", name:"ca_data_fim", id:"iddp_df", stringResult:true, format:"%Y-%M-%d" },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEd_avaliacoes').add({
                            alAno: $$("idCombo_al").getValue(),
                            ava_nome: $$("idCombo_ava").getValue(),
                            ca_data_inicio: $$("iddp_di").getValue(),
                            ca_data_fim: $$("iddp_df").getValue(),
                        });
                        $$("idwinADD_avaliacoes").close();
                        $$("idDTEd_avaliacoes").clearAll();
                        $$("idDTEd_avaliacoes").load(BASE_URL + "Ccalendarios_avaliacoes/read");
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADD_avaliacoes").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};