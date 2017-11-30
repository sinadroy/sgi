<?php
class MCandidatos extends CI_Model {

    function mGet_telXCandidato_id($id){
          $this->db->select('cTelefone');
          $this->db->from('Candidatos');
          $this->db->where('id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->cTelefone;
          }
      }
      function mGet_emailXCandidato_id($id){
          $this->db->select('cEmail');
          $this->db->from('Candidatos');
          $this->db->where('id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->cEmail;
          }
      }

    //calcular edad por la fecha de nacimiento
    function calculaEdad($dataN) {
        $date2 = date('Y-m-d'); //
        $diff = abs(strtotime($date2) - strtotime($dataN)); //'1999-11-04'
        $years = floor($diff / (365 * 60 * 60 * 24));
        //$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        //$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        return $years;
    }
    
    /*
     * Obtener provincia de emissao apartir del ID
     */
    function obtProvinciaXid($id){
        $this->db->select('Provincias.id,Provincias.provNome');
        $this->db->from('Provincias');
        $this->db->where('id', $id);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->provNome;
        }
    }
    function obtPaisFormacaoXid($cid){
        $this->db->select('paNome');
        $this->db->from('Pais');
        $this->db->join('Dados_Academicos_Candidatos', 'Dados_Academicos_Candidatos.Formacao_Pais_id = Pais.id');
        $this->db->where('Dados_Academicos_Candidatos.Candidatos_id', $cid);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->paNome;
        }
    }
    function obtProvFormacaoXid($cid){
        $this->db->select('Provincias.provNome');
        $this->db->from('Provincias');
        $this->db->join('Dados_Academicos_Candidatos', 'Dados_Academicos_Candidatos.Formacao_Provincias_id = Provincias.id');
        $this->db->where('Dados_Academicos_Candidatos.Candidatos_id', $cid);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->provNome;
        }
    }
    function obtProvXid($cid){
        $this->db->select('Provincias.provNome');
        $this->db->from('Provincias');
        $this->db->join('Endereco_Candidatos', 'Endereco_Candidatos.Provincias_id = Provincias.id');
        $this->db->where('Endereco_Candidatos.Candidatos_id', $cid);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->provNome;
        }
    }
    function obtPaXid($cid){
        $this->db->select('Pais.paNome');
        $this->db->from('Provincias');
        $this->db->join('Endereco_Candidatos', 'Endereco_Candidatos.Pais_id = Pais.id');
        $this->db->where('Endereco_Candidatos.Candidatos_id', $cid);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->paNome;
        }
    }
    function obtMunXid($cid){
        $this->db->select('Municipios.munNome');
        $this->db->from('Municipios');
        $this->db->join('Endereco_Candidatos', 'Endereco_Candidatos.Municipios_id = Municipios.id');
        $this->db->where('Endereco_Candidatos.Candidatos_id', $cid);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->munNome;
        }
    }

    function mread_total(){
        $this->db->select('id');
        $this->db->from('Candidatos');
        return $this->db->count_all_results();
    }

    /*
rtar todos los datos de candidatos
    */
function mreadto_Excel() {
	$this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cData_Nascimento,
                Candidatos.Nascimento_Provincias_id,Provincias.provNome as provNascimento,
                Candidatos.Nascimento_Municipios_id,Municipios.munNome as munNascimento,
                Candidatos.cNome_Pai,Candidatos.cNome_Mae,
                Candidatos.cBI_Passaporte,Candidatos.cBI_Data_Emissao,Candidatos.cBI_Lugar_Emissao_Provincia_id,
                Candidatos.Estado_Civil_id,Estado_Civil.ecNome,
                Candidatos.cTelefone,Candidatos.cEmail,
                Candidatos.Generos_id,Generos.gNome,
                Candidatos.Trabalhador_id,Trabalhador.trabNome,
                Candidatos.Profissao_id,Profissao.proNome,
                Candidatos.Nacionalidades_Geral_id,Nacionalidades_Geral.ngNome,
                Candidatos.Necessita_Educacao_Especial_id,Necessita_Educacao_Especial.neeNome,
                
                Tipo_Instituicao_Laboral.tilNome,
                Organismos_Tutela.otNome,
                Dados_Laborais.dlLocal_Trabalho, Dados_Laborais.dlCargo,
                
                Dados_Academicos_Candidatos.Habilitacoes_Literarias_Candidatos_id, Habilitacoes_Literarias_Candidatos.hlfNome,
                Opcao.opcNome,
                Dados_Academicos_Candidatos.Ano,Dados_Academicos_Candidatos.Media,
                Escola_Formacao.efNome,

                Endereco_Candidatos.Pais_id, Pais.paNome,
                
                Endereco_Candidatos.Bairros_id, Bairros.baiNome,

                niveis.nNome, cursos.cNome as curso, periodos.pNome');
	    $this->db->from('Candidatos');

        $this->db->join('Provincias', 'Candidatos.Nascimento_Provincias_id = Provincias.id');
        $this->db->join('Municipios', 'Candidatos.Nascimento_Municipios_id = Municipios.id');
        $this->db->join('Estado_Civil', 'Candidatos.Estado_Civil_id = Estado_Civil.id');
        $this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
        $this->db->join('Trabalhador', 'Candidatos.Trabalhador_id = Trabalhador.id');
        $this->db->join('Profissao', 'Candidatos.Profissao_id = Profissao.id');
        $this->db->join('Nacionalidades_Geral', 'Candidatos.Nacionalidades_Geral_id = Nacionalidades_Geral.id');
        $this->db->join('Necessita_Educacao_Especial', 'Candidatos.Necessita_Educacao_Especial_id = Necessita_Educacao_Especial.id');
        //DPRO
        //$this->db->join('Trabalhador', 'Candidatos.Trabalhador_id = Trabalhador.id');
        //$this->db->join('Profissao', 'Candidatos.Profissao_id = Profissao.id');
        $this->db->join('Dados_Laborais', 'Candidatos.id = Dados_Laborais.Candidatos_id');
        $this->db->join('Tipo_Instituicao_Laboral', 'Tipo_Instituicao_Laboral.id = Dados_Laborais.Tipo_Instituicao_Laboral_id');
        $this->db->join('Organismos_Tutela', 'Organismos_Tutela.id = Dados_Laborais.Organismos_Tutela_id');
        //DACA
        $this->db->join('Dados_Academicos_Candidatos', 'Dados_Academicos_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Habilitacoes_Literarias_Candidatos', 'Dados_Academicos_Candidatos.Habilitacoes_Literarias_Candidatos_id = Habilitacoes_Literarias_Candidatos.id');
        //$this->db->join('Pais', 'Dados_Academicos_Candidatos.Formacao_Pais_id = Pais.id');
        //determinar con una funcion
        //$this->db->join('Provincias', 'Dados_Academicos_Candidatos.Formacao_Provincias_id = Provincias.id');
        $this->db->join('Escola_Formacao','Dados_Academicos_Candidatos.Escola_Formacao_id = Escola_Formacao.id');
        $this->db->join('Opcao','Dados_Academicos_Candidatos.Opcao_id = Opcao.id');
        //DLOC
        $this->db->join('Endereco_Candidatos', 'Endereco_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Bairros', 'Endereco_Candidatos.Bairros_id = Bairros.id');
        //$this->db->join('Municipios', 'Endereco_Candidatos.Municipios_id = Municipios.id');
        $this->db->join('Pais', 'Endereco_Candidatos.Pais_id = Pais.id');
        //$this->db->join('Provincias', 'Endereco_Candidatos.Provincias_id = Provincias.id');

        $this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
	
	$this->db->order_by('cNome','ASC');
	$consulta = $this->db->get();
	$ord=1;
	$data = array();
	foreach ($consulta->result() as $row) {
		$data[] = array(
			"id" => $row->id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cData_Nascimento" => $row->cData_Nascimento,
                "cIdade" => $this->calculaEdad($row->cData_Nascimento),
                "Nascimento_Provincias_id" => $row->Nascimento_Provincias_id,
                "provNascimento" => $row->provNascimento,
                "Nascimento_Municipios_id" => $row->Nascimento_Municipios_id,
                "munNascimento" => $row->munNascimento,
                "cNome_Pai" => $row->cNome_Pai,
                "cNome_Mae" => $row->cNome_Mae,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cBI_Data_Emissao" => $row->cBI_Data_Emissao,
                "cBI_Lugar_Emissao_Provincia_id" => $row->cBI_Lugar_Emissao_Provincia_id,
                "provEmissao" => $this->obtProvinciaXid($row->cBI_Lugar_Emissao_Provincia_id),
                "Estado_Civil_id" => $row->Estado_Civil_id,
                "ecNome" => $row->ecNome,
                "cTelefone" => $row->cTelefone,
                "cEmail" => $row->cEmail,
                "Generos_id" => $row->Generos_id,
                "gNome" => $row->gNome,
                "Nacionalidades_Geral_id" => $row->Nacionalidades_Geral_id,
                "ngNome" => $row->ngNome,
                "Necessita_Educacao_Especial_id" => $row->Necessita_Educacao_Especial_id,
                "neeNome" => $row->neeNome,
                //DPRO
                "proNome" => $row->proNome,
                "trabNome" => $row->trabNome,
                "tilNome" => $row->tilNome,
                "otNome" => $row->otNome,
                "dlLocal_Trabalho" => $row->dlLocal_Trabalho,
                "dlCargo" => $row->dlCargo,
                //DACA
                "hlfNome" => $row->hlfNome,
                "opcNome" => $row->opcNome,
                "efNome" => $row->efNome,
                "Ano" => $row->Ano,
                "Media" => $row->Media,
                "paFormacao" => $this->obtPaisFormacaoXid($row->id),
                "provFormacao" => $this->obtProvFormacaoXid($row->id),
                //DLOC
                "paNome" => $row->paNome,//$this->obtPaXid($row->id),
                "provNome" => $this->obtProvXid($row->id),
                "munNome" => $this->obtMunXid($row->id),
                "baiNome" => $row->baiNome,
		
		    "nNome" => $row->nNome,
		    "curso" => $row->curso,
		    "pNome" => $row->pNome,
		);
		$ord++;
	}
	return $data;
}

