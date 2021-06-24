<?php

require_once '../../core/init.php';

$id = $_POST['id'];

if (Input::exists()) {
    
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'Category'     => array(
            'required'      =>  true,
            ),
            'added_by'      =>  array(
            'required'      =>  true,
            )
        ));

        if ($validation->passed()) {
            $user = Db::getInstance();

            try {
                    $user->update('programmes', $id, array(
                         'category' => Input::get('Category'),
                         'added_by' => Input::get('added_by')
                    ));

                    echo 'Programme updated successfully';
                
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo $error . '<br />';
            }
        }
    }



