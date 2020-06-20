<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class BaseTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'modified' => 'always',
                ],
                'Orders.completed' => [
                    'modified' => 'always'
                ]
            ]
        ]);
    }
}
