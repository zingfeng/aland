<div class="form-group">
    <label class="control-label col-sm-2 col-xs-12"></label>
    <div class="col-sm-10 col-xs-12">
        <div class="col-sm-3 col-xs-3">
            <b>Hình ảnh</b>
        </div>
        
        <div class="col-sm-1 col-xs-3">
            <b>Correct</b>
        </div>
    </div>
</div>

<?php for($i = 0; $i < 4; $i++){?>
<div class="form-group">
    <label class="control-label col-sm-2 col-xs-12">Câu trả lời <?php echo ($i + 1);?></label>
    <div class="col-sm-10 col-xs-12">
        <div class="col-sm-3 col-xs-3">
            <div class="col-sm-10 col-xs-12 filemanager_media">
                <img class="image_org" data-name="test_image_<?php echo $i;?>" data-type="image" data-selected="<?php echo $answer[$i]['content']; ?>" src="<?php echo ($answer[$i]['content']) ? getimglink($answer[$i]['content'],'size2') : $this->config->item("img").'default_image.jpg'; ?>">
                <i class="fa fa-remove image_delete"></i>
                <input type="hidden" name="answer[<?php echo $i;?>][label]" value="<?php echo $answer[$i]['content'];?>" />
            </div>
        </div>
        <div class="col-sm-1 col-xs-3">
            <div class="checkbox">
                <label><input <?php echo ($answer[$i]['correct'] == 1 )? 'checked':'';?> type="checkbox" value="1" name="answer[<?php echo $i;?>][correct]"></label>                       
            </div>
        </div>
    </div>
</div>
<?php }?>