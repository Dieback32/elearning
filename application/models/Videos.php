<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getVideos($id){
        $query = $this->db->get_where('video_tutorial',array(
            'group_id' => $id
        ));

        return $query->result();
    }

    public function getAllVideos(){
        $this->db->order_by("logs", "desc");
        $this->db->where('user_id',$this->session->userdata('id'));
        $query = $this->db->get('video_storage');
        return $query->result();
    }

    public function deleteVideoTutorial($id,$group_id){
        $data = array(
            'id' => $id,
            'group_id' => $group_id
        );

        $this->db->where($data);
        $this->db->delete('video_tutorial');
    }
}