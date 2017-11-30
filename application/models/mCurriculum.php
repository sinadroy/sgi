<?php
  class MCurriculum extends CI_Model{
    
    var $hpdf = '';
    
    function dtMes($mes) {
        $nome = "";
        switch ($mes) {
            case '1':
                $nome = "Janeiro";
                break;
            case '2':
                $nome = "Fevereiro";
                break;
            case '3':
                $nome = "Mar&ccedil;o";
                break;
            case '4':
                $nome = "Abril";
                break;
            case '5':
                $nome = "Maio";
                break;
            case '6':
                $nome = "Junho";
                break;
            case '7':
                $nome = "Julho";
                break;
            case '8':
                $nome = "Agosto";
                break;
            case '9':
                $nome = "Setembro";
                break;
            case '10':
                $nome = "Outubro";
                break;
            case '11':
                $nome = "Novembro";
                break;
            case '12':
                $nome = "Dezembro";
                break;
            default:
                $nome = "Janeiro";
                break;
        }
        return $nome;
    }
    
    public function criarPdf($dp, $dpro, $do, $aFF, $aOF, $aPUB, $aEV, $aLin)
    {
        $this->load->library('hpdf');
        date_default_timezone_set('UTC');
        $this->hpdf = new HTML2PDF('P','A4','pt','true','UTF-8');

        //cargar logotipo de documento
     /*   $this->load->model('MLogo');
        $logotipo = $this->MLogo->mread_logo_documentos();
        $logotipo_height = $this->MLogo->mread_logo_documentos_height();
        $logotipo_width = $this->MLogo->mread_logo_documentos_width();
        $logotipo_titulo = $this->MLogo->mread_logo_documentos_titulo();
       */ 
        //DADOS GERAIS
        
        $fNome = "";
        $fNomes = "";
        $fApelido = "";
        $fBI_Passaporte = "";
        $fData_Nascimento = "";
        $fidade = "";
        $gNome = "";
        $ecNome = "";
        $paNome = "";
        $munNome = ""; //Naturalidade - municipio de nascimento
        $fTelefone = "";
        $fEmail = "";
        $hlfNome = "";
        
        //$contador = 1;
        foreach ($dp as $value) {
            $fNome = $value['fNome'];
            $fNomes = $value['fNomes'];
            $fApelido = $value['fApelido'];
            $fBI_Passaporte = $value['fBI_Passaporte'];
            $fData_Nascimento = $value['fData_Nascimento'];
            $fidade = $value['fidade'];
            $gNome = $value['gNome'];
            $ecNome = $value['ecNome'];
            $paNome = $value['paNome'];
            $munNome = $value['munNome'];
            $fTelefone = $value['fTelefone'];
            $fEmail = $value['fEmail'];
            $hlfNome = $value['hlfNome'];
            //$contador++;
        }
        
        //DADOS PROFISSIONAIS
        $cfNome = ""; //categoria de funcionario (docente o administrativo)
        $fExperiencias_Profissionais = "";
        $vlNome = "";
        $carNome ="";
        foreach ($dpro as $value1) {
            $cfNome = $value1['cfNome'];
            $fExperiencias_Profissionais = $value1['fExperiencias_Profissionais'];
            $vlNome = $value1['vlNome'];
            $carNome = $value1['carNome'];
        }
        //DADOS OUTROS
        $bairro = "";
        $municipio = "";
        $provincia = "";
        $pais = "";
        foreach ($do as $value2) {
            $bairro = $value2['baiNome'];
            $municipio = $value2['munNome'];
            $provincia = $value2['provNome'];
            $pais = $value2['paNome'];
        }
        //formacao funcionarios
        $fofuAno_Inicio = "";
        $fofuAno_Fin = "";
        $fofuCurso = "";
        $univNome = "";
        $paisFormacao = "";
        $listaFormacoes = "";
        foreach ($aFF as $value3) {
            $fofuAno_Inicio = $value3['fofuAno_Inicio'];
            $fofuAno_Fin = $value3['fofuAno_Fin'];
            $fofuCurso = $value3['fofuCurso'];
            $univNome = $value3['univNome'];
            $paisFormacao = $value3['paNome'];
            
            $listaFormacoes = $listaFormacoes.'
                <tr><td border="0" align="left">- '.$fofuAno_Inicio.' - '.$fofuAno_Fin.': '.$fofuCurso.', '.$univNome.', '.$paisFormacao.'</td></tr>
            ';
        }
        //Formacao profissional
        $ofData_Inicio = "";
        $ofData_Fim = "";
        $ofCurso= "";
        $ofInstituicao = "";
        $paisOF = "";
        $listaOF = "";
        foreach ($aOF as $value4) {
            $ofData_Inicio = $value4['ofData_Inicio'];
            $ofData_Fim = $value4['ofData_Fim'];
            $ofCurso = $value4['ofCurso'];
            $ofInstituicao = $value4['ofInstituicao'];
            $ofTipo_Formacao = $value4['ofTipo_Formacao'];
            $paisOF = $value4['paNome'];
            
            $listaOF = $listaOF.'
                <tr><td border="0" align="left">- '.$ofData_Inicio.' - '.$ofData_Fim.': '.$ofCurso.', '.$ofTipo_Formacao.', '.$ofInstituicao.', '.$paisOF.'</td></tr>
            ';
        }
        //publicacoes
        $pubTitulo = "";
        $pubAno = "";
        $pubEditora_Revista = "";
        $pubISBN_ISSN = "";
        $paPub = "";
        $tpubNome = "";
        $listaPUB = "";
        foreach ($aPUB as $value5) {
            $pubTitulo = $value5['pubTitulo'];
            $pubAno = $value5['pubAno'];
            $pubEditora_Revista = $value5['pubEditora_Revista'];
            $pubISBN_ISSN = $value5['pubISBN_ISSN'];
            $tpubNome = $value5['tpubNome'];
            $paPub = $value5['paNome'];
            
            $listaPUB = $listaPUB.'
                <tr><td border="0" align="left">- '.$pubAno.': '.$pubTitulo.', '.$tpubNome.', '.$pubEditora_Revista.', '.$pubISBN_ISSN.', '.$paPub.'</td></tr>
            ';
        }
        //Eventos
        $evTitulo = "";
        $evInstituicao = "";
        $evAno = "";
        $paisEV = "";
        $teNome = "";
        $listaEV = "";
        foreach ($aEV as $value5) {
            $evTitulo = $value5['evTitulo'];
            $evInstituicao = $value5['evInstituicao'];
            $evAno = $value5['evAno'];
            $teNome = $value5['teNome'];
            $paisEV = $value5['paNome'];
            
            $listaEV = $listaEV.'
                <tr><td border="0" align="left">- '.$evAno.': '.$evTitulo.', '.$teNome.', '.$evInstituicao.', '.$paisEV.'</td></tr>
            ';
        }
        //Linguas
        $linNome = "";
        $lnNome = "";
        $listaLin = "";
        foreach ($aLin as $value6) {
            $linNome = $value6['linNome'];
            $lnNome = $value6['lnNome'];
            
            $listaLin = $listaLin.'
                <tr><td align="left" width="200">'.$linNome.'</td> <td align="left" width="200">'.$lnNome.'</td></tr>
            ';
        }
        
        $mes = $this->dtMes(date('m'));
        
        $content = '
            <page>
                <div align="center">
                    <table align="center" border="1">
                        <tr ><td border="0" align="center" width="600"> <h2>Curriculum Vitae</h2><br> </td></tr>
                       <!-- <tr ><td border="0" align="right" width="600"> <b>Data: '.date("d-m-Y").'</b><br> </td></tr> -->
                    </table>
                    <br>
                </div>
                <div align="left">
                    <table>
                        <tr><td border="0" align="left"><h5>DADOS GERAIS</h5></td></tr>
                        <tr><td border="0" align="left"><b>- Nome:</b> '.$fNome.' '.$fNomes.' '.$fApelido.' </td></tr>
                        <tr><td border="0" align="left"><b>- Genero:</b> '.$gNome.'</td></tr>
                        <tr><td border="0" align="left"><b>- Data de Nascimento:</b> '.$fData_Nascimento.' </td></tr>
                        <tr><td border="0" align="left"><b>- Idade:</b> '.$fidade.' </td></tr>
                        <tr><td border="0" align="left"><b>- Estado Civil:</b> '.$ecNome.'</td></tr>
                        <tr><td border="0" align="left"><b>- BI/Passaporte:</b> '.$fBI_Passaporte.'</td></tr>
                        <tr><td border="0" align="left"><b>- Nacionalidade:</b> '.$paNome.'</td></tr>
                        <tr><td border="0" align="left"><b>- Naturalidade:</b> '.$munNome.'</td></tr>    
                        <tr><td border="0" align="left"><b>- Telefone:</b> '.$fTelefone.'</td></tr>
                        <tr><td border="0" align="left"><b>- Email:</b> '.$fEmail.'</td></tr>
                        <tr><td border="0" align="left"><b>- Endere&ccedil;o:</b> '.$provincia.', '.$municipio.', '.$bairro.' </td></tr>
                    </table>
                    <br>
                </div>
                <div align="left">
                    <table>
                        <tr><td border="0" align="left"><h5>HABILITA&Ccedil;&Otilde;ES LITERARIAS</h5></td></tr>
                        '.$listaFormacoes.'
                    </table>
                    <br>
                </div>
                <div align="left">
                    <table>
                        <tr><td border="0" align="left"><h5>OUTRAS FORMA&Ccedil;&Otilde;ES</h5></td></tr>
                        '.$listaOF.'
                    </table>
                    <br>
                </div>
                <div align="left">
                    <table>
                        <tr><td border="0" align="left"><h5>PUBLICA&Ccedil;&Otilde;ES</h5></td></tr>
                        '.$listaPUB.'
                    </table>
                    <br>
                </div>
                <div align="left">
                    <table>
                        <tr><td border="0" align="left"><h5>PARTICIPA&Ccedil;&Atilde;O EM EVENTOS</h5></td></tr>
                        '.$listaEV.'
                    </table>
                    <br>
                
                <div align="left">
                    <table>
                        <tr><td border="0" align="left"><h5>EXPERIENCIAS PROFISSIONAIS</h5></td></tr>
                        <tr><td border="0" align="left"><p>'.$fExperiencias_Profissionais.'</p></td></tr>
                    </table>
                    <br>
                </div>
                </div>
                
                <div align="left">
                <h5>HABILITA&Ccedil;&Otilde;ES LINGU&Iacute;STICAS</h5>
                    <table border="1" cellpadding="0" cellspacing="0">
                        <!-- <tr><td align="left"><h5>HABILITA&Ccedil;&Otilde;ES LINGU&Iacute;STICAS</h5></td></tr> -->
                        <tr bgcolor="gray"><td align="left" width="200">L&iacute;nguas</td><td align="left" width="200">Nivel</td></tr>
                        '.$listaLin.'
                    </table>
                    <br>
                </div>
                <div>
                    <br>
                    <table align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                        <td><p><b>Huambo, '.date("d").' de '.$mes.' de '.date('Y').'.</b></p> </td>
                        </tr>
                        <tr>
                            <td width="300" height="10" align="left"></td>
                        </tr>
                        <tr>
                            <td width="300" height="10" align="left"></td>
                        </tr>
                        <tr>
                            <td width="300" height="10" align="left"></td>
                        </tr>
                        <tr>
                            <td width="300" height="10" align="left"><p><b>_________________________</b></p></td>
                        </tr>    
                        <tr>
                            <td width="300" height="20" align="left"><p>'.$fNome.' '.$fNomes.' '.$fApelido.'</p></td>
                        </tr>
                    </table>
                </div>
            </page>
        ';
        $this->hpdf->WriteHTML($content);
        //APPPATH."libraries/html2pdf_v4.03/
        $this->hpdf->Output('relatorios/curriculum.pdf','F');
        echo "true";
    }       
  }
