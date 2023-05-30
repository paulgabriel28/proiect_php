<?php


function view(string $filename, array $data = []): void
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once __DIR__ . '/../inc/' . $filename . '.php';
}

function import_page(string $filename, array $data = []): void
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }
    require_once __DIR__ . '/../../public/pages/' . $filename . '.php';
}

function error_class(array $errors, string $field): string
{
    return isset($errors[$field]) ? 'error' : '';
}


function is_post_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}

function is_save_profile_request() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_profile_button']);
}

function is_save_skills_request() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_skills_button']);
}

function is_send_message_request() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_message_button']);
}

function send_message_global_chat_request() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_message_global_chat_button']);
}

function is_follow_button_request() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['follow_button']);
}

function create_ticket_request() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_ticket_button']);
}

function ticket_message_request() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ticket_message_button']);
}

function ticket_close_request() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ticket_close_button']);
}

function ticket_reopen_request() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ticket_reopen_button']);
}


function find_chat() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['find_chat_user']);
}

function is_save_accounts_request() 
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_accounts_button']);
}

function admin_save_profile_button()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_save_profile_button']); 
}

function admin_save_roles_button()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_save_roles_button']);
}

function admin_save_accounts_button()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_save_accounts_button']);
}

function admin_save_skills_button()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_save_skills_button']);
}

function admin_remove_followers_button()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_remove_followers_button']);
}

function admin_remove_following_button()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['admin_remove_following_button']);
}

function search_user_by_username_button()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_user_by_username']);
}

function is_get_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'GET';
}


function redirect_to(string $url): void
{
    header('Location:' . $url);
    exit;
}


function redirect_with(string $url, array $items): void
{
    foreach ($items as $key => $value) {
        $_SESSION[$key] = $value;
    }

    redirect_to($url);
}


function redirect_with_message(string $url, string $message, string $type = FLASH_SUCCESS)
{
    flash('flash_' . uniqid(), $message, $type);
    redirect_to($url);
}


function session_flash(...$keys): array
{
    $data = [];
    foreach ($keys as $key) {
        if (isset($_SESSION[$key])) {
            $data[] = $_SESSION[$key];
            unset($_SESSION[$key]);
        } else {
            $data[] = [];
        }
    }
    return $data;
}
