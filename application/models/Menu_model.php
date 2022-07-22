<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

//  Menu Management
    public function addMenu($menu_title, $sel_parent, $sel_content, $parent)
    {
        $query = $this->db->get_where('content', array(
            'content_title' => $sel_content
        ));

        if ($parent == 'parent') {

            $check = $this->db->get_where('parent', array(
                'parent_title' => $menu_title,
            ));
            if ($check->num_rows() == 0) {

                $data = array(
                    'content_id' => $query->row()->id,
                    'parent_title' => $menu_title,
                );

                $this->db->insert('parent', $data);

//                Inserting Logs

                $user = $this->session->userdata('authorization');

                $logs = array(
                    'user' => $user,
                    'activity' => $user . " , created a new PARENT menu."."<br/>". "Menu Title : ".$menu_title ,
                    'datetime' => date('Y-m-d H:i:s')
                );

                $this->db->insert('activity_logs',$logs);

                return true;
            }


        } else {

            $check = $this->db->get_where('child', array(
                'child_title' => $menu_title,
            ));

            $check_parent = $this->db->get_where('parent', array(
                'parent_title' => $sel_parent,
            ));

            $count = $check_parent->row()->child_status;

            if ($check->num_rows() == 0) {

                $data = array(
                    'content_id' => $query->row()->id,
                    'parent_id' => $check_parent->row()->id,
                    'child_title' => $menu_title
                );

                $this->db->insert('child', $data);

//                Inserting Logs

                $user = $this->session->userdata('authorization');

                $logs = array(
                    'user' => $user,
                    'activity' => $user . " , created a new CHILD menu."."<br/>". "Menu Title : ".$menu_title ,
                    'datetime' => date('Y-m-d H:i:s')
                );

                $this->db->insert('activity_logs',$logs);

//               Count of the child inserted in a parent

                $child_status = $this->db->get_where('parent',array(
                    'parent_title' => $sel_parent
                ));
                $count = $child_status->row()->child_status;
                $this->db->where('parent_title',$sel_parent);
                $status = array(
                    'child_status' => $count + 1
                );
                $this->db->update('parent',$status);

                return true;
            }else{
                return false;
            }


        }
        return false;
    }

    public function getMenus(){

        $this->db->select('*');
        $this->db->from('parent a');
        $this->db->join('child b', 'b.parent_id=a.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function addPage($title,$content){
        $this->db->where('content_title',$title);
        $qry = $this->db->get('content');

        if ($qry->num_rows() == 0){

            $data = array(
                'content_title' => $title,
                'content' => $content
            );

            $this->db->insert('content',$data);

            //     Inserting Logs

            $user = $this->session->userdata('authorization');

            $logs = array(
                'user' => $user,
                'activity' => $user . " , created a new CONTENT Page."."<br/>". "Content Title : ".$title ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);
            return true;
        }else{
            return false;
        }

    }

//    Edit Child Menu

    public function showParentById($id)
    {

        $child = $this->db->get_where('child', array('id' => $id));
        $child_id = $child->row()->parent_id;

        $parent = $this->db->get_where('parent', array('id' => $child_id));
        return $parent->result();
    }

    public function showChildById($id)
    {
        $this->db->where('id', $id);
        $qry = $this->db->get('child');
        return $qry->result();
    }

    public function showContentById($id)
    {

        $child = $this->db->get_where('child', array('id' => $id));
        $child_id = $child->row()->content_id;

        $content = $this->db->get_where('content', array('id' => $child_id));
        return $content->result();
    }


    public function childUpdate($child_title,$parent_title,$content_title,$child_id){
        $check = $this->db->get_where('child', array('child_title' => $child_title));
        $parent_id = $this->db->get_where('parent', array('parent_title' => $parent_title));
        $content_id = $this->db->get_where('content', array('content_title' => $content_title));


        if ($check->num_rows() == 1 || $check->num_rows() == 0){

            //  Count of the child inserted in a parent

            $child_status = $this->db->get_where('parent',array(
                'parent_title' => $parent_title
            ));
            $checkparent = $this->db->get('child');
            $parent = $checkparent->row()->parent_id;

            $count = $child_status->row()->child_status;
            if ($parent == $parent_id->row()->id){
                $this->db->where('parent_title',$parent_title);
                $status = array(
                    'child_status' => $count + 0
                );
                $this->db->update('parent',$status);
            }else{

                $this->db->where('parent_title',$parent_title);
                $status = array(
                    'child_status' => $count + 1
                );
                $this->db->update('parent',$status);



            }


            $data = array(
                'parent_id' => $parent_id->row()->id,
                'child_title' => $child_title,
                'content_id' => $content_id->row()->id
            );
            $this->db->where('id', $child_id);
            $this->db->update('child', $data);

            //     Inserting Logs

            $user = $this->session->userdata('authorization');

            $logs = array(
                'user' => $user,
                'activity' => $user . " , Child menu has been change to.". $child_title ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);
            return true;
        }else{
            return false;
        }


    }

//    Delete Child Menu
    public function childDelete($chd_id)
    {

        $child = $this->db->get_where('child',array(
            'id' => $chd_id
        ));
        $child_title = $child->row()->child_title;
        $child_id = $child->row()->parent_id;
        $child_status = $this->db->get_where('parent', array(
            'id' => $child_id
        ));
        $count = $child_status->row()->child_status;
        $this->db->where('id',$child_id);
        $status = array(
            'child_status' => $count - 1
        );

        $this->db->update('parent',$status);


        $this->db->where('id', $chd_id);
        $this->db->delete('child');

        //     Inserting Logs

        $user = $this->session->userdata('authorization');

        $logs = array(
            'user' => $user,
            'activity' => $user . " , Child menu has been Deleted.". "<br/>" . "Menu Title : ".$child_title ,
            'datetime' => date('Y-m-d H:i:s')
        );

        $this->db->insert('activity_logs',$logs);

        return true;
    }

//    Edit Parent Menu

    public function getParentById($id)
    {
        $this->db->where('id', $id);
        $qry = $this->db->get('parent');
        return $qry->result();

    }

    public function getContentById($id)
    {
        $parent = $this->db->get_where('parent', array('id' => $id));
        $parent_id = $parent->row()->content_id;

        $content = $this->db->get_where('content', array('id' => $parent_id));
        return $content->result();
    }

    public function parentUpdate($parent_id,$parent_title,$content_title){

        $qry = $this->db->get_where('parent',array(
            'parent_title' => $parent_title
        ));
        $check = $this->db->get_where('content',array(
            'content_title' => $content_title
        ));
        $content_id = $check->row()->id;
        if ($qry->num_rows() == 1 || $qry->num_rows() == 0){

            $data = array(
                'parent_title' => $parent_title,
                'content_id' => $content_id
            );

            $this->db->where('id',$parent_id);
            $this->db->update('parent',$data);

            //     Inserting Logs

            $user = $this->session->userdata('authorization');

            $logs = array(
                'user' => $user,
                'activity' => $user . " , Parent menu has been Updated.". "<br/>" . "Menu Title : ".$parent_title ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);
            return true;
        }else{
            return false;
        }

    }

//    Delete Parent Menu

    public function delParent($prt_id){

        //     Inserting Logs
        $check = $this->db->get_where('parent', array('id' => $prt_id ));
        $parent_title = $check->row()->parent_title;
        $user = $this->session->userdata('authorization');

        $logs = array(
            'user' => $user,
            'activity' => $user . " , Parent menu has been Deleted.". "<br/>" . "Menu Title : ".$parent_title ,
            'datetime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('activity_logs',$logs);


        $this->db->where('id', $prt_id);
        $this->db->delete('parent');
        return true;
    }


//    Edit Content Page

    public function fetchContentById($id){

        $content_id = $this->db->get_where('content', array(
            'id' => $id
        ));

        return $content_id->result();

    }

    public function contentUpdate($content_id,$content_title,$content){

        $data = array(
            'content_title' => $content_title,
            'content' => $content
        );
        $this->db->where('id',$content_id);
        $this->db->update('content',$data);


        //     Inserting Logs

        $user = $this->session->userdata('authorization');

        $logs = array(
            'user' => $user,
            'activity' => $user . " , Content Page has been Updated.". "<br/>" . "Menu Title : ".$content_title ,
            'datetime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('activity_logs',$logs);

        return true;

    }

//    Delete Content Page

    public function delContentPage($cnt_id){
        $check = $this->db->get_where('content',array('id' => $cnt_id));
        $content_title = $check->row()->content_title;
        //     Inserting Logs
        $user = $this->session->userdata('authorization');

        $logs = array(
            'user' => $user,
            'activity' => $user . " , Content Page has been Deleted.". "<br/>" . "Menu Title : ".$content_title ,
            'datetime' => date('Y-m-d H:i:s')
        );
        $this->db->insert('activity_logs',$logs);


        $this->db->where('id', $cnt_id);
        $this->db->delete('content');

        $query_parent = $this->db->get_where('parent',array(
            'content_id' => $cnt_id
        ));

        $query_child = $this->db->get_where('child',array(
            'content_id' => $cnt_id
        ));


        if ($query_parent->num_rows() > 0){
            $data = array(
                'content_id' => NULL
            );
            $this->db->where('content_id',$cnt_id);
            $this->db->update('parent',$data);
        }

        if ($query_child->num_rows() > 0){
            $data = array(
                'content_id' => NULL
            );
            $this->db->where('content_id',$cnt_id);
            $this->db->update('child',$data);
        }
    }


//    Fetch Data from database
    public function getParent(){
        $qry = $this->db->get('parent');
        return $qry->result();
    }

    public function getChild(){
        $qry = $this->db->get('child');
        return $qry->result();
    }

    public function getContent(){
        $qry = $this->db->get('content');
        return $qry->result();
    }

    public function checkContent(){
        $qry = $this->db->get('content');
        if ($qry->num_rows() == 0){
            return NULL;
        }
    }







}