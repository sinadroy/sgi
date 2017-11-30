function cargarVistaFerias(itemID){
            $$("views").addView({
               view:"tabview",
               id:itemID, 
                height:900,
		cells:[
                    { 
                        //<div class='mark'>#badge# </div> #smNome#
                        //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                        header:"Editar Ferias", body:{    
                         //id:"Niveis de Acessos",
                        rows:[{
                            view:"form", scroll:false,
                            cols:[
                                {   view:"button", type:"form", value:"Adicionar", width:100, click:function(){
                                        webix.ui({
                                            view:"window",
                                            id:"idwinADDFerias",
                                            width:500,
                                            position:"center",
                                            modal:true,
                                            head:"Adicionar Ferias",
                                            body:webix.copy(formADDFerias)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdFerias").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var envio = "id="+idSelecionado;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cFerias/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdFerias").clearAll();
                                                            $$("idDTEdFerias").load(BASE_URL+"cFerias/read");
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
                            id:"idDTEdFerias",
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
                                {id:"ferData_Inicio",editor:"date", header:"Data Inicio",width:140,validate:webix.rules.isNotEmpty(),sort:"strig"},
                                {id:"ferData_Fin",editor:"date", header:"Data Fin",width:140,validate:webix.rules.isNotEmpty(),sort:"strig"},
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //validar todo
                                    if(id && data.ferData_Inicio && data.ferData_Fin)
                                    {
                                        var envio = "id="+id+
                                                "&ferData_Inicio="+data.ferData_Inicio+
                                                "&ferData_Fin="+data.ferData_Fin;
                                        var r = webix.ajax().sync().post(BASE_URL+"cFerias/update", envio);
                                        if(r.responseText == "true"){
                                            $$("idDTEdFerias").clearAll();
                                            $$("idDTEdFerias").load(BASE_URL+"cFerias/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdFerias").clearAll();
                                            $$("idDTEdFerias").load(BASE_URL+"cFerias/read");
                                        }
                                    
                                }
                                
                            },
                            url: BASE_URL+"cFerias/read",
                            pager:"pagerFerias"
                        },{
                            view:"pager", id:"pagerFerias",
                            template:"{common.prev()} {common.pages()} {common.next()}",
                            size:25,
                            group:10
                        }]   
                    }}
                ] 
            });
}
//Adicionar Ferias
var formADDFerias = {
    view:"form",
    id:"idformADDFerias",
    borderless:true,
    elements: [
        {rows:[
            {view:"combo",label:'Localizar por BI/Passaporte',name:"fBI_Passaporte",/*value:1,*/options:{body:{template:"#fBI_Passaporte#",yCount:7,url: BASE_URL+"CFuncionarios/readBI"}},
                on:{
                    "onChange": function(newv, oldv){
                        //code
                        //alert(this.getValue());
                        //$$("idComboProvincias").getList().clearAll();
                        //$$("idComboProvincias").getList().load(BASE_URL+"cProvincias/readXPais?id="+this.getValue());
                        
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
            {view:"datepicker", label:"Data Inicio", name:"fData_Inicio", stringResult:true,validate:"isNotEmpty", validateEvent:"blur"},
            {view:"datepicker", label:"Data Fin", name:"fData_Fin", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"}
        ]    
        },{
        cols:[
            { view:"button", value: "Salvar", click:function(){
                var id = $$("idformADDFerias").getValues().fBI_Passaporte;
                var ferData_Inicio = $$("idformADDFerias").getValues().fData_Inicio;
                var ferData_Fin = $$("idformADDFerias").getValues().fData_Fin;
            if(id && ferData_Inicio && ferData_Fin){ //validate form
                
                var envio = "Funcionarios_id="+id+
                        "&ferData_Inicio="+ferData_Inicio+
                        "&ferData_Fin="+ferData_Fin;
                var r = webix.ajax().sync().post(BASE_URL+"cFerias/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdFerias").load(BASE_URL+"cFerias/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDFerias").close();
            }}
        ]
    }
    ],
    elementsConfig:{
        labelPosition:"top",
    }
};