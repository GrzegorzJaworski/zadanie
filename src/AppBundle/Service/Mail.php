<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Jaworski
 * Date: 24.04.2018
 * Time: 23:26
 */

namespace AppBundle\Service;


class Mail
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendRaportMail($urlArray)
    {
        $message = \Swift_Message::newInstance('Raport')
            ->setFrom('grzegorz_j@go2.pl')
            ->setTo('grzegorz_j@go2.pl')
            ->setBody("Witryny, które ładują się szybciej: ".implode(', ', $urlArray)
            )
        ;
        $this->mailer->send($message);
    }
}