<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct() {
        parent::__construct();
        $this->is_logged_in();
    }

    function is_logged_in(){
        $logged_in = $this->session->userdata('logged_in');
        if ($this->session->userdata('authorization') == 'instructor' || $this->session->userdata('authorization') == 'student'){
            redirect('home');
        }else{
            if (!isset($logged_in) || $logged_in == false){
                redirect('admin');
            }
        }

    }

    public function index(){

        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/content',
        );

        $this->load->view('backend/layout',$data);

    }

//    User Profile Methods

    public function user_profile(){

        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/user_profile',
        );

        $this->load->view('backend/layout',$data);

    }
    public function profile_edit(){

        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $user_update = $this->profile_model->edit_profile($fullname,$email);

        if ($user_update == true){

            $this->session->set_flashdata(array(
                'updateuser' => 'User profile has been updated.'
            ));
            redirect('dashboard/user_profile');
        }else{
            redirect('dashboard');
        }
    }

    public function user_avatar(){

        $config = array(
            'upload_path' => './uploads/users/',
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
                'avatar' => $file['file_name']
            );
            $user = $this->session->userdata('id');
            $qry = $this->db->get_where('users', array('id' => $user) );
            if ($qry->num_rows() > 0){
                $this->db->where('id',$user);
                $this->db->update('users',$data);

                $this->session->set_flashdata(array(

                    'uploaded' => 'Avatar successfully changed'
                ));

                //     Inserting Logs

                $user = $this->session->userdata('authorization');

                $logs = array(
                    'user' => $user,
                    'activity' => $user . " , Profile Avatar has been changed." ,
                    'datetime' => date('Y-m-d H:i:s')
                );

                $this->db->insert('activity_logs',$logs);


            }else{
                $this->db->insert('users',$data);
            }

            redirect('dashboard/user_profile');


        }else{
            $error = array(
                'user_prof' => $this->profile_model->get_userById(),
                'content' => 'backend/user_profile',
            );

            $this->session->set_flashdata(array(
                'error' => $this->upload->display_errors(),
            ));
            $this->load->view('backend/layout',$error);
        }

    }

    public function userChangepass(){

        $this->form_validation->set_rules('oldpassword','Password','trim|required|min_length[6]');
        $this->form_validation->set_rules('newpassword','Password','trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm','Confirm Password','trim|required|min_length[6]|matches[newpassword]');

        if ($this->form_validation->run() == FALSE){

            $data = array(
                'user_prof' => $this->profile_model->get_userById(),
                'content' => 'backend/user_profile',
            );


            $this->session->set_flashdata(array(
                'errors' => validation_errors()
            ));
            $this->load->view('backend/layout',$data);

        }else{

            $old_password = $this->input->post('oldpassword');
            $password = $this->input->post('newpassword');

            $newpass = $this->profile_model->userChangePass($old_password,$password);

            if ($newpass == true){

                $data = array(
                    'content' => 'backend/user_profile',
                    'user_prof' => $this->profile_model->get_userById(),

                );
                $this->session->set_flashdata(array(
                    'success' => 'New Password Updated',
                ));
                $this->load->view('backend/layout',$data);

            }else{
                $data = array(
                    'content' => 'backend/user_profile',
                    'user_prof' => $this->profile_model->get_userById(),
                );
                $this->session->set_flashdata(array(
                    'failed' => 'Old Password is Incorrect'
                ));
                $this->load->view('backend/layout',$data);
            }
        }
    }


//    Menu Management System

    public function addMenuPage(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/add_menu',
            'show_parent' => $this->menu_model->getParent(),
            'show_content' => $this->menu_model->getContent(),

        );

        $this->load->view('backend/layout',$data);

    }

    public function addMenu(){
        $parent = $this->input->post('menu_type');
        $menu_title = $this->input->post('menu_title');
        $sel_parent = $this->input->post('selparent');
        $sel_content = $this->input->post('selcontent');

        $data = $this->menu_model->addMenu($menu_title,$sel_parent,$sel_content,$parent);

        if ($data == true){

            $this->session->set_flashdata(array(
                'success' => 'Menu has been created.',
            ));
            redirect('dashboard/addMenuPage');

        }else{
            $this->session->set_flashdata(array(
                'failed' => 'Menu Title already exist.',
            ));
            redirect('dashboard/addMenuPage');
        }
    }

    public function addPageContent(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/add_content',
        );

        $this->load->view('backend/layout',$data);
    }

    public function addPage(){

        $title = $this->input->post('content_title');
        $content =$this->input->post('content');

        $data = $this->menu_model->addPage($title,$content);

        if ($data == true){
            $this->session->set_flashdata(array(
                'success' => 'Content has been created.',
            ));
            redirect('dashboard/addPageContent');
        }else{
            $this->session->set_flashdata(array(
                'failed' => 'Content Title already exist.',
            ));
            redirect('dashboard/addPageContent');
        }

    }

    public function menuList(){

        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'show_parent' => $this->menu_model->getParent(),
            'show_child' => $this->menu_model->getChild(),
            'show_content' => $this->menu_model->getContent(),
            'show_menus' =>$this->menu_model->getMenus(),
            'content' => 'backend/menu_list'
        );
        $this->load->view('backend/layout',$data);
    }

//  Edit Child Menu

    public function editChild(){
        $id = $this->input->get('id');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/editChild',
            'show_parent' => $this->menu_model->getParent(),
            'show_content' => $this->menu_model->getContent(),
            'parent_name' => $this->menu_model->showParentById($id),
            'child_name' => $this->menu_model->showChildById($id),
            'content_title' => $this->menu_model->showContentById($id)
        );
        $this->load->view('backend/layout',$data);
    }

    public function updateChild(){
        $child_id = $this->input->post('child_id');
        $child_title = $this->input->post('child_title');
        $parent_title = $this->input->post('selparent');
        $content_title = $this->input->post('selcontent');

        $data = $this->menu_model->childUpdate($child_title,$parent_title,$content_title,$child_id);

        if ($data == true){

            $this->session->set_flashdata(array(
                'success' => 'Child Menu has been updated.',
            ));
            redirect('dashboard/menuList/childlist');
        }else{
            $this->session->set_flashdata(array(
                'failed' => 'Child Menu Title already exist.',
            ));
            redirect('dashboard/menuList/childlist');
        }
    }

