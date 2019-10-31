<div class="form-group ckeditor_detail">
    <label class="control-label col-sm-2 col-xs-12">Chi tiết</label>
    <div class="col-sm-10 col-xs-12">
        <textarea name="detail" class="form-control" placeholder="Chi tiết" rows="3"><?php echo $row['detail']; ?></textarea>
    </div>
</div>
<div class="form-group ckeditor_detail">
    <label class="control-label col-sm-2 col-xs-12">Câu trả lời</label>
    <div class="col-sm-10 col-xs-12">
        <textarea name="answer[0][label]" class="form-control" placeholder="Câu trả lời" rows="3"><?php echo $answer[0]['content']; ?></textarea>
    </div>
</div>