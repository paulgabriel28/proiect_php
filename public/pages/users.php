<?php

require __DIR__ . '/../../src/bootstrap.php';
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
          <li class="breadcrumb-item active" aria-current="page" style="text-decoration:none">Users</li>

        </ol>
      </nav>

      <a href="search.php"><button class="btn btn-info" style="width:100%">Search an user</button></a>

      <div class="card-body">
        <h4>Users</h4>
        <div class="">
          <table class="table">
            <thead style="background-color:#BBD2F0">
              <tr>
                <th>#</th>
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
              $sql = "SELECT * FROM users ORDER BY id ASC";
              $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<td>" . $row['id'] . "</td>";

                  echo "<td> <img src='src/avatars/avatar" . $row['avatar_id'] . ".png' alt='Admin' class='rounded-circle' width='50'></td>";

                  echo "<td> <a style='text-decoration:none' href='profile.php?user=" . $row['username'] . "'>" . $row['username'] . "</a>";
                  if (find_follower($row['id'], $user['id'])) {
                    echo '<small>';
                    echo '<br>';
                    echo '<h6 style="color:green; font-size: .80em">* Following</h6>';
                    echo '</small>';
                    echo '</td>';
                  } else
                    echo '</td>';
                  echo "<td>" . $row['name'] . "</td>";

                  echo "<td>";
                  if ($row['is_admin'] == 1)
                    echo "<span class='label' style='background-color:black;'><i style='position:relative; left:-4px;' class='fa fa-rocket' aria-hidden='true'></i>Staff</span>";
                  else
                    echo "<span class='label' style='background-color:#6d9edf;'><i style='position:relative; left:-4px;' class='fa fa-user-o' aria-hidden='true'></i>Newbie</span>";

                  if ($row['role'] == 7)
                    echo " <span class='label' style='background-color:#b30000;'><i style='position:relative; left:-4px;' class='fa fa-commenting-o' aria-hidden='true'></i>Founder</span>";
                  elseif ($row['role'] == 6)
                    echo " <span class='label' style='background-color:#e60000;'><i style='position:relative; left:-4px;' class='fa fa-cogs' aria-hidden='true'></i>Owner</span>";
                  elseif ($row['role'] == 5)
                    echo " <span class='label' style='background-color:#ff1a1a;'><i style='position:relative; left:-4px;' class='fa fa-cog' aria-hidden='true'></i>Co-Owner<Co-Owner</span>";
                  elseif ($row['role'] == 4)
                    echo " <span class='label' style='background-color:#997a00;'><i style='position:relative; left:-4px;' class='fa fa-cloud' aria-hidden='true'></i>Manager</span>";
                  elseif ($row['role'] == 3)
                    echo " <span class='label' style='background-color:#33cc33;'><i style='position:relative; left:-4px;' class='fa fa-tachometer' aria-hidden='true'></i>Engineer</span>";
                  elseif ($row['role'] == 2)
                    echo " <span class='label' style='background-color:#0000ff;'><i style='position:relative; left:-4px;' class='fa fa-comments-o' aria-hidden='true'></i>Support</span>";
                  elseif ($row['role'] == 1)
                    echo " <span class='label' style='background-color:#cc7a00;'><i style='position:relative; left:-4px;' class='fa fa-eraser' aria-hidden='true'></i>Tester</span>";
                  echo "</td>";

                  echo "<td> <img style='border:0.1px solid; border-color: gray' src='src/flags/" . $row['country'] . ".svg' width='30'></td>";

                  echo "<tr>";
                }
              } else {
                echo "No user was found.";
              }
              mysqli_close($conn);
              ?>

            </tbody>
          </table>
        </div>
      </div>


    </div>
  </div>
  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
  <script type="text/javascript">

  </script>
  <?php view('footer') ?>