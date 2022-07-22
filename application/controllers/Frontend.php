<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller
{

    function __construct() {
        parent::__construct();


    }


    public function index(){
//        $user = $this->session->userdata('authorization');
//
//        if ($user != 'admin' || $this->session->userdata('logged_in') == true){
//            redirect('home');
//        }else{

            $data = array(

                'parent' => $this->menu_model->getParent(),
                'child' => $this->menu_model->getChild(),
                'content' => $this->menu_model->getContent(),
                'webdata' => $this->manage_website->getWebData(),
                'contact' => $this->manage_website->getContactDetails(),
                'check_contact' => $this->manage_website->checkContact(),
                'check_webdata' => $this->manage_website->checkWebData(),
                'check_content' => $this->menu_model->checkContent(),
                'footer' => $this->footer_model->getFooter(),
                'check_footer' => $this->footer_model->checkFooterData()
            );

            $this->load->view('frontend/frontend_view',$data);

//        }


    }

    public function userLogin(){
        $id_number = $this->input->post('id');
        $password = $this->input->post('password');


        $check_session = $this->session->userdata('logged_in');
        if ($check_session){
            redirect('signin');
        }else{
            $data = $this->authentication_model->userLogin($id_number,$password);
            if ($data == true){
                redirect('home');
            }elseif($data == null){
                $this->session->set_flashdata('logged_in','This user is already login.');
                redirect('signin');
            }else{
                $this->session->set_flashdata(array(
                    'errors' => 'Incorrect ID or Password'
                ));
                redirect('signin');
            }
        }

    }

    public function contactUs(){
        $email = $this->input->post('email');
        $info = $this->input->post('info');

        $data = $this->frontend_model->contactUs($email,$info);
        if ($data){
            redirect('signin');
        }else{
            redirect('signin');
        }

    }


}