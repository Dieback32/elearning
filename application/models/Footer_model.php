<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footer_model extends CI_Model
{
    function __construct() {
        parent::__construct();

    }

    public function manageFooter($company,$message,$year){

        $query = $this->db->get('footer');

        $data = array(
            'company_name' => $company,
            'message' => $message,
            'year' => $year
        );

        if ($query->num_rows() == 0){

            $this->db->insert('footer',$data);

            //                Inserting Logs

            $user = $this->session->userdata('authorization');

            $logs = array(
                'user' => $user,
                'activity' => " Footer has been changed"."<br/>" ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);

            return true;
        }else{

            //                Inserting Logs

            $user = $this->session->userdata('authorization');

            $logs = array(
                'user' => $user,
                'activity' => " Footer has been changed"."<br/>" ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);
            $this->db->update('footer',$data);

            return true;
        }

    }


    public function checkFooterData(){
        $query = $this->db->get('footer');
        if ($query->num_rows() == 0){
            return NULL;
        }
    }
    public function getFooter(){

        $query = $this->db->get('footer');

        return $query->result();
    }

    public function deleteFooter(){
        //     Inserting Logs
        $user = $this->session->userdata('authorization');
        $logs = array(
            'user' => $user,
            'activity' => "Footer has been deleted" ,
            'datetime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('activity_logs',$logs);
//        End of Logs

        $this->db->empty_table('footer');
        return true;
    }

}