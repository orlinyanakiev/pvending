<?php
/**
 * Created by PhpStorm.
 * User: oyanakiev
 * Date: 2/21/15
 * Time: 10:21
 */
require_once(APPPATH . 'core/My_BaseController.php');

class StartPage extends My_BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this->IsLogged();
    }

    public function IsLogged()
    {
        if(is_object($this->aData['oUser']) && $this->aData['oUser']->id > 0 ){
            redirect(base_url() . 'memberpage/');
        }
    }

    public function index()
    {

        $this->login();
    }

    public function Login()
    {
        $this->aData['sTitle'] = 'Login';

        if($this->input->post()){
            $this->load->library('form_validation');

            $this->form_validation->set_rules('LoginName','Login Name','trim|required|xss_clean');
            $this->form_validation->set_rules('Password','Password','trim|required|xss_clean');

            if($this->form_validation->run()){
                $aUserData = array(
                    'LoginName' => $this->input->post('LoginName',true),
                    'Password' => sha1($this->input->post('Password',true)),
                );

                $oUser = $this->users->CheckUser($aUserData);
                if(is_object($oUser) && isset($oUser->id)){
                    $this->session->set_userdata('iUserId',$oUser->id);
                    redirect(base_url().'memberpage/');
                }
                $this->session->set_flashdata('wrong_login', true);
            }
            $this->session->set_flashdata('wrong_login', true);
        }

        $this->load->view('public/include/header',$this->aData);
        $this->load->view('public/page/login',$this->aData);
        $this->load->view('public/include/footer',$this->aData);
    }

    public function Register()
    {
        $this->aData['sTitle'] = 'Register';

        if($this->input->post()){
            $this->load->library('form_validation');

            $this->form_validation->set_rules('FirstName','FirstName','trim|required|xss_clean');
            $this->form_validation->set_rules('LastName','lastName','trim|required|xss_clean');
            $this->form_validation->set_rules('LoginName','LoginName','trim|required|xss_clean');
            $this->form_validation->set_rules('Password','Password','trim|required|xss_clean');
            $this->form_validation->set_rules('Password2','Password2','trim|required|xss_clean|matches[Password]');

            if($this->form_validation->run()){
                $aUserData = array(
                    'first_name' => $this->input->post('FirstName',true),
                    'last_name' => $this->input->post('LastName',true),
                    'login_name' => $this->input->post('LoginName',true),
                    'password' => sha1($this->input->post('Password',true)),
                    'register_date' => date('Y-m-d H:i:s')
                );

                $bRegUser = $this->users->RegisterUser($aUserData);
                if($bRegUser == false){
                    $this->session->set_flashdata('wrong_register', true);
                }
                $this->session->set_flashdata('wrong_register', true);
            }
        }

        $this->load->view('public/include/header',$this->aData);
        $this->load->view('public/page/register',$this->aData);
        $this->load->view('public/include/footer',$this->aData);
    }
}