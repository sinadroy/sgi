<?php
  class MFinancas_Inscricao_2S_Comprovativo extends CI_Model{
    
    var $hpdf = '';
    /*
    Retornar candidatos_id
    */
    function getCandidatos_id($id){
        $this->db->select('Cursos_Pretendidos_2S.Candidatos_id');
        $this->db->from('Cursos_Pretendidos_2S');
        $this->db->join('Candidatos', 'Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->where('Cursos_Pretendidos_2S.id', $id);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            $cid = $row->Candidatos_id;
        }
        return $cid;
    }
/*
    function getBI($id){
        $this->db->select('Candidatos.cBI_Passaporte');
        $this->db->from('Cursos_Pretendidos');
        $this->db->join('Candidatos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->where('Cursos_Pretendidos.id', $id);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            $bi = $row->cBI_Passaporte;
        }
        return $bi;
    }
    */
    function getBI($id){
        $this->db->select('Candidatos.cBI_Passaporte');
        $this->db->from('Cursos_Pretendidos_2S');
        $this->db->join('Candidatos', 'Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->where('Candidatos.id', $id);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            $bi = $row->cBI_Passaporte;
        }
        return $bi;
    }
    /*
     * Datos para comprobativo de Inscricaos
    */
    function mread($bi,$id) {
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.anos_lectivos_id,anos_lectivos.alAno,
                Candidatos.cEstado,
                niveis.nNome,cursos.cNome as curso,periodos.pNome,
                niveis_cursos.ncPreco_Inscricao2s');
        $this->db->from('Cursos_Pretendidos_2S');
        $this->db->join('Candidatos', 'Cursos_Pretendidos_2S.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos_2S.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        //$this->db->where('Candidatos.cBI_Passaporte', $bi);
        $this->db->where('Cursos_Pretendidos_2S.Candidatos_id', $id);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                "nNome" => $row->nNome,
                "curso" => $row->curso,
                "pNome" => $row->pNome,
                "ncPreco_Inscricao2s" => $row->ncPreco_Inscricao2s,
                "alAno" => $row->alAno
            );
        }
        return $data;
    }
    /*
        Registrar pagamento de Inscricao
    */
    function registrar_pagamento_inscricao($Candidatos_id,$fpcCodigoBarra,$fpcData,$fpcHora,$fpcValor,$fpcRefPagamento,
                                                        $ftpNome,$ffpNome,$contNumero,$uid,$utilizadores_id){
        $this->load->model('MFinancas_Pagamentos_Candidatos');
        if($this->MFinancas_Pagamentos_Candidatos->minsert($Candidatos_id,$fpcCodigoBarra,$fpcData,$fpcHora,$fpcValor,$fpcRefPagamento,
                                                        $ftpNome,$ffpNome,$contNumero,$uid,$utilizadores_id)){
            $this->load->model('MCandidatos');
            $this->MCandidatos->cambiar_estado_2s($Candidatos_id,"Inscrição aceite");
            return true;
        }else
            return false;
    }

    public function criarPdf($id,$total_pagar,$bancNome,$contNumero,$ffpNome,$fpcRefPagamento,$utilizadores_id)
    {
        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('P','A4','pt','true','UTF-8');
        
        //DADOS GERAIS
        $Candidatos_id = $id;
        //$Candidatos_id = $this->getCandidatos_id($id);
        $cNome = "";
        $cNomes = "";
        $cApelido = "";
        $cBI_Passaporte = "";
        $nNome = "";
        $cNome = "";
        $pNome = "";
        $ncPreco_Inscricao = "";
        $alAno = "";
        
        //converter mes em texto
        $this->load->model('MFormato_Mes');
        $mes = $this->MFormato_Mes->dtMes(date("m"));

        //cargar logotipo de documento
        $this->load->model('MLogo');
        $logotipo = $this->MLogo->mread_logo_documentos();
        $logotipo_height = $this->MLogo->mread_logo_documentos_height();
        $logotipo_width = $this->MLogo->mread_logo_documentos_width();
        $logotipo_titulo = $this->MLogo->mread_logo_documentos_titulo();
        $logo_pie_firma = $this->MLogo->mread_logo_pie_firma();

        $listaInscricao = "";

        //registrar registrar_pagamento_inscricao
        $data = date('Y')."-".date("m").'-'.date("d");
        $hoy = getdate();
        $fpcHora = $hoy['hours'].':'.$hoy['minutes'].':'.$hoy['seconds'];
        $this->load->model('MFinancas_Tipo_Pagamento');
        $ftpNome = $this->MFinancas_Tipo_Pagamento->mreadXtipo("Inscrição 2 sessão");
        //utilizador id
        $this->load->model('mutilizadores');
        $uid = $this->mutilizadores->mreadXnome($utilizadores_id);
        $this->registrar_pagamento_inscricao($Candidatos_id,"",$data,$fpcHora,$total_pagar,$fpcRefPagamento,
                                        $ftpNome,$ffpNome,$contNumero,$uid,$utilizadores_id);

        //$contador = 1;
        //$this->load->model('mCandidatos');
        $bi = $this->getBI($id);
        foreach ($this->mread($bi,$id) as $value) {
            $cNome = $value['cNome'];
            $cNomes = $value['cNomes'];
            $cApelido = $value['cApelido'];
            $cBI_Passaporte = $value['cBI_Passaporte'];
            $nNome = $value['nNome'];
            $curso = $value['curso'];
            $pNome = $value['pNome'];
            $ncPreco_Inscricao = $value['ncPreco_Inscricao2s'];
            $alAno = $value['alAno'];
            //$contador++;
            $listaInscricao = $listaInscricao.'
                <tr><td align="left">'.$nNome.'</td> <td align="left">'.$curso.'</td><td>'.$pNome.'</td><td>'.$ncPreco_Inscricao.',00 Kz</td></tr>
            ';
        }
        
        $content = '
            <page>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h3>Finan&ccedil;as Comprovativo de Inscri&ccedil;&atilde;o 2º Sess&atilde;o</h3><br> </td></tr>
                    </table>
                    <br>
                    <table>
                        <tr ><td border="0" align="left"> Nome Completo: '.$cNome.' '.$cNomes.' '.$cApelido.'</td></tr>
                        <tr ><td border="0" align="left"> BI/Passaporte: '.$cBI_Passaporte.'</td></tr>
                        <tr> <td border="0" align="left">Ano Lectivo: '.$alAno.'</td> </tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr><td  width="200"><b>N&iacute;vel</b></td> <td width="300"><b>Curso</b></td><td width="100"><b>Per&iacute;odo</b></td><td width="100"><b>Pre&ccedil;o Insc.</b></td></tr>
                        '.$listaInscricao.'
                        <tr><td  width="200"><b></b></td> <td width="300"><b></b></td><td width="100"><b>Total:</b></td><td width="100"><b>'.$total_pagar.'</b></td></tr>
                    </table>
                    <br>
                </div>
                
                <div>
                    <table>
                        <tr ><td border="0" align="left"> Funcionario: '.$utilizadores_id.'</td></tr>
                    </table>
                    <table align="right" width="300" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="right"><p><b>'.$logo_pie_firma.', '.date("d").' de '.$mes.' de '.date('Y').'.</b></p> </td>
                        </tr>
                    </table>
                    <br>
                </div>
                <div>
                <p>================================================================================================</p>
                </div>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h3>Finan&ccedil;as Comprovativo de Inscri&ccedil;&atilde;o 2º Sess&atilde;o</h3><br> </td></tr>
                    </table>
                    <br>
                    <table>
                        <tr ><td border="0" align="left"> Nome Completo: '.$cNome.' '.$cNomes.' '.$cApelido.'</td></tr>
                        <tr ><td border="0" align="left"> BI/Passaporte: '.$cBI_Passaporte.'</td></tr>
                        <tr> <td border="0" align="left">Ano Lectivo: '.$alAno.'</td> </tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0.5" cellpadding="0" cellspacing="0">
                        <tr><td  width="200"><b>N&iacute;vel</b></td> <td width="300"><b>Curso</b></td><td width="100"><b>Per&iacute;odo</b></td><td width="100"><b>Pre&ccedil;o Insc.</b></td></tr>
                        '.$listaInscricao.'
                        <tr><td  width="200"><b></b></td> <td width="300"><b></b></td><td width="100"><b>Total:</b></td><td width="100"><b>'.$total_pagar.'</b></td></tr>
                    </table>
                    <br>
                </div>
              
                <div>
                    <table>
                        <tr ><td border="0" align="left"> Funcionario: '.$utilizadores_id.'</td></tr>
                    </table>
                    <table align="right" width="300" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="right"><p><b>'.$logo_pie_firma.', '.date("d").' de '.$mes.' de '.date('Y').'.</b></p> </td>
                        </tr>
                    </table>
                    <br>
                </div>
            </page>
        ';
        $this->hpdf->WriteHTML($content);
        //APPPATH."libraries/html2pdf_v4.03/
        $this->hpdf->Output('relatorios/Financas_Inscricao_2S_Comprovativo.pdf','F');
        echo "true";
    }       
  }
