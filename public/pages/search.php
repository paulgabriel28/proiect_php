<?php

require __DIR__ . '/../../src/bootstrap.php';
require __DIR__ . '/../../src/search.php';
require_login();
$show_search = 1;
$user = find_user_by_username(current_user());
?>

<?php view('header', ['title' => 'Search user']) ?>

<body>
    <div class="container">
        <div class="main-body">

            <a href="?users=<?= $user['username'] ?>" style="text-decoration:none; color:black">
                <img src="src/avatars/avatar<?= $user['avatar_id'] ?>.png" class="rounded-circle" alt="avatar"
                    style="width:20px"> <b>
                    <?= $user['username'] ?>
                </b>
            </a>
            <br><br>

            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php" style="text-decoration:none">Home</a></li>
                    <li class="breadcrumb-item"><a href="users.php" style="text-decoration:none">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-decoration:none">Search</li>
                </ol>
            </nav>


            <?php if (isset($_GET['user'])) {

                $users = search_user_by_username($_GET['user']);
                if (search_user_by_username($_GET['user']) != NULL) { ?>
                    <div class="card-body">
                        <table class="table">
                            <thead style="background-color:#BBD2F0">
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Roles</th>
                                    <th>Country</th>
                                </tr>
                            </thead>
                            <tbody style="background-color:#CFDDF0">
                                <img src="" alt="">
                                <?php
                                $user_count = 0;
                                foreach ($users as $user) {
                                    $user_count++;
                                    echo '<td>' . $user_count . "</td>";

                                    echo "<td>" . $user['id'] . "</td>";

                                    echo "<td> <img src='src/avatars/avatar" . $user['avatar_id'] . ".png' alt='Admin' class='rounded-circle' width='50'></td>";

                                    echo "<td> <a style='text-decoration:none' href='profile.php?user=" . $user['username'] . "'>" . $user['username'] . "</a>";
                                    if (find_follower($user['id'], $user['id'])) {
                                        echo '<small>';
                                        echo '<br>';
                                        echo '<h6 style="color:green; font-size: .80em">* Following</h6>';
                                        echo '</small>';
                                        echo '</td>';
                                    } else
                                        echo '</td>';
                                    echo "<td>" . $user['name'] . "</td>";

                                    echo "<td>";
                                    if ($user['is_admin'] == 1)
                                        echo "<span class='label' style='background-color:black;'><i style='position:relative; left:-4px;' class='fa fa-rocket' aria-hidden='true'></i>Staff</span>";
                                    else
                                        echo "<span class='label' style='background-color:#6d9edf;'><i style='position:relative; left:-4px;' class='fa fa-user-o' aria-hidden='true'></i>Newbie</span>";

                                    if ($user['role'] == 7)
                                        echo " <span class='label' style='background-color:#b30000;'><i style='position:relative; left:-4px;' class='fa fa-commenting-o' aria-hidden='true'></i>Founder</span>";
                                    elseif ($user['role'] == 6)
                                        echo " <span class='label' style='background-color:#e60000;'><i style='position:relative; left:-4px;' class='fa fa-cogs' aria-hidden='true'></i>Owner</span>";
                                    elseif ($user['role'] == 5)
                                        echo " <span class='label' style='background-color:#ff1a1a;'><i style='position:relative; left:-4px;' class='fa fa-cog' aria-hidden='true'></i>Co-Owner<Co-Owner</span>";
                                    elseif ($user['role'] == 4)
                                        echo " <span class='label' style='background-color:#997a00;'><i style='position:relative; left:-4px;' class='fa fa-cloud' aria-hidden='true'></i>Manager</span>";
                                    elseif ($user['role'] == 3)
                                        echo " <span class='label' style='background-color:#33cc33;'><i style='position:relative; left:-4px;' class='fa fa-tachometer' aria-hidden='true'></i>Engineer</span>";
                                    elseif ($user['role'] == 2)
                                        echo " <span class='label' style='background-color:#0000ff;'><i style='position:relative; left:-4px;' class='fa fa-comments-o' aria-hidden='true'></i>Support</span>";
                                    elseif ($user['role'] == 1)
                                        echo " <span class='label' style='background-color:#cc7a00;'><i style='position:relative; left:-4px;' class='fa fa-eraser' aria-hidden='true'></i>Tester</span>";
                                    echo "</td>";

                                    echo "<td> <img style='border:0.1px solid; border-color: gray' src='src/flags/" . $user['country'] . ".svg' width='30'></td>";

                                    echo "<tr>";
                                }
                                echo '</tbody>';
                }

            } else { ?>
                            <form action="search.php" method="POST">
                                <div class="card">
                                    <div class="card-body" style="text-align:center; align-items-center:">
                                        <h5>Search an user (by username)</h5>
                                        <input type="text" autocomplete="off" class="form-control" name="username"
                                            id="username" style="width:800px; text-align:center; margin: auto;"
                                            value="<?= $inputs['username'] ?? '' ?>">
                                        <small>
                                            <?= $errors['username'] ?? '' ?>
                                        </small>

                                        <br>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button class="btn btn-info" name="search_user_by_username" type="submit"
                                                    id="search_user_by_username"><i class="fa fa-search"
                                                        aria-hidden="true"></i>
                                                    Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <?php
            }
            ?>



                        <!-- 
            </div>
            <form action="search.php" method="POST">
                <div class="card">
                    <div class="card-body" style="text-align:center; align-items-center:">
                        <h5>Search an user (by email - SOON)</h5>
                        <input type="text" class="form-control" name="email" id="email"
                            style="width:800px; text-align:center; margin: auto;"
                            value="<?= $inputs['email'] ?? '' ?>">
                        <small>
                            <?= $errors['email'] ?? '' ?>
                        </small>

                        <br>

                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-info" name="search_user_by_email" type="submit"
                                    id="search_user_by_email"><i class="fa fa-search" aria-hidden="true"></i>
                                    Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> -->
                        <?php view('footer') ?>