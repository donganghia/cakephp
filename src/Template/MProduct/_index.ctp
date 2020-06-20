<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MProduct[]|\Cake\Collection\CollectionInterface $mProduct
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New M Product'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="mProduct index large-9 medium-8 columns content">
    <h3><?= __('M Product') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('koudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mei_sakuin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tani') ?></th>
                <th scope="col"><?= $this->Paginator->sort('setto_hinkubun') ?></th>
                <th scope="col"><?= $this->Paginator->sort('setto_hinkubun_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jidou_furikae_shori_taishou_kubun') ?></th>
                <th scope="col"><?= $this->Paginator->sort('jidou_furikae_shori_taishou_kubun_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zaiko_kanri_kubun') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zaiko_kanri_kubun_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shu_shiiresaki_koudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shu_shiiresaki_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hyoujun_uriage_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ranku_1_uriage_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ranku_2_uriage_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ranku_3_uriage_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ranku_4_uriage_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ranku_5_uriage_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hyoujun_shiire_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zaiko_hyouka_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('arari_sanshutsu_you_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('joudai_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shin_tanka_jisshibi') ?></th>
                <th scope="col"><?= $this->Paginator->sort('henkou_go_tanka_shiyou_kubun') ?></th>
                <th scope="col"><?= $this->Paginator->sort('kikan_tanka_taishou_hidzuke') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shin_hyoujun_uriage_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shin_ranku_1_uriage_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shin_ranku_2_uriage_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shin_ranku_3_uriage_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shin_ranku_4_uriage_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shin_ranku_5_uriage_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shin_hyoujun_shiiretanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shin_zaiko_hyouka_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shin_arari_san_shutsuyou_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shin_joudai_tanka') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bunrui_koudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('kategori_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_2_koudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_2_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_3_koudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_3_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_4_koudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_4_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_5_koudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_5_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_6_koudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_6_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_7_koudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_7_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_8_koudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_8_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_9_koudo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhin_bunrui_9_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hikazei_kubun') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hikazei_kubun_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uriage_tanka_settei_kubun') ?></th>
                <th scope="col"><?= $this->Paginator->sort('uriage_tanka_settei_kubun_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shiiretanka_settei_kubun') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shiiretanka_settei_kubun_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shouhi_zeiritsu_kubun') ?></th>
                <th scope="col"><?= $this->Paginator->sort('kyu_zeiritsu') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shin_zeiritsu') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zeiritsu_jisshi_nengappi') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ekisei_zaiko_suuryou') ?></th>
                <th scope="col"><?= $this->Paginator->sort('kishu_zan_suuryou') ?></th>
                <th scope="col"><?= $this->Paginator->sort('kishu_zan_kingaku') ?></th>
                <th scope="col"><?= $this->Paginator->sort('masuta_kensaku_hyouji_kubun') ?></th>
                <th scope="col"><?= $this->Paginator->sort('masuta_kensaku_hyouji_kubun_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nyuryoku_patan_uriage_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nyuryoku_patan_uriage_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nyuryoku_patan_shiire_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('nyuryoku_patan_shiire_mei') ?></th>
                <th scope="col"><?= $this->Paginator->sort('naiyou') ?></th>
                <th scope="col"><?= $this->Paginator->sort('keika_sochi_shiteibi') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mProduct as $mProduct): ?>
            <tr>
                <td><?= $this->Number->format($mProduct->id) ?></td>
                <td><?= h($mProduct->koudo) ?></td>
                <td><?= h($mProduct->mei) ?></td>
                <td><?= h($mProduct->mei_sakuin) ?></td>
                <td><?= h($mProduct->tani) ?></td>
                <td><?= $this->Number->format($mProduct->setto_hinkubun) ?></td>
                <td><?= h($mProduct->setto_hinkubun_mei) ?></td>
                <td><?= $this->Number->format($mProduct->jidou_furikae_shori_taishou_kubun) ?></td>
                <td><?= h($mProduct->jidou_furikae_shori_taishou_kubun_mei) ?></td>
                <td><?= $this->Number->format($mProduct->zaiko_kanri_kubun) ?></td>
                <td><?= h($mProduct->zaiko_kanri_kubun_mei) ?></td>
                <td><?= h($mProduct->shu_shiiresaki_koudo) ?></td>
                <td><?= h($mProduct->shu_shiiresaki_mei) ?></td>
                <td><?= $this->Number->format($mProduct->hyoujun_uriage_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->ranku_1_uriage_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->ranku_2_uriage_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->ranku_3_uriage_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->ranku_4_uriage_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->ranku_5_uriage_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->hyoujun_shiire_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->zaiko_hyouka_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->arari_sanshutsu_you_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->joudai_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->shin_tanka_jisshibi) ?></td>
                <td><?= $this->Number->format($mProduct->henkou_go_tanka_shiyou_kubun) ?></td>
                <td><?= $this->Number->format($mProduct->kikan_tanka_taishou_hidzuke) ?></td>
                <td><?= $this->Number->format($mProduct->shin_hyoujun_uriage_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->shin_ranku_1_uriage_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->shin_ranku_2_uriage_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->shin_ranku_3_uriage_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->shin_ranku_4_uriage_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->shin_ranku_5_uriage_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->shin_hyoujun_shiiretanka) ?></td>
                <td><?= $this->Number->format($mProduct->shin_zaiko_hyouka_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->shin_arari_san_shutsuyou_tanka) ?></td>
                <td><?= $this->Number->format($mProduct->shin_joudai_tanka) ?></td>
                <td><?= h($mProduct->bunrui_koudo) ?></td>
                <td><?= h($mProduct->kategori_id) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_2_koudo) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_2_mei) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_3_koudo) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_3_mei) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_4_koudo) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_4_mei) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_5_koudo) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_5_mei) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_6_koudo) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_6_mei) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_7_koudo) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_7_mei) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_8_koudo) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_8_mei) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_9_koudo) ?></td>
                <td><?= h($mProduct->shouhin_bunrui_9_mei) ?></td>
                <td><?= $this->Number->format($mProduct->hikazei_kubun) ?></td>
                <td><?= h($mProduct->hikazei_kubun_mei) ?></td>
                <td><?= $this->Number->format($mProduct->uriage_tanka_settei_kubun) ?></td>
                <td><?= h($mProduct->uriage_tanka_settei_kubun_mei) ?></td>
                <td><?= $this->Number->format($mProduct->shiiretanka_settei_kubun) ?></td>
                <td><?= h($mProduct->shiiretanka_settei_kubun_mei) ?></td>
                <td><?= $this->Number->format($mProduct->shouhi_zeiritsu_kubun) ?></td>
                <td><?= $this->Number->format($mProduct->kyu_zeiritsu) ?></td>
                <td><?= $this->Number->format($mProduct->shin_zeiritsu) ?></td>
                <td><?= $this->Number->format($mProduct->zeiritsu_jisshi_nengappi) ?></td>
                <td><?= $this->Number->format($mProduct->ekisei_zaiko_suuryou) ?></td>
                <td><?= $this->Number->format($mProduct->kishu_zan_suuryou) ?></td>
                <td><?= $this->Number->format($mProduct->kishu_zan_kingaku) ?></td>
                <td><?= $this->Number->format($mProduct->masuta_kensaku_hyouji_kubun) ?></td>
                <td><?= h($mProduct->masuta_kensaku_hyouji_kubun_mei) ?></td>
                <td><?= $this->Number->format($mProduct->nyuryoku_patan_uriage_no) ?></td>
                <td><?= $this->Number->format($mProduct->nyuryoku_patan_uriage_mei) ?></td>
                <td><?= $this->Number->format($mProduct->nyuryoku_patan_shiire_no) ?></td>
                <td><?= $this->Number->format($mProduct->nyuryoku_patan_shiire_mei) ?></td>
                <td><?= h($mProduct->naiyou) ?></td>
                <td><?= h($mProduct->keika_sochi_shiteibi) ?></td>
                <td><?= h($mProduct->created) ?></td>
                <td><?= h($mProduct->modified) ?></td>
                <td><?= h($mProduct->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $mProduct->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mProduct->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mProduct->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mProduct->id)]) ?>
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
