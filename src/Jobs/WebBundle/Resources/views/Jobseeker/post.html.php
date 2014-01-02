<!-- src/Jobs/WebBundle/Resources/views/JobSeeker/post.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>
<script src="<?php echo $view['assets']->getUrl('scripts/postResume.js') ?>"></script>
<h2>Post Your Resume</h2>

<div ng-app="postResume" ng-controller="PostResumeController">
    <form novalidate class="form-horizontal" ng-submit="submitResume()" name="resumeForm">
        <br>
         <div class="form-group">
             <label class="col-md-2">Desired Job Title</label>
            <div class="col-md-4">
                  <input class="form-control" type="text" ng-model="resume.title"
                         name="title" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2">Contact Number</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="resume.contactNumber" name="number">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2">Available to start</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="resume.startDate" name="startdate">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2">Work Authorization</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="resume.workAuthorization" name="workauthorization">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2">Education</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="resume.education" name="education">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2">School</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="resume.school" name="school">
            </div>
        </div>
             
        <div class="form-group">
            <label class="col-md-2">Major</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="resume.major" name="major">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2">Work experience</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="resume.workExperience" name="experience">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2">Skill set</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="resume.skillSet" name="skillset">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2">Preferred location</label>
            <div class="col-md-4">
                <input class="form-control" type="text" 
                       ng-model="resume.location" name="location">
            </div>
        </div>
        <hr>
        
        <div class="form-group">
            <div class="col-md-5">
        <label for="fileToUpload">Attach your resume in MS WORD or PDF format</label><br />
             </div>
        </div>
        
<div ng-controller="MyCtrl">
  <input type="file" ng-file-select="onFileSelect($files)" multiple>
</div>
        
        <br/><br/>
        <div>{{resume |json}}</div>
        <div class="form-group">
            <div class="col-md-5">
                <button class="btn register" ng-disabled="resumeForm.$invalid">Continue</button>{{resumeForm.$invalid}}
            </div>
        </div>
        <div class="response_messages" ng-show="message">{{ message }}</div>
    </form>
</div>