function cargarVistaReconhecimentos(itemID){
            $$("views").addView({
               view:"tabview",
               id:itemID, 
                height:900,
		cells:[
                    { 
                        //<div class='mark'>#badge# </div> #smNome#
                        //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                        header:"Editar M&eacute;rito / Reconhecimentos", body:{    
                         //id:"Niveis de Acessos",
                        rows:[{
                            view:"form", scroll:false,
                            cols:[
                                {   view:"button", type:"form", value:"Adicionar", width:100, click:function(){
                                        webix.ui({
                                            view:"window",
                                            id:"idwinADDReconhecimentos",
                                            width:500,
                                            //heigth:700,
                                            position:"center",
                                            modal:true,
                                            head:"Adicionar Reconhecimento",
                                            body:webix.copy(formADDReconhecimentos)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdReconhecimentos").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var envio = "id="+idSelecionado;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cReconhecimentos/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdReconhecimentos").clearAll();
                                                            $$("idDTEdReconhecimentos").load(BASE_URL+"cReconhecimentos/read");
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
                            id:"idDTEdReconhecimentos",
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
                                {id:"recData",editor:"date", header:"Data",width:140,validate:webix.rules.isNotEmpty(),sort:"strig"},
                                {id:"recMotivo", editor:"text",header:"Motivo",width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"recObs",editor:"text", header:"Observa&ccedil;&atilde;o",width:140,validate:webix.rules.isNotEmpty(),sort:"strig"}
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //validar todo
                                    if(id && data.recData && data.recObs && data.recMotivo)
                                    {
                                        var envio = "id="+id+
                                                "&recData="+data.recData+
                                                "&recMotivo="+data.recMotivo+
                                                "&recObs="+data.recObs;
                                        var r = webix.ajax().sync().post(BASE_URL+"cReconhecimentos/update", envio);
                                        if(r.responseText == "true"){
                                            $$("idDTEdReconhecimentos").clearAll();
                                            $$("idDTEdReconhecimentos").load(BASE_URL+"cReconhecimentos/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdReconhecimentos").clearAll();
                                            $$("idDTEdReconhecimentos").load(BASE_URL+"cReconhecimentos/read");
                                        }
                                    
                                }
                                
                            },
                            url: BASE_URL+"cReconhecimentos/read",
                            pager:"pagerReconhecimentos"
                        },{
                            view:"pager", id:"pagerReconhecimentos",
                            template:"{common.prev()} {common.pages()} {common.next()}",
                            size:25,
                            group:10
                        }]   
                    }}
                ] 
            });
}
//Adicionar Reconhecimentos
var formADDReconhecimentos = {
    view:"form",
    id:"idformADDReconhecimentos",
    heigth:700,
    borderless:true,
    elements: [
        {rows:[
            {view:"combo",label:'Localizar por BI/Passaporte',name:"recBI_Passaporte",/*value:1,*/options:{body:{template:"#fBI_Passaporte#",yCount:7,url: BASE_URL+"CFuncionarios/readBI"}},
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
            {view:"datepicker", label:"Data", name:"recData", stringResult:true,validate:"isNotEmpty", validateEvent:"blur"},
            {view:"text", label:"Motivo", name:"recMotivo", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
            {view:"textarea", label:'Observa&ccedil;&atilde;o',heigth:400, name:"recObs"}
        ]    
        },{
        cols:[
            { view:"button", value: "Salvar", click:function(){
                var id = $$("idformADDReconhecimentos").getValues().recBI_Passaporte;
                var recData = $$("idformADDReconhecimentos").getValues().recData;
                var recMotivo = $$("idformADDReconhecimentos").getValues().recMotivo;
                var recObs = $$("idformADDReconhecimentos").getValues().recObs;
            if(id && recData && recMotivo && recObs){ //validate form
                
                var envio = "Funcionarios_id="+id+
                        "&recData="+recData+
                        "&recMotivo="+recMotivo+
                        "&recObs="+recObs;
                var r = webix.ajax().sync().post(BASE_URL+"cReconhecimentos/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdReconhecimentos").load(BASE_URL+"cReconhecimentos/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDReconhecimentos").close();
            }}
        ]
    }
    ],
    elementsConfig:{
        labelPosition:"top",
    }
};