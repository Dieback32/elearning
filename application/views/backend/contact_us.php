<?php
if ($this->session->userdata('authorization') != 'admin'){
    redirect('dashboard');
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>People who contact us</h2>
            </div>
            <div class="body table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($contact_us != null){ ?>
                    <?php foreach ($contact_us as $contact): ?>
                        <tr>
                            <th scope="row"><?php echo $contact->id?></th>
                            <td><?php echo $contact->email?></td>
                            <td><?php echo $contact->info_data?></td>
                        </tr>
                    <?php endforeach; }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


