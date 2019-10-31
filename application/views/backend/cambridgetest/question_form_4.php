
<div class="form-group ckeditor_detail">
    <label class="control-label col-sm-2 col-xs-12">Chi tiết</label>
    <div class="col-sm-10 col-xs-12">
        <textarea name="detail" class="form-control" placeholder="Chi tiết" rows="3"><?php echo $row['detail']; ?></textarea>
    </div>
</div>

<div class="form-group">
    <label class="control-label col-sm-2 col-xs-12"></label>
    <div class="col-sm-10 col-xs-12">
        <div class="col-sm-4 col-xs-9">
            <b>Nội dung</b>
        </div>
        <div class="col-sm-1 col-xs-3">
            <b>Correct</b>
        </div>
        <div class="col-sm-1 col-xs-3">
            <b>Set</b>
        </div>
    </div>
</div>
<?php for($i = 0; $i < 25; $i++){?>
<div class="form-group">
    <label class="control-label col-sm-2 col-xs-12">Câu trả lời <?php echo ($i + 1);?></label>
    <div class="col-sm-10 col-xs-12">
        <div class="col-sm-4 col-xs-9">
            <input value="<?php echo $answer[$i]['content'];?>" type="text" name="answer[<?php echo $i;?>][label]" placeholder="Câu trả lời <?php echo ($i + 1);?>" class="form-control">
        </div>
        <div class="col-sm-1 col-xs-3">
            <div class="checkbox">
                <label><input <?php echo ($answer[$i]['correct'] == 1 )? 'checked':'';?> type="checkbox" value="1" name="answer[<?php echo $i;?>][correct]"></label>                       
            </div>
        </div>
        <div class="col-sm-1 col-xs-3">
            <div class="checkbox">
                <label><input <?php echo ($answer[$i]['parent'] == 1 )? 'checked':'';?> type="checkbox" value="1" name="answer[<?php echo $i;?>][parent]"></label>                       
            </div>
        </div>
    </div>
</div>
<?php }?>
