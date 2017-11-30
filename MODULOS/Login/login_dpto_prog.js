var formLogin_dpto_prog = {
    view: "form",
    id: "idformLogin_dpto_prog",
    borderless: true,
    elements: [
        { view: "text", label: 'Usu&aacute;rio', name: "login" },
        { view: "text", label: 'Senha', name: "senha", type: "password" },
        {
            view: "button", value: "Entrar", hotkey: "enter", click: function () {
                if (this.getParentView().validate()) { //validate form
                    var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/validar", "action=login&login=" + $$("idformLogin_dpto_prog").getValues().login + "&senha=" + $$("idformLogin_dpto_prog").getValues().senha);
                    if (r.responseText == "true") {
                        this.getTopParentView().hide(); //hide window
                        var r2 = webix.ajax().sync().post(BASE_URL + "Cchefes_departamentos_utilizadores/dt_se_chefe_departamento", "login=" + $$("idformLogin_dpto_prog").getValues().login);
                        if (r2.responseText == "true") {
                            webix.message("A carregar programas...");
                            //cargar windows com combo pa seleccionar disciplina y Pautas
                            webix.ui({
                                view: "window",
                                id: "idwin_dpto_prog",
                                width: 1200,
                                height: 600,
                                position: "center",
                                modal: true,
                                //head: "Pautas Professores",
                                head: {
                                    view: "toolbar", cols: [
                                        { view: "label", label: "Programas Departamento" },
                                        {
                                            view: "button", type: "danger", label: 'X', width: 50, align: 'right', click: function () {//"$$('idwin_Pautas_Professores').close();" }
                                                $$('idwin_dpto_prog').close();
                                                var redirect = BASE_URL + 'welcome/logout';
                                                window.location = redirect;
                                            }
                                        }
                                    ]
                                },
                                body: webix.copy(form_dpto_prog)
                            }).show();
                            //cargar datos
                            //read_DiscXProf
                            //var r3 = webix.ajax().sync().post(BASE_URL + "cutilizadores/Get_ProfXUsuario", "login=" + $$("idformLogin_dpto_prog").getValues().login);

                            //id del usuario que se logueo
                            //$$('id_usuario_dpto_prog').setValue(r3.responseText);
                            //nome usuario
                            //$$('usuario_dpto_prog').setValue($$("idformLogin_dpto_prog").getValues().login);

                            var r_idu = webix.ajax().sync().post(BASE_URL + "cutilizadores/getid", "login=" + $$("idformLogin_dpto_prog").getValues().login);
                            var r_dpto = webix.ajax().sync().post(BASE_URL + "Cchefes_departamentos_utilizadores/read_dpto_id", "idu=" + r_idu.responseText);
                            //actualizar nivels por dpto
                            $$("idLI_CB_nNome_ld").getList().clearAll();
                            $$("idLI_CB_nNome_ld").getList().load(BASE_URL + "cniveis/read_dpto?dpto=" + r_dpto.responseText);
                            //actualizar cursos por dpto
                            $$("idLI_CB_cNome_ld").getList().clearAll();
                            $$("idLI_CB_cNome_ld").getList().load(BASE_URL + "ccursos/read_dpto?dpto=" + r_dpto.responseText);
                            //$$("idLI_CB_nNome_ld").getList().load(BASE_URL + "cdisciplinas/read_dpto?dpto=" + r_dpto.responseText);

                        } else
                            webix.message({ type: "error", text: "Usuário incorretos, não é chefe de departamento" });

                    } else
                        webix.message({ type: "error", text: "Dados incorretos" });
                }
                else
                    webix.message({ type: "error", text: "Dados incorretos" });
            }
        },
        {
            view: "button", value: "Cancel", name: "cancel", type: "danger", click: function () {
                $$("idformLogin_dpto_prog").clear();
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
    id: "winLogin_dpto_prog",
    width: 300,
    position: "center",
    modal: false,
    head: "Dados de Usu&aacute;rio",
    //body:webix.copy(form)
    body: formLogin_dpto_prog
});

var form_dpto_prog = {
    view: "form",
    id: "idform_dpto_prog",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "form", rows: [
                        {
                            rows: [
                                {
                                    cols: [
                                        {
                                            view: "richselect", width: 200, id: "idLI_CB_nNome_ld",
                                            label: 'Nivel', name: "nNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#nNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cNiveis/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {

                                                    var n = $$("idLI_CB_nNome_ld").getValue();
                                                    var c = $$("idLI_CB_cNome_ld").getValue();
                                                    var p = $$("idLI_CB_pNome_ld").getValue();
                                                    var ac = $$("idLI_CB_acNome_ld").getValue();
                                                    var g = $$("id_cb_dgnome_cp").getValue();

                                                    if (n && c && p && ac && g) {
                                                        $$("id_cb_ld_d").setValue('');
                                                        $$("id_cb_ld_d").getList().clearAll();

                                                        $$("id_cb_ld_d").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p_g?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac + "&dgNome=" + g);
                                                    }

                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 500, id: "idLI_CB_cNome_ld",
                                            label: 'Curso', name: "cNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#cNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cCursos/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    var n = $$("idLI_CB_nNome_ld").getValue();
                                                    var c = $$("idLI_CB_cNome_ld").getValue();
                                                    var p = $$("idLI_CB_pNome_ld").getValue();
                                                    var ac = $$("idLI_CB_acNome_ld").getValue();
                                                    var g = $$("id_cb_dgnome_cp").getValue();

                                                    if (n && c && p && ac && g) {
                                                        $$("id_cb_ld_d").setValue('');
                                                        $$("id_cb_ld_d").getList().clearAll();

                                                        $$("id_cb_ld_d").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p_g?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac + "&dgNome=" + g);
                                                    }
                                                }
                                            }
                                        },
                                        {}
                                    ]
                                },
                                {
                                    cols: [

                                        {
                                            view: "richselect", width: 125, id: "idLI_CB_pNome_ld",
                                            label: 'Periodo', name: "pNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#pNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "cPeriodos/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    var n = $$("idLI_CB_nNome_ld").getValue();
                                                    var c = $$("idLI_CB_cNome_ld").getValue();
                                                    var p = $$("idLI_CB_pNome_ld").getValue();
                                                    var ac = $$("idLI_CB_acNome_ld").getValue();
                                                    var g = $$("id_cb_dgnome_cp").getValue();

                                                    if (n && c && p && ac && g) {
                                                        $$("id_cb_ld_d").setValue('');
                                                        $$("id_cb_ld_d").getList().clearAll();

                                                        $$("id_cb_ld_d").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p_g?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac + "&dgNome=" + g);
                                                    }

                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 100, id: "idLI_CB_acNome_ld",
                                            label: 'Ano Curricular', name: "acNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#acNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CAno_Curricular/read"
                                                }
                                            }, on: {
                                                "onChange": function (newv, oldv) {
                                                    var n = $$("idLI_CB_nNome_ld").getValue();
                                                    var c = $$("idLI_CB_cNome_ld").getValue();
                                                    var p = $$("idLI_CB_pNome_ld").getValue();
                                                    var ac = $$("idLI_CB_acNome_ld").getValue();
                                                    var g = $$("id_cb_dgnome_cp").getValue();

                                                    if (n && c && p && ac && g) {
                                                        $$("id_cb_ld_d").setValue('');
                                                        $$("id_cb_ld_d").getList().clearAll();

                                                        $$("id_cb_ld_d").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p_g?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac + "&dgNome=" + g);
                                                    }

                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 200, id: "id_cb_dgnome_cp",
                                            label: 'Geração', name: "dgnome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#dgnome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CDisciplinas_Geracao/read"
                                                }
                                            },
                                            on: {
                                                "onChange": function (newv, oldv) {
                                                    var n = $$("idLI_CB_nNome_ld").getValue();
                                                    var c = $$("idLI_CB_cNome_ld").getValue();
                                                    var p = $$("idLI_CB_pNome_ld").getValue();
                                                    var ac = $$("idLI_CB_acNome_ld").getValue();
                                                    var g = $$("id_cb_dgnome_cp").getValue();

                                                    if (n && c && p && ac && g) {
                                                        $$("id_cb_ld_d").setValue('');
                                                        $$("id_cb_ld_d").getList().clearAll();

                                                        $$("id_cb_ld_d").getList().load(BASE_URL + "CDisciplinas/readX_ac_n_c_p_g?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&acNome=" + ac + "&dgNome=" + g);
                                                    }

                                                }
                                            }
                                        },
                                        {
                                            view: "richselect", width: 370, id: "id_cb_ld_d",
                                            label: 'Disciplina', name: "dnome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#dnome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CDisciplinas/read"
                                                }
                                            }
                                        },

                                        {
                                            view: "button", type: "form", value: "Perquisar", width: 110, click: function () {
                                                var n = $$("idLI_CB_nNome_ld").getValue();
                                                var c = $$("idLI_CB_cNome_ld").getValue();
                                                var p = $$("idLI_CB_pNome_ld").getValue();
                                                var ac = $$("idLI_CB_acNome_ld").getValue();
                                                var d = $$("id_cb_ld_d").getValue();

                                                if (n && c && p && ac && d) {
                                                    $$("idDTdpto_prog").clearAll();
                                                    $$("idDTdpto_prog").load(BASE_URL + "Cplanificacoes_dpto/read_x_idd?idd=" + d);
                                                } else
                                                    webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });

                                            }
                                        },
                                        {}
                                    ]
                                }
                            ]
                        },
                    ]

                },
                {
                    view: "form", rows: [
                        {
                            cols: [
                                {
                                    view: "button", type: "form", value: "Adicionar", width: 110, click: function () {
                                        var idd = $$('id_cb_ld_d').getValue();
                                        if(idd){
                                            webix.ui({
                                                view: "window",
                                                id: "idwin_dpto_prog_add",
                                                width: 500,
                                                height: 500,
                                                position: "center",
                                                modal: true,
                                                //head: "Pautas Professores",
                                                head: {
                                                    view: "toolbar", cols: [
                                                        { view: "label", label: "Adicionar Tema" },
                                                        {
                                                            view: "button", type: "danger", label: 'X', width: 50, align: 'right', click: function () {//"$$('idwin_Pautas_Professores').close();" }
                                                                $$('idwin_dpto_prog_add').close();
                                                            }
                                                        }
                                                    ]
                                                },
                                                body: webix.copy(form_dpto_prog_add)
                                            }).show();

                                            $$('id_text_idd').setValue(idd);
                                            $$('id_cb_ld_d_add').setValue($$('id_cb_ld_d').getText());
                                        }else
                                            webix.message({ type: "error", text: "Deve seleccionar primeiro uma disciplina." }); 
                                        
                                    }
                                },
                                {
                                    view: "button", type: "standard", value: "Editar", width: 110, click: function () {
                                        var idd = $$('id_cb_ld_d').getValue();
                                        var idSelecionado = $$("idDTdpto_prog").getSelectedId(false, true);
                                        if (idSelecionado) {
                                            webix.ui({
                                                view: "window",
                                                id: "idwin_dpto_prog_ed",
                                                width: 500,
                                                height: 500,
                                                position: "center",
                                                modal: true,
                                                //head: "Pautas Professores",
                                                head: {
                                                    view: "toolbar", cols: [
                                                        { view: "label", label: "Editar Programa" },
                                                        {
                                                            view: "button", type: "danger", label: 'X', width: 50, align: 'right', click: function () {//"$$('idwin_Pautas_Professores').close();" }
                                                                $$('idwin_dpto_prog_ed').close();
                                                                //var redirect = BASE_URL + 'welcome/logout';
                                                                //window.location = redirect;
                                                            }
                                                        }
                                                    ]
                                                },
                                                body: webix.copy(form_dpto_prog_ed)
                                            }).show();
                                            // cargar datos
                                            var record = $$("idDTdpto_prog").getItem(idSelecionado);
                                            $$('id_text_id').setValue(record.id);
                                            $$('id_text_temnome_ed').setValue(record.temnome);
                                            $$('id_text_temhoras_ed').setValue(record.temhoras);
                                            $$('id_cb_ld_d_ed').setValue($$('id_cb_ld_d').getText());
                                            $$('id_text_idd_ed').setValue(idd);

                                        } else
                                            webix.message({ type: "error", text: "Deve seleccionar primeiro uma linha." });
                                    }
                                },
                                {
                                    view: "button", type: "danger", value: "Apagar", width: 110, click: function () {
                                        var idSelecionado = $$("idDTdpto_prog").getSelectedId(false, true);
                                        if (idSelecionado) {
                                            var envio = "id=" + idSelecionado;
                                            var r = webix.ajax().sync().post(BASE_URL + "Cplanificacoes_dpto/delete", envio);
                                            if (r.responseText == "true") {
                                                webix.message("Dados actualizados com sucesso");
                                                //actualizar grid si los campos estan seleccionados
                                                var n = $$("idLI_CB_nNome_ld").getValue();
                                                var c = $$("idLI_CB_cNome_ld").getValue();
                                                var p = $$("idLI_CB_pNome_ld").getValue();
                                                var ac = $$("idLI_CB_acNome_ld").getValue();
                                                var d = $$("id_cb_ld_d").getValue();
                
                                                if (n && c && p && ac && d) {
                                                    $$("idDTdpto_prog").clearAll();
                                                    $$("idDTdpto_prog").load(BASE_URL + "Cplanificacoes_dpto/read_x_idd?idd=" + d);
                                                } else
                                                    webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });
                                                //
                                            } else {
                                                webix.message({ type: "error", text: "Erro apagando dados" });
                                            }
                                        } else
                                            webix.message({ type: "error", text: "Deve seleccionar primeiro uma linha." });
                                    }
                                },
                                {}
                            ]
                        }
                    ]
                },
                {
                    view: "datatable",
                    id: "idDTdpto_prog",
                    select: "row", /*editable: true, editaction: "click",*/
                    editable: false,
                    columns: [
                        { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                        { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                        { id: "temnome", header: ["Tema", { content: "textFilter" }], width: 600, sort: "string" },
                        { id: "temhoras", header: ["Horas", { content: "textFilter" }], width: 80, sort: "int" },
                    ],
                    resizeColumn: true,
                    //url: BASE_URL + "cpautas/read",
                    pager: "pager_dpto_prog"
                }, {
                    view: "pager", id: "pager_dpto_prog",
                    template: "{common.prev()} {common.pages()} {common.next()}",
                    size: 15,
                    group: 5
                }
            ]
        },
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

