<?php

require __DIR__ . '/../../src/bootstrap.php';
require_login();
$user = find_user_by_username(current_user())
?>
<?php view('header', ['title' => 'Avatars']) ?>

<div class="container">
    <div class="main-body">
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="users.php">Users</a></li>
                <li class="breadcrumb-item"><a href="profile.php">User Profile</a></li>
                <li class="breadcrumb-item"><a href="edit_profile.php">Edit Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Avatars</li>
                <a href="profile.php" style="margin-left:54%; text-decoration:none; color:black">
            <li><img src="src/avatars/avatar<?= $user['avatar_id'] ?>.png" class="rounded-circle" alt="avatar"
                style="width:20px"> <b>
                <?= $user['username'] ?>
              </b></li>
          </a>
            </ol>
        </nav>

        <div class="card-body">
            <h4>Avatars</h4>
            <div class="">
                <table class="table">
                    <thead style="background-color:#BBD2F0">
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Choose</th>
                        </tr>
                    </thead>
                    <tbody style="background-color:#CFDDF0">
                        <img src="" alt="">
                        <?php
                        for ($avatar_id = 1; $avatar_id <= 8; $avatar_id++) {
                            echo <<<HTML
                            <td><h5>$avatar_id</h5></td>
                            <td><img src="src/avatars/avatar$avatar_id.png"  class="rounded-circle" width="150"></td>
                            <td><a class="btn btn-info" href="edit_profile.php">Choose</a></td>
                            <tr>
                            HTML;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php view('footer') ?>