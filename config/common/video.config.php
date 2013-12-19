<?php
return array(
    'controller' => 'video/crud',
    'data_mapping' => array(
        'vide_name' => array(
            'title' => __('name'),
        ),
        'vide_nbvue' => array(
            'title' => __('nbvue'),
        ),
        'vide_rate' => array(
            'title' => __('rate'),
        ),
        'vide_tags' => array(
            'title' => __('tags'),
        ),
        'context' => true,
        'publication_status' => true,
    ),
    /*
    'i18n' => array(
        // Crud
        'notification item added' => __('Done! The item has been added.'),
        'notification item saved' => __('OK, all changes are saved.'),
        'notification item deleted' => __('The item has been deleted.'),

        // General errors
        'notification item does not exist anymore' => __('This item doesn’t exist any more. It has been deleted.'),
        'notification item not found' => __('We cannot find this item.'),
        'deleted popup title' => __('Bye bye'),
        'deleted popup close' => __('Close tab'),

        // see novius-os/framework/config/i18n_common.config.php
    ),
    */

    'actions' => array(
        'sync' => array(
            'label' => __('Synchronise'),
            // Le clic ouvrira un nouvel onglet
            'action' => array(
                'action' => 'nosTabs',
                'method' => 'add',
                'tab' => array(
                    'url' => '{{controller_base_url}}sync',
                ),
            ),
            // L'action sera affichée uniquement dans la barre d'outils de l'App Desk
            'targets' => array(
                'toolbar-grid' => true,
            ),
        ),
    )

    /*
    'actions' => array(
        'list' => array(
            'delete' => array(
                'action' => array( // ce qu'on envoi à nosAction
                    'action' => 'confirmationDialog',
                    'dialog' => array(
                        'contentUrl' => '{{controller_base_url}}delete/{{_id}}',
                        'title' => 'Delete',
                    ),
                ),
                'label' => __('Delete'),
                'primary' => true,
                'icon' => 'trash',
                'red' => true,
                'targets' => array(
                'grid' => true,
                    'toolbar-edit' => true,
                ),
                'disabled' => function($item) {
                        return false;
                },
                'visible' => function($params) {
                        return !isset($params['item']) || !$params['item']->is_new();
                },
            ),
        ),
        'order' => array(
            'delete',
            // others
        ),
    )
    */
);