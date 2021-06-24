<?php

require_once '../../core/init.php';



if (Input::exists()) {

    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'Category'         => array(
        'required'      => true
        ),
        'added_by' => array(
            'require' => true
        )
    ));

    if ($validation->passed()) {
        $user = Db::getInstance();

        try {
            $user->insert('programmes', array(
                'category'     => Input::get('Category'),
                'added_by' => input::get('added_by')
            ));

            echo 'Programme added successfully';
        } catch (Exception $e) {
            die($e->getMessage());
        }
    } else {

        foreach ($validation->errors() as $error) {
            echo $error . '<br />';
        }
    }
}
