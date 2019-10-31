<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$pDelete = $this->permission->check_permission_backend('delete');
$test_type = $this->config->item('cambridge_test_type');
?>
<!-- page content -->
<div id="test_lists" class="page-lists">
	<div class="clearfix"></div>
	<form class="ajax-delete-form" action="" method="POST">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Bài test: <?php echo $test_detail['title'];?></h2>
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
									<th class="column-title">Tên bài test</th>
									<th class="column-title">Type</th>	
									<th class="column-title" width="80px">Xuất bản</th>					
									<th class="column-title no-link last" align="center" width="95px;"><span class="nobr"><?php echo $this->lang->line("common_action"); ?></span></th>
								</tr>
							</thead>
							<tbody id="sortbytable">
								<?php 
								foreach ($rows as $key => $row) { ?>
								<tr>
									<?php if ($pDelete) { ?>
									<td class="a-center ">
										<input type="checkbox" value="<?php echo $row['question_id']; ?>" class="inputSelect" name="cid[]">
									</td>
									<?php } ?>
									<td><?php echo $row['title']; ?></td>
									<td><?php echo $test_type[$row['type']]['name']; ?></td>
									<td align="center"><?php echo tmp_check_status($row['publish']); ?></td>								
									<td class="action last" align="center">
										<?php if ($this->permission->check_permission_backend('edit')) { ?>
										<a data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line("common_edit"); ?>" href="<?php echo SITE_URL; ?>/testcambridge/question_edit/<?php echo $row['question_id']; ?>">
											<i class="fa fa-edit"></i>
										</a>
										<?php } ?>
										<?php if ($pDelete) { ?>
										<a class="quick-delete" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line("common_delete"); ?>" data-id="<?php echo $row['question_id']; ?>" href="javascript:void(0)" rel="nofollow">
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
			<a class="btn btn-primary" href="<?php echo SITE_URL; ?>/testcambridge/question_add?testid=<?php echo $test_detail['test_id'];?>">Thêm câu hỏi</a>
			<?php } ?>
			<button class="btn btn-primary" onclick="save_order();" type="button">Save Order</button>
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
<script type="text/javascript">
	function save_order(){
		var arrId = [];
		$("#sortbytable").find('input[type="checkbox"]').each(function(){
			arrId.push($(this).val());
		});
		$.ajax({
			type: "POST",
			url: '<?php echo site_url('testcambridge/question_sort'); ?>',
			data: {'question_id': arrId,'test_id' : <?php echo $test_detail['test_id']; ?>},
			dataType: 'json',
			success: function(data){
				show_notify_error({
					title: 'Success',
					type: 'success',
					message: data.message,
				});
			}
		});
	}
	$(document).ready(function(){
		$( "#sortbytable" ).sortable();
		$( "#sortbytable" ).disableSelection();

	});
</script>