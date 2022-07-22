<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Class_group extends CI_Controller
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
            'content' => 'frontend/main/classGroup',
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'group_details' => $this->group->getAllGroups(),
            'notify_count' => $this->group->getNotificationCount(),
            'count_notify_chat' => $this->group->getCountNotify(),
            'notification' => $this->group->getNotification(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'footer' => $this->manage_website->getFooter()
        );

        $this->load->view('frontend/main/home',$data);
    }


    public function getGroups(){
        if (isset($_POST['group_id']) && $_POST['group_id'] != ''){
            $group_id = $_POST['group_id'];

            $data = $this->db->get_where('class_group',array(
                'id' => $group_id
            ));
            $id = $data->row()->id;

            $std = new stdClass();
            $std->id = $id;

            echo json_encode($std);;
        }
    }

    public function uploadGroupPhoto(){

            $group_id = $this->input->post('id_group');
            $config = array(
                'upload_path' => './uploads/classphoto/',
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
                    'group_img' => $file['file_name']
                );
                $qry = $this->db->get_where('class_group', array('id' => $group_id) );
                if ($qry->num_rows() > 0){
                    $this->db->where('id',$group_id);
                    $this->db->update('class_group',$data);

                }
            }else{
                $this->session->set_flashdata(array(
                    'failedupload' => 'Failed'
                ));
            }

            redirect('class_group');


    }

    public function deleteGroup(){
        if (!empty($_POST)){

            $group_id = $this->input->post('group_id');

            $this->group->deleteGroup($group_id);

        }

    }

    public function select_classgroup(){
        $data = array(
            'class_group' => $this->group->getCG()
        );
        $this->load->view('frontend/main/classgroup/select_group',$data);
    }

    public function studentGroup(){
        $data = array(
            'class_group' => $this->group->getAllGroups(),
            'students' => $this->group->getStudentGroup()
        );
        $this->load->view('frontend/main/classgroup/students_group',$data);
    }


    public function classWall(){
        $id = $this->input->get('id');
        $data = array(
            'content' => 'frontend/main/class_wall/class_wall',
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'group' => $this->group->getCGById($id),
            'group_details' => $this->group->getAllGroups(),
            'subject' => $this->add_subjects->getAllSubjects(),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'webdata' => $this->manage_website->getWebData(),
            'comment' => $this->group->getComment($id),
            'check_webdata' => $this->manage_website->checkWebData(),
            'notify_count' => $this->group->getNotificationCount(),
            'count_notify_chat' => $this->group->getCountNotify(),
            'notification' => $this->group->getNotification(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'footer' => $this->manage_website->getFooter()
        );
        $this->load->view('frontend/main/home',$data);
    }

    public function quizAndExam(){
        $id = $this->input->get('id');
        $data = array(
            'content' => 'frontend/main/quiz_exam/quizAndexam',
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'group' => $this->group->getCGById($id),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'quiz_info' => $this->quiz->getQuizInfo($id),
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'notify_count' => $this->group->getNotificationCount(),
            'count_notify_chat' => $this->group->getCountNotify(),
            'notification' => $this->group->getNotification(),
            'group_details' => $this->group->getAllGroups(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'footer' => $this->manage_website->getFooter()
        );
        $this->load->view('frontend/main/home',$data);

    }

    public function viewSummary(){
        $id = $this->input->get('id');
        $qID = $this->input->get('q');
        $data = array(
            'content' => 'frontend/main/quiz_exam/view_summary',
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'group' => $this->group->getCGById($id),
            'getStudens' => $this->user_management->getAllStudents(),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'students' => $this->user_management->getAllStudentByGroup($id),
            'studentsGroup' => $this->group->getStudentsGroupSummary($id),
            'exam_summary' => $this->quiz->examSummary($qID),
            'student_score' => $this->quiz->studentScore($qID),
            'quiz_info' => $this->quiz->getQuizInfo($id),
            'questions' => $this->quiz->getQuestions($qID),
            'choices' => $this->quiz->getChoices(),
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'notify_count' => $this->group->getNotificationCount(),
            'count_notify_chat' => $this->group->getCountNotify(),
            'notification' => $this->group->getNotification(),
            'group_details' => $this->group->getAllGroups(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'footer' => $this->manage_website->getFooter()
        );
        $this->load->view('frontend/main/home',$data);
    }

    public function class_discussion(){
        $id = $this->input->get('id');
        $data = array(
            'content' => 'frontend/main/group_chat/group_chat',
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'group' => $this->group->getCGById($id),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'all_students' => $this->group->getAllStudentInGroup($id),
            'students' => $this->user_management->getAllStudents(),
            'instructor' => $this->user_management->getAllInstructor(),
            'notify_count' => $this->group->getNotificationCount(),
            'count_notify_chat' => $this->group->getCountNotify(),
            'group_details' => $this->group->getAllGroups(),
            'notification' => $this->group->getNotification(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'footer' => $this->manage_website->getFooter()
        );
        $this->load->view('frontend/main/home',$data);;
    }

    public function projects(){
        $id = $this->input->get('id');
        $data = array(
            'content' => 'frontend/main/projects/projects',
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'group' => $this->group->getCGById($id),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'students' => $this->user_management->getAllStudentByGroup($id),
            'projects' => $this->projects->getStudentProjects($id),
            'prelim' => $this->grades->prelimGrade($id),
            'midterm' => $this->grades->midtermGrade($id),
            'prefinal' => $this->grades->prefinalGrade($id),
            'finals' => $this->grades->finalsGrade($id),
            'deadline' => $this->projects->deadline($id),
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'notify_count' => $this->group->getNotificationCount(),
            'count_notify_chat' => $this->group->getCountNotify(),
            'notification' => $this->group->getNotification(),
            'group_details' => $this->group->getAllGroups(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'footer' => $this->manage_website->getFooter()
        );
        $this->load->view('frontend/main/home',$data);;
    }

//    public function live_lecture(){
//        $id = $this->input->get('id');
//        $data = array(
//            'content' => 'frontend/main/live_lecture/live_lecture',
//            'all_users' => $this->user_management->getAllUsers(),
//            'user_data' => $this->user_management->getUserData(),
//            'group' => $this->group->getCGById($id),
//            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
//            'webdata' => $this->manage_website->getWebData(),
//            'comment' => $this->group->getComment($id),
//            'check_webdata' => $this->manage_website->checkWebData(),
//            'notify_count' => $this->group->getNotificationCount(),
//            'notification' => $this->group->getNotification(),
//            'footer' => $this->manage_website->getFooter()
//        );
//        $this->load->view('frontend/main/home',$data);
//    }

    public function video_tutorial(){
        $id = $this->input->get('id');
        $data = array(
            'content' => 'frontend/main/video_tutorial/video_tutorial',
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'group' => $this->group->getCGById($id),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'webdata' => $this->manage_website->getWebData(),
            'video' => $this->videos->getVideos($id),
            'play' => $this->videos->getAllVideos(),
            'comment' => $this->group->getComment($id),
            'check_webdata' => $this->manage_website->checkWebData(),
            'notify_count' => $this->group->getNotificationCount(),
            'count_notify_chat' => $this->group->getCountNotify(),
            'notification' => $this->group->getNotification(),
            'group_details' => $this->group->getAllGroups(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'footer' => $this->manage_website->getFooter()
        );
        $this->load->view('frontend/main/home',$data);
    }

    public function class_library(){
        $id = $this->input->get('id');
        $data = array(
            'content' => 'frontend/main/class_library/library',
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'group' => $this->group->getCGById($id),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'webdata' => $this->manage_website->getWebData(),
            'comment' => $this->group->getComment($id),
            'check_webdata' => $this->manage_website->checkWebData(),
            'notify_count' => $this->group->getNotificationCount(),
            'count_notify_chat' => $this->group->getCountNotify(),
            'notification' => $this->group->getNotification(),
            'group_details' => $this->group->getAllGroups(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'class_files' => $this->library->getFiles(),
            'footer' => $this->manage_website->getFooter()
        );
        $this->load->view('frontend/main/home',$data);
    }

    public function members(){
        $id = $this->input->get('id');
        $data = array(
            'content' => 'frontend/main/members/members',
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'group' => $this->group->getCGById($id),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'all_students' => $this->group->getAllStudentInGroup($id),
            'students' => $this->user_management->getAllStudents(),
            'instructor' => $this->user_management->getAllInstructor(),
            'notify_count' => $this->group->getNotificationCount(),
            'count_notify_chat' => $this->group->getCountNotify(),
            'notification' => $this->group->getNotification(),
            'group_details' => $this->group->getAllGroups(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'footer' => $this->manage_website->getFooter()
        );
        $this->load->view('frontend/main/home',$data);
    }
    public function commentAjax(){

        if(isset($_POST['task']) && $_POST['task'] == 'comment_insert'){
            $group_id = $_POST['groupId'];
            $userID = (int)$_POST['userId'];
            $comment = addslashes(str_replace("\n","</br>",$_POST['comment']));
            $avatar = $_POST['avatar'];
            $name = $_POST['name'];
            $group_image = $_POST['group_image'];
            $uri = $_POST['uri'];

            $std = new stdClass();
            $std->comment_id = 24;
            $std->userID = $userID;
            $std->comment = htmlspecialchars($comment);
            $std->userName = $name;
            $std->profile_img = base_url()."uploads/users/".$avatar;

            $this->group->insertComment($uri,$group_image,$userID,$comment,$avatar,$name,$group_id);

            echo json_encode($std);

        }else{

        }
    }

//    Create Quiz
    public function createQuiz(){
        if (!empty($_POST)){
            $output = '';
            $group_id = $this->input->post('group_id');
            $name = $this->input->post('quiz_name');
            $type = $this->input->post('type');
            $start = $this->input->post('start_date');
            $limit = $this->input->post('limit');
            $term = $this->input->post('term');
            $post = $this->input->post('post');

            $data = $this->quiz->createQuiz($group_id,$name,$type,$start,$limit,$term,$post);

            $query = $this->db->get_where('quiz_exam',array(
                'group_id' => $group_id
            ));
            $quiz_info = $query->result();
            if ($data == true){
                foreach ($quiz_info as $info){
                    $output .= '<div class="quiz-list">';
                    $output .= '<span><a href="">'.$info->name.'</a></span>';
                    $output .= '</div>';
                }

                echo $output;
            }

        }

    }

    public function createQuizManual(){
        if (!empty($_POST)){
            $output = '';
            $group_id = $this->input->post('group_id');
            $name = $this->input->post('quiz_name');
            $type = $this->input->post('type');
            $default_start = $this->input->post('start_time');
            $limit = $this->input->post('limit');
            $term = $this->input->post('term');
            $post = $this->input->post('post');

            $data = $this->quiz->createQuizManual($group_id,$name,$type,$default_start,$limit,$term,$post);

            $query = $this->db->get_where('quiz_exam',array(
                'group_id' => $group_id
            ));
            $quiz_info = $query->result();
            if ($data == true){
                foreach ($quiz_info as $info){
                    $output .= '<div class="quiz-list">';
                    $output .= '<span><a href="">'.$info->name.'</a></span>';
                    $output .= '</div>';
                }

                echo $output;
            }

        }
    }

    public function manualStartOfQuiz(){
        if (!empty($_POST)){
            $quiz_id = $_POST['id'];
            $query = $this->db->get_where('quiz_exam',array(
                'id' => $quiz_id
            ));

            $check_question = $this->db->get_where('questions',array(
                'quiz_id' => $quiz_id
            ));

            if ($check_question->num_rows() == 0){
                $msg = $this->session->set_flashdata('no_question','Their is no question created.');
//                redirect('class_group/createQuestion?q='.$quiz_id);
                $output = "";
                $output .= "<div class=\"alert alert-danger alert-dismissable\">";
                $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>";
                $output .= "<strong>Sorry!</strong>&nbsp; '.'$msg'";
                $output .= "</div>";

                $std = new stdClass();
                $std->msg = $output;

            }else{
                $start_time = date('Y-m-d H:i:s');
                $set_start = array(
                    'start' => $start_time
                );
                $this->db->where('id',$quiz_id);
                $this->db->update('quiz_exam',$set_start);

                $id = $query->row()->id;
                $std = new stdClass();
                $std->id = $id;
                $std->start = $start_time;

                echo json_encode($std);
            }


        }
    }

    public function searchQuiz(){
        $output = '';
        if (isset($_POST['search']) && $_POST['search'] != ''){
            $group_id = $_POST['group_id'];
            $this->db->like(array(
                'name' => $_POST['search']
            ));
            $query = $this->db->get('quiz_exam');
            $quiz = $query->result();

            if ($quiz != null){
                foreach ($quiz as $data){
                    if ($data->group_id == $group_id){
                        $output .= '<div class="quiz-list">';
                        $output .= '<span><a style="font-weight: bold;" href="'.site_url().'class_group/createQuestion?q='.$data->id.'">'.$data->name.'</a></span>';
                        $output .= '<div class="q-settings dropdown">';
                        $output .= '<a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>';
                        $output .= '<ul class="dropdown-menu">';
                        $output .= '<li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#edit-modal" class="QuizEdit" id="'.$data->id.'" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Edit</a></li>';
                        $output .= '<li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#delete-modal" class="QuizDelete" id="'.$data->id.'"><i style="margin-right: 20px;" class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>';
                        $output .= '</ul>';
                        $output .= '</a>';
                        $output .= '</div>';
                        $output .= '</div>';
                    }
                }

                echo $output;
            }else{
                $output .= '<div class="quiz-list" style="text-align: center">';
                $output .= '<span style="font-weight: bold">No Data Found</span>';
                $output .= '</div>';

                echo $output;
            }

        }else{

            $this->db->order_by('log', 'desc');
            $this->db->where('group_id',$_POST['group_id']);
            $queries = $this->db->get('quiz_exam');
            $quizzes = $queries->result();

            if ($quizzes == null){
                $output .= '<div class="quiz-list" style="text-align: center">';
                $output .= '<h4 style="text-align: center;margin-top: 20px;" >Empty Data</h4>';
                $output .= '</div>';

                echo $output;
            }else{
                foreach ($quizzes as $info){
                    $output .= '<div class="quiz-list">';
                    $output .= '<span><a style="font-weight: bold;" href="'.site_url().'class_group/createQuestion?q='.$info->id.'">'.$info->name.'</a></span>';
                    $output .= '<div class="q-settings dropdown">';
                    $output .= '<a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>';
                    $output .= '<ul class="dropdown-menu">';
                    $output .= '<li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#edit-modal" class="QuizEdit" id="'.$info->id.'" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Edit</a></li>';
                    $output .= '<li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#delete-modal" class="QuizDelete" id="'.$info->id.'"><i style="margin-right: 20px;" class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>';
                    $output .= '</ul>';
                    $output .= '</a>';
                    $output .= '</div>';
                    $output .= '</div>';
                }
                echo $output;
            }

        }
    }

    public function getExamSummary(){
        $output = "";
        if (isset($_POST['user_id']) && $_POST['user_id'] != ''){
            $student_id = $_POST['user_id'];
            $quiz_id = $_POST['quiz_id'];
            $data = $this->db->get_where('exam_summary',array(
                'student_id' => $student_id,
                'quiz_id' => $quiz_id
            ));
            $summary = $data->result();
            $get_questions = $this->db->get_where('questions',array(
                'quiz_id' => $quiz_id
            ));
            $questions = $get_questions->result();

            $get_choices = $this->db->get('multiple_choice');

            $choices = $get_choices->result();

            foreach ($summary as $sums) {
            foreach ($questions as $cnt=>$quest) {

                    if ($quest->id == $sums->question_id){
                        $output .= "<span style='font-size: 17px;font-weight: bold;background: #475080;color: ghostwhite;padding: 5px 5px 5px 5px;border-radius: 3px 3px 3px 3px'>$quest->question</span><br>";
                        $output .= "<div class='row'></div>";
                        if ($sums->answer == ''){
                            $answer = '';
                        }else{
                            $answer = $sums->answer;
                        }
                        $output .= "<span style='font-size: 15px;font-weight: bold;'>Answer</span> : <span style='font-size: 15px;'>$answer</span><br>";

                        foreach ($choices as $cho){
                        if ($cho->question_id == $quest->id){
                            if ($cho->is_correct == 1){
                                $output .= "<span style='font-size: 15px;font-weight: bold;'>Correct Answer</span> : <span style='font-size: 15px;'>$cho->choices</span><br>";
                            }
                        }
                        }
                        $output .= "<div class='row' style='margin-top: 10px;'></div>";
                    }
                }
            }

            echo $output;
        }
    }

    public function getQuiz(){
        if (isset($_POST['quiz_id']) && $_POST['quiz_id'] != ''){
            $quiz_id = $_POST['quiz_id'];
           $data = $this->db->get_where('quiz_exam',array(
               'id' => $quiz_id
           ));
           $name = $data->row()->name;
           $term = $data->row()->term;
           $type = $data->row()->type;
           $start = $data->row()->start;
           $end = $data->row()->time_limit;
           $post = $data->row()->post;

            $std = new stdClass();
            $std->name = $name;
            $std->term = $term;
            $std->type = $type;
            $std->start = $start;
            $std->end = $end;
            $std->post = $post;
            $std->id = $quiz_id;

            echo json_encode($std);;
        }
    }

    public function editQuiz(){
        if (!empty($_POST)){
            $output = '';
            $quiz_id = $this->input->post('quiz_id');
            $group_id = $this->input->post('group_id');
            $name = $this->input->post('quiz_name');
            $type = $this->input->post('type');
            $start = $this->input->post('start_date');
            $limit = $this->input->post('limit');
            $term = $this->input->post('term');
            $post = $this->input->post('post');

            $data = $this->quiz->editQuiz($quiz_id,$name,$type,$start,$limit,$term,$post);

            $query = $this->db->get_where('quiz_exam',array(
                'group_id' => $group_id
            ));
            $quiz_info = $query->result();
            if ($data == true){
                foreach ($quiz_info as $info){
                    $output .= '<div class="quiz-list">';
                    $output .= '<span><a href="">'.$info->name.'</a></span>';
                    $output .= '</div>';
                }
                echo $output;
            }

        }
    }

    public function deleteQuiz(){
        if (!empty($_POST)){
            $output = '';
            $quiz_id = $this->input->post('id_quiz');
            $group_id = $this->input->post('group_id');

            $data = $this->quiz->deleteQuiz($quiz_id);

            $query = $this->db->get_where('quiz_exam',array(
                'group_id' => $group_id
            ));
            $quiz_info = $query->result();
            if ($data == true){
                foreach ($quiz_info as $info){
                    $output .= '<div class="quiz-list">';
                    $output .= '<span><a href="">'.$info->name.'</a></span>';
                    $output .= '</div>';
                }
                echo $output;
            }

        }
    }

    public function createQuestion(){

        $quiz_id = $this->input->get('q');
        $data = array(
            'content' => 'frontend/main/quiz_exam/create_question',
            'all_users' => $this->user_management->getAllUsers(),
            'get_quiz' => $this->quiz->getQuizById($quiz_id),
            'user_data' => $this->user_management->getUserData(),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'question' => $this->quiz->getQuestionsInstructor($quiz_id),
            'time_limit' => $this->quiz->checkTimeLimit($quiz_id),
            'numbering' => $this->quiz->questionNumbering($quiz_id),
            'numberofquestion' => $this->quiz->getNumberOfQuestion($quiz_id),
            'summary' => $this->quiz->getNumberExamSummary($quiz_id),
            'get_result' => $this->quiz->getResult($quiz_id),
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'notify_count' => $this->group->getNotificationCount(),
            'count_notify_chat' => $this->group->getCountNotify(),
            'notification' => $this->group->getNotification(),
            'group_details' => $this->group->getAllGroups(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'footer' => $this->manage_website->getFooter()
        );
        $this->load->view('frontend/main/home',$data);

    }

    public function addQuestion(){

        if (isset($_POST["type"])) {
            if ($_POST["type"] == 'multiple') {
                $this->multipleChoicePage();
            }elseif($_POST["type"] == 'trueORfalse'){
                $this->trueOrFalse();
            }elseif($_POST["type"] == 'blank'){
                $this->fill_inthe_blank();
            }

        }
    }

    public function multipleChoicePage(){
        $this->load->view('frontend/main/quiz_exam/multiple_choice');
    }
    public function trueOrFalse(){
        $this->load->view('frontend/main/quiz_exam/trueOrfalse');
    }
    public function essay(){
        $this->load->view('frontend/main/quiz_exam/essay');
    }
    public function fill_inthe_blank(){
        $this->load->view('frontend/main/quiz_exam/fill_in_the_blank');
    }


    public function questionAndAnswer(){
        $q_id = $this->input->post('quest_id');
        $number = $this->input->post('question_number');
        $quest = $this->input->post('question');
        $choice = $this->input->post('choice');
        $type = $this->input->post('type');
        $correct = $this->input->post('correct');
        $term = $this->input->post('term');
        $kind_of = $this->input->post('kind_of');
        $group_id = $this->input->post('group_id');

        $data = $this->quiz->question($q_id,$number,$quest,$type,$term,$group_id,$kind_of);
        if ($data == true){
            foreach ($choice as $c => $value){
                if ($value != ''){
                    if ($correct == $c){
                        $is_correct = 1;
                    }else{
                        $is_correct = 0;
                    }
                    $this->quiz->choices($q_id,$quest,$value,$is_correct);
                }

            }
            redirect('class_group/createQuestion?q='.$q_id);
        }else{
            redirect('class_group/createQuestion?q='.$q_id);
        }
    }


    public function getQuestion(){
        if (isset($_POST['question_id']) && $_POST['question_id'] != ''){
            $question_id = $_POST['question_id'];

            $data = $this->db->get_where('questions',array(
                'id' => $question_id
            ));

            $getChoice = $this->db->get_where('multiple_choice',array(
                'question_id' => $question_id
            ));
            $choices = $getChoice->result();


            if ($data->row()->type == 'Multiple Choice'){
                foreach ($choices as $num => $select){
                    if ($num == 0){
                        $choice1 = $select->choices;
                        if ($select->is_correct == 1){
                            $correct1 = 'checked';
                        }else{
                            $correct1 = '';
                        }
                    }elseif ($num == 1){
                        $choice2 = $select->choices;
                        if ($select->is_correct == 1){
                            $correct2 = 'checked';
                        }else{
                            $correct2 = '';
                        }
                    }
                    elseif ($num == 2){
                        $choice3 = $select->choices;
                        if ($select->is_correct == 1){
                            $correct3 = 'checked';
                        }else{
                            $correct3 = '';
                        }
                    }
                    elseif ($num == 3){
                        $choice4 = $select->choices;
                        if ($select->is_correct == 1){
                            $correct4 = 'checked';
                        }else{
                            $correct4 = '';
                        }
                    }
                }

                $multiple = '';
                $multiple .= '<div class="form-group">';
                $multiple .= '<label for="choice1" style="float: right">Correct Answer </label>';
                $multiple .= '<input style="float: right" type="radio" name="correct" value="0" '.$correct1.'  required>';
                $multiple .= '<div class="input-group">';
                $multiple .= '<input type="text" class="form-control" name="choice[]"  value="'.$choice1.'" placeholder="Enter Choices" required>';
                $multiple .= '<span class="input-group-addon">';
                $multiple .= '<span>A</span>';
                $multiple .= '</span>';
                $multiple .= '</div>';
                $multiple .= '</div>';
                $multiple .= '<div class="form-group">';
                $multiple .= '<label style="float: right" for="choice2">Correct Answer</label>';
                $multiple .= '<input style="float: right" type="radio" name="correct"  value="1" '.$correct2.' required>';
                $multiple .= '<div class="input-group">';
                $multiple .= '<input type="text" class="form-control" name="choice[]" value="'.$choice2.'" placeholder="Enter Choices" required>';
                $multiple .= '<span class="input-group-addon">';
                $multiple .= '<span>B</span>';
                $multiple .= '</span>';
                $multiple .= '</div>';
                $multiple .= '</div>';
                $multiple .= '<div class="form-group">';
                $multiple .= '<label style="float: right" for="choice2">Correct Answer</label>';
                $multiple .= '<input style="float: right" type="radio" name="correct"  value="2" '.$correct3.' required>';
                $multiple .= '<div class="input-group">';
                $multiple .= '<input type="text" class="form-control" name="choice[]" value="'.$choice3.'" placeholder="Enter Choices" required>';
                $multiple .= '<span class="input-group-addon">';
                $multiple .= '<span>C</span>';
                $multiple .= '</span>';
                $multiple .= '</div>';
                $multiple .= '</div>';
                $multiple .= '<div class="form-group">';
                $multiple .= '<label style="float: right" for="choice2">Correct Answer</label>';
                $multiple .= '<input style="float: right" type="radio" name="correct"  value="3" '.$correct4.' required>';
                $multiple .= '<div class="input-group">';
                $multiple .= '<input type="text" class="form-control" name="choice[]" value="'.$choice4.'" placeholder="Enter Choices" required>';
                $multiple .= '<span class="input-group-addon">';
                $multiple .= '<span>D</span>';
                $multiple .= '</span>';
                $multiple .= '</div>';
                $multiple .= '</div>';
                $multiple .= '<input type="hidden" class="form-control" name="type"  value="Multiple Choice">';
            }

            if ($data->row()->type == 'True or False'){
//                            True OR False
                foreach ($choices as $num => $select){
                    if ($num == 0){
                        $choice1 = $select->choices;
                        if ($select->is_correct == 1){
                            $correct1 = 'checked';
                        }else{
                            $correct1 = '';
                        }
                    }elseif ($num == 1){
                        $choice2 = $select->choices;
                        if ($select->is_correct == 1){
                            $correct2 = 'checked';
                        }else{
                            $correct2 = '';
                        }
                    }
                }


                $trueOrfalse = '';
                $trueOrfalse .= '<div class="form-group">';
                $trueOrfalse .= '<label for="choice1">True</label>';
                $trueOrfalse .= '<input type="radio" name="correct" value="0" '.$correct1.'  required>';
                $trueOrfalse .= '<input type="hidden" class="form-control" value="True" name="choice[]" placeholder="Enter Choices" required>';
                $trueOrfalse .= '<label for="choice2">False</label>';
                $trueOrfalse .= '<input type="radio" name="correct" value="1" '.$correct2.' required>';
                $trueOrfalse .= '<input type="hidden" value="False" class="form-control" name="choice[]" placeholder="Enter Choices" required>';
                $trueOrfalse .= '</div>';
                $trueOrfalse .= '<input type="hidden" class="form-control" name="type"  value="True or False">';

            }

            if ($data->row()->type == 'Fill in the Blank'){

                foreach ($choices as $num => $select){
                    $choice = $select->choices;
                }

                $fillInTheBlank = '';
                $fillInTheBlank .= '<div class="form-group">';
                $fillInTheBlank .= '<label for="correct">Correct Answer </label>';
                $fillInTheBlank .= ' <input type="text" class="form-control" name="choice[]" value="'.$choice.'" id="choice" placeholder="Enter Answer" required>';
                $fillInTheBlank .= '</div>';
                $fillInTheBlank .= '<input type="hidden" class="form-control" name="type"  value="Fill in the Blank">';

            }


            $type = $data->row()->type;
            $question = $data->row()->question;
            $std = new stdClass();
            $std->type = $type;
            $std->id = $question_id;
            $std->question = $question;

            if ($type == 'Multiple Choice'){
                $std->preview =  $multiple;
            }elseif ($type == 'True or False'){
                $std->preview =  $trueOrfalse;
            }elseif ($type == 'Fill in the Blank'){
                $std->preview =  $fillInTheBlank;
            }

            echo json_encode($std);;
        }
    }

    public function editQuestion(){
        $quiz_id = $this->input->post('quiz_id');
        $quest_id = $this->input->post('question_id');
        $quest = $this->input->post('question');
        $choice = $this->input->post('choice');
        $type = $this->input->post('type');
        $correct = $this->input->post('correct');


        $data = $this->quiz->editQuestion($quest_id,$quest,$type);
        if ($data == true){
            $this->quiz->deleteChoices($quest_id);
            foreach ($choice as $count => $value){
                if ($value != ''){
                    if ($correct == $count){
                        $is_correct = 1;
                    }else{
                        $is_correct = 0;
                    }
                    $this->quiz->editChoice($quest_id,$value,$is_correct);
                }
            }

            redirect('class_group/createQuestion?q='.$quiz_id);
        }else{
            redirect('class_group/createQuestion?q='.$quiz_id);
        }


    }

    public function deleteQuestions(){
        $quiz_id = $this->input->post('quiz_id');
        $question_id = $this->input->post('questionID');
        $data = $this->quiz->deleteQuestion($question_id);
        if ($data == true){
            redirect('class_group/createQuestion?q='.$quiz_id);
        }else{
            redirect('class_group/createQuestion?q='.$quiz_id);
        }

    }

//    Student's Menu
//    Exam Page
    public function startOfExam(){
        $quiz_id = $this->input->get('q');
        $question_num = $this->input->get('n');

        $data = array(
            'content' => 'frontend/main/quiz_exam/student_exam',
            'all_users' => $this->user_management->getAllUsers(),
            'user_data' => $this->user_management->getUserData(),
            'get_quiz' => $this->quiz->getQuizById($quiz_id),
            'on_going_exam' => $this->quiz->getQuizByStudentsId(),
            'question' => $this->quiz->getQuestionsStudent($quiz_id,$question_num),
            'choices' => $this->quiz->getChoices(),
            'time_limit' => $this->quiz->checkTimeLimit($quiz_id),
            'numberofquestion' => $this->quiz->getNumberOfQuestion($quiz_id),
            'summary' => $this->quiz->getNumberExamSummary($quiz_id),
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
            'notify_count' => $this->group->getNotificationCount(),
            'count_notify_chat' => $this->group->getCountNotify(),
            'notification' => $this->group->getNotification(),
            'group_details' => $this->group->getAllGroups(),
            'chat_msg' => $this->chat_message->getMessageUsers(),
            'count_items' => $this->quiz->numberOfItems($quiz_id),
            'footer' => $this->manage_website->getFooter()
        );
        $this->load->view('frontend/main/home',$data);
    }


    public function getScore(){
        $quiz_id = $this->input->post('quiz_id');
        $number = $this->input->post('number');
        $question = $this->input->post('question_id');
        $answer = $this->input->post('answer');
        $term = $this->input->post('term');
        $group_id = $this->input->post('group_id');
        $exam_type = $this->input->post('exam_type');
        $total_items = $this->quiz->numberOfItems($quiz_id);
        $user = $this->session->userdata('id');

        $this->quiz->getScore($question, $answer, $quiz_id,$term,$group_id,$exam_type);
//        if ($data == true){
            $this->quiz->perTermAverage($group_id,$term,$quiz_id,$exam_type);
            $this->quiz->GWA($group_id,$user);

//            redirect('class_group/startOfExam?q='.$quiz_id);
//        }else{
//            $this->quiz->perTermAverage($group_id,$term);
//            $this->quiz->GWA($group_id);
//            redirect('class_group/startOfExam?q='.$quiz_id);
//        }
    }

    public function getStudentsPrelim(){
        if (isset($_POST['student_id']) && $_POST['student_id'] != ''){
            $student_id = $_POST['student_id'];
            $data = $this->db->get_where('prelim',array(
                'student_id' => $student_id
            ));
            $student = $data->row()->student_id;
            $project = $data->row()->project;
            $participation = $data->row()->participation;

            $std = new stdClass();
            $std->id = $student;
            $std->remarks = $project;
            $std->participation = $participation;


            echo json_encode($std);;
        }
    }

    public function inputPrelimProject(){
        if (!empty($_POST)){

            $student_id = $this->input->post('student_id');
            $group_id = $this->input->post('group_id');
            $remarks = $this->input->post('prelim-remarks');

            $data = $this->projects->prelimRemarks($student_id,$group_id,$remarks);
            if ($data == false){
                $this->session->set_flashdata('project_error','This student is already drop in this subject.');
            }else{
                $this->session->set_flashdata('project_success','Grade has been inserted.');
            }

        }
    }

    public function getStudentsMidterm(){
        if (isset($_POST['student_id']) && $_POST['student_id'] != ''){
            $student_id = $_POST['student_id'];
            $data = $this->db->get_where('midterm',array(
                'student_id' => $student_id
            ));
            $student = $data->row()->student_id;
            $project = $data->row()->project;
            $participation = $data->row()->participation;

            $std = new stdClass();
            $std->id = $student;
            $std->remarks = $project;
            $std->participation = $participation;


            echo json_encode($std);
        }
    }

    public function insertMidtermProject(){
        $group_id = $this->input->post('groupID');
        $student_id = $this->input->post('studentID');
        $remarks = $this->input->post('midterm-remarks');

        $data = $this->projects->midtermRemarks($student_id,$group_id,$remarks);
        if ($data == false){
            $this->session->set_flashdata('project_error','This student is already drop in this subject.');
        }else{
            $this->session->set_flashdata('project_success','Grade has been inserted.');
        }

    }

    public function getStudentsPrefinal(){
        if (isset($_POST['student_id']) && $_POST['student_id'] != ''){
            $student_id = $_POST['student_id'];
            $data = $this->db->get_where('prefinal',array(
                'student_id' => $student_id
            ));
            $student = $data->row()->student_id;
            $project = $data->row()->project;
            $participation = $data->row()->participation;

            $std = new stdClass();
            $std->id = $student;
            $std->remarks = $project;
            $std->participation = $participation;


            echo json_encode($std);;
        }
    }

    public function insertPrefinalProject(){
        $group_id = $this->input->post('groupID');
        $student_id = $this->input->post('studentId');
        $remarks = $this->input->post('prefinal-remarks');

        $data = $this->projects->prefinalRemarks($student_id,$group_id,$remarks);
        if ($data == false){
            $this->session->set_flashdata('project_error','This student is already drop in this subject.');
        }else{
            $this->session->set_flashdata('project_success','Grade has been inserted.');
        }
    }

    public function getStudentsFinals(){
        if (isset($_POST['student_id']) && $_POST['student_id'] != ''){
            $student_id = $_POST['student_id'];
            $data = $this->db->get_where('finals',array(
                'student_id' => $student_id
            ));
            $student = $data->row()->student_id;
            $project = $data->row()->project;
            $participation = $data->row()->participation;

            $std = new stdClass();
            $std->id = $student;
            $std->remarks = $project;
            $std->participation = $participation;


            echo json_encode($std);;
        }
    }

    public function insertFinalsProject(){
        $group_id = $this->input->post('groupID');
        $student_id = $this->input->post('studentId');
        $remarks = $this->input->post('finals-remarks');

        $data = $this->projects->finalRemarks($student_id,$group_id,$remarks);
        if ($data == false){
            $this->session->set_flashdata('project_error','This student is already drop in this subject.');
        }else{
            $this->session->set_flashdata('project_success','Grade has been inserted.');
        }
    }

    public function searchProjectPrelim(){
        $output = '';
        $group_id = $_POST['group_id'];
        $students_group = $this->db->get_where('students_group',array(
            'group_id' => $group_id
        ));
        $group = $students_group->result();
        $stud_projects = $this->db->get_where('projects',array(
            'group_id' => $group_id
        ));
        $projects = $stud_projects->result();

        $preResult = $this->db->get_where('prelim',array(
            'group_id' => $group_id
        ));
        $prelim = $preResult->result();

        if (isset($_POST['search']) && $_POST['search'] != ''){


//            $this->db->like('firstname',$_POST['search']);
            $this->db->like('lastname',$_POST['search']);
            $query = $this->db->get('endusers');
            $students = $query->result();

            if ($students != null){
                foreach ($students as $data) {
                    foreach ($group as $stud) {
                        if ($stud->student_id == $data->id) {
                            foreach ($projects as $pro) {
                                foreach ($prelim as $remarks) {
                                    if ($remarks->student_id == $data->id) {
                                        if ($pro->student_id == $data->id) {
                                            $output .= '<div class="quiz-list row">';
                                            $output .= '<div class="col-md-6">';
                                            $output .= '<span style="color: black;font-weight: bold;">' . $data->lastname. ', ' . $data->firstname . '</span>';
                                            $output .= '</div>';
                                            $output .= '<div class="col-md-4">';
                                            if ($pro->prelim == null) {
                                                $output .= '<span>No project</span>';
                                            } else {
                                                $output .= '<span><a href="'.base_url().'uploads/projects/'.$pro->prelim.'" download="'.$pro->prelim.'">' . $pro->prelim . '</a></span>';
                                            }
                                            $output .= '</div>';
                                            $output .= '<div class="col-md-2">';
                                            $output .= '<span style="font-weight: bold">'.$remarks->project.'</span>';
                                            $output .= '<div class="q-settings dropdown">';
                                            $output .= '<a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>';
                                            $output .= '<ul class="dropdown-menu">';
                                            $output .= '<li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#prelimRemarks" class="prelimProject" id="'.$data->id.'" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Remarks</a></li>';
                                            $output .= '</ul>';
                                            $output .= '</a>';
                                            $output .= '</div>';
                                            $output .= '</div>';
                                            $output .= '</div>';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                echo $output;
            }else{
                $output .= '<div class="quiz-list" style="text-align: center">';
                $output .= '<span style="font-weight: bold">No Data Found</span>';
                $output .= '</div>';

                echo $output;
            }

        }else{

            $this->db->where('status','activated');
            $this->db->order_by('lastname');
            $students_data = $this->db->get('endusers');

            $students = $students_data->result();

            foreach ($students as $data) {
                foreach ($group as $stud) {
                    if ($stud->student_id == $data->id) {
                        foreach ($projects as $pro) {
                            foreach ($prelim as $remarks) {
                                if ($remarks->student_id == $data->id) {
                                    if ($pro->student_id == $data->id) {
                                        $output .= '<div class="quiz-list row">';
                                        $output .= '<div class="col-md-6">';
                                        $output .= '<span style="color: black;font-weight: bold;">' . $data->lastname . ', ' . $data->firstname . '</span>';
                                        $output .= '</div>';
                                        $output .= '<div class="col-md-4">';
                                        if ($pro->prelim == null) {
                                            $output .= '<span>No project</span>';
                                        } else {
                                            $output .= '<span><a href="'.base_url().'uploads/projects/'.$pro->prelim.'" download="'.$pro->prelim.'">' . $pro->prelim . '</a></span>';
                                        }
                                        $output .= '</div>';
                                        $output .= '<div class="col-md-2">';
                                        $output .= '<span style="font-weight: bold">'.$remarks->project.'</span>';
                                        $output .= '<div class="q-settings dropdown">';
                                        $output .= '<a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>';
                                        $output .= '<ul class="dropdown-menu">';
                                        $output .= '<li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#prelimRemarks" class="prelimProject" id="'.$data->id.'" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Remarks</a></li>';
                                        $output .= '</ul>';
                                        $output .= '</a>';
                                        $output .= '</div>';
                                        $output .= '</div>';
                                        $output .= '</div>';
                                    }
                                }
                            }
                        }
                    }
                }
            }

            echo $output;

        }
    }


    public function uploadPrelimProject(){
        $group_id = $this->input->post('group_id');
        $student_id = $this->input->post('student_id');

        $config = array(
            'upload_path' => './uploads/projects/prelim/',
            'allowed_types' => '*',
            'overwrite' => TRUE,
            'max_size' => '5000',
            'max_height' => '0',
            'max_width' => '0',

        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()){

            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $data = array(
                'prelim' => $file['file_name']
            );
            $qry = $this->db->get_where('projects', array('group_id' => $group_id, 'student_id' => $student_id) );
            $array = array('group_id' => $group_id, 'student_id' => $student_id);
            if ($qry->num_rows() > 0){
                $this->db->where($array);
                $this->db->update('projects',$data);

            }
            $this->session->set_flashdata(array(
                'uploaded' => 'The file has been uploaded'
            ));
        }else{
            $this->session->set_flashdata(array(
                'error' => $this->upload->display_errors(),
            ));
        }

        redirect('class_group/projects?id='.$group_id);
    }


    public function searchProjectMidterm(){
        $output = '';
        $group_id = $_POST['group_id'];
        $students_group = $this->db->get_where('students_group',array(
            'group_id' => $group_id
        ));
        $group = $students_group->result();
        $stud_projects = $this->db->get_where('projects',array(
            'group_id' => $group_id
        ));
        $projects = $stud_projects->result();

        $preResult = $this->db->get_where('midterm',array(
            'group_id' => $group_id
        ));
        $midterm = $preResult->result();

        if (isset($_POST['search']) && $_POST['search'] != ''){
//            $this->db->like('firstname',$_POST['search']);
            $this->db->like('lastname',$_POST['search']);
            $query = $this->db->get('endusers');
            $students = $query->result();

            if ($students != null){
                foreach ($students as $data) {
                    foreach ($group as $stud) {
                        if ($stud->student_id == $data->id) {
                            foreach ($projects as $pro) {
                                foreach ($midterm as $remarks) {
                                    if ($remarks->student_id == $data->id) {
                                        if ($pro->student_id == $data->id) {
                                            $output .= '<div class="quiz-list row">';
                                            $output .= '<div class="col-md-6">';
                                            $output .= '<span style="color: black;font-weight: bold;">' . $data->lastname. ', ' . $data->firstname . '</span>';
                                            $output .= '</div>';
                                            $output .= '<div class="col-md-4">';
                                            if ($pro->midterm == null) {
                                                $output .= '<span>No project</span>';
                                            } else {
                                                $output .= '<span><a href="'.base_url().'uploads/projects/'.$pro->midterm.'" download="'.$pro->midterm.'">' . $pro->midterm . '</a></span>';
                                            }
                                            $output .= '</div>';
                                            $output .= '<div class="col-md-2">';
                                            $output .= '<span style="font-weight: bold">'.$remarks->project.'</span>';
                                            $output .= '<div class="q-settings dropdown">';
                                            $output .= '<a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>';
                                            $output .= '<ul class="dropdown-menu">';
                                            $output .= '<li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#prelimRemarks" class="prelimProject" id="'.$data->id.'" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Remarks</a></li>';
                                            $output .= '</ul>';
                                            $output .= '</a>';
                                            $output .= '</div>';
                                            $output .= '</div>';
                                            $output .= '</div>';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                echo $output;
            }else{
                $output .= '<div class="quiz-list" style="text-align: center">';
                $output .= '<span style="font-weight: bold">No Data Found</span>';
                $output .= '</div>';

                echo $output;
            }

        }else{

            $this->db->where('status','activated');
            $this->db->order_by('lastname');
            $students_data = $this->db->get('endusers');

            $students = $students_data->result();

            foreach ($students as $data) {
                foreach ($group as $stud) {
                    if ($stud->student_id == $data->id) {
                        foreach ($projects as $pro) {
                            foreach ($midterm as $remarks) {
                                if ($remarks->student_id == $data->id) {
                                    if ($pro->student_id == $data->id) {
                                        $output .= '<div class="quiz-list row">';
                                        $output .= '<div class="col-md-6">';
                                        $output .= '<span style="color: black;font-weight: bold;">' . $data->lastname . ', ' . $data->firstname . '</span>';
                                        $output .= '</div>';
                                        $output .= '<div class="col-md-4">';
                                        if ($pro->midterm == null) {
                                            $output .= '<span>No project</span>';
                                        } else {
                                            $output .= '<span><a href="'.base_url().'uploads/projects/'.$pro->midterm.'" download="'.$pro->midterm.'">' . $pro->midterm . '</a></span>';
                                        }
                                        $output .= '</div>';
                                        $output .= '<div class="col-md-2">';
                                        $output .= '<span style="font-weight: bold">'.$remarks->project.'</span>';
                                        $output .= '<div class="q-settings dropdown">';
                                        $output .= '<a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>';
                                        $output .= '<ul class="dropdown-menu">';
                                        $output .= '<li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#prelimRemarks" class="prelimProject" id="'.$data->id.'" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Remarks</a></li>';
                                        $output .= '</ul>';
                                        $output .= '</a>';
                                        $output .= '</div>';
                                        $output .= '</div>';
                                        $output .= '</div>';
                                    }
                                }
                            }
                        }
                    }
                }
            }

            echo $output;

        }
    }

    public function uploadMidtermProject(){
        $group_id = $this->input->post('group_id');
        $student_id = $this->input->post('student_id');

        $config = array(
            'upload_path' => './uploads/projects/midterm/',
            'allowed_types' => '*',
            'overwrite' => TRUE,
            'max_size' => '5000',
            'max_height' => '0',
            'max_width' => '0',

        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()){

            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $data = array(
                'midterm' => $file['file_name']
            );
            $qry = $this->db->get_where('projects', array('group_id' => $group_id, 'student_id' => $student_id) );
            $array = array('group_id' => $group_id, 'student_id' => $student_id);
            if ($qry->num_rows() > 0){
                $this->db->where($array);
                $this->db->update('projects',$data);

            }
            $this->session->set_flashdata(array(
                'uploaded' => 'The file has been uploaded'
            ));
        }else{
            $this->session->set_flashdata(array(
                'error' => $this->upload->display_errors(),
            ));
        }

        redirect('class_group/projects?id='.$group_id);
    }

    public function searchProjectPrefinal(){
        $output = '';
        $group_id = $_POST['group_id'];
        $students_group = $this->db->get_where('students_group',array(
            'group_id' => $group_id
        ));
        $group = $students_group->result();
        $stud_projects = $this->db->get_where('projects',array(
            'group_id' => $group_id
        ));
        $projects = $stud_projects->result();

        $preResult = $this->db->get_where('prefinal',array(
            'group_id' => $group_id
        ));
        $prefinal = $preResult->result();

        if (isset($_POST['search']) && $_POST['search'] != ''){


//            $this->db->like('firstname',$_POST['search']);
            $this->db->like('lastname',$_POST['search']);
            $query = $this->db->get('endusers');
            $students = $query->result();

            if ($students != null){
                foreach ($students as $data) {
                    foreach ($group as $stud) {
                        if ($stud->student_id == $data->id) {
                            foreach ($projects as $pro) {
                                foreach ($prefinal as $remarks) {
                                    if ($remarks->student_id == $data->id) {
                                        if ($pro->student_id == $data->id) {
                                            $output .= '<div class="quiz-list row">';
                                            $output .= '<div class="col-md-6">';
                                            $output .= '<span style="color: black;font-weight: bold;">' . $data->lastname. ', ' . $data->firstname . '</span>';
                                            $output .= '</div>';
                                            $output .= '<div class="col-md-4">';
                                            if ($pro->prefinal == null) {
                                                $output .= '<span>No project</span>';
                                            } else {
                                                $output .= '<span><a href="'.base_url().'uploads/projects/'.$pro->prefinal.'" download="'.$pro->prefinal.'">' . $pro->prefinal . '</a></span>';
                                            }
                                            $output .= '</div>';
                                            $output .= '<div class="col-md-2">';
                                            $output .= '<span style="font-weight: bold">'.$remarks->project.'</span>';
                                            $output .= '<div class="q-settings dropdown">';
                                            $output .= '<a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>';
                                            $output .= '<ul class="dropdown-menu">';
                                            $output .= '<li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#prelimRemarks" class="prelimProject" id="'.$data->id.'" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Remarks</a></li>';
                                            $output .= '</ul>';
                                            $output .= '</a>';
                                            $output .= '</div>';
                                            $output .= '</div>';
                                            $output .= '</div>';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                echo $output;
            }else{
                $output .= '<div class="quiz-list" style="text-align: center">';
                $output .= '<span style="font-weight: bold">No Data Found</span>';
                $output .= '</div>';

                echo $output;
            }

        }else{

            $this->db->where('status','activated');
            $this->db->order_by('lastname');
            $students_data = $this->db->get('endusers');

            $students = $students_data->result();

            foreach ($students as $data) {
                foreach ($group as $stud) {
                    if ($stud->student_id == $data->id) {
                        foreach ($projects as $pro) {
                            foreach ($prefinal as $remarks) {
                                if ($remarks->student_id == $data->id) {
                                    if ($pro->student_id == $data->id) {
                                        $output .= '<div class="quiz-list row">';
                                        $output .= '<div class="col-md-6">';
                                        $output .= '<span style="color: black;font-weight: bold;">' . $data->lastname . ', ' . $data->firstname . '</span>';
                                        $output .= '</div>';
                                        $output .= '<div class="col-md-4">';
                                        if ($pro->prefinal == null) {
                                            $output .= '<span>No project</span>';
                                        } else {
                                            $output .= '<span><a href="'.base_url().'uploads/projects/'.$pro->prefinal.'" download="'.$pro->prefinal.'">' . $pro->prefinal . '</a></span>';
                                        }
                                        $output .= '</div>';
                                        $output .= '<div class="col-md-2">';
                                        $output .= '<span style="font-weight: bold">'.$remarks->project.'</span>';
                                        $output .= '<div class="q-settings dropdown">';
                                        $output .= '<a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>';
                                        $output .= '<ul class="dropdown-menu">';
                                        $output .= '<li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#prelimRemarks" class="prelimProject" id="'.$data->id.'" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Remarks</a></li>';
                                        $output .= '</ul>';
                                        $output .= '</a>';
                                        $output .= '</div>';
                                        $output .= '</div>';
                                        $output .= '</div>';
                                    }
                                }
                            }
                        }
                    }
                }
            }

            echo $output;

        }
    }

    public function uploadPrefinalProject(){
        $group_id = $this->input->post('group_id');
        $student_id = $this->input->post('student_id');

        $config = array(
            'upload_path' => './uploads/projects/prefinal/',
            'allowed_types' => '*',
            'overwrite' => TRUE,
            'max_size' => '5000',
            'max_height' => '0',
            'max_width' => '0',

        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()){

            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $data = array(
                'prefinal' => $file['file_name']
            );
            $qry = $this->db->get_where('projects', array('group_id' => $group_id, 'student_id' => $student_id) );
            $array = array('group_id' => $group_id, 'student_id' => $student_id);
            if ($qry->num_rows() > 0){
                $this->db->where($array);
                $this->db->update('projects',$data);

            }
            $this->session->set_flashdata(array(
                'uploaded' => 'The file has been uploaded'
            ));
        }else{
            $this->session->set_flashdata(array(
                'error' => $this->upload->display_errors(),
            ));
        }

        redirect('class_group/projects?id='.$group_id);
    }

    public function searchProjectFinals(){
        $output = '';
        $group_id = $_POST['group_id'];
        $students_group = $this->db->get_where('students_group',array(
            'group_id' => $group_id
        ));
        $group = $students_group->result();
        $stud_projects = $this->db->get_where('projects',array(
            'group_id' => $group_id
        ));
        $projects = $stud_projects->result();

        $preResult = $this->db->get_where('finals',array(
            'group_id' => $group_id
        ));
        $finals = $preResult->result();

        if (isset($_POST['search']) && $_POST['search'] != ''){


//            $this->db->like('firstname',$_POST['search']);
            $this->db->like('lastname',$_POST['search']);
            $query = $this->db->get('endusers');
            $students = $query->result();

            if ($students != null){
                foreach ($students as $data) {
                    foreach ($group as $stud) {
                        if ($stud->student_id == $data->id) {
                            foreach ($projects as $pro) {
                                foreach ($finals as $remarks) {
                                    if ($remarks->student_id == $data->id) {
                                        if ($pro->student_id == $data->id) {
                                            $output .= '<div class="quiz-list row">';
                                            $output .= '<div class="col-md-6">';
                                            $output .= '<span style="color: black;font-weight: bold;">' . $data->lastname. ', ' . $data->firstname . '</span>';
                                            $output .= '</div>';
                                            $output .= '<div class="col-md-4">';
                                            if ($pro->finals == null) {
                                                $output .= '<span>No project</span>';
                                            } else {
                                                $output .= '<span><a href="'.base_url().'uploads/projects/'.$pro->finals.'" download="'.$pro->finals.'">' . $pro->finals . '</a></span>';
                                            }
                                            $output .= '</div>';
                                            $output .= '<div class="col-md-2">';
                                            $output .= '<span style="font-weight: bold">'.$remarks->project.'</span>';
                                            $output .= '<div class="q-settings dropdown">';
                                            $output .= '<a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>';
                                            $output .= '<ul class="dropdown-menu">';
                                            $output .= '<li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#prelimRemarks" class="prelimProject" id="'.$data->id.'" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Remarks</a></li>';
                                            $output .= '</ul>';
                                            $output .= '</a>';
                                            $output .= '</div>';
                                            $output .= '</div>';
                                            $output .= '</div>';
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                echo $output;
            }else{
                $output .= '<div class="quiz-list" style="text-align: center">';
                $output .= '<span style="font-weight: bold">No Data Found</span>';
                $output .= '</div>';

                echo $output;
            }

        }else{

            $this->db->where('status','activated');
            $this->db->order_by('lastname');
            $students_data = $this->db->get('endusers');

            $students = $students_data->result();

            foreach ($students as $data) {
                foreach ($group as $stud) {
                    if ($stud->student_id == $data->id) {
                        foreach ($projects as $pro) {
                            foreach ($finals as $remarks) {
                                if ($remarks->student_id == $data->id) {
                                    if ($pro->student_id == $data->id) {
                                        $output .= '<div class="quiz-list row">';
                                        $output .= '<div class="col-md-6">';
                                        $output .= '<span style="color: black;font-weight: bold;">' . $data->lastname . ', ' . $data->firstname . '</span>';
                                        $output .= '</div>';
                                        $output .= '<div class="col-md-4">';
                                        if ($pro->finals == null) {
                                            $output .= '<span>No project</span>';
                                        } else {
                                            $output .= '<span><a href="'.base_url().'uploads/projects/'.$pro->finals.'" download="'.$pro->finals.'">' . $pro->finals . '</a></span>';
                                        }
                                        $output .= '</div>';
                                        $output .= '<div class="col-md-2">';
                                        $output .= '<span style="font-weight: bold">'.$remarks->project.'</span>';
                                        $output .= '<div class="q-settings dropdown">';
                                        $output .= '<a href="" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-cog fa-lg" aria-hidden="true"></i>';
                                        $output .= '<ul class="dropdown-menu">';
                                        $output .= '<li><a style="font-weight: bold;" href="" data-toggle="modal" data-target="#prelimRemarks" class="prelimProject" id="'.$data->id.'" ><i style="margin-right: 20px;" class="fa fa-edit" aria-hidden="true"></i>Remarks</a></li>';
                                        $output .= '</ul>';
                                        $output .= '</a>';
                                        $output .= '</div>';
                                        $output .= '</div>';
                                        $output .= '</div>';
                                    }
                                }
                            }
                        }
                    }
                }
            }

            echo $output;

        }
    }

    public function uploadFinalsProject(){
        $group_id = $this->input->post('group_id');
        $student_id = $this->input->post('student_id');

        $config = array(
            'upload_path' => './uploads/projects/finals/',
            'allowed_types' => '*',
            'overwrite' => TRUE,
            'max_size' => '5000',
            'max_height' => '0',
            'max_width' => '0',

        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()){

            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $data = array(
                'finals' => $file['file_name']
            );
            $qry = $this->db->get_where('projects', array('group_id' => $group_id, 'student_id' => $student_id) );
            $array = array('group_id' => $group_id, 'student_id' => $student_id);
            if ($qry->num_rows() > 0){
                $this->db->where($array);
                $this->db->update('projects',$data);

            }
            $this->session->set_flashdata(array(
                'uploaded' => 'The file has been uploaded'
            ));
        }else{
            $this->session->set_flashdata(array(
                'error' => $this->upload->display_errors(),
            ));
        }

        redirect('class_group/projects?id='.$group_id);
    }

    public function uploadLibraryFiles(){
        $group_id = $this->input->post('group_id');
        $subject_id = $this->input->post('subject_id');
        $uri = $this->input->post('uri');
        $user_sender = $this->input->post('user');
        $image = $this->input->post('image');

        $config = array(
            'upload_path' => './uploads/class_library/',
            'allowed_types' => '*',
            'remove_spaces' => TRUE,
            'overwrite' => FALSE,
            'max_size' => '0',
            'max_filename' => '0'

        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()){

            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $data = array(
                'file' => $file['file_name'],
                'group_id' => $group_id,
                'subject_id' => $subject_id,
                'logs' => date('Y-m-d H:i:s')
            );
            $qry = $this->db->get_where('class_library',array(
                'file' => $file['file_name']
            ));
            if ($qry->num_rows() == 0){

               $this->db->insert('class_library',$data);

                //        Notification
                $check = $this->db->get_where('students_group',array(
                    'group_id' => $group_id
                ));

                $group_user = $check->result();

                foreach ($group_user as $user){
                    if ($user->student_id != $user_sender){
                        $notify = array(
                            'user_id' => $user->student_id,
                            'sender_id' => $user_sender,
                            'group_id' => $group_id,
                            'image' => $image,
                            'uri' => $uri,
                            'notify' => 1,
                            'data' => 'Your instructor upload a file in Class Library',
                            'page' => 'library',
                            'logs' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('notification',$notify);
                    }


                }


            }
            $this->session->set_flashdata(array(
                'library_uploaded' => 'The file has been uploaded'
            ));
            redirect('class_group/class_library?id='.$group_id);
        }else{
            $this->session->set_flashdata(array(
                'library_error' => $this->upload->display_errors(),
            ));
            redirect('class_group/class_library?id='.$group_id);
        }


    }

    public function getLibraryFiles(){
        if (isset($_POST['file_id']) && $_POST['file_id'] != ''){
            $file_id = $_POST['file_id'];

            $std = new stdClass();
            $std->id = $file_id;

            echo json_encode($std);
        }
    }

    public function deleteLibrary(){
        $file_id = $this->input->post('file_id');
        $group_id = $this->input->post('group_id');
        $this->db->where('id',$file_id);
        $this->db->delete('class_library');

        $this->session->set_flashdata('delete_file','File in Class Library has been Deleted.');

        redirect('class_group/class_library?id='.$group_id);
    }

    public function getSubjectInfo(){
        if (isset($_POST['group_id']) && $_POST['group_id'] != ''){
            $group_id = $_POST['group_id'];
            $data = $this->db->get_where('class_group',array(
                'id' => $group_id
            ));
            $id = $data->row()->id;
            $subject_id = $data->row()->subject_id;

            $std = new stdClass();
            $std->id = $id;
            $std->subject_id = $subject_id;
            $std->subject_id = $subject_id;


            echo json_encode($std);
        }
    }

    public function setDeadlinePrelim(){
        if (!empty($_POST)){
            $subject_id = $this->input->post('groupID');
            $group_id = $this->input->post('subjectID');
            $deadline = $this->input->post('deadline');

            $this->projects->setDeadlinePrelim($subject_id,$group_id,$deadline);

        }
    }

    public function setDeadlineMidterm(){
        if (!empty($_POST)){
            $subject_id = $this->input->post('groupID');
            $group_id = $this->input->post('subjectID');
            $deadline = $this->input->post('deadline');

            $this->projects->setDeadlineMidterm($subject_id,$group_id,$deadline);

        }
    }

    public function setDeadlinePrefinal(){
        if (!empty($_POST)){
            $subject_id = $this->input->post('groupID');
            $group_id = $this->input->post('subjectID');
            $deadline = $this->input->post('deadline');

            $this->projects->setDeadlinePrefinal($subject_id,$group_id,$deadline);

        }
    }

    public function setDeadlineFinals(){
        if (!empty($_POST)){
            $subject_id = $this->input->post('groupID');
            $group_id = $this->input->post('subjectID');
            $deadline = $this->input->post('deadline');

            $this->projects->setDeadlineFinals($subject_id,$group_id,$deadline);

        }
    }

    public function uploadVideoTutorial(){
        $group_id = $this->input->post('groupID');
        $vid_name = $this->input->post('vid_name');
        $user_sender = $this->input->post('user_id');
        $image = $this->input->post('image');
        $uri = $this->input->post('uri');

        $config = array(
            'upload_path' => './uploads/video_tutorial/',
            'allowed_types' => '*',
            'remove_spaces' => TRUE,
            'overwrite' => FALSE,
            'max_size' => '0',
            'max_filename' => '0',
            'encrypt_name' => TRUE

        );
        $this->load->library('upload', $config);

        if ($this->upload->do_upload()){

            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $data = array(
                'video' => $file['file_name'],
                'video_name' => $vid_name,
                'group_id' => $group_id,
                'logs' => date('Y-m-d H:i:s')
            );
            $qry = $this->db->get_where('video_tutorial',array(
                'video' => $file['file_name'],
                'group_id' => $group_id,
            ));
            if ($qry->num_rows() == 0){

                $this->db->insert('video_tutorial',$data);

                //        Notification
                $check = $this->db->get_where('students_group',array(
                    'group_id' => $group_id
                ));

                $group_user = $check->result();

                foreach ($group_user as $user){
                    if ($user->student_id != $user_sender){
                        $notify = array(
                            'user_id' => $user->student_id,
                            'sender_id' => $user_sender,
                            'group_id' => $group_id,
                            'image' => $image,
                            'uri' => $uri,
                            'notify' => 1,
                            'data' => 'Your Instructor upload a video in your class group.',
                            'page' => 'video_tutorial',
                              'logs' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('notification',$notify);
                    }


                }

            }
            $this->session->set_flashdata(array(
                'video_uploaded' => 'The Video has been uploaded'
            ));
            redirect('class_group/video_tutorial?id='.$group_id);
        }else{
            $this->session->set_flashdata(array(
                'video_error' => $this->upload->display_errors(),
            ));
            redirect('class_group/video_tutorial?id='.$group_id);
        }

    }

    public function deleteVideoTutorial(){
        $id = $this->input->post('checkbox');
        $group_id = $this->input->post('group_id');
        foreach ($id as $video){
            $this->videos->deleteVideoTutorial($video,$group_id);
        }
        redirect('class_group/video_tutorial?id='.$group_id);
    }

    public function getVideoDetails(){
        if (isset($_POST['video_id']) && $_POST['video_id'] != ''){
            $video_id = $_POST['video_id'];
            $data = $this->db->get_where('video_tutorial',array(
                'id' => $video_id
            ));
            $id = $data->row()->id;
            $video = $data->row()->video;

            $check = array(
                'user_id' => $this->session->userdata('id'),
                'video_id' => $id,
            );

            $this->db->where($check);
            $this->db->delete('video_storage');

            $data = array(
                'video_id' => $id,
                'video' => $video,
                'user_id' => $this->session->userdata('id'),
                'logs' => date('Y-m-d H:i:s')
            );

            $this->db->insert('video_storage',$data);
            $get_vid = $this->db->get_where('video_storage',array(
                'video_id' => $id,
                'user_id' => $this->session->userdata('id'),
            ));



            $std = new stdClass();
            $std->id = $id;
            $std->video = $video;

            echo json_encode($std);
        }
    }

    public function play_videos(){
        $data = array(
            'video' => $this->videos->getAllVideos()
        );
        $this->load->view('frontend/main/video_tutorial/play_videos',$data);

    }


}