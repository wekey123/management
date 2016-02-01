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
                          <?php foreach($value as $key3 => $fields){ ?>
                                <?php 
                                if($fields == 'quantity')
                                    $placeholder = 'Qty';
                                if($fields == 'purchase_price')
                                    $placeholder = 'Purchase Price';
                                if($fields == 'sale_price')
                                    $placeholder = 'Sale Price';
                                
                                echo $this->Form->input($key1.'.'.$key2.'.'.$fields ,array('div'=>false,'error'=>false, 'before' => '<div class="form-group">', 'after' => '</div>', 'class'=>'validate[required] form-control invent_'.$fields,'placeholder'=>$placeholder,'id'=>'pTitle','required'=>false,'label'=>$placeholder)); 
                                ?>
                          <?php } ?>
                             </div>
                             </div>
                  </div>
                <?php } ?>
            	</div>
             </div>
           </div>
<?php $i++;} ?>
</div>