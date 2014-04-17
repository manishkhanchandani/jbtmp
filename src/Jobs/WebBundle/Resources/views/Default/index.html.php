<!-- src/Jobs/WebBundle/Resources/views/Default/index.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<script src="<?php echo $view['assets']->getUrl('scripts/loginApp.js') ?>"></script>

<div ng-app="jobApp">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-5" ng-controller="jobController">
            <div class="findJobs row">
                <h4>Find Jobs</h4>
                <div class="col-xs-6 col-sn-6 col-md-6">
                    <label>Keywords:</label>
                    <input type="text" ng-model="findJob.keyword" />
                    <a href="employer/search" class="">Advanced Search</a>
                </div>
                <div class="col-xs-6 col-sn-6 col-md-6">
                    <label>Location:</label>
                    <input type="text" ng-model="findJob.location" /><br>
                    <a href="employer/search?q={{findJob.keyword}}&location={{findJob.location}}" class="findJob pull-right">Find Job</a>
                </div>
            </div>
            <div class="recentJobs">
                <h4>Jobs</h4>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#jobs" data-toggle="tab">Recent Jobs</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="jobs">
                        <div>Location: SanRamon, CA</div>
                        <div class="row" ng-repeat="job in recentJobs">
                            <a href="employer/preview?jobId={{job.job_id}}"><h5>{{job.title}}</h5></a>
                            <div>{{job.description}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-10 col-md-7">
        
            <div class="signIn">
                <div class="col-xs-6 col-sm-7 col-md-6 wrap">
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
                <div class="col-xs-6 col-sm-7 col-md-5 wrap">
                    <h6 class="signup_title">New to WorkOnOpt.com</h6>
                    <div class="loginMargin">
                        <h5>Enjoy the features of WorkOnOpt.com</h5>

                        <p>
                            Sign up now to enjoy to enjoy all the features of WorkOnOpt.com, Including<br>
                            Job search management tools<br>
                            Resume Posting Tools<br>
                            Job recommendations
                        </p>
                        <a href="auth/register" class="btn btn-primary" 
                           title="SignUp">
                            <span>Sign up Now!</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>