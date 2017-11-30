function cargarVistaNiveisCursos(itemID){
            $$("views").addView({
               view:"tabview",
               id:itemID, 
                height:900,
		cells:[
                    { 
                        //<div class='mark'>#badge# </div> #smNome#
                        //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                        header:"Editar N&iacute;veis", body:{    
                         //id:"Niveis de Acessos",
                        rows:[{
                            view:"form", scroll:false,
                            cols:[
                                {   view:"button", type:"form",disabled:true,value:"Adicionar", width:100, click:function(){
                                        webix.ui({
                                            view:"window",
                                            id:"idwinADDNiv",
                                            width:500,
                                            position:"center",
                                            modal:true,
                                            head:"Dados do N&iacute;vel",
                                            body:webix.copy(formADDNiveis)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", disabled:true,value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdNiveis").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var idrowDT = $$("idDTEdNiveis").getSelectedId(false,true);
                                                        var envio = "id="+idrowDT;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cNiveis/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdNiveis").clearAll();
                                                            $$("idDTEdNiveis").load(BASE_URL+"cNiveis/read");
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
                            id:"idDTEdNiveis",
                            //autowidth:true,
                            //autoConfig:true,
                            select:true,
                            editable:false,
                            //editable:true,
                            //editaction:"dblclick",
                            columns:[
                                { id:"id", header:"", css:"rank",width:30,sort:"int"},
                                { id:"nNome",editor:"text", header:["Nome", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                { id:"nCodigo",editor:"text", header:["C&oacute;digo", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                { id:"nDescricao",editor:"text",header:"Descri&ccedil;&atilde;o",width:200,sort:"string"}
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //alert("Current value: " + data.uNome);
                                    //alert("Current value: " + id);
                                    //validar todo
                                    if(id && data.nNome && data.nCodigo && data.nDescricao)
                                    {
                                        var envio = "id="+id+
                                                "&nNome="+data.nNome+
                                                "&nCodigo="+data.nCodigo+
                                                "&nDescricao="+data.nDescricao;
                                        var r = webix.ajax().sync().post(BASE_URL+"cNiveis/update", envio);
                                        if(r.responseText == "true"){
                                            $$("idDTEdNiveis").clearAll();
                                            $$("idDTEdNiveis").load(BASE_URL+"cNiveis/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdNiveis").clearAll();
                                            $$("idDTEdNiveis").load(BASE_URL+"cNiveis/read");
                                        }
                                    
                                }
                                
                            },
                            url: BASE_URL+"cNiveis/read",
                            pager:"pagerNiveis"
                        },{
                            view:"pager", id:"pagerNiveis",
                            template:"{common.prev()} {common.pages()} {common.next()}",
                            size:25,
                            group:10
                        }]   
                    }},
                    { 
                        //<div class='mark'>#badge# </div> #smNome#
                        //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                        header:"Editar Cursos", body:{    
                         //id:"Niveis de Acessos",
                        rows:[{
                            view:"form", scroll:false,
                            cols:[
                                {   view:"button", type:"form", disabled:true,value:"Adicionar", width:100, click:function(){
                                        webix.ui({
                                            view:"window",
                                            id:"idwinADDCursos",
                                            width:500,
                                            position:"center",
                                            modal:true,
                                            head:"Dados do Curso",
                                            body:webix.copy(formADDCursos)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", disabled:true, value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdCursos").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        var idrowDT = $$("idDTEdCursos").getSelectedId(false,true);
                                                        var envio = "id="+idrowDT;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cCursos/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdCursos").clearAll();
                                                            $$("idDTEdCursos").load(BASE_URL+"cCursos/read");
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
                            id:"idDTEdCursos",
                            //autowidth:true,
                            //autoConfig:true,
                            select:true,
                            editable:false,
                            //editable:true,
                            //editaction:"dblclick",
                            columns:[
                                { id:"id", header:"", css:"rank",width:30,sort:"int"},
                                { id:"cNome",editor:"text", header:["Nome", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                { id:"cCodigo",editor:"text", header:["C&oacute;digo", {content:"textFilter"}],width:90, validate:webix.rules.isNotEmpty(),sort:"string"},
                                //{ id:"cDescricao",editor:"text",header:"Descri&ccedil;&atilde;o",width:200,sort:"string"},
                                //{ id:"nNome",editor:"richselect",header:"N&iacute;vel", width:150,template:"#nNome#",options:BASE_URL+"CNiveis/read"},
                                //{ id:"ncDuracao",editor:"text",header:"Anos de Dura&ccedil;&atilde;o",width:150,sort:"int"},
                                //{ id:"ncPreco_Inscricao",editor:"text",header:"Pre&ccedil;o de Inscri&ccedil;&atilde;o",width:150,sort:"int"},
                                //{ id:"ncPreco_Matricula",editor:"text",header:"Pre&ccedil;o de Matr&iacute;cula",width:150,sort:"int"},
                                //{ id:"ncPreco_Propina",editor:"text",header:"Pre&ccedil;o de Propina",width:150,sort:"int"},
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //alert("Current value: " + data.uNome);
                                    //alert("Current value: " + id);
                                    //validar todo
                                    if(id && data.cNome && data.cCodigo)
                                    {
                                        //var r2 = webix.ajax().sync().post(BASE_URL+"cCursos/insert", "cCodigo="+data.cCodigo);
                                        //$idCurso = r2.responseText;
                                        var envio = "id="+id+
                                                "&cNome="+data.cNome+
                                                "&cCodigo="+data.cCodigo;
                                        var r = webix.ajax().sync().post(BASE_URL+"cCursos/update", envio);
                                        if(r.responseText == "true"){
                                            $$("idDTEdCursos").clearAll();
                                            $$("idDTEdCursos").load(BASE_URL+"cCursos/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdCursos").clearAll();
                                            $$("idDTEdCursos").load(BASE_URL+"cCursos/read");
                                        }
                                    
                                }
                                
                            },
                            
                            url: BASE_URL+"cCursos/read",
                            pager:"pagerCursos"
                        },{
                            view:"pager", id:"pagerCursos",
                            template:"{common.prev()} {common.pages()} {common.next()}",
                            size:16,
                            group:10
                        }]   
                    }},
                    { 
                        //<div class='mark'>#badge# </div> #smNome#
                        //header:"<div class='mark'>5 </div> Niveis de Acessos", icon:"users", body:{ 
                        header:"Cursos por Niveis", body:{    
                         //id:"Niveis de Acessos",
                        rows:[{
                            view:"form", scroll:false,
                            cols:[
                                {   view:"button", type:"form", disabled:true, value:"Adicionar", width:100, click:function(){
                                        webix.ui({
                                            view:"window",
                                            id:"idwinADDNiveisCursos",
                                            width:500,
                                            position:"center",
                                            modal:true,
                                            head:"Dados do Curso",
                                            body:webix.copy(formADDNiveisCursos)
                                        }).show();
                                    }
                                },
                                {   view:"button", type:"danger", disabled:true, value:"Apagar", width:100, click:function(){
                                        var idSelecionado = $$("idDTEdNiveisCursos").getSelectedId(false,true);
                                        if(idSelecionado){
                                            webix.confirm({
                                                title:"Confirmação",
                                                type:"confirm-warning",
                                                ok:"Sim", cancel:"Nao",
                                                text:"Est&aacute; seguro que deseja apagar a linha selecionada",
                                                callback:function(result){
                                                    if(result){
                                                        //var idrowDT = $$("idDTEdNiveisCursos").getSelectedId(false,true);
                                                        var envio = "id="+idSelecionado;
                                                        var r = webix.ajax().sync().post(BASE_URL+"cNiveisCursos/delete", envio);
                                                        if(r.responseText == "true"){
                                                            $$("idDTEdNiveisCursos").clearAll();
                                                            $$("idDTEdNiveisCursos").load(BASE_URL+"cNiveisCursos/read");
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
                            id:"idDTEdNiveisCursos",
                            select:true,
                            editable:false,
                            columns:[
                                { id:"id", header:"", css:"rank",width:30,sort:"int"},
                                //{ id:"cNome",editor:"text", header:["Nome", {content:"textFilter"}],width:170, validate:webix.rules.isNotEmpty(),sort:"string"},
                                { id:"cNome",editor:"richselect",header:"Cursos", width:150,template:"#cNome#",options:BASE_URL+"CCursos/read"},
                                //{ id:"cCodigo",editor:"text", header:["C&oacute;digo", {content:"textFilter"}],width:90, validate:webix.rules.isNotEmpty(),sort:"string"},
                                //{ id:"cDescricao",editor:"text",header:"Descri&ccedil;&atilde;o",width:200,sort:"string"},
                                { id:"nNome",editor:"richselect",header:"N&iacute;vel", width:150,template:"#nNome#",options:BASE_URL+"CNiveis/read"},
                                { id:"pNome",editor:"richselect",header:"Per&iacute;odo", width:150,template:"#pNome#",options:BASE_URL+"CPeriodos/read"},
                                { id:"ncDuracao",editor:"text",header:"Meses de Dura&ccedil;&atilde;o",width:150,sort:"int"},
                                { id:"ncPreco_Inscricao",editor:"text",header:"Pre&ccedil;o de Inscri&ccedil;&atilde;o",width:150,sort:"int"},
                                { id:"ncPreco_Matricula",editor:"text",header:"Pre&ccedil;o de Matr&iacute;cula",width:150,sort:"int"},
                                { id:"ncPreco_Propina",editor:"text",header:"Pre&ccedil;o de Propina",width:150,sort:"int"},
                            ],
                            on:{
                                "onDataUpdate": function(id, data){
                                    //validar todo
                                    if(id && data.cNome && data.nNome && !isNaN(data.ncDuracao) && !isNaN(data.ncPreco_Inscricao) && !isNaN(data.ncPreco_Matricula) && !isNaN(data.ncPreco_Propina))
                                    {
                                        //optener el idcurso y idniveis_cursos
                                        var idNiveis;
                                        if(isNaN(data.nNome)){
                                            var r1 = webix.ajax().sync().post(BASE_URL+"cNiveis/GetID", "nNome="+data.nNome);
                                            idNiveis = r1.responseText;
                                        }else
                                            idNiveis = data.nNome;
                                        var idCursos;
                                        if(isNaN(data.cNome)){
                                            var r1 = webix.ajax().sync().post(BASE_URL+"cCursos/GetID", "cNome="+data.cNome);
                                            idCursos = r1.responseText;
                                        }else
                                            idCursos = data.cNome;
                                        var idp;
                                        if(isNaN(data.pNome)){
                                            var rp = webix.ajax().sync().post(BASE_URL+"cPeriodos/GetID", "pNome="+data.pNome);
                                            idp = rp.responseText;
                                        }else
                                            idp = data.pNome;
                                        //
                                        var envio = "id="+id+
                                                "&cursos_id="+idCursos+
                                                "&niveis_id="+idNiveis+//(isNaN(data.nNome))?idCurso:data.nNome+
                                                "&ncDuracao="+data.ncDuracao+
                                                "&ncPreco_Inscricao="+data.ncPreco_Inscricao+
                                                "&ncPreco_Matricula="+data.ncPreco_Matricula+
                                                "&ncPreco_Propina="+data.ncPreco_Propina+
                                                "&pNome="+idp;
                                        var r = webix.ajax().sync().post(BASE_URL+"cNiveisCursos/update", envio);
                                        if(r.responseText == "true"){
                                            $$("idDTEdNiveisCursos").clearAll();
                                            $$("idDTEdNiveisCursos").load(BASE_URL+"cNiveisCursos/read");
                                            webix.message("Dados atualizados com sucesso");
                                        }else{    
                                            webix.message({ type:"error", text:"Erro atualizando dados" });
                                        }
                                    }else{    
                                            webix.message({ type:"error", text:"Erro validando dados" });
                                            $$("idDTEdNiveisCursos").clearAll();
                                            $$("idDTEdNiveisCursos").load(BASE_URL+"cNiveisCursos/read");
                                        }
                                    
                                }
                                
                            },
                            
                            url: BASE_URL+"cNiveisCursos/read",
                            pager:"pagerCursos"
                        },{
                            view:"pager", id:"pagerCursos",
                            template:"{common.prev()} {common.pages()} {common.next()}",
                            size:16,
                            group:10
                        }]   
                    }}
                ] 
            });
}
//Adicionar Niveis
var formADDNiveis = {
    view:"form",
    id:"idformADDNiveis",
    borderless:true,
    elements: [
        {rows:[
            { view:"text", label:'Nome', name:"nNome",validate:"isNotEmpty", validateEvent:"blur"},
            { view:"text", label:'C&oacute;digo', name:"nCodigo",validate:"isNotEmpty", validateEvent:"blur"},
            { view:"text", label:'Descri&ccedil;&atilde;o', name:"nDescricao" }
        ]    
        },{
        cols:[
            { view:"button", value: "Aceitar", click:function(){
            var nnome = $$("idformADDNiveis").getValues().nNome;
            var ncodigo = $$("idformADDNiveis").getValues().nCodigo;
            var ndescricao = $$("idformADDNiveis").getValues().ndescricao;
            if(nnome && ncodigo){ //validate form
                //webix.message({ type:"error", text:"Entro ok" });
            //if($$("idformADDNiveis").validate()){    
                var envio = "nNome="+nnome+
                        "&nCodigo="+ncodigo+
                        "&nDescricao="+ndescricao;
                var r = webix.ajax().sync().post(BASE_URL+"cNiveis/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdNiveis").load(BASE_URL+"cNiveis/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDNiv").close();
            }}
        ]
    }
    ],
    rules:{
        "nNome":webix.rules.isNotEmpty(),
        "nCodigo":webix.rules.isNotEmpty(),
        //"nDescricao":webix.rules.isNotEmpty()
    },
    elementsConfig:{
        labelPosition:"top",
    }
};
//ADICIONAR CURSOS
var formADDCursos = {
    view:"form",
    id:"idformADDCursos",
    borderless:true,
    elements: [
        {rows:[
            { view:"text", label:'Nome', name:"cNome",validate:"isNotEmpty", validateEvent:"blur"},
            { view:"text", label:'C&oacute;digo', name:"cCodigo",validate:"isNotEmpty", validateEvent:"blur"},
            {
        //},{
        cols:[
            { view:"button",value: "Aceitar", click:function(){
                if($$("idformADDCursos").getValues().cNome && $$("idformADDCursos").getValues().cCodigo){ //validate form
                var envio = "cNome="+$$("idformADDCursos").getValues().cNome+
                        "&cCodigo="+$$("idformADDCursos").getValues().cCodigo;
                var r = webix.ajax().sync().post(BASE_URL+"cCursos/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdCursos").load(BASE_URL+"cCursos/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDCursos").close();
            }}
        ]}
        ],
    }
    ],
    rules:{
        "cNome":webix.rules.isNotEmpty(),
        "cCodigo":webix.rules.isNotEmpty()
    },
    elementsConfig:{
        labelPosition:"top",
    }
};
//Adicionar NiveisCursos
var formADDNiveisCursos = {
    view:"form",
    id:"idformADDNiveisCursos",
    borderless:true,
    elements: [
        {rows:[
            { 
                    view:"combo", width:300,
                    label: 'Curso',  name:"cNome",
                    value:1, options:{
                    body:{
                        template:"#cNome#",
                        yCount:7,
                        url: BASE_URL+"CCursos/read"
                    }
                }
            },
            { 
                    view:"combo", width:300,
                    label: 'N&iacute;vel',  name:"nNome",
                    value:1, options:{
                    body:{
                        template:"#nNome#",
                        yCount:7,
                        url: BASE_URL+"CNiveis/read"
                    }
                }
            },
            { 
                    view:"combo", width:300,
                    label: 'Per&iacute;odo',  name:"pNome",
                    value:1, options:{
                    body:{
                        template:"#pNome#",
                        yCount:7,
                        url: BASE_URL+"CPeriodos/read"
                    }
                }
            },
            {view:"counter", label:"Duração", name:"ncDuracao",validate: "isNumber", validateEvent: "key"},
            {view:"text", label:'Pre&ccedil;o de Inscri&ccedil;&atilde;o', name:"ncPreco_Inscricao",validate:"isNumber", validateEvent:"key"},
            {view:"text", label:'Pre&ccedil;o de Matr&iacute;cula', name:"ncPreco_Matricula",validate:"isNumber", validateEvent:"key"},
            {view:"text", label:'Pre&ccedil;o de Propina', name:"ncPreco_Propina",validate:"isNumber", validateEvent:"key"},
            {
        //},{
        cols:[
            { view:"button",value: "Aceitar", click:function(){
                var cnome = $$("idformADDNiveisCursos").getValues().cNome;
                var nnome = $$("idformADDNiveisCursos").getValues().nNome;
                var ncduracao = $$("idformADDNiveisCursos").getValues().ncDuracao;
                var ncpreco_inscricao = $$("idformADDNiveisCursos").getValues().ncPreco_Inscricao;
                var ncpreco_matricula = $$("idformADDNiveisCursos").getValues().ncPreco_Matricula;
                var ncpreco_propina = $$("idformADDNiveisCursos").getValues().ncPreco_Propina;
                var pNome = $$("idformADDNiveisCursos").getValues().pNome;
                
                if(cnome && nnome && !isNaN(ncduracao) && !isNaN(ncpreco_inscricao) && !isNaN(ncpreco_matricula) && 
                    !isNaN(ncpreco_propina) && ncduracao && ncpreco_inscricao && ncpreco_matricula && ncpreco_propina){ //validate form
                var envio = "cursos_id="+cnome+
                        "&niveis_id="+nnome+
                        "&ncDuracao="+ncduracao+
                        "&ncPreco_Inscricao="+ncpreco_inscricao+
                        "&ncPreco_Matricula="+ncpreco_matricula+
                        "&ncPreco_Propina="+ncpreco_propina+
                        "&pNome="+pNome;
                var r = webix.ajax().sync().post(BASE_URL+"cNiveisCursos/insert", envio);
                if(r.responseText == "true"){
                    webix.message("Dados inseridos com sucesso");
                    this.getTopParentView().hide(); //hide window
                    $$("idDTEdNiveisCursos").load(BASE_URL+"cNiveisCursos/read");
                }else{    
                    webix.message({ type:"error", text:"Erro inserindo dados" });
                }
            }
            else
                webix.message({ type:"error", text:"Erro validando dados" });
            }},
            { view:"button", value:"Cancelar", name:"cancel", type:"danger",click:function(){
                $$("idwinADDNiveisCursos").close();
            }}
        ]}
        ],
    }
    ],
    elementsConfig:{
        labelPosition:"top",
    }
};