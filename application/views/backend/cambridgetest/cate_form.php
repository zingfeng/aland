<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
$this->load->config('data');
?>
<form class="form-horizontal form-label-left ajax-submit-form" action="" method="POST">
<div class="form-group">	
	<button class="btn btn-primary" onclick="goBack();" type="button">Back</button>
	<?php if ($this->permission->check_permission_backend('cate_index')) {?>
	<a class="btn btn-primary" href="<?php echo SITE_URL; ?>/testcambridge/cate_index">Danh sách nhóm test</a>
	<?php } ?>
	<button class="btn btn-success ajax-submit-button" type="submit"><?php echo $this->lang->line("common_save"); ?></button>
	<?php if ($row['cate_id']) { ?>
	<input  type="hidden" name="token" value="<?php echo $this->security->generate_token_post($row['cate_id']) ?>"/>
	<?php } ?>
</div>
<div class="row">
	<div class="col-md-7 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Nhóm test</small></h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content row">
				<div class="form-group validation_name">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Tên nhóm *</label>
					<div class="col-md-9 col-sm-9 col-xs-12 validation_form">
						<input required type="text" name="name" value="<?php echo $row['name']; ?>" placeholder="Tên nhóm" class="form-control">
					</div>
                </div>
                <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Cấp nhóm</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<select name="parent" class="select2_single form-control" placeholder="Cấp nhóm" tabindex="-1">
                            <option value="0">Nhóm chính</option>
                            <?php foreach ($arrCate as $key => $cate) { ?>
                            <option <?php if ($row['parent'] == $cate['cate_id']) echo 'selected'; ?> value="<?php echo $cate['cate_id']; ?>"><?php echo $cate['name']; ?></option>
                            <?php } ?>
                        </select>
					</div>
                </div>
                <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Ảnh mô tả</label>
					<div class="col-md-9 col-sm-9 col-xs-12 filemanager_media">
						<img class="image_org" data-name="test_image" data-type="image" data-selected="<?php echo $row['images']; ?>" src="<?php echo ($row['images']) ? getimglink($row['images'],'size2') : $this->config->item("img").'default_image.jpg'; ?>">
						<i class="fa fa-remove image_delete"></i>
						<input type="hidden" name="images" value="<?php echo $row['images']; ?>" />
					</div>
                </div>
                <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Thứ tự</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" name="ordering" value="<?php echo (int) $row['ordering']; ?>" placeholder="<?php echo $this->lang->line("test_cate_ordering"); ?>" class="form-control">
					</div>
                </div>
                <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Loại</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<select name="type" class="select2_single form-control" placeholder="<?php echo $this->lang->line("test_cate_type"); ?>" tabindex="-1">
                            <?php foreach ($this->config->item('cate_test_type') as $key => $type) { ?>
                            <option <?php if ($row['type'] == $key) echo 'selected'; ?> value="<?php echo $key; ?>"><?php echo $type; ?></option>
                            <?php } ?>
                        </select>
					</div>
                </div>
                <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Mô tả</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<textarea name="description" class="form-control" placeholder="<?php echo $this->lang->line("test_cate_description"); ?>" rows="3"><?php echo $row['description']; ?></textarea>
					</div>
                </div>
			</div>
		</div>
	</div>
	<div class="col-md-5 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>SEO AREA <small>Seo for category</small></h2>
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
					<label class="control-label col-md-3 col-sm-3 col-xs-12">SEO title</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" name="seo_title" value="<?php echo $row['seo_title']; ?>" placeholder="SEO title" class="form-control">
					</div>
                </div>
                <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">SEO keyword</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<input type="text" name="seo_keyword" value="<?php echo $row['seo_keyword']; ?>" placeholder="SEO keyword" class="form-control">
					</div>
                </div>
                <div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">SEO description</label>
					<div class="col-md-9 col-sm-9 col-xs-12">
						<textarea name="seo_description" class="form-control" placeholder="SEO description" value="" rows="3"><?php echo $row['seo_description']; ?></textarea>
				
					</div>
                </div>
			</div>
		</div>
	</div>
</div>
</form>