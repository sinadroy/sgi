<?php
  class MFormato_Mes extends CI_Model{
    
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

    function dtMesNumero($mes) {
        $nome = "";
        switch ($mes) {
            case "Janeiro":
                $nome = 1;
                break;
            case "Fevereiro":
                $nome = 2;
                break;
            case "Março":
                $nome = 3;
                break;
            case "Abril":
                $nome = 4;
                break;
            case "Maio":
                $nome = 5;
                break;
            case "Junho":
                $nome = 6;
                break;
            case "Julho":
                $nome = 7;
                break;
            case "Agosto":
                $nome = 8;
                break;
            case "Setembro":
                $nome = 9;
                break;
            case "Outubro":
                $nome = 10;
                break;
            case "Novembro":
                $nome = 11;
                break;
            case "Dezembro":
                $nome = 12;
                break;
        }
        return $nome;
    }  
  }
