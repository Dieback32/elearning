<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller
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
            'content' => 'frontend/main/messages/messages',
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'notify_count' => $this->group->getNotificationCount(),
            'notification' => $this->group->getNotification(),
            'chatmessage' => $this->chat_message->getMessage()
        );

        $this->load->view('frontend/main/home',$data);
    }

    public function chat_message(){

        $data = array(
            'chatmessage' => $this->chat_message->getMessage(),
            'student_group' => $this->group->getStudentGroup(),
            'instructor_group' => $this->group->getAllGroups(),
            'user' => $this->user_management->getAllUsers(),
        );
        $this->load->view('frontend/main/messages/chat_message',$data);
    }


    public function getUsersID(){
        if (isset($_POST['user_id']) && $_POST['user_id'] != ''){
            $user_id = $_POST['user_id'];

            $data = $this->db->get_where('endusers',array(
                'id' => $user_id
            ));

            $user_info = $this->db->get_where('user_info',array(
                'user_id' => $user_id
            ));

            $id = $data->row()->id;
            $fname = $data->row()->firstname;
            $lname = $data->row()->lastname;
            $course = $data->row()->course;
            $year = $data->row()->year;
            $city = $user_info->row()->current_city;
            $hometown = $user_info->row()->hometown;


            $std = new stdClass();
            $std->id = $id;
            $std->fname = $fname;
            $std->lname = $lname;
            $std->course = $course;
            $std->year = $year;
            $std->city = $city;
            $std->hometown = $hometown;

            echo json_encode($std);

        }
    }

    public function insertMessageChat(){
        $output = '';
        if (isset($_POST['user_id']) && $_POST['user_id'] != ''){
            $user_id = $_POST['user_id'];
            $chatMsg = $_POST['chatText'];
            $group_id = $_POST['groupID'];
            $present = date('Y-m-d H:i:s');
            $image = $_POST['image'];
            $uri =  $_POST['uri'];
            if ($chatMsg != ""){
                $data = array(
                    'group_id' => $group_id,
                    'user_id' => $user_id,
                    'message' => htmlspecialchars($chatMsg),
                    'logs' => $present
                );

                $this->db->insert('chatmessage',$data);

                //        Notification
                $check = $this->db->get_where('students_group',array(
                    'group_id' => $group_id
                ));

                $group_user = $check->result();

                foreach ($group_user as $user){
                    if ($user->student_id != $user_id){
                        $notify = array(
                            'user_id' => $user->student_id,
                            'sender_id' => $user_id,
                            'group_id' => $group_id,
                            'image' => $image,
                            'uri' => $uri,
                            'notify' => 1,
                            'data' => 'Someone is start a discussion',
                            'page' => 'chat_group',
                            'logs' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('notification',$notify);
                    }


                }
                $check_instrutor = $this->db->get('class_group',array(
                    'id' => $group_id
                ));
                $instructor_id = $check_instrutor->row()->instructor_id;
                if ($instructor_id != $user_id){
                    $notify = array(
                        'user_id' => $instructor_id,
                        'sender_id' => $user_id,
                        'group_id' => $group_id,
                        'image' => $image,
                        'uri' => $uri,
                        'notify' => 1,
                        'data' => 'Someone is start a discussion',
                        'page' => 'chat_group',
                        'logs' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('notification',$notify);
                }

                //End of Notification

                $query = $this->db->get_where('chatmessage',array(
                    'user_id' => $user_id
                ));

                $message = $query->result();

                foreach ($message as $msg){
                    $output = '<span>'.$msg->message.'</span>';
                }

                echo $output;
            }

        }

    }

    public function speechToText(){
        $output = '';
        if (isset($_POST['user_id']) && $_POST['user_id'] != ''){
            $user_id = $_POST['user_id'];
            $speech = $_POST['speech'];
            $group_id = $_POST['groupId'];

            $data = array(
                'user_id' => $user_id,
                'speech' => $speech,
                'group_id' => $group_id
            );

            $check = $this->db->get_where('speech_to_text',array(
                'user_id' => $user_id
            ));

            if ($check->num_rows() > 0){
                $this->db->where('user_id',$user_id);
                $this->db->update('speech_to_text',$data);
            }else{
                $this->db->insert('speech_to_text',$data);
            }

            $query = $this->db->get_where('speech_to_text',array(
                'user_id' => $user_id
            ));

            $txt = $query->result();

            foreach ($txt as $msg){
                $output = '<span>'.$msg->speech.'</span>';
            }

            echo $output;
        }

    }

    public function textDisplay(){
        $id = $this->input->get('id');
        $data = array(
            'speechtext' => $this->chat_message->getSpeech(),
            'user' => $this->user_management->getAllUsers(),
            'group' => $this->group->getGroupById($id)
        );
        $this->load->view('frontend/main/live_lecture/text_display',$data);
    }


    public function countGroupChat(){
        if (isset($_POST['group_id']) && $_POST['group_id'] != ''){
            $group_id = $_POST['group_id'];

            $check = array(
                'group_id' => $group_id,
                'user_id' => $this->session->userdata('id'),
                'page' => 'chat_group'
            );

            $update = array(
                'notify' => null,
                'read_unread' => 0
            );

            $this->db->where($check);
            $this->db->update('notification',$update);

            $query = $this->db->get_where('notification',array(
                'group_id' => $group_id,
                'user_id' => $this->session->userdata('id'),
                'page' => 'chat_group'
            ));

            $count = $query->num_rows();



            $std = new stdClass();
            $std->count = $count;


            echo json_encode($std);

        }
    }


}