//var codigo_foto;
function cargarFuncionarios(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        //autoheight:true,
        height: 900,
        cells: [
            {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Dados Pessoais", body: {

                    rows: [{
                        view: "form", id: "idform_DP_superior_grid", height: 125, minHeight: 10, maxHeight: 120, scroll: false,
                        cols: [
                            {},
                            { view: "template", id: "id_template_foto", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Funcionarios/default.jpg /></div>' }
                        ]
                    }, {
                        view: "form", scroll: false,
                        cols: [
                            {
                                view: "button", type: "form", value: "Adicionar", width: 120, click: function () {
                                    webix.ui({
                                        view: "window",
                                        id: "idwinADDDadosPesoais",
                                        width: 600,
                                        position: "center",
                                        modal: true,
                                        head: "Adicionar Dados",
                                        body: webix.copy(formADDDadosPesoais)
                                    }).show();
                                }
                            },
                            //
                            {
                                view: "button", type: "standard", value: "Editar Foto", width: 120, click: function () {
                                    var idSelecionado = $$("idDTEdDadosPesoais").getSelectedId(false, true);

                                    //locallizar el codifoFoto en la tabla Funcionarios
                                    var envio = "id=" + idSelecionado;
                                    var r = webix.ajax().sync().post(BASE_URL + "cFuncionarios/cargarFoto", envio);
                                    var CODIGO_FOTO = r.responseText;

                                    if (idSelecionado) {
                                        //preparar webcam
                                        webix.ui({
                                            view: "window",
                                            id: "idwinADDFoto",
                                            width: 460,
                                            position: "center",
                                            modal: true,
                                            head: "Adicionar Foto",
                                            //body:webix.copy(formADDFoto)
                                            //formFoto
                                            body: webix.copy(formFoto(CODIGO_FOTO))
                                        }).show();
                                    } else {
                                        webix.message({ type: "error", text: "Deve selecionar primeriro um funcion&aacute;rio" });
                                    }

                                }
                            },
                            {
                                view: "button", type: "danger", value: "Apagar", width: 120, click: function () {
                                    var idSelecionado = $$("idDTEdDadosPesoais").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        webix.confirm({
                                            title: "Confirmação",
                                            type: "confirm-warning",
                                            ok: "Sim", cancel: "Nao",
                                            text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                            callback: function (result) {
                                                if (result) {
                                                    //var idrowDT = $$("idDTEdDadosPesoais").getSelectedId(false,true);
                                                    var envio = "id=" + idSelecionado;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cFuncionarios/delete", envio);
                                                    if (r.responseText == "true") {
                                                        $$("idDTEdDadosPesoais").clearAll();
                                                        $$("idDTEdDadosPesoais").load(BASE_URL + "cFuncionarios/readDP");
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
                                view: "button", type: "form", value: "Curriculum", width: 120, click: function () {
                                    //criar PDF
                                    var idSelecionado = $$("idDTEdDadosPesoais").getSelectedId(false, true);
                                    if (idSelecionado) {
                                        var envio = "id=" + idSelecionado;
                                        var r = webix.ajax().sync().post(BASE_URL + "cCurriculum/imprimir", envio);
                                        if (r.responseText == "true") {
                                            webix.message("PDF criado com sucesso");
                                            //Carregar PDF
                                            webix.ui({
                                                view: "window",
                                                id: "idWinPDFCurriculum",
                                                height: 600,
                                                width: 700,
                                                left: 50, top: 50,
                                                move: true,
                                                modal: true,
                                                //head:"This window can be moved",
                                                head: {
                                                    view: "toolbar", cols: [
                                                        { view: "label", label: "Curriculum" },
                                                        { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDFCurriculum').close();" }
                                                    ]
                                                },
                                                body: {
                                                    //template:"Some text"
                                                    template: '<div id="idPDFCurriculum" style="width:690px;  height:590px"></div>'
                                                }
                                            }).show();
                                            PDFObject.embed("../../relatorios/curriculum.pdf", "#idPDFCurriculum");


                                        } else {
                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                        }

                                    } else {
                                        webix.message({ type: "error", text: "Deve selecionar um funcion&aacute;rio" });
                                    }
                                }
                            },
                            {
                                view: "button", value: "Actualizar", name: "id_btn_actualizar", type: "standard", width: 120, click: function () {
                                    $$("idDTEdDadosPesoais").clearAll();
                                    $$("idDTEdDadosPesoais").load(BASE_URL + "cFuncionarios/readDP");
                                }
                            },
                            {},
                            //{view:"template",width:320,template:'<div id="my_camera">'+'<img src='+PRO_URL+'Fotos/Funcionarios/'+CODIGO_FOTO+'.jpg /></div>'},
                            //
                            //{view:"template",width:320,template:'html->my_img_default'},
                        ]

                    }, {
                        view: "datatable",
                        id: "idDTEdDadosPesoais",
                        //autoheight:true,
                        //autowidth:true,
                        //autoConfig:true,
                        select: true,
                        editable: true,
                        //editable:true,
                        //editaction:"dblclick",
                        columns: [
                            { id: "id", header: "", css: "rank", width: 50, sort: "int" },
                            //{ id: "festado", header: "", css: "rank", width: 50, sort: "int" },
                            { id: "festado", header: "Activo", checkValue: 'on', uncheckValue: 'off', template: "{common.checkbox()}", width: 60 },
                            { id: "fNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                            { id: "fNomes", editor: "text", header: ["Nomes", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                            { id: "fApelido", editor: "text", header: ["Apelido", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                            { id: "fBI_Passaporte", editor: "text", header: ["BI-Pass.", { content: "textFilter" }], width: 150, validate: webix.rules.isNotEmpty(), sort: "strig" },
                            { id: "fBI_Data_Emissao", editor: "date", header: "BI D. Emiss&atilde;o.", width: 140, validate: webix.rules.isNotEmpty(), sort: "strig" },
                            { id: "fBI_Provincia_Emissao", editor: "richselect", header: "BI Identifica&ccedil;&atilde;o", width: 140, template: "#provNome#", options: BASE_URL + "CProvincias/read_combos" },
                            { id: "gNome", editor: "richselect", header: "Genero", width: 100, template: "#gNome#", options: BASE_URL + "CGeneros/read" },
                            { id: "ecNome", editor: "richselect", header: "Est. Civil", width: 100, template: "#ecNome#", options: BASE_URL + "CEstado_civil/read" },
                            { id: "paNome", editor: "richselect", header: "Nacionalidade", width: 120, template: "#paNome#", options: BASE_URL + "CPaises/read_combos" },
                            { id: "fData_Nascimento", editor: "date", header: "D. Nascimento.", width: 140, validate: webix.rules.isNotEmpty(), sort: "strig" },
                            { id: "provNome", editor: "richselect", header: "Prov&iacute;ncia", width: 140, template: "#provNome#", options: BASE_URL + "CProvincias/read_combos" },
                            { id: "munNome", editor: "richselect", header: "Naturalidade", width: 140, template: "#munNome#", options: BASE_URL + "CMunicipios/read_combos" },
                            { id: "hlfNome", editor: "richselect", header: "Habilita&ccedil;&atilde;o", width: 140, template: "#hlfNome#", options: BASE_URL + "CHabilitacoes_Literarias/read" },
                            //{ id: "fTelefone", editor: "text", header: ["Telefone1", { content: "textFilter" }], width: 100, sort: "strig" },
                            //{ id: "fTelefone1", editor: "text", header: ["Telefone2", { content: "textFilter" }], width: 100, sort: "strig" },
                            //{ id: "fEmail", editor: "text", header: "EMail", width: 110, validate: webix.rules.isNotEmpty(), sort: "strig" }
                        ],
                        resizeColumn: true,
                        on: {
                            "onAfterSelect": function (id) {
                                var idSelecionado = $$("idDTEdDadosPesoais").getSelectedId(false, true);
                                var envio = "id=" + idSelecionado;
                                var r = webix.ajax().sync().post(BASE_URL + "cFuncionarios/cargarFoto", envio);
                                var CODIGO_FOTO = r.responseText;
                                // idform_DP_superior_grid
                                $$("idform_DP_superior_grid").removeView("id_template_foto");
                                $$("idform_DP_superior_grid").addView({ view: "template", id: "id_template_foto", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Funcionarios/' + CODIGO_FOTO + '.jpg /></div>' }, 2);
                                //{view:"template",width:320,template:'<div id="my_camera">'+'<img src='+PRO_URL+'Fotos/Funcionarios/'+CODIGO_FOTO+'.jpg /></div>'},
                            },
                            "onDataUpdate": function (id, data) {
                                //validar todo
                                /* if (id && data.fNome && data.fNomes && data.fApelido && data.gNome && data.paNome && data.fBI_Passaporte && data.fBI_Data_Emissao &&
                                     data.fBI_Provincia_Emissao && data.fData_Nascimento && data.provNome && data.munNome &&
                                     data.hlfNome) {
                                         */
                                if (id && data.fNome && data.fApelido && data.fBI_Passaporte) {
                                    //comprobar que los combos envien el id
                                    var idGenero;
                                    if (isNaN(data.gNome)) {
                                        var rg = webix.ajax().sync().post(BASE_URL + "cGeneros/GetID", "gNome=" + data.gNome);
                                        idGenero = rg.responseText;
                                    } else {
                                        idGenero = data.gNome;
                                    }
                                    var idEC;
                                    if (isNaN(data.ecNome)) {
                                        var rec = webix.ajax().sync().post(BASE_URL + "cEstado_Civil/GetID", "ecNome=" + data.ecNome);
                                        idEC = rec.responseText;
                                    } else {
                                        idEC = data.ecNome;
                                    }
                                    var idPais;
                                    if (isNaN(data.paNome)) {
                                        var rpa = webix.ajax().sync().post(BASE_URL + "cPaises/GetID", "paNome=" + data.paNome);
                                        idPais = rpa.responseText;
                                    } else {
                                        idPais = data.paNome;
                                    }
                                    var idBI_P_E;
                                    if (isNaN(data.fBI_Provincia_Emissao)) {
                                        var rbi = webix.ajax().sync().post(BASE_URL + "cProvincias/GetID", "provNome=" + data.fBI_Provincia_Emissao);
                                        idBI_P_E = rbi.responseText;
                                    } else {
                                        idBI_P_E = data.fBI_Provincia_Emissao;
                                    }
                                    var idprovNome;
                                    if (isNaN(data.provNome)) {
                                        var rpn = webix.ajax().sync().post(BASE_URL + "cProvincias/GetID", "provNome=" + data.provNome);
                                        idprovNome = rpn.responseText;
                                    } else {
                                        idprovNome = data.provNome;
                                    }
                                    var idmunNome;
                                    if (isNaN(data.munNome)) {
                                        var rmn = webix.ajax().sync().post(BASE_URL + "cMunicipios/GetID", "munNome=" + data.munNome);
                                        idmunNome = rmn.responseText;
                                    } else {
                                        idmunNome = data.munNome;
                                    }
                                    var idhlf;
                                    if (isNaN(data.hlfNome)) {
                                        var rhlf = webix.ajax().sync().post(BASE_URL + "cHabilitacoes_Literarias/GetID", "hlfNome=" + data.hlfNome);
                                        idhlf = rhlf.responseText;
                                    } else {
                                        idhlf = data.hlfNome;
                                    }

                                    var envio = "id=" + id +
                                        "&festado=" + data.festado +
                                        "&fNome=" + data.fNome +
                                        "&fNomes=" + data.fNomes +
                                        "&fApelido=" + data.fApelido +
                                        "&gNome=" + idGenero +
                                        "&ecNome=" + idEC +
                                        "&paNome=" + idPais +
                                        "&fBI_Passaporte=" + data.fBI_Passaporte +
                                        "&fBI_Data_Emissao=" + data.fBI_Data_Emissao +
                                        "&BI_Lugar_Emissao_Provincias=" + idBI_P_E +
                                        "&fData_Nascimento=" + data.fData_Nascimento +
                                        "&Nascimento_Provincias_id=" + idprovNome +
                                        "&Nascimento_Municipios_id=" + idmunNome +
                                        "&hlfNome=" + idhlf;
                                    var r = webix.ajax().sync().post(BASE_URL + "cFuncionarios/updateDP", envio);
                                    if (r.responseText == "true") {
                                        $$("idDTEdDadosPesoais").clearAll();
                                        $$("idDTEdDadosPesoais").load(BASE_URL + "cFuncionarios/readDP");
                                        webix.message("Dados atualizados com sucesso");
                                    } else {
                                        webix.message({ type: "error", text: "Erro atualizando dados" });
                                    }
                                } else {
                                    webix.message({ type: "error", text: "Erro validando dados" });
                                    $$("idDTEdDadosPesoais").clearAll();
                                    $$("idDTEdDadosPesoais").load(BASE_URL + "cFuncionarios/readDP");
                                }

                            }

                        },
                        url: BASE_URL + "cFuncionarios/readDP",
                        pager: "pagerDadosPesoais"
                    }, {
                        view: "pager", id: "pagerDadosPesoais",
                        template: "{common.prev()} {common.pages()} {common.next()}",
                        size: 25,
                        group: 10
                    }]
                }
            }, {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Dados Profissionais", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "datatable",
                        id: "idDTEdDadosProfisionais",
                        //autowidth:true,
                        //autoConfig:true,
                        select: true,
                        editable: true,
                        //editable:true,
                        //editaction:"dblclick",
                        columns: [
                            { id: "id", header: "", css: "rank", width: 50, sort: "int" },
                            { id: "fNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                            { id: "fNomes", editor: "text", header: ["Nomes", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                            { id: "fApelido", editor: "text", header: ["Apelido", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                            { id: "fBI_Passaporte", editor: "text", header: ["BI-Pass.", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "strig" },
                            { id: "gfNome", editor: "richselect", header: "Grupo", width: 150, template: "#gfNome#", options: BASE_URL + "CGrupoFuncionarios/read_combos" },
                            { id: "cfNome", editor: "richselect", header: "Categoria", width: 150, template: "#cfNome#", options: BASE_URL + "cCategoriaFuncionarios/read_combos" },
                            { id: "vlNome", editor: "richselect", header: "Vinculo Laboral", width: 150, template: "#vlNome#", options: BASE_URL + "CVinculos_Laborais/read_combos" },
                            { id: "fNumero_Agente", editor: "text", header: ["Numero Agente.", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "strig" },
                            { id: "fNumero_NIF", editor: "text", header: ["Numero NIF.", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "strig" },
                            { id: "depNome", editor: "richselect", header: "Departamento", width: 150, template: "#depNome#", options: BASE_URL + "CDepartamentos/read" },
                            { id: "secNome", editor: "richselect", header: "Sector", width: 150, template: "#secNome#", options: BASE_URL + "CSectores/read" },
                            { id: "carNome", editor: "richselect", header: "Cargo", width: 150, template: "#carNome#", options: BASE_URL + "CCargos/read" },
                            { id: "fExperiencias_Profissionais", editor: "text", header: "Experiencias Profiss.", width: 200, validate: webix.rules.isNotEmpty(), sort: "strig" },

                            //{id:"fBI_Data_Emissao",editor:"date", header:"BI D. Emiss&atilde;o.",width:140, validate:webix.rules.isNotEmpty(),sort:"strig"},
                            //{id:"fBI_Provincia_Emissao",editor:"richselect",header:"BI Prov Emiss&atilde;o", width:140,template:"#provNome#",options:BASE_URL+"CProvincias/read"},
                            { id: "funcNome", editor: "richselect", header: "Fun&ccedil;&atilde;o", width: 140, template: "#funcNome#", options: BASE_URL + "CFuncionarios_Funcoes/read_combos" },
                            { id: "fData_Funcao", editor: "date", header: "Data Fun&ccedil;&atilde;o", width: 200, validate: webix.rules.isNotEmpty(), sort: "strig" },
                            { id: "fData_Admissao", editor: "date", header: "Data Admiss&atilde;o", width: 200, validate: webix.rules.isNotEmpty(), sort: "strig" },
                            //{ id: "fSalario_Basico", editor: "text", header: "Sal&aacute;rio B&aacute;sico", width: 170, validate: webix.rules.isNumber(), sort: "int" },
                            {
                                id: "fSalario_Basico", editor: "text", header: "Sal&aacute;rio B&aacute;sico", width: 170, validate: webix.rules.isNumber(), format: webix.Number.numToStr({
                                    groupDelimiter: ".",
                                    groupSize: 3,
                                    decimalDelimiter: ",",
                                    decimalSize: 2
                                })
                            },
                        ],
                        resizeColumn: true,
                        on: {
                            "onDataUpdate": function (id, data) {
                                //validar todo
                                /* if (id && data.fNome && data.fNomes && data.fApelido && data.fBI_Passaporte && data.gfNome && data.cfNome && data.carNome &&
                                     data.vlNome && data.fNumero_Agente && data.fNumero_NIF && data.depNome && data.secNome &&
                                     data.funcNome, data.fSalario_Basico) {
                                         */
                                if (id && data.fNome && data.fApelido && data.fBI_Passaporte) {
                                    var idGF;
                                    if (isNaN(data.gfNome)) {
                                        var rgf = webix.ajax().sync().post(BASE_URL + "cGrupoFuncionarios/GetID", "gfNome=" + data.gfNome);
                                        idGF = rgf.responseText;
                                    } else {
                                        idGF = data.gfNome;
                                    }
                                    var idCF;
                                    if (isNaN(data.cfNome)) {
                                        var rcf = webix.ajax().sync().post(BASE_URL + "cCategoriaFuncionarios/GetID", "cfNome=" + data.cfNome);
                                        idCF = rcf.responseText;
                                    } else {
                                        idCF = data.cfNome;
                                    }
                                    var idCAR;
                                    if (isNaN(data.carNome)) {
                                        var rcar = webix.ajax().sync().post(BASE_URL + "cCargos/GetID", "carNome=" + data.carNome);
                                        idCAR = rcar.responseText;
                                    } else {
                                        idCAR = data.carNome;
                                    }
                                    var idVL;
                                    if (isNaN(data.vlNome)) {
                                        var rvl = webix.ajax().sync().post(BASE_URL + "cVinculos_Laborais/GetID", "vlNome=" + data.vlNome);
                                        idVL = rvl.responseText;
                                    } else {
                                        idVL = data.vlNome;
                                    }
                                    var iddep;
                                    if (isNaN(data.depNome)) {
                                        var rdep = webix.ajax().sync().post(BASE_URL + "cDepartamentos/GetID", "depNome=" + data.depNome);
                                        iddep = rdep.responseText;
                                    } else {
                                        iddep = data.depNome;
                                    }
                                    var idsec;
                                    if (isNaN(data.secNome)) {
                                        var rsec = webix.ajax().sync().post(BASE_URL + "cSectores/GetID", "secNome=" + data.secNome);
                                        idsec = rsec.responseText;
                                    } else {
                                        idsec = data.secNome;
                                    }
                                    var idfunc;
                                    if (isNaN(data.funcNome)) {
                                        var rfunc = webix.ajax().sync().post(BASE_URL + "cFuncionarios_Funcoes/GetID", "funcNome=" + data.funcNome);
                                        idfunc = rfunc.responseText;
                                    } else {
                                        idfunc = data.funcNome;
                                    }
                                    var envio = "id=" + id +
                                        "&fNome=" + data.fNome +
                                        "&fNomes=" + data.fNomes +
                                        "&fApelido=" + data.fApelido +
                                        "&fBI_Passaporte=" + data.fBI_Passaporte +
                                        "&gfNome=" + idGF +
                                        "&cfNome=" + idCF +
                                        "&depNome=" + iddep +
                                        "&secNome=" + idsec +
                                        "&carNome=" + idCAR +
                                        "&vlNome=" + idVL +
                                        "&fNumero_Agente=" + data.fNumero_Agente +
                                        "&fNumero_NIF=" + data.fNumero_NIF +
                                        "&fExperiencias_Profissionais=" + data.fExperiencias_Profissionais +
                                        "&funcNome=" + idfunc +
                                        "&fData_Funcao=" + data.fData_Funcao +
                                        "&fData_Admissao=" + data.fData_Admissao +
                                        "&fSalario_Basico=" + data.fSalario_Basico;
                                    var r = webix.ajax().sync().post(BASE_URL + "cFuncionarios/updateDPRO", envio);
                                    if (r.responseText == "true") {
                                        $$("idDTEdDadosProfisionais").clearAll();
                                        $$("idDTEdDadosProfisionais").load(BASE_URL + "cFuncionarios/readDPRO");
                                        webix.message("Dados atualizados com sucesso");
                                    } else {
                                        webix.message({ type: "error", text: "Erro atualizando dados" });
                                    }
                                } else {
                                    webix.message({ type: "error", text: "Erro validando dados" });
                                    $$("idDTEdDadosProfisionais").clearAll();
                                    $$("idDTEdDadosProfisionais").load(BASE_URL + "cFuncionarios/readDPRO");
                                }

                            }

                        },
                        url: BASE_URL + "cFuncionarios/readDPRO",
                        pager: "pagerDadosProfisionais"
                    }, {
                        view: "pager", id: "pagerDadosProfisionais",
                        template: "{common.prev()} {common.pages()} {common.next()}",
                        size: 25,
                        group: 10
                    }]
                }
            }, {
                //<div class='mark'>#badge# </div> #smNome#
                //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                header: "Contactos", body: {
                    //id:"Niveis de Acessos",
                    rows: [{
                        view: "datatable",
                        id: "idDTEdDadosOutros",
                        //autowidth:true,
                        //autoConfig:true,
                        select: true,
                        editable: true,
                        //editable:true,
                        //editaction:"dblclick",
                        columns: [
                            { id: "id", header: "", css: "rank", width: 50, sort: "int" },
                            { id: "fNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                            { id: "fNomes", editor: "text", header: ["Nomes", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                            { id: "fApelido", editor: "text", header: ["Apelido", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                            { id: "fBI_Passaporte", editor: "text", header: ["BI-Pass.", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "strig" },
                            { id: "paNome", editor: "richselect", header: "Pais de Residencia", width: 200, template: "#paNome#", options: BASE_URL + "CPaises/read" },
                            { id: "provNome", editor: "richselect", header: "Provincia de Residencia", width: 200, template: "#provNome#", options: BASE_URL + "CProvincias/read_combos" },
                            { id: "munNome", editor: "richselect", header: "Municipio de Residencia", width: 200, template: "#munNome#", options: BASE_URL + "CMunicipios/read_combos" },
                            { id: "baiNome", editor: "richselect", header: "Bairro de Residencia", width: 200, template: "#baiNome#", options: BASE_URL + "CBairros/read_combos" },

                            { id: "fTelefone", editor: "text", header: ["Telefone1", { content: "textFilter" }], width: 100, sort: "strig" },
                            { id: "fTelefone1", editor: "text", header: ["Telefone2", { content: "textFilter" }], width: 100, sort: "strig" },
                            { id: "fEmail", editor: "text", header: "EMail", width: 110, validate: webix.rules.isNotEmpty(), sort: "strig" }
                        ],
                        resizeColumn: true,
                        on: {
                            "onDataUpdate": function (id, data) {
                                //validar todo
                                /*if (id && data.fNome && data.fNomes && data.fApelido && data.fBI_Passaporte && data.paNome && data.provNome && data.munNome && data.baiNome) { */
                                if (id && data.fNome && data.fApelido && data.fBI_Passaporte) {
                                    var idpa;
                                    if (isNaN(data.paNome)) {
                                        var rpa = webix.ajax().sync().post(BASE_URL + "cPaises/GetID", "paNome=" + data.paNome);
                                        idpa = rpa.responseText;
                                    } else {
                                        idpa = data.paNome;
                                    }
                                    var idprov;
                                    if (isNaN(data.provNome)) {
                                        var rprov = webix.ajax().sync().post(BASE_URL + "cProvincias/GetID", "provNome=" + data.provNome);
                                        idprov = rprov.responseText;
                                    } else {
                                        idprov = data.provNome;
                                    }
                                    var idmun;
                                    if (isNaN(data.munNome)) {
                                        var rmun = webix.ajax().sync().post(BASE_URL + "cMunicipios/GetID", "munNome=" + data.munNome);
                                        idmun = rmun.responseText;
                                    } else {
                                        idmun = data.munNome;
                                    }
                                    var idbai;
                                    if (isNaN(data.baiNome)) {
                                        var rbai = webix.ajax().sync().post(BASE_URL + "cBairros/GetID", "baiNome=" + data.baiNome);
                                        idbai = rbai.responseText;
                                    } else {
                                        idbai = data.baiNome;
                                    }
                                    var envio = "id=" + id +
                                        "&fNome=" + data.fNome +
                                        "&fNomes=" + data.fNomes +
                                        "&fApelido=" + data.fApelido +
                                        "&fBI_Passaporte=" + data.fBI_Passaporte +
                                        "&paNome=" + idpa +
                                        "&provNome=" + idprov +
                                        "&munNome=" + idmun +
                                        "&baiNome=" + idbai +
                                        "&fTelefone=" + data.fTelefone +
                                        "&fTelefone1=" + data.fTelefone1 +
                                        "&fEmail=" + data.fEmail;
                                    var r = webix.ajax().sync().post(BASE_URL + "cFuncionarios/updateDO", envio);
                                    if (r.responseText == "true") {
                                        $$("idDTEdDadosOutros").clearAll();
                                        $$("idDTEdDadosOutros").load(BASE_URL + "cFuncionarios/readDO");
                                        webix.message("Dados atualizados com sucesso");
                                    } else {
                                        webix.message({ type: "error", text: "Erro atualizando dados" });
                                    }
                                } else {
                                    webix.message({ type: "error", text: "Erro validando dados" });
                                    $$("idDTEdDadosOutros").clearAll();
                                    $$("idDTEdDadosOutros").load(BASE_URL + "cFuncionarios/readDO");
                                }

                            }

                        },
                        url: BASE_URL + "cFuncionarios/readDO",
                        pager: "pagerDadosOutros"
                    }, {
                        view: "pager", id: "pagerDadosOutros",
                        template: "{common.prev()} {common.pages()} {common.next()}",
                        size: 25,
                        group: 10
                    }]
                }
            }
        ]
    });
}
//Adicionar DadosPesoais
var formADDDadosPesoais = {
    view: "tabview",
    id: "tabDP",
    //height:900,
    cells: [{
        header: "Dados Pessoais", body: {
            view: "form",
            id: "idformADDDadosPesoais",
            height: 550,
            borderless: true,
            elements: [
                {
                    cols: [{
                        rows: [
                            { view: "checkbox", label: "Activo", name: "festado", labelWidth: 60, value: "on", uncheckValue: "off", checkValue: "on" },
                            { view: "text", label: 'Apelido', name: "fApelido", required: true, validate: "isNotEmpty", validateEvent: "blur" },
                            //{ view: "datepicker", label: "Data Nascimento", name: "fData_Nascimento", stringResult: true },
                            { view: "datepicker", label: "Data Nascimento", name: "fData_Nascimento", stringResult: true, format: "%Y-%m-%d", value: "1975-01-01" },
                            { view: "richselect", label: 'Nacionalidade', name: "paNome", value: 2, options: { body: { template: "#paNome#", yCount: 7, url: BASE_URL + "CPaises/read_combos" } } },
                            {
                                view: "richselect", label: 'Provincia Nascimento', name: "Nascimento_Provincias_id", value: 3, options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read_combos" } },
                                on: {
                                    "onChange": function (newv, oldv) {
                                        //code
                                        //alert(this.getValue());
                                        $$("id_municipio_nascimento").getList().clearAll();
                                        $$("id_municipio_nascimento").getList().load(BASE_URL + "cMunicipios/readXProvincia?id=" + this.getValue());
                                    }
                                }
                            },
                            { view: "datepicker", label: "BI Data Emiss&atilde;o", name: "fBI_Data_Emissao", stringResult: true, format: "%Y-%m-%d", value: new Date() },
                            { view: "richselect", label: 'BI Arquivo Identifica&ccedil;&atilde;o', name: "provincia_emissao", value: 3, options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read_combos" } } },
                            //{ view: "text", label: 'Telefone1', name: "fTelefone" },
                            //{ view: "text", label: 'E-Mail', name: "fEmail" },
                            {}
                        ]
                    }, {
                        rows: [
                            //{},
                            { view: "text", label: 'Nome', name: "fNome", required: true, validate: "isNotEmpty", validateEvent: "blur" },
                            { view: "text", label: 'Nomes', name: "fNomes" },
                            { view: "richselect", label: 'Genero', name: "gNome", value: 3, options: { body: { template: "#gNome#", yCount: 7, url: BASE_URL + "CGeneros/read" } } },
                            { view: "richselect", label: 'Estado Civil', name: "ecNome", value: 1, options: { body: { template: "#ecNome#", yCount: 7, url: BASE_URL + "CEstado_Civil/read" } } },
                            { view: "richselect", label: 'Municipio Nascimento', name: "municipio_nascimento", id: "id_municipio_nascimento", value: 1, options: { body: { template: "#munNome#", yCount: 7, url: BASE_URL + "CMunicipios/read_combos" } } },

                            { view: "text", label: 'BI/Pass:', name: "fBI_Passaporte", required: true, validate: "isNotEmpty", validateEvent: "blur" },

                            //{ view: "text", label: 'Telefone2', name: "fTelefone1" },
                            {}
                        ]
                    }
                    ]
                }, {
                    cols: [{},
                    {
                        view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                            $$("idwinADDDadosPesoais").close();
                        }
                    }
                    ]
                }
            ],
            elementsConfig: {
                labelPosition: "top",
            }
        }
    },

    {
        header: "Dados Profissionais", body: {
            view: "form",
            id: "idformADDDadosProfissionais",
            height: 550,
            borderless: true,
            elements: [
                {
                    cols: [{
                        rows: [
                            {
                                view: "richselect", label: 'Grupo Funcionarios', name: "gfNome", value: 3, options: { body: { template: "#gfNome#", yCount: 7, url: BASE_URL + "CGrupoFuncionarios/read_combos" } },
                                on: {
                                    "onChange": function (newv, oldv) {
                                        //code
                                        //alert(this.getValue());
                                        $$("id_cfNome").getList().clearAll();
                                        $$("id_cfNome").getList().load(BASE_URL + "CCategoriaFuncionarios/read_x_grupo?id=" + this.getValue());
                                    }
                                }
                            },
                            { view: "richselect", label: 'Fun&ccedil;&atilde;o', name: "funcNome", value: 3, options: { body: { template: "#funcNome#", yCount: 7, url: BASE_URL + "CFuncionarios_Funcoes/read_combos" } } },
                            { view: "richselect", label: 'Vinculo Laboral', name: "vlNome", value: 1, options: { body: { template: "#vlNome#", yCount: 7, url: BASE_URL + "CVinculos_Laborais/read_combos" } } },
                            { view: "richselect", label: 'Cargo', name: "carNome", value: 1, options: { body: { template: "#carNome#", yCount: 7, url: BASE_URL + "CCargos/read" } } },
                            { view: "text", label: 'Numero Agente', name: "fNumero_Agente" },
                            {
                                view: "richselect", label: 'Departamento', name: "depNome", value: 1, options: { body: { template: "#depNome#", yCount: 7, url: BASE_URL + "CDepartamentos/read_combos" } },
                                on: {
                                    "onChange": function (newv, oldv) {
                                        //code
                                        //alert(this.getValue());
                                        $$("id_secNome").getList().clearAll();
                                        $$("id_secNome").getList().load(BASE_URL + "CSectores/read_x_dep?id=" + this.getValue());
                                    }
                                }
                            },
                            { view: "richselect", label: 'Habilita&ccedil;&otilde;es Literarias', name: "hlfNome", value: 1, options: { body: { template: "#hlfNome#", yCount: 7, url: BASE_URL + "CHabilitacoes_Literarias/read_combos" } } },

                            {}
                        ]
                    }, {
                        rows: [
                            { view: "richselect", label: 'Categoria Funcionarios', name: "cfNome", id: "id_cfNome", value: 2, options: { body: { template: "#cfNome#", yCount: 7, url: BASE_URL + "CCategoriaFuncionarios/read_combos" } } },
                            { view: "datepicker", label: "Data Fun&ccedil;&atilde;o", name: "fData_Funcao", stringResult: true, format: "%Y-%m-%d", value: new Date() },
                            { view: "datepicker", label: "Data Admiss&atilde;o", name: "fData_Admissao", stringResult: true, format: "%Y-%m-%d", value: new Date() },
                            {
                                view: "text", label: 'Sal&aacute;rio B&aacute;sico', name: "fSalario_Basico", validate: "isNumber", validateEvent: "key", required: true, value: '0'
                            },
                            { view: "text", label: 'Numero NIF', name: "fNumero_NIF" },
                            { view: "richselect", label: 'Sector', name: "secNome", id:"id_secNome", value: 1, options: { body: { template: "#secNome#", yCount: 7, url: BASE_URL + "CSectores/read_combos" } } },
                            { view: "textarea", label: 'Experiencias Profissionais', heigth: 600, name: "fExperiencias_Profissionais" },
                            // {}
                        ]
                    }
                    ]
                }, {
                    cols: [{},
                    {
                        view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                            $$("idwinADDDadosPesoais").close();
                        }
                    }
                    ]
                }
            ],
            elementsConfig: {
                labelPosition: "top",
            }
        }
    }, {
        header: "Contactos", body: {
            view: "form",
            id: "idformADDDadosOutros",
            height: 550,
            borderless: true,
            elements: [
                {
                    cols: [{
                        rows: [
                            {
                                view: "richselect", label: 'Endere&ccedil;o Pais', name: "EnderecoPais", value: 2, options: { body: { template: "#paNome#", yCount: 7, url: BASE_URL + "CPaises/read_combos" } },
                                on: {
                                    "onChange": function (newv, oldv) {
                                        //code
                                        //alert(this.getValue());
                                        $$("idComboProvincias").getList().clearAll();
                                        $$("idComboProvincias").getList().load(BASE_URL + "cProvincias/readXPais?id=" + this.getValue());
                                    }
                                }
                            },
                            {
                                view: "richselect", id: "idComboMunicipios", label: 'Endere&ccedil;o Municipio', name: "EnderecoMunicipio", value: 1, options: { body: { template: "#munNome#", yCount: 7, url: BASE_URL + "CMunicipios/read_combos" } },
                                on: {
                                    "onChange": function (newv, oldv) {
                                        //code
                                        //alert(this.getValue());
                                        $$("idComboBairros").getList().clearAll();
                                        $$("idComboBairros").getList().load(BASE_URL + "cBairros/readXMunicipio?id=" + this.getValue());
                                    }
                                }
                            },
                            { view: "text", label: 'Telefone1', name: "fTelefone" },
                            { view: "text", label: 'E-Mail', name: "fEmail" },
                            {}
                        ]
                    }, {
                        rows: [
                            {
                                view: "richselect", id: "idComboProvincias", label: 'Comuna', name: "EnderecoProvincia", value: 3, options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read_combos" } },
                                on: {
                                    "onChange": function (newv, oldv) {
                                        //code
                                        //alert(this.getValue());
                                        $$("idComboMunicipios").getList().clearAll();
                                        $$("idComboMunicipios").getList().load(BASE_URL + "cMunicipios/readXProvincia?id=" + this.getValue());
                                    }
                                }
                            },
                            { view: "richselect", id: "idComboBairros", label: 'Endere&ccedil;o Bairro', name: "EnderecoBairro", value: 1, options: { body: { template: "#baiNome#", yCount: 7, url: BASE_URL + "CBairros/read_combos" } } },
                            { view: "text", label: 'Telefone2', name: "fTelefone1" },
                            {}
                        ]
                    }
                    ]
                }, {
                    cols: [
                        {
                            view: "button", value: "Salvar", click: function () {
                                var festado = $$("idformADDDadosPesoais").getValues().festado;
                                var fNome = $$("idformADDDadosPesoais").getValues().fNome;
                                var fNomes = $$("idformADDDadosPesoais").getValues().fNomes;
                                var fApelido = $$("idformADDDadosPesoais").getValues().fApelido;
                                var gNome = $$("idformADDDadosPesoais").getValues().gNome;
                                var paNome = $$("idformADDDadosPesoais").getValues().paNome;
                                var fBI_Passaporte = $$("idformADDDadosPesoais").getValues().fBI_Passaporte;
                                var fBI_Data_Emissao = $$("idformADDDadosPesoais").getValues().fBI_Data_Emissao;
                                var fData_Nascimento = $$("idformADDDadosPesoais").getValues().fData_Nascimento;
                                var BI_Lugar_Emissao_Provincias = $$("idformADDDadosPesoais").getValues().provincia_emissao;
                                var ecNome = $$("idformADDDadosPesoais").getValues().ecNome;
                                var Nascimento_Provincias_id = $$("idformADDDadosPesoais").getValues().Nascimento_Provincias_id;
                                var Nascimento_Municipios_id = $$("idformADDDadosPesoais").getValues().municipio_nascimento;

                                var gfNome = $$("idformADDDadosProfissionais").getValues().gfNome;
                                var cfNome = $$("idformADDDadosProfissionais").getValues().cfNome;
                                var carNome = $$("idformADDDadosProfissionais").getValues().carNome;
                                var vlNome = $$("idformADDDadosProfissionais").getValues().vlNome;
                                var fNumero_Agente = $$("idformADDDadosProfissionais").getValues().fNumero_Agente;
                                var fNumero_NIF = $$("idformADDDadosProfissionais").getValues().fNumero_NIF;
                                var hlfNome = $$("idformADDDadosProfissionais").getValues().hlfNome;
                                var depNome = $$("idformADDDadosProfissionais").getValues().depNome;
                                var secNome = $$("idformADDDadosProfissionais").getValues().secNome;
                                var fExperiencias_Profissionais = $$("idformADDDadosProfissionais").getValues().fExperiencias_Profissionais;
                                var funcNome = $$("idformADDDadosProfissionais").getValues().funcNome;
                                var fData_Funcao = $$("idformADDDadosProfissionais").getValues().fData_Funcao;
                                var fData_Admissao = $$("idformADDDadosProfissionais").getValues().fData_Admissao;
                                var fSalario_Basico = $$("idformADDDadosProfissionais").getValues().fSalario_Basico;

                                var EnderecoPais = $$("idformADDDadosOutros").getValues().EnderecoPais;
                                var EnderecoProvincia = $$("idformADDDadosOutros").getValues().EnderecoProvincia;
                                var EnderecoMunicipio = $$("idformADDDadosOutros").getValues().EnderecoMunicipio;
                                var EnderecoBairro = $$("idformADDDadosOutros").getValues().EnderecoBairro;
                                var fTelefone = $$("idformADDDadosPesoais").getValues().fTelefone;
                                var fTelefone1 = $$("idformADDDadosPesoais").getValues().fTelefone1;
                                var fEmail = $$("idformADDDadosPesoais").getValues().fEmail;
                                /*
                                if (fNome && fNomes && fApelido && gNome && ecNome && paNome && fBI_Passaporte && fBI_Data_Emissao && BI_Lugar_Emissao_Provincias && fData_Nascimento && Nascimento_Provincias_id && Nascimento_Municipios_id &&
                                    gfNome && cfNome && carNome && vlNome && fNumero_Agente && fNumero_NIF && hlfNome && depNome && secNome &&
                                    EnderecoPais && EnderecoProvincia && EnderecoMunicipio && EnderecoBairro && fData_Funcao) { //validate form
                                */
                                //this.getParentView().validate();

                                if (fNome && fApelido && fBI_Passaporte && !isNaN(fSalario_Basico)) {
                                    //Adicionar Funcionarios
                                    var envio =
                                        "festado=" + festado +
                                        "&fNome=" + fNome +
                                        "&fNomes=" + fNomes +
                                        "&fApelido=" + fApelido +
                                        "&gNome=" + gNome +
                                        "&ecNome=" + ecNome +
                                        "&paNome=" + paNome +
                                        "&fBI_Passaporte=" + fBI_Passaporte +
                                        "&fBI_Data_Emissao=" + fBI_Data_Emissao +
                                        "&BI_Lugar_Emissao_Provincias=" + BI_Lugar_Emissao_Provincias +
                                        "&fData_Nascimento=" + fData_Nascimento +
                                        "&Nascimento_Provincias_id=" + Nascimento_Provincias_id +
                                        "&Nascimento_Municipios_id=" + Nascimento_Municipios_id +
                                        "&fTelefone=" + fTelefone +
                                        "&fTelefone1=" + fTelefone1 +
                                        "&fEmail=" + fEmail +
                                        "&Grupos_Funcionarios_id=" + gfNome +
                                        "&Categorias_Funcionarios_id=" + cfNome +
                                        "&Cargos_id=" + carNome +
                                        "&Vinculos_Laborais_id=" + vlNome +
                                        "&fNumero_Agente=" + fNumero_Agente +
                                        "&fNumero_NIF=" + fNumero_NIF +
                                        "&Habilitacoes_Literarias_Funcionarios_id=" + hlfNome +
                                        "&Departamentos_id=" + depNome +
                                        "&Sectores_id=" + secNome +
                                        "&fExperiencias_Profissionais=" + fExperiencias_Profissionais +
                                        "&EnderecoPais=" + EnderecoPais +
                                        "&EnderecoProvincia=" + EnderecoProvincia +
                                        "&EnderecoMunicipio=" + EnderecoMunicipio +
                                        "&EnderecoBairro=" + EnderecoBairro +
                                        "&funcNome=" + funcNome +
                                        "&fData_Funcao=" + fData_Funcao +
                                        "&fData_Admissao=" + fData_Admissao +
                                        "&fSalario_Basico=" + fSalario_Basico;
                                    var r = webix.ajax().sync().post(BASE_URL + "cFuncionarios/insertDP", envio);
                                    if (r.responseText == "true") {
                                        webix.message("Dados inseridos com sucesso");
                                        this.getTopParentView().hide(); //hide window
                                        //ACTUALIZAR DADOS PESSOAIS
                                        $$("idDTEdDadosPesoais").load(BASE_URL + "cFuncionarios/readDP");
                                        //ACTUALIZAR GRID DE DADOS PROFISSIONAIS
                                        $$("idDTEdDadosProfisionais").load(BASE_URL + "cFuncionarios/readDPRO");
                                        //ACTUALIZAR GRID DE DADOS OUTROS
                                        $$("idDTEdDadosOutros").load(BASE_URL + "cFuncionarios/readDO");
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
                                $$("idwinADDDadosPesoais").close();
                            }
                        }
                    ]
                }
            ],

            elementsConfig: {
                labelPosition: "top",
                on: {
                    'onChange': function (newv, oldv) {
                        this.validate();
                    }
                }
            }
        }
    }]
};



//var CODIGO_FOTO;
//fotografia
//var formADDFoto = {
function formFoto(CODIGO_FOTO) {
    var formADDFoto = {
        view: "form",
        id: "idformADDFoto",
        height: 550,
        borderless: true,
        elements: [{
            rows: [
                {
                    cols: [
                        {},
                        { view: "template", width: 480, template: '<div id="my_camera">' + '<img src=' + PRO_URL + 'Fotos/Funcionarios/' + CODIGO_FOTO + '.jpg /></div>' },
                        {}
                    ]
                },
                {
                    cols: [
                        {
                            view: "button", value: "Activar Camera", type: "standard", click: function () {
                                Webcam.set({
                                    width: 480,
                                    height: 390,
                                    image_format: 'jpeg',
                                    jpeg_quality: 100
                                });
                                Webcam.attach('#my_camera');
                            }
                        },
                        {
                            view: "button", value: "Captura/Salvar", type: "form", click: function () {
                                var idSelecionado = $$("idDTEdDadosPesoais").getSelectedId(false, true);
                                Webcam.snap(function (data_uri) {
                                    // display results in page
                                    document.getElementById('my_camera').innerHTML = '<img src="' + data_uri + '"/>';
                                    Webcam.upload(data_uri, BASE_URL + 'cFuncionarios/salvarFoto?id=' + idSelecionado, function (code, text) {
                                        if (text !== "true") {
                                            webix.message({ type: "error", text: "Deve selecionar primeriro um funcion&aacute;rio" });
                                        } else {
                                            webix.message({ text: "Foto guardada com sucesso" });
                                        }

                                    });
                                });
                            }
                        },
                        {
                            view: "button", value: "Fechar", name: "fechar", type: "danger", click: function () {
                                //Webcam.off('set');
                                Webcam.reset();
                                $$("idwinADDFoto").close();
                            }
                        }
                    ]
                }

            ]
        }]
    };
    return formADDFoto;
}


