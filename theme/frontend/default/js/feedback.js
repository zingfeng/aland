// ================ CLASS =======================
function click_ok_class() {
    var status = $('#btn_ok_class').attr('status');
    if(status === 'insert'){
        insert_class();
    }else{
        edit_class();
    }


}

function load_edit_class(event) {
    $('#btn_ok_class').attr('status','edit');

    var obj = event.target;
    var info = obj.getAttribute('info');
    var info_live = JSON.parse(info);
    console.log("info_live");
    console.log(info_live);

    // class_code: "TOECI"
    // class_id: "1"
    // list_teacher: "["1","2"]"
    // more_info: "ghdfgh"
    // time_end: "1893430800"
    // time_end_client: "2030-01-01T00:00"
    // time_start: "946659600"
    // time_start_client: "2000-01-01T00:00"
    // type: "giaotiep"


    $('#btn_ok_class').attr('class_id',info_live.class_id);

    $("#class_type").val(info_live.type);
    $("#class_code").val(info_live.class_code);
    $("#class_from_date").val(info_live.time_start_client);
    $("#class_to_date").val(info_live.time_end_client);
    $('#class_more_info').val(info_live.more_info);
    $('#location_class').val(info_live.id_location);

    var list_teacher = JSON.parse(info_live.list_teacher);
    $('#class_teacher').val(list_teacher).trigger('change');


    $('#insert_class_modal').modal('show');

    // var array_convert = [];
}

function load_del_class(event) {
    var obj = event.target;
    var info = obj.getAttribute('info');
    var info_live = JSON.parse(info);
    console.log("info_live");
    console.log(info_live);

    // class_code: "TOECI"
    // class_id: "1"
    // list_teacher: "["1","2"]"
    // more_info: "ghdfgh"
    // time_end: "1893430800"
    // time_end_client: "2030-01-01T00:00"
    // time_start: "946659600"
    // time_start_client: "2000-01-01T00:00"
    // type: "giaotiep"

    var r = confirm("Bạn có muốn xóa Lớp học :\n" + "Mã lớp: " + info_live.class_code +'\nKiểu: ' + info_live.type );
    if (r == true) {
        $.post("/feedback/request",{
                optcod: 'del_class', // có thể include optcode này vào đâu ko ?
                token: 'abcd',
                class_id: info_live.class_id,
            },
            function (data, status) {
                console.log(data);
                make_effect_submit_done('btn_ok_class'); // có bao gồm reload
            });
    } else {
        // txt = "You pressed Cancel!";
    }

}

function load_get_link_class(event) {

    var obj = event.target;
    var info = obj.getAttribute('info');
    var info_live = JSON.parse(info);
    console.log("info_live");
    console.log(info_live);

    var link_feedback = 'https://www.aland.edu.vn/feedback/' + info_live.type + '?my_class=' + info_live.class_code;
    // var link_feedback = 'http://local.aland/feedback/' + info_live.type + '?my_class=' + info_live.class_code;

    $('#modal_link_feedback').html(info_live.class_code);
    $('#link_feedback').val(link_feedback);

    $('#modal_get_link').modal('show');

    $('#link_feedback').select();

    captain.copyToClipboard(link_feedback);
    // alert('Link feedback: ' + link_feedback + '\nĐã copy vào Clipboard !');

}

function ClickCopy() {
    var link_feedback = $('#link_feedback').val();
    captain.copyToClipboard(link_feedback);
    $('#link_feedback').select();
}

function ClickOpenLink() {
    var link_feedback = $('#link_feedback').val();
    openInNewTab(link_feedback);
}

function openInNewTab(url) {
    var win = window.open(url, '_blank');
    win.focus();
}

function edit_class(){
    var my_info = captain.getForm('insert_class_modal');
    if (my_info.class_code.trim() === ''){
        alert('Bạn cần nhập mã lớp');
        return null;
    }
    make_effect_submitting('btn_ok_class');

    console.log("myinfo");
    console.log(my_info);

    var class_id = $('#btn_ok_class').attr('class_id');
    make_effect_submitting('btn_ok_teacher');


    $.post("/feedback/request",{
            optcod: 'edit_class', // có thể include optcode này vào đâu ko ?
            token: 'abcd',
            class_id: class_id,
            class_code: my_info.class_code,
            class_from_date: my_info.class_from_date,
            class_more_info: my_info.class_more_info,
            class_teacher: my_info.class_teacher,
            class_to_date: my_info.class_to_date,
            class_type: my_info.class_type,
            id_location: my_info.location_class,
        },
        function (data, status) {
            console.log(data);
            make_effect_submit_done('btn_ok_class');
        });

}

