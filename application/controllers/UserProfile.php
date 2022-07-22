<?php


class UserProfile extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->is_logged_in();
    }
    function is_logged_in(){
        $logged_in = $this->session->userdata('logged_in');
        if (!isset($logged_in) || $logged_in == false){
            redirect('signin');
        }
    }


    public function index(){
        $data = array(
            'content' => 'frontend/main/userProfile',
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'user_data' => $this->enduser_profile->getUserData(),
            'all_users' => $this->user_management->getAllUsers(),
            'notify_count' => $this->group->getNotificationCount(),
            'notification' => $this->group->getNotification(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'footer' => $this->manage_website->getFooter()
        );
        $this->load->view('frontend/main/home',$data);
    }

//    User Profile Information
    public function overview(){
        $this->load->view('frontend/main/userprofile/overview');
    }
    public function place(){
        $data = array(
            'user_info' => $this->enduser_profile->getUserInfo()
        );
        $this->load->view('frontend/main/userprofile/place',$data);
    }
    public function contact(){
        $data = array(
            'user_info' => $this->enduser_profile->getUserInfo()
        );
        $this->load->view('frontend/main/userprofile/contact',$data);
    }
    public function info(){
        $data = array(
            'user_info' => $this->enduser_profile->getUserInfo()
        );
        $this->load->view('frontend/main/userprofile/info',$data);
    }
    public function about(){
        $data = array(
            'user_info' => $this->enduser_profile->getUserInfo()
        );
        $this->load->view('frontend/main/userprofile/about',$data);
    }

//    Profile Avatar

    public function uploadAvatar(){

        $config = array(
            'upload_path' => './uploads/users/',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'overwrite' => TRUE,
            'max_size' => '5000',
            'max_height' => '0',
            'max_width' => '0',
            'encrypt_name' => TRUE

        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()){

            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $data = array(
                'avatar' => $file['file_name']
            );
            $user = $this->session->userdata('id');
            $qry = $this->db->get_where('endusers', array('id' => $user) );
            if ($qry->num_rows() > 0){
                $this->db->where('id',$user);
                $this->db->update('endusers',$data);

                $this->session->set_flashdata(array(

                    'uploaded' => 'Avatar successfully changed'
                ));


            }else{
                $this->db->insert('users',$data);
            }

            redirect('userprofile');


        }else{


            $this->session->set_flashdata(array(
                'error' => $this->upload->display_errors(),
            ));
            redirect('userprofile');
        }
    }

    public function uploadCoverPhoto(){
        $config = array(
            'upload_path' => './uploads/coverphoto/',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'overwrite' => TRUE,
            'max_size' => '5000',
            'max_height' => '0',
            'max_width' => '0',
            'encrypt_name' => TRUE

        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()){

            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $data = array(
                'cover_photo' => $file['file_name']
            );
            $user = $this->session->userdata('id');
            $qry = $this->db->get_where('endusers', array('id' => $user) );
            if ($qry->num_rows() > 0){
                $this->db->where('id',$user);
                $this->db->update('endusers',$data);

                $this->session->set_flashdata(array(

                    'uploaded' => 'Avatar successfully changed'
                ));


            }else{
                $this->db->insert('users',$data);
            }

            redirect('userprofile');


        }else{


            $this->session->set_flashdata(array(
                'error' => $this->upload->display_errors(),
            ));
            redirect('userprofile');
        }
    }

//    User Profile Information

    public function editCity(){
        $city = $this->input->post('city');
        $id = $this->input->post('id');

        $data = $this->enduser_profile->editCity($city,$id);
        if ($data){
            redirect('userprofile');
        }else{
            redirect('userprofile');
        }

    }

    public function aboutYourself(){
        $user = $this->input->post('id');
        $about = $this->input->post('about');

        $data = $this->enduser_profile->aboutYourself($user,$about);
        if ($data){
            redirect('userprofile');
        }else{
            redirect('userprofile');
        }
    }
}