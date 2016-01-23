<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($user['User']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo'); ?></dt>
		<dd>
			<?php echo h($user['User']['photo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Privilages'); ?></dt>
		<dd>
			<?php echo h($user['User']['privilages']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Publish'); ?></dt>
		<dd>
			<?php echo h($user['User']['publish']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Published At'); ?></dt>
		<dd>
			<?php echo h($user['User']['published_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated At'); ?></dt>
		<dd>
			<?php echo h($user['User']['updated_at']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventories'), array('controller' => 'inventories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Varies'), array('controller' => 'varies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vary'), array('controller' => 'varies', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Inventories'); ?></h3>
	<?php if (!empty($user['Inventory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Purchase Price'); ?></th>
		<th><?php echo __('Sale Price'); ?></th>
		<th><?php echo __('Variant'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Inventory'] as $inventory): ?>
		<tr>
			<td><?php echo $inventory['id']; ?></td>
			<td><?php echo $inventory['user_id']; ?></td>
			<td><?php echo $inventory['product_id']; ?></td>
			<td><?php echo $inventory['quantity']; ?></td>
			<td><?php echo $inventory['purchase_price']; ?></td>
			<td><?php echo $inventory['sale_price']; ?></td>
			<td><?php echo $inventory['variant']; ?></td>
			<td><?php echo $inventory['type']; ?></td>
			<td><?php echo $inventory['created']; ?></td>
			<td><?php echo $inventory['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'inventories', 'action' => 'view', $inventory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'inventories', 'action' => 'edit', $inventory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'inventories', 'action' => 'delete', $inventory['id']), array('confirm' => __('Are you sure you want to delete # %s?', $inventory['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Products'); ?></h3>
	<?php if (!empty($user['Product'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Vendor'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Tags'); ?></th>
		<th><?php echo __('Publish'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('List Price'); ?></th>
		<th><?php echo __('Sku'); ?></th>
		<th><?php echo __('Barcode'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Weight'); ?></th>
		<th><?php echo __('Variants'); ?></th>
		<th><?php echo __('Attributes'); ?></th>
		<th><?php echo __('Values'); ?></th>
		<th><?php echo __('Tax'); ?></th>
		<th><?php echo __('Shipping'); ?></th>
		<th><?php echo __('Published At'); ?></th>
		<th><?php echo __('Updated At'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Product'] as $product): ?>
		<tr>
			<td><?php echo $product['id']; ?></td>
			<td><?php echo $product['user_id']; ?></td>
			<td><?php echo $product['title']; ?></td>
			<td><?php echo $product['description']; ?></td>
			<td><?php echo $product['vendor']; ?></td>
			<td><?php echo $product['type']; ?></td>
			<td><?php echo $product['tags']; ?></td>
			<td><?php echo $product['publish']; ?></td>
			<td><?php echo $product['price']; ?></td>
			<td><?php echo $product['list_price']; ?></td>
			<td><?php echo $product['sku']; ?></td>
			<td><?php echo $product['barcode']; ?></td>
			<td><?php echo $product['quantity']; ?></td>
			<td><?php echo $product['weight']; ?></td>
			<td><?php echo $product['variants']; ?></td>
			<td><?php echo $product['attributes']; ?></td>
			<td><?php echo $product['values']; ?></td>
			<td><?php echo $product['tax']; ?></td>
			<td><?php echo $product['shipping']; ?></td>
			<td><?php echo $product['published_at']; ?></td>
			<td><?php echo $product['updated_at']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'products', 'action' => 'view', $product['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'products', 'action' => 'edit', $product['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'products', 'action' => 'delete', $product['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Varies'); ?></h3>
	<?php if (!empty($user['Vary'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Inventory Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Purchase Price'); ?></th>
		<th><?php echo __('Sale Price'); ?></th>
		<th><?php echo __('Attribute'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Created At'); ?></th>
		<th><?php echo __('Modified At'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Vary'] as $vary): ?>
		<tr>
			<td><?php echo $vary['id']; ?></td>
			<td><?php echo $vary['user_id']; ?></td>
			<td><?php echo $vary['inventory_id']; ?></td>
			<td><?php echo $vary['product_id']; ?></td>
			<td><?php echo $vary['quantity']; ?></td>
			<td><?php echo $vary['purchase_price']; ?></td>
			<td><?php echo $vary['sale_price']; ?></td>
			<td><?php echo $vary['attribute']; ?></td>
			<td><?php echo $vary['value']; ?></td>
			<td><?php echo $vary['type']; ?></td>
			<td><?php echo $vary['created_at']; ?></td>
			<td><?php echo $vary['modified_At']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'varies', 'action' => 'view', $vary['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'varies', 'action' => 'edit', $vary['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'varies', 'action' => 'delete', $vary['id']), array('confirm' => __('Are you sure you want to delete # %s?', $vary['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Vary'), array('controller' => 'varies', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
