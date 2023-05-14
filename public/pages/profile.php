<?php

require __DIR__ . '/../../src/bootstrap.php';
require __DIR__ . '/../../src/profile.php';
require_login();
$user = find_user_by_username(current_user());
$user_admin = find_user_by_username(current_user());

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

<?php view('header', ['title' => 'Profile - ' . $user['username']]) ?>

<body>
  <div class="container">
    <div class="main-body">
      <a href="?users=<?= $user_admin['username'] ?>" style="text-decoration:none; color:black">
        <img src="src/avatars/avatar<?= $user_admin['avatar_id'] ?>.png" class="rounded-circle" alt="avatar"
          style="width:20px"> <b>
          <?= $user_admin['username'] ?>
        </b>
      </a>
  

      <br><br>
      <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="../index.php" style="text-decoration:none">Home</a></li>
          <li class="breadcrumb-item"><a href="users.php" style="text-decoration:none">Users</a></li>
          <li class="breadcrumb-item active" aria-current="page">User Profile</li>
        </ol>
      </nav>
      <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <img src="src/avatars/avatar<?= $user['avatar_id'] ?>.png" alt="Admin" class="rounded-circle"
                  width="150">
                <div class="mt-3">
                  <h4>
                    <?= $user['username'] ?>
                    <?php
                    if (find_follower($user['id'], $user_admin['id'])) {
                      ?>
                      <small>
                        <br>
                        <h6 style="color:green; font-size: .50em">* You are following this user</h6>
                      </small>
                    <?php } ?>
                  </h4>

                  <?php if ($user['is_admin'] == 1): ?>
                    <span class="label" style="background-color:black;"><i style="position:relative; left:-4px;"
                        class="fa fa-rocket" aria-hidden="true"></i>Staff</span>
                  <?php else: ?>
                    <span class="label" style="background-color:#6d9edf;"><i style="position:relative; left:-4px;"
                        class="fa fa-user-o" aria-hidden="true"></i>Newbie</span>
                  <?php endif; ?>
                  <?php if ($user['role'] == 7): ?>
                    <span class="label" style="background-color:#b30000;"><i style="position:relative; left:-4px;"
                        class="fa fa-commenting-o" aria-hidden="true"></i>Founder</span>
                  <?php elseif ($user['role'] == 6): ?>
                    <span class="label" style="background-color:#e60000;"><i style="position:relative; left:-4px;"
                        class="fa fa-cogs" aria-hidden="true"></i>Owner</span>
                  <?php elseif ($user['role'] == 5): ?>
                    <span class="label" style="background-color:#ff1a1a;"><i style="position:relative; left:-4px;"
                        class="fa fa-cog" aria-hidden="true"></i>Co-Owner</span>
                  <?php elseif ($user['role'] == 4): ?>
                    <span class="label" style="background-color:#997a00;"><i style="position:relative; left:-4px;"
                        class="fa fa-cloud" aria-hidden="true"></i>Manager</span>
                  <?php elseif ($user['role'] == 3): ?>
                    <span class="label" style="background-color:#33cc33;"><i style="position:relative; left:-4px;"
                        class="fa fa-tachometer" aria-hidden="true"></i>Engineer</span>
                  <?php elseif ($user['role'] == 2): ?>
                    <span class="label" style="background-color:#0000ff;"><i style="position:relative; left:-4px;"
                        class="fa fa-comments-o" aria-hidden="true"></i>Support</span>
                  <?php elseif ($user['role'] == 1): ?>
                    <span class="label" style="background-color:#cc7a00;"><i style="position:relative; left:-4px;"
                        class="fa fa-eraser" aria-hidden="true"></i>Tester</span>
                  <?php endif; ?>

                  <?php if ($user['about_me']): ?>
                    <p></p>
                    About Me: <b>
                      <?= $user['about_me'] ?>
                    </b>
                  <?php endif; ?>
                  <br><br>
                  <?php if ($user['username'] != $user_admin['username']) { ?>
                    <?php
                    if (!find_follower($user['id'], $user_admin['id'])) { ?>
                      <form action="profile.php" method="POST">
                        <input type="hidden" name="follower_id" value="<?= $user['id'] ?>" />
                        <input type="hidden" name="following_id" value="<?= $user_admin['id'] ?>" />
                        <input type="hidden" name="following_name" value="<?= $user_admin['username'] ?>" />
                        <input type="hidden" name="username" value="<?= $user['username'] ?>" />
                        <button class="btn btn-primary" name="follow_button"><i style="position:relative; left:-4px;"
                            class="fa fa-heart" aria-hidden="true"></i>Follow</button>
                        <a href="chat.php?user=<?= $user['username'] ?>" class="btn btn-outline-primary"><i
                            style="position:relative; left:-4px;" class="fa fa-commenting-o"
                            aria-hidden="true"></i>Message</a>
                      </form>
                    <?php } else { ?>
                      <a href="chat.php?user=<?= $user['username'] ?>" class="btn btn-outline-primary"><i
                          style="position:relative; left:-4px;" class="fa fa-commenting-o"
                          aria-hidden="true"></i>Message</a>
                    <?php }
                  }
                  ?>
                  <div class="row">
                    <div class="col-sm-12">
                      <?php if ($user['username'] == $user_admin['username']) { ?>
                        <a class="btn btn-info " href="edit_profile.php"><i style="position:relative; left:-4px;"
                            class="fa fa-gear" aria-hidden="true"></i>Edit account</a>
                        <br>
                        <p></p>
                      <?php } ?>
                      <?php if ($user_admin['role'] >= 4) { ?>
                        <p></p>
                        <a href="admin_settings.php?user=<?= $user['username'] ?>"><button class="btn btn-primary"
                            style="background-color:red; text-color=white; border-color:transparent;"
                            href="edit_profile.php"><i style="position:relative; left:-4px;" class="fa fa-wrench"
                              aria-hidden="true"></i>Admin Settings</button></a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php
          $query = "SELECT * FROM user_followers WHERE follower_id = '{$user['id']}'";
          $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) != 0) {
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="d-flex align-items-center mb-3">Followers:</h5>';
            echo '<h6>';
            $count_followers = 0;
            while ($follower = mysqli_fetch_assoc($result)) {
              $count_followers++;
              $user_follower = find_user_by_id($follower['following_id']);
              echo '<a href="profile.php?user=' . $user_follower['username'] . '" style="text-decoration:none"><img src="src/avatars/avatar' . $user_follower['avatar_id'] . '.png" class="rounded-circle" style="width:15px"> ' . $user_follower['username'] . '</a>';
              echo '&emsp;';
            }
            echo '</h6>';
            echo '<hr>';
            echo '<h6>Total: ' . $count_followers;
            echo '</div> ';
            echo '</div>';
          }


          $query = "SELECT * FROM user_followers WHERE following_id = '{$user['id']}'";
          $result = mysqli_query($conn, $query);
          if ($user_admin['id'] == $user['id'] || $user_admin['role'] >= 4) {
            if (mysqli_num_rows($result) != 0) {
              echo '<div class="card">';
              echo '<div class="card-body">';
              echo '<h5 class="d-flex align-items-center mb-3">Following:';
              if ($user_admin['role'] >= 4 && $user_admin['id'] != $user['id'])
                echo ' (only staff)';
              echo '</h5>';
              echo '<h6>';
              $count_followers = 0;
              while ($follower = mysqli_fetch_assoc($result)) {
                $count_followers++;
                $user_follower = find_user_by_id($follower['follower_id']);
                echo '<a href="profile.php?user=' . $user_follower['username'] . '" style="text-decoration:none"><img src="src/avatars/avatar' . $user_follower['avatar_id'] . '.png" class="rounded-circle" style="width:15px"> ' . $user_follower['username'] . '</a>';
                echo '&emsp;';
              }
              echo '</h6>';
              echo '<hr>';
              echo '<h6>Total: ' . $count_followers;
              echo '</div> ';
              echo '</div>';
            }
          }
          ?>

          <div class="card mt-3">
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-globe mr-2 icon-inline">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <path
                      d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                    </path>
                  </svg>Website</h6>
                <a style="text-decoration:none" href="https://<?= $user['website'] ?>"><span class="text-secondary">
                    <?= $user['website'] ?>
                  </span></a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-github mr-2 icon-inline">
                    <path
                      d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                    </path>
                  </svg>Github</h6>
                <a style="text-decoration:none" href="https://github.com/<?= $user['github'] ?>"><span
                    class="text-secondary">
                    <?= $user['github'] ?>
                  </span></a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-instagram mr-2 icon-inline text-danger">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                  </svg>Instagram</h6>
                <a style="text-decoration:none" href="https://www.instagram.com/<?= $user['instagram'] ?>"><span
                    class="text-secondary">
                    @<?= $user['instagram'] ?>
                  </span></a>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-facebook mr-2 icon-inline text-primary">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                  </svg>Facebook</h6>
                <a style="text-decoration:none" href="https://www.facebook.com/<?= $user['facebook'] ?>"><span
                    class="text-secondary">
                    @<?= $user['facebook'] ?>
                  </span></a>
              </li>
            </ul>
          </div>

        </div>



        <div class="col-md-8">
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Full Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?= $user['name'] ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?= $user['email'] ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php if ($user['phone'] != 0) { ?>
                    +40
                    <?= $user['phone'];
                  } ?>

                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Address</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?= $user['adress'] ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Country</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <img class="flag-img" style="border:0.1px solid; border-color: gray"
                    src="src/flags/<?= $user['country'] ?>.svg" width="30">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Created At</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?= $user['created_at'] ?>
                </div>
              </div>
              <?php if($user_admin['role'] >= 5) { ?>
                <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Verified Email: </h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php if($user['active']) {?>
                    <div style="color:green"> Yes</div>
                  <?php } 
                  else { ?>
                    <div style="color:red"> No</div>
                  <?php }?>

                </div>
              </div>
              <?php } ?>

            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="d-flex align-items-center mb-3">Skills</h5>
                  <p>Web Design <b styl>
                      <?= $user['web_design'] ?>%
                    </b></p>
                  <div class="progress mb-3" style="height: 8px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar"
                      style="width: <?= $user['web_design'] ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p>Java Script <b>
                      <?= $user['java_script'] ?>%
                    </b></p>
                  <div class="progress mb-3" style="height: 8px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar"
                      style="width: <?= $user['java_script'] ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p>C# <b>
                      <?= $user['cs'] ?>%
                    </b></p>
                  <div class="progress mb-3" style="height: 8px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
                      style="width: <?= $user['cs'] ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p>C++ <b>
                      <?= $user['cpp'] ?>%
                    </b></p>
                  <div class="progress mb-3" style="height: 8px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar"
                      style="width: <?= $user['cpp'] ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <p>Python <b>
                      <?= $user['python'] ?>%
                    </b></p>
                  <div class="progress" style="height: 8px">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar"
                      style="width: <?= $user['python'] ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
  <script type="text/javascript">

  </script>
  <?php view('footer') ?>