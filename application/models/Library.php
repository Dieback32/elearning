<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    public function getFiles(){
        $query = $this->db->get('class_library');
        return $query->result();
    }
}