//    Delete Child Menu
    public function deleteChild(){

        $id = $this->input->post('checkbox');

        foreach ($id as $chd_id){
            $this->menu_model->childDelete($chd_id);
        }
        redirect('dashboard/menuList/childlist');

    }

//    Edit Parent Menu

    public function editParent(){
        $id = $this->input->get('id');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/editParent',
            'show_content' => $this->menu_model->getContent(),
            'parent_title' => $this->menu_model->getParentById($id),
            'content_title' => $this->menu_model->getContentById($id)
        );
        $this->load->view('backend/layout',$data);
    }

    public function updateParent(){
        $parent_id = $this->input->post('parent_id');
        $parent_title = $this->input->post('parent_title');
        $content_title = $this->input->post('selcontent');

        $data = $this->menu_model->parentUpdate($parent_id,$parent_title,$content_title);

        if ($data == true){

            $this->session->set_flashdata(array(
                'success' => 'Parent Menu has been updated.',
            ));
            redirect('dashboard/menuList/parentlist');
        }else{
            $this->session->set_flashdata(array(
                'failed' => 'Parent Menu Title already exist.',
            ));
            redirect('dashboard/menuList/parentlist');
        }
    }

//    Delete Parent Menu

    public function deleteParent(){
        $id = $this->input->post('checkbox');
        foreach ($id as $prt_id){
            $this->menu_model->delParent($prt_id);
        }
        redirect('dashboard/menuList/parentlist');

    }


//    Edit Content Page

    public function editContent(){
        $id = $this->input->get('id');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/editContent',
            'content_title' => $this->menu_model->fetchContentById($id)

        );
        $this->load->view('backend/layout',$data);
    }

    public function updateContent(){
        $content_id = $this->input->post('content_id');
        $content_title = $this->input->post('content_title');
        $content = $this->input->post('content');

        $data = $this->menu_model->contentUpdate($content_id,$content_title,$content);

        if ($data == true){

            $this->session->set_flashdata(array(
                'success' => 'Content Page has been updated.',
            ));
            redirect('dashboard/menuList/contentlist');
        }else{
            $this->session->set_flashdata(array(
                'failed' => 'Content Title already exist.',
            ));
            redirect('dashboard/menuList/contentlist');
        }
    }

//    Delete Content Page

    public function deleteContent(){
        $id = $this->input->post('checkbox');

        foreach ($id as $cnt_id){
            $this->menu_model->delContentPage($cnt_id);
        }
        redirect('dashboard/menuList/contentlist');
    }


//    Add New User

    public function new_user(){

        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/add_users',
            'checkreg' => $this->new_user->checkRegistrar()
        );
        $this->load->view('backend/layout',$data);

    }

    public function add_user(){

        $this->form_validation->set_rules('fullname','Complete Name','trim|required');
        $this->form_validation->set_rules('username','Username','trim|required|min_length[4]');
        $this->form_validation->set_rules('email','Email','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm','Confirm Password','trim|required|min_length[6]|matches[password]');

        if ($this->form_validation->run() == FALSE){

            $this->session->set_flashdata(array(
                'errors' => validation_errors()
            ));
            redirect('dashboard/new_user');
        }else{

            $fullname = $this->input->post('fullname');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $data = $this->new_user->addNewUser($fullname,$username,$email,$password);

            if ($data == true){
                $this->session->set_flashdata(array(
                    'success' => 'New account has been created'
                ));
                redirect('dashboard');
            }else{
                redirect('dashboard/new_user');
            }
        }


    }

    public function manageUser(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/manage_user',
            'user_data' => $this->user_management->getUsers(),
        );

        $this->load->view('backend/layout',$data);

    }

    public function deleteUser(){
        $id = $this->input->post('checkbox');

        foreach ($id as $user_id){
            $this->new_user->deleteUsers($user_id);
        }
        redirect('dashboard/manageUser');
    }

    public function contactcontactUs(){

        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'show_parent' => $this->menu_model->getParent(),
            'show_child' => $this->menu_model->getChild(),
            'show_content' => $this->menu_model->getContent(),
            'show_menus' =>$this->menu_model->getMenus(),
            'contact_us' => $this->frontend_model->getContacts(),
            'content' => 'backend/contact_us'
        );
        $this->load->view('backend/layout',$data);
    }

//    Activity Logs Page
    public function actLogsPage(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/activity_logs',
            'show_logs' => $this->logs->getLogs()
        );
        $this->load->view('backend/layout',$data);
    }

    public function deleteLogs(){

        $this->logs->LogsDelete();

        redirect('dashboard/actLogsPage');
    }

//    Add Website Icon
    public function manageSettings(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/addWebIcon',
            'webdata' => $this->manage_website->getWebData(),
            'check_webdata' => $this->manage_website->checkWebData(),
        );
        $this->load->view('backend/layout',$data);
    }

    public function addIcon(){

        $config = array(
            'upload_path' => './uploads/icon/',
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
                'web_icon' => $file['file_name']
            );
            $checkdata = $this->db->get('websetting');

            if ($checkdata->num_rows() > 0){

                $this->session->set_flashdata(array(
                    'uploaded' => 'Web Icon Uploaded'
                ));

                $this->db->update('websetting',$data);
            }else{
                $this->session->set_flashdata(array(
                    'uploaded' => 'Web Icon Uploaded'
                ));
                $this->db->insert('websetting',$data);
            }

            //     Inserting Logs

            $user = $this->session->userdata('authorization');

            $logs = array(
                'user' => $user,
                'activity' => $user . " , Website icon has been changed." ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);

            redirect('dashboard/manageSettings');

        }else{

            $this->session->set_flashdata(array(
                'error' => $this->upload->display_errors(),
            ));
            redirect('dashboard/manageSettings');
        }

    }

