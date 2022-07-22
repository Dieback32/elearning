<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }
    public function getEventDetails(){
        $this->db->order_by("logs", "desc");
        $query = $this->db->get('event');
        return $query->result();
    }

    public function editEvent($event_id,$event_name,$location,$date_time,$event_desc){
        $data = array(
            'event_name' => $event_name,
            'location' => $location,
            'date_time' => $date_time,
            'description' => $event_desc,
            'logs' => date('Y-m-d H:i:s')
        );

        $this->db->where('id',$event_id);
        $this->db->update('event',$data);

        return true;
    }

    public function deleteEvent($event_id){
        $this->db->where('id',$event_id);
        $this->db->delete('event');
    }
}