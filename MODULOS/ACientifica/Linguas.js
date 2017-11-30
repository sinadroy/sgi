function cargarVistaLinguas_Funcionarios(itemID){
            $$("views").addView({
               view:"tabview",
               id:itemID, 
                height:900,
		cells:[
                    { 
                        //<div class='mark'>#badge# </div> #smNome#
                        //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                        header:"Editar L&iacute;ngua", body:{    
                         //id:"Niveis de Acessos",
                        rows:[{
                            view:"form", scroll:false,
                            cols:[
                                {   view:"button", type:"form", value:"Adicionar", width:100, click:function(){
                                        webix.ui({
                                            view:"window",
                                            id:"idwinADDLinguas_Funcionarios",
                                            width:500,
                                            //heigth:700,
                                            position:"center",
                                            modal:true,
                                            head:"Adicionar ",
                                            body:webix.copy(formADDLinguas_Funcionarios)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdLinguas_Funcionarios").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var envio = "id="+idSelecionado;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cLinguas_Funcionarios/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdLinguas_Funcionarios").clearAll();
                                                            $$("idDTEdLinguas_Funcionarios").load(BASE_URL+"cLinguas_Funcionarios/read");
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
                            id:"idDTEdLinguas_Funcionarios",
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
                                //{id:"fNomes", header:["Nomes", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fApelido", header:["Apelido", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fBI_Passaporte", header:["BI-Pass.", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"strig"},
                                {id:"linNome",editor:"richselect", header:"l&iacute;ngua",width:150,template:"#linNome#",options:BASE_URL+"cLinguas/read"},
                                {id:"lnNome",editor:"richselect", header:"N&iacute;vel",width:150,template:"#lnNome#",options:BASE_URL+"cLinguas_Nivel/read"}
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //validar todo
                                    if(id && data.Funcionarios_id && data.linNome && data.lnNome)
                                    {
                                        var idlin;
                                        if(isNaN(data.linNome)){
                                            var rlin = webix.ajax().sync().post(BASE_URL+"cLinguas/GetID", "linNome="+data.linNome);
                                            idlin = rlin.responseText; 
                                        }else{
                                            idlin = data.linNome;
                                        }
                                        var idln;
                                        if(isNaN(data.lnNome)){
                                            var rgp = webix.ajax().sync().post(BASE_URL+"cLinguas_Nivel/GetID", "lnNome="+data.lnNome);
                                            idln = rgp.responseText; 
                                        }else{
                                            idln = data.lnNome;
                                        }
                                        
                                        var envio = "id="+id+
                                                "&Funcionarios_id="+data.Funcionarios_id+
                                                "&linguas_id="+idlin+
                                                "&linguas_nivel_id="+idln;
                                    var r = webix.ajax().sync().post(BASE_URL+"cLinguas_Funcionarios/update", envio);
                                    if(r.responseText == "true"){
                                            $$("idDTEdLinguas_Funcionarios").clearAll();
                                            $$("idDTEdLinguas_Funcionarios").load(BASE_URL+"cLinguas_Funcionarios/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdLinguas_Funcionarios").clearAll();
                                            $$("idDTEdLinguas_Funcionarios").load(BASE_URL+"cLinguas_Funcionarios/read");
                                        }
                                    
                                }
                                
                            },
                            url: BASE_URL+"cLinguas_Funcionarios/read",
                            pager:"pagerLinguas_Funcionarios"
                        },{
                            view:"pager", id:"pagerLinguas_Funcionarios",
                            template:"{common.prev()} {common.pages()} {common.next()}",
                            size:25,
                            group:10
                        }
                    ]   
                    }}
                ] 
            });
}
//Adicionar Linguas_Funcionarios
var formADDLinguas_Funcionarios = {
    view:"form",
    id:"idformADDLinguas_Funcionarios",
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
                    
                    {view:"richselect",id:"linNome",label:'L&iacute;ngua',name:"linNome",value:1,options:{body:{template:"#linNome#",yCount:10,url: BASE_URL+"CLinguas/read"}}},
                ]
            },{
                rows:[
                    {},
                    { view:"text", id:"idComboFApelido",readonly:true, label:'Apelido', name:"fApelido"},
                    
                    {view:"richselect",id:"lnNome",label:'N&iacute;vel',name:"lnNome",value:1,options:{body:{template:"#lnNome#",yCount:10,url: BASE_URL+"CLinguas_Nivel/read"}}},
                ]
            }
        ]},
        {
        cols:[
            { view:"button", value: "Salvar", click:function(){
                var id = $$("idformADDLinguas_Funcionarios").getValues().BI_Passaporte;
                var linNome = $$("idformADDLinguas_Funcionarios").getValues().linNome;
                var lnNome = $$("idformADDLinguas_Funcionarios").getValues().lnNome;
                
            if(id && linNome && lnNome){ //validate form
                
                var envio = "Funcionarios_id="+id+
                        "&linguas_id="+linNome+
                        "&linguas_nivel_id="+lnNome;
                var r = webix.ajax().sync().post(BASE_URL+"cLinguas_Funcionarios/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdLinguas_Funcionarios").load(BASE_URL+"cLinguas_Funcionarios/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDLinguas_Funcionarios").close();
            }}
        ]
    }
    ],
    elementsConfig:{
        labelPosition:"top",
    }
};