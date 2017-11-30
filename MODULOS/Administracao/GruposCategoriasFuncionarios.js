function cargarVistaGruposCategoriasFuncionarios(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Grupos", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDGrupos",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Dados do Grupo",
                                        body: webix.copy(formADDGrupos)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdGrupos").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdGrupos").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cGrupoFuncionarios/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdGrupos").clearAll();
                                                        $$("idDTEdGrupos").load(BASE_URL + "cGrupoFuncionarios/read");
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
                                    $$("idDTEdGrupos").clearAll();
                                    $$("idDTEdGrupos").load(BASE_URL + "cGrupoFuncionarios/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdGrupos",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "",hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "gfNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "gfCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.gfNome && data.gfCodigo) {
                                        var envio = "id=" + id +
                                            "&gfNome=" + data.gfNome +
                                            "&gfCodigo=" + data.gfCodigo;
                                        var r = webix.ajax().sync().post(BASE_URL + "cGrupoFuncionarios/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdGrupos").clearAll();
                                            $$("idDTEdGrupos").load(BASE_URL + "cGrupoFuncionarios/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdGrupos").clearAll();
                                        $$("idDTEdGrupos").load(BASE_URL + "cGrupoFuncionarios/read");
                                    }

                                }

                            },
                            url: BASE_URL + "cGrupoFuncionarios/read",
                            pager: "pagerGrupos"
                        }, {
                            view: "pager", id: "pagerGrupos",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            },
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Categorias", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDCategorias",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Dados da Categoria",
                                        body: webix.copy(formADDCategorias)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdCategorias").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdCategorias").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cCategoriaFuncionarios/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdCategorias").clearAll();
                                                        $$("idDTEdCategorias").load(BASE_URL + "cCategoriaFuncionarios/read");
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
                                    $$("idDTEdCategorias").clearAll();
                                    $$("idDTEdCategorias").load(BASE_URL + "cCategoriaFuncionarios/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdCategorias",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "",hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "cfNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "cfCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 90, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "gfNome", editor: "richselect", header: "Grupo", width: 150, template: "#gfNome#", options: BASE_URL + "CGrupoFuncionarios/read", sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.cfNome && data.cfCodigo && data.gfNome) {
                                        var idgfnome;
                                        if (isNaN(data.gfNome)) {
                                            var r1 = webix.ajax().sync().post(BASE_URL + "cGrupoFuncionarios/GetID", "gfNome=" + data.gfNome);
                                            idgfnome = r1.responseText;
                                        } else
                                            idgfnome = data.gfNome;

                                        var envio = "id=" + id +
                                            "&cfNome=" + data.cfNome +
                                            "&cfCodigo=" + data.cfCodigo +
                                            "&Grupos_Funcionarios_id=" + idgfnome;
                                        var r = webix.ajax().sync().post(BASE_URL + "cCategoriaFuncionarios/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdCategorias").clearAll();
                                            $$("idDTEdCategorias").load(BASE_URL + "cCategoriaFuncionarios/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdCategorias").clearAll();
                                        $$("idDTEdCategorias").load(BASE_URL + "cCategoriaFuncionarios/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cCategoriaFuncionarios/read",
                            pager: "pagerCategorias"
                        }, {
                            view: "pager", id: "pagerCategorias",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Grupos
var formADDGrupos = {
    view: "form",
    id: "idformADDGrupos",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "gfNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "gfCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var gfnome = $$("idformADDGrupos").getValues().gfNome;
                        var gfcodigo = $$("idformADDGrupos").getValues().gfCodigo;
                        if (gfnome && gfcodigo) { //validate form
                            //webix.message({ type:"error", text:"Entro ok" });
                            //if($$("idformADDNiveis").validate()){    
                            var envio = "gfNome=" + gfnome +
                                "&gfCodigo=" + gfcodigo;
                            var r = webix.ajax().sync().post(BASE_URL + "cGrupoFuncionarios/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdGrupos").load(BASE_URL + "cGrupoFuncionarios/read");
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
                        $$("idwinADDGrupos").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
//ADICIONAR CATEGORIAS
var formADDCategorias = {
    view: "form",
    id: "idformADDCategorias",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "cfNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "cfCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                {
                    view: "combo", width: 300,
                    label: 'Grupo Funcionario', name: "gfNome",
                    options: {
                        body: {
                            template: "#gfNome#",
                            yCount: 7,
                            url: BASE_URL + "CGrupoFuncionarios/read"
                        }
                    }
                },
                {
                    //},{
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var cfnome = $$("idformADDCategorias").getValues().cfNome;
                                var cfcodigo = $$("idformADDCategorias").getValues().cfCodigo;
                                var gfnome = $$("idformADDCategorias").getValues().gfNome;
                                if (cfnome && cfcodigo) { //validate form
                                    var envio = "cfNome=" + cfnome +
                                        "&cfCodigo=" + cfcodigo +
                                        "&Grupos_Funcionarios_id=" + gfnome;
                                    var r = webix.ajax().sync().post(BASE_URL + "cCategoriaFuncionarios/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdCategorias").load(BASE_URL + "cCategoriaFuncionarios/read");
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
                                $$("idwinADDCategorias").close();
                            }
                        }
                    ]
                }
            ],
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
//Adicionar NiveisCursos
var formADDNiveisCursos = {
    view: "form",
    id: "idformADDNiveisCursos",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "combo", width: 300,
                    label: 'Curso', name: "cNome",
                    value: 1, options: {
                        body: {
                            template: "#cNome#",
                            yCount: 7,
                            url: BASE_URL + "CCursos/read"
                        }
                    }
                },
                {
                    view: "combo", width: 300,
                    label: 'N&iacute;vel', name: "nNome",
                    value: 1, options: {
                        body: {
                            template: "#nNome#",
                            yCount: 7,
                            url: BASE_URL + "CNiveis/read"
                        }
                    }
                },
                { view: "counter", label: "Duração", name: "ncDuracao" },
                { view: "text", label: 'Pre&ccedil;o de Inscri&ccedil;&atilde;o', name: "ncPreco_Inscricao", validate: "isNumber", validateEvent: "blur" },
                { view: "text", label: 'Pre&ccedil;o de Matr&iacute;cula', name: "ncPreco_Matricula", validate: "isNumber", validateEvent: "blur" },
                { view: "text", label: 'Pre&ccedil;o de Propina', name: "ncPreco_Propina", validate: "isNumber", validateEvent: "blur" },
                {
                    //},{
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var cnome = $$("idformADDNiveisCursos").getValues().cNome;
                                var nnome = $$("idformADDNiveisCursos").getValues().nNome;
                                var ncduracao = $$("idformADDNiveisCursos").getValues().ncDuracao;
                                var ncpreco_inscricao = $$("idformADDNiveisCursos").getValues().ncPreco_Inscricao;
                                var ncpreco_matricula = $$("idformADDNiveisCursos").getValues().ncPreco_Matricula;
                                var ncpreco_propina = $$("idformADDNiveisCursos").getValues().ncPreco_Propina;

                                if (cnome && nnome && !isNaN(ncduracao) && !isNaN(ncpreco_inscricao) && !isNaN(ncpreco_matricula) &&
                                    !isNaN(ncpreco_propina) && ncduracao && ncpreco_inscricao && ncpreco_matricula && ncpreco_propina) { //validate form
                                    var envio = "cursos_id=" + cnome +
                                        "&niveis_id=" + nnome +
                                        "&ncDuracao=" + ncduracao +
                                        "&ncPreco_Inscricao=" + ncpreco_inscricao +
                                        "&ncPreco_Matricula=" + ncpreco_matricula +
                                        "&ncPreco_Propina=" + ncpreco_propina;
                                    var r = webix.ajax().sync().post(BASE_URL + "cNiveisCursos/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdNiveisCursos").load(BASE_URL + "cNiveisCursos/read");
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
                                $$("idwinADDNiveisCursos").close();
                            }
                        }
                    ]
                }
            ],
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};