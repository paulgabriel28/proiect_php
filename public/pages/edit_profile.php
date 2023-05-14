<?php

require __DIR__ . '/../../src/bootstrap.php';
require __DIR__ . '/../../src/edit_profile.php';
require_login();
$user = find_user_by_username(current_user());
?>
<?php view('header', ['title' => 'Profile - ' . $user['username']]) ?>

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
                    <li class="breadcrumb-item"><a href="profile.php" style="text-decoration:none">User Profile</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-decoration:none">Edit Profile
                    </li>

                </ol>
            </nav>

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="src/avatars/avatar<?= $user['avatar_id'] ?>.png" alt="Admin"
                                    class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4>
                                        <?= $user['username'] ?>
                                    </h4>
                                    <?php if ($user['is_admin'] == 1): ?>
                                        <span class="label" style="background-color:black;"><i
                                                style="position:relative; left:-4px;" class="fa fa-rocket"
                                                aria-hidden="true"></i>Staff</span>
                                    <?php else: ?>
                                        <span class="label" style="background-color:#6d9edf;"><i
                                                style="position:relative; left:-4px;" class="fa fa-user-o"
                                                aria-hidden="true"></i>Newbie</span>
                                    <?php endif; ?>
                                    <?php if ($user['role'] == 7): ?>
                                        <span class="label" style="background-color:#b30000;"><i
                                                style="position:relative; left:-4px;" class="fa fa-commenting-o"
                                                aria-hidden="true"></i>Founder</span>
                                    <?php elseif ($user['role'] == 6): ?>
                                        <span class="label" style="background-color:#e60000;"><i
                                                style="position:relative; left:-4px;" class="fa fa-cogs"
                                                aria-hidden="true"></i>Owner</span>
                                    <?php elseif ($user['role'] == 5): ?>
                                        <span class="label" style="background-color:#ff1a1a;"><i
                                                style="position:relative; left:-4px;" class="fa fa-cog"
                                                aria-hidden="true"></i>Co-Owner</span>
                                    <?php elseif ($user['role'] == 4): ?>
                                        <span class="label" style="background-color:#997a00;"><i
                                                style="position:relative; left:-4px;" class="fa fa-cloud"
                                                aria-hidden="true"></i>Manager</span>
                                    <?php elseif ($user['role'] == 3): ?>
                                        <span class="label" style="background-color:#33cc33;"><i
                                                style="position:relative; left:-4px;" class="fa fa-tachometer"
                                                aria-hidden="true"></i>Engineer</span>
                                    <?php elseif ($user['role'] == 2): ?>
                                        <span class="label" style="background-color:#0000ff;"><i
                                                style="position:relative; left:-4px;" class="fa fa-comments-o"
                                                aria-hidden="true"></i>Support</span>
                                    <?php elseif ($user['role'] == 1): ?>
                                        <span class="label" style="background-color:#cc7a00;"><i
                                                style="position:relative; left:-4px;" class="fa fa-eraser"
                                                aria-hidden="true"></i>Tester</span>
                                    <?php endif; ?>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a class="btn btn-info " href="profile.php">Back</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="edit_profile.php" method="POST">
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
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
                                    <input type="text" autocomplete="off" name="website" id="website"
                                        class="form-control <?= error_class($errors, 'website') ?>"
                                        style="width:50%; text-align:right" value="<?= $user['website'];
                                        $inputs['website'] ?? '' ?>">
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-github mr-2 icon-inline">
                                            <path
                                                d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                            </path>
                                        </svg>Github</h6>
                                    <input type="text" autocomplete="off" name="github" id="github"
                                        class="form-control <?= error_class($errors, 'github') ?>"
                                        style="width:50%; text-align:right" value="<?= $user['github'];
                                        $inputs['github'] ?? '' ?>">
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-instagram mr-2 icon-inline text-danger">
                                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                        </svg>Instagram</h6>
                                    @<input type="text" autocomplete="off" name="instagram" id="instagram"
                                        class="form-control <?= error_class($errors, 'instagram') ?>"
                                        style="width:50%; text-align:right" value="<?= $user['instagram'];
                                        $inputs['instagram'] ?? '' ?>">
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-facebook mr-2 icon-inline text-primary">
                                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                            </path>
                                        </svg>Facebook</h6>
                                    @<input type="text" autocomplete="off" name="facebook" id="facebook"
                                        class="form-control <?= error_class($errors, 'facebook') ?>"
                                        style="width:50%; text-align:right" value="<?= $user['facebook'];
                                        $inputs['facebook'] ?? '' ?>">
                                    </span>

                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-info" name="save_accounts_button" type="submit"
                                        id="button_id_2"
                                        style="margin-left:12px; margin-top:12px; margin-bottom:12px;">Save
                                        Accounts</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <form action="edit_profile.php" method="POST">
                    <div class="col-lg-auto">
                        <div class="card">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" autocomplete="off" class="form-control" name="name" id="name"
                                            value="<?= $user['name'];
                                            $inputs['name'] ?? '' ?> ">
                                        <small>
                                            <?= $errors['name'] ?? '' ?>
                                        </small>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" autocomplete="off" name="email" id="email"
                                            class="form-control <?= error_class($errors, 'email') ?>" value="<?= $user['email'];
                                               $inputs['email'] ?? '' ?>">
                                        <small>
                                            <?= $errors['email'] ?? '' ?>
                                        </small>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" autocomplete="off" name="phone" id="phone"
                                            class="form-control <?= error_class($errors, 'phone') ?>" value="<?= $user['phone'];
                                               $inputs['phone'] ?? '' ?>">
                                        <small>
                                            <?= $errors['phone'] ?? '' ?>
                                        </small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Adress</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" autocomplete="off" name="adress" id="adress"
                                            class="form-control <?= error_class($errors, 'adress') ?>" value="<?= $user['adress'];
                                               $inputs['adress'] ?? '' ?>">
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Country (ISO)</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" autocomplete="off" name="country" id="country"
                                            class="form-control <?= error_class($errors, 'country') ?>" value="<?= $user['country'];
                                               $inputs['country'] ?? '' ?>">
                                        <small>
                                            <?= $errors['country'] ?? '' ?>
                                        </small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">About Me</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" autocomplete="off" name="about_me" id="about_me"
                                            class="form-control <?= error_class($errors, 'about_me') ?>" value="<?= $user['about_me'];
                                               $inputs['about_me'] ?? '' ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Avatar ID</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" min="0" max="8" name="avatar_id" id="avatar_id"
                                            class="form-control <?= error_class($errors, 'avatar_id') ?>" value="<?= $user['avatar_id'];
                                               $inputs['avatar_id'] ?? '' ?>">
                                    </div>
                                </div>

                                <div style="padding-left: 506px">

                                    <a class="btn btn-info" style="color:white" href="avatars.php">Show avatars</a>

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-info" name="save_profile_button" type="submit"
                                            id="button_id_0">Save profile</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                </form>
                <hr>
                <form action="edit_profile.php" method="POST">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-flex align-items-center mb-3">Skills</h5>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Web Design <b>
                                                    <?= $user['web_design'] ?>%
                                                </b></p>
                                        </div>
                                        <div style="padding-right: 380px;"></div>
                                        <div class="col-sm-2 text-secondary">
                                            <input type="number" name="web_design" id="web_design" min="0" max="100"
                                                class="form-control" value="<?= $user['web_design'];
                                                $inputs['web_design'] ?? '' ?>">
                                            <small>
                                                <?= $errors['web_design'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="progress mb-3" style="height: 8px">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width: <?= $user['web_design'] ?>%" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>

                                    <hr>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Java Script <b>
                                                    <?= $user['java_script'] ?>%
                                                </b></p>
                                        </div>
                                        <div style="padding-right: 380px;"></div>
                                        <div class="col-sm-2 text-secondary">
                                            <input type="number" name="java_script" id="java_script" min="0" max="100"
                                                class="form-control" value="<?= $user['java_script'];
                                                $inputs['java_script'] ?? '' ?>">
                                            <small>
                                                <?= $errors['java_script'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="progress mb-3" style="height: 8px">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: <?= $user['java_script'] ?>%" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>

                                    <hr>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">C# <b>
                                                    <?= $user['cs'] ?>%
                                                </b></p>
                                        </div>
                                        <div style="padding-right: 380px;"></div>
                                        <div class="col-sm-2 text-secondary">
                                            <input type="number" name="cs" id="cs" min="0" max="100"
                                                class="form-control" value="<?= $user['cs'];
                                                $inputs['cs'] ?? '' ?>">
                                            <small>
                                                <?= $errors['cs'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="progress mb-3" style="height: 8px">
                                        <div class="progress-bar bg-success" role="progressbar"
                                            style="width: <?= $user['cs'] ?>%" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">C++ <b>
                                                    <?= $user['cpp'] ?>%
                                                </b></p>
                                        </div>
                                        <div style="padding-right: 380px;"></div>
                                        <div class="col-sm-2 text-secondary">
                                            <input type="number" name="cpp" id="cpp" min="0" max="100"
                                                class="form-control" value="<?= $user['cpp'];
                                                $inputs['cpp'] ?? '' ?>">
                                            <small>
                                                <?= $errors['cpp'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="progress mb-3" style="height: 8px">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: <?= $user['cpp'] ?>%" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Python <b>
                                                    <?= $user['python'] ?>%
                                                </b></p>
                                        </div>
                                        <div style="padding-right: 380px;"></div>
                                        <div class="col-sm-2 text-secondary">
                                            <input type="number" name="python" id="python" min="0" max="100"
                                                class="form-control" value="<?= $user['python'];
                                                $inputs['python'] ?? '' ?>">
                                            <small>
                                                <?= $errors['python'] ?? '' ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="progress" style="height: 8px">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: <?= $user['python'] ?>%" aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <button class="btn btn-info" type="submit" name="save_skills_button"
                                                value="Refresh Page" onClick="refresh" id="button_id_1">Save
                                                skills</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <style type="text/css">
        body {
            margin-top: 20px;
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }

        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col,
        .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }
    </style>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script type="text/javascript">

    </script>
    <?php view('footer') ?>