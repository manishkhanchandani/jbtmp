<header class="navbar navbar header-outer" role="banner">
    <div class="container form-inline">
        <a class="logo"><img src="<?php echo $view['assets']->getUrl('images/work_on_opt_logo.jpg') ?>" width="280" height=""></a>
        <div class="pull-right padding-top">
            <div><span class="orange">Employers:</span> <a href="<?php echo $view['router']->generate('jobs_web_employer_post'); ?>">Post Jobs</a> | <a href="login">Search Resumes</a></div>
            <div><span class="orange">Job Seekers:</span> <a href="<?php echo $view['router']->generate('jobs_web_jobseeker_post'); ?>">Post Resume</a> | <a href="jobs">Find Jobs</a></div>
    </div>
</header>

<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
<!--        <a class="navbar-brand" href="#">Nav Place Holder</a>-->
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Find Jobs</a></li>
            <li><a href="#">Post Resumes</a></li>
            <li><a href="#">Employers</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <!--<li><a href="#">Contact Us</a></li>-->
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>