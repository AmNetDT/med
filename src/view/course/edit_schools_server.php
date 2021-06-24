<?php

require_once '../../core/init.php';

$id = $_POST['id'];

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
			$user->update('schools', $id, array(
				'title' => Input::get('Title')
			));

			echo 'Schools updated successfully';
		} catch (Exception $e) {
			die($e->getMessage());
		}
	} else {

		foreach ($validation->errors() as $error) {
			echo $error . '<br />';
		}
	}
}
