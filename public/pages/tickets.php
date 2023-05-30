<?php

require __DIR__ . '/../../src/bootstrap.php';
require __DIR__ . '/../../src/tickets.php';
require_login();
$show_search = 1;
$user_admin = find_user_by_username(current_user());
?>

<?php view('header', ['title' => 'Tickets']) ?>

<body>
    <div class="container">
        <div class="main-body">

            <a href="?users=<?= $user_admin['username'] ?>" style="text-decoration:none; color:black">
                <img src="src/avatars/avatar<?= $user_admin['avatar_id'] ?>.png" class="rounded-circle" alt="avatar" style="width:20px"> <b>
                    <?= $user_admin['username'] ?>
                </b>
            </a>
            <br><br>




            <?php
            if (!isset($_GET['id'])) { ?>
                <nav aria-label="breadcrumb" class="main-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php" style="text-decoration:none">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page" style="text-decoration:none">Tickets</li>
                    </ol>
                </nav>

                <a href="create_ticket.php"><button class="btn btn-info" name="#" type="submit" id="#" style="width:100%"><i class="fa fa-ticket" aria-hidden="true"></i> Create a ticket</button></a>

                <div class="card-body">
                    <table class="table">
                        <thead style="background-color:#BBD2F0">
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Username</th>
                                <th>Date</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody style="background-color:#CFDDF0">


                            <?php
                            $query = "SELECT * FROM tickets ORDER BY ID DESC";
                            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['status'] == 1 and ($user_admin['role'] >= 5 or $row['user_id'] == $user_admin['id'])) {
                                    echo "<td>" . $row['ID'] . "</td>";
                                    $find_user = find_user_by_id($row['user_id']);
                                    echo "<td> <img src='src/avatars/avatar" . $find_user['avatar_id'] . ".png' alt='Admin' class='rounded-circle' width='50'></td>";

                                    echo "<td> <a style='text-decoration:none' href='profile.php?user=" . $find_user['username'] . "'>" . $find_user['username'] . "</a>";

                                    echo "<td>";
                                    echo $row['date'];
                                    echo "</td>";

                                    echo "<td>";
                                    if ($row['priority'] == 1)
                                        echo "Low";
                                    elseif ($row['priority'] == 2)
                                        echo "High";
                                    elseif ($row['priority'] == 3)
                                        echo "Very High";
                                    echo "</td>";

                                    echo "<td>";
                                    if ($row['status'] == 1)
                                        echo " <span class='label' style='background-color:#2eb82e;'><i style='position:relative; left:-4px;' class='fa fa-plus-square' aria-hidden='true'></i>Open</span>";
                                    else
                                        echo " <span class='label' style='background-color:#ff0000;'><i style='position:relative; left:-4px;' class='fa fa-minus-square' aria-hidden='true'></i>Closed</span>";

                                    echo "</td>";


                                    echo "<td>";
                                    echo "<a href='?id=" . $row['ID'] . "'>View</a>";
                                    echo "</td>";

                                    echo "<tr>";
                                }
                            }

                            $query = "SELECT * FROM tickets ORDER BY ID DESC";
                            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['status'] == 0 and ($user_admin['role'] >= 5 or $row['user_id'] == $user_admin['id'])) {
                                    echo "<td>" . $row['ID'] . "</td>";
                                    $find_user = find_user_by_id($row['user_id']);
                                    echo "<td> <img src='src/avatars/avatar" . $find_user['avatar_id'] . ".png' alt='Admin' class='rounded-circle' width='50'></td>";

                                    echo "<td> <a style='text-decoration:none' href='profile.php?user=" . $find_user['username'] . "'>" . $find_user['username'] . "</a>";

                                    echo "<td>";
                                    echo $row['date'];
                                    echo "</td>";

                                    echo "<td>";
                                    if ($row['priority'] == 1)
                                        echo "Low";
                                    elseif ($row['priority'] == 2)
                                        echo "High";
                                    elseif ($row['priority'] == 3)
                                        echo "Very High";
                                    echo "</td>";

                                    echo "<td>";
                                    if ($row['status'] == 1)
                                        echo " <span class='label' style='background-color:#2eb82e;'><i style='position:relative; left:-4px;' class='fa fa-plus-square' aria-hidden='true'></i>Open</span>";
                                    else
                                        echo " <span class='label' style='background-color:#ff0000;'><i style='position:relative; left:-4px;' class='fa fa-minus-square' aria-hidden='true'></i>Closed</span>";

                                    echo "</td>";


                                    echo "<td>";
                                    echo "<a href='?id=" . $row['ID'] . "'>View</a>";
                                    echo "</td>";

                                    echo "<tr>";
                                }
                            }
                            echo '</tbody>';
                        } else { ?>

                            <?php
                            $find_user = find_user_by_id_ticket($_GET['id']);
                            $user = find_user_by_id($find_user['user_id']);
                            if ($user_admin['id'] == $find_user['user_id'] or $user_admin['role'] >= 5) { ?>
                                <nav aria-label="breadcrumb" class="main-breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="../index.php" style="text-decoration:none">Home</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="tickets.php" style="text-decoration:none">Tickets</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page" style="text-decoration:none">
                                            Ticket - #
                                            <?= $_GET['id'] ?>
                                        </li>
                                    </ol>
                                </nav>

                                <div class="row gutters-sm">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <img src="src/avatars/avatar<?= $user['avatar_id'] ?>.png" alt="Admin" class="rounded-circle" width="170">
                                                <div class="mt-3">
                                                    <h4>
                                                        <a style="text-decoration: none;" href="profile.php?user=<?= $user['username']?>"><?= $user['username'] ?> </a>

                                                    </h4>

                                                    <?php if ($user['is_admin'] == 1) : ?>
                                                        <span class="label" style="background-color:black;"><i style="position:relative; left:-4px;" class="fa fa-rocket" aria-hidden="true"></i>Staff</span>
                                                    <?php else : ?>
                                                        <span class="label" style="background-color:#6d9edf;"><i style="position:relative; left:-4px;" class="fa fa-user-o" aria-hidden="true"></i>Newbie</span>
                                                    <?php endif; ?>
                                                    <?php if ($user['role'] == 7) : ?>
                                                        <span class="label" style="background-color:#b30000;"><i style="position:relative; left:-4px;" class="fa fa-commenting-o" aria-hidden="true"></i>Founder</span>
                                                    <?php elseif ($user['role'] == 6) : ?>
                                                        <span class="label" style="background-color:#e60000;"><i style="position:relative; left:-4px;" class="fa fa-cogs" aria-hidden="true"></i>Owner</span>
                                                    <?php elseif ($user['role'] == 5) : ?>
                                                        <span class="label" style="background-color:#ff1a1a;"><i style="position:relative; left:-4px;" class="fa fa-cog" aria-hidden="true"></i>Co-Owner</span>
                                                    <?php elseif ($user['role'] == 4) : ?>
                                                        <span class="label" style="background-color:#997a00;"><i style="position:relative; left:-4px;" class="fa fa-cloud" aria-hidden="true"></i>Manager</span>
                                                    <?php elseif ($user['role'] == 3) : ?>
                                                        <span class="label" style="background-color:#33cc33;"><i style="position:relative; left:-4px;" class="fa fa-tachometer" aria-hidden="true"></i>Engineer</span>
                                                    <?php elseif ($user['role'] == 2) : ?>
                                                        <span class="label" style="background-color:#0000ff;"><i style="position:relative; left:-4px;" class="fa fa-comments-o" aria-hidden="true"></i>Support</span>
                                                    <?php elseif ($user['role'] == 1) : ?>
                                                        <span class="label" style="background-color:#cc7a00;"><i style="position:relative; left:-4px;" class="fa fa-eraser" aria-hidden="true"></i>Tester</span>
                                                    <?php endif; ?>

                                                    <?php if ($user['about_me']) : ?>
                                                        <p></p>
                                                        About: <b>
                                                            <?= $user['about_me'] ?>
                                                        </b>
                                                    <?php endif; ?>

                                                    <br>
                                                    E-Mail: <b>
                                                        <?= $user['email'] ?>
                                                    </b>
                                                    <br>
                                                    Phone: <b>+40
                                                        <?= $user['phone'] ?>
                                                    </b>
                                                    <br>
                                                    Created at: <b>
                                                        <?= $user['created_at'] ?>
                                                    </b>

                                                    <br>
                                                    <?php if ($user_admin['role'] >= 5) { ?>
                                                        <p></p>
                                                        <a href="admin_settings.php?user=<?= $user['username'] ?>"><button class="btn btn-danger" style="background-color:red; border-color:transparent;" href="edit_profile.php"><i style="position:relative; left:-4px;" class="fa fa-wrench" aria-hidden="true"></i>Admin
                                                                Settings</button></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h6 style="text-align:center" class="card-title">Ticket detalis</h6>
                                            <h5>Informations</h5>
                                            <h6 style="padding-left:20px">
                                                <?= $find_user['title'] ?>
                                            </h6>
                                            <h6 style="padding-left:20px">
                                                Status:
                                                <?php
                                                if ($find_user['status'] == 1)
                                                    echo " <span class='label' style='background-color:#2eb82e;'><i style='position:relative; left:-4px;' class='fa fa-plus-square' aria-hidden='true'></i>Open</span>";
                                                else {
                                                    $answer_user = find_user_by_id($find_user['answer']);
                                                    echo " <span class='label' style='background-color:#ff0000;'><i style='position:relative; left:-4px;' class='fa fa-minus-square' aria-hidden='true'></i>Closed</span>";
                                                    echo " - " . $find_user['date_answer'] . ' by <b>' . $answer_user['username'] . '</b>';
                                                }
                                                echo "</td>";
                                                ?>
                                            </h6>
                                            <h6 style="padding-left:20px">
                                                Date: <?= $find_user['date'] ?>
                                            </h6>

                                            <br>
                                            <h5>Detalis</h5>
                                            <p style="margin-left:10px; margin-right:10px"><?= $find_user['text'] ?></p>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Comments</h5>
                                            <div>
                                                <?php
                                                $ticket = $_GET['id'];
                                                $sql = "SELECT * FROM tickets_comments WHERE (ticket_id = $ticket) ORDER BY id_comment ASC";
                                                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                                $result = mysqli_query($conn, $sql);
                                                while ($ticket_chat = mysqli_fetch_assoc($result)) {
                                                    $sender = find_user_by_id($ticket_chat['sender_id']);
                                                    echo '<div>';
                                                    echo '<img src="src/avatars/avatar' . $sender['avatar_id'] . '.png" alt="avatar" class="rounded-circle" style="width:35px;"> ';
                                                    echo '<b><a style="text-decoration:none; color:black" href="profile.php?user='.$sender['username'].'"><span class="message-data-time">' . $sender['username'] . '</span></a>';
                                                    if ($find_user['user_id'] == $ticket_chat['sender_id'])
                                                        echo ' <span class="label" style="background-color:#26c6da; font-size:10px">Ticket Creator</span> ';
                                                    else
                                                        echo ' <span class="label" style="background-color:#000; font-size:10px">Staff</span> ';
                                                    echo ':</b>';
                                                    echo ' ' . $ticket_chat['text'];
                                                    echo '</div>';
                                                }
                                                ?>
                                            </div>
                                            <br>
                                            <form action="tickets.php" method="POST">
                                                <?php if ($find_user['status']) { ?>
                                                    <textarea id="text_ticket" rows="4" maxlength="500" class="form-control <?= error_class($errors, 'text') ?> " name="text" style="width:100%; overflow: auto; resize:none; outline: none; padding:7px" placeholder='Write a comment...'></textarea>
                                                    <small>
                                                        <?= $errors['text'] ?? '' ?>
                                                    </small>
                                                    <br>
                                                    <input type="hidden" name="sender_id" value="<?= $user_admin['id']; ?>" />
                                                    <input type="hidden" name="ticket_id" value="<?= $_GET['id']; ?>" />
                                                    <button class="btn btn-info" name="ticket_message_button" type="submit" id=""><i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                        Send</button>
                                                    <?php if ($user_admin['role'] >= 5) {
                                                    ?>
                                                        <button class="btn btn-danger" name="ticket_close_button" type="submit" style="background-color:red; border-color:red;" id=""><i class="fa fa-cog" aria-hidden="true"></i>
                                                            Close ticket</button>

                                                    <?php }
                                                } else {
                                                    if ($user_admin['role'] >= 5) { ?>
                                                        <input type="hidden" name="ticket_id" value="<?= $_GET['id']; ?>" />
                                                        <input type="hidden" name="sender_id" value="<?= $user_admin['id']; ?>" />
                                                        <button class="btn" name="ticket_reopen_button" type="submit" style="background-color:#ffff33; border-color:#ffff33;" id=""><i class="fa fa-refresh" aria-hidden="true"></i>
                                                            Reopen ticket</button>
                                                <?php }
                                                } ?>
                                            </form>
                                        </div>
                                    </div>

                                </div>


                        <?php
                            } else
                                redirect_to('tickets.php');
                        }
                        ?>

                        <?php view('footer') ?>