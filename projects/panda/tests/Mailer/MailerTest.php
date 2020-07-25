<?php

namespace tests\Mailer;

use App\Entity\User;
use App\Mailer\Mailer;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

class MailerTest extends TestCase
{
    public function testConfirmationEmail()
    {
        $user = new User();
        $user->setEmail('john@doe.com');

        $swiftMailer = $this->getMockBuilder(\Swift_Mailer::class)
                ->disableOriginalConstructor()
                ->getMock();

        $swiftMailer->expects($this->once())->method('send')
                ->with($this->callback(function($subject) {
                    $messangeStr = (string)$subject;

                    return strpos($messangeStr, "From: me@domain.com") !== false
                    && strpos($messangeStr, "Content-Type: text/html; charset=utf-8") !== false
                    && strpos($messangeStr, "Subject: Welcome to the micro-post app!") !== false
                    && strpos($messangeStr, "To: john@doe.com") !== false
                    && strpos($messangeStr, 'This is a message body') !== false;

                }));

        $twigMock = $this->getMockBuilder(Environment::class)
                ->disableOriginalConstructor()
                ->getMock();

        $twigMock->expects($this->once())->method('render')
                ->with('email/registration.html.twig', [
                    'user' => $user,
                    ]
                )->willReturn('This is a message body');

        $mailer = new Mailer($swiftMailer, $twigMock, 'me@domain.com');
        $mailer->sendConfirmationEmail($user);
    }
}
