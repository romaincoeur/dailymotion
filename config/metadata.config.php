<?php
return array(
    'name'    => 'Dailymotion',
    'version' => 'WIP', //@todo: to be defined
    'provider' => array(
        'name' => 'Unknown', //@todo: to be defined
    ),
    'namespace' => "Dailymotion",
    'permission' => array(
    ),
    'icons' => array( //@todo: to be defined
        64 => 'static/apps/dailymotion/img/64/icon.png',
        32 => 'static/apps/dailymotion/img/32/icon.png',
        16 => 'static/apps/dailymotion/img/16/icon.png',
    ),
    'launchers' => array(
        'Dailymotion::Video' => array(
            'name'    => 'Video', // displayed name of the launcher
            'action' => array(
                'action' => 'nosTabs',
                'tab' => array(
                    'url' => 'admin/dailymotion/video/appdesk', // url to load
                ),
            ),
        ),
    ),
    /* Launcher configuration sample
    'launchers' => array(
        'key' => array( // key must be defined
            'name'    => 'name of the launcher', // displayed name of the launcher
            'action' => array(
                'action' => 'nosTabs',
                'tab' => array(
                    'url' => 'url to load', // URL to load
                ),
            ),
        ),
    ),
    */
    // Enhancer configuration sample
    'enhancers' => array(
        'dailymotion_video' => array( // key must be defined
            'title' => 'Dailymotion Video',
            'desc'  => '',
            'urlEnhancer' => 'dailymotion/front/video/main', // URL of the enhancer
            //'previewUrl' => 'admin/dailymotion/application/preview', // URL of preview
            //'dialog' => array(
            //    'contentUrl' => 'admin/dailymotion/application/popup',
            //    'width' => 450,
            //    'height' => 400,
            //    'ajax' => true,
            //),
        ),
    ),
    /* Data catcher configuration sample
    'data_catchers' => array(
        'key' => array( // key must be defined
            'title' => 'title',
            'description'  => '',
            'action' => array(
                'action' => 'nosTabs',
                'tab' => array(
                    'url' => 'admin/dailymotion/post/insert_update/?context={{context}}&title={{urlencode:'.\Nos\DataCatcher::TYPE_TITLE.'}}&summary={{urlencode:'.\Nos\DataCatcher::TYPE_TEXT.'}}&thumbnail={{urlencode:'.\Nos\DataCatcher::TYPE_IMAGE.'}}',
                    'label' => 'label of the data catcher',
                ),
            ),
            'onDemand' => true,
            'specified_models' => false,
            // data examples
            'required_data' => array(
                \Nos\DataCatcher::TYPE_TITLE,
            ),
            'optional_data' => array(
                \Nos\DataCatcher::TYPE_TEXT,
                \Nos\DataCatcher::TYPE_IMAGE,
            ),
        ),
    ),
    */
);
