<!DOCTYPE HTML>
<html>
    <head>
        <!-- <link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css"> 
         <script src="http://cdn.webix.com/edge/webix.js" type="text/javascript"></script> -->

        <link rel="stylesheet" href=<?php echo $web_dir . "webix/codebase/skins/terrace.css"; ?> type="text/css">
        <script src=<?php echo $web_dir . "webix/codebase/webix.js"; ?> type="text/javascript"></script>

        <script src=<?php echo $web_dir . "MODULOS/temp.js"; ?> type="text/javascript"></script>
        <!--<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"></link>-->
        <link rel="stylesheet" href=<?php echo $web_dir . "resources/css/estiloRedesSociales.css"; ?> type="text/css"> 

<!--<<link rel="stylesheet" href=<?php //echo $web_dir."resources/css/font-awesome.min.css";            ?> type="text/css"> -->
        <link rel="stylesheet" href=<?php echo $web_dir . "resources/css/style.css"; ?> type="text/css">
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
                padding: 50px 60px;
            }
            .title{
                position: absolute;
                left: 10px;
                bottom: 15px;
                color: #fff;
                font-size: 16px;
            }
            /*barras*/
            .blue_row{
                background-color: #fff !important;
            }
            /* Flex Box*/
            #content{
                background: #e7eef5;
                height: 500px;
                display: flex;
                flex-direction: row;
                /*flex-direction: column; */
                flex-wrap: wrap; /*para q el contenido se ajuste en columnas si el ancho no es suficiente para representar los items*/
                justify-content: flex-start; /*flex-start; space-around y flex-end para ajustar al final o al inicio*/
                align-items: center; /*para alinear en la vertical acepta flex-start y flex-end, strech para ajustar altura auto
                                        baseline para */
                -webkit-flex-flow: row wrap;
                flex-flow: row wrap;
            }
            .item{
                flex-grow: 0; /*ocupa o resto da largura da div*/
                flex-shrink: 1; /* encolhe a nossa div*/
                flex-basis: auto; /*Define un width para cada elemento en caso que no tenga*/
                
                height: 330px;
                width: 405;
                //min-width: 300px
                color: black;
                -webkit-box-shadow: 0px 2px 8px -1px rgba(0,0,0,0,24);
                background:  white;
                margin: 5px;
            }
        </style>
    </head>
    <body>
        <script type="text/javascript" charset="utf-8">
            
            //var BASE_URL = '<?php echo $web_dir . "index.php/"; ?>';
            var BASE_URL = '<?php echo base_url(); ?>' + 'index.php/';
            var PRO_URL = '<?php echo base_url(); ?>';
            //carrucel
            function img(obj) {
                return '<img src="' + obj.src + '" class="content" ondragstart="return false"/><div class="title">' + obj.title + '</div>'
            }
            </script>
        <!-- <div id="testA" style="width:400px; height:300px; margin:10px;"></div> 
        color gris del banner #bdc3c7-->
        <div style="background-color:whitesmoke;">
            <header class="header">
                <div id="headerSpace1" style="background-color:#2c3e50; height:10px; padding:0; margin:0px" ></div>
                <div id="headerSpace2" style="background-color:#f1c40f; height:70px;"><img src="resources/images/logoGeSoftv1.png" border="0" height="50" width="50" align="left" /><img src="resources/images/logoGeSoftTexto.png" border="0" height="50" width="100" align="left" /></div>
                <div id="headerSpace4" style="background-color:#8e44ad; color:white; height:40px; padding-top:10px; margin:0px; text-align:center">SISTEMA DE GEST&Atilde;O INTEGRAL</div>
                <div id="headerSpace3"></div>
            </header>
            
         <!--   <div id="principalSpace" style="margin-bottom:20px">
                <section id="content">
                    <article class="item"><div id:"item01"></div></article>
                    <article class="item" id:"item02"></article>
                    <article class="item" id:"item03"></article>
                </section>
        
            </div>
            -->
            <section id="content">
                    <article class="item"> <div id="item01">
                        <script type="text/javascript" charset="utf-8">
                            webix.ui({
                                container: "item01",
                                //type:"clear", id:"a1", autoWidth:true, autoHeight:true,
                                rows: [
                                    {
                                        cols: [
                                            {
                                                view: "button", value: "Anterior",
                                                click: function () {
                                                    $$('pager1').select("prev");
                                                }
                                            },
                                            {},
                                            {
                                                view: "button", value: "Seguinte",
                                                click: function () {
                                                    $$('pager1').select("next");
                                                }
                                            }
                                        ]
                                    },
                                    {
                                        view: "list", data: data_comunicados, yCount: 5, select: true,
                                        type: {
                                            width: 400,
                                            height: 70,
                                            template: "<div class='overall'><div class='T&iacute;tulo'>#comTitulo#</div><div class='year'>Data: #data#</div> </div>"
                                        },
                                        pager: {
                                            apiOnly: true, id: "pager1", size: 5, animate: {
                                                direction: "top"
                                            }
                                        }
                                    }
                                ]
                            })
                            </script>
                            </div>
                    </article>
                    <article class="item" ><div id="item02">
                        <script type="text/javascript" charset="utf-8">
                            webix.ui({
                                container: "item02",
                                rows: [
                                    {
                                        view: "carousel",
                                        id: "carouselFotos",
                                        //head: "Fotos Instituição",
                                        //move: true,
                                        //top: 50,
                                        width: 400,
                                        height: 330,
                                        navigation: {
                                            type: "side",
                                            items: true,
                                            buttons: true
                                        },
                                        cols: [
                                            { css: "image", template: img, data: { src: PRO_URL + "resources/carrucel/image001.jpg", title: "Image 1" } },
                                            { css: "image", template: img, data: { src: PRO_URL + "resources/carrucel/image002.jpg", title: "Image 2" } },
                                            { css: "image", template: img, data: { src: PRO_URL + "resources/carrucel/image003.jpg", title: "Image 3" } },
                                            { css: "image", template: img, data: { src: PRO_URL + "resources/carrucel/image004.jpg", title: "Image 4" } },
                                            { css: "image", template: img, data: { src: PRO_URL + "resources/carrucel/image005.jpg", title: "Image 5" } },
                                            { css: "image", template: img, data: { src: PRO_URL + "resources/carrucel/image006.jpg", title: "Image 6" } }
                                        ]
                                    },
                                ]
                            });
                    </script>
                    </div></article>
                    <article class="item"><div id="item03">
                        <script type="text/javascript" charset="utf-8">
                            webix.ui({
                                container: "item03",
                                rows: [
                                    {
                                        view: "carousel",
                                        id: "carouselEstadisticas",
                                        width: 400,
                                        height: 330,
                                        navigation: {
                                            type: "side",
                                            items: true,
                                            buttons: true
                                        },
                                        cols: [
                                            //{css: "image", template:img, data:{src:PRO_URL+"resources/carrucel/image001.jpg", title: "Image 1"} },
                                            {
                                                css: "image",
                                                id: "chartEstXCurso",
                                                view: "chart",
                                                //width:600px;height:250px;
                                                width: 410,
                                                //autowidth: true,
                                                height: 250,
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
                                                data: dataset_colors
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
                                                        data: month_dataset
                                                    }, {
                                                        template: "<div style='width:100%;text-align:center'>Estudantes por periodo</div>",
                                                        height: 30
                                                    }
                                                ]
                                            }
                                        ]
                                    },
                                ]
                            });
                            </script>
                    </div></article>
                </section>
                <footer class="footer">
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
                </footer>
            
        </div>

        <!--<div id="loginSpace" style="height:900px; margin:5px;"></div>-->
        <script type="text/javascript" charset="utf-8">
            
            //var BASE_URL = '<?php echo $web_dir . "index.php/"; ?>';
            var BASE_URL = '<?php echo base_url(); ?>' + 'index.php/';
            var PRO_URL = '<?php echo base_url(); ?>';
            var form = {
                view: "form",
                id: "idformLogin",
                borderless: true,
                elements: [
                    {view: "text", label: 'Usu&aacute;rio', name: "login"},
                    {view: "text", label: 'Senha', name: "senha", type: "password"},
                    {view: "button", value: "Entrar", hotkey: "enter", click: function () {
                            if (this.getParentView().validate()) { //validate form
                                var r = webix.ajax().sync().post(BASE_URL + "cutilizadores/validar", "action=login&login=" + $$("idformLogin").getValues().login + "&senha=" + $$("idformLogin").getValues().senha);
                                if (r.responseText == "true") {
                                    this.getTopParentView().hide(); //hide window
                                    var redirect = BASE_URL + 'welcome/principal';
                                    window.location = redirect;
                                } else {
                                    webix.message({type: "error", text: "Dados incorretos"});
                                }
                            }
                            else
                                webix.message({type: "error", text: "Dados incorretos"});
                        }},
                    {view: "button", value: "Cancel", name: "cancel", type: "danger", click: function () {
                            $$("idformLogin").clear();
                            this.getTopParentView().hide(); //hide window
                        }}
                ],
                rules: {
                    "senha": webix.rules.isNotEmpty,
                    "login": webix.rules.isNotEmpty
                },
                elementsConfig: {
                    labelPosition: "top",
                }
            };
            function showForm(winId, node) {
                $$(winId).getBody().clear();
                $$(winId).show(node);
                $$(winId).getBody().focus();
            }
            //header
            var menu_data = [
                {id: "1", value: "Estudantes", submenu: ["Credenciais", "Notas", "Pagamentos", "Regulamentos"]},
                {id: "2", value: "Professores", submenu: ["Credenciais", "Curriculum", "Avalia&ccedil;&otilde;es", "Regulamentos"]},
                {id: "3", value: "Biblioteca", submenu: ["Consultas"]}
            ];
            var menu = {
                view: "menu",
                padding: 0,
                width: 255,
                //autowidth:true,
                data: menu_data,
                css: "blue"
            };
            

            var toolbar = {view: "toolbar", id: "idtoolbar", paddingY: 0, height: 35, cols: [
                    //{ view:"label", type:"image", label:"Sistema de Gest&atilde;o Integral",width:300,/*image:PRO_URL+"resources/images/logoGeSoftv1-2.png"*/},
                    {},
                    {view: "label", label: "SISTEMA DE GEST&Atilde;O INTEGRAL", width: 300},
                    {},
                    //{ view:"toggle", type:"image", label:"Inicio",css:"myBtnCSS2",width:90,/*height:75,*/image:PRO_URL+"webix/samples/common/imgs/32/redo.gif"/*image:path+"paste.gif"*/},
                    /*{ view:"button", type:"imageButton", label:"Inicio",image:PRO_URL+"resources/icons/Home.png",height:45, width:90,click:function(){
                     var redirect = BASE_URL+'welcome/principal';
                     window.location = redirect;
                     }},*/
                    {view: "button", type: "imageButton", label: "Login SGI", image: PRO_URL + "resources/icons/im32x32.gif", width: 115, click: function () {
                            //var redirect = BASE_URL+'welcome/logout';
                            //window.location = redirect;
                            showForm("winLoginSGI", this.$view);
                        }}
                    //{view:"button", value:"Add New Film", width:150, type:"form", align:"left", click:"add_new"},{},
                    //{view:"button", value:"Sair", width:60, type:"danger", align:"right", click:"del_tab"}
                ]};
            var loginSGI = {view: "button", type: "imageButton", label: "Login SGI", image: PRO_URL + "resources/icons/im32x32.gif", width: 115, click: function () {
                    //var redirect = BASE_URL+'welcome/logout';
                    //window.location = redirect;
                    showForm("winLoginSGI", this.$view);
                }};

            webix.ui({
                //type:"clean",
                container: "headerSpace3",
                rows: [
                    {type: "clean", cols: [menu, {}, loginSGI]},
                    //{type:"clean", view:"template",height:30},

                ]
            });
            
            webix.ui({
                //view:"window",
                view: "popup",
                id: "winLoginSGI",
                width: 300,
                position: "center",
                modal: false,
                head: "Dados de Usu&aacute;rio",
                //body:webix.copy(form)
                body: form
            });
            //}).show();

            //$$("idtoolbar").define("css", "barras");
        /*    function carruselSiguiente() {
                $$('carouselFotos').showNext();
                $$('carouselEstadisticas').showNext();
                //$$('carousel1').;
            }
            setInterval('carruselSiguiente()', 15000);
            */
        </script>
    </body>
</html>

