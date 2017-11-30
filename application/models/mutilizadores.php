<?php
class Mutilizadores extends CI_Model{
	
	
	//v	ar $id = '';
	
	var $uNome = '';
	
	var $uApelido = '';
	
	var $uTitulo = '';
	
	var $uEmail = '';
	
	var $uUsuario = '';
	
	var $uSenha = '';
	
	var $uProfessores_id = '';
	
	var $Niveis_Acessos_id = '';
	
	
	function _construct(){
		
		//p		arent::Model();
		
		//$		this->load->database();
		
	}
	
	function mvalidar($user, $pass){
		
		//$		this->db->where('nombre', $nombre);
		
		$consulta = $this->db->get_where('utilizadores',array('uUsuario' => $user,'uSenha' => $pass));
		
		//$		this->db->where('nombre', $nombre);
		
		$this->load->model('MAuditorias_Intranet');
		
		
		if($consulta->num_rows() > 0){
			
			$this->MAuditorias_Intranet->minsert("Login","Intranet","Login",$user,"Login com sucesso");
			
			return true;
			
		}
		
		else{
			
			$this->MAuditorias_Intranet->minsert("Login","Intranet","Login",$user,"Login sem sucesso");
			
			return false;
			
		}
		
	}
	
	function mvalidar_prof_pauta($user, $pass){
		
		//$		this->db->where('nombre', $nombre);
		
		$consulta = $this->db->get_where('utilizadores',array('uUsuario' => $user,'uSenha' => $pass));
		
		//$		this->db->where('nombre', $nombre);
		
		$this->load->model('MAuditorias_Intranet');
		
		
		if($consulta->num_rows() > 0){
			
			$this->MAuditorias_Intranet->minsert("Login","Intranet","Login",$user,"Login com sucesso");
			
			return true;
			
		}
		
		else{
			
			$this->MAuditorias_Intranet->minsert("Login","Intranet","Login",$user,"Login sem sucesso");
			
			return false;
			
		}
		
	}
	
	function mGet_ProfXUsuario($user){
		
		$this->db->select('utilizadores.uProfessores_id');
		
		$this->db->from('utilizadores');
		
		$this->db->where('uUsuario', $user);
		
		$consulta = $this->db->get();
		
		foreach($consulta->result() as $row){
			
			return $row->uProfessores_id;
			
		}
		
	}
	
	function mExiste_ProfXUsuario($user){
		
		$this->db->select('utilizadores.uProfessores_id');
		
		$this->db->from('utilizadores');
		
		$this->db->where('uUsuario', $user);
		
		$consulta = $this->db->get();
		
		foreach($consulta->result() as $value) {
			
			return $value->uProfessores_id;
			
		}
		
	}
	
	function mread(){
		
		$this->db->select('utilizadores.id,utilizadores.uNome,utilizadores.uApelido,utilizadores.uTitulo,utilizadores.uEmail,utilizadores.uUsuario, utilizadores.uSenha, utilizadores.uProfessores_id,              niveis_acessos.id as idna,niveis_acessos.naNome');
		
		$this->db->from('utilizadores');
		
		$this->db->join('niveis_acessos', 'utilizadores.Niveis_Acessos_id = niveis_acessos.id');
		
		$consulta = $this->db->get();
		
		return $consulta->result();
		
	}
	
	public function totalUsuarios(){
		
		$this->db->select('utilizadores.id,utilizadores.uNome,utilizadores.uApelido,utilizadores.uTitulo,utilizadores.uEmail,utilizadores.uUsuario, utilizadores.uSenha, utilizadores.uProfessores_id,              niveis_acessos.id as idna,niveis_acessos.naNome');
		
		$this->db->from('utilizadores');
		
		$this->db->join('niveis_acessos', 'utilizadores.Niveis_Acessos_id = niveis_acessos.id');
		
		return $this->db->count_all_results();
		
	}
	
	
	function mreadX($id){
		
		$this->db->select('utilizadores.id,utilizadores.uNome,utilizadores.uApelido,utilizadores.uTitulo,              utilizadores.uEmail,utilizadores.uUsuario, utilizadores.uSenha, utilizadores.uProfessores_id,              niveis_acessos.naNome');
		
		$this->db->from('utilizadores');
		
		$this->db->join('niveis_acessos', 'utilizadores.Niveis_Acessos_id = niveis_acessos.id');
		
		$this->db->where('utilizadores.id', $id);
		
		$consulta = $this->db->get();
		
		return $consulta->result();
		
	}
	
	
	function mreadusuarios(){
		
		$this->db->select('id,uusuario');
		
		$this->db->from('utilizadores');
		
		$consulta = $this->db->get();
		
		return $consulta->result();
		
	}
	
	
	function mGetID($Nome){
		
		$this->db->select('id');
		
		$this->db->from('utilizadores');
		
		$this->db->where('utilizadores.uUsuario', $Nome);
		
		$consulta = $this->db->get();
		
		foreach($consulta->result() as $value) {
			
			return $value->id;
			
		}
		
	}
	
	
	function mreadX2($id){
		
		$this->db->select('utilizadores.uUsuario');
		
		$this->db->from('utilizadores');
		
		//$		this->db->join('niveis_acessos', 'utilizadores.Niveis_Acessos_id = niveis_acessos.id');
		
		$this->db->where('utilizadores.id', $id);
		
		$consulta = $this->db->get();
		
		$Nome = "";
		
		foreach ($consulta->result() as $row) {
			
			$Nome = $row->uUsuario;
			
		}
		
		return $Nome;
		
	}
	
	
	/*Determinar se um usuario pertence ao nivel administradores*/
	
