<!-- src/Jobs/WebBundle/Resources/views/Auth/register.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>
<script src="<?php echo $view['assets']->getUrl('scripts/register.js') ?>"></script>
<h2>New Users: Sign up now</h2>

<div  ng-app="App" ng-controller="Controller">
    <form novalidate class="form-horizontal" ng-submit="submit()" name="form">
        <h3>site name Registration</h3><hr>
         <div class="form-group">
             <label class="col-md-3">I will be using site name as </label>
            <div class="col-md-5">
                  <input class="btn-group" type="radio" ng-model="user.user_type" value="1" name="user_type" required> a job seeker
                  <input class="btn-group" type="radio" ng-model="user.user_type" value="2" name="user_type" required> an employer
                  <input class="btn-group" type="radio" ng-model="user.user_type" value="3" name="user_type" required> a staffing agency representative
            </div>
        </div>
        
        <h3>Account Information</h3><hr>
        <div class="form-group">
            <label class="col-md-2">First name</label>
            <div class="col-md-4"><input class="form-control" type="text" ng-model="user.firstname" name="firstname" ng-minlength=3 ng-maxlength=20 required></div>
        </div>
        <div class="form-group">
            <label class="col-md-2">Last name</label>
            <div class="col-md-4"><input class="form-control" type="text" ng-model="user.lastname" name="lastname" required></div>
        </div>
        <div class="form-group">
            <label class="col-md-2">Email Address</label>
            <div class="col-md-4"><input class="form-control" type="email" ng-model="user.email" name="email" required></div>
        </div>
        <div class="form-group">
            <label class="col-md-2">Confirm Email Address</label>
            <div class="col-md-4"><input class="form-control" type="email" ng-model="user.confirmEmail" name="confirmEmail" required></div>
        </div>
        <div class="form-group">
            <label class="col-md-2">Create Password</label>
            <div class="col-md-4"><input class="form-control" type="password" ng-model="user.password" name="password" required ng-minlength="6" ></div>
            <p class="help-block" ng-show="form.password.$error.minlength || form.password.$invalid">Password must be atleast 6 characters</p>
        </div>
        <div class="form-group">
            <label class="col-md-2">Confirm Password</label>
            <div class="col-md-4"><input class="form-control" type="password" ng-model="user.confirm" name="confirm" required></div>
        </div>
        
        <h3>Contact Information</h3><hr>
         <div class="form-group">
            <label class="col-md-2">Phone</label>
            <div class="col-md-4"><input class="form-control" type="number" ng-model="user.phone" name="phone"></div>
        </div>
         <div class="form-group">
            <label class="col-md-2">Address</label>
            <div class="col-md-4"><input class="form-control" type="text" ng-model="user.address" name="address"></div>
        </div>
         <div class="form-group">
            <label class="col-md-2">Address2</label>
            <div class="col-md-4"><input class="form-control" type="text" ng-model="user.address2" name="address2"></div>
        </div>
        <div  ng-controller="countriesController">
            <div class="form-group">
                <label class="col-md-2">country</label>
                <div class="col-md-4">
                    <select ng-model="user.country" name="country" ng-options="country.name for country in countries" ng-change="updateCountry()">
                        <option value="">Select country</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">State</label>
                <div class="col-md-4">
                    <select ng-model="user.state" name="state" ng-options="state.name for state in availableStates">
                        <option value="">Select state</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">City</label>
            <div class="col-md-4"><input class="form-control" type="text" ng-model="user.city" name="city"></div>
        </div>
         <div class="form-group">
            <label class="col-md-2">Zip</label>
            <div class="col-md-4"><input class="form-control" type="password" ng-model="user.zip" name="zip"></div>
        </div>
        
        <div class="form-group">
            <div class="col-md-5">
                <button class="btn btn-default" ng-disabled="form.$invalid">Register Now</button>
            </div>
        </div>
        <div class="response_messages" ng-show="message">{{ message }}</div>
    </form>
</div>