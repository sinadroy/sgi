function cargarVistaAutorizacao_Saida(itemID){
            $$("views").addView({
               view:"tabview",
               id:itemID, 
                height:900,
		cells:[
                    { 
                        //<div class='mark'>#badge# </div> #smNome#
                        //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                        header:"Editar Autoriza&ccedil;&atilde;o de Sa&iacute;das", body:{    
                         //id:"Niveis de Acessos",
                        rows:[{
                            view:"form", scroll:false,
                            cols:[
                                {   view:"button", type:"form", value:"Adicionar", width:100, click:function(){
                                        webix.ui({
                                            view:"window",
                                            id:"idwinADDAutorizacao_Saida",
                                            width:500,
                                            position:"center",
                                            modal:true,
                                            head:"Adicionar Sa&iacute;da",
                                            body:webix.copy(formADDAutorizacao_Saida)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdAutorizacao_Saida").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var envio = "id="+idSelecionado;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cAutorizacao_Saida/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdAutorizacao_Saida").clearAll();
                                                            $$("idDTEdAutorizacao_Saida").load(BASE_URL+"cAutorizacao_Saida/read");
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
                            id:"idDTEdAutorizacao_Saida",
                            //autowidth:true,
                            //autoConfig:true,
                            select:true,
                            editable:true,
                            //editable:true,
                            //editaction:"dblclick",
                            columns:[
                                {id:"id", header:"ID", css:"rank",width:30,sort:"int"},
                                {id:"Funcionarios_id", hidden:true,header:"ID", css:"rank",width:30,sort:"int"},
                                {id:"fNome", header:"Nome",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"fNomes", header:"Nomes",width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fApelido", header:"Apelido",width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fBI_Passaporte", header:"BI-Pass.",width:120, validate:webix.rules.isNotEmpty(),sort:"strig"},
                                {id:"autData_Inicio",editor:"date", header:"Data Inicio",width:140,validate:webix.rules.isNotEmpty(),sort:"strig"},
                                {id:"autData_Fin",editor:"date", header:"Data Fin",width:140,validate:webix.rules.isNotEmpty(),sort:"strig"},
                                {id:"autMotivo", editor:"text",header:"Motivo",width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //validar todo
                                    if(id && data.autData_Inicio && data.autData_Fin && data.autMotivo)
                                    {
                                        var envio = "id="+id+
                                                "&autData_Inicio="+data.autData_Inicio+
                                                "&autData_Fin="+data.autData_Fin+
                                                "&autMotivo="+data.autMotivo;
                                        var r = webix.ajax().sync().post(BASE_URL+"cAutorizacao_Saida/update", envio);
                                        if(r.responseText == "true"){
                                            $$("idDTEdAutorizacao_Saida").clearAll();
                                            $$("idDTEdAutorizacao_Saida").load(BASE_URL+"cAutorizacao_Saida/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdAutorizacao_Saida").clearAll();
                                            $$("idDTEdAutorizacao_Saida").load(BASE_URL+"cAutorizacao_Saida/read");
                                        }
                                    
                                }
                                
                            },
                            url: BASE_URL+"cAutorizacao_Saida/read",
                            pager:"pagerAutorizacao_Saida"
                        },{
                            view:"pager", id:"pagerAutorizacao_Saida",
                            template:"{common.prev()} {common.pages()} {common.next()}",
                            size:25,
                            group:10
                        }]   
                    }}
                ] 
            });
}
//Adicionar Autorizacao_Saida
var formADDAutorizacao_Saida = {
    view:"form",
    id:"idformADDAutorizacao_Saida",
    borderless:true,
    elements: [
        {rows:[
            {view:"combo",label:'Localizar por BI/Passaporte',name:"autBI_Passaporte",/*value:1,*/options:{body:{template:"#fBI_Passaporte#",yCount:7,url: BASE_URL+"CFuncionarios/readBI"}},
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
            { view:"text", id:"idComboFNome",readonly:true, label:'Nome', name:"fNome"},
            //{ view:"text", readonly:true, label:'Nomes', name:"fNomes",validate:"isNotEmpty", validateEvent:"blur"},
            { view:"text", id:"idComboFApelido",readonly:true, label:'Apelido', name:"fApelido"},
            {view:"datepicker", label:"Data Inicio", name:"autData_Inicio", stringResult:true,validate:"isNotEmpty", validateEvent:"blur"},
            {view:"datepicker", label:"Data Fin", name:"autData_Fin", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
            {view:"textarea", label:'Motivo',heigth:400, name:"autMotivo"}
        ]    
        },{
        cols:[
            { view:"button", value: "Salvar", click:function(){
                var id = $$("idformADDAutorizacao_Saida").getValues().autBI_Passaporte;
                var autData_Inicio = $$("idformADDAutorizacao_Saida").getValues().autData_Inicio;
                var autData_Fin = $$("idformADDAutorizacao_Saida").getValues().autData_Fin;
                var autMotivo = $$("idformADDAutorizacao_Saida").getValues().autMotivo;
            if(id && autData_Inicio && autData_Fin && autMotivo){ //validate form
                
                var envio = "Funcionarios_id="+id+
                        "&autData_Inicio="+autData_Inicio+
                        "&autData_Fin="+autData_Fin+
                        "&autMotivo="+autMotivo;
                var r = webix.ajax().sync().post(BASE_URL+"cAutorizacao_Saida/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdAutorizacao_Saida").load(BASE_URL+"cAutorizacao_Saida/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDAutorizacao_Saida").close();
            }}
        ]
    }
    ],
    elementsConfig:{
        labelPosition:"top",
    }
};