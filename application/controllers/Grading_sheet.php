<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grading_sheet extends CI_Controller
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
            'content' => 'frontend/main/grading_sheet',
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'user_data' => $this->enduser_profile->getUserData(),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'all_users' => $this->user_management->getAllUsers(),
            'notify_count' => $this->group->getNotificationCount(),
            'notification' => $this->group->getNotification(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'group_details' => $this->group->getAllGroups(),
            'footer' => $this->manage_website->getFooter()
        );

        $this->load->view('frontend/main/home',$data);
    }

    public function groupList(){
        $data = array(
            'class_group' => $this->group->getCG(),
        );
        $this->load->view('frontend/main/grading_sheet/group_list',$data);
    }

    public function gradesPerGroup(){
        $id = $this->input->get('id');
        $data = array(
            'content' => 'frontend/main/grading_sheet/grades',
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'group' => $this->group->getCGById($id),
            'user_data' => $this->enduser_profile->getUserData(),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'all_users' => $this->user_management->getAllUsers(),
            'notify_count' => $this->group->getNotificationCount(),
            'notification' => $this->group->getNotification(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'group_details' => $this->group->getAllGroups(),
            'prelim' => $this->grades->prelimGrade($id),
            'midterm' => $this->grades->midtermGrade($id),
            'prefinal' => $this->grades->prefinalGrade($id),
            'finals' => $this->grades->finalsGrade($id),
            'gwa' => $this->grades->gwaGrade($id),
            'footer' => $this->manage_website->getFooter()
        );

        $this->load->view('frontend/main/home',$data);
    }

    //Participation
    public function prelimParticipation(){
        $group_id = $this->input->post('groupID');
        $student_id = $this->input->post('studentId');
        $remarks = $this->input->post('participation-prelim');

        $data = $this->participation->prelimParticipation($student_id,$group_id,$remarks);
        if ($data == false){
            $this->session->set_flashdata('participation_error','This student is already drop in this subject.');
        }else{
            $this->session->set_flashdata('participation_success','Grade has been inserted.');
        }
    }
    public function midtermParticipation(){
        $group_id = $this->input->post('groupID');
        $student_id = $this->input->post('studentId');
        $remarks = $this->input->post('participation-midterm');

        $data = $this->participation->midtermParticipation($student_id,$group_id,$remarks);
        if ($data == false){
            $this->session->set_flashdata('participation_error','This student is already drop in this subject.');
        }else{
            $this->session->set_flashdata('participation_success','Grade has been inserted.');
        }
    }
    public function prefinalParticipation(){
        $group_id = $this->input->post('groupID');
        $student_id = $this->input->post('studentId');
        $remarks = $this->input->post('participation-prefinal');

        $data = $this->participation->prefinalParticipation($student_id,$group_id,$remarks);
        if ($data == false){
            $this->session->set_flashdata('participation_error','This student is already drop in this subject.');
        }else{
            $this->session->set_flashdata('participation_success','Grade has been inserted.');
        }
    }
    public function finalsParticipation(){
        $group_id = $this->input->post('groupID');
        $student_id = $this->input->post('studentId');
        $remarks = $this->input->post('participation-finals');

        $data = $this->participation->finalsParticipation($student_id,$group_id,$remarks);
        if ($data == false){
            $this->session->set_flashdata('participation_error','This student is already drop in this subject.');
        }else{
            $this->session->set_flashdata('participation_success','Grade has been inserted.');
        }
    }

    //Set Number of Items in Exam
    public function prelimNumItems(){
        $num = $this->input->post('numitems-prelim');
        $group_id = $this->input->post('groupID');

        $data = $this->grades->prelimNumItems($num,$group_id);

        if ($data){
            redirect('grading_sheet/gradesPerGroup?id='.$group_id);
        }else{
            redirect('grading_sheet/gradesPerGroup?id='.$group_id);
        }

    }

    public function midtermNumItems(){
        $num = $this->input->post('numitems-midterm');
        $group_id = $this->input->post('groupID');

        $data = $this->grades->midtermNumItems($num,$group_id);

        if ($data){
            redirect('grading_sheet/gradesPerGroup?id='.$group_id);
        }else{
            redirect('grading_sheet/gradesPerGroup?id='.$group_id);
        }

    }

    public function prefinalNumItems(){
        $num = $this->input->post('numitems-prefinal');
        $group_id = $this->input->post('groupID');

        $data = $this->grades->prefinalNumItems($num,$group_id);

        if ($data){
            redirect('grading_sheet/gradesPerGroup?id='.$group_id);
        }else{
            redirect('grading_sheet/gradesPerGroup?id='.$group_id);
        }

    }

    public function finalsNumItems(){
        $num = $this->input->post('numitems-finals');
        $group_id = $this->input->post('groupID');

        $data = $this->grades->finalsNumItems($num,$group_id);

        if ($data){
            redirect('grading_sheet/gradesPerGroup?id='.$group_id);
        }else{
            redirect('grading_sheet/gradesPerGroup?id='.$group_id);
        }

    }

    //Exam Score
    public function prelimExamScore(){
        $score = $this->input->post('exam_prelim-score');
        $user = $this->input->post('studentId');
        $group_id = $this->input->post('groupID');

        $data = $this->grades->prelimExamScore($score,$user,$group_id);
        if ($data == false){
            $this->session->set_flashdata('exam_error','This student is already drop in this subject.');
        }else{
            $this->session->set_flashdata('exam_success','Score has been inserted.');
        }

    }

    public function midtermExamScore(){
        $score = $this->input->post('exam_midterm-score');
        $user = $this->input->post('studentId');
        $group_id = $this->input->post('groupID');

        $data = $this->grades->midtermExamScore($score,$user,$group_id);
        if ($data == false){
            $this->session->set_flashdata('exam_error','This student is already drop in this subject.');
        }else{
            $this->session->set_flashdata('exam_success','Score has been inserted.');
        }

    }

    public function prefinalExamScore(){
        $score = $this->input->post('exam_prefinal-score');
        $user = $this->input->post('studentId');
        $group_id = $this->input->post('groupID');

        $data = $this->grades->prefinalExamScore($score,$user,$group_id);
        if ($data == false){
            $this->session->set_flashdata('exam_error','This student is already drop in this subject.');
        }else{
            $this->session->set_flashdata('exam_success','Score has been inserted.');
        }

    }

    public function finalsExamScore(){
        $score = $this->input->post('exam_finals-score');
        $user = $this->input->post('studentId');
        $group_id = $this->input->post('groupID');

        $data = $this->grades->finalsExamScore($score,$user,$group_id);
        if ($data == false){
            $this->session->set_flashdata('exam_error','This student is already drop in this subject.');
        }else{
            $this->session->set_flashdata('exam_success','Score has been inserted.');
        }

    }


}