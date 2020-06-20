<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderAttachedFile Entity
 *
 * @property int $id
 * @property int $project_id
 * @property int $order_id
 * @property int $supplier_id
 * @property string $name
 * @property string $view_name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Order $order
 */
class OrderAttachedFile extends Entity
{

    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
