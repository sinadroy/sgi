<!DOCTYPE HTML>
<html>
    <head>
        <!-- <link rel="stylesheet" href="http://cdn.webix.com/edge/webix.css" type="text/css"> 
         <script src="http://cdn.webix.com/edge/webix.js" type="text/javascript"></script> -->

        <link rel="stylesheet" href=<?php echo $web_dir . "webix/codebase/skins/terrace.css"; ?> type="text/css">
        <script src=<?php echo $web_dir . "webix/codebase/webix.js"; ?> type="text/javascript"></script>
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
    </head>
    <body>
         <script type="text/javascript" charset="utf-8">
            
            var BASE_URL = '<?php echo base_url(); ?>' + 'index.php/';
            var PRO_URL = '<?php echo base_url(); ?>';
         </script>
        <!-- <div id="testA" style="width:400px; height:300px; margin:10px;"></div> 
        color gris del banner #bdc3c7-->
        <div style="background-color:whitesmoke;">
            <div id="headerSpace1" style="background-color:#2c3e50; height:10px; padding:0; margin:0px" ></div>
            <div id="headerSpace2" style="background-color:#f1c40f; height:70px;"><img src="../../resources/images/logoGeSoftv1.png" border="0" height="50" width="50" align="left" /><img src="../../resources/images/logoGeSoftTexto.png" border="0" height="50" width="100" align="left" /></div>

            <div id="headerSpace4" style="background-color:#8e44ad; color:white; height:40px; padding-top:10px; margin:0px; text-align:center">CONTROLE DE PRESEN&Ccedil;AS</div>
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
            
            //var BASE_URL = '<?php echo $web_dir . "index.php/"; ?>';
            var BASE_URL = '<?php echo base_url(); ?>' + 'index.php/';
            var PRO_URL = '<?php echo base_url(); ?>';
            
            var toolbar = {view: "toolbar", id: "idtoolbar", paddingY: 0, height: 35, cols: [
                    //{ view:"label", type:"image", label:"Sistema de Gest&atilde;o Integral",width:300,/*image:PRO_URL+"resources/images/logoGeSoftv1-2.png"*/},
                    {view: "label", label: "SISTEMA DE GEST&Atilde;O INTEGRAL", width: 300},
                    {},
                    {view: "label", label: "Controle de Presen&ccedil;as", width: 300},
                    {},
                ]};
            
            /*formulario*/
            var form1 = [
                { view:"text", id:"idCodigoBarra",type:'password', label:"Codigo de Barras",labelPosition: "top"//,
                   /* on: {
                            "onChange": function (newv, oldv) {
                                var fNome = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readNomeXBI", "id=" + this.getValue());
                                var fApelido = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readApelidoXBI", "id=" + this.getValue());
                                if(fNome && fApelido){
                                    $$("idTNome").setValue(fNome.responseText);
                                    $$("idTApelido").setValue(fApelido.responseText);
                                    $$("idTBI").setValue(this.getValue());
                                }
                            }
                        } */
                },
                { view:"text", id:"idTNome",label:"Nome",/*value:"Nome",*/labelPosition: "top",readonly: true},
                { view:"text", id:"idTApelido",label:"Apelido",/*value:"Apelido",*/labelPosition: "top",readonly: true},
                { view:"text", id:"idTBI",label:"BI",/*value:"BI",*/labelPosition: "top",readonly: true},
                { margin:5, cols:[
                    //{ view:"button", value:"Login" , type:"form" },
                    //{ view:"button", value:"Cancelar", type:"danger"}
                ]}
            ];

            var form2 = [
                { view:"text", id:"idTData",label:"Data",labelPosition: "top",readonly: true},
                { view:"text", id:"idTHora",label:"Hora",labelPosition: "top",readonly: true},
                { view:"text", id:"idTEntrada",label:"Hora de Entrada Sess&atilde;o actual",labelPosition: "top",readonly: true},
                { view:"text", id:"idTSaida",label:"Hora de Sa&iacute;da Sess&atilde;o actual",labelPosition: "top",readonly: true},
                { view:"text", id:"idTEstado",label:"Estado",labelPosition: "top",readonly: true}
            ];

            webix.ui({
                container: "principalSpace",
                id:"al",
                rows:[
                    {height:20},
                    {
                        responsive:"al",//view:"flexlayout",type:"wide",
                        cols: [
                            {},
                            { view:"form", scroll:false, width:300, elements: form1 },
                            {},
                            {
                                view:"form", id:"idform_Foto", height:205, width:250, scroll:false,
                                rows:[
                                    {},
                                    {view:"template",id:"id_template_foto",width:200,height:200,template:'<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src='+PRO_URL+'Fotos/Funcionarios/default.jpg /></div>'},
                                    {}
                                ]
                            },
                            {},
                            { view:"form", scroll:false, width:300, elements: form2 },
                            {}
                        ]
                    }]
            });

            //EVENTOS
            //Poner el focus en el campo Codigo de Barras
            $$('idCodigoBarra').focus();

            $$("idCodigoBarra").attachEvent("onChange", function(newv, oldv){
                //cargar datos personales
                var fNome = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readNomeXBI", "id=" + this.getValue());
                var fApelido = webix.ajax().sync().post(BASE_URL + "cFuncionarios/readApelidoXBI", "id=" + this.getValue());
                if(fNome && fApelido){
                    $$("idTNome").setValue(fNome.responseText);
                    $$("idTApelido").setValue(fApelido.responseText);
                    $$("idTBI").setValue(this.getValue());
                }
                //CARGAR ENTRADA Y SALIDA
                var Entrada = webix.ajax().sync().post(BASE_URL + "cHorario_Funcionarios/getHoraEntrada", "bi=" + this.getValue());
                var Saida = webix.ajax().sync().post(BASE_URL + "cHorario_Funcionarios/getHoraSaida", "bi=" + this.getValue());
                
                if(Entrada && Saida){
                    $$("idTEntrada").setValue(Entrada.responseText);
                    $$("idTSaida").setValue(Saida.responseText);
                    
                    //REGISTRAR MARCA
                    //registrar_marca
                    var marca = webix.ajax().sync().post(BASE_URL + "cHorario_Funcionarios/registrar_marca", "bi=" + newv);
                    if(marca.responseText == "true"){
                        webix.message("Registrado");
                        var Estado = webix.ajax().sync().post(BASE_URL + "cHorario_Funcionarios/get_Ultimo_Estado", "bi=" + this.getValue());
                        $$("idTEstado").setValue(Estado.responseText);
                    }
                    else
                        webix.message({type: "error", text: "Erro, C&oacute;digo errado ou não tem horario definido para esta sessão de trabalho"});
                           
                }/*else{

                }*/
                //cargar foto
                var envio = "id="+newv;
                var r = webix.ajax().sync().post(BASE_URL+"cFuncionarios/cargarFotoCB", envio);
                var CODIGO_FOTO = r.responseText;
                if(CODIGO_FOTO !== ""){
                    $$("idform_Foto").removeView("id_template_foto");
                    $$("idform_Foto").addView({view:"template",id:"id_template_foto",width:200,height:200,template:'<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src='+PRO_URL+'Fotos/Funcionarios/'+CODIGO_FOTO+'.jpg /></div>'}, 1);
                    //activar la funcion de tiempo para que limpie los componentes en 8 seg
                    setTimeout('marcaSiguiente()', 8000);
                    //setInterval('marcaSiguiente()', 8000);
                }/*else{
                    webix.message({ type: "error", text: "Erro, O C&oacute;digo de Barras n&atilde;o &eacute; v&aacute;lido" });
                }*/

            });
            //reiniciar todo cada 8 segundos para proxima marca
            function marcaSiguiente() {
                $$("idCodigoBarra").setValue("");
                //$$("idCodigoBarra").clearValue();
                $$("idTNome").setValue("");
                $$("idTApelido").setValue("");
                $$("idTBI").setValue("");
                $$("idform_Foto").removeView("id_template_foto");
                $$("idform_Foto").addView({view:"template",id:"id_template_foto",width:200,height:200,template:'<div><img style="max-width:100%; max-height:100%; margin:auto; display:block;" src='+PRO_URL+'Fotos/Funcionarios/default.jpg /></div>'}, 1);
                $$("idTEstado").setValue("");
            };
            //reloj y data
            //data
            //$$("idTData").setValue(new Date());
            var f = new Date();
            $$("idTData").setValue(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());

            mueveReloj();
            function mueveReloj(){ 
                momentoActual = new Date() 
                hora = momentoActual.getHours() 
                minuto = momentoActual.getMinutes() 
                segundo = momentoActual.getSeconds() 

                horaImprimible = hora + " : " + minuto + " : " + segundo 

                //document.form_reloj.reloj.value = horaImprimible 
                $$("idTHora").setValue(horaImprimible);
                setTimeout("mueveReloj()",1000) 
            };
        </script>
    </body>
</html>