//    Delete Icon
    public function deleteIcon(){
        $delete = $this->manage_website->deleteIcon();
        if ($delete == true){
            redirect('dashboard/manageSettings');
        }else{
            redirect('dashboard/manageSettings');
        }
    }
    public function addTitle(){

        $web_title = $this->input->post('web_title');
        $brand_name = $this->input->post('brand_name');

        $data = $this->manage_website->insertTitle($web_title,$brand_name);

        if ($data){
            $this->session->set_flashdata(array(
                'updated' => 'Web Title & Brand Name has been Updated'
            ));
            redirect('dashboard/manageSettings');
        }else{
            $this->session->set_flashdata(array(
                'errors' => 'Insertion failed'
            ));
            redirect('dashboard/manageSettings');
        }

    }

//    Delete Web Label
    public function deleteWebLabel(){
        $data = $this->manage_website->deleteWebLabel();
        if ($data == true){
            redirect('dashboard/manageSettings');
        }else{
            redirect('dashboard/manageSettings');
        }
    }
    public function addLogo(){
        $config = array(
            'upload_path' => './uploads/logo/',
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
                'logo' => $file['file_name']
            );
            $checkdata = $this->db->get('websetting');

            if ($checkdata->num_rows() > 0){

                $this->session->set_flashdata(array(
                    'logo' => 'Web Logo has been Uploaded'
                ));

                $this->db->update('websetting',$data);
            }else{
                $this->session->set_flashdata(array(
                    'logo' => 'Web Logo has been Uploaded'
                ));
                $this->db->insert('websetting',$data);
            }

            //     Inserting Logs

            $user = $this->session->userdata('authorization');

            $logs = array(
                'user' => $user,
                'activity' => $user . " , Website icon has been changed." ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);

            redirect('dashboard/manageSettings');

        }else{

            $this->session->set_flashdata(array(
                'error' => $this->upload->display_errors(),
            ));
            redirect('dashboard/manageSettings');
        }

    }

//    Delete Logo
    public function deleteLogo(){
        $data = $this->manage_website->deleteLogo();
        if ($data == true){
            redirect('dashboard/manageSettings');
        }else{
            redirect('dashboard/manageSettings');
        }
    }

    public function addBanner(){
        $config = array(
            'upload_path' => './uploads/banner/',
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
                'banner' => $file['file_name']
            );
            $checkdata = $this->db->get('websetting');

            if ($checkdata->num_rows() > 0){

                $this->session->set_flashdata(array(
                    'banner' => 'Web Banner has been Uploaded'
                ));

                $this->db->update('websetting',$data);
            }else{
                $this->session->set_flashdata(array(
                    'banner' => 'Web Banner has been Uploaded'
                ));
                $this->db->insert('websetting',$data);
            }

            //     Inserting Logs

            $user = $this->session->userdata('authorization');

            $logs = array(
                'user' => $user,
                'activity' => $user . " , Website icon has been changed." ,
                'datetime' => date('Y-m-d H:i:s')
            );

            $this->db->insert('activity_logs',$logs);

            redirect('dashboard/manageSettings');

        }else{

            $this->session->set_flashdata(array(
                'error' => $this->upload->display_errors(),
            ));
            redirect('dashboard/manageSettings');
        }


    }

//    Delete Banner
    public function deleteBanner(){
        $data = $this->manage_website->deleteBanner();
        if ($data == true){
            redirect('dashboard/manageSettings');
        }else{
            redirect('dashboard/manageSettings');
        }
    }
//    Footer Settings
    public function footerSettings(){

        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/footer_settings',
            'footer_data' => $this->footer_model->getFooter(),
            'check_data' => $this->footer_model->checkFooterData()
        );
        $this->load->view('backend/layout',$data);
    }

    public function manageFooter(){
        $company = $this->input->post('company');
        $message = $this->input->post('message');
        $year = $this->input->post('year');

        $data = $this->footer_model->manageFooter($company,$message,$year);

        if($data == true){
            redirect('dashboard/footerSettings');

        }else{
            redirect('dashboard/footerSettings');
        }

    }

//    Delete Footer
    public function deleteFooter(){

        $id = $this->input->post('footer');

        $this->footer_model->deleteFooter($id);

        redirect('dashboard/footerSettings');
    }

//    Contact Detail Settings
    public function manageContact(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/manageContact',
            'contact' => $this->manage_website->getContactDetails(),
            'check_contact' => $this->manage_website->checkContact()
        );
        $this->load->view('backend/layout',$data);
    }

    public function contactSettings(){
        $school = $this->input->post('school');
        $location = $this->input->post('location');
        $email = $this->input->post('email');
        $number = $this->input->post('number');

        $data = $this->manage_website->contactDetails($school,$location,$email,$number);

        if ($data){
            $this->session->set_flashdata(array(
                'contact' => 'Contact Detail has been Updated'
            ));
            redirect('dashboard/manageContact');
        }else{
            $this->session->set_flashdata(array(
                'failed' => 'Insertion Failed'
            ));
            redirect('dashboard/manageContact');
        }

    }


//    Registrar's Menus
//    Add Staff
    public function addStaff(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/registrar/add_staff',
        );
        $this->load->view('backend/layout',$data);
    }

    public function newAccountforStaff(){
        $this->form_validation->set_rules('complete_name','Complete Name','trim|required');
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('email','Email','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm','Confirm Password','trim|required|min_length[6]|matches[password]');

        if ($this->form_validation->run() == FALSE){

            $this->session->set_flashdata(array(
                'errors' => validation_errors()
            ));
            redirect('dashboard/addStaff');

        }else{
            $c_name = $this->input->post('complete_name');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $data = $this->new_user->addStaff($c_name,$email,$username,$password);
            if ($data == true){
                $this->session->set_flashdata(array(
                    'success' => 'New account created'
                ));
                redirect('dashboard/addStaff');
            }else{
                redirect('dashboard/addStaff');
            }
        }
    }
