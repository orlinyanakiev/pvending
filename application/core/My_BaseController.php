<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_BaseController extends CI_Controller
{
    public $aData;

    function __construct()
    {
        parent::__construct();

        $this->aData;

        $this->load->helper('url');
        $this->load->model('users');

        $this->CheckIfUserIsLogged();
    }

    protected function CheckIfUserIsLogged($redirect = false)
    {
        $this->aData['oUser'] = new stdClass();
        $this->aData['oUser']->id = 0;

        if ($this->session->userdata('iUserId')) {

            $iUserId = $this->session->userdata('iUserId');

            if (isset($iUserId)) {
                $this->aData['oUser'] = $this->users->getUser($iUserId);
            }

        } elseif ($redirect) {
            redirect(base_url());
        }

    }
}
