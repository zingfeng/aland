<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$pDelete = $this->permission->check_permission_backend('delete');
?>
<!-- page content -->
<div id="adveritse_lists" class="page-lists">
	<div class="clearfix"></div>
	<form action="" method="GET">
	<div id="filter-data">
		<div class="x_panel">
			<div class="x_title">
				<h2><?php echo $this->lang->line("common_filter_submit"); ?></h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content" style="display: none;">
	            <div class="col-tn-12 col-xs-6 col-sm-3 form-group">
					<label class="control-label">Tên lớp</label>
					<input type="text" name="name" value="<?php echo $filter['name']; ?>" placeholder="Tên lớp" class="form-control">
	            </div>
	            <div class="col-tn-12 col-xs-12 form-group">
	            	<button class="btn btn-primary reset" type="button"><?php echo $this->lang->line("common_reset"); ?></a>
					<button class="btn btn-success" type="submit"><?php echo $this->lang->line("common_filter_submit"); ?></button>
	            </div>
			</div>
			
		</div>
	</div>
	</form>
	<div class="clearfix"></div>
	<form class="ajax-delete-form" action="" method="POST">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Danh sách lớp học</h2>
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
									<th class="column-title">Tên lớp</th>
									<th class="column-title">Tên đăng nhập</th>
									<th class="column-title">Mật khẩu</th>
									<th class="column-title" style="text-align: center;">Lịch học</th>
									<th class="column-title no-link last" align="center" width="95px;"><span class="nobr"><?php echo $this->lang->line("common_action"); ?></span></th>
								</tr>
							</thead>
							<tbody id="checkbox_list">
								<?php 
								foreach ($rows as $key => $row) { ?>
								<tr>
									<?php if ($pDelete) { ?>
									<td class="a-center ">
										<input type="checkbox" value="<?php echo $row['class_id']; ?>" class="inputSelect" name="cid[]">
									</td>
									<?php } ?>
									<td><?php echo $row['name'] ?></td>
									<td><?php echo $row['username']; ?></td>
									<td><?php echo base64_decode($row['password']); ?></td>
									<td align="center">
										<?php if ($this->permission->check_permission_backend('lesson_add')) { ?>
										<a title="Thêm chuyên đề" href="<?php echo SITE_URL; ?>/group/lesson_add?class_id=<?php echo $row['class_id']; ?>">
											Thêm             |
										</a>
										<?php } ?>
										
										<?php if ($this->permission->check_permission_backend('lesson_index')) { ?>
										<a title="Thêm chuyên đề" href="<?php echo SITE_URL; ?>/group/lesson_index/<?php echo $row['class_id']; ?>">
											Xem
										</a>
										<?php } ?>
									</td>		
									<td class="action last" align="center">
										
										<?php if ($this->permission->check_permission_backend('index_users')) { ?>
										<a data-toggle="tooltip" data-placement="top" title="Danh sách học viên" href="<?php echo SITE_URL; ?>/group/index_users/<?php echo $row['class_id']; ?>">
											<i class="fa fa-users"></i>
										</a>
										<?php } ?>
										<?php if ($this->permission->check_permission_backend('edit')) { ?>
										<a data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line("common_edit"); ?>" href="<?php echo SITE_URL; ?>/group/edit/<?php echo $row['class_id']; ?>">
											<i class="fa fa-edit"></i>
										</a>
										<?php } ?>
										<?php if ($pDelete) { ?>
										<a class="quick-delete" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line("common_delete"); ?>" data-id="<?php echo $row['class_id']; ?>" href="javascript:void(0)" rel="nofollow">
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
						<?php echo $paging; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page-title scroll_action">
		<div class="title_left">
			<button class="btn btn-primary" onclick="goBack();" type="button">Back</button>
			<?php if ($this->permission->check_permission_backend('add')) {?>
			<a class="btn btn-primary" href="<?php echo SITE_URL; ?>/group/add">Thêm Lớp học</a>
			<?php } ?>
			<?php if ($pDelete) { ?>
			<button class="btn btn-success ajax-delete-button" type="submit"><?php echo $this->lang->line("common_delete"); ?></button>
			<?php } ?>
		</div>
	</div>
	</form>
</div>
<?php if ($filter) {?>
<script type="text/javascript">
	var filtering = 1;
</script>
<?php } ?>