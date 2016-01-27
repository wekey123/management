<div id="page-wrapper">
<?php echo $this->Form->create('Product'); ?>
	<div class="addNewButton" style="float:none;">
         <?php echo $this->Html->link(__('Back to Product'), array('action' => 'index'),array('class' => 'btn btn-primary','type'=>'button')); ?>
        
    </div>
	<fieldset>
		<legend><?php echo __('Edit Product'); ?></legend>
        <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
            	<div class="panel-heading">Products</div>              
                <div class="panel-body"> 
		
	<?php //echo '<pre>';print_r($this->request->data);exit;
		echo $this->Form->input('id');
		//echo $this->Form->input('user_id');
		echo $this->Form->input('title',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('description',array('div'=>false,'error'=>false,'type'=>'textarea', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('vendor',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('type',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('tags',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>'0'));
		echo $this->Form->input('publish',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>'1'));
		echo $this->Form->input('price',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>0));
		echo $this->Form->input('list_price',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>0));
		echo $this->Form->input('sku',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('barcode',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('quantity',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>0));
		echo $this->Form->input('weight',array('div'=>false,'error'=>false,'type'=>'text', 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control'));
		echo $this->Form->input('variants',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>0));
		echo $this->Form->input('attributes',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>0,'id'=>'tagVarients'));
		echo $this->Html->tag('label', 'Variants');
						echo  '<ul id="eventTags">';
						$attributes=explode(',',$this->request->data['Product']['attributes']);
						 foreach($attributes as $optlist){
				?>
                <li><?php echo $optlist; ?> </li>
                <?php 
				 }echo '</ul>';
		echo $this->Html->tag('label', 'Values');
		echo  '<ul id="mySingleFieldTags">';
		$values=explode(',',$this->request->data['Product']['values']);
						 foreach($values as $optlist){
				?>
                <li><?php echo $optlist; ?> </li>
                <?php 
				 }echo '</ul>';
		echo $this->Form->input('values',array('div'=>false,'error'=>false,'type'=>'hidden','value'=>0,'id'=>'tagValues'));
	?></div>
            </div>
		</div>
    </div>
	</fieldset>
<?php echo $this->Form->submit(__('Submit'),array('div'=>false, 'class'=>'btn btn-lg btn-success btn-block' ,'id' => 'getVarientValue')); echo $this->Form->end();	?>
</div>
<?php /*?><div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Product.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Product.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventories'), array('controller' => 'inventories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Varies'), array('controller' => 'varies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vary'), array('controller' => 'varies', 'action' => 'add')); ?> </li>
	</ul>
</div><?php */?>
