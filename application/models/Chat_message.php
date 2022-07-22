<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_message extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    public function getMessage(){
        $this->db->order_by('logs','asc');
        $query = $this->db->get('chatmessage');

        return $query->result();
    }

    public function getSpeech(){
        $query = $this->db->get('speech_to_text');
        return $query->result();
    }

    public function getMessageUsers(){
        $query = $this->db->get('chatmessage');

        return $query->result();
    }

}