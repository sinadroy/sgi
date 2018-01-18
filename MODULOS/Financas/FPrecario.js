function cargarVistaPrecario(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Pre&ccedil;ario", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDPrecario",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Dados",
                                        body: webix.copy(formADDPrecario)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "standard", value: "Editar", width: 100, click: function () {
                                    let idSelecionado = $$("idDTEdPrecarios").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.ui({
                                            view: "window",
                                            id: "idwinEDPrecario",
                                            width: 500,
                                            position: "center",
                                            modal: true,
                                            head: "Editar Dados",
                                            body: webix.copy(formEDPrecario)
                                        }).show();

                                        let record = $$("idDTEdPrecarios").getItem(idSelecionado);
                                        $$("id_formed_id").setValue(record.id);
                                        $$("id_formed_precnome").setValue(record.precnome);
                                        $$("id_formed_preccodigo").setValue(record.preccodigo);
                                        $$("id_formed_precdescricao").setValue(record.precdescricao);
                                    } else {
                                        webix.message({ type: "error", text: "Erro deve selecionar uma linha." });
                                    }
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdPrecarios").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdPrecarios").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cPrecarios/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdPrecarios").clearAll();
                                                        $$("idDTEdPrecarios").load(BASE_URL + "cPrecarios/read");
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
                                    $$("idDTEdPrecarios").clearAll();
                                    $$("idDTEdPrecarios").load(BASE_URL + "cPrecarios/read");
                                }
                            },
                            {}
                        ]

                    }, {
                        view: "datatable",
                        id: "idDTEdPrecarios",
                        //autowidth:true,
                        //autoConfig:true,
                        select: true,
                        editable: false,
                        //editable:true,
                        //editaction:"dblclick",
                        columns: [
                            { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                            { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                            { id: "precnome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 200, sort: "string" },
                            { id: "preccodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, sort: "string" },
                            { id: "precdescricao", editor: "text", header: ["Descri&ccedil;&atilde;o", { content: "textFilter" }], width: 300, sort: "string" }
                        ],
                        resizeColumn: true,
                        url: BASE_URL + "cprecarios/read",
                        pager: "pagerPrecarios"
                    }, {
                        view: "pager", id: "pagerPrecarios",
                        template: "{common.prev()} {common.pages()} {common.next()}",
                        size: 25,
                        group: 10
                    }]
                }
            },
            {
                header: "Preçario / Cursos", body: {
                    rows: [{
                        view: "form", scroll: false,
                        rows: [
                            {
                                cols: [
                                    {
                                        view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                            webix.ui({
                                                view: "window",
                                                id: "idwinADDPrecarioCursos",
                                                width: 500,
                                                position: "center",
                                                modal: true,
                                                head: "Adicionar Preçario / Curso",
                                                body: webix.copy(formADDPrecarioCursos)
                                            }).show();
                                        }
                                    },
                                    {
                                        view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                            var idSelecionado = $$("idDTEdPrecario_Cursos").getSelectedId(false, true);
                                            if (idSelecionado) {
                                                webix.confirm({
                                                    title: "Confirmação",
                                                    type: "confirm-warning",
                                                    ok: "Sim", cancel: "Nao",
                                                    text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                                    callback: function (result) {
                                                        if (result) {
                                                            var envio = "id=" + idSelecionado;
                                                            var r = webix.ajax().sync().post(BASE_URL + "CPrecarios_Cursos/delete", envio);
                                                            if (r.responseText == "true") {
                                                                $$("idDTEdPrecario_Cursos").clearAll();
                                                                $$("idDTEdPrecario_Cursos").load(BASE_URL + "CPrecarios_Cursos/read");
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
                                            $$("idDTEdPrecario_Cursos").clearAll();
                                            $$("idDTEdPrecario_Cursos").load(BASE_URL + "CPrecarios_Cursos/read");
                                        }
                                    },
                                    {}
                                ]
                            }
                        ]

                    }, {
                        view: "datatable",
                        id: "idDTEdPrecario_Cursos",
                        //autowidth:true,
                        //autoConfig:true,
                        select: true,
                        editable: false,
                        //editable:true,
                        //editaction:"dblclick",
                        columns: [
                            { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                            { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                            { id: "alAno", header: "Ano Lec.", css: "rank", width: 90, sort: "int" },
                            { id: "nNome", header: ["N&iacute;vel", { content: "textFilter" }], width: 170, sort: "string" },
                            { id: "cNome", header: ["Curso", { content: "textFilter" }], width: 170, sort: "string" },
                            { id: "pNome", header: ["Per&iacute;odo", { content: "textFilter" }], width: 170, sort: "string" },
                            { id: "precnome", header: ["Pre&ccedil;ario", { content: "textFilter" }], width: 170, sort: "string" },
                            { id: "ncp_preco", header: ["Valor", { content: "textFilter" }], width: 170, sort: "string" },
                            { id: "ncp_precou", header: ["Valor Urgente", { content: "textFilter" }], width: 170, sort: "string" },
                        ],
                        resizeColumn: true,
                        url: BASE_URL + "CPrecarios_Cursos/read",
                        pager: "pagerPrecario_Cursos"
                    }, {
                        view: "pager", id: "pagerPrecario_Cursos",
                        template: "{common.prev()} {common.pages()} {common.next()}",
                        size: 16,
                        group: 10
                    }]
                }
            }
        ]
    });
}
//Adicionar Departamentos
var formADDPrecario = {
    view: "form",
    id: "idformADDPrecario",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "precnome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "preccodigo", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "textarea", rows: 3, height: 80, label: 'Descrição', name: "precdescricao" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var precnome = $$("idformADDPrecario").getValues().precnome;
                        var preccodigo = $$("idformADDPrecario").getValues().preccodigo;
                        var precdescricao = $$("idformADDPrecario").getValues().precdescricao;
                        if (precnome && preccodigo) { //validate form
                            var envio = "precnome=" + precnome +
                                "&preccodigo=" + preccodigo +
                                "&precdescricao=" + precdescricao;
                            var r = webix.ajax().sync().post(BASE_URL + "cprecarios/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdPrecarios").load(BASE_URL + "cPrecarios/read");
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
                        $$("idwinADDPrecario").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
var formEDPrecario = {
    view: "form",
    id: "idformEDPrecario",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: '', name: "id", id: "id_formed_id", hidden: true },
                { view: "text", label: 'Nome', name: "precnome", id: "id_formed_precnome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "preccodigo", id: "id_formed_preccodigo", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "textarea", rows: 3, height: 80, label: 'Descrição', name: "precdescricao", id: "id_formed_precdescricao" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        let id = $$("idformEDPrecario").getValues().id;
                        let precnome = $$("idformEDPrecario").getValues().precnome;
                        let preccodigo = $$("idformEDPrecario").getValues().preccodigo;
                        let precdescricao = $$("idformEDPrecario").getValues().precdescricao;
                        if (id && precnome && preccodigo) { //validate form
                            var envio = "id=" + id +
                                "&precnome=" + precnome +
                                "&preccodigo=" + preccodigo +
                                "&precdescricao=" + precdescricao;
                            var r = webix.ajax().sync().post(BASE_URL + "cprecarios/update", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados actualizados com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdPrecarios").load(BASE_URL + "cPrecarios/read");
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
                        $$("idwinEDPrecario").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
// adicionar precario niveis cursos
var formADDPrecarioCursos = {
    view: "form",
    id: "idformADDPrecarioCursos",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "richselect", /*width: 80,*/ id: "id_CB_alAno_pc",
                    label: 'Ano Lectivo', name: "alAno",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#alAno#",
                            yCount: 7,
                            url: BASE_URL + "CAnos_Lectivos/read"
                        }
                    }
                },
                {
                    view: "richselect", id: "id_CB_nNome_pc",
                    label: 'Nivel', name: "nNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#nNome#",
                            yCount: 7,
                            url: BASE_URL + "cNiveis/read"
                        }
                    },
                    on: {
                        "onChange": function (newv, oldv) {

                            var n = $$("id_CB_nNome_pc").getValue();
                            var c = $$("id_CB_cNome_pc").getValue();
                            var p = $$("id_CB_pNome_pc").getValue();
                            // var ac = $$("idLI_CB_acNome_lciTM").getValue();

                            if (n) {
                                $$("id_CB_cNome_pc").getList().clearAll();
                                $$("id_CB_cNome_pc").getList().load(BASE_URL + "Ccursos/readXn?nNome=" + this.getValue());
                            }
                        }
                    }
                },
                {
                    view: "richselect", id: "id_CB_cNome_pc",
                    label: 'Curso', name: "cNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#cNome#",
                            yCount: 7,
                            url: BASE_URL + "cCursos/read"
                        }
                    },
                    // on: {
                    //     "onChange": function (newv, oldv) {
                    //         var n = $$("id_CB_nNome_pc").getValue();
                    //         var c = $$("id_CB_cNome_pc").getValue();
                    //         var p = $$("id_CB_pNome_pc").getValue();

                    //     }
                    // }
                },
                {
                    view: "richselect", id: "id_CB_pNome_pc",
                    label: 'Periodo', name: "pNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#pNome#",
                            yCount: 7,
                            url: BASE_URL + "cPeriodos/read"
                        }
                    }
                },
                {
                    view: "richselect", id: "id_CB_precNome_pc",
                    label: 'Preçario', name: "precnome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#precnome#",
                            yCount: 7,
                            url: BASE_URL + "CPrecarios/read"
                        }
                    }
                },
                { view: "counter", labelPosition: "top", label: 'Valor', value: 1000, name: "ncp_preco", id: "id_ncp_preco", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "counter", labelPosition: "top", label: 'Valor Urgente', value: 1000, name: "ncp_precou", id: "id_ncp_precou", validate: "isNotEmpty", validateEvent: "blur" },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        let n = $$("id_CB_nNome_pc").getValue();
                        let c = $$("id_CB_cNome_pc").getValue();
                        let p = $$("id_CB_pNome_pc").getValue();
                        let prec = $$("id_CB_precNome_pc").getValue();
                        let ncp_preco = $$("id_ncp_preco").getValue();
                        let ncp_precou = $$("id_ncp_precou").getValue();
                        let alano = $$('id_CB_alAno_pc').getValue();

                        var re = webix.ajax().sync().post(BASE_URL + "CPrecarios_Cursos/existe", "n=" + n + "&c=" + c + "&p=" + p + "&prec=" + prec + "&al=" + alano);
                        if (re.responseText == "false") {
                            if (n && c && p && prec && !isNaN(ncp_preco) && !isNaN(ncp_precou)) { //validate form
                                var envio = "n=" + n +
                                    "&c=" + c +
                                    "&p=" + p +
                                    "&prec=" + prec +
                                    "&ncp_preco=" + ncp_preco +
                                    "&ncp_precou=" + ncp_precou + 
                                    "&al=" + alano;
                                var r = webix.ajax().sync().post(BASE_URL + "CPrecarios_Cursos/insert", envio);
                                if (r.responseText == "true") {
                                    webix.message("Dados inseridos com sucesso");
                                    this.getTopParentView().hide(); //hide window
                                    $$("idDTEdPrecario_Cursos").load(BASE_URL + "CPrecarios_Cursos/read");
                                } else {
                                    webix.message({ type: "error", text: "Erro inserindo dados" });
                                }
                            } else
                                webix.message({ type: "error", text: "Erro validando dados" });
                        } else
                            webix.message({ type: "error", text: "Erro, o Pre&ccedil;ario actual ja existe" });
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDPrecarioCursos").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};