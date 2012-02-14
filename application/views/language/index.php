<div class="row">
	<div class="span12">
		<p>Below are all listed program languages.Select to add addiational
			languages or edit or delete existing languages</p>
		<div class="row">
			<div class="span4">
				<table class="margin-top20 table table-bordered">
					<tbody>
					<?php foreach($langs as $row):?>
					    <tr>
							<td><a
								href="<?php echo URL::to('admin/language/edit/'.$row['id'])?>"><?php echo $row['name']?></a></td>
							<td width="20px"><a
								href="<?php echo URL::to('admin/language/delete/'.$row['id'])?>"
								onClick="return confirm('If you delete this language,you will be lost all the data with this language.Are you sure ?')"><i
									class="icon-trash"></i></a></td>
						</tr>
					<?php endforeach?>
					</tbody>
				</table>
			</div>
			<div class="span7 pull-right">
				<form class="well margin-top20"
					action="<?php echo URL::to('/admin/language/add')?>" method="post">
					<legend>Add new</legend>
					<label>Name</label> <input type="text" name="name" class="span3"> <label>Note</label>
					<textarea rows="5" class="span5" name="note"></textarea>
					<br>
					<button type="submit" class="btn">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>