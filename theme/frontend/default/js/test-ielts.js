function onClickTabMenu() {
    // document.querySelector('.menu-link').classList.add('-active'); 
    document.querySelector('.menu-link').classList.toggle('-active');
}

function showQuestionsList() {
    document.querySelector('.background-questions-list').classList.toggle('-active');
    if ($('#questions-list-inner').hasClass('-active')){
        console.log("showing");
        $('#id-listening-test-container').css('margin-bottom','150px');
    }else{
        console.log("hiding");
        $('#id-listening-test-container').css('margin-bottom','30px');
    }

}

function hideQuestionsList() {
    document.querySelector('.background-questions-list').classList.remove('-active');
    $('#id-listening-test-container').css('margin-bottom','30px');


}
function onClickShowNotepad(dom,id) {
	$(dom).hide();
	$("#show_note_pad_" + id).show(500);
}

