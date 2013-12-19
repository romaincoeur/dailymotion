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
        logger(\Fuel::L_WARNING, $this->app_config['dailymotion']['user']);
        $videos = $api->get('/videos', array(
            'fields' => 'id,thumbnail_120_url,title,views_total,rating,tags',
            'owner' => $this->app_config['dailymotion']['user'],
        ))['list'];

        logger(\Fuel::L_WARNING, count($videos));

        if ($videos != null)
        {
            foreach ($videos as $video_daily)
            {
                logger(\Fuel::L_WARNING, $video_daily['title']);
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
}
