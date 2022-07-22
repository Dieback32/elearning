<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->is_logged_in();
    }

    function is_logged_in(){
        $logged_in = $this->session->userdata('logged_in');
        if ($this->session->userdata('authorization') == 'admin' || $this->session->userdata('authorization') == 'registrar' || $this->session->userdata('authorization') == 'staff'){
            redirect('dashboard');
        }else{
            if (!isset($logged_in) || $logged_in == false){
                redirect('signin');
            }
        }

    }

    public function index(){

        $data = array(
            'content' => 'frontend/main/leftlist_content',
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'notify_count' => $this->group->getNotificationCount(),
            'group_details' => $this->group->getAllGroups(),
            'notification' => $this->group->getNotification(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'event' => $this->event->getEventDetails(),
            'footer' => $this->manage_website->getFooter()
        );

        $this->load->view('frontend/main/home',$data);
    }

    public function userLogout(){
        $change = array('standing' => 0);
        $this->db->where('id',$this->session->userdata('id'));
        $this->db->update('endusers',$change);

        $this->session->sess_destroy();
        redirect('signin');
    }

    public function createEvent(){
        $event_name = $this->input->post('event_name');
        $location = $this->input->post('event_location');
        $date_time = $this->input->post('event_date');
        $event_desc = $this->input->post('event_desc');

        $config = array(
            'upload_path' => './uploads/event_photos/',
            'allowed_types' => 'png|jpg|jpeg',
            'remove_spaces' => TRUE,
            'overwrite' => FALSE,
            'encrypt_name' => TRUE,
            'max_size' => '0',
            'max_filename' => '0'

        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()){

            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $data = array(
                'event_photo' => $file['file_name'],
                'event_name' => $event_name,
                'location' => $location,
                'date_time' => $date_time,
                'description' => $event_desc,
                'logs' => date('Y-m-d H:i:s')
            );
            $qry = $this->db->get_where('event',array(
                'event_photo' => $file['file_name']
            ));
            if ($qry->num_rows() == 0){

                $this->db->insert('event',$data);

            }
            $this->session->set_flashdata(array(
                'event_success' => 'Event has been created'
            ));
            redirect('home');
        }else{
            $this->session->set_flashdata(array(
                'event_failed' => $this->upload->display_errors(),
            ));
            redirect('home');
        }

    }

    public function getEventDetails(){
        if (isset($_POST['event_id']) && $_POST['event_id'] != ''){
            $event_id = $_POST['event_id'];
            $data = $this->db->get_where('event',array(
                'id' => $event_id
            ));
            $event_photo = $data->row()->event_photo;
            $event_name = $data->row()->event_name;
            $location = $data->row()->location;
            $date_time = $data->row()->date_time;
            $description = $data->row()->description;

            $std = new stdClass();
            $std->photo = $event_photo;
            $std->name = $event_name;
            $std->location = $location;
            $std->date = $date_time;
            $std->description = $description;
            $std->id = $event_id;

            echo json_encode($std);
        }
    }

    public function editEvent(){
        if (!empty($_POST)){
        $event_id = $this->input->post('event_id');
        $event_name = $this->input->post('event_name');
        $location = $this->input->post('event_location');
        $date_time = $this->input->post('event_date');
        $event_desc = $this->input->post('event_desc');

        $this->event->editEvent($event_id,$event_name,$location,$date_time,$event_desc);

        }

    }

    public function deleteEvent(){
        if (!empty($_POST)){
            $event_id = $this->input->post('id_event');
            $this->event->deleteEvent($event_id);

        }
    }

    public function removeBadgeNotification(){

        if(isset($_POST['task']) && $_POST['task'] == 'remove_badge'){
            $userID = (int)$_POST['userId'];

            $std = new stdClass();
            $std->userID = $userID;

            $this->group->removeBadgeNotification($userID);

            echo json_encode($std);

        }
    }

    public function changeUnread(){
        if(isset($_POST['notify_id']) && $_POST['notify_id'] != null){
            $notify_id = $_POST['notify_id'];

            $change = array('read_unread' => 0);
            $this->db->where('id',$notify_id);
            $this->db->update('notification',$change);


            $std = new stdClass();
            $std->id = $notify_id;

            echo json_encode($std);

        }
    }

    public function changeDefaultPassStatus(){
        $user_id = $this->input->post('user_id');
        $data = $this->authentication_model->changeDefaultPassStatus($user_id);
        if ($data == true){
            redirect('home');
        }else{
            redirect('home');
        }
    }

    public function redirectToChangePass(){
        $user_id = $this->input->post('user_id');
        $data = $this->authentication_model->changeDefaultPassStatus($user_id);
        if ($data == true){
            redirect('home/changePassword');
        }else{
            redirect('home/changePassword');
        }
    }

    public function changePassword(){
        $data = array(
            'content' => 'frontend/main/change_password/change_pass',
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'user_data' => $this->enduser_profile->getUserData(),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'group_details' => $this->group->getAllGroups(),
            'notify_count' => $this->group->getNotificationCount(),
            'notification' => $this->group->getNotification(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'footer' => $this->manage_website->getFooter()
        );

        $this->load->view('frontend/main/home',$data);
    }

    public function changingPassword(){

        $old = $this->input->post('old');
        $new = $this->input->post('new');

        $data = $this->authentication_model->changingPassword($old,$new);

        if ($data == true){
            $this->session->set_flashdata('success','Password has been change');
            redirect('home/changePassword');
        }else{
            $this->session->set_flashdata('error','Incorrect Old Password');
            redirect('home/changePassword');
        }

     }


}