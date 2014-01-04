<!-- src/Jobs/WebBundle/Resources/views/Auth/register.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>
<script src="<?php echo $view['assets']->getUrl('scripts/app.js') ?>"></script>
<script src="<?php echo $view['assets']->getUrl('scripts/register.js') ?>"></script>
<h2>New Users: Sign up now</h2>

<div  ng-app="App" ng-controller="Controller">
    <form novalidate class="form-horizontal" ng-submit="submit()" name="registerForm">
        <h3>workOnOpt Registration</h3><hr>
        <div class="form-group">
            <label class="col-md-3">I will be using workOnOpt as </label>
            <div class="col-md-7">
                <input class="btn-group" type="radio" 
                       ng-model="user.user_type" value="1" 
                       name="user_type" required> a job seeker
                <input class="btn-group" type="radio" 
                       ng-model="user.user_type" value="2" 
                       name="user_type" required> an employer
                <input class="btn-group" type="radio" 
                       ng-model="user.user_type" value="3" 
                       name="user_type" required> a staffing agency representative
            </div>
        </div>

        <h3>Account Information</h3><hr>
        <div class="form-group">
            <label class="col-md-2">First name</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="user.firstname" name="firstname" 
                       ng-minlength=3 ng-maxlength=20 required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">Last name</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="user.lastname" name="lastname" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">Email Address</label>
            <div class="col-md-4">
                <input class="form-control" type="email" 
                       ng-model="user.email" name="email" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">Confirm Email Address</label>
            <div class="col-md-4">
                <input class="form-control" type="email" 
                       ng-model="user.confirmEmail" name="confirmEmail" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">Create Password</label>
            <div class="col-md-4">
                <input class="form-control" type="password" 
                       ng-model="user.password" name="password" 
                       required ng-minlength="6" >
            </div>
            <p class="help-block" ng-show="registerForm.password.$error.minlength || registerForm.password.$invalid">
                Password must be atleast 6 characters
            </p>
        </div>
        <div class="form-group">
            <label class="col-md-2">Confirm Password</label>
            <div class="col-md-4">
                <input class="form-control" type="password" 
                       ng-model="user.confirm" name="confirm" required>
            </div>
        </div>

        <h3>Contact Information</h3><hr>
        <div class="form-group">
            <label class="col-md-2">Phone</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="user.phone" name="phone" 
                       ng-required="user.user_type == 2">
            </div>
        </div>
        <div class="form-group" ng-show="user.user_type == 2">
            <label class="col-md-2">Company Name</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="user.company" name="company" 
                       ng-required="user.user_type == 2">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">Address</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="user.address" name="address" ng-required="user.user_type == 2">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">Address2</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="user.address2" name="address2">
            </div>
        </div>
        <div  ng-controller="countriesController">
            <div class="form-group">
                <label class="col-md-2">Country</label>
                <div class="col-md-4">
                    <select ng-model="user.country" name="country" 
                            ng-options="country.name for country in countries" 
                            ng-change="updateState(user.country.id)"
                            ng-required="user.user_type == 2">
                        <option value="">Select Country</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">State</label>
                <div class="col-md-4">
                    <select ng-model="user.state" name="state" 
                            ng-options="state.name for state in states"
                            ng-change="updateCity(user.state.id)"
                            ng-required="user.user_type == 2">
                        <option value="">Select State</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">City</label>
                <div class="col-md-4">
                    <select ng-model="user.city" name="city" 
                            ng-options="city.name for city in cities"
                            ng-required="user.user_type == 2">
                        <option value="">Select City</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">Zip</label>
            <div class="col-md-4">
                <input class="form-control" type="password" 
                       ng-model="user.zip" name="zip"
                       ng-required="user.user_type == 2">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-5">
                <button class="btn register" ng-disabled="registerForm.$invalid">Register Now</button>
            </div>
        </div>
        <div class="response_messages" ng-show="message">{{ message}}</div>
    </form>
</div>