<?php use App\Model\Table\ProjectTable; ?>
<?= $this->element('../Project/_list', ['title' => '予定データ一覧','type' => ProjectTable::YOTEI_TYPE]); ?>