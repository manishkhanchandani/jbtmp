<?php

namespace Jobs\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class MainController extends Controller
{
    
    protected $userId;
    protected $email;
    protected $userType;
    protected $session;
    public function __construct()
    {
        $this->session = new Session();
        $this->session->start();
    }

    protected function init($request)
    {
        if (!isset($_COOKIE['userId']) || !isset($_COOKIE['email'])) {
            $token = $request->query->get('accessToken');
            if (empty($token)) {
                throw new \Exception('Unauthorised Access. Valid token is required', 404);
            }
            $cache = $this->get('jobs_service.cache')->load('users');
            $result = $cache->getItem($token, $success);
            if (!$success) {
                throw new \Exception('Unauthorised Access', 404);
            }
            $cache->touchItem($token);
            $this->userId = $result->getUserId();
            $this->email = $result->getEmail();
            $this->userType = $result->getUserType();
        } else if (isset($_COOKIE['userId']) && isset($_COOKIE['email'])) {
            $this->userId = $_COOKIE['userId'];
            $this->email = $_COOKIE['email'];
            $this->userType = $_COOKIE['userType'];
        } else {
            throw new \Exception('Unauthorised Accesscode', 404);
        }
    }

    protected function setCheckbox($value)
    {
        if (empty($value)) return 0;
        else if ($value === "true") return 1;
        else if ($value === "false") return 0;
        return 0;
    }
}
?>
