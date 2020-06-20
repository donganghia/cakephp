<?php use App\Model\Table\ProjectTable;

$aryParam = [
    'title' => '確定注文登録',
    'type' => ProjectTable::KAKUTEI_TYPE,
    'oldProjectId' => $project->id,
    'oldOrderId' => $order->id
];

//clear parent data
unset($project->id, $project->type, $order->id, $order->created, $order->m_system_joutaikubun_id);

echo $this->element('../Project/_form', $aryParam);
?>
