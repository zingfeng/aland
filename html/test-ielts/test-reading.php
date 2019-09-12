<?php include('include/header.php'); ?>
<section class="test-reading">
    <div class="container background-test">
        <div class="row">
            <div class="col group-test text-center">
                <div class="group-test__title">
                    IELTS Recent Actual Test With Answers (Vol 6)
                </div>
                <div class="group-test__subtitle">
                    LISTENING PRACTICE TEST 1
                </div>
                <div class="group-test__custom-border-bottom"></div>
            </div>
        </div>
        <div class="row">
            <div id="col1" class="col-xl-6 col-lg-6 col-md-12 col-sm-12 read margin-top">
                <h2 class="title">READING PASSAGE 1</h2>
                <div class="description">You should spend about 20 minutes on Questions 1-13, which are based on Reading
                    Passage 1 below.</div>
                <div class="read_title">The Concept of Childhood in Western Countries</div>
                <div class="read_image">
                    <img src="https://dummyimage.com/1000x600/dddddd/999999.jpg" alt="">
                </div>
                <div class="read_content">
                    Whether childhood is itself a recent invention has been one of the most intensely debated issues in
                    the history of childhood. Historian Philippe Aries asserted that children were regarded as miniature
                    adults, with all the intellect and personality that this implies, in Western Europe during the
                    Middle Ages (up to about the end of the 15th century). After scrutinising medieval pictures and
                    diaries, he concluded that there was no distinction between children and adults for they shared
                    similar leisure activities and work; However, this does not mean children were neglected, forsaken
                    or despised, he argued. The idea of childhood corresponds to awareness about the peculiar nature of
                    childhood, which distinguishes the child from adult, even the young adult. Therefore, the concept of
                    childhood is not to be confused with affection for children. Traditionally, children played a
                    functional role in contributing to the family income in the history. Under this circumstance,
                    children were considered to be useful. Back in the Middle Ages, children of 5 or 6 years old did
                    necessary chores for their parents. During the 16th century, children of 9 or 10 years old were
                    often encouraged or even forced to leave their family to work as servants for wealthier families or
                    apprentices for a trade. In the 18th and 19th centuries, industrialisation created a new demand for
                    child labour; thus many children were forced to work for a long time in mines, workshops and
                    factories. The issue of whether long hours of labouring would interfere with children’s growing
                    bodies began to perplex social reformers. Some of them started to realise the potential of
                    systematic studies to monitor how far these early deprivations might be influencing children’s
                    development. The concerns of reformers gradually had some impact upon the working condition of
                    children. For example, in Britain, the Factory Act of 1833 signified the emergence of legal
                    protection of children from exploitation and was also associated with the rise of schools for
                    factory children. Due partly to factory reform, the worst forms of child exploitation were
                    eliminated gradually. The influence of trade unions and economic changes also contributed to the
                    evolution by leaving some forms of child labour redundant during the 19th century. Initiating
                    children into work as ‘useful’ children was no longer a priority, and childhood was deemed to be a
                    time for play and education for all children instead of a privileged minority. Childhood was
                    increasingly understood as a more extended phase of dependency, development and learning with the
                    delay of the age for starting full-time work- Even so, work continued to play a significant, if less
                    essential, role in children’s lives in the later 19th and 20th centuries. Finally, the ‘useful
                    child’ has become a controversial concept during the first decade of the 21st century, especially in
                    the context of global concern about large numbers of children engaged in child labour.
                </div>
            </div>
            <div id="col2" class="col-xl-6 col-lg-6 col-md-12 col-sm-12 answer margin-top">
                <div class="question_title">Question 1 - 7</div>
                <p>Do the following statements agree with the information given in Reading Passage 1? In boxes 1-7 on
                    your answer sheet, write</p>
                <table class="table table-striped">
                    <tr>
                        <td>TRUE</td>
                        <td>if the statement is false</td>
                    </tr>
                    <tr>
                        <td>FALSE</td>
                        <td>if the statement is true</td>
                    </tr>
                    <tr>
                        <td>NOT GIVEN</td>
                        <td>if the information is not given in the passage</td>
                    </tr>
                </table>
                <div class="choose_answer">
                    <?php for ($i=0; $i < 3; $i++) { ?>
                    <div class="item row">
                        <div class="col-5 custom-col">
                            <div class="form-answer__number-answer left_input_100">
                                3
                            </div>
                            <div class="right_input_100">
                                <select class="form-control" name="">
                                    <option value="">TRUE</option>
                                    <option value="">TRUE</option>
                                    <option value="">TRUE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-7 custom-col">
                            Aries pointed out that children did different types of work to adults during the Middle
                            Ages.
                        </div>
                    </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</section>
<section class="information">
    <div class="container">
        <div class="row">
            <div class="col designed-build text-center">
                Designed and built with all the love in the world by the Imap team
            </div>
        </div>
    </div>
</section>



<footer id="footer-test" class="fixed-bottom">
    <div class="container">
        <!-- view tablet desktop -->
        <div class="row align-item-center footer-reading-view-desktop-tablet">
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4">
                <button class="btn btn-outline-primary form-control" onclick="showQuestionsList()">
                    Bảng câu hỏi
                </button>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-6 col-sm-4 text-center">
                <!-- thời gian làm bài còn lại -->
                <div class="time-countdown-test-reading-view-desktop-mobile align-item-center">
                    <span class="time-countdown-test-reading-view-desktop-mobile__icon">
                        <span class="icon-round-timer-24px"></span>
                    </span>
                    <span class="time-countdown-test-reading-view-desktop-mobile__time">
                        39:23
                    </span>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4">
                <button class="btn btn-danger form-control">
                    Submit
                </button>
            </div>
        </div>

        <!-- view mobile -->
        <div class="row align-item-center footer-reading-view-mobile">
            <div class="col-2">
                <button class="btn btn-outline-primary btn-sm" onclick="showQuestionsList()">
                <i class="fa fa-check" aria-hidden="true"></i>
                </button>           
            </div>
            <div class="col-6 align-item-center text-center">
            <div class="time-countdown-test-reading-view-mobile align-item-center">
                    <span class="time-countdown-test-reading-view-mobile__icon">
                        <span class="icon-round-timer-24px"></span>
                    </span>
                    <span class="time-countdown-test-reading-view-mobile__time">
                        39:23
                    </span>                   
                </div>               
            </div>
            <div class="col-4">
            <button class="btn btn-danger btn-sm w-100">
                        Submit
                </button>
            </div>
        </div>
    </div>
</footer>

<?php include('include/footer.php'); ?>
<script src="../js/split.min.js"></script>
<script>
/* JS Goes Here */
if ($(document).width() > 768) {
    Split(['#col1', '#col2'], {
        elementStyle: (dimension, size, gutterSize) => ({
            'flex-basis': `calc(${size}% - ${gutterSize}px)`,
        }),
        gutterStyle: (dimension, gutterSize) => ({
            'flex-basis': `5px`,
        }),
        minSize: 500
    });
}
</script>