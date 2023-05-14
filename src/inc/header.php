<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?= $title ?? 'Home' ?>
    </title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

</head>

<body>
    
    <main>
        <?php flash() ?>
    <?php if(is_user_logged_in()) {
    $user = find_user_by_username(current_user());
        if($user['name'] == null && $user['phone'] == null && $user['adress'] == null && $user['country'] == "unk") { ?>
    
        <div class="container alert alert-warning" style="text-align:center">Please setup your account <b><a href="pages/edit_profile.php" style="color:black">here</a></b>!</div>
    <?php } }?>
    