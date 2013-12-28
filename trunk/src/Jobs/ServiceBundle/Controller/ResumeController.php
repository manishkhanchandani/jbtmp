<?php

namespace Jobs\ServiceBundle\Controller;

use Jobs\ServiceBundle\Controller\MainController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Jobs\ServiceBundle\Models\ErrorCode;

class ResumeController extends MainController
{
    
    public function postAction(Request $request)
    {
        $result = 0;
        $msg = '';
        $code = 200;
        try {
            $this->init($request);
            pr($_POST);
            pr($_FILES);
            exit;
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
}