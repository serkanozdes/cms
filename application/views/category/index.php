<script>
$(document).ready(function(e){
	$('#categories_list').val('<?php echo $cat_id?>').change();
	$('#categories_list').change(function(e){
		var url='<?php echo URL::to('admin/category/')?>'+$(this).val();		
		window.location = url;
	})
});
</script>
<div class="row">
	<div class="span4">
		Category &nbsp; <select id="categories_list">
			<?php foreach((array)$categories as $row):?>
			<option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
			<?php endforeach?>
		</select>
	</div>
	<div class="span4 pull-left">
		<a href="<?php echo URL::to('admin/category/add')?>"
			class="btn btn-primary">Add new</a>
	</div>
</div>
<form class="form-horizontal" method="post">
<input type="hidden" name="id" value="<?php echo $cat_id?>">
	<div class="row margin-top20">
		<div class="span6">
			<legend>Display name</legend>
		<?php foreach((array)$details as $row):?>
				   <div class="control-group">
				<label class="control-label" for="input01"><?php echo $row->lang_name?></label>
				<div class="controls">
					<input type="hidden" value="<?php echo $row->lang_id?>" name="lang_id[]">
					<input type="hidden" value="<?php echo $row->lang_name?>"
						name="lang_name[]"> <input type="text" class="input-xlarge"
						name="display_name[]" value="<?php echo $row->display_name?>">
				</div>
			</div>	 
		<?php endforeach;?>
		<?php foreach ($langs as $lang):?>
		      <div class="control-group">
					<label class="control-label" for="input01"><?php echo $lang['name']?></label>					
					<div class="controls">
					    <input type="hidden" value="<?php echo $lang['id']?>" name="lang_id[]">
					    <input type="hidden" value="<?php echo $lang['name']?>" name="lang_name[]">
						<input type="text" class="input-xlarge" name="display_name[]">
					</div>
				</div>	 
		<?php endforeach;?>						
	</div>
	</div>
	<button type="submit" class="btn btn-primary pull-right">Update</button>
</form>