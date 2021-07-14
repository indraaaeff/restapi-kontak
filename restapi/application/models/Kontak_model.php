<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontak_model extends CI_Model {

        public function get_user()
        {   
            $sql = $this->db->get('user')->result();
            return $sql;
        }

        public function find_user($id)
        { 
            $this->db->where('id', $id);
            $sql = $this->db->get('user')->result();
            return $sql;
        }

        public function insert_user($data){
            $insert = $this->db->insert('user', $data);
            return $insert;
        }

        public function update_user($data){
            $this->db->where('id', $data['id']);
            $update = $this->db->update('user', $data);
            return $update;
        }

        public function delete_user($id){
            $this->db->where('id', $id);
            $delete = $this->db->delete('user');
            return $delete;
        }

        public function count_all(){
            return $this->db->count_all('user');
        }

        public function filter($search, $limit, $start, $order_field, $order_ascdesc){
            $this->db->like('nama', $search);
            $this->db->or_like('no_hp', $search);
            $this->db->or_like('email', $search);
            $this->db->order_by($order_field, $order_ascdesc);
            $this->db->limit($limit, $start);
            return $this->db->get('user')->result_array();
        }

        public function count_filter($search){
            $this->db->like('nama', $search);
            $this->db->or_like('no_hp', $search);
            $this->db->or_like('email', $search);
            return $this->db->get('user')->num_rows();
        }
}

?>