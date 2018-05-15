<?php

namespace App\Updates;

use App\Service\MessageGenerator;

class SiteUpdateManager
{
    private $messageGenerator;
    private $mailer;
    private $iam;
    private $adminEmail;

    public function __construct(MessageGenerator $messageGenerator, \Swift_Mailer $mailer, $adminEmail, $myName)
    {
        $this->messageGenerator = $messageGenerator;
        $this->mailer           = $mailer;
        $this->adminEmail = $adminEmail;
        $this->iam = $myName;
    }

    public function notifyOfSiteUpdate()
    {
        $happyMessage = $this->messageGenerator->getHappyMessage();

        $message = (new \Swift_Message('Site update just happened!'))
            ->setFrom('admin@example.com')
            //->setTo('manager@example.com')
            ->setTo($this->adminEmail)
            ->addPart(
                'Someone just updated the site. It was '.$this->iam.'. We told them: '.$happyMessage
            );

        return $this->mailer->send($message) > 0;
    }
}