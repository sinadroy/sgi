function cargarVistaUsuarios(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Niveis de Acessos", icon: "users", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDNA",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Dados de Usu&aacute;rio",
                                        body: webix.copy(formADDNiveisAcesso)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdNiveisAcesso").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdNiveisAcesso").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cNiveisAcesso/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdNiveisAcesso").clearAll();
                                                        $$("idDTEdNiveisAcesso").load(BASE_URL + "cNiveisAcesso/read");
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
                                    $$("idDTEdNiveisAcesso").clearAll();
                                    $$("idDTEdNiveisAcesso").load(BASE_URL + "cNiveisAcesso/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdNiveisAcesso",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "naNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "naDescricao", editor: "text", header: "Descri&ccedil;&atilde;o", width: 200, sort: "string" }
                            ],/*
                            pager:{
                                template:"{common.prev()} {common.pages()} {common.next()}",
                                container:"principalAdmin",
                                align:"center",
                                size:25,
                                group:7
                            },*/
                            on: {
                                /*
                                "onItemClick":function(id){
                                    this.editStop();
                                    this.editRow(id);
                                    this.focusEditor(id);
				},
                                */
                                "onDataUpdate": function (id, data) {
                                    //alert("Current value: " + data.uNome);
                                    //alert("Current value: " + id);
                                    //validar todo
                                    if (id && data.naNome) {
                                        var envio = "id=" + id +
                                            "&naNome=" + data.naNome +
                                            "&naDescricao=" + data.naDescricao;
                                        var r = webix.ajax().sync().post(BASE_URL + "cNiveisAcesso/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdNiveisAcesso").clearAll();
                                            $$("idDTEdNiveisAcesso").load(BASE_URL + "cNiveisAcesso/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdNiveisAcesso").clearAll();
                                        $$("idDTEdNiveisAcesso").load(BASE_URL + "cutilizadores/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cNiveisAcesso/read",
                            pager: "pagerNiveisAcesso"
                        }, {
                            view: "pager", id: "pagerNiveisAcesso",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            },
            {
                header: "Modulos e Sub-Modulos", body: {
                    rows: [
                        {
                            cols: [
                                {
                                    view: "combo", id: "idcombo_NA", width: 300, labelPosition: "top",
                                    label: 'Nivei de Acesso', name: "naNome",
                                    options: {
                                        body: {
                                            template: "#naNome#",
                                            yCount: 20,
                                            url: BASE_URL + "CNiveisAcesso/read"
                                        }
                                    }
                                }, {
                                    view: "combo", id: "idcombo_M", width: 300, labelPosition: "top",
                                    label: 'Modulos', name: "mNome",
                                    options: {
                                        body: {
                                            template: "#mNome#",
                                            yCount: 20,
                                            url: BASE_URL + "CModulos/read"
                                        }
                                    }, on: {
                                        "onChange": function (newv, oldv) {
                                            //ACTUALIZAR COMBO CONTAS
                                            $$("idcombo_SM").getList().clearAll();
                                            $$("idcombo_SM").getList().load(BASE_URL + "CSubModulos/readXid?modulo=" + this.getValue());
                                        }
                                    }
                                }, {
                                    view: "combo", id: "idcombo_SM", width: 300, labelPosition: "top",
                                    label: 'Sub-Modulos', name: "smNome",
                                    options: {
                                        body: {
                                            template: "#smNome#",
                                            yCount: 20,
                                            url: BASE_URL + "CSubModulos/readAll"
                                        }
                                    }
                                },
                                {}
                            ]
                        }, {
                            cols: [
                                {
                                    view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                        //alert($$("idcombo_NA").getValue());
                                        na_value = $$("idcombo_NA").getValue();
                                        m_value = $$("idcombo_M").getValue();
                                        sm_value = $$("idcombo_SM").getValue();
                                        var envio = "Niveis_Acessos_id=" + na_value + "&Modulos_id=" + m_value + "&sub_modulos_id=" + sm_value;
                                        var r = webix.ajax().sync().post(BASE_URL + "cNiveis_Acessos_Modulos/insert", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTModulosXNA").clearAll();
                                            $$("idDTModulosXNA").load(BASE_URL + "cNiveis_Acessos_Modulos/read");
                                            webix.message("Os dados foram adicionados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro adicionando dados" });
                                        }
                                    }
                                },
                                {
                                    view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                        var idSelecionado = $$("idDTModulosXNA").getSelectedId(false, true);
                                        if (idSelecionado) {
                                            webix.confirm({
                                                title: "Confirmação",
                                                type: "confirm-warning",
                                                ok: "Sim", cancel: "Nao",
                                                text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback: function (result) {
                                                    if (result) {
                                                        //var idrowDT = $$("idDTEdUsuarios").getSelectedId(false,true);
                                                        var envio = "id=" + idSelecionado;
                                                        var r = webix.ajax().sync().post(BASE_URL + "cNiveis_Acessos_Modulos/delete", envio);
                                                        if (r.responseText == "true") {
                                                            $$("idDTModulosXNA").clearAll();
                                                            $$("idDTModulosXNA").load(BASE_URL + "cNiveis_Acessos_Modulos/read");
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
                                },  {
                                    view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                        //actualizar grid
                                        $$("idDTModulosXNA").clearAll();
                                        $$("idDTModulosXNA").load(BASE_URL + "cNiveis_Acessos_Modulos/read");
                                        //actualizar combos
                                        $$("idcombo_NA").getList().clearAll();
                                        $$("idcombo_NA").getList().load(BASE_URL + "CNiveisAcesso/read");
                                        //actualizar combos
                                        $$("idcombo_M").getList().clearAll();
                                        $$("idcombo_M").getList().load(BASE_URL + "CModulos/read");
                                        //actualizar combos
                                        $$("idcombo_SM").getList().clearAll();
                                        $$("idcombo_SM").getList().load(BASE_URL + "CSubModulos/readAll");
                                    }
                                },
                                {}
                            ]

                        }, {
                            view: "datatable",
                            id: "idDTModulosXNA",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            //editable:true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "naNome", editor: "text", header: ["Niveis de Acesso", { content: "selectFilter" }], width: 200, sort: "string" },
                                { id: "mNome", editor: "text", header: ["Modulo", { content: "selectFilter" }], width: 200, sort: "string" },
                                { id: "smNome", editor: "text", header: ["Sub-Modulos", { content: "selectFilter" }], width: 200, sort: "string" },
                            ],
                            url: BASE_URL + "cNiveis_Acessos_Modulos/read",
                            pager: "pagerNAM"
                        }, {
                            view: "pager", id: "pagerNAM",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }
                    ]
                }
            }, {
                header: "Editar Usu&aacute;rios", body: {
                    //id:"Editar Usu&aacute;rios",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDUsuarios",
                                        width: 650,
                                        position: "center",
                                        modal: true,
                                        head: "Dados de Usu&aacute;rio",
                                        body: webix.copy(formADDUsuarios)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdUsuarios").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdUsuarios").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdUsuarios").clearAll();
                                                        $$("idDTEdUsuarios").load(BASE_URL + "cutilizadores/read");
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

                                    /*
                                    var idrowDT = $$("idDTEdUsuarios").getSelectedId(false,true);
                                    var envio = "id="+idrowDT;
                                    var r = webix.ajax().sync().post(BASE_URL+"cutilizadores/delete", envio);
                                    if(r.responseText == "true"){
                                        $$("idDTEdUsuarios").clearAll();
                                        $$("idDTEdUsuarios").load(BASE_URL+"cutilizadores/read");
                                        webix.message("Os dados foram apagados com sucesso");
                                    }else{    
                                        webix.message({ type:"error", text:"Erro apagando dados" });
                                    }*/
                                }

                            },{
                                    view: "button", type: "danger", value: "Aterar Senha", width: 120, height: 50, click: function () {
                                        var idSelecionado = $$("idDTEdUsuarios").getSelectedId(false, true);
                                        if (idSelecionado) {
                                            webix.ui({
                                                view: "window",
                                                id: "id_win_usuario_ed_senha",
                                                width: 600,
                                                position: "center",
                                                modal: true,
                                                head: "Editar Dados",
                                                body: webix.copy(formEDUsuario_Senha)
                                            }).show();
                                            //Ano
                                            var envio = "id=" + idSelecionado;
                                            var r = webix.ajax().sync().post(BASE_URL + "Cutilizadores/readX2", envio);
                                            $$("id_text_uUsuario").setValue(r.responseText);

                                            $$("id_text_idusuario").setValue(idSelecionado);

                                        } else {
                                            webix.message({ type: "error", text: "Deve selecionar primeriro um usu&aacute;rio" });
                                        }
                                    }
                                }, {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdUsuarios").clearAll();
                                    $$("idDTEdUsuarios").load(BASE_URL + "cutilizadores/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdUsuarios",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "uTitulo", header: "T&iacute;tulo", width: 60, sort: "string" },
                                { id: "uNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "uApelido", editor: "text", header: "Apelido", width: 200, sort: "string" },
                                { id: "uEmail", editor: "text", header: "Correio", width: 200, validate: webix.rules.isEmail(), sort: "string" },
                                { id: "uUsuario", editor: "text", header: ["Utilizador", { content: "textFilter" }], autowidth: true, sort: "string" },
                                { id: "uSenha", /*editor: "password",*/ header: "Senha-MD5", autowidth: true, },
                                //{ id:"naNome",header:["N&iacute;vel_Acesso", {content:"selectFilter"}],width:130,sort:"string"},
                                { id: "naNome", editor: "richselect", header: "Niveis Acesso", width: 150, validate: webix.rules.isNotEmpty(), template: "#naNome#", options: BASE_URL + "CNiveisAcesso/read" },
                                { id: "p_nome_completo", /*editor: "richselect",*/ header: "Professor", width: 150, validate: webix.rules.isNotEmpty(), template: "#p_nome_completo#", options: BASE_URL + "cFuncionarios/read_professores" },
                            ],

                            on: {
                                /*
                                "onItemClick":function(id){
                                    this.editStop();
                                    this.editRow(id);
                                    this.focusEditor(id);
				},
                                */
                                "onDataUpdate": function (id, data) {
                                    //alert("Current value: " + data.uNome);
                                    //alert("Current value: " + id);
                                    //validar todo
                                    if (data.uNome && data.uApelido && data.uTitulo && data.uEmail && data.uUsuario && data.uSenha && data.naNome)
                                    //if($$(idDTEdUsuarios).validate())
                                    {
                                        var envio = "id=" + id +
                                            "&uNome=" + data.uNome +
                                            "&uApelido=" + data.uApelido +
                                            "&uTitulo=" + data.uTitulo +
                                            "&uEmail=" + data.uEmail +
                                            "&uUsuario=" + data.uUsuario +
                                            "&uSenha=" + data.uSenha +
                                            "&naNome=" + data.naNome;
                                        var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdUsuarios").clearAll();
                                            $$("idDTEdUsuarios").load(BASE_URL + "cutilizadores/read");
                                            webix.message("Dados atualizados com sucesso");
                                            //this.getTopParentView().hide(); //hide window
                                            //$$("idDTEdUsuarios").load(BASE_URL+"cutilizadores/read");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdUsuarios").clearAll();
                                        $$("idDTEdUsuarios").load(BASE_URL + "cutilizadores/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cutilizadores/read",
                            pager: "pagerEditarUsuarios"
                        }, {
                            view: "pager", id: "pagerEditarUsuarios",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Niveis de Acesso
var formADDNiveisAcesso = {
    view: "form",
    id: "idformADDNiveisAcesso",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "naNome" },
                { view: "text", label: 'Descri&ccedil;&atilde;o', name: "naDescricao" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        if ($$("idformADDNiveisAcesso").getValues().naDescricao && $$("idformADDNiveisAcesso").getValues().naNome) { //validate form
                            //webix.message({ type:"error", text:"Entro ok" });
                            //if($$("idformADDNiveisAcesso").validate()){    
                            var envio = "naNome=" + $$("idformADDNiveisAcesso").getValues().naNome +
                                "&naDescricao=" + $$("idformADDNiveisAcesso").getValues().naDescricao;
                            var r = webix.ajax().sync().post(BASE_URL + "cNiveisAcesso/insert", envio);
                            if (r.responseText == "true") {
                                //var redirect = BASE_URL+'welcome/principal';
                                //window.location = redirect;
                                //$$("component_id").load("some/path/data.json");
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdNiveisAcesso").load(BASE_URL + "cNiveisAcesso/read");
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
                        $$("idwinADDNA").close();
                    }
                }
            ]
        }
    ],
    rules: {
        "naNome": webix.rules.isNotEmpty(),
        "naDescricao": webix.rules.isNotEmpty()
    },
    elementsConfig: {
        labelPosition: "top",
    }
};
//Adicionar Usuario
var formADDUsuarios = {
    view: "form",
    id: "idFromADDUsuarios",
    borderless: true,
    elements: [
        {
            cols: [
                {
                    rows: [
                        {
                            view: "combo", width: 300,
                            label: 'Titulo', name: "uTitulo",
                            value: 1, options: [
                                { id: 1, value: "Sr." },
                                { id: 2, value: "Sra." }
                            ]
                        },
                        { view: "text", label: 'Nome', name: "uNome" },
                        { view: "text", label: 'Apelido', name: "uApelido" },
                        { view: "text", label: 'Email', name: "uEmail" },
                        {},
                    ]
                },
                {
                    rows: [
                        { view: "text", label: 'Usuario', name: "uUsuario" },
                        { view: "text", label: 'Senha', name: "uSenha", type: "password" },
                        //{ view:"text", label:'naNome', name:"naNome" },
                        {
                            view: "combo", width: 300,
                            label: 'Nivei Acesso', name: "naNome",
                            value: 1, options: {
                                body: {
                                    template: "#naNome#",
                                    yCount: 7,
                                    url: BASE_URL + "CNiveisAcesso/read"
                                }
                            }
                        },
                        {},
                        {
                            view: "combo", width: 300,
                            label: 'Professor', name: "p_nome_completo",
                            options: {
                                body: {
                                    template: "#p_nome_completo#",
                                    yCount: 7,
                                    url: BASE_URL + "cFuncionarios/read_professores"
                                }
                            }
                        },

                    ]
                }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        if ($$("idFromADDUsuarios").validate()) { //validate form
                            var envio = "uNome=" + $$("idFromADDUsuarios").getValues().uNome +
                                "&uApelido=" + $$("idFromADDUsuarios").getValues().uApelido +
                                "&uTitulo=" + $$("idFromADDUsuarios").getValues().uTitulo +
                                "&uEmail=" + $$("idFromADDUsuarios").getValues().uEmail +
                                "&uUsuario=" + $$("idFromADDUsuarios").getValues().uUsuario +
                                "&uSenha=" + $$("idFromADDUsuarios").getValues().uSenha +
                                "&naNome=" + $$("idFromADDUsuarios").getValues().naNome +
                                "&p_nome_completo=" + $$("idFromADDUsuarios").getValues().p_nome_completo;
                            var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/insert", envio);
                            if (r.responseText == "true") {
                                //var redirect = BASE_URL+'welcome/principal';
                                //window.location = redirect;
                                //$$("component_id").load("some/path/data.json");
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdUsuarios").load(BASE_URL + "cutilizadores/read");
                            } else {
                                webix.message({ type: "error", text: "Erro inserindo dados" });
                            }
                        }
                        else
                            webix.message({ type: "error", text: "Dados incorretos" });
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("idwinADDUsuarios").close();
                    }
                }
            ]
        }
    ],
    rules: {
        "uEmail": webix.rules.isEmail,
        "uNome": webix.rules.isNotEmpty,
        "uApelido": webix.rules.isNotEmpty,
        "uTitulo": webix.rules.isNotEmpty,
        "uUsuario": webix.rules.isNotEmpty,
        "uSenha": webix.rules.isNotEmpty,
        "naNome": webix.rules.isNotEmpty
        //webix.rules.isNumber()
    },
    elementsConfig: {
        labelPosition: "top",
    }
};

//formEDUsuario_Senha
var formEDUsuario_Senha = {
    view: "form",
    id: "idformEDUsuario_Senha",
    borderless: true,
    elements: [
        {
            rows:[
                { view: "text", label: 'id', hidden:true, id:"id_text_idusuario", name: "uid" },
                { view: "text", label: 'Usuario', disabled:true, id:"id_text_uUsuario", name: "uUsuario" },
                { view: "text", label: 'Senha', name: "uSenha", id:"id_text_uSenha", type: "password", validate: "isNotEmpty", validateEvent: "blur"},
            ]
        
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var uid = $$("id_text_idusuario").getValue();
                        var senha = $$("id_text_uSenha").getValue();
                        if (uid && senha) { //validate form
                            var envio = "id=" + uid + "&uSenha=" + senha;
                            var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/update_senha", envio);
                            if (r.responseText == "true") {
                                //var redirect = BASE_URL+'welcome/principal';
                                //window.location = redirect;
                                //$$("component_id").load("some/path/data.json");
                                webix.message("Dados actualizados com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdUsuarios").load(BASE_URL + "cutilizadores/read");
                            } else {
                                webix.message({ type: "error", text: "Erro actualizando dados" });
                            }
                        }
                        else
                            webix.message({ type: "error", text: "Dados incorretos" });
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("id_win_usuario_ed_senha").close();
                    }
                }
            ]
        }
    ],
    rules: {
        "uEmail": webix.rules.isEmail,
        "uNome": webix.rules.isNotEmpty,
        "uApelido": webix.rules.isNotEmpty,
        "uTitulo": webix.rules.isNotEmpty,
        "uUsuario": webix.rules.isNotEmpty,
        "uSenha": webix.rules.isNotEmpty,
        "naNome": webix.rules.isNotEmpty
        //webix.rules.isNumber()
    },
    elementsConfig: {
        labelPosition: "top",
    }
};
