<?php
require_once ( APPPATH . 'core/My_BaseController.php');

class MemberPage extends MY_BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->CheckIfUserIsLogged(true);
    }

    public function index()
    {
        $aData['sTitle'] = 'Member\'s Page';

        $this->load->view('member/include/header',$aData);
        $this->load->view('member/page/home',$aData);
        $this->load->view('member/include/footer',$aData);
    }

    public function Logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}