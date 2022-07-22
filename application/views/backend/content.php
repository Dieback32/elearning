<?php if ($this->session->flashdata('success')):?>
<div class="alert alert-success">
    <strong><i class="fa fa-check fa-2x" aria-hidden="true"></i> &nbsp;Success!</strong> <?php echo $this->session->flashdata('success');?>
</div>
<?php endif;?>
<h2 class="text-uppercase">Welcome Back <?php echo $this->session->userdata('authorization')?></h2>
<p>This is the Dashboard Page. You can use all the available features here. You can Create,Read,Update and Delete (CRUD).</p>
<p>All the features are available for you to use. That is needed to maintain the website.</p>
<p>Dashboards can be broken down according to role and are either strategic, analytical, operational, or informational.
    Strategic dashboards support managers at any level in an organization, and provide the quick overview that decision makers need to monitor the health and opportunities of the business.
    Dashboards of this type focus on high level measures of performance, and forecasts.
    Strategic dashboards benefit from static snapshots of data (daily, weekly, monthly, and quarterly) that are not constantly changing from one moment to the next.
    Dashboards for analytical purposes often include more context, comparisons, and history, along with subtler performance evaluators.
    Analytical dashboards typically support interactions with the data, such as drilling down into the underlying details.
    Dashboards for monitoring operations are often designed differently from those that support strategic decision making or
    data analysis and often require monitoring of activities and events that are constantly changing and might require attention
    and response at a moment's notice</p>