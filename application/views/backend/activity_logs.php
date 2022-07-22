<form action="<?php echo site_url();?>dashboard/deleteLogs" method="post">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <button type="submit" onclick="return confirm('Are you sure you want clear all the logs?')" id="delete" name="delete" style="float: right"  class="btn btn-primary">Clear Logs &nbsp;<i class="fa fa-trash-o" aria-hidden="true"></i></button>
                    <h2>
                        Activity Logs
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Activity</th>
                                <th>Date & Time</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($show_logs as $log){?>
                                    <?php $date = date_create($log->datetime); ?>
                                <tr>
                                    <td><?php echo $log->user?></td>
                                    <td><p><?php echo $log->activity;?></p></td>
                                    <td><?php echo date_format($date,'M d, Y h:i:s A') ?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>