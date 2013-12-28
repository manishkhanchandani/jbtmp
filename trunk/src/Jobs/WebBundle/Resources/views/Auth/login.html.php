
<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<script src="<?php echo $view['assets']->getUrl('scripts/loginApp.js') ?>"></script>

<div class="container" ng-app="loginApp">
    <div class="row">
        <div class="signIn">
            <div class="col-xs-12 col-sm-4 col-sm-offset-3">
                <h6 class="signin_title">Registered users: Sign in here</h6><br>

                <form name="loginForm" novalidate ng-controller="LoginController" ng-submit="login()" class="loginMargin">
                    <small>The feature you requested is only avalable to members.Please sign in to continue...</small><br><br>
                    <div class="form-group">
                        <input class="form-control" name="email" type="email" placeholder="Email Address" required ng-model="session.email" autofillable/>
                        <div class="custom-error" ng-show="loginForm.email.$dirty && loginForm.email.$invalid">Username is required.
                            <!--<span ng-show="loginForm.email.$error.required">Username is required.</span>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="password" type="password" placeholder="Password" required ng-model="session.password" autofillable/>
                        <div class="custom-error" ng-show="loginForm.password.$dirty && loginForm.password.$invalid">Password is required.
                            <!--<span ng-show="loginForm.password.$error.required">Password is required.</span>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" 
                                value="Login" title="Signin"
                                ng-disabled="loginForm.email.$pristine || loginForm.email.$dirty && loginForm.email.$invalid">
                            <span>Signin</span>
                        </button>
                    </div>
                    <div><a href="forgotPassword">Forgot Password?</a></div>
                    <div class="response_messages" ng-show="message">{{ message}} {{$invalid}}</div>
                </form>
            </div>
        </div>

        <div class="signUp">
            <div class="col-xs-12 col-sm-4 col-sm-offset-3">
                <h6 class="signup_title">New to WorkOnOpt.com</h6>
                <div class="loginMargin">
                    <h5>Enjoy the features of WorkOnOpt.com</h5>

                    <p>
                        Sign up now to enjoy to enjoy all the features of WorkOnOpt.com, Including<br>
                        Job search management tools<br>
                        Resume Posting Tools<br>
                        Job recommendations
                    </p>
                    <a href="register" class="btn btn-primary" 
                       title="SignUp">
                        <span>Sign up Now!</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
