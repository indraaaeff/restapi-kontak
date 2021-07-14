<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datauser extends CI_Controller {

	public function __construct()
   	{
    	parent::__construct();
    	$this->load->library('session');
	}

	public function index()
	{
        $data['title'] = 'Data User';
    	$data['main_content'] = 'master/datauser'; 
    	$this->load->view('temp/template',$data);
	}

	public function create(){
		$data['title'] = 'Create New User';
    	$data['main_content'] = 'master/form';
    	$this->load->view('temp/template',$data);
	}

	public function edit(){
		$data['title'] = 'Edit Data User';
    	$data['main_content'] = 'master/form';
    	$this->load->view('temp/template',$data);
	}
}
