<?php
class Cutilizadores extends CI_Controller {
    
    public function getid(){
        $user = $this->input->post('login');
        $this->load->model('mutilizadores');
        echo $this->mutilizadores->mGetID($user);
    }

    public function validar() {
            $user = $this->input->post('login');
            $password = $this->input->post('senha');
            //validar
            $passwordMD5 = md5($password);
            $this->load->model('mutilizadores');        
            $val = $this->mutilizadores->mvalidar($user, $passwordMD5);
            if($val)
            {
                $newdata = array(
                    //'session_id'    => random hash,
                    'username'  => $user,
                    'idusuario' => $user,
                    //'web_dir' => base_url(),
                    //'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
                echo "true";
                //redirect(base_url().'welcome/principal');
            }else
            {
                echo "false";
            }
    }
    
    public function validar_prof_pauta() {
            $user = $this->input->post('login');
            $password = $this->input->post('senha');
            //validar
            $passwordMD5 = md5($password);
            $this->load->model('mutilizadores');        
            $val = $this->mutilizadores->mvalidar_prof_pauta($user, $passwordMD5);
            if($val)
            {
                $newdata = array(
                    //'session_id'    => random hash,
                    'username'  => $user,
                    'idusuario' => $user,
                    //'web_dir' => base_url(),
                    //'logged_in' => TRUE
                );
                $this->session->set_userdata($newdata);
                echo "true";
                //redirect(base_url().'welcome/principal');
            }else
            {
                echo "false";
            }
    }
    
    public function read(){
        $this->load->model('mutilizadores');
        $this->load->model('mfuncionarios');
        $ord = 1;
        foreach($this->mutilizadores->mread() as $row){
            
            $al[] = array(
                    "ord"=>$ord,
                    "id"=>$row->id,
                    "uNome"=>$row->uNome,
                    "uApelido"=>$row->uApelido,
                    "uTitulo"=>($row->uTitulo==1)?"Sr.":"Sra.",
                    "uEmail"=>$row->uEmail,
                    "uUsuario"=>$row->uUsuario,
                    "value"=>$row->uUsuario,
                    "uSenha"=>$row->uSenha,
                    "uProfessores_id"=>$row->uProfessores_id,
                    "idna"=>$row->idna,
                    "naNome"=>$row->naNome,
                    "p_nome_completo"=>($this->mfuncionarios->mGetNomeApelido($row->uProfessores_id))?$this->mfuncionarios->mGetNomeApelido($row->uProfessores_id):'-'
            );
            $ord++;
        }
            $total = count($al);
            $data = json_encode($al);
            $response = $data;
        
        echo $response;
    }
    //para saber id_prof por usuario para cargar pauta de professor em login
    public function Get_ProfXUsuario(){
        $user = $this->input->post('login');
        $this->load->model('mutilizadores');
        echo $this->mutilizadores->mGet_ProfXUsuario($user);
    }

    //ver si existe um professor en la tabla usuarios
    public function Existe_ProfXUsuario(){
        $user = $this->input->post('login');
        $this->load->model('mutilizadores');
        if(strlen($this->mutilizadores->mExiste_ProfXUsuario($user))>0)
            echo "true";
        else
            echo "false";
    }

    public function readusuarios(){
        $this->load->model('mutilizadores');
        foreach($this->mutilizadores->mreadusuarios() as $row){
            $al[] = array(
                    "id"=>$row->id,
                    "uusuario"=>$row->uusuario,
                    "value"=>$row->uusuario,
            );
        }
        $total = count($al);
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function readAcesso(){
        $request = $_POST;
        $usuario = $request["usuario"];
        $this->load->model('mutilizadores');
        echo $this->mutilizadores->mreadAcesso($usuario);
    }

    public function readX2(){
        $request = $_POST;
        $id = $request['id'];
        $this->load->model('mutilizadores');
        echo $this->mutilizadores->mreadX2($id);
    }
    public function readIDXnome(){
            $request = $_POST;
            $nome = $request['nome'];
            $this->load->model('mutilizadores');
            echo $this->mutilizadores->mreadXnome($nome);
    }
    
    public function delete(){
        $id = $this->input->post('id');
        if($id !== "")
        {
            $this->load->model('mutilizadores');
            if($this->mutilizadores->mdelete($id))
                echo "true"; 
            else
               echo "false";           
        }
    }
    
    public function update(){                       
            $id = $this->input->post('id');
            $uTitulo = ($this->input->post('uTitulo')=="Sr.")?1:2;
            $uNome = $this->input->post('uNome');
            $uApelido = $this->input->post('uApelido');
            $uEmail = $this->input->post('uEmail');
            $uUsuario = $this->input->post('uUsuario');
            $uSenha = $this->input->post('uSenha');
            $passwordMD5 = md5($uSenha);
            $naNome_envio = $this->input->post('naNome');
            $professores_id = $this->input->post('p_nome_completo');
            $this->load->model('mNiveisAcesso');
            if(is_numeric($naNome_envio))
                $naNome = $naNome_envio;
            else
                $naNome = $this->mNiveisAcesso->getID($naNome_envio);
            $this->load->model('mutilizadores');
            if($this->mutilizadores->mupdate($id,$uTitulo,$uNome,$uApelido,$uEmail,$uUsuario,$passwordMD5,$naNome,$professores_id))
                echo "true"; 
            else
               echo "false";
    }
    public function update_senha(){                       
            $id = $this->input->post('id');
            $uSenha = $this->input->post('uSenha');
            $passwordMD5 = md5($uSenha);
            
            $this->load->model('mutilizadores');
            if($this->mutilizadores->mupdate_senha($id,$passwordMD5))
                echo "true"; 
            else
               echo "false";
    }
        
        public function insert(){
           $uNome = $this->input->post('uNome');
           $uApelido = $this->input->post('uApelido');
           $uTitulo = $this->input->post('uTitulo');
           $uEmail = $this->input->post('uEmail');
           $uUsuario = $this->input->post('uUsuario');
           $uSenha = $this->input->post('uSenha');
           $passwordMD5 = md5($uSenha);
           $naNome = $this->input->post('naNome');
           $uProfessores_id = $this->input->post('p_nome_completo');
            
           $this->load->model('mutilizadores');
           if($this->mutilizadores->minsert($uNome,$uApelido,$uTitulo,$uEmail,$uUsuario,$passwordMD5,$naNome,$uProfessores_id))
               echo "true";
           else
               echo "false";
        }

        //teste
        public function readXnome(){
            $request = $_GET;
            $nome = $request['nome'];
            $this->load->model('mutilizadores');
            echo $this->mutilizadores->mreadXnome($nome);
        }
    
}
?>