function cargarVistaPublicacoes(itemID){
            $$("views").addView({
               view:"tabview",
               id:itemID, 
                height:900,
		cells:[
                    { 
                        //<div class='mark'>#badge# </div> #smNome#
                        //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                        header:"Editar Publica&ccedil;&otilde;es", body:{    
                         //id:"Niveis de Acessos",
                        rows:[{
                            view:"form", scroll:false,
                            cols:[
                                {   view:"button", type:"form", value:"Adicionar", width:100, click:function(){
                                        webix.ui({
                                            view:"window",
                                            id:"idwinADDPublicacoes",
                                            width:500,
                                            //heigth:700,
                                            position:"center",
                                            modal:true,
                                            head:"Adicionar ",
                                            body:webix.copy(formADDPublicacoes)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdPublicacoes").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var envio = "id="+idSelecionado;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cPublicacoes/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdPublicacoes").clearAll();
                                                            $$("idDTEdPublicacoes").load(BASE_URL+"cPublicacoes/read");
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
                            id:"idDTEdPublicacoes",
                            select:true,
                            editable:true,
                            columns:[
                                {id:"id", header:"", css:"rank",width:30,sort:"int"},
                                {id:"Funcionarios_id", hidden:true,header:"ID", css:"rank",width:30,sort:"int"},
                                {id:"fNome", header:["Nome", {content:"textFilter"}],width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                //{id:"fNomes", header:["Nomes", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fApelido", header:["Apelido", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fBI_Passaporte", header:["BI-Pass.", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"strig"},
                                
                                {id:"pubTitulo",editor:"text", header:"T&iacute;tulo",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"pubAno",editor:"text", header:"Ano",width:170,validate:"isNumber", validateEvent:"blur",sort:"int"},
                                
                                {id:"pubEditora_Revista",editor:"text", header:"Editora/Revista",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                //pubISBN_ISSN
                                {id:"pubISBN_ISSN",editor:"text", header:"ISBN/ISSN",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"tpubNome",editor:"richselect", header:"Tipo de Publica&ccedil;&atilde;o",width:150,template:"#tpubNome#",options:BASE_URL+"cTipo_Publicacoes/read"},
                                
                                {id:"paNome",editor:"richselect", header:"Pais",width:150,template:"#paNome#",options:BASE_URL+"cPaises/read"},
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //validar todo
                                    if(id && data.Funcionarios_id && data.pubTitulo && data.pubAno &&  
                                        data.pubEditora_Revista && data.pubISBN_ISSN && data.tpubNome && data.paNome)
                                    {
                                        
                                        var idtp;
                                        if(isNaN(data.tpubNome)){
                                            var rtp = webix.ajax().sync().post(BASE_URL+"cTipo_Publicacoes/GetID", "tpubNome="+data.tpubNome);
                                            idtp = rtp.responseText; 
                                        }else{
                                            idtp = data.tpubNome;
                                        }
                                        var idpa;
                                        if(isNaN(data.paNome)){
                                            var rpa = webix.ajax().sync().post(BASE_URL+"cPaises/GetID", "paNome="+data.paNome);
                                            idpa = rpa.responseText; 
                                        }else{
                                            idpa = data.paNome;
                                        }
                                        
                                        var envio = "id="+id+
                                                "&Funcionarios_id="+data.Funcionarios_id+
                                                "&Tipo_Publicacoes_id="+idtp+
                                                "&pubTitulo="+data.pubTitulo+
                                                "&pubAno="+data.pubAno+
                                                "&pubEditora_Revista="+data.pubEditora_Revista+
                                                "&pubISBN_ISSN="+data.pubISBN_ISSN+
                                                "&tpubNome="+idtp+
                                                "&paNome="+idpa;
                                    var r = webix.ajax().sync().post(BASE_URL+"cPublicacoes/update", envio);
                                    if(r.responseText == "true"){
                                            $$("idDTEdPublicacoes").clearAll();
                                            $$("idDTEdPublicacoes").load(BASE_URL+"cPublicacoes/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdPublicacoes").clearAll();
                                            $$("idDTEdPublicacoes").load(BASE_URL+"cPublicacoes/read");
                                        }
                                    
                                }
                                
                            },
                            url: BASE_URL+"cPublicacoes/read",
                            pager:"pagerPublicacoes"
                        },{
                            view:"pager", id:"pagerPublicacoes",
                            template:"{common.prev()} {common.pages()} {common.next()}",
                            size:25,
                            group:10
                        }
                    ]   
                    }}
                ] 
            });
}
//Adicionar Publicacoes
var formADDPublicacoes = {
    view:"form",
    id:"idformADDPublicacoes",
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
                    { view:"text", id:"idComboFApelido",readonly:true, label:'Apelido', name:"fApelido"},
                    
                    {view:"text", label:"Titulo", name:"pubTitulo", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    //{view:"richselect",id:"idunivNome",label:'Universidade',name:"univNome",value:1,options:{body:{template:"#univNome#",yCount:10,url: BASE_URL+"CUniversidades/read"}}},
                    
                    {view:"text", label:"Ano", name:"pubAno", stringResult:true ,validate:"isNumber", validateEvent:"blur"},
                    
                    //{view:"richselect",id:"idbolNome",label:'Bolsa',name:"bolNome",value:1,options:{body:{template:"#bolNome#",yCount:10,url: BASE_URL+"CBolsa_Funcionarios/read"}}},
                    {view:"richselect",id:"paNome",label:'Pa&iacute;s',name:"paNome",value:1,options:{body:{template:"#paNome#",yCount:10,url: BASE_URL+"CPaises/read"}}},
                ]
            },{
                rows:[
                    {},
                    {view:"text", id:"idComboFNome",readonly:true, label:'Nome', name:"fNome"},
                    {view:"text", label:"Editora/Revista", name:"pubEditora_Revista", stringResult:true},
                    //{view:"text", label:"Op&ccedil;&atilde;o", name:"ffOpcao", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    {view:"text", label:"ISBN/ISSN", name:"pubISBN_ISSN", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    //{view:"text", label:"E-Mail Secretaria", name:"ffEmail_Secretaria", stringResult:true},
                    {view:"richselect",id:"idtpubNome",label:'Tipo de Publica&ccedil;&atilde;o',name:"tpubNome",value:1,options:{body:{template:"#tpubNome#",yCount:10,url: BASE_URL+"CTipo_Publicacoes/read"}}},
                    //{view:"richselect",id:"mfNome",label:'Modalidade Forma&ccedil;&atilde;o',name:"mfNome",value:1,options:{body:{template:"#mfNome#",yCount:10,url: BASE_URL+"CModalidades_Formacao/read"}}},
                    //{view:"text", label:"Ano de Fin", name:"fofuAno_Fin", stringResult:true ,validate:"isNumber", validateEvent:"blur"},
                    
                    //{view:"richselect",id:"opbNome",label:'Org&atilde;o Provendor Bolsa',name:"opbNome",value:1,options:{body:{template:"#opbNome#",yCount:10,url: BASE_URL+"COrgao_Provendor_Bolsas/read"}}},
                    //{view:"text", label:"Nota Ponderada", name:"fofuNota", stringResult:true ,validate:"isNumber", validateEvent:"blur"},
                ]
            }
        ]},{
        cols:[
            { view:"button", value: "Salvar", click:function(){
                var id = $$("idformADDPublicacoes").getValues().BI_Passaporte;
                var pubTitulo = $$("idformADDPublicacoes").getValues().pubTitulo;
                var pubAno = $$("idformADDPublicacoes").getValues().pubAno;
                var pubEditora_Revista = $$("idformADDPublicacoes").getValues().pubEditora_Revista;
                var pubISBN_ISSN = $$("idformADDPublicacoes").getValues().pubISBN_ISSN;
                var tpubNome = $$("idformADDPublicacoes").getValues().tpubNome;
                var paNome = $$("idformADDPublicacoes").getValues().paNome;
               
            if(id && pubTitulo && pubAno && pubEditora_Revista && pubISBN_ISSN && tpubNome && paNome){ //validate form
                
                var envio = "Funcionarios_id="+id+
                        "&pubTitulo="+pubTitulo+
                        "&pubAno="+pubAno+
                        "&pubEditora_Revista="+pubEditora_Revista+
                        "&pubISBN_ISSN="+pubISBN_ISSN+
                        "&tpubNome="+tpubNome+
                        "&paNome="+paNome;
                var r = webix.ajax().sync().post(BASE_URL+"cPublicacoes/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdPublicacoes").load(BASE_URL+"cPublicacoes/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDPublicacoes").close();
            }}
        ]
    }
    ],
    elementsConfig:{
        labelPosition:"top",
    }
};