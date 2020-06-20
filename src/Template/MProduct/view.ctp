<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MProduct $mProduct
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit M Product'), ['action' => 'edit', $mProduct->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete M Product'), ['action' => 'delete', $mProduct->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mProduct->id)]) ?> </li>
        <li><?= $this->Html->link(__('List M Product'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New M Product'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mProduct view large-9 medium-8 columns content">
    <h3><?= h($mProduct->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Koudo') ?></th>
            <td><?= h($mProduct->koudo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mei') ?></th>
            <td><?= h($mProduct->mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mei Sakuin') ?></th>
            <td><?= h($mProduct->mei_sakuin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Setto Hinkubun Mei') ?></th>
            <td><?= h($mProduct->setto_hinkubun_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jidou Furikae Shori Taishou Kubun Mei') ?></th>
            <td><?= h($mProduct->jidou_furikae_shori_taishou_kubun_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zaiko Kanri Kubun Mei') ?></th>
            <td><?= h($mProduct->zaiko_kanri_kubun_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shu Shiiresaki Koudo') ?></th>
            <td><?= h($mProduct->shu_shiiresaki_koudo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shu Shiiresaki Mei') ?></th>
            <td><?= h($mProduct->shu_shiiresaki_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 2 Koudo') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_2_koudo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 2 Mei') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_2_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 3 Koudo') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_3_koudo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 3 Mei') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_3_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 4 Koudo') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_4_koudo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 4 Mei') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_4_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 5 Koudo') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_5_koudo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 5 Mei') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_5_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 6 Koudo') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_6_koudo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 6 Mei') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_6_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 7 Koudo') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_7_koudo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 7 Mei') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_7_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 8 Koudo') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_8_koudo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 8 Mei') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_8_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 9 Koudo') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_9_koudo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhin Bunrui 9 Mei') ?></th>
            <td><?= h($mProduct->shouhin_bunrui_9_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uriage Tanka Settei Kubun Mei') ?></th>
            <td><?= h($mProduct->uriage_tanka_settei_kubun_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shiiretanka Settei Kubun Mei') ?></th>
            <td><?= h($mProduct->shiiretanka_settei_kubun_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Masuta Kensaku Hyouji Kubun Mei') ?></th>
            <td><?= h($mProduct->masuta_kensaku_hyouji_kubun_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Naiyou') ?></th>
            <td><?= h($mProduct->naiyou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mProduct->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Setto Hinkubun') ?></th>
            <td><?= $this->Number->format($mProduct->setto_hinkubun) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Jidou Furikae Shori Taishou Kubun') ?></th>
            <td><?= $this->Number->format($mProduct->jidou_furikae_shori_taishou_kubun) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zaiko Kanri Kubun') ?></th>
            <td><?= $this->Number->format($mProduct->zaiko_kanri_kubun) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hyoujun Uriage Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->hyoujun_uriage_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ranku 1 Uriage Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->ranku_1_uriage_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ranku 2 Uriage Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->ranku_2_uriage_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ranku 3 Uriage Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->ranku_3_uriage_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ranku 4 Uriage Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->ranku_4_uriage_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ranku 5 Uriage Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->ranku_5_uriage_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hyoujun Shiire Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->hyoujun_shiire_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zaiko Hyouka Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->zaiko_hyouka_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Arari Sanshutsu You Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->arari_sanshutsu_you_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Joudai Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->joudai_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shin Tanka Jisshibi') ?></th>
            <td><?= $this->Number->format($mProduct->shin_tanka_jisshibi) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Henkou Go Tanka Shiyou Kubun') ?></th>
            <td><?= $this->Number->format($mProduct->henkou_go_tanka_shiyou_kubun) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kikan Tanka Taishou Hidzuke') ?></th>
            <td><?= $this->Number->format($mProduct->kikan_tanka_taishou_hidzuke) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shin Hyoujun Uriage Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->shin_hyoujun_uriage_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shin Ranku 1 Uriage Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->shin_ranku_1_uriage_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shin Ranku 2 Uriage Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->shin_ranku_2_uriage_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shin Ranku 3 Uriage Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->shin_ranku_3_uriage_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shin Ranku 4 Uriage Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->shin_ranku_4_uriage_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shin Ranku 5 Uriage Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->shin_ranku_5_uriage_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shin Hyoujun Shiiretanka') ?></th>
            <td><?= $this->Number->format($mProduct->shin_hyoujun_shiiretanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shin Zaiko Hyouka Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->shin_zaiko_hyouka_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shin Arari San Shutsuyou Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->shin_arari_san_shutsuyou_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shin Joudai Tanka') ?></th>
            <td><?= $this->Number->format($mProduct->shin_joudai_tanka) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hikazei Kubun') ?></th>
            <td><?= $this->Number->format($mProduct->hikazei_kubun) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uriage Tanka Settei Kubun') ?></th>
            <td><?= $this->Number->format($mProduct->uriage_tanka_settei_kubun) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shiiretanka Settei Kubun') ?></th>
            <td><?= $this->Number->format($mProduct->shiiretanka_settei_kubun) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shouhi Zeiritsu Kubun') ?></th>
            <td><?= $this->Number->format($mProduct->shouhi_zeiritsu_kubun) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kyu Zeiritsu') ?></th>
            <td><?= $this->Number->format($mProduct->kyu_zeiritsu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shin Zeiritsu') ?></th>
            <td><?= $this->Number->format($mProduct->shin_zeiritsu) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zeiritsu Jisshi Nengappi') ?></th>
            <td><?= $this->Number->format($mProduct->zeiritsu_jisshi_nengappi) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ekisei Zaiko Suuryou') ?></th>
            <td><?= $this->Number->format($mProduct->ekisei_zaiko_suuryou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kishu Zan Suuryou') ?></th>
            <td><?= $this->Number->format($mProduct->kishu_zan_suuryou) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kishu Zan Kingaku') ?></th>
            <td><?= $this->Number->format($mProduct->kishu_zan_kingaku) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Masuta Kensaku Hyouji Kubun') ?></th>
            <td><?= $this->Number->format($mProduct->masuta_kensaku_hyouji_kubun) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nyuryoku Patan Uriage No') ?></th>
            <td><?= $this->Number->format($mProduct->nyuryoku_patan_uriage_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nyuryoku Patan Uriage Mei') ?></th>
            <td><?= $this->Number->format($mProduct->nyuryoku_patan_uriage_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nyuryoku Patan Shiire No') ?></th>
            <td><?= $this->Number->format($mProduct->nyuryoku_patan_shiire_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nyuryoku Patan Shiire Mei') ?></th>
            <td><?= $this->Number->format($mProduct->nyuryoku_patan_shiire_mei) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Keika Sochi Shiteibi') ?></th>
            <td><?= h($mProduct->keika_sochi_shiteibi) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($mProduct->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($mProduct->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($mProduct->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tani') ?></th>
            <td><?= $mProduct->tani ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bunrui Koudo') ?></th>
            <td><?= $mProduct->bunrui_koudo ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kategori Id') ?></th>
            <td><?= $mProduct->kategori_id ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hikazei Kubun Mei') ?></th>
            <td><?= $mProduct->hikazei_kubun_mei ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
