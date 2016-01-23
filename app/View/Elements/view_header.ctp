<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12">
        <?php 	echo $this->Session->flash('success');echo $this->Session->flash('error');echo $this->Session->flash('warning');echo $this->Session->flash('notice');?>
            <?php //echo $this->Html->link(__('New User'), array('action' => 'add','type'=>'button','class'=>'btn btn-primary')); ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
    <div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo __('Users'); ?>
        </div>