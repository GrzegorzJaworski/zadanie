<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Jaworski
 * Date: 25.04.2018
 * Time: 00:01
 */

namespace AppBundle\Service;


class ReportFile
{
    /**
     * @param $report
     */
    public function saveTxt($report)
    {
        $time = new \DateTime('now');
        $string = $time->format('G:i:s d-m-Y').' - ';

        $mainTime = $report[0]['time'];

        $string .= $report[0]['url'].': '.$mainTime.', ';

        for ($x = 1; $x<count($report); $x++){
            $difference = (int)$report[$x]['time']!=0?(int)$mainTime-(int)$report[$x]['time']:'Błąd pomiaru';
            $string .= $report[$x]['url'].': '.(int)$report[$x]['time'].': '. $difference;
            $string.= $x != count($report)-1?', ':"\r\n";
        }

        file_put_contents('log.txt', $string, FILE_APPEND);
    }
}