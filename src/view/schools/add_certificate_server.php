<?php

require_once '../../core/init.php';



if (Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'title'         => array(
        'required'      => true
        ),
        'duration'      => array(
            'required'      => true
        ),
        'programme'      => array(
            'required'      => true
        ),
        'added_by'      =>  array(
        'required'      =>  true
        )
    ));

    if ($validation->passed()) {
        $user = Db::getInstance();

        try {
            $user->insert('certificates', array(
                'title'     => Input::get('title'),
                'course_objective' => Input::get('Objectives'),
                'duration'  => Input::get('duration'),
                'programme'  => Input::get('programme'),
                'added_by'  => Input::get('added_by')
            ));

            echo 'Certificate added successfully';
        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {

        foreach ($validation->errors() as $error) {
            echo $error . '<br />';
        }
    }
}
