<div class="row margin-top20">
	<div class="span6">
		<form class="form-horizontal" method="post">
			<field> <legend>Name</legend>
			<div class="control-group">
				<label class="control-label" for="input01">Category name</label>
				<div class="controls">
					<input type="text" class="input-xlarge" name="name">
				</div>
			</div>
			</field>
			<fieldset>
				<legend>Display name</legend>
				<?php foreach($langs as $row):?>
				   <div class="control-group">
					<label class="control-label" for="input01"><?php echo $row['name']?></label>					
					<div class="controls">
					    <input type="hidden" value="<?php echo $row['id']?>" name="lang_id[]">
					    <input type="hidden" value="<?php echo $row['name']?>" name="lang_name[]">
						<input type="text" class="input-xlarge" name="display_name[]">
					</div>
				</div>	 
				<?php endforeach;?>							
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</fieldset>
		</form>
	</div>
</div>