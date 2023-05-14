<?php
ob_start();
require __DIR__ . '/../src/bootstrap.php';
require_login();
$user = find_user_by_username(current_user());
?>



<?php view('header', ['title' => 'Home']) ?>
<div class="container ">
  <div class="main-body">

    <a href="?users=<?= $user['username'] ?>" style="text-decoration:none; color:black">
      <img src="pages/src/avatars/avatar<?= $user['avatar_id'] ?>.png" class="rounded-circle" alt="avatar" style="width:20px">
      <b>
        <?= $user['username'] ?>
      </b>
    </a>
    <br><br>

    <nav aria-label="breadcrumb" class="main-breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none">Home</a></li>

      </ol>
    </nav>

    <div class="row gutters-sm">
      <div class="col-md-4 mb-3">
        <div class="card" style="margin-left: 5%; position:absolute; width:499">
          <div class="card-body">
            <h5>Welcome,
              <a style="color:blue;">
                <?= $user['username'] ?>
              </a>
            </h5>
            <a class="btn btn-info" href="pages/profile.php">Profile</a>
            <a class="btn btn-info" href="pages/users.php">Users</a>
            <a class="btn btn-info" href="pages/search.php">Search</a>
            <br><br>
            <a class="btn btn-outline-primary" href="logout.php">Logout</a>
          </div>
        </div>
        <div style="position:static; position:absolute;left:500px;">
          <?php import_page('globalchat') ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<?php view('footer') ?>
<?php ob_end_flush(); ?>