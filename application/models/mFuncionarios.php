<?php
  class MFuncionarios extends CI_Model{
     
    //calcular edad por la fecha de nacimiento
    function calculaEdad($dataN){
        $date2 = date('Y-m-d');//
        $diff = abs(strtotime($date2) - strtotime($dataN)); //'1999-11-04'
        $years = floor($diff / (365*60*60*24));
        //$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        //$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        return $years;
    }
      
     function mreadDP(){
          $this->db->select('Funcionarios.festado,Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,
                  Funcionarios.fBI_Passaporte,Funcionarios.fBI_Data_Emissao,Funcionarios.fData_Nascimento,
                  Funcionarios.Nascimento_Provincias_id,Provincias.provNome,
                  Funcionarios.Nascimento_Municipios_id,Municipios.munNome,
                  Funcionarios.Habilitacoes_Literarias_Funcionarios_id,Habilitacoes_literarias_Funcionarios.hlfNome,
                  Funcionarios.fTelefone,
                  Funcionarios.fTelefone1,
                  Funcionarios.Generos_id,Generos.gNome,
                  Funcionarios.Estado_Civil_id,Estado_Civil.ecNome,
                  Funcionarios.Nacionalidade_Pais_id,Pais.paNome,
                  Funcionarios.fEmail');
          $this->db->from('Funcionarios');
          //$this->db->join('Provincias', 'Funcionarios.fBI_Lugar_Emissao_Provincias_id = Provincias.id');
          $this->db->join('Habilitacoes_Literarias_Funcionarios', 'Funcionarios.Habilitacoes_Literarias_Funcionarios_id = Habilitacoes_Literarias_Funcionarios.id');
          $this->db->join('Generos', 'Funcionarios.Generos_id = Generos.id');
          $this->db->join('Estado_Civil', 'Funcionarios.Estado_Civil_id = Estado_Civil.id');
          $this->db->join('Pais', 'Funcionarios.Nacionalidade_Pais_id = Pais.id');
          //$this->db->join('Grupos_Funcionarios', 'Funcionarios.Grupos_Funcionarios_id = Grupos_Funcionarios.id');
          //$this->db->join('Categorias_Funcionarios', 'Funcionarios.Categorias_Funcionarios_id = Categorias_Funcionarios.id');
          $this->db->join('Provincias', 'Funcionarios.Nascimento_Provincias_id = Provincias.id');
          $this->db->join('Municipios', 'Funcionarios.Nascimento_Municipios_id = Municipios.id');
          //$this->db->join('Vinculos_Laborais', 'Funcionarios.Vinculos_Laborais_id = Vinculos_Laborais.id');
          //$this->db->join('Departamentos', 'Funcionarios.Departamentos_id = Departamentos.id');
          //$this->db->join('Sectores', 'Funcionarios.Sectores_id = Sectores.id');
          //$this->db->join('Provincias', 'Funcionarios.Endereco_Provincias_id = Provincias.id');
          //$this->db->join('Municipios', 'Funcionarios.Endereco_Municipios_id = Municipios.id');
          //$this->db->join('Bairros', 'Funcionarios.Endereco_Bairros_id = Bairros.id');
          //$this->db->join('Cargos', 'Funcionarios.Cargos_id = Cargos.id');
          $this->db->order_by('fNome','ASC');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      //PARA CURRICULUM
      function mreadDPXid($id){
          $this->db->select('Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,
                  Funcionarios.fBI_Passaporte,Funcionarios.fBI_Data_Emissao,Funcionarios.fData_Nascimento,
                  Funcionarios.Nascimento_Provincias_id,Provincias.provNome,
                  Funcionarios.Nascimento_Municipios_id,Municipios.munNome,
                  Funcionarios.Habilitacoes_Literarias_Funcionarios_id,Habilitacoes_literarias_Funcionarios.hlfNome,
                  Funcionarios.fTelefone,
                  Funcionarios.fTelefone1,
                  Funcionarios.Generos_id,Generos.gNome,
                  Funcionarios.Estado_Civil_id,Estado_Civil.ecNome,
                  Funcionarios.Nacionalidade_Pais_id,Pais.paNome,
                  Funcionarios.fEmail');
          $this->db->from('Funcionarios');
          $this->db->join('Habilitacoes_Literarias_Funcionarios', 'Funcionarios.Habilitacoes_Literarias_Funcionarios_id = Habilitacoes_Literarias_Funcionarios.id');
          $this->db->join('Generos', 'Funcionarios.Generos_id = Generos.id');
          $this->db->join('Estado_Civil', 'Funcionarios.Estado_Civil_id = Estado_Civil.id');
          $this->db->join('Pais', 'Funcionarios.Nacionalidade_Pais_id = Pais.id');
          $this->db->join('Provincias', 'Funcionarios.Nascimento_Provincias_id = Provincias.id');
          $this->db->join('Municipios', 'Funcionarios.Nascimento_Municipios_id = Municipios.id');
          $this->db->where('Funcionarios.id', $id);
          $this->db->order_by('fNome','ASC');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      function mGetNomeApelido($id){
          $this->db->select('Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->fNome.' '.$row->fApelido;
          }
      }
      function mGetNome($id){
          $this->db->select('Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->fNome;
          }
      }
      function mGetNomes($id){
          $this->db->select('Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->fNomes;
          }
      }
      function mGetApelido($id){
          $this->db->select('Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->fApelido;
          }
      }
      function mGetBI($id){
          $this->db->select('Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->fBI_Passaporte;
          }
      }
      function mGetBI_Data_Emissao($id){
          $this->db->select('Funcionarios.id,Funcionarios.fBI_Data_Emissao');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->fBI_Data_Emissao;
          }
      }
      function mgetbi_provincia_emissao($id){
          $this->db->select('Provincias.id');
          $this->db->from('Provincias');
          $this->db->join('BI_Lugar_Emissao_Provincias', 'BI_Lugar_Emissao_Provincias.Provincias_id = Provincias.id');
          $this->db->join('Funcionarios', 'BI_Lugar_Emissao_Provincias.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mget_data_nacimiento($id){
          $this->db->select('Funcionarios.id,Funcionarios.fData_Nascimento');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->fData_Nascimento;
          }
      }
      function mget_genero($id){
          $this->db->select('Funcionarios.id,Funcionarios.Generos_id');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->Generos_id;
          }
      }
      function mget_estado_civil($id){
          $this->db->select('Funcionarios.id,Funcionarios.Estado_Civil_id');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->Estado_Civil_id;
          }
      }
      function mget_nacionalidade($id){
          $this->db->select('Funcionarios.id,Funcionarios.Nacionalidade_Pais_id');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->Nacionalidade_Pais_id;
          }
      }
      function mget_nascimento_provincia($id){
          $this->db->select('Funcionarios.id,Funcionarios.Nascimento_Provincias_id');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->Nascimento_Provincias_id;
          }
      }
      function mget_nascimento_municipio($id){
          $this->db->select('Funcionarios.id,Funcionarios.Nascimento_Municipios_id');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->Nascimento_Municipios_id;
          }
      }
      function mget_habilitacao_literaria($id){
          $this->db->select('Funcionarios.id,Funcionarios.Habilitacoes_Literarias_Funcionarios_id');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->Habilitacoes_Literarias_Funcionarios_id;
          }
      }
      function mget_experiencias_profissionais($id){
          $this->db->select('Funcionarios.id,Funcionarios.fExperiencias_Profissionais');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $row){
            return $row->fExperiencias_Profissionais;
          }
      }

      function mreadDPRO(){
          $this->db->select('Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Funcionarios.Grupos_Funcionarios_id,Grupos_Funcionarios.gfNome,
              Funcionarios.Categorias_Funcionarios_id,Categorias_Funcionarios.cfNome,
              Funcionarios.Departamentos_id,Departamentos.depNome,
              Funcionarios.Sectores_id,Sectores.secNome,
              Funcionarios.Cargos_id,Cargos.carNome,
              Funcionarios.Vinculos_Laborais_id,Vinculos_Laborais.vlNome,
              Funcionarios.fNumero_Agente, Funcionarios.fNumero_NIF,
              Funcionarios.fExperiencias_Profissionais,
              Funcoes.funcNome,Funcionarios.fData_Funcao,Funcionarios.fData_Admissao,Funcionarios.fSalario_Basico');
          $this->db->from('Funcionarios');
          //$this->db->join('Provincias', 'Funcionarios.fBI_Lugar_Emissao_Provincias_id = Provincias.id');
          //$this->db->join('Habilitacoes_Literarias_Funcionarios', 'Funcionarios.Habilitacoes_Literarias_Funcionarios_id = Habilitacoes_Literarias_Funcionarios.id');
          $this->db->join('Grupos_Funcionarios', 'Funcionarios.Grupos_Funcionarios_id = Grupos_Funcionarios.id');
          $this->db->join('Categorias_Funcionarios', 'Funcionarios.Categorias_Funcionarios_id = Categorias_Funcionarios.id');
          $this->db->join('Vinculos_Laborais', 'Funcionarios.Vinculos_Laborais_id = Vinculos_Laborais.id');
          $this->db->join('Departamentos', 'Funcionarios.Departamentos_id = Departamentos.id');
          $this->db->join('Sectores', 'Funcionarios.Sectores_id = Sectores.id');
          //$this->db->join('Provincias', 'Funcionarios.Endereco_Provincias_id = Provincias.id');
          //$this->db->join('Municipios', 'Funcionarios.Endereco_Municipios_id = Municipios.id');
          //$this->db->join('Bairros', 'Funcionarios.Endereco_Bairros_id = Bairros.id');
          $this->db->join('Cargos', 'Funcionarios.Cargos_id = Cargos.id');
          $this->db->join('Funcoes', 'Funcionarios.Funcoes_id = Funcoes.id');
          $this->db->order_by('fNome','ASC');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      //PARA CURRICULUM
      function mreadDPROXid($id){
          $this->db->select('Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Funcionarios.Grupos_Funcionarios_id,Grupos_Funcionarios.gfNome,
              Funcionarios.Categorias_Funcionarios_id,Categorias_Funcionarios.cfNome,
              Funcionarios.Departamentos_id,Departamentos.depNome,
              Funcionarios.Sectores_id,Sectores.secNome,
              Funcionarios.Cargos_id,Cargos.carNome,
              Funcionarios.Vinculos_Laborais_id,Vinculos_Laborais.vlNome,
              Funcionarios.fNumero_Agente, Funcionarios.fNumero_NIF,
              Funcionarios.fExperiencias_Profissionais');
          $this->db->from('Funcionarios');
          //$this->db->join('Provincias', 'Funcionarios.fBI_Lugar_Emissao_Provincias_id = Provincias.id');
          //$this->db->join('Habilitacoes_Literarias_Funcionarios', 'Funcionarios.Habilitacoes_Literarias_Funcionarios_id = Habilitacoes_Literarias_Funcionarios.id');
          $this->db->join('Grupos_Funcionarios', 'Funcionarios.Grupos_Funcionarios_id = Grupos_Funcionarios.id');
          $this->db->join('Categorias_Funcionarios', 'Funcionarios.Categorias_Funcionarios_id = Categorias_Funcionarios.id');
          $this->db->join('Vinculos_Laborais', 'Funcionarios.Vinculos_Laborais_id = Vinculos_Laborais.id');
          $this->db->join('Departamentos', 'Funcionarios.Departamentos_id = Departamentos.id');
          $this->db->join('Sectores', 'Funcionarios.Sectores_id = Sectores.id');
          //$this->db->join('Provincias', 'Funcionarios.Endereco_Provincias_id = Provincias.id');
          //$this->db->join('Municipios', 'Funcionarios.Endereco_Municipios_id = Municipios.id');
          //$this->db->join('Bairros', 'Funcionarios.Endereco_Bairros_id = Bairros.id');
          $this->db->join('Cargos', 'Funcionarios.Cargos_id = Cargos.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      function mreadDO(){
          $this->db->select('Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
                  Pais.paNome,Provincias.provNome,Municipios.munNome,Bairros.baiNome');
          $this->db->from('Funcionarios');
          $this->db->join('Enderecos_Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->join('Bairros', 'Enderecos_Funcionarios.Bairros_id = Bairros.id');
          $this->db->join('Municipios', 'Enderecos_Funcionarios.Municipios_id = Municipios.id');
          $this->db->join('Provincias', 'Enderecos_Funcionarios.Provincias_id = Provincias.id');
          $this->db->join('Pais', 'Enderecos_Funcionarios.Pais_id = Pais.id');
          $consulta = $this->db->get();
          return $consulta->result();
      }
      //para curriculum
      function mreadDOXid($id){
          $this->db->select('Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
                  Pais.paNome,Provincias.provNome,Municipios.munNome,Bairros.baiNome');
          $this->db->from('Funcionarios');
          $this->db->join('Enderecos_Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->join('Bairros', 'Enderecos_Funcionarios.Bairros_id = Bairros.id');
          $this->db->join('Municipios', 'Enderecos_Funcionarios.Municipios_id = Municipios.id');
          $this->db->join('Provincias', 'Enderecos_Funcionarios.Provincias_id = Provincias.id');
          $this->db->join('Pais', 'Enderecos_Funcionarios.Pais_id = Pais.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          return $consulta->result();
      }
      
      function mReadProvinciaEmissao($id){
          $this->db->select('Provincias.provNome');
          $this->db->from('Provincias');
          $this->db->join('BI_Lugar_Emissao_Provincias', 'BI_Lugar_Emissao_Provincias.Provincias_id = Provincias.id');
          $this->db->join('Funcionarios', 'BI_Lugar_Emissao_Provincias.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->provNome;
          }
      }
      function mReadEnderecoPais($id){
          $this->db->select('Pais.paNome');
          $this->db->from('Pais');
          $this->db->join('Enderecos_Funcionarios', 'Enderecos_Funcionarios.Pais_id = Pais.id');
          //$this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Enderecos_Funcionarios.Funcionarios_id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->paNome;
          }
      }
      function mReadEnderecoProvincias($id){
          $this->db->select('Provincias.provNome');
          $this->db->from('Provincias');
          $this->db->join('Enderecos_Funcionarios', 'Enderecos_Funcionarios.Provincias_id = Provincias.id');
          $this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->provNome;
          }
      }
      function mReadEnderecoMunicipios($id){
          $this->db->select('Municipios.munNome');
          $this->db->from('Municipios');
          $this->db->join('Enderecos_Funcionarios', 'Enderecos_Funcionarios.Municipios_id = Municipios.id');
          $this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->munNome;
          }
      }
      function mReadEnderecoBairros($id){
          $this->db->select('Bairros.baiNome');
          $this->db->from('Bairros');
          $this->db->join('Enderecos_Funcionarios', 'Enderecos_Funcionarios.Bairros_id = Bairros.id');
          $this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->baiNome;
          }
      }
      
      function mReadMunicipioEndereco($Bairros_id){
          $this->db->select('Municipios.munNome');
          $this->db->from('Municipios');
          //$this->db->join('Municipios', 'Municipios.Provincias_id = Provincias.id');
          $this->db->join('Bairros', 'Bairros.Municipios_id = Municipios.id');
          $this->db->where('Bairros.id', $Bairros_id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->munNome;
          }
      }
      function mReadProvinciaEndereco($Bairros_id){
          $this->db->select('Provincias.provNome');
          $this->db->from('Provincias');
          $this->db->join('Municipios', 'Municipios.Provincias_id = Provincias.id');
          $this->db->join('Bairros', 'Bairros.Municipios_id = Municipios.id');
          $this->db->where('Bairros.id', $Bairros_id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->provNome;
          }
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
      
      function mGetID2($bi){
          $this->db->select('Funcionarios.id');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.fBI_Passaporte', $bi);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mreadNomeXID($id){
          $this->db->select('Funcionarios.fNome');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->fNome;
          }
      }
      function mreadNomesXID($id){
          $this->db->select('Funcionarios.fNomes');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->fNomes;
          }
      }
      function mreadApelidoXID($id){
          $this->db->select('Funcionarios.fApelido');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->fApelido;
          }
      }
      function mreadNomeXBI($id){
          $this->db->select('Funcionarios.fNome');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.fBI_Passaporte', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->fNome;
          }
      }
      function mreadXbi($bi){
          $this->db->select('fNome, fNomes, fApelido');
          $this->db->from('Funcionarios');
          $this->db->where('fBI_Passaporte', $bi);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->fNome.' '.$value->fNomes.' '.$value->fApelido;
          }
      }
      function mreadIDXBI($bi){
          $this->db->select('id');
          $this->db->from('funcionarios');
          $this->db->where('funcionarios.fbi_passaporte', $bi);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->id;
          }
      }
      function mreadApelidoXBI($id){
          $this->db->select('Funcionarios.fApelido');
          $this->db->from('Funcionarios');
          $this->db->where('Funcionarios.fBI_Passaporte', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->fApelido;
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
      public function totalFuncionarios(){
        $this->db->select('Funcionarios.id');
          $this->db->from('Funcionarios');
        return $this->db->count_all_results();
      }

      //
      function mread_professores(){
          $this->db->select('Funcionarios.id,Funcionarios.fNome,Funcionarios.fNomes,Funcionarios.fApelido,Funcionarios.fBI_Passaporte,
              Funcionarios.Grupos_Funcionarios_id,Grupos_Funcionarios.gfNome');
          $this->db->from('Funcionarios');
          $this->db->join('Grupos_Funcionarios', 'Funcionarios.Grupos_Funcionarios_id = Grupos_Funcionarios.id');
          $this->db->order_by('fNome','ASC');
          $consulta = $this->db->get();
          return $consulta->result();
      }

      function mupdateDO($id,$fNome,$fNomes,$fApelido,$fBI_Passaporte,$fTelefone,$fTelefone1,$fEmail){
            $dados = array('fNome'=>$fNome,'fNomes'=>$fNomes,'fApelido'=>$fApelido,'fBI_Passaporte'=>$fBI_Passaporte,'fTelefone'=>$fTelefone,'fTelefone1'=>$fTelefone1,'fEmail'=>$fEmail);
            if($this->db->update('Funcionarios', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      function mupdateDPRO($id,$fNome,$fNomes,$fApelido,$fBI_Passaporte,$gfNome,$cfNome,$depNome,$secNome,$carNome,
        $vlNome,$fNumero_Agente,$fNumero_NIF,$fExperiencias_Profissionais,$funcNome,$fData_Funcao,$fData_Admissao,$fSalario_Basico){
            $dados = array('fNome'=>$fNome,'fNomes'=>$fNomes,'fApelido'=>$fApelido,'fBI_Passaporte'=>$fBI_Passaporte,
                'Grupos_Funcionarios_id'=>$gfNome,'Categorias_Funcionarios_id'=>$cfNome,'Departamentos_id'=>$depNome,'Sectores_id'=>$secNome,'Cargos_id'=>$carNome,'Vinculos_Laborais_id'=>$vlNome,
                'fNumero_Agente'=>$fNumero_Agente,'fNumero_NIF'=>$fNumero_NIF,'fExperiencias_Profissionais'=>$fExperiencias_Profissionais,
                'Funcoes_id'=>$funcNome,'fData_Funcao'=>$fData_Funcao,'fData_Admissao'=>$fData_Admissao,'fSalario_Basico'=>$fSalario_Basico);
            if($this->db->update('Funcionarios', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
      function mupdateDP($id,$festado,$fNome,$fNomes,$fApelido,$gNome,$ecNome,$paNome,$fBI_Passaporte,$fBI_Data_Emissao,
                $fData_Nascimento,$Nascimento_Provincias_id,$Nascimento_Municipios_id,$hlfNome){
            $dados = array('festado'=>$festado,'fNome'=>$fNome,'fNomes'=>$fNomes,'fApelido'=>$fApelido,'Generos_id'=>$gNome,'Estado_Civil_id'=>$ecNome,
            'Nacionalidade_Pais_id'=>$paNome,'fBI_Passaporte'=>$fBI_Passaporte,'fBI_Data_Emissao'=>$fBI_Data_Emissao,
            'fData_Nascimento'=>$fData_Nascimento,'Nascimento_Provincias_id'=>$Nascimento_Provincias_id,'Nascimento_Municipios_id'=>$Nascimento_Municipios_id,
            'Habilitacoes_Literarias_Funcionarios_id'=>$hlfNome);
            if($this->db->update('Funcionarios', $dados, array('id' => $id))){
                return true;
            }else
                return false;
      }
    //
    function minsertDP($festado,$fNome,$fNomes,$fApelido,$gNome,$ecNome,$paNome,$fBI_Passaporte,$fBI_Data_Emissao,
                $fData_Nascimento,$Nascimento_Provincias_id,$Nascimento_Municipios_id,$fTelefone,$fTelefone1,$fEmail,
                $Grupos_Funcionarios_id,$Categorias_Funcionarios_id,$Cargos_id,$Vinculos_Laborais_id,$fNumero_Agente,$fNumero_NIF,$Habilitacoes_Literarias_Funcionarios_id,$Departamentos_id,$Sectores_id,$fExperiencias_Profissionais,
                $EnderecoPais,$EnderecoProvincia,$EnderecoMunicipio,$EnderecoBairro,
                $funcNome,$fData_Funcao,$fData_Admissao,$fSalario_Basico){
        
        if($this->db->insert('Funcionarios', array('festado'=>$festado,'fNome'=>$fNome,'fNomes'=>$fNomes,'fApelido'=>$fApelido,'Generos_id'=>$gNome,'Estado_Civil_id'=>$ecNome,
            'Nacionalidade_Pais_id'=>$paNome,'fBI_Passaporte'=>$fBI_Passaporte,'fBI_Data_Emissao'=>$fBI_Data_Emissao,/*'BI_Lugar_Emissao_Provincias'=>$BI_Lugar_Emissao_Provincias,*/
            'fData_Nascimento'=>$fData_Nascimento,'Nascimento_Provincias_id'=>$Nascimento_Provincias_id,'Nascimento_Municipios_id'=>$Nascimento_Municipios_id,
            'fTelefone'=>$fTelefone,'fTelefone1'=>$fTelefone1,'fEmail'=>$fEmail,
            'Grupos_Funcionarios_id'=>$Grupos_Funcionarios_id,'Categorias_Funcionarios_id'=>$Categorias_Funcionarios_id,'Cargos_id'=>$Cargos_id,'Vinculos_Laborais_id'=>$Vinculos_Laborais_id,
            'fNumero_Agente'=>$fNumero_Agente,'fNumero_NIF'=>$fNumero_NIF,'Habilitacoes_Literarias_Funcionarios_id'=>$Habilitacoes_Literarias_Funcionarios_id,'Departamentos_id'=>$Departamentos_id,
            'Sectores_id'=>$Sectores_id,'fExperiencias_Profissionais'=>$fExperiencias_Profissionais,
            'Funcoes_id'=>$funcNome,'fData_Funcao'=>$fData_Funcao,'fData_Admissao'=>$fData_Admissao,'fSalario_Basico'=>$fSalario_Basico)))
        {
            return true;
            
        }else{
            return false;
        }
           
    }
    function mdelete($id) {
        if($this->db->delete('Funcionarios', array('id' => $id)))  
            return true;
        else
            return false;
        
    }
    function msalvarFoto($id,$codigo_foto){
        $dados = array('fFoto'=>$codigo_foto);
        if($this->db->update('Funcionarios', $dados, array('id' => $id))){
                return true;
            }else
                return false;
    }
    function mcargarFoto($id){
          $this->db->select('Funcionarios.fFoto');
          $this->db->from('Funcionarios');
          //$this->db->join('Enderecos_Funcionarios', 'Enderecos_Funcionarios.Pais_id = Pais.id');
          //$this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.id', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->fFoto;
          }
      }
     function mcargarFotoCB($id){
          $this->db->select('Funcionarios.fFoto');
          $this->db->from('Funcionarios');
          //$this->db->join('Enderecos_Funcionarios', 'Enderecos_Funcionarios.Pais_id = Pais.id');
          //$this->db->join('Funcionarios', 'Enderecos_Funcionarios.Funcionarios_id = Funcionarios.id');
          $this->db->where('Funcionarios.fBI_Passaporte', $id);
          $consulta = $this->db->get();
          foreach($consulta->result() as $value) {
              return $value->fFoto;
          }
      }

      //curriculum
      function mupdate_curriculum_dp($id,$fBI_Data_Emissao,$fBI_Provincia_Emissao,$fData_Nascimento,$Generos_id,$Estado_Civil_id,
        $Nacionalidade_Pais_id,$Nascimento_Provincias_id,$Nascimento_Municipios_id,$Habilitacoes_Literarias_Funcionarios_id,
        $fExperiencias_Profissionais){
            
            $dados = array('fBI_Data_Emissao'=>$fBI_Data_Emissao,'fData_Nascimento'=>$fData_Nascimento,'Generos_id'=>$Generos_id,'Estado_Civil_id'=>$Estado_Civil_id,
            'Nacionalidade_Pais_id'=>$Nacionalidade_Pais_id,'Nascimento_Provincias_id'=>$Nascimento_Provincias_id,'Nascimento_Municipios_id'=>$Nascimento_Municipios_id,
            'Habilitacoes_Literarias_Funcionarios_id'=>$Habilitacoes_Literarias_Funcionarios_id,'fExperiencias_Profissionais'=>$fExperiencias_Profissionais);
            if($this->db->update('Funcionarios', $dados, array('id' => $id))){
                $dados2 = array('Provincias_id' => $fBI_Provincia_Emissao);
                $this->load->model('MBI_Lugar_Emissao_Provincias');
                $idok = $this->MBI_Lugar_Emissao_Provincias->mGetID($id);
                if($this->db->update('BI_Lugar_Emissao_Provincias', $dados2, array('id' => $idok))){
                    return true;
                }else
                    return false;
            }else
                return false;
      }  
           
  }
?>
