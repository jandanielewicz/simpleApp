<!doctype html>
<html>
<head>
    <title>simpleApplication</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>css/style.css"/>
</head>
<body>
<div class="wrapper">

    <ul class="navigation">
        <li <?php if (View::checkForActiveController($filename, "index")) {
            echo ' class="active" ';
        } ?> >
            <a href="<?php echo Config::get('URL'); ?>index/index">Home page</a>
        </li>
        <li <?php if (View::checkForActiveController($filename, "category")) {
            echo ' class="active" ';
        } ?> >
            <a href="<?php echo Config::get('URL'); ?>category/index">Categories</a>
        </li>
        <li <?php if (View::checkForActiveController($filename, "article")) {
            echo ' class="active" ';
        } ?> >
            <a href="<?php echo Config::get('URL'); ?>article/index">Articles</a>
        </li>
        <li <?php if (View::checkForActiveController($filename, "author")) {
            echo ' class="active" ';
        } ?> >
            <a href="<?php echo Config::get('URL'); ?>author/index">Authors</a>
        </li>
        <?php if (Session::userIsLogged()) { ?>
            <li <?php if (View::checkForActiveController($filename, "collection")) {
                echo ' class="active" ';
            } ?> >
                <a href="<?php echo Config::get('URL'); ?>collection/index">Collection</a>
            </li>
        <?php } ?>
    </ul>

    <ul class="navigation right">

        <?php if (Session::userIsLogged()) {

            $user_id = Session::get('user_id');
            $user = UserModel::getProfileOfUser($user_id);
            $wallet = $user->wallet;

            ?>

            <li>
                <div class="padding10"><?= $wallet ?></div
            </li>
            <li <?php if (View::checkForActiveController($filename, "login")) {
                echo ' class="active" ';
            } ?> >
                <a href="<?php echo Config::get('URL'); ?>login/logout">Logout</a>
            </li>
        <?php } else { ?>
            <!-- for not logged -->
            <li <?php if (View::checkForActiveControllerAndAction($filename, "login/index")) {
                echo ' class="active" ';
            } ?> >
                <a href="<?php echo Config::get('URL'); ?>login/index">Login</a>
            </li>
        <?php } ?>

    </ul>