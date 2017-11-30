//var codigo_foto;
function cargarVistaEstudantes_Disciplinas(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        //autoheight:true,
        height: 900,
        cells: [
            {
                header: "Estudantes Disciplinas", body: {
                    rows: [
                        {
                            view: "form", scroll: false,
                            rows: [
                                {
                                    cols: [
                                        { view: "text", label: 'BI / Passaporte (Estudantes)', name: "cbi_passaporte", id: "idtext_bi_ed", width: 300, labelPosition: "top" },
                                        {
                                            view: "button", type: "form", value: "Localizar", width: 120, click: function () {

                                                var bi = $$("idtext_bi_ed").getValue();

                                                var envio = "bi=" + bi;
                                                var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxBI", envio);
                                                var candidato_id = rbi.responseText;

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeCompletoXID", envio);
                                                var nome_completo_candidato = r1.responseText;

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Nivel_NomeXCandidato_id", envio);
                                                var nivel = r1.responseText;

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Curso_NomeXCandidato_id", envio);
                                                var curso = r1.responseText;

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Periodo_NomeXCandidato_id", envio);
                                                var periodo = r1.responseText;

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_AC_NomeXCandidato_id", envio);
                                                var ac = r1.responseText;

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Semestre_NomeXCandidato_id", envio);
                                                var s = r1.responseText;

                                                var envio = "id=" + candidato_id; //this.getValue();
                                                var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Turma_NomeXCandidato_id", envio);
                                                var t = r1.responseText;

                                                //ver cual es el dpto del estudiante
                                                /*var envio10 = "n=" + nivel + "&c=" + curso + "&bi=" + bi; //this.getValue();
                                                var r10 = webix.ajax().sync().post(BASE_URL + "Cchefes_departamentos_utilizadores/dpto_x_bi", envio10);
                                                var dpto_est = r10.responseText;
                                                */
                                                //ver si el usuario logeado pertenece al dpto del estudiante
                                                //var envio20 = "dpto=" + dpto_est + "&user=" + user_sessao + "&n=" + nivel + "&c=" + curso + "&bi=" + bi;
                                                var envio20 = "user=" + user_sessao + "&n=" + nivel + "&c=" + curso + "&bi=" + bi;
                                                var r20 = webix.ajax().sync().post(BASE_URL + "Cchefes_departamentos_utilizadores/comprobar_departamento_usuario", envio20);
                                                var pertenece = r20.responseText;
                                                if (pertenece == "true") {
                                                    $$("idtext_nome_completo").setValue(nome_completo_candidato);
                                                    $$("idtext_nnome").setValue(nivel);
                                                    $$("idtext_cnome").setValue(curso);
                                                    $$("idtext_pnome").setValue(periodo);
                                                    $$("idtext_acnome").setValue(ac);
                                                    $$("idtext_snome").setValue(s);
                                                    $$("idtext_tnome").setValue(t);

                                                    $$('idbtn_pesquisar1').enable();
                                                    //$$('idbtn_pesquisar2').enable();
                                                    //$$('idbtn_Activar').enable();
                                                } else {
                                                    $$('idtext_bi_ed').setValue("");
                                                    $$('idbtn_pesquisar1').disable();
                                                    //$$('idbtn_pesquisar2').disable();
                                                    //$$('idbtn_Activar').disable();
                                                    webix.message({ type: "error", text: "Erro, O estudante pertence a um departamento diferente" });
                                                }

                                            }
                                        },
                                        {}
                                    ]
                                }, {
                                    cols: [
                                        { view: "text", label: 'Nome Completo', name: "cnome", id: "idtext_nome_completo", readonly: true, disabled: true, width: 350, labelPosition: "top" },
                                        { view: "text", label: 'Nível', name: "nnome", id: "idtext_nnome", readonly: true, disabled: true, width: 200, labelPosition: "top" },
                                        { view: "text", label: 'Curso', name: "cnome", id: "idtext_cnome", readonly: true, disabled: true, width: 400, labelPosition: "top" },
                                        { view: "text", label: 'Período', name: "pnome", id: "idtext_pnome", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                                        //{ view: "text", label: 'Nível', name: "nnome", id: "idtext_nnome", readonly: true, width: 400, labelPosition:"top"},
                                        {}
                                    ]
                                },
                                {
                                    cols: [
                                        { view: "text", label: 'Ano Curricular', name: "acnome", id: "idtext_acnome", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                                        { view: "text", label: 'Semestre Actual', name: "snome", id: "idtext_snome", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                                        { view: "text", label: 'Turma Actual', name: "tnome", id: "idtext_tnome", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                                        {}
                                    ]
                                },
                                {
                                    cols: [
                                        {
                                            view: "richselect", width: 170, id: "idCB_sNome_ed",
                                            label: 'Semestre', name: "sNome",
                                            labelPosition: "top",
                                            options: {
                                                body: {
                                                    template: "#sNome#",
                                                    yCount: 7,
                                                    url: BASE_URL + "CSemestres/read"
                                                }
                                            }
                                        },
                                        {
                                            view: "button", type: "standard", value: "Carregar", id: "idbtn_pesquisar1", width: 140, click: function () {
                                                var bi = $$("idtext_bi_ed").getValue();
                                                var n = $$("idtext_nnome").getValue();
                                                var c = $$("idtext_cnome").getValue();
                                                var p = $$("idtext_pnome").getValue();
                                                var s = $$("idCB_sNome_ed").getValue();

                                                if (bi && n && c && p && s) {
                                                    $$("idDTED").clearAll();
                                                    $$("idDTED").load(BASE_URL + "Cacademica_estudantes_disciplinas/read_disc_semestre?n=" + n + "&c=" + c +
                                                        "&p=" + p +
                                                        "&s=" + s +
                                                        "&bi=" + bi);
                                                }
                                            }
                                        },
                                        {}
                                        /* {
                                             view: "button", type: "form", value: "Confirmar Matríc.", id: "idbtn_pesquisar2", width: 140, click: function () {
                                                 var bi = $$("idtext_bi_ed").getValue();
                                                 var n = $$("idtext_nnome").getValue();
                                                 var c = $$("idtext_cnome").getValue();
                                                 var p = $$("idtext_pnome").getValue();
                                                 var s = $$("idCB_sNome_ed").getValue();
                                                 
                                                 //cargar windows
                                                 if (bi && n && c && p && s) {
                                                     //seleccionar turma para matricular
                                                     webix.ui({
                                                         view: "window",
                                                         id: "id_win_formchefes_dpto",
                                                         width: 1300,
                                                         position: "center",
                                                         modal: true,
                                                         move: true,
                                                         head: "Confirmar Matrícula",
                                                         body: webix.copy(formchefes_dpto)
                                                     }).show();
                                                     //actualizar campos de la windows
                                                     $$("idDTED").clearAll();
                                                     $$("idDTED").load(BASE_URL + "Cacademica_estudantes_disciplinas/read_disc_semestre?n=" + n + "&c=" + c +
                                                         "&p=" + p +
                                                         "&s=" + s +
                                                         "&bi=" + bi);
 
                                                     $$('idtext_acnome_jcd').setValue($$('idtext_acnome').getValue());
                                                     $$('idtext_snome_jcd').setValue($$('idtext_snome').getValue());
 
                                                 } else
                                                     webix.message({ type: "error", text: "Erro, Faltam dados para localizar o estudante" });
                                             }
                                         },
                                         */
                                    ]
                                }, {
                                    rows: [
                                        {
                                            cols: [
                                                {},
                                                {
                                                    view: "button", type: "form", value: "Matric. Disc.", id: "idbtn_Activar", width: 140, click: function () {
                                                        var idSelecionado = $$("idDTED").getSelectedId(false, true);
                                                        if (idSelecionado) {
                                                            webix.ui({
                                                                view: "window",
                                                                id: "id_win_ano_lec",
                                                                width: 200,
                                                                position: "center",
                                                                modal: true,
                                                                head: "Ano Lectivo Mat. Disc. ",
                                                                body: webix.copy(form_ano_lec)
                                                            }).show();
                                                        } else
                                                            webix.message({ type: "error", text: "Erro, Selecionar primeiro uma disciplina" });
                                                    }
                                                },
                                                {
                                                    view: "button", type: "standard", value: "Repetir Disc.", width: 140, click: function () {
                                                        var bi = $$("idtext_bi_ed").getValue();
                                                        var envio = "bi=" + bi;
                                                        var rbi = webix.ajax().sync().post(BASE_URL + "cEstudantes/get_idXbi", envio);
                                                        var ide = rbi.responseText;

                                                        var idSelecionado = $$("idDTED").getSelectedId(false, true);
                                                        if (idSelecionado) {
                                                            var record = $$("idDTED").getItem(idSelecionado);
                                                            //inserir na pauta
                                                            var envio2 = "Estudantes_id=" + ide + "&Disciplinas_id=" + record.id;
                                                            var r = webix.ajax().sync().post(BASE_URL + "cPautas/insert_inicializar", envio2);
                                                            //Actualizar ano de activacao em Estudantes_Disciplinas
                                                            var envio_aa = "id=" + ide + "&idd=" + record.id + "&webix_operation=update";
                                                            var raa = webix.ajax().sync().post(BASE_URL + "Cacademica_estudantes_disciplinas/crud", envio_aa);
                                                            if (raa.responseText == "true")
                                                                webix.message("Ano lectivo actualizado com sucesso.");
                                                            else
                                                                webix.message({ type: "error", text: "Erro ao actualizar o ano lectivo na pauta." });
                                                            //actualizar dados
                                                            var bi = $$("idtext_bi_ed").getValue();
                                                            var n = $$("idtext_nnome").getValue();
                                                            var c = $$("idtext_cnome").getValue();
                                                            var p = $$("idtext_pnome").getValue();
                                                            var s = $$("idCB_sNome_ed").getValue();
                                                            if (bi && n && c && p && s) {
                                                                $$("idDTED").clearAll();
                                                                $$("idDTED").load(BASE_URL + "Cacademica_estudantes_disciplinas/read_disc_semestre?n=" + n + "&c=" + c +
                                                                    "&p=" + p +
                                                                    "&s=" + s +
                                                                    "&bi=" + bi);
                                                            }
                                                        } else
                                                            webix.message({ type: "error", text: "Erro, Deve seleccionar primeiro uma disciplina." });
                                                    }
                                                },
                                                {
                                                    view: "button", type: "danger", value: "Cancelar Mat. Disc.", width: 140, click: function () {
                                                        var idSelecionado = $$('idDTED').getSelectedId();
                                                        if (idSelecionado) {
                                                            //cargar datos
                                                            var bi = $$("idtext_bi_ed").getValue();
                                                            var envio = "bi=" + bi;
                                                            var rbi = webix.ajax().sync().post(BASE_URL + "cEstudantes/get_idXbi", envio);
                                                            var ide = rbi.responseText;

                                                            var record = $$("idDTED").getItem(idSelecionado);

                                                            webix.confirm({
                                                                title: "Confirmação",
                                                                type: "confirm-warning",
                                                                ok: "Sim", cancel: "Nao",
                                                                text: "Est&aacute; seguro que deseja cancelar matrícula da disciplina selecionada",
                                                                callback: function (result) {
                                                                    if (result) {
                                                                        //cancelar matricula pauta
                                                                        var envio_cmd = "ide=" + ide + "&idd=" + record.id;
                                                                        var r = webix.ajax().sync().post(BASE_URL + "cpautas/cancelar_matricula_disciplina", envio_cmd);
                                                                        //cancelar matricula Estudantes_Dicisplinas
                                                                        var envio_ced = "id=" + ide + "&idd=" + record.id + "&webix_operation=delete";
                                                                        var rced = webix.ajax().sync().post(BASE_URL + "Cacademica_estudantes_disciplinas/crud", envio_ced);

                                                                        if (r.responseText == "true" && rced.responseText == "true") {
                                                                            webix.message("Matrícula cancelada com sucesso");
                                                                            //actualizar dados
                                                                            var bi = $$("idtext_bi_ed").getValue();
                                                                            var n = $$("idtext_nnome").getValue();
                                                                            var c = $$("idtext_cnome").getValue();
                                                                            var p = $$("idtext_pnome").getValue();
                                                                            var s = $$("idCB_sNome_ed").getValue();
                                                                            if (bi && n && c && p && s) {
                                                                                $$("idDTED").clearAll();
                                                                                $$("idDTED").load(BASE_URL + "Cacademica_estudantes_disciplinas/read_disc_semestre?n=" + n + "&c=" + c +
                                                                                    "&p=" + p +
                                                                                    "&s=" + s +
                                                                                    "&bi=" + bi);
                                                                            }
                                                                        }
                                                                        else
                                                                            webix.message({ type: "error", text: "Erro, não é posivel cancelar matrícula, contacte o administrador" });
                                                                    }
                                                                }
                                                            });
                                                        } else {
                                                            webix.message({ type: "error", text: "Erro, selecione primeiro uma disciplina activa" });
                                                        }
                                                    }
                                                },
                                                {
                                                    view: "button", type: "standard", value: "Actualizar", width: 140, click: function () {
                                                        //actualizar dados
                                                        var bi = $$("idtext_bi_ed").getValue();
                                                        var n = $$("idtext_nnome").getValue();
                                                        var c = $$("idtext_cnome").getValue();
                                                        var p = $$("idtext_pnome").getValue();
                                                        var s = $$("idCB_sNome_ed").getValue();
                                                        if (bi && n && c && p && s) {
                                                            $$("idDTED").clearAll();
                                                            $$("idDTED").load(BASE_URL + "Cacademica_estudantes_disciplinas/read_disc_semestre?n=" + n + "&c=" + c +
                                                                "&p=" + p +
                                                                "&s=" + s +
                                                                "&bi=" + bi);
                                                        }
                                                    }
                                                },
                                                {}
                                            ]
                                        },
                                        {
                                            view: "datatable",
                                            id: "idDTED",
                                            height: 420,
                                            //select: "row", /*editable: true, editaction: "click",*/
                                            columns: [
                                                { id: "bi", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                                { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                                { id: "ord", header: "Nº", css: "rank", width: 40, sort: "int" },
                                                {
                                                    id: "destado", header: "Estado", width: 60, sort: "string",
                                                    template: function (obj) {
                                                        if (obj.destado == "off")
                                                            return "<span style='color:red;'>" + obj.destado + "</span>";
                                                        else
                                                            return "<span style='color:green;'>" + obj.destado + "</span>";

                                                    },
                                                },
                                                {
                                                    id: "activa", header: "activa", width: 60, sort: "string",
                                                    template: function (obj) {
                                                        if (obj.activa == "Sim")
                                                            return "<span style='color:green;'>" + obj.activa + "</span>";
                                                        else
                                                            return "<span style='color:red;'>" + obj.activa + "</span>";

                                                    },
                                                },
                                                { id: "ano_lec", header: "Ano", width: 50, sort: "int" },
                                                //{ id:"activar", header:["Activar",{content:"masterCheckbox" }], checkValue:'on', uncheckValue:'off', template:"{common.checkbox()}", width:80},
                                                ///////{ id: "activa", header: "Activa", width: 70, sort: "string" },
                                                { id: "dnome", header: "Disciplina", width: 320, sort: "string" },
                                                { id: "ddnome", header: "Duração", width: 100, sort: "string" },
                                                //{ id: "estado", header: "Resultado", width: 100, sort: "string" },
                                                {
                                                    id: "estado", header: "Resultado", width: 100, sort: "string",
                                                    template: function (obj) {
                                                        if (obj.estado == "Reprovado")
                                                            return "<span style='color:red;'>" + obj.estado + "</span>";
                                                        else {
                                                            if (obj.estado == null)
                                                                return "<span style='color:red;'>" + 'Reprovado' + "</span>";
                                                            else
                                                                return "<span style='color:green;'>" + obj.estado + "</span>";
                                                        }

                                                    },
                                                },
                                                { id: "repeticoes", editor: "text", header: "Ocasi&atilde;o", width: 85, sort: "int" },
                                                { id: "dgnome", editor: "text", header: "Gera&ccedil;&atilde;o Disc.", width: 110, sort: "string" },
                                                { id: "dprecedencia1_id", header: "Precedencia 1", width: 200, sort: "string" },
                                                { id: "dprecedencia2_id", header: "Precedencia 2", width: 200, sort: "string" },
                                                { id: "dprecedencia3_id", header: "Precedencia 3", width: 200, sort: "string" },

                                            ],
                                            resizeColumn: true,
                                            select: "row", //editable: true, editaction: "click",
                                            save: BASE_URL + "cacademica_estudantes_disciplinas/crud",
                                            url: BASE_URL + "cacademica_estudantes_disciplinas/read_disc_semestre",
                                            pager: "pagerCDadosED"
                                        }, {
                                            view: "pager", id: "pagerCDadosED",
                                            template: "{common.prev()} {common.pages()} {common.next()}",
                                            size: 25,
                                            group: 10
                                        }, {
                                            cols: [
                                                {},
                                                {
                                                    view: "button", type: "danger", value: "Voltar", disabled: true, id: "id_btn_voltar", width: 140, click: function () {
                                                        var bi = $$("idtext_bi_ed").getValue();
                                                        var envio = "bi=" + bi;
                                                        var rbi = webix.ajax().sync().post(BASE_URL + "cEstudantes/get_idXbi", envio);

                                                        var ide = rbi.responseText;
                                                        var s = $$("idCB_sNome_ed").getValue();

                                                        var envio_ac = "id=" + ide;
                                                        var rac = webix.ajax().sync().post(BASE_URL + "cEstudantes/readXano_curricular_id", envio_ac);
                                                        var ac = rac.responseText;
                                                        //convertir snome en sid
                                                        var envio_snome = "sNome=" + $$("idtext_snome").getValue();
                                                        var rs_id = webix.ajax().sync().post(BASE_URL + "CSemestres/GetID", envio_snome);
                                                        var s_id = rs_id.responseText;

                                                        var envio_ced = "id=" + ide + "&acNome=" + ac + "&sNome=" + s_id +
                                                            "&user=" + user_sessao + "&bi=" + bi;
                                                        var rced = webix.ajax().sync().post(BASE_URL + "cEstudantes/voltar_estudante", envio_ced);

                                                        if (rced.responseText == "true") {
                                                            webix.message("Estudante colocado no semestre anterior com sucesso");
                                                            //actualizar campos desabilitados de arriba
                                                            var bi = $$("idtext_bi_ed").getValue();

                                                            var envio = "bi=" + bi;
                                                            var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxBI", envio);
                                                            var candidato_id = rbi.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeCompletoXID", envio);
                                                            var nome_completo_candidato = r1.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Nivel_NomeXCandidato_id", envio);
                                                            var nivel = r1.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Curso_NomeXCandidato_id", envio);
                                                            var curso = r1.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Periodo_NomeXCandidato_id", envio);
                                                            var periodo = r1.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_AC_NomeXCandidato_id", envio);
                                                            var ac = r1.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Semestre_NomeXCandidato_id", envio);
                                                            var s = r1.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Turma_NomeXCandidato_id", envio);
                                                            var t = r1.responseText;

                                                            var envio20 = "user=" + user_sessao + "&n=" + nivel + "&c=" + curso + "&bi=" + bi;
                                                            var r20 = webix.ajax().sync().post(BASE_URL + "Cchefes_departamentos_utilizadores/comprobar_departamento_usuario", envio20);
                                                            var pertenece = r20.responseText;
                                                            if (pertenece == "true") {
                                                                $$("idtext_nome_completo").setValue(nome_completo_candidato);
                                                                $$("idtext_nnome").setValue(nivel);
                                                                $$("idtext_cnome").setValue(curso);
                                                                $$("idtext_pnome").setValue(periodo);
                                                                $$("idtext_acnome").setValue(ac);
                                                                $$("idtext_snome").setValue(s);
                                                                $$("idtext_tnome").setValue(t);

                                                                $$('idbtn_pesquisar1').enable();
                                                                //$$('idbtn_pesquisar2').enable();
                                                                //$$('idbtn_Activar').enable();
                                                            } else {
                                                                $$('idtext_bi_ed').setValue("");
                                                                $$('idbtn_pesquisar1').disable();
                                                                //$$('idbtn_pesquisar2').disable();
                                                                //$$('idbtn_Activar').disable();
                                                                webix.message({ type: "error", text: "Erro, O estudante pertence a um departamento diferente" });
                                                            }
                                                            //
                                                        }
                                                        else
                                                            webix.message({ type: "error", text: "Erro, não é posivel executar esta peração com o estudante, contacte o administrador" });
                                                    }
                                                },
                                                {
                                                    view: "button", type: "form", value: "Transitar", width: 140, click: function () {
                                                        var bi = $$("idtext_bi_ed").getValue();
                                                        var envio = "bi=" + bi;
                                                        var rbi = webix.ajax().sync().post(BASE_URL + "cEstudantes/get_idXbi", envio);

                                                        var ide = rbi.responseText;
                                                        var s = $$("idCB_sNome_ed").getValue();

                                                        var envio_ac = "id=" + ide;
                                                        var rac = webix.ajax().sync().post(BASE_URL + "cEstudantes/readXano_curricular_id", envio_ac);
                                                        var ac = rac.responseText;
                                                        //convertir snome en sid
                                                        var envio_snome = "sNome=" + $$("idtext_snome").getValue();
                                                        var rs_id = webix.ajax().sync().post(BASE_URL + "CSemestres/GetID", envio_snome);
                                                        var s_id = rs_id.responseText;

                                                        var envio_ced = "id=" + ide + "&acNome=" + ac + "&sNome=" + s_id +
                                                            "&user=" + user_sessao + "&bi=" + bi;
                                                        var rced = webix.ajax().sync().post(BASE_URL + "cEstudantes/tranferir_estudante", envio_ced);

                                                        if (rced.responseText == "true") {
                                                            webix.message("Estudante tranferido com sucesso");
                                                            //actualiar los campos desabilitados de arriba
                                                            var bi = $$("idtext_bi_ed").getValue();

                                                            var envio = "bi=" + bi;
                                                            var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxBI", envio);
                                                            var candidato_id = rbi.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeCompletoXID", envio);
                                                            var nome_completo_candidato = r1.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Nivel_NomeXCandidato_id", envio);
                                                            var nivel = r1.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Curso_NomeXCandidato_id", envio);
                                                            var curso = r1.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Periodo_NomeXCandidato_id", envio);
                                                            var periodo = r1.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_AC_NomeXCandidato_id", envio);
                                                            var ac = r1.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Semestre_NomeXCandidato_id", envio);
                                                            var s = r1.responseText;

                                                            var envio = "id=" + candidato_id; //this.getValue();
                                                            var r1 = webix.ajax().sync().post(BASE_URL + "cEstudantes/Get_Turma_NomeXCandidato_id", envio);
                                                            var t = r1.responseText;

                                                            var envio20 = "user=" + user_sessao + "&n=" + nivel + "&c=" + curso + "&bi=" + bi;
                                                            var r20 = webix.ajax().sync().post(BASE_URL + "Cchefes_departamentos_utilizadores/comprobar_departamento_usuario", envio20);
                                                            var pertenece = r20.responseText;
                                                            if (pertenece == "true") {
                                                                $$("idtext_nome_completo").setValue(nome_completo_candidato);
                                                                $$("idtext_nnome").setValue(nivel);
                                                                $$("idtext_cnome").setValue(curso);
                                                                $$("idtext_pnome").setValue(periodo);
                                                                $$("idtext_acnome").setValue(ac);
                                                                $$("idtext_snome").setValue(s);
                                                                $$("idtext_tnome").setValue(t);

                                                                $$('idbtn_pesquisar1').enable();
                                                                //$$('idbtn_pesquisar2').enable();
                                                                //$$('idbtn_Activar').enable();
                                                            } else {
                                                                $$('idtext_bi_ed').setValue("");
                                                                $$('idbtn_pesquisar1').disable();
                                                                //$$('idbtn_pesquisar2').disable();
                                                                //$$('idbtn_Activar').disable();
                                                                webix.message({ type: "error", text: "Erro, O estudante pertence a um departamento diferente" });
                                                            }
                                                            //
                                                        }
                                                        else
                                                            webix.message({ type: "error", text: "Erro, não é posivel tranferir o estudante, contacte o administrador" });
                                                    }
                                                },
                                                /*{
                                                    view: "button", type: "danger", value: "Repetir", width: 140, click: function () {

                                                    }
                                                },*/
                                                {}
                                            ]
                                        },

                                    ]
                                }
                            ]

                        },/* {
                            view: "datatable",
                            id: "idDTED1",
                            height: 420,

                            columns: [
                                { id: "bi", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                { id: "ord", header: "Nº", css: "rank", width: 40, sort: "int" },
                                {
                                    id: "destado", header: "Estado", width: 60, sort: "string",
                                    template: function (obj) {
                                        if (obj.destado == "off")
                                            return "<span style='color:red;'>" + obj.destado + "</span>";
                                        else
                                            return "<span style='color:green;'>" + obj.destado + "</span>";

                                    },
                                },
                                {
                                    id: "activa", header: "activa", width: 60, sort: "string",
                                    template: function (obj) {
                                        if (obj.activa == "Sim")
                                            return "<span style='color:green;'>" + obj.activa + "</span>";
                                        else
                                            return "<span style='color:red;'>" + obj.activa + "</span>";

                                    },
                                },
                                { id: "ano_lec", header: "Ano", width: 50, sort: "int" },
                                //{ id:"activar", header:["Activar",{content:"masterCheckbox" }], checkValue:'on', uncheckValue:'off', template:"{common.checkbox()}", width:80},
                                ///////{ id: "activa", header: "Activa", width: 70, sort: "string" },
                                { id: "dnome", header: "Disciplina", width: 320, sort: "string" },
                                { id: "ddnome", header: "Duração", width: 100, sort: "string" },
                                //{ id: "estado", header: "Resultado", width: 100, sort: "string" },
                                {
                                    id: "estado", header: "Resultado", width: 100, sort: "string",
                                    template: function (obj) {
                                        if (obj.estado == "Reprovado")
                                            return "<span style='color:red;'>" + obj.estado + "</span>";
                                        else {
                                            if (obj.estado == null)
                                                return "<span style='color:red;'>" + 'Reprovado' + "</span>";
                                            else
                                                return "<span style='color:green;'>" + obj.estado + "</span>";
                                        }

                                    },
                                },
                                { id: "repeticoes", editor: "text", header: "Ocasi&atilde;o", width: 85, sort: "int" },
                                { id: "dgnome", editor: "text", header: "Gera&ccedil;&atilde;o Disc.", width: 110, sort: "string" },
                                { id: "dprecedencia1_id", header: "Precedencia 1", width: 200, sort: "string" },
                                { id: "dprecedencia2_id", header: "Precedencia 2", width: 200, sort: "string" },
                                { id: "dprecedencia3_id", header: "Precedencia 3", width: 200, sort: "string" },

                            ],
                            resizeColumn: true,
                            select: "row", //editable: true, editaction: "click",
                            save: BASE_URL + "cacademica_estudantes_disciplinas/crud",
                            url: BASE_URL + "cacademica_estudantes_disciplinas/read_disc_semestre",
                            pager: "pagerCDadosED1"
                        }, {
                            view: "pager", id: "pagerCDadosED1",
                            template: "{common.prev()} {common.pages()} {common.next()}",
                            size: 25,
                            group: 10
                        }*/
                    ]
                }

            }
        ]
    });
    //alert(user_sessao);
    //readAcesso
    var envio = "usuario=" + user_sessao;
    var r = webix.ajax().sync().post(BASE_URL + "Cutilizadores/readAcesso", envio);
    if (r.responseText == "Administradores") {
        $$("id_btn_voltar").enable();
        //$$("idbtn_Apagar_Cursos_PretendidosTM").enable();
        //$$("idbtn_Exportar_DadosTM").enable();
    }
    /* if (user_sessao == "admin") {
         $$("idbtn_Apagar_Candidato").enable();
         $$("idbtn_Apagar_Cursos_Pretendidos").enable();
     }*/
}
var formchefes_dpto = {
    view: "form",
    id: "idformchefes_dpto",
    borderless: true,
    elements: [{
        rows: [
            {
                cols: [
                    {},
                    { view: "text", label: 'Ano Curricular Actual', name: "acnome", id: "idtext_acnome_jcd", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                    { view: "text", label: 'Semestre Actual', name: "snome", id: "idtext_snome_jcd", readonly: true, disabled: true, width: 150, labelPosition: "top" },
                    {},
                ]
            },
            {
                cols: [
                    {},
                    {
                        view: "button", type: "form", value: "Matric. Disc.", id: "idbtn_Activar", width: 140, click: function () {
                            var bi = $$("idtext_bi_ed").getValue();
                            var envio = "bi=" + bi;
                            var rbi = webix.ajax().sync().post(BASE_URL + "cEstudantes/get_idXbi", envio);
                            var ide = rbi.responseText;

                            var idSelecionado = $$("idDTED").getSelectedId(false, true);
                            if (idSelecionado) {
                                var record = $$("idDTED").getItem(idSelecionado);

                                var p1 = "";
                                var p2 = "";
                                var p3 = "";
                                //cambiar nombre por id
                                if (record.dprecedencia1_id) {
                                    var enviop1 = "dnome=" + record.dprecedencia1_id;
                                    var rp1 = webix.ajax().sync().post(BASE_URL + "cdisciplinas/readXnome", enviop1);
                                    var p1 = rp1.responseText;
                                }
                                if (record.dprecedencia2_id) {
                                    var enviop2 = "dnome=" + record.dprecedencia2_id;
                                    var rp2 = webix.ajax().sync().post(BASE_URL + "cdisciplinas/readXnome", enviop2);
                                    var p2 = rp2.responseText;
                                }
                                if (record.dprecedencia3_id) {
                                    var enviop3 = "dnome=" + record.dprecedencia3_id;
                                    var rp3 = webix.ajax().sync().post(BASE_URL + "cdisciplinas/readXnome", enviop3);
                                    var p3 = rp3.responseText;
                                }

                                var estado_precedencia1;
                                var estado_precedencia2;
                                var estado_precedencia3;
                                //ver si existem precedencias para esta disciplina en estado reprovada.
                                if (p1 != "") {
                                    //verificar 1 precedencia
                                    var envio11 = "ide=" + ide + "&idd=" + p1;
                                    var r11 = webix.ajax().sync().post(BASE_URL + "CPautas/read_estado_est_disc", envio11);
                                    estado_precedencia1 = r11.responseText;
                                }
                                if (p2 != "") {
                                    //verificar 2 precedencia
                                    var envio22 = "ide=" + ide + "&idd=" + p2;
                                    var r22 = webix.ajax().sync().post(BASE_URL + "CPautas/read_estado_est_disc", envio22);
                                    estado_precedencia2 = r22.responseText;
                                }
                                if (p3 != "") {
                                    //verificar 3 precedencia
                                    var envio33 = "ide=" + ide + "&idd=" + p3;
                                    var r33 = webix.ajax().sync().post(BASE_URL + "CPautas/read_estado_est_disc", envio33);
                                    estado_precedencia3 = r33.responseText;
                                }
                                //saber si  esta disciplina tiee precedencias o no.
                                var envioep = "idd=" + record.id;
                                var rep = webix.ajax().sync().post(BASE_URL + "cdisciplinas/read_existem_precedencias", envioep);
                                existem_prec = rep.responseText;

                                //ver si no tiene deuda con alguna precedencia
                               ////// if (existem_prec == "false" || estado_precedencia1 == "Aprovado" || estado_precedencia2 == "Aprovado" || estado_precedencia3 == "Aprovado") {
                                    if (ide && record.id) {
                                        //ver si existe el est antes de inserir
                                        var envio4 = "bi=" + bi + "&idd=" + record.id;
                                        var r4 = webix.ajax().sync().post(BASE_URL + "CPautas/existe_est", envio4);
                                        if (r4.responseText == "false") {
                                            //inserir na pauta
                                            var envio2 = "Estudantes_id=" + ide + "&Disciplinas_id=" + record.id;
                                            var r = webix.ajax().sync().post(BASE_URL + "cPautas/insert_inicializar", envio2);
                                        } else
                                            webix.message({ type: "error", text: "Erro, Os dados ja existem na Base de Dados" });
                                        //ver si existe el est antes de inserir
                                        var envio3 = "bi=" + bi + "&idd=" + record.id;
                                        var r = webix.ajax().sync().post(BASE_URL + "cacademica_estudantes_disciplinas/existe_d_e", envio3);
                                        if (r.responseText == "false") {
                                            //inserir em Estudantes_Disciplinas
                                            $$('idDTED').add({
                                                idd: record.id,
                                                bi: bi
                                            });
                                        } else
                                            webix.message({ type: "error", text: "Erro, Os dados ja existem na Base de Dados" });
                                    } else
                                        webix.message({ type: "error", text: "Erro, Faltam dados por inserir ou seleccionar" });

                            /*    } else
                                    webix.message({ type: "error", text: "Erro, Esta disciplina tem precedencias em estado reprovado." });
                            */
                            
                                //actualizar dados
                                var bi = $$("idtext_bi_ed").getValue();
                                var n = $$("idtext_nnome").getValue();
                                var c = $$("idtext_cnome").getValue();
                                var p = $$("idtext_pnome").getValue();
                                var s = $$("idCB_sNome_ed").getValue();
                                if (bi && n && c && p && s) {
                                    $$("idDTED").clearAll();
                                    $$("idDTED").load(BASE_URL + "Cacademica_estudantes_disciplinas/read_disc_semestre?n=" + n + "&c=" + c +
                                        "&p=" + p +
                                        "&s=" + s +
                                        "&bi=" + bi);
                                }
                            } else
                                webix.message({ type: "error", text: "Erro, Deve seleccionar primeiro uma disciplina." });
                        }
                    },
                    {
                        view: "button", type: "standard", value: "Repetir Disc.", width: 140, click: function () {
                            var bi = $$("idtext_bi_ed").getValue();
                            var envio = "bi=" + bi;
                            var rbi = webix.ajax().sync().post(BASE_URL + "cEstudantes/get_idXbi", envio);
                            var ide = rbi.responseText;

                            var idSelecionado = $$("idDTED").getSelectedId(false, true);
                            if (idSelecionado) {
                                var record = $$("idDTED").getItem(idSelecionado);
                                //inserir na pauta
                                var envio2 = "Estudantes_id=" + ide + "&Disciplinas_id=" + record.id;
                                var r = webix.ajax().sync().post(BASE_URL + "cPautas/insert_inicializar", envio2);
                                //Actualizar ano de activacao em Estudantes_Disciplinas
                                var envio_aa = "id=" + ide + "&idd=" + record.id + "&webix_operation=update";
                                var raa = webix.ajax().sync().post(BASE_URL + "Cacademica_estudantes_disciplinas/crud", envio_aa);
                                if (raa.responseText == "true")
                                    webix.message("Ano lectivo actualizado com sucesso.");
                                else
                                    webix.message({ type: "error", text: "Erro ao actualizar o ano lectivo na pauta." });
                                //actualizar dados
                                var bi = $$("idtext_bi_ed").getValue();
                                var n = $$("idtext_nnome").getValue();
                                var c = $$("idtext_cnome").getValue();
                                var p = $$("idtext_pnome").getValue();
                                var s = $$("idCB_sNome_ed").getValue();
                                if (bi && n && c && p && s) {
                                    $$("idDTED").clearAll();
                                    $$("idDTED").load(BASE_URL + "Cacademica_estudantes_disciplinas/read_disc_semestre?n=" + n + "&c=" + c +
                                        "&p=" + p +
                                        "&s=" + s +
                                        "&bi=" + bi);
                                }
                            } else
                                webix.message({ type: "error", text: "Erro, Deve seleccionar primeiro uma disciplina." });
                        }
                    },
                    {
                        view: "button", type: "danger", value: "Cancelar Mat. Disc.", width: 140, click: function () {
                            var idSelecionado = $$('idDTED').getSelectedId();
                            if (idSelecionado) {
                                //cargar datos
                                var bi = $$("idtext_bi_ed").getValue();
                                var envio = "bi=" + bi;
                                var rbi = webix.ajax().sync().post(BASE_URL + "cEstudantes/get_idXbi", envio);
                                var ide = rbi.responseText;

                                var record = $$("idDTED").getItem(idSelecionado);

                                webix.confirm({
                                    title: "Confirmação",
                                    type: "confirm-warning",
                                    ok: "Sim", cancel: "Nao",
                                    text: "Est&aacute; seguro que deseja cancelar matrícula da disciplina selecionada",
                                    callback: function (result) {
                                        if (result) {
                                            //cancelar matricula pauta
                                            var envio_cmd = "ide=" + ide + "&idd=" + record.id;
                                            var r = webix.ajax().sync().post(BASE_URL + "cpautas/cancelar_matricula_disciplina", envio_cmd);
                                            //cancelar matricula Estudantes_Dicisplinas
                                            var envio_ced = "id=" + ide + "&idd=" + record.id + "&webix_operation=delete";
                                            var rced = webix.ajax().sync().post(BASE_URL + "Cacademica_estudantes_disciplinas/crud", envio_ced);

                                            if (r.responseText == "true" && rced.responseText == "true") {
                                                webix.message("Matrícula cancelada com sucesso");
                                                //actualizar dados
                                                var bi = $$("idtext_bi_ed").getValue();
                                                var n = $$("idtext_nnome").getValue();
                                                var c = $$("idtext_cnome").getValue();
                                                var p = $$("idtext_pnome").getValue();
                                                var s = $$("idCB_sNome_ed").getValue();
                                                if (bi && n && c && p && s) {
                                                    $$("idDTED").clearAll();
                                                    $$("idDTED").load(BASE_URL + "Cacademica_estudantes_disciplinas/read_disc_semestre?n=" + n + "&c=" + c +
                                                        "&p=" + p +
                                                        "&s=" + s +
                                                        "&bi=" + bi);
                                                }
                                            }
                                            else
                                                webix.message({ type: "error", text: "Erro, não é posivel cancelar matrícula, contacte o administrador" });
                                        }
                                    }
                                });
                            } else {
                                webix.message({ type: "error", text: "Erro, selecione primeiro uma disciplina activa" });
                            }
                        }
                    },
                    {
                        view: "button", type: "standard", value: "Actualizar", width: 140, click: function () {
                            //actualizar dados
                            var bi = $$("idtext_bi_ed").getValue();
                            var n = $$("idtext_nnome").getValue();
                            var c = $$("idtext_cnome").getValue();
                            var p = $$("idtext_pnome").getValue();
                            var s = $$("idCB_sNome_ed").getValue();
                            if (bi && n && c && p && s) {
                                $$("idDTED").clearAll();
                                $$("idDTED").load(BASE_URL + "Cacademica_estudantes_disciplinas/read_disc_semestre?n=" + n + "&c=" + c +
                                    "&p=" + p +
                                    "&s=" + s +
                                    "&bi=" + bi);
                            }
                        }
                    },
                    {}
                ]
            },
            {
                view: "datatable",
                id: "idDTED",
                height: 420,
                //select: "row", /*editable: true, editaction: "click",*/
                columns: [
                    { id: "bi", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                    { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                    { id: "ord", header: "Nº", css: "rank", width: 40, sort: "int" },
                    {
                        id: "destado", header: "Estado", width: 60, sort: "string",
                        template: function (obj) {
                            if (obj.destado == "off")
                                return "<span style='color:red;'>" + obj.destado + "</span>";
                            else
                                return "<span style='color:green;'>" + obj.destado + "</span>";

                        },
                    },
                    {
                        id: "activa", header: "activa", width: 60, sort: "string",
                        template: function (obj) {
                            if (obj.activa == "Sim")
                                return "<span style='color:green;'>" + obj.activa + "</span>";
                            else
                                return "<span style='color:red;'>" + obj.activa + "</span>";

                        },
                    },
                    { id: "ano_lec", header: "Ano", width: 50, sort: "int" },
                    //{ id:"activar", header:["Activar",{content:"masterCheckbox" }], checkValue:'on', uncheckValue:'off', template:"{common.checkbox()}", width:80},
                    ///////{ id: "activa", header: "Activa", width: 70, sort: "string" },
                    { id: "dnome", header: "Disciplina", width: 320, sort: "string" },
                    { id: "ddnome", header: "Duração", width: 100, sort: "string" },
                    //{ id: "estado", header: "Resultado", width: 100, sort: "string" },
                    {
                        id: "estado", header: "Resultado", width: 100, sort: "string",
                        template: function (obj) {
                            if (obj.estado == "Reprovado")
                                return "<span style='color:red;'>" + obj.estado + "</span>";
                            else {
                                if (obj.estado == null)
                                    return "<span style='color:red;'>" + 'Reprovado' + "</span>";
                                else
                                    return "<span style='color:green;'>" + obj.estado + "</span>";
                            }

                        },
                    },
                    { id: "repeticoes", editor: "text", header: "Ocasi&atilde;o", width: 85, sort: "int" },
                    { id: "dgnome", editor: "text", header: "Gera&ccedil;&atilde;o Disc.", width: 110, sort: "string" },
                    { id: "dprecedencia1_id", header: "Precedencia 1", width: 200, sort: "string" },
                    { id: "dprecedencia2_id", header: "Precedencia 2", width: 200, sort: "string" },
                    { id: "dprecedencia3_id", header: "Precedencia 3", width: 200, sort: "string" },

                ],
                resizeColumn: true,
                select: "row", //editable: true, editaction: "click",
                save: BASE_URL + "cacademica_estudantes_disciplinas/crud",
                url: BASE_URL + "cacademica_estudantes_disciplinas/read_disc_semestre",
                pager: "pagerCDadosED"
            }, {
                view: "pager", id: "pagerCDadosED",
                template: "{common.prev()} {common.pages()} {common.next()}",
                size: 25,
                group: 10
            }, {
                cols: [
                    {},
                    {
                        view: "button", type: "form", value: "Transitar", width: 140, click: function () {

                        }
                    },
                    {
                        view: "button", type: "danger", value: "Repetir", width: 140, click: function () {

                        }
                    },
                    {}
                ]
            },

        ]
    }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};

var form_ano_lec = {
    view: "form",
    id: "idform_ano_lec",
    borderless: true,
    elements: [
        {
            rows: [
                {
                    view: "richselect",
                    label: 'Ano Lectivo',
                    labelPosition: "top",
                    name: "alAno",
                    id: "idalAno_mat_est_disc",
                    //width: 80,
                    //value: ,
                    options: {
                        body: {
                            template: "#alAno#",
                            yCount: 7,
                            url: BASE_URL + "CAnos_Lectivos/read"
                        }
                    },
                },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var al = $$('idalAno_mat_est_disc').getText();
                        if (al) {
                            var bi = $$("idtext_bi_ed").getValue();
                            var envio = "bi=" + bi;
                            var rbi = webix.ajax().sync().post(BASE_URL + "cEstudantes/get_idXbi", envio);
                            var ide = rbi.responseText;

                            var idSelecionado = $$("idDTED").getSelectedId(false, true);
                            if (idSelecionado) {
                                var record = $$("idDTED").getItem(idSelecionado);

                                var p1 = "";
                                var p2 = "";
                                var p3 = "";
                                //cambiar nombre por id
                                if (record.dprecedencia1_id) {
                                    var enviop1 = "dnome=" + record.dprecedencia1_id;
                                    var rp1 = webix.ajax().sync().post(BASE_URL + "cdisciplinas/readXnome", enviop1);
                                    var p1 = rp1.responseText;
                                }
                                if (record.dprecedencia2_id) {
                                    var enviop2 = "dnome=" + record.dprecedencia2_id;
                                    var rp2 = webix.ajax().sync().post(BASE_URL + "cdisciplinas/readXnome", enviop2);
                                    var p2 = rp2.responseText;
                                }
                                if (record.dprecedencia3_id) {
                                    var enviop3 = "dnome=" + record.dprecedencia3_id;
                                    var rp3 = webix.ajax().sync().post(BASE_URL + "cdisciplinas/readXnome", enviop3);
                                    var p3 = rp3.responseText;
                                }

                                var estado_precedencia1;
                                var estado_precedencia2;
                                var estado_precedencia3;
                                //ver si existem precedencias para esta disciplina en estado reprovada.
                                if (p1 != "") {
                                    //verificar 1 precedencia
                                    var envio11 = "ide=" + ide + "&idd=" + p1;
                                    var r11 = webix.ajax().sync().post(BASE_URL + "CPautas/read_estado_est_disc", envio11);
                                    estado_precedencia1 = r11.responseText;
                                }
                                if (p2 != "") {
                                    //verificar 2 precedencia
                                    var envio22 = "ide=" + ide + "&idd=" + p2;
                                    var r22 = webix.ajax().sync().post(BASE_URL + "CPautas/read_estado_est_disc", envio22);
                                    estado_precedencia2 = r22.responseText;
                                }
                                if (p3 != "") {
                                    //verificar 3 precedencia
                                    var envio33 = "ide=" + ide + "&idd=" + p3;
                                    var r33 = webix.ajax().sync().post(BASE_URL + "CPautas/read_estado_est_disc", envio33);
                                    estado_precedencia3 = r33.responseText;
                                }
                                //saber si  esta disciplina tiee precedencias o no.
                                var envioep = "idd=" + record.id;
                                var rep = webix.ajax().sync().post(BASE_URL + "cdisciplinas/read_existem_precedencias", envioep);
                                existem_prec = rep.responseText;

                                //ver si no tiene deuda con alguna precedencia
                               ////// if (existem_prec == "false" || estado_precedencia1 == "Aprovado" || estado_precedencia2 == "Aprovado" || estado_precedencia3 == "Aprovado") {
                                    if (ide && record.id) {
                                        //ver si existe el est antes de inserir
                                        var envio4 = "bi=" + bi + "&idd=" + record.id;
                                        var r4 = webix.ajax().sync().post(BASE_URL + "CPautas/existe_est", envio4);
                                        if (r4.responseText == "false") {
                                            //inserir na pauta
                                            var envio2 = "Estudantes_id=" + ide + "&Disciplinas_id=" + record.id + "&al=" + al;
                                            var r = webix.ajax().sync().post(BASE_URL + "cPautas/insert_inicializar", envio2);
                                        } else
                                            webix.message({ type: "error", text: "Erro, Os dados ja existem na Base de Dados" });
                                        //ver si existe el est antes de inserir
                                        var envio3 = "bi=" + bi + "&idd=" + record.id;
                                        var r = webix.ajax().sync().post(BASE_URL + "cacademica_estudantes_disciplinas/existe_d_e", envio3);
                                        if (r.responseText == "false") {
                                            //inserir em Estudantes_Disciplinas
                                            $$('idDTED').add({
                                                idd: record.id,
                                                bi: bi,
                                                al: al
                                            });
                                        } else
                                            webix.message({ type: "error", text: "Erro, Os dados ja existem na Base de Dados" });
                                    } else
                                        webix.message({ type: "error", text: "Erro, Faltam dados por inserir ou seleccionar" });

                            /*    } else
                                    webix.message({ type: "error", text: "Erro, Esta disciplina tem precedencias em estado reprovado." });
                            */

                                //actualizar dados
                                var bi = $$("idtext_bi_ed").getValue();
                                var n = $$("idtext_nnome").getValue();
                                var c = $$("idtext_cnome").getValue();
                                var p = $$("idtext_pnome").getValue();
                                var s = $$("idCB_sNome_ed").getValue();
                                if (bi && n && c && p && s) {
                                    $$("idDTED").clearAll();
                                    $$("idDTED").load(BASE_URL + "Cacademica_estudantes_disciplinas/read_disc_semestre?n=" + n + "&c=" + c +
                                        "&p=" + p +
                                        "&s=" + s +
                                        "&bi=" + bi);
                                }

                                $$("id_win_ano_lec").close();

                            } else
                                webix.message({ type: "error", text: "Erro, Deve seleccionar primeiro uma disciplina." });
                        } else
                            webix.message({ type: "error", text: "Erro, Deve seleccionar primeiro um ano lectivo." });
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("id_win_ano_lec").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
