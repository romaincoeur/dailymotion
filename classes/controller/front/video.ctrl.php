<?php

namespace Dailymotion;

use Nos\Controller_Front_Application;

use View;

class Controller_Front_Video extends Controller_Front_Application
{
    public $page_from = false;

    public function action_main($args = array())
    {
        $this->page_from = $this->main_controller->getPage();

        $enhancer_url = $this->main_controller->getEnhancerUrl();

        if (!empty($enhancer_url)) {
            $segments = explode('/', $enhancer_url);

            if (!empty($segments[0])) {
                return $this->display_video($segments[0]);
            }

            throw new \Nos\NotFoundException();
        }

        return $this->display_list_video();
    }

    protected function display_list_video()
    {
        $params = array(
            'where' => array(),
            'order_by' => array(
                'vide_id' => 'ASC'
            ),
            'limit' => 10
        );

        $params['where'][] = array('vide_context', '=', $this->page_from->page_context);
        $params['where'][] = array('published', true);

        $video_list =  Model_Video::find('all', $params);

        return \View::forge('front/video_list', array(
            'video_list' => $video_list,
        ), false);
    }


    protected function display_video($virtual_name)
    {
        $video = Model_Video::find('first', array(
            'where' => array(
                array('vide_virtual_name', '=', $virtual_name)
            )
        ));

        if (empty($video)) {
            throw new \Nos\NotFoundException();
        }

        $this->main_controller->setTitle($video->vide_name);
        //$this->main_controller->setMetaDescription($video->vide_name);

        return \View::forge('front/video_item', array(
            'video' => $video,
        ), false);
    }

    public static function getUrlEnhanced($params = array())
    {
        $item = \Arr::get($params, 'item', false);
        if ($item) {
            // url built according to $item'class
            switch (get_class($item)) {
                case 'Dailymotion\Model_Video' :
                    return $item->virtual_name().'.html';
                    break;
            }
        }

        return false;
    }
}