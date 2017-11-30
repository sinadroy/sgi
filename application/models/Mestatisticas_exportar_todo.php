<?php
header("Content-Type: text/html;charset=utf-8");
  class Mestatisticas_exportar_todo extends CI_Model{
    
    
    /*
     * Datos para comprobativo de Inscricaos
    */
    function mread() {
        //mysql_query("SET NAMES 'utf8'");
        $this->db->query("SET NAMES 'utf8'");

        $this->db->select('Candidatos.id,Candidatos.cNome,Candidatos.cNomes,Candidatos.cApelido,Candidatos.cBI_Passaporte');
        $this->db->from('Candidatos');
        //$this->db->join('Estudantes', 'Estudantes.Candidatos_id = Candidatos.id');
        //$this->db->join('niveis_cursos', 'Estudantes.niveis_cursos_id = niveis_cursos.id');
        //$this->db->join('niveis', 'niveis_cursos.niveis_id = niveis.id');
        //$this->db->join('cursos', 'niveis_cursos.cursos_id = cursos.id');
        //$this->db->join('periodos', 'niveis_cursos.periodos_id = periodos.id');
        //$this->db->join('anos_lectivos', 'Candidatos.anos_lectivos_id = anos_lectivos.id');
        //$this->db->where('Candidatos.cBI_Passaporte', $id);
        $consulta = $this->db->get();
        $data = array();
        foreach ($consulta->result() as $row) {
            $data[] = array(
                "id" => $row->id,
                "cNome" => $row->cNome,
                "cNomes" => $row->cNomes,
                "cApelido" => $row->cApelido,
                "cBI_Passaporte" => $row->cBI_Passaporte,
                //"nNome" => $row->nNome,
                //"curso" => $row->curso,
                //"pNome" => $row->pNome,
                //"ncPreco_Confirmacao" => $row->ncPreco_Confirmacao,
                //"alAno" => $row->alAno
            );
        }
        return $data;
    }
    

    public function criarExcel()
    {
        
        date_default_timezone_set('UTC');
        
        
        //$id = $this->MCandidatos->mreadIDxBI($bi);
        //echo "verificar id: ".$id;

        
        //DADOS GERAIS
        $cNome = "";
        $cNomes = "";
        $cApelido = "";
        $cBI_Passaporte = "";
        $nNome = "";
        $cNome = "";
        $pNome = "";
        $ncPreco_Confirmacao = "";
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
        $contador = 0;
        //foreach ($this->mread() as $value) {
        $this->load->model('Mcandidatos');
        foreach ($this->Mcandidatos->mreadto_Excel() as $value) {    
            $cNome = $value['cNome'];
            $cNomes = $value['cNomes'];
            $cApelido = $value['cApelido'];
            $cBI_Passaporte = $value['cBI_Passaporte'];
            $contador++;
            $listaInscricao = $listaInscricao.'<tr><td align="left">'.utf8_encode($cNome).'</td> <td align="left">'.$cNomes.'</td><td>'.$cApelido.'</td></tr>';
        }
        
        //registrar log
        //$this->load->model('MAuditorias_Academicas');
        //$this->MAuditorias_Academicas->minsert("Transf. Matrícula","Academica","Transf.Matricula",$utilizadores_id,"Estudante: ".$cNome.' '.$cApelido.' BI: '.$cBI_Passaporte.' Transferido com sucesso');

        $content = '
                    <head>
                        <meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
                    </head>
                    <body>
                        <table align="center" border="1" cellpadding="0" cellspacing="0">
                            <tr><td  width="100"><b>Nome</b></td> <td width="300"><b>Nomes</b></td><td width="200"><b>Apelido</b></td></tr>
                            '.$listaInscricao.'
                        </table>
                    </body>
        ';

        header("Content-type: application/vnd.ms-excel"); 
        header("Content-disposition: attachment; filename=listaCandidatos.xls"); 
        print $content; 
        //exit; 

        //$this->hpdf->WriteHTML($content);
        //APPPATH."libraries/html2pdf_v4.03/
        //$this->hpdf->Output('relatorios/Academica_Confirmacao_Comprobativo.pdf','F');
        //echo "true";
    }       
  }
