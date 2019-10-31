<p class="lead">Read the passage and choose the correct answer:</p>
<div class="myquestionarea">
    <div class="alert alert-warning"><?php echo $question['detail']; ?></div>
    <?php 
    $i = 0;
    foreach ($question['answer'] as $j => $arrAnswer) { ?>
        <div id="testing_answer_<?php echo $question['question_id']?>_<?php echo $page + $i ?>">
        <?php
        $n = 0;
        foreach ($arrAnswer as $key => $a) { ?>
            <?php if ($a['parent'] == 1) { ?>
            <div class="question_number"><b>Question <?php echo $page + $i; ?>: </b><span><?php echo $a['content']; ?></span></div>
            <?php continue;} ?>
            <label class="fulltest_answer_label" id="test_answer_label_<?php echo $a['answer_id']?>">
                <input type="radio" data-iquestion="<?php echo ($page + $i) ?>" data-question="<?php echo $question['question_id']?>" name="answer[<?php echo $question['question_id']?>][<?php echo $i; ?>]" value="<?php echo $a['answer_id']?>">
                <strong><?php echo translate_answer($n + 1); ?></strong> <span><?php echo $a['content']; ?></span>
            </label>
        <?php $n++; } ?>
        </div>
    <?php $i++; } ?>
</div>