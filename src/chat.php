<?php
if (!is_user_logged_in()) {
    redirect_to('/paulgabriel.ro/auth/index.php');
}

$user = find_user_by_username(current_user());

$errors = [];
$inputs = [];



if (is_send_message_request()) {
    $fields = [
        'from_id' => 'int',
        'to_id' => 'int',
        'message' => 'string | required | between 1, 50'
    ];

    $messages = [
        'message' => [
            'required' => '* Enter a message!'
        ]

    ];

    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('chat.php?user=' . $user_name, [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    
    if (send_message($user['id'], $user_id, $inputs['message'])) {
    
        redirect_with_message(
            'chat.php?user=' . $user_name,
            ''
        );
    }
}
else {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}
