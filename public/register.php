<?php
ob_start();
require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/register.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<?php view('header', ['title' => 'Register']) ?>

<div class="container ">
    <div class="main-body">

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">

                        <form action="register.php" method="post">

                            <h1>Sign Up</h1>
                            <div>
                                <label class="mb-0" for="username">
                                    <h5>Username:</h5>
                                </label>
                                <input type="text" name="username" id="username"
                                    value="<?= $inputs['username'] ?? '' ?>"
                                    class="<?= error_class($errors, 'username') ?> form-control">
                                <small>
                                    <?= $errors['username'] ?? '' ?>
                                </small>
                            </div>
                            <p></p>
                            <div>
                                <label class="mb-0" for="email">
                                    <h5>Email:</h5>
                                </label>
                                <input type="email" name="email" id="email" value="<?= $inputs['email'] ?? '' ?>"
                                    class="<?= error_class($errors, 'email') ?> form-control">
                                <small>
                                    <?= $errors['email'] ?? '' ?>
                                </small>
                            </div>
                            <p></p>
                            <div>
                                <label class="mb-0" for="password">
                                    <h5>Password:</h5>
                                </label>
                                <input type="password" name="password" id="password"
                                    value="<?= $inputs['password'] ?? '' ?>"
                                    class="<?= error_class($errors, 'password') ?> form-control">
                                <small>
                                    <?= $errors['password'] ?? '' ?>
                                </small>
                            </div>
                            <p></p>
                            <div>
                                <label class="mb-0" for="password2">
                                    <h5>Password Again:</h5>
                                </label>
                                <input type="password" name="password2" id="password2" class="form-control"
                                    value="<?= $inputs['password2'] ?? '' ?>"
                                    class="<?= error_class($errors, 'password2') ?> form-control">
                                <small>
                                    <?= $errors['password2'] ?? '' ?>
                                </small>
                            </div>
                            <div style="padding-left: 155px">
                                <button type="button" class="btn btn-info" onclick="show_password()" id="text_password"
                                    style="width:150px; margin: 11px"> Show Passwords
                                </button>
                            </div>
                            <div>
                                <label for="agree">
                                    <input type="checkbox" name="agree" id="agree" value="checked" <?= $inputs['agree'] ?? '' ?> /> I agree with
                                    the <a href="#" title="term of services">term of services</a>
                                </label>
                                <small>
                                    <br>
                                    <?= $errors['agree'] ?? '' ?>
                                </small>
                            </div>
                            <button type="submit" class="btn btn-outline-primary" value="Refresh Page"
                                onClick="refresh">Register</button>
                            <footer>Already a member? <a href="login.php">Login here</a></footer>

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
        var pass2 = document.getElementById("password2");
        var text_password = document.getElementById("text_password");
        if (pass.type === "password") {
            pass.type = "text";
            pass2.type = "text";
            text_password.textContent = "Hide Passwords"
        } else {
            pass.type = "password";
            pass2.type = "password";
            text_password.textContent = "Show Passwords"
        }
    }
</script>


<?php view('footer') ?>
<?php ob_end_flush(); ?>