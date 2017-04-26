<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

            'theme/assets/global/plugins/font-awesome/css/font-awesome.min.css',
            'theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
            'theme/assets/global/plugins/bootstrap/css/bootstrap.min.css',
            'theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
            'theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css',
            'theme/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
            'theme/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
            'theme/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
            'theme/assets/global/plugins/morris/morris.css',
            'theme/assets/global/plugins/fullcalendar/fullcalendar.min.css',
            'theme/assets/global/plugins/jqvmap/jqvmap/jqvmap.css',
            'theme/assets/global/plugins/bootstrap-table/bootstrap-table.min.css',
            'theme/assets/global/css/components-md.min.css',
            'theme/assets/global/css/plugins-md.min.css',
            'theme/assets/pages/css/error.min.css',
            
            'theme/assets/layouts/layout2/css/layout.min.css',
            'theme/assets/layouts/layout2/css/themes/dark.min.css',
            'theme/assets/layouts/layout2/css/custom.min.css',

            'theme/assets/global/plugins/bootstrap-sweetalert/sweetalert.css',
            'theme/assets/pages/css/blog.min.css',
            'theme/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css',
            'theme/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css',
            'theme/assets/global/plugins/bootstrap-summernote/summernote.css',
            //'theme/assets/global/plugins/select2/css/select2.min.css',
            //'theme/assets/global/plugins/select2/css/select2-bootstrap.min.css',
            'theme/assets/pages/css/invoice-2.min.css',
            'theme/assets/pages/css/about.min.css',
            //'css/site.css',
            'theme/assets/pages/css/search.min.css',
            'theme/assets/apps/css/inbox.min.css',
            



    ];
    public $js = [
	"theme/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js",

        'theme/assets/global/scripts/app.min.js',
        'theme/assets/pages/scripts/dashboard.min.js',
        'theme/assets/global/plugins/bootstrap/js/bootstrap.min.js',
        'theme/assets/global/plugins/js.cookie.min.js',
        'theme/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'theme/assets/global/plugins/jquery.blockui.min.js',
        'theme/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        'theme/assets/pages/scripts/components-editors.min.js',
        'theme/assets/layouts/global/scripts/quick-nav.min.js',
        'theme/assets/layouts/layout2/scripts/layout.min.js',
        'theme/assets/layouts/layout2/scripts/demo.min.js',
        'theme/assets/layouts/global/scripts/quick-sidebar.js',
        'theme/assets/global/plugins/moment.min.js',
        'theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js',
        'theme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        'theme/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
        'theme/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
        'theme/assets/global/plugins/morris/morris.min.js',
        'theme/assets/global/plugins/morris/raphael-min.js',
        'theme/assets/global/plugins/counterup/jquery.waypoints.min.js',
        'theme/assets/global/plugins/counterup/jquery.counterup.min.js',
        'theme/assets/pages/scripts/components-date-time-pickers.min.js',
        'theme/assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js',
        'theme/assets/pages/scripts/ui-sweetalert.min.js',
        'theme/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js',
        'theme/assets/pages/scripts/form-input-mask.min.js',
        'theme/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js',
        'theme/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js',
        'theme/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js',
        'theme/assets/global/plugins/bootstrap-markdown/lib/markdown.js',
        'theme/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js',
        'theme/assets/global/plugins/bootstrap-summernote/summernote.min.js',
        'theme/assets/pages/scripts/dashboard.min.js',
        'js/extra.js',
        'js/message.js',
        'js/test.js',
        'theme/assets/global/plugins/jquery.mockjax.js',
        'theme/assets/global/plugins/bootstrap-table/bootstrap-table.min.js',
        'theme/assets/pages/scripts/table-bootstrap.min.js',
        
        "theme/assets/pages/scripts/form-wizard.js",

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
