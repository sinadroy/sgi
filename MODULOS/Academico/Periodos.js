function cargarVistaPeriodos(itemID){
            $$("views").addView({
               view:"tabview",
               id:itemID, 
                height:900,
		cells:[
                    {
                        header:"Editar Periodos", body:{    
                         //id:"Niveis de Acessos",
                        rows:[{
                            view:"form", scroll:false,
                            cols:[
                                {   view:"button", type:"form",disabled:true, value:"Adicionar", width:100, click:function(){
                                        webix.ui({
                                            view:"window",
                                            id:"idwinADDGeneros",
                                            width:500,
                                            position:"center",
                                            modal:true,
                                            head:"Adicionar Dados",
                                            body:webix.copy(formADDPeriodos)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger",disabled:true, value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdPeriodos").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var idrowDT = $$("idDTEdPeriodos").getSelectedId(false,true);
                                                        var envio = "id="+idrowDT;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cPeriodos/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdPeriodos").clearAll();
                                                            $$("idDTEdPeriodos").load(BASE_URL+"cPeriodos/read");
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
                            id:"idDTEdPeriodos",
                            select:true,
                            editable:false,
                            columns:[
                                { id:"id", header:"", css:"rank",width:30,sort:"int"},
                                { id:"pNome",editor:"text", header:["Nome", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                { id:"pCodigo",editor:"text", header:["C&oacute;digo", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"int"}
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //validar todo
                                    if(id && data.pNome && data.pCodigo)
                                    {
                                        var envio = "id="+id+
                                                "&pNome="+data.pNome+
                                                "&pCodigo="+data.pCodigo;
                                        var r = webix.ajax().sync().post(BASE_URL+"cPeriodos/update", envio);
                                        if(r.responseText == "true"){
                                            $$("idDTEdPeriodos").clearAll();
                                            $$("idDTEdPeriodos").load(BASE_URL+"cPeriodos/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdPeriodos").clearAll();
                                            $$("idDTEdPeriodos").load(BASE_URL+"cPeriodos/read");
                                        }
                                    
                                }
                                
                            },
                            url: BASE_URL+"cPeriodos/read",
                            pager:"pagerPeriodos"
                        },{
                            view:"pager", id:"pagerPeriodos",
                            template:"{common.prev()} {common.pages()} {common.next()}",
                            size:25,
                            group:10
                        }]   
                    }}
                ] 
            });
}
//Adicionar Periodos
var formADDPeriodos = {
    view:"form",
    id:"idformADDPeriodos",
    borderless:true,
    elements: [
        {rows:[
            { view:"text", label:'Nome', name:"pNome",validate:"isNotEmpty", validateEvent:"blur"},
            { view:"text", label:'C&oacute;digo', name:"pCodigo",validate:"isNotEmpty", validateEvent:"blur"}
        ]    
        },{
        cols:[
            { view:"button", value: "Aceitar", click:function(){
            var pnome = $$("idformADDPeriodos").getValues().pNome;
            var pcodigo = $$("idformADDPeriodos").getValues().pCodigo;
            if(pnome && pcodigo){ //validate form
                var envio = "pNome="+pnome+
                        "&pCodigo="+pcodigo;
                var r = webix.ajax().sync().post(BASE_URL+"cPeriodos/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdPeriodos").load(BASE_URL+"cPeriodos/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDPeriodos").close();
            }}
        ]
    }
    ],
    elementsConfig:{
        labelPosition:"top",
    }
};