<?php
class MApple extends CI_Model{
	
	
	function mGetMAC(){
		$pedazo = explode('//',site_url());
        $ip = explode('/',$pedazo[1]);
        //echo $ip[0];
		// 		Execute the arp command and store the output in $arpTable
		$command = "arp -a ".$ip;
		
		$arpTable = shell_exec($command);
		
		// 		Split the output so every line is an entry of the $arpSplitted array
		$arpSplitted = split("\\n",$arpTable);
		
	}
	
	
	
	/*      function mGetID($Nome){          $this->db->select('anos_lectivos.id');          $this->db->from('anos_lectivos');          $this->db->where('anos_lectivos.alAno', $Nome);          $consulta = $this->db->get();          foreach($consulta->result() as $value) {              return $value->id;          }      }            public function total(){        $this->db->select('anos_lectivos.id');          $this->db->from('anos_lectivos');        return $this->db->count_all_results();      }      function mupdate($id,$alAno){            $dados = array('alAno' => $alAno);            if($this->db->update('anos_lectivos', $dados, array('id' => $id))){                return true;            }else                return false;      }          function minsert($alAno){        if($this->db->insert('anos_lectivos', array('alAno' => $alAno)))        {            return true;        }else{            return false;        }               }    function mdelete($id) {        if($this->db->delete('anos_lectivos', array('id' => $id)))              return true;        else            return false;            }      */
	
	
}

?>