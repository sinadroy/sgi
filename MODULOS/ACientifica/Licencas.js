function cargarVistaLicencas(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Editar Licen&ccedil;as", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDLicencas",
                                        width: 500,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Licen&ccedil;as",
                                        body: webix.copy(formADDLicencas)
                                    }).show();
                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                    var idSelecionado = $$("idDTEdLicencas").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    var envio = "id=" + idSelecionado;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cLicencas/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdLicencas").clearAll();
                                                        $$("idDTEdLicencas").load(BASE_URL + "cLicencas/read");
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
                            id: "idDTEdLicencas",
                            //autowidth:true,
                            //autoConfig:true,
                            select: true,
                            editable: true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns: [
                                { id: "id", header: "ID", css: "rank", width: 30, sort: "int" },
                                { id: "Funcionarios_id", hidden: true, header: "ID", css: "rank", width: 30, sort: "int" },
                                { id: "fNome", header: "Nome", width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                { id: "fNomes", header: "Nomes", width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "fApelido", header: "Apelido", width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                { id: "fBI_Passaporte", header: "BI-Pass.", width: 120, validate: webix.rules.isNotEmpty(), sort: "strig" },
                                { id: "liceData_Inicio", editor: "date", header: "Data Inicio", width: 120, validate: webix.rules.isNotEmpty(), sort: "strig" },
                                { id: "liceData_Fin", editor: "date", header: "Data Fin", width: 120, validate: webix.rules.isNotEmpty(), sort: "strig" },
                                //{id:"liceMotivo", editor:"text",header:"Motivo",width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                { id: "lmNome", editor: "richselect", header: "Motivo", width: 200, template: "#lmNome#", options: BASE_URL + "CLicencas_Motivos/read" },
                                //{id:"lmNome", editor:"text",header:"Motivo",width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                            ],
                            on: {
                                "onDataUpdate": function (id, data) {
                                    var Funcionarios_id = data.Funcionarios_id;
                                    var liceData_Inicio = data.liceData_Inicio;
                                    var liceData_Fin = data.liceData_Fin;
                                    var lmNome = data.lmNome;

                                    if (isNaN(lmNome)) {
                                        var lm = webix.ajax().sync().post(BASE_URL + "cLicencas/GetID", "lmNome=" + lmNome);
                                        lmNome = lm.responseText;
                                    }

                                    //validar todo
                                    if (id && Funcionarios_id && liceData_Inicio && liceData_Fin && lmNome) {
                                        var envio = "id=" + id +
                                            "&Funcionarios_id=" + Funcionarios_id +
                                            "&liceData_Inicio=" + liceData_Inicio +
                                            "&liceData_Fin=" + liceData_Fin +
                                            "&lmNome=" + lmNome;

                                        var r = webix.ajax().sync().post(BASE_URL + "cLicencas/update", envio);
                                        if (r.responseText == "true") {
                                            $$("idDTEdLicencas").clearAll();
                                            $$("idDTEdLicencas").load(BASE_URL + "cLicencas/read");
                                            webix.message("Dados atualizados com sucesso");
                                            
                                            if (lmNome == 10) {
                                                //cargar PDF cuando se seleccione licenca disciplinar
                                                var envio = "Funcionarios_id=" + Funcionarios_id;
                                                var rfid = webix.ajax().sync().post(BASE_URL + "CLicencas_Motivos_Disciplinar_IMP/imprimir", envio);
                                                if (rfid.responseText == "true") {
                                                    webix.message("PDF criado com sucesso");
                                                    //Carregar PDF
                                                    webix.ui({
                                                        view: "window",
                                                        id: "idWinPDFLicencas",
                                                        height: 600,
                                                        width: 950,
                                                        left: 50, top: 50,
                                                        move: true,
                                                        modal: true,
                                                        //head:"This window can be moved",
                                                        head: {
                                                            view: "toolbar", cols: [
                                                                { view: "label", label: "Imprimir" },
                                                                { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFLicencas').close();" }
                                                            ]
                                                        },
                                                        body: {
                                                            //template:"Some text"
                                                            template: '<div id="idPDFLicencas" style="width:940px;  height:590px"></div>'
                                                        }
                                                    }).show();
                                                    PDFObject.embed("../../relatorios/mLicencas_Motivos_Disciplinar_IMP.pdf", "#idPDFLicencas");
                                                } else {
                                                    webix.message({ type: "error", text: "Erro atualizando dados" });
                                                }
                                            }
                                            
                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }
                                    } else {
                                        webix.message({ type: "error", text: "Erro validando dados" });
                                        $$("idDTEdLicencas").clearAll();
                                        $$("idDTEdLicencas").load(BASE_URL + "cLicencas/read");
                                    }

                                }

                            },
                            url: BASE_URL + "cLicencas/read",
                            pager: "pagerLicencas"
                        }, {
                            view: "pager", id: "pagerLicencas",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }]
                }
            }
        ]
    });
}
//Adicionar Licencas
var formADDLicencas = {
    view: "form",
    id: "idformADDLicencas",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "combo", label: 'Localizar por BI/Passaporte', name: "liceBI_Passaporte",/*value:1,*/options: { body: { template: "#fBI_Passaporte#", yCount: 7, url: BASE_URL + "CFuncionarios/readBI" } },
                    on: {
                        "onChange": function (newv, oldv) {
                            var fNome = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readNomeXID", "id=" + this.getValue());
                            var fApelido = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readApelidoXID", "id=" + this.getValue());
                            //if(r.responseText == "true"){
                            $$("idComboFNome").setValue(fNome.responseText);
                            $$("idComboFApelido").setValue(fApelido.responseText);
                        }
                    }
                },
                { view: "text", id: "idComboFNome", readonly: true, label: 'Nome', name: "fNome" },
                //{ view:"text", readonly:true, label:'Nomes', name:"fNomes",validate:"isNotEmpty", validateEvent:"blur"},
                { view: "text", id: "idComboFApelido", readonly: true, label: 'Apelido', name: "fApelido" },
                { view: "datepicker", label: "Data Inicio", name: "liceData_Inicio", stringResult: true, validate: "isNotEmpty", validateEvent: "blur" },
                { view: "datepicker", label: "Data Fin", name: "liceData_Fin", stringResult: true, validate: "isNotEmpty", validateEvent: "blur" },
                //{view:"textarea", label:'Motivo',heigth:400, name:"liceMotivo"}
                { view: "richselect", label: 'Motivo', name: "lmNome",/*value:1,*/options: { body: { template: "#lmNome#", yCount: 7, url: BASE_URL + "CLicencas_Motivos/read" } } }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Salvar", click: function () {
                        var id = $$("idformADDLicencas").getValues().liceBI_Passaporte;
                        var liceData_Inicio = $$("idformADDLicencas").getValues().liceData_Inicio;
                        var liceData_Fin = $$("idformADDLicencas").getValues().liceData_Fin;
                        var lmNome = $$("idformADDLicencas").getValues().lmNome;
                        if (id && liceData_Inicio && liceData_Fin && lmNome) { //validate form

                            if (isNaN(lmNome)) {
                                var lm = webix.ajax().sync().post(BASE_URL + "cLicencas/GetID", "lmNome=" + lmNome);
                                lmNome = lm.responseText;
                            }

                            var envio = "Funcionarios_id=" + id +
                                "&liceData_Inicio=" + liceData_Inicio +
                                "&liceData_Fin=" + liceData_Fin +
                                "&lmNome=" + lmNome;
                            var r = webix.ajax().sync().post(BASE_URL + "cLicencas/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdLicencas").load(BASE_URL + "cLicencas/read");
                                //si el tipo de licenca es Disciplinar hay que imp relatorio
                                if (lmNome == 10) {
                                    //cargar PDF cuando se seleccione licenca disciplinar
                                    var envio = "Funcionarios_id=" + id;
                                    var rfid = webix.ajax().sync().post(BASE_URL + "CLicencas_Motivos_Disciplinar_IMP/imprimir", envio);
                                    if (rfid.responseText == "true") {
                                        webix.message("PDF criado com sucesso");
                                        //Carregar PDF
                                        webix.ui({
                                            view: "window",
                                            id: "idWinPDFLicencas",
                                            height: 600,
                                            width: 950,
                                            left: 50, top: 50,
                                            move: true,
                                            modal: true,
                                            //head:"This window can be moved",
                                            head: {
                                                view: "toolbar", cols: [
                                                    { view: "label", label: "Imprimir" },
                                                    { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFLicencas').close();" }
                                                ]
                                            },
                                            body: {
                                                //template:"Some text"
                                                template: '<div id="idPDFLicencas" style="width:940px;  height:590px"></div>'
                                            }
                                        }).show();
                                        PDFObject.embed("../../relatorios/mLicencas_Motivos_Disciplinar_IMP.pdf", "#idPDFLicencas");
                                    } else {
                                        webix.message({ type: "error", text: "Erro atualizando dados" });
                                    }
                                }

                                //end
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
                        $$("idwinADDLicencas").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};