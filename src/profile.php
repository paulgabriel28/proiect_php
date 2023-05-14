<?php
if (!is_user_logged_in()) {
    redirect_to('/paulgabriel.ro/auth/index.php');
}

$user = find_user_by_username(current_user());

if (is_follow_button_request()) {
    if (follow_user($_POST['follower_id'], $_POST['following_id'], $_POST['following_name'])) {
        redirect_with_message(
            'profile.php?user=' . $_POST['username'],
            'You have successfully followed ' . $_POST['username'] 
        );
    }
}