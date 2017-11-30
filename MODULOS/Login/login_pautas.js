var form = {
    view: "form",
    id: "idformLogin_pautas",
    borderless: true,
    elements: [
        { view: "text", label: 'Usu&aacute;rio', name: "login" },
        { view: "text", label: 'Senha', name: "senha", type: "password" },
        {
            view: "button", value: "Entrar", hotkey: "enter", click: function () {
                if (this.getParentView().validate()) { //validate form
                    var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/validar", "action=login&login=" + $$("idformLogin_pautas").getValues().login + "&senha=" + $$("idformLogin_pautas").getValues().senha);
                    if (r.responseText == "true") {
                        this.getTopParentView().hide(); //hide window
                        var r2 = webix.ajax().sync().post(BASE_URL + "cutilizadores/Existe_ProfXUsuario", "login=" + $$("idformLogin_pautas").getValues().login);
                        if (r2.responseText == "true") {
                            webix.message("A carregar Pautas Professor...");
                            //cargar windows com combo pa seleccionar disciplina y Pautas
                            webix.ui({
                                view: "window",
                                id: "idwin_Pautas_Professores",
                                width: 1200,
                                height: 700,
                                position: "center",
                                modal: true,
                                //head: "Pautas Professores",
                                head: {
                                    view: "toolbar", cols: [
                                        { view: "label", label: "Pautas Professores" },
                                        { view: "button", type: "danger", label: 'X', width: 50, align: 'right', click: function(){//"$$('idwin_Pautas_Professores').close();" }
                                            $$('idwin_Pautas_Professores').close();
                                            var redirect = BASE_URL + 'welcome/logout';
                                            window.location = redirect;
                                        }}
                                    ]
                                },
                                body: webix.copy(form__Pautas_Professores)
                            }).show();
                            //cargar datos
                            //read_DiscXProf
                            var r3 = webix.ajax().sync().post(BASE_URL + "cutilizadores/Get_ProfXUsuario", "login=" + $$("idformLogin_pautas").getValues().login);

                            //id del usuario que se logueo
                            $$('id_usuario').setValue(r3.responseText);
                            //nome usuario
                            $$('usuario').setValue($$("idformLogin_pautas").getValues().login);

                            $$("id_cb_pp").getList().clearAll();
                            $$("id_cb_pp").getList().load(BASE_URL + "cprofessores_disciplinas/read_DiscXProf?id=" + r3.responseText);
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
                $$("idformLogin_pautas").clear();
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
    id: "winLoginSGI_pautas",
    width: 300,
    position: "center",
    modal: false,
    head: "Dados de Usu&aacute;rio",
    //body:webix.copy(form)
    body: form
});

var form__Pautas_Professores = {
    view: "form",
    id: "idform__Pautas_Professores",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "form", rows: [
                        {
                            view: "form", rows: [
                                {
                                    rows: [
                                        {
                                            cols: [
                                                {
                                                    view: "text", width: 80, id: "idLI_CB_alAno_pp",
                                                    label: 'Ano Lec.', name: "alAno",
                                                    labelPosition: "top",
                                                    disabled: true,
                                                },
                                                {
                                                    view: "text", width: 200, id: "idLI_CB_nNome_pp",
                                                    label: 'Nivel', name: "nNome",
                                                    labelPosition: "top",
                                                    disabled: true,
                                                },
                                                {
                                                    view: "text", width: 500, id: "idLI_CB_cNome_pp",
                                                    label: 'Curso', name: "cNome",
                                                    labelPosition: "top",
                                                    disabled: true,
                                                },
                                                {}
                                            ]
                                        },
                                        {
                                            cols: [

                                                {
                                                    view: "text", width: 125, id: "idLI_CB_pNome_pp",
                                                    label: 'Periodo', name: "pNome",
                                                    labelPosition: "top",
                                                    disabled: true,
                                                },
                                                {
                                                    view: "text", width: 100, id: "idLI_CB_acNome_pp",
                                                    label: 'Ano Curricular', name: "acNome",
                                                    labelPosition: "top",
                                                    disabled: true,
                                                },
                                                {
                                                    view: "richselect", width: 370, id: "id_cb_pp",
                                                    label: 'Disciplina', name: "dNome",
                                                    labelPosition: "top",
                                                    options: {
                                                        body: {
                                                            template: "#dNome#",
                                                            yCount: 7,
                                                            url: BASE_URL + "CDisciplinas/read"
                                                        }
                                                    },
                                                    on: {
                                                        "onChange": function (newv, oldv) {
                                                            var d = $$("id_cb_pp").getValue();
                                                            if (d) {
                                                                //ano_lectivo
                                                                var r2 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_ano_lectivo", "idd=" + d + "&idp=" + $$('id_usuario').getValue());
                                                                $$('idLI_CB_alAno_pp').setValue(r2.responseText);
                                                                //Nivel
                                                                var r3 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_nivel", "idd=" + d + "&idp=" + $$('id_usuario').getValue());
                                                                $$('idLI_CB_nNome_pp').setValue(r3.responseText);
                                                                //Curso
                                                                var r4 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_curso", "idd=" + d + "&idp=" + $$('id_usuario').getValue());
                                                                $$('idLI_CB_cNome_pp').setValue(r4.responseText);
                                                                //Periodo
                                                                var r5 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_periodo", "idd=" + d + "&idp=" + $$('id_usuario').getValue());
                                                                $$('idLI_CB_pNome_pp').setValue(r5.responseText);
                                                                //Ano Curricular
                                                                var r6 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_ano_curricular", "idd=" + d + "&idp=" + $$('id_usuario').getValue());
                                                                $$('idLI_CB_acNome_pp').setValue(r6.responseText);
                                                                //activar exportar pauta excel
                                                                $$('idbtn_Exportar_Pauta_Prof').enable();
                                                            }
                                                        }
                                                    }
                                                },

                                                {
                                                    view: "button", type: "form", value: "Pesquisar", width: 110, click: function () {
                                                        var al = $$("idLI_CB_alAno_pp").getValue();
                                                        var n = $$("idLI_CB_nNome_pp").getValue();
                                                        var c = $$("idLI_CB_cNome_pp").getValue();
                                                        var p = $$("idLI_CB_pNome_pp").getValue();
                                                        var ac = $$("idLI_CB_acNome_pp").getValue();
                                                        var d = $$("id_cb_pp").getValue();

                                                        if (al && n && c && p && ac && d) {
                                                            $$("idDTpp").clearAll();
                                                            $$("idDTpp").load(BASE_URL + "cpautas/readXdisciplina_login_pautas?n=" + n + "&c=" + c + "&p=" + p + "&al=" + al + "&d=" + d + "&al=" + al);
                                                        } else
                                                            webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });

                                                    }
                                                },
                                                { view: "label", name: "usuario", id: "id_usuario", width: 110, hidden: true },
                                                { view: "label", name: "usuario nome", id: "usuario", hidden: true },
                                                {}
                                            ]
                                        }
                                    ]

                                }
                            ]


                        },
                    ]

                }, {
                    view: "form", rows: [
                        {
                            cols: [
                                {
                                    view: "button", type: "danger", value: "Editar Notas", width: 100, click: function () {
                                        var idSelecionado = $$("idDTpp").getSelectedId(false, true);
                                        if (idSelecionado) {
                                            webix.ui({
                                                view: "window",
                                                id: "id_win_pp",
                                                width: 300,
                                                position: "center",
                                                modal: true,
                                                head: "Editar Notas",
                                                body: webix.copy(formED_login_pp)
                                            }).show();
                                            //cargar el id del estudiante
                                            $$("id_text_ide").setValue(idSelecionado);

                                            var record = $$("idDTpp").getItem(idSelecionado);

                                            //ver si activar los componentes o no
                                            var rpp1 = webix.ajax().sync().post(BASE_URL + "Ccalendarios_avaliacoes/pertenece", "ava_nome=" + "pp1");
                                            if(rpp1.responseText == "true")
                                                $$('id_text_PP1').enable();
                                            var rpp2 = webix.ajax().sync().post(BASE_URL + "Ccalendarios_avaliacoes/pertenece", "ava_nome=" + "pp2");
                                            if(rpp2.responseText == "true")
                                                $$('id_text_PP2').enable();
                                            var rpp3 = webix.ajax().sync().post(BASE_URL + "Ccalendarios_avaliacoes/pertenece", "ava_nome=" + "pp3");
                                            //ver si la disc e semestral o anual para desabilitar
                                            var rdd = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_duracao_x_id", "id=" + record.did);
                                            if(rpp3.responseText == "true" && rdd.responseText == "Anual")
                                                $$('id_text_PP3').enable();
                                            var ref = webix.ajax().sync().post(BASE_URL + "Ccalendarios_avaliacoes/pertenece", "ava_nome=" + "ef");
                                            if(ref.responseText == "true")
                                                $$('id_text_EF').enable();
                                            var rrecurso = webix.ajax().sync().post(BASE_URL + "Ccalendarios_avaliacoes/pertenece", "ava_nome=" + "recurso");
                                            if(rrecurso.responseText == "true")
                                                $$('id_text_Recurso').enable();
                                            var respecial = webix.ajax().sync().post(BASE_URL + "Ccalendarios_avaliacoes/pertenece", "ava_nome=" + "especial");
                                            if(respecial.responseText == "true")
                                                $$('id_text_Especial').enable();
                                            //
                                            $$('id_text_Nome').setValue(record.cNome);
                                            $$('id_text_Apelido').setValue(record.cApelido);
                                            $$('id_text_BI').setValue(record.cBI_Passaporte);
                                            $$('id_text_PP1').setValue(record.pp1);
                                            $$('id_text_PP2').setValue(record.pp2);
                                            $$('id_text_PP3').setValue(record.pp3);
                                            $$('id_text_EF').setValue(record.ef);
                                            $$('id_text_Recurso').setValue(record.recurso);
                                            $$('id_text_Especial').setValue(record.especial);
                                            $$('id_text_did').setValue(record.did);

                                        } else {
                                            webix.message({ type: "error", text: "Deve selecionar primeriro um estudante" });
                                        }
                                    }
                                },
                                {
                                    view: "button", type: "form", id: "idbtn_Exportar_Pauta_Prof", value: "Exportar Pauta", disabled: true, width: 120, click: function () {
                                        var al = $$("idLI_CB_alAno_pp").getValue();
                                        var n = $$("idLI_CB_nNome_pp").getValue();
                                        var c = $$("idLI_CB_cNome_pp").getValue();
                                        var p = $$("idLI_CB_pNome_pp").getValue();
                                        var ac = $$("idLI_CB_acNome_pp").getValue();
                                        var idd = $$("id_cb_pp").getValue();
                                        var d = $$("id_cb_pp").getText();

                                        if (al && n && c && p && ac && d) {
                                            //get codigo disciplina
                                            var r1 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_codigo", "idd=" + idd);
                                            var cod = r1.responseText;
                                            //
                                            var r2 = webix.ajax().sync().post(BASE_URL + "CDisciplinas_Geracao/get_dgnome", "idd=" + idd);
                                            var g = r2.responseText;
                                            /*
                                            var envio = "al=" + al +
                                                "&n=" + n +
                                                "&c=" + c +
                                                "&p=" + p +
                                                "&ac=" + ac +
                                                "&d=" + d +
                                                "&cod=" + cod +
                                                "&g=" + g;
                                                */
                                            //var r = webix.ajax().sync().get(BASE_URL + "cpauta_professor/exportar", envio);
                                            var env = [];
                                            env["al"] = al;
                                            env["n"] = n;
                                            env["c"] = c;
                                            env["p"] = p;
                                            env["ac"] = ac;
                                            env["idd"] = idd;
                                            env["d"] = d;
                                            env["cod"] = cod;
                                            env["g"] = g;
                                            webix.send(BASE_URL + "cpauta_professor/exportar", env, "GET");
                                        } else
                                            webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });

                                    }
                                },
                                {
                                    view: "uploader", label: 'Importar Pauta', type: "standard", icon: "upload",
                                    name: "files", //accept: "application/vnd.ms-excel",
                                    width: 150,
                                    /*link: "mylist",*/ upload: BASE_URL + "cpauta_professor/importar"
                                },
                                {
                                    view: "button", type: "form", id: "idbtn_imprimir_Pauta_Prof", value: "imprimir", disabled: false, width: 120, click: function () {
                                        var al = $$("idLI_CB_alAno_pp").getValue();
                                        var n = $$("idLI_CB_nNome_pp").getValue();
                                        var c = $$("idLI_CB_cNome_pp").getValue();
                                        var p = $$("idLI_CB_pNome_pp").getValue();
                                        var ac = $$("idLI_CB_acNome_pp").getValue();
                                        var idd = $$("id_cb_pp").getValue();
                                        var d = $$("id_cb_pp").getText();

                                        if (al && n && c && p && ac && d) {
                                            //get codigo disciplina
                                            var r1 = webix.ajax().sync().post(BASE_URL + "CDisciplinas/read_codigo", "idd=" + idd);
                                            var cod = r1.responseText;
                                            //
                                            var r2 = webix.ajax().sync().post(BASE_URL + "CDisciplinas_Geracao/get_dgnome", "idd=" + idd);
                                            var g = r2.responseText;
                                            //
                                            var envio = "al=" + al + "&n=" + n + "&c=" + c + "&p=" + p + "&ac=" + ac + "&idd=" + idd + "&d=" + d;
                                            var r = webix.ajax().sync().post(BASE_URL + "Cpautas_professores_imp/imprimir", envio);
                                            if (r.responseText == "true") {
                                                webix.message("PDF criado com sucesso");
                                                //Carregar PDF
                                                webix.ui({
                                                    view: "window",
                                                    id: "idWinPDF_login_pauta_prof",
                                                    height: 600,
                                                    width: 950,
                                                    left: 50, top: 50,
                                                    move: true,
                                                    modal: true,
                                                    //head:"This window can be moved",
                                                    head: {
                                                        view: "toolbar", cols: [
                                                            { view: "label", label: "Imprimir" },
                                                            { view: "button", label: 'X', width: 50, align: 'right', click: "$$('idWinPDF_login_pauta_prof').close();" }
                                                        ]
                                                    },
                                                    body: {
                                                        //template:"Some text"
                                                        template: '<div id="idPDF_login_pauta_prof" style="width:940px;  height:590px"></div>'
                                                    }
                                                }).show();
                                                PDFObject.embed("./relatorios/pauta_professor.pdf", "#idPDF_login_pauta_prof");


                                            } else {
                                                webix.message({ type: "error", text: "Erro ao imprimir dados" });
                                            }

                                        }
                                    },
                                },
                                {}
                            ]
                        }
                    ]
                },
                {
                    view: "datatable",
                    id: "idDTpp",
                    select: "row", /*editable: true, editaction: "click",*/
                    editable: false,
                    columns: [
                        { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                        { id: "did", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                        { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                        //{ id: "eData_Matricula", header: "Data Mat.", css: "rank", width: 60, sort: "int" },
                        { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                        { id: "cNomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                        { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                        { id: "cBI_Passaporte", header: ["BI-Pass.", { content: "textFilter" }], width: 140, sort: "strig" },

                        //{ id: "dNome", header: ["Disciplina", { content: "textFilter" }], width: 170, sort: "string" },
                        { id: "pp1", header: ["pp1", { content: "textFilter" }], width: 55, sort: "int" },
                        { id: "pp2", header: ["pp2", { content: "textFilter" }], width: 55, sort: "int" },
                        { id: "pp3", header: ["pp3", { content: "textFilter" }], width: 55, sort: "int" },
                        { id: "mp", header: ["mp", { content: "textFilter" }], width: 55, sort: "int" },
                        { id: "ef", header: ["ef", { content: "textFilter" }], width: 55, sort: "int" },
                        { id: "mf", header: ["mf", { content: "textFilter" }], width: 55, sort: "int" },
                        { id: "recurso", header: ["recurso", { content: "textFilter" }], width: 80, sort: "int" },
                        { id: "especial", header: ["especial", { content: "textFilter" }], width: 80, sort: "int" },
                        {
                            id: "estado", header: ["Estado", { content: "selectFilter" }], width: 100, sort: "string",
                            template: function (obj) {
                                if (obj.estado == "Reprovado")
                                    return "<span style='color:red;'>" + obj.estado + "</span>";
                                else
                                    return "<span style='color:green;'>" + obj.estado + "</span>";

                            },
                        },
                    ],
                    resizeColumn: true,
                    //url: BASE_URL + "cpautas/read",
                    pager: "pagercp"
                }, {
                    view: "pager", id: "pagercp",
                    template: "{common.prev()} {common.pages()} {common.next()}",
                    size: 25,
                    group: 10
                }
            ]
        },
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

var formED_login_pp = {
    view: "form",
    id: "idformED_login_pp",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'id', hidden: true, id: "id_text_ide", name: "uid" },
                { view: "text", label: 'did', hidden: true, id: "id_text_did", name: "uid" },
                { view: "text", label: 'Nome', id: "id_text_Nome", name: "cNome", disabled: true },
                { view: "text", label: 'Apelido', id: "id_text_Apelido", name: "cApelido", disabled: true },
                { view: "text", label: 'BI/Passaporte', id: "id_text_BI", name: "cBI_Passaporte", disabled: true },
                { view: "text", label: 'PP1', id: "id_text_PP1", disabled:true, name: "pp1" },
                { view: "text", label: 'PP2', id: "id_text_PP2", disabled:true, name: "pp2" },
                { view: "text", label: 'PP3', id: "id_text_PP3", disabled:true, name: "pp3" },
                { view: "text", label: 'EF', id: "id_text_EF", disabled:true, name: "ef" },
                { view: "text", label: 'Recurso', id: "id_text_Recurso", disabled:true, name: "recurso" },
                { view: "text", label: 'Especial', id: "id_text_Especial", disabled:true, name: "especial" },
            ]

        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var ide = $$("id_text_ide").getValue(); //esto es id de la pauta
                        var idd = $$("id_text_did").getValue();
                        var pp1 = ($$("id_text_PP1").getValue()) ? $$("id_text_PP1").getValue() : 0;
                        var pp2 = ($$("id_text_PP2").getValue()) ? $$("id_text_PP2").getValue() : 0;
                        var pp3 = ($$("id_text_PP3").getValue()) ? $$("id_text_PP3").getValue() : 0;
                        var ef = ($$("id_text_EF").getValue()) ? $$("id_text_EF").getValue() : 0;
                        var recurso = ($$("id_text_Recurso").getValue()) ? $$("id_text_Recurso").getValue() : 0;
                        var especial = ($$("id_text_Especial").getValue()) ? $$("id_text_Especial").getValue() : 0;

                        var cnome = $$("id_text_Nome").getValue();
                        var capelido = $$("id_text_Apelido").getValue();

                        //ver nombre de la disc actualizada
                        var rd = webix.ajax().sync().post(BASE_URL + "CDisciplinas/readX", "id="+$$('id_text_did').getValue());
                        var disc_nome = rd.responseText;
                        //ver nombre del est actualizado
                        //var re = webix.ajax().sync().post(BASE_URL + "CEstudantes/readX", "id="+$$('id_text_ide').getValue());
                        //var est_nome = re.responseText;

                        if (ide && !isNaN(pp1) && !isNaN(pp2) && !isNaN(pp3) && !isNaN(ef) && !isNaN(recurso) && !isNaN(especial)) { //validate form
                            var envio = "id=" + ide +
                                "&pp1=" + pp1 +
                                "&pp2=" + pp2 +
                                "&pp3=" + pp3 +
                                "&ef=" + ef +
                                "&recurso=" + recurso +
                                "&especial=" + especial +
                                "&idd=" + idd +
                                "&usuario=" + $$('usuario').getValue() +
                                "&dnome=" + disc_nome +
                                "&enome=" + cnome + ' ' + capelido;
                            var r = webix.ajax().sync().post(BASE_URL + "cpautas/update", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados actualizados com sucesso");
                                //$$("idDTpp").load(BASE_URL + "cpautas/read");
                                //actualizar
                                var al = $$("idLI_CB_alAno_pp").getValue();
                                var n = $$("idLI_CB_nNome_pp").getValue();
                                var c = $$("idLI_CB_cNome_pp").getValue();
                                var p = $$("idLI_CB_pNome_pp").getValue();
                                var ac = $$("idLI_CB_acNome_pp").getValue();
                                var d = $$("id_cb_pp").getValue();

                                if (al && n && c && p && ac && d) {
                                    $$("idDTpp").clearAll();
                                    $$("idDTpp").load(BASE_URL + "cpautas/readXdisciplina_login_pautas?n=" + n + "&c=" + c + "&p=" + p + "&al=" + al + "&d=" + d + "&al=" + al);
                                } else
                                    webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });
                                //
                                $$("id_win_pp").close();
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
                        $$("id_win_pp").close();
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