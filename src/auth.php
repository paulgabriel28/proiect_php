<?php

/**
 * Register a user
 *
 * @param string $email
 * @param string $username
 * @param string $password
 * @param bool $is_admin
 * @return bool
 */
function register_user(string $email, string $username, string $password, string $activation_code, int $expiry = 1 * 24 * 60 * 60, bool $is_admin = false): bool
{
    $sql = 'INSERT INTO users(username, email, password, is_admin, activation_code, activation_expiry, website, github, instagram, facebook, country)
            VALUES(:username, :email, :password, :is_admin, :activation_code, :activation_expiry, :website, :github, :instagram, :facebook, :country)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
    $statement->bindValue(':is_admin', (int) $is_admin, PDO::PARAM_INT);
    $statement->bindValue(':activation_code', password_hash($activation_code, PASSWORD_DEFAULT));
    $statement->bindValue(':activation_expiry', date('Y-m-d H:i:s', time() + $expiry));
    $statement->bindValue(':website', '-');
    $statement->bindValue(':github', '-');
    $statement->bindValue(':instagram', '-');
    $statement->bindValue(':facebook', '-');
    $statement->bindValue(':country', 'unk');

    return $statement->execute();
}

function find_user_by_username(string $username)
{
    $sql = 'SELECT username, password, active, email, is_admin, id, activation_code, created_at, updated_at, activated_at, web_design, java_script, cs, cpp, python, website, github, instagram, facebook, name, role, adress, phone, country, avatar_id, about_me
            FROM users
            WHERE username=:username';

    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function find_user_by_id(int $id)
{
    $sql = 'SELECT username, password, active, email, is_admin, activation_code, created_at, updated_at, activated_at, web_design, java_script, cs, cpp, python, website, github, instagram, facebook, name, role, adress, phone, country, avatar_id, about_me
            FROM users
            WHERE id=:id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function find_follower(int $follower_id, int $find_follow)
{
    $sql = 'SELECT id, following_id, following_name, timestamp
            FROM user_followers
            WHERE follower_id=:follower_id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':follower_id', $follower_id);
    $statement->execute();

    while ($follower = $statement->fetch(PDO::FETCH_ASSOC)) {
        if ($follower['following_id'] == $find_follow) {
            return true;
        }
    }

    return false;
}

function login(string $username, string $password): bool
{
    $user = find_user_by_username($username);

    if ($user && !is_user_active($user) && password_verify($password, $user['password'])) {
        redirect_with_message(
            'login.php',
            'Your account has not been verified, check your email to verify your account!',
            FLASH_ERROR
        );
    }

    if ($user && is_user_active($user) && password_verify($password, $user['password'])) {
        session_regenerate_id();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        return true;
    }

    return false;
}

function is_user_logged_in(): bool
{
    return isset($_SESSION['username']);
}
function require_login(): void
{
    if (!is_user_logged_in()) {
        redirect_with_message(
            'login.php',
            "You can access that page after logging in!",
            FLASH_ERROR
        );
    }
}

function logout(): void
{
    if (is_user_logged_in()) {
        unset($_SESSION['username'], $_SESSION['user_id']);
        redirect_with_message(
            'login.php',
            "You have successfully logged out!"
        );
        session_destroy();
    }
}
function current_user()
{
    if (is_user_logged_in()) {
        return $_SESSION['username'];
    }
    return null;
}


function is_user_active($user)
{
    return (int) $user['active'] === 1;
}

function delete_user_by_id(int $id, int $active = 0)
{
    $sql = 'DELETE FROM users
            WHERE id =:id and active=:active';

    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->bindValue(':active', $active, PDO::PARAM_INT);

    return $statement->execute();
}

function find_unverified_user(string $activation_code, string $email)
{

    $sql = 'SELECT id, activation_code, activation_expiry < now() as expired
            FROM users
            WHERE active = 0 AND email=:email';

    $statement = db()->prepare($sql);

    $statement->bindValue(':email', $email);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ((int) $user['expired'] === 1) {
            delete_user_by_id($user['id']);
            return null;
        }
        if (password_verify($activation_code, $user['activation_code'])) {
            return $user;
        }
    }

    return null;
}

function activate_user(int $user_id): bool
{
    $sql = 'UPDATE users
            SET active = 1,
                activated_at = CURRENT_TIMESTAMP
            WHERE id=:id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $user_id, PDO::PARAM_INT);

    return $statement->execute();
}

function send_activation_email(string $email, string $activation_code): void
{
    $activation_link = APP_URL . "/activate.php?email=$email&activation_code=$activation_code";
    $subject = 'Please activate your account';
    $message = "
            Hi,\nPlease click the following link to activate your account:\n$activation_link\n";
    $header = "From: no-reply@paulgabriel.ro";
    mail($email, $subject, nl2br($message), $header);
}

function generate_activation_code(): string
{
    return bin2hex(random_bytes(16));
}

function save_profile(string $name, string $email, int $phone, string $adress, string $country, string $about_me, int $avatar_id, int $user_id): bool
{
    $sql = "UPDATE users
    SET name='$name',
        email='$email',
        phone='$phone',
        adress='$adress',
        country='$country',
        about_me='$about_me',
        avatar_id='$avatar_id'
    WHERE id='$user_id'";
    $statement = db()->prepare($sql);
    return $statement->execute();
}

function save_profile_skills(int $web_design, int $java_script, int $cs, int $cpp, int $python, int $user_id): bool
{
    $sql = "UPDATE users
    SET web_design='$web_design',
        java_script='$java_script',
        cs='$cs',
        cpp='$cpp',
        python='$python'
    WHERE id='$user_id'";

    $statement = db()->prepare($sql);
    return $statement->execute();
}

