<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Forum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/forum")
 */
class ForumController extends Controller
{
    /**
     * @Route("/", name="app_forum_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Forum:index.html.twig', array(
            'forums' => $this->getDoctrine()->getRepository(Forum::class)->findAll()
        ));
    }

    /**
     * @Route("/add")
     */
    public function addAction(Request $request)
    {
        if($request->isMethod('post')){
            $forum = new Forum();
            $forum->setTitle($request->get('title'));
            $forum->setDescription($request->get('description'));

            $em = $this->getDoctrine()->getManager();

            $em->persist($forum);

            $em->flush();

            return $this->redirectToRoute('app_forum_index');
        }
        return $this->render('AppBundle:Forum:add.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/{id}",requirements={"id": "\d+"}, name="app_forum_show")
     */
    public function showAction(int $id)
    {
        return $this->render('AppBundle:Forum:show.html.twig', array(
            'forum' =>$this->getDoctrine()->getRepository(Forum::class)->find($id)
        ));
    }

}
