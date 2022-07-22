<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_website extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

//    Get all the data in websetting table

    public function getWebData(){
        $query = $this->db->get('websetting');
        return $query->result();
    }
    public function checkWebData(){
        $query = $this->db->get('websetting');
        if ($query->num_rows == 0){
            return NULL;
        }
    }

    public function insertTitle($web_title,$brand_name){

        $check = $this->db->get('websetting');
        $data = array(
            'web_title' => $web_title,
            'brand_name' => $brand_name
        );

        if ($check->num_rows() > 0){

            $this->db->update('websetting',$data);

            //     Inserting Logs

            $user = $this->session->userdata('authorization');

            $logs = array(
                'user' => $user,
                'activity' => $user . " , Web Title & Brand Name has been Updated" ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);
            return true;
        }else{

            //     Inserting Logs

            $user = $this->session->userdata('authorization');
            $logs = array(
                'user' => $user,
                'activity' => $user . " , Web Title has been Updated" ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);
            $this->db->insert('websetting',$data);
            return true;
        }

    }

    public function contactDetails($school,$location,$email,$number){

        $qry = $this->db->get('contact_details');
        $data = array(
            'school' => $school,
            'location' => $location,
            'email' => $email,
            'contact_no' => $number
        );

        if ($qry->num_rows() > 0){

            //     Inserting Logs

            $user = $this->session->userdata('authorization');
            $logs = array(
                'user' => $user,
                'activity' => $user . " , Contact Details has been Updated" ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);

            $this->db->update('contact_details',$data);
            return true;
        }else{

            //     Inserting Logs

            $user = $this->session->userdata('authorization');
            $logs = array(
                'user' => $user,
                'activity' => $user . " , Contact Details has been Updated" ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);

            $this->db->insert('contact_details',$data);
            return true;
        }

    }
//          Delete Icon
    public function deleteIcon(){
        //     Inserting Logs
        $user = $this->session->userdata('authorization');
        $logs = array(
            'user' => $user,
            'activity' => "Web Icon has been deleted" ,
            'datetime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('activity_logs',$logs);

        $data = array(
            'web_icon' => NULL
        );
        $this->db->update('websetting',$data);

    }

//    Delete Web Label

    public function deleteWebLabel(){
        //     Inserting Logs
        $user = $this->session->userdata('authorization');
        $logs = array(
            'user' => $user,
            'activity' => "Web Label has been deleted" ,
            'datetime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('activity_logs',$logs);
//        End of Logs

        $data = array(
            'web_title' => NULL,
            'brand_name' => NULL
        );
        $this->db->update('websetting',$data);
        return true;
    }
//      Delete Logo
    public function deleteLogo(){
        //     Inserting Logs
        $user = $this->session->userdata('authorization');
        $logs = array(
            'user' => $user,
            'activity' => "Web Logo has been deleted" ,
            'datetime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('activity_logs',$logs);
//        End of Logs

        $data = array(
            'logo' => NULL
        );

        $this->db->update('websetting',$data);
        return true;
    }

//    Delete Banner
    public function deleteBanner(){
        //     Inserting Logs
        $user = $this->session->userdata('authorization');
        $logs = array(
            'user' => $user,
            'activity' => "Web Banner has been deleted" ,
            'datetime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('activity_logs',$logs);
//        End of Logs

        $data = array(
            'banner' => NULL
        );
        $this->db->update('websetting',$data);
        return true;
    }
    public function getContactDetails(){

        $qry = $this->db->get('contact_details');
        return $qry->result();

    }

    public function checkContact(){
        $qry = $this->db->get('contact_details');
        if ($qry->num_rows == 0){
            return NULL;
        }
    }

    public function getFooter(){
        $query = $this->db->get('footer');
        return $query->result();
    }

}