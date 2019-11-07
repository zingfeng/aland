<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$this->load->config('data');
$test_type = $this->config->item("cambridge_test_type");
?>
<form class="form-horizontal form-label-left ajax-submit-form" action="" method="POST">
<div class="form-group">	
	<button class="btn btn-primary" onclick="goBack();" type="button">Back</button>
	<button class="btn btn-success ajax-submit-button" type="submit"><?php echo $this->lang->line("common_save"); ?></button>
	<?php if ($row['question_id']) { ?>
	<input  type="hidden" name="token" value="<?php echo $this->security->generate_token_post($row['question_id']) ?>"/>
	<?php } ?>
</div>
<div class="row">
	<div class="col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Dạng bài test: <?php echo $test_type[$type]['name'];?></h2>
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
					<label class="control-label col-sm-2 col-xs-12">Tên câu hỏi</label>
					<div class="col-sm-10 col-xs-12 validation_form">
						<input required type="text" name="title" value="<?php echo $row['title']; ?>" placeholder="Tên câu hỏi" class="form-control">
					</div>
                </div>
                <div class="form-group">
					<label class="control-label col-sm-2 col-xs-12">Xuất bản</label>
					<div class="col-sm-10 col-xs-12">
						<div class="checkbox">
							<label><input type="checkbox" value="1" <?php echo ($row['publish'] == 1 || !isset($row['publish'])) ? 'checked' : ''; ?> name="publish"></label>						
						</div>
					</div>
                </div>
                <?php //if (in_array($type, array(1,8))) { ?>
                <div class="form-group">
					<label class="control-label col-sm-2 col-xs-12">Ảnh</label>
					<div class="col-sm-10 col-xs-12 filemanager_media">
						<img class="image_org" data-name="test_image" data-type="image" data-selected="<?php echo $row['images']; ?>" src="<?php echo ($row['images']) ? getimglink($row['images'],'size2') : $this->config->item("img").'default_image.jpg'; ?>">
						<i class="fa fa-remove image_delete"></i>
						<input type="hidden" name="images" value="<?php echo $row['images']; ?>" />
					</div>
                </div>
                <?php //} ?>
                <?php //if (in_array($type, array(1,3,4,8))) { ?>
                <div class="form-group">
					<label class="control-label col-sm-2 col-xs-12">Sound</label>
					<div class="col-sm-10 col-xs-12 filemanager_media">
						<a href="javascript:;" class="image_org" data-name="question_sound" data-type="sound" data-selected="<?php echo $row['sound']; ?>">Chọn file</a>
						<div class="sound_preview">
						<?php if ($row['sound']) {?>
			            	<audio controls>
								  <source src="<?php echo getFileLink($row['sound']); ?>" type="audio/mpeg">
									Your browser does not support the audio element.
							</audio>
							<i class="fa fa-remove sound_delete"></i>
		            	<?php } ?>
		            	</div>
						<input type="hidden" class="sound_input" name="sound" value="<?php echo $row['sound']; ?>" />
					</div>
                </div>
                <?php //} ?>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content row">
				<?php
				switch ($type) {
                    case 3:
                    case 4:
                        $form_no = 3;
                        break;
					/*case 1:
						$layout = 'question_form_1';
						break;
					case 2:
						$layout = 'question_form_2';
						break;
					case 5:
						$layout = 'question_form_3';
						break;
					case 3:
					case 4:
					case 6: 
					case 7:
						$layout = 'question_form_4';
						break;
					case 8:
						$layout = 'question_form_8';
						break;*/
					default:
                        $form_no = 0;
						break;
				}
                $layout = 'question_form_' . $form_no;
                $this->load->view('cambridgetest/'.$layout,array('row' => $row,'answer' => $answer),FALSE);
		        ?>
			</div>
	</div>
</div>
</form>