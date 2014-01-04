<!-- src/Jobs/WebBundle/Resources/views/Empoyer/post.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>
<script src="<?php echo $view['assets']->getUrl('scripts/postJob.js') ?>"></script>
<div id="postJob">
    <h2>Post Job</h2>
    <div ng-app="postJob" ng-controller="PostJobController">
        <form novalidate class="form-horizontal" ng-submit="submitJob()" name="jobForm">
            <h4>Create your job posting</h4><hr>
            <div class="form-group">
                <label class="col-md-2">Job title</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" ng-model="job.title"
                           name="title" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2">Job Number</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" 
                           ng-model="job.number" name="number">
                </div>
            </div><hr>
            <div class="form-group">
                <label class="col-md-2">Job Position Type</label>
                <div class="col-md-4">
                    <select class="form-control" multiple="multiple" ng-model="job.position" name="position"
                            ng-options="job.position for job in jobPosition"></select>
                </div>
            </div><hr>
            <h5>Choose your Prefer method to receive Applications.</h5>
            <div class="form-group">
                <div class="col-md-5 text-right">
                    <input class="btn-group" type="radio" 
                           ng-model="job.apply" value="email" 
                           name="apply" required > Apply to Email
                    <input class="btn-group" type="radio" 
                           ng-model="job.apply" value="url" 
                           name="apply" required> Apply to Url
                </div>
            </div>
            <div class="form-group" ng-show="job.apply !== 'url'">
                <label class="col-md-2">Email</label>
                <div class="col-md-4">
                    <input class="form-control" type="email" 
                           ng-model="job.email" name="email" required>
                </div>
            </div>
            <div class="form-group" ng-show="job.apply !== 'url'">
                <label class="col-md-2">CC Email</label>
                <div class="col-md-4">
                    <input class="form-control" type="email" 
                           ng-model="job.CCemail" name="CCemail">
                </div>
            </div>
            <div class="form-group" ng-show="job.apply === 'url'">
                <label class="col-md-2">URL</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" 
                           ng-model="job.url" name="url"  required>
                </div>
            </div><hr>

            <h5>Job Location</h5><hr>
            <div ng-controller="countriesController">
                <div class="form-group">
                    <label class="col-md-2">Job Country</label>
                    <div class="col-md-4">
                        <select ng-model="job.country" name="country" 
                                ng-options="country.name for country in countries" 
                                ng-change="updateState(job.country.id)" required>
                            <option value="">Select Country</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2">Job State</label>
                    <div class="col-md-4">
                        <select ng-model="job.state" name="state" 
                                ng-options="state.name for state in states" 
                                ng-change="updateCity(job.state.id)" required>
                            <option value="">Select State</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2">Job City</label>
                    <div class="col-md-4">
                        <select ng-model="job.city" name="city" 
                                ng-options="city.name for city in cities"  required>
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">Job Area Code</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" 
                           ng-model="job.areaCode" name="areaCode" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">Job Postal Code</label>
                <div class="col-md-4">
                    <input class="form-control" type="text" 
                           ng-model="job.postalCode" name="postalCode" required>
                </div>
            </div>
            <h5>Required Skills: Enter keywords for required position</h5>
            <div class="form-group">            
                <div class="col-md-4">
                    <input class="form-control" type="text" 
                           ng-model="job.skills" name="skills" required style="margin: 0px 150px;">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2">Job Description</label>
                <div class="col-md-7">
                    <textarea class="form-control" type="text" cols="10" rows="10"
                              ng-model="job.description" name="description" required></textarea>
                </div>
            </div><hr>
            <h5>Contact Information</h5>
            <div class="form-group">
                <div class="col-md-4">
                    <input class="" type="checkbox" ng-model="job.contact_name" name="contact_Info"><span> Name: {{userDetails.firstname}} {{userDetails.lastname}}</span>
                    <br><input class="" type="checkbox" ng-model="job.contact_address1" name="contact_Info"><span> Address Line 1: {{userDetails.address}}</span>
                    <br><input class="" type="checkbox" ng-model="job.contact_address2" name="contact_Info"><span> Address Line 2: {{userDetails.address1}}</span>
                    <br><input class="" type="checkbox" ng-model="job.contact_city" name="contact_Info"><span> City: {{userDetails.city}}</span>
                    <br><input class="" type="checkbox" ng-model="job.contact_state" name="contact_Info"><span> State: {{userDetails.state}}</span>
                    <br><input class="" type="checkbox" ng-model="job.contact_zip" name="contact_Info"><span> Zip: {{userDetails.zip}}</span>
                    <br><input class="" type="checkbox" ng-model="job.contact_phone" name="contact_Info"><span> Phone: {{userDetails.phone}}</span>
                    <br><input class="" type="checkbox" ng-model="job.contact_email" name="contact_Info"><span> Email: {{userDetails.email}}</span>
                </div>
            </div><hr>
            <div class="form-group">
                <div class="col-md-5">
                    <button class="btn register" ng-disabled="jobForm.$invalid">Continue</button>
                </div>
            </div>
            <div class="response_messages" ng-show="message">{{message}}</div>
        </form>
    </div>
</div>
<div id="previewJob">
    <h2>Job Preview</h2>
    <div class="row-fluid show-grid">
        <div class="col-md-2">Job title</div><div class="col-md-2">{{job.title}}</div>
    </div>
</div>