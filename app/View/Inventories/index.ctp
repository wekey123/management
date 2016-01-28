<style>
tr {
    border-bottom: 0px solid black;
    border-collapse: collapse;
}
</style>
<div id="page-wrapper">

   <div class="row">
        <div class="col-lg-12">
        <?php 	echo $this->Session->flash(); ?>
        </div>
    </div>

    <div class="row">
    
    <div class="col-lg-12">
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?php echo __('Inventory '.$this->request->params['pass'][0]); ?></h4> <span>(Shows only last <?php echo $records;?> days Records.)<span>
        </div>
   	    <div class="panel-body">
     	   <div class="dataTable_wrapper">
            <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" id="dataTables-example" style="margin-top:15px;">
	<thead>
	<tr>
			<th><?php echo h('Title'); ?></th>
            <th><?php echo h('Total Qty'); ?></th>
			<th><?php echo h('Total Purchase Price'); ?></th>
			<th><?php echo h('Total Sales Price'); ?></th>
            <th><?php echo h('Date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php $total_Quantity = '';$total_purchase_price = '';$total_sale_price = ''; foreach ($inventories as $inventory): ?>
	<tr>
		<td><?php echo h($inventory['Product']['title']); ?>&nbsp;</td>
        
		<td><?php echo $quantity = (!empty($inventory['Inventory']['quantity'])) ? $inventory['Inventory']['quantity'] : 0;  
		$total_Quantity += $quantity; ?>&nbsp;</td>
        
		<td><?php $purchase_price = (!empty($inventory['Inventory']['purchase_price'])) ? $inventory['Inventory']['purchase_price'] : 0; echo '$'.$purchase_price; 
		
		$total_purchase_price += $purchase_price; ?>&nbsp;</td>
        <td><?php $sale_price = (!empty($inventory['Inventory']['sale_price'])) ? $inventory['Inventory']['sale_price'] : 0; echo '$'.$sale_price;
		
		$total_sale_price += $sale_price; ?>&nbsp;</td>
        
         <td><?php echo  date('m-d-Y', strtotime($inventory['Inventory']['created']));?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $inventory['Inventory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $inventory['Inventory']['id'])); ?>
		</td>
        
	</tr>
<?php endforeach; ?>
		<tr><td><b>Total: </b></td><td><?php echo $total_Quantity;?>&nbsp;</td> <td><?php echo '$'.$total_purchase_price;?>&nbsp;</td> <td><?php echo '$'.$total_sale_price;?>&nbsp;</td><td colspan="2">&nbsp;</td></tr>
	</tbody>
	</table>
    
   			   </div>
       		</div>
		 </div>
	   </div>
	</div>
</div>