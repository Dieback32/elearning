<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Add_subjects extends CI_Model{

    function __construct()
    {
        parent::__construct();

    }

    public function addSchoolYear($sy){
        $query = $this->db->get_where('school_year',array(
            'school_year' => $sy
        ));

        if ($query->num_rows() == 0){
            $data = array(
                'school_year' => $sy
            );

            $this->db->insert('school_year',$data);
            return true;
        }else{
            return false;
        }
    }

    public function deleteSY($schoolYear){
        $school_year = $this->db->get_where('school_year',array(
            'id' => $schoolYear
        ));
        $year = $school_year->result();
        $query = $this->db->get('class_subjects');
        $check = $query->result();
        foreach ($year as $y){
            foreach ($check as $sy){
                if ($y->school_year == $sy->school_year){
                    return false;
                }else{
                    $this->db->where('id',$schoolYear);
                    $this->db->delete('school_year');
                    return true;
                }

            }

        }


    }

    public function getSY(){
        $query = $this->db->get('school_year');

        return $query->result();
    }

    public function insertingSubjects($year,$semester,$id){
        $data = array(
            'school_year' => $year,
            'semester' => $semester
        );
        $this->db->where('id',$id);
        $this->db->update('class_subjects',$data);
    }

    public function addNewSubjetcs($sy,$semester,$subject_code,$subject_desc,$subject_day,$subject_time){

        $query = $this->db->get_where('class_subjects', array(
                'subject_code' => $subject_code,
                'school_year' => $sy
        ));

        if ($query->num_rows() == 0){

            $data = array(
                'school_year' => $sy,
                'semester' => $semester,
                'subject_code' => $subject_code,
                'subject_desc' => $subject_desc,
                'day' => $subject_day,
                'time' => $subject_time
            );
            $this->db->insert('class_subjects',$data);

            $get_sub = $this->db->get_where('class_subjects',array(
                'subject_code' => $subject_code,
            ));
            $sub_id = $get_sub->row()->id;
            $data2 = array(
                'subject_id' => $sub_id,
                'subject_name' => $subject_desc,
            );
            $this->db->insert('class_group',$data2);
            return true;
        }else{
            return false;
        }


    }

    public function getSubjectBySY($sy){
        $query = $this->db->get_where('class_subjects',array(
            'school_year' => $sy
        ));

        return $query->result();
    }

    public function getSubjectByInstructor(){
        $query = $this->db->get_where('class_subjects',array(
            'instructor_id' => $this->session->userdata('id')
        ));

        return $query->result();
    }


    public function getAllSubjects(){
        $query = $this->db->get('class_subjects');

        return $query->result();
    }

    public function getAllLoadedSubject(){
        $query = $this->db->get_where('class_subjects',array(
            'status' => 0
        ));

        return $query->result();
    }

    public function subjectGetById($id){
        $query = $this->db->get_where('class_subjects',array(
            'id' => $id
        ));
        return $query->result();
    }

    public function editingSubject($id,$sub_id,$description,$day,$time){
        $query = $this->db->get_where('class_subjects',array(
           'subject_code' => $sub_id
        ));

        if ($query->num_rows() > 0){
            $data = array(
                'subject_code' => $sub_id,
                'subject_desc' => $description,
                'day' => $day,
                'time' => $time
            );

            $this->db->where('id',$id);
            $this->db->update('class_subjects',$data);

            return true;
        }else{

            return false;
        }
    }

    public function deleteSubject($subject){
        $check_student = $this->db->get_where('students_group',array(
            'subject_id' => $subject
        ));

        $check_instructor =  $this->db->get_where('class_subjects',array(
            'id' => $subject
        ));

        $get_id = $check_instructor->row()->instructor_id;


        if ($check_student->num_rows() > 0 || $get_id != 0 || $get_id != null ){
            return false;
        }else{
            $this->db->where('id',$subject);
            $this->db->delete('class_subjects');
            return true;
        }


    }

    public function assigningInstructor($user_id,$sub_id){

           $data = array(
               'status' => 1,
               'instructor_id' => $user_id
           );

           $this->db->where('id',$sub_id);
           $this->db->update('class_subjects',$data);

           $query = $this->db->get_where('class_subjects',array(
               'id' => $sub_id
           ));

           $sub_name = $query->row()->subject_desc;


           $group = array(
               'subject_id' => $sub_id,
               'subject_name' => $sub_name

           );
           $ins_id = array(
               'instructor_id' => $user_id
           );
           $this->db->where($group);
           $this->db->update('class_group',$ins_id);
           return true;

    }

    public function removeAssignedInstructor($subject_id){
        $data = array(
            'status' => 0,
            'instructor_id' => 0
        );
       $this->db->where('id ',$subject_id);
       $this->db->update('class_subjects',$data);
       $remove = array(
           'subject_id' => $subject_id
       );

       $ins = array(
           'instructor_id' => 0
       );
        $this->db->where('subject_id ',$subject_id);
        $this->db->update('class_group',$ins);

       return true;

    }

    public function getSubjectAssignStudents($id){
        $query = $this->db->get_where('class_subjects',array(
            'id' => $id
        ));

        return $query->result();
    }

    public function assigningStudents($subject_id,$id){
        $query = $this->db->get_where('class_group',array(
            'subject_id' => $subject_id,
        ));

        $check_group = $this->db->get_where('students_group',array(
            'subject_id' => $subject_id,
            'student_id' => $id
        ));

        $check_prelim = $this->db->get_where('prelim',array(
            'subject_id' => $subject_id,
            'student_id' => $id
        ));

        $check_midterm = $this->db->get_where('midterm',array(
            'subject_id' => $subject_id,
            'student_id' => $id
        ));

        $check_prefinal = $this->db->get_where('prefinal',array(
            'subject_id' => $subject_id,
            'student_id' => $id
        ));

        $check_finals = $this->db->get_where('finals',array(
            'subject_id' => $subject_id,
            'student_id' => $id
        ));

        $check_grading_sheet = $this->db->get_where('grading_sheet',array(
            'subject_id' => $subject_id,
            'student_id' => $id
        ));

        $check_project = $this->db->get_where('projects',array(
            'subject_id' => $subject_id,
            'student_id' => $id
        ));


        $group_id = $query->row()->id;

        if ($check_group->num_rows() == 0){
            $data = array(
                'student_id' => $id,
                'group_id' => $group_id,
                'subject_id' => $subject_id,
                'status' => 'Enrolled'
            );
            $data2 = array(
                'student_id' => $id,
                'group_id' => $group_id,
                'subject_id' => $subject_id,
            );

            $this->db->insert('students_group',$data);

            if ($check_prelim->num_rows() == 0){
                $this->db->insert('prelim',$data2);
            }

            if ($check_midterm->num_rows() == 0){
                $this->db->insert('midterm',$data2);
            }

            if ($check_prefinal->num_rows() == 0){
                $this->db->insert('prefinal',$data2);
            }

            if ($check_finals->num_rows() == 0){
                $this->db->insert('finals',$data2);
            }

            if ($check_grading_sheet->num_rows() == 0){
                $this->db->insert('grading_sheet',$data2);
            }

            if ($check_project->num_rows() == 0){
                $this->db->insert('projects',$data2);
            }

        }

    }

    public function dropStudents($subject_id,$students){
        $prelim = $this->db->get_where('prelim',array(
            'subject_id' => $subject_id,
            'student_id' => $students
        ));

        $midterm = $this->db->get_where('midterm',array(
            'subject_id' => $subject_id,
            'student_id' => $students
        ));

        $prefinal = $this->db->get_where('prefinal',array(
            'subject_id' => $subject_id,
            'student_id' => $students
        ));

        $finals = $this->db->get_where('finals',array(
            'subject_id' => $subject_id,
            'student_id' => $students
        ));

        $grading_sheet = $this->db->get_where('grading_sheet',array(
            'subject_id' => $subject_id,
            'student_id' => $students
        ));

        $project = $this->db->get_where('projects',array(
            'subject_id' => $subject_id,
            'student_id' => $students
        ));

        $check_midterm = $midterm->row()->average;

        if ($check_midterm > 65){
            return false;
        }else{

            $data = array(
                'status' => 'Drop'
            );
            $drop = array(
                'remarks' => 'Drop'
            );
            $check = array(
                'student_id' => $students,
                'subject_id' => $subject_id
            );
            $this->db->where($check);
            $this->db->update('students_group',$data);

            $this->db->where($check);
            $this->db->update('grading_sheet',$drop);


            return true;
        }

    }

    public function unassignStudents($subject_id,$students){
        $prelim = $this->db->get_where('prelim',array(
            'subject_id' => $subject_id,
            'student_id' => $students
        ));

        $midterm = $this->db->get_where('midterm',array(
            'subject_id' => $subject_id,
            'student_id' => $students
        ));

        $prefinal = $this->db->get_where('prefinal',array(
            'subject_id' => $subject_id,
            'student_id' => $students
        ));

        $finals = $this->db->get_where('finals',array(
            'subject_id' => $subject_id,
            'student_id' => $students
        ));

        $grading_sheet = $this->db->get_where('grading_sheet',array(
            'subject_id' => $subject_id,
            'student_id' => $students
        ));

        $project = $this->db->get_where('projects',array(
            'subject_id' => $subject_id,
            'student_id' => $students
        ));

        $check_prelim = $prelim->row()->average;

        if ($check_prelim > 65){
            return false;
        }else{

            $check = array(
                'student_id' => $students,
                'subject_id' => $subject_id
            );
            $this->db->where($check);
            $this->db->delete('students_group');

            return true;
        }
    }

    public function studentsGroup($id){
        $this->db->where('subject_id', $id);
        $group = $this->db->get('students_group');
        return $group->result();
    }

    public function getAssignedSubjects($id){
        $this->db->where('subject_id', $id);
        $group = $this->db->get('students_group');
        return $group->result();
    }

}
