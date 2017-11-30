function cargarVistaMatricula(itemID) {
    function Nota_css(value) {
        if (value == "Não Admitido")
            return "vermelho_css";
        else
            return "verde_css"
    }
    function Condicionado_css(value){
        if (value == "Não")
            return "vermelho_css";
        else
            return "verde_css"
    }
    $$("views").addView({
        view: "tabview",
        id: itemID,
        height: 900,
        cells: [
            {
                //regime e sessao na BD
                header: "Lista Candidatos Aprovados", body: {
                    //id:"Niveis de Acessos",
                    id: "idMatricula",
                    rows: [
                        {
                            //view:"flexlayout",
                            type: "line",
                            responsive: "idMatricula",
                            rows: [
                                {
                                    view: "form", id: "idform_DP_superior_grid_M", height: 125, minHeight: 10, maxHeight: 120, scroll: false,
                                    cols: [
                                        {},
                                        { view: "template", id: "id_template_foto_M", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Funcionarios/default.jpg /></div>' }
                                    ]
                                },
                                {
                                    view: "form", scroll: false,
                                    cols: [
                                        {
                                            view: "button", type: "form", value: "Matricular", width: 120, height: 50, click: function () {
                                                //get cid, nivel, curso e periodo da grid
                                                var rowId = $$("idDTEdMatricula").getSelectedId(false, true);

                                                if (rowId) {
                                                    var record = $$("idDTEdMatricula").getItem(rowId);
                                                    var idSelecionado = record.cid;
                                                    var n = record.nid;
                                                    var c = record.cursoid;
                                                    var p = record.pid;
                                                    var bi = record.cBI_Passaporte;
                                                    var envio_existe = "id=" + idSelecionado;
                                                    var rex = webix.ajax().sync().post(BASE_URL + "CEstudantes/Existe", envio_existe);
                                                    //comprobar si ya esta matriculado
                                                    if (rex.responseText == "false") {
                                                        if (record.emEstado == "Não Matriculado") {
                                                            //seleccionar turma para matricular
                                                            webix.ui({
                                                                view: "window",
                                                                id: "id_win_add_turma",
                                                                width: 600,
                                                                position: "center",
                                                                modal: true,
                                                                head: "Editar Dados",
                                                                body: webix.copy(formADDTurma)
                                                            }).show();
                                                            //actualizar campos de la windows
                                                            if (n && c && p) {
                                                                $$("idtNome").getList().clearAll();
                                                                $$("idtNome").getList().load(BASE_URL + "CTurmas/readXncp?nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&ac=" + 1);
                                                            }

                                                        } else
                                                            webix.message({ type: "error", text: "Erro, o estudantes ja foi matriculado" });
                                                    } else
                                                        webix.message({ type: "error", text: "Erro, o estudantes ja foi matriculado em outro curso" });
                                                } else
                                                    webix.message({ type: "error", text: "Erro, deve seleccionar primeiro un camdidato" });
                                            }
                                        },
                                        //
                                        {
                                            view: "button", type: "danger", value: "Editar Foto", disabled: false, width: 120, height: 50, click: function () {

                                                var rowId = $$("idDTEdMatricula").getSelectedId(false, true);
                                                var record = $$("idDTEdMatricula").getItem(rowId);
                                                var idSelecionado = record.cid;

                                                //locallizar el codifoFoto en la tabla Funcionarios
                                                var envio = "id=" + idSelecionado;
                                                var r = webix.ajax().sync().post(BASE_URL + "cCandidatos/cargarFoto", envio);
                                                var CODIGO_FOTO = r.responseText;

                                                if (idSelecionado) {
                                                    //preparar webcam
                                                    webix.ui({
                                                        view: "window",
                                                        id: "idwinADDFotoCandidatos_M",
                                                        width: 460,
                                                        position: "center",
                                                        modal: true,
                                                        head: "Editar Foto",
                                                        //body:webix.copy(formADDFoto)
                                                        //formFoto
                                                        body: webix.copy(formFoto_M(CODIGO_FOTO))
                                                    }).show();
                                                } else {
                                                    webix.message({ type: "error", text: "Deve selecionar primeriro um funcion&aacute;rio" });
                                                }

                                            }
                                        },
                                        {
                                            view: "button", type: "danger", id: "idbtn_Apagar_Candidato", value: "Apagar", disabled: true, width: 120, height: 50, click: function () {
                                                var idSelecionado = $$('idDTEdDadosPesoais').getSelectedId();
                                                if (idSelecionado) {
                                                    webix.confirm({
                                                        title: "Confirmação",
                                                        type: "confirm-warning",
                                                        ok: "Sim", cancel: "Nao",
                                                        text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                                        callback: function (result) {
                                                            if (result) {
                                                                $$('idDTEdDadosPesoais').remove(idSelecionado);
                                                                //actualizar todas las grid
                                                                $$("idDTEdDadosPesoais").clearAll();
                                                                $$("idDTEdDadosPesoais").load(BASE_URL + "cCandidatos/readDP");
                                                                $$("idDTEdDadosPesoais").clearAll();
                                                                $$("idDTEdDadosPesoais").load(BASE_URL + "cCandidatos/readDP");
                                                                $$("idDTEdDadosAcademicos").clearAll();
                                                                $$("idDTEdDadosAcademicos").load(BASE_URL + "cCandidatos/readDACA");
                                                                $$("idDTEdDadosLocalizacao").clearAll();
                                                                $$("idDTEdDadosLocalizacao").load(BASE_URL + "cCandidatos/readDLOC");
                                                            }
                                                        }
                                                    });
                                                } else {
                                                    webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                                }

                                            }

                                        },
                                        {
                                            view: "button", type: "standard", value: "Actualizar", width: 120, height: 50, click: function () {


                                                webix.extend($$("app"), webix.ProgressBar);
                                                function show_progress_bar(delay) {
                                                    //
                                                    $$("idDTEdMatricula").clearAll();
                                                    $$("idDTEdMatricula").load(BASE_URL + "CAcademica_Matricula/read");
                                                    //
                                                    $$("app").disable();
                                                    $$("app").showProgress({
                                                        type: "top",
                                                        delay: delay,
                                                        hide: true
                                                    });
                                                    setTimeout(function () {
                                                        //conteudo

                                                        //
                                                        $$("app").enable();
                                                    }, delay);
                                                }
                                                setTimeout(show_progress_bar(20000), 0);
                                            }
                                        },
                                        /*  {
                                              view: "button", type: "form", id: "idbtn_Exportar_Dados", value: "Exportar Dados", disabled: true, width: 120, height: 50, click: function () {
                                                  //criar excel
                                                  var envio = "user=" + user_sessao;
                                                  var r = webix.ajax().sync().post(BASE_URL + "CExportar_Dados_Excel/Dados_Inscricao", envio);
                                                  webix.send(BASE_URL + "CExportar_Dados_Excel/Dados_Inscricao", null, "GET");
                                                  //  if (r.responseText == "true") {
                                                   //     webix.message("Excel criado com sucesso");
                                                        
                                                   // } else {
                                                   //     webix.message({ type: "error", text: "Erro Exportando dados" });
                                                   // }
                                                    
                                              }
                                          },
                                          */
                                        {
                                            view: "button", type: "form", label: "Exportar Dados", width: 120, click: function () {
                                                //webix.toExcel($$("idDTEdMatricula"));
                                                webix.cdn = PRO_URL + "webix";
                                                webix.toExcel($$("idDTEdMatricula"), {
                                                    filename: "Matriculas",
                                                    //name: "Ranks",
                                                    /*   columns: {
                                                           "rank": { header: "Rank", width: 50 },
                                                           "title": { header: "Title", width: 200 }
                                                       }*/
                                                });
                                            }
                                        },
                                        {},
                                        //{view:"template",width:320,template:'<div id="my_camera">'+'<img src='+PRO_URL+'Fotos/Funcionarios/'+CODIGO_FOTO+'.jpg /></div>'},
                                        //
                                        //{view:"template",width:320,template:'html->my_img_default'},
                                    ]

                                },
                                {
                                    view: "datatable",
                                    id: "idDTEdMatricula",
                                    columns: [
                                        { id: "cid", header: "cid", hidden: true, css: "rank", width: 50, sort: "int" },
                                        { id: "nid", header: "nid", hidden: true, css: "rank", width: 50, sort: "int" },
                                        { id: "cursoid", header: "cursoid", hidden: true, css: "rank", width: 50, sort: "int" },
                                        { id: "pid", header: "pid", hidden: true, css: "rank", width: 50, sort: "int" },

                                        { id: "orden", header: "Nº", css: "rank", width: 50, sort: "int" },
                                        {
                                            id: "emEstado", header: ["Estado", { content: "selectFilter" }], width: 170, sort: "string",
                                            template: function (obj) {
                                                if (obj.emEstado == "Não Matriculado")
                                                    return "<span style='color:red;'>" + obj.emEstado + "</span>";
                                                else
                                                    if (obj.emEstado == "Mat.Esp.Pag")
                                                        return "<span style='color:orange;'>" + obj.emEstado + "</span>";
                                                    else
                                                        return "<span style='color:green;'>" + obj.emEstado + "</span>";

                                            },
                                        },
                                        { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                        //{ id: "cNomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "cBI_Passaporte", header: ["cBI_Passaporte", { content: "textFilter" }], width: 170, sort: "string" },
                                        { id: "nNome", header: ["Nível", { content: "selectFilter" }], width: 120, sort: "string" },
                                        { id: "curso", header: ["Curso", { content: "selectFilter" }], width: 220, sort: "string" },
                                        { id: "pNome", header: ["Período", { content: "selectFilter" }], width: 120, sort: "string" },
                                        {
                                            id: "apecNota", editor: "text", header: "Nota", width: 70, sort: "int", format: webix.Number.numToStr({
                                                groupDelimiter: ",",
                                                groupSize: 2,
                                                decimalDelimiter: ",",
                                                decimalSize: 2
                                            })
                                        },
                                        {
                                            id: "estado", header: "Estado",
                                            /*template: function (obj) { 
                                                if (obj.apecNota >= 10) 
                                                    return "Aprovado"; 
                                                    else return "Reprovado"; 
                                            },*/
                                            width: 110, sort: "string", //css:{"color":"#B51454"}
                                            cssFormat: Nota_css
                                        },

                                        { id: "condicionado", header: ["Condicionado", { content: "textFilter" }], width: 100, sort: "string",cssFormat: Condicionado_css},
                                        
                                        //condicionado
                                        { id: "apecCodigoBarra", header: "apecCodigoBarra", hidden: true, css: "rank", width: 50 },
                                        { id: "provNome", header: ["Provincia Formação ", { content: "selectFilter" }], width: 170, sort: "string" },
                                    ],
                                    resizeColumn:true,
                                    on: {
                                        "onAfterSelect": function (id) {
                                            //var idSelecionado = $$("idDTEdDadosPesoais").getSelectedId(false, true);
                                            var rowId = $$("idDTEdMatricula").getSelectedId(false, true);
                                            var record = $$("idDTEdMatricula").getItem(rowId);
                                            var idSelecionado = record.cid;

                                            var envio = "id=" + idSelecionado;
                                            var r = webix.ajax().sync().post(BASE_URL + "cCandidatos/cargarFoto", envio);
                                            var CODIGO_FOTO = r.responseText;
                                            if (CODIGO_FOTO) {
                                                // idform_DP_superior_grid
                                                $$("idform_DP_superior_grid_M").removeView("id_template_foto_M");
                                                $$("idform_DP_superior_grid_M").addView({ view: "template", id: "id_template_foto_M", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Candidatos/' + CODIGO_FOTO + '.jpg /></div>' }, 2);
                                            } else {
                                                // idform_DP_superior_grid
                                                $$("idform_DP_superior_grid_M").removeView("id_template_foto_M");
                                                $$("idform_DP_superior_grid_M").addView({ view: "template", id: "id_template_foto_M", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Candidatos/default.jpg /></div>' }, 2);
                                            }
                                            //{view:"template",width:320,template:'<div id="my_camera">'+'<img src='+PRO_URL+'Fotos/Funcionarios/'+CODIGO_FOTO+'.jpg /></div>'},
                                        }
                                    },
                                    //height: true,
                                    //autowidth: true,
                                    select: "row", //editable: true, editaction: "click",
                                    //save: BASE_URL + "CAcademica_Listas_Resultados_Exame_Acesso/crud",
                                    url: BASE_URL + "CAcademica_Matricula/read",
                                    pager: "pagerMatricula"
                                }, {
                                    view: "pager", id: "pagerMatricula",
                                    template: "{common.prev()} {common.pages()} {common.next()}",
                                    size: 25,
                                    group: 10
                                }
                            ]
                        },
                    ]
                }
            }
        ]
    });

}

function formFoto_M(CODIGO_FOTO) {
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
                        { view: "template", width: 480, template: '<div id="my_camera">' + '<img src=' + PRO_URL + 'Fotos/Candidatos/' + CODIGO_FOTO + '.jpg /></div>' },
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
                                //var idSelecionado = $$("idDTEdMatricula").getSelectedId(false, true);
                                var rowId = $$("idDTEdMatricula").getSelectedId(false, true);
                                var record = $$("idDTEdMatricula").getItem(rowId);
                                var idSelecionado = record.cid;

                                Webcam.snap(function (data_uri) {
                                    // display results in page
                                    document.getElementById('my_camera').innerHTML = '<img src="' + data_uri + '"/>';
                                    Webcam.upload(data_uri, BASE_URL + 'cCandidatos/salvarFoto?id=' + idSelecionado, function (code, text) {
                                        if (text !== "true") {
                                            webix.message({ type: "error", text: "Deve selecionar primeriro um Candidato" });
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
                                //cargar foto
                                //var idSelecionado = $$("idDTEdMatricula").getSelectedId(false, true);
                                var rowId = $$("idDTEdMatricula").getSelectedId(false, true);
                                var record = $$("idDTEdMatricula").getItem(rowId);
                                var idSelecionado = record.cid;

                                var envio = "id=" + idSelecionado;
                                var r = webix.ajax().sync().post(BASE_URL + "cCandidatos/cargarFoto", envio);
                                var CODIGO_FOTO = r.responseText;
                                if (CODIGO_FOTO) {
                                    // idform_DP_superior_grid
                                    $$("idform_DP_superior_grid_M").removeView("id_template_foto_M");
                                    $$("idform_DP_superior_grid_M").addView({ view: "template", id: "id_template_foto_M", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Candidatos/' + CODIGO_FOTO + '.jpg /></div>' }, 2);
                                } else {
                                    $$("idform_DP_superior_grid_M").removeView("id_template_foto_M");
                                    $$("idform_DP_superior_grid_M").addView({ view: "template", id: "id_template_foto_M", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Candidatos/default.jpg /></div>' }, 2);
                                }

                                $$("idwinADDFotoCandidatos_M").close();
                            }
                        }
                    ]
                }

            ]
        }]
    };
    return formADDFoto;
}

var formADDTurma = {
    view: "form",
    id: "idformADDTurma",
    borderless: true,
    elements: [
        {
            rows: [
                { view: "text", label: 'id', name: "id", id: "idText_id", hidden: true },
                {
                    view: "richselect", width: 170, id: "idtNome",
                    label: 'Turma', name: "tNome",
                    labelPosition: "top",
                    options: {
                        body: {
                            template: "#tNome#",
                            yCount: 7,
                            url: BASE_URL + "CTurmas/read"
                        }
                    }
                },
            ]
        }, {
            cols: [
                {
                    view: "button", value: "Aceitar", click: function () {
                        var rowId = $$("idDTEdMatricula").getSelectedId(false, true);
                        var record = $$("idDTEdMatricula").getItem(rowId);
                        var idSelecionado = record.cid;
                        var n = record.nid;
                        var c = record.cursoid;
                        var p = record.pid;

                        var bi = record.cBI_Passaporte;
                        var turma_id = $$('idtNome').getValue();

                        //insertar estos datos en la tabla estudantes
                        var envio_estudantes = "Candidatos_id=" + idSelecionado + "&nNome=" + n + "&cNome=" + c + "&pNome=" + p + "&webix_operation=insert" + "&turma_id=" + turma_id;
                        var re = webix.ajax().sync().post(BASE_URL + "CEstudantes/insert_matricula", envio_estudantes);
                        if (re.responseText == "true") {
                            webix.message("Estudante matriculado com sucesso");
                            //imprimir comprovativo
                            var d = new Date();
                            var dataActual = d.getFullYear() + "" + (d.getMonth() + 1) + "" + d.getDate();
                            var horaActual = d.getHours() + "" + d.getMinutes() + "" + d.getSeconds();

                            var envio_imp = "bi=" + bi + "&utilizadores_id=" + user_sessao + "&data=" + dataActual + "&hora=" + horaActual;
                            var rimp = webix.ajax().sync().post(BASE_URL + "Cacademica_matricula_comprobativo/imprimir", envio_imp);
                            if (rimp.responseText == "true") {
                                webix.ui({
                                    view: "window",
                                    id: "idWinPDFCP_ComprobativoM",
                                    height: 600,
                                    width: 700,
                                    left: 50, top: 50,
                                    move: true,
                                    modal: true,
                                    //head:"This window can be moved",
                                    head: {
                                        view: "toolbar", cols: [
                                            { view: "label", label: "Comprovativo de Inscri&ccedil;&atilde;o" },
                                            { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFCP_ComprobativoM').close(); } }
                                        ]
                                    },
                                    body: {
                                        //template:"Some text"
                                        template: '<div id="idPDF_ComprobativoM" style="width:690px;  height:590px"></div>'
                                    }
                                }).show();
                                PDFObject.embed("../../relatorios/Academica_Matricula_Comprobativo.pdf", "#idPDF_ComprobativoM");
                            }
                            //actualizar grid
                            $$("idDTEdMatricula").clearAll();
                            $$("idDTEdMatricula").load(BASE_URL + "CAcademica_Matricula/read");
                        } else
                            webix.message({ type: "error", text: "Erro ao inserir dados na tabela Estudantes" });

                        //actualizar grid
                        $$("idDTEdMatricula").clearAll();
                        $$("idDTEdMatricula").load(BASE_URL + "CAcademica_Matricula/read");

                        $$("id_win_add_turma").close();
                    }
                },
                {
                    view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                        $$("id_win_add_turma").close();
                    }
                }
            ]
        }
    ],
    elementsConfig: {
        labelPosition: "top",
    }
};
