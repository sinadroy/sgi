//var codigo_foto;
function cargarVistaInscricao(itemID) {
    $$("views").addView({
        view: "tabview",
        id: itemID,
        //autoheight:true,
        height: 900,
        cells: [
            {
                header: "Dados Candidatos", body: {
                    view: "tabview",
                    cells: [
                        {
                            header: "Dados Pessoais", body: {
                                rows: [
                                    {
                                        view: "form", id: "idform_DP_superior_grid", height: 125, minHeight: 10, maxHeight: 120, scroll: false,
                                        cols: [
                                            {},
                                            { view: "template", id: "id_template_foto", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Funcionarios/default.jpg /></div>' }
                                        ]
                                    },
                                    {
                                        view: "form", scroll: false,
                                        cols: [
                                            {
                                                view: "button", type: "form", value: "Adicionar", width: 120, height: 50, click: function () {
                                                    webix.ui({
                                                        view: "window",
                                                        id: "id_win_inscricao_add",
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
                                                view: "button", type: "danger", value: "Editar", width: 120, height: 50, click: function () {
                                                    var idSelecionado = $$("idDTEdDadosPesoais").getSelectedId(false, true);
                                                    if (idSelecionado) {
                                                        webix.ui({
                                                            view: "window",
                                                            id: "id_win_inscricao_ed",
                                                            width: 600,
                                                            position: "center",
                                                            modal: true,
                                                            head: "Editar Dados",
                                                            body: webix.copy(formEDDadosPesoais)
                                                        }).show();
                                                        //cargar datos de todo el record seleccionado
                                                        var record = $$("idDTEdDadosPesoais").getItem($$("idDTEdDadosPesoais").getSelectedId(false, true));
                                                        //////////***** datos personales *****/////////
                                                        $$("idcNome").setValue(record.cNome);
                                                        $$("idcApelido").setValue(record.cApelido);
                                                        $$("idcData_Nascimento").setValue(record.cData_Nascimento);
                                                        //Nacionalidade Geral
                                                        var envio = "ngNome=" + record.ngNome;
                                                        var rng = webix.ajax().sync().post(BASE_URL + "CNacionalidades_Geral/GetID", envio);
                                                        $$("idngNome").setValue(rng.responseText);
                                                        //$$("idngNome").setValue(record.ngNome);
                                                        //Genero
                                                        var envio = "munNome=" + record.munNascimento;
                                                        var rmun = webix.ajax().sync().post(BASE_URL + "CMunicipios/GetID", envio);
                                                        $$("idNascimento_Municipios_id").setValue(rmun.responseText);

                                                        $$("idcBI_Data_Emissao").setValue(record.cBI_Data_Emissao);
                                                        $$("idcNome_Pai").setValue(record.cNome_Pai);

                                                        //Necesita educacao especial
                                                        var envio = "neeNome=" + record.neeNome;
                                                        var rnee = webix.ajax().sync().post(BASE_URL + "CNecessita_Educacao_Especial/GetID", envio);
                                                        $$("idneeNome").setValue(rnee.responseText);

                                                        $$("idcNomes").setValue(record.cNomes);

                                                        //Genero
                                                        var envio = "gNome=" + record.gNome;
                                                        var rg = webix.ajax().sync().post(BASE_URL + "CGeneros/GetID", envio);
                                                        $$("idgNome").setValue(rg.responseText);

                                                        //Estado Civil
                                                        var envio = "ecNome=" + record.ecNome;
                                                        var rec = webix.ajax().sync().post(BASE_URL + "CEstado_Civil/GetID", envio);
                                                        $$("idecNome").setValue(rec.responseText);

                                                        //Provincia de Nascimento
                                                        var envio = "provNome=" + record.provNascimento;
                                                        var rprov = webix.ajax().sync().post(BASE_URL + "CProvincias/GetID", envio);
                                                        $$("idNascimento_Provincias_id").setValue(rprov.responseText);

                                                        $$("idcBI_Passaporte").setValue(record.cBI_Passaporte);

                                                        //Provincia de Emissao
                                                        if (isNaN(record.cBI_Lugar_Emissao_Provincia_id)) {
                                                            var envio = "provNome=" + record.cBI_Lugar_Emissao_Provincia_id;
                                                            var rprovEmissao = webix.ajax().sync().post(BASE_URL + "CProvincias/GetID", envio);
                                                            $$("idcBI_Lugar_Emissao_Provincia_id").setValue(rprovEmissao.responseText);
                                                        } else {
                                                            $$("idcBI_Lugar_Emissao_Provincia_id").setValue(record.cBI_Lugar_Emissao_Provincia_id);
                                                        }
                                                        $$("idcNome_Mae").setValue(record.cNome_Mae);

                                                        //////////***** datos Profissionais *****/////////
                                                        var envio = "id=" + idSelecionado;
                                                        var rtrab = webix.ajax().sync().post(BASE_URL + "CTrabalhador/GetIDXCandidato_id", envio);
                                                        $$("idtrabNome").setValue(rtrab.responseText);
                                                        /*if ($$("idtrabNome").getValue() == 1) {
                                                            $$("idtilNome").enable();
                                                            $$("iddlLocal_Trabalho").enable();
                                                            $$("idproNome").enable();
                                                            $$("idotNome").enable();
                                                            $$("iddlCargo").enable();
                                                        }*/
                                                        //profissao
                                                        var envio = "id=" + idSelecionado;
                                                        var rpro = webix.ajax().sync().post(BASE_URL + "CProfissao/GetIDXCandidato_id", envio);
                                                        $$("idproNome").setValue(rpro.responseText);
                                                        //tipo de insituicao laboral
                                                        var envio = "id=" + idSelecionado;
                                                        var rtil = webix.ajax().sync().post(BASE_URL + "CTipo_Instituicao_Laboral/GetIDXCandidato_id", envio);
                                                        $$("idtilNome").setValue(rtil.responseText);
                                                        //Organismo de Tutela
                                                        var envio = "id=" + idSelecionado;
                                                        var ridot = webix.ajax().sync().post(BASE_URL + "COrganismos_Tutela/GetIDXCandidato_id", envio);
                                                        $$("idotNome").setValue(ridot.responseText);
                                                        //local de trabalho
                                                        var envio = "id=" + idSelecionado;
                                                        var rltrab = webix.ajax().sync().post(BASE_URL + "CDados_Laborais/Get_ltXCandidato_id", envio);
                                                        $$("iddlLocal_Trabalho").setValue(rltrab.responseText);
                                                        //Cargo
                                                        var envio = "id=" + idSelecionado;
                                                        var rcargo = webix.ajax().sync().post(BASE_URL + "CDados_Laborais/Get_cargoXCandidato_id", envio);
                                                        $$("iddlCargo").setValue(rcargo.responseText);
                                                        //////////***** datos Academicos *****/////////
                                                        //Pais de Formacao
                                                        var envio = "id=" + idSelecionado;
                                                        var rpf = webix.ajax().sync().post(BASE_URL + "CDados_Academicos/Get_pfXCandidato_id", envio);
                                                        $$("idFormacao_paNome").setValue(rpf.responseText);

                                                        //Provincia de Formacao
                                                        var envio = "id=" + idSelecionado;
                                                        var rprof = webix.ajax().sync().post(BASE_URL + "CDados_Academicos/Get_provfXCandidato_id", envio);
                                                        $$("idFormacao_provNome").setValue(rprof.responseText);

                                                        //Habilitacao literaria
                                                        var envio = "id=" + idSelecionado;
                                                        var rhl = webix.ajax().sync().post(BASE_URL + "CDados_Academicos/Get_hlXCandidato_id", envio);
                                                        $$("idhlfNome").setValue(rhl.responseText);

                                                        //Escola de formacao
                                                        var envio = "id=" + idSelecionado;
                                                        var ref = webix.ajax().sync().post(BASE_URL + "CDados_Academicos/Get_efXCandidato_id", envio);
                                                        $$("idFormacao_efNome").setValue(ref.responseText);

                                                        //Opcao
                                                        var envio = "id=" + idSelecionado;
                                                        var ropc = webix.ajax().sync().post(BASE_URL + "CDados_Academicos/Get_opcXCandidato_id", envio);
                                                        $$("idOpcao2").setValue(ropc.responseText);

                                                        //Ano
                                                        var envio = "id=" + idSelecionado;
                                                        var rano = webix.ajax().sync().post(BASE_URL + "CDados_Academicos/Get_anoXCandidato_id", envio);
                                                        $$("idAno").setValue(rano.responseText);
                                                        //Media
                                                        var envio = "id=" + idSelecionado;
                                                        var rmedia = webix.ajax().sync().post(BASE_URL + "CDados_Academicos/Get_mediaXCandidato_id", envio);
                                                        $$("idMedia").setValue(rmedia.responseText);
                                                        //////////***** Endereco Contacto *****/////////
                                                        //Pais
                                                        var envio = "id=" + idSelecionado;
                                                        var rpais = webix.ajax().sync().post(BASE_URL + "CEndereco_Candidatos/Get_paisXCandidato_id", envio);
                                                        $$("idpaNome").setValue(rpais.responseText);
                                                        //Provincia
                                                        var envio = "id=" + idSelecionado;
                                                        var rprov = webix.ajax().sync().post(BASE_URL + "CEndereco_Candidatos/Get_provXCandidato_id", envio);
                                                        $$("idprovNome").setValue(rprov.responseText);
                                                        //Municipio
                                                        var envio = "id=" + idSelecionado;
                                                        var rmun = webix.ajax().sync().post(BASE_URL + "CEndereco_Candidatos/Get_munXCandidato_id", envio);
                                                        $$("idmunNome").setValue(rmun.responseText);
                                                        //Bairro
                                                        var envio = "id=" + idSelecionado;
                                                        var rbairro = webix.ajax().sync().post(BASE_URL + "CEndereco_Candidatos/Get_bairroXCandidato_id", envio);
                                                        $$("idbaiNome").setValue(rbairro.responseText);
                                                        //Telefone
                                                        var envio = "id=" + idSelecionado;
                                                        var rtell = webix.ajax().sync().post(BASE_URL + "CCandidatos/Get_telXCandidato_id", envio);
                                                        $$("idcTelefone").setValue(rtell.responseText);
                                                        //EMail
                                                        var envio = "id=" + idSelecionado;
                                                        var rtell = webix.ajax().sync().post(BASE_URL + "CCandidatos/Get_emailXCandidato_id", envio);
                                                        $$("idcEmail").setValue(rtell.responseText);
                                                    } else {
                                                        webix.message({ type: "error", text: "Deve selecionar primeriro um funcion&aacute;rio" });
                                                    }
                                                }
                                            },
                                            //
                                            {
                                                view: "button", type: "standard", value: "Editar Foto", disabled: false, width: 120, height: 50, click: function () {
                                                    var idSelecionado = $$("idDTEdDadosPesoais").getSelectedId(false, true);

                                                    //locallizar el codifoFoto en la tabla Funcionarios
                                                    var envio = "id=" + idSelecionado;
                                                    var r = webix.ajax().sync().post(BASE_URL + "cCandidatos/cargarFoto", envio);
                                                    var CODIGO_FOTO = r.responseText;

                                                    if (idSelecionado) {
                                                        //preparar webcam
                                                        webix.ui({
                                                            view: "window",
                                                            id: "idwinADDFotoCandidatos",
                                                            width: 460,
                                                            position: "center",
                                                            modal: true,
                                                            head: "Editar Foto",
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
                                                    $$("idDTEdDadosPesoais").clearAll();
                                                    $$("idDTEdDadosPesoais").load(BASE_URL + "cCandidatos/readDP");
                                                }
                                            },
                                            {
                                                view: "button", type: "form", id: "idbtn_Exportar_Dados", value: "Exportar Dados", disabled: true, width: 120, height: 50, click: function () {
                                                    //criar excel
                                                    var envio = "user=" + user_sessao;
                                                    var r = webix.ajax().sync().post(BASE_URL + "CExportar_Dados_Excel/Dados_Inscricao", envio);
                                                    webix.send(BASE_URL + "CExportar_Dados_Excel/Dados_Inscricao", null, "GET");
                                                    /*  if (r.responseText == "true") {
                                                          webix.message("Excel criado com sucesso");
                                                          
                                                      } else {
                                                          webix.message({ type: "error", text: "Erro Exportando dados" });
                                                      }
                                                      */
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
                                        //select: true,
                                        //editable:true,
                                        select: "row", //editable: true, editaction: "click",
                                        columns: [
                                            { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                            { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                                            { id: "cNome", editor: "text", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                            { id: "cNomes", header: "Nomes", width: 170, sort: "string" },
                                            { id: "cApelido", editor: "text", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                            { id: "cBI_Passaporte", editor: "text", header: ["BI-Pass.", { content: "textFilter" }], width: 150, sort: "strig" },
                                            { id: "cBI_Data_Emissao", header: "BI D. Emiss&atilde;o.", width: 120, sort: "strig" },
                                            { id: "provEmissao", editor: "richselect", header: ["BI Prov. Emiss&atilde;o", { content: "selectFilter" }], width: 140, sort: "strig" },
                                            { id: "cData_Nascimento", editor: "date", header: ["D. Nascimento", { content: "textFilter" }], width: 115, sort: "strig" },
                                            { id: "cIdade", header: ["Idade", { content: "textFilter" }], width: 60, sort: "int" },
                                            { id: "provNascimento", header: ["Prov&iacute;ncia", { content: "selectFilter" }], width: 140, sort: "strig" },
                                            { id: "munNascimento", header: ["Naturalidade", { content: "selectFilter" }], width: 140, sort: "strig" },
                                            { id: "gNome", header: ["Genero", { content: "selectFilter" }], width: 90, sort: "strig" },
                                            { id: "ecNome", editor: "richselect", header: ["Est. Civil", { content: "selectFilter" }], width: 100, sort: "strig" },
                                            //{ id: "ngNome", editor: "richselect", header: "Nacionalidade", width: 140, validate: "isNotEmpty", validateEvent: "blur", sort: "strig" },
                                            { id: "ngNome", header: ["Nacionalidade", { content: "selectFilter" }], width: 120, sort: "strig" },
                                            { id: "cNome_Pai", header: "Nome Pai", width: 140, sort: "strig" },
                                            { id: "cNome_Mae", header: "Nome Mae", width: 140, sort: "strig" },
                                        ],
                                        on: {
                                            "onAfterSelect": function (id) {
                                                var idSelecionado = $$("idDTEdDadosPesoais").getSelectedId(false, true);
                                                var envio = "id=" + idSelecionado;
                                                var r = webix.ajax().sync().post(BASE_URL + "cCandidatos/cargarFoto", envio);
                                                var CODIGO_FOTO = r.responseText;
                                                if (CODIGO_FOTO) {
                                                    // idform_DP_superior_grid
                                                    $$("idform_DP_superior_grid").removeView("id_template_foto");
                                                    $$("idform_DP_superior_grid").addView({ view: "template", id: "id_template_foto", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Candidatos/' + CODIGO_FOTO + '.jpg /></div>' }, 2);
                                                } else {
                                                    // idform_DP_superior_grid
                                                    $$("idform_DP_superior_grid").removeView("id_template_foto");
                                                    $$("idform_DP_superior_grid").addView({ view: "template", id: "id_template_foto", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Candidatos/default.jpg /></div>' }, 2);
                                                }
                                                //{view:"template",width:320,template:'<div id="my_camera">'+'<img src='+PRO_URL+'Fotos/Funcionarios/'+CODIGO_FOTO+'.jpg /></div>'},
                                            },
                                            "onAfterAdd": function (id, data) {
                                                $$("idDTEdDadosPesoais").clearAll();
                                                $$("idDTEdDadosPesoais").load(BASE_URL + "cCandidatos/readDP");
                                                //dp
                                                $$("idDTEdDadosProfisionais").clearAll();
                                                $$("idDTEdDadosProfisionais").load(BASE_URL + "cCandidatos/readDPRO");
                                                //da
                                                $$("idDTEdDadosAcademicos").clearAll();
                                                $$("idDTEdDadosAcademicos").load(BASE_URL + "cCandidatos/readDACA");
                                                //dl
                                                $$("idDTEdDadosLocalizacao").clearAll();
                                                $$("idDTEdDadosLocalizacao").load(BASE_URL + "cCandidatos/readDLOC");
                                            },
                                            "onAfterUpdate": function (id, data) {
                                                $$("idDTEdDadosPesoais").clearAll();
                                                $$("idDTEdDadosPesoais").load(BASE_URL + "cCandidatos/readDP");
                                                //dp
                                                $$("idDTEdDadosProfisionais").clearAll();
                                                $$("idDTEdDadosProfisionais").load(BASE_URL + "cCandidatos/readDPRO");
                                                //da
                                                $$("idDTEdDadosAcademicos").clearAll();
                                                $$("idDTEdDadosAcademicos").load(BASE_URL + "cCandidatos/readDACA");
                                                //dl
                                                $$("idDTEdDadosLocalizacao").clearAll();
                                                $$("idDTEdDadosLocalizacao").load(BASE_URL + "cCandidatos/readDLOC");
                                            }
                                        },
                                        save: BASE_URL + "cCandidatos/crud?tu=DP",
                                        url: BASE_URL + "cCandidatos/readDP",
                                        pager: "pagerCDadosPesoais"
                                    }, {
                                        view: "pager", id: "pagerCDadosPesoais",
                                        template: "{common.prev()} {common.pages()} {common.next()}",
                                        size: 25,
                                        group: 10
                                    }]
                            }
                        }, {
                            header: "Dados Profissionais", body: {
                                rows: [
                                    {
                                        view: "form", scroll: false,
                                        cols: [
                                            {
                                                view: "button", type: "standard", value: "Actualizar", width: 120, height: 50, click: function () {
                                                    $$("idDTEdDadosProfisionais").clearAll();
                                                    $$("idDTEdDadosProfisionais").load(BASE_URL + "cCandidatos/readDPRO");
                                                }
                                            },
                                            {}
                                        ]
                                    },
                                    {
                                        view: "datatable",
                                        id: "idDTEdDadosProfisionais",
                                        //select:true,
                                        select: "row", //editable: true, editaction: "click",
                                        columns: [
                                            { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                            { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                                            { id: "cNome", /*editor: "text",*/ header: ["Nome", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                            //{id:"cNomes",editor:"text", header:["Nomes", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                            { id: "cApelido", /*editor: "text",*/ header: ["Apelido", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                            { id: "cBI_Passaporte", /*editor: "text",*/ header: ["BI-Pass.", { content: "textFilter" }], width: 150, validate: webix.rules.isNotEmpty(), sort: "strig" },
                                            { id: "proNome", editor: "richselect", header: ["Profiss&atilde;o", { content: "selectFilter" }], width: 150, template: "#proNome#", options: BASE_URL + "CProfissao/read" },
                                            { id: "trabNome", editor: "richselect", header: ["Trabalha", { content: "selectFilter" }], width: 80, template: "#trabNome#", options: BASE_URL + "CTrabalhador/read" },
                                            { id: "tilNome", editor: "richselect", header: ["Tipo Insti.", { content: "selectFilter" }], width: 100, template: "#tilNome#", options: BASE_URL + "CTipo_Instituicao_Laboral/read" },
                                            { id: "otNome", editor: "richselect", header: ["Organismo Tutela", { content: "textFilter" }], width: 200, template: "#otNome#", options: BASE_URL + "COrganismos_Tutela/read" },
                                            { id: "dlLocal_Trabalho", editor: "text", header: ["Local Trabalho", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "strig" },
                                            { id: "dlCargo", editor: "text", header: ["Cargo", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "strig" },
                                        ],
                                        on: {
                                            "onAfterEditStop": function (state, editor, ignoreUpdate) {
                                                $$("idDTEdDadosProfisionais").clearAll();
                                                $$("idDTEdDadosProfisionais").load(BASE_URL + "cCandidatos/readDPRO");
                                            }
                                        },
                                        //save: BASE_URL + "cCandidatos/crud?tu=DPRO",
                                        url: BASE_URL + "cCandidatos/readDPRO",
                                        pager: "pagerDadosProfisionais"
                                    }, {
                                        view: "pager", id: "pagerDadosProfisionais",
                                        template: "{common.prev()} {common.pages()} {common.next()}",
                                        size: 25,
                                        group: 10
                                    }]
                            }
                        }, {
                            header: "Dados Academicos", body: {
                                rows: [{
                                    view: "form", scroll: false,
                                    cols: [
                                        {
                                            view: "button", type: "standard", value: "Actualizar", width: 120, height: 50, click: function () {
                                                $$("idDTEdDadosAcademicos").clearAll();
                                                $$("idDTEdDadosAcademicos").load(BASE_URL + "cCandidatos/readDACA");
                                            }
                                        },
                                        {}
                                    ]
                                },
                                    {
                                        view: "datatable",
                                        id: "idDTEdDadosAcademicos",
                                        //select:true,
                                        select: "row", // editable: true, editaction: "click",
                                        columns: [
                                            { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                            { id: "orden", header: "Nº", width: 60, sort: "int" },
                                            { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                            { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                            { id: "cBI_Passaporte", header: ["BI-Pass.", { content: "textFilter" }], width: 150, sort: "strig" },
                                            { id: "paFormacao", header: ["Pa&iacute;s", { content: "selectFilter" }], width: 150, sort: "strig" },
                                            { id: "provFormacao", header: ["Provincia", { content: "selectFilter" }], width: 150, sort: "strig" },
                                            { id: "hlfNome", header: ["Habilita&ccedil;&otilde;es Lit.", { content: "selectFilter" }], width: 150, sort: "strig" },
                                            //{ id: "efNome", editor: "text", header: ["Escola", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "strig" },
                                            { id: "efNome", header: ["Escola", { content: "selectFilter" }], width: 150, sort: "strig" },
                                            //{ id: "Opcao", editor: "text", header: ["Op&ccedil;&atilde;o", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "strig" },
                                            { id: "opcNome", header: ["Op&ccedil;&atilde;o", { content: "selectFilter" }], width: 150, sort: "strig" },
                                            { id: "Ano", header: ["Ano", { content: "textFilter" }], width: 70, sort: "int" },
                                            { id: "Media", header: ["M&eacute;dia", { content: "textFilter" }], width: 70, sort: "int" }
                                        ],
                                        /*on: {
                                            "onAfterEditStop": function (state, editor, ignoreUpdate) {
                                                $$("idDTEdDadosAcademicos").clearAll();
                                                $$("idDTEdDadosAcademicos").load(BASE_URL + "cCandidatos/readDACA");
                                            }
                                        },*/
                                        //save: BASE_URL + "cCandidatos/crud?tu=DACA",
                                        url: BASE_URL + "cCandidatos/readDACA",
                                        pager: "pagerDadosAcademicos"
                                    }, {
                                        view: "pager", id: "pagerDadosAcademicos",
                                        template: "{common.prev()} {common.pages()} {common.next()}",
                                        size: 25,
                                        group: 10
                                    }]
                            }
                        },
                        {
                            header: "Dados de Localiza&ccedil;&atilde;o", body: {
                                rows: [
                                    {
                                        view: "form", scroll: false,
                                        cols: [
                                            {
                                                view: "button", type: "standard", value: "Actualizar", width: 120, height: 50, click: function () {
                                                    $$("idDTEdDadosLocalizacao").clearAll();
                                                    $$("idDTEdDadosLocalizacao").load(BASE_URL + "cCandidatos/readDLOC");
                                                }
                                            },
                                            {}
                                        ]
                                    }, {
                                        view: "datatable",
                                        id: "idDTEdDadosLocalizacao",
                                        //select:true,
                                        select: "row", //editable: true, editaction: "click",
                                        columns: [
                                            { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                            { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                                            { id: "cNome", /*editor: "text",*/ header: ["Nome", { content: "textFilter" }], width: 170, validate: "isNotEmpty", validateEvent: "blur", sort: "string" },
                                            { id: "cApelido", /*editor: "text",*/ header: ["Apelido", { content: "textFilter" }], width: 170, validate: webix.rules.isNotEmpty(), sort: "string" },
                                            { id: "cBI_Passaporte", /*editor: "text",*/ header: ["BI-Pass.", { content: "textFilter" }], width: 150, validate: webix.rules.isNotEmpty(), sort: "strig" },
                                            { id: "cTelefone", editor: "text", header: ["Telefone1", { content: "textFilter" }], width: 100, sort: "strig" },
                                            { id: "cEmail", editor: "text", header: ["E-Mail", { content: "textFilter" }], width: 180, validate: "isNotEmpty", validateEvent: "blur", sort: "strig" },
                                            { id: "paNome", editor: "richselect", header: ["Pa&iacute;s", { content: "selectFilter" }], width: 180, template: "#paNome#", options: BASE_URL + "CPaises/read" },
                                            { id: "provNome", editor: "richselect", header: ["Provincia", { content: "selectFilter" }], width: 180, template: "#provNome#", options: BASE_URL + "CProvincias/read" },
                                            { id: "munNome", editor: "richselect", header: ["Municipio", { content: "selectFilter" }], width: 180, template: "#munNome#", options: BASE_URL + "CMunicipios/read" },
                                            { id: "baiNome", editor: "richselect", header: ["Comuna", { content: "selectFilter" }], width: 180, template: "#baiNome#", options: BASE_URL + "CBairros/read" },
                                        ],
                                        on: {
                                            "onAfterEditStop": function (state, editor, ignoreUpdate) {
                                                $$("idDTEdDadosLocalizacao").clearAll();
                                                $$("idDTEdDadosLocalizacao").load(BASE_URL + "cCandidatos/readDLOC");
                                            }
                                        },
                                        // save: BASE_URL + "cCandidatos/crud?tu=DLOC",
                                        url: BASE_URL + "cCandidatos/readDLOC",
                                        pager: "pagerDadosLocalizacao"
                                    }, {
                                        view: "pager", id: "pagerDadosLocalizacao",
                                        template: "{common.prev()} {common.pages()} {common.next()}",
                                        size: 25,
                                        group: 10
                                    }]
                            }
                        }
                    ]
                }
            }, {
                header: "Dados Inscri&ccedil;&atilde;o", body: {
                    view: "tabview",
                    cells: [
                        {
                            header: "Cursos Pretendidos", body: {
                                rows: [
                                    {
                                        view: "form", scroll: false,
                                        rows: [
                                            {
                                                cols: [
                                                    {
                                                        view: "text", id: "idComboBI", label: 'Localizar por BI/Passaporte', labelPosition: "top", width: 200, name: "fBI_Passaporte", options: { body: { template: "#cBI_Passaporte#", yCount: 7, url: BASE_URL + "CCandidatos/readBI" } },
                                                        on: {
                                                            "onChange": function (newv, oldv) {
                                                                var envio = "bi=" + this.getValue();
                                                                var rbi = webix.ajax().sync().post(BASE_URL + "cCandidatos/readIDxBI", envio);
                                                                var candidato_id = rbi.responseText;
                                                                if (this.getValue !== "") {
                                                                    if (candidato_id !== "false") {
                                                                        var cNome = webix.ajax().sync().post(BASE_URL + "cCandidatos/readNomeXID", "id=" + candidato_id/*this.getValue()*/);
                                                                        var cApelido = webix.ajax().sync().post(BASE_URL + "cCandidatos/readApelidoXID", "id=" + candidato_id/*this.getValue()*/);
                                                                        $$("idNomes").setValue(cNome.responseText + " " + cApelido.responseText);
                                                                        //$$("idComboFNome").setValue(fNome.responseText);
                                                                        //$$("idComboFApelido").setValue(fApelido.responseText);
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    },
                                                    { view: "text", id: "idNomes", readonly: true, label: 'Nome', labelPosition: "top", width: 200, name: "cNome" },
                                                    {
                                                        view: "richselect", width: 120, id: "idCBnNome",
                                                        label: 'Nivel', name: "nNome",
                                                        labelPosition: "top",
                                                        options: {
                                                            body: {
                                                                template: "#nNome#",
                                                                yCount: 7,
                                                                url: BASE_URL + "cNiveis/read"
                                                            }
                                                        },
                                                    },
                                                    {
                                                        view: "richselect", width: 300, id: "idCBcNome",
                                                        label: 'Curso', name: "cNome",
                                                        labelPosition: "top",
                                                        options: {
                                                            body: {
                                                                template: "#cNome#",
                                                                yCount: 7,
                                                                url: BASE_URL + "cCursos/read"
                                                            }
                                                        },
                                                    },
                                                    {
                                                        view: "richselect", width: 100, id: "idCBpNome",
                                                        label: 'Per&iacute;odo', name: "pNome",
                                                        labelPosition: "top",
                                                        options: {
                                                            body: {
                                                                template: "#pNome#",
                                                                yCount: 7,
                                                                url: BASE_URL + "cPeriodos/read"
                                                            }
                                                        },
                                                    },
                                                    {
                                                        view: "button", type: "form", value: "Adicionar", width: 100, height: 50, click: function () {
                                                            if ($$("idComboBI").getValue() && $$("idCBnNome").getValue() && $$("idCBcNome").getValue() && $$("idCBpNome").getValue()) {
                                                                //verificar que no exista ya un registro igual en la BD
                                                                var envio = "bi=" + $$("idComboBI").getValue() +
                                                                    "&nNome=" + $$("idCBnNome").getValue() +
                                                                    "&cNome=" + $$("idCBcNome").getValue() +
                                                                    "&pNome=" + $$("idCBpNome").getValue();
                                                                var r = webix.ajax().sync().post(BASE_URL + "CCursos_Pretendidos/Existe", envio);
                                                                if (r.responseText == "false") {
                                                                    //Adicionar
                                                                    $$('idDTCPretendidos').add({
                                                                        bi: $$("idComboBI").getValue(),
                                                                        nNome: $$("idCBnNome").getValue(),
                                                                        cNome: $$("idCBcNome").getValue(),
                                                                        pNome: $$("idCBpNome").getValue(),
                                                                        usuario: user_sessao
                                                                    });
                                                                    $$("idDTCPretendidos").clearAll();
                                                                    $$("idDTCPretendidos").load(BASE_URL + "cCursos_Pretendidos/read");
                                                                } else {
                                                                    webix.message({ type: "error", text: "Erro, os dados ja existem na BD" });
                                                                }
                                                            } else {
                                                                webix.message({ type: "error", text: "Erro, Faltam campos por seleccionar" });
                                                            }

                                                        }
                                                    },
                                                    {},
                                                ]
                                            }, //aqui
                                            {
                                                cols: [
                                                    {
                                                        view: "button", type: "standard", value: "Actualizar", width: 120, height: 50, click: function () {
                                                            $$("idDTCPretendidos").clearAll();
                                                            $$("idDTCPretendidos").load(BASE_URL + "cCursos_Pretendidos/read");
                                                            $$("idComboBI").setValue("");
                                                            $$("idNomes").setValue("");
                                                            //$$("fBI_Passaporte").getList().clearAll();
                                                            //$$("fBI_Passaporte").getList().load(BASE_URL + "CCandidatos/readBI");
                                                        }
                                                    },
                                                    {
                                                        view: "button", type: "danger", id: "idbtn_Apagar_Cursos_Pretendidos", disabled: true, value: "Apagar", width: 120, height: 50, click: function () {
                                                            var idSelecionado = $$('idDTCPretendidos').getSelectedId();
                                                            if (idSelecionado) {
                                                                webix.confirm({
                                                                    title: "Confirmação",
                                                                    type: "confirm-warning",
                                                                    ok: "Sim", cancel: "Nao",
                                                                    text: "Est&aacute; seguro que deseja apagar a linha selecionada",
                                                                    callback: function (result) {
                                                                        if (result) {
                                                                            //registrar log
                                                                            var envio = "id=" + idSelecionado +
                                                                                "&audOperacao=Apagar:Curso Pretendido" +
                                                                                "&mNome=Academica" +
                                                                                "&smNome=Inscrição" +
                                                                                "&audDescricao=" + $$("idComboBI").getValue() +
                                                                                "&usuario=" + user_sessao +
                                                                                "&webix_operation=insert";
                                                                            var r = webix.ajax().sync().post(BASE_URL + "cAuditorias_Academicas/crud", envio);
                                                                            $$('idDTCPretendidos').remove(idSelecionado);
                                                                        }
                                                                    }
                                                                });
                                                            } else {
                                                                webix.message({ type: "error", text: "Erro apagando dados, selecione primeiro um candidato" });
                                                            }

                                                        }

                                                    },

                                                    {}
                                                ]
                                            }
                                        ]
                                    }, {
                                        view: "datatable",
                                        id: "idDTCPretendidos",
                                        select: "row", /*editable: true, editaction: "click",*/
                                        columns: [
                                            { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                            { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                                            { id: "Nome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                            //{ id: "cNomes", header: ["Nomes", { content: "textFilter" }], width: 170, sort: "string" },
                                            { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                            { id: "cBI_Passaporte", editor: "text", header: ["BI-Pass.", { content: "textFilter" }], width: 150, sort: "strig" },
                                            { id: "nNome", editor: "text", header: ["Nivel", { content: "selectFilter" }], width: 120, sort: "strig" },
                                            { id: "cNome", editor: "text", header: ["Curso", { content: "selectFilter" }], width: 300, sort: "strig" },
                                            { id: "pNome", editor: "text", header: ["Per&iacute;odo", { content: "selectFilter" }], width: 120, sort: "strig" },
                                            //ncPreco_Inscricao
                                            { id: "ncPreco_Inscricao", editor: "text", header: ["Pre&ccedil;o Inscri&ccedil;&atilde;o", { content: "textFilter" }], width: 120, sort: "strig" },
                                        ],
                                        on: {
                                            "onAfterAdd": function (id, data) {
                                                $$("idDTCPretendidos").clearAll();
                                                $$("idDTCPretendidos").load(BASE_URL + "cCursos_Pretendidos/read");
                                            },
                                            "onAfterUpdate": function (id, data) {
                                                $$("idDTCPretendidos").clearAll();
                                                $$("idDTCPretendidos").load(BASE_URL + "cCursos_Pretendidos/read");
                                            }
                                        },
                                        save: BASE_URL + "cCursos_Pretendidos/crud",
                                        url: BASE_URL + "cCursos_Pretendidos/read",
                                        pager: "pagerCDadosCPretendidos"
                                    }, {
                                        view: "pager", id: "pagerCDadosCPretendidos",
                                        template: "{common.prev()} {common.pages()} {common.next()}",
                                        size: 25,
                                        group: 10
                                    }]
                            }
                        },
                        {
                            header: "Listas/Comprovativos Inscri&ccedil;&atilde;o", body: {
                                rows: [
                                    {
                                        view: "form", scroll: false,
                                        rows: [
                                            {
                                                cols: [
                                                    {
                                                        view: "richselect", width: 250, id: "idLI_CB_nNome_lci",
                                                        label: 'Nivel', name: "nNome",
                                                        labelPosition: "top",
                                                        options: {
                                                            body: {
                                                                template: "#nNome#",
                                                                yCount: 7,
                                                                url: BASE_URL + "cNiveis/read"
                                                            }
                                                        },
                                                    },
                                                    {
                                                        view: "richselect", width: 300, id: "idLI_CB_cNome_lci",
                                                        label: 'Curso', name: "cNome",
                                                        labelPosition: "top",
                                                        options: {
                                                            body: {
                                                                template: "#cNome#",
                                                                yCount: 7,
                                                                url: BASE_URL + "cCursos/read"
                                                            }
                                                        },
                                                    },
                                                    {
                                                        view: "combo", width: 250, id: "idLI_CB_pNome_lci",
                                                        label: 'Periodo', name: "pNome",
                                                        labelPosition: "top",
                                                        options: {
                                                            body: {
                                                                template: "#pNome#",
                                                                yCount: 7,
                                                                url: BASE_URL + "cPeriodos/read"
                                                            }
                                                        }
                                                    },
                                                    {
                                                        view: "button", type: "form", value: "Perquisar", width: 120, click: function () {
                                                            //var idSelecionado = $$("idDTEdHorarios").getSelectedId(false,true);
                                                            var nNome = $$("idLI_CB_nNome_lci").getValue();
                                                            var cNome = $$("idLI_CB_cNome_lci").getValue();
                                                            var pNome = $$("idLI_CB_pNome_lci").getValue();
                                                            if (nNome && cNome && pNome) {
                                                                $$("idDTInscricao").clearAll();
                                                                $$("idDTInscricao").load(BASE_URL + "cCandidatos/readDInscricaoXncp?nNome=" + nNome +
                                                                    "&cNome=" + cNome +
                                                                    "&pNome=" + pNome);
                                                            }

                                                        }
                                                    },
                                                    {
                                                        view: "button", type: "standard", value: "Imprimir", width: 120, height: 50, click: function () {
                                                            //criar PDF
                                                            var nNome = $$("idLI_CB_nNome_lci").getValue();
                                                            var cNome = $$("idLI_CB_cNome_lci").getValue();
                                                            var pNome = $$("idLI_CB_pNome_lci").getValue();
                                                            if (nNome && cNome && pNome) {
                                                                var envio = "nNome=" + nNome + "&cNome=" + cNome + "&pNome=" + pNome + "&utilizador=" + user_sessao;
                                                                var r = webix.ajax().sync().post(BASE_URL + "cInscricao_Lista/imprimir", envio);
                                                                if (r.responseText == "true") {
                                                                    webix.message("PDF criado com sucesso");
                                                                    //Carregar PDF
                                                                    webix.ui({
                                                                        view: "window",
                                                                        id: "idWinPDFIl",
                                                                        height: 600,
                                                                        width: 700,
                                                                        left: 50, top: 50,
                                                                        move: true,
                                                                        modal: true,
                                                                        //head:"This window can be moved",
                                                                        head: {
                                                                            view: "toolbar", cols: [
                                                                                { view: "label", label: "Inscri&ccedil;&atilde;o" },
                                                                                { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFIl').close(); } }
                                                                            ]
                                                                        },
                                                                        body: {
                                                                            //template:"Some text"
                                                                            template: '<div id="idPDFIL" style="width:690px;  height:590px"></div>'
                                                                        }
                                                                    }).show();
                                                                    PDFObject.embed("../../relatorios/Inscricao_Lista.pdf", "#idPDFIL");


                                                                } else {
                                                                    webix.message({ type: "error", text: "Erro atualizando dados" });
                                                                }

                                                            } else {
                                                                webix.message({ type: "error", text: "Deve selecionar primeiro n&iacute;vel, curso e per&iacute;odo" });
                                                            }
                                                        }
                                                    },
                                                    {}
                                                ]
                                            },
                                            {
                                                cols: [
                                                    {
                                                        view: "button", type: "standard", value: "Actualizar", width: 120, height: 50, click: function () {
                                                            $$("idDTInscricao").clearAll();
                                                            $$("idDTInscricao").load(BASE_URL + "cCandidatos/readDInscricao");
                                                        }
                                                    },
                                                    {
                                                        view: "button", type: "form", value: "Comprovativo", width: 120, height: 50, click: function () {
                                                            //criar PDF
                                                            var idSelecionado = $$("idDTInscricao").getSelectedId(false, true);
                                                            if (idSelecionado) {
                                                                //ver estado actual del candidato
                                                                var envio = "id=" + idSelecionado;
                                                                var rec = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/read_estado_pagamento", envio);
                                                                if (rec.responseText == "Inscrição aceite") {
                                                                    webix.message({ type: "error", text: "Erro, O estado actual do candidato &eacute; Inscrição aceite" });
                                                                } else if (rec.responseText == "Espera de Pagamento") {
                                                                    //Existe_Pag_Pendiente
                                                                    var envio = "id=" + idSelecionado + "&tipo_pag=" + 1;
                                                                    var repp = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Pendientes_Candidatos/Existe_Pag_Pendiente", envio);
                                                                    if (repp.responseText == "true") {
                                                                        webix.message({ type: "error", text: "Erro, Ja existe um pagamento pendiente, deve continuar o processo em Finan&ccedil;a" });
                                                                    } else {
                                                                        //PREPATAT DATA E HORA
                                                                        var d = new Date();
                                                                        var dataActual = d.getFullYear() + "" + (d.getMonth() + 1) + "" + d.getDate();
                                                                        var horaActual = d.getHours() + "" + d.getMinutes() + "" + d.getSeconds();

                                                                        var envio = "id=" + idSelecionado + "&data=" + dataActual + "&hora=" + horaActual + "&utilizadores_id=" + user_sessao;
                                                                        var r = webix.ajax().sync().post(BASE_URL + "CCursos_Pretendidos_Comprobativo/imprimir", envio);
                                                                        if (r.responseText == "true") {
                                                                            webix.message("PDF criado com sucesso");
                                                                            //Carregar PDF
                                                                            webix.ui({
                                                                                view: "window",
                                                                                id: "idWinPDFCP_Comprobativo",
                                                                                height: 600,
                                                                                width: 700,
                                                                                left: 50, top: 50,
                                                                                move: true,
                                                                                modal: true,
                                                                                //head:"This window can be moved",
                                                                                head: {
                                                                                    view: "toolbar", cols: [
                                                                                        { view: "label", label: "Comprovativo de Inscri&ccedil;&atilde;o" },
                                                                                        { view: "button", label: 'X', width: 50, align: 'right', click: function () { $$('idWinPDFCP_Comprobativo').close(); } }
                                                                                    ]
                                                                                },
                                                                                body: {
                                                                                    //template:"Some text"
                                                                                    template: '<div id="idPDFCP_Comprobativo" style="width:690px;  height:590px"></div>'
                                                                                }
                                                                            }).show();
                                                                            PDFObject.embed("../../relatorios/Cursos_Pretendidos_Comprobativo.pdf", "#idPDFCP_Comprobativo");


                                                                        } else {
                                                                            webix.message({ type: "error", text: "Erro atualizando dados" });
                                                                        }
                                                                    }
                                                                }

                                                            } else {
                                                                webix.message({ type: "error", text: "Deve selecionar um Candidato" });
                                                            }
                                                        }
                                                    },
                                                    {}
                                                ]
                                            }
                                        ]

                                    }, {
                                        view: "datatable",
                                        id: "idDTInscricao",
                                        select: "row", /*editable: true, editaction: "click",*/
                                        columns: [
                                            { id: "id", header: "", css: "rank", hidden: true, width: 30, sort: "int" },
                                            { id: "ord", header: "Nº", css: "rank", width: 60, sort: "int" },
                                            {
                                                id: "cEstado", header: ["Estado", { content: "selectFilter" }], width: 170, sort: "string",
                                                template: function (obj) {
                                                    if (obj.cEstado == "Espera de Pagamento")
                                                        return "<span style='color:red;'>" + obj.cEstado + "</span>";
                                                    else
                                                        return "<span style='color:green;'>" + obj.cEstado + "</span>";

                                                },
                                            },
                                            {
                                                id: "alAno", header: ["Ano Lectivo", { content: "textFilter" }], width: 100, sort: "int",
                                                /*  template: function (obj) {
                                                      if (obj.cEstado == "Espera de Pagamento")
                                                          return "<span style='color:red;'>" + obj.cEstado + "</span>";
                                                      else
                                                          return "<span style='color:green;'>" + obj.cEstado + "</span>";
                         
                                                  },*/
                                            },

                                            { id: "cNome", header: ["Nome", { content: "textFilter" }], width: 170, sort: "string" },
                                            { id: "cNomes", header: "Nomes", width: 170, sort: "string" },
                                            { id: "cApelido", header: ["Apelido", { content: "textFilter" }], width: 170, sort: "string" },
                                            { id: "cBI_Passaporte", editor: "text", header: ["BI-Pass.", { content: "textFilter" }], width: 150, sort: "strig" },

                                        ],
                                        url: BASE_URL + "cCandidatos/readDInscricao",
                                        pager: "pagerCDadosInscricao"
                                    }, {
                                        view: "pager", id: "pagerCDadosInscricao",
                                        template: "{common.prev()} {common.pages()} {common.next()}",
                                        size: 25,
                                        group: 10
                                    }
                                ]
                            }
                        },
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
        $$("idbtn_Apagar_Candidato").enable();
        $$("idbtn_Apagar_Cursos_Pretendidos").enable();
        $$("idbtn_Exportar_Dados").enable();
    }
    /* if (user_sessao == "admin") {
         $$("idbtn_Apagar_Candidato").enable();
         $$("idbtn_Apagar_Cursos_Pretendidos").enable();
     }*/
}
//Adicionar DadosPesoais
var formADDDadosPesoais = {
    view: "tabview",
    id: "id_form_inscricao_add",
    //height:900,
    cells: [{
        header: "Dados Pessoais", body: {
            view: "form",
            id: "idformADDDadosPesoais",
            height: 450,
            borderless: true,
            elements: [
                {
                    cols: [{
                        rows: [
                            { view: "text", label: 'Nome', name: "cNome", id: "idcNome", validate: "isNotEmpty", validateEvent: "blur" },
                            { view: "text", label: 'Apelido', name: "cApelido", id: "idcApelido", validate: "isNotEmpty", validateEvent: "blur" },
                            { view: "datepicker", label: "Data Nascimento", name: "cData_Nascimento", id: "idcData_Nascimento", stringResult: true },
                            { view: "richselect", label: 'Nacionalidade', name: "ngNome", id: "idngNome", value: 1, options: { body: { template: "#ngNome#", yCount: 7, url: BASE_URL + "CNacionalidades_Geral/read" } } },
                            { view: "richselect", label: 'Municipio Nascimento', name: "munNascimento", id: "idNascimento_Municipios_id", options: { body: { template: "#munNascimento#", yCount: 7, url: BASE_URL + "CMunicipios/readMN" } } },
                            { view: "datepicker", label: "BI Data Emiss&atilde;o", name: "cBI_Data_Emissao", id: "idcBI_Data_Emissao", stringResult: true },
                            { view: "text", label: 'Nome Pai', name: "cNome_Pai", id: "idcNome_Pai", validate: "isNotEmpty", validateEvent: "blur" },
                            { view: "richselect", label: 'Necessita educa&ccedil;&atilde;o especial', name: "neeNome", id: "idneeNome", value: 1, options: { body: { template: "#neeNome#", yCount: 7, url: BASE_URL + "CNecessita_Educacao_Especial/read" } } },
                            {}
                        ]
                    }, {
                            rows: [
                                { view: "text", label: 'Nomes', name: "cNomes", id: "idcNomes" },
                                { view: "richselect", label: 'Genero', name: "gNome", id: "idgNome", value: 1, options: { body: { template: "#gNome#", yCount: 7, url: BASE_URL + "CGeneros/read" } } },
                                { view: "richselect", label: 'Estado Civil', name: "ecNome", id: "idecNome", value: 1, options: { body: { template: "#ecNome#", yCount: 7, url: BASE_URL + "CEstado_Civil/read" } } },
                                {
                                    view: "richselect", label: 'Provincia Nascimento', name: "provNascimento", id: "idNascimento_Provincias_id", options: { body: { template: "#provNascimento#", yCount: 7, url: BASE_URL + "CProvincias/readPN" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            $$("idcBI_Lugar_Emissao_Provincia_id").setValue(this.getValue());
                                            //alert(this.getValue());
                                            $$("idNascimento_Municipios_id").setValue("");
                                            $$("idNascimento_Municipios_id").getList().clearAll();
                                            $$("idNascimento_Municipios_id").getList().load(BASE_URL + "cMunicipios/readXProvincia?id=" + this.getValue());
                                        }
                                    }
                                },
                                { view: "text", label: 'BI/Passaporte', name: "cBI_Passaporte", id: "idcBI_Passaporte", validate: "isNotEmpty", validateEvent: "blur" },
                                { view: "richselect", disabled: true, label: 'BI Provincia Emiss&atilde;o', name: "cBI_Lugar_Emissao_Provincia_id", id: "idcBI_Lugar_Emissao_Provincia_id", options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read" } } },
                                { view: "text", label: 'Nome Mae', name: "cNome_Mae", id: "idcNome_Mae", validate: "isNotEmpty", validateEvent: "blur" },



                                {}
                            ]
                        }
                    ]
                }, {
                    cols: [{},
                        {
                            view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                $$("id_win_inscricao_add").close();
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
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", label: 'Trabalhador', name: "trabNome", id: "idtrabNome", value: 2, options: { body: { template: "#trabNome#", yCount: 10, url: BASE_URL + "CTrabalhador/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            if (this.getText() == "Não") {
                                                $$("idtilNome").disable();
                                                $$("iddlLocal_Trabalho").disable();
                                                $$("idproNome").disable();
                                                $$("idotNome").disable();
                                                $$("iddlCargo").disable();
                                            } else {
                                                $$("idtilNome").enable();
                                                $$("iddlLocal_Trabalho").enable();
                                                $$("idproNome").enable();
                                                $$("idotNome").enable();
                                                $$("iddlCargo").enable();
                                            }
                                        }
                                    }
                                },

                                {
                                    view: "richselect", label: 'Tipo Institui&ccedil;&atilde;o', name: "tilNome", id: "idtilNome", disabled: true, options: { body: { template: "#tilNome#", yCount: 7, url: BASE_URL + "CTipo_Instituicao_Laboral/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            if (this.getText() == "Privada") {
                                                $$("idotNome").disable();
                                            }
                                        }
                                    }
                                },
                                { view: "text", label: 'Local de Trabalho', name: "dlLocal_Trabalho", disabled: true, id: "iddlLocal_Trabalho", },
                                {}
                            ]
                        }, {
                                rows: [
                                    { view: "richselect", label: 'Profiss&atilde;o', name: "proNome", id: "idproNome", disabled: true, options: { body: { template: "#proNome#", yCount: 10, url: BASE_URL + "CProfissao/read" } } },
                                    { view: "richselect", label: 'Organismo Tutela', name: "otNome", id: "idotNome", disabled: true, options: { body: { template: "#otNome#", yCount: 7, url: BASE_URL + "COrganismos_Tutela/read" } } },
                                    { view: "text", label: 'Cargo', name: "dlCargo", id: "iddlCargo", disabled: true },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [{},
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_inscricao_add").close();
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
            header: "Dados Acad&eacute;micos", body: {
                view: "form",
                id: "idformADDDadosAcademicos",
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", label: 'Pa&iacute;s de Forma&ccedil;&atilde;o', name: "paNome", id: "idFormacao_paNome", value: 1, options: { body: { template: "#paNome#", yCount: 10, url: BASE_URL + "CPaises/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idFormacao_provNome").setValue("");
                                            $$("idFormacao_provNome").getList().clearAll();
                                            $$("idFormacao_provNome").getList().load(BASE_URL + "CProvincias/readXP?id=" + this.getValue());
                                        }
                                    }
                                },
                                {
                                    view: "richselect", label: 'Habilita&ccedil;&atilde;o Literária', name: "hlfNome", id: "idhlfNome", options: { body: { template: "#hlfNome#", yCount: 7, url: BASE_URL + "CHabilitacoes_Literarias_Candidatos/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idFormacao_efNome").setValue("");
                                            $$("idFormacao_efNome").getList().clearAll();
                                            $$("idFormacao_efNome").getList().load(BASE_URL + "CEscola_Formacao/readXtipo?tipo=" + this.getValue());
                                        }
                                    }
                                },
                                //{ view: "text", label: 'Op&ccedil;&atilde;o', name: "Opcao", id: "idOpcao" },
                                { view: "richselect", label: 'Op&ccedil;&atilde;o', name: "opcNome", id: "idOpcao", options: { body: { template: "#opcNome#", yCount: 10, url: BASE_URL + "COpcao/read" } } },
                                {
                                    view: "text", label: 'M&eacute;dia', name: "Media", id: "idMedia", format: webix.Number.numToStr({
                                        groupDelimiter: ",",
                                        groupSize: 2,
                                        decimalDelimiter: ",",
                                        decimalSize: 2
                                    }),
                                    validate: "isNumber", validateEvent: "key"
                                },
                                {}
                            ]
                        }, {
                                rows: [
                                    { view: "richselect", label: 'Provincia', name: "provNome", id: "idFormacao_provNome", value: 1, options: { body: { template: "#provNome#", yCount: 10, url: BASE_URL + "CProvincias/read" } } },
                                    //{ view: "text", label: 'Escola', name: "Escola", id: "idEscola" },
                                    {
                                        view: "richselect", label: 'Escola', name: "efNome", id: "idFormacao_efNome", options: { body: { template: "#efNome#", yCount: 10, url: BASE_URL + "CEscola_Formacao/read" } },
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                //code
                                                $$("idOpcao").setValue("");
                                                $$("idOpcao").getList().clearAll();
                                                $$("idOpcao").getList().load(BASE_URL + "COpcao/readXtipo?escola=" + this.getValue());
                                            }
                                        }
                                    },
                                    //{ view: "text", label: 'Ano', name: "Ano", id: "idAno" },
                                    { view: "counter", label: "Ano", name: "Ano", value: 2016, id: "idAno", validate: "isNumber", validateEvent: "key" },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [{},
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_inscricao_add").close();
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
            header: "Endere&ccedil;o/Contacto", body: {
                view: "form",
                id: "idformADDDadosOutros",
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", label: 'Pais', name: "paNome", id: "idpaNome", value: 1, options: { body: { template: "#paNome#", yCount: 10, url: BASE_URL + "CPaises/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idprovNome").setValue("");
                                            $$("idprovNome").getList().clearAll();
                                            $$("idprovNome").getList().load(BASE_URL + "cProvincias/readXP?id=" + this.getValue());
                                        }
                                    }
                                },
                                {
                                    view: "richselect", id: "idmunNome", label: 'Municipio', name: "munNome", options: { body: { template: "#munNome#", yCount: 7, url: BASE_URL + "CMunicipios/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idbaiNome").setValue("");
                                            $$("idbaiNome").getList().clearAll();
                                            $$("idbaiNome").getList().load(BASE_URL + "cBairros/readXMunicipio?id=" + this.getValue());
                                        }
                                    }
                                },
                                { view: "text", label: 'Telefone', name: "cTelefone", id: "idcTelefone" },
                                {}
                            ]
                        }, {
                                rows: [
                                    {
                                        view: "richselect", id: "idprovNome", label: 'Provincia', name: "provNome", options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read" } },
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                //code
                                                //alert(this.getValue());
                                                $$("idmunNome").setValue("");
                                                $$("idmunNome").getList().clearAll();
                                                $$("idmunNome").getList().load(BASE_URL + "cMunicipios/readXProvincia?id=" + this.getValue());
                                            }
                                        }
                                    },
                                    { view: "richselect", id: "idbaiNome", label: 'Comuna', name: "baiNome", options: { body: { template: "#baiNome#", yCount: 7, url: BASE_URL + "CBairros/read" } } },
                                    { view: "text", label: 'E-Mail', name: "cEmail", id: "idcEmail" },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [
                            {
                                view: "button", type: "form", value: "Salvar", click: function () {
                                    //ver si ya existe el bi en la BD
                                    var envio = "bi=" + $$('idcBI_Passaporte').getValue();
                                    var rebi = webix.ajax().sync().post(BASE_URL + "CCandidatos/Existe_BI", envio);
                                    if (rebi.responseText == "true") {
                                        webix.message({ type: "error", text: "Erro, Ja existe um Candidato com este BI na Base de Dados" });
                                    } else {
                                        var profissao = ($$("idproNome").getValue()) ? $$("idproNome").getValue() : 1;
                                        var y = new Date;
                                        var ano_actual = y.getFullYear();
                                        var envio = "alAno=" + ano_actual;
                                        var r = webix.ajax().sync().post(BASE_URL + "CAnos_Lectivos/GetID", envio);
                                        var ano_id = r.responseText;
                                        if (ano_id !== "false") {
                                            if ($$("idcNome").getValue() && $$("idcApelido").getValue() && $$("idcBI_Passaporte").getValue() &&
                                                $$("idcBI_Data_Emissao").getValue() && $$("idhlfNome").getValue() && $$("idFormacao_efNome").getValue() &&
                                                $$("idOpcao").getValue() && $$("idMedia").getValue() && $$("idAno").getValue() &&
                                                $$("idpaNome").getValue() && $$("idprovNome").getValue() && $$("idmunNome").getValue() && $$("idbaiNome").getValue() &&
                                                $$("idNascimento_Provincias_id").getValue() && $$("idNascimento_Municipios_id").getValue()) {
                                                $$('idDTEdDadosPesoais').add({
                                                    cNome: $$("idcNome").getValue(),
                                                    cNomes: $$("idcNomes").getValue(),
                                                    cApelido: $$("idcApelido").getValue(),
                                                    gNome: $$("idgNome").getValue(),
                                                    ngNome: $$("idngNome").getValue(),
                                                    cNome_Mae: $$("idcNome_Mae").getValue(),
                                                    cBI_Data_Emissao: $$("idcBI_Data_Emissao").getValue(),
                                                    ecNome: $$("idecNome").getValue(),
                                                    cData_Nascimento: $$("idcData_Nascimento").getValue(),
                                                    provNascimento: $$("idNascimento_Provincias_id").getValue(),
                                                    munNascimento: $$("idNascimento_Municipios_id").getValue(),
                                                    cNome_Pai: $$("idcNome_Pai").getValue(),
                                                    cBI_Passaporte: $$("idcBI_Passaporte").getValue(),
                                                    provEmissao: $$("idcBI_Lugar_Emissao_Provincia_id").getValue(),
                                                    neeNome: $$("idneeNome").getValue(),
                                                    //Profissionais
                                                    proNome: profissao,
                                                    tilNome: ($$("idtilNome").getValue()) ? $$("idtilNome").getValue() : 1,
                                                    dlLocal_Trabalho: $$("iddlLocal_Trabalho").getValue(),
                                                    trabNome: $$("idtrabNome").getValue(),
                                                    otNome: ($$("idotNome").getValue()) ? $$("idotNome").getValue() : 1,
                                                    dlCargo: $$("iddlCargo").getValue(),
                                                    //Academicos
                                                    paFormacao: $$("idFormacao_paNome").getValue(),
                                                    provFormacao: $$("idFormacao_provNome").getValue(),
                                                    hlfNome: $$("idhlfNome").getValue(),
                                                    Opcao: $$("idOpcao").getValue(),
                                                    Media: $$("idMedia").getValue(),
                                                    efNome: $$("idFormacao_efNome").getValue(),
                                                    Ano: $$("idAno").getValue(),
                                                    //Localizacao
                                                    paNome: $$("idpaNome").getValue(),
                                                    provNome: $$("idprovNome").getValue(),
                                                    munNome: $$("idmunNome").getValue(),
                                                    baiNome: $$("idbaiNome").getValue(),
                                                    cTelefone: $$("idcTelefone").getValue(),
                                                    cEmail: $$("idcEmail").getValue(),
                                                    //outros dados
                                                    ano: ano_id,
                                                    usuario: user_sessao
                                                });
                                                //actualizar combo de BI en cursos Pretendidos
                                                ///////$$("idComboBI").getList().clearAll();
                                                //////$$("idComboBI").getList().load(BASE_URL + "CCandidatos/readBI");
                                                //actualizar grid de cursos Pretendidos
                                                $$("idDTCPretendidos").clearAll();
                                                $$("idDTCPretendidos").load(BASE_URL + "cCursos_Pretendidos/read");
                                                //actualizar grid de listas/Comprovativo
                                                $$("idDTInscricao").clearAll();
                                                $$("idDTInscricao").load(BASE_URL + "cCandidatos/readDInscricao");

                                                $$("idDTEdDadosPesoais").clearAll();
                                                $$("idDTEdDadosPesoais").load(BASE_URL + "cCandidatos/readDP");
                                                $$("idDTEdDadosProfisionais").clearAll();
                                                $$("idDTEdDadosProfisionais").load(BASE_URL + "cCandidatos/readDPRO");
                                                $$("idDTEdDadosAcademicos").clearAll();
                                                $$("idDTEdDadosAcademicos").load(BASE_URL + "cCandidatos/readDACA");
                                                $$("idDTEdDadosLocalizacao").clearAll();
                                                $$("idDTEdDadosLocalizacao").load(BASE_URL + "cCandidatos/readDLOC");

                                                $$("id_win_inscricao_add").close();
                                            } else {
                                                webix.message({ type: "error", text: "Algums campos s&atilde;o obrigatorios" });
                                            }

                                        }
                                        else {
                                            webix.message({ type: "error", text: "O ano actual n&atilde;o est&aacute; activo para inscri&ccedil;&atilde;o" });
                                        }
                                    }
                                }
                            },
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_inscricao_add").close();
                                }
                            }
                        ]
                    }
                ],
                elementsConfig: {
                    labelPosition: "top",
                }
            }
        }]
};
//editar
var formEDDadosPesoais = {
    view: "tabview",
    id: "id_form_inscricao_ed",
    //height:900,
    cells: [{
        header: "Dados Pessoais", body: {
            view: "form",
            id: "idformEDDadosPesoais",
            height: 450,
            borderless: true,
            elements: [
                {
                    cols: [{
                        rows: [
                            { view: "text", label: 'Nome', name: "cNome", id: "idcNome", validate: "isNotEmpty", validateEvent: "blur" },
                            { view: "text", label: 'Apelido', name: "cApelido", id: "idcApelido", validate: "isNotEmpty", validateEvent: "blur" },
                            { view: "datepicker", label: "Data Nascimento", name: "cData_Nascimento", id: "idcData_Nascimento", stringResult: true },
                            { view: "richselect", label: 'Nacionalidade', name: "ngNome", id: "idngNome", options: { body: { template: "#ngNome#", yCount: 7, url: BASE_URL + "CNacionalidades_Geral/read" } } },
                            { view: "richselect", label: 'Municipio Nascimento', name: "munNascimento", id: "idNascimento_Municipios_id", options: { body: { template: "#munNascimento#", yCount: 7, url: BASE_URL + "CMunicipios/readMN" } } },
                            { view: "datepicker", label: "BI Data Emiss&atilde;o", name: "cBI_Data_Emissao", id: "idcBI_Data_Emissao", stringResult: true },
                            { view: "text", label: 'Nome Pai', name: "cNome_Pai", id: "idcNome_Pai", validate: "isNotEmpty", validateEvent: "blur" },
                            { view: "richselect", label: 'Necessita educa&ccedil;&atilde;o especial', name: "neeNome", id: "idneeNome", options: { body: { template: "#neeNome#", yCount: 7, url: BASE_URL + "CNecessita_Educacao_Especial/read" } } },
                            {}
                        ]
                    }, {
                            rows: [
                                { view: "text", label: 'Nomes', name: "cNomes", id: "idcNomes", validate: "isNotEmpty", validateEvent: "blur" },
                                { view: "richselect", label: 'Genero', name: "gNome", id: "idgNome", options: { body: { template: "#gNome#", yCount: 7, url: BASE_URL + "CGeneros/read" } } },
                                { view: "richselect", label: 'Estado Civil', name: "ecNome", id: "idecNome", options: { body: { template: "#ecNome#", yCount: 7, url: BASE_URL + "CEstado_Civil/read" } } },
                                { view: "richselect", label: 'Provincia Nascimento', name: "provNascimento", id: "idNascimento_Provincias_id", options: { body: { template: "#provNascimento#", yCount: 7, url: BASE_URL + "CProvincias/readPN" } } },
                                { view: "text", label: 'BI/Passaporte', name: "cBI_Passaporte", id: "idcBI_Passaporte", validate: "isNotEmpty", validateEvent: "blur" },
                                { view: "richselect", label: 'BI Provincia Emiss&atilde;o', name: "cBI_Lugar_Emissao_Provincia_id", id: "idcBI_Lugar_Emissao_Provincia_id", options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read" } } },
                                { view: "text", label: 'Nome Mae', name: "cNome_Mae", id: "idcNome_Mae", validate: "isNotEmpty", validateEvent: "blur" },



                                {}
                            ]
                        }
                    ]
                }, {
                    cols: [{},
                        {
                            view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                $$("id_win_inscricao_ed").close();
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
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", label: 'Trabalhador', name: "trabNome", id: "idtrabNome", options: { body: { template: "#trabNome#", yCount: 10, url: BASE_URL + "CTrabalhador/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            if (this.getValue() == 2) {
                                                $$("idtilNome").disable();
                                                $$("iddlLocal_Trabalho").disable();
                                                $$("idproNome").disable();
                                                $$("idotNome").disable();
                                                $$("iddlCargo").disable();
                                            } else {
                                                $$("idtilNome").enable();
                                                $$("iddlLocal_Trabalho").enable();
                                                $$("idproNome").enable();
                                                $$("idotNome").enable();
                                                $$("iddlCargo").enable();
                                            }
                                        }
                                    }
                                },

                                { view: "richselect", label: 'Tipo Institui&ccedil;&atilde;o', name: "tilNome", id: "idtilNome", disabled: true, options: { body: { template: "#tilNome#", yCount: 7, url: BASE_URL + "CTipo_Instituicao_Laboral/read" } } },
                                { view: "text", label: 'Local de Trabalho', name: "dlLocal_Trabalho", disabled: true, id: "iddlLocal_Trabalho", },
                                {}
                            ]
                        }, {
                                rows: [
                                    { view: "richselect", label: 'Profiss&atilde;o', name: "proNome", id: "idproNome", disabled: true, options: { body: { template: "#proNome#", yCount: 10, url: BASE_URL + "CProfissao/read" } } },
                                    { view: "richselect", label: 'Organismo Tutela', name: "otNome", id: "idotNome", disabled: true, options: { body: { template: "#otNome#", yCount: 7, url: BASE_URL + "COrganismos_Tutela/read" } } },
                                    { view: "text", label: 'Cargo', name: "dlCargo", id: "iddlCargo", disabled: true },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [{},
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_inscricao_ed").close();
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
            header: "Dados Acad&eacute;micos", body: {
                view: "form",
                id: "idformADDDadosAcademicos",
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", label: 'Pa&iacute;s de Forma&ccedil;&atilde;o', name: "paNome", id: "idFormacao_paNome", options: { body: { template: "#paNome#", yCount: 10, url: BASE_URL + "CPaises/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idFormacao_provNome").setValue("");
                                            $$("idFormacao_provNome").getList().clearAll();
                                            $$("idFormacao_provNome").getList().load(BASE_URL + "CProvincias/readXP?id=" + this.getValue());
                                        }
                                    }
                                },
                                {
                                    view: "richselect", label: 'Habilita&ccedil;&atilde;o Literária', name: "hlfNome", id: "idhlfNome", options: { body: { template: "#hlfNome#", yCount: 7, url: BASE_URL + "CHabilitacoes_Literarias_Candidatos/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idFormacao_efNome").setValue("");
                                            $$("idFormacao_efNome").getList().clearAll();
                                            $$("idFormacao_efNome").getList().load(BASE_URL + "CEscola_Formacao/readXtipo?tipo=" + this.getValue());
                                        }
                                    }
                                },
                                //{ view: "text", label: 'Op&ccedil;&atilde;o', name: "Opcao", id: "idOpcao" },
                                { view: "richselect", label: 'Op&ccedil;&atilde;o', name: "opcNome", id: "idOpcao2", options: { body: { template: "#opcNome#", yCount: 10, url: BASE_URL + "COpcao/read" } } },
                                {
                                    view: "text", label: 'M&eacute;dia', name: "Media", id: "idMedia", format: webix.Number.numToStr({
                                        groupDelimiter: ",",
                                        groupSize: 2,
                                        decimalDelimiter: ",",
                                        decimalSize: 2
                                    }),
                                    validate: "isNumber", validateEvent: "key"
                                },
                                {}
                            ]
                        }, {
                                rows: [
                                    { view: "richselect", label: 'Provincia', name: "provNome", id: "idFormacao_provNome", options: { body: { template: "#provNome#", yCount: 10, url: BASE_URL + "CProvincias/read" } } },
                                    //{ view: "text", label: 'Escola', name: "Escola", id: "idEscola" },
                                    {
                                        view: "richselect", label: 'Escola', name: "efNome", id: "idFormacao_efNome", options: { body: { template: "#efNome#", yCount: 10, url: BASE_URL + "CEscola_Formacao/read" } },
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                //code
                                                //$$("idOpcao2").setValue("");
                                                //$$("idOpcao2").getList().clearAll();
                                                //$$("idOpcao2").getList().load(BASE_URL + "COpcao/readXtipo?escola=" + this.getValue());
                                            }
                                        }
                                    },
                                    //{ view: "text", label: 'Ano', name: "Ano", id: "idAno" },
                                    { view: "counter", label: "Ano", name: "Ano", id: "idAno", validate: "isNumber", validateEvent: "key" },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [{},
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_inscricao_ed").close();
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
            header: "Endere&ccedil;o/Contacto", body: {
                view: "form",
                id: "idformADDDadosOutros",
                height: 450,
                borderless: true,
                elements: [
                    {
                        cols: [{
                            rows: [
                                {
                                    view: "richselect", label: 'Pais', name: "paNome", id: "idpaNome", options: { body: { template: "#paNome#", yCount: 10, url: BASE_URL + "CPaises/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idprovNome").setValue("");
                                            $$("idprovNome").getList().clearAll();
                                            $$("idprovNome").getList().load(BASE_URL + "cProvincias/readXP?id=" + this.getValue());
                                        }
                                    }
                                },
                                {
                                    view: "richselect", id: "idmunNome", label: 'Municipio', name: "munNome", options: { body: { template: "#munNome#", yCount: 7, url: BASE_URL + "CMunicipios/read" } },
                                    on: {
                                        "onChange": function (newv, oldv) {
                                            //code
                                            //alert(this.getValue());
                                            $$("idbaiNome").setValue("");
                                            $$("idbaiNome").getList().clearAll();
                                            $$("idbaiNome").getList().load(BASE_URL + "cBairros/readXMunicipio?id=" + this.getValue());
                                        }
                                    }
                                },
                                { view: "text", label: 'Telefone', name: "cTelefone", id: "idcTelefone" },
                                {}
                            ]
                        }, {
                                rows: [
                                    {
                                        view: "richselect", id: "idprovNome", label: 'Provincia', name: "provNome", options: { body: { template: "#provNome#", yCount: 7, url: BASE_URL + "CProvincias/read" } },
                                        on: {
                                            "onChange": function (newv, oldv) {
                                                //code
                                                //alert(this.getValue());
                                                $$("idmunNome").setValue("");
                                                $$("idmunNome").getList().clearAll();
                                                $$("idmunNome").getList().load(BASE_URL + "cMunicipios/readXProvincia?id=" + this.getValue());
                                            }
                                        }
                                    },
                                    { view: "richselect", id: "idbaiNome", label: 'Comuna', name: "baiNome", options: { body: { template: "#baiNome#", yCount: 7, url: BASE_URL + "CBairros/read" } } },
                                    { view: "text", label: 'E-Mail', name: "cEmail", id: "idcEmail" },
                                    {}
                                ]
                            }
                        ]
                    }, {
                        cols: [
                            {
                                view: "button", type: "form", value: "Salvar", click: function () {
                                    var idSelecionado = $$("idDTEdDadosPesoais").getSelectedId(false, true);
                                    var profissao = ($$("idproNome").getValue()) ? $$("idproNome").getValue() : 1;
                                    var y = new Date;
                                    var ano_actual = y.getFullYear();
                                    var envio = "alAno=" + ano_actual;
                                    var r = webix.ajax().sync().post(BASE_URL + "CAnos_Lectivos/GetID", envio);
                                    var ano_id = r.responseText;
                                    if (idSelecionado) {
                                        //$$('idDTEdDadosPesoais').upd({
                                        var cNome = $$("idcNome").getValue();
                                        var cNomes = $$("idcNomes").getValue();
                                        var cApelido = $$("idcApelido").getValue();
                                        var gNome = $$("idgNome").getValue();
                                        var ngNome = $$("idngNome").getValue();
                                        var cNome_Mae = $$("idcNome_Mae").getValue();
                                        var cBI_Data_Emissao = $$("idcBI_Data_Emissao").getValue();
                                        var ecNome = $$("idecNome").getValue();
                                        var cData_Nascimento = $$("idcData_Nascimento").getValue();
                                        var provNascimento = $$("idNascimento_Provincias_id").getValue();
                                        var munNascimento = $$("idNascimento_Municipios_id").getValue();
                                        var cNome_Pai = $$("idcNome_Pai").getValue();
                                        var cBI_Passaporte = $$("idcBI_Passaporte").getValue();
                                        var provEmissao = $$("idcBI_Lugar_Emissao_Provincia_id").getValue();
                                        var neeNome = $$("idneeNome").getValue();
                                        //Profissionais
                                        var proNome = profissao;
                                        var tilNome = $$("idtilNome").getValue();
                                        var dlLocal_Trabalho = $$("iddlLocal_Trabalho").getValue();
                                        var trabNome = $$("idtrabNome").getValue();
                                        var otNome = $$("idotNome").getValue();
                                        var dlCargo = $$("iddlCargo").getValue();
                                        //Academicos
                                        var paFormacao = $$("idFormacao_paNome").getValue();
                                        var provFormacao = $$("idFormacao_provNome").getValue();
                                        var hlfNome = $$("idhlfNome").getValue();
                                        var Opcao = $$("idOpcao2").getValue();
                                        var Media = $$("idMedia").getValue();
                                        var efNome = $$("idFormacao_efNome").getValue();
                                        var Ano = $$("idAno").getValue();
                                        //Localizacao
                                        var paNome = $$("idpaNome").getValue();
                                        var provNome = $$("idprovNome").getValue();
                                        var munNome = $$("idmunNome").getValue();
                                        var baiNome = $$("idbaiNome").getValue();
                                        var cTelefone = $$("idcTelefone").getValue();
                                        var cEmail = $$("idcEmail").getValue();
                                        //outros dados
                                        var ano = ano_id;
                                        var usuario = user_sessao;
                                        //});
                                        var envio = "webix_operation=update" + "&id=" + idSelecionado + "&cNome=" + cNome + "&cNomes=" + cNomes + "&cApelido=" + cApelido + "&gNome=" + gNome + "&ngNome=" + ngNome + "&cNome_Mae=" + cNome_Mae +
                                            "&cBI_Data_Emissao=" + cBI_Data_Emissao + "&ecNome=" + ecNome + "&cData_Nascimento=" + cData_Nascimento + "&provNascimento=" + provNascimento +
                                            "&munNascimento=" + munNascimento + "&cNome_Pai=" + cNome_Pai + "&cBI_Passaporte=" + cBI_Passaporte + "&provEmissao=" + provEmissao +
                                            "&neeNome=" + neeNome +
                                            //Profissionais
                                            "&proNome=" + proNome + "&tilNome=" + tilNome + "&dlLocal_Trabalho=" + dlLocal_Trabalho + "&trabNome=" + trabNome + "&otNome=" + otNome + "&dlCargo=" + dlCargo +
                                            //Academicos
                                            "&paFormacao=" + paFormacao + "&provFormacao=" + provFormacao + "&hlfNome=" + hlfNome + "&Opcao=" + Opcao + "&Media=" + Media + "&efNome=" + efNome + "&Ano=" + Ano +
                                            //Localizacao
                                            "&paNome=" + paNome + "&provNome=" + provNome + "&munNome=" + munNome + "&baiNome=" + baiNome + "&cTelefone=" + cTelefone + "&cEmail=" + cEmail + "&ano=" + ano +
                                            //usuarios
                                            "&usuario=" + usuario;

                                        var r = webix.ajax().sync().post(BASE_URL + "CCandidatos/crud", envio);
                                        if (r.responseText == "true") {
                                            webix.message("Dados actualizados com sucesso");
                                        } else {
                                            webix.message({ type: "error", text: "Erro ao actualizar dados" });
                                        }
                                        $$("idDTEdDadosPesoais").clearAll();
                                        $$("idDTEdDadosPesoais").load(BASE_URL + "cCandidatos/readDP");
                                        $$("idDTEdDadosProfisionais").clearAll();
                                        $$("idDTEdDadosProfisionais").load(BASE_URL + "cCandidatos/readDPRO");
                                        $$("idDTEdDadosAcademicos").clearAll();
                                        $$("idDTEdDadosAcademicos").load(BASE_URL + "cCandidatos/readDACA");
                                        $$("idDTEdDadosLocalizacao").clearAll();
                                        $$("idDTEdDadosLocalizacao").load(BASE_URL + "cCandidatos/readDLOC");

                                        $$("id_win_inscricao_ed").close();
                                    }
                                    else {
                                        webix.message({ type: "error", text: "O ano actual n&atilde;o est&aacute; activo para inscri&ccedil;&atilde;o" });
                                    }

                                }
                            },
                            {
                                view: "button", value: "Cancelar", name: "cancel", type: "danger", click: function () {
                                    $$("id_win_inscricao_ed").close();
                                }
                            }
                        ]
                    }
                ],
                elementsConfig: {
                    labelPosition: "top",
                }
            }
        }]
}


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
                                var idSelecionado = $$("idDTEdDadosPesoais").getSelectedId(false, true);
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
                                var idSelecionado = $$("idDTEdDadosPesoais").getSelectedId(false, true);
                                var envio = "id=" + idSelecionado;
                                var r = webix.ajax().sync().post(BASE_URL + "cCandidatos/cargarFoto", envio);
                                var CODIGO_FOTO = r.responseText;
                                if (CODIGO_FOTO) {
                                    // idform_DP_superior_grid
                                    $$("idform_DP_superior_grid").removeView("id_template_foto");
                                    $$("idform_DP_superior_grid").addView({ view: "template", id: "id_template_foto", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Candidatos/' + CODIGO_FOTO + '.jpg /></div>' }, 2);
                                } else {
                                    $$("idform_DP_superior_grid").removeView("id_template_foto");
                                    $$("idform_DP_superior_grid").addView({ view: "template", id: "id_template_foto", width: 160, height: 120, template: '<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src=' + PRO_URL + 'Fotos/Candidatos/default.jpg /></div>' }, 2);
                                }

                                $$("idwinADDFotoCandidatos").close();
                            }
                        }
                    ]
                }

            ]
        }]
    };
    return formADDFoto;
}


