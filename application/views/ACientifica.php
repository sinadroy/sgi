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
        <title>SGI-AC</title>
   <!-- <link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css"> 
    <script src="http://cdn.webix.com/edge/webix.js" type="text/javascript"></script> -->
    <link rel="stylesheet" href=<?php echo $web_dir."webix/codebase/webix.css";?> type="text/css" media="screen" charset="utf-8">
    <script src=<?php echo $web_dir."webix/codebase/webix.js";?> type="text/javascript"></script>
    <!-- libreria para WEBCAM -->
    <script src=<?php echo $web_dir."webcamjs-master/webcam.js";?> type="text/javascript"></script>
    <script src=<?php echo $web_dir."webcamjs-master/webcam.min.js";?> type="text/javascript"></script>
    <!-- PDF OBJECT -->
    <script src=<?php echo $web_dir."PDFObject-master/pdfobject.js";?> type="text/javascript"></script>
    </head>
    <style type="text/css">
	/*
        .transparent{
            background-color: transparent;
	}
	.main_title{
            font-size: 19px;
            line-height: 48px;
	}
	a.check_flight{
            color:  #367ddc;
	}
	.webix_row_select a.check_flight{
            color:  #fff;
	}
	.blue_row{
            background-color: #cbdeeb !important;
	}
	.blue_row .webixtype_form{
            font-size: 18px;
	}
        .texto_todo{
            font-size: 6px;
        }*/
                .mark{
			width:50px;
			text-align: center;
			font-weight:bold;
			float:right;
			background-color:#f4a528;
                        //background-color:#f1c40f;
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
            /*para PDF*/
            .pdfobject-container{alignment-adjust:central; width:600px;  height: 600px;}
            .pdfobject { border: 1px solid #666; }
        </style>
    <body>
        <!-- VARIABLES DEL SERVIDOR-->
        <script type="text/javascript" charset="utf-8">
            var BASE_URL = '<?php echo base_url(); ?>' + 'index.php/';
            var PRO_URL = '<?php echo base_url(); ?>';
            var user_sessao = '<?php echo $this->session->userdata('username') ?>';
            //var CODIGO_FOTO;
        </script>
        <!-- SUB-MODULOS -->
        <script src=<?php echo $web_dir."MODULOS/ACientifica/Funcionarios.js";?> type="text/javascript"></script>
       <!-- <script src=<?php //echo $web_dir."MODULOS/RHumanos/Ferias.js";?> type="text/javascript"></script>
        <script src=<?php //echo $web_dir."MODULOS/RHumanos/Autorizacao_Saida.js";?> type="text/javascript"></script> -->
        <script src=<?php echo $web_dir."MODULOS/ACientifica/Licencas.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/ACientifica/Reconhecimentos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/ACientifica/Sancoes.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/ACientifica/Em_Formacao_Funcionarios.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/ACientifica/Formacao_Funcionarios.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/ACientifica/Publicacoes.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/ACientifica/Eventos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/ACientifica/Outras_Formacoes.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/ACientifica/Linguas.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/ACientifica/Licenca_Motivos.js";?> type="text/javascript"></script>
        
       <!-- <div id="testA" style="width:400px; height:300px; margin:10px;"></div> -->
       <div id="headerAmin" style="margin:10px"></div>
       <div id="menuAdmin" style="margin:5px; width:210px"></div>
       <div id="principalAdmin" style="margin:5px; "></div>
       
        <div id="my_img_default" style='display:none;'>
			<!-- <input  type="text"> -->
            <img src="../../Fotos/Funcionarios/default.jpg"/>
	</div>
       
       <script type="text/javascript" charset="utf-8">
        
        webix.ui({
            css:"texto_todo",
            container:"principalAdmin", type:"space",
            position:"center",
            rows:[	
                {view:"toolbar", cols:[
                    { view:"label", type:"image", label:"Sistema de Gest&atilde;o Integral",width:300/*image:PRO_URL+"resources/images/logoGeSoftv1-2.png"*/},
                    {},
                    { view:"label", label:"AREA CIENTIFICA",width:300},
                    {},
                    //{ view:"toggle", type:"image", label:"Inicio",css:"myBtnCSS2",width:90,/*height:75,*/image:PRO_URL+"webix/samples/common/imgs/32/redo.gif"/*image:path+"paste.gif"*/},
                    { view:"button", type:"imageButton", label:"Inicio",image:PRO_URL+"resources/icons/Home.png",height:45, width:90,click:function(){
                            var redirect = BASE_URL+'welcome/principal';
                            window.location = redirect;
                    }},
                    { view:"button", type:"imageButton", label:"Sair",image:PRO_URL+"resources/icons/Index.png",height:45, width:90,click:function(){
                            var redirect = BASE_URL+'welcome/logout';
                            window.location = redirect;
                    }}
                    //{view:"button", value:"Add New Film", width:150, type:"form", align:"left", click:"add_new"},{},
                    //{view:"button", value:"Sair", width:60, type:"danger", align:"right", click:"del_tab"}
		]},
		{ cols:[
            { view:"list", id:"menuACientifica",
                        //template:"#smNome#",
			width: 200,
			autoheight:true,
			//data: submodulosUsuarios,
                        template:"<div class='mark'>#badge# </div> #smNome#",
			type:{
                            height:40
			},
                        url: BASE_URL+"CSubModulos/read?modulo=06&usuario="+user_sessao,
			select:true,
			on:{
                            onItemClick:open_new_tab
			}
                    },
                    { type:"clean", 
                    rows:[
                        { id:"tabs", view:"tabbar",close:true,  multiview:true, options:[], height:40},
                        { id:"views", cells:[
                            {view:"template", id:"tpl", height:900,template:"Vem-Bindo ao Sub-Sistema para Área Científica."}
                        ]}
                    ]}
                ]}
            ]
	});
        
        function open_new_tab(id){
            var item = $$('menuACientifica').getItem(id);
            //add tab
            if(!$$(item.id)){
                if(item.smCodigo==='0601'){
                    //console.log('entro en 1');
                    
                    cargarFuncionarios(item.smCodigo);
                }
                if(item.smCodigo==='0602'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaFerias(item.smCodigo);
                }
                if(item.smCodigo==='0603'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaAutorizacao_Saida(item.smCodigo);
                }
                /*
                if(item.smCodigo==='0604'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaLicencas(item.smCodigo);
                }
                */
                if(item.smCodigo==='0605'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaReconhecimentos(item.smCodigo);
                }
                /*
                if(item.smCodigo==='0606'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaSancoes(item.smCodigo);
                }
                */
                if(item.smCodigo==='0607'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaEm_Formacao_Funcionarios(item.smCodigo);
                }
                if(item.smCodigo==='0608'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaFormacao_Funcionarios(item.smCodigo);
                }
                if(item.smCodigo==='0609'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaPublicacoes(item.smCodigo);
                }
                //cargarVistaEventos
                if(item.smCodigo==='0610'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaEventos(item.smCodigo);
                }
                if(item.smCodigo==='0611'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaOutras_Formacoes(item.smCodigo);
                }
                if(item.smCodigo==='0612'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaLinguas_Funcionarios(item.smCodigo);
                }
                /*
                if(item.smCodigo==='0613'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaLicenca_Motivos(item.smCodigo);
                }
                */
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
            if($$("tabs").config.options.length===0)
                $$("tpl").show();

            $$("views").removeView(id);
            $$("menuACientifica").unselect(id);
        }
        //para cuando se cierra el ultimo tab iniciar el por default
        $$("tabs").attachEvent("onBeforeTabClose", function(id, e){
            //code
            del_tab();
            //if($$("tabs").config.options.length===0)
            //    $$("tpl").show();
            //return false;
        });
        //EVENTOS MODULO RH SUBMODULO FUNCIONARIOS
        /*$$("idcomboPais").attachEvent("onItemClick", function(id, e){
            //code
            alert(id);
        });
    $$("idDTEdDadosPesoais").attachEvent("onAfterSelect", function(id){
        $$("idform_DP_superior_grid").addView({ template:"New one" }, 2);
}   );
     //"onAfterSelect": function(id){
                                //        $$("idform_DP_superior_grid").addView({ template:"New one" }, 2);
                                //},
     **/
    </script>
    
    </body>
</html>


