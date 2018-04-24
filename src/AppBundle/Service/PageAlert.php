<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Jaworski
 * Date: 24.04.2018
 * Time: 23:14
 */

namespace AppBundle\Service;


class PageAlert
{
    private $mailer;
    private $smsAlert;

    public function __construct(Mail $mailer, Sms $smsAlert)
    {
        $this->mailer = $mailer;
        $this->smsAlert = $smsAlert;
    }

    /**
     * @param $plik
     */
    public function checkIfAlert($plik)
    {
        $mainTime = $plik[0]['time'];
        $mail = [];
        $sms = [];

        for ($x = 1; $x<count($plik); $x++){
            if ($plik[$x]['time'] > 0){
                $difference = (int)$mainTime/(int)$plik[$x]['time'];
                if($difference >= 2){
                    $mail[] = $plik[$x]['url'];
                    $sms[] = $plik[$x]['url'];
                } elseif ($difference > 1) {
                    $mail[] = $plik[$x]['url'];
                }
            }
        }

        if (count($mail)){
            $this->mailer->sendRaportMail($mail);
        }

        if (count($sms)){
            $this->smsAlert->sendRaportSms($sms);
        }

    }
}