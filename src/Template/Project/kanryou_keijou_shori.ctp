<?php use App\Model\Table\ProjectTable; ?>
<?= $this->element('../Project/_form_kakunin_shori', ['title' => '完了計上処理', 'type' => ProjectTable::KAKUTEI_TYPE,
    'titleButton' => '登録']); ?>
