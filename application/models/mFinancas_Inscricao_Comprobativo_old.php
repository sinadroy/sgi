<?php
  class MFinancas_Inscricao_Comprobativo extends CI_Model{
    
    var $hpdf = '';
    /*
    Retornar candidatos_id
    */
    function getCandidatos_id($id){
        $this->db->select('Cursos_Pretendidos.Candidatos_id');
        $this->db->from('Cursos_Pretendidos');
        $this->db->join('Candidatos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->where('Cursos_Pretendidos.id', $id);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            $cid = $row->Candidatos_id;
        }
        return $cid;
    }

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
    /*
     * Datos para comprobativo de Inscricaos
    */
    function mread($id) {
        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte,
                Candidatos.anos_lectivos_id,anos_lectivos.alAno,
                Candidatos.cEstado,
                niveis.nNome,cursos.cNome as curso,periodos.pNome,
                niveis_cursos.ncPreco_Inscricao');
        $this->db->from('Cursos_Pretendidos');
        $this->db->join('Candidatos', 'Cursos_Pretendidos.Candidatos_id = Candidatos.id');
        $this->db->join('niveis_cursos', 'Cursos_Pretendidos.niveis_cursos_id = niveis_cursos.id');
        $this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        $this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        $this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        $this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        $this->db->where('Candidatos.cBI_Passaporte', $id);
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
                "ncPreco_Inscricao" => $row->ncPreco_Inscricao,
                "alAno" => $row->alAno
            );
        }
        return $data;
    }

    public function criarPdf($id,$codigo_barra)
    {
        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('P','A4','pt','true','UTF-8');

        //cargar logotipo de documento
        $this->load->model('MLogo');
        $logotipo = $this->MLogo->mread_logo_documentos();
        $logotipo_height = $this->MLogo->mread_logo_documentos_height();
        $logotipo_width = $this->MLogo->mread_logo_documentos_width();
        $logotipo_titulo = $this->MLogo->mread_logo_documentos_titulo();
        
        //DADOS GERAIS
        $Candidatos_id = $this->getCandidatos_id($id);
        $cNome = "";
        $cNomes = "";
        $cApelido = "";
        $cBI_Passaporte = "";
        $nNome = "";
        $cNome = "";
        $pNome = "";
        $ncPreco_Inscricao = "";
        $alAno = "";
        $listaInscricao = "";
        //$contador = 1;
        //$this->load->model('mCandidatos');
        $bi = $this->getBI($id);
        foreach ($this->mread($bi) as $value) {
            $cNome = $value['cNome'];
            $cNomes = $value['cNomes'];
            $cApelido = $value['cApelido'];
            $cBI_Passaporte = $value['cBI_Passaporte'];
            $nNome = $value['nNome'];
            $curso = $value['curso'];
            $pNome = $value['pNome'];
            $ncPreco_Inscricao = $value['ncPreco_Inscricao'];
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
                        <tr ><td border="0" align="center" width="600"> <h2>Comprovativo de Inscri&ccedil;&atilde;o</h2><br> </td></tr>
                    </table>
                    <br>
                    <table>
                        <tr ><td border="0" align="left">Ano Lectivo: '.$alAno.'</td> <td border="0" align="left"> Nome Candidato: '.$cNome.' '.$cNomes.' '.$cApelido.'</td></tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="1">
                        <tr><td  width="200"><b>N&iacute;vel</b></td> <td width="200"><b>Curso</b></td><td width="200"><b>Per&iacute;odo</b></td><td width="100"><b>Pre&ccedil;o Insc.</b></td></tr>
                        '.$listaInscricao.'
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0">
                        <tr><td width="200"><img src="data:image/png;base64,' . base64_encode($codigo_barra) . '"></td></tr>
                    </table>
                </div>
                <div>
                    <br>
                    <table align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                        <td><p><b>Huambo, '.date("d").' de '.date("m").' de '.date('Y').'.</b></p> </td>
                        </tr>
                    </table>
                </div>
                <div>
                <p>================================================================================================</p>
                </div>
                <div align="center">
                    <img src='.APPPATH.'../resources/images/'.$logotipo.' border="0" height='.$logotipo_height.' width='.$logotipo_width.'/><br><br>
                    <b>'.$logotipo_titulo.'</b><br>
                    <br>
                    <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h2>Comprovativo de Inscri&ccedil;&atilde;o</h2><br> </td></tr>
                    </table>
                    <br>
                    <table>
                        <tr ><td border="0" align="left">Ano Lectivo: '.$alAno.'</td> <td border="0" align="left"> Nome Candidato: '.$cNome.' '.$cNomes.' '.$cApelido.'</td></tr>
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="1">
                        <tr><td  width="200"><b>N&iacute;vel</b></td> <td width="200"><b>Curso</b></td><td width="200"><b>Per&iacute;odo</b></td><td width="100"><b>Pre&ccedil;o Insc.</b></td></tr>
                        '.$listaInscricao.'
                    </table>
                    <br>
                </div>
                <div align="center">
                    <table align="center" border="0">
                        <tr><td width="200"><img src="data:image/png;base64,' . base64_encode($codigo_barra) . '"></td></tr>
                    </table>
                </div>
                <div>
                    <br>
                    <table align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                        <td><p><b>Huambo, '.date("d").' de '.date("m").' de '.date('Y').'.</b></p> </td>
                        </tr>
                    </table>
                </div>
            </page>
        ';
        $this->hpdf->WriteHTML($content);
        //APPPATH."libraries/html2pdf_v4.03/
        $this->hpdf->Output('relatorios/Cursos_Pretendidos_Comprobativo.pdf','F');
        echo "true";
    }       
  }