var form_dpto_prog_ed = {
    view: "form",
    id: "idform_dpto_prog_ed",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'id', hidden: true, id: "id_text_id", name: "id" },
                { view: "text", label: 'idd', hidden: true, id: "id_text_idd_ed", name: "idd" },
                { view: "text", label: 'Disciplina', disabled: true, id: "id_cb_ld_d_ed", name: "dnome" },
                { view: "text", label: 'Tema', id: "id_text_temnome_ed", name: "temnome" },
                { view: "counter", label: 'Q.Horas', id: "id_text_temhoras_ed", name: "temhoras" }
            ]

        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var id = $$("id_text_id").getValue();
                        var temnome = $$("id_text_temnome_ed").getValue();
                        var temhoras = $$("id_text_temhoras_ed").getValue();
                        var idd = $$("id_text_idd_ed").getValue();

                        if (temnome && temhoras && idd && id) { //validate form
                            var envio = "temnome=" + temnome +
                                "&temhoras=" + temhoras +
                                "&disciplinas_id=" + idd + 
                                "&id=" + id;
                            var r = webix.ajax().sync().post(BASE_URL + "Cplanificacoes_dpto/update", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados actualizados com sucesso");
                                //actualizar grid si los campos estan seleccionados
                                var n = $$("idLI_CB_nNome_ld").getValue();
                                var c = $$("idLI_CB_cNome_ld").getValue();
                                var p = $$("idLI_CB_pNome_ld").getValue();
                                var ac = $$("idLI_CB_acNome_ld").getValue();
                                var d = $$("id_cb_ld_d").getValue();

                                if (n && c && p && ac && d) {
                                    $$("idDTdpto_prog").clearAll();
                                    $$("idDTdpto_prog").load(BASE_URL + "Cplanificacoes_dpto/read_x_idd?idd=" + d);
                                } else
                                    webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });
                                //
                                $$("idwin_dpto_prog_ed").close();
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
                        $$("idwin_dpto_prog_ed").close();
                    }
                }
            ]
        }
    ],
    rules: {
        "stnome": webix.rules.isNotEmpty
    },
    elementsConfig: {
        labelPosition: "top",
    }
};



