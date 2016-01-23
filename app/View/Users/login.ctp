<div class="login-panel panel panel-default">
         <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
<?php echo $this->Form->create('User'); ?>
<fieldset>
		<div class="col-lg-12" style="color:#F00; font-size: 14px;">
        	<?php 	echo $this->Session->flash(); ?>
        </div>
        <div>
                 <?php
                echo $this->Form->input('email',array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','placeholder'=>'Username','style'=>'width: 90%;'));
                echo $this->Form->input('password',array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','placeholder'=>'Password','style'=>'width: 90%;'));
                ?>
                <?php echo $this->Form->submit(__('Login'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block'));	?>
        		<br /><!--<div class="forgottabs loginlink"><font>Can't access your account?</font></div>-->
   		</div>
<?php echo $this->Form->end(); ?>
  </div>
                </div>
