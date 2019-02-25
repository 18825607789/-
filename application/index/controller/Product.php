<?php
namespace app\index\controller;

use think\Controller;

class Product extends Common
{
    public function product_center()
    {
        return $this->fetch('product_center');
    }

    public function product_details()
    {
        return $this->fetch('product_details');
    }
}
