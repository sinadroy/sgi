function cargarVistaDisciplinas(itemID) {

    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Disciplinas", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDDisciplinas",
                                        width: 600,
                                        position: "center",
                                        modal: true,
                                        head: "Dados da Disciplina",
                                        body: webix.copy(formADDDisciplinas)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "standard", value: "Editar", width: 120, /*height: 50,*/ click: function () {
                                    var idSelecionado = $$("idDTEdDisciplinas").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.ui({
                                            view: "window",
                                            id: "id_win_disciplinas_ed",
                                            width: 600,
                                            position: "center",
                                            modal: true,
                                            head: "Editar Dados",
                                            body: webix.copy(formEDDisciplinas)
                                        }).show();
                                        //cargar datos en la windows
                                        var record = $$("idDTEdDisciplinas").getItem(idSelecionado);
                                        //var idSelecionado = record.cid;
                                        var n = record.nid;
                                        var c = record.cid;
                                        var p = record.pid;
                                        var dNome = record.dNome;
                                        var dCodigo = record.dCodigo;
                                        var clid = record.Classificacao_id;
                                        var durid = record.Disciplinas_Duracao_id;
                                        var acid = record.acId;
                                        var sid = record.sId;
                                        var desc = record.dDescricao;
                                        var nmi = record.dNotaMinima;
                                        var nma = record.dNotaMaxima;
                                        var qh = record.dQuantidadesHoras;
                                        var cred = record.dCredito;
                                        var dEstado = record.dEstado;
                                        var d_geracao_id = record.d_geracao_id;

                                        $$("id_ed_d").setValue(idSelecionado);

                                        $$("id_ed_nNome").setValue(n); $$("id_ed_cNome").setValue(c);
                                        $$("id_ed_pNome").setValue(p); $$("id_ed_dNome").setValue(dNome);
                                        $$("id_ed_dCodigo").setValue(dCodigo); $$("id_ed_clNome").setValue(clid);
                                        $$("id_ed_ddNome").setValue(durid); $$("idComboAC").setValue(acid);
                                        $$("idComboSemestre").setValue(sid); $$("id_ed_dDescricao").setValue(desc);
                                        $$("id_ed_dNotaMinima").setValue(nmi); $$("id_ed_dNotaMaxima").setValue(nma);
                                        $$("id_ed_dQuantidadesHoras").setValue(qh); $$("id_ed_dCredito").setValue(cred);
                                        $$("id_ed_activa").setValue(dEstado);
                                        if (isNaN(d_geracao_id) == false)
                                            $$("idComboDisciploinasGeracao").setValue(d_geracao_id);

                                    } else {
                                        webix.message({ type: "error", text: "Deve selecionar primeriro uma disciplina" });
                                    }
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdDisciplinas").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdDisciplinas").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdDisciplinas").clearAll();
                                                        $$("idDTEdDisciplinas").load(BASE_URL + "cDisciplinas/read");
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

                            },
                            {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdDisciplinas").clearAll();
                                    $$("idDTEdDisciplinas").load(BASE_URL + "cDisciplinas/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdDisciplinas",
                            select: true,
                            editable: false,
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 50, sort: "int" },
                                { id: "nid", header: "nid", hidden: true, sort: "int" },
                                //{ id: "dEstado", header: "Estado", hidden: false, sort: "string" },
                                {
                                    id: "dEstado", header: "Estado", width: 90, sort: "string",
                                    template: function (obj) {
                                        if (obj.dEstado == "off")
                                            return "<span style='color:red;'>" + obj.dEstado + "</span>";
                                        else
                                            return "<span style='color:green;'>" + obj.dEstado + "</span>";

                                    },
                                },
                                { id: "nNome",/*editor:"richselect",*/header: ["N&iacute;vel", { content: "selectFilter" }], width: 150, sort: "string" },
                                { id: "cid", header: "cid", hidden: true, sort: "int" },
                                { id: "cNome",/*editor:"richselect",*/header: ["Curso", { content: "selectFilter" }], width: 250, sort: "string" },
                                { id: "pid", header: "pid", hidden: true, sort: "int" },
                                { id: "pNome",/*editor:"richselect",*/header: ["Per&iacute;odo", { content: "selectFilter" }], width: 120, sort: "string" },
                                { id: "acId", header: "acId", hidden: true, sort: "int" },
                                { id: "acNome", editor: "richselect", header: ["Ano Curricular", { content: "textFilter" }], width: 120, template: "#acNome#", options: BASE_URL + "CAno_Curricular/read" },
                                { id: "sId", header: "sId", hidden: true, sort: "int" },
                                { id: "sNome", editor: "richselect", header: ["Semestre", { content: "textFilter" }], width: 100, template: "#sNome#", options: BASE_URL + "CSemestres/read" },
                                { id: "dNome", editor: "text", header: ["Disciplinas", { content: "textFilter" }], width: 200, sort: "string" },
                                { id: "dCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "dgnome", editor: "text", header: ["Gera&ccedil;&atilde;o", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "dNotaMaxima", editor: "text", header: "Nota M&aacute;xima", width: 120, sort: "int" },
                                { id: "dNotaMinima", editor: "text", header: "Nota M&iacute;nima", width: 120, sort: "int" },
                                { id: "dQuantidadesHoras", editor: "text", header: "Quantidade Horas", width: 150, sort: "int" },
                                { id: "dCredito", editor: "text", header: "Cr&eacute;dito", width: 100, sort: "int" },
                                { id: "Classificacao_id", header: "Classificacao_id", hidden: true, sort: "int" },
                                { id: "clNome", editor: "richselect", header: "Classifica&ccedil;&atilde;o", width: 150, template: "#clNome#", options: BASE_URL + "CClassificacao/read" },
                                { id: "Disciplinas_Duracao_id", header: "Disciplinas_Duracao_id", hidden: true, sort: "int" },
                                { id: "ddNome", editor: "richselect", header: "Dura&ccedil;&atilde;o", width: 150, template: "#ddNome#", options: BASE_URL + "CDisciplinas_Duracao/read" },

                                { id: "dDescricao", editor: "text", header: "Descri&ccedil;&atilde;o", width: 200, sort: "string" },
                            ],
                            resizeColumn: true,
                            url: BASE_URL + "cDisciplinas/read",
                            pager: "pagerDisciplinas"
                        }, {
                            view: "pager", id: "pagerDisciplinas",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            },
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Classifica&ccedil;&atilde;o", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDClassificacao",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Classifica&ccedil;&atilde;o",
                                        body: webix.copy(formADDClassificacao)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdClassificacao").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdClassificacao").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cClassificacao/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdClassificacao").clearAll();
                                                        $$("idDTEdClassificacao").load(BASE_URL + "cClassificacao/read");
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
                                    $$("idDTEdClassificacao").clearAll();
                                    $$("idDTEdClassificacao").load(BASE_URL + "cClassificacao/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdClassificacao",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "clNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                { id: "clCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 90, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                { id: "clPercentagem", editor: "text", header: "Percentagem", width: 150, validate: "isNotEmpty", validateEvent: "blur", sort: "int" },
                                { id: "clObservacao", editor: "text", header: "Observa&ccedil;&atilde;o", width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.clNome && data.clCodigo && data.clObservacao) {
                                        var envio = "id=" + id +
                                            "&clNome=" + data.clNome +
                                            "&clCodigo=" + data.clCodigo +
                                            "&clPercentagem=" + data.clPercentagem +
                                            "&clObservacao=" + data.clObservacao;
                                        var r = webix.ajax().sync().post(BASE_URL + "cClassificacao/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdClassificacao").clearAll();
                                            $$("idDTEdClassificacao").load(BASE_URL + "cClassificacao/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdClassificacao").clearAll();
                                        $$("idDTEdClassificacao").load(BASE_URL + "cClassificacao/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cClassificacao/read",
                            pager: "pagerClassificacao"
                        }, {
                            view: "pager", id: "pagerClassificacao",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            },
            {
                header: "Dura&ccedil;&atilde;o", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDDisciplinas_Duracao",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Dura&ccedil;&atilde;o",
                                        body: webix.copy(formADDDisciplinas_Duracao)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdDisciplinas_Duracao").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    //var idrowDT = $$("idDTEdNiveisCursos").getSelectedId(false,true);
                                                    var envio = "id=" + idSelecionado;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas_Duracao/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdDisciplinas_Duracao").clearAll();
                                                        $$("idDTEdDisciplinas_Duracao").load(BASE_URL + "cDisciplinas_Duracao/read");
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
                                    $$("idDTEdDisciplinas_Duracao").clearAll();
                                    $$("idDTEdDisciplinas_Duracao").load(BASE_URL + "cDisciplinas_Duracao/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdDisciplinas_Duracao",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "ddNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                { id: "ddCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 90, validate: "isNotEmpty", validateEvent: "blur", sort: "string" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.ddNome && data.ddCodigo) {
                                        var envio = "id=" + id +
                                            "&ddNome=" + data.ddNome +
                                            "&ddCodigo=" + data.ddCodigo;
                                        var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas_Duracao/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdDisciplinas_Duracao").clearAll();
                                            $$("idDTEdDisciplinas_Duracao").load(BASE_URL + "cDisciplinas_Duracao/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdDisciplinas_Duracao").clearAll();
                                        $$("idDTEdDisciplinas_Duracao").load(BASE_URL + "cDisciplinas_Duracao/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cDisciplinas_Duracao/read",
                            pager: "pagerDisciplinas_Duracao"
                        }, {
                            view: "pager", id: "pagerDisciplinas_Duracao",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            },
            {
                header: "Gera&ccedil;&atilde;o", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDDisciplinas_Geracao",
                                        width: 300,
                                        position: "center",
                                        modal: true,
                                        head: "Dura&ccedil;&atilde;o",
                                        body: webix.copy(formADDDisciplinas_Geracao)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdDisciplinas_Geracao").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    //var idrowDT = $$("idDTEdNiveisCursos").getSelectedId(false,true);
                                                    var envio = "id=" + idSelecionado;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas_Geracao/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdDisciplinas_Geracao").clearAll();
                                                        $$("idDTEdDisciplinas_Geracao").load(BASE_URL + "cDisciplinas_Geracao/read");
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
                                    $$("idDTEdDisciplinas_Geracao").clearAll();
                                    $$("idDTEdDisciplinas_Geracao").load(BASE_URL + "cDisciplinas_Geracao/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdDisciplinas_Geracao",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "dgnome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "dgano_inicio", editor: "text", header: ["Ano Inicio", { content: "selectFilter" }], width: 90, sort: "int" },
                                { id: "dgano_fin", editor: "text", header: ["Ano Fim", { content: "selectFilter" }], width: 90, sort: "int" }
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.dgnome && isNaN(data.dgano_inicio) == false && isNaN(data.dgano_fin) == false) {
                                        var envio = "id=" + id +
                                            "&dgnome=" + data.dgnome +
                                            "&dgano_inicio=" + data.dgano_inicio +
                                            "&dgano_fin=" + data.dgano_fin;
                                        var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas_Geracao/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdDisciplinas_Geracao").clearAll();
                                            $$("idDTEdDisciplinas_Geracao").load(BASE_URL + "cDisciplinas_Geracao/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdDisciplinas_Geracao").clearAll();
                                        $$("idDTEdDisciplinas_Geracao").load(BASE_URL + "cDisciplinas_Geracao/read");
                                    }

                                }

                            },
                            resizeColumn: true,
                            url: BASE_URL + "cDisciplinas_Geracao/read",
                            pager: "pagerDisciplinas_Geracao"
                        }, {
                            view: "pager", id: "pagerDisciplinas_Geracao",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            },
            {
                header: "Precedencias", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            /*{   view:"button", type:"form", value:"Adicionar", width:100, click:function(){
                                    webix.ui({
                                        view:"window",
                                        id:"idwinADDDisciplinas_Precedencias",
                                        width:500,
                                        position:"center",
                                        modal:true,
                                        head:"Precedencias",
                                        body:webix.copy(formADDDisciplinas_Precedencias)
                                    }).show();
                                }
                            },*/
                            {
                                view: "button", type: "form", value: "Editar", width: 120, height: 50, click: function () {
                                    var idSelecionado = $$("idDTEdDisciplinas_Precedencias").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.ui({
                                            view: "window",
                                            id: "id_win_precedencias_ed",
                                            width: 400,
                                            position: "center",
                                            modal: true,
                                            head: "Editar Dados",
                                            body: webix.copy(formEDPrecedencias)
                                        }).show();
                                        //cargar datos en la windows
                                        var record = $$("idDTEdDisciplinas_Precedencias").getItem(idSelecionado);
                                        //var idSelecionado = record.cid;
                                        var p1 = record.dPrecedencia1;
                                        var p2 = record.dPrecedencia2;
                                        var p3 = record.dPrecedencia3;

                                        //$$("id_ed_d").setValue(idSelecionado);

                                        $$("id_edp_p1").setValue(p1);
                                        $$("id_edp_p2").setValue(p2);
                                        $$("id_edp_p3").setValue(p3);

                                        $$("id_edp_p1").disable();
                                        $$("id_edp_p2").disable();
                                        $$("id_edp_p3").disable();

                                    } else {
                                        webix.message({ type: "error", text: "Deve selecionar primeriro uma disciplina" });
                                    }
                                }
                            },
                            {
                                view: "button", type: "danger",/*disabled:true,*/ value: "Apagar Precedencias", width: 200, click: function () {
                                    var idSelecionado = $$("idDTEdDisciplinas_Precedencias").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar precedencias da disciplina selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var envio = "id=" + idSelecionado;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas_Precedencias/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdDisciplinas_Precedencias").clearAll();
                                                        $$("idDTEdDisciplinas_Precedencias").load(BASE_URL + "cDisciplinas_Precedencias/read");
                                                        webix.message("Os dados foram apagados com sucesso");
                                                    } else {
                                                        webix.message({ type: "error", text: "Erro apagando dados" });
                                                    }
                                                }
                                            }
                                        });
                                    } else {
                                        webix.message({ type: "error", text: "Erro, deve selecionar uma disciplina" });
                                    }

                                }

                            }, {
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdDisciplinas_Precedencias").clearAll();
                                    $$("idDTEdDisciplinas_Precedencias").load(BASE_URL + "cDisciplinas_Precedencias/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdDisciplinas_Precedencias",
                            select: true,
                            editable: false,
                            columns: [
                                { id: "id", header: "", hidden: true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 50, sort: "int" },
                                { id: "nid", header: "nid", hidden: true, sort: "int" },
                                { id: "nNome", header: ["N&iacute;vel", { content: "selectFilter" }], width: 170, sort: "string" },
                                { id: "cid", header: "cid", hidden: true, sort: "int" },
                                { id: "cNome", header: ["Curso", { content: "selectFilter" }], width: 250, sort: "string" },
                                { id: "pid", header: "pid", hidden: true, sort: "int" },
                                { id: "pNome", header: ["Per&iacute;odo", { content: "selectFilter" }], width: 140, sort: "string" },
                                { id: "acId", header: "acId", hidden: true, sort: "int" },
                                { id: "acNome", header: ["Ano Curricular", { content: "selectFilter" }], width: 130, sort: "string" },
                                { id: "dNome", header: ["Disciplina", { content: "selectFilter" }], width: 170, sort: "string" },
                                { id: "dCodigo", header: ["C&oacute;digo", { content: "textFilter" }], width: 150, sort: "string" },
                                { id: "dPrecedencia1", editor: "richselect", header: "Precedencia1", width: 150, template: "#dPrecedencia1#", options: BASE_URL + "CDisciplinas_Precedencias/readP1" },
                                { id: "dPrecedencia2", editor: "richselect", header: "Precedencia2", width: 150, template: "#dPrecedencia2#", options: BASE_URL + "CDisciplinas_Precedencias/readP2" },
                                { id: "dPrecedencia3", editor: "richselect", header: "Precedencia3", width: 150, template: "#dPrecedencia3#", options: BASE_URL + "CDisciplinas_Precedencias/readP2" }
                            ],
                            resizeColumn: true,
                            /*on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.dNome && data.dCodigo) {
                                        var idp1;
                                        if (isNaN(data.dPrecedencia1)) {
                                            var rp1 = webix.ajax().sync().post(BASE_URL + "cDisciplinas_Precedencias/GetID", "dNome=" + data.dPrecedencia1);
                                            idp1 = rp1.responseText;
                                        } else
                                            idp1 = data.dPrecedencia1;

                                        var idp2;
                                        if (isNaN(data.dPrecedencia2)) {
                                            var rp2 = webix.ajax().sync().post(BASE_URL + "cDisciplinas_Precedencias/GetID", "dNome=" + data.dPrecedencia2);
                                            idp2 = rp2.responseText;
                                        } else
                                            idp2 = data.dPrecedencia2;

                                        var idp3;
                                        if (isNaN(data.dPrecedencia3)) {
                                            var rp3 = webix.ajax().sync().post(BASE_URL + "cDisciplinas_Precedencias/GetID", "dNome=" + data.dPrecedencia3);
                                            idp3 = rp3.responseText;
                                        } else
                                            idp3 = data.dPrecedencia3;

                                        var envio = "id=" + id +
                                            "&dNome=" + data.dNome +
                                            "&dCodigo=" + data.dCodigo +
                                            "&dPrecedencia1=" + idp1 +
                                            "&dPrecedencia2=" + idp2 +
                                            "&dPrecedencia3=" + idp3;
                                        var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas_Precedencias/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdDisciplinas_Precedencias").clearAll();
                                            $$("idDTEdDisciplinas_Precedencias").load(BASE_URL + "cDisciplinas_Precedencias/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdDisciplinas_Precedencias").clearAll();
                                        $$("idDTEdDisciplinas_Precedencias").load(BASE_URL + "cDisciplinas_Precedencias/read");
                                    }

                                }

                            },
                            */
                            url: BASE_URL + "cDisciplinas_Precedencias/read",
                            pager: "pagerDisciplinas_Precedencias"
                        }, {
                            view: "pager", id: "pagerDisciplinas_Precedencias",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Disciplinas
var formADDDisciplinas = {
    view: "form",
    id: "idformADDDisciplinas",
    borderless: true,
    elements: [
        {
            cols: [{
                rows: [
                    {
                        view: "combo", //width: 200,
                        label: 'N&iacute;vel', name: "nNome",
                        options: {
                            body: {
                                template: "#nNome#",
                                yCount: 7,
                                url: BASE_URL + "CNiveis/read"
                            }
                        }
                    },
                    {
                        view: "combo", //width: 200,
                        label: 'Per&iacute;odo', name: "pNome",
                        options: {
                            body: {
                                template: "#pNome#",
                                yCount: 7,
                                url: BASE_URL + "CPeriodos/read"
                            }
                        }
                    },

                    { view: "text", label: 'C&oacute;digo', name: "dCodigo", validate: "isNotEmpty", validateEvent: "blur" },

                    {
                        view: "combo", //width: 200,
                        label: 'Dura&ccedil;&atilde;o', name: "ddNome",
                        options: {
                            body: {
                                template: "#ddNome#",
                                yCount: 7,
                                url: BASE_URL + "CDisciplinas_Duracao/read"
                            }
                        },
                        on: {
                            'onChange': function (newv, oldv) {
                                //alert(newv);
                                if (newv == "1") {
                                    $$('idComboSemestre10').disable();
                                    $$('idComboAC').enable();
                                } else if (newv == "2") {
                                    $$('idComboSemestre10').enable();
                                    $$('idComboAC').enable();
                                } else {
                                    $$('idComboSemestre10').disable();
                                    $$('idComboAC').disable();
                                }
                            }
                        }
                    },
                    {
                        view: "combo", /*width: 200,*/ id: "idComboSemestre10",
                        label: 'Semestre', name: "sNome",
                        options: {
                            body: {
                                template: "#sNome#",
                                yCount: 7,
                                url: BASE_URL + "CSemestres/read"
                            }
                        },
                    },
                    {
                        view: "combo", /*width: 200,*/ //id: "idComboDisciploinasGeracao",
                        label: 'Geração', name: "dgnome",
                        options: {
                            body: {
                                template: "#dgnome#",
                                yCount: 7,
                                url: BASE_URL + "cDisciplinas_Geracao/read"
                            }
                        },
                    },
                    { view: "counter", label: "Nota M&iacute;nima", name: "dNotaMinima" },
                    { view: "counter", label: "Quantidade Horas", name: "dQuantidadesHoras" },

                ]
            },
                {
                    rows: [
                        {
                            view: "combo", //width: 250,
                            label: 'Curso', name: "cNome",
                            options: {
                                body: {
                                    template: "#cNome#",
                                    yCount: 7,
                                    url: BASE_URL + "CCursos/read"
                                }
                            }
                        },
                        { view: "text", label: 'Disciplina', name: "dNome", validate: "isNotEmpty", validateEvent: "blur" },
                        {
                            view: "combo", //width: 200,
                            label: 'Classifica&ccedil;&atilde;o', name: "clNome",
                            options: {
                                body: {
                                    template: "#clNome#",
                                    yCount: 7,
                                    url: BASE_URL + "CClassificacao/read"
                                }
                            }
                        },
                        {
                            view: "combo", /*width: 200,*/ id: "idComboAC",
                            label: 'Ano Curricular', name: "acNome",
                            options: {
                                body: {
                                    template: "#acNome#",
                                    yCount: 7,
                                    url: BASE_URL + "CAno_Curricular/read"
                                }
                            },
                            on: {
                                "onChange": function (newv, oldv) {
                                    $$("idComboSemestre1").getList().clearAll();
                                    $$("idComboSemestre1").getList().load(BASE_URL + "CAno_Curricular/dt_semestres?ac=" + this.getValue());
                                }
                            }
                        },
                        { view: "textarea", label: 'Descri&ccedil;&atilde;o', heigth: 300, name: "dDescricao" },
                        {},
                        {},
                        { view: "counter", label: "Nota M&aacute;xima", name: "dNotaMaxima" },
                        { view: "counter", label: "Cr&eacute;dito", name: "dCredito" },

                    ]
                }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var nNome = $$("idformADDDisciplinas").getValues().nNome;
                        var cNome = $$("idformADDDisciplinas").getValues().cNome;
                        var pNome = $$("idformADDDisciplinas").getValues().pNome;
                        var dNome = $$("idformADDDisciplinas").getValues().dNome;
                        var dCodigo = $$("idformADDDisciplinas").getValues().dCodigo;
                        var dDescricao = $$("idformADDDisciplinas").getValues().dDescricao;
                        var dNotaMaxima = $$("idformADDDisciplinas").getValues().dNotaMaxima;
                        var dNotaMinima = $$("idformADDDisciplinas").getValues().dNotaMinima;
                        var dQuantidadesHoras = $$("idformADDDisciplinas").getValues().dQuantidadesHoras;
                        var dCredito = $$("idformADDDisciplinas").getValues().dCredito;
                        var clNome = $$("idformADDDisciplinas").getValues().clNome;
                        var ddNome = $$("idformADDDisciplinas").getValues().ddNome;
                        var sNome = $$("idformADDDisciplinas").getValues().sNome;
                        var acNome = $$("idformADDDisciplinas").getValues().acNome;
                        var dgnome = $$("idformADDDisciplinas").getValues().dgnome;

                        if (nNome && cNome, pNome, dNome, dCodigo) {
                            var envio = "nNome=" + nNome +
                                "&cNome=" + cNome +
                                "&pNome=" + pNome +
                                "&dNome=" + dNome +
                                "&dCodigo=" + dCodigo +
                                "&dDescricao=" + dDescricao +
                                "&dNotaMaxima=" + dNotaMaxima +
                                "&dNotaMinima=" + dNotaMinima +
                                "&dQuantidadesHoras=" + dQuantidadesHoras +
                                "&dCredito=" + dCredito +
                                "&clNome=" + clNome +
                                "&ddNome=" + ddNome +
                                "&sNome=" + sNome +
                                "&acNome=" + acNome +
                                "&dgnome=" + dgnome;
                            var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdDisciplinas").load(BASE_URL + "cDisciplinas/read");
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
                        $$("idwinADDDisciplinas").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
//ADICIONAR Classificacao
var formADDClassificacao = {
    view: "form",
    id: "idformADDClassificacao",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "clNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "clCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "counter", label: "Percentagem", name: "clPercentagem" },
                { view: "textarea", label: 'Observa&ccedil;&atilde;o', heigth: 300, name: "clObservacao" },
                {
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var clNome = $$("idformADDClassificacao").getValues().clNome;
                                var clCodigo = $$("idformADDClassificacao").getValues().clCodigo;
                                var clPercentagem = $$("idformADDClassificacao").getValues().clPercentagem;
                                var clObservacao = $$("idformADDClassificacao").getValues().clObservacao;
                                if (clNome && clCodigo && clPercentagem) { //validate form
                                    var envio = "clNome=" + clNome +
                                        "&clCodigo=" + clCodigo +
                                        "&clPercentagem=" + clPercentagem +
                                        "&clObservacao=" + clObservacao;

                                    var r = webix.ajax().sync().post(BASE_URL + "cClassificacao/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdClassificacao").load(BASE_URL + "cClassificacao/read");
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
                                $$("idwinADDClassificacao").close();
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
//Adicionar Disciplinas_Duracao
var formADDDisciplinas_Duracao = {
    view: "form",
    id: "idformADDDisciplinas_Duracao",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "ddNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "ddCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                {
                    //},{
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var ddNome = $$("idformADDDisciplinas_Duracao").getValues().ddNome;
                                var ddCodigo = $$("idformADDDisciplinas_Duracao").getValues().ddCodigo;

                                if (ddNome && ddCodigo) { //validate form
                                    var envio = "ddNome=" + ddNome +
                                        "&ddCodigo=" + ddCodigo;

                                    var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas_Duracao/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdDisciplinas_Duracao").load(BASE_URL + "cDisciplinas_Duracao/read");
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
                                $$("idwinADDDisciplinas_Duracao").close();
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
//Adicionar Disciplinas_Geracao
var formADDDisciplinas_Geracao = {
    view: "form",
    id: "idformADDDisciplinas_Geracao",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "dgnome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "counter", label: "Ano Inicio", name: "dgano_inicio", value: 1990/*, width: 200*/ },
                { view: "counter", label: "Ano Fim", name: "dgano_fin", value: 1990/*, width: 200*/ },
                {
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var dgnome = $$("idformADDDisciplinas_Geracao").getValues().dgnome;
                                var dgano_inicio = $$("idformADDDisciplinas_Geracao").getValues().dgano_inicio;
                                var dgano_fin = $$("idformADDDisciplinas_Geracao").getValues().dgano_fin;

                                if (dgano_inicio <= dgano_fin) {
                                    if (dgnome && dgano_inicio && dgano_fin) { //validate form
                                        var envio = "dgnome=" + dgnome +
                                            "&dgano_inicio=" + dgano_inicio +
                                            "&dgano_fin=" + dgano_fin;

                                        var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas_Geracao/insert", envio);
                                        if (r.responseText == "true") {
                                            webix.message("Dados inseridos com sucesso");
                                            this.getTopParentView().hide(); //hide window
                                            $$("idDTEdDisciplinas_Geracao").load(BASE_URL + "cDisciplinas_Geracao/read");
                                        } else {
                                            webix.message({ type: "error", text: "Erro inserindo dados" });
                                        }
                                    }
                                    else
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                } else
                                    webix.message({ type: "error", text: "Erro no intervalo, O ano inicio tem que ser menor que ano fim" });

                            }
                        },
                        {
                            view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                $$("idwinADDDisciplinas_Geracao").close();
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
//editar
var formEDDisciplinas = {
    view: "form",
    id: "idformEDDisciplinas",
    borderless: true,
    elements: [
        {
            cols: [{
                rows: [
                    {
                        view: "combo", /*width: 200,*/ id: "id_ed_nNome",
                        label: 'N&iacute;vel', name: "nNome",
                        options: {
                            body: {
                                template: "#nNome#",
                                yCount: 7,
                                url: BASE_URL + "CNiveis/read"
                            }
                        }
                    },
                    {
                        view: "combo", /*width: 200,*/ id: "id_ed_pNome",
                        label: 'Per&iacute;odo', name: "pNome",
                        options: {
                            body: {
                                template: "#pNome#",
                                yCount: 7,
                                url: BASE_URL + "CPeriodos/read"
                            }
                        }
                    },

                    { view: "text", label: 'C&oacute;digo', name: "dCodigo", id: "id_ed_dCodigo", validate: "isNotEmpty", validateEvent: "blur" },

                    {
                        view: "combo", /*width: 200,*/ id: "id_ed_ddNome",
                        label: 'Dura&ccedil;&atilde;o', name: "ddNome",
                        options: {
                            body: {
                                template: "#ddNome#",
                                yCount: 7,
                                url: BASE_URL + "CDisciplinas_Duracao/read"
                            }
                        },
                        on: {
                            'onChange': function (newv, oldv) {
                                //alert(newv);
                                if (newv == "1") {
                                    $$('idComboSemestre').disable();
                                    $$('idComboAC').enable();
                                } else if (newv == "2") {
                                    $$('idComboSemestre').enable();
                                    $$('idComboAC').enable();
                                } else {
                                    $$('idComboSemestre').disable();
                                    $$('idComboAC').disable();
                                }
                            }
                        }
                    },
                    {
                        view: "combo", /*width: 200,*/ id: "idComboSemestre",
                        label: 'Semestre', name: "sNome",
                        options: {
                            body: {
                                template: "#sNome#",
                                yCount: 7,
                                url: BASE_URL + "CSemestres/read"
                            }
                        },
                    },
                    { view: "counter", label: "Nota M&iacute;nima", name: "dNotaMinima", id: "id_ed_dNotaMinima" },
                    { view: "counter", label: "Quantidade Horas", name: "dQuantidadesHoras", id: "id_ed_dQuantidadesHoras" },
                    //Activar / desactivar disciplinas
                    { view: "checkbox", label: "Activa", labelWidth: 80, name: "dEstado", uncheckValue: "off", checkValue: "on", id: "id_ed_activa" },
                ]
            },
                {
                    rows: [
                        {
                            view: "combo", /*width: 250,*/ id: "id_ed_cNome",
                            label: 'Curso', name: "cNome",
                            options: {
                                body: {
                                    template: "#cNome#",
                                    yCount: 7,
                                    url: BASE_URL + "CCursos/read"
                                }
                            }
                        },
                        { view: "text", label: 'Disciplina', name: "dNome", id: "id_ed_dNome", validate: "isNotEmpty", validateEvent: "blur" },
                        {
                            view: "combo", /*width: 200,*/ id: "id_ed_clNome",
                            label: 'Classifica&ccedil;&atilde;o', name: "clNome",
                            options: {
                                body: {
                                    template: "#clNome#",
                                    yCount: 7,
                                    url: BASE_URL + "CClassificacao/read"
                                }
                            }
                        },
                        {
                            view: "combo", /*width: 200,*/ id: "idComboAC",
                            label: 'Ano Curricular', name: "acNome",
                            options: {
                                body: {
                                    template: "#acNome#",
                                    yCount: 7,
                                    url: BASE_URL + "CAno_Curricular/read"
                                }
                            },
                            on: {
                                "onChange": function (newv, oldv) {
                                    $$("idComboSemestre").getList().clearAll();
                                    $$("idComboSemestre").getList().load(BASE_URL + "CAno_Curricular/dt_semestres?ac=" + this.getValue());
                                }
                            }

                        },
                        { view: "textarea", label: 'Descri&ccedil;&atilde;o', id: "id_ed_dDescricao", heigth: 300, name: "dDescricao" },
                        { view: "counter", label: "Nota M&aacute;xima", name: "dNotaMaxima", id: "id_ed_dNotaMaxima" },
                        { view: "counter", label: "Cr&eacute;dito", name: "dCredito", id: "id_ed_dCredito" },

                        { view: "text", label: 'idd', name: "did", id: "id_ed_d", hidden: true },
                        //{},
                        {
                            view: "combo", /*width: 200,*/ id: "idComboDisciploinasGeracao",
                            label: 'Geração', name: "dgnome",
                            options: {
                                body: {
                                    template: "#dgnome#",
                                    yCount: 7,
                                    url: BASE_URL + "cDisciplinas_Geracao/read"
                                }
                            },
                        },
                    ]
                }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var idd = $$("idformEDDisciplinas").getValues().did;
                        var nNome = $$("idformEDDisciplinas").getValues().nNome;
                        var cNome = $$("idformEDDisciplinas").getValues().cNome;
                        var pNome = $$("idformEDDisciplinas").getValues().pNome;
                        var dNome = $$("idformEDDisciplinas").getValues().dNome;
                        var dCodigo = $$("idformEDDisciplinas").getValues().dCodigo;
                        var dDescricao = $$("idformEDDisciplinas").getValues().dDescricao;
                        var dNotaMaxima = $$("idformEDDisciplinas").getValues().dNotaMaxima;
                        var dNotaMinima = $$("idformEDDisciplinas").getValues().dNotaMinima;
                        var dQuantidadesHoras = $$("idformEDDisciplinas").getValues().dQuantidadesHoras;
                        var dCredito = $$("idformEDDisciplinas").getValues().dCredito;
                        var clNome = $$("idformEDDisciplinas").getValues().clNome;
                        var ddNome = $$("idformEDDisciplinas").getValues().ddNome;
                        var sNome = $$("idformEDDisciplinas").getValues().sNome;
                        var acNome = $$("idformEDDisciplinas").getValues().acNome;

                        var dEstado = $$("idformEDDisciplinas").getValues().dEstado;
                        var dgnome = $$("idformEDDisciplinas").getValues().dgnome;

                        if (nNome && cNome && pNome && dNome && dCodigo && dNotaMaxima && dNotaMinima && dQuantidadesHoras &&
                            dCredito && clNome && ddNome && sNome && acNome) {
                            var envio = "id=" + idd +
                                "&nNome=" + nNome +
                                "&cNome=" + cNome +
                                "&pNome=" + pNome +
                                "&dNome=" + dNome +
                                "&dCodigo=" + dCodigo +
                                "&dDescricao=" + dDescricao +
                                "&dNotaMaxima=" + dNotaMaxima +
                                "&dNotaMinima=" + dNotaMinima +
                                "&dQuantidadesHoras=" + dQuantidadesHoras +
                                "&dCredito=" + dCredito +
                                "&clNome=" + clNome +
                                "&ddNome=" + ddNome +
                                "&sNome=" + sNome +
                                "&acNome=" + acNome +
                                "&dEstado=" + dEstado +
                                "&dgnome=" + dgnome;
                            var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas/update", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdDisciplinas").clearAll();
                                $$("idDTEdDisciplinas").load(BASE_URL + "cDisciplinas/read");
                            } else {
                                webix.message({ type: "error", text: "Erro ao actualizar dados" });
                            }
                        }
                        else
                            webix.message({ type: "error", text: "Erro validando dados" });
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("id_win_disciplinas_ed").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

//editar Precedencias
var formEDPrecedencias = {
    view: "form",
    id: "idformEDPrecedencias",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "combo", /*width: 200,*/ id: "id_edp_ac",
                    label: 'Ano Curricular', name: "acNome",
                    options: {
                        body: {
                            template: "#acNome#",
                            yCount: 7,
                            url: BASE_URL + "CAno_Curricular/read"
                        }
                    },
                    on: {
                        'onChange': function (newv, oldv) {
                            $$('id_edp_p1').enable();
                            //actualizar combo siguiente
                            var idSelecionado = $$("idDTEdDisciplinas_Precedencias").getSelectedId(false, true);
                            var record = $$("idDTEdDisciplinas_Precedencias").getItem(idSelecionado);
                            var n = record.nid;
                            var c = record.cid;
                            var p = record.pid;
                            //var acid = record.acId;

                            $$("id_edp_p1").getList().clearAll();
                            $$("id_edp_p1").getList().load(BASE_URL + "CDisciplinas_Precedencias/readP1?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + $$('id_edp_ac').getValue());
                        }
                    }
                },
                {
                    view: "richselect", /*width: 200,*/disabled: true, id: "id_edp_p1",
                    label: 'Precedencia 1', name: "dPrecedencia1",
                    options: {
                        body: {
                            template: "#dPrecedencia1#",
                            yCount: 7,
                            url: BASE_URL + "CDisciplinas_Precedencias/readP1"
                        }
                    },
                    on: {
                        'onChange': function (newv, oldv) {
                            $$('id_edp_p2').enable();
                            var idSelecionado = $$("idDTEdDisciplinas_Precedencias").getSelectedId(false, true);
                            var record = $$("idDTEdDisciplinas_Precedencias").getItem(idSelecionado);
                            var n = record.nid;
                            var c = record.cid;
                            var p = record.pid;
                            //var acid = record.acId;

                            $$("id_edp_p2").getList().clearAll();
                            $$("id_edp_p2").getList().load(BASE_URL + "CDisciplinas_Precedencias/readP2?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + $$('id_edp_ac').getValue());
                        }
                    }
                },
                {
                    view: "richselect", /*width: 200,*/ disabled: true, id: "id_edp_p2",
                    label: 'Precedencia 2', name: "dPrecedencia2",
                    options: {
                        body: {
                            template: "#dPrecedencia2#",
                            yCount: 7,
                            url: BASE_URL + "CDisciplinas_Precedencias/readP2"
                        }
                    },
                    on: {
                        'onChange': function (newv, oldv) {
                            $$('id_edp_p3').enable();
                            var idSelecionado = $$("idDTEdDisciplinas_Precedencias").getSelectedId(false, true);
                            var record = $$("idDTEdDisciplinas_Precedencias").getItem(idSelecionado);
                            var n = record.nid;
                            var c = record.cid;
                            var p = record.pid;
                            //var acid = record.acId;

                            $$("id_edp_p3").getList().clearAll();
                            $$("id_edp_p3").getList().load(BASE_URL + "CDisciplinas_Precedencias/readP3?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + $$('id_edp_ac').getValue());
                        }
                    }
                },
                {
                    view: "richselect", /*width: 200,*/disabled: true, id: "id_edp_p3",
                    label: 'Precedencia 3', name: "dPrecedencia3",
                    options: {
                        body: {
                            template: "#dPrecedencia3#",
                            yCount: 7,
                            url: BASE_URL + "CDisciplinas_Precedencias/readP3"
                        }
                    }
                },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var idd = $$("idDTEdDisciplinas_Precedencias").getSelectedId(false, true);
                        var p1 = $$("idformEDPrecedencias").getValues().dPrecedencia1;
                        var p2 = $$("idformEDPrecedencias").getValues().dPrecedencia2;
                        var p3 = $$("idformEDPrecedencias").getValues().dPrecedencia3;

                        if (idd && p1 && p2 && p3) {
                            var envio = "id=" + idd +
                                "&dPrecedencia1=" + p1 +
                                "&dPrecedencia2=" + p2 +
                                "&dPrecedencia3=" + p3;
                            var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas_Precedencias/update", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados actualizados com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdDisciplinas_Precedencias").clearAll();
                                $$("idDTEdDisciplinas_Precedencias").load(BASE_URL + "cDisciplinas_Precedencias/read");
                            } else {
                                webix.message({ type: "error", text: "Erro ao actualizar dados" });
                            }
                        }
                        else
                            webix.message({ type: "error", text: "Erro validando dados" });
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("id_win_precedencias_ed").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};