function insert_class(){
    var my_info = captain.getForm('insert_class_modal');
    if (my_info.class_code.trim() === ''){
        alert('Bạn cần nhập mã lớp');
        return null;
    }
    make_effect_submitting('btn_ok_class');

    console.log("myinfo");
    console.log(my_info);

    $.post("/feedback/request",{
            optcod: 'insert_class', // có thể include optcode này vào đâu ko ?
            token: 'abcd',
            class_code: my_info.class_code,
            class_from_date: my_info.class_from_date,
            class_more_info: my_info.class_more_info,
            class_teacher: my_info.class_teacher,
            class_to_date: my_info.class_to_date,
            class_type: my_info.class_type,
            id_location: my_info.location_class,
        },
        function (data, status) {
            console.log(data);
            make_effect_submit_done('btn_ok_class');
        });

}

//=================== LOCATION =======================
function click_ok_location() {
    var status = $('#btn_ok_location').attr('status');
    if(status === 'insert'){
        insert_location();
    }else{
        edit_location();
    }


}

function load_edit_location(event) {
    $('#btn_ok_location').attr('status','edit');

    var obj = event.target;
    var info = obj.getAttribute('info');
    var info_live = JSON.parse(info);
    console.log("info_live");
    console.log(info_live);

    $('#btn_ok_location').attr('location_id',info_live.id);

    $('#name_location_insert').val(info_live.name);
    $('#area').val(info_live.area).change();

    $('#insert_location_modal').modal('show');

    // var array_convert = [];
}

function load_del_location(event) {
    var obj = event.target;
    var info = obj.getAttribute('info');
    var info_live = JSON.parse(info);
    console.log("info_live");
    console.log(info_live);

    var r = confirm("Bạn có muốn xóa Location :\n" + "Tên: " + info_live.name +'\nKhu vực: ' + info_live.area );
    if (r == true) {
        $.post("/feedback/request",{
                optcod: 'del_location', // có thể include optcode này vào đâu ko ?
                token: 'abcd',
                id: info_live.id,
            },
            function (data, status) {
                console.log(data);
                make_effect_submit_done('btn_ok_location'); // có bao gồm reload
            });
    } else {
        // txt = "You pressed Cancel!";
    }

}

function edit_location(){
    var my_info = captain.getForm('insert_location_modal');
    if (my_info.name_location_insert.trim() === ''){
        alert('Bạn cần điền tên cơ sở');
        return null;
    }
    // console.log("here");
    var location_id = $('#btn_ok_location').attr('location_id');
    make_effect_submitting('btn_ok_location');

    $.post("/feedback/request",{
            optcod: 'edit_location', // có thể include optcode này vào đâu ko ?
            token: 'abcd',
            id: location_id,
            name_location_insert: my_info.name_location_insert,
            area: my_info.area,
        },
        function (data, status) {
            console.log(data);
            make_effect_submit_done('btn_ok_location');
        });



}

function insert_location(){
    var my_info = captain.getForm('insert_location_modal');
    if (my_info.name_location_insert.trim() === ''){
        alert('Bạn cần điền tên giáo viên');
        return null;
    }
    make_effect_submitting('btn_ok_location');

    $.post("/feedback/request",{
            optcod: 'insert_location', // có thể include optcode này vào đâu ko ?
            token: 'abcd',
            id: my_info.location_id,
            name_location_insert: my_info.name_location_insert,
            area: my_info.area,
        },
        function (data, status) {
            console.log(data);
            make_effect_submit_done('btn_ok_location');
        });
}


// ================ TEACHER =======================
function click_ok_teacher() {
    var status = $('#btn_ok_teacher').attr('status');
    if(status === 'insert'){
        insert_teacher();
    }else{
        edit_teacher();
    }


}

