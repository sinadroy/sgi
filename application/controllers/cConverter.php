<?php
class CConverter extends CI_Controller {
    
    public function number_to_word(){
        $n = $this->input->get('n');
        $this->load->model('MConverter');
        echo $this->MConverter->to_word($n, null);
    }

    public function teste(){
        $pedazo = explode('//',site_url());
        $ip = explode('/',$pedazo[1]);
        //echo $ip[0];
		// 		Execute the arp command and store the output in $arpTable
		$command = "arp -a ".$ip[0];
		
		$arpTable = shell_exec($command);
		
		// 		Split the output so every line is an entry of the $arpSplitted array
		$arpSplitted = explode("\\n",$arpTable);
        echo $arpSplitted[0];
    }
}
?>