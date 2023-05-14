<?php
ob_start();
require __DIR__ . '/../src/bootstrap.php';

if (logout()) {
    redirect_with_message(
        'login.php',
        'You have successfully logged out!'
    );
}
ob_end_flush();