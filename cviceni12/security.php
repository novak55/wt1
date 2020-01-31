<?php;

class security
{
    private $role;
    public function __construct()
    {
        $this->role = 'admin';
    }
    
    public function getRole()
    {
        return $this->role;
    }
}