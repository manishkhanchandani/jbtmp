
<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<script src="<?php echo $view['assets']->getUrl('scripts/loginApp.js') ?>"></script>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <h1>Login</h1>
            <form name="loginForm" novalidate ng-app="LoginApp" ng-controller="LoginController" rc-submit="login()">
                <div class="form-group" ng-class="{'has-error': rc.loginForm.needsAttention(loginForm.username)}">
                    <input class="form-control" name="username" type="text" placeholder="Username" required ng-model="session.username" />
                    <span class="help-block" ng-show="loginForm.username.$error.required">Required</span>
                </div>
                <div class="form-group" ng-class="{'has-error': rc.loginForm.needsAttention(loginForm.password)}">
                    <input class="form-control" name="password" type="password" placeholder="Password" required ng-model="session.password" />
                    <span class="help-block" ng-show="loginForm.password.$error.required">Required</span>
                </div>
                <div><a href="forgotPassword">Forgot Password</a></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right" 
                            value="Login" title="Login">
                        <span>Login</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
