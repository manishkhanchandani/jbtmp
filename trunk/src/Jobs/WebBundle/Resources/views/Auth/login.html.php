
<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<script src="<?php echo $view['assets']->getUrl('scripts/loginApp.js') ?>"></script>

<div class="container">
    <div class="row">
        <div class="signIn">
            <div class="col-xs-12 col-sm-4 col-sm-offset-3">
                <h6 class="signin_title">Registered users: Sign in here</h6><br>

                <form name="loginForm" novalidate ng-app="LoginApp" ng-controller="LoginController" rc-submit="login()" class="loginMargin">
                    <small>The feature you requested is only avalable to members.Please sign in to continue...</small><br><br>
                    <div class="form-group" ng-class="{'has-error': (loginForm.email | shouldDisplayError:email)}">
                        <input class="form-control" name="username" type="text" placeholder="Email Address" required ng-model="session.email" />
                        <!--<span class="help-block" ng-show="loginForm.username.$error.required">Required</span>-->
                    </div>
                    <div class="form-group" ng-class="{'has-error': (loginForm.password | shouldDisplayError:loginForm)}">
                        <input class="form-control" name="password" type="password" placeholder="Password" required ng-model="session.password" />
                        <!--<span class="help-block" ng-show="loginForm.password.$error.required">Required</span>-->
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" 
                                value="Login" title="Signin">
                            <span>Signin</span>
                        </button>
                    </div>
                    <div><a href="forgotPassword">Forgot Password?</a></div>
                    <div class="response_messages" ng-show="message">{{ message}}</div>
                </form>
            </div>
        </div>

        <div class="signUp">
            <div class="col-xs-12 col-sm-4 col-sm-offset-3">
                <h6 class="signup_title">New to WorkOnOpt.com</h6>
                <div class="loginMargin">
                    <h5>Enjoy the featues of WorkOnOpt.com</h5>

                    <p>
                        Sign up now to enjoy to enjoy all the features of WorkOnOpt.com, Including<br>
                        Job search management tools<br>
                        Resume Posting Tools<br>
                        Job recommendations
                    </p>
                    <a href="register" class="btn btn-primary" 
                            value="SignUp" title="SignUp">
                        <span>Sign up Now!</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
