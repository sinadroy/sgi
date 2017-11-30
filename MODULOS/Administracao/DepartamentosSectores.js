function cargarVistaDepartamentosSectores(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Departamentos", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDDepartamentos",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Dados",
                                        body: webix.copy(formADDDepartamentos)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdDepartamentos").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdDepartamentos").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cDepartamentos/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdDepartamentos").clearAll();
                                                        $$("idDTEdDepartamentos").load(BASE_URL + "cDepartamentos/read");
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
                                    $$("idDTEdDepartamentos").clearAll();
                                    $$("idDTEdDepartamentos").load(BASE_URL + "cDepartamentos/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdDepartamentos",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "depNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "depCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.depNome && data.depCodigo) {
                                        var envio = "id=" + id +
                                            "&depNome=" + data.depNome +
                                            "&depCodigo=" + data.depCodigo;
                                        var r = webix.ajax().sync().post(BASE_URL + "cDepartamentos/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdDepartamentos").clearAll();
                                            $$("idDTEdDepartamentos").load(BASE_URL + "cDepartamentos/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdDepartamentos").clearAll();
                                        $$("idDTEdDepartamentos").load(BASE_URL + "cDepartamentos/read");
                                    }

                                }

                            },
                            url: BASE_URL + "cDepartamentos/read",
                            pager: "pagerDepartamentos"
                        }, {
                            view: "pager", id: "pagerDepartamentos",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            },
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Sectores", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDSectores",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Dados",
                                        body: webix.copy(formADDSectores)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdSectores").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdSectores").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cSectores/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdSectores").clearAll();
                                                        $$("idDTEdSectores").load(BASE_URL + "cSectores/read");
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
                                    $$("idDTEdSectores").clearAll();
                                    $$("idDTEdSectores").load(BASE_URL + "cSectores/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdSectores",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "secNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "secCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 90, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "depNome", editor: "richselect", header: "Departamento", width: 150, template: "#depNome#", options: BASE_URL + "CDepartamentos/read", sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.secNome && data.secCodigo && data.depNome) {
                                        var iddepnome;
                                        if (isNaN(data.depNome)) {
                                            var r1 = webix.ajax().sync().post(BASE_URL + "cDepartamentos/GetID", "depNome=" + data.depNome);
                                            iddepnome = r1.responseText;
                                        } else
                                            iddepnome = data.depNome;

                                        var envio = "id=" + id +
                                            "&secNome=" + data.secNome +
                                            "&secCodigo=" + data.secCodigo +
                                            "&Departamentos_id=" + iddepnome;
                                        var r = webix.ajax().sync().post(BASE_URL + "cSectores/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdSectores").clearAll();
                                            $$("idDTEdSectores").load(BASE_URL + "cSectores/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdSectores").clearAll();
                                        $$("idDTEdSectores").load(BASE_URL + "cSectores/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cSectores/read",
                            pager: "pagerSectores"
                        }, {
                            view: "pager", id: "pagerSectores",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            },
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Chefe Departamento", body: {
                    //id:"Niveis de Acessos",

                    rows: [{
                        view: "form", scroll: false,
                        rows: [
                            {
                                cols: [
                                    {
                                        view: "text", id: "idCB_bi_ds", label: 'Localizar BI Funcion&aacute;rio', labelPosition: "top", width: 180, name: "fbi_passaporte",
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                var envio = "bi=" + $$("idCB_bi_ds").getValue();;
                                                var r = webix.ajax().sync().post(BASE_URL + "cfuncionarios/readXbi", envio);
                                                var nome_completo = r.responseText;
                                                if (this.getValue !== "") {
                                                    if (nome_completo !== "false") {
                                                        $$("idNomeCompleto").setValue(nome_completo);
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    { view: "text", id: "idNomeCompleto", readonly: true, label: 'Nome Funcion&aacute;rio', labelPosition: "top", width: 350, name: "cNome" },
                                    {
                                        view: "richselect", width: 250, id: "idCB_u_es",
                                        label: 'Usu&aacute;rio', name: "uusuario",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#uusuario#",
                                                yCount: 7,
                                                url: BASE_URL + "cutilizadores/readusuarios"
                                            }
                                        },
                                    },
                                    {
                                        view: "richselect", width: 300, id: "idCB_d_es",
                                        label: 'Departamento', name: "depNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#depNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CDepartamentos/read"
                                            }
                                        },
                                    },
                                    {}
                                ]
                            },
                            {
                                cols: [
                                    {
                                        view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                            var bi = $$("idCB_bi_ds").getValue();
                                            var r1 = webix.ajax().sync().post(BASE_URL + "cfuncionarios/readIDXBI", "bi=" + bi);
                                            var fid = r1.responseText;

                                            var uid = $$("idCB_u_es").getValue();
                                            var did = $$("idCB_d_es").getValue();

                                            var re = webix.ajax().sync().post(BASE_URL + "Cchefes_departamentos_utilizadores/existe", "id=" + fid);
                                            if (re.responseText == "false") {
                                                if (fid && uid && did) { //validate form
                                                    var envio = "funcionarios_id=" + fid +
                                                        "&utilizadores_id=" + uid +
                                                        "&departamentos_id=" + did +
                                                        "&webix_operation=insert";
                                                    var r = webix.ajax().sync().post(BASE_URL + "Cchefes_departamentos_utilizadores/crud", envio);
                                                    if (r.responseText == "true") {
                                                        webix.message("Dados inseridos com sucesso");
                                                        //this.getTopParentView().hide(); //hide window
                                                        $$("idDTEdChefe_Departamento").load(BASE_URL + "Cchefes_departamentos_utilizadores/read");
                                                    } else {
                                                        webix.message({ type: "error", text: "Erro inserindo dados" });
                                                    }
                                                }
                                                else
                                                    webix.message({ type: "error", text: "Erro validando dados" });
                                            } else
                                                webix.message({ type: "error", text: "Erro, o funcion&aacute;rio actual ja existe" });

                                        }
                                    },
                                    {
                                        view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                            var idSelecionado = $$("idDTEdChefe_Departamento").getSelectedId(false, true);
                                            if (idSelecionado) {
                                                webix.confirm({
                                                    title: "Confirmação",
                                                    type: "confirm-warning",
                                                    ok: "Sim", cancel: "Nao",
                                                    text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                                    callback: function (result) {
                                                        if (result) {
                                                            var envio = "id=" + idSelecionado + "&webix_operation=delete";
                                                            var r = webix.ajax().sync().post(BASE_URL + "Cchefes_departamentos_utilizadores/crud", envio);
                                                            if (r.responseText == "true") {
                                                                $$("idDTEdChefe_Departamento").clearAll();
                                                                $$("idDTEdChefe_Departamento").load(BASE_URL + "Cchefes_departamentos_utilizadores/read");
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
                                            $$("idDTEdChefe_Departamento").clearAll();
                                            $$("idDTEdChefe_Departamento").load(BASE_URL + "Cchefes_departamentos_utilizadores/read");
                                        }
                                    },
                                    {}
                                ]
                            }
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdChefe_Departamento",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "fnome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "fnomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "fapelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "fbi_passaporte", header: ["BI/Passaporte", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "uusuario", editor: "richselect", header: "Utilizador", width: 150, template: "#uusuario#", options: BASE_URL + "cutilizadores/readusuarios", sort: "string" },
                                { id: "depnome", editor: "richselect", header: "Departamento", width: 150, template: "#depnome#", options: BASE_URL + "CDepartamentos/read", sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    /*
                                    if (id && data.secNome && data.secCodigo && data.depNome) {
                                        var iddepnome;
                                        if (isNaN(data.depNome)) {
                                            var r1 = webix.ajax().sync().post(BASE_URL + "cDepartamentos/GetID", "depNome=" + data.depNome);
                                            iddepnome = r1.responseText;
                                        } else
                                            iddepnome = data.depNome;

                                        var envio = "id=" + id +
                                            "&secNome=" + data.secNome +
                                            "&secCodigo=" + data.secCodigo +
                                            "&Departamentos_id=" + iddepnome;
                                        var r = webix.ajax().sync().post(BASE_URL + "cSectores/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdSectores").clearAll();
                                            $$("idDTEdSectores").load(BASE_URL + "cSectores/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdSectores").clearAll();
                                        $$("idDTEdSectores").load(BASE_URL + "cSectores/read");
                                    }
*/
                                }

                            },

                            url: BASE_URL + "Cchefes_departamentos_utilizadores/read",
                            pager: "pagerSectores"
                        }, {
                            view: "pager", id: "pagerSectores",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            },
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Chefe Sector", body: {
                    //id:"Niveis de Acessos",

                    rows: [{
                        view: "form", scroll: false,
                        rows: [
                            {
                                cols: [
                                    {
                                        view: "text", id: "idCB_bi_cs", label: 'Localizar BI Funcion&aacute;rio', labelPosition: "top", width: 180, name: "fbi_passaporte",
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                var envio = "bi=" + $$("idCB_bi_cs").getValue();;
                                                var r = webix.ajax().sync().post(BASE_URL + "cfuncionarios/readXbi", envio);
                                                var nome_completo = r.responseText;
                                                if (this.getValue !== "") {
                                                    if (nome_completo !== "false") {
                                                        $$("idNomeCompleto_cs").setValue(nome_completo);
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    { view: "text", id: "idNomeCompleto_cs", readonly: true, label: 'Nome Funcion&aacute;rio', labelPosition: "top", width: 350, name: "cNome" },
                                    {
                                        view: "richselect", width: 250, id: "idCB_u_cs",
                                        label: 'Usu&aacute;rio', name: "uusuario",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#uusuario#",
                                                yCount: 7,
                                                url: BASE_URL + "cutilizadores/readusuarios"
                                            }
                                        },
                                    },
                                    {
                                        view: "richselect", width: 300, id: "idCB_d_cs",
                                        label: 'Sector', name: "secNome",
                                        labelPosition: "top",
                                        options: {
                                            body: {
                                                template: "#secNome#",
                                                yCount: 7,
                                                url: BASE_URL + "CSectores/read"
                                            }
                                        },
                                    },
                                    {}
                                ]
                            },
                            {
                                cols: [
                                    {
                                        view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                            var bi = $$("idCB_bi_cs").getValue();
                                            var r1 = webix.ajax().sync().post(BASE_URL + "cfuncionarios/readIDXBI", "bi=" + bi);
                                            var fid = r1.responseText;

                                            var uid = $$("idCB_u_cs").getValue();
                                            var did = $$("idCB_d_cs").getValue();

                                            var re = webix.ajax().sync().post(BASE_URL + "Cchefes_sectores_utilizadores/existe", "id=" + fid);
                                            if (re.responseText == "false") {
                                                if (fid && uid && did) { //validate form
                                                    var envio = "funcionarios_id=" + fid +
                                                        "&utilizadores_id=" + uid +
                                                        "&sectores_id=" + did +
                                                        "&webix_operation=insert";
                                                    var r = webix.ajax().sync().post(BASE_URL + "Cchefes_sectores_utilizadores/crud", envio);
                                                    if (r.responseText == "true") {
                                                        webix.message("Dados inseridos com sucesso");
                                                        //this.getTopParentView().hide(); //hide window
                                                        $$("idDTEdChefe_sectores").load(BASE_URL + "Cchefes_sectores_utilizadores/read");
                                                    } else {
                                                        webix.message({ type: "error", text: "Erro inserindo dados" });
                                                    }
                                                }
                                                else
                                                    webix.message({ type: "error", text: "Erro validando dados" });
                                            } else
                                                webix.message({ type: "error", text: "Erro, o funcion&aacute;rio actual ja existe" });

                                        }
                                    },
                                    {
                                        view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                            var idSelecionado = $$("idDTEdChefe_sectores").getSelectedId(false, true);
                                            if (idSelecionado) {
                                                webix.confirm({
                                                    title: "Confirmação",
                                                    type: "confirm-warning",
                                                    ok: "Sim", cancel: "Nao",
                                                    text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                                    callback: function (result) {
                                                        if (result) {
                                                            var envio = "id=" + idSelecionado + "&webix_operation=delete";
                                                            var r = webix.ajax().sync().post(BASE_URL + "Cchefes_sectores_utilizadores/crud", envio);
                                                            if (r.responseText == "true") {
                                                                $$("idDTEdChefe_sectores").clearAll();
                                                                $$("idDTEdChefe_sectores").load(BASE_URL + "Cchefes_sectores_utilizadores/read");
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
                                            $$("idDTEdChefe_sectores").clearAll();
                                            $$("idDTEdChefe_sectores").load(BASE_URL + "Cchefes_sectores_utilizadores/read");
                                        }
                                    },
                                    {}
                                ]
                            }
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdChefe_sectores",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "fnome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "fnomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "fapelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "fbi_passaporte", header: ["BI/Passaporte", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "uusuario", editor: "richselect", header: "Utilizador", width: 150, template: "#uusuario#", options: BASE_URL + "cutilizadores/readusuarios", sort: "string" },
                                { id: "secnome", editor: "richselect", header: "Sector", width: 150, template: "#secnome#", options: BASE_URL + "CSectores/read", sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    /*
                                    if (id && data.secNome && data.secCodigo && data.depNome) {
                                        var iddepnome;
                                        if (isNaN(data.depNome)) {
                                            var r1 = webix.ajax().sync().post(BASE_URL + "cDepartamentos/GetID", "depNome=" + data.depNome);
                                            iddepnome = r1.responseText;
                                        } else
                                            iddepnome = data.depNome;

                                        var envio = "id=" + id +
                                            "&secNome=" + data.secNome +
                                            "&secCodigo=" + data.secCodigo +
                                            "&Departamentos_id=" + iddepnome;
                                        var r = webix.ajax().sync().post(BASE_URL + "cSectores/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdSectores").clearAll();
                                            $$("idDTEdSectores").load(BASE_URL + "cSectores/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdSectores").clearAll();
                                        $$("idDTEdSectores").load(BASE_URL + "cSectores/read");
                                    }
*/
                                }

                            },

                            url: BASE_URL + "Cchefes_sectores_utilizadores/read",
                            pager: "pagerSectores"
                        }, {
                            view: "pager", id: "pagerSectores",
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
var formADDDepartamentos = {
    view: "form",
    id: "idformADDDepartamentos",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "depNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "depCodigo", validate: "isNotEmpty", validateEvent: "blur" }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var depnome = $$("idformADDDepartamentos").getValues().depNome;
                        var depcodigo = $$("idformADDDepartamentos").getValues().depCodigo;
                        if (depnome && depcodigo) { //validate form
                            var envio = "depNome=" + depnome +
                                "&depCodigo=" + depcodigo;
                            var r = webix.ajax().sync().post(BASE_URL + "cDepartamentos/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdDepartamentos").load(BASE_URL + "cDepartamentos/read");
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
                        $$("idwinADDDepartamentos").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
//ADICIONAR Sectores
var formADDSectores = {
    view: "form",
    id: "idformADDSectores",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "secNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "secCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                {
                    view: "combo", width: 300,
                    label: 'Departamento', name: "depNome",
                    options: {
                        body: {
                            template: "#depNome#",
                            yCount: 7,
                            url: BASE_URL + "CDepartamentos/read"
                        }
                    }
                },
                {
                    //},{
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var secnome = $$("idformADDSectores").getValues().secNome;
                                var seccodigo = $$("idformADDSectores").getValues().secCodigo;
                                var depnome = $$("idformADDSectores").getValues().depNome;
                                if (secnome && seccodigo && depnome) { //validate form
                                    var envio = "secNome=" + secnome +
                                        "&secCodigo=" + seccodigo +
                                        "&Departamentos_id=" + depnome;
                                    var r = webix.ajax().sync().post(BASE_URL + "cSectores/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdSectores").load(BASE_URL + "cSectores/read");
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
                                $$("idwinADDSectores").close();
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

//ADICIONAR chefes
var formADDChefe_Departamento = {
    view: "form",
    id: "idformADDChefe_Departamento",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "fNome", id: "id_text_fnome", readonly: true },
                { view: "text", label: 'Apelido', name: "fApelido", id: "id_text_fapelido", readonly: true },
                { view: "text", label: 'BI/Passaporte', name: "fbi_passaporte", id: "id_text_fbi_passaporte", readonly: true },
                //{ view: "text", label: 'C&oacute;digo', name: "secCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                {
                    view: "richselect", width: 300,
                    label: 'Usu&aacute;rio', name: "uusuario",
                    options: {
                        body: {
                            template: "#uusuario#",
                            yCount: 7,
                            url: BASE_URL + "cutilizadores/readusuarios"
                        }
                    }
                },
                {
                    view: "richselect", width: 300,
                    label: 'Departamento', name: "depNome",
                    options: {
                        body: {
                            template: "#depNome#",
                            yCount: 7,
                            url: BASE_URL + "CDepartamentos/read"
                        }
                    }
                },
                {
                    //},{
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var secnome = $$("idformADDSectores").getValues().secNome;
                                var seccodigo = $$("idformADDSectores").getValues().secCodigo;
                                var depnome = $$("idformADDSectores").getValues().depNome;
                                if (secnome && seccodigo && depnome) { //validate form
                                    var envio = "secNome=" + secnome +
                                        "&secCodigo=" + seccodigo +
                                        "&Departamentos_id=" + depnome;
                                    var r = webix.ajax().sync().post(BASE_URL + "cSectores/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdSectores").load(BASE_URL + "cSectores/read");
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
                                $$("idwinADDSectores").close();
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