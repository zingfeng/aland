<div class="col-sm-6 col-xs-12">
    <div class="form-group">
        <?php for($i = 0; $i < 4; $i++){?>
        <div class="form-group">
            <label class="control-label col-sm-3 col-xs-12">Câu trả lời <?php echo ($i + 1);?></label>
            <div class="col-sm-9 col-xs-12">
                <div class="col-sm-6 col-xs-6">
                    <input value="<?php echo $answer[$i]['content'];?>" type="text" name="answer[<?php echo $i;?>][label]" placeholder="Câu hỏi <?php echo ($i + 1);?>" class="form-control">
                </div>
                <div class="col-sm-6 col-xs-6">
                    <input value="<?php echo $answer[$i]['content'];?>" type="text" name="answer[<?php echo $i;?>][label]" placeholder="Câu trả lời <?php echo ($i + 1);?>" class="form-control">
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>