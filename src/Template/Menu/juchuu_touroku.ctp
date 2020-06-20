<?php use Cake\Routing\Router; ?>

<div class="page operation_selection" id="selection">
    <?= $this->element('_back', ['url' => Router::url(['controller' => 'Menu', 'action' => 'main'])]); ?>
    <div class="content">
        <h1 class="title">登録作業選択</h1>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="row col-lg-8">
                <div class="col-lg-5"><h5>新規登録</h5></div>
                <div class="col-lg-2"></div>
                <div class="col-lg-5"><h5>既存データ編集</h5></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="row col-lg-8">
                <div class="col-lg-5 select_box">
                    <a href="<?= Router::url(['controller' => 'Project', 'action' => 'yoteiTouroku']); ?>" class="abt">予定注文登録</a>
                    <a href="<?= Router::url(['controller' => 'Project', 'action' => 'kakuteiTouroku']); ?>" class="abt">確定注文登録</a>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-5 select_box">
                    <a href="<?= Router::url(['controller' => 'Project', 'action' => 'yoteiIchiran']); ?>" class="abt">予定データ一覧</a>
                    <a href="<?= Router::url(['controller' => 'Project', 'action' => 'juchuuSumiIchiran']); ?>" class="abt">受注済データ一覧</a>
                </div>
            </div>
        </div>

        <?= $this->element('../Menu/_project_list', [
            'titleTable' => '登録未完了一時保存リスト',
            'url' => Router::url(['controller'=> 'Menu', 'action'=> 'juchuuTouroku'])
        ]); ?>
    </div>
</div>
