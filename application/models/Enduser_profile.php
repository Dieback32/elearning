<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enduser_profile extends CI_Model
{
    function __construct() {
        parent::__construct();

    }

    public function getUserData(){
        $qry = $this->db->get_where('endusers',array(
            'id' => $this->session->userdata('id')
        ));
        return $qry->result();
    }

    public function getUserInfo(){
        $query = $this->db->get_where('user_info',array(
            'user_id' => $this->session->userdata('id')
        ));

        return $query->result();
    }

    public function editCity($city,$id){

        $check = $this->db->get_where('user_info',array(
            'user_id' => $id
        ));

        if ($check->num_rows() == 0){
            $data = array(
                'current_city' => $city,
                'user_id' => $id
            );
            $this->db->insert('user_info',$data);

        }else{
            $this->db->where('user_id',$id);
            $data = array(
                'current_city' => $city,
            );
            $this->db->update('user_info',$data);
        }
    }

    public function aboutYourself($user,$about){
        $query = $this->db->get_where('user_info',array(
           'user_id' => $user
        ));

        if ($query->num_rows() > 0){
            $this->db->where('user_id',$user);
            $data = array(
                'about_you' => $about,
            );
            $this->db->update('user_info',$data);
        }
    }

}