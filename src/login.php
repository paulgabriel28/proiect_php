<?php

if (is_user_logged_in()) {
    redirect_to('public/index.php');
}

$inputs = [];
$errors = [];

if (is_post_request()) {

    [$inputs, $errors] = filter($_POST, [
        'username' => 'string | required',
        'password' => 'string | required'
    ]);

    if ($errors) {
        redirect_with('login.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    }


    if (!login($inputs['username'], $inputs['password'])) {
        redirect_with_message(
            'login.php',
            'Invalid username or password!',
            FLASH_ERROR
        );
    }

    redirect_with_message(
        'index.php',
        'Successfully connected!'
    );

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}