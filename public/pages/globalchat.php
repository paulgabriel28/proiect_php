<?php
require __DIR__ . '/../../src/bootstrap.php';
require __DIR__ . '/../../src/globalchat.php';
$user = find_user_by_username(current_user());
?>


<div class="container" style="">
    <div class="row clearfix" style="width:500px; margin-left: auto; position:static; margin-right: 5%;">
        <div class="card col-lg-12">
            <div class="chat">
                <div class="chat-header clearfix">
                    <h5>Global Chat</h5>
                </div>
                <div class="chat-history my-div">
                        <ul class="m-b-0">
                            <?php
                            $user_id= $user['id'];
                            $sql = "SELECT * FROM globalchat WHERE (user_id = user_id) ORDER BY chat_id ASC";
                            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($chat = mysqli_fetch_assoc($result)) {
                                    if ($user['id'] == $chat['user_id']) {
                                        echo '<li class="clearfix">';
                                        echo '<div class="message-data text-right">';
                                        echo '<a style="text-decoration:none;" ref="pages/profile.php?user='. $chat['username'] . '"><span class="message-data-time">' . $chat['username'] . ' </span></a>';
                                        echo '<img src="pages/src/avatars/avatar' . $user['avatar_id'] . '.png" alt="avatar">';
                                        echo '</div>';
                                        echo '<div class="message other-message float-right"> ' . $chat['message'];
                                        echo '<div style="margin-top: 5px;margin-bottom: -20px; font-size:10px"><span>' . date("h:i:s \n(d.m.Y)", strtotime($chat['created_at'])) . '</span></div>';
                                        echo '</div>';
                                        echo '</li>';
                                    } else {
                                        $user2 = find_user_by_username($chat['username']);
                                        echo '<li class="clearfix">';
                                        echo '<div class="message-data">';
                                        echo '<img src="pages/src/avatars/avatar' . $user2['avatar_id'] . '.png" alt="avatar">';
                                        echo '<a style="text-decoration:none;" href="pages/profile.php?user='. $chat['username'] . '"><span class="message-data-time">'  .$chat['username'] . '</span></a>';
                                        echo '</div>';
                                        echo '<div class="message my-message" style=""> ' . $chat['message'] . "\n"  ;
                                        echo '<div style="margin-top: 5px;margin-bottom: -20px; font-size:10px"><span>' . date("h:i:s \n(d.m.Y)", strtotime($chat['created_at'])) . '</span></div>';
                                        echo '</div>';
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

                <form action="pages/globalchat.php" method="POST">
                    <div class="chat-message clearfix">
                        <div class="input-group mb-0">
                            <div class="input-group-prepend">
                                <button class="btn btn-info" name="send_message_global_chat_button" type="submit"><i
                                        class="fa fa-send"></i></button>
                            </div>
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>" />
                            <input type="hidden" name="user_name" value="<?= $user['username'] ?>" />
                            <input type="text" class="form-control"
                                name="message" autocomplete="off" id="message" value="<?= $inputs['message'] ?? '' ?>"
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