	function mreadAcesso($usuario){
		
		$this->db->select('niveis_acessos.naNome');
		
		$this->db->from('utilizadores');
		
		$this->db->join('niveis_acessos', 'utilizadores.Niveis_Acessos_id = niveis_acessos.id');
		
		$this->db->where('utilizadores.uUsuario', $usuario);
		
		$consulta = $this->db->get();
		
		$naNome = "";
		
		foreach ($consulta->result() as $row) {
			
			$naNome = $row->naNome;
			
		}
		
		return $naNome;
		
	}
	
	
	function mreadXnome($nome){
		
		$this->db->select('utilizadores.id');
		
		$this->db->from('utilizadores');
		
		//$		this->db->join('niveis_acessos', 'utilizadores.Niveis_Acessos_id = niveis_acessos.id');
		
		$this->db->where('utilizadores.uUsuario', $nome);
		
		$consulta = $this->db->get();
		
		$id = "";
		
		foreach ($consulta->result() as $row) {
			
			$id = $row->id;
			
		}
		
		return $id;
		
	}
	
	
	function mupdate($id,$uTitulo,$uNome,$uApelido,$uEmail,$uUsuario,$uSenha,$idnaNome,$uProfessores_id){
		
		//$		this->id   = $id;
		
		//i		f($passwd == $passwd2){
			
			
			/*            $this->uNome = $uNome;            $this->uApelido = $uApelido;            $this->uTitulo = $uTitulo;            $this->uEmail = $uEmail;            $this->uUsuario = $uUsuario;            $this->uSenha = $uSenha;//md5($uSenha);            */
			
			//$			senha= md5($uSenha);
			
			//$			this->uProfessores_id = $uProfessores_id;
			
			//$			this->Niveis_Acessos_id = $idnaNome;
			
			
			$arr = array('uNome' => $uNome, 'uApelido' => $uApelido,
			'uTitulo'=>$uTitulo, 'uEmail'=>$uEmail, 'uUsuario'=>$uUsuario,
			'uProfessores_id'=>$uProfessores_id, 'Niveis_Acessos_id'=>$idnaNome);
			
			
			if($this->db->update('utilizadores', $arr, array('id' => $id)))
			return true;
			
			else
			return false;
			
		}
		
		//u		pdate_senha
		function mupdate_senha($id,$uSenha){
			
			$uSenha = $uSenha;
			//m			d5($uSenha);
			
			if($this->db->update('utilizadores', array('uSenha' => $uSenha), array('id' => $id)))
			return true;
			
			else
			return false;
			
		}
		
		
		function minsert($uNome,$uApelido,$uTitulo,$uEmail,$uUsuario,$uSenha,$naNome,$uProfessores_id){
			
			//i			f($senha == $senha2){
				
				if($this->db->insert('utilizadores', array('uNome' => $uNome, 'uApelido' => $uApelido,
				'uTitulo'=>$uTitulo, 'uEmail'=>$uEmail, 'uUsuario'=>$uUsuario, 'uSenha'=>$uSenha,
				'uProfessores_id'=>$uProfessores_id, 'Niveis_Acessos_id'=>$naNome)))
				{
					
					return true;
					
				}
				
				else{
					
					return false;
					
				}
				
			}
			
			
			function mdelete($id) {
				
				if($this->db->delete('utilizadores', array('id' => $id)))  
				return true;
				
				else
				return false;
				
				
			}
			
			
		}
		
		?>