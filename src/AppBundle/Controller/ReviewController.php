<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Review;
use AppBundle\Form\ReviewType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

/**
 * Review controller.
 *
 * @Route("review")
 */
class ReviewController extends Controller
{
    /**
     * @Route("/", name="review_index")
     *
     */
    public function reviewAction()
    {

        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository(Review::class)->findAll();

        return $this->render('review/review.html.twig', array(
            'reviews' => $review,
        ));
    }

    /**
     * Creates a new review entity.
     *
     * @Route("/new", name="review_new")
     * @Method({"GET", "POST"})
     */

    public function newAction(Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            // You can use too :
            // return $this->redirect($this->generateUrl('review_show', array('id' => $review->getId())))

            return $this->redirectToRoute('review_show', array('id' => $review->getId()));
        }

        return $this->render('review/new.html.twig', array(
            'review' => $review,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Review entity.
     *
     * @Route("/{id}", name="review_show")
     * @Method("GET")
     */
    public function showAction(Review $review)
    {
        $deleteForm = $this->createDeleteForm($review);

        return $this->render('review/show.html.twig', array(
            'review' => $review,
            'delete_form' => $deleteForm->createView(),
        ));
    }

        /**
         * Creates a form to delete a flight entity.
         *
         * @param Review $review The review entity
         *
         * @return \Symfony\Component\Form\Form The form
         */
        private function createDeleteForm(Review $review)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('review_delete', array('id' => $review->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * Deletes a review entity.
     *
     * @Route("/{id}", name="review_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Review $review)
    {
        $form = $this->createDeleteForm($review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($review);
            $em->flush();
        }

        return $this->redirectToRoute('review_index');
    }

    /**
     * Displays a form to edit an existing review entity.
     *
     * @Route("/{id}/edit", name="review_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Review $review)
    {
        $deleteForm = $this->createDeleteForm($review);
        $editForm = $this->createForm(ReviewType::class, $review);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('review_show', array('id' => $review->getId()));
        }

        return $this->render('flight/edit.html.twig', array(
            'review' => $review,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
}
