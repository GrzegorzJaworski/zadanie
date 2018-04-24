<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Jaworski
 * Date: 24.04.2018
 * Time: 22:37
 */

namespace AppBundle\Service;


class PageSpeed
{
    /**
     * @param $url
     * @return int
     */
    public function getLoadTime($url)
    {
        $url = 'https://www.googleapis.com/pagespeedonline/v4/runPagespeed?url='.$url.'&strategy=desktop&fields=responseCode,loadingExperience%2Fmetrics&key=AIzaSyBtS5TK56ds2WH0LNmC5B1xpFc9wNQu-84';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($res, true);

//        dump($res);die;
        if (key_exists('loadingExperience', $res)){
            $time = $res['loadingExperience']['metrics']['DOM_CONTENT_LOADED_EVENT_FIRED_MS']['median'];
        }else{
            $time = 0;
        }
        return $time;
    }
}