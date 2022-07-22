<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model
{

    function __construct() {
        parent::__construct();

    }

    public function edit_profile($fullname,$email){

       $user_id = $this->session->userdata('id');
       $this->db->where('id', $user_id );


           $data = array(
                'complete_name' => $fullname,
                'email' => $email
           );

         $this->db->update('users',$data);

        //     Inserting Logs

        $user = $this->session->userdata('authorization');

        $logs = array(
            'user' => $user,
            'activity' => $user . " , Profile information has been updated." ,
            'datetime' => date('Y-m-d H:i:s')
        );

        $this->db->insert('activity_logs',$logs);

         return true;

    }

    public function get_userById(){

        $query = $this->db->get_where('users', array(

            'id' => $this->session->userdata('id'),
        ));
        return $query->result();
    }

    public function userChangePass($old_password,$password){

        $qry = $this->db->get_where('users',array('password' => md5($old_password)));
        if ($qry->num_rows() > 0){

            $user_id = $this->session->userdata('id');
            $this->db->where('id', $user_id );
            $data = array('password' => md5($password) );

            $this->db->update('users',$data);

            //     Inserting Logs

            $user = $this->session->userdata('authorization');

            $logs = array(
                'user' => $user,
                'activity' => $user . " , Password has been changed." ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);
            return true;
        }else{
            return false;
        }

    }




}