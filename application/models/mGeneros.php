<?php
  class MGeneros extends CI_Model{
      
      var $gNome = '';
      var $gCodigo = '';
      
      function mread(){
          $this->db->select('Generos.id,Generos.gNome,Generos.gCodigo');
          $this->db->from('Generos');
          //$this->db->join('Grupos_Funcionarios', 'Categorias_Funcionarios.Grupos_Funcionarios_id = Grupos_Funcionarios.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
    
      function mGet_total_X_sexoID($id,$al,$n,$c,$p){
        $this->db->select('count(candidatos.id) as total');
        $this->db->from('candidatos');
        $this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.candidatos_id = candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        //$this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('anos_lectivos', 'candidatos.anos_lectivos_id = anos_lectivos.id');
        if($id)
            $this->db->where('candidatos.generos_id', $id);
        //$this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $al);
        $this->db->where('anos_lectivos.alano', $al);
        if($n)
            $this->db->where('niveis_cursos.niveis_id', $n);
        if($c)
            $this->db->where('niveis_cursos.cursos_id', $c);
        if($p)
            $this->db->where('niveis_cursos.periodos_id', $p);
        $consulta = $this->db->get();
        $data = array();
        foreach($consulta->result() as $row) {
            return $row->total;
        }
    }
    //para estatisticas
    function mestudantes_x_sexo($al,$n,$c,$p){
            $al = ($al != "")?$al:date('Y');
            $this->db->select('id, gNome, gCodigo');
            $this->db->from('Generos');
            //$this->db->join('Generos', 'candidatos.Generos_id = candidatos.id');
            $consulta = $this->db->get();
            $data = array();
            foreach($consulta->result() as $row) {
                if($row->gCodigo != 0){
                    $data[] = array(
                        "id" => $row->id,
                        "sexo"=> $row->gNome,
                        "quantidade" => $this->mGet_total_X_sexoID($row->id,$al,$n,$c,$p),
                        "color" => ($row->id == 2)?"#36abee":"#ee9e36",
                    );
                }
            }
            return $data;
    }

      function mGetID($Nome){
          $this->db->select('Generos.id');
          $this->db->from('Generos');
          $this->db->where('Generos.gNome', $Nome);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mGetIDXCodigo($Codigo){
          $this->db->select('Generos.id');
          $this->db->from('Generos');
          $this->db->where('Generos.gCodigo', $Codigo);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      public function totalGeneros(){
        $this->db->select('Generos.id');
          $this->db->from('Generos');
        return $this->db->count_all_results();
      }
      function mupdate($id,$Nome,$Codigo){
            $dadosGeneros = array('gNome' => $Nome,'gCodigo' => $Codigo);
            if($this->db->update('Generos', $dadosGeneros, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($Nome,$Codigo){
        if($this->db->insert('Generos', array('gNome' => $Nome,'gCodigo' => $Codigo)))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Generos', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
       
           
  }
?>
