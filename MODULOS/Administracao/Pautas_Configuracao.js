function cargarVistaFormulas_Pautas(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                header: "Editar Formulas", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDFormulas_Pautas",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Cargo",
                                        body: webix.copy(formADDFormulas_Pautas)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", disabled: false, width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdFormulas_Pautas").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    $$('idDTEdFormulas_Pautas').remove(idSelecionado);
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
                                    $$("idDTEdFormulas_Pautas").clearAll();
                                    $$("idDTEdFormulas_Pautas").load(BASE_URL + "cpautas_configuracao/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdFormulas_Pautas",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "dgid", header: "Geração", hidden: true, width: 400, sort: "int" },
                                { id: "dgnome", header: ["Geração", { content: "textFilter" }], width: 300, sort: "string" },
                                { id: "td", header: ["Tipo Disciplina", { content: "textFilter" }], width: 200, sort: "string" },
                                { id: "pp1", header: ["1º Avaliação %", { content: "textFilter" }], width: 120, sort: "int" },
                                { id: "pp2", header: ["2º Avaliação %", { content: "textFilter" }], width: 120, sort: "int" },
                                { id: "pp3", header: ["3º Avaliação %", { content: "textFilter" }], width: 120, sort: "int" },
                                { id: "ef", header: ["Exame Final %", { content: "textFilter" }], width: 120, sort: "int" },
                                { id: "recurso", header: ["Recurso %", { content: "textFilter" }], width: 120, sort: "int" },
                                { id: "especial", header: ["Outra %", { content: "textFilter" }], width: 120, sort: "int" },
                            ],
                            save: BASE_URL + "cpautas_configuracao/crud",
                            url: BASE_URL + "cpautas_configuracao/read",
                            pager: "pagerFormulas_Pautas"
                        }, {
                            view: "pager", id: "pagerFormulas_Pautas",
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
var formADDFormulas_Pautas = {
    view: "form",
    id: "idformADDFormulas_Pautas",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "richselect", id: "idCombo_dg",
                    label: 'Geração', name: "dgnome",
                    options: {
                        body: {
                            template: "#dgnome#",
                            yCount: 7,
                            url: BASE_URL + "cDisciplinas_Geracao/read"
                        }
                    },
                },
                {
                    view: "richselect", id: "idCombo_dd",
                    label: 'Duração', name: "ddNome",
                    options: {
                        body: {
                            template: "#ddNome#",
                            yCount: 7,
                            url: BASE_URL + "CDisciplinas_Duracao/read"
                        }
                    },
                    on: {
                        'onChange': function (newv, oldv) {
                            if (newv != "1") {
                                $$('id_counter_pp3').disable();
                                
                            } else {
                                $$('id_counter_pp3').enable();
                            }
                        }
                    }
                },
                {
                    cols: [
                        { view: "counter", label: "1º Avaliação %", name: "pp1", id: "id_counter_pp1" },
                        { view: "counter", label: "2º Avaliação %", name: "pp2", id: "id_counter_pp2" },
                        { view: "counter", label: "3º Avaliação %", name: "pp3", id: "id_counter_pp3" },
                    ]
                },
                {
                    cols: [
                        { view: "counter", label: "Exame Final", name: "ef", id: "id_counter_ef" },
                        { view: "counter", label: "Recurso", name: "recurso", id: "id_counter_rec" },
                        { view: "counter", label: "Outra", name: "especial", id: "id_counter_esp" },
                    ]
                }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        $$('idDTEdFormulas_Pautas').add({
                            dgnome: $$("idCombo_dg").getValue(),
                            td: $$("idCombo_dd").getText(),
                            pp1: $$("id_counter_pp1").getValue(),
                            pp2: $$("id_counter_pp2").getValue(),
                            pp3: ($$("id_counter_pp3").getValue())?$$("id_counter_pp3").getValue():0, //este tem que ser 0 para disc semestrais
                            ef: $$("id_counter_ef").getValue(),
                            recurso: $$("id_counter_rec").getValue(),
                            especial: $$("id_counter_esp").getValue(),
                        });
                        $$("idwinADDFormulas_Pautas").close();
                        $$("idDTEdFormulas_Pautas").clearAll();
                        $$("idDTEdFormulas_Pautas").load(BASE_URL + "cpautas_configuracao/read");
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDFormulas_Pautas").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};