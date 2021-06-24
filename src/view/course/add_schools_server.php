<?php

require_once '../../core/init.php';



if (Input::exists()) {

	$validate = new Validate();
	$validation = $validate->check($_POST, array(
		'Title'         => array(
		'required'      => true
		)
	));

	if ($validation->passed()) {
		$user = Db::getInstance();

		try {
			$user->insert('schools', array(
				'title'     => Input::get('Title')
			));

			echo 'School added successfully';
		} catch (Exception $e) {
			die($e->getMessage());
		}
	} else {

		foreach ($validation->errors() as $error) {
			echo $error . '<br />';
		}
	}
}