function save_profile_accounts(string $website, string $github, string $instagram, string $facebook, int $user_id): bool
{
    $sql = "UPDATE users
    SET website = '$website',
        github = '$github',
        instagram = '$instagram',
        facebook = '$facebook'
    WHERE id='$user_id'";

    $statement = db()->prepare($sql);
    return $statement->execute();
}

function admin_save_profile(string $username, string $name, string $email, int $phone, string $adress, string $country, string $about_me, int $avatar_id, int $user_id): bool
{
    $sql = "UPDATE users
    SET username ='$username',
        name='$name',
        email='$email',
        phone='$phone',
        adress='$adress',
        country='$country',
        about_me='$about_me',
        avatar_id='$avatar_id'
    WHERE id='$user_id'";
    $statement = db()->prepare($sql);
    return $statement->execute();
}

function admin_save_roles($is_admin, $role, $user_id)
{
    $sql = "UPDATE users
    SET is_admin='$is_admin',
        role='$role'
    WHERE id='$user_id'";
    $statement = db()->prepare($sql);
    return $statement->execute();
}

function admin_save_accounts(string $website, string $github, string $instagram, string $facebook, int $user_id): bool
{
    $sql = "UPDATE users
    SET website = '$website',
        github = '$github',
        instagram = '$instagram',
        facebook = '$facebook'
    WHERE id='$user_id'";

    $statement = db()->prepare($sql);
    return $statement->execute();
}

function admin_save_skills(int $web_design, int $java_script, int $cs, int $cpp, int $python, int $user_id): bool
{
    $sql = "UPDATE users
    SET web_design='$web_design',
        java_script='$java_script',
        cs='$cs',
        cpp='$cpp',
        python='$python'
    WHERE id='$user_id'";

    $statement = db()->prepare($sql);
    return $statement->execute();
}

function admin_remove_follower($follower_id, $following_id)
{
    $sql = 'DELETE FROM user_followers
    WHERE follower_id=:follower_id AND following_id=:following_id';

    $statement = db()->prepare($sql);

    $statement->bindValue(':follower_id', $follower_id);
    $statement->bindValue(':following_id', $following_id);

    return $statement->execute();
}


function find_user_chat(string $username)
{
    $sql = 'SELECT 
            FROM users
            WHERE username=:username';

    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function send_message(int $from_id, int $to_id, string $message)
{
    $sql = 'INSERT INTO chats(from_id, to_id, message)
            VALUES(:from_id, :to_id, :message)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':from_id', $from_id);
    $statement->bindValue(':to_id', $to_id);
    $statement->bindValue(':message', $message);

    return $statement->execute();
}

function follow_user(int $follower_id, int $following_id, string $following_name)
{
    $sql = 'INSERT INTO user_followers(follower_id, following_id, following_name)
            VALUES(:follower_id, :following_id, :following_name)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':follower_id', $follower_id);
    $statement->bindValue(':following_id', $following_id);
    $statement->bindValue(':following_name', $following_name);

    return $statement->execute();
}

function search_user_by_username(string $username)
{
    $sql = "SELECT username, active, email, is_admin, id, name, role, country, avatar_id FROM users WHERE username LIKE :username";
    $statement = db()->prepare($sql);
    $statement->bindValue(':username', "%$username%");
    $statement->execute();

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function send_message_global_chat(int $user_id, string $username, string $message)
{
    $sql = 'INSERT INTO globalchat(user_id, username, message)
            VALUES(:user_id, :username, :message)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':user_id', $user_id);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':message', $message);

    return $statement->execute();
}

function create_ticket(int $user_id, string $title, int $priority, string $text)
{
    $sql = 'INSERT INTO tickets(user_id, title, priority, text)
    VALUES(:user_id, :title, :priority, :text)';

    $statment = db()->prepare($sql);

    $statment->bindValue(':user_id', $user_id);
    $statment->bindValue(':title', $title);
    $statment->bindValue(':priority', $priority);
    $statment->bindValue(':text', $text);

    return $statment->execute();
}

function find_user_by_id_ticket(int $id)
{
    $sql = 'SELECT user_id, title, text, priority, date, status, answer, date_answer
            FROM tickets
            WHERE ID=:id';

    $statement = db()->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function send_ticket_message(int $ticket_id, int $sender_id, string $text)
{
    $sql = 'INSERT INTO tickets_comments(ticket_id, sender_id, text)
    VALUES(:ticket_id, :sender_id, :text)';

    $statment = db()->prepare($sql);

    $statment->bindValue(':ticket_id', $ticket_id);
    $statment->bindValue(':sender_id', $sender_id);
    $statment->bindValue(':text', $text);

    return $statment->execute();
}

function close_ticket(int $ticket_id, int $answer_id)
{
    $sql = 'UPDATE tickets SET status = 0, answer = :answer, date_answer = CURRENT_TIMESTAMP WHERE ID = :ticket_id';

    $statement = db()->prepare($sql);

    $statement->bindValue(':answer', $answer_id);
    $statement->bindValue(':ticket_id', $ticket_id);

    return $statement->execute();
}

function reopen_ticket(int $ticket_id)
{
    $sql = 'UPDATE tickets SET status = 1, answer = NULL, date_answer = NULL WHERE ID = :ticket_id';

    $statement = db()->prepare($sql);

    $statement->bindValue(':ticket_id', $ticket_id);

    return $statement->execute();
}
