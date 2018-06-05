<?php

namespace AppBundle\Service;

use AppBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Mailer
 * @package AppBundle\Service
 */
class Mailer
{
    protected $mailer;
    protected $templating;
    private $from = "reservations@flyaround.com";


    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function sendMail($to, $subject, $body)
    {
        $message = \Swift_Message::newInstance();

        $message
            ->setFrom($this->from)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType('text/html');

        $this->mailer->send($message);
    }


    public function reservationUser(Reservation $reservation)
    {
        $subject = 'Reservation confirmee';
        $to = $reservation->getPassenger()->getEmail();
        $body = $this->templating->render('email\messageUser.html.twig', [
            'reservation' => $reservation
    ]);
        $this->sendMail($to,$subject,$body);
    }

    public function reservationPilot(Reservation $reservation)
    {
        $subject = 'Reservation confirmee';
        $to = $reservation->getFlight()->getPilot()->getEmail();
        $body = $this->templating->render('email\message.html.twig', [
            'reservation' => $reservation
        ]);
        $this->sendMail($to,$subject,$body);
    }
}