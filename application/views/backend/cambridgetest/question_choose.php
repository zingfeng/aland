<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$this->load->config('data');
$test_type = $this->config->item("cambridge_test_type");
?>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Chọn loại câu hỏi</h2>
				<div class="clearfix"></div>
			</div>

			<div class="x_content">
				<ul>

					<?php foreach ($test_type as $key => $value) { ?>
						<?php if($key > 0) { ?>
						<li><a href="<?php echo SITE_URL; ?>/testcambridge/question_add?testid=<?php echo $this->input->get("testid"); ?>&type=<?php echo $key; ?>"><?php echo $value['name']; ?></a></li>
						<?php } else { ?>
							<li style="list-style: none; font-weight: bold; text-decoration: underline; margin-top: 15px"><?php echo $value['name']; ?></li>
						<?php } ?>
					<?php } ?> 
				</ul>
			</div>
		</div>
	</div>
</div>
