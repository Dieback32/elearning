<div class="class-container container">
    <div class="group-sidebar">
        <ul class="menu-list">
            <?php if ($this->session->userdata('authorization') == 'instructor'){ ?>
            <li><a href="#select_group" class="select-group active-link"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp;Class Group</a></li>
            <?php }elseif ($this->session->userdata('authorization') == 'student'){ ?>
            <li><a href="#select_group" class="student-group active-link"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;&nbsp;Class Group</a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="group-content">
        <?php if ($this->session->flashdata('success')){ ?>
            <div class="alert alert-success alert-dismissable fade in" style="margin: 0 30px 0 30px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> <?php echo ($this->session->flashdata('success'));?>
            </div>
        <?php }elseif ($this->session->flashdata('joined')){ ?>
            <div class="alert alert-success alert-dismissable fade in" style="margin: 0 30px 0 30px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> <?php echo ($this->session->flashdata('joined'));?>
            </div>
        <?php }elseif ($this->session->flashdata('invalid')){ ?>
            <div class="alert alert-danger alert-dismissable fade in" style="margin: 0 30px 0 30px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error!</strong> <?php echo ($this->session->flashdata('invalid'));?>
            </div>
        <?php } ?>
        <div >
          <?php
            if ($this->session->userdata('authorization') == 'instructor'){
              $data = array(
                  'class_group' => $this->group->getCG(),
                  'class_subject' => $this->add_subjects->getAllSubjects(),
                  'students' => $this->group->getStudentGroup()
              );
              $this->load->view('frontend/main/classgroup/select_group',$data);
            }else{
                $data = array(
                    'class_group' => $this->group->getAllGroups(),
                    'class_subject' => $this->add_subjects->getAllSubjects(),
                    'students' => $this->group->getStudentGroup()
                );
                $this->load->view('frontend/main/classgroup/students_group',$data);
            }
          ?>
        </div>
    </div>
</div>
<?php $this->load->view('frontend/main/footer/footer');?>