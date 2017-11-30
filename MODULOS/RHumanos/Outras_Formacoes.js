function cargarVistaOutras_Formacoes(itemID){
            $$("views").addView({
               view:"tabview",
               id:itemID, 
                height:900,
		cells:[
                    { 
                        //<div class='mark'>#badge# </div> #smNome#
                        //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                        header:"Editar Forma&ccedil;&atilde;o", body:{    
                         //id:"Niveis de Acessos",
                        rows:[{
                            view:"form", scroll:false,
                            cols:[
                                {   view:"button", type:"form", value:"Adicionar", width:100, click:function(){
                                        webix.ui({
                                            view:"window",
                                            id:"idwinADDOutras_Formacoes",
                                            width:500,
                                            //heigth:700,
                                            position:"center",
                                            modal:true,
                                            head:"Adicionar ",
                                            body:webix.copy(formADDOutras_Formacoes)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdOutras_Formacoes").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var envio = "id="+idSelecionado;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cOutras_Formacoes/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdOutras_Formacoes").clearAll();
                                                            $$("idDTEdOutras_Formacoes").load(BASE_URL+"cOutras_Formacoes/read");
                                                            webix.message("Os dados foram apagados com sucesso");
                                                        }else{    
                                                            webix.message({ type:"error", text:"Erro apagando dados" });
                                                        }
                                                    }
                                                }
                                            }); 
                                        }else{    
                                            webix.message({ type:"error", text:"Erro apagando dados" });
                                        }
                                        
                                        }
                                        
                                },
                                {}
                            ]

                        },{
                            view:"datatable",
                            id:"idDTEdOutras_Formacoes",
                            select:true,
                            editable:true,
                            columns:[
                                {id:"id", header:"", css:"rank",width:30,sort:"int"},
                                {id:"Funcionarios_id", hidden:true,header:"ID", css:"rank",width:30,sort:"int"},
                                {id:"fNome", header:["Nome", {content:"textFilter"}],width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"fNomes", header:["Nomes", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fApelido", header:["Apelido", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fBI_Passaporte", header:["BI-Pass.", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"strig"},
                                //{id:"univNome",editor:"richselect", header:"Universidade",width:150,template:"#univNome#",options:BASE_URL+"cUniversidades/read"},
                                {id:"ofCurso",editor:"text", header:"Curso",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"ofData_Inicio",editor:"date", header:"Data Inicio",width:170,validate:"isNumber", validateEvent:"blur",sort:"int"},
                                {id:"ofData_Fim",editor:"date", header:"Data Fim",width:170,validate:"isNumber", validateEvent:"blur",sort:"int"},
                                {id:"ofInstituicao",editor:"text", header:"Institui&ccedil;&atilde;o",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"ofTipo_Formacao",editor:"text", header:"Tipo Forma&ccedil;&atilde;o",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                //{id:"ofTipo_Formacao",editor:"richselect", header:"Tipo Forma&ccedil;&atilde;o",width:150,template:"#gpNome#",options:BASE_URL+"cGraus_Pretendidos/read"},
                                //{id:"mfNome",editor:"richselect", header:"Modalidade Forma&ccedil;&atilde;o",width:150,template:"#mfNome#",options:BASE_URL+"cModalidades_Formacao/read"},
                                {id:"paNome",editor:"richselect", header:"Pais",width:150,template:"#paNome#",options:BASE_URL+"cPaises/read"},
                                //{id:"fofuNota",editor:"text", header:"Nota Ponderada",width:170,validate:"isNumber", validateEvent:"blur",sort:"int"}  
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //validar todo
                                    if(id && data.Funcionarios_id &&  data.ofCurso &&  
                                        data.ofData_Inicio && data.ofData_Fim && data.ofInstituicao && data.ofTipo_Formacao && data.paNome)
                                    {
                                        var idpa;
                                        if(isNaN(data.paNome)){
                                            var rpa = webix.ajax().sync().post(BASE_URL+"cPaises/GetID", "paNome="+data.paNome);
                                            idpa = rpa.responseText; 
                                        }else{
                                            idpa = data.paNome;
                                        }
                                        
                                        var envio = "id="+id+
                                                "&Funcionarios_id="+data.Funcionarios_id+
                                                "&ofCurso="+data.ofCurso+
                                                "&ofData_Inicio="+data.ofData_Inicio+
                                                "&ofData_Fim="+data.ofData_Fim+
                                                "&ofInstituicao="+data.ofInstituicao+
                                                "&ofTipo_Formacao="+data.ofTipo_Formacao+
                                                "&paNome="+idpa;
                                    var r = webix.ajax().sync().post(BASE_URL+"cOutras_Formacoes/update", envio);
                                    if(r.responseText == "true"){
                                            $$("idDTEdOutras_Formacoes").clearAll();
                                            $$("idDTEdOutras_Formacoes").load(BASE_URL+"cOutras_Formacoes/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdOutras_Formacoes").clearAll();
                                            $$("idDTEdOutras_Formacoes").load(BASE_URL+"cOutras_Formacoes/read");
                                        }
                                    
                                }
                                
                            },
                            url: BASE_URL+"cOutras_Formacoes/read",
                            pager:"pagerOutras_Formacoes"
                        },{
                            view:"pager", id:"pagerOutras_Formacoes",
                            template:"{common.prev()} {common.pages()} {common.next()}",
                            size:25,
                            group:10
                        }
                    ]   
                    }}
                ] 
            });
}
//Adicionar Em_Formacao_Funcionarios
var formADDOutras_Formacoes = {
    view:"form",
    id:"idformADDOutras_Formacoes",
    heigth:700,
    borderless:true,
    elements: [
        {cols:[
            {
                rows:[
                    {view:"combo",label:'Localizar por BI/Passaporte',name:"BI_Passaporte",/*value:1,*/options:{body:{template:"#fBI_Passaporte#",yCount:7,url: BASE_URL+"CFuncionarios/readBI"}},
                        on:{
                            "onChange": function(newv, oldv){
                                var fNome = webix.ajax().sync().post(BASE_URL+"cFuncionarios/readNomeXID", "id="+this.getValue());
                                var fApelido = webix.ajax().sync().post(BASE_URL+"cFuncionarios/readApelidoXID", "id="+this.getValue());
                                //if(r.responseText == "true"){
                                $$("idComboFNome").setValue(fNome.responseText);
                                $$("idComboFApelido").setValue(fApelido.responseText);
                            }
                        }
                    },
                    {view:"text", id:"idComboFNome",readonly:true, label:'Nome', name:"fNome"},
                    
                    {view:"text", label:"Curso", name:"ofCurso", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    //{view:"richselect",id:"idunivNome",label:'Universidade',name:"univNome",value:1,options:{body:{template:"#univNome#",yCount:10,url: BASE_URL+"CUniversidades/read"}}},
                    //{view:"text", label:"Web da Universidade", name:"ffWeb_Site_Univ", stringResult:true},
                    {view:"datepicker", label:"Data Inicio", name:"ofData_Inicio", stringResult:true ,validate:"isNumber", validateEvent:"blur"},
                    
                    //{view:"richselect",id:"idbolNome",label:'Bolsa',name:"bolNome",value:1,options:{body:{template:"#bolNome#",yCount:10,url: BASE_URL+"CBolsa_Funcionarios/read"}}},
                    {view:"text", label:"Tipo de Forma&ccedil;&atilde;o", name:"ofTipo_Formacao", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                ]
            },{
                rows:[
                    {},
                    { view:"text", id:"idComboFApelido",readonly:true, label:'Apelido', name:"fApelido"},
                    
                    //{view:"text", label:"Op&ccedil;&atilde;o", name:"ffOpcao", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    {view:"text", label:"Institui&ccedil;&atilde;o", name:"ofInstituicao", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    //{view:"text", label:"E-Mail Secretaria", name:"ffEmail_Secretaria", stringResult:true},
                    //{view:"richselect",id:"gpNome",label:'Forma&ccedil;&atilde;o',name:"gpNome",value:1,options:{body:{template:"#gpNome#",yCount:10,url: BASE_URL+"CGraus_Pretendidos/read"}}},
                    //{view:"richselect",id:"mfNome",label:'Modalidade Forma&ccedil;&atilde;o',name:"mfNome",value:1,options:{body:{template:"#mfNome#",yCount:10,url: BASE_URL+"CModalidades_Formacao/read"}}},
                    {view:"datepicker", label:"Data Fim", name:"ofData_Fim", stringResult:true ,validate:"isNumber", validateEvent:"blur"},
                    
                    //{view:"richselect",id:"opbNome",label:'Org&atilde;o Provendor Bolsa',name:"opbNome",value:1,options:{body:{template:"#opbNome#",yCount:10,url: BASE_URL+"COrgao_Provendor_Bolsas/read"}}},
                    {view:"richselect",id:"paNome",label:'Pa&iacute;s',name:"paNome",value:1,options:{body:{template:"#paNome#",yCount:10,url: BASE_URL+"CPaises/read"}}},
                        
                ]
            }
        ]},{
        cols:[
            { view:"button", value: "Salvar", click:function(){
                var id = $$("idformADDOutras_Formacoes").getValues().BI_Passaporte;
                var ofCurso = $$("idformADDOutras_Formacoes").getValues().ofCurso;
                var ofData_Inicio = $$("idformADDOutras_Formacoes").getValues().ofData_Inicio;
                var ofData_Fim = $$("idformADDOutras_Formacoes").getValues().ofData_Fim;
                var ofInstituicao = $$("idformADDOutras_Formacoes").getValues().ofInstituicao;
                var ofTipo_Formacao = $$("idformADDOutras_Formacoes").getValues().ofTipo_Formacao;
                var paNome = $$("idformADDOutras_Formacoes").getValues().paNome;
               
            if(id && ofCurso && ofData_Inicio && ofData_Fim && ofInstituicao && ofTipo_Formacao && paNome){ //validate form
                
                var envio = "Funcionarios_id="+id+
                        "&ofCurso="+ofCurso+
                        "&ofData_Inicio="+ofData_Inicio+
                        "&ofData_Fim="+ofData_Fim+
                        "&ofInstituicao="+ofInstituicao+
                        "&ofTipo_Formacao="+ofTipo_Formacao+
                        "&paNome="+paNome;
                var r = webix.ajax().sync().post(BASE_URL+"cOutras_Formacoes/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdOutras_Formacoes").load(BASE_URL+"cOutras_Formacoes/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDOutras_Formacoes").close();
            }}
        ]
    }
    ],
    elementsConfig:{
        labelPosition:"top",
    }
};