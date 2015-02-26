<?php

class Users extends CI_Model {

    protected $sTable = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function CheckUser(array $aUserData)
    {
        $where = array(
            'login_name' => $aUserData['LoginName'],
            'password' => $aUserData['Password'],
            'active' => '1',
        );

        $this->db->where($where);

        $iUsers = $this->db->get($this->sTable)->num_rows();

        if($iUsers > 0){
            return $this->db->get($this->sTable)->row();
        }

        return false;
    }

    public function getUser($iId)
    {
        $iId = (int)$iId;

        $this->db->where('id', $iId);

        return $this->db->get($this->sTable)->row();
    }

    public function CheckLoginNameAvailability($sLoginName)
    {
        $bLoginNameFree = $this->db->where('login_name', $sLoginName);

        return $bLoginNameFree;
    }

    public function RegisterUser(array $aUserData)
    {
        $bLoginNameFree = $this->CheckLoginNameAvailability($aUserData['login_name']);

        if($bLoginNameFree){
            return $this->db->insert($this->sTable,$aUserData);
        }
        return false;
    }
}