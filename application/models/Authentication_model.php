<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication_model extends CI_Model
{

//    Backend Login and Signup

    public function check_login(){

        $query = $this->db->get_where('users', array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password'))
                ));

        if ($query->num_rows() > 0){
            $row = $query->row();
            $this->session->set_userdata(
                array(
                    'id' => $row->id,
                    'username' => $row->username,
                    'email' => $row->email,
                    'authorization' => $row->authorization,
                    'logged_in' => true
                ));
            return true;

        }else{
            return false;
        }
    }

    public function user_check(){
       $qry = $this->db->get('users');

       if ($qry->num_rows() > 0){
           return $qry->result();
       }else{
           return false;
       }

    }

    public function signup_user($complete_name,$username,$email,$password){

            $data = array(
                'username' => $username,
                'email' => $email,
                'password' =>  md5($password),
                'complete_name' => $complete_name,
                'authorization' => 'admin'
            );

            $this->db->insert('users',$data);

    }

    public function retrieve_password(){

        $query = $this->db->get_where('users', array(
            'email' => $this->input->post('email')
        ));
        if ($query->num_rows() > 0){
             return $query->row()->email;
        }else{
            return false;
        }
    }

    public function resetPass($new,$email){

        $qry = $this->db->get_where('users', array(
            'email' => $email
        ));

        if ($qry->num_rows() > 0){
            $this->db->where('email',$qry->row()->email);
            $data = array(
                'password' => md5($new)
            );
            $this->db->update('users',$data);

            $del = $this->db->where('user_email', $email);

            $this->db->delete('passcode',$del);

            return true;
        }else{
            return false;
        }


    }

    public function insert_verify($code,$email){
        $data = array(
            'code' => $code,
            'user_email' => $email
        );
        $this->db->insert('passcode',$data);

        return $this->db->insert_id();

    }
    public function getCodeId($datacode){
        $qry = $this->db->get_where('passcode', array(
            'id' => $datacode
        ));
        if ($qry->num_rows() > 0){

            return $qry->result();
        }else{
            return false;
        }


    }
    //    End of Backend

//      Frontend Login
    public function userLogin($id_number,$password){
        $qry = $this->db->get_where('endusers',array(
            'id_number' => $id_number,
            'password' => md5($password),
            'status' => 'activated'
        ));

        $check = array(
            'id_number' => $id_number,
            'password' => md5($password)
        );
        $change = array('standing' => 1);
        $this->db->where($check);
        $this->db->update('endusers',$change);


        if ($qry->row()->standing == 1){
            return null;
        }else{
            if ($qry->num_rows() > 0){
                $row = $qry->row();
                $this->session->set_userdata(array(
                    'id' => $row->id,
                    'student_id' => $row->student_id,
                    'email' => $row->email,
                    'firstname' => $row->firstname,
                    'lastname' => $row->lastname,
                    'avatar' => $row->avatar,
                    'cover_photo' => $row->cover_photo,
                    'password' => $row->password,
                    'authorization' => $row->authorization,
                    'default_pass' => $row->default_pass,
                    'logged_in' => true
                ));

                return true;
            }else{
                return false;
            }
        }

    }

    public function changeDefaultPassStatus($user_id){
        $data = array(
          'default_pass' => 0
        );

        $this->db->where('id',$user_id);
        $this->db->update('endusers',$data);

        return true;
    }

    public function changingPassword($old,$new){
        $query = $this->db->get_where('endusers',array(
            'id' => $this->session->userdata('id')
        ));

        $oldpass = $query->row()->password;
        if ($oldpass != md5($old)){
            return false;
        }else{
            $data = array(
                'password' => md5($new)
            );

            $this->db->where( 'id',$this->session->userdata('id'));
            $this->db->update('endusers',$data);

            return true;
        }


    }


}