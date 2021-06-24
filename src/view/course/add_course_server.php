<?php

require_once '../../core/init.php';



if (Input::exists()) {

	$validate = new Validate();
	$validation = $validate->check($_POST, array(
		'title'         => array(
			'required'      => true
		),
		'school' => array(
			'require' => true
		),
		'test' => array(
			'require' => true
		),
		'exam'         => array(
			'required'      => true
		),
		'added_by' => array(
			'require' => true
		)
	));

	if ($validation->passed()) {
		$user = Db::getInstance();

		try {
			$user->insert('courses', array(
				'title'    => Input::get('title'),
				'school'   => input::get('school'),
				'lecturer' => Input::get('lecturer'),
				'test' 	   => input::get('test'),
				'exam'     => Input::get('exam'),
				'added_by' => input::get('added_by')
			));

			echo 'Course added successfully';
		} catch (Exception $e) {
			die($e->getMessage());
		}
	} else {

		foreach ($validation->errors() as $error) {
			echo $error . '<br />';
		}
	}
}
