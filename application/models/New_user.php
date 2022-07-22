<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_user extends CI_Model
{
    function __construct() {
        parent::__construct();

    }

//    Delete User
    public function deleteUsers($user_id){

        //     Inserting Logs
        $user = $this->session->userdata('authorization');

        $logs = array(
            'user' => $user,
            'activity' => "User has been Deleted.",
            'datetime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('activity_logs',$logs);


        $this->db->where('id',$user_id);
        $this->db->delete('users');

    }
    public function checkRegistrar(){
        $qry = $this->db->get_where('users',array(
            'authorization' => 'registrar'
        ));
        if ($qry->num_rows()==0){
            return true;
        }else{
            return false;
        }
    }

//    Add Registrar
    public function addNewUser($fullname,$username,$email,$password){

        $this->db->where( 'authorization', "registrar");
        $qry = $this->db->get('users');

        if ($qry->num_rows() == 0){

            $data = array(
                'complete_name' => $fullname,
                'username' => $username,
                'email' => $email,
                'password' => md5($password),
                'authorization' => 'registrar'
            );

            $this->db->insert('users',$data);

            //     Inserting Logs

            $user = $this->session->userdata('authorization');

            $logs = array(
                'user' => $user,
                'activity' => $user . " , created a new Account for Registrar." ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);
            return true;
        }else{
            return false;
        }


    }

//    Add Instructor
    public function addNewInstructor($id_no,$fname,$lname,$email){

       $qry = $this->db->get_where('endusers',array(
           'id_number' => $id_no
       ));

        if ($qry->num_rows() == 0){

            $data = array(
                'id_number' => $id_no,
                'firstname' => $fname,
                'lastname' => $lname,
                'email' => $email,
                'password' => md5($id_no),
                'status' => 'activated',
                'default_pass' => 1,
                'authorization' => 'instructor'
            );

            $this->db->insert('endusers',$data);

            $query = $this->db->get_where('endusers',array(
                'id_number' => $id_no,
                'firstname' => $fname,
                'lastname' => $lname,
                'email' => $email
            ));
            $user = $query->row();
            $info = array(
                'user_id' => $user->id
            );
            $this->db->insert('user_info',$info);
            return true;
        }else{
            return false;
        }


    }

//    Add Staff
    public function addStaff($c_name,$email,$username,$password){
        $query = $this->db->get_where('users',array(
            'authorization' => 'staff',
            'username' => $username,
            'complete_name' => $c_name
        ));
        if ($query->num_rows() > 0){
            return false;
        }else{
            $data = array(
                'complete_name' => $c_name,
                'email' => $email,
                'username' => $username,
                'password' => md5($password),
                'authorization' => 'staff'
            );

            $this->db->insert('users',$data);
            return true;
        }
    }

//    Add New Student

    public function addNewStudent($id_number,$fname,$lname,$email,$course,$year){
        $query = $this->db->get_where('endusers',array(
            'id_number' => $id_number
        ));

        if ($query->num_rows() == 0){
            $data = array(
                'password' => md5($id_number),
                'id_number' => $id_number,
                'firstname' => $fname,
                'lastname' => $lname,
                'email' => $email,
                'course' => $course,
                'year' => $year,
                'status' => 'activated',
                'authorization' => 'student'
            );

            $this->db->insert('endusers',$data);

            $user_info = $this->db->get_where('endusers',array(
                'id_number' => $id_number,
                'firstname' => $fname,
                'lastname' => $lname,
            ));

            $user_id = $user_info->row()->id;
            $info = array(
                'user_id' => $user_id
            );
            $this->db->insert('user_info',$info);

            return true;

        }

    }


}