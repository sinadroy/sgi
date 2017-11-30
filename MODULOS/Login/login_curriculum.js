var form_login_curriculum = {
    view: "form",
    id: "idformLogin_curriculum",
    borderless: true,
    elements: [
        { view: "text", label: 'Usu&aacute;rio', name: "login" },
        { view: "text", label: 'Senha', name: "senha", type: "password" },
        {
            view: "button", value: "Entrar", hotkey: "enter", click: function () {
                if (this.getParentView().validate()) { //validate form
                    var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/validar", "action=login&login=" + $$("idformLogin_curriculum").getValues().login + "&senha=" + $$("idformLogin_curriculum").getValues().senha);
                    if (r.responseText == "true") {
                        this.getTopParentView().hide(); //hide window
                        var r2 = webix.ajax().sync().post(BASE_URL + "cutilizadores/Existe_ProfXUsuario", "login=" + $$("idformLogin_curriculum").getValues().login);
                        if (r2.responseText == "true") {
                            webix.message("A carregar Curriculum...");
                            //cargar windows com combo pa seleccionar disciplina y Pautas
                            webix.ui({
                                view: "window",
                                id: "idwin_curriculum",
                                width: 1200,
                                height: 600,
                                position: "center",
                                modal: true,
                                //head: "Pautas Professores",
                                head: {
                                    view: "toolbar", cols: [
                                        { view: "label", label: "Actualizar Curriculum" },
                                        {
                                            view: "button", type: "danger", label: 'X', width: 50, align: 'right', click: function () {//"$$('idwin_curriculum').close();" }
                                                $$('idwin_curriculum').close();
                                                var redirect = BASE_URL + 'welcome/logout';
                                                window.location = redirect;
                                            }
                                        }
                                    ]
                                },
                                body: webix.copy(form__curriculum)
                            }).show();
                            //cargar datos
                            var r3 = webix.ajax().sync().post(BASE_URL + "cutilizadores/Get_ProfXUsuario", "login=" + $$("idformLogin_curriculum").getValues().login);
                            $$('id_func').setValue(r3.responseText);

                            //actualizar grid de formacoes
                            $$("idDTEdFormacao_Funcionarios").clearAll();
                            $$("idDTEdFormacao_Funcionarios").load(BASE_URL + "cFormacao_Funcionarios/read_x_idf?id=" + r3.responseText);
                            //actualizar grid de outras formacoes
                            $$("idDTEdOutras_Formacoes").clearAll();
                            $$("idDTEdOutras_Formacoes").load(BASE_URL + "COutras_Formacoes/read_x_id?id=" + r3.responseText);
                            //actualizar grid de publicacoes
                            $$("idDTEdPublicacoes").clearAll();
                            $$("idDTEdPublicacoes").load(BASE_URL + "cPublicacoes/read_x_id?id=" + r3.responseText);
                            //actualizar grid de Eventos
                            $$("idDTEdEventos").clearAll();
                            $$("idDTEdEventos").load(BASE_URL + "CEventos/read_x_id?id=" + r3.responseText);
                            //actualizar grid de Linguas
                            $$("idDTEdLinguas_Funcionarios").clearAll();
                            $$("idDTEdLinguas_Funcionarios").load(BASE_URL + "CLinguas_Funcionarios/read_x_id?id=" + r3.responseText);

                            var rNome = webix.ajax().sync().post(BASE_URL + "cfuncionarios/getnome", "id=" + r3.responseText);
                            $$('idfNome').setValue(rNome.responseText);
                            var rNomes = webix.ajax().sync().post(BASE_URL + "cfuncionarios/getnomes", "id=" + r3.responseText);
                            $$('idfNomes').setValue(rNomes.responseText);
                            var rApelido = webix.ajax().sync().post(BASE_URL + "cfuncionarios/getapelido", "id=" + r3.responseText);
                            $$('idfApelido').setValue(rApelido.responseText);
                            var rbi = webix.ajax().sync().post(BASE_URL + "cfuncionarios/getbi", "id=" + r3.responseText);
                            $$('idfBI_Passaporte').setValue(rbi.responseText);
                            //
                            var rbide = webix.ajax().sync().post(BASE_URL + "cfuncionarios/getbi_data_emissao", "id=" + r3.responseText);
                            $$('idfBI_Data_Emissao').setValue(rbide.responseText);
                            var rbipe = webix.ajax().sync().post(BASE_URL + "cfuncionarios/getbi_provincia_emissao", "id=" + r3.responseText);
                            $$('idprovincia_emissao').setValue(rbipe.responseText);
                            var rbidn = webix.ajax().sync().post(BASE_URL + "cfuncionarios/get_data_nacimiento", "id=" + r3.responseText);
                            $$('idfData_Nascimento').setValue(rbidn.responseText);
                            var rg = webix.ajax().sync().post(BASE_URL + "cfuncionarios/get_genero", "id=" + r3.responseText);
                            $$('idgnome').setValue(rg.responseText);
                            //
                            var rec = webix.ajax().sync().post(BASE_URL + "cfuncionarios/get_estado_civil", "id=" + r3.responseText);
                            $$('idecnome').setValue(rec.responseText);
                            var rnac = webix.ajax().sync().post(BASE_URL + "cfuncionarios/get_nacionalidade", "id=" + r3.responseText);
                            $$('idpanome').setValue(rnac.responseText);
                            var rpn = webix.ajax().sync().post(BASE_URL + "cfuncionarios/get_nascimento_provincia", "id=" + r3.responseText);
                            $$('idNascimento_Provincias_id').setValue(rpn.responseText);
                            var rmn = webix.ajax().sync().post(BASE_URL + "cfuncionarios/get_nascimento_municipio", "id=" + r3.responseText);
                            $$('idmunicipio_nascimento').setValue(rmn.responseText);
                            var rhl = webix.ajax().sync().post(BASE_URL + "cfuncionarios/get_habilitacao_literaria", "id=" + r3.responseText);
                            $$('idhlfNome').setValue(rhl.responseText);
                            //
                            var rep = webix.ajax().sync().post(BASE_URL + "cfuncionarios/get_experiencias_profissionais", "id=" + r3.responseText);
                            $$('idfExperiencias_Profissionais').setValue(rep.responseText);
                            //actualizar Contactos
                            //Pais
                            var rpa = webix.ajax().sync().post(BASE_URL + "Cendereco_funcionarios/read_pais", "id=" + r3.responseText);
                            $$('id_EnderecoPais').setValue(rpa.responseText);
                            //Provincias
                            var rprov = webix.ajax().sync().post(BASE_URL + "Cendereco_funcionarios/read_provincia", "id=" + r3.responseText);
                            $$('idComboProvincias').setValue(rprov.responseText);
                            //Municipios
                            var rmun = webix.ajax().sync().post(BASE_URL + "Cendereco_funcionarios/read_municipio", "id=" + r3.responseText);
                            $$('idComboMunicipios').setValue(rmun.responseText);
                            //Bairro
                            var rbai = webix.ajax().sync().post(BASE_URL + "Cendereco_funcionarios/read_bairro", "id=" + r3.responseText);
                            $$('idComboBairros').setValue(rbai.responseText);
                            //telefone 1
                            var rt1 = webix.ajax().sync().post(BASE_URL + "Cendereco_funcionarios/read_telefone1", "id=" + r3.responseText);
                            $$('id_text_telefone1').setValue(rt1.responseText);
                            //telefone 2
                            var rt2 = webix.ajax().sync().post(BASE_URL + "Cendereco_funcionarios/read_telefone2", "id=" + r3.responseText);
                            $$('id_text_telefone2').setValue(rt2.responseText);
                            //fEmail
                            var remail = webix.ajax().sync().post(BASE_URL + "Cendereco_funcionarios/read_mail", "id=" + r3.responseText);
                            $$('id_text_femail').setValue(remail.responseText);
                        } else
                            webix.message({ type: "error", text: "Usuário incorretos, não é docente" });

                    } else
                        webix.message({ type: "error", text: "Dados incorretos" });
                }
                else
                    webix.message({ type: "error", text: "Dados incorretos" });
            }
        },
        {
            view: "button", value: "Cancel", name: "cancel", type: "danger", click: function () {
                $$("idformLogin_curriculum").clear();
                this.getTopParentView().hide(); //hide window
            }
        }
    ],
    rules: {
        "senha": webix.rules.isNotEmpty,
        "login": webix.rules.isNotEmpty
    },
    elementsConfig: {
        labelPosition: "top",
    }
};

