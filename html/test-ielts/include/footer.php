<!-- ------------------bảng câu hỏi----------------- -->
        <section id="questions-list">
            <div class="container background-questions-list">
                <div class="row justify-content-between title-button-hide-questions-list">
                    <div class="col-6  title-button-hide-questions-list__title">
                        Bảng câu hỏi
                    </div>
                    <div class="col-6 text-right">
                        <a class="button-hide-questions-list" onclick="hideQuestionsList()">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="questions-list">
                    
                    <?php for ($i=1; $i < 39; $i++) { ?> 
                    <a href="" class="questions-number -false">
                        <?php echo $i; ?>
                    </a>
                    <?php } ?>
                    
                    <a href="" class="questions-number -not-done-yet">
                        40
                    </a>
                     
                </div>
            </div>
        </section>
        <!-- kết thúc bảng câu hỏi -->

    </main>
    <script src="html/js/bootstrap4/jquery-3.3.1.slim.min.js"></script>
    <script src="html/js/bootstrap4/popper.min.js"></script>
    <script src="html/js/bootstrap4/bootstrap.min.js"></script>
    <script src="html/js/test-ielts.js"></script>
</body>

</html>