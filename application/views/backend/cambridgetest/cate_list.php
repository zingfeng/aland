<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$cate_type = $this->config->item("cate_test_type");
$pDelete = $this->permission->check_permission_backend('cate_delete');
?>
<!-- page content -->
<div id="cate_lists" class="page-lists">
	<div class="clearfix"></div>
	<form class="ajax-delete-form" action="" method="POST">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Danh sách nhóm test</h2>
					<div class="clearfix"></div>
				</div>

				<div class="x_content">
					<div class="table-responsive">
						<?php if ($rows) { ?>
						<table class="table table-striped jambo_table table-bordered">
							<thead id="checkbox_all">
								<tr class="headings">
									<?php if ($pDelete) { ?>
									<th width="20px">
										<input type="checkbox" class="inputCheckAll">
									</th>
									<?php } ?>
									<th class="column-title">Tên nhóm</th>
									<th class="column-title" width="120px">loại</th>
									<th class="column-title" width="70px">Thứ tự </th>
									<th class="column-title no-link last" width="70px;"><span class="nobr"><?php echo $this->lang->line("common_action"); ?></span></th>
								</tr>
							</thead>
							<tbody id="checkbox_list">
								<?php 
								foreach ($rows as $key => $row) { ?>
								<tr>
									<?php if ($pDelete) { ?>
									<td class="a-center ">
										<input type="checkbox" value="<?php echo $row['cate_id']; ?>" class="inputSelect" name="cid[]">
									</td>
									<?php } ?>
									<td><?php echo $row['name']; ?></td>
									
									<td><?php echo $cate_type[$row['type']]; ?></td>
									<td><?php echo $row['ordering']; ?></td>
							
									<td class="action last">
										<?php if ($this->permission->check_permission_backend('cate_edit')) { ?>
										<a data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line("common_edit"); ?>" href="<?php echo SITE_URL; ?>/test/cate_edit/<?php echo $row['cate_id']; ?>">
											<i class="fa fa-edit"></i>
										</a>
										<?php } ?>
										<?php if ($pDelete) { ?>
										<a class="quick-delete" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line("common_delete"); ?>" data-id="<?php echo $row['cate_id']; ?>" href="javascript:void(0)" rel="nofollow">
											<i class="fa fa-trash"></i>
										</a>
										<?php } ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<?php }else{?>
						<div class="no-result"><?php echo $this->lang->line("common_no_result"); ?></div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page-title scroll_action">
		<div class="title_left">
			<button class="btn btn-primary" onclick="goBack();" type="button">Back</button>
			<?php if ($this->permission->check_permission_backend('cate_add')) {?>
			<a class="btn btn-primary" href="<?php echo SITE_URL; ?>/testcambridge/cate_add">Thêm nhóm test</a>
			<?php } ?>
			<?php if ($pDelete) { ?>
			<button class="btn btn-success ajax-delete-button" type="submit"><?php echo $this->lang->line("common_delete"); ?></button>
			<?php } ?>
		</div>
	</div>
	</form>
</div>
