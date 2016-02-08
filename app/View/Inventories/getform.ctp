<?php  if(!empty($loops)){ ?>


<style>
.form-group label{
	 width: 55%;
}
.form-group input[type="text"]{
	 width: 55%;
}
</style>


<div id="tab">
<ul style="width:100%;float:left;">
<?php 
$i=1;foreach($loops as $Titlekey => $loopTitle){?>
    <li style="list-style:none; float:left; margin-left:20px;">    
    <a href="#tabs-<?php echo $i;?>"><?php echo strtoupper($Titlekey);?></a> 
    </li>   
<?php $i++;} ?>
</ul>
<?php $i=1;foreach($loops as $key1 => $loop){ ?> 
		
		  <div class="col-lg-12" id="tabs-<?php echo $i ?>">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo strtoupper($key1);?></div>              
                <div class="panel-body"> 
				<?php foreach($loop as $key2 => $value){  ?>
                  <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo strtoupper($key2);?></div>              
                            <div class="panel-body"> 
                          <?php foreach($value as $key3 => $values){ ?>
                                <?php 
                                if($key3 == 'quantity')
                                    $placeholder = 'Qty';
                                if($key3 == 'purchase_price')
                                    $placeholder = 'Purchase Price';
                                if($key3 == 'sale_price')
                                    $placeholder = 'Sale Price';

									if($key3 == 'order_quantity' && $types == 'fulfillment'){
									  echo $this->Form->input($key1.'.'.$key2.'.'.$key3 ,array('div'=>false,'error'=>false,'type'=>'text','id'=>$key1.'_'.$key2.'_'.$key3, 'value'=>$values,'label'=>'Order Qty Left','before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','disabled' => 'disabled'));
									}
									if($key3 == 'fulfillment_quantity' && $types == 'sale'){
									  echo $this->Form->input($key1.'.'.$key2.'.'.$key3 ,array('div'=>false,'error'=>false,'type'=>'text','id'=>$key1.'_'.$key2.'_'.$key3, 'value'=>$values,'label'=>'Fulfillment Qty Left','before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','disabled' => 'disabled'));
									}
									if($key3 == 'sale_quantity'){
									  echo $this->Form->input($key1.'.'.$key2.'.'.$key3 ,array('div'=>false,'error'=>false,'type'=>'hidden','id'=>$key1.'_'.$key2.'_'.$key3, 'value'=>$values,'label'=>'Sale Qty Left','before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control','disabled' => 'disabled'));
									}

                                
									if($key3 == 'quantity'){
                              		  echo $this->Form->input($key1.'.'.$key2.'.'.$key3 ,array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control invent_'.$key3,'placeholder'=>$placeholder,'id'=>$key1.'_'.$key2.'_'.$key3,'required'=>false,'label'=>$placeholder)); 
									}
									if($types == 'order'){
										if($key3 == 'purchase_price'){
                              		  echo $this->Form->input($key1.'.'.$key2.'.'.$key3 ,array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control invent_'.$key3,'placeholder'=>$placeholder,'id'=>'pTitle','required'=>false,'label'=>$placeholder)); 
										}
									}
									if($types == 'fulfillment'){
										if($key3 == 'sale_price'){
                              		  echo $this->Form->input($key1.'.'.$key2.'.'.$key3 ,array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control invent_'.$key3,'placeholder'=>$placeholder,'id'=>'pTitle','required'=>false,'label'=>$placeholder)); 
										}
									}
									
									if($key3 == 'purchase_price' && $types == 'fulfillment'){
                              		  echo $this->Form->input($key1.'.'.$key2.'.'.$key3 ,array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control invent_'.$key3,'placeholder'=>$placeholder,'id'=>'pTitle','required'=>false,'label'=>$placeholder,'disabled' => 'disabled','value'=>$values)); 
									}
									
									if(($key3 == 'purchase_price' || $key3 == 'sale_price') && $types == 'sale'){
                              		  echo $this->Form->input($key1.'.'.$key2.'.'.$key3 ,array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control invent_'.$key3,'placeholder'=>$placeholder,'id'=>'pTitle','required'=>false,'label'=>$placeholder,'disabled' => 'disabled','value'=>$values)); 
									}
                                ?>
                              

                          <?php } ?>
                          
                             </div>
                             </div>
                  </div>
                <?php } ?>
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
	var type = $('#type').val();
	var quantity_id = $(this).attr('id');
	var seperate = quantity_id.split('_');
	var order_quantity_id = seperate[0]+'_'+seperate[1]+'_order_quantity';
	var fulfillment_quantity_id = seperate[0]+'_'+seperate[1]+'_fulfillment_quantity';
	var sale_quantity_id = seperate[0]+'_'+seperate[1]+'_sale_quantity';

	 if(type == 'fulfillment'){
		  var  quantity_left = parseInt($('#'+order_quantity_id).val()) - parseInt($('#'+fulfillment_quantity_id).val());
		  alert(quantity_left);
	 }
	 
	 if(type == 'sale'){
		   var  quantity_left = parseInt($('#'+fulfillment_quantity_id).val()) - parseInt($('#'+sale_quantity_id).val());
	 }
	 
	 //alert('fulfillment_quantity_left'+fulfillment_quantity_left);
	 var currentInput = $('#'+$(this).attr('id')).val();
	 if(currentInput > quantity_left){
	     $(this).prev().html('<span>Qty less then or Equal '+quantity_left+'</span>');
		 $('#getVarientValue').prop('disabled', true);
	 }else{
		 $(this).prev().html('Qty');
	 }
	 
	 
	 $( "label" ).each(function( index ) {
  			var string = $( this ).html();
			var $str1 = $(string); //this turns your string into real html
			
			if(typeof $str1[0] === 'undefined'){
			 $('#getVarientValue').prop('disabled', false);
			}else{
			 console.log($str1[0]);
			 $('#getVarientValue').prop('disabled', true);
			 return false;
			}
	 });
});
</script>