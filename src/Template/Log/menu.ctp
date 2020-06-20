<?php
use Cake\Routing\Router;
$menu = [
            ['url' => Router::url(['controller' => 'Log', 'action' => 'index']), 'title' => 'ログイン履歴'],
            ['url' => Router::url(['controller' => 'Log', 'action' => 'logProjectList']), 'title' => '案件操作履歴'],
        ]
?>
<h4>案件検索</h4>
<div class="col-sm-9 pull-left">
    <?php
        foreach ($menu as $index => $btn) { ?>
            <div class="col-xs-3 mt-1">
                <a href="<?= $position === $index ? '#' : $btn['url'] ;?>" <?= $position === $index ? 'class="btn btn-dark" ' : 'class="btn btn-outline-dark"' ?> >
                    <?= $btn['title'] ;?>
                </a>
            </div>
    <?php
        }
    ?>
</div>
<div class="clearfix"></div>