function load_edit_teacher(event) {
    $('#btn_ok_teacher').attr('status','edit');

    var obj = event.target;
    var info = obj.getAttribute('info');
    var info_live = JSON.parse(info);
    console.log("info_live");
    console.log(info_live);

    $('#btn_ok_teacher').attr('teacher_id',info_live.teacher_id);


    $('#name_teacher_insert').val(info_live.name);
    $('#info_teacher_insert').val(info_live.info);


    if (info_live.giaotiep === '1'){
        var check = true;
    }else{
        var check = false;
    }
    $('#teacher_giaotiep_insert').prop('checked',check);

    if (info_live.toeic === '1'){
        var check = true;
    }else{
        var check = false;
    }
    $('#teacher_toeic_insert').prop('checked',check);


    if (info_live.ielts === '1'){
        var check = true;
    }else{
        var check = false;
    }
    $('#teacher_ielts_insert').prop('checked',check);

    if (info_live.aland === '1'){
        var check = true;
    }else{
        var check = false;
    }
    $('#teacher_aland_insert').prop('checked',check);



    $('#insert_teacher_modal').modal('show');

    // var array_convert = [];
}

function load_del_teacher(event) {
    var obj = event.target;
    var info = obj.getAttribute('info');
    var info_live = JSON.parse(info);
    console.log("info_live");
    console.log(info_live);

    var r = confirm("Bạn có muốn xóa Giảng viên :\n" + "Tên: " + info_live.name +'\nThông tin: ' + info_live.info );
    if (r == true) {
        $.post("/feedback/request",{
                optcod: 'del_teacher', // có thể include optcode này vào đâu ko ?
                token: 'abcd',
                teacher_id: info_live.teacher_id,
            },
            function (data, status) {
                console.log(data);
                make_effect_submit_done('btn_ok_teacher'); // có bao gồm reload
            });
    } else {
        // txt = "You pressed Cancel!";
    }

}

function edit_teacher(){
    var my_info = captain.getForm('insert_teacher_modal');
    if (my_info.name_teacher_insert.trim() === ''){
        alert('Bạn cần điền tên giáo viên');
        return null;
    }
    // console.log("here");
    var teacher_id = $('#btn_ok_teacher').attr('teacher_id');
    make_effect_submitting('btn_ok_teacher');

    $.post("/feedback/request",{
            optcod: 'edit_teacher', // có thể include optcode này vào đâu ko ?
            token: 'abcd',
            teacher_id: teacher_id,
            name_teacher_insert: my_info.name_teacher_insert,
            info_teacher_insert: my_info.info_teacher_insert,
            teacher_giaotiep_insert: my_info.teacher_giaotiep_insert,
            teacher_toeic_insert: my_info.teacher_toeic_insert,
            teacher_ielts_insert: my_info.teacher_ielts_insert,
            teacher_aland_insert: my_info.teacher_aland_insert,
        },
        function (data, status) {
            console.log(data);
            make_effect_submit_done('btn_ok_teacher');
        });



}

function insert_teacher(){
    var my_info = captain.getForm('insert_teacher_modal');
    if (my_info.name_teacher_insert.trim() === ''){
        alert('Bạn cần điền tên giáo viên');
        return null;
    }
    make_effect_submitting('btn_ok_teacher');

    $.post("/feedback/request",{
        optcod: 'insert_teacher', // có thể include optcode này vào đâu ko ?
        token: 'abcd',
        teacher_giaotiep_insert: my_info.teacher_giaotiep_insert,
        teacher_ielts_insert: my_info.teacher_ielts_insert,
        teacher_toeic_insert: my_info.teacher_toeic_insert,
        teacher_aland_insert: my_info.teacher_aland_insert,
        info_teacher_insert: my_info.info_teacher_insert,
        name_teacher_insert: my_info.name_teacher_insert,
    },
    function (data, status) {
        console.log(data);
        make_effect_submit_done('btn_ok_teacher');
    });

}

//=================================================

function make_effect_submitting(id_btn){
    $('#' + id_btn).attr('disabled',true);
    var old_content = $('#' + id_btn).html();
    $('#' + id_btn).attr('old_content',old_content);
    $('#' + id_btn).html('Submitting');
}

function make_effect_submit_done(id_btn){
    $('#' + id_btn).attr('disabled',false);
    var old_content = $('#' + id_btn).attr('old_content');
    $('#' + id_btn).html(old_content);

    // hide all modal
    location.reload();
}



$(document).ready(function () {
    // bind event md bootstrap
    $('.select2_input').select2();

});

