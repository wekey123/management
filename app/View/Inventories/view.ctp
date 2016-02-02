<div class="inventories view" id="page-wrapper">
<div class="addNewButton" style="float:none;">
	 <?php echo $this->Html->link(__('Back to Inventory'), array('action' => 'index'),array('class' => 'btn btn-primary','type'=>'button')); ?>
     <?php echo $this->Html->link(__('Add Inventory'), array('action' => 'add'),array('class' => 'btn btn-primary','type'=>'button')); ?>
</div>
<div class="row">
        <div class="col-lg-12">
            <fieldset><legend><?php echo __('Inventory'); ?></legend>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($inventory['User']['id'], array('controller' => 'users', 'action' => 'view', $inventory['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($inventory['Product']['title'], array('controller' => 'products', 'action' => 'view', $inventory['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchase Price'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['purchase_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sale Price'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['sale_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Variant'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['variant']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($inventory['Inventory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
    </fieldset>
    </div>

    <br /> <br />

<div class="col-lg-12">
     
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo __('Related Varies'); ?>
        </div>
	<?php if (!empty($inventory['Vary'])): ?>
    <div class="panel-body">
     	   <div class="dataTable_wrapper">
	 <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered gtable table-hover" id="dataTables-example" style="margin-top:15px;">
	<tr>
		<?php /*?><!--<th><?php echo __('Id'); ?></th>--><?php */?>
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
	<?php foreach ($inventory['Vary'] as $vary): ?>
		<tr>
			<?php /*?><td><?php echo $vary['id']; ?></td><?php */?>
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
     </div>
       		</div>
		
	   
<?php endif; ?>
</div> </div>
</div>	
</div>
