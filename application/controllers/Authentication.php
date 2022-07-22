<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Authentication extends CI_Controller
{
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('authentication') == 'instructor' || $this->session->userdata('authentication') == 'student'){
            redirect('signin');
        }
    }

    public function login(){
        $check = $this->authentication_model->check_login();
        if ($check){
            redirect('dashboard');
        }else{

            $this->session->set_flashdata(array(
                'errors' => 'Incorrect Email or Password'
            ));
            redirect('admin');
        }

    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('admin');
    }

    public function signup(){

        $this->form_validation->set_rules('email','Email','trim|required');
        $this->form_validation->set_rules('username','Username','trim|required|min_length[4]');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm','Confirm Password','trim|required|min_length[6]|matches[password]');

        if ($this->form_validation->run() == FALSE){

            $this->session->set_flashdata(array(
                'errors' => validation_errors()
            ));

        }else{

            $complete_name = $this->input->post('completename');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $data = $this->authentication_model->signup_user($complete_name,$username,$email,$password);

            if ($data){
                redirect('admin');

            }else{
                redirect('admin');
            }
        }

    }

    public function forgotPassword(){
        $data = array(
            'check' => "backend/forgot_password",
            'msg' => ''
        );

        $this->load->view('backend/main',$data);
    }

    public function sendEmail(){

        $email = $this->authentication_model->retrieve_password();
        if ($email){

            $config = array(
//                'protocol' => 'smtp',
//                'mailpath' => "\"C:\xampp\sendmail\sendmail.exe\" -t",
//                'smtp_host' => 'smtp.gmail.com',
//                'smtp_port' => '587',
                'mailtype' => 'html',

            );

            $this->email->initialize($config);
            $this->email->set_newline("\r\n");

            $this->email->from('rarecandy06@gmail.com', 'System Services');
            $this->email->to($email);
            $this->email->subject('Forgot Password');
            $this->email->message($this->resetMessage($email));

            if ($this->email->send()){
                $this->session->set_flashdata(array(
                    'msg' => 'The email has been sent. Please check your email to reset your password.'
                ));

               redirect('authentication/forgotPassword');
            }else{

                $this->session->set_flashdata(array(
                    'failed' => 'Sorry, Message not send.'
                ));
                redirect('authentication/forgotPassword');
//                show_error($this->email->print_debugger());

            }


        }else{
            $this->session->set_flashdata(array(
                'failed' => 'Sorry, Your email does not exist.'
            ));
            redirect('authentication/forgotPassword');

        }


    }

    public function resetMessage($email){

        $code = md5(rand(10000,99999));
        $code_id = $this->authentication_model->insert_verify($code,$email);
        $site_url = site_url();
        $data = "<html>";
        $data .= "<head></head>";
        $data .= "<body>";
        $data .= "<h3>Reset Password</h3>";
        $data .= "To reset your password. Please";
        $data .= "<a href='".$site_url."/authentication/resetPage/".$code_id."/".$code."' > Click Here.</a>";
        $data .= "</body>";
        $data .= "</html>";

        return $data;
    }

    public function resetPage(){

        $datacode = $this->uri->segment(3);

        $data = array(
            'check' => 'backend/reset_password',
            'verify_code' => $this->authentication_model->getCodeId($datacode)
        );

        $this->load->view('backend/main',$data);
    }

    public function resetPassword(){

        $this->form_validation->set_rules('newpass','Password','trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm','Confirm Password','trim|required|min_length[6]|matches[newpass]');


        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata(array(
                'errors' => validation_errors()
            ));

        }else{

            $new = $this->input->post('newpass');
            $email = $this->input->post('email');
            $data = $this->authentication_model->resetPass($new,$email);


            if ($data == true){
                $this->session->set_flashdata(array(
                   'success' => 'Password has been reset'
                ));
                redirect('admin');
            }else{

                redirect('authentication/forgotPassword');
            }

        }


    }




}