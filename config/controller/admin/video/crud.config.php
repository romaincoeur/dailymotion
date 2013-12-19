<?php
return array(
    'controller_url'  => 'admin/dailymotion/video/crud',
    'model' => 'Dailymotion\Model_Video',
    'layout' => array(
        'large' => true,
        'title' => 'vide_name',
        'content' => array(
            'proprietes_internes' => array(
                'view' => 'nos::form/expander',
                'params' => array(
                    'title'   => __('propri&eacute;t&eacute;s internes'),
                    'nomargin' => true,
                    'options' => array(
                        'allowExpand' => true,
                    ),
                    'content' => array(
                        'view' => 'nos::form/fields',
                        'params' => array(
                            'fields' => array(
                                'vide_nbvue',
                                'vide_rate',
                                'wysiwygs->description->wysiwyg_text',
                                'vide_tags'
                            ),
                        ),
                    ),
                ),
            ),
            'proprietes_dailymotion' => array(
                'view' => 'nos::form/expander',
                'params' => array(
                    'title'   => __('propri&eacute;t&eacute;s dailymotion'),
                    'nomargin' => true,
                    'options' => array(
                        'allowExpand' => true,
                    ),
                    'content' => array(
                        'view' => 'nos::form/fields',
                        'params' => array(
                            'fields' => array(
                                'vide_url_dailymotion',
                                'vide_id_dailymotion'
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'menu' => array(
            __('URL') => array('vide_virtual_name'),
        ),
    ),
    'fields' => array(
        'vide__id' => array (
            'label' => 'ID: ',
            'form' => array(
                'type' => 'hidden',
            ),
            'dont_save' => true,
        ),
        'vide_name' => array(
            'label' => __('name'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'vide_url_dailymotion' => array(
            'label' => __('url_dailymotion'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'vide_nbvue' => array(
            'label' => __('nbvue'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'vide_rate' => array(
            'label' => __('rate'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'wysiwygs->description->wysiwyg_text' => array(
            'label' => __('description'),
            'renderer' => 'Nos\Renderer_Wysiwyg',
            'template' => '{field}',
            'form' => array(
                'style' => 'width: 100%; height: 100px;',
            ),
        ),
        'vide_id_dailymotion' => array(
            'label' => __('id_dailymotion'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'vide_tags' => array(
            'label' => __('tags'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'vide_virtual_name' => array(
            'label' => __('URL: '),
            'renderer' => 'Nos\Renderer_Virtualname',
            'validation' => array(
                'required',
                'min_length' => array(2),
            ),
        ),
    )
    /* UI texts sample
    'i18n' => array(
        // Crud
        // Note to translator: Default copy meant to be overwritten by applications (e.g. The item has been deleted > The page has been deleted). The word 'item' is not to feature in Novius OS.
        'notification item added' => __('Done! The item has been added.'),
        'notification item saved' => __('OK, all changes are saved.'),
        'notification item deleted' => __('The item has been deleted.'),

        // General errors
        'notification item does not exist anymore' => __('This item doesn’t exist any more. It has been deleted.'),
        'notification item not found' => __('We cannot find this item.'),

        // Deletion popup
        'deleting item title' => __('Deleting the item ‘{{title}}’'),

        # Delete action's labels
        'deleting button 1 item' => __('Yes, delete this item'),
        'deleting button N items' => __('Yes, delete these {{count}} items'),

        'deleting wrong confirmation' => __('We cannot delete this item as the number of sub-items you’ve entered is wrong. Please amend it.'),

        '1 item' => __('1 item'),
        'N items' => __('{{count}} items'),

        # Keep only if the model has the behaviour Contextable
        'deleting with N contexts' => __('This item exists in <strong>{{context_count}} contexts</strong>.'),
        'deleting with N languages' => __('This item exists in <strong>{{language_count}} languages</strong>.'),

        # Keep only if the model has the behaviours Contextable + Tree
        'deleting with N contexts and N children' => __('This item exists in <strong>{{context_count}} contexts</strong> and has <strong>{{children_count}} sub-items</strong>.'),
        'deleting with N contexts and 1 child' => __('This item exists in <strong>{{context_count}} contexts</strong> and has <strong>one sub-item</strong>.'),
        'deleting with N languages and N children' => __('This item exists in <strong>{{language_count}} languages</strong> and has <strong>{{children_count}} sub-items</strong>.'),
        'deleting with N languages and 1 child' => __('This item exists in <strong>{{language_count}} languages</strong> and has <strong>one sub-item</strong>.'),

        # Keep only if the model has the behaviour Twinnable
        'translate error parent not available in context' => __('We’re afraid this item cannot be added to {{context}} because its <a>parent</a> is not available in this context yet.'),
        'translate error parent not available in language' => __('We’re afraid this item cannot be translated into {{language}} because its <a>parent</a> is not available in this language yet.'),
        'translate error impossible context' => __('This item cannot be added in {{context}}. (How come you get this error message? You’ve hacked your way into here, haven’t you?)'),

        # Keep only if the model has the behaviour Tree
        'deleting with 1 child' => __('This item has <strong>1 sub-item</strong>.'),
        'deleting with N children' => __('This item has <strong>{{children_count}} sub-items</strong>.'),
    ),
    */
    /*
    Tab configuration sample
    'tab' => array(
        'iconUrl' => 'static/apps/{{application_name}}/img/16/icon.png',
        'labels' => array(
            'insert' => __('Add an item'),
            'blankSlate' => __('Translate an item'),
        ),
    ),
    */
);
