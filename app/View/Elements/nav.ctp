<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            
            <?php echo $this->Html->link(__('Yes Medics'), array('controller' => 'products'),array('class' => 'navbar-brand')); ?>
            
            <div class="navbar-header" style="padding-left: 50px;">
              <?php echo $this->Html->link(__('Home'), array('controller' => 'products','action'=>'index'),array('class' => 'navbar-brand')); ?>
              <?php echo $this->Html->link(__('(1) Order List'), array('controller' => 'inventories','action'=>'index','order'),array('class' => 'navbar-brand')); ?>
              <?php echo $this->Html->link(__('(2) FulFillment List'), array('controller' => 'inventories','action'=>'index','fulfillment'),array('class' => 'navbar-brand')); ?>
              <?php echo $this->Html->link(__('(3) Sale List'), array('controller' => 'inventories','action'=>'index','sale'),array('class' => 'navbar-brand')); ?>
            </div>
            <?php echo $this->element('nav_right'); ?>        
            <!-- /.navbar-static-side -->
        </nav>