<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participation extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    public function prelimParticipation($student_id,$group_id,$remarks){
        $check = $this->db->get_where('students_group',array(
            'group_id' => $group_id,
            'student_id' => $student_id
        ));


        if ($check->row()->status == 'Drop'){
            return false;
        }else{
            $data = array(
                'participation' => $remarks
            );

            $check = array(
                'student_id' => $student_id,
                'group_id' => $group_id
            );
            $this->db->where($check);
            $this->db->update('prelim',$data);

            $get_prelim = $this->db->get_where('prelim',array(
                'group_id' => $group_id,
                'student_id' => $student_id
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
                    'student_id' => $student_id
                );
                $this->db->where($user_data);
                $this->db->update('prelim',$data);

//                Inserting in Grading Sheet
                $grade_prelim = array(
                    'prelim' => $average
                );

                $prelim = array(
                    'group_id' => $group_id,
                    'student_id' => $student_id
                );
                $this->db->where($prelim);
                $this->db->update('grading_sheet',$grade_prelim);

                //Getting the GWA
                $this->quiz->GWA($group_id,$student_id);
                return true;
            }
        }

    }
    public function midtermParticipation($student_id,$group_id,$remarks){
        $check = $this->db->get_where('students_group',array(
            'group_id' => $group_id,
            'student_id' => $student_id
        ));


        if ($check->row()->status == 'Drop'){
            return false;
        }else{
            $data = array(
                'participation' => $remarks
            );

            $check = array(
                'student_id' => $student_id,
                'group_id' => $group_id
            );
            $this->db->where($check);
            $this->db->update('midterm',$data);

            $get_midterm = $this->db->get_where('midterm',array(
                'group_id' => $group_id,
                'student_id' => $student_id
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

                if ($average < 65){
                    $average = 65;
                }

                $data = array(
                    'average' => $average
                );

                $user_data = array(
                    'group_id' => $group_id,
                    'student_id' => $student_id
                );
                $this->db->where($user_data);
                $this->db->update('midterm',$data);

//                Inserting in Grading Sheet
                $midtermAVG = array(
                    'midterm' => $average
                );

                $midterm = array(
                    'group_id' => $group_id,
                    'student_id' => $student_id
                );
                $this->db->where($midterm);
                $this->db->update('grading_sheet',$midtermAVG);

                //Getting the GWA
                $this->quiz->GWA($group_id,$student_id);
                return true;
            }
        }

    }
    public function prefinalParticipation($student_id,$group_id,$remarks){
        $check = $this->db->get_where('students_group',array(
            'group_id' => $group_id,
            'student_id' => $student_id
        ));


        if ($check->row()->status == 'Drop'){
            return false;
        }else{
            $data = array(
                'participation' => $remarks
            );

            $check = array(
                'student_id' => $student_id,
                'group_id' => $group_id
            );
            $this->db->where($check);
            $this->db->update('prefinal',$data);

            $get_prefinal = $this->db->get_where('prefinal',array(
                'group_id' => $group_id,
                'student_id' => $student_id
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

                if ($average < 65){
                    $average = 65;
                }

                $data = array(
                    'average' => $average
                );

                $user_data = array(
                    'group_id' => $group_id,
                    'student_id' => $student_id
                );
                $this->db->where($user_data);
                $this->db->update('prefinal',$data);

                //                Inserting in Grading Sheet
                $prefinalAVG = array(
                    'prefinal' => $average
                );

                $prefinal = array(
                    'group_id' => $group_id,
                    'student_id' => $student_id
                );
                $this->db->where($prefinal);
                $this->db->update('grading_sheet',$prefinalAVG);


                //Getting the GWA
                $this->quiz->GWA($group_id,$student_id);
                return true;
            }
        }
    }
    public function finalsParticipation($student_id,$group_id,$remarks){
        $check = $this->db->get_where('students_group',array(
            'group_id' => $group_id,
            'student_id' => $student_id
        ));


        if ($check->row()->status == 'Drop'){
            return false;
        }else{
            $data = array(
                'participation' => $remarks
            );

            $check = array(
                'student_id' => $student_id,
                'group_id' => $group_id
            );
            $this->db->where($check);
            $this->db->update('finals',$data);

            $get_finals = $this->db->get_where('finals',array(
                'group_id' => $group_id,
                'student_id' => $student_id
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

                if ($average < 65){
                    $average = 65;
                }

                $data = array(
                    'average' => $average
                );

                $user_data = array(
                    'group_id' => $group_id,
                    'student_id' => $student_id
                );
                $this->db->where($user_data);
                $this->db->update('finals',$data);

//                Inserting in Grading Sheet
                $finalsAVG = array(
                    'finals' => $average
                );

                $finals = array(
                    'group_id' => $group_id,
                    'student_id' => $student_id
                );
                $this->db->where($finals);
                $this->db->update('grading_sheet',$finalsAVG);

                //Getting the GWA
                $this->quiz->GWA($group_id,$student_id);
                return true;
            }
        }
    }

}