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
            <b>Nhân vật</b>
        </div>
        <div class="col-sm-3 col-xs-3">
            <b>Nội dung hành động / sự việc</b>
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
                <input type="text" name="answer[<?php echo $i;?>][object]" value="<?php echo $answer[$i]['object']; ?>" placeholder="" class="form-control">
            </div>
        </div>
    </div>
<?php } ?>