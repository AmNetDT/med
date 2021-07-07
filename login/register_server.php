<?php
require_once '../core/init.php';



  if (Input::exists()) {
  
    if (Token::check(Input::get('token'))) {
      $validate = new Validate();
      $validation = $validate->check($_POST, array(
      
      'firstname'    => array(
      'require'      => true
      ),
      'lastname'     => array(
      'require'      => true
      ), 
      'email'        => array(
      'required'     => true,
      ),
      'phone'        => array(
      'require'      => true
      ),
      'syscategory'  => array(
      'require'      => true
      ),
      'password'     => array(
      'require'      => true,
      'min'          => 6
      ),
      'confirm'  =>  array(
      'required'          =>  true,
      'matches'           => 'password'
      )
    ));

      if ($validation->passed()) {
        $user = new User();
        $salt = Hash::salt(32);
        
        try {
          $user->create('users', array(
            'firstname'     => Input::get('firstname'),
            'lastname'      => Input::get('lastname'),
            'email'         => Input::get('email'),
            'phone'         => Input::get('phone'),
            'syscategory'   => Input::get('syscategory'),
            'password'      => Hash::make(Input::get('password'), $salt),
            'salt'          => $salt,
            'joined'        => date('Y-m-d H:i:s')
          ));

        echo 'You have successfully registered a student';
          
          
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



