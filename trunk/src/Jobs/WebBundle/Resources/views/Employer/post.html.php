<!-- src/Jobs/WebBundle/Resources/views/Empoyer/post.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<script src="<?php echo $view['assets']->getUrl('scripts/postJob.js') ?>"></script>
<div id="curtain" style="display:none;"></div>
<div ng-app="postJob" ng-controller="PostJobController" class="postJob">
    <div id="postJob"  ng-show="showpreviewbtns == 'no'">
        <h2>Post Job</h2>
        <h5><b>Create your job posting</b></h5>
        <div>* Required Fields</div><hr>
        <div>
            <form novalidate class="form-horizontal" ng-submit="submitJob()" name="jobForm">
                <div class="form-group">
                    <label class="col-md-2">Job title <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" ng-model="job.title"
                               name="title" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2">Job Number <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" 
                               ng-model="job.number" name="number" required>
                        <input type="hidden" ng-model="job.status" name="status"/>
                    </div>
                </div><hr>
                <div class="form-group">
                    <label class="col-md-2">Job Position Type <span class="req">*</span></label>
                    <div class="col-md-4">
                        <select class="form-control job-position" multiple="multiple"
                                ng-model="job.position" name="position"
                                ng-options="job.id as job.position for job in jobPosition"></select>
                    </div>
                </div><hr>
                <h5>Enter email id to receive Applications</h5>
                <div class="form-group">
                    <label class="col-md-2">Email <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input class="form-control" type="email" 
                               ng-model="job.email" name="email" ng-required="job.apply !== 'url'">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2">CC Email</label>
                    <div class="col-md-4">
                        <input class="form-control" type="email" 
                               ng-model="job.CCemail" name="CCemail">
                    </div>
                </div><hr>

                <h5>Job Location</h5><hr>
                <div ng-controller="countriesController">
                    <div class="form-group">
                        <label class="col-md-2">Job Country <span class="req">*</span></label>
                        <div class="col-md-4">
                            <select ng-model="job.country" name="country"
                                    ng-change="updateState(job.country)" required>
                                <option value="">Select Country</option>
                                <option ng-repeat="country in countries" value="{{country.id}}" 
                                        ng-click="job.countryName = country.name">{{country.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2">Job State <span class="req">*</span></label>
                        <div class="col-md-4">
                            <select ng-if="states == ''" ng-model="job.state" name="state"
                                    ng-change="updateCity(job.state)" required>
                                <option value="">Select State</option>
                                <option ng-repeat="state in state_info" value="{{state.id}}"
                                        ng-click="job.stateName = state.name"
                                        ng-selected="job.state == state.id">{{state.name}}</option>
                            </select>
                            
                            <select ng-if="states != ''" ng-model="job.state" name="state"
                                    ng-change="updateCity(job.state)" required>
                                <option value="">Select State</option>
                                <option ng-repeat="state in states" value="{{state.id}}"
                                        ng-click="job.stateName = state.name">{{state.name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2">Job City <span class="req">*</span></label>
                        <div class="col-md-4">
                            <select ng-if="cities == ''" ng-model="job.city" name="city" required>
                                <option value="">Select City</option>
                                <option ng-repeat="city in city_info" value="{{city.id}}"
                                        ng-click="job.cityName = city.name"
                                        ng-selected="job.city == city.id">{{city.name}}</option>
                            </select>
                            <select ng-if="cities != ''" ng-model="job.city" name="city" required>
                                <option value="">Select City</option>
                                <option ng-repeat="city in cities" value="{{city.id}}"
                                        ng-click="job.cityName = city.name">{{city.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2">Job Area Code <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" 
                               ng-model="job.areaCode" name="areaCode" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2">Job Postal Code <span class="req">*</span></label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" 
                               ng-model="job.postalCode" name="postalCode" required>
                    </div>
                </div>
                <h5>Required Skills: Enter keywords for required position <span class="req">*</span></h5>
                <div class="form-group">            
                    <div class="col-md-4">
                        <input class="form-control" type="text"
                               ng-model="job.skills" name="skills" required style="margin: 0px 150px;">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2">Job Description <span class="req">*</span></label>
                    <div class="col-md-7">
                        <textarea class="form-control" type="text" cols="10" rows="10"
                                  ng-model="job.description" name="description" required></textarea>
                    </div>
                </div><hr>
                <h5>Contact Information</h5>
                <div class="form-group">
                    <div class="col-md-4">
                        <input class="" type="checkbox" ng-model="job.contact_name" name="contact_Info"><span> Name: {{userDetails.firstname}} {{userDetails.lastname}}</span><br>
                        <input class="" type="checkbox" ng-model="job.contact_address1" name="contact_Info"><span> Address Line 1: {{userDetails.address}}</span><br>
                        <input class="" type="checkbox" ng-model="job.contact_address2" name="contact_Info"><span> Address Line 2: {{userDetails.address1}}</span><br>
                        <input class="" type="checkbox" ng-model="job.contact_city" name="contact_Info"><span> City: {{userDetails.city}}</span><br>
                        <input class="" type="checkbox" ng-model="job.contact_state" name="contact_Info"><span> State: {{userDetails.state}}</span><br>
                        <input class="" type="checkbox" ng-model="job.contact_zip" name="contact_Info"><span> Zip: {{userDetails.zip}}</span><br>
                        <input class="" type="checkbox" ng-model="job.contact_phone" name="contact_Info"><span> Phone: {{userDetails.phone}}</span><br>
                        <input class="" type="checkbox" ng-model="job.contact_email" name="contact_Info"><span> Email: {{userDetails.email}}</span><br>
                    </div>
                </div><hr>
            </form>
            <div class="form-group">
                <div class="col-md-5">
                    <button class="btn register" ng-disabled="jobForm.$invalid" ng-click="showpreviewbtns = 'yes'">Continue</button>
                </div>
            </div>
            <div class="response_messages" ng-show="message">{{message}}</div>
        </div>
    </div><br>
    <div id="previewButtons" ng-show="showpreviewbtns == 'yes'">
        <h4>Preview job and Choose Posting Options</h4>
        <button class="btn ngpopup"
                name="inline-name"
                data-popupid="inline"
                data-controller="inlinePopupController"
                ng-click="internalPopOpen('inline', 'inline-popup')">Preview</button>

        <span>Click on preview to display your job as it will appear to job seekers</span><br>
        <hr>
        <p>You will need to click 'Post' or 'Save as inactive' in order to complete the job posting process.</p>
        <button class="btn register" ng-click="showpreviewbtns = 'no'">Edit</button>
        <button class="btn register" ng-disabled="jobForm.$invalid" ng-click="submitJobasInactive()">Save as Inactive</button>
        <button ng-if="jobUpdate == ''" class="btn register" ng-disabled="jobForm.$invalid" ng-click="submitJob()">Post</button>
        <button ng-if="jobUpdate != ''" class="btn register" ng-disabled="jobForm.$invalid" ng-click="updateJob(jobId)">Update</button><br>
        <div style="color:blue;">{{message}}</div>
    </div>

    <script type="text/ng-template" id="inline-popup">
        <div id="ngpopup">
            <a class="close">X</a>
            <div id="previewJob">
                <h2>Job Preview</h2>
                <div class="row-fluid show-grid">
                    <div>
                        <b>Job Title:</b> {{job.title}} <br>
                        <b>Job Number:</b>{{job.number}}
                    </div><br>
                    <div>
                        <b>Location: </b> <br>
                        {{job.cityName}}, <br>
                        {{job.stateName}}, <br>
                        {{job.countryName}}
                    </div><br>
                    <div>
                        <b>Skills: </b><br>
                        {{job.skills}}
                    </div><br>
                    <div>
                        <b>Description: </b> <br>
                        {{job.description}}
                    </div><br>
                    <div>
                        <b>Contact: </b><br>
                        <span ng-if="job.contact_name">{{userDetails.firstname}} {{userDetails.lastname}}</span><br>
                        <span ng-if="job.contact_address">{{userDetails.address}} {{userDetails.address1}}</span><br>
                        <span ng-if="job.contact_city">{{userDetails.city}}</span><br>
                        <span ng-if="job.contact_state">{{userDetails.state}}</span><br>
                        <span ng-if="job.contact_zip">{{userDetails.zip}}</span><br>
                        <span ng-if="job.contact_phone">{{userDetails.phone}}</span><br>
                        <span ng-if="job.contact_email">{{userDetails.email}}</span>
                    </div>
                    <button ng-if="jobUpdate == ''" class="btn register" ng-disabled="jobForm.$invalid" ng-click="submitJob()">Post</button>
                    <button ng-if="jobUpdate != ''" class="btn register" ng-disabled="jobForm.$invalid" ng-click="updateJob(jobId)">Update</button><br>
                </div>
            </div>
        </div>
    </script>


</div>