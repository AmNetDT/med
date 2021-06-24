<?php

require_once '../../core/init.php';

$id = $_POST['id'];

if (Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'Programme'         => array(
        'required'      => true
        ),
        'Title'         => array(
        'required'      => true
        ),
        'Duration'      => array(
        'required'      => true
        ),
        'added_by'      =>  array(
        'required'      =>  true
        )
    ));

    if ($validation->passed()) {
        $user = Db::getInstance();

        try {
            $user->update('certificates', $id, array(
                'programme' => Input::get('Programme'),
                'title'     => Input::get('Title'),
                'course_objective' => Input::get('Objectives'),
                'duration'  => Input::get('Duration'),
                'added_by'  => Input::get('added_by')
            ));

            echo 'Certificate updated successfully';
        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {

        foreach ($validation->errors() as $error) {
            echo $error . '<br />';
        }
    }
}
