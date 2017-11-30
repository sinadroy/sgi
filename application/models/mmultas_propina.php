<?php
  class Mmultas_propina extends CI_Model{
      
      function mread(){
          $this->db->select('multas_propina.id,multas_propina.mp_data_inicio,multas_propina.mp_data_fin,multas_propina.mp_porciento,
            meses_propina.mesnome');
          $this->db->from('multas_propina');
          $this->db->join('meses_propina', 'multas_propina.meses_propina_id = meses_propina.id');
          $consulta = $this->db->get();
          $data = array();
            foreach ($consulta->result() as $row) {
                    $data[] = array(
                        "id" => $row->id,
                        "mp_data_inicio" => $row->mp_data_inicio,
                        "mp_data_fin" => $row->mp_data_fin,
                        "mp_porciento" => $row->mp_porciento,
                        "mesnome" => $row->mesnome
                    );
            }
            return $data;
      }

      function mreadIdXMes($mesNome){
          $this->db->select('multas_propina.id');
          $this->db->from('multas_propina');
          $this->db->join('meses_propina', 'multas_propina.meses_propina_id = meses_propina.id');
          $this->db->where('meses_propina.mesnome', $mesNome);
          $consulta = $this->db->get();
          foreach ($consulta->result() as $row) {
            return $row->id;
          }
      }
      //determinar si una data esta en el intervalo pasado
      function pertenece_intervalo_data($data,$data_inicio,$data_fin){

        list($a, $m, $d) = preg_split('[-]', $data);
        list($anoi, $mesi, $diai) = preg_split('[-]', $data_inicio);
        list($anof, $mesf, $diaf) = preg_split('[-]', $data_fin);

        $data = mktime(0, 0, 0, $m, $d, $a);
        $ri = mktime(0 ,0 ,0 ,$mesi ,$diai , $anoi);
        $rf = mktime(0 ,0 ,0 ,$mesf ,$diaf ,$anof);
        if($data >= $ri && $data <= $rf)
            return true;
        else
            return false;
      }
      //determinar para una fecha cual es el porciento de multa a pagar
      function mread_porciento($mes_a_pagar, $ano_a_pagar){
          $date_now = date('Y-m-d');

          $this->db->select('multas_propina.id, mp_porciento, mp_data_inicio, mp_data_fin');
          $this->db->from('multas_propina');
          $this->db->join('meses_propina', 'multas_propina.meses_propina_id = meses_propina.id');
          $this->db->where('meses_propina.mesnome', $mes_a_pagar);
          $consulta = $this->db->get();
          $intervalo_encontrado = 0;
          $pc = 0;
          foreach ($consulta->result() as $row) {
            if($this->pertenece_intervalo_data($date_now,$row->mp_data_inicio,$row->mp_data_fin)){
                $intervalo_encontrado++;
                //echo $intervalo_encontrado.'<br>';
                $pc = $row->mp_porciento;
                break;
            }
          }
          //convertir a numero el mes a pagar
          $this->load->model('MFormato_Mes');
          $mes_a_pagar_num = $this->MFormato_Mes->dtMesNumero($mes_a_pagar);
          //sino pertenece a ningun intervalo, verificar si es menor o mayor el mes de la data act al que se esta pagando
          //if($intervalo_encontrado == 0){ 
              if((date('m') > $mes_a_pagar_num && date('Y') >= $ano_a_pagar) || (date('m') < $mes_a_pagar_num && date('Y') > $ano_a_pagar)) //si el mes act es mayor que mes a pag y 
                $pc = 100;
              //else
                //$pc = 0;
          //}
          if(date('m') < $mes_a_pagar_num && date('Y') <= $ano_a_pagar)
            $pc = 0;
          return $pc;
      }

      function mupdate($id,$mp_data_inicio,$mp_data_fin,$mp_porciento,$meses_propina_id){
            $dados = array('mp_data_inicio'=>$mp_data_inicio, 'mp_data_fin'=>$mp_data_fin, 'mp_porciento'=>$mp_porciento,
                'meses_propina_id'=>$meses_propina_id);
            if($this->db->update('multas_propina', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      } 

      function minsert($mp_data_inicio,$mp_data_fin,$mp_porciento,$meses_propina_id){
        $dados = array('mp_data_inicio'=>$mp_data_inicio,'mp_data_fin'=>$mp_data_fin,'mp_porciento'=>$mp_porciento, 'meses_propina_id'=>$meses_propina_id);
        if($this->db->insert('multas_propina', $dados))
        {
            return true;
        }else{
            return false;
        }
           
    }
    
    function mdelete($id) {
        if($this->db->delete('multas_propina', array('id' => $id)))  
            return true;
        else
            return false; 
    }     
           
  }
