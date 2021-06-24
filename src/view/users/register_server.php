<?php
require_once '../../core/init.php';

$member_id = $_POST['username'];
$syscategory = $_POST['syscategory'];
$user = new User();


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
        'added_by'        => array(
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
        $user = new User();
        $salt = Hash::salt(32);
        
        try {
          $user->create('users', array(
            'username'      => Input::get('username'),
            'syscategory'   => Input::get('syscategory'),
            'school'        => Input::get('school'),
            'location'      => Input::get('location'),
            'added_by'      => Input::get('added_by'),
            'password'      => Hash::make(Input::get('password'), $salt),
            'salt'          => $salt,
            'joined'        => date('Y-m-d H:i:s')
          ));

        if(Input::get('syscategory') != 5){// syscategory 5 is student

                $user->create('staff_record', array(
                  'member_id' => Input::get('username'),
                  'added_by' => Input::get('added_by')
                ));
                echo 'You have successfully registered a staff';

        }else{

                $user->create('students_record', array(
                  'member_id' => Input::get('username'),
                  'added_by' => Input::get('added_by')
                ));
                echo 'You have successfully registered a student';
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



