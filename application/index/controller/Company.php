<?php
namespace app\index\controller;

use think\Controller;

class Company extends Common
{
    public function company_introduction()
    {
        return $this->fetch('company_introduction');
    }

    public function company_forum()
    {
    	return $this->fetch('company_forum');
    }
}
