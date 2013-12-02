<?php

namespace Jobs\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Jobs\ServiceBundle\Entity\Users;
use Jobs\ServiceBundle\Form\Type\UsersType;
use Jobs\ServiceBundle\Entity\UsersRepository;

class UsersController extends Controller
{
    private $errors = array();

    public function addAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $this->errors = array();
        try {
            $usersRequest = $request->request->get('users');
            if (empty($usersRequest)) {
                throw new \Exception('Invalid Data');
            }
            $email = !empty($usersRequest['email']) ? $usersRequest['email'] : NULL;
            $password = !empty($usersRequest['password']['password']) ? $usersRequest['password']['password'] : NULL;
            $confirm = !empty($usersRequest['password']['confirm']) ? $usersRequest['password']['confirm'] : NULL;
            if ($password != $confirm) {
                throw new \Exception('Password does not match with confirm password');
            }
            $firstname = !empty($usersRequest['firstname']) ? $usersRequest['firstname'] : NULL;
            $lastname = !empty($usersRequest['lastname']) ? $usersRequest['lastname'] : NULL;
            $user_type = !empty($usersRequest['user_type']) ? $usersRequest['user_type'] : NULL;
            $users = new Users();
            $userId = guid();
            $users->setUserId($userId);
            $users->setAccessLevel('Member');
            $created = tstobts(time());
            $users->setCreated($created);
            $users->setStatus(1);
            $users->setEmail($email);
            $users->setPassword($password);
            $users->setFirstname($firstname);
            $users->setLastname($lastname);
            $users->setUserType($user_type);
            $repository = $this->getDoctrine()->getRepository('JobsServiceBundle:Users');
            $userData = $repository->findOneByEmail($users->getEmail());
            if (!empty($userData)) {
                throw new \Exception('Email already in database.');
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($users);
            $em->flush();
            $msg = 'Success';
            $result = 1;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
        }
        $arr = array('success' => $result, 'message' => $msg);
        if ($request->query->get('admin')) {
            $arr['postVars'] = $_POST;
        }
        $json = json_encode($arr);
        return new Response($json);
    }
}
