<?php 
$this->load->view('temp/header',$title);
if ($this->session->userdata('logged_in')) {
	$this->load->view('temp/navbar');
}
// echo "<main>";
// $this->load->view('temp/sidebar');
$this->load->view($main_content);
// echo "</main>";
// $this->load->view('temp/footer');
?>