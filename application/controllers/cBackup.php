<?php
class CBackup extends CI_Controller {
    
    public function read(){
        $this->load->model('MBackup');
        $ord = 1;
        foreach($this->MBackup->mread() as $row){
            $al[] = array(
                "ord"=>$ord,
                "id"=>$row->id,
                "bNome"=>$row->bNome,
                "data"=>$row->data,
                "hora"=>$row->hora
            );
            $ord++;
        }
        $data = json_encode($al);
        $response = $data;
        echo $response;
    }

    public function crud(){
        $request = $_POST;
        $id = @$request['id'];
        $bNome = $request["bNome"];
        //$data = $request["data"];
        //$hora = $request["hora"];

        $data = date("Y/m/d");
        $hora = date('H:i:s', time());

        //webix_operation
        $webix_operation = $request["webix_operation"];
        $this->load->model('MBackup');

        if ($webix_operation == "insert"){
            if($this->MBackup->minsert($bNome,$data,$hora)){
                //$this->backup($bNome);
                echo "true";
            }else
                echo "false";
        } else if ($webix_operation == "delete"){
            if($this->MBackup->mdelete($id))
                echo "true"; 
            else
               echo "false";
        } else 
            echo "false";
    }

     /* backup the db OR just a table */
    function backup()
    {
        $bNome = $this->input->post('bNome');
        $user="root";
        $pass="1qaz2wsx3edc4rfv5tgb";
        $name="sgi3";
        $host="localhost";
        $tables = '*';
        $return = 'SET FOREIGN_KEY_CHECKS=0;';
        
        $link = @mysql_connect($host,$user,$pass);
        $charset = 'utf8';
        if (!mysql_set_charset($charset, $link))
        {
            mysql_query('SET NAMES '.$charset);
        }
        @mysql_select_db($name,$link);
        
        //get all of the tables
        if($tables == '*')
        {
            $tables = array();
            $result = mysql_query('SHOW TABLES');
            while($row = mysql_fetch_row($result))
            {
                $tables[] = $row[0];
            }
        }
        else
        {
            $tables = is_array($tables) ? $tables : explode(',',$tables);
        }
        
        //cycle through
        foreach($tables as $table)
        {
            $result = mysql_query('SELECT * FROM '.$table);
            $num_fields = mysql_num_fields($result);
            
            //$return.= 'DROP TABLE IF EXISTS '.$table.';';
            $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
            $return.= "\n\n".$row2[1].";\n\n";
            
            for ($i = 0; $i < $num_fields; $i++) 
            {
                while($row = mysql_fetch_row($result))
                {
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                    for($j=0; $j < $num_fields; $j++) 
                    {
                        $row[$j] = addslashes($row[$j]);
                        $row[$j] = @ereg_replace("\n","\\n",$row[$j]);
                        if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                        if ($j < ($num_fields-1)) { $return.= ','; }
                    }
                    $return.= ");\n";
                }
            }
            $return.="\n\n\n";
        }
        
        //save file
        $path = APPPATH.'../backup_DB/';
        $archivo = $bNome.'.sql';//'db-backup-'.date("d-m-Y").'.sql'; 
        $handle = fopen($path.$archivo,'w+');
        fwrite($handle,$return);
        
        fclose($handle);
        //
        $enlace = $path.$archivo; 
        //header ("Content-Disposition: attachment; filename=".$archivo." "); 
        //header ("Content-Type: application/octet-stream");
        //header ("Content-Length: ".filesize($enlace));
        //$mime = "application/x-sql";
        //header( "Content-Type: " . $mime );
        //header( 'Content-Disposition: attachment; filename="' . $archivo . '"' );
        //readfile($enlace);
        //download.php?id=$archivo;
        $data = file_get_contents($enlace);
        header('Content-Type: application/force-download');
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename='.$archivo);
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.filesize($enlace));
        readfile($enlace); 
    }
}
?>