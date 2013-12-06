<!-- src/Jobs/WebBundle/Resources/views/Auth/forgotPassword.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<h1>Forgot Your Password </h1>
<h3>Please enter your UserName.</h3><br />
<!--label class="col-md-2" for="inputFirstName">User Name</label> <br />-->

<div class="col-xs-12 col-sm-6">
<div class="form-group" ng-class="{'has-error': rc.loginForm.needsAttention(loginForm.username)}">
     <input class="form-control ng-pristine ng-invalid ng-invalid-required" 
            name="username" type="text" placeholder="Username" required="" ng-model="session.username">
     <span class="help-block" ng-show="loginForm.username.$error.required">Required</span>
</div>
</div>
<div class="form-group">
     <button type="submit" class="btn btn-primary" value="Continue">
             <span>Continue</span>
     </button>
</div>


