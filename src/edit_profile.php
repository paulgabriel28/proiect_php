<?php

if (!is_user_logged_in()) {
    redirect_to('/paulgabriel.ro/auth/index.php');
}

$user = find_user_by_username(current_user());

$errors = [];
$inputs = [];

if (is_save_profile_request()) {
        $fields = [
            'name' => 'string | between: 5, 50',
            'email' => 'email | required | unique: users, email',
            'phone' => 'int | required | between 9, 15 | unique: users, phone',
            'adress' => 'string',
            'country' => 'string | required | between: 2, 5',
            'about_me' => 'string',
            'avatar_id' => 'int'
        ];
    
        $messages = [
            'email' => [
                'required' => '* Please enter an email'
            ],
            'country' => [
                'required' => '* Please enter a country (ISO ID)'
            ],
            'phone' => [
                'required' => '* Please enter a phone number'    
            ]
    
        ];
    
        [$inputs, $errors] = filter($_POST, $fields, $messages);
    
        if ($errors) {
            redirect_with('edit_profile.php', [
                'inputs' => $inputs,
                'errors' => $errors
            ]);
        }
        
        if (save_profile($inputs['name'], $inputs['email'], $inputs['phone'], $inputs['adress'], $inputs['country'], $inputs['about_me'], $inputs['avatar_id'], $user['id'])) {
    
            redirect_with_message(
                'profile.php',
                'Profile settings saved successfully!'
            );
        }
    }

if(is_save_skills_request()) {
    $fields = [
        'web_design' => 'int | required | between: 0, 100',
        'java_script' => 'int | required | between: 0, 100',
        'cs' => 'int | required | between: 0, 100',
        'cpp' => 'int | required | between: 0, 100',
        'python' => 'int | required | between: 0, 100',
    ];

    $messages = [
        'web_design' => [
            'required' => 'Enter skill'
        ],
        'java_script' => [
            'required' => 'Enter skill'
        ],
        'cs' => [
            'required' => 'Enter skill'
        ],
        'cpp' => [
            'required' => 'Enter skill'
        ],
        'python' => [
            'required' => 'Enter skill'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('edit_profile.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    if (save_profile_skills($inputs['web_design'], $inputs['java_script'], $inputs['cs'], $inputs['cpp'], $inputs['python'], $user['id'])) {

        redirect_with_message(
            'profile.php',
            'Profile skills saved successfully!'
        );
    }
}                     

if(is_save_accounts_request()) {
    $fields = [
        'website' => 'string | between: 0, 100',
        'github' => 'string | between: 0, 50',
        'instagram' => 'string  | between: 0, 50',
        'facebook' => 'string  | between: 0, 50',
    ];

    $messages = [
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('edit_profile.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    if (save_profile_accounts($inputs['website'], $inputs['github'], $inputs['instagram'], $inputs['facebook'], $user['id'])) {

        redirect_with_message(
            
            'profile.php',
            '<div class="container"> Profile accounts saved successfully!</div>'
        );
    }
}                     

else if (is_get_request()) {
        [$errors, $inputs] = session_flash('errors', 'inputs');
}
