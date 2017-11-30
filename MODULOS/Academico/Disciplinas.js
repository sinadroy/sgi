var nNomePD = '';
var cNomePD = '';
var pNomePD = '';
var acNomePD = '';
function cargarVistaDisciplinas(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Disciplinas", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            /*
                            {   view:"button", type:"form",disabled:true, value:"Adicionar", width:100, click:function(){
                                    webix.ui({
                                        view:"window",
                                        id:"idwinADDDisciplinas",
                                        width:600,
                                        position:"center",
                                        modal:true,
                                        head:"Dados da Disciplina",
                                        body:webix.copy(formADDDisciplinas)
                                    }).show();
                                }
                            },
                            {   view:"button", type:"danger",disabled:true, value:"Apagar", width:100, click:function(){
                                    var idSelecionado = $$("idDTEdDisciplinas").getSelectedId(false,true);
                                    if(idSelecionado){
                                        webix.confirm({
                                            title:"Confirmação",
                                            type:"confirm-warning",
                                            ok:"Sim", cancel:"Nao",
                                            text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback:function(result){
                                                if(result){
                                                    var idrowDT = $$("idDTEdDisciplinas").getSelectedId(false,true);
                                                    var envio = "id="+idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL+"cDisciplinas/delete", envio);
                                                    if(r.responseText == "true"){
                                                        $$("idDTEdDisciplinas").clearAll();
                                                        $$("idDTEdDisciplinas").load(BASE_URL+"cDisciplinas/read");
                                                        webix.message("Os dados foram apagados com sucesso");
                                                    }else{    
                                                        webix.message({ type:"error", text:"Erro apagando dados" });
                                                    }
                                                }
                                            }
                                        }); 
                                    }else{    
                                        webix.message({ type:"error", text:"Erro apagando dados" });
                                    }
                                    
                                    }
                                    
                            }, */
                            {
                                view: "button", type: "form", value: "Imprimir", id: "idbtnimp", disabled: true, width: 120, /*height: 50,*/ click: function () {
                                    //criar PDF
                                    //var idSelecionado = $$("idDTEdDisciplinas").get;
                                    // if(idSelecionado){
                                    //var envio = "id="+idSelecionado;
                                    var r = webix.ajax().sync().post(BASE_URL + "CDisciplinas_IMP/imprimir", "imp=1");
                                    if (r.responseText == "true") {
                                        webix.message("PDF criado com sucesso");
                                        //Carregar PDF
                                        webix.ui({
                                            view: "window",
                                            id: "idWinPDFDisciplinas_Professores",
                                            height: 600,
                                            width: 950,
                                            left: 50, top: 50,
                                            move: true,
                                            modal: true,
                                            //head:"This window can be moved",
                                            head: {
                                                view: "toolbar", cols: [
                                                    { view: "label", label: "Imprimir" },
                                                    { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFDisciplinas_Professores').close();" }
                                                ]
                                            },
                                            body: {
                                                //template:"Some text"
                                                template: '<div id="idPDFDisciplinas_Professores" style="width:940px;  height:590px"></div>'
                                            }
                                        }).show();
                                        PDFObject.embed("../../relatorios/Disciplinas_Professores.pdf", "#idPDFDisciplinas_Professores");


                                    } else {
                                        webix.message({ type: "error", text: "Erro ao imprimir dados" });
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
                                { id: "id", header: "", css: "rank", width: 50, sort: "int" },
                                {
                                    id: "dEstado", header: "Estado", width: 90, sort: "string",
                                    template: function (obj) {
                                        if (obj.dEstado == "off")
                                            return "<span style='color:red;'>" + obj.dEstado + "</span>";
                                        else
                                            return "<span style='color:green;'>" + obj.dEstado + "</span>";

                                    },
                                },
                                { id: "nNome", header: ["N&iacute;vel", { content: "selectFilter" }], width: 150, sort: "string" },
                                { id: "cNome", header: ["Curso", { content: "selectFilter" }], width: 150, sort: "string" },
                                { id: "pNome", header: ["Per&iacute;odo", { content: "selectFilter" }], width: 150, sort: "string" },
                                { id: "acNome", header: ["Ano Curricular", { content: "selectFilter" }], width: 150, sort: "string" },
                                { id: "sNome", header: ["Semestre", { content: "selectFilter" }], width: 150 },
                                { id: "dNome", editor: "text", header: ["Disciplina", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "dCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "dgnome", editor: "text", header: ["Gera&ccedil;&atilde;o", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "dNotaMaxima", editor: "text", header: "Nota M&aacute;xima", width: 120, sort: "int" },
                                { id: "dNotaMinima", editor: "text", header: "Nota M&iacute;nima", width: 120, sort: "int" },
                                { id: "dQuantidadesHoras", editor: "text", header: "Quantidade Horas", width: 150, sort: "int" },
                                { id: "dCredito", editor: "text", header: "Cr&eacute;dito", width: 100, sort: "int" },
                                { id: "clNome", editor: "richselect", header: "Classifica&ccedil;&atilde;o", width: 150, template: "#clNome#", options: BASE_URL + "CClassificacao/read" },
                                { id: "ddNome", editor: "richselect", header: "Dura&ccedil;&atilde;o", width: 150, template: "#ddNome#", options: BASE_URL + "CDisciplinas_Duracao/read" },

                                { id: "dDescricao", editor: "text", header: "Descri&ccedil;&atilde;o", width: 200, sort: "string" },
                            ],
                            resizeColumn: true,
                            on: {
                                "onDataUpdate": function (id, data) {

                                    if (id && data.nNome && data.cNome && data.pNome && data.dNome && data.dCodigo && data.dNotaMaxima && data.dNotaMinima && data.dQuantidadesHoras && data.clNome && data.ddNome) {
                                        var idcl;
                                        if (isNaN(data.clNome)) {
                                            var rcl = webix.ajax().sync().post(BASE_URL + "cClassificacao/GetID", "clNome=" + data.clNome);
                                            idcl = rcl.responseText;
                                        } else {
                                            idcl = data.clNome;
                                        }
                                        var iddd;
                                        if (isNaN(data.ddNome)) {
                                            var rdd = webix.ajax().sync().post(BASE_URL + "CDisciplinas_Duracao/GetID", "ddNome=" + data.ddNome);
                                            iddd = rdd.responseText;
                                        } else {
                                            iddd = data.ddNome;
                                        }
                                        var envio = "id=" + id +
                                            "&nNome=" + data.nNome +
                                            "&cNome=" + data.cNome +
                                            "&pNome=" + data.pNome +
                                            "&dNome=" + data.dNome +
                                            "&dCodigo=" + data.dCodigo +
                                            "&dDescricao=" + data.dDescricao +
                                            "&dNotaMaxima=" + data.dNotaMaxima +
                                            "&dNotaMinima=" + data.dNotaMinima +
                                            "&dQuantidadesHoras=" + data.dQuantidadesHoras +
                                            "&dCredito=" + data.dCredito +
                                            "&clNome=" + idcl +
                                            "&ddNome=" + iddd;
                                        var r = webix.ajax().sync().post(BASE_URL + "cDisciplinas/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdDisciplinas").clearAll();
                                            $$("idDTEdDisciplinas").load(BASE_URL + "cDisciplinas/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdDisciplinas").clearAll();
                                        $$("idDTEdDisciplinas").load(BASE_URL + "cDisciplinas/read");
                                    }
                                }
                            },
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
                                view: "button", type: "form", disabled: true, value: "Adicionar", width: 100, click: function () {
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
                                view: "button", type: "danger", disabled: true, value: "Apagar", width: 100, click: function () {
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

                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdClassificacao",
                            select: true,
                            editable: false,
                            columns: [
                                { id: "id", header: "", css: "rank", width: 30, sort: "int" },
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
                            size: 25,
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
                                view: "button", type: "form", disabled: true, value: "Adicionar", width: 100, click: function () {
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
                                view: "button", type: "danger", disabled: true, value: "Apagar", width: 100, click: function () {
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

                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdDisciplinas_Duracao",
                            select: true,
                            editable: false,
                            columns: [
                                { id: "id", header: "", css: "rank", width: 30, sort: "int" },
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
                            size: 25,
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
                                view: "button", type: "form", value: "Adicionar", width: 100, disabled: true, click: function () {
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
                                view: "button", type: "danger", value: "Apagar", width: 100, disabled: true, click: function () {
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
                            editable: false,
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
                            size: 25,
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
                                view: "button", type: "form", value: "Editar", width: 120, /*height: 50,*/ click: function () {
                                    var idSelecionado = $$("idDTEdDisciplinas_Precedencias").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.ui({
                                            view: "window",
                                            id: "id_win_precedencias_ed",
                                            width: 400,
                                            position: "center",
                                            modal: true,
                                            head: "Editar Dados",
                                            body: webix.copy(formEDPrecedenciasAca)
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
                                { id: "acNome", header: ["Ano Curricular", { content: "textFilter" }], width: 130, sort: "string" },
                                { id: "dNome", header: ["Disciplina", { content: "selectFilter" }], width: 170, sort: "string" },
                                { id: "dCodigo", header: ["C&oacute;digo", { content: "textFilter" }], width: 150, sort: "string" },
                                { id: "dgnome", editor: "text", header: ["Gera&ccedil;&atilde;o", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "dPrecedencia1", editor: "richselect", header: "Precedencia1", width: 150, template: "#dPrecedencia1#", options: BASE_URL + "CDisciplinas_Precedencias/readP1" },
                                { id: "dgnome_p1", header: "Geração P1", width: 170, sort: "string" },
                                { id: "dPrecedencia2", editor: "richselect", header: "Precedencia2", width: 150, template: "#dPrecedencia2#", options: BASE_URL + "CDisciplinas_Precedencias/readP2" },
                                { id: "dgnome_p2", header: "Geração P2", width: 170, sort: "string" },
                                { id: "dPrecedencia3", editor: "richselect", header: "Precedencia3", width: 150, template: "#dPrecedencia3#", options: BASE_URL + "CDisciplinas_Precedencias/readP2" },
                                { id: "dgnome_p3", header: "Geração P3", width: 170, sort: "string" },
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
                            size: 25,
                            group: 10
                        }]
                }
            },
            {
                header: "Professores", body: {
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDProfessores_Disciplinas",
                                        width: 700,
                                        position: "center",
                                        modal: true,
                                        head: "Professores por Disciplinas",
                                        body: webix.copy(formADDProfessores_Disciplinas)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger",/*disabled:true,*/ value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdProfessores_Disciplinas").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var envio = "id=" + idSelecionado;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cProfessores_Disciplinas/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdProfessores_Disciplinas").clearAll();
                                                        $$("idDTEdProfessores_Disciplinas").load(BASE_URL + "cProfessores_Disciplinas/read");
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

                            },
                            {
                                view: "button", type: "form", value: "Imprimir", id: "idbtnPDimp", disabled: true, width: 120, /*height: 50,*/ click: function () {
                                    //criar PDF
                                    //var idSelecionado = $$("idDTEdDisciplinas").get;
                                    // if(idSelecionado){
                                    var nivel = $$("idDTEdProfessores_Disciplinas").getFilter("nNome").value;
                                    var curso = $$("idDTEdProfessores_Disciplinas").getFilter("cNome").value;
                                    var periodo = $$("idDTEdProfessores_Disciplinas").getFilter("pNome").value;
                                    var alectivo = $$("idDTEdProfessores_Disciplinas").getFilter("acNome").value;
                                    var envio = "nNome=" + nivel + "&cNome=" + curso + "&pNome=" + periodo + "&acNome=" + alectivo;
                                    var r = webix.ajax().sync().post(BASE_URL + "CProfessores_Disciplinas_IMP/imprimir", envio);
                                    if (r.responseText == "true") {
                                        webix.message("PDF criado com sucesso");
                                        //Carregar PDF
                                        webix.ui({
                                            view: "window",
                                            id: "idWinPDFProfessores_Disciplinas",
                                            height: 600,
                                            width: 950,
                                            left: 50, top: 50,
                                            move: true,
                                            modal: true,
                                            //head:"This window can be moved",
                                            head: {
                                                view: "toolbar", cols: [
                                                    { view: "label", label: "Imprimir" },
                                                    { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFProfessores_Disciplinas').close();" }
                                                ]
                                            },
                                            body: {
                                                //template:"Some text"
                                                template: '<div id="idPDFProfessores_Disciplinas" style="width:940px;  height:590px"></div>'
                                            }
                                        }).show();
                                        PDFObject.embed("../../relatorios/Professores_Disciplinas.pdf", "#idPDFProfessores_Disciplinas");


                                    } else {
                                        webix.message({ type: "error", text: "Erro ao imprimir dados" });
                                    }
                                }
                            },
                            {
                                view: "button", type: "form", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdProfessores_Disciplinas").clearAll();
                                    $$("idDTEdProfessores_Disciplinas").load(BASE_URL + "cProfessores_Disciplinas/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdProfessores_Disciplinas",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", header: "", css: "rank", width: 50, sort: "int" },
                                { id: "disciplinas_id", hidden: true, header: "disciplinas_id", css: "rank", width: 30, sort: "int" },
                                { id: "anos_lectivos_id", hidden: true, header: "anos_lectivos_id", css: "rank", width: 30, sort: "int" },
                                { id: "alAno", header: ["Ano Lec.", { content: "textFilter" }], width: 80, validate: "isNotEmpty", validateEvent: "blur", sort: "int" },

                                { id: "nNome", header: ["N&iacute;vel", { content: "selectFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                { id: "cNome", header: ["Curso", { content: "selectFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                { id: "pNome", header: ["Per&iacute;odo", { content: "selectFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                { id: "acNome", header: ["Ano Curricular", { content: "selectFilter" }], width: 150, sort: "string" },
                                { id: "sNome", header: ["Semestre", { content: "selectFilter" }], width: 75, sort: "string" },
                                { id: "tNome", header: ["Turma", { content: "selectFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                { id: "dNome", header: ["Disciplina", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                { id: "dCodigo", header: "C&oacute;digo", width: 90, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                { id: "ProfessorP", editor: "combo", header: "Prof. Principal", width: 150, template: "#ProfessorP#", options: BASE_URL + "CProfessores_Disciplinas/readPP" },
                                { id: "ProfessorA1", editor: "combo", header: "Prof. Assistente1", width: 150, template: "#ProfessorA1#", options: BASE_URL + "CProfessores_Disciplinas/readPA1" },
                                { id: "ProfessorA2", editor: "combo", header: "Prof. Assistente2", width: 150, template: "#ProfessorA2#", options: BASE_URL + "CProfessores_Disciplinas/readPA2" },
                            ],
                            resizeColumn: true,
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    if (id && data.dNome && data.dCodigo) {

                                        var idpp;
                                        if (isNaN(data.ProfessorP)) {
                                            var rpp = webix.ajax().sync().post(BASE_URL + "cProfessores_Disciplinas/GetID", "nome=" + data.ProfessorP);
                                            idpp = rpp.responseText;
                                        } else
                                            idpp = data.ProfessorP;

                                        var idpa1;
                                        if (isNaN(data.ProfessorA1)) {
                                            var rpa1 = webix.ajax().sync().post(BASE_URL + "cProfessores_Disciplinas/GetID", "nome=" + data.ProfessorA1);
                                            idpa1 = rpa1.responseText;
                                        } else
                                            idpa1 = data.ProfessorA1;

                                        var idpa2;
                                        if (isNaN(data.ProfessorA2)) {
                                            var rpa2 = webix.ajax().sync().post(BASE_URL + "cProfessores_Disciplinas/GetID", "nome=" + data.ProfessorA2);
                                            idpa2 = rpa2.responseText;
                                        } else
                                            idpa2 = data.ProfessorA2;

                                        var envio = "id=" + id +
                                            "&dNome=" + data.disciplinas_id +
                                            "&tNome=" + data.tNome +
                                            "&ProfessorP=" + idpp +
                                            "&ProfessorA1=" + idpa1 +
                                            "&ProfessorA2=" + idpa2 +
                                            "&alAno=" + data.anos_lectivos_id;
                                        var r = webix.ajax().sync().post(BASE_URL + "cProfessores_Disciplinas/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdProfessores_Disciplinas").clearAll();
                                            $$("idDTEdProfessores_Disciplinas").load(BASE_URL + "cProfessores_Disciplinas/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdProfessores_Disciplinas").clearAll();
                                        $$("idDTEdProfessores_Disciplinas").load(BASE_URL + "cProfessores_Disciplinas/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cProfessores_Disciplinas/read",
                            pager: "pagerProfessores_Disciplinas"
                        }, {
                            view: "pager", id: "pagerProfessores_Disciplinas",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
    //eventos
    //capturar filtros OKOKOKOK
    $$("idDTEdDisciplinas").attachEvent("onAfterFilter", function () {
        var nNome = this.getFilter("nNome").value;
        var cNome = this.getFilter("cNome").value;
        var pNome = this.getFilter("pNome").value;
        var acNome = this.getFilter("acNome").value;
        if (nNome !== "" && cNome !== "" && pNome !== "" && acNome !== "") {
            $$("idbtnimp").enable();
        } else
            $$("idbtnimp").disable();
        //webix.message(dNome);
    });
    //activar imprimir de Professores_Disciplinas
    $$("idDTEdProfessores_Disciplinas").attachEvent("onAfterFilter", function () {
        var nNomePD = this.getFilter("nNome").value; //$$("idDTEdProfessores_Disciplinas").getFilter("nNome").value;
        var cNomePD = this.getFilter("cNome").value;
        var pNomePD = this.getFilter("pNome").value;
        var acNomePD = this.getFilter("acNome").value;
        if (nNomePD !== "" && cNomePD !== "" && pNomePD !== "" && acNomePD !== "") {
            $$("idbtnPDimp").enable();
        } else
            $$("idbtnPDimp").disable();
        //webix.message(dNome);
    });
}
//Adicionar Professores_Disciplinas
var formADDProfessores_Disciplinas = {
    view: "form",
    id: "idformADDProfessores_Disciplinas",
    borderless: true,
    elements: [
        {
            cols: [{
                rows: [
                    {
                        view: "richselect",  id: "id_cb_alAno_pd",
                        label: 'Ano Lec.', name: "alAno",
                        labelPosition: "top",
                        options: {
                            body: {
                                template: "#alAno#",
                                yCount: 7,
                                url: BASE_URL + "CAnos_Lectivos/read"
                            }
                        },
                    },

                    {
                        view: "combo",  id: "id_cb_cNome_pd",
                        label: 'Curso', name: "cNome",
                        options: {
                            body: {
                                template: "#cNome#",
                                yCount: 7,
                                url: BASE_URL + "CCursos/read"
                            }
                        },
                        on: {
                            "onChange": function (newv, oldv) {

                                var n = $$("id_cb_nNome_pd").getValue();
                                var c = $$("id_cb_cNome_pd").getValue();
                                var p = $$("id_cb_pNome_pd").getValue();
                                var ac = $$("id_cb_acNome_pd").getValue();

                                if (n && c && p && ac) {
                                    $$("id_cb_dNome_pd").getList().clearAll();
                                    $$("id_cb_dNome_pd").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac);

                                    $$("id_cb_tNome_pd").getList().clearAll();
                                    $$("id_cb_tNome_pd").getList().load(BASE_URL + "cTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);

                                }
                            }
                        }
                    },
                    {
                        view: "combo", /*width: 200,*/ id: "id_cb_acNome_pd",
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

                                var n = $$("id_cb_nNome_pd").getValue();
                                var c = $$("id_cb_cNome_pd").getValue();
                                var p = $$("id_cb_pNome_pd").getValue();
                                var ac = $$("id_cb_acNome_pd").getValue();

                                if (n && c && p && ac) {
                                    $$("id_cb_dNome_pd").getList().clearAll();
                                    $$("id_cb_dNome_pd").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac);

                                    $$("id_cb_tNome_pd").getList().clearAll();
                                    $$("id_cb_tNome_pd").getList().load(BASE_URL + "cTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                }
                            }
                        }
                    },
                    {
                        view: "combo",  id: "id_cb_ProfessorP_pd",
                        label: 'Professor Principal', name: "ProfessorP",
                        options: {
                            body: {
                                template: "#ProfessorP#",
                                yCount: 7,
                                url: BASE_URL + "CProfessores_Disciplinas/readPP"
                            }
                        }
                    },
                    {
                        view: "combo",  id: "id_cb_ProfessorA2_pd",
                        label: 'Prof. Assistente 2', name: "ProfessorA2",
                        options: {
                            body: {
                                template: "#ProfessorA2#",
                                yCount: 7,
                                url: BASE_URL + "CProfessores_Disciplinas/readPA2"
                            }
                        }
                    },

                ]
            },
                {
                    rows: [
                        {
                            view: "combo",  id: "id_cb_nNome_pd",
                            label: 'N&iacute;vel', name: "nNome",
                            options: {
                                body: {
                                    template: "#nNome#",
                                    yCount: 7,
                                    url: BASE_URL + "CNiveis/read"
                                }
                            },
                            on: {
                                "onChange": function (newv, oldv) {

                                    var n = $$("id_cb_nNome_pd").getValue();
                                    var c = $$("id_cb_cNome_pd").getValue();
                                    var p = $$("id_cb_pNome_pd").getValue();
                                    var ac = $$("id_cb_acNome_pd").getValue();

                                    if (n) {
                                        $$("id_cb_cNome_pd").getList().clearAll();
                                        $$("id_cb_cNome_pd").getList().load(BASE_URL + "Ccursos/readXn?nNome=" + this.getValue());
                                    }

                                    if (n && c && p && ac) {
                                        $$("id_cb_dNome_pd").getList().clearAll();
                                        $$("id_cb_dNome_pd").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac);

                                        $$("id_cb_tNome_pd").getList().clearAll();
                                        $$("id_cb_tNome_pd").getList().load(BASE_URL + "cTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                    }
                                }
                            }
                        },
                        {
                            view: "combo", id: "id_cb_pNome_pd",
                            label: 'Per&iacute;odo', name: "pNome",
                            options: {
                                body: {
                                    template: "#pNome#",
                                    yCount: 7,
                                    url: BASE_URL + "CPeriodos/read"
                                }
                            },
                            on: {
                                "onChange": function (newv, oldv) {

                                    var n = $$("id_cb_nNome_pd").getValue();
                                    var c = $$("id_cb_cNome_pd").getValue();
                                    var p = $$("id_cb_pNome_pd").getValue();
                                    var ac = $$("id_cb_acNome_pd").getValue();

                                    if (n && c && p && ac) {
                                        $$("id_cb_dNome_pd").getList().clearAll();
                                        $$("id_cb_dNome_pd").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac);

                                        $$("id_cb_tNome_pd").getList().clearAll();
                                        $$("id_cb_tNome_pd").getList().load(BASE_URL + "cTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + ac);
                                    }
                                }
                            }
                        },

                        {
                            view: "combo", id: "id_cb_dNome_pd",
                            label: 'Disciplina', name: "dnome",
                            options: {
                                body: {
                                    template: "#dnome#",
                                    yCount: 7,
                                    url: BASE_URL + "CDisciplinas/read"
                                }
                            }
                        },
                        {
                            view: "combo", id: "id_cb_ProfessorA1_pd",
                            label: 'Prof. Assistente 1', name: "ProfessorA1",
                            options: {
                                body: {
                                    template: "#ProfessorA1#",
                                    yCount: 7,
                                    url: BASE_URL + "CProfessores_Disciplinas/readPA1"
                                }
                            }
                        },
                        {
                            view: "combo", id: "id_cb_tNome_pd",
                            label: 'Turma', name: "tNome",
                            options: {
                                body: {
                                    template: "#tNome#",
                                    yCount: 7,
                                    url: BASE_URL + "CTurmas/read"
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
                        var alAno = $$("idformADDProfessores_Disciplinas").getValues().alAno;
                        var nNome = $$("idformADDProfessores_Disciplinas").getValues().nNome;
                        var cNome = $$("idformADDProfessores_Disciplinas").getValues().cNome;
                        var pNome = $$("idformADDProfessores_Disciplinas").getValues().pNome;
                        var tNome = $$("idformADDProfessores_Disciplinas").getValues().tNome;
                        var dNome = $$("idformADDProfessores_Disciplinas").getValues().dnome;
                        var ProfessorP = $$("idformADDProfessores_Disciplinas").getValues().ProfessorP;
                        var ProfessorA1 = $$("idformADDProfessores_Disciplinas").getValues().ProfessorA1;
                        var ProfessorA2 = $$("idformADDProfessores_Disciplinas").getValues().ProfessorA2;

                        if (alAno && nNome && cNome, pNome, tNome, dNome, ProfessorP) {

                            var envio = "alAno=" + alAno +
                                "&nNome=" + nNome +
                                "&cNome=" + cNome +
                                "&pNome=" + pNome +
                                "&tNome=" + tNome +
                                "&dNome=" + dNome +
                                "&ProfessorP=" + ProfessorP +
                                "&ProfessorA1=" + ProfessorA1 +
                                "&ProfessorA2=" + ProfessorA2;
                            var r = webix.ajax().sync().post(BASE_URL + "cProfessores_Disciplinas/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdProfessores_Disciplinas").load(BASE_URL + "cProfessores_Disciplinas/read");
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
                        $$("idwinADDProfessores_Disciplinas").close();
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
var formEDPrecedenciasAca = {
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
