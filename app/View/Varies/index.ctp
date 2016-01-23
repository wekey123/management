<div class="varies index">
	<h2><?php echo __('Varies'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('inventory_id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('purchase_price'); ?></th>
			<th><?php echo $this->Paginator->sort('sale_price'); ?></th>
			<th><?php echo $this->Paginator->sort('attribute'); ?></th>
			<th><?php echo $this->Paginator->sort('value'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('created_at'); ?></th>
			<th><?php echo $this->Paginator->sort('modified_At'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($varies as $vary): ?>
	<tr>
		<td><?php echo h($vary['Vary']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($vary['User']['id'], array('controller' => 'users', 'action' => 'view', $vary['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($vary['Inventory']['id'], array('controller' => 'inventories', 'action' => 'view', $vary['Inventory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($vary['Product']['title'], array('controller' => 'products', 'action' => 'view', $vary['Product']['id'])); ?>
		</td>
		<td><?php echo h($vary['Vary']['quantity']); ?>&nbsp;</td>
		<td><?php echo h($vary['Vary']['purchase_price']); ?>&nbsp;</td>
		<td><?php echo h($vary['Vary']['sale_price']); ?>&nbsp;</td>
		<td><?php echo h($vary['Vary']['attribute']); ?>&nbsp;</td>
		<td><?php echo h($vary['Vary']['value']); ?>&nbsp;</td>
		<td><?php echo h($vary['Vary']['type']); ?>&nbsp;</td>
		<td><?php echo h($vary['Vary']['created_at']); ?>&nbsp;</td>
		<td><?php echo h($vary['Vary']['modified_At']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $vary['Vary']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $vary['Vary']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $vary['Vary']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vary['Vary']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Vary'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventories'), array('controller' => 'inventories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
