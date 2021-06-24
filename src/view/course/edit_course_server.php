<?php

require_once '../../core/init.php';

$id = $_POST['id'];

if (Input::exists()) {

	$validate = new Validate();
	$validation = $validate->check($_POST, array(
		'Title'         => array(
			'required'      => true
		),
		'School'         => array(
			'required'      => true
		),
		'Lecturer'      => array(
			'required'      => true
		),
		'Test'         => array(
			'required'      => true
		),
		'Exam'      => array(
			'required'      => true
		),
		'added_by'      =>  array(
			'required'      =>  true
		)
	));

	if ($validation->passed()) {
		$user = Db::getInstance();

		try {
			$user->update('courses', $id, array(
				'title' => Input::get('Title'),
				'school'     => Input::get('School'),
				'lecturer'  => Input::get('Lecturer'),
				'test'  => Input::get('Test'),
				'exam'  => Input::get('Exam'),
				'added_by'  => Input::get('added_by')
			));

			echo 'Course updated successfully';
		} catch (Exception $e) {
			die($e->getMessage());
		}
	} else {

		foreach ($validation->errors() as $error) {
			echo $error . '<br />';
		}
	}
}
