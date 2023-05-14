<?php

if (!is_user_logged_in()) {
    redirect_to('/paulgabriel.ro/auth/index.php');
}
$admin = find_user_by_username(current_user());

$errors = [];
$inputs = [];

if (admin_save_profile_button()) {
    $fields = [
        'username' => 'username',
        'name' => 'string ',
        'email' => 'email',
        'phone' => 'int',
        'adress' => 'string',
        'country' => 'string',
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
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_username'];
    if ($errors) {
        redirect_with('admin_settings.php?user=' . $user_name.'#profile', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    if ($inputs['username'] == null)
        $inputs['username'] = '';

    if ($inputs['name'] == null)
        $inputs['name'] = '';

    if ($inputs['email'] == null)
        $inputs['email'] = '';

    if ($inputs['phone'] == null)
        $inputs['phone'] = 0;

    if ($inputs['adress'] == null)
        $inputs['adress'] = '';

    if ($inputs['country'] == null)
        $inputs['country'] = 'unk';

    if ($inputs['about_me'] == null)
        $inputs['about_me'] = '';

    if ($inputs['avatar_id'] == null)
        $inputs['avatar_id'] = 0;

    if ($country == null)
        $country = 'unk';

    if (admin_save_profile($inputs ['username'], $inputs['name'], $inputs['email'], $inputs['phone'], $inputs['adress'], $inputs['country'], $inputs['about_me'], $inputs['avatar_id'], $user_id)) {

        redirect_with_message(
            'admin_settings.php?user=' . $user_name.'#profile',
            'Profile settings saved successfully!'
        );
    }
} elseif (admin_save_roles_button()) {
    $set_staff = $_POST["set_staff"];
    $set_role = $_POST["set_role"];
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_username'];
    if (admin_save_roles($set_staff, $set_role, $user_id)) {
        $_SESSION['user'] = $user;
        redirect_with_message(
            'admin_settings.php?user=' . $user_name.'#roles',
            'Roles (permissions) saved successfully!'
        );
    }

} elseif (admin_save_accounts_button()) {
    $fields = [
        'website' => 'string | between: 0, 100',
        'github' => 'string | between: 0, 50',
        'instagram' => 'string  | between: 0, 50',
        'facebook' => 'string  | between: 0, 50',
    ];

    $messages = [
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_username'];
    if ($errors) {
        redirect_with('admin_settings.php?user=' . $user_name.'#accounts', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    if (admin_save_accounts($inputs['website'], $inputs['github'], $inputs['instagram'], $inputs['facebook'], $user_id)) {

        redirect_with_message(

            'admin_settings.php?user=' . $user_name.'#accounts',
            'Profile accounts saved successfully!</div>'
        );
    }
} elseif (admin_save_skills_button()) {
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
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_username'];
    if ($errors) {
        redirect_with('admin_settings.php?user=' . $user_name .'#skills', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    if (admin_save_skills($inputs['web_design'], $inputs['java_script'], $inputs['cs'], $inputs['cpp'], $inputs['python'], $user_id)) {

        redirect_with_message(
            'admin_settings.php?user=' . $user_name.'#skills',
            'Profile skills saved successfully!'
        );
    }
} elseif (admin_remove_followers_button()) {
    $fields = [
        'remove_followers' => 'string | required',
    ];

    $messages = [
        'remove_followers' => [
            'required' => '* Enter a follower username!'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_username'];
    if ($errors) {
        redirect_with('admin_settings.php?user=' . $user_name . '#remove_followers', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    $follower_name = find_user_by_username($inputs['remove_followers']);
    if (admin_remove_follower($user_id, $follower_name['id'])) {

        redirect_with_message(
            'admin_settings.php?user=' . $user_name . '#remove_followers',
            'You have successfully removed follower: ' . $follower_name['username'] . ' from user: ' . $user_name
        );
    }
} elseif (admin_remove_following_button()) {
    $fields = [
        'remove_following' => 'string | required',
    ];

    $messages = [
        'remove_following' => [
            'required' => '* Enter a follower!'
        ]
    ];

    [$inputs, $errors] = filter($_POST, $fields, $messages);
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_username'];
    if ($errors) {
        redirect_with('admin_settings.php?user=' . $user_name . '#remove_following', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }
    $follower_name = find_user_by_username($inputs['remove_following']);
    if (admin_remove_follower($follower_name['id'], $user_id)) {

        redirect_with_message(
            'admin_settings.php?user=' . $user_name . '#remove_following',
            'You have successfully removed follower: ' . $follower_name['username'] . ' from user: ' . $user_name
        );
    }

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}