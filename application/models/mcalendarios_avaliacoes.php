<?php
  class Mcalendarios_avaliacoes extends CI_Model{
      
      function mread(){
          $this->db->select('calendario_avaliacoes.id,
                             ca_data_inicio,
                             ca_data_fim,
                             alAno,
                             ava_nome');
          $this->db->from('calendario_avaliacoes');
          $this->db->join('avaliacoes', 'calendario_avaliacoes.avaliacoes_id = avaliacoes.id');
          $this->db->join('anos_lectivos', 'calendario_avaliacoes.anos_lectivos_id = anos_lectivos.id');
          $consulta = $this->db->get();
          $ord=1;
          $data = array();
          $this->load->model('mDisciplinas_Duracao');
            foreach ($consulta->result() as $row) {
                $data[] = array(
                        "id" => $row->id,
                        "ord" => $ord,
                        "alAno" => $row->alAno,
                        "ca_data_inicio" => $row->ca_data_inicio,
                        "ca_data_fim" => $row->ca_data_fim,
                        "ava_nome" => $row->ava_nome,
                    );
                $ord++;
            }
            return $data;
      }
      //determinar si una data en un anho esta en un intervalo
      function mpertenece($data,$alAno,$ava_nome){
          //
          $data_inicio = '';
          $data_fin = '';
          $this->db->select('calendario_avaliacoes.id,ca_data_inicio,ca_data_fim,alAno,ava_nome');
          $this->db->from('calendario_avaliacoes');
          $this->db->join('avaliacoes', 'calendario_avaliacoes.avaliacoes_id = avaliacoes.id');
          $this->db->join('anos_lectivos', 'calendario_avaliacoes.anos_lectivos_id = anos_lectivos.id');
          $this->db->where('ava_nome', $ava_nome);
          $this->db->where('alAno', $alAno);
          $consulta = $this->db->get();
          foreach ($consulta->result() as $row) {
            $data_inicio = $row->ca_data_inicio;
            $data_fin = $row->ca_data_fim;
          }
          //echo $data.'<br>';
          //
          if($data_inicio != '' && $data_fin != ''){
            list($a, $m, $d) = preg_split('[-]', $data);
            list($anoi, $mesi, $diai) = preg_split('[-]', $data_inicio);
            list($anof, $mesf, $diaf) = preg_split('[-]', $data_fin);
            $data = mktime(0, 0, 0, $m, $d, $a);
            //echo $data.'<br>';
            $ri = mktime(0 ,0 ,0 ,$mesi ,$diai , $anoi);
            //echo $ri.'<br>';
            $rf = mktime(0 ,0 ,0 ,$mesf ,$diaf ,$anof);
            //echo $rf.'<br>';
            if($data >= $ri && $data <= $rf)
                return true;
            else
                return false;
          }else
            return false;
        }
      
      function mupdate($id,$alAno,$ca_data_inicio,$ca_data_fim,$ava_nome){
            if(!is_numeric($ava_nome)){
                $this->load->model('Mcalendarios_tipo_avaliacoes');
                $ava_nome = $this->Mcalendarios_tipo_avaliacoes->mGetID($ava_nome);
            }
            $this->load->model('manos_lectivos');
            $alAno = $this->manos_lectivos->mGetID($alAno);
            $dados = array('anos_lectivos_id' => $alAno,'ca_data_inicio' => $ca_data_inicio,'ca_data_fim' => $ca_data_fim,'avaliacoes_id' => $ava_nome);
            if($this->db->update('calendario_avaliacoes', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      
    function minsert($alAno,$ca_data_inicio,$ca_data_fim,$ava_nome){
        $dados = array('anos_lectivos_id' => $alAno,'ca_data_inicio' => $ca_data_inicio,'ca_data_fim' => $ca_data_fim,'avaliacoes_id' => $ava_nome);
        if($this->db->insert('calendario_avaliacoes', $dados))
        {
            return true;
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('calendario_avaliacoes', array('id' => $id)))  
            return true;
        else
            return false;
        
    }       
  }
?>
