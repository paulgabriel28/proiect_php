<?php
require __DIR__ . '/../../src/bootstrap.php';
require __DIR__ . '/../../src/create_ticket.php';
require_login();
$user = find_user_by_username(current_user());
?>

<?php view('header', ['title' => 'Create ticket']) ?>

<body>
    <div class="container">
        <div class="main-body">

            <a href="?users=<?= $user['username'] ?>" style="text-decoration:none; color:black">
                <img src="src/avatars/avatar<?= $user['avatar_id'] ?>.png" class="rounded-circle" alt="avatar" style="width:20px"> <b>
                    <?= $user['username'] ?>
                </b>
            </a>
            <br><br>

            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php" style="text-decoration:none">Home</a></li>
                    <li class="breadcrumb-item"><a href="tickets.php" style="text-decoration:none">Tickets</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-decoration:none">Create Ticket
                    </li>
                </ol>
            </nav>


            <form action="create_ticket.php" method="POST">
                <div class="card">
                    <div class="card-body" style="text-align:center;">
                        <h5 style="font-size:30px">Create a ticket!</h5>


                        <br>
                        <b style="font-size:22px">Title</b><br>
                        <textarea id="text_ticket" rows="1" maxlength="40" class="form-control <?= error_class($errors, 'title') ?>" name="title" style="width:350px; overflow: none; text-align:center; resize:none; outline: none; text-align:center; margin: auto;" placeholder="Introdu titlul..." spellcheck="false"></textarea>
                        <small>
                            <br>
                            <?= $errors['title'] ?? '' ?>
                        </small>
                        </p>


                        <br>
                        <b style="font-size:22px">Ticket priority</b><br>
                        <select id="priority" name="priority" style="width:400px; text-align:center; margin: auto;" class="form-control">
                            <option value="1">Low</option>
                            <option value="2">High</option>
                            <option value="3">Very High</option>
                        </select>

                        <br>
                        <small>
                            <?= $errors['priority'] ?? '' ?>
                        </small>

                        <br>
                        <br>
                        <b style="font-size:22px">Details</b>
                        <br>
                        <textarea id="text_ticket" rows="7" maxlength="1000" class="form-control <?= error_class($errors, 'text') ?> " name="text" style="width:500px; overflow: auto; resize:none; outline: none; padding:7px; text-align:center; margin:auto" placeholder='Descrie problema ta aici...'></textarea>
                        <br>
                        <small>
                            <?= $errors['text'] ?? '' ?>
                        </small>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-info" name="create_ticket_button" type="submit" id="create_ticket_button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    Creeaza</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="card">
                <div class="card-body">
                    <h4>Your active tickets!</h4>
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
                                if ($row['status'] == 1 and ($row['user_id'] == $user['id'])) {
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
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <style>
                input[type="radio"] {
                    appearance: none;
                    -webkit-appearance: none;
                    -moz-appearance: none;
                    width: 12px;
                    height: 12px;
                    border-radius: 50%;
                    border: 2px solid #000;
                    outline: none;
                    margin-right: 3px;
                    margin-left: 20px;

                }

                input[type="radio"]:checked {
                    background-color: #17a2b8;
                }
            </style>

            <?php view('footer') ?>