// captain
var captain = {
    aboutMe: function(){
        console.log("Im Captain. Read Document about me in https:// ");
    },
    getValById: function(id){
        var tagName = $('#' + id).get(0).tagName.toLowerCase();
        switch (tagName) {
            case "input":
                var type = $('#' + id).attr('type').toLowerCase();
                if (type === 'radio'){
                    // ========== gom value ntn ?

                }
                if (type === 'checkbox'){
                    return $('#' + id).prop('checked');
                }
                return $('#' + id).val();
            case "select":
                // Trả về giá trị value của thẻ đã selected
                // mutiply sẽ trả về 1 array
                var caption_get = $('#' + id).attr('caption_get');

                if ( ( typeof caption_get !== 'undefined' ) && (caption_get.trim().toLowerCase() === 'text' ) ){
                    // mutiply
                    var multiple = $('#' + id).attr('multiple');
                    var res = [];
                    $("#" + id + " > option").each(function() {
                        if (this.selected  == true){
                            res.push(this.text);
                        }
                    });

                    if (res.length === 1){
                        if ( ( multiple === 'multiple' ) || (multiple === true) ){
                            return res;
                        }else{
                            return res[0];
                        }
                    }

                    // return $('#' + id).children("option:selected").text();
                    return res;
                }
                return $('#' + id).val();

            case 'textarea':
                return $('#' + id).val();
            default:
                return $('#' + id).html();
        }
    },
    getForm: function(id_div, arr_tag, arr_id_more){
        var arr_tag_available = ['input', 'textarea', 'p', 'h1', 'h2','h3','h4','h5','h6'];

        if (typeof arr_tag === 'undefined'){
            arr_tag = ['input','textarea']; // default
        }

        var res = [];

        for (var i = 0; i < arr_tag.length; i++) {
            var mono = arr_tag[i];

            if (! arr_tag_available.includes(mono)){
                continue;
            }

            if (mono === 'input') {
                $("#" +id_div + " :" + mono).each(function () {
                    var id = $(this).attr('id');

                    if (( typeof id === 'undefined') || ( id === '' )) {
                        var name = $(this).attr('name');
                        if (( typeof name === 'undefined') || ( name === '' )){
                            id = captain.genIdElement(15);
                            $(this).attr('id',id);
                            res[id] = captain.getValById(id);
                        }else{
                            // id = name;
                            res[name] = captain.getValById(id);
                        }
                    }
                    res[id] = captain.getValById(id);
                });
            }else{

                $("#" +id_div).find('textarea').each(function () {
                    var id = $(this).attr('id');
                    if (( typeof id === 'undefined') || ( id === '' )) {
                        var name = $(this).attr('name');
                        if (( typeof name === 'undefined') || ( name === '' )){
                            id = captain.genIdElement(15);
                            $(this).attr('id',id);
                            res[id] = captain.getValById(id);
                        }else{
                            // id = name;
                            res[name] = captain.getValById(id);
                        }
                    }
                    res[id] = captain.getValById(id);
                });

            }

        }

        if (typeof arr_id_more !== 'undefined'){
            if (typeof arr_id_more === 'string'){
                arr_id_more = [arr_id_more];
            }
            for (var k = 0; k < arr_id_more.length; k++) {
                var mono_id = arr_id_more[k];
                res[mono_id] = captain.getValById(id);
            }
        }
        return res;
    },
    genIdElement: function(length){
        if (typeof length === 'undefined'){
            length = 10;
        }
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    },
    inArray: function(value,arr){
        return arr.includes(value);
    },
    // ============ Code 30.07 below
    merge: function (obj_total,obj1, obj2) {

        // Object.assign(my_info, plus1, plus2); // Thêm obj plus1 và plus 2 vào obj my_info
        // console.log("my_info");
        // console.log(my_info);
        //

    },
    copyToClipboard: function (val_copy) {
        // Cần show thẻ input trước rồi mới có thể set data
        if ($('#captain_copy_to_clipboard').length === 0){
            $('body').append('<input type="text" value="" id="captain_copy_to_clipboard" style="height: 0px;">');
        }else{
            $('#captain_copy_to_clipboard').css('display','block');
        }

        // Cần show thẻ input trước rồi mới có thể set data
        $('#captain_copy_to_clipboard').val(val_copy);
        var copyText = document.getElementById("captain_copy_to_clipboard");
        copyText.select();
        document.execCommand("copy");
        $('#captain_copy_to_clipboard').css('display','none !important');
    },
};
