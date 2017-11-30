function cargarVistaEventos(itemID){
            $$("views").addView({
               view:"tabview",
               id:itemID, 
                height:900,
		cells:[
                    { 
                        //<div class='mark'>#badge# </div> #smNome#
                        //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                        header:"Editar Eventos", body:{    
                         //id:"Niveis de Acessos",
                        rows:[{
                            view:"form", scroll:false,
                            cols:[
                                {   view:"button", type:"form", value:"Adicionar", width:100, click:function(){
                                        webix.ui({
                                            view:"window",
                                            id:"idwinADDEventos",
                                            width:500,
                                            //heigth:700,
                                            position:"center",
                                            modal:true,
                                            head:"Adicionar ",
                                            body:webix.copy(formADDEventos)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdEventos").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var envio = "id="+idSelecionado;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cEventos/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdEventos").clearAll();
                                                            $$("idDTEdEventos").load(BASE_URL+"cEventos/read");
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
                            id:"idDTEdEventos",
                            select:true,
                            editable:true,
                            columns:[
                                {id:"id", header:"", css:"rank",width:30,sort:"int"},
                                {id:"Funcionarios_id", hidden:true,header:"ID", css:"rank",width:30,sort:"int"},
                                {id:"fNome", header:["Nome", {content:"textFilter"}],width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"fApelido", header:["Apelido", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                {id:"fBI_Passaporte", header:["BI-Pass.", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"strig"},
                                {id:"evTitulo",editor:"text", header:"T&iacute;tulo",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"evInstituicao",editor:"text", header:"Institui&ccedil;&atilde;o",width:170,validate:"isNotEmpty", validateEvent:"blur",sort:"string"},
                                {id:"evAno",editor:"text", header:"Ano",width:170,validate:"isNumber", validateEvent:"blur",sort:"int"},
                                {id:"teNome",editor:"richselect", header:"Tipo de Evento",width:150,template:"#teNome#",options:BASE_URL+"cTipo_Eventos/read"},
                                {id:"paNome",editor:"richselect", header:"Pais",width:150,template:"#paNome#",options:BASE_URL+"cPaises/read"}
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //validar todo
                                    if(id && data.Funcionarios_id && data.evTitulo && data.evInstituicao && data.evAno &&  
                                        data.teNome && data.paNome)
                                    {
                                        
                                        var idte;
                                        if(isNaN(data.teNome)){
                                            var rte = webix.ajax().sync().post(BASE_URL+"cTipo_Eventos/GetID", "teNome="+data.teNome);
                                            idte = rte.responseText; 
                                        }else{
                                            idte = data.teNome;
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
                                                "&evTitulo="+data.evTitulo+
                                                "&evAno="+data.evAno+
                                                "&evInstituicao="+data.evInstituicao+
                                                "&Tipo_Evento_id="+idte+
                                                "&paNome="+idpa;
                                    var r = webix.ajax().sync().post(BASE_URL+"cEventos/update", envio);
                                    if(r.responseText == "true"){
                                            $$("idDTEdEventos").clearAll();
                                            $$("idDTEdEventos").load(BASE_URL+"cEventos/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdEventos").clearAll();
                                            $$("idDTEdEventos").load(BASE_URL+"cEventos/read");
                                        }
                                    
                                }
                                
                            },
                            url: BASE_URL+"cEventos/read",
                            pager:"pagerEventos"
                        },{
                            view:"pager", id:"pagerEventos",
                            template:"{common.prev()} {common.pages()} {common.next()}",
                            size:25,
                            group:10
                        }
                    ]   
                    }}
                ] 
            });
}
//Adicionar Eventos
var formADDEventos = {
    view:"form",
    id:"idformADDEventos",
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
                    {view:"text", label:"Titulo", name:"evTitulo", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    {view:"text", label:"Ano", name:"evAno", stringResult:true ,validate:"isNumber", validateEvent:"blur"},
                    {view:"richselect",id:"teNome",label:'Tipo de Evento',name:"teNome",value:1,options:{body:{template:"#teNome#",yCount:10,url: BASE_URL+"CTipo_Eventos/read"}}},
                    
                ]
            },{
                rows:[
                    {},
                    {view:"text", id:"idComboFApelido",readonly:true, label:'Apelido', name:"fApelido"},
                    {view:"text", label:"Institui&ccedil;&atilde;o", name:"evInstituicao", stringResult:true ,validate:"isNotEmpty", validateEvent:"blur"},
                    {view:"richselect",id:"paNome",label:'Pa&iacute;s',name:"paNome",value:1,options:{body:{template:"#paNome#",yCount:10,url: BASE_URL+"CPaises/read"}}},
                    {}
                ]
            }
        ]},{
        cols:[
            { view:"button", value: "Salvar", click:function(){
                var id = $$("idformADDEventos").getValues().BI_Passaporte;
                var evTitulo = $$("idformADDEventos").getValues().evTitulo;
                var evAno = $$("idformADDEventos").getValues().evAno;
                var evInstituicao = $$("idformADDEventos").getValues().evInstituicao;
                var teNome = $$("idformADDEventos").getValues().teNome;
                var paNome = $$("idformADDEventos").getValues().paNome;
               
            if(id && evTitulo && evAno && evInstituicao && teNome && paNome){ //validate form
                
                var envio = "Funcionarios_id="+id+
                        "&evTitulo="+evTitulo+
                        "&evAno="+evAno+
                        "&evInstituicao="+evInstituicao+
                        "&teNome="+teNome+
                        "&paNome="+paNome;
                var r = webix.ajax().sync().post(BASE_URL+"cEventos/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdEventos").load(BASE_URL+"cEventos/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDEventos").close();
            }}
        ]
    }
    ],
    elementsConfig:{
        labelPosition:"top",
    }
};