webix.ui({
    view: "window",
    //view: "popup",
    id: "winLoginSGI_curriculum",
    width: 300,
    position: "center",
    modal: false,
    head: "Dados de Usu&aacute;rio",
    //body:webix.copy(form)
    body: form_login_curriculum
});

var form__curriculum = {
    view: "form",
    id: "idform__curriculum",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "tabview",
                    cells: [
                        {
                            header: "Dados Pessoais", body: {
                                rows: [
                                    {
                                        view: "form", id: "idform_cv_f", rows:
                                        [
                                            {
                                                cols: [
                                                    { view: "text", label: 'Nome', name: "fNome", id: "idfNome", disabled: true },
                                                    { view: "text", label: 'Nomes', name: "fNomes", id: "idfNomes", disabled: true },
                                                    { view: "text", label: 'Apelido', name: "fApelido", id: "idfApelido", disabled: true },
                                                    { view: "text", label: 'BI/Pass:', name: "fBI_Passaporte", id: "idfBI_Passaporte", disabled: true },
                                                ]
                                            },
                                            {
                                                cols: [
                                                    { view: "datepicker", label: "BI Data Emiss&atilde;o", name: "fBI_Data_Emissao", id: "idfBI_Data_Emissao", stringResult: true, format: "%Y-%m-%d" },
                                                    { view: "richselect", label: 'BI Arquivo Identifica&ccedil;&atilde;o', name: "provincia_emissao", id: "idprovincia_emissao", options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read_combos" } } },
                                                    { view: "datepicker", label: "Data Nascimento", name: "fData_Nascimento", id: "idfData_Nascimento", stringResult: true, format: "%Y-%m-%d" },
                                                    { view: "richselect", label: 'Genero', name: "gNome", id: "idgnome", options: { body: { template: "#gNome#", yCount: 7, url: BASE_URL + "CGeneros/read" } } },
                                                ]
                                            },
                                            {
                                                cols: [
                                                    { view: "richselect", label: 'Estado Civil', name: "ecNome", id: "idecnome", options: { body: { template: "#ecNome#", yCount: 7, url: BASE_URL + "CEstado_Civil/read" } } },
                                                    {
                                                        view: "richselect", label: 'Nacionalidade', name: "paNome", id: "idpanome", options: { body: { template: "#paNome#", yCount: 7, url: BASE_URL + "CPaises/read_combos" } },
                                                        on: {
                                                            "onChange": function (newv, oldv) {
                                                                //code
                                                                //alert(this.getValue());
                                                                $$("idNascimento_Provincias_id").getList().clearAll();
                                                                $$("idNascimento_Provincias_id").getList().load(BASE_URL + "cProvincias/readXPais?id=" + this.getValue());
                                                            }
                                                        }
                                                    },
                                                    {
                                                        view: "richselect", label: 'Provincia Nascimento', name: "Nascimento_Provincias_id", id: "idNascimento_Provincias_id", options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read_combos" } },
                                                        on: {
                                                            "onChange": function (newv, oldv) {
                                                                //code
                                                                //alert(this.getValue());
                                                                $$("idmunicipio_nascimento").getList().clearAll();
                                                                $$("idmunicipio_nascimento").getList().load(BASE_URL + "cMunicipios/readXProvincia?id=" + this.getValue());
                                                            }
                                                        }
                                                    },
                                                    { view: "richselect", label: 'Municipio Nascimento', name: "municipio_nascimento", id: "idmunicipio_nascimento", options: { body: { template: "#munNome#", yCount: 7, url: BASE_URL + "CMunicipios/read_combos" } } },
                                                ]
                                            },
                                            {
                                                cols: [
                                                    { view: "richselect", label: 'Habilitação Literarias', name: "hlfNome", id: "idhlfNome", options: { body: { template: "#hlfNome#", yCount: 7, url: BASE_URL + "CHabilitacoes_Literarias/read_combos" } } },
                                                    {},
                                                    {},
                                                    {}
                                                ]
                                            },
                                            {
                                                cols: [
                                                    { view: "textarea", label: 'Experiencias Profissionais', heigth: 600, name: "fExperiencias_Profissionais", id: "idfExperiencias_Profissionais" },
                                                    { view: "text", hidden: true, id: "id_func", name: "idfunc" },
                                                    {}
                                                ]
                                            }
                                        ]
                                    }

                                ]
                            }

                        }, {
                            header: "Contactos", body: {
                                view: "form",
                                id: "idformADDDadosOutrosCV",
                                //height: 550,
                                borderless: true,
                                elements: [
                                    {
                                        cols: [{
                                            rows: [
                                                {
                                                    view: "richselect", label: 'Endere&ccedil;o Pais', name: "EnderecoPais", id:"id_EnderecoPais", value: 2, options: { body: { template: "#paNome#", yCount: 7, url: BASE_URL + "CPaises/read_combos" } },
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
                                                { view: "text", label: 'Telefone1', name: "fTelefone", id:"id_text_telefone1" },
                                                { view: "text", label: 'E-Mail', name: "fEmail", id:"id_text_femail" },
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
                                                { view: "text", label: 'Telefone2', name: "fTelefone1", id:"id_text_telefone2" },
                                                {}
                                            ]
                                        }
                                        ]
                                    }, 
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
                        }, {
                            header: "Formações", body: {
                                rows: [{
                                    view: "form", scroll: false,
                                    cols: [
                                        {
                                            view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                                webix.ui({
                                                    view: "window",
                                                    id: "idwinADDFormacao_Funcionarios",
                                                    width: 700,
                                                    //heigth:700,
                                                    position: "center",
                                                    modal: true,
                                                    head: "Adicionar ",
                                                    body: webix.copy(formADDFormacao_Funcionarios)
                                                }).show();

                                                $$('idbi_formacao_funcionarios').setValue($$('id_func').getValue());
                                            }
                                        },
                                        {
                                            view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                                var idSelecionado = $$("idDTEdFormacao_Funcionarios").getSelectedId(false, true);
                                                if (idSelecionado) {
                                                    webix.confirm({
                                                        title: "Confirmação",
                                                        type: "confirm-warning",
                                                        ok: "Sim", cancel: "Nao",
                                                        text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                                        callback: function (result) {
                                                            if (result) {
                                                                var envio = "id=" + idSelecionado;
                                                                var r = webix.ajax().sync().post(BASE_URL + "cFormacao_Funcionarios/delete", envio);
                                                                if (r.responseText == "true") {
                                                                    $$("idDTEdFormacao_Funcionarios").clearAll();
                                                                    $$("idDTEdFormacao_Funcionarios").load(BASE_URL + "cFormacao_Funcionarios/read");
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
                                    id: "idDTEdFormacao_Funcionarios",
                                    select: true,
                                    editable: false,
                                    columns: [
                                        { id: "id", header: "", css: "rank", width: 30, sort: "int" },
                                        { id: "Funcionarios_id", hidden: true, header: "ID", css: "rank", width: 30, sort: "int" },
                                        { id: "fNome", hidden: true, header: ["Nome", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        { id: "fNomes", hidden: true, header: ["Nomes", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                        { id: "fApelido", hidden: true, header: ["Apelido", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                        { id: "fBI_Passaporte", hidden: true, header: ["BI-Pass.", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "strig" },

                                        { id: "univNome", editor: "richselect", header: "Universidade", width: 300, template: "#univNome#", options: BASE_URL + "cUniversidades/read" },
                                        { id: "fofuCurso", editor: "text", header: "Curso", width: 200, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        { id: "fofuAno_Inicio", editor: "text", header: "Ano Inicio", width: 70, validate: "isNumber", validateEvent: "blur", sort: "int" },
                                        { id: "fofuAno_Fin", editor: "text", header: "Ano Fim", width: 70, validate: "isNumber", validateEvent: "blur", sort: "int" },
                                        { id: "fofuTema_Tese", editor: "text", header: "Tema de Tese", width: 300, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        { id: "gpNome", editor: "richselect", header: "Forma&ccedil;&atilde;o", width: 150, template: "#gpNome#", options: BASE_URL + "cGraus_Pretendidos/read" },
                                        { id: "mfNome", editor: "richselect", header: "Modalidade Forma&ccedil;&atilde;o", width: 150, template: "#mfNome#", options: BASE_URL + "cModalidades_Formacao/read" },
                                        { id: "paNome", editor: "richselect", header: "Pais", width: 150, template: "#paNome#", options: BASE_URL + "cPaises/read" },
                                        { id: "fofuNota", editor: "text", header: "Nota Ponderada", width: 70, validate: "isNumber", validateEvent: "blur", sort: "int" }
                                    ],
                                    columnResize: true,
                                    //url: BASE_URL + "cFormacao_Funcionarios/read",
                                    pager: "pagerFormacao_Funcionarios"
                                }, {
                                    view: "pager", id: "pagerFormacao_Funcionarios",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 25,
                                    group: 10
                                }
                                ]
                            }
                        }, {
                            header: "Outras Formações", body: {
                                rows: [{
                                    view: "form", scroll: false,
                                    cols: [
                                        {
                                            view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                                webix.ui({
                                                    view: "window",
                                                    id: "idwinADDOutras_Formacoes",
                                                    width: 500,
                                                    //heigth:700,
                                                    position: "center",
                                                    modal: true,
                                                    head: "Adicionar ",
                                                    body: webix.copy(formADDOutras_Formacoes)
                                                }).show();

                                                $$('idbi_outras_formacoes1').setValue($$('id_func').getValue());
                                            }
                                        },
                                        {
                                            view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                                var idSelecionado = $$("idDTEdOutras_Formacoes").getSelectedId(false, true);
                                                if (idSelecionado) {
                                                    webix.confirm({
                                                        title: "Confirmação",
                                                        type: "confirm-warning",
                                                        ok: "Sim", cancel: "Nao",
                                                        text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                                        callback: function (result) {
                                                            if (result) {
                                                                var envio = "id=" + idSelecionado;
                                                                var r = webix.ajax().sync().post(BASE_URL + "cOutras_Formacoes/delete", envio);
                                                                if (r.responseText == "true") {
                                                                    $$("idDTEdOutras_Formacoes").clearAll();
                                                                    $$("idDTEdOutras_Formacoes").load(BASE_URL + "cOutras_Formacoes/read");
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
                                    id: "idDTEdOutras_Formacoes",
                                    select: true,
                                    editable: false,
                                    columns: [
                                        { id: "id", header: "", css: "rank", width: 30, sort: "int" },
                                        { id: "Funcionarios_id", hidden: true, header: "ID", css: "rank", width: 30, sort: "int" },
                                        //{ id: "fNome", header: ["Nome", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        //{ id: "fNomes", header: ["Nomes", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                        //{ id: "fApelido", header: ["Apelido", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                        //{ id: "fBI_Passaporte", header: ["BI-Pass.", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "strig" },
                                        //{id:"univNome",editor:"richselect", header:"Universidade",width:150,template:"#univNome#",options:BASE_URL+"cUniversidades/read"},
                                        { id: "ofCurso", editor: "text", header: "Curso", width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        { id: "ofData_Inicio", editor: "date", header: "Data Inicio", width: 170, validate: "isNumber", validateEvent: "blur", sort: "int" },
                                        { id: "ofData_Fim", editor: "date", header: "Data Fim", width: 170, validate: "isNumber", validateEvent: "blur", sort: "int" },
                                        { id: "ofInstituicao", editor: "text", header: "Institui&ccedil;&atilde;o", width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        { id: "ofTipo_Formacao", editor: "text", header: "Tipo Forma&ccedil;&atilde;o", width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        //{id:"ofTipo_Formacao",editor:"richselect", header:"Tipo Forma&ccedil;&atilde;o",width:150,template:"#gpNome#",options:BASE_URL+"cGraus_Pretendidos/read"},
                                        //{id:"mfNome",editor:"richselect", header:"Modalidade Forma&ccedil;&atilde;o",width:150,template:"#mfNome#",options:BASE_URL+"cModalidades_Formacao/read"},
                                        { id: "paNome", editor: "richselect", header: "Pais", width: 150, template: "#paNome#", options: BASE_URL + "cPaises/read" },
                                        //{id:"fofuNota",editor:"text", header:"Nota Ponderada",width:170,validate:"isNumber", validateEvent:"blur",sort:"int"}  
                                    ],
                                    //url: BASE_URL + "cOutras_Formacoes/read",
                                    pager: "pagerOutras_Formacoes"
                                }, {
                                    view: "pager", id: "pagerOutras_Formacoes",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 25,
                                    group: 10
                                }
                                ]
                            }
                        }, {
                            header: "Publicações", body: {
                                rows: [{
                                    view: "form", scroll: false,
                                    cols: [
                                        {
                                            view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                                webix.ui({
                                                    view: "window",
                                                    id: "idwinADDPublicacoes",
                                                    width: 700,
                                                    //heigth:700,
                                                    position: "center",
                                                    modal: true,
                                                    head: "Adicionar ",
                                                    body: webix.copy(formADDPublicacoes)
                                                }).show();

                                                $$('id_bi_publicacoes').setValue($$('id_func').getValue());
                                            }
                                        },
                                        {
                                            view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                                var idSelecionado = $$("idDTEdPublicacoes").getSelectedId(false, true);
                                                if (idSelecionado) {
                                                    webix.confirm({
                                                        title: "Confirmação",
                                                        type: "confirm-warning",
                                                        ok: "Sim", cancel: "Nao",
                                                        text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                                        callback: function (result) {
                                                            if (result) {
                                                                var envio = "id=" + idSelecionado;
                                                                var r = webix.ajax().sync().post(BASE_URL + "cPublicacoes/delete", envio);
                                                                if (r.responseText == "true") {
                                                                    $$("idDTEdPublicacoes").clearAll();
                                                                    $$("idDTEdPublicacoes").load(BASE_URL + "cPublicacoes/read");
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
                                    id: "idDTEdPublicacoes",
                                    select: true,
                                    editable: false,
                                    columns: [
                                        { id: "id", header: "", css: "rank", width: 30, sort: "int" },
                                        { id: "Funcionarios_id", hidden: true, header: "ID", css: "rank", width: 30, sort: "int" },
                                        //{ id: "fNome", header: ["Nome", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        //{id:"fNomes", header:["Nomes", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                        //{ id: "fApelido", header: ["Apelido", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                        //{ id: "fBI_Passaporte", header: ["BI-Pass.", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "strig" },

                                        { id: "pubTitulo", editor: "text", header: "T&iacute;tulo", width: 350, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        { id: "pubAno", editor: "text", header: "Ano", width: 70, validate: "isNumber", validateEvent: "blur", sort: "int" },

                                        { id: "pubEditora_Revista", editor: "text", header: "Editora/Revista", width: 250, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        //pubISBN_ISSN
                                        { id: "pubISBN_ISSN", editor: "text", header: "ISBN/ISSN", width: 100, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        { id: "tpubNome", editor: "richselect", header: "Tipo de Publica&ccedil;&atilde;o", width: 200, template: "#tpubNome#", options: BASE_URL + "cTipo_Publicacoes/read" },

                                        { id: "paNome", editor: "richselect", header: "Pais", width: 170, template: "#paNome#", options: BASE_URL + "cPaises/read" },
                                    ],
                                    //url: BASE_URL + "cPublicacoes/read",
                                    pager: "pagerPublicacoes"
                                }, {
                                    view: "pager", id: "pagerPublicacoes",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 25,
                                    group: 10
                                }
                                ]
                            }
                        }, {
                            header: "Eventos", body: {
                                rows: [{
                                    view: "form", scroll: false,
                                    cols: [
                                        {
                                            view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                                webix.ui({
                                                    view: "window",
                                                    id: "idwinADDEventos",
                                                    width: 500,
                                                    //heigth:700,
                                                    position: "center",
                                                    modal: true,
                                                    head: "Adicionar ",
                                                    body: webix.copy(formADDEventos)
                                                }).show();

                                                $$('id_bi_eventos').setValue($$('id_func').getValue());
                                            }
                                        },
                                        {
                                            view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                                var idSelecionado = $$("idDTEdEventos").getSelectedId(false, true);
                                                if (idSelecionado) {
                                                    webix.confirm({
                                                        title: "Confirmação",
                                                        type: "confirm-warning",
                                                        ok: "Sim", cancel: "Nao",
                                                        text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                                        callback: function (result) {
                                                            if (result) {
                                                                var envio = "id=" + idSelecionado;
                                                                var r = webix.ajax().sync().post(BASE_URL + "cEventos/delete", envio);
                                                                if (r.responseText == "true") {
                                                                    $$("idDTEdEventos").clearAll();
                                                                    $$("idDTEdEventos").load(BASE_URL + "cEventos/read");
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
                                    id: "idDTEdEventos",
                                    select: true,
                                    editable: false,
                                    columns: [
                                        { id: "id", header: "", css: "rank", width: 30, sort: "int" },
                                        { id: "Funcionarios_id", hidden: true, header: "ID", css: "rank", width: 30, sort: "int" },
                                        //{ id: "fNome", header: ["Nome", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        //{ id: "fApelido", header: ["Apelido", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                        //{ id: "fBI_Passaporte", header: ["BI-Pass.", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "strig" },
                                        { id: "evTitulo", editor: "text", header: "T&iacute;tulo", width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        { id: "evInstituicao", editor: "text", header: "Institui&ccedil;&atilde;o", width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        { id: "evAno", editor: "text", header: "Ano", width: 170, validate: "isNumber", validateEvent: "blur", sort: "int" },
                                        { id: "teNome", editor: "richselect", header: "Tipo de Evento", width: 150, template: "#teNome#", options: BASE_URL + "cTipo_Eventos/read" },
                                        { id: "paNome", editor: "richselect", header: "Pais", width: 150, template: "#paNome#", options: BASE_URL + "cPaises/read" }
                                    ],

                                    //url: BASE_URL + "cEventos/read",
                                    pager: "pagerEventos"
                                }, {
                                    view: "pager", id: "pagerEventos",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 25,
                                    group: 10
                                }
                                ]
                            }
                        }, {
                            header: "Habilitações Linguísticas", body: {
                                rows: [{
                                    view: "form", scroll: false,
                                    cols: [
                                        {
                                            view: "button", type: "form", value: "Adicionar", width: 100, click: function () {
                                                webix.ui({
                                                    view: "window",
                                                    id: "idwinADDLinguas_Funcionarios",
                                                    width: 500,
                                                    //heigth:700,
                                                    position: "center",
                                                    modal: true,
                                                    head: "Adicionar ",
                                                    body: webix.copy(formADDLinguas_Funcionarios)
                                                }).show();

                                                $$('id_bi_linguas').setValue($$('id_func').getValue());
                                            }
                                        },
                                        {
                                            view: "button", type: "danger", value: "Apagar", width: 100, click: function () {
                                                var idSelecionado = $$("idDTEdLinguas_Funcionarios").getSelectedId(false, true);
                                                if (idSelecionado) {
                                                    webix.confirm({
                                                        title: "Confirmação",
                                                        type: "confirm-warning",
                                                        ok: "Sim", cancel: "Nao",
                                                        text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                                        callback: function (result) {
                                                            if (result) {
                                                                var envio = "id=" + idSelecionado;
                                                                var r = webix.ajax().sync().post(BASE_URL + "cLinguas_Funcionarios/delete", envio);
                                                                if (r.responseText == "true") {
                                                                    $$("idDTEdLinguas_Funcionarios").clearAll();
                                                                    $$("idDTEdLinguas_Funcionarios").load(BASE_URL + "cLinguas_Funcionarios/read");
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
                                    id: "idDTEdLinguas_Funcionarios",
                                    //autowidth:true,
                                    //autoConfig:true,
                                    select: true,
                                    editable: false,
                                    //editable:true,
                                    //editaction:"dblclick",
                                    columns: [
                                        { id: "id", header: "", css: "rank", width: 30, sort: "int" },
                                        { id: "Funcionarios_id", hidden: true, header: "ID", css: "rank", width: 30, sort: "int" },
                                        //{ id: "fNome", header: ["Nome", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                        //{id:"fNomes", header:["Nomes", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                        //{ id: "fApelido", header: ["Apelido", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                        //{ id: "fBI_Passaporte", header: ["BI-Pass.", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "strig" },
                                        { id: "linNome", editor: "richselect", header: "l&iacute;ngua", width: 350, template: "#linNome#", options: BASE_URL + "cLinguas/read" },
                                        { id: "lnNome", editor: "richselect", header: "N&iacute;vel", width: 350, template: "#lnNome#", options: BASE_URL + "cLinguas_Nivel/read" }
                                    ],
                                    //url: BASE_URL + "cLinguas_Funcionarios/read",
                                    pager: "pagerLinguas_Funcionarios"
                                }, {
                                    view: "pager", id: "pagerLinguas_Funcionarios",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 25,
                                    group: 10
                                }
                                ]
                            }
                        }
                    ]
                },
                {
                    view: "form", rows:
                    [
                        {
                            cols: [
                                {
                                    view: "button", type: "danger", value: "Salvar", width: 100, click: function () {
                                        var idf = $$('idform_cv_f').getValues().idfunc;
                                        var bi = $$('idform_cv_f').getValues().fBI_Passaporte;
                                        var fBI_Data_Emissao = $$('idform_cv_f').getValues().fBI_Data_Emissao;
                                        var fBI_Provincia_Emissao = $$('idform_cv_f').getValues().provincia_emissao;
                                        var fData_Nascimento = $$('idform_cv_f').getValues().fData_Nascimento;
                                        var Generos_id = $$('idform_cv_f').getValues().gNome;
                                        var Estado_Civil_id = $$('idform_cv_f').getValues().ecNome;
                                        var Nacionalidade_Pais_id = $$('idform_cv_f').getValues().paNome;
                                        var Nascimento_Provincias_id = $$('idform_cv_f').getValues().Nascimento_Provincias_id;
                                        var Nascimento_Municipios_id = $$('idform_cv_f').getValues().municipio_nascimento;
                                        var Habilitacoes_Literarias_Funcionarios_id = $$('idform_cv_f').getValues().hlfNome;
                                        var fExperiencias_Profissionais = $$('idform_cv_f').getValues().fExperiencias_Profissionais;

                                        var EnderecoPais = $$("idformADDDadosOutrosCV").getValues().EnderecoPais;
                                        var EnderecoProvincia = $$("idformADDDadosOutrosCV").getValues().EnderecoProvincia;
                                        var EnderecoMunicipio = $$("idformADDDadosOutrosCV").getValues().EnderecoMunicipio;
                                        var EnderecoBairro = $$("idformADDDadosOutrosCV").getValues().EnderecoBairro;

                                        var fTelefone = $$("idformADDDadosOutrosCV").getValues().fTelefone;
                                        var fTelefone1 = $$("idformADDDadosOutrosCV").getValues().fTelefone1;
                                        var fEmail = $$("idformADDDadosOutrosCV").getValues().fEmail;
                                        //
                                        if (idf && bi) {
                                            var envio = "id=" + idf +
                                                "&fBI_Data_Emissao=" + fBI_Data_Emissao +
                                                "&fBI_Provincia_Emissao=" + fBI_Provincia_Emissao +
                                                "&fData_Nascimento=" + fData_Nascimento +
                                                "&Generos_id=" + Generos_id +
                                                "&Estado_Civil_id=" + Estado_Civil_id +
                                                "&Nacionalidade_Pais_id=" + Nacionalidade_Pais_id +
                                                "&Nascimento_Provincias_id=" + Nascimento_Provincias_id +
                                                "&Nascimento_Municipios_id=" + Nascimento_Municipios_id +
                                                "&Habilitacoes_Literarias_Funcionarios_id=" + Habilitacoes_Literarias_Funcionarios_id +
                                                "&fExperiencias_Profissionais=" + fExperiencias_Profissionais;
                                            var r = webix.ajax().sync().post(BASE_URL + "cfuncionarios/update_curriculum_dp", envio);

                                            var envio_2 = "Funcionarios_id=" + idf +
                                                "&EnderecoPais=" + EnderecoPais +
                                                "&EnderecoProvincia=" + EnderecoProvincia +
                                                "&EnderecoMunicipio=" + EnderecoMunicipio +
                                                "&EnderecoBairro=" + EnderecoBairro;
                                            var r2 = webix.ajax().sync().post(BASE_URL + "Cendereco_funcionarios/update", envio_2);

                                            var envio_3 = "Funcionarios_id=" + idf +
                                                "&fTelefone=" + fTelefone +
                                                "&fTelefone1=" + fTelefone1 +
                                                "&fEmail=" + fEmail;
                                            var r3 = webix.ajax().sync().post(BASE_URL + "Cendereco_funcionarios/update_contacto", envio_3);

                                            if (r.responseText == "true" && r2.responseText == "true" && r3.responseText == "true") {
                                                webix.message("Dados actualizados com sucesso.");
                                            }
                                        } else {
                                            webix.message({ type: "error", text: "erro ao actualizar dados." });
                                        }
                                    }
                                },
                                {
                                    view: "button", type: "form", id: "idbtn_imprimir_Pauta_Prof", value: "imprimir", disabled: false, width: 120, click: function () {
                                        //criar PDF
                                        var idSelecionado = $$('idform_cv_f').getValues().idfunc;
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
                                                PDFObject.embed("relatorios/curriculum.pdf", "#idPDFCurriculum");


                                            } else {
                                                webix.message({ type: "error", text: "Erro atualizando dados" });
                                            }

                                        } else {
                                            webix.message({ type: "error", text: "Deve selecionar um funcion&aacute;rio" });
                                        }
                                    }
                                },
                                {}
                            ]
                        }
                    ]
                },
            ]
        },
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

var formADDFormacao_Funcionarios = {
    view: "form",
    id: "idformADDFormacao_Funcionarios",
    heigth: 700,
    borderless: true,
    elements: [
        {
            cols: [
                {
                    rows: [
                        {
                            view: "combo", label: 'Localizar por BI/Passaporte', name: "BI_Passaporte", id: "idbi_formacao_funcionarios", disabled: true,/*value:1,*/options: { body: { template: "#fBI_Passaporte#", yCount: 7, url: BASE_URL + "CFuncionarios/readBI" } },
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
                        { view: "text", id: "idComboFApelido", readonly: true, disabled: true, label: 'Apelido', name: "fApelido" },
                        { view: "text", label: "Curso", name: "fofuCurso", stringResult: true, validate: "isNotEmpty", validateEvent: "blur" },
                        { view: "richselect", id: "paNome", label: 'Pa&iacute;s', name: "paNome", //value: 1, 
                            options: { 
                                body: { template: "#paNome#", yCount: 10, url: BASE_URL + "CPaises/read" } 
                            },
                            on: {
                                "onChange": function (newv, oldv) {
                                    var pa = this.getValue();
                                    if (pa) {
                                        $$("idunivNome").getList().clearAll();
                                        $$("idunivNome").getList().load(BASE_URL + "cUniversidades/read_x_pais?paNome=" + pa);
                                    }
                                }
                            }
                        },
                        
                        //{view:"text", label:"Web da Universidade", name:"ffWeb_Site_Univ", stringResult:true},
                        { view: "richselect", id: "mfNome", label: 'Modalidade Forma&ccedil;&atilde;o', name: "mfNome", value: 1, options: { body: { template: "#mfNome#", yCount: 10, url: BASE_URL + "CModalidades_Formacao/read" } } },
                        { view: "text", label: "Ano Inicio", name: "fofuAno_Inicio", stringResult: true, validate: "isNumber", validateEvent: "blur" },

                        //{view:"richselect",id:"idbolNome",label:'Bolsa',name:"bolNome",value:1,options:{body:{template:"#bolNome#",yCount:10,url: BASE_URL+"CBolsa_Funcionarios/read"}}},
                        
                    ]
                }, {
                    rows: [
                        {},
                        { view: "text", id: "idComboFNome", readonly: true, disabled: true, label: 'Nome', name: "fNome" },

                        //{view:"text", label:"Op&ccedil;&atilde;o", name:"ffOpcao", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                        { view: "text", label: "Tema da Tese", name: "fofuTema_Tese", stringResult: true, validate: "isNotEmpty", validateEvent: "blur" },
                        //{view:"text", label:"E-Mail Secretaria", name:"ffEmail_Secretaria", stringResult:true},
                        { view: "richselect", id: "gpNome", label: 'Forma&ccedil;&atilde;o', name: "gpNome", value: 1, options: { body: { template: "#gpNome#", yCount: 10, url: BASE_URL + "CGraus_Pretendidos/read" } } },
                        { view: "richselect", id: "idunivNome", label: 'Universidade', name: "univNome", value: 1, options: { body: { template: "#univNome#", yCount: 10, url: BASE_URL + "CUniversidades/read" } } },
                        
                        
                        { view: "text", label: "Nota Ponderada", name: "fofuNota", stringResult: true, validate: "isNumber", validateEvent: "blur" },
                        { view: "text", label: "Ano Fim", name: "fofuAno_Fin", stringResult: true, validate: "isNumber", validateEvent: "blur" },

                        //{view:"richselect",id:"opbNome",label:'Org&atilde;o Provendor Bolsa',name:"opbNome",value:1,options:{body:{template:"#opbNome#",yCount:10,url: BASE_URL+"COrgao_Provendor_Bolsas/read"}}},
                        
                    ]
                }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Salvar", click: function () {
                        var id = $$("idformADDFormacao_Funcionarios").getValues().BI_Passaporte;
                        var univNome = $$("idformADDFormacao_Funcionarios").getValues().univNome;
                        var fofuCurso = $$("idformADDFormacao_Funcionarios").getValues().fofuCurso;
                        var fofuAno_Inicio = $$("idformADDFormacao_Funcionarios").getValues().fofuAno_Inicio;
                        var fofuAno_Fin = $$("idformADDFormacao_Funcionarios").getValues().fofuAno_Fin;
                        var fofuTema_Tese = $$("idformADDFormacao_Funcionarios").getValues().fofuTema_Tese;
                        var gpNome = $$("idformADDFormacao_Funcionarios").getValues().gpNome;
                        var mfNome = $$("idformADDFormacao_Funcionarios").getValues().mfNome;
                        var paNome = $$("idformADDFormacao_Funcionarios").getValues().paNome;
                        var fofuNota = $$("idformADDFormacao_Funcionarios").getValues().fofuNota;

                        if (id && univNome && fofuCurso && fofuAno_Inicio && fofuAno_Fin && fofuTema_Tese && gpNome && mfNome && paNome && fofuNota) { //validate form

                            var envio = "Funcionarios_id=" + id +
                                "&univNome=" + univNome +
                                "&fofuCurso=" + fofuCurso +
                                "&fofuAno_Inicio=" + fofuAno_Inicio +
                                "&fofuAno_Fin=" + fofuAno_Fin +
                                "&fofuTema_Tese=" + fofuTema_Tese +
                                "&gpNome=" + gpNome +
                                "&mfNome=" + mfNome +
                                "&paNome=" + paNome +
                                "&fofuNota=" + fofuNota;
                            var r = webix.ajax().sync().post(BASE_URL + "cFormacao_Funcionarios/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                //$$("idDTEdFormacao_Funcionarios").load(BASE_URL + "cFormacao_Funcionarios/read");
                                //actualizar grid de formacoes
                                $$("idDTEdFormacao_Funcionarios").clearAll();
                                $$("idDTEdFormacao_Funcionarios").load(BASE_URL + "cFormacao_Funcionarios/read_x_idf?id=" + id);
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
                        $$("idwinADDFormacao_Funcionarios").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

var formADDOutras_Formacoes = {
    view: "form",
    id: "idformADDOutras_Formacoes",
    heigth: 700,
    borderless: true,
    elements: [
        {
            cols: [
                {
                    rows: [
                        /*{view:"combo",label:'Localizar por BI/Passaporte', id:"idbi_outras_formacoes1",name:"BI_Passaporte",options:{body:{template:"#fBI_Passaporte#",yCount:7,url: BASE_URL+"CFuncionarios/readBI"}},
                            on:{
                                "onChange": function(newv, oldv){
                                    var fNome = webix.ajax().sync().post(BASE_URL+"cFuncionarios/readNomeXID", "id="+this.getValue());
                                    var fApelido = webix.ajax().sync().post(BASE_URL+"cFuncionarios/readApelidoXID", "id="+this.getValue());
                                    //if(r.responseText == "true"){
                                    $$("idComboFNome").setValue(fNome.responseText);
                                    $$("idComboFApelido").setValue(fApelido.responseText);
                                }
                            }
                        },*/
                        {
                            view: "combo", label: 'Localizar por BI/Passaporte', disabled: true, name: "BI_Passaporte", id: "idbi_outras_formacoes1", disabled: true,/*value:1,*/options: { body: { template: "#fBI_Passaporte#", yCount: 7, url: BASE_URL + "CFuncionarios/readBI" } },
                            on: {
                                "onChange": function (newv, oldv) {
                                    var fNome = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readNomeXID", "id=" + this.getValue());
                                    var fApelido = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readApelidoXID", "id=" + this.getValue());
                                    //if(r.responseText == "true"){
                                    $$("idComboFNome1").setValue(fNome.responseText);
                                    $$("idComboFApelido1").setValue(fApelido.responseText);
                                }
                            }
                        },
                        { view: "text", id: "idComboFNome1", readonly: true, disabled: true, label: 'Nome', name: "fNome" },

                        { view: "text", label: "Curso", name: "ofCurso", stringResult: true, validate: "isNotEmpty", validateEvent: "blur" },
                        //{view:"richselect",id:"idunivNome",label:'Universidade',name:"univNome",value:1,options:{body:{template:"#univNome#",yCount:10,url: BASE_URL+"CUniversidades/read"}}},
                        //{view:"text", label:"Web da Universidade", name:"ffWeb_Site_Univ", stringResult:true},
                        { view: "datepicker", label: "Data Inicio", name: "ofData_Inicio", stringResult: true, validate: "isNumber", validateEvent: "blur" },

                        //{view:"richselect",id:"idbolNome",label:'Bolsa',name:"bolNome",value:1,options:{body:{template:"#bolNome#",yCount:10,url: BASE_URL+"CBolsa_Funcionarios/read"}}},
                        { view: "text", label: "Tipo de Forma&ccedil;&atilde;o", name: "ofTipo_Formacao", stringResult: true, validate: "isNotEmpty", validateEvent: "blur" },
                    ]
                }, {
                    rows: [
                        {},
                        { view: "text", id: "idComboFApelido1", readonly: true, disabled: true, label: 'Apelido', name: "fApelido" },

                        //{view:"text", label:"Op&ccedil;&atilde;o", name:"ffOpcao", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                        { view: "text", label: "Institui&ccedil;&atilde;o", name: "ofInstituicao", stringResult: true, validate: "isNotEmpty", validateEvent: "blur" },
                        //{view:"text", label:"E-Mail Secretaria", name:"ffEmail_Secretaria", stringResult:true},
                        //{view:"richselect",id:"gpNome",label:'Forma&ccedil;&atilde;o',name:"gpNome",value:1,options:{body:{template:"#gpNome#",yCount:10,url: BASE_URL+"CGraus_Pretendidos/read"}}},
                        //{view:"richselect",id:"mfNome",label:'Modalidade Forma&ccedil;&atilde;o',name:"mfNome",value:1,options:{body:{template:"#mfNome#",yCount:10,url: BASE_URL+"CModalidades_Formacao/read"}}},
                        { view: "datepicker", label: "Data Fim", name: "ofData_Fim", stringResult: true, validate: "isNumber", validateEvent: "blur" },

                        //{view:"richselect",id:"opbNome",label:'Org&atilde;o Provendor Bolsa',name:"opbNome",value:1,options:{body:{template:"#opbNome#",yCount:10,url: BASE_URL+"COrgao_Provendor_Bolsas/read"}}},
                        { view: "richselect", id: "paNome", label: 'Pa&iacute;s', name: "paNome", value: 1, options: { body: { template: "#paNome#", yCount: 10, url: BASE_URL + "CPaises/read" } } },

                    ]
                }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Salvar", click: function () {
                        var id = $$("idformADDOutras_Formacoes").getValues().BI_Passaporte;
                        var ofCurso = $$("idformADDOutras_Formacoes").getValues().ofCurso;
                        var ofData_Inicio = $$("idformADDOutras_Formacoes").getValues().ofData_Inicio;
                        var ofData_Fim = $$("idformADDOutras_Formacoes").getValues().ofData_Fim;
                        var ofInstituicao = $$("idformADDOutras_Formacoes").getValues().ofInstituicao;
                        var ofTipo_Formacao = $$("idformADDOutras_Formacoes").getValues().ofTipo_Formacao;
                        var paNome = $$("idformADDOutras_Formacoes").getValues().paNome;

                        if (id && ofCurso && ofData_Inicio && ofData_Fim && ofInstituicao && ofTipo_Formacao && paNome) { //validate form

                            var envio = "Funcionarios_id=" + id +
                                "&ofCurso=" + ofCurso +
                                "&ofData_Inicio=" + ofData_Inicio +
                                "&ofData_Fim=" + ofData_Fim +
                                "&ofInstituicao=" + ofInstituicao +
                                "&ofTipo_Formacao=" + ofTipo_Formacao +
                                "&paNome=" + paNome;
                            var r = webix.ajax().sync().post(BASE_URL + "cOutras_Formacoes/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                $$("idDTEdOutras_Formacoes").load(BASE_URL + "cOutras_Formacoes/read_x_id?id=" + $$('idform_cv_f').getValues().idfunc);
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
                        $$("idwinADDOutras_Formacoes").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

//Adicionar Publicacoes
var formADDPublicacoes = {
    view: "form",
    id: "idformADDPublicacoes",
    heigth: 700,
    borderless: true,
    elements: [
        {
            cols: [
                {
                    rows: [
                        {
                            view: "combo", label: 'Localizar por BI/Passaporte', name: "BI_Passaporte", id: "id_bi_publicacoes", disabled: true, options: { body: { template: "#fBI_Passaporte#", yCount: 7, url: BASE_URL + "CFuncionarios/readBI" } },
                            on: {
                                "onChange": function (newv, oldv) {
                                    var fNome = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readNomeXID", "id=" + this.getValue());
                                    var fApelido = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readApelidoXID", "id=" + this.getValue());
                                    //if(r.responseText == "true"){
                                    $$("idComboFNomeP").setValue(fNome.responseText);
                                    $$("idComboFApelidoP").setValue(fApelido.responseText);
                                }
                            }
                        },
                        { view: "text", id: "idComboFApelidoP", readonly: true, disabled: true, label: 'Apelido', name: "fApelido" },

                        { view: "text", label: "Titulo", name: "pubTitulo", stringResult: true, validate: "isNotEmpty", validateEvent: "blur" },
                        //{view:"richselect",id:"idunivNome",label:'Universidade',name:"univNome",value:1,options:{body:{template:"#univNome#",yCount:10,url: BASE_URL+"CUniversidades/read"}}},

                        { view: "text", label: "Ano", name: "pubAno", stringResult: true, validate: "isNumber", validateEvent: "blur" },

                        //{view:"richselect",id:"idbolNome",label:'Bolsa',name:"bolNome",value:1,options:{body:{template:"#bolNome#",yCount:10,url: BASE_URL+"CBolsa_Funcionarios/read"}}},
                        { view: "richselect", id: "paNome", label: 'Pa&iacute;s', name: "paNome", value: 1, options: { body: { template: "#paNome#", yCount: 10, url: BASE_URL + "CPaises/read" } } },
                    ]
                }, {
                    rows: [
                        {},
                        { view: "text", id: "idComboFNomeP", readonly: true, disabled: true, label: 'Nome', name: "fNome" },
                        { view: "text", label: "Editora/Revista", name: "pubEditora_Revista", stringResult: true },
                        //{view:"text", label:"Op&ccedil;&atilde;o", name:"ffOpcao", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                        { view: "text", label: "ISBN/ISSN", name: "pubISBN_ISSN", stringResult: true, validate: "isNotEmpty", validateEvent: "blur" },
                        //{view:"text", label:"E-Mail Secretaria", name:"ffEmail_Secretaria", stringResult:true},
                        { view: "richselect", id: "idtpubNome", label: 'Tipo de Publica&ccedil;&atilde;o', name: "tpubNome", value: 1, options: { body: { template: "#tpubNome#", yCount: 10, url: BASE_URL + "CTipo_Publicacoes/read" } } },
                        //{view:"richselect",id:"mfNome",label:'Modalidade Forma&ccedil;&atilde;o',name:"mfNome",value:1,options:{body:{template:"#mfNome#",yCount:10,url: BASE_URL+"CModalidades_Formacao/read"}}},
                        //{view:"text", label:"Ano de Fin", name:"fofuAno_Fin", stringResult:true ,validate:"isNumber", validateEvent:"blur"},

                        //{view:"richselect",id:"opbNome",label:'Org&atilde;o Provendor Bolsa',name:"opbNome",value:1,options:{body:{template:"#opbNome#",yCount:10,url: BASE_URL+"COrgao_Provendor_Bolsas/read"}}},
                        //{view:"text", label:"Nota Ponderada", name:"fofuNota", stringResult:true ,validate:"isNumber", validateEvent:"blur"},
                    ]
                }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Salvar", click: function () {
                        var id = $$("idformADDPublicacoes").getValues().BI_Passaporte;
                        var pubTitulo = $$("idformADDPublicacoes").getValues().pubTitulo;
                        var pubAno = $$("idformADDPublicacoes").getValues().pubAno;
                        var pubEditora_Revista = $$("idformADDPublicacoes").getValues().pubEditora_Revista;
                        var pubISBN_ISSN = $$("idformADDPublicacoes").getValues().pubISBN_ISSN;
                        var tpubNome = $$("idformADDPublicacoes").getValues().tpubNome;
                        var paNome = $$("idformADDPublicacoes").getValues().paNome;

                        if (id && pubTitulo && pubAno && pubEditora_Revista && pubISBN_ISSN && tpubNome && paNome) { //validate form

                            var envio = "Funcionarios_id=" + id +
                                "&pubTitulo=" + pubTitulo +
                                "&pubAno=" + pubAno +
                                "&pubEditora_Revista=" + pubEditora_Revista +
                                "&pubISBN_ISSN=" + pubISBN_ISSN +
                                "&tpubNome=" + tpubNome +
                                "&paNome=" + paNome;
                            var r = webix.ajax().sync().post(BASE_URL + "cPublicacoes/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                //$$("idDTEdPublicacoes").load(BASE_URL+"cPublicacoes/read");
                                //actualizar grid de publicacoes
                                $$("idDTEdPublicacoes").clearAll();
                                $$("idDTEdPublicacoes").load(BASE_URL + "cPublicacoes/read_x_id?id=" + id);
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
                        $$("idwinADDPublicacoes").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

//Adicionar Eventos
var formADDEventos = {
    view: "form",
    id: "idformADDEventos",
    heigth: 700,
    borderless: true,
    elements: [
        {
            cols: [
                {
                    rows: [
                        {
                            view: "combo", label: 'Localizar por BI/Passaporte', name: "BI_Passaporte", id: "id_bi_eventos", disabled: true, options: { body: { template: "#fBI_Passaporte#", yCount: 7, url: BASE_URL + "CFuncionarios/readBI" } },
                            on: {
                                "onChange": function (newv, oldv) {
                                    var fNome = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readNomeXID", "id=" + this.getValue());
                                    var fApelido = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readApelidoXID", "id=" + this.getValue());
                                    //if(r.responseText == "true"){
                                    $$("idComboFNomeE").setValue(fNome.responseText);
                                    $$("idComboFApelidoE").setValue(fApelido.responseText);
                                }
                            }
                        },
                        { view: "text", id: "idComboFNomeE", readonly: true, disabled: true, label: 'Nome', name: "fNome" },
                        { view: "text", label: "Titulo", name: "evTitulo", stringResult: true, validate: "isNotEmpty", validateEvent: "blur" },
                        { view: "text", label: "Ano", name: "evAno", stringResult: true, validate: "isNumber", validateEvent: "blur" },
                        { view: "richselect", id: "teNome", label: 'Tipo de Evento', name: "teNome", value: 1, options: { body: { template: "#teNome#", yCount: 10, url: BASE_URL + "CTipo_Eventos/read" } } },

                    ]
                }, {
                    rows: [
                        {},
                        { view: "text", id: "idComboFApelidoE", readonly: true, disabled: true, label: 'Apelido', name: "fApelido" },
                        { view: "text", label: "Institui&ccedil;&atilde;o", name: "evInstituicao", stringResult: true, validate: "isNotEmpty", validateEvent: "blur" },
                        { view: "richselect", id: "paNome", label: 'Pa&iacute;s', name: "paNome", value: 1, options: { body: { template: "#paNome#", yCount: 10, url: BASE_URL + "CPaises/read" } } },
                        {}
                    ]
                }
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Salvar", click: function () {
                        var id = $$("idformADDEventos").getValues().BI_Passaporte;
                        var evTitulo = $$("idformADDEventos").getValues().evTitulo;
                        var evAno = $$("idformADDEventos").getValues().evAno;
                        var evInstituicao = $$("idformADDEventos").getValues().evInstituicao;
                        var teNome = $$("idformADDEventos").getValues().teNome;
                        var paNome = $$("idformADDEventos").getValues().paNome;

                        if (id && evTitulo && evAno && evInstituicao && teNome && paNome) { //validate form

                            var envio = "Funcionarios_id=" + id +
                                "&evTitulo=" + evTitulo +
                                "&evAno=" + evAno +
                                "&evInstituicao=" + evInstituicao +
                                "&teNome=" + teNome +
                                "&paNome=" + paNome;
                            var r = webix.ajax().sync().post(BASE_URL + "cEventos/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                //$$("idDTEdEventos").load(BASE_URL+"cEventos/read");
                                $$("idDTEdEventos").clearAll();
                                $$("idDTEdEventos").load(BASE_URL + "CEventos/read_x_id?id=" + id);
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
                        $$("idwinADDEventos").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

//Adicionar Linguas_Funcionarios
var formADDLinguas_Funcionarios = {
    view: "form",
    id: "idformADDLinguas_Funcionarios",
    heigth: 700,
    borderless: true,
    elements: [
        {
            cols: [
                {
                    rows: [
                        {
                            view: "combo", label: 'Localizar por BI/Passaporte', name: "BI_Passaporte", id: "id_bi_linguas", disabled: true, options: { body: { template: "#fBI_Passaporte#", yCount: 7, url: BASE_URL + "CFuncionarios/readBI" } },
                            on: {
                                "onChange": function (newv, oldv) {
                                    var fNome = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readNomeXID", "id=" + this.getValue());
                                    var fApelido = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readApelidoXID", "id=" + this.getValue());
                                    //if(r.responseText == "true"){
                                    $$("idComboFNomeL").setValue(fNome.responseText);
                                    $$("idComboFApelidoL").setValue(fApelido.responseText);
                                }
                            }
                        },
                        { view: "text", id: "idComboFNomeL", readonly: true, disabled: true, label: 'Nome', name: "fNome" },

                        { view: "richselect", id: "linNome", label: 'L&iacute;ngua', name: "linNome", value: 1, options: { body: { template: "#linNome#", yCount: 10, url: BASE_URL + "CLinguas/read" } } },
                    ]
                }, {
                    rows: [
                        {},
                        { view: "text", id: "idComboFApelidoL", readonly: true, disabled: true, label: 'Apelido', name: "fApelido" },

                        { view: "richselect", id: "lnNome", label: 'N&iacute;vel', name: "lnNome", value: 1, options: { body: { template: "#lnNome#", yCount: 10, url: BASE_URL + "CLinguas_Nivel/read" } } },
                    ]
                }
            ]
        },
        {
            cols: [
                {
                    view: "button", value: "Salvar", click: function () {
                        var id = $$("idformADDLinguas_Funcionarios").getValues().BI_Passaporte;
                        var linNome = $$("idformADDLinguas_Funcionarios").getValues().linNome;
                        var lnNome = $$("idformADDLinguas_Funcionarios").getValues().lnNome;

                        if (id && linNome && lnNome) { //validate form

                            var envio = "Funcionarios_id=" + id +
                                "&linguas_id=" + linNome +
                                "&linguas_nivel_id=" + lnNome;
                            var r = webix.ajax().sync().post(BASE_URL + "cLinguas_Funcionarios/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                this.getTopParentView().hide(); //hide window
                                //$$("idDTEdLinguas_Funcionarios").load(BASE_URL+"cLinguas_Funcionarios/read");
                                //actualizar grid de Linguas
                                $$("idDTEdLinguas_Funcionarios").clearAll();
                                $$("idDTEdLinguas_Funcionarios").load(BASE_URL + "CLinguas_Funcionarios/read_x_id?id=" + id);
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
                        $$("idwinADDLinguas_Funcionarios").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};