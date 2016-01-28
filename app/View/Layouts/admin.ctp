<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>
    <?php 
	echo $this->Html->css('bootstrap.min'); 
	echo $this->Html->css('plugins/metisMenu/metisMenu.min'); 
	echo $this->Html->css('plugins/timeline'); 
	echo $this->Html->css('sb-admin-2'); 
	echo $this->Html->css('plugins/morris'); 
	echo $this->Html->css('tag/jquery.tagit'); 
	echo $this->Html->css('tag/tagit.ui-zendesk'); 
	echo $this->Html->css('font-awesome-4.1.0/css/font-awesome.min');
	echo $this->Html->css('dataTables/dataTables.responsive.css'); 
	?>
   
    <style>
	#page-wrapper{
	padding-bottom:20px;
	margin:0px;
	}
	</style>
</head>

<body><?php 
	echo $this->Html->script('jquery.min');
	echo $this->Html->script('jquery-ui.min');
	//echo $this->Html->script('selectivity-full.js');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->script('tag-it.min');
	
	echo $this->Html->script('plugins/metisMenu/metisMenu.min');
	//echo $this->Html->script('plugins/morris/raphael.min');
	//echo $this->Html->script('plugins/morris/morris.min');
	//echo $this->Html->script('plugins/morris/morris-data');
	//echo $this->Html->script('dataTables/jquery.dataTables.min.js'); 
	//echo $this->Html->script('dataTables/dataTables.bootstrap.min.js'); 
	echo $this->Html->script('sb-admin-2');
	?>
    <div id="wrapper">
        <?php echo $this->element('nav'); ?>
		
        <?php echo $this->fetch('content'); ?>
    </div>
    <!-- /#wrapper -->
	
	
	 <script>
		$(document).ready(function() {
			 $('#varient_body').hide();
			//$('#multiple-select-box').selectivity();
			//$('#multiple-select-box-edit').selectivity();
		/*	$('#emails-input').selectivity({
					inputType: 'Email',
                    placeholder: 'Enter option',
             }); 
			 var counter = 1;
			 $('#emails-input').on('keyup',function(e){
				 //console.log(e.keyCode);
				 if(e.keyCode == 8){
					counter--;
					console.log(counter);
        			$("#TextBoxDiv" + counter).remove();
					 console.log('backspace trapped');
				 }
				 
				  if(e.keyCode == 188){
					if(counter>10){
							alert("Only 10 textboxes allow");
							return false;
					}   
						
					var newTextBoxDiv = $(document.createElement('div'))
						 .attr("id", 'TextBoxDiv' + counter);
								
					newTextBoxDiv.after().html('<div class="varient-group"><label>price</label><input type="text" id="price' + counter + '" value=""  ></div><div class="varient-group"><label>SKU</label><input type="text" id="sku' + counter + '" value=""  ></div><div class="varient-group"><label>BarCode</label><input type="text" id="barcode' + counter + '" value=""  ></div>');
							
					newTextBoxDiv.appendTo("#TextBoxesGroup");
					counter++;
				  }
					
					//console.log(counter);
             });*/
			 var varenb;
			 $(".varient-enable").click(function () {
				 if(!varenb){
				  $('#varient_body').show();
				  $(this).removeClass('.glyphicon-plus-sign');
				  $(this).addClass('.glyphicon-minus-sign');
				  varenb=1;
				 }
				 else{
					 varenb=0;
					 $(this).addClass('.glyphicon-plus-sign');
				  $(this).removeClass('.glyphicon-minus-sign');
				 $('#varient_body').hide();
				 }
			 });
			 
			  $("#getVarientValue").click(function () {
				   var data = [];var data1 = [];
				 $("#eventTags li input").each(function(i) {
					  data.push($.trim($(this).val()));
				});
				$("#mySingleFieldTags li input").each(function(i) {
					  data1.push($.trim($(this).val()));
				});
				
				$('#tagVarients').val(data.join(","));
				$('#tagValues').val(data1.join(","));
				//return false;
			});
			 
			 
			/*$('#dataTables-example').DataTable({
					responsive: true
			});*/
		});
	
		/*function initMCEexact(e){
			  tinymce.init({
			  selector: e,
			  theme: "modern",
			  width: 900,
			  height: 150,
			  plugins: [
				"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
				"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				"save table contextmenu directionality emoticons template paste textcolor"
			  ],
			  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons"
			 });
		}
	
		initMCEexact("#CategoryDescription");*/
		
		$(function(){
            var sampleTags = ['c++', 'java', 'php', 'coldfusion', 'javascript', 'asp', 'ruby', 'python', 'c', 'scala', 'groovy', 'haskell', 'perl', 'erlang', 'apl', 'cobol', 'go', 'lua'];

            //-------------------------------
            // Minimal
            //-------------------------------
            $('#myTags').tagit();
			$("#mySingleFieldTags").tagit();
            

            //-------------------------------
            // Tag events
            //-------------------------------
            var eventTags = $('#eventTags');

            var addEvent = function(text) {
                $('#events_container').append(text + '<br>');
				
            };
			var arr = [];
            eventTags.tagit({
                //availableTags: sampleTags,
                beforeTagAdded: function(evt, ui) {
                    if (!ui.duringInitialization) {
                        addEvent('beforeTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
                    }
                },
                afterTagAdded: function(evt, ui) {
                    if (!ui.duringInitialization) {
                        addEvent('afterTagAdded: ' + eventTags.tagit('tagLabel', ui.tag));
                    }
                },
                beforeTagRemoved: function(evt, ui) {
                    addEvent('beforeTagRemoved: ' + eventTags.tagit('tagLabel', ui.tag));
                },
                afterTagRemoved: function(evt, ui) {console.log(arr);
					var result = $.grep(arr, function(e){ 
							if(e.tagLabel == ui.tagLabel){
								$('#'+ui.tagLabel).remove();
							}
						 return e.tagLabel != ui.tagLabel; 
					});
					arr=result;
					console.log(arr);
                },
                onTagClicked: function(evt, ui) {
                    addEvent('onTagClicked: ' + eventTags.tagit('tagLabel', ui.tag));
                },
                onTagExists: function(evt, ui) {
                    addEvent('onTagExists: ' + eventTags.tagit('tagLabel', ui.existingTag));
                }
            });

			//-------------------------------
            // Remove confirmation
            //-------------------------------
            $('#removeConfirmationTags').tagit({
				beforeTagAdded: function(evt, ui) {
					$('#tagProduct').val(ui.tagLabel).join(",");
				},
                availableTags: sampleTags,
                removeConfirmation: true
            });
            $('#'+ui.tagLabel).remove();
        });
   </script>

</body>
</html>