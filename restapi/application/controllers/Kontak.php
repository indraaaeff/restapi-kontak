<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
require (APPPATH . '/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

	function __construct($config = 'rest') {
        parent::__construct($config);
		$this->load->model('kontak_model');
    }

	// public function index(){
	// 	$this->load->view('welcome_message');
	// }

	function index_get() {
		$id = $this->get('id');
        if ($id == '') {
			$kontak = $this->kontak_model->get_user();
        } else {
			$kontak = $this->kontak_model->find_user($id);
        }
		if ($kontak == true) {
			$status = 200;
			$message = "Get Kontak Success.";
		} else {
			$status = 500;
			$message = "Internal Server Error.";
		}
		$response = array(
			'status' => $status,
			'message' => $message,
			'data' => $kontak
		);
        $this->response($response, $status);

    }

	function daftar_post() {
		//datatables var
		$search = $_POST['search']['value'];
        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order_index = $_POST['order'][0]['column'];
        $order_field = $_POST['columns'][$order_index]['data'];
        $order_ascdesc = $_POST['order'][0]['dir'];
		
		$sql_total = $this->kontak_model->count_all();
        $sql_data = $this->kontak_model->filter($search, $limit, $start, $order_field, $order_ascdesc);
        $sql_filter = $this->kontak_model->count_filter($search);
		
		if ($sql_data == true) {
			$status = 200;
			$message = "Get Kontak Success.";
		} else if (empty($sql_data)){
			$status = 200;
			$message = "No matching records found.";
		} else {
			$status = 500;
			$message = "Internal Server Error.";
		}
		$response = array(
			'status' => $status,
			'message' => $message,
			'draw'=>$_POST['draw'],
            'recordsTotal'=>$sql_total,
            'recordsFiltered'=>$sql_filter,
			'data' => $sql_data
		);
        $this->response($response, $status);
    }

	function buat_post(){
		$data = array(
			// 'id'       => $this->post('id'),
			'nama'     => $this->post('nama'),
			'no_hp'    => $this->post('no_hp'),
			'email'    => $this->post('email'));
		$is_insert = $this->kontak_model->insert_user($data);
		if ($is_insert == true) {
			$status = 200;
			$message = "Insert Data Success.";
		} else {
			$status = 500;
			$message = "Insert Data Fail.";
		}
		$response = array(
			'status' => $status,
			'message' => $message,
			'data' => $data
		);
		$this->response($response, $status);
	}


	function ubah_post(){
		$id = $this->post('id');
        $data = array(
				'id'      => $this->post('id'),
				'nama'    => $this->post('nama'),
				'no_hp'   => $this->post('no_hp'),
				'email'   => $this->post('email')
			);
		$is_update = $this->kontak_model->update_user($data);
		if ($is_update == true) {
			$status = 200;
			$message = "Update Data Success.";
		} else {
			$status = 500;
			$message = "Update Data Fail.";
		}
		$response = array(
			'status' => $status,
			'message' => $message,
			'data' => $data
		);
		$this->response($response, $status);
		
	}

	function hapus_post(){
		$id = $this->post('id');
		$is_delete = $this->kontak_model->delete_user($id);
		if ($is_delete == true) {
			$status = 200;
			$message = "Delete Data Success.";
		} else {
			$status = 500;
			$message = "Delete Data Fail.";
		}
		$response = array(
			'status' => $status,
			'message' => $message
		);
		$this->response($response, $status);
	}

	function index_post() {
    }

	function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'       => $this->put('id'),
                    'nama'     => $this->put('nama'),
                    'no_hp'    => $this->put('no_hp'),
                    'email'    => $this->put('email')
				);
        $this->db->where('id', $id);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('user');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
