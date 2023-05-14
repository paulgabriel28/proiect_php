<?php 
if (!is_user_logged_in()) {
    redirect_to('/paulgabriel.ro/auth/index.php');
}

$errors = [];
$inputs = [];

if (search_user_by_username_button()) {
    $fields = [
        'username' => 'string|required'
    ];

    $messages = [
        'username' => [
            'required' => '* Enter an username!'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);
    if ($errors) {
        redirect_with('search.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

    if (search_user_by_username($inputs['username'])) {
        redirect_with_message(
            'search.php?user=' . $inputs['username'],
            'The user <b>'. $inputs['username']. '</b> has been found'
        );
    }
    else {
        redirect_with_message(
            'search.php?user=' . $inputs['username'],
            'User <b>'. $inputs['username'] .'</b> not found!',
            FLASH_ERROR
        );
    }
}

    else if (is_get_request()) {
        [$errors, $inputs] = session_flash('errors', 'inputs');
    }