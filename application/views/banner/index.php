<script>
$(document).ready(function(e){
	$('#lang_id').val('<?php echo $banner['lang_id']?>').change();
	$('#lang_id').change(function(e){
		var url='<?php echo URL::to('admin/banner/')?>'+$(this).val();		
		window.location = url;
	})
});
function getFileManager(functionData )
{
    // You can use the "CKFinder" class to render CKFinder in a page:
    var finder = new CKFinder();

    // The path for the installation of CKFinder (default = "/ckfinder/").
    finder.basePath = 'ckfinder/';

    //Startup path in a form: "Type:/path/to/directory/"
    finder.startupPath = 'Files:/';

    // Name of a function which is called when a file is selected in CKFinder.
    finder.selectActionFunction = SetFileField;

    // Additional data to be passed to the selectActionFunction in a second argument.
    // We'll use this feature to pass the Id of a field that will be updated.
    finder.selectActionData = functionData;

    // Name of a function which is called when a thumbnail is selected in CKFinder.
    finder.selectThumbnailActionFunction = ShowThumbnails;

    // Launch CKFinder
    finder.popup();
}
//This is a sample function which is called when a file is selected in CKFinder.
function SetFileField( fileUrl, data )
{
    document.getElementById( data["selectActionData"] ).value = fileUrl;
}

// This is a sample function which is called when a thumbnail is selected in CKFinder.
function ShowThumbnails( fileUrl, data )
{
    // this = CKFinderAPI
    var sFileName = this.getSelectedFile().name;
    document.getElementById( 'thumbnails' ).innerHTML +=
        '<div class="thumb">' +
        '<img src="' + fileUrl + '" />' +
        '<div class="caption">' +
        '<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
        '</div>' +
        '</div>';

    document.getElementById( 'preview' ).style.display = "";
    // It is not required to return any value.
    // When false is returned, CKFinder will not close automatically.
    return false;
}
</script>
<form class="form-horizontal" method="post">
<div class="row">
	<div class="span4">
		Languages &nbsp; <select id="lang_id" name="lang_id">
			<?php foreach($langs as $row):?>
			    <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>			
			<?php endforeach ?>
		</select>
	</div>
	<div class="span7 pull-right">
		<div class="row">
			<div class="span3" style="text-align: right">Select your machine
				banner</div>
			<div class="span4 pull-left">
				<input type="text" name="top_banner" id="top_banner" onclick="getFileManager('top_banner')" value="<?php echo $banner['top_banner']?>"></input>				
			</div>
		</div>
	</div>
</div>
<div class="row margin-top20">
	<div class="span6">
	    <input type="hidden" name="id" value="<?php echo $banner['id']?>">
		<!-- Form 1 -->		
			<fieldset>
				<legend>Banner 1</legend>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 1</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner1_frame1" value="<?php echo $banner['banner1_frame1']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 2</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner1_frame2" value="<?php echo $banner['banner1_frame2']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 3</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner1_frame3" value="<?php echo $banner['banner1_frame3']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 4</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner1_frame4" value="<?php echo $banner['banner1_frame4']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Footer</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner1_footer" value="<?php echo $banner['banner1_footer']?>">
					</div>
				</div>
			</fieldset>		

		<!-- Form 2 -->		
			<fieldset>
				<legend>Banner 2</legend>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 1</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner2_frame1" value="<?php echo $banner['banner2_frame1']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 2</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner2_frame2" value="<?php echo $banner['banner2_frame2']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 3</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner2_frame3" value="<?php echo $banner['banner2_frame3']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 4</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner2_frame4" value="<?php echo $banner['banner2_frame4']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Footer</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner2_footer" value="<?php echo $banner['banner2_footer']?>">
					</div>
				</div>
			</fieldset>			
	</div>

	<div class="span6">
		<!-- Form 3 -->		
			<fieldset>
				<legend>Banner 3</legend>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 1</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner3_frame1" value="<?php echo $banner['banner3_frame1']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 2</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner3_frame2" value="<?php echo $banner['banner3_frame2']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 3</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner3_frame3" value="<?php echo $banner['banner3_frame3']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 4</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner3_frame4" value="<?php echo $banner['banner3_frame4']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Footer</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner3_footer" value="<?php echo $banner['banner3_footer']?>">
					</div>
				</div>
			</fieldset>		

		<!-- Form 4 -->		
			<fieldset>
				<legend>Banner 4</legend>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 1</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner4_frame1" value="<?php echo $banner['banner4_frame1']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 2</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner4_frame2" value="<?php echo $banner['banner4_frame2']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 3</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner4_frame3" value="<?php echo $banner['banner4_frame3']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Frame 4</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner4_frame4" value="<?php echo $banner['banner4_frame4']?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Footer</label>
					<div class="controls">
						<input type="text" class="input-xlarge" name="banner4_footer" value="<?php echo $banner['banner4_footer']?>">
					</div>
				</div>
			</fieldset>	
			<div class="clear"></div>
			<button type="submit" class="btn btn-primary pull-right">Update</button>		
	</div>
</div>
</form>