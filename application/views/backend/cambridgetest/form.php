
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
$this->load->config('data');
?>
<form class="form-horizontal form-label-left ajax-submit-form" action="" method="POST">
<div class="form-group">	
	<button class="btn btn-primary" onclick="goBack();" type="button">Back</button>
	<?php if ($this->permission->check_permission_backend('index')) {?>
	<a class="btn btn-primary" href="<?php echo SITE_URL; ?>/testcambridge/index">Danh sách bài test</a>
	<?php } ?>
	<button class="btn btn-success ajax-submit-button" type="submit"><?php echo $this->lang->line("common_save"); ?></button>
	<?php if ($row['test_id']) { ?>
	<input  type="hidden" name="token" value="<?php echo $this->security->generate_token_post($row['test_id']) ?>"/>
	<?php } ?>
</div>
<div class="row tab-pane" id="test_detail">
	<div class="col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Detail</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content row">
				<div class="form-group validation_title">
					<label class="control-label col-sm-2 col-xs-12">Tên bài test</label>
					<div class="col-sm-10 col-xs-12 validation_form">
						<input required type="text" name="title" value="<?php echo $row['title']; ?>" placeholder="Tên bài test" class="form-control">
					</div>
                </div>
                <div class="form-group validation_original_cate">
					<label class="control-label col-sm-2 col-xs-12">Nhóm</label>
					<div class="col-sm-10 col-xs-12 validation_form">
						<select name="original_cate" class="select2_single form-control" placeholder="Nhóm" tabindex="-1">
                            <option value="0">Nhóm chính</option>
                            <?php foreach ($arrCate as $key => $cate) { ?>
                            <option <?php if ($row['original_cate'] == $cate['cate_id']) echo 'selected'; ?> value="<?php echo $cate['cate_id']; ?>"><?php echo $cate['name']; ?></option>
                            <?php } ?>
                        </select>
					</div>
                </div>
                <?php if ($this->permission->check_permission_backend('publish')) { ?>
                <div class="form-group">
					<label class="control-label col-sm-2 col-xs-12">Xuất bản</label>
					<div class="col-sm-10 col-xs-12">
						<div class="checkbox">
							<label><input type="checkbox" value="1" <?php echo ($row['publish'] == 1 || !isset($row['publish'])) ? 'checked' : ''; ?> name="publish"></label>						
						</div>
					</div>
                </div>
                <?php } ?>
                <div class="form-group">
					<label class="control-label col-sm-2 col-xs-12">Ảnh mô tả</label>
					<div class="col-sm-10 col-xs-12 filemanager_media">
						<img class="image_org" data-name="test_image" data-type="image" data-selected="<?php echo $row['images']; ?>" src="<?php echo ($row['images']) ? getimglink($row['images'],'size2') : $this->config->item("img").'default_image.jpg'; ?>">
						<i class="fa fa-remove image_delete"></i>
						<input type="hidden" name="images" value="<?php echo $row['images']; ?>" />
					</div>
                </div>
                <div class="form-group validation_title">
					<label class="control-label col-sm-2 col-xs-12">Thời gian làm bài</label>
					<div class="col-sm-10 col-xs-12 validation_form">
						<input required type="text" name="test_time" value="<?php echo $row['test_time']; ?>" placeholder="Thời gian làm bài (phút)" class="form-control">
					</div>
                </div>
                <div class="form-group ckeditor_detail">
					<label class="control-label col-sm-2 col-xs-12">Mô tả</label>
					<div class="col-sm-10 col-xs-12">
						<textarea name="description" class="form-control" placeholder="Mô tả" rows="3"><?php echo $row['description']; ?></textarea>
					</div>
                </div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>SEO AREA <small>Option</small></h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content row">
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Ngày đăng</label>
					<div class="col-md-10 col-sm-10 col-xs-12">
						<input id="publish_time" type="text" name="publish_time" class="form-control" value="<?php echo ($row['publish_time']) ? date('d/m/Y H:i:s',$row['publish_time']) : date('d/m/Y H:i:s'); ?>"/>
					</div>
				</div>
		</div>
	</div>
</div>
</div>
</form>
<script type="text/javascript">
$(document).ready(function() {
	////tab
    $('.nav-tabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show');
        var id_tab = $(this).attr('href');
        $('.tab-pane').hide();
        $(id_tab).show();
    });

	/** DATETIME **/
	$('#publish_time').datetimepicker({
		format: 'd/m/Y H:i:s',
		step: 5
	});

	//suggest documents
	$("#suggest_class").select2({
		allowClear: true,
		placeholder: 'Chọn hoặc tìm lớp học ...',
		ajax: {
			url: SITE_URL + "/group/suggest_group",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					term: params.term, // search term
					page: params.page,
				};
			},
			processResults: function (data, params) {
				  params.page = params.page || 1;
				  return {
					results: data.data,
					pagination: {
						more: data.option.nextpage
					}
				  };
	  		},
	  		cache: true
		},
		minimumInputLength: 0,
		templateSelection: function(data) {
			if (typeof (data.item_id) != 'undefined') {
				$("#suggest_class option[value="+data.item_id+"]").attr("selected", "selected");
			}
			
			return data.text;
		}
	});

});
</script>