<!DOCTYPE HTML>
<html>
    <head>
        <!-- <link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css"> 
         <script src="http://cdn.webix.com/edge/webix.js" type="text/javascript"></script> -->
        <link rel="stylesheet" href=<?php echo $web_dir . "webix/codebase/skins/terrace.css";?> type="text/css">
        <script src=<?php echo $web_dir . "webix/codebase/webix.js";?> type="text/javascript"></script>
        <!--<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"></link>-->
        <link rel="stylesheet" href=<?php echo $web_dir . "resources/css/estiloRedesSociales.css";?> type="text/css"> 
<!--<<link rel="stylesheet" href=<?php //echo $web_dir."resources/css/font-awesome.min.css";
?> type="text/css"> -->
        <link rel="stylesheet" href=<?php echo $web_dir . "resources/css/style.css";?> type="text/css">
        <style>
            #areaA, #areaB{
                margin: 50px;
                width:700px; height:100px;
            }
            .blue.webix_menu-x{
                background:#3498DB;
            }
            /*carrucel*/
            html,body{
                background-color:#ffffff;
            }
            .content {
                width:100%;
                height:100%;
            }
            .image .webix_template{
                position: relative;
                background: #fff;
                padding: 5px 5px;
            }
            .title{
                position: absolute;
                left: 10px;
                bottom: 15px;
                color: #fff;
                font-size: 16px;
            }
            //barras
            .blue_row{
                background-color: #fff !important;
            }
        </style>

        <script src=<?php echo $web_dir."PDFObject-master/pdfobject.js";?> type="text/javascript"></script>
        
    </head>
    <body>
        <!-- <div id="testA" style="width:400px; height:300px; margin:10px;"></div> 
        color gris del banner #bdc3c7-->
        <div style="background-color:whitesmoke;">
            <div id="headerSpace1" style="background-color:#2c3e50; height:10px; padding:0; margin:0px" ></div>
            <!--logoGeSoftv1-->
        <div id="headerSpace2" style="background-color:#f1c40f; height:100px;"><img src="resources/images/Logo_Mandavek_Service.png" border="0" height="110" width="210" align="left" /> </div>
            <div id="headerSpace4" style="background-color:#8e44ad; color:white; height:40px; padding-top:10px; margin:0px; text-align:center">SISTEMA DE GEST&Atilde;O INTEGRADA</div>
            <div id="headerSpace3"></div>
            <div id="principalSpace" style="margin-bottom:20px"></div>
            <div id="footerSpace1" style="background-color:#8e44ad; height:10px;" ></div>
            <div id="footerSpace2" style="background-color:#2c3e50; color:graytext; height:150px; margin:0px; text-align:center; padding-top:10px;">Portal Web<br>Sobre Nos<br>
                <a class="facebookBtn smGlobalBtn" href="social-media-profile-url" ></a>
                <a class="twitterBtn smGlobalBtn" href="social-media-profile-url" ></a>
                <a class="googleplusBtn smGlobalBtn" href="social-media-profile-url" ></a>
                <a class="linkedinBtn smGlobalBtn" href="social-media-profile-url" ></a>
                <a class="pinterestBtn smGlobalBtn" href="social-media-profile-url" ></a>
                <a class="tumblrBtn smGlobalBtn" href="social-media-profile-url" ></a>
                <a class="rssBtn smGlobalBtn" href="social-media-profile-url" ></a>
            </div>
        </div>
        <!--<div id="loginSpace" style="height:900px; margin:5px;"></div>-->
        <script type="text/javascript" charset="utf-8">
            var BASE_URL = '<?php echo base_url();?>' + 'index.php/';
            var PRO_URL = '<?php echo base_url();?>';
        </script>
        <script src=<?php echo $web_dir."MODULOS/Login/login.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Login/alterar_senha.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Login/login_pautas.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Login/login_curriculum.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Login/login_planif_prof.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Login/login_dpto_prog.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Login/login_dpto_dosi.js";?> type="text/javascript"></script>
        <script src=<?php echo $web_dir."MODULOS/Login/login_planif_dpto.js";?> type="text/javascript"></script>

        <script type="text/javascript" charset="utf-8">
            //header
            var menu_data = [
                {id: "1", value: "Estudantes", submenu: ["Notas", "Pagamentos", "Regulamentos"]},
                {id: "2", value: "Professores", submenu: ["Curriculum", "Avaliações", "Planif. Aulas", "Regulamentos"]},
                {id: "3", value: "Departamentos", submenu: ["Planificação","Programas", "Dosificação"]},
                {id: "4", value: "Biblioteca", submenu: ["Consultas"]}
            ];
            var menu = {
                view: "menu",
                padding: 0,
                width: 365,
                //autowidth:true,
                data: menu_data,
                css: "blue",
                on:{
					onMenuItemClick:function(id){
						//webix.message("Click: "+id);
                        if(this.getMenuItem(id).value == "Avaliações")
                            $$("winLoginSGI_pautas").show();
                        if(this.getMenuItem(id).value == "Curriculum")
                            $$("winLoginSGI_curriculum").show();
                        if(this.getMenuItem(id).value == "Planif. Aulas")
                            $$("winLogin_planif_prof").show();

                        //Departamentos
                        if(this.getMenuItem(id).value == "Planificação")
                            $$("winLogin_planif_dpto").show();
                        if(this.getMenuItem(id).value == "Programas")
                            $$("winLogin_dpto_prog").show();
                        if(this.getMenuItem(id).value == "Dosificação")
                            $$("winLogin_dpto_dosi").show();
					}
				}
            };
            //carrucel
            function img(obj) {
                return '<img src="' + obj.src + '" class="content" ondragstart="return false"/><div class="title">' + obj.title + '</div>'
            }
            var toolbar = {view: "toolbar", id: "idtoolbar", paddingY: 0, height: 35, 
                cols: [
                    //{ view:"label", type:"image", label:"Sistema de Gest&atilde;o Integral",width:300,/*image:PRO_URL+"resources/images/logoGeSoftv1-2.png"*/},
                    {},
                    {view: "label", label: "SISTEMA DE GEST&Atilde;O INTEGRADA", width: 300},
                    {}
                ]};
            var loginSGI = {view: "button", type: "imageButton", label: "Login SGI", image: PRO_URL + "resources/icons/im32x32.gif", width: 115, click: function () {
                    //var redirect = BASE_URL+'welcome/logout';
                    //window.location = redirect;
                    showForm("winLoginSGI", this.$view);
                }};
            var alterar_senha = {view: "button", type: "imageButton", label: "Alterar Senha", image: PRO_URL + "resources/icons/logout.png", width: 125, click: function () {
                    //var redirect = BASE_URL+'welcome/logout';
                    //window.location = redirect;
                    showForm2("winLoginSGI2", this.$view);
            }};
            
            webix.ui({
                //type:"clean",
                container: "headerSpace3",
                rows: [
                    {type: "clean", cols: [menu, /*videos,*/{},alterar_senha,loginSGI]},
                    //{type:"clean", view:"template",height:30},
                ]
            });
            //TEMPORAL PARA GRAFICA
            var dataset_colors = [
                {id: 1, quantidade: 20, codigo: "ELMED", color: "#ee4339"},
                {id: 2, quantidade: 55, codigo: "EFM", color: "#ee9336"},
                {id: 3, quantidade: 40, codigo: "LCLI", color: "#eed236"},
                {id: 4, quantidade: 78, codigo: "PSIC", color: "#d3ee36"},
                {id: 5, quantidade: 61, codigo: "EIF", color: "#a7ee70"},
                {id: 6, quantidade: 35, codigo: "ELEC", color: "#58dccd"},
                {id: 7, quantidade: 80, codigo: "MECA", color: "#36abee"},
                {id: 8, quantidade: 50, codigo: "ARQ", color: "#476cee"},
                {id: 9, quantidade: 65, codigo: "IDRA", color: "#a244ea"},
                {id: 10, quantidade: 59, codigo: "ECIV", color: "#e33fc7"}
            ];
            var month_dataset = [
                {quantidade: "300", periodo: "Regular", color: "#36abee"},
                {quantidade: "200", periodo: "Postlaboral", color: "#ee9e36"},
                //{quantidade: "20", periodo: "PostGrau", color: "#58dccd"}
            ];
            webix.ui({
                container: "principalSpace",
                //type:"wide", margin:10, padding:0, 
                //view:"flexlayout", //id:"a1", autoWidth:true, autoHeight:true,
                id:"al",
                rows:[
                    {
                        //type:"clear", /*padding:0,*/ responsive:"a1",autoWidth:true, autoHeight:true,
                        responsive:"al",//view:"flexlayout",type:"wide",
                        /*cols: [
                                {},
                                {*/
                                    view: "carousel",
                                    id: "carouselFotos",
                                    //head: "Fotos Instituição",
                                    //move: true,
                                    //top: 50,
                                    minWidth: 400,
                                    minHeight: 330,
                                    height: 550,
                                    navigation: {
                                        type: "side",
                                        items: true,
                                        buttons: true
                                    },
                                    cols: [
                                        {css: "image", template: img, data: {src: PRO_URL + "resources/carrucel/image001.jpg", title: "Image 1"}},
                                        {css: "image", template: img, data: {src: PRO_URL + "resources/carrucel/image002.jpg", title: "Image 2"}},
                                        {css: "image", template: img, data: {src: PRO_URL + "resources/carrucel/image003.jpg", title: "Image 3"}},
                                        {css: "image", template: img, data: {src: PRO_URL + "resources/carrucel/image004.jpg", title: "Image 4"}},
                                        {css: "image", template: img, data: {src: PRO_URL + "resources/carrucel/image005.jpg", title: "Image 5"}},
                                        {css: "image", template: img, data: {src: PRO_URL + "resources/carrucel/image006.jpg", title: "Image 6"}}
                                    ]
                                /*},
                                {},
                            ]*/
                    },
                {
                    cols: [
                        {
                            responsive:"al",
                                    rows: [
                                        {cols: [
                                                {view: "button", value: "Anterior",
                                                    click: function () {
                                                        $$('pager1').select("prev");
                                                    }},
                                                {view: "label", label: "Comunicados", width:100},
                                                {view: "button", value: "Seguinte",
                                                    click: function () {
                                                        $$('pager1').select("next");
                                                    }}
                                            ]},
                                        {view: "list", minWidth: 350,/*data: data_comunicados,*/ url:BASE_URL + "CComunicados/read", yCount: 5, select:true,
                                            type: {
                                                //minWidth: 400,
                                                height: 80,
                                                template: "<div class='overall'>#comTitulo#<div class='T&iacute;tulo'>#comConteudo#</div><div class='year'>Data: #comData#  Hora: #comHora#</div> </div>"
                                            },
                                            pager: {
                                                apiOnly: true, id: "pager1", size: 5, animate: {
                                                    direction: "top"
                                                }
                                            }
                                        }]
                            /* },
                                {}
                            ]*/
                        },
                        //{width: 10},
                        //{height: 30,template: "<div style='background-color:#fff; color:white; width:40px; text-align:center'>Estatat&iacute;sticas</div>"},
                        //{width: 10},
                       /* {
                            responsive:"al",
                                    view: "carousel",
                                    id: "carouselEstadisticas",
                                    minWidth: 400,
                                    minHeight: 330,
                                    navigation: {
                                        type: "side",
                                        items: true,
                                        buttons: true
                                    },
                                    cols: [
                                        //{css: "image", template:img, data:{src:PRO_URL+"resources/carrucel/image001.jpg", title: "Image 1"} },
                                        {css: "image",
                                            id: "chartEstXCurso",
                                            view: "chart",
                                            //width:600px;height:250px;
                                            minWidth: 410,
                                            //autowidth: true,
                                            minHeight: 250,
                                            type: "bar",
                                            value: "#quantidade#",
                                            label: "#quantidade#",
                                            color: "#color#",
                                            radius: 0,
                                            barWidth: 40,
                                            tooltip: {
                                                template: "#quantidade#"
                                            },
                                            xAxis: {
                                                title: "Estudantes por curso",
                                                template: "'#codigo#",
                                                lines: true
                                            },
                                            padding: {
                                                left: 10,
                                                right: 10,
                                                top: 50
                                            },
                                            //data: dataset_colors
                                            url: BASE_URL + "CCursos/Get_total_X_curso_estadistica",
                                        }, {
                                            rows: [
                                                {
                                                    css: "image",
                                                    view: "chart",
                                                    type: "pie",
                                                    autowidth: true,
                                                    //borderless:true,
                                                    border: true,
                                                    value: "#quantidade#",
                                                    color: "#color#",
                                                    label: "#periodo#",
                                                    pieInnerText: "#quantidade#",
                                                    shadow: 0,
                                                    //data: month_dataset
                                                    url: BASE_URL + "CPeriodos/Get_total_X_periodo_estadistica",
                                                }, {
                                                    template: "<div style='width:100%;text-align:center'>Estudantes por periodo</div>",
                                                    height: 30
                                                }
                                            ]
                                        }
                                    ]
                        }, */
                        //{height: 30},
                    ]
                }
            ]
            });
            function carruselSiguiente() {
                $$('carouselFotos').showNext();
               // $$('carouselEstadisticas').showNext();
            }
            setInterval('carruselSiguiente()', 15000);
        </script>
    </body>
</html>
