
<div id="previewJob" ng-show="showpreview">
    <h2>Job Preview</h2>
    <div class="row-fluid show-grid">
        <div class="col-md-2">{{job.title}}</div><br>
        <div class="col-md-2">{{job.number}}</div><br>
        <div class="col-md-2">
            <b>Location: </b> <br>
            {{job.city.name}}, <br>
            {{job.state.name}}, <br>
            {{job.country.name}}
        </div><br>
        <div class="col-md-2">
            <b>Skills: </b><br>
            {{job.skills}}
        </div><br>
        <div class="col-md-2">
            <b>Location: </b> <br>
            {{job.description}}
        </div><br>
    </div>
</div>