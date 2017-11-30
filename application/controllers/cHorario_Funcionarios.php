<?php
class CHorario_Funcionarios extends CI_Controller {
    
    public function read(){
        $this->load->model('MHorario_Funcionarios');
        echo json_encode($this->MHorario_Funcionarios->mread());
    }

    public function crud(){
        $request = $_POST;
        // get id and data 
        $id = @$request['id'];
        $BI_Passaporte = @$request["BI_Passaporte"];
        //$Funcionarios_id = $request["Funcionarios_id"];
        $htNome = $request["htNome"];
        //webix_operation
        $webix_operation = $request["webix_operation"];

        $this->load->model('MHorario_Funcionarios');
        if ($webix_operation == "insert"){
            if($this->MHorario_Funcionarios->minsert($BI_Passaporte,$htNome))
                echo "true";
            else
                echo "false";
        } else if ($webix_operation == "update"){
            if($this->MHorario_Funcionarios->mupdate($id,$BI_Passaporte,$htNome))
                echo "true"; 
            else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MHorario_Funcionarios->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }
     
    function getHoraEntrada(){
        $request = $_POST;
        $bi = $request['bi'];
        //$bi = $this->input->get('bi');
        //$ses = $this->input->get('ses');
        /*DETERMINAR SESION A PARTIR DE LA HORA ACTUAL
        Manha 7:00:00 a 12:00:00
        Tarde 12:01:00 a 18:00:00
        Noite 18:01:00 a 23:00:00
        */
        $maha_i = "7:00:00"; $manha_f = "12:00:00";
        $tarde_i = "12:01:00"; $tarde_f = "18:00:00";
        $noite_i = "18:01:00"; $noite_f = "23:00:00";
        //HORA ACTUAL
        $hoy = getdate();
        $horaActual = $hoy['hours'].':'.$hoy['minutes'].':'.$hoy['seconds'];
        //DETERMINAR SESION
        $this->load->model('mTime');
        if($this->mTime->pertenece_sesion($horaActual,$maha_i,$manha_f))
            $ses = "01";
        elseif($this->mTime->pertenece_sesion($horaActual,$tarde_i,$tarde_f))
            $ses = "02";
        else
            $ses = "03";

        $this->load->model('mHorario_Funcionarios');
        echo $this->mHorario_Funcionarios->mgetHoraEntrada($bi,$ses);
    }

    function getHoraSaida(){
        
        $request = $_POST;
        $bi = @$request['bi'];
        //$bi = $this->input->get('bi');
        //$ses = $this->input->get('ses');
        /*DETERMINAR SESION A PARTIR DE LA HORA ACTUAL
        Manha 7:00:00 a 12:00:00
        Tarde 12:01:00 a 18:00:00
        Noite 18:01:00 a 23:00:00
        */
        $maha_i = "7:00:00"; $manha_f = "12:00:00";
        $tarde_i = "12:01:00"; $tarde_f = "18:00:00";
        $noite_i = "18:01:00"; $noite_f = "23:00:00";
        //HORA ACTUAL
        $hoy = getdate();
        $horaActual = $hoy['hours'].':'.$hoy['minutes'].':'.$hoy['seconds'];
        //DETERMINAR SESION
        $this->load->model('mTime');
        if($this->mTime->pertenece_sesion($horaActual,$maha_i,$manha_f))
            $ses = "01";
        elseif($this->mTime->pertenece_sesion($horaActual,$tarde_i,$tarde_f))
            $ses = "02";
        else
            $ses = "03";

        $this->load->model('mHorario_Funcionarios');
        echo $this->mHorario_Funcionarios->mgetHoraSaida($bi,$ses);
    }
    /*
    Determinar session
    */
    function dt_session_actual(){
         /*DETERMINAR SESION A PARTIR DE LA HORA ACTUAL
        Manha 7:00:00 a 12:00:00
        Tarde 12:01:00 a 18:00:00
        Noite 18:01:00 a 23:00:00
        */
        $maha_i = "7:00:00"; $manha_f = "12:00:00";
        $tarde_i = "12:01:00"; $tarde_f = "18:00:00";
        $noite_i = "18:01:00"; $noite_f = "23:00:00";
        //HORA ACTUAL
        $hoy = getdate();
        $horaActual = $hoy['hours'].':'.$hoy['minutes'].':'.$hoy['seconds'];
        //DETERMINAR SESION
        $this->load->model('mTime');
        if($this->mTime->pertenece_sesion($horaActual,$maha_i,$manha_f))
            return "1"; //id de la session las sesiones de trab no pueden ser configurables, son datos fijos en la bd
        elseif($this->mTime->pertenece_sesion($horaActual,$tarde_i,$tarde_f))
            return "2";
        else
            return "3";
    }
	/*
	Determinar estado segun la sesion
	*/
	function dtestado($bi,$s,$ha,$tipo_marca){
		$this->load->model('mTime');
		//ver cual es la hora de entrada y salida de esta session
		$this->load->model('mHorario_Funcionarios');
		$hora_entrada = $this->mHorario_Funcionarios->mgetHoraEntrada($bi,$s);
		$hora_saida = $this->mHorario_Funcionarios->mgetHoraSaida($bi,$s);

		if($tipo_marca == "Entrada"){
			if($this->mTime->menor_que($ha,$hora_entrada)){
				return "Entrada Puntual";
			}else{
				return "Entrada Tarde";
			}
		}elseif($tipo_marca == "Saida"){
			if($this->mTime->menor_que($ha,$hora_saida)){
				return "Saída Cedo";
			}else{
				return "Saída Puntual";
			}
		}
		//return 
	}
    /*
    Registrar marca actual
    */
    function registrar_marca(){
        $request = $_POST;
        $bi = @$request['bi'];

        $this->load->model('mFuncionarios');
        $fid = $this->mFuncionarios->mGetID2($bi);
        $this->load->model('mHorario_Funcionarios');
        if($fid /*&& $existe_horario_sessao*/){
            //ver si ya hoy existe una entrada sin salida en alguna session para marcar salida
            $hoy = getdate();
            $data = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
            $horaActual = $hoy['hours'].':'.$hoy['minutes'].':'.$hoy['seconds'];
            
            $Num_entrada_sin_salida = $this->mHorario_Funcionarios->mgetMarca_sin_Salida($data,$bi);
            //registrar salida
            if($Num_entrada_sin_salida != 0){ //es que existe una entrada sin salida
                $rfid = $Num_entrada_sin_salida;
                //determinar estado
				$session_registro_em_proceso = $this->mHorario_Funcionarios->mdt_Sessao_rfid($rfid);
                $sessionInt = (int)$session_registro_em_proceso; //convertir a int el valor de la sesion, sino el estado no funciona bien
                //echo $session_registro_em_proceso.'<br>'.$horaActual;
				$estado = $this->dtestado($bi,$sessionInt,$horaActual,"Saida");
                if($this->mHorario_Funcionarios->mActualizar_Marca($rfid,$horaActual,$estado)) //Registro_Funcionario.id ($rfid), bi y hora act para colocar como salida
                    echo "true";
                else
                    echo "false";
            }else{ //es que no existe una entrada incompleta
                //ver si para ese func queda una sesion sin marcar hoy
                // 1- Para marcar es necesario saber si el fun tiene un regimen en la sesion de la manha
                // 2- sino ver en la tarde y en la noche si existe un regimen
                // 3- sino es que el ya marco las sesiones que teni a que marcar y no tiene que marcar mas en el dia
                $encontro = false;
                for($i = 1;$i <= 3; $i++){ // $i seria la sesion, recorremos las 3 para saber en cual marcar
                    if($this->mHorario_Funcionarios->mExiste_Funcionario_SessaoXid($bi,$i)){ //si true significa que existe el funcionario en esta session, por tanto puede marcar
                        if($this->mHorario_Funcionarios->mgetMarca_completada($data,$bi,$i) == false){ //ver si existe alguna marca completada de alguna sesion hoy
							$estado = $this->dtestado($bi,$i,$horaActual,"Entrada");
                            if($this->mHorario_Funcionarios->mRegistrar_Marca($data,$i,$fid,$horaActual,$estado)){ // data, session actual, funcionario y hora para colocar en Entrada
                                $encontro = true;
                                echo "true";
                                break;
                            }
                        }
                    }
                }
                if($encontro == false)
                    echo "false"; 
            }
            
            //si no verificar en que session estamos, para registrar entrada en esa session
            //determinar estado
        }else
            echo "false";
    }
    function get_Ultimo_Estado(){
        $request = $_POST;
        $bi = $request['bi'];
        $this->load->model('mHorario_Funcionarios');
        echo $this->mHorario_Funcionarios->mget_ultimo_estado($bi);
    }
	//para testes
    function teste(){
        $this->load->model('mHorario_Funcionarios');
        $hoy = getdate();
    	$data = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
        //echo $this->mHorario_Funcionarios->mgetMarca_sin_Salida($data,"123");
		$horaActual = $hoy['hours'].':'.$hoy['minutes'].':'.$hoy['seconds'];
		
		$hora_entrada = $this->mHorario_Funcionarios->mgetHoraEntrada("123",1);
		//echo $hora_entrada;
		$estado = $this->dtestado("123",1,$horaActual,"Saida");
		//echo $estado;
        //echo $this->mHorario_Funcionarios->mgetHoraEntrada("123",1);

        //echo $this->mHorario_Funcionarios->mdt_Sessao_rfid("12");
        $Num_entrada_sin_salida = $this->mHorario_Funcionarios->mgetMarca_sin_Salida($data,"123");
        $ses = $this->mHorario_Funcionarios->mdt_Sessao_rfid($Num_entrada_sin_salida);
        $sesInt = (int)$ses;
        $estado = $this->dtestado("123",$sesInt,$horaActual,"Saida");
        echo $estado;
    }
}