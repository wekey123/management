<style>
.rTable {  	display: block;   	width: 100%; } .rTableHeading, .rTableBody, .rTableFoot, .rTableRow{   	clear: both; } .rTableHead, .rTableFoot{   	background-color: #DDD;   	font-weight: bold; } .rTableCell, .rTableHead {   	border: 1px solid #999999;   	float: left;   	height: 30px;   	overflow: hidden;   	padding: 3px 1.8%;   	width: 33%; } .rTable:after {   	visibility: hidden;   	display: block;   	font-size: 0;   	content: " ";   	clear: both;   	height: 0; }
</style>
</style>
<div class="products view" id="page-wrapper">
	<div class="addNewButton" style="float:none;">
         <?php echo $this->Html->link(__('Back to Product'), array('action' => 'index'),array('class' => 'btn btn-primary','type'=>'button')); ?>
         <?php echo $this->Html->link(__('Add Product'), array('action' => 'add'),array('class' => 'btn btn-primary','type'=>'button')); ?>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <fieldset><legend><?php echo __('Product'); ?></legend>
                <dl>
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
                    <dt><?php echo __('Weight'); ?></dt>
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
                </dl>
    </fieldset>
    </div></div>
    <br /> <br />
    <div class="row">
       <div class="col-lg-6">
            <fieldset><legend><?php echo __('Total Products Ordered'); ?></legend>
                <?php foreach ($product['order'] as $key => $salesVary):
				$total_sale_price = 0;
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
    		</fieldset>
    </div> 
       <div class="col-lg-6">
            <fieldset><legend><?php echo __('Total Products Sold'); ?></legend>
                <?php foreach ($product['attribute'] as $key => $salesVary):$total_sale_price = 0;
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
    		</fieldset>
    </div>
    </div>
    
</div>

