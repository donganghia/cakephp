<?php
/* Copyright (c) ASC All Rights Reserved.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ［変更履歴］
 * 2018.11.28 Hieunld：新規作成
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace App\View;

use App\Libs\Constant;
use Cake\View\View;

class AppView extends View
{

    public function initialize()
    {
        $this->loadHelper('Html', [
            'className' => 'VHtml'
        ]);
        $this->Html->setTemplates([
            'javascriptlink' => '<script src="{{url}}?v='.time().'"{{attrs}}></script>',
            'css' => '<link rel="{{rel}}" href="{{url}}?v='.time().'"{{attrs}}/>'
        ]);
    }
}