//    Add Instructor

    public function addInstructor(){

        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/registrar/add_instructor',
        );
        $this->load->view('backend/layout',$data);
    }

    public function addNewAccount(){

        $this->form_validation->set_rules('fname','Firstname','trim|required');
        $this->form_validation->set_rules('lname','Lastname','trim|required');
        $this->form_validation->set_rules('email','Email','trim|required');

        if ($this->form_validation->run() == FALSE){

            $this->session->set_flashdata(array(
                'errors' => validation_errors()
            ));
            redirect('dashboard/addInstructor');
        }else{
            $id_no = $this->input->post('id_no');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $email = $this->input->post('email');


            $data = $this->new_user->addNewInstructor($id_no,$fname,$lname,$email);

            if ($data == true){
                $this->session->set_flashdata(array(
                    'success' => 'New instructor account created'
                ));
                redirect('dashboard/addInstructor');
            }else{
                redirect('dashboard/addInstructor');
            }
        }
    }

    public function addStudentsPage(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/registrar/add_student',
        );
        $this->load->view('backend/layout',$data);
    }

    public function addStudentsAccount(){
        $this->form_validation->set_rules('fname','Firstname','trim|required');
        $this->form_validation->set_rules('lname','Lastname','trim|required');
        $this->form_validation->set_rules('email','Email','trim|required');
        $this->form_validation->set_rules('course','Course','trim|required');
        $this->form_validation->set_rules('year','Year Level','trim|required');

        if ($this->form_validation->run() == FALSE){

            $this->session->set_flashdata(array(
                'errors' => validation_errors()
            ));
            redirect('dashboard/addInstructor');
        }else{
            $id_number = $this->input->post('ID');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $email = $this->input->post('email');
            $course = $this->input->post('course');
            $year = $this->input->post('year');

            $data = $this->new_user->addNewStudent($id_number,$fname,$lname,$email,$course,$year);

            if ($data == true){
                $this->session->set_flashdata(array(
                    'success' => 'New account for student created'
                ));
                redirect('dashboard/addStudentsPage');
            }else{
                redirect('dashboard/addStudentsPage');
            }
        }
    }


    public function studentManagement(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'get_users' => $this->user_management->getAllStudents(),
            'content' => 'backend/registrar/students',
        );
        $this->load->view('backend/layout',$data);
    }

    public function deleteStudent(){
        $std_id = $this->input->post('checkbox');

        foreach ($std_id as $id){
            $data = $this->user_management->deleteStudentAccount($id);
            if ($data == false){
                $this->session->set_flashdata('student_delete','This student is already enrolled.');
            }
        }
        redirect('dashboard/studentManagement');

    }

    public function instructorManagement(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'get_users' => $this->user_management->getAllInstructor(),
            'content' => 'backend/registrar/instructor',
        );
        $this->load->view('backend/layout',$data);
    }

    public function getInstructorsID(){
        if (isset($_POST['instructor_id']) && $_POST['instructor_id'] != ''){
            $instructor_id = $this->input->post('instructor_id');
            $data = $this->db->get_where('endusers',array(
                'id' => $instructor_id
            ));
            $id_number = $data->row()->id_number;
            $fname = $data->row()->firstname;
            $lname = $data->row()->lastname;
            $email = $data->row()->email;
            $id = $data->row()->id;


            $std = new stdClass();
            $std->fname = $fname;
            $std->lname = $lname;
            $std->email = $email;
            $std->id_number = $id_number;
            $std->id = $id;

            echo json_encode($std);
        }
    }

    public function editInstructorsData(){
        $instructor_id = $this->input->post('ins_id');
        $id_number = $this->input->post('id_no');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $email = $this->input->post('email');

        $data = $this->user_management->editInstructorsData($instructor_id,$id_number,$fname,$lname,$email);
        if ($data == true){
            $this->session->set_flashdata('ins_updated','The changes has been done.');
            redirect('dashboard/instructorManagement');
        }else{
            $this->session->set_flashdata('ins_failed','The ID number already exist.');
            redirect('dashboard/instructorManagement');
        }
    }

    public function deactivateInstructor(){
        $instructor_id = $this->input->post('instructor_id');

        $data = $this->user_management->deactivateInstructor($instructor_id);
        if ($data == true){
            $this->session->set_flashdata('deactivated','Account has been Deactivated.');
            redirect('dashboard/instructorManagement');
        }else{
            $this->session->set_flashdata('failed_deactivate','Something is wrong.');
            redirect('dashboard/instructorManagement');
        }
    }

    public function activateInstructor(){
        $instructor_id = $this->input->post('instructor_id');

        $data = $this->user_management->activateInstructor($instructor_id);
        if ($data == true){
            $this->session->set_flashdata('activated','Account has been Activated.');
            redirect('dashboard/instructorManagement');
        }else{
            $this->session->set_flashdata('failed_activate','Something is wrong.');
            redirect('dashboard/instructorManagement');
        }
    }

    public function getStudentID(){
        if (isset($_POST['student_id']) && $_POST['student_id'] != ''){
            $student_id = $this->input->post('student_id');
            $data = $this->db->get_where('endusers',array(
                'id' => $student_id
            ));
            $id_number = $data->row()->id_number;
            $fname = $data->row()->firstname;
            $lname = $data->row()->lastname;
            $email = $data->row()->email;
            $course = $data->row()->course;
            $year = $data->row()->year;
            $id = $data->row()->id;


            $std = new stdClass();
            $std->fname = $fname;
            $std->lname = $lname;
            $std->email = $email;
            $std->course = $course;
            $std->year = $year;
            $std->id_number = $id_number;
            $std->id = $id;

            echo json_encode($std);;
        }
    }

    public function getStudentByID(){
        if (isset($_POST['student_id']) && $_POST['student_id'] != ''){
            $student_id = $this->input->post('student_id');
            $data = $this->db->get_where('endusers',array(
                'id' => $student_id
            ));
            $get_info = $this->db->get_where('user_info',array(
                'user_id' => $student_id
            ));

            $city = $get_info->row()->current_city;
            $hometown = $get_info->row()->hometown;
            $mobile = $get_info->row()->mobile;
            $address = $get_info->row()->address;
            $birth = $get_info->row()->birthdate;
            $gender = $get_info->row()->gender;

            $id = $data->row()->id;


            $std = new stdClass();
            $std->id = $id;
            $std->city = $city;
            $std->hometown = $hometown;
            $std->mobile = $mobile;
            $std->address = $address;
            $std->birth = $birth;
            $std->gender = $gender;

            echo json_encode($std);
        }
    }

    public function personalInfo(){
        $user = $this->input->post('studend_id');
        $city = $this->input->post('city');
        $hometown = $this->input->post('hometown');
        $mobile = $this->input->post('mobile');
        $address = $this->input->post('address');
        $birth = $this->input->post('birth');
        $gender = $this->input->post('gender');

        $data = $this->user_management->personalInfo($user,$city,$hometown,$mobile,$address,$birth,$gender);

        if ($data){
            redirect('dashboard/studentManagement');
        }else{
            redirect('dashboard/studentManagement');
        }

    }

    public function editStudentsData(){
        $student_id = $this->input->post('studend_id');
        $id_number = $this->input->post('id_number');
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $email = $this->input->post('email');
        $course = $this->input->post('course');
        $year = $this->input->post('year');

        $data = $this->user_management->editStudentsData($student_id,$id_number,$fname,$lname,$email,$course,$year);
        if ($data == true){
            $this->session->set_flashdata('stud_updated','The changes has been done.');
            redirect('dashboard/studentManagement');
        }else{
            $this->session->set_flashdata('stud_failed','The ID number already exist.');
            redirect('dashboard/studentManagement');
        }
    }

    public function deactivateStudent(){
        $student_id = $this->input->post('students_id');

        $data = $this->user_management->deactivateStudent($student_id);
        if ($data == true){
            $this->session->set_flashdata('deactivated','Account has been Deactivated.');
            redirect('dashboard/studentManagement');
        }else{
            $this->session->set_flashdata('failed_deactivate','Something is wrong.');
            redirect('dashboard/studentManagement');
        }
    }

    public function activateStudent(){
        $student_id = $this->input->post('students_id');

        $data = $this->user_management->activateStudent($student_id);
        if ($data == true){
            $this->session->set_flashdata('activated','Account has been Activated.');
            redirect('dashboard/studentManagement');
        }else{
            $this->session->set_flashdata('failed_activate','Something is wrong.');
            redirect('dashboard/studentManagement');
        }
    }

