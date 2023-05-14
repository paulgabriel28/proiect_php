<?php

require __DIR__ . '/../../src/bootstrap.php';
require __DIR__ . '/../../src/admin_settings.php';
require_login();
$admin = find_user_by_username(current_user());
if ($admin['role'] < 4) {
    redirect_with_message(
        'profile.php',
        "You don't have access!",
        FLASH_ERROR
    );
}

if (isset($_GET['user'])) {
    $username = $_GET['user'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 0) {
        redirect_with_message(
            'users.php',
            'The account was not found!',
            FLASH_ERROR
        );
    } else
        $user = find_user_by_username($username);
}

?>

<?php view('header', ['title' => 'Admin Settings - ' . $user['username']]) ?>

<body>
    <div class="container">
        <div class="main-body">

            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.php" style="text-decoration:none">Home</a></li>
                    <li class="breadcrumb-item"><a href="users.php" style="text-decoration:none">Users</a></li>
                    <li class="breadcrumb-item"><a href="profile.php?user=<?= $user['username'] ?>"
                            style="text-decoration:none">User Profile</a></li>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-decoration:none">Admin
                        Settings -
                        <?= $user['username'] ?>
                    </li>
                    <a href="profile.php" style="margin-left:51%; text-decoration:none; color:black">
                        <li><img src="src/avatars/avatar<?= $admin['avatar_id'] ?>.png" class="rounded-circle"
                                alt="avatar" style="width:20px"> <b>
                                <?= $admin['username'] ?>
                            </b></li>
                    </a>
                </ol>
            </nav>

            <form action="admin_settings.php" method="POST">
                <div class="card" id="profile">
                    <div class=" card-body">
                        <h5 class="d-flex align-items-center mb-3">Profile</h5>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Username</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="username" id="username" value="<?= $user['username'];
                                $inputs['username'] ?? '' ?> ">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" class="form-control" name="name" id="name" value="<?= $user['name'];
                                $inputs['name'] ?? '' ?> ">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="email" id="email" class="form-control" value="<?= $user['email'];
                                $inputs['email'] ?? '' ?>">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone (+40)</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="phone" id="phone" class="form-control" value="<?= $user['phone'];
                                $inputs['phone'] ?? '' ?>">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Adress</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="adress" id="adress" class="form-control" value="<?= $user['adress'];
                                $inputs['adress'] ?? '' ?>">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Country (ISO)</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="country" id="country" class="form-control" value="<?= $user['country'];
                                $inputs['country'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">About Me</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="about_me" id="about_me" class="form-control" value="<?= $user['about_me'];
                                $inputs['about_me'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <a href="avatars.php" style="text-decoration:none">
                                    <h6 class="mb-0">Avatar ID</h6>
                                </a>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="number" min="0" max="8" name="avatar_id" id="avatar_id"
                                    class="form-control" value="<?= $user['avatar_id'];
                                    $inputs['avatar_id'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>" />
                                <input type="hidden" name="user_username" value="<?= $user['username'] ?>" />
                                <button class="btn btn-info" name="admin_save_profile_button" type="submit"
                                    id="button_id_0"><i class="fa fa-floppy-o" style="position:relative; left:-4px;"
                                        aria-hidden="true"></i> Save
                                    profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>



            <form action="admin_settings.php" method="POST">
                <div class="card" id="roles">
                    <div class=" card-body">
                        <h5 class="d-flex align-items-center mb-3">Roles</h5>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Set Staff</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select id="set_staff" name="set_staff" class="form-control">
                                    <option value="1" <?= ($user['is_admin'] == 1) ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= ($user['is_admin'] == 0) ? 'selected' : '' ?> style="color:red">
                                        No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Set Role</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <select id="set_role" name="set_role" class="form-control">
                                    <option value="7" <?= ($user['role'] == 7) ? 'selected' : '' ?>>Founder</option>
                                    <option value="6" <?= ($user['role'] == 6) ? 'selected' : '' ?>>Owner</option>
                                    <option value="5" <?= ($user['role'] == 5) ? 'selected' : '' ?>>Co-Owner</option>
                                    <option value="4" <?= ($user['role'] == 4) ? 'selected' : '' ?>>Manager</option>
                                    <option value="3" <?= ($user['role'] == 3) ? 'selected' : '' ?>>Engineer</option>
                                    <option value="2" <?= ($user['role'] == 2) ? 'selected' : '' ?>>Support</option>
                                    <option value="1" <?= ($user['role'] == 1) ? 'selected' : '' ?>>Tester</option>
                                    <option value="0" <?= ($user['role'] == 0) ? 'selected' : '' ?> style="color:red">
                                        None</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>" />
                                <input type="hidden" name="user_username" value="<?= $user['username'] ?>" />
                                <button class="btn btn-info" name="admin_save_roles_button" type="submit"
                                    id="button_id_0"><i class="fa fa-floppy-o" aria-hidden="true"
                                        style="position:relative; left:-4px;"></i> Save
                                    roles</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>



            <form action="admin_settings.php" method="POST">
                <div class="card" id="accounts">
                    <div class=" card-body">
                        <h5 class="d-flex align-items-center mb-3">Accounts</h5>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-globe mr-2 icon-inline">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="2" y1="12" x2="22" y2="12"></line>
                                        <path
                                            d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                        </path>
                                    </svg>Website</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="website" id="website" class="form-control"
                                    value="<?= $user['website'] ?>">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-github mr-2 icon-inline">
                                        <path
                                            d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                        </path>
                                    </svg>Github</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="github" id="github" class="form-control"
                                    value="<?= $user['github'] ?>">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-instagram mr-2 icon-inline text-danger">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                    </svg>Instagram</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="instagram" id="instagram" class="form-control"
                                    value="<?= $user['instagram'] ?>">
                            </div>
                        </div>



                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-facebook mr-2 icon-inline text-primary">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                        </path>
                                    </svg>Facebook</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="facebook" id="facebook" class="form-control"
                                    value="<?= $user['facebook'] ?>">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>" />
                                <input type="hidden" name="user_username" value="<?= $user['username'] ?>" />
                                <button class="btn btn-info" name="admin_save_accounts_button" type="submit"
                                    id="button_id_0"><i class="fa fa-floppy-o" aria-hidden="true"
                                        style="position:relative; left:-4px;"></i> Save
                                    accounts</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


            <form action="admin_settings.php" method="POST">
                <div class="card" id="skills">
                    <div class="card-body">
                        <h5 class="d-flex align-items-center mb-3">Skills</h5>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <p class="mb-0">Web Design <b>
                                        <?= $user['web_design'] ?>%
                                    </b></p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="number" name="web_design" id="web_design" min="0" max="100"
                                    class="form-control" value="<?= $user['web_design'];
                                    $inputs['web_design'] ?? '' ?>">
                                <small>
                                    <?= $errors['web_design'] ?? '' ?>
                                </small>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <p class="mb-0">Java Script <b>
                                        <?= $user['java_script'] ?>%
                                    </b></p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="number" name="java_script" id="java_script" min="0" max="100"
                                    class="form-control" value="<?= $user['java_script'];
                                    $inputs['java_script'] ?? '' ?>">
                                <small>
                                    <?= $errors['java_script'] ?? '' ?>
                                </small>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <p class="mb-0">C# <b>
                                        <?= $user['cs'] ?>%
                                    </b></p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="number" name="cs" id="cs" min="0" max="100" class="form-control" value="<?= $user['cs'];
                                $inputs['cs'] ?? '' ?>">
                                <small>
                                    <?= $errors['cs'] ?? '' ?>
                                </small>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <p class="mb-0">C++ <b>
                                        <?= $user['cpp'] ?>%
                                    </b></p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="number" name="cpp" id="cpp" min="0" max="100" class="form-control" value="<?= $user['cpp'];
                                $inputs['cpp'] ?? '' ?>">
                                <small>
                                    <?= $errors['cpp'] ?? '' ?>
                                </small>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <p class="mb-0">Python <b>
                                        <?= $user['python'] ?>%
                                    </b></p>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="number" name="python" id="python" min="0" max="100" class="form-control"
                                    value="<?= $user['python'];
                                    $inputs['python'] ?? '' ?>">
                                <small>
                                    <?= $errors['python'] ?? '' ?>
                                </small>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>" />
                                <input type="hidden" name="user_username" value="<?= $user['username'] ?>" />
                                <button class="btn btn-info" type="submit" name="admin_save_skills_button"
                                    value="Refresh Page" onClick="refresh" id="button_id_1"><i class="fa fa-floppy-o"
                                        aria-hidden="true" style="position:relative; left:-4px;"></i> Save
                                    skills</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>



            <?php
            $query = "SELECT * FROM user_followers WHERE follower_id = '{$user['id']}'";
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) != 0) {
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="d-flex align-items-center mb-3">Followers</h5>';
                echo '<h6>';
                while ($follower = mysqli_fetch_assoc($result)) {
                    $user_follower = find_user_by_username($follower['following_name']);
                    echo '<a href="profile.php?user=' . $follower['following_name'] . '" style="text-decoration:none"><img src="src/avatars/avatar' . $user_follower['avatar_id'] . '.png" class="rounded-circle" style="width:15px"> ' . $follower['following_name'] . '</a>';
                    echo '&emsp;';
                }
                ?>
                <hr>
                <form action="admin_settings.php" method="POST">
                    <div class="row mb-3" id="remove_followers">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Remove (from Followers)</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>" />
                            <input type="hidden" name="user_username" value="<?= $user['username'] ?>" />
                            <input type="text" name="remove_followers" id="remove_followers" class="form-control"
                                placeholder="Follower Username" value="<?= $inputs['remove_followers'] ?? '' ?>">
                            <small>
                                <?= $errors['remove_followers'] ?? '' ?>
                            </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-info" name="admin_remove_followers_button" type="submit"
                                id="button_id_0"><i class="fa fa-search-minus" aria-hidden="true"
                                    style="position:relative; left:-4px;"></i>
                                Remove</button>
                        </div>
                    </div>
                </form>
                <?php
                echo '</h6>';
                echo '</div> ';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="d-flex align-items-center mb-3">Followers</h5>';
                echo '<h6> This user is not being followed by anyone!';
                echo '</h6>';
                echo '</div> ';
                echo '</div>';
            }


            $query = "SELECT * FROM user_followers WHERE following_id = '{$user['id']}'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) != 0) {
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="d-flex align-items-center mb-3">Following</h5>';
                echo '<h6>';
                while ($follower = mysqli_fetch_assoc($result)) {
                    $user_follower = find_user_by_id($follower['follower_id']);
                    echo '<a href="profile.php?user=' . $user_follower['username'] . '" style="text-decoration:none"><img src="src/avatars/avatar' . $user_follower['avatar_id'] . '.png" class="rounded-circle" style="width:15px"> ' . $user_follower['username'] . '</a>';
                    echo '&emsp;';
                }
                echo '</h6>';
                ?>
                <hr>
                <form action="admin_settings.php" method="POST">
                    <div class="row mb-3" id="remove_following">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Remove (from Following)</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>" />
                            <input type="hidden" name="user_username" value="<?= $user['username'] ?>" />
                            <input type="text" name="remove_following" id="remove_following" class="form-control"
                                placeholder="Follower Username" value="<?= $inputs['remove_following'] ?? '' ?>">
                            <small>
                                <?= $errors['remove_following'] ?? '' ?>
                            </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button class="btn btn-info" name="admin_remove_following_button" type="submit"
                                id="button_id_0"><i class="fa fa-search-minus" aria-hidden="true"
                                    style="position:relative; left:-4px;"></i>
                                Remove</button>
                        </div>
                    </div>
                </form>
                <?php
                echo '</div> ';
                echo '</div>';
            } else {
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="d-flex align-items-center mb-3">Following</h5>';
                echo '<h6> This user is not following anyone!';
                echo '</h6>';
                echo '</div> ';
                echo '</div>';
            }
            ?>

            <div class="card" id="logs">
                <div class="card-body">
                    <h5 class="d-flex align-items-center mb-3">Logs</h5>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <p class="mb-0"> Last Update <b><a href="#last_update"
                                        style="text-decoration:none; color:black">(view)</a></b></p>
                            <p class="mb-0"> Chat Logs <b><a href="#chat_logs"
                                        style="text-decoration:none; color:black">(view)</a></b></p>
                            <p class="mb-0"> Activation Logs <b><a href="#activation_logs"
                                        style="text-decoration:none; color:black">(view)</a></b></p>
                            <p class="mb-0"> Profile Logs <b><a href="#profile_logs"
                                        style="text-decoration:none; color:black">(view)</a></b></p>
                        </div>

                    </div>
                    <?php
                    $current_url = $_SERVER['REQUEST_URI'];

                    // Verificați dacă URL-ul curent conține o ancoră "last_update"
                    if (strpos($current_url, "#last_update") !== false) {
                        // Afișați containerul aici
                        echo "<div id='container'>...</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


    </div>
    <?php view('footer') ?>