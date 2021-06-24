<?php

require_once '../../core/init.php';

$id = $_POST['user_id'];
$member_id = $_POST['username'];

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username'        => array(
                'required'        => true,
                'min'             =>  6,
                'max'             =>  11
            ),
            'syscategory'     => array(
                'require'         => true
            ),
            'school'          => array(
                'require'         => true
            ),
            'location'        => array(
                'require'         => true
            ),
            'password'        => array(
                'require'         => true,
                'min'             => 6
            ),
            'confirm_password'  =>  array(
                'required'          =>  true,
                'matches'           => 'password'
            )
        ));

        if ($validation->passed()) {
            $user = Db::getInstance();
            $salt = Hash::salt(32);

            try {
                $user->update("users", $id, array(
                    'username' => Input::get('username'),
                    'syscategory' => Input::get('syscategory'),
                    'school' => Input::get('school'),
                    'location' => Input::get('location'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt,
                    'joined' => date('Y-m-d H:i:s')
                ));


                if (Input::get('syscategory') != 5) { // syscategory 5 is student

                    $user->update('staff_record', $member_id, array(
                        'member_id' => Input::get('username'),
                        'added_by' => Input::get('added_by')
                    ));
                    echo 'You have successfully update a staff';
                } else {

                    $user->update('students_record', $member_id, array(
                        'member_id' => Input::get('username'),
                        'added_by' => Input::get('added_by')
                    ));

                    $user->update('payment', $member_id, array(
                        'member_id' => Input::get('username'),
                        'added_by' => Input::get('added_by')
                    ));

                    echo 'You have successfully update a student';
                }
          
                
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {

            foreach ($validation->errors() as $error) {
                echo $error . '<br />';
            }
        }
    }
}