//  School Year
    public function addSY(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/registrar/add_sy',
            'sy' => $this->add_subjects->getSY(),
            'subjects' => $this->add_subjects->getAllSubjects(),
        );
        $this->load->view('backend/layout',$data);
    }

    public function addSchoolYear(){

        $this->form_validation->set_rules('sy','School Year','trim|required|min_length[11]');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata(array(
                'errors' => validation_errors()
            ));

            redirect('dashboard/addSY');

        }else{
            $sy = $this->input->post('sy');
            $data = $this->add_subjects->addSchoolYear($sy);
            if ($data){
                $this->session->set_flashdata(array(
                    'success' => 'Input successful.'
                ));
                redirect('dashboard/addSY');
            }else{
                $this->session->set_flashdata(array(
                    'failed' => 'Input failed.'
                ));
                redirect('dashboard/addSY');
            }
        }
    }

    public function deleteSY(){
        $id = $this->input->post('checkbox');
        foreach ($id as $schoolYear){
            $data = $this->add_subjects->deleteSY($schoolYear);
            if ($data == false){
                $this->session->set_flashdata('sy_delete','Can not Delete School Year. Their are subjects that already assigned.');
            }
        }
        redirect('dashboard/addSY');
    }

//    public function insertSubjectInSY(){
//        $data = array(
//            'user_prof' => $this->profile_model->get_userById(),
//            'content' => 'backend/registrar/insert_subject',
//            'sy' => $this->add_subjects->getSY(),
//            'subjects' => $this->add_subjects->getAllSubjects(),
//        );
//        $this->load->view('backend/layout',$data);
//    }
//
//    public function insertingSubjects(){
//        $year = $this->input->post('year');
//        $semester = $this->input->post('semester');
//        $subject_id = $this->input->post('checkbox');
//
//        foreach ($subject_id as $id){
//            $this->add_subjects->insertingSubjects($year,$semester,$id);
//        }
//        $this->session->set_flashdata(array(
//            'inserted' => 'Subject Inserted'
//        ));
//        redirect('dashboard/insertSubjectInSY');
//    }

    public function getAllSubjects(){
        $query = $this->db->get('class_subjects');
        $sub = $query->result();

        $qry = $this->db->get_where('endusers',array(
            'authorization' => 'instructor'
        ));
        $instructor = $qry->result();
        $subject = '';
        $uri = site_url();
                foreach ($sub as $data) {
                    $subject .= '<tr>';
                    $subject .= '<td style="text-align: center"><input type="checkbox" id='.$data->id .' name="checkbox[]" value='.$data->id .'>';
                    $subject .=  '<label for='.$data->id .'></label></td>';
                    $subject .= '<td>'.$data->semester.'</td>';
                    $subject .= '<td>'.$data->subject_code.'</td>';
                    $subject .= '<td>'.$data->subject_desc .'</td>';
                    $subject .= '<td>'.$data->day .'</td>';
                    $subject .= '<td>'.$data->time .'</td>';
                    if ($instructor != null){
                    foreach ($instructor as $ins){
                        if ($data->instructor_id == $ins->id) {
                           $fname = $ins->firstname;
                           $lname = $ins->lastname;
                        }elseif ($data->instructor_id == NULL || $data->instructor_id == 0){
                            $fname = 'No';
                            $lname = 'Data';
                        }
                    }
                    }else{
                        $fname = 'No';
                        $lname = 'Data';
                    }
                    $subject .= '<td>' . $fname." ".$lname . '</td>';
                    $subject .= '<td style="text-align: center"><a href='. $uri ."dashboard/editSubject?id=". $data->id.'><i class="material-icons">mode_edit</i></a>&nbsp;<a href='. $uri ."dashboard/assignStudents?id=". $data->id.'><i class="material-icons">assignment</i></a>&nbsp;<a href='.$uri."dashboard/removeAssignedInstructor?sub=".$data->id.'><i class="material-icons" id="remove">remove_circle</i></a>&nbsp;<a href="'.$uri."dashboard/listOfStudentsPerSubject?sub=".$data->id.'"><i class="material-icons">list</i></a></td>';
                    $subject .= '</tr>';
                }


        return $subject;
    }

    public function listOfStudentsPerSubject(){
        $id = $this->input->get('sub');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'subject' => $this->add_subjects->subjectGetById($id),
            'content' => 'backend/registrar/listOfstudentPerSubject',
            'instructor' => $this->user_management->getAllInstructor(),
            'students' => $this->user_management->getAllStudents(),
            'student_group' => $this->group->getStudentsGroup($id)
        );
        $this->load->view('backend/layout',$data);
    }


    public function getSubjectBySY(){

        $subject = '';
        $qry = $this->db->get_where('endusers',array(
            'authorization' => 'instructor'
        ));
        $instructor = $qry->result();
        $uri = site_url();

        if (isset($_POST["sy"])){
            if ($_POST["sy"] != ''){
                $array = array(
                    'school_year' => $_POST["sy"],
                    'semester' => $_POST["semester"]
                );
                $this->db->order_by('semester', 'asc');
                $this->db->like($array);
                $sql = $this->db->get('class_subjects');

                $sub = $sql->result();
            }else{
                $sql = $this->db->get('class_subjects');
                $sub = $sql->result();
            }

                foreach ($sub as $data){
                $subject .= '<tr>';
                $subject .= '<td style="text-align: center"><input type="checkbox" id='.$data->id .' name="checkbox[]" value='.$data->id .'>';
                $subject .= '<label for='.$data->id .'></label></td>';
                $subject .= '<td>'.$data->semester.'</td>';
                $subject .= '<td>'.$data->subject_code.'</td>';
                $subject .= '<td>'.$data->subject_desc .'</td>';
                $subject .= '<td>'.$data->day .'</td>';
                $subject .= '<td>'.$data->time .'</td>';
                if ($instructor != null){
                foreach ($instructor as $ins){
                    if ($data->instructor_id == $ins->id) {
                        $fname = $ins->firstname;
                        $lname = $ins->lastname;
                    }elseif ($data->instructor_id == NULL || $data->instructor_id == 0){
                        $fname = 'No';
                        $lname = 'Data';
                    }
                }
                }else{
                    $fname = 'No';
                    $lname = 'Data';
                }
                $subject .= '<td>' . $fname." ".$lname . '</td>';
                $subject .= '<td style="text-align: center"><a href='. $uri ."dashboard/editSubject?id=". $data->id.'><i class="material-icons">mode_edit</i></a>&nbsp;<a href='. $uri ."dashboard/assignStudents?id=". $data->id.'><i class="material-icons">assignment</i></a>&nbsp;<a href='.$uri."dashboard/removeAssignedInstructor?sub=".$data->id.'><i class="material-icons" id="remove">remove_circle</i></a>&nbsp;<a href="'.$uri."dashboard/listOfStudentsPerSubject?sub=".$data->id.'"><i class="material-icons">list</i></a></td>';
                $subject .= '</tr>';
                }

            echo $subject;
        }
    }

