<?php

namespace Xmailer\Config;

use ezcMailAddress;

class Mailinglist
{
    public ezcMailAddress $address;
    public String $mailbox;
    public Int $grpid;
    private array $members;
    public function __construct($config)
    {
        $this->address = new ezcMailAddress($config['email'], $config['name']);
        $this->mailbox = $config['mailbox'];
        $this->grpid = $config['grpId'];

        // TODO: Reading Members from Database with grpId
        $this->members = [
            new ezcMailAddress("rolandgreim60@googlemail.com", "Roland Greim")
        ];
    }
    public function getMemberEmailAdresses(): array
    {
        return $this->members;
    }
    public function isEmailAdressOfThisList(ezcMailAddress $email): Bool
    {
        return $email->email == $this->email;
    }
    public function isMemberOfList(ezcMailAddress $email): Bool
    {
        foreach ($this->members as $user) {
            if ($user->email == $email->email) {
                return true;
            }
        }
        return false;
    }
    public function jsonSerialize()
    {
        return [
            'name' => $this->address->name,
            'email' => $this->address->email,
            'mailbox' => $this->mailbox,
            'grpId' => $this->grpid
        ];
    }
}