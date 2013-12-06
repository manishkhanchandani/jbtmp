<?php

namespace Jobs\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Jobs\ServiceBundle\Entity\Users;
use Jobs\ServiceBundle\Form\Type\UsersType;
use Jobs\ServiceBundle\Entity\UsersRepository;
use \Jobs\ServiceBundle\Models\ErrorCode;

class UsersController extends Controller
{

    const CODE_EMAIL_INVALID = 1001;
    const CODE_PASSWORD_INVALID = 1002;
    const CODE_CONFIRM_INVALID = 1003;
    const CODE_EMAIL_IN_DB = 1004;
    const CODE_INVALID_USER = 1005;

    public function addAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            $confirm = $request->request->get('confirm');
            $password = trim($password);
            $confirm = trim($confirm);
            if (empty($email)) {
                throw new \Exception(ErrorCode::getError(self::CODE_EMAIL_INVALID), self::CODE_EMAIL_INVALID);
            }
            if (empty($password)) {
                throw new \Exception(ErrorCode::getError(self::CODE_PASSWORD_INVALID), self::CODE_PASSWORD_INVALID);
            }
            if ($password != $confirm) {
                throw new \Exception(ErrorCode::getError(self::CODE_CONFIRM_INVALID), self::CODE_CONFIRM_INVALID);
            }
            $firstname = $request->request->get('firstname');
            $lastname = $request->request->get('lastname');
            $user_type = $request->request->get('user_type');
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
                throw new \Exception(ErrorCode::getError(self::CODE_EMAIL_IN_DB), self::CODE_EMAIL_IN_DB);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($users);
            $em->flush();
            $params = array('name' => $firstname.' '.$lastname, 'to' => $email, 'from' => $this->container->getParameter('from_email'), 'subject' => 'New Member Registration');
            $this->get('jobs_service.email')->send('add.html.php', $params);
            $msg = 'Success';
            $result = 1;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'code' => $code);
        $json = json_encode($arr);
        return new Response($json);
    }

    
    public function loginAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            $password = trim($password);
            $email = trim($email);
            if (empty($email)) {
                throw new \Exception(ErrorCode::getError(self::CODE_EMAIL_INVALID), self::CODE_EMAIL_INVALID);
            }
            if (empty($password)) {
                throw new \Exception(ErrorCode::getError(self::CODE_PASSWORD_INVALID), self::CODE_PASSWORD_INVALID);
            }
            $repository = $this->getDoctrine()->getRepository('JobsServiceBundle:Users');
            $userData = $repository->findOneByEmail($email);
            if (empty($userData)) {
                throw new \Exception(ErrorCode::getError(self::CODE_INVALID_USER), self::CODE_INVALID_USER);
            }
            $passwd = $userData->getPassword();
            if ($passwd !== $password) {
                throw new \Exception(ErrorCode::getError(self::CODE_PASSWORD_INVALID), self::CODE_PASSWORD_INVALID);
            }
            $userId = $userData->getUserId();
            $cache = $this->get('jobs_service.cache')->load('users');
            $key    = md5($userId);
            //update this key for this user
            $cache->removeItem($key);
            $result = $cache->getItem($key, $success);
            if (!$success) {
                $result = $userData;
                $cache->setItem($key, $result);
            }
            $msg = 'Success';
            $result = 1;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'accessToken' => !empty($key) ? $key : '', 'code' => $code);
        $json = json_encode($arr);
        return new Response($json);
    }
    
    
    public function forgotAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $email = $request->request->get('email');
            $email = trim($email);
            if (empty($email)) {
                throw new \Exception(ErrorCode::getError(self::CODE_EMAIL_INVALID), self::CODE_EMAIL_INVALID);
            }
            $repository = $this->getDoctrine()->getRepository('JobsServiceBundle:Users');
            $userData = $repository->findOneByEmail($email);
            if (empty($userData)) {
                throw new \Exception(ErrorCode::getError(self::CODE_INVALID_USER), self::CODE_INVALID_USER);
            }
            $passwd = $userData->getPassword();
            $firstname = $userData->getFirstname();
            $lastname = $userData->getLastname();
            $params = array('name' => $firstname.' '.$lastname, 'to' => $email, 'from' => $this->container->getParameter('from_email'), 'subject' => 'Forgot Password', 'password' => $passwd);
            $this->get('jobs_service.email')->send('forgot.html.php', $params);
            $msg = 'Success';
            $result = 1;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'code' => $code);
        $json = json_encode($arr);
        return new Response($json);
    }
}