<div class="container" style="padding-top: 55px;">
    <div class="grading-sidebar">
        <ul class="menu-list">
            <li><a href="<?php echo site_url()?>grading_sheet" class="active-link"><i class="fa fa-table" aria-hidden="true"></i> &nbsp;&nbsp;Grading Sheet</a></li>
        </ul>
    </div>
    <div class="grading-content">
        <div class="grade-header">
            <h4>Grading Sheet</h4>
        </div>
        <div class="grade-container">
            <?php
            if ($this->session->userdata('authorization') == 'instructor'){
                $data = array(
                    'class_group' => $this->group->getCG(),
                    'subjects' => $this->add_subjects->getAllSubjects(),
                    'students' => $this->group->getStudentGroup()
                );
                $this->load->view('frontend/main/grading_sheet/group_list',$data);
            }else{
                $data = array(
                    'class_group' => $this->group->getAllGroups(),
                    'subjects' => $this->add_subjects->getAllSubjects(),
                    'students' => $this->group->getStudentGroup()
                );
                $this->load->view('frontend/main/grading_sheet/student_grade',$data);
            }
            ?>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>