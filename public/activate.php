<?php
ob_start();
require __DIR__ . '/../src/bootstrap.php';

if (is_get_request()) {
    [$inputs, $errors] = filter($_GET, [
        'email' => 'string | required | email',
        'activation_code' => 'string | required'
    ]);

    if (!$errors) {

        $user = find_unverified_user($inputs['activation_code'], $inputs['email']);

        if ($user && activate_user($user['id'])) {
            redirect_with_message(
                'login.php',
                'You account has been activated successfully. Please login here.'
            );
        }
    }
}

redirect_with_message(
    'register.php',
    'The activation link is not valid (expired / incorrect), please register again.',
    FLASH_ERROR
);
ob_end_flush();
