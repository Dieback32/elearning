<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Model
{

    function __construct()
    {
        parent::__construct();

    }


    public function getLogs(){
        $query = "SELECT * FROM activity_logs ORDER BY datetime DESC ";
        $qry = $this->db->query($query);
        return $qry->result();
    }

    public function LogsDelete(){

        $this->db->empty_table('activity_logs');

    }



}