var form_dpto_prog_add = {
    view: "form",
    id: "idform_dpto_prog_add",
    borderless: true,
    elements: [
        {
            rows: [
                //{ view: "text", label: 'id', hidden: true, id: "id_text_ide", name: "id" },
                { view: "text", label: 'idd', hidden: true, id: "id_text_idd", name: "idd" },
                { view: "text", label: 'Disciplina', disabled: true, id: "id_cb_ld_d_add", name: "dnome" },
                { view: "text", label: 'Tema', id: "id_text_temnome_add", name: "temnome" },
                { view: "counter", label: 'Q.Horas', id: "id_text_temhoras_add", name: "temhoras" }
            ]

        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {

                        var temnome = $$("id_text_temnome_add").getValue();
                        var temhoras = $$("id_text_temhoras_add").getValue();
                        var idd = $$("id_text_idd").getValue();

                        if (temnome && temhoras && idd) { //validate form
                            var envio = "temnome=" + temnome +
                                "&temhoras=" + temhoras +
                                "&disciplinas_id=" + idd;
                            var r = webix.ajax().sync().post(BASE_URL + "Cplanificacoes_dpto/insert", envio);
                            if (r.responseText == "true") {
                                webix.message("Dados inseridos com sucesso");
                                //actualizar grid si los campos estan seleccionados
                                var n = $$("idLI_CB_nNome_ld").getValue();
                                var c = $$("idLI_CB_cNome_ld").getValue();
                                var p = $$("idLI_CB_pNome_ld").getValue();
                                var ac = $$("idLI_CB_acNome_ld").getValue();
                                var d = $$("id_cb_ld_d").getValue();

                                if (n && c && p && ac && d) {
                                    $$("idDTdpto_prog").clearAll();
                                    $$("idDTdpto_prog").load(BASE_URL + "Cplanificacoes_dpto/read_x_idd?idd=" + d);
                                } else
                                    webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });
                                //
                                $$("idwin_dpto_prog_add").close();
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
                        $$("idwin_dpto_prog_add").close();
                    }
                }
            ]
        }
    ],
    rules: {
        "stnome": webix.rules.isNotEmpty
    },
    elementsConfig: {
        labelPosition: "top",
    }
};