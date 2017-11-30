<?php
class MTime extends CI_Model{
    /*
    *DETERMINAR SI HORA ESTA EN EL INTERVALO DE RANGO_INICIO A RANGO_FIN
    *PARA SABER SI UNA HORA ES DE LA SESSION MANHANA O TARDE
    */
    function pertenece_sesion($hora,$rango_inicio,$rango_fin){
        //$hora = "10:11:12";
        //$rango_inicio = "10:12:00";
        //$rango_fin = "10:30:00";

        list($h, $m, $s) = preg_split('[:]', $hora);
        list($hri, $mri, $sri) = preg_split('[:]', $rango_inicio);
        list($hrf, $mrf, $srf) = preg_split('[:]', $rango_fin);

        $hora = mktime($h, $m, $s, 0, 0, 0);
        $ri = mktime($hri ,$mri ,$sri ,0 ,0 , 0);
        $rf = mktime($hrf ,$mrf ,$srf ,0 ,0 , 0);
        if($hora > $ri && $hora < $rf)
            return true;
        else
            return false;
    }
    /*
    DETERMINAR SI HORA ACTUAL ES MENOR QUE HORA_ENTRADA
    */
    function menor_que($hora_actual,$hora_entrada){
        @list($ha, $ma, $sa) = @preg_split('[:]', $hora_actual);
        @list($he, $me, $se) = @preg_split('[:]', $hora_entrada);

        $hactual = @mktime($ha, $ma, $sa, 0, 0, 0);
        $hentrada = @mktime($he ,$me ,$se ,0 ,0 , 0);
        
        if($hactual <= $hentrada)
            return true;
        else
            return false;
    }
}