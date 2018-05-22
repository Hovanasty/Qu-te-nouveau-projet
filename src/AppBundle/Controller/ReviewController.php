<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Review;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * Review controller.
 *
 * @Route("review")
 */
class ReviewController extends Controller
{
    /**
     * @Route("/", name="review")
     *
     */
    public function reviewAction()
    {
        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository(Review::class)->findAll();

        return $this->render('review/review.html.twig');
    }

    /**
     * @Route("/new", name="review_new")
     * 
     */
    public function newReviewAction()
    {
        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository(Review::class)->findAll();

        return $this->render('review/new.html.twig', array(
            'review' => $review,
        ));
    }
}
