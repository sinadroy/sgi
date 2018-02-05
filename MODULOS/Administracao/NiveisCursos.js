function cargarVistaNiveisCursos(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar N&iacute;veis", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDNiv",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Dados do N&iacute;vel",
                                        body: webix.copy(formADDNiveis)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdNiveis").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdNiveis").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cNiveis/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdNiveis").clearAll();
                                                        $$("idDTEdNiveis").load(BASE_URL + "cNiveis/read");
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
                                    $$("idDTEdNiveis").clearAll();
                                    $$("idDTEdNiveis").load(BASE_URL + "cNiveis/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdNiveis",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "",hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "nNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "nCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 170, sort: "string" },
                                { id: "nDescricao", editor: "text", header: "Descri&ccedil;&atilde;o", width: 200, sort: "string" }
                            ],
                            resizeColumn:true,
                            rules: {
                                nNome: webix.rules.isNotEmpty,
                                nCodigo: webix.rules.isNotEmpty,
                            },
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //alert("Current value: " + data.uNome);
                                    //alert("Current value: " + id);
                                    //validar todo
                                    //if(id && data.nNome && data.nCodigo && data.nDescricao)
                                    //this.getParentView().validate()
                                    if ($$("idDTEdNiveis").validate()) {
                                        var envio = "id=" + id +
                                            "&nNome=" + data.nNome +
                                            "&nCodigo=" + data.nCodigo +
                                            "&nDescricao=" + data.nDescricao;
                                        var r = webix.ajax().sync().post(BASE_URL + "cNiveis/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdNiveis").clearAll();
                                            $$("idDTEdNiveis").load(BASE_URL + "cNiveis/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdNiveis").clearAll();
                                        $$("idDTEdNiveis").load(BASE_URL + "cNiveis/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cNiveis/read",
                            pager: "pagerNiveis"
                        }, {
                            view: "pager", id: "pagerNiveis",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            },
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Cursos", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDCursos",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Dados do Curso",
                                        body: webix.copy(formADDCursos)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdCursos").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var idrowDT = $$("idDTEdCursos").getSelectedId(false, true);
                                                    var envio = "id=" + idrowDT;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cCursos/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdCursos").clearAll();
                                                        $$("idDTEdCursos").load(BASE_URL + "cCursos/read");
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
                                    $$("idDTEdCursos").clearAll();
                                    $$("idDTEdCursos").load(BASE_URL + "cCursos/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdCursos",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "",hidden:true, css: "rank", width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 30, sort: "int" },
                                { id: "cNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 300, sort: "string" },
                                { id: "cCodigo", editor: "text", header: ["C&oacute;digo", { content: "textFilter" }], width: 100, sort: "string" },
                                { id: "cCodigoNome", editor: "text", header: ["C&oacute;d. Nome", { content: "textFilter" }], width: 100, sort: "string" },
                                { id:"cDescricao",editor:"text",header:"C&oacute;digo Num. Univ.",width:200,sort:"string"},
                                //{ id:"nNome",editor:"richselect",header:"N&iacute;vel", width:150,template:"#nNome#",options:BASE_URL+"CNiveis/read"},
                                //{ id:"ncDuracao",editor:"text",header:"Anos de Dura&ccedil;&atilde;o",width:150,sort:"int"},
                                //{ id:"ncPreco_Inscricao",editor:"text",header:"Pre&ccedil;o de Inscri&ccedil;&atilde;o",width:150,sort:"int"},
                                //{ id:"ncPreco_Matricula",editor:"text",header:"Pre&ccedil;o de Matr&iacute;cula",width:150,sort:"int"},
                                //{ id:"ncPreco_Propina",editor:"text",header:"Pre&ccedil;o de Propina",width:150,sort:"int"},
                            ],
                            resizeColumn:true,
                            rules: {
                                cNome: webix.rules.isNotEmpty,
                                cCodigo: webix.rules.isNotEmpty,
                                cCodigoNome: webix.rules.isNotEmpty,
                            },
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //alert("Current value: " + data.uNome);
                                    //alert("Current value: " + id);
                                    //validar todo
                                    if(id && data.cNome && data.cCodigo && data.cCodigoNome){
                                    //if ($$("idDTEdCursos").validate()) {
                                        //var r2 = webix.ajax().sync().post(BASE_URL+"cCursos/insert", "cCodigo="+data.cCodigo);
                                        //$idCurso = r2.responseText;
                                        var envio = "id=" + id +
                                            "&cNome=" + data.cNome +
                                            "&cCodigo=" + data.cCodigo +
                                            "&cCodigoNome=" + data.cCodigoNome +
                                            "&cDescricao=" + data.cDescricao;
                                        var r = webix.ajax().sync().post(BASE_URL + "cCursos/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdCursos").clearAll();
                                            $$("idDTEdCursos").load(BASE_URL + "cCursos/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdCursos").clearAll();
                                        $$("idDTEdCursos").load(BASE_URL + "cCursos/read");
                                    }

                                }

                            },

                            url: BASE_URL + "cCursos/read",
                            pager: "pagerCursos"
                        }, {
                            view: "pager", id: "pagerCursos",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 16,
                            group: 10
                        }]
                }
            },
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Cursos por Niveis", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDNiveisCursos",
                                        width: 500,
                                        height: 1000,
                                        position: "center",
                                        modal: true,
                                        head: "Dados do Curso",
                                        body: webix.copy(formADDNiveisCursos1)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdNiveisCursos").getSelectedId(false, true);
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
                                                    var r = webix.ajax().sync().post(BASE_URL + "cNiveisCursos/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdNiveisCursos").clearAll();
                                                        $$("idDTEdNiveisCursos").load(BASE_URL + "cNiveisCursos/read");
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

                            },{
                                view: "button", type: "standard", value: "Actualizar", width: 100, click: function () {
                                    $$("idDTEdNiveisCursos").clearAll();
                                    $$("idDTEdNiveisCursos").load(BASE_URL + "cNiveisCursos/read");
                                }
                            },
                            {}
                        ]

                    }, {
                            view: "datatable",
                            id: "idDTEdNiveisCursos",
                            select: true,
                            editable: true,
                            columns: [
                                { id: "id", /*header: "asd",*/ hidden:true},
                                { id: "ord", header: "Nº", width: 30, sort: "int" },
                                //{ id:"cNome",editor:"text", header:["Nome", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                { id: "cNome", /*editor: "richselect",*/ header: "Cursos", width: 250,/* template: "#cNome#", options: BASE_URL + "CCursos/read",*/sort:"string" },
                                //{ id:"cCodigo",editor:"text", header:["C&oacute;digo", {content:"textFilter"}],width:90, validate:webix.rules.isNotEmpty(),sort:"string"},
                                //{ id:"cDescricao",editor:"text",header:"Descri&ccedil;&atilde;o",width:200,sort:"string"},
                                { id: "nNome", /*editor: "richselect",*/ header: "N&iacute;vel", width: 150, /*template: "#nNome#", options: BASE_URL + "CNiveis/read",*/ sort:"string" },
                                { id: "pNome", /*editor: "richselect",*/ header: "Per&iacute;odo", width: 150, /*template: "#pNome#", options: BASE_URL + "CPeriodos/read" ,*/ sort:"string"},
                                { id: "ncDuracao", editor: "text", header: "Meses de Dura&ccedil;&atilde;o", width: 150, sort: "int" },
                                { id: "ncNota_Minima_EA", editor: "text", header: "Nota M&iacute;nima EA", width: 130, sort: "int" },
                                { id: "ncNota_Minima_EA2s", editor: "text", header: "Nota M&iacute;nima EA 2s", width: 150, sort: "int" },
                                { id: "ncPreco_Inscricao", editor: "text", header: "Pre&ccedil;o de Inscri&ccedil;&atilde;o", width: 150, sort: "int" },
                                { id: "ncPreco_Inscricao2s", editor: "text", header: "Pre&ccedil;o de Inscri&ccedil;&atilde;o 2s", width: 160, sort: "int" },
                                { id: "ncPreco_Matricula", editor: "text", header: "Pre&ccedil;o de Matr&iacute;cula", width: 150, sort: "int" },
                                { id: "ncPreco_Confirmacao", editor: "text", header: "Pre&ccedil;o de Conf. Mat.", width: 150, sort: "int" },
                                { id: "ncPreco_Propina", editor: "text", header: "Pre&ccedil;o de Propina", width: 150, sort: "int" },
                                { id: "depnome", editor: "richselect", header: "Departamento", width: 150, template: "#depnome#", options: BASE_URL + "CDepartamentos/read", sort: "string" }
                            ],
                            resizeColumn:true,
                            //autowidth:true,
                            rules: {
                                ncDuracao: webix.rules.isNumber,
                                ncPreco_Inscricao: webix.rules.isNumber,
                                ncPreco_Matricula: webix.rules.isNumber,
                                ncPreco_Propina: webix.rules.isNumber,
                            },
                            on: {
                                "onDataUpdate": function (id, data) {
                                    //validar todo
                                    //if(id && data.cNome && data.nNome && !isNaN(data.ncDuracao) && !isNaN(data.ncPreco_Inscricao) && !isNaN(data.ncPreco_Matricula) && !isNaN(data.ncPreco_Propina))
                                    if ($$("idDTEdNiveisCursos").validate()) {
                                        //optener el idcurso y idniveis_cursos
                                        var idNiveis;
                                        if (isNaN(data.nNome)) {
                                            var r1 = webix.ajax().sync().post(BASE_URL + "cNiveis/GetID", "nNome=" + data.nNome);
                                            idNiveis = r1.responseText;
                                        } else
                                            idNiveis = data.nNome;
                                        var idCursos;
                                        if (isNaN(data.cNome)) {
                                            var r1 = webix.ajax().sync().post(BASE_URL + "cCursos/GetID", "cNome=" + data.cNome);
                                            idCursos = r1.responseText;
                                        } else
                                            idCursos = data.cNome;
                                        var idp;
                                        if (isNaN(data.pNome)) {
                                            var rp = webix.ajax().sync().post(BASE_URL + "cPeriodos/GetID", "pNome=" + data.pNome);
                                            idp = rp.responseText;
                                        } else
                                            idp = data.pNome;
                                        
                                        var idDep;
                                        if (isNaN(data.depnome)) {
                                            var r1 = webix.ajax().sync().post(BASE_URL + "cdepartamentos/GetID", "depNome=" + data.depnome);
                                            idDep = r1.responseText;
                                        } else
                                            idDep = data.depnome;
                                        //
                                        var envio = "id=" + id +
                                            "&cursos_id=" + idCursos +
                                            "&niveis_id=" + idNiveis +//(isNaN(data.nNome))?idCurso:data.nNome+
                                            "&ncDuracao=" + data.ncDuracao +
                                            "&ncPreco_Inscricao=" + data.ncPreco_Inscricao +
                                            "&ncPreco_Inscricao2s=" + data.ncPreco_Inscricao2s +
                                            "&ncPreco_Matricula=" + data.ncPreco_Matricula +
                                            "&ncPreco_Confirmacao=" + data.ncPreco_Confirmacao +
                                            "&ncPreco_Propina=" + data.ncPreco_Propina +
                                            "&pNome=" + idp +
                                            "&ncNota_Minima_EA=" + data.ncNota_Minima_EA +
                                            "&ncNota_Minima_EA2s=" + data.ncNota_Minima_EA2s +
                                            "&departamentos_id=" + idDep;
                                        var r = webix.ajax().sync().post(BASE_URL + "cNiveisCursos/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdNiveisCursos").clearAll();
                                            $$("idDTEdNiveisCursos").load(BASE_URL + "cNiveisCursos/read");
                                            webix.message("Dados atualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdNiveisCursos").clearAll();
                                        $$("idDTEdNiveisCursos").load(BASE_URL + "cNiveisCursos/read");
                                    }

                                }

                            },
                            url: BASE_URL + "cNiveisCursos/read",
                            pager: "pagerNiveisCursos"
                        }, {
                            view: "pager", id: "pagerNiveisCursos",
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
var formADDNiveis = {
    view: "form",
    id: "idformADDNiveis",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "nNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "nCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Descri&ccedil;&atilde;o', name: "nDescricao" },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var nnome = $$("idformADDNiveis").getValues().nNome;
                        var ncodigo = $$("idformADDNiveis").getValues().nCodigo;
                        var ndescricao = $$("idformADDNiveis").getValues().ndescricao;
                        if (nnome && ncodigo) { //validate form
                            //webix.message({ type:"error", text:"Entro ok" });
                            //if($$("idformADDNiveis").validate()){    
                            var envio = "nNome=" + nnome +
                                "&nCodigo=" + ncodigo +
                                "&nDescricao=" + ndescricao;
                            var r = webix.ajax().sync().post(BASE_URL + "cNiveis/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdNiveis").load(BASE_URL + "cNiveis/read");
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
                        $$("idwinADDNiv").close();
                    }
                }
            ]
        }
    ],
    rules: {
        "nNome": webix.rules.isNotEmpty(),
        "nCodigo": webix.rules.isNotEmpty(),
        //"nDescricao":webix.rules.isNotEmpty()
    },
    elementsConfig: {
        labelPosition: "top",
    }
};
//ADICIONAR CURSOS
var formADDCursos = {
    view: "form",
    id: "idformADDCursos",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'Nome', name: "cNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo', name: "cCodigo", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'C&oacute;digo Nome', name: "cCodigoNome", validate: "isNotEmpty", validateEvent: "blur" },
                { view: "text", label: 'Descri&ccedil;&atilde;o', name: "cDescricao"},
                {
                    //},{
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                if ($$("idformADDCursos").getValues().cNome && $$("idformADDCursos").getValues().cCodigo) { //validate form
                                    var envio = "cNome=" + $$("idformADDCursos").getValues().cNome +
                                        "&cCodigo=" + $$("idformADDCursos").getValues().cCodigo +
                                        "&cCodigoNome=" + $$("idformADDCursos").getValues().cCodigoNome +
                                        "&cDescricao=" + $$("idformADDCursos").getValues().cDescricao;
                                    var r = webix.ajax().sync().post(BASE_URL + "cCursos/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdCursos").load(BASE_URL + "cCursos/read");
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
                                $$("idwinADDCursos").close();
                            }
                        }
                    ]
                }
            ],
        }
    ],
    rules: {
        "cNome": webix.rules.isNotEmpty(),
        "cCodigo": webix.rules.isNotEmpty(),
        "cCodigoNome": webix.rules.isNotEmpty()
    },
    elementsConfig: {
        labelPosition: "top",
    }
};
//Adicionar NiveisCursos
var formADDNiveisCursos1 = {
    view: "form",
    id: "idformADDNiveisCursos1",
    borderless: true,
    //height:1000,
    elements: [
        {
            rows: [
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
                    label: 'Per&iacute;odo', name: "pNome",
                    value: 1, options: {
                        body: {
                            template: "#pNome#",
                            yCount: 7,
                            url: BASE_URL + "CPeriodos/read"
                        }
                    }
                },
                { view: "counter", label: "Meses de Duração", name: "ncDuracao" },
                { view: "counter", label: "Nota M&iacute;nima EA", name: "ncNota_Minima_EA" },
                {
                    view: "text", label: 'Pre&ccedil;o de Inscri&ccedil;&atilde;o', name: "ncPreco_Inscricao",
                    placeholder: "####",
                    validate: "isNumber",
                    validateEvent: "blur"
                },
                {
                    view: "text", label: 'Pre&ccedil;o de Matr&iacute;cula', name: "ncPreco_Matricula",
                    placeholder: "####",
                    validate: "isNumber",
                    validateEvent: "blur"
                },
                {
                    view: "text", label: 'Confirma&ccedil;&atilde;o de Matr&iacute;cula', name: "ncPreco_Confirmacao",
                    placeholder: "####",
                    validate: "isNumber",
                    validateEvent: "blur"
                },
                {
                    view: "text", label: 'Pre&ccedil;o de Propina', name: "ncPreco_Propina",
                    placeholder: "####",
                    validate: "isNumber",
                    validateEvent: "blur"
                },
                {
                    //},{
                    cols: [
                        {
                            view: "button", value: "Aceitar", click: function () {
                                var cnome = $$("idformADDNiveisCursos1").getValues().cNome;
                                var nnome = $$("idformADDNiveisCursos1").getValues().nNome;
                                var ncduracao = $$("idformADDNiveisCursos1").getValues().ncDuracao;
                                var ncpreco_inscricao = $$("idformADDNiveisCursos1").getValues().ncPreco_Inscricao;
                                var ncpreco_matricula = $$("idformADDNiveisCursos1").getValues().ncPreco_Matricula;
                                var ncpreco_propina = $$("idformADDNiveisCursos1").getValues().ncPreco_Propina;
                                var pNome = $$("idformADDNiveisCursos1").getValues().pNome;
                                var ncNota_Minima_EA = $$("idformADDNiveisCursos1").getValues().ncNota_Minima_EA;
                                var ncpreco_conf = $$("idformADDNiveisCursos1").getValues().ncPreco_Confirmacao;

                                //if(cnome && nnome && !isNaN(ncduracao) && !isNaN(ncpreco_inscricao) && !isNaN(ncpreco_matricula) && 
                                //    !isNaN(ncpreco_propina) && ncduracao && ncpreco_inscricao && ncpreco_matricula && ncpreco_propina){ //validate form
                                //if ($$("idformADDNiveisCursos").validate()) {
                                if (cnome && nnome && !isNaN(ncduracao) && !isNaN(ncpreco_inscricao) && !isNaN(ncpreco_matricula) && !isNaN(ncpreco_propina) && pNome && !isNaN(ncpreco_conf)) {
                                    var envio = "cursos_id=" + cnome +
                                        "&niveis_id=" + nnome +
                                        "&ncDuracao=" + ncduracao +
                                        "&ncPreco_Inscricao=" + ncpreco_inscricao +
                                        "&ncPreco_Matricula=" + ncpreco_matricula +
                                        "&ncPreco_Propina=" + ncpreco_propina +
                                        "&pNome=" + pNome +
                                        "&ncNota_Minima_EA=" + ncNota_Minima_EA +
                                        "&ncPreco_Confirmacao=" + ncpreco_conf;
                                    var r = webix.ajax().sync().post(BASE_URL + "cNiveisCursos/insert", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        $$("idDTEdNiveisCursos").load(BASE_URL + "cNiveisCursos/read");
                                    } else {
                                        webix.message({ type: "error", text: "Os Dados j&aacute; existem" });
                                    }
                                }
                                else
                                    webix.message({ type: "error", text: "Erro validando dados, os campos de pre&ccedil;os s&atilde;o num&eacute;ricos" });
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