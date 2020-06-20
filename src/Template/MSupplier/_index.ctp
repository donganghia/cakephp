<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MSupplier[]|\Cake\Collection\CollectionInterface $mSupplier
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New M Supplier'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List M User'), ['controller' => 'MUser', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New M User'), ['controller' => 'MUser', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mSupplier index large-9 medium-8 columns content">
    <h3><?= __('M Supplier') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('koudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mei_1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mei_2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ryakushou') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sakuin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('yuubenbangou') ?></th>
                <th scope="col"><?= $this->Paginator->sort('juusho_1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('juusho_2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('juusho_3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('kasutama_bakoudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('denwa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fax') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_system_shiiresaki_kategori_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shiharai_saki_kubun') ?></th>
                <th scope="col"><?= $this->Paginator->sort('m_system_tantousha_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('aitesaki_tantousha_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bikou') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mSupplier as $mSupplier): ?>
            <tr>
                <td><?= $this->Number->format($mSupplier->id) ?></td>
                <td><?= h($mSupplier->koudo) ?></td>
                <td><?= h($mSupplier->mei_1) ?></td>
                <td><?= h($mSupplier->mei_2) ?></td>
                <td><?= h($mSupplier->ryakushou) ?></td>
                <td><?= h($mSupplier->sakuin) ?></td>
                <td><?= h($mSupplier->yuubenbangou) ?></td>
                <td><?= h($mSupplier->juusho_1) ?></td>
                <td><?= h($mSupplier->juusho_2) ?></td>
                <td><?= h($mSupplier->juusho_3) ?></td>
                <td><?= h($mSupplier->kasutama_bakoudo) ?></td>
                <td><?= h($mSupplier->denwa) ?></td>
                <td><?= h($mSupplier->fax) ?></td>
                <td><?= $this->Number->format($mSupplier->m_system_shiiresaki_kategori_id) ?></td>
                <td><?= $this->Number->format($mSupplier->shiharai_saki_kubun) ?></td>
                <td><?= $this->Number->format($mSupplier->m_system_tantousha_id) ?></td>
                <td><?= h($mSupplier->aitesaki_tantousha_mei) ?></td>
                <td><?= h($mSupplier->bikou) ?></td>
                <td><?= h($mSupplier->created) ?></td>
                <td><?= h($mSupplier->modified) ?></td>
                <td><?= h($mSupplier->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mSupplier->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mSupplier->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mSupplier->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mSupplier->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
