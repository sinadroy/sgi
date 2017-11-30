function cargarVistaSancoes(itemID){
            $$("views").addView({
               view:"tabview",
               id:itemID, 
                height:900,
		cells:[
                    { 
                        //<div class='mark'>#badge# </div> #smNome#
                        //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                        header:"Editar San&ccedil;&otilde;oes", body:{    
                         //id:"Niveis de Acessos",
                        rows:[{
                            view:"form", scroll:false,
                            cols:[
                                {   view:"button", type:"form", value:"Adicionar", width:100, click:function(){
                                        webix.ui({
                                            view:"window",
                                            id:"idwinADDSancoes",
                                            width:500,
                                            //heigth:700,
                                            position:"center",
                                            modal:true,
                                            head:"Adicionar San&ccedil;&otilde;es",
                                            body:webix.copy(formADDSancoes)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdSancoes").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var envio = "id="+idSelecionado;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cSancoes/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdSancoes").clearAll();
                                                            $$("idDTEdSancoes").load(BASE_URL+"cSancoes/read");
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
                            id:"idDTEdSancoes",
                            css:"my_style",
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
                                {id:"sanData",editor:"date", header:"Data",width:140,validate:webix.rules.isNotEmpty(),sort:"strig"},
                                {id:"sanMotivo", editor:"text",header:"Motivo",width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"sanObs",editor:"text", header:"Observa&ccedil;&atilde;o",width:140,validate:webix.rules.isNotEmpty(),sort:"strig"}
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //validar todo
                                    if(id && data.sanData && data.sanObs && data.sanMotivo)
                                    {
                                        var envio = "id="+id+
                                                "&sanData="+data.sanData+
                                                "&sanMotivo="+data.sanMotivo+
                                                "&sanObs="+data.sanObs;
                                        var r = webix.ajax().sync().post(BASE_URL+"cSancoes/update", envio);
                                        if(r.responseText == "true"){
                                            $$("idDTEdSancoes").clearAll();
                                            $$("idDTEdSancoes").load(BASE_URL+"cSancoes/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdSancoes").clearAll();
                                            $$("idDTEdSancoes").load(BASE_URL+"cSancoes/read");
                                        }
                                    
                                }
                                
                            },
                            url: BASE_URL+"cSancoes/read",
                            pager:"pagerSancoes"
                        },{
                            view:"pager", id:"pagerSancoes",
                            template:"{common.prev()} {common.pages()} {common.next()}",
                            size:25,
                            group:10
                        }]   
                    }}
                ] 
            });
}
//Adicionar Sancoes
var formADDSancoes = {
    view:"form",
    id:"idformADDSancoes",
    heigth:700,
    borderless:true,
    elements: [
        {rows:[
            {view:"combo",label:'Localizar por BI/Passaporte',name:"sanBI_Passaporte",/*value:1,*/options:{body:{template:"#fBI_Passaporte#",yCount:7,url: BASE_URL+"CFuncionarios/readBI"}},
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
            {view:"datepicker", label:"Data", name:"sanData", stringResult:true,validate:"isNotEmpty", validateEvent:"blur"},
            {view:"text", label:"Motivo", name:"sanMotivo", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
            {view:"textarea", label:'Observa&ccedil;&atilde;o',heigth:400, name:"sanObs"}
        ]    
        },{
        cols:[
            { view:"button", value: "Salvar", click:function(){
                var id = $$("idformADDSancoes").getValues().sanBI_Passaporte;
                var sanData = $$("idformADDSancoes").getValues().sanData;
                var sanMotivo = $$("idformADDSancoes").getValues().sanMotivo;
                var sanObs = $$("idformADDSancoes").getValues().sanObs;
            if(id && sanData && sanMotivo && sanObs){ //validate form
                
                var envio = "Funcionarios_id="+id+
                        "&sanData="+sanData+
                        "&sanMotivo="+sanMotivo+
                        "&sanObs="+sanObs;
                var r = webix.ajax().sync().post(BASE_URL+"cSancoes/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdSancoes").load(BASE_URL+"cSancoes/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDSancoes").close();
            }}
        ]
    }
    ],
    elementsConfig:{
        labelPosition:"top",
    }
};