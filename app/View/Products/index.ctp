<style>
tr {
    border-bottom: 0px solid black;
    border-collapse: collapse;
}
.Titleactions {
	float:left;
	height:20px;
	margin-top:10px;
	width:160px;
	padding-left:0px;
}
.Titleactions li{
	display:none;	
}
.Titleactions li a.confirdel{
	color:#E80000;
}
.gtable tr:hover ul.Titleactions li{
	display:inline;
}
.Titleactions li{
	position:relative;
}
.rTable {  	display: block;   	width: 100%; } .rTableHeading, .rTableBody, .rTableFoot, .rTableRow{   	clear: both; } .rTableHead, .rTableFoot{   	background-color: #DDD;   	font-weight: bold; } .rTableCell, .rTableHead {   	border: 1px solid #999999;   	float: left;   	height: 30px;   	overflow: hidden;   	padding: 3px 1.8%;   	width: 33%; } .rTable:after {   	visibility: hidden;   	display: block;   	font-size: 0;   	content: " ";   	clear: both;   	height: 0; }
</style>
<div id="page-wrapper">

   <div class="row">
        <div class="col-lg-12">
        <?php 	echo $this->Session->flash(); ?>
        </div>
    </div>

    <div class="row">
    <div class="col-lg-12 addNewButton">
            <?php echo $this->Html->link(__('New Product'), array('action' => 'add'),array('class' => 'btn btn-primary','type'=>'button')); ?>
        </div>
    <div class="col-lg-12">
     
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo __('Products'); ?>
        </div>
   	    <div class="panel-body">
     	   <div class="dataTable_wrapper">
            <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered gtable table-hover" id="dataTables-example" style="margin-top:15px;">
	<thead>
	<tr>
			<th><?php echo h('Title'); ?></th>
            <th><?php echo h('No.of Order'); ?></th>
			<th><?php echo h('Order Price'); ?></th>
		    <th><?php echo h('No.of Sales'); ?></th>
			<th><?php echo h('Sales Price'); ?></th>
            <th><?php echo h('Product Left'); ?></th>
            <th><?php echo h('Amount Profit'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php 
	if(!empty($products)){
	$i=1;foreach ($products as $product): //echo '<pre>';print_r($product);?>
	<tr>
		<td width="30%"><?php echo h($product['Product']['title']); ?>&nbsp;<br><ul class="Titleactions">
<li><?php echo $this->Html->link(__('View'), array('action' => 'view', $product['Product']['id'])); ?>&nbsp;|&nbsp;</li>
<li><?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id'])); ?>&nbsp;|&nbsp;</li>
<li><?php //echo $this->Html->link(__('Delete'), array('action' => 'delete', $product['Product']['id']),array('class'=>'confirdel')); ?></li>
</ul></td>
        
		<td width="6%"><?php echo $orderQty = (!empty($product['Product']['order_qty'])) ? $product['Product']['order_qty'] : 0; ?>&nbsp;</td>
		<td width="6%"><?php echo (!empty($product['Product']['order_purchase_price'])) ? '$'.$product['Product']['order_purchase_price'] : 0; ?>&nbsp;</td>
        
		<td width="6%"><?php $salesQty = (!empty($product['Product']['sale_qty']))? $product['Product']['sale_qty'] : 0; ?><?php echo $this->Html->link(__($salesQty), array('action' => '#varientModal'.$i),array('data-toggle'=>'modal','data-target'=>'#varientModal'.$i,)); ?>&nbsp;</td>      
		<td width="6%"><?php echo (!empty($product['Product']['sale_sale_price'])) ? '$'.$product['Product']['sale_sale_price'] : 0; ?>&nbsp;</td>
        
        <td width="6%"><?php echo $orderQty - $salesQty;  ?>&nbsp;</td>
		<td width="6%"><?php echo ($product['Product']['order_purchase_price'] >= $product['Product']['sale_sale_price']) ? '-$'.($product['Product']['order_purchase_price'] - $product['Product']['sale_sale_price']) : '$'.($product['Product']['sale_sale_price'] - $product['Product']['order_purchase_price']); ?>&nbsp;</td>

		<td class="actions">
        	<?php echo $this->Html->link(__('Order'), array('controller'=>'inventories','action' => 'add', $product['Product']['id'])); ?>&nbsp;|&nbsp;
			<?php //echo $this->Html->link(__('Varients'), array('action' => '#varientModal'.$i),array('data-toggle'=>'modal','data-target'=>'#varientModal'.$i,)); ?>
		</td>
        <!-- Modal -->
        <div id="varientModal<?php echo $i;?>" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo h($product['Product']['title']); ?></h4>
              </div>
              <div class="modal-body">
              <div class="panel panel-default">
        
              <?php foreach ($product['attribute'] as $key => $salesVary):
			  			echo '<div class="panel-heading">'.$key.'</div>';?>
						<div class="panel-body">
                            <div class="rTable">
                              <div class="rTableRow">
                                <div class="rTableHead"><strong><?php echo h('Varient size'); ?></strong></div>
                                <div class="rTableHead"><span style="font-weight: bold;"><?php echo h('Quantity X Sold Price'); ?></span></div>
                                <div class="rTableHead"><?php echo h('Total Sold Price'); ?></div>
                              </div>
                              <?php 	foreach($salesVary as $key2 => $salesValue){ ?>
                              <div class="rTableRow">
                                <div class="rTableCell"><?php echo $key2 ?></div>
                                <div class="rTableCell"><?php echo $salesValue['quantity']; ?> X <?php echo $salesValue['sale_price'] ?></div>
                                <div class="rTableCell"><?php echo $salesValue['total_sale_price'] ?></div>
                              </div>
                              <?php  $total_sale_price += $salesValue['total_sale_price'];} ?>
                              <div class="rTableRow">
                                <div class="rTableCell"></div>
                                <div class="rTableCell"><?php echo h('Total Sold Price'); ?></div>
                                <div class="rTableCell"><?php echo $total_sale_price ?></div>
                              </div>
                            </div>
             			</div> 
			 <?php	endforeach ?>
                <?php /*?><p><?php echo '<pre>';print_r($product['attribute']); ?></p><?php */?>
                </div> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
        
          </div>
        </div>
	</tr>
<?php $i++;endforeach; }else {?>
<tr><td colspan="8" align="center">No Products available</td></tr><?php } ?>
	</tbody>
	</table>
    
   			   </div>
       		</div>
		 </div>
	   </div>
	</div>
</div>