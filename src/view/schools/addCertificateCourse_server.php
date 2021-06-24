<?php

require_once '../../core/init.php';



if (Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        
        'course'      => array(
            'required'      => true
        )
    ));

    if ($validation->passed()) {
        $user = Db::getInstance();

        try {
            $user->insert('certificate_courses', array(
                'certificate_id'     => Input::get('certificate'),
                'course_id' => Input::get('course')
            ));

            echo 'Course added to Certificate successfully';
        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {

        foreach ($validation->errors() as $error) {
            echo $error . '<br />';
        }
    }
}
