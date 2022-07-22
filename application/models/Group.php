<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }


    public function getGroupById($id){
        $query = $this->db->get_where('class_group',array(
            'id' => $id
        ));

        return $query->result();
    }

    public function editGroup($name,$group_id){
        $data = array(
            'group_name' => $name
        );

        $this->db->where('id',$group_id);
        $this->db->update('class_group',$data);

        return true;
    }

    public function getCG(){
        $user = $this->session->userdata('id');
        $query = $this->db->get_where('class_group',array(
            'instructor_id' => $user
        ));

        return $query->result();
    }

    public function deleteGroup($group_id){
        $this->db->where('id',$group_id);
        $this->db->delete('class_group');
        return true;
    }


    public function getCGById($id){
        $query = $this->db->get_where('class_group',array(
            'id' => $id
        ));
        return $query->result();
    }

    public function getAllGroups(){
        $query = $this->db->get('class_group');
        return $query->result();
    }

    public function studentsGroup(){
        $query = $this->db->get('students_group');
        return $query->result();
    }

    public function getStudentsGroupSummary($id){
        $this->db->where('group_id',$id);
        $query = $this->db->get('students_group');
        return $query->result();
    }

    public function getStudentGroup(){
        $query = $this->db->get_where('students_group',array(
            'student_id' => $this->session->userdata('id'),
        ));
        return $query->result();
    }

    public function getAllStudentInGroup($id){
        $query = $this->db->get_where('students_group',array(
            'group_id' => $id
        ));
        return $query->result();
    }

    public function getComment($id){
        $this->db->from('class_wall_comment');
        $this->db->where('group_id',$id);
        $this->db->order_by("time", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function getStudentsGroup($id){
        $query = $this->db->get_where('students_group',array(
            'subject_id' => $id
        ));

        return $query->result();
    }

    public function insertComment($uri,$group_image,$userID,$comment,$avatar,$name,$group_id){

        $data = array(
            'group_id' => $group_id,
            'comment' => htmlspecialchars($comment),
            'userid' => $userID,
            'avatar' => $avatar,
            'name' => $name,
            'time' => date('Y-m-d H:i:s')
        );

        $this->db->insert('class_wall_comment',$data);

//        Notification
        $check = $this->db->get_where('students_group',array(
            'group_id' => $group_id
        ));

        $group_user = $check->result();

        foreach ($group_user as $user){
            if ($user->student_id != $userID){
                $notify = array(
                    'user_id' => $user->student_id,
                    'sender_id' => $userID,
                    'group_id' => $group_id,
                    'image' => $group_image,
                    'uri' => $uri,
                    'notify' => 1,
                    'data' => 'Your instructor has been posted on the class wall',
                    'page' => 'class_wall',
                    'logs' => date('Y-m-d H:i:s')
                );
                $this->db->insert('notification',$notify);
            }
        }

        return true;
    }

//     Notification

    public function getNotificationCount(){
        $query = $this->db->get_where('notification',array(
            'user_id' => $this->session->userdata('id'),
            'notify' => 1
        ));
        return $query->num_rows();
    }

    public function getCountNotify(){
        $query = $this->db->get_where('notification',array(
            'user_id' => $this->session->userdata('id'),
            'notify' => 1,
            'page' => 'chat_group'
        ));
        return $query->num_rows();
    }

    public function getNotification(){
        $this->db->order_by("logs","desc");
        $query = $this->db->get_where('notification',array(
            'user_id' => $this->session->userdata('id'),
        ));
        return $query->result();
    }

    public function removeBadgeNotification($userID){
        $query = $this->db->get_where('notification',array(
            'user_id' => $userID,
        ));
        if ($query->num_rows() > 0){
            $data = array(
                'notify' => null
            );

            $check = array(
                'user_id' => $userID,
            );

            $this->db->where($check);
            $this->db->update('notification',$data);

            return true;
        }else{
            return false;
        }

    }
}