<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_management extends CI_Model
{
    function __construct() {
        parent::__construct();

    }

    public function getUsers(){
        $qry = $this->db->get_where('users',array(
            'authorization' => 'registrar'
        ));

        return $qry->result();
    }

    public function getAllStudents(){
        $query = $this->db->get_where('endusers',array(
            'authorization' => 'student'
        ));

        return $query->result();
    }

    public function getStudentsByLastname(){
        $this->db->order_by('lastname','asc');
        $this->db->where('authorization','student');
        $query = $this->db->get('endusers');

        return $query->result();
    }
    public function getAllInstructor(){
        $query = $this->db->get_where('endusers',array(
            'authorization' => 'instructor'
        ));

        return $query->result();
    }

    public function getInstructorById($id){
        $query = $this->db->get_where('endusers',array(
            'id' => $id
        ));

        return $query->result();
    }

    public function deleteStudentAccount($id){
        $check = $this->db->get_where('students_group',array(
            'student_id' => $id
        ));

        $student = $check->result();

        foreach ($student as $stud){
            if ($stud->student_id == $id){
                return false;
            }else{
                $this->db->where('id',$id);
                $this->db->delete('endusers');
                return true;
            }
        }


        return true;
    }

    public function getAllUsers(){
        $this->db->where('status','activated');
        $this->db->order_by('lastname','asc');
        $query = $this->db->get('endusers');

        return $query->result();
    }

    public function getAllStudentByGroup($id){
        $student = $this->db->get_where('students_group',array(
            'group_id' => $id
        ));

        return $student->result();
    }

    public function getUserData(){
        $this->db->where('id',$this->session->userdata('id'));
        $query = $this->db->get('endusers');

        return $query->result();
    }

    public function editInstructorsData($instructor_id,$id_number,$fname,$lname,$email){
        $query = $this->db->get_where('endusers',array(
            'id_number' => $id_number
        ));

        $check = $this->db->get_where('endusers',array(
            'id' => $instructor_id
        ));

      if ($check->row()->id_number == $id_number) {
          $data = array(
              'id_number' => $id_number,
              'email' => $email,
              'password' => md5($id_number),
              'firstname' => $fname,
              'lastname' => $lname,
          );

          $this->db->where('id', $instructor_id);
          $this->db->update('endusers', $data);

          return true;
      }elseif($query->num_rows() == 0){
          $data = array(
              'id_number' => $id_number,
              'email' => $email,
              'password' => md5($id_number),
              'firstname' => $fname,
              'lastname' => $lname,
          );

          $this->db->where('id', $instructor_id);
          $this->db->update('endusers', $data);

          return true;
      }

    }

    public function deactivateInstructor($instructor_id){
        $data = array(
          'status' => 'deactivated'
        );

        $this->db->where('id',$instructor_id);
        $this->db->update('endusers',$data);

        return true;
    }

    public function activateInstructor($instructor_id){
        $data = array(
            'status' => 'activated'
        );

        $this->db->where('id',$instructor_id);
        $this->db->update('endusers',$data);

        return true;
    }

    public function editStudentsData($student_id,$id_number,$fname,$lname,$email,$course,$year){
        $query = $this->db->get_where('endusers',array(
            'id_number' => $id_number
        ));

        $check = $this->db->get_where('endusers',array(
            'id' => $student_id
        ));

        if ($check->row()->id_number == $id_number) {
            $data = array(
                'id_number' => $id_number,
                'email' => $email,
                'password' => md5($id_number),
                'firstname' => $fname,
                'lastname' => $lname,
                'course' => $course,
                'year' => $year
            );

            $this->db->where('id', $student_id);
            $this->db->update('endusers', $data);

            return true;
        }elseif($query->num_rows() == 0){
            $data = array(
                'id_number' => $id_number,
                'email' => $email,
                'password' => md5($id_number),
                'firstname' => $fname,
                'lastname' => $lname,
                'course' => $course,
                'year' => $year
            );

            $this->db->where('id', $student_id);
            $this->db->update('endusers', $data);

            return true;
        }
    }

    public function deactivateStudent($student_id){
        $data = array(
            'status' => 'deactivated'
        );
        $this->db->where('id',$student_id);
        $this->db->update('endusers',$data);

        return true;
    }

    public function activateStudent($student_id){
        $data = array(
            'status' => 'activated'
        );
        $this->db->where('id',$student_id);
        $this->db->update('endusers',$data);

        return true;
    }

    public function personalInfo($user,$city,$hometown,$mobile,$address,$birth,$gender){
        $data = array(
            'current_city' => $city,
            'hometown' => $hometown,
            'mobile' => $mobile,
            'address' => $address,
            'birthdate' => $birth,
            'gender' => $gender
        );

        $this->db->where('user_id',$user);
        $this->db->update('user_info',$data);
    }

}