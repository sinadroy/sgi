<?php
class MCursos_Pretendidos extends CI_Model {

    /*
     * Datos
    */
    function mread($al,$i,$l) {
        $this->load->model('manos_lectivos');
        // $al = $this->manos_lectivos->mGetID($al);
        //$ala = $this->manos_lectivos->mGetID(date('Y'));
        $ala = date('Y');
        $this->db->select('Cursos_Pretendidos.id,Candidatos.cNome as Nome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            niveis.nNome,cursos.cNome,pNome,niveis_cursos.ncPreco_Inscricao,
            Cursos_Pretendidos.cp_ano_lec_insc');
        $this->db->from('Cursos_Pretendidos');
        $this->db->join('Candidatos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        
        if($al != "")
            $this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $al);
        else
            $this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $ala);

        $this->db->order_by('Nome,cApelido','ASC');
        $this->db->limit($l, $i);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row){
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "Nome" => $row->Nome,
                //"cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "nNome" => $row->nNome,
                "cNome" => $row->cNome,
                "pNome" => $row->pNome,
                "ncPreco_Inscricao" => $row->ncPreco_Inscricao,
                "cp_ano_lec_insc"=>$row->cp_ano_lec_insc
            );
            $ord++;
        }
        return $data;
    }

    function mread_search($al,$i,$l,$x) {
        $this->load->model('manos_lectivos');
        //$al = $this->manos_lectivos->mGetID($al);
        //$ala = $this->manos_lectivos->mGetID(date('Y'));
        $ala = date('Y');
        $this->db->select('Cursos_Pretendidos.id,Candidatos.cNome as Nome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
            niveis.nNome,cursos.cNome,pNome,niveis_cursos.ncPreco_Inscricao,
            Cursos_Pretendidos.cp_ano_lec_insc');
        $this->db->from('Cursos_Pretendidos');
        $this->db->join('Candidatos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        
        if($al != "")
            $this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $al);
        else
            $this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', $ala);

        $this->db->like('Candidatos.cNome',$x);
        $this->db->or_like('Candidatos.cNomes',$x);
        $this->db->or_like('Candidatos.cApelido',$x);
        $this->db->or_like('Candidatos.cBI_Passaporte',$x);
        $this->db->or_like('niveis.nNome',$x);
        $this->db->or_like('cursos.cNome',$x);
        $this->db->or_like('pNome',$x);
        $this->db->or_like('niveis_cursos.ncPreco_Inscricao',$x);
        $this->db->or_like('Cursos_Pretendidos.cp_ano_lec_insc',$x);

        $this->db->order_by('Nome,cApelido','ASC');
        $this->db->limit($l, $i);
        $consulta = $this->db->get();
        $ord=1;
        $data = array();
        foreach ($consulta->result() as $row){
            //$data[] = $row;
            $data[] = array(
                "id" => $row->id,
                "ord" => $ord,
                "Nome" => $row->Nome,
                //"cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "nNome" => $row->nNome,
                "cNome" => $row->cNome,
                "pNome" => $row->pNome,
                "ncPreco_Inscricao" => $row->ncPreco_Inscricao,
                "cp_ano_lec_insc"=>$row->cp_ano_lec_insc
            );
            $ord++;
        }
        return $data;
    }

    /*
        leer nivel curso periodo apartir del id de candidato
    */
    function mread_ncpXid($id){
        $this->db->select('niveis.nNome,cursos.cNome,periodos.pNome');
        $this->db->from('Cursos_Pretendidos');
        $this->db->join('Candidatos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('Financas_Pagamentos_Pendientes_Candidatos', 'Financas_Pagamentos_Pendientes_Candidatos.Candidatos_id = Candidatos.id');
        //$this->db->where('Candidatos.cEstado', "Espera de Pagamento");
        
        $this->db->where('Financas_Pagamentos_Pendientes_Candidatos.id', $id);
        
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row){
            $data[] = array(
                //"id" => $row->id,
                "nNome" => $row->nNome,
                "cNome" => $row->cNome,
                "pNome" => $row->pNome,
                "ncPreco_Inscricao" => $row->ncPreco_Inscricao
            );
        }
        return $data;
    }
    
    function mupdate($id,$cNome, $cNomes, $cApelido, $gNome, $ngNome, $cNome_Pai, $cNome_Mae, $cBI_Passaporte, $cBI_Data_Emissao, $provEmissao,
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
            return true;
        } else
            return false;
    }

    //select niveis_cursos_id apartir de nivel cursos y periodo
    function get_ncp_id($n,$c,$p){
        $this->db->select('niveis_cursos.id');
        $this->db->from('niveis_cursos');
        $this->db->where('niveis_cursos.niveis_id', $n);
        $this->db->where('niveis_cursos.cursos_id', $c);
        $this->db->where('niveis_cursos.periodos_id', $p);
        $consulta = $this->db->get();
        foreach ($consulta->result() as $row) {
            return $row->id;
        }
    }
    public function Existe($cBI_Passaporte, $nNome, $cNome, $pNome){
        $this->load->model('mCandidatos');
        $candidatos_id = $this->mCandidatos->mreadIDxBI($cBI_Passaporte);
        $niveis_cursos_id = $this->get_ncp_id($nNome,$cNome,$pNome);

        $this->db->select('Cursos_Pretendidos.id');
        $this->db->from('Cursos_Pretendidos');
        $this->db->where('Cursos_Pretendidos.Candidatos_id', $candidatos_id);
        $this->db->where('Cursos_Pretendidos.niveis_cursos_id', $niveis_cursos_id);
        $this->db->where('Cursos_Pretendidos.cp_ano_lec_insc', date('Y'));
        if($this->db->count_all_results() > 0)
            return true;
        else
            return false;
    }
    function minsert($cBI_Passaporte, $nNome, $cNome, $pNome, $cp_ano_lec_insc){
        $this->load->model('mCandidatos');
        $candidatos_id = $this->mCandidatos->mreadIDxBI($cBI_Passaporte);
        $niveis_cursos_id = $this->get_ncp_id($nNome,$cNome,$pNome);
        $cursos_pretendidos = array('Candidatos_id'=>$candidatos_id, 'niveis_cursos_id'=>$niveis_cursos_id, 'cp_ano_lec_insc'=>$cp_ano_lec_insc);
        $existe = $this->Existe($candidatos_id, $nNome, $cNome, $pNome);
        if($existe == false){
            if($this->db->insert('Cursos_Pretendidos', $cursos_pretendidos))
            {
                return true;
            } else {
                return false;
            }
        } else {
                return false;
            }
        
    }

    function mdelete($id) {
        if($this->db->delete('Cursos_Pretendidos', array('id' => $id)))
            return true;
        else
            return false;
    }

}

?>
