function cargarVistaFormacao_Funcionarios(itemID){
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
                                            id:"idwinADDFormacao_Funcionarios",
                                            width:500,
                                            //heigth:700,
                                            position:"center",
                                            modal:true,
                                            head:"Adicionar ",
                                            body:webix.copy(formADDFormacao_Funcionarios)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdFormacao_Funcionarios").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var envio = "id="+idSelecionado;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cFormacao_Funcionarios/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdFormacao_Funcionarios").clearAll();
                                                            $$("idDTEdFormacao_Funcionarios").load(BASE_URL+"cFormacao_Funcionarios/read");
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
                            id:"idDTEdFormacao_Funcionarios",
                            select:true,
                            editable:true,
                            columns:[
                                {id:"id", header:"", css:"rank",width:30,sort:"int"},
                                {id:"Funcionarios_id", hidden:true,header:"ID", css:"rank",width:30,sort:"int"},
                                {id:"fNome", header:["Nome", {content:"textFilter"}],width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"fNomes", header:["Nomes", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fApelido", header:["Apelido", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fBI_Passaporte", header:["BI-Pass.", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"strig"},
                                {id:"univNome",editor:"richselect", header:"Universidade",width:150,template:"#univNome#",options:BASE_URL+"cUniversidades/read"},
                                {id:"fofuCurso",editor:"text", header:"Curso",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"fofuAno_Inicio",editor:"text", header:"Ano Inicio",width:170,validate:"isNumber", validateEvent:"blur",sort:"int"},
                                {id:"fofuAno_Fin",editor:"text", header:"Ano Fim",width:170,validate:"isNumber", validateEvent:"blur",sort:"int"},
                                {id:"fofuTema_Tese",editor:"text", header:"Tema de Tese",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"gpNome",editor:"richselect", header:"Forma&ccedil;&atilde;o",width:150,template:"#gpNome#",options:BASE_URL+"cGraus_Pretendidos/read"},
                                {id:"mfNome",editor:"richselect", header:"Modalidade Forma&ccedil;&atilde;o",width:150,template:"#mfNome#",options:BASE_URL+"cModalidades_Formacao/read"},
                                {id:"paNome",editor:"richselect", header:"Pais",width:150,template:"#paNome#",options:BASE_URL+"cPaises/read"},
                                {id:"fofuNota",editor:"text", header:"Nota Ponderada",width:170,validate:"isNumber", validateEvent:"blur",sort:"int"}  
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //validar todo
                                    if(id && data.Funcionarios_id && data.univNome && data.fofuCurso &&  
                                        data.fofuTema_Tese && data.gpNome && data.mfNome && data.paNome && data.fofuNota)
                                    {
                                        var idgp;
                                        if(isNaN(data.gpNome)){
                                            var rgp = webix.ajax().sync().post(BASE_URL+"cGraus_Pretendidos/GetID", "gpNome="+data.gpNome);
                                            idgp = rgp.responseText; 
                                        }else{
                                            idgp = data.gpNome;
                                        }
                                        var idmf;
                                        if(isNaN(data.mfNome)){
                                            var rmf = webix.ajax().sync().post(BASE_URL+"cModalidades_Formacao/GetID", "mfNome="+data.mfNome);
                                            idmf = rmf.responseText; 
                                        }else{
                                            idmf = data.mfNome;
                                        }
                                        var idpa;
                                        if(isNaN(data.paNome)){
                                            var rpa = webix.ajax().sync().post(BASE_URL+"cPaises/GetID", "paNome="+data.paNome);
                                            idpa = rpa.responseText; 
                                        }else{
                                            idpa = data.paNome;
                                        }
                                        var iduniv;
                                        if(isNaN(data.univNome)){
                                            var runiv = webix.ajax().sync().post(BASE_URL+"cUniversidades/GetID", "univNome="+data.univNome);
                                            iduniv = runiv.responseText; 
                                        }else{
                                            iduniv = data.univNome;
                                        }
                                        
                                        var envio = "id="+id+
                                                "&Funcionarios_id="+data.Funcionarios_id+
                                                "&Universidades_id="+iduniv+
                                                "&fofuCurso="+data.fofuCurso+
                                                "&fofuAno_Inicio="+data.fofuAno_Inicio+
                                                "&fofuAno_Fin="+data.fofuAno_Fin+
                                                "&fofuTema_Tese="+data.fofuTema_Tese+
                                                "&gpNome="+idgp+
                                                "&fofuNota="+data.fofuNota+
                                                "&mfNome="+idmf+
                                                "&paNome="+idpa;
                                    var r = webix.ajax().sync().get(BASE_URL+"cFormacao_Funcionarios/update", envio);
                                    if(r.responseText == "true"){
                                            $$("idDTEdFormacao_Funcionarios").clearAll();
                                            $$("idDTEdFormacao_Funcionarios").load(BASE_URL+"cFormacao_Funcionarios/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdFormacao_Funcionarios").clearAll();
                                            $$("idDTEdFormacao_Funcionarios").load(BASE_URL+"cFormacao_Funcionarios/read");
                                        }
                                    
                                }
                                
                            },
                            url: BASE_URL+"cFormacao_Funcionarios/read",
                            pager:"pagerFormacao_Funcionarios"
                        },{
                            view:"pager", id:"pagerFormacao_Funcionarios",
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
var formADDFormacao_Funcionarios = {
    view:"form",
    id:"idformADDFormacao_Funcionarios",
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
                    {view:"text", label:"Curso", name:"fofuCurso", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    {view:"richselect",id:"idunivNome",label:'Universidade',name:"univNome",value:1,options:{body:{template:"#univNome#",yCount:10,url: BASE_URL+"CUniversidades/read"}}},
                    //{view:"text", label:"Web da Universidade", name:"ffWeb_Site_Univ", stringResult:true},
                    {view:"text", label:"Ano Inicio", name:"fofuAno_Inicio", stringResult:true ,validate:"isNumber", validateEvent:"blur"},
                    
                    //{view:"richselect",id:"idbolNome",label:'Bolsa',name:"bolNome",value:1,options:{body:{template:"#bolNome#",yCount:10,url: BASE_URL+"CBolsa_Funcionarios/read"}}},
                    {view:"richselect",id:"paNome",label:'Pa&iacute;s',name:"paNome",value:1,options:{body:{template:"#paNome#",yCount:10,url: BASE_URL+"CPaises/read"}}},
                ]
            },{
                rows:[
                    {},
                    {view:"text", id:"idComboFNome",readonly:true, label:'Nome', name:"fNome"},
                    
                    //{view:"text", label:"Op&ccedil;&atilde;o", name:"ffOpcao", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    {view:"text", label:"Tema da Tese", name:"fofuTema_Tese", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    //{view:"text", label:"E-Mail Secretaria", name:"ffEmail_Secretaria", stringResult:true},
                    {view:"richselect",id:"gpNome",label:'Forma&ccedil;&atilde;o',name:"gpNome",value:1,options:{body:{template:"#gpNome#",yCount:10,url: BASE_URL+"CGraus_Pretendidos/read"}}},
                    {view:"richselect",id:"mfNome",label:'Modalidade Forma&ccedil;&atilde;o',name:"mfNome",value:1,options:{body:{template:"#mfNome#",yCount:10,url: BASE_URL+"CModalidades_Formacao/read"}}},
                    {view:"text", label:"Ano Fim", name:"fofuAno_Fin", stringResult:true ,validate:"isNumber", validateEvent:"blur"},
                    
                    //{view:"richselect",id:"opbNome",label:'Org&atilde;o Provendor Bolsa',name:"opbNome",value:1,options:{body:{template:"#opbNome#",yCount:10,url: BASE_URL+"COrgao_Provendor_Bolsas/read"}}},
                    {view:"text", label:"Nota Ponderada", name:"fofuNota", stringResult:true ,validate:"isNumber", validateEvent:"blur"},
                ]
            }
        ]},{
        cols:[
            { view:"button", value: "Salvar", click:function(){
                var id = $$("idformADDFormacao_Funcionarios").getValues().BI_Passaporte;
                var univNome = $$("idformADDFormacao_Funcionarios").getValues().univNome;
                var fofuCurso = $$("idformADDFormacao_Funcionarios").getValues().fofuCurso;
                var fofuAno_Inicio = $$("idformADDFormacao_Funcionarios").getValues().fofuAno_Inicio;
                var fofuAno_Fin = $$("idformADDFormacao_Funcionarios").getValues().fofuAno_Fin;
                var fofuTema_Tese = $$("idformADDFormacao_Funcionarios").getValues().fofuTema_Tese;
                var gpNome = $$("idformADDFormacao_Funcionarios").getValues().gpNome;
                var mfNome = $$("idformADDFormacao_Funcionarios").getValues().mfNome;
                var paNome = $$("idformADDFormacao_Funcionarios").getValues().paNome;
                var fofuNota= $$("idformADDFormacao_Funcionarios").getValues().fofuNota;
               
            if(id && univNome && fofuCurso && fofuAno_Inicio && fofuAno_Fin && fofuTema_Tese && gpNome && mfNome && paNome && fofuNota){ //validate form
                
                var envio = "Funcionarios_id="+id+
                        "&univNome="+univNome+
                        "&fofuCurso="+fofuCurso+
                        "&fofuAno_Inicio="+fofuAno_Inicio+
                        "&fofuAno_Fin="+fofuAno_Fin+
                        "&fofuTema_Tese="+fofuTema_Tese+
                        "&gpNome="+gpNome+
                        "&mfNome="+mfNome+
                        "&paNome="+paNome+
                        "&fofuNota="+fofuNota;
                var r = webix.ajax().sync().post(BASE_URL+"cFormacao_Funcionarios/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdFormacao_Funcionarios").load(BASE_URL+"cFormacao_Funcionarios/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDFormacao_Funcionarios").close();
            }}
        ]
    }
    ],
    elementsConfig:{
        labelPosition:"top",
    }
};