
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
        <div class="col-sm-6 col-xs-6 answer_sound_<?php echo $i;?>">
            <input type="hidden" name="answer[<?php echo $i;?>][sound_answer]" value="<?php echo $answer[$i]['sound']; ?>">
            <?php if($answer[$i]['sound']){?>
            <audio controls>
                <source src="<?php echo getFileLink($answer[$i]['sound']); ?>" type="audio/mpeg">Your browser does not support the audio element.
            </audio>
            <span class="delete_image" onclick="delete_parents('answer_sound_<?php echo $i;?>')"><i class="fa fa-remove"></i></span>
            <?php } else {?>
            <a href="javascript:;" class="select_audio" data-name="answer_sound_<?php echo $i;?>">Chọn file nghe</a>
            <?php }?>
        </div>
    </div>
</div>
<?php }?>
<script language="javascript">
    //////////// FORM IMAGE ////////
    $("body").on("click",".select_audio",function() {
        var dom = $(this).attr('data-name');
        filemanager_multi_callback_popup('sound','audio_callback',dom);
    });
    function delete_parents(dom){
        $('.'+dom).find('audio').remove();
        $('.'+dom).find('input').val("");
        $('.'+dom).find('.delete_image').remove();
        $('.'+dom).append('<a href="javascript:;" class="select_audio" data-name="'+dom+'">Chọn file nghe</a>');
    }
    function audio_callback (file,dom) {
        var src = UPLOAD_URL + 'sound/' + file;
        $('.'+dom).find('input').val(file);
        $('.'+dom).find('.select_audio').remove();
        $('.'+dom).append('<audio controls> <source src="'+src+'" type="audio/mpeg">Your browser does not support the audio element. </audio> <span class="delete_image" onclick="delete_parents(\''+dom+'\')"><i class="fa fa-remove"></i></span>');
    }
</script>
