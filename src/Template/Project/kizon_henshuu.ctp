<?php use App\Model\Table\ProjectTable; ?>
<?= $this->element('../Project/_form', ['title' => $project->type === ProjectTable::YOTEI_TYPE
    ? '予定注文編集' : '確定注文編集', 'type' => $project->type]); ?>
