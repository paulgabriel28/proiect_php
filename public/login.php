<?php
ob_start();
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/login.php';
?>
<?php view('header', ['title' => 'Login']) ?>

<?php if (isset($errors['login'])): ?>
    <div class="alert alert-error">
        <?= $errors['login'] ?>
    </div>
<?php endif ?>

<div class="container ">
    <div class="main-body">

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form action="login.php" method="post">
                            <h1>Login</h1>
                            <div>
                                <label class="mb-0" for="username">
                                    <h5>Username:</h5>
                                </label>
                                <input type="text" name="username" id="username" class="form-control"
                                    value="<?= $inputs['username'] ?? '' ?>">
                                <small>
                                    <?= $errors['username'] ?? '' ?>
                                </small>
                            </div>

                            <div>
                                <label class="mb-0" for="password">
                                    <h5>Password:</h5>
                                </label>
                                <input type="password" name="password" id="password" class="form-control">
                                <small>
                                    <?= $errors['password'] ?? '' ?>
                                </small>

                                <div style="padding-left: 155px">
                                    <button type="button" class="btn btn-info" onclick="show_password()"
                                        id="text_password" style="width:150px; margin: 11px"> Show Password
                                    </button>
                                </div>
                                <label for="remember_me">
                                    <input type="checkbox" name="remember_me" id="remember_me" value="checked"
                                        <?= $inputs['remember_me'] ?? '' ?> />
                                    Remember Me
                                </label>
                                <small>
                                    <?= $errors['agree'] ?? '' ?>
                                </small>
                            </div>

                            <button class="btn btn-outline-primary" type="submit" value="Refresh Page"
                                onClick="refresh">Login</button>

                            <footer>You are not a member? <a href="register.php">Register here!</a></footer>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function show_password() {
        var pass = document.getElementById("password");
        var text_password = document.getElementById("text_password");
        if (pass.type === "password") {
            pass.type = "text";
            text_password.textContent = "Hide Password"
        } else {
            pass.type = "password";
            text_password.textContent = "Show Password"
        }
    }
</script>

<?php view('footer') ?>
<?php ob_end_flush(); ?>