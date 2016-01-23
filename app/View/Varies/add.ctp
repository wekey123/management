<div class="varies form">
<?php echo $this->Form->create('Vary'); ?>
	<fieldset>
		<legend><?php echo __('Add Vary'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('inventory_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('quantity');
		echo $this->Form->input('purchase_price');
		echo $this->Form->input('sale_price');
		echo $this->Form->input('attribute');
		echo $this->Form->input('value');
		echo $this->Form->input('type');
		echo $this->Form->input('created_at');
		echo $this->Form->input('modified_At');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Varies'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventories'), array('controller' => 'inventories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
