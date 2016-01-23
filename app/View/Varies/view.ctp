<div class="varies view">
<h2><?php echo __('Vary'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($vary['Vary']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vary['User']['id'], array('controller' => 'users', 'action' => 'view', $vary['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inventory'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vary['Inventory']['id'], array('controller' => 'inventories', 'action' => 'view', $vary['Inventory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($vary['Product']['title'], array('controller' => 'products', 'action' => 'view', $vary['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($vary['Vary']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchase Price'); ?></dt>
		<dd>
			<?php echo h($vary['Vary']['purchase_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sale Price'); ?></dt>
		<dd>
			<?php echo h($vary['Vary']['sale_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attribute'); ?></dt>
		<dd>
			<?php echo h($vary['Vary']['attribute']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($vary['Vary']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($vary['Vary']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created At'); ?></dt>
		<dd>
			<?php echo h($vary['Vary']['created_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified At'); ?></dt>
		<dd>
			<?php echo h($vary['Vary']['modified_At']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vary'), array('action' => 'edit', $vary['Vary']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Vary'), array('action' => 'delete', $vary['Vary']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vary['Vary']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Varies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vary'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventories'), array('controller' => 'inventories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
