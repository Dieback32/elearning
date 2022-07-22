<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_model extends CI_Model
{
    function __construct() {
        parent::__construct();

    }

    public function contactUs($email,$info){
        $data = array(
            'email' => $email,
            'info_data' => $info
        );

        $this->db->insert('contact_us',$data);
    }

    public function getContacts(){
        $query = $this->db->get('contact_us');

        return $query->result();
    }


}