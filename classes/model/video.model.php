<?php

namespace Dailymotion;

class Model_Video extends \Nos\Orm\Model
{

    protected static $_primary_key = array('vide_id');
    protected static $_table_name = 'videos';

    protected static $_properties = array(
        'vide_id',
        'vide_name',
        'vide_url_dailymotion',
        'vide_nbvue',
        'vide_rate',
        'vide_id_dailymotion',
        'vide_tags',
        'vide_virtual_name' => array(
            'default' => null,
            'data_type' => 'varchar',
            'null' => false,
            'character_maximum_length' => 100,
        ),
        'vide_publication_status',
        'vide_publication_start',
        'vide_publication_end',
        'vide_context',
        'vide_context_common_id',
        'vide_context_is_main',
        'vide_created_by_id',
        'vide_updated_by_id',
        'vide_created_at',
        'vide_updated_at',
    );

    protected static $_title_property = 'vide_name';

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'mysql_timestamp' => true,
            'property'=>'vide_created_at'
        ),
        'Orm\Observer_UpdatedAt' => array(
            'mysql_timestamp' => true,
            'property'=>'vide_updated_at'
        )
    );

    protected static $_behaviours = array(
        'Nos\Orm_Behaviour_Publishable' => array(
            'publication_state_property' => 'vide_publication_status',
            'publication_start_property' => 'vide_publication_start',
            'publication_end_property' => 'vide_publication_end',
        ),
        'Nos\Orm_Behaviour_Urlenhancer' => array(
            'enhancers' => array('dailymotion_video'),
        ),
        'Nos\Orm_Behaviour_Virtualname' => array(
            'virtual_name_property' => 'vide_virtual_name',
        ),
        'Nos\Orm_Behaviour_Twinnable' => array(
            'context_property'      => 'vide_context',
            'common_id_property' => 'vide_context_common_id',
            'is_main_property' => 'vide_context_is_main',
            'common_fields'   => array(),
        ),
        'Nos\Orm_Behaviour_Author' => array(
            'created_by_property' => 'vide_created_by_id',
            'updated_by_property' => 'vide_updated_by_id',
        ),
    );

    protected static $_belongs_to  = array(
        /*
        'key' => array( // key must be defined, relation will be loaded via $video->key
            'key_from' => 'vide_...', // Column on this model
            'model_to' => 'Dailymotion\Model_...', // Model to be defined
            'key_to' => '...', // column on the other model
            'cascade_save' => false,
            'cascade_delete' => false,
            //'conditions' => array('where' => ...)
        ),
        */
    );
    protected static $_has_one   = array();
    protected static $_has_many  = array(
        /*
        'key' => array( // key must be defined, relation will be loaded via $video->key
            'key_from' => 'vide_...', // Column on this model
            'model_to' => 'Dailymotion\Model_...', // Model to be defined
            'key_to' => '...', // column on the other model
            'cascade_save' => false,
            'cascade_delete' => false,
            //'conditions' => array('where' => ...)
        ),
        */
    );
    protected static $_many_many = array(
        /*
            'key' => array( // key must be defined, relation will be loaded via $video->key
                'table_through' => '...', // intermediary table must be defined
                'key_from' => 'vide_...', // Column on this model
                'key_through_from' => '...', // Column "from" on the intermediary table
                'key_through_to' => '...', // Column "to" on the intermediary table
                'key_to' => '...', // Column on the other model
                'cascade_save' => false,
                'cascade_delete' => false,
                'model_to'       => 'Dailymotion\Model_...', // Model to be defined
            ),
        */
    );

    protected static $_twinnable_belongs_to = array();
    protected static $_twinnable_has_one    = array();
    protected static $_twinnable_has_many   = array();
    protected static $_twinnable_many_many  = array();
    protected static $_attachment           = array();
}