//    Add Subjects
    public function addSubject(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'sy' => $this->add_subjects->getSY(),
            'content' => 'backend/registrar/add_subjects',
        );
        $this->load->view('backend/layout',$data);
    }

    public function addNewSubject(){
        $sy = $this->input->post('sy');
        $semester = $this->input->post('semester');
        $subject_code = $this->input->post('subcode');
        $subject_desc = $this->input->post('subdesc');
        $subject_day = $this->input->post('subday');
        $subject_time = $this->input->post('subtime');

        $data = $this->add_subjects->addNewSubjetcs($sy,$semester,$subject_code,$subject_desc,$subject_day,$subject_time);

        if ($data == true){

            $this->session->set_flashdata(array('success' => 'New Subject Created'));
            redirect('dashboard/addSubject');
        }else{
            $this->session->set_flashdata(array('failed' => 'Subject Already exist'));
            redirect('dashboard/addSubject');
        }
    }

    public function subjectSettings(){

        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'subjects' => $this->getAllSubjects(),
            'instructor' => $this->user_management->getAllInstructor(),
            'school_year' => $this->add_subjects->getSY(),
            'content' => 'backend/registrar/subject_list',
        );
        $this->load->view('backend/layout',$data);
    }

    public function subjectList(){
        $sy = $this->input->post('sy');
        $data = $this->add_subject->getSubjectBySY($sy);
        if ($data){
            redirect('dashboard/subjectList');
        }else{
            redirect('dashboard/subjectList');
        }
    }

    public function editSubject(){
        $id = $this->input->get('id');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'subject' => $this->add_subjects->subjectGetById($id),
            'content' => 'backend/registrar/edit_subject'
        );
        $this->load->view('backend/layout',$data);
    }

    public function editingSubject(){
        $id = $this->input->post('id');
        $sub_id = $this->input->post('subject_id');
        $description = $this->input->post('description');
        $day = $this->input->post('day');
        $time = $this->input->post('time');

        $data = $this->add_subjects->editingSubject($id,$sub_id,$description,$day,$time);

        if ($data){
            $this->session->set_flashdata('success','The Subject has been changed.');
            redirect('dashboard/subjectSettings');
        }else{
            $this->session->set_flashdata('failed','Their is an error in changing the subject.');
            redirect('dashboard/subjectSettings');
        }
    }

    public function deleteSubject(){
        $id = $this->input->post('checkbox');
        foreach ($id as $subject){
            $data = $this->add_subjects->deleteSubject($subject);
            if ($data == false){
                $this->session->set_flashdata('failed_delete','Can not Delete Subject. Their are students already enrolled in the Subject.' . "<br>" . 'Their is instructor already assigned in this subject' );
            }
        }
        redirect('dashboard/subjectSettings');
    }

    public function removeAssignedInstructor(){
        $subject_id = $this->input->get('sub');

        $data = $this->add_subjects->removeAssignedInstructor($subject_id);

        if ($data){
            redirect('dashboard/subjectSettings');
        }else{
            redirect('dashboard/subjectSettings');
        }

    }

    public function assignInstructor(){
        $id = $this->input->get('id');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'loaded' => $this->add_subjects->getAllLoadedSubject(),
            'instructor' => $this->user_management->getInstructorById($id),
            'content' => 'backend/registrar/assign_instructor',
        );
        $this->load->view('backend/layout',$data);
    }

    public function assigningInstructor(){
        $user_id = $this->input->post('id');
        $subject = $this->input->post('checkbox');

        foreach ($subject as $sub_id){
            $this->add_subjects->assigningInstructor($user_id,$sub_id);
        }

        redirect('dashboard/subjectSettings');

    }

    public function assignStudents(){
        $id = $this->input->get('id');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'subjects' => $this->add_subjects->getSubjectAssignStudents($id),
            'students_group' => $this->add_subjects->getAssignedSubjects($id),
            'class' => $this->add_subjects->studentsGroup($id),
            'students' => $this->user_management->getAllStudents(),
            'content' => 'backend/registrar/assign_student'
        );
        $this->load->view('backend/layout',$data);
    }

    public function assigningStudent(){
        $subject_id = $this->input->post('subject_id');
        $students = $this->input->post('checkbox');

        foreach ($students as $id){
            $this->add_subjects->assigningStudents($subject_id,$id);
        }

        redirect('dashboard/listOfStudentsPerSubject?sub='.$subject_id);
    }

    public function dropStudents(){
        $subject_id = $this->input->get('sub');
        $students = $this->input->get('id');

        $data = $this->add_subjects->dropStudents($subject_id,$students);
        if ($data == false){
            $this->session->set_flashdata('error_delete','Can not Drop a student.');
            redirect('dashboard/listOfStudentsPerSubject?sub='.$subject_id);
        }else{

            redirect('dashboard/listOfStudentsPerSubject?sub='.$subject_id);
        }

    }

    public function unassignStudents(){
        $subject_id = $this->input->get('sub');
        $students = $this->input->get('id');

        $data = $this->add_subjects->unassignStudents($subject_id,$students);
        if ($data == false){
            $this->session->set_flashdata('error_delete','Can not Remove this student.');
            redirect('dashboard/listOfStudentsPerSubject?sub='.$subject_id);
        }else{

            redirect('dashboard/listOfStudentsPerSubject?sub='.$subject_id);
        }
    }


    public function reports(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/registrar/reports/reports',
            'grades' => $this->grades->getGradingSheet(),
            'students' => $this->user_management->getAllStudents(),
            'subjects' => $this->add_subjects->getAllSubjects(),
            'school_year' => $this->add_subjects->getSY(),
        );
        $this->load->view('backend/layout',$data);
    }

    public function getSubjectByYear(){
        $data = '';
        $uri = site_url();

        if (isset($_POST["school_year"])){
            if ($_POST["school_year"] != ''){
                $semester = $_POST["semester"];
                $array = array(
                    'school_year' => $_POST["school_year"],
                    'semester' => $semester
                );
                $this->db->order_by('semester', 'asc');
                $this->db->like($array);
                $sql = $this->db->get('class_subjects');
                $subject = $sql->result();
            }else{
                $this->db->order_by('semester', 'asc');
                $sql = $this->db->get('class_subjects');
                $subject = $sql->result();
            }

            foreach ($subject as $sub){
                $data .= '<div class="display-subjects">';
                $data .= '<div class="col-md-3" style="text-align: center">';
                $data .= '<span>Semester:&nbsp;'.$sub->semester.'</span>';
                $data .= '</div>';
                $data .= '<div class="col-md-3" style="text-align: center">';
                $data .= '<span>'.$sub->subject_code.'</span>';
                $data .= '</div>';
                $data .= '<div class="col-md-3" style="text-align: center">';
                $data .= '<span>'.$sub->subject_desc.'</span>';
                $data .= '</div>';
                $data .= '<div class="col-md-3">';
                $data .= '<div class="dropdown" style="text-align: right">';
                $data .= '<a style="color: #777777;" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog fa-lg" aria-hidden="true"></i></a>';
                $data .= '<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">';
                $data .= '<li role="presentation"><a style="font-weight: bold;color: #555;" role="menuitem" href="'.$uri.'dashboard/reportsListOfStudentPerSub?subject='.$sub->id.'">&nbsp;Reports</a></li>';
                $data .= '</ul>';
                $data .= '</div>';
                $data .= '</div>';
                $data .= '</div>';
            }

            echo $data;
        }
    }

    public function getSubjectByYearReports(){
        $data = '';
        $uri = site_url();

        if (isset($_POST["school_year"])){
            if ($_POST["school_year"] != ''){
                $semester = $_POST["semester"];
                $array = array(
                    'school_year' => $_POST["school_year"],
                    'semester' => $semester
                );
                $this->db->order_by('semester', 'asc');
                $this->db->like($array);
                $sql = $this->db->get('class_subjects');
                $subject = $sql->result();
            }else{
                $this->db->order_by('semester', 'asc');
                $sql = $this->db->get('class_subjects');
                $subject = $sql->result();
            }

            foreach ($subject as $sub){
                $data .= '<div class="display-subjects">';
                $data .= '<div class="col-md-3" style="text-align: center">';
                $data .= '<span>Semester:&nbsp;'.$sub->semester.'</span>';
                $data .= '</div>';
                $data .= '<div class="col-md-3" style="text-align: center">';
                $data .= '<span>'.$sub->subject_code.'</span>';
                $data .= '</div>';
                $data .= '<div class="col-md-3" style="text-align: center">';
                $data .= '<span>'.$sub->subject_desc.'</span>';
                $data .= '</div>';
                $data .= '<div class="col-md-3">';
                $data .= '<div class="dropdown" style="text-align: right">';
                $data .= '<a style="color: #777777;" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog fa-lg" aria-hidden="true"></i></a>';
                $data .= '<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">';
                $data .= '<li role="presentation"><a style="font-weight: bold;" role="menuitem" href="'.$uri.'dashboard/reportsPrelim?subject='.$sub->id.'" >&nbsp;Prelim</a></li>';
                $data .= '<li role="presentation"><a style="font-weight: bold;" role="menuitem" href="'.$uri.'dashboard/reportsMidterm?subject='.$sub->id.'" >&nbsp;Midterm</a></li>';
                $data .= '<li role="presentation"><a style="font-weight: bold;" role="menuitem" href="'.$uri.'dashboard/reportsPrefinal?subject='.$sub->id.'" >&nbsp;Prefinal</a></li>';
                $data .= '<li role="presentation"><a style="font-weight: bold;" role="menuitem" href="'.$uri.'dashboard/reportsFinals?subject='.$sub->id.'" >&nbsp;Finals</a></li>';
                $data .= '<li role="presentation" class="divider"></li>';
                $data .= '<li role="presentation"><a style="font-weight: bold;" role="menuitem" href="'.$uri.'dashboard/reportsFinalGrade?subject='.$sub->id.'" >&nbsp;Final Grade</a></li>';
                $data .= '</ul>';
                $data .= '</div>';
                $data .= '</div>';
                $data .= '</div>';
            }

            echo $data;
        }
    }


    public function reportsPrelim(){
        $subject_id = $this->input->get('subject');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/registrar/reports/reports_prelim',
            'subjects' => $this->add_subjects->subjectGetById($subject_id),
            'instructor' => $this->user_management->getAllInstructor(),
            'grades' => $this->grades->getPrelimGrade($subject_id),
            'students' => $this->user_management->getStudentsByLastname(),
        );
        $this->load->view('backend/layout',$data);
    }

    public function reportsMidterm(){
        $subject_id = $this->input->get('subject');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/registrar/reports/reports_midterm',
            'subjects' => $this->add_subjects->subjectGetById($subject_id),
            'instructor' => $this->user_management->getAllInstructor(),
            'grades' => $this->grades->getMidtermGrade($subject_id),
            'students' => $this->user_management->getStudentsByLastname(),
        );
        $this->load->view('backend/layout',$data);
    }

    public function reportsPrefinal(){
        $subject_id = $this->input->get('subject');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/registrar/reports/reports_prefinal',
            'subjects' => $this->add_subjects->subjectGetById($subject_id),
            'instructor' => $this->user_management->getAllInstructor(),
            'grades' => $this->grades->getPrefinalGrade($subject_id),
            'students' => $this->user_management->getStudentsByLastname(),
        );
        $this->load->view('backend/layout',$data);
    }

    public function reportsFinals(){
        $subject_id = $this->input->get('subject');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/registrar/reports/reports_finals',
            'subjects' => $this->add_subjects->subjectGetById($subject_id),
            'instructor' => $this->user_management->getAllInstructor(),
            'grades' => $this->grades->getFinalsGrade($subject_id),
            'students' => $this->user_management->getStudentsByLastname(),
        );
        $this->load->view('backend/layout',$data);
    }

    public function reportsFinalGrade(){
        $subject_id = $this->input->get('subject');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/registrar/reports/report_finalgrade',
            'subjects' => $this->add_subjects->subjectGetById($subject_id),
            'grades' => $this->grades->getFinalGrade($subject_id),
            'instructor' => $this->user_management->getAllInstructor(),
            'students' => $this->user_management->getStudentsByLastname(),
        );
        $this->load->view('backend/layout',$data);
    }

    public function listOfStudentPerSubject(){
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/registrar/reports/list_of_student',
            'grades' => $this->grades->getGradingSheet(),
            'students' => $this->user_management->getAllStudents(),
            'instructor' => $this->user_management->getAllInstructor(),
            'subjects' => $this->add_subjects->getAllSubjects(),
            'school_year' => $this->add_subjects->getSY(),
        );
        $this->load->view('backend/layout',$data);
    }

    public function reportsListOfStudentPerSub(){
        $subject_id = $this->input->get('subject');
        $data = array(
            'user_prof' => $this->profile_model->get_userById(),
            'content' => 'backend/registrar/reports/studentsPerSubject',
            'subjects' => $this->add_subjects->subjectGetById($subject_id),
            'instructor' => $this->user_management->getAllInstructor(),
            'grades' => $this->grades->getFinalsGrade($subject_id),
            'students' => $this->user_management->getStudentsByLastname(),
            'student_group' => $this->group->getStudentsGroup($subject_id)
        );
        $this->load->view('backend/layout',$data);
    }

}
