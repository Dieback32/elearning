<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function createQuiz($group_id,$name,$type,$start,$limit,$term,$post){

        $prelim = $this->db->get_where('quiz_exam',array(
            'type' => 'exam',
            'term' => 'prelim'
        ));

        $midterm = $this->db->get_where('quiz_exam',array(
            'type' => 'exam',
            'term' => 'midterm'
        ));

        $prefinal = $this->db->get_where('quiz_exam',array(
            'type' => 'exam',
            'term' => 'prefinal'
        ));

        $finals = $this->db->get_where('quiz_exam',array(
            'type' => 'exam',
            'term' => 'finals'
        ));
//        if ($prelim->num_rows() == 0){
        $data = array(
            'group_id' => $group_id,
            'name' => $name,
            'type' => $type,
            'start' => $start,
            'time_limit' => $limit,
            'term' => $term,
            'post' => $post,
            'set_by' => 'automatic',
            'status' => 'active',
            'log' => date('Y-m-d H:i:s')
        );

        $this->db->insert('quiz_exam',$data);

        return true;
//        }

    }

    public function createQuizManual($group_id,$name,$type,$default_start,$limit,$term,$post){

        $prelim = $this->db->get_where('quiz_exam',array(
            'type' => 'exam',
            'term' => 'prelim'
        ));

        $midterm = $this->db->get_where('quiz_exam',array(
            'type' => 'exam',
            'term' => 'midterm'
        ));

        $prefinal = $this->db->get_where('quiz_exam',array(
            'type' => 'exam',
            'term' => 'prefinal'
        ));

        $finals = $this->db->get_where('quiz_exam',array(
            'type' => 'exam',
            'term' => 'finals'
        ));

        $data = array(
            'group_id' => $group_id,
            'name' => $name,
            'type' => $type,
            'start' => $default_start,
            'time_limit' => $limit,
            'term' => $term,
            'post' => $post,
            'set_by' => 'manual',
            'status' => 'active',
            'log' => date('Y-m-d H:i:s')
        );

        $this->db->insert('quiz_exam',$data);

        return true;


    }

    public function editQuiz($quiz_id,$name,$type,$start,$limit,$term,$post){
        $data = array(
            'term' => $term,
            'name' => $name,
            'type' => $type,
            'start' => $start,
            'time_limit' => $limit,
            'post' => $post
        );

        $this->db->where('id',$quiz_id);
        $this->db->update('quiz_exam',$data);

    }

    public function deleteQuiz($quiz_id){
        $this->db->where('id',$quiz_id);
        $this->db->delete('quiz_exam');
    }


    public function getQuizById($quiz_id){
        $query = $this->db->get_where('quiz_exam',array(
            'id' => $quiz_id
        ));

        return $query->result();
    }

    public function checkTimeLimit($quiz_id){
//        $query = $this->db->get_where('quiz_exam',array(
//            'id' => $quiz_id
//        ));
//
//        //        Check if the Time Limit reach the present time
//        $end = $query->row()->time_limit;
//        $present = date('Y-m-d H:i:s');
//        if ($end <= $present){
//            $data = array(
//                'status' => 'deactivated'
//            );
//
//            $this->db->where('id', $quiz_id);
//            $this->db->update('quiz_exam',$data);
//
//            return true;
//        }else{
//            return false;
//        }

    }



    public function getQuizByStudentsId(){
        $check = $this->db->get_where('class_group',array(
            'instructor_id' => $this->session->userdata('id')
        ));
        if ($check->num_rows() > 0){
            if ( $this->session->userdata('authorization') == 'student'){
                $student_group = $this->db->get_where('students_group',array(
                    'student_id' => $this->session->userdata('id')
                ));
                if ($student_group->num_rows() > 0){
                    $data = $student_group->row()->class_group_id;
                }else{
                    $data = null;
                }

            }else{
                $student_group = $this->db->get_where('class_group',array(
                    'instructor_id' => $this->session->userdata('id')
                ));
                if ($student_group != null){
                    $data = $student_group->row()->instructor_id;
                }

            }

            $query = $this->db->get_where('quiz_exam',array(
                'group_id' => $data
            ));

            return $query->result();
        }

    }


    public function examSummary($qID){
        $query = $this->db->get_where('exam_summary',array(
            'quiz_id' => $qID
        ));

        return $query->result();
    }

    public function studentScore($qID){
        $query = $this->db->get_where('students_score',array(
            'quiz_id' => $qID
        ));

        return $query->result();
    }

    public function getQuizInfo($id){
        $this->db->from('quiz_exam');
        $this->db->where('group_id',$id);
        $this->db->order_by("log", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getQuestionsInstructor($quiz_id){
        $this->db->from('questions');
        $this->db->where('quiz_id',$quiz_id);
        $this->db->order_by("question_number", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function questionNumbering($quiz_id){
        $this->db->from('questions');
        $this->db->where('quiz_id',$quiz_id);
        $this->db->order_by("question_number", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getQuestionsStudent($quiz_id,$question_num){
        $questions = array(
            'quiz_id' => $quiz_id,
//            'question_number' => $question_num
        );
        $this->db->from('questions');
        $this->db->where($questions);
        $this->db->order_by('rand()');
        $query = $this->db->get();
        return $query->result();
    }

    public function getQuestions($qID){
        $query = $this->db->get_where('questions',array(
            'quiz_id' => $qID
        ));
        return $query->result();
    }

    public function getChoices(){
        $query = $this->db->get('multiple_choice');
        return $query->result();
    }

    public function numberOfItems($quiz_id){
        $query = $this->db->get_where('questions',array(
            'quiz_id' => $quiz_id
        ));
        return $query->num_rows();
    }

    public function getScore($q,$answer,$quiz_id,$term,$group_id,$exam_type){
        $question = $this->db->get_where('questions',array(
            'quiz_id' => $q
        ));
        $query = $this->db->get_where('multiple_choice',array(
            'question_id' => $q,
            'choices' => $answer
        ));

        $user = $this->db->get_where('students_score',array(
            'quiz_id' => $quiz_id,
            'student_id' => $this->session->userdata('id')
        ));

        $records = $this->db->get_where('exam_summary',array(
            'quiz_id' => $quiz_id,
            'question_id' => $q,
            'student_id' => $this->session->userdata('id'),
        ));
        $score = $user->row()->score;
        if ($records->num_rows() == 0){

            if ($answer == null){
                $input_record = array(
                    'group_id' => $group_id,
                    'quiz_id' => $quiz_id,
                    'question_id' => $q,
                    'student_id' => $this->session->userdata('id'),
                );

                $this->db->insert('exam_summary',$input_record);
            }else{
                $input_record = array(
                    'group_id' => $group_id,
                    'quiz_id' => $quiz_id,
                    'question_id' => $q,
                    'student_id' => $this->session->userdata('id'),
                    'answer' => $answer
                );

                $this->db->insert('exam_summary',$input_record);
            }



            if ($user->num_rows() == 0){
                if ($query->row()->is_correct == 1){

                        $get_items = $this->db->get_where('questions',array(
                            'quiz_id' => $quiz_id
                        ));


                        $data = array(
                            'student_id' => $this->session->userdata('id'),
                            'quiz_id' => $quiz_id,
                            'group_id' => $group_id,
                            'total_items' =>  $get_items->num_rows(),
                            'type' => $exam_type,
                            'term' => $term,
                            'score' => $score + 1
                        );

                        $this->db->insert('students_score',$data);

//                        if ($term == 'prelim'){
//                            if ($exam_type == 'quiz'){
//                                $get_student_score = $this->db->get_where('prelim',array(
//                                    'student_id' => $this->session->userdata('id'),
//                                    'group_id' => $group_id
//                                ));
//                                $student_score = $get_student_score->row()->term_exam;
//
//                                $prelim_data = array(
//                                    'quiz' => $student_score + 1
//                                );
//                                $array = array(
//                                    'group_id' => $group_id,
//                                    'student_id' => $this->session->userdata('id')
//                                );
//                                $this->db->where($array);
//                                $this->db->update('prelim',$prelim_data);
//                            }else{
//                                $get_student_score = $this->db->get_where('prelim',array(
//                                    'student_id' => $this->session->userdata('id'),
//                                    'group_id' => $group_id
//                                ));
//                                $student_score = $get_student_score->row()->term_exam;
//
//                                $prelim_data = array(
//                                    'term_exam' => $student_score + 1
//                                );
//                                $array = array(
//                                    'group_id' => $group_id,
//                                    'student_id' => $this->session->userdata('id')
//                                );
//                                $this->db->where($array);
//                                $this->db->update('prelim',$prelim_data);
//                            }
//                        }elseif ($term == 'midterm'){
//                            $get_student_score = $this->db->get_where('midterm',array(
//                                'student_id' => $this->session->userdata('id'),
//                                'group_id' => $group_id
//                            ));
//
//                            $student_score = $get_student_score->row()->quiz;
//
//                            if ($exam_type == 'quiz'){
//                                $prelim_data = array(
//                                    'quiz' => $student_score + 1
//                                );
//                                $array = array(
//                                    'group_id' => $group_id,
//                                    'student_id' => $this->session->userdata('id')
//                                );
//                                $this->db->where($array);
//                                $this->db->update('midterm',$prelim_data);
//                            }else{
//                                $get_student_score = $this->db->get_where('midterm',array(
//                                    'student_id' => $this->session->userdata('id'),
//                                    'group_id' => $group_id
//                                ));
//                                $student_score = $get_student_score->row()->term_exam;
//
//                                $prelim_data = array(
//                                    'term_exam' => $student_score + 1
//                                );
//                                $array = array(
//                                    'group_id' => $group_id,
//                                    'student_id' => $this->session->userdata('id')
//                                );
//                                $this->db->where($array);
//                                $this->db->update('midterm',$prelim_data);
//                            }
//                        }elseif ($term == 'prefinal'){
//                            $get_student_score = $this->db->get_where('prefinal',array(
//                                'student_id' => $this->session->userdata('id'),
//                                'group_id' => $group_id
//                            ));
//
//                            $student_score = $get_student_score->row()->quiz;
//
//                            if ($exam_type == 'quiz'){
//                                $prelim_data = array(
//                                    'quiz' => $student_score + 1
//                                );
//                                $array = array(
//                                    'group_id' => $group_id,
//                                    'student_id' => $this->session->userdata('id')
//                                );
//                                $this->db->where($array);
//                                $this->db->update('prefinal',$prelim_data);
//                            }else{
//                                $get_student_score = $this->db->get_where('prefinal',array(
//                                    'student_id' => $this->session->userdata('id'),
//                                    'group_id' => $group_id
//                                ));
//                                $student_score = $get_student_score->row()->term_exam;
//
//                                $prelim_data = array(
//                                    'term_exam' => $student_score + 1
//                                );
//                                $array = array(
//                                    'group_id' => $group_id,
//                                    'student_id' => $this->session->userdata('id')
//                                );
//                                $this->db->where($array);
//                                $this->db->update('prefinal',$prelim_data);
//                            }
//                        }else{
//                            $get_student_score = $this->db->get_where('finals',array(
//                                'student_id' => $this->session->userdata('id'),
//                                'group_id' => $group_id
//                            ));
//
//                            $student_score = $get_student_score->row()->quiz;
//
//                            if ($exam_type == 'quiz'){
//                                $prelim_data = array(
//                                    'quiz' => $student_score + 1
//                                );
//                                $array = array(
//                                    'group_id' => $group_id,
//                                    'student_id' => $this->session->userdata('id')
//                                );
//                                $this->db->where($array);
//                                $this->db->update('finals',$prelim_data);
//                            }else{
//                                $get_student_score = $this->db->get_where('finals',array(
//                                    'student_id' => $this->session->userdata('id'),
//                                    'group_id' => $group_id
//                                ));
//                                $student_score = $get_student_score->row()->term_exam;
//
//                                $prelim_data = array(
//                                    'term_exam' => $student_score + 1
//                                );
//                                $array = array(
//                                    'group_id' => $group_id,
//                                    'student_id' => $this->session->userdata('id')
//                                );
//                                $this->db->where($array);
//                                $this->db->update('finals',$prelim_data);
//                            }
//                        }

                        return true;


                }else{
                    $get_items = $this->db->get_where('questions',array(
                        'quiz_id' => $quiz_id
                    ));

                    $data = array(
                        'student_id' => $this->session->userdata('id'),
                        'quiz_id' => $quiz_id,
                        'group_id' => $group_id,
                        'total_items' =>  $get_items->num_rows(),
                        'type' => $exam_type,
                        'term' => $term,
                        'quiz_id' => $quiz_id,
                        'score' => 0
                    );

                    $this->db->insert('students_score',$data);
                }
            }else{
                if ($query->row()->is_correct == 1){
                    if ($question->row()->type != 'Essay'){
                        $data = array(
                            'score' => $score + 1
                        );
                        $this->db->where('student_id',$this->session->userdata('id'));
                        $this->db->update('students_score',$data);

//                        if ($term == 'prelim'){
////                        Inserting Score in Prelim
//                            if ($exam_type == 'quiz'){
//                                $get_student_score = $this->db->get_where('students_score',array(
//                                    'student_id' => $this->session->userdata('id'),
//                                    'quiz_id' => $quiz_id,
//                                ));
//                                $student_score = $get_student_score->row()->score;
//
//                                $prelim_data = array(
//                                    'quiz' => $student_score
//                                );
//                                $array = array(
//                                    'group_id' => $group_id,
//                                    'student_id' => $this->session->userdata('id')
//                                );
//                                $this->db->where($array);
//                                $this->db->update('prelim',$prelim_data);
//                            }else{
//                                $get_student_score = $this->db->get_where('students_score',array(
//                                    'student_id' => $this->session->userdata('id'),
//                                    'quiz_id' => $quiz_id,
//                                ));
//                                $student_score = $get_student_score->row()->score;
//
//                                $prelim_data = array(
//                                    'term_exam' => $student_score
//                                );
//                                $array = array(
//                                    'group_id' => $group_id,
//                                    'student_id' => $this->session->userdata('id')
//                                );
//                                $this->db->where($array);
//                                $this->db->update('prelim',$prelim_data);
//                            }
//
//                        }
                        return true;

                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }

        }else{
            return false;
        }

    }
//     Calculate the Average Per Term
    public function perTermAverage($group_id,$term,$quiz_id,$exam_type){

        $get_student_score = $this->db->get_where('students_score',array(
            'student_id' => $this->session->userdata('id'),
            'quiz_id' => $quiz_id
        ));

        $student_score = $get_student_score->row()->score;

        $get_quiz = $this->db->get_where('questions',array(
            'quiz_id' => $quiz_id
        ));

        $data_array = array(
            'student_id' => $this->session->userdata('id'),
            'quiz_id' => $quiz_id
        );

        $total_quiz = $get_quiz->num_rows();
        $passing = $total_quiz * 0.4;
        if ($student_score >= round($passing) ){
            $computation_1 = (($student_score - round($passing)) * (100 - 75) / ($total_quiz - round($passing))) + 75;
            $equivalent = array(
                'equivalent' => round($computation_1)
            );
            $this->db->where($data_array);
            $this->db->update('students_score',$equivalent);
        }else{
            $computation_2 = ($student_score * (75-65) / round($passing) ) + 65;
            $equivalent = array(
                'equivalent' => round($computation_2)
            );
            $this->db->where($data_array);
            $this->db->update('students_score',$equivalent);
        }

        if ($term == 'prelim'){
            if ($exam_type == 'quiz'){
                $cal_prelim = $this->db->get_where('students_score',array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id,
                    'term' => 'prelim'
                ));

                $prelim_quizzes = $cal_prelim->result();
                $total = 0;
                foreach ($prelim_quizzes as $quizzes){
                    $total = $quizzes->equivalent + $total;
                }

                $prelim_quiz_avg = $total / $cal_prelim->num_rows();

                $grades_data = array(
                    'quiz' => $prelim_quiz_avg
                );
                $user_grades = array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id
                );
                $this->db->where($user_grades);
                $this->db->update('prelim',$grades_data);

            }else{
                $get_term_score = $this->db->get_where('students_score',array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id,
                    'term' => 'prelim'
                ));
                $term_exam_avg = $get_term_score->row()->equivalent;
                $user_term_grade = array(
                    'term_exam' => $term_exam_avg
                );
                $user_grades = array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id
                );
                $this->db->where($user_grades);
                $this->db->update('prelim',$user_term_grade);
            }

            $get_prelim = $this->db->get_where('prelim',array(
                'group_id' => $group_id,
                'student_id' => $this->session->userdata('id')
            ));

            if ($get_prelim->num_rows() > 0){
                $quiz_equi = $get_prelim->row()->quiz;
                $participation = $get_prelim->row()->participation;
                $project = $get_prelim->row()->project;
                $exam_score = $get_prelim->row()->term_exam;

                $avgquiz = $quiz_equi * 0.2;
                $avgexam =  $exam_score * 0.4;
                $avgparticipation = $participation * 0.2;
                $avgproject = $project * 0.2;
                $average = $avgquiz + $avgexam + $avgparticipation + $avgproject;

                if ($average < 65){
                    $average = 65;
                }
                $data = array(
                    'average' => $average
                );

                $user_data = array(
                    'group_id' => $group_id,
                    'student_id' => $this->session->userdata('id')
                );
                $this->db->where($user_data);
                $this->db->update('prelim',$data);

//                Inserting in Grading Sheet
                $grade_prelim = array(
                    'prelim' => $average
                );

                $prelim = array(
                    'group_id' => $group_id,
                    'student_id' => $this->session->userdata('id')
                );
                $this->db->where($prelim);
                $this->db->update('grading_sheet',$grade_prelim);
            }

        }elseif ($term == 'midterm'){
            if ($exam_type == 'quiz'){
                $cal_midterm = $this->db->get_where('students_score',array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id,
                    'term' => 'midterm'
                ));

                $midterm_quizzes = $cal_midterm->result();
                $total = 0;
                foreach ($midterm_quizzes as $quizzes){
                    $total = $quizzes->equivalent + $total;
                }

                $midterm_quiz_avg = $total / $cal_midterm->num_rows();

                $grades_data = array(
                    'quiz' => $midterm_quiz_avg
                );
                $user_grades = array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id
                );
                $this->db->where($user_grades);
                $this->db->update('midterm',$grades_data);

            }else{
                $get_term_score = $this->db->get_where('students_score',array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id,
                    'term' => 'midterm'
                ));
                $term_exam_avg = $get_term_score->row()->equivalent;
                $user_term_grade = array(
                    'term_exam' => $term_exam_avg
                );
                $user_grades = array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id
                );
                $this->db->where($user_grades);
                $this->db->update('midterm',$user_term_grade);
            }

            $get_midterm = $this->db->get_where('midterm',array(
                'group_id' => $group_id,
                'student_id' => $this->session->userdata('id')
            ));

            if ($get_midterm->num_rows() > 0){

                $participation = $get_midterm->row()->participation;
                $project = $get_midterm->row()->project;

                $quiz_score = $get_midterm->row()->quiz;
                $exam_score = $get_midterm->row()->term_exam;

                $avgquiz = $quiz_score * 0.2 ;
                $avgexam =  $exam_score * 0.4 ;
                $avgparticipation = $participation * 0.2;
                $avgproject = $project * 0.2;
                $average = $avgquiz + $avgexam + $avgparticipation + $avgproject;

                $data = array(
                    'average' => $average
                );

                $user_data = array(
                    'group_id' => $group_id,
                    'student_id' => $this->session->userdata('id')
                );
                $this->db->where($user_data);
                $this->db->update('midterm',$data);

//                Inserting in Grading Sheet
                $midtermAVG = array(
                    'midterm' => $average
                );

                $midterm = array(
                    'group_id' => $group_id,
                    'student_id' => $this->session->userdata('id')
                );
                $this->db->where($midterm);
                $this->db->update('grading_sheet',$midtermAVG);
            }
        }elseif ($term == 'prefinal'){
            if ($exam_type == 'quiz'){
                $cal_prefinal = $this->db->get_where('students_score',array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id,
                    'term' => 'prefinal'
                ));

                $prefinal_quizzes = $cal_prefinal->result();
                $total = 0;
                foreach ($prefinal_quizzes as $quizzes){
                    $total = $quizzes->equivalent + $total;
                }

                $prefinal_quiz_avg = $total / $cal_prefinal->num_rows();

                $grades_data = array(
                    'quiz' => $prefinal_quiz_avg
                );
                $user_grades = array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id
                );
                $this->db->where($user_grades);
                $this->db->update('prefinal',$grades_data);

            }else{
                $get_term_score = $this->db->get_where('students_score',array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id,
                    'term' => 'prefinal'
                ));
                $term_exam_avg = $get_term_score->row()->equivalent;
                $user_term_grade = array(
                    'term_exam' => $term_exam_avg
                );
                $user_grades = array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id
                );
                $this->db->where($user_grades);
                $this->db->update('prefinal',$user_term_grade);
            }

            $get_prefinal = $this->db->get_where('prefinal',array(
                'group_id' => $group_id,
                'student_id' => $this->session->userdata('id')
            ));

            if ($get_prefinal->num_rows() > 0){
                $participation = $get_prefinal->row()->participation;
                $project = $get_prefinal->row()->project;

                $quiz_score = $get_prefinal->row()->quiz;
                $exam_score = $get_prefinal->row()->term_exam;

                $avgquiz = $quiz_score * 0.2;
                $avgexam =  $exam_score * 0.4;
                $avgparticipation = $participation * 0.2;
                $avgproject = $project * 0.2;
                $average = $avgquiz + $avgexam + $avgparticipation + $avgproject;

                $data = array(
                    'average' => $average
                );

                $user_data = array(
                    'group_id' => $group_id,
                    'student_id' => $this->session->userdata('id')
                );
                $this->db->where($user_data);
                $this->db->update('prefinal',$data);

                //                Inserting in Grading Sheet
                $prefinalAVG = array(
                    'prefinal' => $average
                );

                $prefinal = array(
                    'group_id' => $group_id,
                    'student_id' => $this->session->userdata('id')
                );
                $this->db->where($prefinal);
                $this->db->update('grading_sheet',$prefinalAVG);

            }
        }else{
            if ($exam_type == 'quiz'){
                $cal_finals = $this->db->get_where('students_score',array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id,
                    'term' => 'prefinal'
                ));

                $finals_quizzes = $cal_finals->result();
                $total = 0;
                foreach ($finals_quizzes as $quizzes){
                    $total = $quizzes->equivalent + $total;
                }

                $finals_quiz_avg = $total / $cal_finals->num_rows();

                $grades_data = array(
                    'quiz' => $finals_quiz_avg
                );
                $user_grades = array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id
                );
                $this->db->where($user_grades);
                $this->db->update('finals',$grades_data);

            }else{
                $get_term_score = $this->db->get_where('students_score',array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id,
                    'term' => 'finals'
                ));
                $term_exam_avg = $get_term_score->row()->equivalent;
                $user_term_grade = array(
                    'term_exam' => $term_exam_avg
                );
                $user_grades = array(
                    'student_id' => $this->session->userdata('id'),
                    'group_id' => $group_id
                );
                $this->db->where($user_grades);
                $this->db->update('finals',$user_term_grade);
            }

            $get_finals = $this->db->get_where('finals',array(
                'group_id' => $group_id,
                'student_id' => $this->session->userdata('id')
            ));

            if ($get_finals->num_rows() > 0){
                $participation = $get_finals->row()->participation;
                $project = $get_finals->row()->project;

                $quiz_score = $get_finals->row()->quiz;
                $exam_score = $get_finals->row()->term_exam;

                $avgquiz = $quiz_score * 0.2;
                $avgexam =  $exam_score * 0.4;
                $avgparticipation = $participation * 0.2;
                $avgproject = $project * 0.2;
                $average = $avgquiz + $avgexam + $avgparticipation + $avgproject;

                $data = array(
                    'average' => $average
                );

                $user_data = array(
                    'group_id' => $group_id,
                    'student_id' => $this->session->userdata('id')
                );
                $this->db->where($user_data);
                $this->db->update('finals',$data);

//                Inserting in Grading Sheet
                $finalsAVG = array(
                    'finals' => $average
                );

                $finals = array(
                    'group_id' => $group_id,
                    'student_id' => $this->session->userdata('id')
                );
                $this->db->where($finals);
                $this->db->update('grading_sheet',$finalsAVG);
            }
        }

    }
