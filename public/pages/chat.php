<?php

require __DIR__ . '/../../src/bootstrap.php';
require __DIR__ . '/../../src/chat.php';
require_login();
$user = find_user_by_username(current_user());
?>

<?php
if (isset($_GET['user'])) {
    $username = $_GET['user'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0 || $user['username'] == $username) {
        redirect_with_message(
            'users.php',
            'The account was not found!',
            FLASH_ERROR
        );
    } else {
        $user2 = find_user_by_username($username);
    }
} else
    redirect_with_message(
        '../index.php',
        'Open a chat with someone!',
        FLASH_ERROR
    );

view('header', ['title' => 'Chat - ' . $user2['username']]);
?>



<body>
    <div class="container">
        <nav aria-label="breadcrumb" class="main-breadcrumb">

            <a href="?users=<?= $user['username'] ?>" style="text-decoration:none; color:black">
                <img src="src/avatars/avatar<?= $user['avatar_id'] ?>.png" class="rounded-circle" alt="avatar"
                    style="width:20px"> <b>
                    <?= $user['username'] ?>
                </b>
            </a>
            <br><br>

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php" style="text-decoration:none">Home</a></li>
                <li class="breadcrumb-item"><a href="users.php" style="text-decoration:none">Users</a></li>
                <li class="breadcrumb-item"><a href="profile.php?user=<?= $user2['username'] ?>"
                        style="text-decoration:none">User Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chat -
                    <?= $user2['username'] ?>
                </li>

            </ol>
        </nav>
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="profile.php?user=<?= $user2['username'] ?>">
                                        <img src="src/avatars/avatar<?= $user2['avatar_id'] ?>.png" alt="avatar">

                                        <div class="chat-about">
                                            <h6 class="m-b-0">
                                                <?= $user2['name'] ?>
                                    </a><br>
                                    <small>
                                        <?= $user2['username'] ?>
                                    </small>
                                    </h6>

                                </div>
                            </div>
                            <div class="col-lg-6 hidden-sm text-right">
                                <a href="#" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                                <a href="#" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                                <a href="#" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                                <a href="#" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="chat-history">
                        <ul class="m-b-0">
                            <?php
                            $to_id = $user['id'];
                            $from_id = $user2['id'];
                            $sql = "SELECT * FROM chats WHERE (to_id = $to_id AND from_id = $from_id) OR (to_id = $from_id AND from_id = $to_id) ORDER BY chat_id ASC";
                            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($chat = mysqli_fetch_assoc($result)) {
                                    if ($user['id'] == $chat['from_id']) {
                                        echo '<li class="clearfix">';
                                        echo '<div class="message-data text-right">';
                                        echo '<span class="message-data-time">' . date("h:i:s (d.m.Y)", strtotime($chat['created_at'])) . ' </span>';
                                        echo '<img src="src/avatars/avatar' . $user['avatar_id'] . '.png" alt="avatar">';
                                        echo '</div>';
                                        echo '<div class="message other-message float-right"> ' . $chat['message'] . '</div>';
                                        echo '</li>';
                                    } else {
                                        echo '<li class="clearfix">';
                                        echo '<div class="message-data">';
                                        echo '<img src="src/avatars/avatar' . $user2['avatar_id'] . '.png" alt="avatar">';
                                        echo '<span class="message-data-time">' . date("h:i:s (d.m.Y)", strtotime($chat['created_at'])) . '</span>';
                                        echo '</div>';
                                        echo '<div class="message my-message"> ' . $chat['message'] . '</div>';
                                        echo '</li>';
                                    }

                                }
                            } else {
                                echo "No messages found.";
                            }
                            mysqli_close($conn);
                            ?>

                        </ul>
                    </div>
                    <form action="chat.php" method="POST">
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <button class="btn btn-info" name="send_message_button" type="submit"><i
                                            class="fa fa-send"></i></button>
                                </div>
                                <input type="hidden" name="user_id" value="<?= $user2['id'] ?>" />
                                <input type="hidden" name="user_name" value="<?= $user2['username'] ?>" />
                                <input type="text" autocomplete="off"
                                    class="form-control <?= error_class($errors, 'message') ?>" name="message"
                                    id="message" value="<?= $inputs['message'] ?? '' ?>"
                                    placeholder="Enter text here...">
                            </div>
                            <small>
                                <?= $errors['message'] ?? '' ?>
                            </small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        // apare mesajul cu js
    </script>
    <?php view('footer') ?>