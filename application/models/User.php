<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class User extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
            $this->load->database();
		}

        public function register($data){
            $result = $this->db->insert('reg', $data);
            if($result){
                return $this->db->select('*')->from('reg')->where('email', $data['email'])->get()->result();
            }
        }

        public function login($data){
            $query = $this->db->select('*')->from('reg')
                        ->where('email', $data['email'])
                        ->where('pass', $data['pass'])
                        ->get()
                        ->result();
            if(count($query) > 0){
                return $query;
            }else{
                return false;
            }
        }

        public function alldata(){
            return $this->db->select('*')->from('reg')->get()->result();
        }

        public function delete_user($id){
            return $this->db->where('id', $id)->update('reg', ['status', 'D']);
        }

    }
?>