<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grades extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    public function prelimGrade($id){
        $query = $this->db->get_where('prelim',array(
            'group_id' => $id
        ));
        return $query->result();
    }
    public function midtermGrade($id){
        $query = $this->db->get_where('midterm',array(
            'group_id' => $id
        ));
        return $query->result();

    }
    public function prefinalGrade($id){
        $query = $this->db->get_where('prefinal',array(
            'group_id' => $id
        ));
        return $query->result();

    }
    public function finalsGrade($id){
        $query = $this->db->get_where('finals',array(
            'group_id' => $id
        ));
        return $query->result();

    }

    public function gwaGrade($id){
        $query = $this->db->get_where('grading_sheet',array(
            'group_id' => $id
        ));
        return $query->result();
    }

    public function getGradingSheet(){
        $query = $this->db->get('grading_sheet');

        return $query->result();
    }

    public function getPrelimGrade($subject_id){
        $this->db->where('subject_id',$subject_id);
        $query = $this->db->get('prelim');

        return $query->result();
    }

    public function getMidtermGrade($subject_id){
        $this->db->where('subject_id',$subject_id);
        $query = $this->db->get('midterm');

        return $query->result();
    }

    public function getPrefinalGrade($subject_id){
        $this->db->where('subject_id',$subject_id);
        $query = $this->db->get('prefinal');

        return $query->result();
    }

    public function getFinalsGrade($subject_id){
        $this->db->where('subject_id',$subject_id);
        $query = $this->db->get('finals');

        return $query->result();
    }

    public function getFinalGrade($subject_id){
        $this->db->where('subject_id',$subject_id);
        $query = $this->db->get('grading_sheet');

        return $query->result();
    }

    //Exam Items
    public function prelimNumItems($num,$group_id){
        $data = array(
            'exam_items' => $num
        );
        $this->db->where('group_id',$group_id);
        $this->db->update('prelim',$data);
    }

    public function midtermNumItems($num,$group_id){
        $data = array(
            'exam_items' => $num
        );
        $this->db->where('group_id',$group_id);
        $this->db->update('midterm',$data);
    }

    public function prefinalNumItems($num,$group_id){
        $data = array(
            'exam_items' => $num
        );
        $this->db->where('group_id',$group_id);
        $this->db->update('prefinal',$data);
    }

    public function finalsNumItems($num,$group_id){
        $data = array(
            'exam_items' => $num
        );
        $this->db->where('group_id',$group_id);
        $this->db->update('finals',$data);
    }

    //Exam Score
    public function prelimExamScore($score,$user,$group_id){
        $check = $this->db->get_where('students_group',array(
            'group_id' => $group_id,
            'student_id' => $user
        ));
        if ($check->row()->status == 'Drop'){
            return false;
        }else{
            $total_items = $this->db->get_where('prelim',array(
                'group_id' => $group_id
            ));
            $items = $total_items->result();

            $passing = $items[0]->exam_items * 0.4;
            if ($score >= round($passing) ){
                $computation_1 = (($score - round($passing)) * (100 - 75) / ($items[0]->exam_items - round($passing))) + 75;

                $get_prelim = $this->db->get_where('prelim',array(
                    'group_id' => $group_id,
                    'student_id' => $user
                ));


                $quiz_equi = $get_prelim->row()->quiz;
                $participation = $get_prelim->row()->participation;
                $project = $get_prelim->row()->project;

                $avgquiz = $quiz_equi * 0.2;
                $avgexam =  $computation_1 * 0.4;
                $avgparticipation = $participation * 0.2;
                $avgproject = $project * 0.2;
                $average = $avgquiz + $avgexam + $avgparticipation + $avgproject;

                if ($average < 65){
                    $average = 65;
                }
                $data = array(
                    'term_exam' => $computation_1,
                    'average' => $average
                );

                $user_data = array(
                    'group_id' => $group_id,
                    'student_id' => $user,
                );
                $this->db->where($user_data);
                $this->db->update('prelim',$data);

//                Inserting in Grading Sheet
                $grade_prelim = array(
                    'prelim' => $average
                );

                $prelim = array(
                    'group_id' => $group_id,
                    'student_id' => $user
                );
                $this->db->where($prelim);
                $this->db->update('grading_sheet',$grade_prelim);

                $this->quiz->GWA($group_id,$user);
                return true;


            }else{
                $computation_2 = ($score * (75-65) / round($passing) ) + 65;

                $get_prelim = $this->db->get_where('prelim',array(
                    'group_id' => $group_id,
                    'student_id' => $user
                ));

                if ($get_prelim->num_rows() > 0) {
                    $quiz_equi = $get_prelim->row()->quiz;
                    $participation = $get_prelim->row()->participation;
                    $project = $get_prelim->row()->project;

                    $avgquiz = $quiz_equi * 0.2;
                    $avgexam = $computation_2 * 0.4;
                    $avgparticipation = $participation * 0.2;
                    $avgproject = $project * 0.2;
                    $average = $avgquiz + $avgexam + $avgparticipation + $avgproject;

                    if ($average < 65) {
                        $average = 65;
                    }
                    $data = array(
                        'term_exam' => $computation_2,
                        'average' => $average
                    );

                    $user_data = array(
                        'group_id' => $group_id,
                        'student_id' => $user,
                    );
                    $this->db->where($user_data);
                    $this->db->update('prelim', $data);

//                Inserting in Grading Sheet
                    $grade_prelim = array(
                        'prelim' => $average
                    );

                    $prelim = array(
                        'group_id' => $group_id,
                        'student_id' => $user
                    );
                    $this->db->where($prelim);
                    $this->db->update('grading_sheet', $grade_prelim);

                    $this->quiz->GWA($group_id,$user);
                    return true;
                }

            }
        }

    }

    public function midtermExamScore($score,$user,$group_id){
        $check = $this->db->get_where('students_group',array(
            'group_id' => $group_id,
            'student_id' => $user
        ));


        if ($check->row()->status == 'Drop'){
            return false;
        }else{
            $total_items = $this->db->get_where('midterm',array(
                'group_id' => $group_id
            ));
            $items = $total_items->result();

            $passing = $items[0]->exam_items * 0.4;
            if ($score >= round($passing) ){
                $computation_1 = (($score - round($passing)) * (100 - 75) / ($items[0]->exam_items - round($passing))) + 75;

                $get_midterm = $this->db->get_where('midterm',array(
                    'group_id' => $group_id,
                    'student_id' => $user
                ));


                $quiz_equi = $get_midterm->row()->quiz;
                $participation = $get_midterm->row()->participation;
                $project = $get_midterm->row()->project;

                $avgquiz = $quiz_equi * 0.2;
                $avgexam =  $computation_1 * 0.4;
                $avgparticipation = $participation * 0.2;
                $avgproject = $project * 0.2;
                $average = $avgquiz + $avgexam + $avgparticipation + $avgproject;

                if ($average < 65){
                    $average = 65;
                }
                $data = array(
                    'term_exam' => $computation_1,
                    'average' => $average
                );

                $user_data = array(
                    'group_id' => $group_id,
                    'student_id' => $user,
                );
                $this->db->where($user_data);
                $this->db->update('midterm',$data);

//                Inserting in Grading Sheet
                $grade_midterm = array(
                    'midterm' => $average
                );

                $midterm = array(
                    'group_id' => $group_id,
                    'student_id' => $user
                );
                $this->db->where($midterm);
                $this->db->update('grading_sheet',$grade_midterm);

                $this->quiz->GWA($group_id,$user);
                return true;

            }else{
                $computation_2 = ($score * (75-65) / round($passing) ) + 65;

                $get_midterm = $this->db->get_where('midterm',array(
                    'group_id' => $group_id,
                    'student_id' => $user
                ));

                if ($get_midterm->num_rows() > 0) {
                    $quiz_equi = $get_midterm->row()->quiz;
                    $participation = $get_midterm->row()->participation;
                    $project = $get_midterm->row()->project;

                    $avgquiz = $quiz_equi * 0.2;
                    $avgexam = $computation_2 * 0.4;
                    $avgparticipation = $participation * 0.2;
                    $avgproject = $project * 0.2;
                    $average = $avgquiz + $avgexam + $avgparticipation + $avgproject;

                    if ($average < 65) {
                        $average = 65;
                    }
                    $data = array(
                        'term_exam' => $computation_2,
                        'average' => $average
                    );

                    $user_data = array(
                        'group_id' => $group_id,
                        'student_id' => $user,
                    );
                    $this->db->where($user_data);
                    $this->db->update('midterm', $data);

//                Inserting in Grading Sheet
                    $grade_midterm = array(
                        'midterm' => $average
                    );

                    $midterm = array(
                        'group_id' => $group_id,
                        'student_id' => $user
                    );
                    $this->db->where($midterm);
                    $this->db->update('grading_sheet', $grade_midterm);

                    $this->quiz->GWA($group_id,$user);
                    return true;
                }

            }
        }

    }

    public function prefinalExamScore($score,$user,$group_id){
        $check = $this->db->get_where('students_group',array(
            'group_id' => $group_id,
            'student_id' => $user
        ));


        if ($check->row()->status == 'Drop'){
            return false;
        }else{
            $total_items = $this->db->get_where('prefinal',array(
                'group_id' => $group_id
            ));
            $items = $total_items->result();

            $passing = $items[0]->exam_items * 0.4;
            if ($score >= round($passing) ){
                $computation_1 = (($score - round($passing)) * (100 - 75) / ($items[0]->exam_items - round($passing))) + 75;

                $get_prefinal = $this->db->get_where('prefinal',array(
                    'group_id' => $group_id,
                    'student_id' => $user
                ));


                $quiz_equi = $get_prefinal->row()->quiz;
                $participation = $get_prefinal->row()->participation;
                $project = $get_prefinal->row()->project;

                $avgquiz = $quiz_equi * 0.2;
                $avgexam =  $computation_1 * 0.4;
                $avgparticipation = $participation * 0.2;
                $avgproject = $project * 0.2;
                $average = $avgquiz + $avgexam + $avgparticipation + $avgproject;

                if ($average < 65){
                    $average = 65;
                }
                $data = array(
                    'term_exam' => $computation_1,
                    'average' => $average
                );

                $user_data = array(
                    'group_id' => $group_id,
                    'student_id' => $user,
                );
                $this->db->where($user_data);
                $this->db->update('prefinal',$data);

//                Inserting in Grading Sheet
                $grade_prefinal = array(
                    'prefinal' => $average
                );

                $prefinal = array(
                    'group_id' => $group_id,
                    'student_id' => $user
                );
                $this->db->where($prefinal);
                $this->db->update('grading_sheet',$grade_prefinal);

                $this->quiz->GWA($group_id,$user);
                return true;

            }else{

                $computation_2 = ($score * (75-65) / round($passing) ) + 65;

                $get_prefinal = $this->db->get_where('prefinal',array(
                    'group_id' => $group_id,
                    'student_id' => $user
                ));

                if ($get_prefinal->num_rows() > 0) {
                    $quiz_equi = $get_prefinal->row()->quiz;
                    $participation = $get_prefinal->row()->participation;
                    $project = $get_prefinal->row()->project;

                    $avgquiz = $quiz_equi * 0.2;
                    $avgexam = $computation_2 * 0.4;
                    $avgparticipation = $participation * 0.2;
                    $avgproject = $project * 0.2;
                    $average = $avgquiz + $avgexam + $avgparticipation + $avgproject;

                    if ($average < 65) {
                        $average = 65;
                    }
                    $data = array(
                        'term_exam' => $computation_2,
                        'average' => $average
                    );

                    $user_data = array(
                        'group_id' => $group_id,
                        'student_id' => $user,
                    );
                    $this->db->where($user_data);
                    $this->db->update('prefinal', $data);

//                Inserting in Grading Sheet
                    $grade_prefinal = array(
                        'prefinal' => $average
                    );

                    $prefinal = array(
                        'group_id' => $group_id,
                        'student_id' => $user
                    );
                    $this->db->where($prefinal);
                    $this->db->update('grading_sheet', $grade_prefinal);

                    $this->quiz->GWA($group_id,$user);
                    return true;
                }

            }
        }


    }

    public function finalsExamScore($score,$user,$group_id){
        $check = $this->db->get_where('students_group',array(
            'group_id' => $group_id,
            'student_id' => $user
        ));


        if ($check->row()->status == 'Drop'){
            return false;
        }else{
            $total_items = $this->db->get_where('finals',array(
                'group_id' => $group_id
            ));
            $items = $total_items->result();

            $passing = $items[0]->exam_items * 0.4;
            if ($score >= round($passing) ){
                $computation_1 = (($score - round($passing)) * (100 - 75) / ($items[0]->exam_items - round($passing))) + 75;

                $get_finals = $this->db->get_where('finals',array(
                    'group_id' => $group_id,
                    'student_id' => $user
                ));


                $quiz_equi = $get_finals->row()->quiz;
                $participation = $get_finals->row()->participation;
                $project = $get_finals->row()->project;

                $avgquiz = $quiz_equi * 0.2;
                $avgexam =  $computation_1 * 0.4;
                $avgparticipation = $participation * 0.2;
                $avgproject = $project * 0.2;
                $average = $avgquiz + $avgexam + $avgparticipation + $avgproject;

                if ($average < 65){
                    $average = 65;
                }
                $data = array(
                    'term_exam' => $computation_1,
                    'average' => $average
                );

                $user_data = array(
                    'group_id' => $group_id,
                    'student_id' => $user,
                );
                $this->db->where($user_data);
                $this->db->update('finals',$data);

//                Inserting in Grading Sheet
                $grade_finals = array(
                    'finals' => $average
                );

                $finals = array(
                    'group_id' => $group_id,
                    'student_id' => $user
                );
                $this->db->where($finals);
                $this->db->update('grading_sheet',$grade_finals);

                $this->quiz->GWA($group_id,$user);

                return true;
            }else{

                $computation_2 = ($score * (75-65) / round($passing) ) + 65;

                $get_finals = $this->db->get_where('finals',array(
                    'group_id' => $group_id,
                    'student_id' => $user
                ));

                if ($get_finals->num_rows() > 0) {
                    $quiz_equi = $get_finals->row()->quiz;
                    $participation = $get_finals->row()->participation;
                    $project = $get_finals->row()->project;

                    $avgquiz = $quiz_equi * 0.2;
                    $avgexam = $computation_2 * 0.4;
                    $avgparticipation = $participation * 0.2;
                    $avgproject = $project * 0.2;
                    $average = $avgquiz + $avgexam + $avgparticipation + $avgproject;

                    if ($average < 65) {
                        $average = 65;
                    }
                    $data = array(
                        'term_exam' => $computation_2,
                        'average' => $average
                    );

                    $user_data = array(
                        'group_id' => $group_id,
                        'student_id' => $user,
                    );
                    $this->db->where($user_data);
                    $this->db->update('finals',$data);

//                Inserting in Grading Sheet

                    $grade_finals = array(
                        'finals' => $average
                    );

                    $finals = array(
                        'group_id' => $group_id,
                        'student_id' => $user
                    );
                    $this->db->where($finals);
                    $this->db->update('grading_sheet', $grade_finals);

                    $this->quiz->GWA($group_id,$user);
                    return true;
                }

            }
        }

    }


}