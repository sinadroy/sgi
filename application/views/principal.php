<?php
if (!$this->session->userdata('idusuario')) {
    // redirigimos a la función login
    redirect(base_url(), 'refresh');
}
// cuerpo de la interfase principal
//echo "Interfase principal";
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>SGI</title>
        <!-- <link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css"> 
         <script src="http://cdn.webix.com/edge/webix.js" type="text/javascript"></script> -->
        <link rel="stylesheet" href=<?php echo $web_dir . "webix/codebase/skins/terrace.css"; ?> type="text/css">
        <script src=<?php echo $web_dir . "webix/codebase/webix.js"; ?> type="text/javascript"></script>
        <!--
        <link rel="stylesheet" href=<?php echo $web_dir . "resources/css/estiloRedesSociales.css"; ?> type="text/css"> 
        -->
        <link rel="stylesheet" href=<?php echo $web_dir . "resources/css/style.css"; ?> type="text/css">

    </head>
    <body>
        <div style="background-color:whitesmoke;">
            <div id="headerSpace1" style="background-color:#2c3e50; height:10px; padding:0; margin:0px" ></div>
            <div id="headerSpace2" style="background-color:#f1c40f; height:100px;"><img src=<?php echo base_url()."resources/images/Logo_Mandavek_Service.png"?> border="0" height="110" width="210" align="left" /> <!--<img src="resources/images/logoGeSoftTexto.png" border="0" height="50" width="100" align="left" />--></div>
            <!--<div id="headerSpace2" style="background-color:#f1c40f; height:70px;"><img src="../../resources/images/logoGeSoftv1.png" border="0" height="50" width="50" align="left" /><img src="../../resources/images/logoGeSoftTexto.png" border="0" height="50" width="100" align="left" /></div> -->

            <div id="headerSpace4" style="background-color:#8e44ad; color:white; height:40px; padding-top:5px; padding-bottom:5px; margin:0px; text-align:left">SISTEMA DE GEST&Atilde;O INTEGRADA<div style="text-align:center">INICIO</div><div id="idDivBtnSupDer"></div></div>
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

        <!-- <div id="testA" style="width:400px; height:300px; margin:10px;"></div> 
        <div id="headerSpace" style="margin:20px"></div>
        <div id="principalSpace" style="margin:20px"></div>
        <div id="footerSpace" style="margin:20px"></div>
        -->

        <script type="text/javascript" charset="utf-8">
            var BASE_URL = '<?php echo base_url(); ?>' + 'index.php/';
            var PRO_URL = '<?php echo base_url(); ?>';
            var user_sessao = '<?php echo $this->session->userdata('username') ?>';

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
            var form1 = {
                view: "form", width: 750, scroll: false,
                rows: [
                    {
                        cols: [
                            {view: "button", type: "image", label: "Académica", css: "myBtnCSS4", padding: 5, height: 75, width: 170, image: PRO_URL + "resources/icons_new/Color_layers.png", click: function () {
                                    //comprobar acesso ao modulo
                                    var envio = "modulo=A.Académica&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/academico';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                                }},
                            {width: 10},
                            {view: "toggle", type: "image", label: "Científica", css: "myBtnCSS10", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=A.Científica&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/cientifica';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                                }},
                            {width: 10},
                            {view: "button", type: "image", label: "R-Humanos", css: "myBtnCSS2", padding: 5, height: 75, width: 170, image: PRO_URL + "resources/icons/group.gif"/*image:path+"paste.gif"*/, click: function () {
                                    var envio = "modulo=R.Humanos&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/rhumanos';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},
                            {width: 10},
                            {view: "toggle", type: "image", label: "Biblioteca", css: "myBtnCSS7", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Biblioteca&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/biblioteca';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                                }},
                        ]
                    },
                    {height: 2},
                    {
                        cols: [
                            {view: "toggle", type: "image", label: "Finan./Contab.", css: "myBtnCSS5", height: 75, width: 170, image: PRO_URL + "resources/icons/money_add.png", click: function () {
                                    var envio = "modulo=Finanças&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/financas';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                                }},
                            {width: 10},
                            
                            
                            {view: "toggle", type: "image", label: "Patrim&oacute;nio", css: "myBtnCSS8", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Patrimonio&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/patrimonio';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                                }},
                             {width: 10},
                             {view: "toggle", type: "image", label: "Arquivos", css: "myBtnCSS12", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Arquivos&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/arquivos';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},
                            {width: 10},
                            {view: "toggle", type: "image", label: "Est&aacute;g./Monog.", css: "myBtnCSS6", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Contabilidade&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/contabilidade';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                                }},
                            
                        ]
                    },
                    {height: 2},
                    {
                        cols: [
                            /*{view: "button", type: "image", label: "Presenças", css: "myBtnCSS3", padding: 5, height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Presenças&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/presencas';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},*/
                            {view: "toggle", type: "image", label: "Livro-Outorga", css: "myBtnCSS9", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Livro-Outorga&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/livro_otorga';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},
                            {width: 10},
                            
                            {view: "toggle", type: "image", label: "Intranet", css: "myBtnCSS9", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Intranet&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/intranet';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                                }},
                            {width: 10},
                            {view: "toggle", type: "image", label: "Auditoria", css: "myBtnCSS11", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Auditoria&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/auditorias';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},
                            {width: 10},
                            {view: "toggle", type: "image", label: "Estat&iacute;sticas", css: "myBtnCSS10", height: 75, width: 170, image: PRO_URL + "resources/icons_new/3d_bar_chart.png", click: function () {
                                    var envio = "modulo=Estatisticas&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/Estatisticas';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},
                        ]
                    },
                    {height: 2},
                    {
                        cols: [
                            {view: "toggle", type: "image", label: "Calendarios", css: "myBtnCSS1", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Calendarios&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/calendarios';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},
                            {width: 10},
                            {view: "toggle", type: "image", label: "Secretar&iacute;a", css: "myBtnCSS1", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Secretaria&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/secretaria';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},
                            {width: 10},
                            {view: "toggle", type: "image", label: "Planifica&ccedil;&atilde;o", css: "myBtnCSS9", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Planificacao&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/planificacao';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},
                        ]
                    },{
                        cols: [
                            {view: "toggle", type: "image", label: "Ajuda", css: "myBtnCSS12", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Ajuda&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/arquivos';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},
                            {view: "button", type: "image", label: "Configura&ccedil;&otilde;es", css: "myBtnCSS1", padding: 5, height: 75, width: 170, image: PRO_URL + "resources/icons/cog_edit.png", click: function () {
                                    var envio = "modulo=Configurações&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/administracao';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},
                            {width: 10},
                            {view: "toggle", type: "image", label: "Backups", css: "myBtnCSS11", height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Backup&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/backup';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},
                            {width: 10},
                            {view: "button", type: "image", label: "Licenças SGI", css: "myBtnCSS3", padding: 5, height: 75, width: 170, image: PRO_URL + "webix/samples/common/imgs/32/copy.gif", click: function () {
                                    var envio = "modulo=Presenças&usuario="+user_sessao;
                                    var r = webix.ajax().sync().post(BASE_URL + "CModulos/getAccess", envio);
                                    if(r.responseText == "true"){
                                        var redirect = BASE_URL + 'welcome/licencas';
                                        window.location = redirect;
                                    }else{
                                        webix.message({ type: "error", text: "O Utilizador actual n&atilde;o tem acesso a este m&oacute;dulo" });
                                    }
                            }},
                            {width: 10},
                        ]
                    }
                ]

            };
            webix.ui({
                //type:"line",
                container: "principalSpace",
                position: "center",
                //css:"myFormGris",
                cols: [
                    {},
                    {
                        rows: [
                            form1 /*form11, form3, form31, form2, form4 */
                        ]
                    }, {}]
            });

            webix.ui({
                //type:"line",
                container: "headerSpace3",
                //container:"idDivBtnSupDer",
                //rows: [{
                cols: [{},
                    {view: "button", type: "imageButton", label: "Sair", image: PRO_URL + "resources/icons/Index.png", height: 45, width: 90, click: function () {
                            var redirect = BASE_URL + 'welcome/logout';
                            window.location = redirect;
                        }
                    }
                ]
                        //    }],
            });
/*
            webix.ui({
                //type:"line",
                container: "principalSpace",
                rows: [
                    
                    {height: 30},
                    {
                        cols: [
                            {},
                           
                            {
                                view: "carousel",
                                id: "idCarouselEstadisticas",
                                width: 750,
                                height: 330,
                                navigation: {
                                    type: "side",
                                    items: true,
                                    buttons: true
                                },
                                cols: [
                                    //{css: "image", template:img, data:{src:PRO_URL+"resources/carrucel/image001.jpg", title: "Image 1"} },
                                    {   css: "image",
                                        
                                        id: "chartEstXCurso",
                                        view: "chart",
                                        //width:600px;height:250px;
                                        width:700,
                                        //autowidth: true,
                                        height: 250,
                                        type: "bar",
                                        value: "#quantidade#",
                                        label: "#quantidade#",
                                        color: "#color#",
                                        radius: 0,
                                        barWidth: 40,
                                        tooltip:{
                                            template: "#quantidade#"
                                        },
                                        xAxis: {
                                            title: "Candidatos por curso",
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
                                                data: month_dataset
                                            }, {
                                                template: "<div style='width:100%;text-align:center'>Estudantes por periodo</div>",
                                                height: 30
                                            }
                                        ]
                                    }
                                ]
                            }, 
                            
                            {}
                        ]
                    }
                    ]

            });
            */
        </script>
    </body>
</html>


