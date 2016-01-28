<div class="products view">
<div class="addNewButton" style="float:none;">
         <?php echo $this->Html->link(__('Back to Product'), array('action' => 'index'),array('class' => 'btn btn-primary','type'=>'button')); ?>
         
         <?php echo $this->Html->link(__('Add Product'), array('action' => 'add'),array('class' => 'btn btn-primary','type'=>'button')); ?>
    </div>

<h2><?php echo __('Product'); ?></h2>
	<dl>
		<?php /*?><dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd><?php */?>
		<?php /*?><dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($product['User']['id'], array('controller' => 'users', 'action' => 'view', $product['User']['id'])); ?>
			&nbsp;
		</dd><?php */?>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($product['Product']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($product['Product']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vendor'); ?></dt>
		<dd>
			<?php echo h($product['Product']['vendor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($product['Product']['type']); ?>
			&nbsp;
		</dd>
		<?php /*?><dt><?php echo __('Tags'); ?></dt>
		<dd>
			<?php echo h($product['Product']['tags']); ?>
			&nbsp;
		</dd><?php */?>
		<?php /*?><dt><?php echo __('Publish'); ?></dt>
		<dd>
			<?php echo h($product['Product']['publish']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($product['Product']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('List Price'); ?></dt>
		<dd>
			<?php echo h($product['Product']['list_price']); ?>
			&nbsp;
		</dd><?php */?>
		<dt><?php echo __('Sku'); ?></dt>
		<dd>
			<?php echo h($product['Product']['sku']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Barcode'); ?></dt>
		<dd>
			<?php echo h($product['Product']['barcode']); ?>
			&nbsp;
		</dd>
		<?php /*?><dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($product['Product']['quantity']); ?>
			&nbsp;
		</dd>
<?php */?>		<dt><?php echo __('Weight'); ?></dt>
		<dd>
			<?php echo h($product['Product']['weight']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Variants'); ?></dt>
		<dd>
			<?php echo h($product['Product']['variants']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Attributes'); ?></dt>
		<dd>
			<?php echo h($product['Product']['attributes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Values'); ?></dt>
		<dd>
			<?php echo h($product['Product']['values']); ?>
			&nbsp;
		</dd>
		<?php /*?><dt><?php echo __('Tax'); ?></dt>
		<dd>
			<?php echo h($product['Product']['tax']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Shipping'); ?></dt>
		<dd>
			<?php echo h($product['Product']['shipping']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Published At'); ?></dt>
		<dd>
			<?php echo h($product['Product']['published_at']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated At'); ?></dt>
		<dd>
			<?php echo h($product['Product']['updated_at']); ?>
			&nbsp;
		</dd><?php */?>
	</dl>
</div>
<?php /*?><div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product'), array('action' => 'delete', $product['Product']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['Product']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inventories'), array('controller' => 'inventories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inventory'), array('controller' => 'inventories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Varies'), array('controller' => 'varies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vary'), array('controller' => 'varies', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Inventories'); ?></h3>
	<?php if (!empty($product['Inventory'])): ?>
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
	<?php foreach ($product['Inventory'] as $inventory): ?>
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
	<h3><?php echo __('Related Varies'); ?></h3>
	<?php if (!empty($product['Vary'])): ?>
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
	<?php foreach ($product['Vary'] as $vary): ?>
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
</div><?php */?>
