<?php
    unset($order->bangou, $order->id, $order->created);
    echo $this->element('../Project/_form', ['title' => '新規伝票発行', 'type' => $project->type]);
?>