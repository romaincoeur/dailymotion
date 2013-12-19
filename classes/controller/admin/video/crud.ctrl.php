<?php
namespace Dailymotion;

class Controller_Admin_Video_Crud extends \Nos\Controller_Admin_Crud
{

    // Cette fonction insere les videos du compte dailymotion configuré dans la BD locale
    // Attention cette fonction n'est pas stable du tout !
    // Ne l'utilisez que si vous comporenez le code
    public function action_sync()
    {
        //----- Dailymotion object instanciation -----//
        $api = new Dailymotion();
        $api->setGrantType(
            Dailymotion::GRANT_TYPE_PASSWORD,
            $this->app_config['dailymotion']['apiKey'],
            $this->app_config['dailymotion']['apiSecret'],
            $scope = array('manage_videos'),
            array(
                'username' => $this->app_config['dailymotion']['user'],
                'password' => $this->app_config['dailymotion']['password']
            )
        );

        $videos = $api->get('/videos', array(
            'fields' => 'id,thumbnail_120_url,title,views_total,rating,tags',
            'owner' => $this->app_config['dailymotion']['user'],
        ))['list'];

        if ($videos != null)
        {
            foreach ($videos as $video_daily)
            {
                $video_bd = Model_Video::find($video_daily['title']);
                if ($video_bd == null)
                {
                    $video_new = Model_Video::forge(array(
                        'vide_name'                 => $video_daily['title'],
                        'vide_id_dailymotion'       => $video_daily['id'],
                        'vide_url_dailymotion'      => $video_daily['thumbnail_120_url'],
                        'vide_nbvue'                => $video_daily['views_total'],
                        'vide_rate'                 => $video_daily['rating'],
                        'vide_tags'                 => $video_daily['tags'],
                        'vide_publication_status'   => 1,
                        'vide_context'              => 'main::fr_FR',
                    ));
                    $video_new->save();
                }
            }
        }

    }


    // Supprime l'objet en BD mais aussi sur dailymotion
    public function delete_confirm()
    {
        logger(\Fuel::L_WARNING,'delete_confirm');
        $id = \Input::post('id', 0);
        if (empty($id) && \Fuel::$env === \Fuel::DEVELOPMENT) {
            $id = \Input::get('id');
        }

        $this->item = $this->crud_item($id);
        $this->is_new = $this->item->is_new();
        $this->checkPermission('delete');

        $dispatchEvent = array(
            'name' => $this->config['model'],
            'action' => 'delete',
            'id' => (int) $id,
        );

        //----- Dailymotion object instanciation -----//
        $api = new Dailymotion();
        $api->setGrantType(
            Dailymotion::GRANT_TYPE_PASSWORD,
            $this->app_config['dailymotion']['apiKey'],
            $this->app_config['dailymotion']['apiSecret'],
            $scope = array('manage_videos'),
            array(
                'username' => $this->app_config['dailymotion']['user'],
                'password' => $this->app_config['dailymotion']['password']
            )
        );

        logger(\Fuel::L_WARNING,$this->item['vide_id_dailymotion']);

        $api->delete('/video/'.$this->item['vide_id_dailymotion']);

        $json_delete = $this->delete();

        if ($this->behaviours['twinnable']) {
            $dispatchEvent['context_common_id'] = $this->item->{$this->behaviours['twinnable']['common_id_property']};
            $dispatchEvent['id'] = array();
            $dispatchEvent['context'] = array();

            // Filter allowed contexts
            $contexts = array_intersect(array_keys(\Nos\User\Permission::contexts()), \Input::post('contexts', array()));
            $contexts_item = $this->item->get_all_context();

            $count_1 = count($contexts);
            $count_2 = count($contexts_item);
            $count_3 = count(array_intersect($contexts, $contexts_item));

            $delete_all_contexts = ($count_1 == $count_3 && $count_2 == $count_3);

            // Children will be deleted recursively (with the 'after_delete' event from the Tree behaviour)
            foreach ($this->item->find_context($contexts) as $item_context) {
                $dispatchEvent['id'][] = (int) $item_context->{$this->pk};
                $dispatchEvent['context'][] = $item_context->{$this->behaviours['twinnable']['context_property']};

                if ($this->behaviours['tree']) {
                    foreach ($item_context->get_ids_children(false) as $item_id) {
                        $dispatchEvent['id'][] = (int) $item_id;
                    }
                }

                // Delete only selected contexts
                if (!$delete_all_contexts) {
                    // Reassigns common_id if this item is the main context (with the 'after_delete' event from the Twinnable behaviour)
                    $item_context->delete();
                }
            }

            // Optimised operation for deleting all contexts
            if ($delete_all_contexts) {
                $this->item->delete_all_context();
            }
        }
        else
        {
            if ($this->behaviours['contextable']) {
                $dispatchEvent['context'] = $this->item{$this->behaviours['contextable']['context_property']};
            }
            if ($this->behaviours['tree']) {
                $dispatchEvent['id'] = array($this->item->{$this->pk});
                foreach ($this->item->get_ids_children(false) as $item_id) {
                    $dispatchEvent['id'][] = (int) $item_id;
                }
            }

            $this->item->delete();
        }
        $json = array(
            'notify' => $this->config['i18n']['notification item deleted'],
            'dispatchEvent' => array($dispatchEvent),
        );
        if (is_array($json_delete)) {
            $json = \Arr::merge($json, $json_delete);
        }

        $this->response($json);
    }
}
