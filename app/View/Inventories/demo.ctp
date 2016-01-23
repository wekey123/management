<?php echo $this->Form->create('Inventory',array('action'=>'demo/1')); ?>
<?php 
foreach($loops as $key1 => $loop){
	echo $key1; echo '<br/>';
?>
	<?php foreach($loop as $key2 => $value){ echo $key2; echo "<br/>"; ?>
   			  <?php foreach($value as $key3 => $fields){ ?>
					<?php //echo $fields; ?> 
                    
                    <!--<input type="text" name="<?php echo $key1.'_'.$key2.'_'.$fields ?>" value=""/> -->
                    <?php echo $this->Form->input($key1.'.'.$key2.'.'.$fields ,array('required'=>false)); ?>
                    
        	  <?php echo "<br/>"; } ?>
	<?php echo "<br/>"; } ?>
<?php echo "<br/>"; } ?>
<?php echo $this->Form->end(__('Submit')); ?>