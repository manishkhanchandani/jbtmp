<!-- src/Jobs/WebBundle/Resources/views/Auth/forgotPassword.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>
<script src="<?php echo $view['assets']->getUrl('scripts/forgotPassword.js') ?>"></script>

<h1>Forgot Your Password </h1>
<h3>Please enter your E-mail address.</h3><br />

<div  ng-app="App" ng-controller="Controller">
    <form novalidate class="form-horizontal" ng-submit="submit()" name="form">
        
        <div class="form-group">
            <label class="col-md-2">Email Address</label>
            <div class="col-md-4"><input class="form-control" type="email" ng-model="user.email" name="email" required></div>
        </div>
       
       <div class="form-group">
            <div class="col-md-5">
              <button class="btn btn-default" ng-disabled="form.$invalid">Continue</button>
            </div>
       </div>
       <div class="response_messages" ng-show="message">{{ message }}</div>
</form>
</div>



