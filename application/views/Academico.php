<?php
    header('Content-Type: text/html; charset=UTF-8');

if (!$this->session->userdata('idusuario')){
	// 	redirigimos a la función login
	    redirect(base_url(), 'refresh');
}

// cuerpo de la interfase principal
//echo "Interfase principal";
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>SGI-Aca</title>
        <meta name="SGI" content="text/html;" http-equiv="content-type" charset="utf-8">
   <!-- <link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css"> 
    <script src="http://cdn.webix.com/edge/webix.js" type="text/javascript"></script> -->
    <link rel="stylesheet" href=<?php echo $web_dir."webix/codebase/skins/clouds.css";?> type="text/css">
    <script src=<?php echo $web_dir."webix/codebase/webix.js";?> type="text/javascript"></script>
    <!-- <script webix.cdn = <?php echo $web_dir."webix/extras";?>; type="text/javascript"></script> -->
    <!-- libreria para WEBCAM -->
    <script src=<?php echo $web_dir."webcamjs-master/webcam.js";?> type="text/javascript"></script>
    <script src=<?php echo $web_dir."webcamjs-master/webcam.min.js";?> type="text/javascript"></script>
    <!-- PDF OBJECT -->
    <script src=<?php echo $web_dir."PDFObject-master/pdfobject.js";?> type="text/javascript"></script>
    </head>
    <style type="text/css">
        .vermelho_css{
            font-weight:bold;
			color:#FFAAAA;
		}
        .verde_css{
            font-weight:bold;
			color:#AFFFAF;
		}
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
            var BASE_URL = '<?php echo base_url();?>' + 'index.php/';
            var PRO_URL = '<?php echo base_url();?>';
            var user_sessao = '<?php echo $this->session->userdata('username') ?>';
        </script>
        <!-- SUB-MODULOS -->
        <script src=<?php echo $web_dir."MODULOS/Academico/Ano_Curricular.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Semestres.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Periodos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/NiveisCursos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Disciplinas.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Horarios.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Inscricao.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Turmas_Ingreso.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Presencas_Exame_Acesso.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Resultados_Exame_Acesso.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Listas_Resultados_Exame_Acesso.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Inscricao_2_sessao.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Turmas_Ingreso_2S.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Presencas_Exame_Acesso_2S.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Resultados_Exame_Acesso_2S.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Listas_Resultados_Exame_Acesso_2S.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Matricula.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Matricula_Distribuicao_Turmas.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Tranferencia_Matricula.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Listas_Gerais.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Estudantes_Disciplinas.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/Listas_Disciplinas.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Academico/cargar_pautas.js";?> type="text/javascript"></script>
       <!-- <div id="testA" style="width:400px; height:300px; margin:10px;"></div> -->
       <div id="headerAmin" style="margin:10px"></div>
       <div id="menuAdmin" style="margin:5px; width:210px"></div>
       <div id="principalAdmin" style="margin:5px; height:900px"></div>
       <script type="text/javascript" charset="utf-8">
       webix.ready(function(){
       webix.ui({
            container:"principalAdmin", type:"space", id:"app",
            position:"center",
            rows:[	
                {view:"toolbar", cols:[
                    { view:"label", type:"image", label:"Sistema de Gest&atilde;o Integral",width:300,/*image:PRO_URL+"resources/images/logoGeSoftv1-2.png"*/},
                    {},
                    { view:"label", label:"ACADÉMICA",width:300},
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
            { view:"list", id:"menuAcademico",
                //template:"#smNome#",Academico
                width: 260,
                autoheight:true,
                //data: submodulosUsuarios,
                template:"<div class='mark'>#badge# </div> #smNome#",
                type:{
                  height:40
                },
                url: BASE_URL+"CSubModulos/read?modulo=03&usuario="+user_sessao,
                select:true,
                on:{
                  onItemClick:open_new_tab
                }
            },
                    { type:"clean", 
                    rows:[
                        { id:"tabs", view:"tabbar",close:true,  multiview:true, options:[], height:40},
                        { id:"views", cells:[
                            {view:"template", id:"tpl", height:900,template:"Vem-Bindo ao Sub-Sistema da &Aacute;rea Acad&eacute;mica."}
                        ]}
                    ]}
                ]}
            ]
	});
        function open_new_tab(id){
            var item = $$('menuAcademico').getItem(id);
            //add tab
            if(!$$(item.id)){
                if(item.smCodigo==='0301'){
                    cargarVistaAno_Curricular(item.smCodigo);
                }
                if(item.smCodigo==='0302'){
                    cargarVistaSemestres(item.smCodigo);
                }
                if(item.smCodigo==='0303'){
                    cargarVistaPeriodos(item.smCodigo);
                }
                if(item.smCodigo==='0304'){
                    //console.log('entro en 1');
                    cargarVistaNiveisCursos(item.smCodigo);
                }
                if(item.smCodigo==='0305'){
                    //console.log('entro en 1');
                    cargarVistaDisciplinas(item.smCodigo);
                }
                if(item.smCodigo==='0306'){
                    cargarVistaHorarios(item.smCodigo);
                }
                if(item.smCodigo==='0307'){
                    cargarVistaInscricao(item.smCodigo);
                }
                if(item.smCodigo==='0308'){
                    cargarVistaTurmas_Ingreso(item.smCodigo);
                }
                if(item.smCodigo==='0309'){
                    cargarVistaPresencas_Exame_Acesso(item.smCodigo);
                }
                if(item.smCodigo==='0310'){
                    cargarVistaResultados_Exame_Acesso(item.smCodigo);
                }
                if(item.smCodigo==='0311'){
                    cargarVistaListas_Resultados_Exame_Acesso(item.smCodigo);
                }
                if(item.smCodigo==='0312'){
                    cargarVistaInscricao_2_sessao(item.smCodigo);
                }
                if(item.smCodigo==='0313'){
                    cargarVistaTurmas_Ingreso_2S(item.smCodigo);
                }
                if(item.smCodigo==='0314'){
                    cargarVistaPresencas_Exame_Acesso_2S(item.smCodigo);
                }
                if(item.smCodigo==='0315'){
                    cargarVistaResultados_Exame_Acesso_2S(item.smCodigo);
                }
                if(item.smCodigo==='0316'){
                    cargarVistaListas_Resultados_Exame_Acesso_2S(item.smCodigo);
                }
                if(item.smCodigo==='0317'){
                    
                    webix.extend($$("app"), webix.ProgressBar);
                    function show_progress_bar(delay) {
                        cargarVistaMatricula(item.smCodigo);
                        $$("app").disable();
                        $$("app").showProgress({
                            type: "top",
                            delay: delay,
                            hide: true
                        });
                        setTimeout(function () {
                            //conteudo
                            
                            //
                            $$("app").enable();
                        }, delay);
                    }
                    setTimeout(show_progress_bar(20000), 0);
                }
                if(item.smCodigo==='0318'){
                    cargarVistaMatricula_Distribuicao_Turmas(item.smCodigo);
                }
                if(item.smCodigo==='0319'){
                    cargarVistaTranferencia_Matricula(item.smCodigo);
                }
                if(item.smCodigo==='0320'){
                    cargarVistaListas_Gerais(item.smCodigo);
                }
                if(item.smCodigo==='0321'){
                    cargarVistaEstudantes_Disciplinas(item.smCodigo);
                }
                if(item.smCodigo==='0322'){
                    cargarVistaListas_Disciplinas(item.smCodigo);
                }
                if(item.smCodigo==='0323'){
                    cargarVistaCargar_pautas(item.smCodigo);
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
            $$("menuAcademico").unselect(id);
        }
        //para cuando se cierra el ultimo tab iniciar el por default
        $$("tabs").attachEvent("onBeforeTabClose", function(id, e){
            //code
            del_tab();
            //if($$("tabs").config.options.length===0)
            //    $$("tpl").show();
            //return false;
        });       
    });
    </script>
    </body>
</html>
