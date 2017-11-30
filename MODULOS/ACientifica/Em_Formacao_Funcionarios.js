function cargarVistaEm_Formacao_Funcionarios(itemID){
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
                                            id:"idwinADDEm_Formacao_Funcionarios",
                                            width:500,
                                            //heigth:700,
                                            position:"center",
                                            modal:true,
                                            head:"Adicionar ",
                                            body:webix.copy(formADDEm_Formacao_Funcionarios)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdEm_Formacao_Funcionarios").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var envio = "id="+idSelecionado;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cEm_Formacao_Funcionarios/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdEm_Formacao_Funcionarios").clearAll();
                                                            $$("idDTEdEm_Formacao_Funcionarios").load(BASE_URL+"cEm_Formacao_Funcionarios/read");
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
                                
                                {view:"button", type:"standard", value:"Imprimir", width:120, height:50, click:function(){
                                        //criar PDF
                                        //var idSelecionado = $$("idDTEdEm_Formacao_Funcionarios").getSelectedId(false,true);
                                       // if(idSelecionado){
                                            //var envio = "id="+idSelecionado;
                                            var r = webix.ajax().sync().post(BASE_URL+"cEm_Formacao_Funcionarios_IMP/imprimir", "imp=1");
                                            if(r.responseText == "true"){
                                                webix.message("PDF criado com sucesso");
                                                //Carregar PDF
                                                webix.ui({
                                                    view:"window",
                                                    id:"idWinPDFEm_Formacao_Funcionarios",
                                                    height:600,
                                                    width:950,
                                                    left:50, top:50,
                                                    move:true,
                                                    modal:true,
                                                    //head:"This window can be moved",
                                                    head:{
                                                        view:"toolbar", cols:[
                                                            {view:"label", label: "Imprimir" },
                                                            { view:"button", label: 'X', width: 50, align: 'right', click:"$$('idWinPDFEm_Formacao_Funcionarios').close();"}
                                                        ]
                                                    },
                                                    body:{
                                                        //template:"Some text"
                                                        template:'<div id="idPDFEm_Formacao_Funcionarios" style="width:940px;  height:590px"></div>'
                                                    }
                                                }).show();
                                                PDFObject.embed("../../relatorios/Em_Formacao_Funcionarios.pdf", "#idPDFEm_Formacao_Funcionarios");
                                            
                                            
                                            }else{    
                                                webix.message({ type:"error", text:"Erro atualizando dados" });
                                            }
                                    }
                                },
                                {}
                            ]

                        },{
                            view:"datatable",
                            id:"idDTEdEm_Formacao_Funcionarios",
                            //autowidth:true,
                            //autoConfig:true,
                            select:true,
                            editable:true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns:[
                                {id:"id", header:"", css:"rank",width:30,sort:"int"},
                                {id:"Funcionarios_id", hidden:true,header:"ID", css:"rank",width:30,sort:"int"},
                                {id:"fNome", header:["Nome", {content:"textFilter"}],width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"fNomes", header:["Nomes", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fApelido", header:["Apelido", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fBI_Passaporte", header:["BI-Pass.", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"strig"},
                                {id:"univNome",editor:"richselect", header:"Universidade",width:150,template:"#univNome#",options:BASE_URL+"cUniversidades/read"},
                                {id:"ffCurso",editor:"text", header:"Curso",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"ffOpcao",editor:"text", header:"Op&ccedil;&atilde;o",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"ffWeb_Site_Univ",editor:"text", header:"Sitio Web da Univ.",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"ffEmail_Secretaria",editor:"text", header:"E-Mail Secretaria",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"ffAno_Inicio",editor:"text", header:"Ano Inicio",width:170,validate:"isNumber", validateEvent:"blur",sort:"int"},
                                {id:"ffAno_Fin",editor:"text", header:"Ano Fim",width:170,validate:"isNumber", validateEvent:"blur",sort:"int"},
                                {id:"bolNome",editor:"richselect", header:"Bolsa",width:150,template:"#bolNome#",options:BASE_URL+"cBolsa_Funcionarios/read"},
                                {id:"ffTema_Tese",editor:"text", header:"Tema de Tese",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"gpNome",editor:"richselect", header:"Grau Pretendido",width:150,template:"#gpNome#",options:BASE_URL+"cGraus_Pretendidos/read"},
                                //{id:"gpNome",editor:"text", header:"Grau Pretendido",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"opbNome",editor:"richselect", header:"Provendor Bolsa",width:150,template:"#opbNome#",options:BASE_URL+"cOrgao_Provendor_Bolsas/read"},
                                //{id:"opbNome",editor:"text", header:"Provendor Bolsa",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"mfNome",editor:"richselect", header:"Modalidade Forma&ccedil;&atilde;o",width:150,template:"#mfNome#",options:BASE_URL+"cModalidades_Formacao/read"},
                                //{id:"mfNome",editor:"text", header:"Modalidade Forma&ccedil;&atilde;o",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"paNome",editor:"richselect", header:"Pais",width:150,template:"#paNome#",options:BASE_URL+"cPaises/read"},
                                //{id:"paNome",editor:"text", header:"Pais",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"ffCidade",editor:"text", header:"Cidade",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"}  
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //validar todo
                                    if(id && data.Funcionarios_id && data.univNome && data.ffCurso && data.ffOpcao && 
                                            data.ffWeb_Site_Univ && data.ffTema_Tese && data.gpNome && data.opbNome && data.mfNome && data.paNome 
                                           /* && data.ffCidade*/)
                                    {
                                        //var idBolsa;
                                        //if(data.bolNome == "Sim"){idBolsa = "1";}else{idBolsa = "2";}
                                        var idbol;
                                        if(isNaN(data.bolNome)){
                                            var rbol = webix.ajax().sync().post(BASE_URL+"cBolsa_Funcionarios/GetID", "bolNome="+data.bolNome);
                                            idbol = rbol.responseText; 
                                        }else{
                                            idbol = data.bolNome;
                                        }
                                        var idgp;
                                        if(isNaN(data.gpNome)){
                                            var rgp = webix.ajax().sync().post(BASE_URL+"cGraus_Pretendidos/GetID", "gpNome="+data.gpNome);
                                            idgp = rgp.responseText; 
                                        }else{
                                            idgp = data.gpNome;
                                        }
                                        var idopb;
                                        if(isNaN(data.opbNome)){
                                            var ropb = webix.ajax().sync().post(BASE_URL+"cOrgao_Provendor_Bolsas/GetID", "opbNome="+data.opbNome);
                                            idopb = ropb.responseText; 
                                        }else{
                                            idopb = data.opbNome;
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
                                        //data.univNome
                                        var iduniv;
                                        if(isNaN(data.univNome)){
                                            var runiv = webix.ajax().sync().post(BASE_URL+"cUniversidades/GetID", "univNome="+data.univNome);
                                            iduniv = runiv.responseText; 
                                        }else{
                                            iduniv = data.univNome;
                                        }
                                        
                                        var envio = "id="+id+
                                                "&Funcionarios_id="+data.Funcionarios_id+
                                                //"&fNome="+data.fNome+
                                                //"&fNomes="+data.fNomes+
                                                //"&fApelido="+data.fApelido+
                                                //"&fBI_Passaporte="+data.fBI_Passaporte+
                                                "&Universidades_id="+iduniv+
                                                "&ffCurso="+data.ffCurso+
                                                "&ffOpcao="+data.ffOpcao+
                                                "&ffWeb_Site_Univ="+data.ffWeb_Site_Univ+
                                                "&ffEmail_Secretaria="+data.ffEmail_Secretaria+
                                                "&ffAno_Inicio="+data.ffAno_Inicio+
                                                "&ffAno_Fin="+data.ffAno_Fin+
                                                "&bolNome="+idbol+
                                                "&ffTema_Tese="+data.ffTema_Tese+
                                                "&gpNome="+idgp+
                                                "&opbNome="+idopb+
                                                "&mfNome="+idmf+
                                               // "&gpNome="+idgp+
                                                "&paNome="+idpa+
                                                "&ffCidade="+data.ffCidade;
                                        //var r = webix.ajax().sync().post(BASE_URL+"cEm_Formacao_Funcionarios/updateEF", envio);
                                        //if(r.responseText == "true"){
                                    var r = webix.ajax().sync().get(BASE_URL+"cEm_Formacao_Funcionarios/update", envio);
                                    if(r.responseText == "true"){
                                            $$("idDTEdEm_Formacao_Funcionarios").clearAll();
                                            $$("idDTEdEm_Formacao_Funcionarios").load(BASE_URL+"cEm_Formacao_Funcionarios/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdEm_Formacao_Funcionarios").clearAll();
                                            $$("idDTEdEm_Formacao_Funcionarios").load(BASE_URL+"cEm_Formacao_Funcionarios/read");
                                        }
                                    
                                }
                                
                            },
                            url: BASE_URL+"cEm_Formacao_Funcionarios/read",
                            pager:"pagerEm_Formacao_Funcionarios"
                        },{
                            view:"pager", id:"pagerEm_Formacao_Funcionarios",
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
var formADDEm_Formacao_Funcionarios = {
    view:"form",
    id:"idformADDEm_Formacao_Funcionarios",
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
                    {view:"text", label:"Curso", name:"ffCurso", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    {view:"richselect",id:"idunivNome",label:'Universidade',name:"univNome",value:1,options:{body:{template:"#univNome#",yCount:10,url: BASE_URL+"CUniversidades/read"}}},
                    {view:"text", label:"Web da Universidade", name:"ffWeb_Site_Univ", stringResult:true},
                    {view:"text", label:"Ano de Inicio", name:"ffAno_Inicio", stringResult:true ,validate:"isNumber", validateEvent:"blur"},
                    {view:"richselect",id:"gpNome",label:'Grau Pretendido',name:"gpNome",value:1,options:{body:{template:"#gpNome#",yCount:10,url: BASE_URL+"CGraus_Pretendidos/read"}}},
                    {view:"richselect",id:"idbolNome",label:'Bolsa',name:"bolNome",value:1,options:{body:{template:"#bolNome#",yCount:10,url: BASE_URL+"CBolsa_Funcionarios/read"}}},
                    {view:"richselect",id:"paNome",label:'Pa&iacute;s',name:"paNome",value:1,options:{body:{template:"#paNome#",yCount:10,url: BASE_URL+"CPaises/read"}}},
                ]
            },{
                rows:[
                    {},
                    { view:"text", id:"idComboFApelido",readonly:true, label:'Apelido', name:"fApelido"},
                    {view:"text", label:"Op&ccedil;&atilde;o", name:"ffOpcao", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    {view:"text", label:"Tema da Tese", name:"ffTema_Tese", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    {view:"text", label:"E-Mail Secretaria", name:"ffEmail_Secretaria", stringResult:true},
                    {view:"text", label:"Ano de Fin", name:"ffAno_Fin", stringResult:true ,validate:"isNumber", validateEvent:"blur"},
                    {view:"richselect",id:"mfNome",label:'Modalidade Forma&ccedil;&atilde;o',name:"mfNome",value:1,options:{body:{template:"#mfNome#",yCount:10,url: BASE_URL+"CModalidades_Formacao/read"}}},
                    {view:"richselect",id:"opbNome",label:'Org&atilde;o Provendor Bolsa',name:"opbNome",value:1,options:{body:{template:"#opbNome#",yCount:10,url: BASE_URL+"COrgao_Provendor_Bolsas/read"}}},
                    {view:"text", label:"Cidade", name:"ffCidade", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                ]
            }
        ]},
        /*{rows:[
            
            //{view:"text", label:"Motivo", name:"sanMotivo", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
            //{view:"textarea", label:'Observa&ccedil;&atilde;o',heigth:400, name:"sanObs"}
            
        ]    
        },*/{
        cols:[
            { view:"button", value: "Salvar", click:function(){
                var id = $$("idformADDEm_Formacao_Funcionarios").getValues().BI_Passaporte;
                var univNome = $$("idformADDEm_Formacao_Funcionarios").getValues().univNome;
                var ffCurso = $$("idformADDEm_Formacao_Funcionarios").getValues().ffCurso;
                var ffOpcao = $$("idformADDEm_Formacao_Funcionarios").getValues().ffOpcao;
                var ffWeb_Site_Univ = $$("idformADDEm_Formacao_Funcionarios").getValues().ffWeb_Site_Univ;
                var ffEmail_Secretaria = $$("idformADDEm_Formacao_Funcionarios").getValues().ffEmail_Secretaria;
                var ffAno_Inicio = $$("idformADDEm_Formacao_Funcionarios").getValues().ffAno_Inicio;
                var ffAno_Fin = $$("idformADDEm_Formacao_Funcionarios").getValues().ffAno_Fin;
                var bolNome = $$("idformADDEm_Formacao_Funcionarios").getValues().bolNome;
                var ffTema_Tese = $$("idformADDEm_Formacao_Funcionarios").getValues().ffTema_Tese;
                var gpNome = $$("idformADDEm_Formacao_Funcionarios").getValues().gpNome;
                var opbNome = $$("idformADDEm_Formacao_Funcionarios").getValues().opbNome;
                var mfNome = $$("idformADDEm_Formacao_Funcionarios").getValues().mfNome;
                var paNome = $$("idformADDEm_Formacao_Funcionarios").getValues().paNome;
                var ffCidade = $$("idformADDEm_Formacao_Funcionarios").getValues().ffCidade;
               
            if(id && univNome && ffOpcao && ffAno_Inicio && ffAno_Fin && bolNome && ffTema_Tese && gpNome && mfNome && paNome && ffCidade){ //validate form
                
                var envio = "Funcionarios_id="+id+
                        "&univNome="+univNome+
                        "&ffCurso="+ffCurso+
                        "&ffOpcao="+ffOpcao+
                        "&ffWeb_Site_Univ="+ffWeb_Site_Univ+
                        "&ffEmail_Secretaria="+ffEmail_Secretaria+
                        "&ffAno_Inicio="+ffAno_Inicio+
                        "&ffAno_Fin="+ffAno_Fin+
                        "&bolNome="+bolNome+
                        "&ffTema_Tese="+ffTema_Tese+
                        "&gpNome="+gpNome+
                        "&opbNome="+opbNome+
                        "&mfNome="+mfNome+
                        "&paNome="+paNome+
                        "&ffCidade="+ffCidade;
                var r = webix.ajax().sync().post(BASE_URL+"cEm_Formacao_Funcionarios/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdEm_Formacao_Funcionarios").load(BASE_URL+"cEm_Formacao_Funcionarios/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDEm_Formacao_Funcionarios").close();
            }}
        ]
    }
    ],
    elementsConfig:{
        labelPosition:"top",
    }
};