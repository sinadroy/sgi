<?php

if (!$this->session->userdata('idusuario')){
    // redirigimos a la función login
    redirect(base_url(), 'refresh');
}

// cuerpo de la interfase principal
//echo "Interfase principal";
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>SGI-Fin</title>
   <!-- <link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css"> 
    <script src="http://cdn.webix.com/edge/webix.js" type="text/javascript"></script> -->
    <link rel="stylesheet" href=<?php echo $web_dir."webix/codebase/skins/air.css";?> type="text/css">
    <script src=<?php echo $web_dir."webix/codebase/webix.js";?> type="text/javascript"></script>
    <!-- PDF OBJECT -->
    <script src=<?php echo $web_dir."PDFObject-master/pdfobject.js";?> type="text/javascript"></script>
    </head>
    <style type="text/css">
        
		.mark{
			width:50px;
			text-align: center;
			font-weight:bold;
			float:right;
			//background-color:#f4a528;
                        background-color:#f39c12;
			color:white;
			border-radius:15px;
			margin-top: 5px;
		}
		.newtime{
			background-color:#DDFFDD;
		}
		.oldtime{
			background-color:#DDDDFF;
		}
                .blue_row .webixtype_form{
                    font-size: 12px;
                }
                .webix_toolbar{
                    background-color:#F0DCB6;
                }
	</style>
    <body>
        <!-- VARIABLES DEL SERVIDOR-->
        <script type="text/javascript" charset="utf-8">
            var BASE_URL = '<?php echo base_url(); ?>' + 'index.php/';
            var PRO_URL = '<?php echo base_url(); ?>';
            var idCodigo_Barra_Selecionado;
            var user_sessao = '<?php echo $this->session->userdata('username') ?>';
        </script>
        <!-- SUB-MODULOS -->
        <script src=<?php echo $web_dir."MODULOS/Financas/FInscricao.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Financas/FInscricao_2_sessao.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Financas/FRelatorio_Candidatos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Financas/FRelatorio_Candidatos_Detalhado.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Financas/FConfirmacao_Matricula.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Financas/FPropinas.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Financas/FMatricula.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Financas/FDocumentos.js";?> type="text/javascript"></script>
        
       <!-- <div id="testA" style="width:400px; height:300px; margin:10px;"></div> -->
       <div id="headerAmin" style="margin:10px"></div>
       <div id="menuAdmin" style="margin:5px; width:210px"></div>
       <div id="principalAdmin" style="margin:5px; height:900px"></div>
       
       <script type="text/javascript" charset="utf-8">
        
        webix.ui({
            container:"principalAdmin", type:"space",
            position:"center",
            rows:[	
                {view:"toolbar", cols:[
                    { view:"label", type:"image", label:"Sistema de Gest&atilde;o Integral",width:300,/*image:PRO_URL+"resources/images/logoGeSoftv1-2.png"*/},
                    {},
                    { view:"label", label:"FINAN&Ccedil;AS",width:300},
                    {},
                    //{ view:"toggle", type:"image", label:"Inicio",css:"myBtnCSS2",width:90,/*height:75,*/image:PRO_URL+"webix/samples/common/imgs/32/redo.gif"/*image:path+"paste.gif"*/},
                    { view:"button", type:"imageButton", label:"Inicio",image:PRO_URL+"resources/icons/Home.png",height:45, width:90,click:function(){
                            var redirect = BASE_URL+'welcome/principal';
                            window.location = redirect;
                    }},
                    { view:"button", type:"imageButton", label:"Sair",image:PRO_URL+"resources/icons/Index.png",height:45, width:90,click:function(){
                            var redirect = BASE_URL+'welcome/logout';
                            window.location = redirect;
                    }},
                    //{view:"button", value:"Add New Film", width:150, type:"form", align:"left", click:"add_new"},{},
                    //{view:"button", value:"Sair", width:60, type:"danger", align:"right", click:"del_tab"}
		]},
		{ cols:[
                    { view:"list", id:"menuFinancas",
                        //template:"#smNome#",
                        width: 230,
                        autoheight:true,
                        //data: submodulosUsuarios,
                        template:"<div class='mark'>#badge# </div> #smNome#",
                        type:{
                            height:40
                        },
                        url: BASE_URL+"CSubModulos/read?modulo=05&usuario="+user_sessao,
                        select:true,
                        on:{
                                        onItemClick:open_new_tab
                        }
                    },
                    { type:"clean", 
                    rows:[
                        { id:"tabs", view:"tabbar",close:true,  multiview:true, options:[], height:40},
                        { id:"views", cells:[
                            {view:"template", id:"tpl", height:900,template:"Vem-Bindo ao Sub-Sistema de Finan&ccedil;as."}
                        ]}
                    ]}
                ]}
            ]
	});
        
        function open_new_tab(id){
            var item = $$('menuFinancas').getItem(id);
            //add tab
            if(!$$(item.id)){
                if(item.smCodigo==='0501'){
                    cargarVistaFInscricao(item.smCodigo);
                    //Actualizar valor total pago de inscricao
                    var envio = "codigo=123454321"; //esto es pa mandar algo, en realidad no hace falta ningun parametro
                    var r = webix.ajax().sync().post(BASE_URL + "CFinancas_Pagamentos_Candidatos/read_valor_total_inscricao", envio);
                    $$('idLabel_valor_total_inscricao').setValue(r.responseText);
                    //Actualizar total de candidatos
                    var envio = "codigo=123454321"; //esto es pa mandar algo, en realidad no hace falta ningun parametro
                    var rtc = webix.ajax().sync().post(BASE_URL + "CCandidatos/read_total", envio);
                    $$('idLabel_total_de_candidatos').setValue(rtc.responseText);
                }
                if(item.smCodigo==='0502'){
                    cargarVistaFInscricao_2_sessao(item.smCodigo);
                }
                if(item.smCodigo==='0503'){
                    cargarVistaFMatricula(item.smCodigo);
                }

                if(item.smCodigo==='0504'){
                    cargarVistaFConfirmacao_Matricula(item.smCodigo);
                }
                if(item.smCodigo==='0505'){
                    cargarVistaFPropinas(item.smCodigo);
                }
                
                if(item.smCodigo==='0506'){
                    cargarVistaFRelatorio_Candidatos(item.smCodigo);
                }
                if(item.smCodigo==='0507'){
                    cargarVistaFRelatorio_Candidatos_Detalhado(item.smCodigo);
                }
                if(item.smCodigo==='0508'){
                    cargarVistaFDocumentos(item.smCodigo);
                }

                $$("tabs").addOption(item.smCodigo, item.smNome, true);
            }
            //or show if already added
            else
                $$("tabs").setValue(item.id);
	}
        function del_tab(){
            var id = $$("tabs").getValue();
            if(!id) return;
            $$("tabs").removeOption(id);

            //show default view if no tabs
            if($$("tabs").config.options.length==0)
                $$("tpl").show();

            $$("views").removeView(id);
            $$("menuFinancas").unselect(id);
        }
        //para cuando se cierra el ultimo tab iniciar el por default
        $$("tabs").attachEvent("onBeforeTabClose", function(id, e){
            //code
            del_tab();
            //if($$("tabs").config.options.length===0)
            //    $$("tpl").show();
            //return false;
        });
        
    
    </script>
    </body>
</html>


