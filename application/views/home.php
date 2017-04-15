<!doctype html>
<!--[if lt IE 7]>
<html ng-app="epam" class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html ng-app="epam" class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html ng-app="epam" class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Flower Pots</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <link rel="stylesheet" href="<?php echo asset_url() . 'bower_components/bootstrap/dist/css/bootstrap.css'; ?>">    
    <?php echo css('bootstrap-theme.css'); ?>

    <style>
        body {
            padding-top: 90px;
            padding-bottom: 20px;
        }
    </style>

    <link rel="stylesheet" href="<?php echo asset_url() . 'bower_components/datatables/media/css/dataTables.bootstrap.css'; ?>">    
    <link rel="stylesheet" href="<?php echo asset_url() . 'bower_components/toastr/toastr.css'; ?>">
    <link rel="stylesheet" href="<?php echo asset_url() . 'bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css'; ?>">
    <link rel="stylesheet" href="<?php echo asset_url() . 'bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css' ?>">    
    <?php echo css('main.css'); ?>
    
    <script src="<?php echo asset_url() . 'vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js'; ?>"></script>    
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Flower Pots</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#about">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        About
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        Settings
                    </a>
                </li>
            </ul>
        </div>
        <!--/.navbar-collapse -->
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table id="flower-pots-table" class="table table-bordered table-striped"></table>
        </div>
    </div>

    <div class="clearfix"></div>

    <?php echo br(); ?>

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <button class="btn btn-lg btn-block btn-primary" data-toggle="modal" data-target="#add-edit"
                    id="create-modal-trigger">Add New
            </button>
        </div>
    </div>

    <hr>

    <footer>
        <p>&copy; <?php echo date('Y'); ?></p>
    </footer>
</div>
<!-- /container -->

<!-- modals -->
<div class="modal fade" id="add-edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <!-- .modal-dialog -->
    <div class="modal-dialog">
        <!-- .modal-content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Details</h4>
            </div>
            <div class="modal-body">
                <form id="flower-pot-details">
                    <input type="hidden" name="id" id="form-id">

                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Name" id="form-name">
                    </div>

                    <fieldset>
                        <h5>Watering Schedule</h5>

                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input type="checkbox" data-label-text="Morning"
                                       id="form-water-morning" name="water_morning" value="1">
                            </label>

                            <label class="checkbox-inline">
                                <input type="checkbox" data-label-text="Noon" id="form-water-noon"
                                       name="water_noon" value="1">
                            </label>

                            <label class="checkbox-inline">
                                <input type="checkbox" data-label-text="Afternoon"
                                       id="form-water-afternoon" name="water_afternoon" value="1">
                            </label>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success btn-lg create" style="width: 100%;"><span
                        class="glyphicon glyphicon-plus-sign"></span> Add
                </button>
                <button type="button" class="btn btn-warning btn-lg update" style="width: 100%;"><span
                        class="glyphicon glyphicon-ok-sign"></span> Update
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you
                    want to delete this Record?
                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success delete"><span class="glyphicon glyphicon-ok-sign"></span>
                    Yes
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><span
                        class="glyphicon glyphicon-remove"></span> No
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="about" role="dialog" aria-labelledby="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">About</h4>
            </div>
            <div class="modal-body">
                <p>
                    This app contains a CRUD interface for flower pots as well a notifier on when to water
                    the flowers.
                </p>

                <p>
                    Technologies used:
                </p>

                <ol>
                    <li>Javascript</li>
                    <li>jQuery</li>
                    <li>Twitter Bootstrap</li>
                    <li>PHP (with Codeigniter framework)</li>
                </ol>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="settings" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">Settings</h4>
            </div>
            <div class="modal-body">
                <form id="site-settings">
                    <div class="form-group">
                        <label for="form-settings-email">User Email</label>
                        <input class="form-control" type="text" name="user_email" placeholder="User Email" id="form-settings-email">
                    </div>

                    <div class="form-group">
                        <label for="form-settings-morning-water-time">Morning Water Time</label>
                        <div class='input-group date water-timepicker'>
                            <input type='text' class="form-control" id="form-settings-morning-water-time" name="morning_water_time" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form-settings-morning-water-time">Noon Water Time</label>
                        <div class='input-group date water-timepicker'>
                            <input type='text' class="form-control" id="form-settings-noon-water-time" name="noon_water_time" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form-settings-morning-water-time">Afternoon Water Time</label>
                        <div class='input-group date water-timepicker'>
                            <input type='text' class="form-control" id="form-settings-afternoon-water-time" name="afternoon_water_time" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="form-settings-alert-advance-minutes">Alert (Minutes Before Water Time)</label>
                        <select class="form-control" name="alert_advance_minutes" id="form-settings-alert-advance-minutes">
                            <option value="5">5 minutes</option>
                            <option value="10">10 minutes</option>
                            <option value="15">15 minutes</option>
                            <option value="30">30 minutes</option>
                            <option value="45">45 minutes</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success update"><span class="glyphicon glyphicon-ok-sign"></span>
                    Update
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><span
                        class="glyphicon glyphicon-remove"></span> Dismiss
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /modals -->

<script>
    var baseUrl = '<?php echo base_url(); ?>';
</script>

<script src="<?php echo asset_url() . 'bower_components/jquery/dist/jquery.js'; ?>"></script>
<script src="<?php echo asset_url() . 'bower_components/datatables/media/js/jquery.dataTables.js'; ?>"></script>
<script src="<?php echo asset_url() . 'bower_components/datatables/media/js/dataTables.bootstrap.js'; ?>"></script>
<script src="<?php echo asset_url() . 'bower_components/jquery-timeago/jquery.timeago.js'; ?>"></script>
<script src="<?php echo asset_url() . 'bower_components/toastr/toastr.js' ?>"></script>
<script src="<?php echo asset_url() . 'bower_components/bootstrap/dist/js/bootstrap.js' ?>"></script>
<script src="<?php echo asset_url()  . 'bower_components/bootstrap-switch/dist/js/bootstrap-switch.js'?>"></script>
<script src="<?php echo asset_url() . 'bower_components/moment/moment.js' ?>"></script>
<script src="<?php echo asset_url() . 'bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js' ?>"></script>

<?php echo js('app.js'); ?>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function (b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function () {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = '//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>