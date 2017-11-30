function cargarVistaResultados_Exame_Acesso_2S(itemID) {

    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Resultados", body: {
                    //id:"Niveis de Acessos",
                    id: "idResultados_Exame_Acesso_2S",
                    rows: [
                        {
                            //view:"flexlayout",
                            type: "line",
                            responsive: "idResultados_Exame_Acesso_2S",
                            rows: [
                                {
                                    view: "form", scroll: false, elements: [
                                        {
                                            cols: [
                                                {},
                                                {
                                                    rows: [
                                                        {
                                                            cols: [
                                                                {
                                                                    view: "text", width: 300, id: "idCodigo_Barra",
                                                                    label: 'C&oacute;digo Barra', name: "Codigo_Barra",
                                                                    type: 'password',
                                                                    labelWidth: 100,
                                                                    //labelPosition: "top",
                                                                    on: {
                                                                        "onChange": function (newv, oldv) {
                                                                            //determinar se o usuario logeado pertence ao nivel de acesso administradores?
                                                                            var nivel_acesso = webix.ajax().sync().post(BASE_URL + "Cutilizadores/readAcesso", "usuario=" + user_sessao);
                                                                            //alert(nivel_acesso.responseText);

                                                                            var cNome = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso_2S/readNome", "nivel_acesso=" + nivel_acesso.responseText + "&cb=" + this.getValue());
                                                                            var cNomes = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso_2S/readNomes", "nivel_acesso=" + nivel_acesso.responseText + "&cb=" + this.getValue());
                                                                            var cApelido = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso_2S/readApelido", "nivel_acesso=" + nivel_acesso.responseText + "&cb=" + this.getValue());
                                                                            var cBI = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso_2S/readBI", "nivel_acesso=" + nivel_acesso.responseText + "&cb=" + this.getValue());

                                                                            var nivel = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso_2S/readNivel", "cb=" + this.getValue());
                                                                            var curso = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso_2S/readCurso", "cb=" + this.getValue());
                                                                            var periodo = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso_2S/readPeriodo", "cb=" + this.getValue());
                                                                            var turma = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso_2S/readTurma", "nivel_acesso=" + nivel_acesso.responseText + "&cb=" + this.getValue());
                                                                            var nota = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso_2S/readNota", "cb=" + this.getValue());

                                                                            if (cNome && cNomes && cApelido && cBI && nivel && curso && periodo && turma && nota) {
                                                                                $$("idREA_Nome_Valor").setValue(cNome.responseText);
                                                                                $$("idREA_Nomes_Valor").setValue(cNomes.responseText);
                                                                                $$("idREA_Apelido_Valor").setValue(cApelido.responseText);
                                                                                $$("idREA_BI_Valor").setValue(cBI.responseText);

                                                                                $$("idREA_Nivel_Valor").setValue(nivel.responseText);
                                                                                $$("idREA_Curso_Valor").setValue(curso.responseText);
                                                                                $$("idREA_Periodo_Valor").setValue(periodo.responseText);
                                                                                $$("idREA_Sala_Valor").setValue(turma.responseText);

                                                                                $$("idCounter_Nota").setValue(nota.responseText);

                                                                                if ($$('idCodigo_Barra').getValue() !== "") {
                                                                                    var p = webix.ajax().sync().post(BASE_URL + "CAcademica_Presencas_Exame_Acesso_2S/readXpresente", "cb=" + this.getValue());
                                                                                    presente = p.responseText;

                                                                                    if (presente !== "true")
                                                                                        webix.message({ type: "error", text: "Candidato ausente ao exame de acesso" });

                                                                                    if (nota.responseText == 0 && presente == "true")
                                                                                        $$("idCounter_Nota").enable();
                                                                                    else
                                                                                        $$("idCounter_Nota").disable();
                                                                                }


                                                                            } else
                                                                                webix.message({ type: "error", text: "N&atilde;o foi pos&iacute;vel carregar a informa&ccedil;&atilde;o na Base de Dados" });
                                                                        }
                                                                    },
                                                                },
                                                                {}
                                                            ]
                                                        },
                                                        { height: 30 },
                                                        {
                                                            cols: [
                                                                { view: "label", id: "idREA_Nome", label: "Nome: ", width: 100, inputWidth: 100 },
                                                                { view: "label", id: "idREA_Nome_Valor", label: "", width: 300, inputWidth: 100 },
                                                                //{},
                                                                { view: "label", id: "idREA_Nivel", label: "N&iacute;vel:", width: 50, inputWidth: 50 },
                                                                { view: "label", id: "idREA_Nivel_Valor", label: "", width: 300, inputWidth: 50 },
                                                                {}
                                                            ]
                                                        },
                                                        { height: 10 },
                                                        {
                                                            cols: [
                                                                { view: "label", id: "idREA_Nomes", label: "Nomes: ", width: 100, inputWidth: 100 },
                                                                { view: "label", id: "idREA_Nomes_Valor", label: "", width: 300, inputWidth: 100 },
                                                                //{},
                                                                { view: "label", id: "idREA_Curso", label: "Curso:", width: 50, inputWidth: 50 },
                                                                { view: "label", id: "idREA_Curso_Valor", label: "", width: 300, inputWidth: 50 },
                                                                {}
                                                            ]
                                                        },
                                                        { height: 10 },
                                                        {
                                                            cols: [
                                                                { view: "label", id: "idREA_Apelido", label: "Apelido:", width: 100, inputWidth: 100 },
                                                                { view: "label", id: "idREA_Apelido_Valor", label: "", width: 300, inputWidth: 100 },
                                                                //{},
                                                                { view: "label", id: "idREA_Periodo", label: "Per&iacute;odo:", width: 50, inputWidth: 50 },
                                                                { view: "label", id: "idREA_Periodo_Valor", label: "", width: 300, inputWidth: 50 },
                                                                {}
                                                            ]
                                                        },
                                                        { height: 10 },
                                                        {
                                                            cols: [
                                                                { view: "label", id: "idREA_BI", label: "BI/Passaporte:", width: 100, inputWidth: 100 },
                                                                { view: "label", id: "idREA_BI_Valor", label: "", width: 300, inputWidth: 100 },
                                                                //{},
                                                                { view: "label", id: "idREA_Sala", label: "Sala:", width: 50, inputWidth: 50 },
                                                                { view: "label", id: "idREA_Sala_Valor", label: "", width: 300, inputWidth: 50 },
                                                                {}
                                                            ]
                                                        },
                                                        { height: 30 },
                                                        {
                                                            cols: [
                                                                { width: 110 },
                                                                { view: "counter", label: "Nota_Exame", id: "idCounter_Nota", width: 200, align: "center", labelWidth: 100 },
                                                                {}
                                                            ]
                                                        },
                                                        { height: 30 },
                                                        {
                                                            cols: [
                                                                {
                                                                    view: "button", type: "form", value: "Salvar", width: 100, click: function () {

                                                                        var nivel_acesso = webix.ajax().sync().post(BASE_URL + "Cutilizadores/readAcesso", "usuario=" + user_sessao);


                                                                        var cb = $$('idCodigo_Barra').getValue();
                                                                        var nota = $$('idCounter_Nota').getValue();
                                                                        if (cb && nota) {
                                                                            var r = webix.ajax().sync().post(BASE_URL + "CAcademica_Resultados_Exame_Acesso_2S/crud", "webix_operation=update&cb=" + cb + "&apecNota=" + nota + 
                                                                                    "&user_sessao=" + user_sessao + "&na="+nivel_acesso);
                                                                            if (r.responseText == "true") {
                                                                                webix.message("Dados inseridos com sucesso");
                                                                                //limpar componentes
                                                                                $$("idCodigo_Barra").setValue("");

                                                                                $$("idREA_Nome_Valor").setValue("");
                                                                                $$("idREA_Nomes_Valor").setValue("");
                                                                                $$("idREA_Apelido_Valor").setValue("");
                                                                                $$("idREA_BI_Valor").setValue("");

                                                                                $$("idREA_Nivel_Valor").setValue("");
                                                                                $$("idREA_Curso_Valor").setValue("");
                                                                                $$("idREA_Periodo_Valor").setValue("");
                                                                                $$("idREA_Sala_Valor").setValue("");
                                                                            } else
                                                                                webix.message({ type: "error", text: "Erro inserindo dados" });
                                                                        } else
                                                                            webix.message({ type: "error", text: "Erro faltam dados" });
                                                                    }
                                                                },
                                                                {},
                                                                {
                                                                    view: "button", type: "danger", value: "Cancelar", width: 100, click: function () {
                                                                        $$("idCodigo_Barra").setValue("");

                                                                        $$("idREA_Nome_Valor").setValue("");
                                                                        $$("idREA_Nomes_Valor").setValue("");
                                                                        $$("idREA_Apelido_Valor").setValue("");
                                                                        $$("idREA_BI_Valor").setValue("");

                                                                        $$("idREA_Nivel_Valor").setValue("");
                                                                        $$("idREA_Curso_Valor").setValue("");
                                                                        $$("idREA_Periodo_Valor").setValue("");
                                                                        $$("idREA_Sala_Valor").setValue("");

                                                                        $$("idCounter_Nota").enable();
                                                                    }
                                                                },
                                                                {}
                                                            ]
                                                        }
                                                    ]
                                                },
                                                {}
                                            ]
                                        }
                                    ]
                                }
                            ]
                        },
                    ]
                }
            }
        ]
    });
}