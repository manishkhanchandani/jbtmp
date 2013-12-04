<!-- src/Jobs/WebBundle/Resources/views/Auth/register.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<h1>Registration</h1>
<form class="form-horizontal" role="form">
    <div class="form-group">
        <label class="col-md-2" for="inputFirstName">First name</label>
        <div class="col-md-4"><input class="form-control" id="inputFirstName" placeholder="FirstName" type="text"></div>
    </div>
    <div class="form-group">
        <label class="col-md-2" for="inputLastName">Last name</label>
        <div class="col-md-4"><input class="form-control" id="inputLastName" placeholder="LastName" type="text"></div>
    </div>
    <div class="form-group">
        <label class="col-md-2" for="inputEmail1">Email</label>
        <div class="col-md-4"><input class="form-control" id="inputEmail1" placeholder="Email" type="email"></div>
    </div>
    <div class="form-group">
        <label class="col-md-2" for="inputPassword1">Password</label>
        <div class="col-md-4"><input class="form-control" id="inputPassword1" placeholder="Password" type="password"></div>
    </div>
    <div class="form-group">
        <label class="col-md-2" for="confirmPassword1">Confirm Password</label>
        <div class="col-md-4"><input class="form-control" id="confirmPassword1" placeholder="Confirm Password" type="password"></div>
    </div>
    <div class="form-group">
        <div class="col-md-5">
            <button type="submit" class="btn btn-default">Sign in</button>
        </div>
    </div>
</form>