<?php
$config['test_type'] = array(
	//1 => array('name' => '[Toeic] Photo'), // trac nghiem ko hien cau tra loi 
	//2 => array('name' => '[Toeic] Question-Response'),
	1 =>'Listening',
	2 =>'Reading', // trac nghiem ko hien detail
	3 =>'Writing',
	4 =>'Speaking',

	//20 => array('name' => 'Bài tập viết'),
	//30 => array('name' => 'Bài tập ghi âm'),
);
$config['cambridge_test_type'] = array(
    //Reading & Writing
	1 => array('name' => '[Reading & Writing] Xác định tính đúng/sai của dữ kiện với hình ảnh'),
	2 => array('name' => '[Reading & Writing] Đánh vần từ theo hình ảnh'),
	3 => array('name' => '[Reading & Writing] Điền từ vào chỗ trống - Chọn từ trong danh sách có sẵn'),
	4 => array('name' => '[Reading & Writing] Điền từ vào chỗ trống - Không có từ cho trước'),
	5 => array('name' => '[Reading & Writing] Trả lời câu hỏi ngắn về câu chuyện kể bằng hình ảnh.'),
	6 => array('name' => '[Reading & Writing] Nối câu đúng để hoàn thành hội thoại'),
	7 => array('name' => '[Reading & Writing] Trắc nghiệm chọn đáp án đúng'),
	8 => array('name' => '[Reading & Writing] Viết số từ quy định để hoàn thành câu'),
	9 => array('name' => '[Reading & Writing] Viết đoạn văn ngắn'),

	//Listening
	10 => array('name' => '[Listening] Nối tên với người trong tranh'),
	11 => array('name' => '[Listening] Nghe trả lời câu hỏi về đứa trẻ hoặc động vật'),
	12 => array('name' => '[Listening] Điền từ để hoàn thành câu'),
	13 => array('name' => '[Listening] Nghe và chọn hình ảnh đúng'),
	14 => array('name' => '[Listening] Nghe - Ghép từng người được nói tới với hình ảnh/đối tượng tương ứng'),
	15 => array('name' => '[Listening] Nghe và tô màu, viết vào tranh theo chỉ dẫn'),

	//Speaking
	16 => array('name' => '[Speaking] Hỏi và trả lời về 1 tấm ảnh'),
	17 => array('name' => '[Speaking] Trả lời các câu hỏi ngắn về tấm ảnh.'),
	18 => array('name' => '[Speaking] Trả lời các câu hỏi ngắn về đồ vật trong ảnh.'),
	19 => array('name' => '[Speaking] Tìm điểm khác nhau trong 2 bức ảnh'),
	20 => array('name' => '[Speaking] Kể chuyện'),
	21 => array('name' => '[Speaking] Hỏi và trả lời về bản thân'),
	22 => array('name' => '[Speaking] Yêu cầu và đưa ra thông tin về 2 tình huống tương tự.'),
);
$config['course_class_type'] = array(
	1 => 'Bài học',
	2 => 'Test kỹ năng',
);
$config['cate_type'] = array(
	1 => array('name' => 'Tin tức', 'code' => 'tin-tuc', 'module' => 'news'),
	2 => array('name' => 'Test', 'code' => 'test', 'module' => 'test'),
	3 => array('name' => 'Quảng cáo', 'code' => 'advertise', 'module' => 'advertise'),
	4 => array('name' => 'Khóa học', 'code' => 'course', 'module' => 'course'),
	5 => array('name' => 'Video', 'code' => 'video', 'module' => 'video')
);

$config['test_answer_type'] = array(
	1 => array(
		101 => 'Chọn đáp án',
		102 => 'Điền từ vào chỗ trống',
		103 => 'Trắc nghiệm chọn đáp án đúng',
		104 => 'Trắc nghiệm chọn nhiều đáp án',
	),
	2 => array(
		100 => 'True / False / Not Given',
		101 => 'Chọn đáp án',
		102 => 'Điền từ vào chỗ trống',
		103 => 'Trắc nghiệm chọn đáp án đúng',
		104 => 'Trắc nghiệm chọn nhiều đáp án',
	),
	3 => array(
		201 => 'Writing',
	),
	4 => array(
		301 => 'Speaking',
	),
);

$config['cate_news_type'] = array(
	1 => 'News',
	2 => 'Khóa học',
	3 => 'Video'
);
$config['news_theme'] = array(
	1 => 'Nomal',
	2 => 'Photo'
);
$config['device'] = array(
    0 => 'All device',
    1 => 'Mobile',
    4 => 'PC'
);
$config['location'] = array(
    1 => 'Hà Nội',
	2 => 'Hồ Chí Minh',
	3 => 'Đà Nẵng',
	4 => 'Khác'
);
