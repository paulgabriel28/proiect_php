<?php
    $user = find_user_by_username(current_user());
    
    $errors = [];
    $inputs = [];
    
    
    
    if (send_message_global_chat_request()) {
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
    
        [$inputs, $errors] = filter($_POST, $fields, $messages);
    
        if ($errors) {
            redirect_with('../index.php', [
                'inputs' => $inputs,
                'errors' => $errors
            ]);
        }
        
        if (send_message_global_chat($user['id'], $user['username'], $inputs['message'])) {
        
            redirect_with_message(
                '../index.php',
                ''
            );
        }
    }
    else {
        [$errors, $inputs] = session_flash('errors', 'inputs');
    }

?>