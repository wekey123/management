<?php if($types!='sale') {echo $this->Form->input('shipping_price',array('div'=>false,'error'=>false,'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control'));
		echo $this->Form->input('miscellaneous',array('div'=>false,'error'=>false,'before' => '<div class="form-group">', 'after' => '</div>' , 'class'=>'validate[required] form-control')); }
		if($types == 'fulfillment'){
			echo '<br /><b>Total Purchase Price </b>: '.$total['purchase_price'].'<br /><br />';
			echo '<b>Shipping and miscellaneous Price </b>: '.$total['miscellaneous'].'<br /><br />';
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
<?php //echo $miscellaneous;//echo '<pre>';print_r($loops);
$i=1;foreach($loops as $key1 => $loop){ ?> 
		
		  <div class="col-lg-12" id="tabs-<?php echo $i ?>">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo strtoupper($key1);?></div>              
                <div class="panel-body"> 
				<?php foreach($loop as $key2 => $value){  ?>
                  <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo strtoupper($key2);?></div>              
                            <div class="panel-body"> 
                          <?php $j=1;foreach($value as $key3 => $fields){ ?>
                                <?php 
                                if($fields == 'quantity')
                                    $placeholder = 'Qty';
                                if($fields == 'purchase_price')
                                    $placeholder = 'Purchase Price';
                                if($fields == 'sale_price')
                                    $placeholder = 'Sale Price';
                                if($j==3)  {echo $this->Form->input($key1.'.'.$key2.'.'.$fields ,array('div'=>false,'error'=>false,'type'=>'hidden' , 'id'=>$key1.$key2.'count' , 'value'=>$fields));
								echo '<b>Quantity Left </b>: '.$fields;
								}
								else 
                                echo $this->Form->input($key1.'.'.$key2.'.'.$fields ,array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control invent_'.$fields,'placeholder'=>$placeholder,'data-rel'=>$key1.$key2.'count','required'=>false,'label'=>$placeholder));
								
                                ?>
                          <?php $j++;} ?>
                             </div>
                             </div>
                  </div>
                <?php } ?>
            	</div>
             </div>
           </div>
<?php $i++;} ?>
</div>
<script>
$(".invent_quantity").change(function() {
	var qcount = $('#'+$(this).data('rel')).val();
	if($(this).val() > qcount){
		$(this).prev().append('<span>Please Enter less then quantity</span>');
		$('input[type="submit"]').prop('disabled', true);
	}
	else {
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