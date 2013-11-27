<?php

namespace Jobs\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Jobs\ServiceBundle\Entity\Users;
use Jobs\ServiceBundle\Entity\UsersRepository;

class UsersController extends Controller
{
    public function addAction(Request $request)
    {
        $entity = new Users();
        $form = $this->createFormBuilder()->setData($entity)->getForm();
        $result = 0;
        $msg = '';
        if ($request->getMethod() == 'POST') 
        {
            $form->bindRequest($request);
            pr($form->getErrors());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                $msg = 'Form Submitted Successfully';
                $result = 1;
            }
        }
        $json = array('success' => 1, 'message' => $msg);
        pr($json);exit;
        return new Response($json);
    }

    public function showformAction()
    {
        $entity = new Users();
    }
}
