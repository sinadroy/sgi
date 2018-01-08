<?php
//echo date("G:i:s");
/*
$fppcData = date("Y").'-'.date("m").'-'.date('d');
            $hora = date("G:i:s");
            //gerar codigo de barra
            $codigo = "i2 ".$fppcData." ".$hora;
echo $codigo;
*/
/*
$cb = 0;
do{
    $cb++;
    if($cb == 5)
        echo "true";
}
while($cb != 5);
*/
//echo is_string("");
//echo strtoupper ( "asdasd" );
//echo md5('fmv2017***');
/*
function pertenece_sesion($data,$data_inicio,$data_fin){

        list($m, $d, $a) = preg_split('[-]', $data);
        list($mesi, $diai, $anoi) = preg_split('[-]', $data_inicio);
        list($mesf, $diaf, $anof) = preg_split('[-]', $data_fin);

        $data = mktime(0, 0, 0, $m, $d, $a);
        $ri = mktime(0 ,0 ,0 ,$mesi ,$diai , $anoi);
        $rf = mktime(0 ,0 ,0 ,$mesf ,$diaf ,$anof);
        if($data >= $ri && $data <= $rf)
            echo "true";
        else
            echo "false";
}

pertenece_sesion(date('m-d-Y'),"05-01-2017","05-12-2017");
//echo date('m-d-Y');
*/
//echo strlen("qwerty");
//$val = "10";
//echo intval($val) * intval($val);
 //echo is_int(intval($val,10));
 //echo date('Y-m-d');
//$a = '2017';
//echo $a[2].$a[3];

//echo date('Y-m-d');
/*
$a[0] = 1;
$a[1] = 2;
$a[2] = 3;
$a[3] = 4;
foreach ($variable as $key => $value) {
    # code...
}
*/
//echo md5('fmv');

//$m = new MongoClient();
//$collection = $m->selectCollection('navegacion', 'dominios');

//$collection->insert(array('nombre' => 'dtse.esy.es'));

//echo date('Y');

list($ano, $mes, $dia) = preg_split('[-]', '2017-01-05');
echo $ano;
