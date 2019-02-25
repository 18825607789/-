<?php
namespace app\index\controller;

use think\Controller;

class News extends Common
{
    public function news_detail()
    {
        return $this->fetch('news_detail');
    }

    public function news_list()
    {
        return $this->fetch('news_list');
    }

    public function profession_dynamic_detail()
    {
        return $this->fetch('profession_dynamic_detail');
    }

}
