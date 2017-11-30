<?php
  class MLogo extends CI_Model{

    var $logo_Documentos = "isced_logo.png"; // logo gesoft usado por default logoGeSoftv1.png
    var $logo_Documentos_height = "80"; // valor usado por default 60 desp ir probando para ahustar 
    var $logo_Documentos_width = "80";
    var $logo_Documentos_titulo = "INSTITUTO SUPERIOR DE CI&Ecirc;NCIAS DE EDUCA&Ccedil;&Atilde;O DO HUAMBO"; //titulo debajo del logotipo de los docs SIEMPRE MAYUSCULA
    var $logo_pie_firma = "Huambo";
    //ESCOLA SUPERIOR PEDAG&Oacute;GICA DO BI&Eacute;
    function mread_logo_documentos(){
        return $this->logo_Documentos;
    }
    //height="60" width="60"
    function mread_logo_documentos_height(){
        return $this->logo_Documentos_height;
    }
    function mread_logo_documentos_width(){
        return $this->logo_Documentos_width;
    }
    function mread_logo_documentos_titulo(){
        return $this->logo_Documentos_titulo;
    }
    function mread_logo_pie_firma(){
        return $this->logo_pie_firma;
    }

   /*   function mread(){
          $this->db->select('anos_lectivos.id,anos_lectivos.alAno');
          $this->db->from('anos_lectivos');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetID($Nome){
          $this->db->select('anos_lectivos.id');
          $this->db->from('anos_lectivos');
          $this->db->where('anos_lectivos.alAno', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      
      public function total(){
        $this->db->select('anos_lectivos.id');
          $this->db->from('anos_lectivos');
        return $this->db->count_all_results();
      }
      function mupdate($id,$alAno){
            $dados = array('alAno' => $alAno);
            if($this->db->update('anos_lectivos', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($alAno){
        if($this->db->insert('anos_lectivos', array('alAno' => $alAno)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('anos_lectivos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
   */    
           
  }
?>