function mreadto_Excel2() {
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cData_Nascimento,
                Candidatos.Nascimento_Provincias_id,Provincias.provNome as provNascimento,
                Candidatos.Nascimento_Municipios_id,Municipios.munNome as munNascimento,
                Candidatos.cNome_Pai,Candidatos.cNome_Mae,
                Candidatos.cBI_Passaporte,Candidatos.cBI_Data_Emissao,Candidatos.cBI_Lugar_Emissao_Provincia_id,
                Candidatos.Estado_Civil_id,Estado_Civil.ecNome,
                Candidatos.cTelefone,Candidatos.cEmail,
                Candidatos.Generos_id,Generos.gNome,
                Candidatos.Trabalhador_id,Trabalhador.trabNome,
                Candidatos.Profissao_id,Profissao.proNome,
                Candidatos.Nacionalidades_Geral_id,Nacionalidades_Geral.ngNome,
                Candidatos.Necessita_Educacao_Especial_id,Necessita_Educacao_Especial.neeNome,
                
                Tipo_Instituicao_Laboral.tilNome,
                Organismos_Tutela.otNome,
                Dados_Laborais.dlLocal_Trabalho, Dados_Laborais.dlCargo,
                
                Dados_Academicos_Candidatos.Habilitacoes_Literarias_Candidatos_id, Habilitacoes_Literarias_Candidatos.hlfNome,
                Opcao.opcNome,
                Dados_Academicos_Candidatos.Ano,Dados_Academicos_Candidatos.Media,
                Escola_Formacao.efNome,

                Endereco_Candidatos.Pais_id, Pais.paNome,
                
                Endereco_Candidatos.Bairros_id, Bairros.baiNome');
                //Endereco_Candidatos.Provincias_id, Provincias.provNome,
                //Endereco_Candidatos.Municipios_id, Municipios.munNome,
                //Dados_Academicos_Candidatos.Formacao_Pais_id, Pais.paNome as paFormacao,
                //Dados_Academicos_Candidatos.Formacao_Provincias_id,Provincias.provNome as provFormacao
        $this->db->from('Candidatos');
        $this->db->join('Provincias', 'Candidatos.Nascimento_Provincias_id = Provincias.id');
        $this->db->join('Municipios', 'Candidatos.Nascimento_Municipios_id = Municipios.id');
        $this->db->join('Estado_Civil', 'Candidatos.Estado_Civil_id = Estado_Civil.id');
        $this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
        $this->db->join('Trabalhador', 'Candidatos.Trabalhador_id = Trabalhador.id');
        $this->db->join('Profissao', 'Candidatos.Profissao_id = Profissao.id');
        $this->db->join('Nacionalidades_Geral', 'Candidatos.Nacionalidades_Geral_id = Nacionalidades_Geral.id');
        $this->db->join('Necessita_Educacao_Especial', 'Candidatos.Necessita_Educacao_Especial_id = Necessita_Educacao_Especial.id');
        //DPRO
        //$this->db->join('Trabalhador', 'Candidatos.Trabalhador_id = Trabalhador.id');
        //$this->db->join('Profissao', 'Candidatos.Profissao_id = Profissao.id');
        $this->db->join('Dados_Laborais', 'Candidatos.id = Dados_Laborais.Candidatos_id');
        $this->db->join('Tipo_Instituicao_Laboral', 'Tipo_Instituicao_Laboral.id = Dados_Laborais.Tipo_Instituicao_Laboral_id');
        $this->db->join('Organismos_Tutela', 'Organismos_Tutela.id = Dados_Laborais.Organismos_Tutela_id');
        //DACA
        $this->db->join('Dados_Academicos_Candidatos', 'Dados_Academicos_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Habilitacoes_Literarias_Candidatos', 'Dados_Academicos_Candidatos.Habilitacoes_Literarias_Candidatos_id = Habilitacoes_Literarias_Candidatos.id');
        //$this->db->join('Pais', 'Dados_Academicos_Candidatos.Formacao_Pais_id = Pais.id');
        //determinar con una funcion
        //$this->db->join('Provincias', 'Dados_Academicos_Candidatos.Formacao_Provincias_id = Provincias.id');
        $this->db->join('Escola_Formacao','Dados_Academicos_Candidatos.Escola_Formacao_id = Escola_Formacao.id');
        $this->db->join('Opcao','Dados_Academicos_Candidatos.Opcao_id = Opcao.id');
        //DLOC
        $this->db->join('Endereco_Candidatos', 'Endereco_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Bairros', 'Endereco_Candidatos.Bairros_id = Bairros.id');
        //$this->db->join('Municipios', 'Endereco_Candidatos.Municipios_id = Municipios.id');
        $this->db->join('Pais', 'Endereco_Candidatos.Pais_id = Pais.id');
        //$this->db->join('Provincias', 'Endereco_Candidatos.Provincias_id = Provincias.id');

        $this->db->order_by('cNome','ASC');
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cData_Nascimento" => $row->cData_Nascimento,
                "cIdade" => $this->calculaEdad($row->cData_Nascimento),
                "Nascimento_Provincias_id" => $row->Nascimento_Provincias_id,
                "provNascimento" => $row->provNascimento,
                "Nascimento_Municipios_id" => $row->Nascimento_Municipios_id,
                "munNascimento" => $row->munNascimento,
                "cNome_Pai" => $row->cNome_Pai,
                "cNome_Mae" => $row->cNome_Mae,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cBI_Data_Emissao" => $row->cBI_Data_Emissao,
                "cBI_Lugar_Emissao_Provincia_id" => $row->cBI_Lugar_Emissao_Provincia_id,
                "provEmissao" => $this->obtProvinciaXid($row->cBI_Lugar_Emissao_Provincia_id),
                "Estado_Civil_id" => $row->Estado_Civil_id,
                "ecNome" => $row->ecNome,
                "cTelefone" => $row->cTelefone,
                "cEmail" => $row->cEmail,
                "Generos_id" => $row->Generos_id,
                "gNome" => $row->gNome,
                "Nacionalidades_Geral_id" => $row->Nacionalidades_Geral_id,
                "ngNome" => $row->ngNome,
                "Necessita_Educacao_Especial_id" => $row->Necessita_Educacao_Especial_id,
                "neeNome" => $row->neeNome,
                //DPRO
                "proNome" => $row->proNome,
                "trabNome" => $row->trabNome,
                "tilNome" => $row->tilNome,
                "otNome" => $row->otNome,
                "dlLocal_Trabalho" => $row->dlLocal_Trabalho,
                "dlCargo" => $row->dlCargo,
                //DACA
                "hlfNome" => $row->hlfNome,
                "opcNome" => $row->opcNome,
                "efNome" => $row->efNome,
                "Ano" => $row->Ano,
                "Media" => $row->Media,
                "paFormacao" => $this->obtPaisFormacaoXid($row->id),
                "provFormacao" => $this->obtProvFormacaoXid($row->id),
                //DLOC
                "paNome" => $row->paNome,//$this->obtPaXid($row->id),
                "provNome" => $this->obtProvXid($row->id),
                "munNome" => $this->obtMunXid($row->id),
                "baiNome" => $row->baiNome
            );
            $ord++;
        }
        return $data;
    }

    /*
     * Datos Personales
    */
    function mreadDP($al,$i,$l) {
        $this->load->model('mestudantes');
        $this->load->model('manos_lectivos');
        $al = $this->manos_lectivos->mGetID($al);
        $ala = $this->manos_lectivos->mGetID(date('Y'));
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cData_Nascimento,
                Candidatos.Nascimento_Provincias_id,Provincias.provNome as provNascimento,
                Candidatos.Nascimento_Municipios_id,Municipios.munNome as munNascimento,
                Candidatos.cNome_Pai,Candidatos.cNome_Mae,
                Candidatos.cBI_Passaporte,Candidatos.cBI_Data_Emissao,Candidatos.cBI_Lugar_Emissao_Provincia_id,
                Candidatos.Estado_Civil_id,Estado_Civil.ecNome,
                Candidatos.cTelefone,Candidatos.cEmail,
                Candidatos.Generos_id,Generos.gNome,
                Candidatos.Trabalhador_id,Trabalhador.trabNome,
                Candidatos.Profissao_id,Profissao.proNome,
                Candidatos.Nacionalidades_Geral_id,Nacionalidades_Geral.ngNome,
                Candidatos.Necessita_Educacao_Especial_id,Necessita_Educacao_Especial.neeNome');
        $this->db->from('Candidatos');
        $this->db->join('Provincias', 'Candidatos.Nascimento_Provincias_id = Provincias.id');
        $this->db->join('Municipios', 'Candidatos.Nascimento_Municipios_id = Municipios.id');
        $this->db->join('Estado_Civil', 'Candidatos.Estado_Civil_id = Estado_Civil.id');
        $this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
        $this->db->join('Trabalhador', 'Candidatos.Trabalhador_id = Trabalhador.id');
        $this->db->join('Profissao', 'Candidatos.Profissao_id = Profissao.id');
        $this->db->join('Nacionalidades_Geral', 'Candidatos.Nacionalidades_Geral_id = Nacionalidades_Geral.id');
        $this->db->join('Necessita_Educacao_Especial', 'Candidatos.Necessita_Educacao_Especial_id = Necessita_Educacao_Especial.id');
        if($al)
            $this->db->where('Candidatos.Anos_Lectivos_id', $al);
        else
            $this->db->where('Candidatos.Anos_Lectivos_id', $ala);
        
        $this->db->order_by('cNome,cApelido','ASC');
        $this->db->limit($l, $i);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            //ver si es estudiante para no cargarlo en inscriccion
            if(!$this->mestudantes->existe_bi($row->cBI_Passaporte)){
                //$data[] = $row;
                $data[] = array(
                    "id" => $row->id,
                    "ord" => $ord,
                    "cNome" => $row->cNome,
                    "cNomes" => $row->cNomes,
                    "cApelido" => $row->cApelido,
                    
                    "cData_Nascimento" => $row->cData_Nascimento,
                    "cIdade" => $this->calculaEdad($row->cData_Nascimento),
                    "Nascimento_Provincias_id" => $row->Nascimento_Provincias_id,
                    "provNascimento" => $row->provNascimento,
                    "Nascimento_Municipios_id" => $row->Nascimento_Municipios_id,
                    "munNascimento" => $row->munNascimento,
                    
                    "cNome_Pai" => $row->cNome_Pai,
                    "cNome_Mae" => $row->cNome_Mae,
                    
                    "cBI_Passaporte" => $row->cBI_Passaporte,
                    "cBI_Data_Emissao" => $row->cBI_Data_Emissao,
                    "cBI_Lugar_Emissao_Provincia_id" => $row->cBI_Lugar_Emissao_Provincia_id,
                    "provEmissao" => $this->obtProvinciaXid($row->cBI_Lugar_Emissao_Provincia_id),
                    
                    "Estado_Civil_id" => $row->Estado_Civil_id,
                    "ecNome" => $row->ecNome,
                    
                    "cTelefone" => $row->cTelefone,
                    "cEmail" => $row->cEmail,
                    
                    "Generos_id" => $row->Generos_id,
                    "gNome" => $row->gNome,
                    
                    "Trabalhador_id" => $row->Trabalhador_id,
                    "trabNome" => $row->trabNome,
                    
                    "Profissao_id" => $row->Profissao_id,
                    "proNome" => $row->proNome,
                    
                    "Nacionalidades_Geral_id" => $row->Nacionalidades_Geral_id,
                    "ngNome" => $row->ngNome,
                    
                    "Necessita_Educacao_Especial_id" => $row->Necessita_Educacao_Especial_id,
                    "neeNome" => $row->neeNome,
                );
                $ord++;
            }
        }
        return $data;
    }

    /*
     * Datos Personales
    */
    function mreadDP_search($al,$i,$l,$x) {
        $this->load->model('mestudantes');
        $this->load->model('manos_lectivos');
        $al = $this->manos_lectivos->mGetID($al);
        $ala = $this->manos_lectivos->mGetID(date('Y'));
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cData_Nascimento,
                Candidatos.Nascimento_Provincias_id,Provincias.provNome as provNascimento,
                Candidatos.Nascimento_Municipios_id,Municipios.munNome as munNascimento,
                Candidatos.cNome_Pai,Candidatos.cNome_Mae,
                Candidatos.cBI_Passaporte,Candidatos.cBI_Data_Emissao,Candidatos.cBI_Lugar_Emissao_Provincia_id,
                Candidatos.Estado_Civil_id,Estado_Civil.ecNome,
                Candidatos.cTelefone,Candidatos.cEmail,
                Candidatos.Generos_id,Generos.gNome,
                Candidatos.Trabalhador_id,Trabalhador.trabNome,
                Candidatos.Profissao_id,Profissao.proNome,
                Candidatos.Nacionalidades_Geral_id,Nacionalidades_Geral.ngNome,
                Candidatos.Necessita_Educacao_Especial_id,Necessita_Educacao_Especial.neeNome');
        $this->db->from('Candidatos');
        $this->db->join('Provincias', 'Candidatos.Nascimento_Provincias_id = Provincias.id');
        $this->db->join('Municipios', 'Candidatos.Nascimento_Municipios_id = Municipios.id');
        $this->db->join('Estado_Civil', 'Candidatos.Estado_Civil_id = Estado_Civil.id');
        $this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
        $this->db->join('Trabalhador', 'Candidatos.Trabalhador_id = Trabalhador.id');
        $this->db->join('Profissao', 'Candidatos.Profissao_id = Profissao.id');
        $this->db->join('Nacionalidades_Geral', 'Candidatos.Nacionalidades_Geral_id = Nacionalidades_Geral.id');
        $this->db->join('Necessita_Educacao_Especial', 'Candidatos.Necessita_Educacao_Especial_id = Necessita_Educacao_Especial.id');
        if($al)
            $this->db->where('Candidatos.Anos_Lectivos_id', $al);
        else
            $this->db->where('Candidatos.Anos_Lectivos_id', $ala);
        
        $this->db->like('Candidatos.cNome',$x);
        $this->db->or_like('Candidatos.cNomes',$x);
        $this->db->or_like('Candidatos.cApelido',$x);
        $this->db->or_like('Candidatos.cData_Nascimento',$x);
        $this->db->or_like('Provincias.provNome',$x);
        $this->db->or_like('Municipios.munNome',$x);
        $this->db->or_like('Candidatos.cNome_Pai',$x);
        $this->db->or_like('Candidatos.cNome_Mae',$x);
        $this->db->or_like('Candidatos.cBI_Passaporte',$x);
        $this->db->or_like('Candidatos.cBI_Data_Emissao',$x);
        $this->db->or_like('Estado_Civil.ecNome',$x);
        $this->db->or_like('Candidatos.cTelefone',$x);
        $this->db->or_like('Candidatos.cEmail',$x);
        $this->db->or_like('Generos.gNome',$x);
        $this->db->or_like('Trabalhador.trabNome',$x);
        $this->db->or_like('Profissao.proNome',$x);
        $this->db->or_like('Nacionalidades_Geral.ngNome',$x);

        $this->db->order_by('cNome,cApelido','ASC');
        $this->db->limit($l, $i);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            //ver si es estudiante para no cargarlo en inscriccion
            if(!$this->mestudantes->existe_bi($row->cBI_Passaporte)){
                //$data[] = $row;
                $data[] = array(
                    "id" => $row->id,
                    "ord" => $ord,
                    "cNome" => $row->cNome,
                    "cNomes" => $row->cNomes,
                    "cApelido" => $row->cApelido,
                    
                    "cData_Nascimento" => $row->cData_Nascimento,
                    "cIdade" => $this->calculaEdad($row->cData_Nascimento),
                    "Nascimento_Provincias_id" => $row->Nascimento_Provincias_id,
                    "provNascimento" => $row->provNascimento,
                    "Nascimento_Municipios_id" => $row->Nascimento_Municipios_id,
                    "munNascimento" => $row->munNascimento,
                    
                    "cNome_Pai" => $row->cNome_Pai,
                    "cNome_Mae" => $row->cNome_Mae,
                    
                    "cBI_Passaporte" => $row->cBI_Passaporte,
                    "cBI_Data_Emissao" => $row->cBI_Data_Emissao,
                    "cBI_Lugar_Emissao_Provincia_id" => $row->cBI_Lugar_Emissao_Provincia_id,
                    "provEmissao" => $this->obtProvinciaXid($row->cBI_Lugar_Emissao_Provincia_id),
                    
                    "Estado_Civil_id" => $row->Estado_Civil_id,
                    "ecNome" => $row->ecNome,
                    
                    "cTelefone" => $row->cTelefone,
                    "cEmail" => $row->cEmail,
                    
                    "Generos_id" => $row->Generos_id,
                    "gNome" => $row->gNome,
                    
                    "Trabalhador_id" => $row->Trabalhador_id,
                    "trabNome" => $row->trabNome,
                    
                    "Profissao_id" => $row->Profissao_id,
                    "proNome" => $row->proNome,
                    
                    "Nacionalidades_Geral_id" => $row->Nacionalidades_Geral_id,
                    "ngNome" => $row->ngNome,
                    
                    "Necessita_Educacao_Especial_id" => $row->Necessita_Educacao_Especial_id,
                    "neeNome" => $row->neeNome,
                );
                $ord++;
            }
        }
        return $data;
    }
    
    /*
     * Datos Personales
    */
    function mreadDPE() {
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cData_Nascimento,
                Candidatos.Nascimento_Provincias_id,Provincias.provNome as provNascimento,
                Candidatos.Nascimento_Municipios_id,Municipios.munNome as munNascimento,
                Candidatos.cNome_Pai,Candidatos.cNome_Mae,
                Candidatos.cBI_Passaporte,Candidatos.cBI_Data_Emissao,Candidatos.cBI_Lugar_Emissao_Provincia_id,
                Candidatos.Estado_Civil_id,Estado_Civil.ecNome,
                Candidatos.cTelefone,Candidatos.cEmail,
                Candidatos.Generos_id,Generos.gNome,
                Candidatos.Trabalhador_id,Trabalhador.trabNome,
                Candidatos.Profissao_id,Profissao.proNome,
                Candidatos.Nacionalidades_Geral_id,Nacionalidades_Geral.ngNome,
                Candidatos.Necessita_Educacao_Especial_id,Necessita_Educacao_Especial.neeNome');
        $this->db->from('Candidatos');
        $this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('Provincias', 'Candidatos.Nascimento_Provincias_id = Provincias.id');
        $this->db->join('Municipios', 'Candidatos.Nascimento_Municipios_id = Municipios.id');
        $this->db->join('Estado_Civil', 'Candidatos.Estado_Civil_id = Estado_Civil.id');
        $this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
        $this->db->join('Trabalhador', 'Candidatos.Trabalhador_id = Trabalhador.id');
        $this->db->join('Profissao', 'Candidatos.Profissao_id = Profissao.id');
        $this->db->join('Nacionalidades_Geral', 'Candidatos.Nacionalidades_Geral_id = Nacionalidades_Geral.id');
        $this->db->join('Necessita_Educacao_Especial', 'Candidatos.Necessita_Educacao_Especial_id = Necessita_Educacao_Especial.id');
        $this->db->order_by('cNome,cApelido','ASC');
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                
                "cData_Nascimento" => $row->cData_Nascimento,
                "cIdade" => $this->calculaEdad($row->cData_Nascimento),
                "Nascimento_Provincias_id" => $row->Nascimento_Provincias_id,
                "provNascimento" => $row->provNascimento,
                "Nascimento_Municipios_id" => $row->Nascimento_Municipios_id,
                "munNascimento" => $row->munNascimento,
                
                "cNome_Pai" => $row->cNome_Pai,
                "cNome_Mae" => $row->cNome_Mae,
                
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cBI_Data_Emissao" => $row->cBI_Data_Emissao,
                "cBI_Lugar_Emissao_Provincia_id" => $row->cBI_Lugar_Emissao_Provincia_id,
                "provEmissao" => $this->obtProvinciaXid($row->cBI_Lugar_Emissao_Provincia_id),
                
                "Estado_Civil_id" => $row->Estado_Civil_id,
                "ecNome" => $row->ecNome,
                
                "cTelefone" => $row->cTelefone,
                "cEmail" => $row->cEmail,
                
                "Generos_id" => $row->Generos_id,
                "gNome" => $row->gNome,
                
                "Trabalhador_id" => $row->Trabalhador_id,
                "trabNome" => $row->trabNome,
                
                "Profissao_id" => $row->Profissao_id,
                "proNome" => $row->proNome,
                
                "Nacionalidades_Geral_id" => $row->Nacionalidades_Geral_id,
                "ngNome" => $row->ngNome,
                
                "Necessita_Educacao_Especial_id" => $row->Necessita_Educacao_Especial_id,
                "neeNome" => $row->neeNome,
            );
            $ord++;
        }
        return $data;
    }

    /*
     * Datos Pofesionales
    */
    function mreadDPRO($al,$i,$l) {
        $this->load->model('manos_lectivos');
        $al = $this->manos_lectivos->mGetID($al);
        $ala = $this->manos_lectivos->mGetID(date('Y'));
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.Trabalhador_id,Trabalhador.trabNome,
                Candidatos.Profissao_id,Profissao.proNome,
                Tipo_Instituicao_Laboral.tilNome,
                Organismos_Tutela.otNome,
                Dados_Laborais.dlLocal_Trabalho, Dados_Laborais.dlCargo');
        $this->db->from('Candidatos');
        $this->db->join('Trabalhador', 'Candidatos.Trabalhador_id = Trabalhador.id');
        $this->db->join('Profissao', 'Candidatos.Profissao_id = Profissao.id');
        $this->db->join('Dados_Laborais', 'Candidatos.id = Dados_Laborais.Candidatos_id');
        $this->db->join('Tipo_Instituicao_Laboral', 'Tipo_Instituicao_Laboral.id = Dados_Laborais.Tipo_Instituicao_Laboral_id');
        $this->db->join('Organismos_Tutela', 'Organismos_Tutela.id = Dados_Laborais.Organismos_Tutela_id');
        
        if($al != "")
            $this->db->where('Candidatos.Anos_Lectivos_id', $al);
        else
            $this->db->where('Candidatos.Anos_Lectivos_id', $ala);
        
        $this->db->order_by('cNome,cApelido','ASC');
        $this->db->limit($l, $i);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "proNome" => $row->proNome,
                "trabNome" => $row->trabNome,
                "tilNome" => $row->tilNome,
                "otNome" => $row->otNome,
                "dlLocal_Trabalho" => $row->dlLocal_Trabalho,
                "dlCargo" => $row->dlCargo,
            );
            $ord++;
        }
        return $data;
    }

    function mreadDPRO_search($al,$i,$l,$x) {
        $this->load->model('manos_lectivos');
        $al = $this->manos_lectivos->mGetID($al);
        $ala = $this->manos_lectivos->mGetID(date('Y'));
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.Trabalhador_id,Trabalhador.trabNome,
                Candidatos.Profissao_id,Profissao.proNome,
                Tipo_Instituicao_Laboral.tilNome,
                Organismos_Tutela.otNome,
                Dados_Laborais.dlLocal_Trabalho, Dados_Laborais.dlCargo');
        $this->db->from('Candidatos');
        $this->db->join('Trabalhador', 'Candidatos.Trabalhador_id = Trabalhador.id');
        $this->db->join('Profissao', 'Candidatos.Profissao_id = Profissao.id');
        $this->db->join('Dados_Laborais', 'Candidatos.id = Dados_Laborais.Candidatos_id');
        $this->db->join('Tipo_Instituicao_Laboral', 'Tipo_Instituicao_Laboral.id = Dados_Laborais.Tipo_Instituicao_Laboral_id');
        $this->db->join('Organismos_Tutela', 'Organismos_Tutela.id = Dados_Laborais.Organismos_Tutela_id');
        
        if($al != "")
            $this->db->where('Candidatos.Anos_Lectivos_id', $al);
        else
            $this->db->where('Candidatos.Anos_Lectivos_id', $ala);
        
        $this->db->like('Candidatos.cNome',$x);
        $this->db->or_like('Candidatos.cNomes',$x);
        $this->db->or_like('Candidatos.cApelido',$x);
        $this->db->or_like('Candidatos.cBI_Passaporte',$x);
        $this->db->or_like('Trabalhador.trabNome',$x);
        $this->db->or_like('Profissao.proNome',$x);
        $this->db->or_like('Tipo_Instituicao_Laboral.tilNome',$x);
        $this->db->or_like('Organismos_Tutela.otNome',$x);
        $this->db->or_like('Dados_Laborais.dlLocal_Trabalho',$x);
        $this->db->or_like('Dados_Laborais.dlCargo',$x);

        $this->db->order_by('cNome,cApelido','ASC');
        $this->db->limit($l, $i);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "proNome" => $row->proNome,
                "trabNome" => $row->trabNome,
                "tilNome" => $row->tilNome,
                "otNome" => $row->otNome,
                "dlLocal_Trabalho" => $row->dlLocal_Trabalho,
                "dlCargo" => $row->dlCargo,
            );
            $ord++;
        }
        return $data;
    }

    /*
     * Datos Pofesionales
    */
    function mreadDPROE() {
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.Trabalhador_id,Trabalhador.trabNome,
                Candidatos.Profissao_id,Profissao.proNome,
                Tipo_Instituicao_Laboral.tilNome,
                Organismos_Tutela.otNome,
                Dados_Laborais.dlLocal_Trabalho, Dados_Laborais.dlCargo');
        $this->db->from('Candidatos');
        $this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('Trabalhador', 'Candidatos.Trabalhador_id = Trabalhador.id');
        $this->db->join('Profissao', 'Candidatos.Profissao_id = Profissao.id');
        $this->db->join('Dados_Laborais', 'Candidatos.id = Dados_Laborais.Candidatos_id');
        $this->db->join('Tipo_Instituicao_Laboral', 'Tipo_Instituicao_Laboral.id = Dados_Laborais.Tipo_Instituicao_Laboral_id');
        $this->db->join('Organismos_Tutela', 'Organismos_Tutela.id = Dados_Laborais.Organismos_Tutela_id');
        $this->db->order_by('cNome,cApelido','ASC');
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "proNome" => $row->proNome,
                "trabNome" => $row->trabNome,
                "tilNome" => $row->tilNome,
                "otNome" => $row->otNome,
                "dlLocal_Trabalho" => $row->dlLocal_Trabalho,
                "dlCargo" => $row->dlCargo,
            );
            $ord++;
        }
        return $data;
    }

    /*
     * Datos Academicos
    */
    function mreadDACA($al,$i,$l){
        $this->load->model('manos_lectivos');
        $al = $this->manos_lectivos->mGetID($al);
        $ala = $this->manos_lectivos->mGetID(date('Y'));
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Dados_Academicos_Candidatos.Habilitacoes_Literarias_Candidatos_id, Habilitacoes_Literarias_Candidatos.hlfNome,
                Opcao.opcNome,
                Dados_Academicos_Candidatos.Ano,Dados_Academicos_Candidatos.Media,
                Escola_Formacao.efNome,
                Dados_Academicos_Candidatos.Formacao_Pais_id, Pais.paNome as paFormacao,
                Dados_Academicos_Candidatos.Formacao_Provincias_id,Provincias.provNome as provFormacao');
        $this->db->from('Candidatos');
        $this->db->join('Dados_Academicos_Candidatos', 'Dados_Academicos_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Habilitacoes_Literarias_Candidatos', 'Dados_Academicos_Candidatos.Habilitacoes_Literarias_Candidatos_id = Habilitacoes_Literarias_Candidatos.id');
        $this->db->join('Pais', 'Dados_Academicos_Candidatos.Formacao_Pais_id = Pais.id');
        $this->db->join('Provincias', 'Dados_Academicos_Candidatos.Formacao_Provincias_id = Provincias.id');
        $this->db->join('Escola_Formacao','Dados_Academicos_Candidatos.Escola_Formacao_id = Escola_Formacao.id');
        $this->db->join('Opcao','Dados_Academicos_Candidatos.Opcao_id = Opcao.id');
        //$this->db->join('Escola_Formacao_Opcao','Escola_Formacao_Opcao.Escola_Formacao_id = Escola_Formacao.id');
        //$this->db->join('Opcao','Escola_Formacao_Opcao.Opcao_id = Opcao.id');
        if($al != "")
            $this->db->where('Candidatos.Anos_Lectivos_id', $al);
        else
            $this->db->where('Candidatos.Anos_Lectivos_id', $ala);

        $this->db->order_by('cNome,cApelido','ASC');
        $this->db->limit($l, $i);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "orden" => $ord,
                "cNome" => $row->cNome,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "hlfNome" => $row->hlfNome,
                "opcNome" => $row->opcNome,
                "efNome" => $row->efNome,
                "Ano" => $row->Ano,
                "Media" => $row->Media,
                "paFormacao" => $row->paFormacao,
                "provFormacao" => $row->provFormacao
            );
            $ord = $ord + 1;
        }
        return $data;
    }

    function mreadDACA_search($al,$i,$l,$x){
        $this->load->model('manos_lectivos');
        $al = $this->manos_lectivos->mGetID($al);
        $ala = $this->manos_lectivos->mGetID(date('Y'));
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Dados_Academicos_Candidatos.Habilitacoes_Literarias_Candidatos_id, Habilitacoes_Literarias_Candidatos.hlfNome,
                Opcao.opcNome,
                Dados_Academicos_Candidatos.Ano,Dados_Academicos_Candidatos.Media,
                Escola_Formacao.efNome,
                Dados_Academicos_Candidatos.Formacao_Pais_id, Pais.paNome as paFormacao,
                Dados_Academicos_Candidatos.Formacao_Provincias_id,Provincias.provNome as provFormacao');
        $this->db->from('Candidatos');
        $this->db->join('Dados_Academicos_Candidatos', 'Dados_Academicos_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Habilitacoes_Literarias_Candidatos', 'Dados_Academicos_Candidatos.Habilitacoes_Literarias_Candidatos_id = Habilitacoes_Literarias_Candidatos.id');
        $this->db->join('Pais', 'Dados_Academicos_Candidatos.Formacao_Pais_id = Pais.id');
        $this->db->join('Provincias', 'Dados_Academicos_Candidatos.Formacao_Provincias_id = Provincias.id');
        $this->db->join('Escola_Formacao','Dados_Academicos_Candidatos.Escola_Formacao_id = Escola_Formacao.id');
        $this->db->join('Opcao','Dados_Academicos_Candidatos.Opcao_id = Opcao.id');
        //$this->db->join('Escola_Formacao_Opcao','Escola_Formacao_Opcao.Escola_Formacao_id = Escola_Formacao.id');
        //$this->db->join('Opcao','Escola_Formacao_Opcao.Opcao_id = Opcao.id');
        if($al != "")
            $this->db->where('Candidatos.Anos_Lectivos_id', $al);
        else
            $this->db->where('Candidatos.Anos_Lectivos_id', $ala);

        $this->db->like('Candidatos.cNome',$x);
        $this->db->or_like('Candidatos.cNomes',$x);
        $this->db->or_like('Candidatos.cApelido',$x);
        $this->db->or_like('Candidatos.cBI_Passaporte',$x);
        $this->db->or_like('Habilitacoes_Literarias_Candidatos.hlfNome',$x);
        $this->db->or_like('Opcao.opcNome',$x);
        $this->db->or_like('Dados_Academicos_Candidatos.Ano',$x);
        $this->db->or_like('Dados_Academicos_Candidatos.Media',$x);
        $this->db->or_like('Escola_Formacao.efNome',$x);
        $this->db->or_like('Pais.paNome',$x);
        $this->db->or_like('Provincias.provNome',$x);
        
        $this->db->order_by('cNome,cApelido','ASC');
        $this->db->limit($l, $i);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "orden" => $ord,
                "cNome" => $row->cNome,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "hlfNome" => $row->hlfNome,
                "opcNome" => $row->opcNome,
                "efNome" => $row->efNome,
                "Ano" => $row->Ano,
                "Media" => $row->Media,
                "paFormacao" => $row->paFormacao,
                "provFormacao" => $row->provFormacao
            );
            $ord = $ord + 1;
        }
        return $data;
    }

    /*
     * Datos Academicos
    */
    function mreadDACAE(){
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Dados_Academicos_Candidatos.Habilitacoes_Literarias_Candidatos_id, Habilitacoes_Literarias_Candidatos.hlfNome,
                Opcao.opcNome,
                Dados_Academicos_Candidatos.Ano,Dados_Academicos_Candidatos.Media,
                Escola_Formacao.efNome,
                Dados_Academicos_Candidatos.Formacao_Pais_id, Pais.paNome as paFormacao,
                Dados_Academicos_Candidatos.Formacao_Provincias_id,Provincias.provNome as provFormacao');
        $this->db->from('Candidatos');
        $this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('Dados_Academicos_Candidatos', 'Dados_Academicos_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Habilitacoes_Literarias_Candidatos', 'Dados_Academicos_Candidatos.Habilitacoes_Literarias_Candidatos_id = Habilitacoes_Literarias_Candidatos.id');
        $this->db->join('Pais', 'Dados_Academicos_Candidatos.Formacao_Pais_id = Pais.id');
        $this->db->join('Provincias', 'Dados_Academicos_Candidatos.Formacao_Provincias_id = Provincias.id');
        $this->db->join('Escola_Formacao','Dados_Academicos_Candidatos.Escola_Formacao_id = Escola_Formacao.id');
        $this->db->join('Opcao','Dados_Academicos_Candidatos.Opcao_id = Opcao.id');
        //$this->db->join('Escola_Formacao_Opcao','Escola_Formacao_Opcao.Escola_Formacao_id = Escola_Formacao.id');
        //$this->db->join('Opcao','Escola_Formacao_Opcao.Opcao_id = Opcao.id');
        $this->db->order_by('cNome,cApelido','ASC');
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "orden" => $ord,
                "cNome" => $row->cNome,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "hlfNome" => $row->hlfNome,
                "opcNome" => $row->opcNome,
                "efNome" => $row->efNome,
                "Ano" => $row->Ano,
                "Media" => $row->Media,
                "paFormacao" => $row->paFormacao,
                "provFormacao" => $row->provFormacao
            );
            $ord = $ord + 1;
        }
        return $data;
    }

    /*
     * Datos de localizacao
    */
    function mreadDLOC($al,$i,$l) {
        $this->load->model('manos_lectivos');
        $al = $this->manos_lectivos->mGetID($al);
        $ala = $this->manos_lectivos->mGetID(date('Y'));
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            Candidatos.cTelefone,Candidatos.cEmail,
                Endereco_Candidatos.Pais_id, Pais.paNome,
                Endereco_Candidatos.Provincias_id, Provincias.provNome,
                Endereco_Candidatos.Municipios_id, Municipios.munNome,
                Endereco_Candidatos.Bairros_id, Bairros.baiNome');
        $this->db->from('Candidatos');
        $this->db->join('Endereco_Candidatos', 'Endereco_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Bairros', 'Endereco_Candidatos.Bairros_id = Bairros.id');
        $this->db->join('Municipios', 'Endereco_Candidatos.Municipios_id = Municipios.id');
        $this->db->join('Pais', 'Endereco_Candidatos.Pais_id = Pais.id');
        $this->db->join('Provincias', 'Endereco_Candidatos.Provincias_id = Provincias.id');

        if($al != "")
            $this->db->where('Candidatos.Anos_Lectivos_id', $al);
        else
            $this->db->where('Candidatos.Anos_Lectivos_id', $ala);

        $this->db->order_by('cNome,cApelido','ASC');
        $this->db->limit($l, $i);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cTelefone" => $row->cTelefone,
                "cEmail" => $row->cEmail,
                "paNome" => $row->paNome,
                "provNome" => $row->provNome,
                "munNome" => $row->munNome,
                "baiNome" => $row->baiNome
            );
            $ord++;
        }
        return $data;
    }

    function mreadDLOC_search($al,$i,$l,$x) {
        $this->load->model('manos_lectivos');
        $al = $this->manos_lectivos->mGetID($al);
        $ala = $this->manos_lectivos->mGetID(date('Y'));
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            Candidatos.cTelefone,Candidatos.cEmail,
                Endereco_Candidatos.Pais_id, Pais.paNome,
                Endereco_Candidatos.Provincias_id, Provincias.provNome,
                Endereco_Candidatos.Municipios_id, Municipios.munNome,
                Endereco_Candidatos.Bairros_id, Bairros.baiNome');
        $this->db->from('Candidatos');
        $this->db->join('Endereco_Candidatos', 'Endereco_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Bairros', 'Endereco_Candidatos.Bairros_id = Bairros.id');
        $this->db->join('Municipios', 'Endereco_Candidatos.Municipios_id = Municipios.id');
        $this->db->join('Pais', 'Endereco_Candidatos.Pais_id = Pais.id');
        $this->db->join('Provincias', 'Endereco_Candidatos.Provincias_id = Provincias.id');

        if($al != "")
            $this->db->where('Candidatos.Anos_Lectivos_id', $al);
        else
            $this->db->where('Candidatos.Anos_Lectivos_id', $ala);
        
        $this->db->like('Candidatos.cNome',$x);
        $this->db->or_like('Candidatos.cNomes',$x);
        $this->db->or_like('Candidatos.cApelido',$x);
        $this->db->or_like('Candidatos.cBI_Passaporte',$x);
        $this->db->or_like('Candidatos.cTelefone',$x);
        $this->db->or_like('Candidatos.cEmail',$x);
        $this->db->or_like('Pais.paNome',$x);
        $this->db->or_like('Provincias.provNome',$x);
        $this->db->or_like('Municipios.munNome',$x);
        $this->db->or_like('Bairros.baiNome',$x);

        $this->db->order_by('cNome,cApelido','ASC');
        $this->db->limit($l, $i);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cTelefone" => $row->cTelefone,
                "cEmail" => $row->cEmail,
                "paNome" => $row->paNome,
                "provNome" => $row->provNome,
                "munNome" => $row->munNome,
                "baiNome" => $row->baiNome
            );
            $ord++;
        }
        return $data;
    }

    /*
     * Datos de localizacao
    */
    function mreadDLOCE() {
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            Candidatos.cTelefone,Candidatos.cEmail,
                Endereco_Candidatos.Pais_id, Pais.paNome,
                Endereco_Candidatos.Provincias_id, Provincias.provNome,
                Endereco_Candidatos.Municipios_id, Municipios.munNome,
                Endereco_Candidatos.Bairros_id, Bairros.baiNome,');
        $this->db->from('Candidatos');
        $this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
        $this->db->join('Endereco_Candidatos', 'Endereco_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->join('Bairros', 'Endereco_Candidatos.Bairros_id = Bairros.id');
        $this->db->join('Municipios', 'Endereco_Candidatos.Municipios_id = Municipios.id');
        $this->db->join('Pais', 'Endereco_Candidatos.Pais_id = Pais.id');
        $this->db->join('Provincias', 'Endereco_Candidatos.Provincias_id = Provincias.id');
        $this->db->order_by('cNome,cApelido','ASC');
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cTelefone" => $row->cTelefone,
                "cEmail" => $row->cEmail,
                "paNome" => $row->paNome,
                "provNome" => $row->provNome,
                "munNome" => $row->munNome,
                "baiNome" => $row->baiNome
            );
            $ord++;
        }
        return $data;
    }
    /*
     * Datos Personales
    */
    function mreadDInscricao($al,$i,$l) {
        $this->load->model('manos_lectivos');
        $al = $this->manos_lectivos->mGetID($al);
        $ala = $this->manos_lectivos->mGetID(date('Y'));
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.anos_lectivos_id,anos_lectivos.alAno,
                Candidatos.cEstado,
                Cursos_Pretendidos.cp_ano_lec_insc');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        //$this->db->join('Financas_Pagamentos_Candidatos', 'Financas_Pagamentos_Candidatos.Candidatos_id = Candidatos.id');
        if($al != "")
            $this->db->where('Candidatos.Anos_Lectivos_id', $al);
        else
            $this->db->where('Candidatos.Anos_Lectivos_id', $ala);

        $this->db->order_by('cNome,cApelido','ASC');
        $this->db->limit($l, $i);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                //"fpc_id" => $row->fpc_id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cEstado" => $row->cEstado,
                "alAno" => $row->cp_ano_lec_insc
            );
            $ord++;
        }
        return $data;
    }

    function mreadDInscricao_search($al,$i,$l,$x) {
        $this->load->model('manos_lectivos');
        $al = $this->manos_lectivos->mGetID($al);
        $ala = $this->manos_lectivos->mGetID(date('Y'));
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.anos_lectivos_id,anos_lectivos.alAno,
                Candidatos.cEstado,
                Cursos_Pretendidos.cp_ano_lec_insc');
        $this->db->from('Candidatos');
        $this->db->join('Cursos_Pretendidos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        //$this->db->join('Financas_Pagamentos_Candidatos', 'Financas_Pagamentos_Candidatos.Candidatos_id = Candidatos.id');
        if($al != "")
            $this->db->where('Candidatos.Anos_Lectivos_id', $al);
        else
            $this->db->where('Candidatos.Anos_Lectivos_id', $ala);

        $this->db->like('Candidatos.cNome',$x);
        $this->db->or_like('Candidatos.cNomes',$x);
        $this->db->or_like('Candidatos.cApelido',$x);
        $this->db->or_like('Candidatos.cBI_Passaporte',$x);
        $this->db->or_like('anos_lectivos.alAno',$x);

        $this->db->order_by('cNome,cApelido','ASC');
        $this->db->limit($l, $i);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                //"fpc_id" => $row->fpc_id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cEstado" => $row->cEstado,
                "alAno" => $row->cp_ano_lec_insc
            );
            $ord++;
        }
        return $data;
    }

    /*
     * Datos Personales
    */
    function mreadDInscricao_Financas() {
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.anos_lectivos_id,anos_lectivos.alAno,
                Candidatos.cEstado');
        $this->db->from('Candidatos');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        //$this->db->join('Financas_Pagamentos_Candidatos', 'Financas_Pagamentos_Candidatos.Candidatos_id = Candidatos.id');
        $this->db->order_by('cNome,cApelido','ASC');
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                //"fpc_id" => $row->fpc_id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cEstado" => $row->cEstado,
                "alAno" => $row->alAno
            );
            $ord++;
        }
        return $data;
    }
    /*
     * Datos Personales de los que estan en espera de pagamento para modulo financas/Inscricao
    */
    function mreadDInscricaoEspPag(){
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.anos_lectivos_id,anos_lectivos.alAno,
                Candidatos.cEstado');
        $this->db->from('Candidatos');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->where('Candidatos.cEstado', "Espera de Pagamento");
        $this->db->order_by('cNome,cApelido','ASC');
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cEstado" => $row->cEstado,
                "alAno" => $row->alAno
            );
        }
        return $data;
    }
    /*
     * Datos Lista de Inscricao busqueda
    */
    function mreadDInscricaoXncp($n,$c,$p,$al) {
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.anos_lectivos_id,anos_lectivos.alAno,
                Candidatos.cEstado,
                Cursos_Pretendidos.cp_ano_lec_insc');
        $this->db->from('Cursos_Pretendidos');
        $this->db->join('Candidatos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->where('niveis_cursos.niveis_id', $n);
        $this->db->where('niveis_cursos.cursos_id', $c);
        $this->db->where('niveis_cursos.periodos_id', $p);
        $this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $al);
        $this->db->order_by('cNome,cApelido','ASC');
        $consulta = $this->db->get();
        $ord = 1;
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cEstado" => $row->cEstado,
                "alAno" => $row->cp_ano_lec_insc,
                //"cp_ano_lec_insc" => $row->cp_ano_lec_insc
            );
            $ord++;
        }
        return $data;
    }
    /*
     * Datos Lista de Inscricao para modulo mInscricao_Lista para imprimir lista
    */
    function mreadXncp($n,$c,$p){
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.anos_lectivos_id,anos_lectivos.alAno,
                Candidatos.cEstado,
                cursos.cNome as curso, niveis.nNome, periodos.pNome');
        $this->db->from('Cursos_Pretendidos');
        $this->db->join('Candidatos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->where('niveis_cursos.niveis_id', $n);
        $this->db->where('niveis_cursos.cursos_id', $c);
        $this->db->where('niveis_cursos.periodos_id', $p);
        $this->db->where('Candidatos.cEstado', "Inscrição aceite");
        $this->db->order_by('cNome,cApelido','ASC');
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cEstado" => $row->cEstado,
                "alAno" => $row->alAno,
                "curso" => $row->curso,
                "nNome" => $row->nNome,
                "pNome" => $row->pNome
            );
            $ord++;
        }
        return $data;
    }
    function mreadXncpal($n,$c,$p,$al){
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.anos_lectivos_id,anos_lectivos.alAno,
                Candidatos.cEstado,
                cursos.cNome as curso, niveis.nNome, periodos.pNome');
        $this->db->from('Cursos_Pretendidos');
        $this->db->join('Candidatos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->where('niveis_cursos.niveis_id', $n);
        $this->db->where('niveis_cursos.cursos_id', $c);
        $this->db->where('niveis_cursos.periodos_id', $p);
        $this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $al);
        $this->db->where('Candidatos.cEstado', "Inscrição aceite");
        $this->db->order_by('cNome,cApelido','ASC');
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "cEstado" => $row->cEstado,
                "alAno" => $row->alAno,
                "curso" => $row->curso,
                "nNome" => $row->nNome,
                "pNome" => $row->pNome
            );
            $ord++;
        }
        return $data;
    }
    function mreadNomeXID($id){
          $this->db->select('Candidatos.cNome');
          $this->db->from('Candidatos');
          $this->db->where('Candidatos.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->cNome;
          }
      }
      function mreadApelidoXID($id){
          $this->db->select('Candidatos.cApelido');
          $this->db->from('Candidatos');
          $this->db->where('Candidatos.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->cApelido;
          }
      }
      /*
     * BI para combos de busqueda
    */
    function mreadBI() {
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cData_Nascimento,
                Candidatos.Nascimento_Provincias_id,Provincias.provNome,
                Candidatos.Nascimento_Municipios_id,Municipios.munNome,
                Candidatos.cNome_Pai,Candidatos.cNome_Mae,
                Candidatos.cBI_Passaporte,Candidatos.cBI_Data_Emissao,Candidatos.cBI_Lugar_Emissao_Provincia_id,
                Candidatos.Estado_Civil_id,Estado_Civil.ecNome,
                Candidatos.cTelefone,Candidatos.cEmail,
                Candidatos.Generos_id,Generos.gNome,
                Candidatos.Trabalhador_id,Trabalhador.trabNome,
                Candidatos.Profissao_id,Profissao.proNome,
                Candidatos.Nacionalidades_Geral_id,Nacionalidades_Geral.ngNome,
                Candidatos.Necessita_Educacao_Especial_id,Necessita_Educacao_Especial.neeNome');
        $this->db->from('Candidatos');
        $this->db->join('Provincias', 'Candidatos.Nascimento_Provincias_id = Provincias.id');
        $this->db->join('Municipios', 'Candidatos.Nascimento_Municipios_id = Municipios.id');
        $this->db->join('Estado_Civil', 'Candidatos.Estado_Civil_id = Estado_Civil.id');
        $this->db->join('Generos', 'Candidatos.Generos_id = Generos.id');
        $this->db->join('Trabalhador', 'Candidatos.Trabalhador_id = Trabalhador.id');
        $this->db->join('Profissao', 'Candidatos.Profissao_id = Profissao.id');
        $this->db->join('Nacionalidades_Geral', 'Candidatos.Nacionalidades_Geral_id = Nacionalidades_Geral.id');
        $this->db->join('Necessita_Educacao_Especial', 'Candidatos.Necessita_Educacao_Especial_id = Necessita_Educacao_Especial.id');
        $this->db->order_by('cNome,cApelido','ASC');
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "value" => $row->cBI_Passaporte,
                "cBI_Passaporte" => $row->cBI_Passaporte
            );
        }
        return $data;
    }
    //get id por BI
    function mreadIDxBI($bi){
          $this->db->select('Candidatos.id');
          $this->db->from('Candidatos');
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
                return $value->id;
          }
      }
      //ver si ya existe un BI en la BD
      function mExiste_BI($bi){
          $this->db->select('Candidatos.id');
          $this->db->from('Candidatos');
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          if($this->db->count_all_results() > 0)
            return true;
          else
            return false;
      }

      function mreadIDxBICount($bi){
          $this->db->select('Candidatos.id');
          $this->db->from('Candidatos');
          $this->db->where('Candidatos.cBI_Passaporte', $bi);
          return $this->db->count_all_results();
      }
      function mreadIDxCodigo_Barra($cb){
          $this->db->select('Candidatos.id');
          $this->db->from('Candidatos');
          $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
          $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.fppcCodigoBarra', $cb);
          //$this->db->where('Candidatos.cBI_Passaporte', $bi);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
                return $value->id;
          }
      }
      function mreadIDxCodigo_Barra_Count($bi){
          $this->db->select('Candidatos.id');
          $this->db->from('Candidatos');
          $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
          $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.fppcCodigoBarra', $bi);
          return $this->db->count_all_results();
      }
      function mreadBIxID($id){
          $this->db->select('Candidatos.cBI_Passaporte');
          $this->db->from('Candidatos');
          $this->db->where('Candidatos.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->cBI_Passaporte;
          }
      }
      function mreadBIxCB_i2s($cb){
          $this->db->select('Candidatos.cBI_Passaporte');
          $this->db->from('Candidatos');
          $this->db->join('Academica_Planificacao_Exame_Candidatos_2S', 'Academica_Planificacao_Exame_Candidatos_2S.Candidatos_id = Candidatos.id');
          $this->db->where('Academica_Planificacao_Exame_Candidatos_2S.apecCodigoBarra', $cb);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->cBI_Passaporte;
          }
      }
      function mreadBIxCB($cb){
          $this->db->select('Candidatos.cBI_Passaporte');
          $this->db->from('Candidatos');
          $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
          $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.fppcCodigoBarra', $cb);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->cBI_Passaporte;
          }
      }
      function mreadIDxCB($cb){
          $this->db->select('Candidatos.id');
          $this->db->from('Candidatos');
          $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
          $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.fppcCodigoBarra', $cb);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
    /*
        cargar nome completo por ID
    */
    function mreadNomeCompletoXID($id){
          $this->db->select('cNome,cNomes,cApelido');
          $this->db->from('Candidatos');
          $this->db->where('Candidatos.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->cNome." ".$value->cNomes." ".$value->cApelido;
          }
      }
      function mreadNomeCompletoXCB($cb){
          $this->db->select('cNome,cNomes,cApelido');
          $this->db->from('Candidatos');
          $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
          $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.fppcCodigoBarra', $cb);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->cNome." ".$value->cNomes." ".$value->cApelido;
          }
      }
      
    function matriculado($id){
        $this->db->select('cNome,cNomes,cApelido,cBI_Passaporte');
        $this->db->from('Candidatos');
        $this->db->join('estudantes', 'estudantes.Candidatos_id = candidatos.id');
        $this->db->where('estudantes.Candidatos_id', $id);
        if($this->db->count_all_results() > 0)
            return true;
        else
            return false;
    }
    function no_matriculados(){
        $this->db->select('id');
        $this->db->from('Candidatos');
        $consulta = $this->db->get();
        foreach($consulta->result() as $value) {
            if($this->matriculado($value->id) == false){
                $this->mdelete($value->id);
            }
        }
    }
      

    function mupdateDP($id,$cNome, $cNomes, $cApelido, $gNome, $ngNome, $cNome_Pai, $cNome_Mae, $cBI_Passaporte, $cBI_Data_Emissao, $provEmissao,
                                            $ecNome, $cData_Nascimento, $provNome, $munNome, $neeNome) {
        //ver los ids y ajustarlos ya que algunos vienen con nombre
        if(is_numeric($ecNome) == false){
            $this->load->Model('MEstado_Civil');
            $ecNome = $this->MEstado_Civil->mGetID($ecNome);
        }
        if(is_numeric($gNome) == false){
            $this->load->Model('MGeneros');
            $gNome = $this->MGeneros->mGetID($gNome);
        }
        if(is_numeric($ngNome) == false){
            $this->load->Model('MNacionalidades_Geral');
            $ngNome = $this->MNacionalidades_Geral->mGetID($ngNome);
        }
        if(is_numeric($neeNome) == false){
            $this->load->Model('MNecessita_Educacao_Especial');
            $neeNome = $this->MNecessita_Educacao_Especial->mGetID($neeNome);
        }
        //municipio de nascimento
        if(is_numeric($munNome) == false){
            $this->load->Model('MMunicipios');
            $munNome = $this->MMunicipios->mGetID($munNome);
        }
        //Provincia de nascimento
        if(is_numeric($provNome) == false){
            $this->load->Model('MProvincias');
            $provNome = $this->MProvincias->mGetID($provNome);
        }
        if(is_numeric($provEmissao) == false){
            $this->load->Model('MProvincias');
            $provEmissao = $this->MProvincias->mGetID($provEmissao);
        }
        
        $Candidatos = array('cNome'=>$cNome, 'cNomes'=>$cNomes, 'cApelido'=>$cApelido, 'Generos_id'=>$gNome, 'Nacionalidades_Geral_id'=>$ngNome, 'cNome_Pai'=>$cNome_Pai, 
                     'cNome_Mae'=>$cNome_Mae, 'cBI_Passaporte'=>$cBI_Passaporte, 'cBI_Data_Emissao'=>$cBI_Data_Emissao, 'cBI_Lugar_Emissao_Provincia_id'=>$provEmissao,
                     'Estado_Civil_id'=>$ecNome, 'cData_Nascimento'=>$cData_Nascimento, 'Nascimento_Provincias_id'=>$provNome, 'Nascimento_Municipios_id'=>$munNome,
                     /*'Trabalhador_id'=>$trabNome, 'Profissao_id'=>$proNome,*/ 'Necessita_Educacao_Especial_id'=>$neeNome /*, 'cTelefone'=>$cTelefone, 'cEmail'=>$cEmail*/);
        
        if ($this->db->update('Candidatos', $Candidatos, array('id' => $id))) {
            //$this->MAuditorias_Academicas->minsert("Actualizar:Candidato","Academica","Inscrição",$usuario,"Dados pessoais do Candidato:".$cNome.' '.$cApelido.' actualizados com sucesso');
            return true;
        } else
            return false;
    }
    /*
    Actualizar dados profissionais
    */
    function mupdateDPRO($id, $trabNome, $proNome, $tilNome, $dlLocal_Trabalho, $otNome, $dlCargo) {
        
        if(is_numeric($proNome) == false){
            $this->load->Model('MProfissao');
            $proNome = $this->MProfissao->mGetID($proNome);
        }
        if(is_numeric($trabNome) == false){
            $this->load->Model('MTrabalhador');
            $trabNome = $this->MTrabalhador->mGetID($trabNome);
        }
        if(is_numeric($tilNome) == false){
            $this->load->Model('MTipo_Instituicao_Laboral');
            $tilNome = $this->MTipo_Instituicao_Laboral->mGetID($tilNome);
        }
        if(is_numeric($otNome) == false){
            $this->load->Model('MOrganismos_Tutela');
            $otNome = $this->MOrganismos_Tutela->mGetID($otNome);
        }
           
        $Candidatos = array('Trabalhador_id'=>$trabNome, 'Profissao_id'=>$proNome);
        $Dados_Laborais = array('Tipo_Instituicao_Laboral_id'=>$tilNome,'Organismos_Tutela_id'=>$otNome,
                            'dlLocal_Trabalho'=>$dlLocal_Trabalho, 'dlCargo'=>$dlCargo);
        
        if($this->db->update('Candidatos', $Candidatos, array('id' => $id)))
        {
            if($this->db->update('Dados_Laborais', $Dados_Laborais, array('Candidatos_id' => $id)))
                return true;
            else
                return false;
        }else
            return false;
    }
    function mupdateDACA($id, $Formacao_Pais_id,$Formacao_Provincias_id,$hlfNome,$Opcao,$Media,$Escola,$Ano) {
        
        if(is_numeric($Formacao_Pais_id) == false){
            $this->load->Model('MPaises');
            $Formacao_Pais_id = $this->MPaises->mGetID($Formacao_Pais_id);
        }
        if(is_numeric($Formacao_Provincias_id) == false){
            $this->load->Model('MProvincias');
            $Formacao_Provincias_id = $this->MProvincias->mGetID($Formacao_Provincias_id);
        }
        if(is_numeric($hlfNome) == false){
            $this->load->Model('MHabilitacoes_Literarias_Candidatos');
            $hlfNome = $this->MHabilitacoes_Literarias_Candidatos->mGetID($hlfNome);
        }

        //$Candidatos = array('Trabalhador_id'=>$trabNome, 'Profissao_id'=>$proNome);
        $Dados_Academicos_Candidatos = array('Habilitacoes_Literarias_Candidatos_id'=>$hlfNome,'Opcao_id'=>$Opcao,
                            'Escola_Formacao_id'=>$Escola, 'Ano'=>$Ano,'Media'=>$Media,'Formacao_Pais_id'=>$Formacao_Pais_id,
                            'Formacao_Provincias_id'=>$Formacao_Provincias_id);
        
        if($this->db->update('Dados_Academicos_Candidatos', $Dados_Academicos_Candidatos, array('Candidatos_id' => $id)))
            return true;
        else
            return false;
    }
    function mupdateDLOC($id, $cTelefone, $cEmail, $Pais_id, $Provincias_id, $Municipios_id, $Bairros_id) {
        
        if(is_numeric($Pais_id) == false){
            $this->load->Model('MPaises');
            $Pais_id = $this->MPaises->mGetID($Pais_id);
        }
        if(is_numeric($Provincias_id) == false){
            $this->load->Model('MProvincias');
            $Provincias_id = $this->MProvincias->mGetID($Provincias_id);
        }
        if(is_numeric($Municipios_id) == false){
            $this->load->Model('MMunicipios');
            $Municipios_id = $this->MMunicipios->mGetID($Municipios_id);
        }
        if(is_numeric($Bairros_id) == false){
            $this->load->Model('MBairros');
            $Bairros_id = $this->MBairros->mGetID($Bairros_id);
        }

        $Candidatos = array('cTelefone'=>$cTelefone, 'cEmail'=>$cEmail);
        $Endereco_Candidatos = array('Pais_id'=>$Pais_id,'Provincias_id'=>$Provincias_id,
                                'Municipios_id'=>$Municipios_id, 'Bairros_id'=>$Bairros_id);
        
        if($this->db->update('Candidatos', $Candidatos, array('id' => $id)))
        {
            if($this->db->update('Endereco_Candidatos', $Endereco_Candidatos, array('Candidatos_id' => $id)))
                return true;
            else
                return false;
        }else
            return false;
    }

    function existe_bi($bi){
          $this->db->select('id');
          $this->db->from('Candidatos');
		  //$this->db->join('Candidatos', 'Estudantes.Candidatos_id = Candidatos.id');
          $this->db->where('cBI_Passaporte', $bi);
          if($this->db->count_all_results() > 0)
		  	return true;
		else
			return false;
    }

    function mactualizar_inscicao($bi,$al) {
        $this->load->model('manos_lectivos');
        $al_id = $this->manos_lectivos->mGetID($al);
        //ver los ids y ajustarlos ya que algunos vienen con nombre
        $ano = array('ano_lec_insc'=>$al,'cEstado'=>"Espera de Pagamento",'anos_lectivos_id'=>$al_id);
        
        if ($this->db->update('Candidatos', $ano, array('cBI_Passaporte' => $bi))) {
            //$this->MAuditorias_Academicas->minsert("Actualizar:Candidato","Academica","Inscrição",$usuario,"Dados pessoais do Candidato:".$cNome.' '.$cApelido.' actualizados com sucesso');
            return true;
        } else
            return false;
    }
    
    function minsert($cNome, $cNomes, $cApelido, $gNome, $ngNome, $cNome_Pai, $cNome_Mae, $cBI_Passaporte, $cBI_Data_Emissao, $cBI_Lugar_Emissao_Provincia_id,
        $ecNome, $cData_Nascimento, $Nascimento_Provincias_id, $Nascimento_Municipios_id, $Necessita_Educacao_Especial_id,
        //dados profissionais
        $trabNome, $proNome, $tilNome, $dlLocal_Trabalho, $otNome, $dlCargo,
        //dados academicos
        $Formacao_Pais_id, $Formacao_Provincias_id, $hlfNome, $Opcao, $Media, $Escola, $Ano,
        //dados localizacao
        $cTelefone, $cEmail, $Pais_id, $Provincias_id, $Municipios_id, $Bairros_id, $Ano_actual_id,
        //usuario
        $usuario){
        
        $this->load->model('MAuditorias_Academicas');

        //Tabla Candidato
        $Candidatos = array('cNome'=>$cNome, 'cNomes'=>$cNomes, 'cApelido'=>$cApelido, 'Generos_id'=>$gNome, 'Nacionalidades_Geral_id'=>$ngNome, 'cNome_Pai'=>$cNome_Pai, 
                     'cNome_Mae'=>$cNome_Mae, 'cBI_Passaporte'=>$cBI_Passaporte, 'cBI_Data_Emissao'=>$cBI_Data_Emissao, 'cBI_Lugar_Emissao_Provincia_id'=>$cBI_Lugar_Emissao_Provincia_id,
                     'Estado_Civil_id'=>$ecNome, 'cData_Nascimento'=>$cData_Nascimento, 'Nascimento_Provincias_id'=>$Nascimento_Provincias_id, 'Nascimento_Municipios_id'=>$Nascimento_Municipios_id,
                     'Trabalhador_id'=>$trabNome, 'Profissao_id'=>$proNome, 'Necessita_Educacao_Especial_id'=>$Necessita_Educacao_Especial_id, 'cTelefone'=>$cTelefone, 'cEmail'=>$cEmail,
                     'cEstado'=>"Espera de Pagamento", 'anos_lectivos_id'=>$Ano_actual_id, 'cSessao'=>1,
                     'ano_lec_insc'=>date('Y'));
        
        if ($this->db->insert('Candidatos', $Candidatos)) {
            //Tabla Dados_Laborais
            $idc = $this->db->insert_id();

            $Dados_Laborais = array('Candidatos_id'=>$idc, 'Tipo_Instituicao_Laboral_id'=>$tilNome, 'Organismos_Tutela_id'=>$otNome, 'dlLocal_Trabalho'=>$dlLocal_Trabalho,'dlCargo'=>$dlCargo);
            /*if (*/ 
            //if(is_numeric($tilNome)){
                $this->db->insert('Dados_Laborais', $Dados_Laborais);   //) {
            //}
                //Tabla Dados_Academicos_Candidatos
                $Dados_Academicos_Candidatos = array('Candidatos_id'=>$idc, 'Habilitacoes_Literarias_Candidatos_id'=>$hlfNome, 'Opcao_id'=>$Opcao, 'Escola_Formacao_id'=>$Escola, 'Ano'=>$Ano, 'Media'=>$Media,
                                                    'Formacao_Pais_id'=>$Formacao_Pais_id, 'Formacao_Provincias_id'=>$Formacao_Provincias_id);
                if ($this->db->insert('Dados_Academicos_Candidatos', $Dados_Academicos_Candidatos)) {
                    //tabla Endereco_Candidatos
                    $Endereco_Candidatos = array('Candidatos_id'=>$idc, 'Bairros_id'=>$Bairros_id, 'Municipios_id'=>$Municipios_id, 'Provincias_id'=>$Provincias_id, 'Pais_id'=>$Pais_id);
                    if ($this->db->insert('Endereco_Candidatos', $Endereco_Candidatos)) {
                        //registrar log para auditoria
                        $this->MAuditorias_Academicas->minsert("Inserir:Candidato","Academica","Inscrição",$usuario,"Candidato:".$cNome.' '.$cApelido.' Inserido com sucesso');
                        return true;
                    }else{
                        $this->MAuditorias_Academicas->minsert("Inserir:Candidato","Academica","Inscrição",$usuario,'Erro inserindo dados de localiza&ccedil;&atilde;o do candidato: '.$cNome.' '.$cApelido);
                        return false;
                    }
                }else{
                    $this->MAuditorias_Academicas->minsert("Inserir:Candidato","Academica","Inscrição",$usuario,'Erro inserindo dados acad&eacute;micos do candidato: '.$cNome.' '.$cApelido);
                    return false;
                }
           /* } else {
                return false;
            }*/
        } else {
            $this->MAuditorias_Academicas->minsert("Inserir:Candidato","Academica","Inscrição",$usuario,'Erro inserindo dados pessoais do candidato: '.$cNome.' '.$cApelido);
            return false;
        }
    }

    function mdelete($id) {
        if($this->db->delete('Endereco_Candidatos', array('candidatos_id' => $id)))
            if($this->db->delete('Dados_Academicos_Candidatos', array('Candidatos_id' => $id)))
                if($this->db->delete('Dados_Laborais', array('Candidatos_id' => $id)))
                    if($this->db->delete('Candidatos', array('id' => $id)))
                        return true;
                    else
                        return false;
                else 
                    return false;
            else
                return false;
        else
            return false;
    }

    function msalvarFoto($id, $codigo_foto) {
        $dados = array('cFoto' => $codigo_foto);
        if ($this->db->update('Candidatos', $dados, array('id' => $id))) {
            return true;
        } else
            return false;
    }

    function mcargarFoto($id) {
        $this->db->select('cFoto');
        $this->db->from('Candidatos');
        //$this->db->join('Enderecos_Funcionarios', 'Enderecos_Funcionarios.Pais_id = Pais.id');
        //$this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
        $this->db->where('Candidatos.id', $id);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $value) {
            return $value->cFoto;
        }
    }

    function mcargarFotoCB($id) {
        $this->db->select('cFoto');
        $this->db->from('Candidatos');
        //$this->db->join('Enderecos_Funcionarios', 'Enderecos_Funcionarios.Pais_id = Pais.id');
        //$this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
        $this->db->where('Candidatos.cBI_Passaporte', $id);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $value) {
            return $value->cFoto;
        }
    }

    /*
        Actualizar estado de candidato (Espera de pagamento)
    */
    function cambiar_estado($id,$cEstado){
        $Candidatos = array('cEstado'=>$cEstado);
        
        if ($this->db->update('Candidatos', $Candidatos, array('id' => $id))) {
            return true;
        } else
            return false;
    }
    function cambiar_estado_2s($id,$cEstado){
        $Candidatos = array('cEstado2s'=>$cEstado);
        
        if ($this->db->update('Candidatos', $Candidatos, array('id' => $id))) {
            return true;
        } else
            return false;
    }
}

?>
