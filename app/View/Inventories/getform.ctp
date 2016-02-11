<?php  if(!empty($loops)){ ?>
<style>
/*.form-group label {
     width: 98%; 
    margin-left: 15px;
}*/
.error_msg{
	font-size:12px;
	color:red;
	padding-left:10px;
}

.form-group label{
	 width: 90%;
}
.form-group input[type="text"]{
	 width: 90%;
}
</style>
</style>
<?php 
		if($types!='sale') {
			echo $this->Form->input('Inventory.shipping_price',array('div'=>false,'error'=>false,'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control'));
			echo $this->Form->input('Inventory.miscellaneous',array('div'=>false,'error'=>false,'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control')); 
		}
?>

<div id="tab">
<ul style="width:100%;float:left;">
<?php 
$i=1;foreach($loops as $Titlekey => $loopTitle){?>
    <li style="list-style:none; float:left; margin-left:20px;">    
    <a href="#tabs-<?php echo $i;?>"><?php echo strtoupper($Titlekey);?></a> 
    </li>   
<?php $i++;} ?>
</ul>
<?php //echo '<pre>';print_r($loops);
$i=1;foreach($loops as $key1 => $loop){ ?> 
		
		  <div class="col-lg-12" id="tabs-<?php echo $i ?>">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo strtoupper($key1);?></div>              
                <div class="panel-body"> 
				<?php foreach($loop as $key2 => $value){ 
				if($types == 'order' || ($types == 'sale' && $value[2] != '') || ($types == 'fulfillment' && $value[2] != '')){ ?>
                  <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo strtoupper($key2);?></div>              
                            <div class="panel-body"> 
                          <?php $j=0;
						 // debug($value);
						  foreach($value as $key3 => $fields){ ?>
                                <?php 
                                if($fields == 'quantity')
                                    $placeholder = 'Qty';
                                if($fields == 'purchase_price')
                                    $placeholder = 'Purchase Price';
                                if($fields == 'sale_price')
                                    $placeholder = 'Sale Price';

								if($j==3){ // QTY LEFT
								echo $this->Form->input($key1.'.'.$key2.'.'.$fields ,array('div'=>false,'error'=>false,'type'=>'hidden' , 'id'=>$key1.$key2.'count' , 'value'=>$fields));
								echo '<div class="form-group"><label for="blackSmallQuantity">Quantity Left <span style="font-weight: 100; margin-left: 10px;"> '.$fields.'</span></label></div>';
								}else{
									if($types == 'order'){	//QTY,purchase_price,sale_price
									echo $this->Form->input($key1.'.'.$key2.'.'.$fields ,array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control invent_'.$fields,'placeholder'=>$placeholder,'data-rel'=>$key1.$key2.'count','required'=>false,'label'=>$placeholder));
									}else if($types == 'fulfillment'){
										if($j == 1){	 //purchase_price
										echo $this->Form->input($key1.'.'.$key2.'.purchase_price' ,array('div'=>false,'error'=>false,'type'=>'hidden' , 'id'=>$key1.$key2.'count' , 'value'=>$fields, 'class'=>'validate[required] form-control invent_purchase_price'));
										echo '<div class="form-group"><label for="blackSmallQuantity">Purchase Price <span style="font-weight: 100; margin-left: 10px;"> '.$fields.'</span></label></div>';
										}else{  //QTY,sale_price
										echo $this->Form->input($key1.'.'.$key2.'.'.$fields ,array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control invent_'.$fields,'placeholder'=>$placeholder,'data-rel'=>$key1.$key2.'count','required'=>false,'label'=>$placeholder));
										}
									}else if($types == 'sale'){
										if($j == 0){	 //QTY
										echo $this->Form->input($key1.'.'.$key2.'.'.$fields ,array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control invent_'.$fields,'data-rel'=>$key1.$key2.'count','required'=>false));
										}else if($j == 1){	 //purchase_price
										echo $this->Form->input($key1.'.'.$key2.'.purchase_price' ,array('div'=>false,'error'=>false,'type'=>'hidden' , 'id'=>$key1.$key2.'count' , 'value'=>$fields, 'class'=>'validate[required] form-control invent_purchase_price'));
										echo '<div class="form-group"><label for="blackSmallQuantity">Purchase Price <span style="font-weight: 100; margin-left: 10px;"> '.$fields.'</span></label></div>';
										}else if($j == 2){		 //sale_price
										echo $this->Form->input($key1.'.'.$key2.'.sale_price' ,array('div'=>false,'error'=>false,'type'=>'hidden' , 'id'=>$key1.$key2.'count' , 'value'=>$fields, 'class'=>'validate[required] form-control invent_sale_price'));
										echo '<div class="form-group"><label for="blackSmallQuantity">Sale Price <span style="font-weight: 100; margin-left: 10px;"> '.$fields.'</span></label></div>';
										}
									}								
								}
                                ?>
                          <?php $j++;} ?>
                             </div>
                             </div>
                  </div>
                <?php } } ?>
            	</div>
             </div>
           </div>
<?php $i++;} 
echo $this->Form->input('type',array('div'=>false,'error'=>false,'type'=>'hidden','id'=>'type', 'value'=>$types));
?>
</div>
<?php }else{ ?>
		<?php if($types == 'fulfillment'){ ?>
        <div class="form-group">No orders for this Product yet. So you must have to add some orders, before fulfillment.</div>
        <?php }if($types == 'sale'){  ?>
         <div class="form-group">No fulfillment for this Product yet. So you must have to add some fulfillment, before sales order.</div>
        <?php }else{} ?>
<?php }  ?>
<script>
$(".invent_quantity").change(function() {
	$('.error_msg').remove();
	var qcount = $('#'+$(this).data('rel')).val();
	if($(this).val() > qcount){
		$(this).prev().append('<span class="error_msg">Please Enter less then quantity</span>');
		$('input[type="submit"]').prop('disabled', true);
	}
	else {$('.error_msg').remove();
		var set = false;
		$('.invent_quantity').each(function() {
			var qcount = $('#'+$(this).data('rel')).val();
			if($(this).val() > qcount){
				set = true;
			}
		});
		console.log(set);
		$('input[type="submit"]').prop('disabled', set);
	}
});
</script>