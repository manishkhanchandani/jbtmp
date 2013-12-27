<?php

namespace Jobs\ServiceBundle\Controller;

use Jobs\ServiceBundle\Controller\MainController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Jobs\ServiceBundle\Entity\Users;
use Jobs\ServiceBundle\Form\Type\UsersType;
use Jobs\ServiceBundle\Entity\UsersRepository;
use Jobs\ServiceBundle\Models\ErrorCode;

class UsersController extends MainController
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
            $users->setModified($created);
            $users->setTempPassword($password);
            $users->setDeleted(0);
            $users->setDeletedDt(0);
            $users->setPhone($request->request->get('phone'));
            $users->setAddress($request->request->get('address'));
            $users->setAddress2($request->request->get('address2'));
            $users->setCity($request->request->get('city'));
            $state = $request->request->get('state');
            $sname = isset($state['name']) ? $state['name'] : NULL;
            $users->setState($sname);
            $country = $request->request->get('country');
            $cname = isset($country['name']) ? $country['name'] : NULL;
            $users->setCountry($sname);
            $users->setZip($request->request->get('zip'));
            $repository = $this->getDoctrine()->getRepository('JobsServiceBundle:Users');
            $userData = $repository->findOneByEmail($users->getEmail());
            if (!empty($userData)) {
                throw new \Exception(ErrorCode::getError(self::CODE_EMAIL_IN_DB), self::CODE_EMAIL_IN_DB);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($users);
            $em->flush();
            $site_name = $this->container->getParameter('site_name');
            $host_url = $this->container->getParameter('host_url');
            $site_name_url = $this->container->getParameter('site_name_url');
            $params = array('name' => $firstname.' '.$lastname, 'to' => $email, 'from' => $this->container->getParameter('from_email'), 'subject' => $site_name.' Registration Confirmation', 'site_name' => $site_name, 'host_url' => $host_url, 'site_name_url' => $site_name_url);
            if ($user_type == 1)
                $this->get('jobs_service.email')->send('add.html.php', $params);
            else if ($user_type == 2)
                $this->get('jobs_service.email')->send('add_emp.html.php', $params);
            $msg = 'Success';
            $result = 1;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'code' => $code, 'post' => $_POST);
        $json = json_encode($arr);
        return new Response($json);
    }

    ///api/user/login
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
            $passwdTemp = $userData->getTempPassword();
            if (!($passwd === $password || $passwdTemp === $password)) {
                throw new \Exception(ErrorCode::getError(self::CODE_PASSWORD_INVALID), self::CODE_PASSWORD_INVALID);
            }
            $userId = $userData->getUserId();
            $key    = md5($userId);
            $tm = 0;
            $remember = $request->request->get('remember');
            if ($remember) {
                $tm = time() + (60 *60 * 24* 365);
            }
            setcookie('userId', $userId, $tm, '/');
            setcookie('email', $email, $tm, '/');
            setcookie('accessToken', $key, $tm, '/');
            setcookie('userType', $userData->getUserType(), $tm, '/');
            //update this key for this user
            $cache = $this->get('jobs_service.cache')->load('users');
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
        $redirectUrl = $this->session->get('_redirectURL');
        $arr = array('success' => $result, 'message' => $msg, 'accessToken' => !empty($key) ? $key : '', 'code' => $code, 'redirectUrl' => $redirectUrl);
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
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('JobsServiceBundle:Users');
            $userData = $repository->findOneByEmail($email);
            if (empty($userData)) {
                throw new \Exception(ErrorCode::getError(self::CODE_INVALID_USER), self::CODE_INVALID_USER);
            }
            $passwd = $userData->getPassword();
            $firstname = $userData->getFirstname();
            $lastname = $userData->getLastname();
            $newPassword = substr(md5(rand(1, 1000)), 3, 7);
            $userData->setTempPassword($newPassword);
            $modified = tstobts(time());
            $userData->setModified($modified);
            $em->flush();
            $site_name = $this->container->getParameter('site_name');
            $host_url = $this->container->getParameter('host_url');
            $site_name_url = $this->container->getParameter('site_name_url');
            $params = array('name' => $firstname.' '.$lastname, 'to' => $email, 'from' => $this->container->getParameter('from_email'), 'subject' => 'Your '.$site_name.' account password has been reset', 'password' => $newPassword, 'site_name' => $site_name, 'host_url' => $host_url, 'site_name_url' => $site_name_url);
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

    public function resetAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $this->init($request);
            $password = $request->request->get('password');
            $confirm = $request->request->get('confirm');
            $password = trim($password);
            $confirm = trim($confirm);
            if (empty($password)) {
                throw new \Exception(ErrorCode::getError(self::CODE_PASSWORD_INVALID), self::CODE_PASSWORD_INVALID);
            }
            if ($password != $confirm) {
                throw new \Exception(ErrorCode::getError(self::CODE_CONFIRM_INVALID), self::CODE_CONFIRM_INVALID);
            }
            $repository = $this->getDoctrine()->getRepository('JobsServiceBundle:Users');
            $userData = $repository->find($this->userId);
            if (empty($userData)) {
                throw new \Exception(ErrorCode::getError(self::CODE_INVALID_USER), self::CODE_INVALID_USER);
            }
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('JobsServiceBundle:Users');
            $userData->setTempPassword($password);
            $userData->setPassword($password);
            $modified = tstobts(time());
            $userData->setModified($modified);
            $em->flush();
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
    
    
    ///api/user/logout
    public function logoutAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $tm = time() - 300;
            $userId = isset($_COOKIE['userId']) ? $_COOKIE['userId'] : '';
            $key = md5($userId);
            setcookie('userId', '', $tm, '/');
            setcookie('email', '', $tm, '/');
            setcookie('accessToken', '', $tm, '/');
            setcookie('userType', '', $tm, '/');
            unset($_COOKIE['userId']);
            unset($_COOKIE['email']);
            unset($_COOKIE['accessToken']);
            unset($_COOKIE['userType']);
            //update this key for this user
            $cache = $this->get('jobs_service.cache')->load('users');
            $cache->removeItem($key);
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
    
    /*
     * get user details
     * http://jobs.mkgalaxy.com/app_dev.php/api/user/details
     */
    public function detailsAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $this->init($request);
            $repository = $this->getDoctrine()->getRepository('JobsServiceBundle:Users');
            $userData = $repository->find($this->userId);
            if (empty($userData)) {
                throw new \Exception(ErrorCode::getError(self::CODE_INVALID_USER), self::CODE_INVALID_USER);
            }
            $data = array();
            $data['userId'] = $userData->getUserId();
            $data['email'] = $userData->getEmail();
            $data['accessLevel'] = $userData->getAccessLevel();
            $data['firstname'] = $userData->getFirstname();
            $data['lastname'] = $userData->getLastname();
            $data['userType'] = $userData->getUserType();
            $data['phone'] = $userData->getPhone();
            $data['address'] = $userData->getAddress();
            $data['address2'] = $userData->getAddress2();
            $data['country'] = $userData->getCountry();
            $data['city'] = $userData->getCity();
            $data['state'] = $userData->getState();
            $data['zip'] = $userData->getZip();
            $msg = 'Success';
            $result = 1;
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $result = 0;
            $code = $e->getCode();
        }
        $arr = array('success' => $result, 'message' => $msg, 'code' => $code, 'data' => $data);
        $json = json_encode($arr);
        return new Response($json);
    }
}
