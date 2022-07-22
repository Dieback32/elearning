<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Admin extends CI_Controller{

    function __construct(){
        parent::__construct();
    }

    public function index(){

        $id = $this->session->userdata('id');
        if ($id){
            redirect('dashboard/index');

        }else{

            $checkrows = $this->authentication_model->user_check();

            if ($checkrows > 0){
                $data['check'] = "backend/login_view";

            }else{
                $data['check'] = "backend/signup_view";
            }

            $this->load->view('backend/main',$data);

        }

    }


}