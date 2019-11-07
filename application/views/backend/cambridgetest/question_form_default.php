<div class="form-group ckeditor_detail">
    <label class="control-label col-sm-2 col-xs-12">Chi tiết</label>
    <div class="col-sm-10 col-xs-12">
        <textarea name="detail" class="form-control" placeholder="Chi tiết" rows="3"><?php echo $row['detail']; ?></textarea>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-sm-2 col-xs-12"></label>
    <div class="col-sm-10 col-xs-12">
        <div class="col-sm-3 col-xs-3">
            <b>Nội dung hỏi bằng chữ</b>
        </div>
        <div class="col-sm-3 col-xs-3">
            <b>Nội dung hỏi bằng ảnh</b>
        </div>
        <div class="col-sm-3 col-xs-3">
            <b>Đáp án</b>
        </div>
        <div class="col-sm-1 col-xs-3">
            <b>Correct</b>
        </div>
    </div>
</div>

<?php for($i = 0; $i < 4; $i++) { ?>
    <div class="form-group">
        <label class="control-label col-sm-2 col-xs-12">Câu <?php echo ($i + 1);?></label>
        <div class="col-sm-10 col-xs-12">
            <div class="col-sm-3 col-xs-3">
                <input type="text" name="answer[<?php echo $i;?>][content]" value="<?php echo $answer[$i]['content']; ?>" placeholder="" class="form-control">
            </div>
            <div class="col-sm-3 col-xs-3">
                <div class="col-sm-10 col-xs-12 filemanager_media">
                    <img class="image_org" data-name="test_image_<?php echo $i;?>" data-type="image" data-selected="<?php echo $answer[$i]['images']; ?>" src="<?php echo ($answer[$i]['images']) ? getimglink($answer[$i]['images'],'size2') : $this->config->item("img").'default_image.jpg'; ?>">
                    <i class="fa fa-remove image_delete"></i>
                    <input type="hidden" name="answer[<?php echo $i;?>][images]" value="<?php echo $answer[$i]['images'];?>" />
                </div>
            </div>
            <div class="col-sm-3 col-xs-3">
                <input type="text" name="answer[<?php echo $i;?>][object]" value="<?php echo $answer[$i]['object']; ?>" placeholder="" class="form-control">
            </div>
            <div class="col-sm-1 col-xs-3">
                <div class="checkbox">
                    <label><input <?php echo ($answer[$i]['correct'] == 1 )? 'checked':'';?> type="checkbox" value="1" name="answer[<?php echo $i;?>][correct]"></label>
                </div>
            </div>
        </div>
    </div>
<?php } ?>