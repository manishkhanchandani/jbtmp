<!-- src/Jobs/WebBundle/Resources/views/Auth/resetPassword.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>
<script src="<?php echo $view['assets']->getUrl('scripts/resetPassword.js') ?>"></script>

<div  ng-app="App" ng-controller="Controller">
    <form novalidate class="form-horizontal" ng-submit="submit()" name="form">
        
        <div class="form-group">
            <label class="col-md-2">Create New Password</label>
            <div class="col-md-4"><input class="form-control" type="password" ng-model="user.password" name="password" required ng-minlength="6" ></div>
            <p class="help-block" ng-show="form.password.$error.minlength || form.password.$invalid">Password must be at least 6 characters</p>
        </div>
        <div class="form-group">
            <label class="col-md-2">Confirm Password</label>
            <div class="col-md-4"><input class="form-control" type="password" ng-model="user.confirm" name="confirm" required></div>
        </div>
       
       <div class="form-group">
            <div class="col-md-5">
              <button class="btn btn-default" ng-disabled="form.$invalid">Continue</button>
            </div>
       </div>
       <div class="response_messages" ng-show="message">{{ message }}</div>
</form>
</div>