//          Final Grade
    public function GWA($group_id,$user){

        $query = $this->db->get_where('grading_sheet',array(
            'group_id' => $group_id,
            'student_id' => $user
        ));

        $prelim = $query->row()->prelim;
        $midterm = $query->row()->midterm;
        $prefinal = $query->row()->prefinal;
        $finals = $query->row()->finals;

        $midtermPercent = (($prelim * 0.3) + ($midterm * 0.7));
        $prefinalPercent = (($midtermPercent * 0.3) + ($prefinal * 0.7));
        $finalsPercent = (($prefinalPercent * 0.3) + ($finals * 0.7));


        if ($finalsPercent < 75){
            $gwa = 5.0;
        }
        if ($finalsPercent >= 75){
            $gwa = 3.0;
        }
        if ($finalsPercent >= 76){
            $gwa = 2.9;
        }
        if ($finalsPercent >= 77){
            $gwa = 2.8;
        }
        if ($finalsPercent >= 78){
            $gwa = 2.7;
        }
        if ($finalsPercent >= 79){
            $gwa = 2.6;
        }
        if ($finalsPercent >= 80){
            $gwa = 2.5;
        }
        if ($finalsPercent >= 81){
            $gwa = 2.4;
        }
        if ($finalsPercent >= 82){
            $gwa = 2.3;
        }
        if ($finalsPercent >= 83){
            $gwa = 2.2;
        }
        if ($finalsPercent >= 84){
            $gwa = 2.1;
        }
        if ($finalsPercent >= 85){
            $gwa = 2.0;
        }
        if ($finalsPercent >= 86){
            $gwa = 1.9;
        }
        if ($finalsPercent >= 87){
            $gwa = 1.8;
        }
        if ($finalsPercent >= 88){
            $gwa = 1.7;
        }
        if ($finalsPercent >= 89){
            $gwa = 1.6;
        }
        if ($finalsPercent >= 90){
            $gwa = 1.5;
        }
        if ($finalsPercent >= 91){
            $gwa = 1.4;
        }
        if ($finalsPercent >= 92){
            $gwa = 1.3;
        }
        if ($finalsPercent >= 93){
            $gwa = 1.2;
        }
        if ($finalsPercent >= 94){
            $gwa = 1.1;
        }
        if ($finalsPercent >= 95){
            $gwa = 1.0;
        }

        $remarks = '';
        if ($finalsPercent >= 75){
            $remarks = 'Passed';
        }else{
            $remarks = 'Failed';
        }


        $data = array(
            'average' => $finalsPercent,
            'gwa' => $gwa,
            'remarks' => $remarks
        );

        $check_user = array(
            'group_id' => $group_id,
            'student_id' => $user
        );

        $this->db->where($check_user);
        $this->db->update('grading_sheet',$data);

    }

    public function getResult($quiz_id){
        $query = $this->db->get_where('students_score',array(
            'student_id' => $this->session->userdata('id'),
            'quiz_id' => $quiz_id
        ));

        return $query->result();
    }

    public function getNumberOfQuestion($quiz_id){
        $query = $this->db->get_where('questions',array(
            'quiz_id' => $quiz_id
        ));

        return $query->num_rows();
    }

    public function getNumberExamSummary($quiz_id){

        $query = $this->db->get_where('exam_summary',array(
            'quiz_id' => $quiz_id,
            'student_id' => $this->session->userdata('id')
        ));

        return $query->num_rows();
    }

    public function question($q_id,$number,$quest,$type,$term,$group_id,$kind_of){
        $query = $this->db->get_where('questions',array(
            'quiz_id' => $q_id,
            'question' => $quest,
        ));

        if ($query->num_rows() == 0){
            $data = array(
                'quiz_id' => $q_id,
                'group_id' => $group_id,
                'term' => $term,
                'question_number' => $number,
                'question' => $quest,
                'type' => $type,
                'kind_of' => $kind_of
            );

            $this->db->insert('questions',$data);

            if ($term == 'prelim'){
                if ($kind_of == 'quiz'){
                    $get_items = $this->db->get_where('questions',array(
                        'group_id' => $group_id,
                        'term' => 'prelim',
                        'kind_of' => 'quiz'
                    ));
                    $items = $get_items->num_rows();
                    $prelim_data = array(
                        'quiz_items' => $items
                    );
                    $this->db->where('group_id',$group_id);
                    $this->db->update('prelim',$prelim_data);
                }else{

                    $get_items = $this->db->get_where('questions',array(
                        'quiz_id' => $q_id,
                    ));
                    $items = $get_items->num_rows();

                    $prelim_data = array(
                        'exam_items' => $items
                    );
                    $this->db->where('group_id',$group_id);
                    $this->db->update('prelim',$prelim_data);
                }
            }elseif($term == 'midterm'){
                if ($kind_of == 'quiz'){
                    $get_items = $this->db->get_where('questions',array(
                        'group_id' => $group_id,
                        'term' => 'midterm',
                        'kind_of' => 'quiz'
                    ));
                    $items = $get_items->num_rows();
                    $prelim_data = array(
                        'quiz_items' => $items
                    );
                    $this->db->where('group_id',$group_id);
                    $this->db->update('midterm',$prelim_data);
                }else{

                    $get_items = $this->db->get_where('questions',array(
                        'quiz_id' => $q_id,
                    ));
                    $items = $get_items->num_rows();

                    $prelim_data = array(
                        'exam_items' => $items
                    );
                    $this->db->where('group_id',$group_id);
                    $this->db->update('midterm',$prelim_data);
                }
            }elseif($term == 'prefinal'){
                if ($kind_of == 'quiz'){
                    $get_items = $this->db->get_where('questions',array(
                        'group_id' => $group_id,
                        'term' => 'prefinal',
                        'kind_of' => 'quiz'
                    ));
                    $items = $get_items->num_rows();
                    $prelim_data = array(
                        'quiz_items' => $items
                    );
                    $this->db->where('group_id',$group_id);
                    $this->db->update('prefinal',$prelim_data);
                }else{

                    $get_items = $this->db->get_where('questions',array(
                        'quiz_id' => $q_id,
                    ));
                    $items = $get_items->num_rows();

                    $prelim_data = array(
                        'exam_items' => $items
                    );
                    $this->db->where('group_id',$group_id);
                    $this->db->update('prefinal',$prelim_data);
                }
            }else{
                if ($kind_of == 'quiz'){
                    $get_items = $this->db->get_where('questions',array(
                        'group_id' => $group_id,
                        'term' => 'finals',
                        'kind_of' => 'quiz'
                    ));
                    $items = $get_items->num_rows();
                    $prelim_data = array(
                        'quiz_items' => $items
                    );
                    $this->db->where('group_id',$group_id);
                    $this->db->update('finals',$prelim_data);
                }else{

                    $get_items = $this->db->get_where('questions',array(
                        'quiz_id' => $q_id,
                    ));
                    $items = $get_items->num_rows();

                    $prelim_data = array(
                        'exam_items' => $items
                    );
                    $this->db->where('group_id',$group_id);
                    $this->db->update('finals',$prelim_data);
                }
            }

            return true;
        }else{
            return false;
        }
    }

    public function choices($q_id,$quest,$choice,$is_correct){

        $question_id = $this->db->get_where('questions',array(
            'quiz_id' => $q_id,
            'question' => $quest
        ));
//        if ($question_id->row()->type == 'Essay'){
//            $is_correct = 0;
//        }
        $cdata = array(
            'question_id' => $question_id->row()->id,
            'choices' => $choice,
            'is_correct' => $is_correct
        );
        $this->db->insert('multiple_choice',$cdata);

    }

    public function editQuestion($quest_id,$quest,$type){
        $data = array(
            'question' => $quest,
            'type' => $type,
        );
        $this->db->where('id',$quest_id);
        $this->db->update('questions',$data);

        return true;
    }

    public function deleteChoices($quest_id){
        $this->db->where('question_id',$quest_id);
        $this->db->delete('multiple_choice');
    }

    public function editChoice($quest_id,$value,$is_correct){
        $data = array(
            'question_id' => $quest_id,
            'choices' => $value,
            'is_correct' => $is_correct
        );

        $this->db->insert('multiple_choice',$data);

        return true;
    }

    public function deleteQuestion($question_id){
        $query = $this->db->get_where('questions',array(
            'id' => $question_id
        ));

        $term = $query->row()->term;
        $kind_of = $query->row()->kind_of;
        $group_id = $query->row()->group_id;
        $q_id = $query->row()->quiz_id;

        $this->db->where('id',$question_id);
        $this->db->delete('questions');
        $this->deleteChoices($question_id);

        if ($term == 'prelim'){
            if ($kind_of == 'quiz'){
                $get_items = $this->db->get_where('questions',array(
                    'group_id' => $group_id,
                    'term' => 'prelim',
                    'kind_of' => 'quiz'
                ));
                $items = $get_items->num_rows();
                $prelim_data = array(
                    'quiz_items' => $items
                );
                $this->db->where('group_id',$group_id);
                $this->db->update('prelim',$prelim_data);
            }else{

                $get_items = $this->db->get_where('questions',array(
                    'quiz_id' => $q_id,
                ));
                $items = $get_items->num_rows();

                $prelim_data = array(
                    'exam_items' => $items
                );
                $this->db->where('group_id',$group_id);
                $this->db->update('prelim',$prelim_data);
            }
        }elseif($term == 'midterm'){
            if ($kind_of == 'quiz'){
                $get_items = $this->db->get_where('questions',array(
                    'group_id' => $group_id,
                    'term' => 'midterm',
                    'kind_of' => 'quiz'
                ));
                $items = $get_items->num_rows();
                $prelim_data = array(
                    'quiz_items' => $items
                );
                $this->db->where('group_id',$group_id);
                $this->db->update('midterm',$prelim_data);
            }else{

                $get_items = $this->db->get_where('questions',array(
                    'quiz_id' => $q_id,
                ));
                $items = $get_items->num_rows();

                $prelim_data = array(
                    'exam_items' => $items
                );
                $this->db->where('group_id',$group_id);
                $this->db->update('midterm',$prelim_data);
            }
        }elseif($term == 'prefinal'){
            if ($kind_of == 'quiz'){
                $get_items = $this->db->get_where('questions',array(
                    'group_id' => $group_id,
                    'term' => 'prefinal',
                    'kind_of' => 'quiz'
                ));
                $items = $get_items->num_rows();
                $prelim_data = array(
                    'quiz_items' => $items
                );
                $this->db->where('group_id',$group_id);
                $this->db->update('prefinal',$prelim_data);
            }else{

                $get_items = $this->db->get_where('questions',array(
                    'quiz_id' => $q_id,
                ));
                $items = $get_items->num_rows();

                $prelim_data = array(
                    'exam_items' => $items
                );
                $this->db->where('group_id',$group_id);
                $this->db->update('prefinal',$prelim_data);
            }
        }else{
            if ($kind_of == 'quiz'){
                $get_items = $this->db->get_where('questions',array(
                    'group_id' => $group_id,
                    'term' => 'finals',
                    'kind_of' => 'quiz'
                ));
                $items = $get_items->num_rows();
                $prelim_data = array(
                    'quiz_items' => $items
                );
                $this->db->where('group_id',$group_id);
                $this->db->update('finals',$prelim_data);
            }else{

                $get_items = $this->db->get_where('questions',array(
                    'quiz_id' => $q_id,
                ));
                $items = $get_items->num_rows();

                $prelim_data = array(
                    'exam_items' => $items
                );
                $this->db->where('group_id',$group_id);
                $this->db->update('finals',$prelim_data);
            }
        }

        return true;
    }


}