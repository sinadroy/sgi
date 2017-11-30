<?php
class Cteste extends CI_Controller {
    
  /*  public function teste(){
        $apecCodigoBarra = "I290120170740";
        $this->load->model('MGerar_Codigo_Barra1');
        echo '<div align="center">'.$this->MGerar_Codigo_Barra1->criarCB($apecCodigoBarra).'</div>';
    }*/
    //<!-- <div align="center"><img align="center" border="0" height="30" width="150" src="data:image/png;base64,' . base64_encode($codigo_barra_generado) . '"></div> -->
    //<!-- <div align="center"><img align="center" border="0" height="30" width="150" src="data:image/png;base64,' . base64_encode($this->MGerar_Codigo_Barra->criarCB($apecCodigoBarra)) . '"></div> -->
    //<!-- <div align="center">' . $codigo_barra_generado . '</div> -->
    public function explorar(){
        $data = array();
        $directorio = opendir("./videos/"); //ruta actual
        //header("Access-Control-Allow-Origin", "*");
        //header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
        {
        /* if (is_dir($archivo))//verificamos si es o no un directorio
            {
                echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
            }
            else 
            {
                echo $archivo . "<br />";
            }
            */
            
            if (!is_dir($archivo))//verificamos si es o no un directorio
                //echo $archivo . "<br />";
                $data[] = array("title" => $archivo);
        }
        header("Access-Control-Allow-Origin: *");
        echo json_encode($data);
    }
}
?>