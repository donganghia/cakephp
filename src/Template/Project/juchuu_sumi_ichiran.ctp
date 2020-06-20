<?php use App\Model\Table\ProjectTable; ?>
<?= $this->element('../Project/_list', ['title' => '受注済データ一覧', 'type' => ProjectTable::KAKUTEI_TYPE]); ?>
