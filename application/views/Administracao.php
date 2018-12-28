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
        <title>SGI-Adm</title>
   <!-- <link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css"> 
    <script src="http://cdn.webix.com/edge/webix.js" type="text/javascript"></script> -->
    <link rel="stylesheet" href=<?php echo $web_dir."webix/codebase/webix.css";?> type="text/css">
    <script src=<?php echo $web_dir."webix/codebase/webix.js";?> type="text/javascript"></script>
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
	</style>
    <body>
        <!-- VARIABLES DEL SERVIDOR-->
        <script type="text/javascript" charset="utf-8">
            var BASE_URL = '<?php echo base_url(); ?>' + 'index.php/';
            var PRO_URL = '<?php echo base_url(); ?>';
            var user_sessao = '<?php echo $this->session->userdata('username') ?>';
        </script>
        <!-- SUB-MODULOS -->
        <script src=<?php echo $web_dir."MODULOS/Administracao/Usuarios.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/NiveisCursos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Enderecos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/GruposCategoriasFuncionarios.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Vinculos_Laborais.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Habilitacoes_Literarias.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/DepartamentosSectores.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Generos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Estado_Civil.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/RegimeTempos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Ano_Curricular.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Disciplinas.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Periodos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Semestres.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Turmas.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Funcionarios_Cargos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Funcionarios_Funcoes.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Funcionarios_Licencas_Motivos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Anos_Lectivos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Necessita_Educacao_Especial.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Profissao.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Escola_Formacao.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Organismos_Tutela.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Financas_Bancos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Meses_Propina.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Documentos.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/DeclaracaoMotivo.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/DeclaracaoMestradoConfiguracao.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/Pautas_Configuracao.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/tipo_aulas.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/modalidades_formacao.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Administracao/universidades.js";?> type="text/javascript"></script>
        
       <!-- <div id="testA" style="width:400px; height:300px; margin:10px;"></div> -->
       <div id="headerAmin" style="margin:10px"></div>
       <div id="menuAdmin" style="margin:5px; width:210px"></div>
       <div id="principalAdmin" style="margin:5px; height:800px"></div>
       
       <script type="text/javascript" charset="utf-8">
        
        webix.ui({
            container:"principalAdmin", type:"space",
            position:"center",
            rows:[	
                {view:"toolbar", cols:[
                    { view:"label", type:"image", label:"Sistema de Gest&atilde;o Integral",width:300,/*image:PRO_URL+"resources/images/logoGeSoftv1-2.png"*/},
                    {},
                    { view:"label", label:"ADMINISTRA&Ccedil;&Atilde;O",width:300},
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
		{ 
            cols:[
                { 
                    view:"list", id:"menuAdministracao",
                    //template:"#smNome#",
                    width: 250,
                    height:750,
                    //autoheight:true,
                    yCount:10,
                    scroll:true,
                    //data: submodulosUsuarios,
                    template:"<div class='mark'>#badge# </div> #smNome#",
                    type:{
                        height:40
                    },
                    url: BASE_URL+"CSubModulos/read?modulo=01&usuario="+user_sessao,
                    select:true,
                    on:{
                        onItemClick:open_new_tab
                    }
                },
                { 
                    type:"clean", 
                        rows:[
                            { id:"tabs", view:"tabbar",close:true,  multiview:true, options:[], height:40},
                            { id:"views", cells:[
                                {view:"template", id:"tpl", height:750, /*height:800,*/template:"Vem-Bindo ao Sub-Sistema de Aministra&ccedil;&atilde;o."}
                            ]}
                        ]
                }
            ]
        }
        ]
	});
        
        function open_new_tab(id){
            var item = $$('menuAdministracao').getItem(id);
            //add tab
            if(!$$(item.id)){
                if(item.smCodigo==='0101'){
                    //console.log('entro en 1');
                    cargarVistaUsuarios(item.smCodigo);
                }
                if(item.smCodigo==='0102'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaNiveisCursos(item.smCodigo);
                }
                if(item.smCodigo==='0103'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaEnderecos(item.smCodigo);
                }
                if(item.smCodigo==='0104'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaGruposCategoriasFuncionarios(item.smCodigo);
                }
                if(item.smCodigo==='0105'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaVinculos_Laborais(item.smCodigo);
                }
                if(item.smCodigo==='0106'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarHabilitacoes_Literarias(item.smCodigo);
                }
                if(item.smCodigo==='0107'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaDepartamentosSectores(item.smCodigo);
                }
                if(item.smCodigo==='0108'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarVistaGeneros(item.smCodigo);
                }
                if(item.smCodigo==='0109'){
                    //$$("views").addView({ view:"template", id:item.smCodigo, template:"Title:"+item.smNome});
                    cargarEstado_Civil(item.smCodigo);
                }
                if(item.smCodigo==='0110'){
                    cargarVistaRegimeTempos(item.smCodigo);
                }
                if(item.smCodigo==='0111'){
                    cargarVistaAno_Curricular(item.smCodigo);
                }
                if(item.smCodigo==='0112'){
                    cargarVistaDisciplinas(item.smCodigo);
                }
                if(item.smCodigo==='0113'){
                    cargarVistaPeriodos(item.smCodigo);
                }
                if(item.smCodigo==='0114'){
                    cargarVistaSemestres(item.smCodigo);
                }
                if(item.smCodigo==='0115'){
                    cargarVistaTurmas(item.smCodigo);
                }
                if(item.smCodigo==='0116'){
                    cargarVistaFuncionarios_Cargos(item.smCodigo);
                }
                if(item.smCodigo==='0117'){
                    cargarVistaFuncionarios_Funcoes(item.smCodigo);
                }
                if(item.smCodigo==='0118'){
                    cargarVistaFuncionarios_Licencas_Motivos(item.smCodigo);
                }
                if(item.smCodigo==='0119'){
                    cargarVistaAnos_Lectivos(item.smCodigo);
                }
                if(item.smCodigo==='0120'){
                    cargarVistaNecessita_Educacao_Especial(item.smCodigo);
                }
                if(item.smCodigo==='0121'){
                    cargarVistaProfissao(item.smCodigo);
                }
                if(item.smCodigo==='0122'){
                    cargarVistaEscola_Formacao(item.smCodigo);
                }
                if(item.smCodigo==='0123'){
                    cargarVistaOrganismos_Tutela(item.smCodigo);
                }
                if(item.smCodigo==='0124'){
                    cargarVistaFinancas_Bancos(item.smCodigo);
                }
                if(item.smCodigo==='0125'){
                    cargarVistaMeses_Propina(item.smCodigo);
                }
                if(item.smCodigo==='0126'){
                    cargarVistaDocumentos(item.smCodigo);
                }
                if(item.smCodigo==='0127'){
                    cargarVistaDeclaracaoMotivo(item.smCodigo);
                }
                if(item.smCodigo==='0128'){
                    cargarVistaDeclaracaoMestradoConfiguracao(item.smCodigo);
                }
                if(item.smCodigo==='0129'){
                    cargarVistaFormulas_Pautas(item.smCodigo);
                }
                if(item.smCodigo==='0130'){
                    cargarVistatipo_aulas(item.smCodigo);
                }
                if(item.smCodigo==='0131'){
                    cargarVista_modalidade_formacao(item.smCodigo);
                }
                if(item.smCodigo==='0132'){
                    cargarVistaUniversidades(item.smCodigo);
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
            $$("menuAdministracao").unselect(id);
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


