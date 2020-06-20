<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MProduct $mProduct
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List M Product'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="mProduct form large-9 medium-8 columns content">
    <?= $this->Form->create($mProduct) ?>
    <fieldset>
        <legend><?= __('Add M Product') ?></legend>
        <?php
            echo $this->Form->control('koudo');
            echo $this->Form->control('mei');
            echo $this->Form->control('mei_sakuin');
            echo $this->Form->control('tani');
            echo $this->Form->control('setto_hinkubun');
            echo $this->Form->control('setto_hinkubun_mei');
            echo $this->Form->control('jidou_furikae_shori_taishou_kubun');
            echo $this->Form->control('jidou_furikae_shori_taishou_kubun_mei');
            echo $this->Form->control('zaiko_kanri_kubun');
            echo $this->Form->control('zaiko_kanri_kubun_mei');
            echo $this->Form->control('shu_shiiresaki_koudo');
            echo $this->Form->control('shu_shiiresaki_mei');
            echo $this->Form->control('hyoujun_uriage_tanka');
            echo $this->Form->control('ranku_1_uriage_tanka');
            echo $this->Form->control('ranku_2_uriage_tanka');
            echo $this->Form->control('ranku_3_uriage_tanka');
            echo $this->Form->control('ranku_4_uriage_tanka');
            echo $this->Form->control('ranku_5_uriage_tanka');
            echo $this->Form->control('hyoujun_shiire_tanka');
            echo $this->Form->control('zaiko_hyouka_tanka');
            echo $this->Form->control('arari_sanshutsu_you_tanka');
            echo $this->Form->control('joudai_tanka');
            echo $this->Form->control('shin_tanka_jisshibi');
            echo $this->Form->control('henkou_go_tanka_shiyou_kubun');
            echo $this->Form->control('kikan_tanka_taishou_hidzuke');
            echo $this->Form->control('shin_hyoujun_uriage_tanka');
            echo $this->Form->control('shin_ranku_1_uriage_tanka');
            echo $this->Form->control('shin_ranku_2_uriage_tanka');
            echo $this->Form->control('shin_ranku_3_uriage_tanka');
            echo $this->Form->control('shin_ranku_4_uriage_tanka');
            echo $this->Form->control('shin_ranku_5_uriage_tanka');
            echo $this->Form->control('shin_hyoujun_shiiretanka');
            echo $this->Form->control('shin_zaiko_hyouka_tanka');
            echo $this->Form->control('shin_arari_san_shutsuyou_tanka');
            echo $this->Form->control('shin_joudai_tanka');
            echo $this->Form->control('bunrui_koudo');
            echo $this->Form->control('kategori_id');
            echo $this->Form->control('shouhin_bunrui_2_koudo');
            echo $this->Form->control('shouhin_bunrui_2_mei');
            echo $this->Form->control('shouhin_bunrui_3_koudo');
            echo $this->Form->control('shouhin_bunrui_3_mei');
            echo $this->Form->control('shouhin_bunrui_4_koudo');
            echo $this->Form->control('shouhin_bunrui_4_mei');
            echo $this->Form->control('shouhin_bunrui_5_koudo');
            echo $this->Form->control('shouhin_bunrui_5_mei');
            echo $this->Form->control('shouhin_bunrui_6_koudo');
            echo $this->Form->control('shouhin_bunrui_6_mei');
            echo $this->Form->control('shouhin_bunrui_7_koudo');
            echo $this->Form->control('shouhin_bunrui_7_mei');
            echo $this->Form->control('shouhin_bunrui_8_koudo');
            echo $this->Form->control('shouhin_bunrui_8_mei');
            echo $this->Form->control('shouhin_bunrui_9_koudo');
            echo $this->Form->control('shouhin_bunrui_9_mei');
            echo $this->Form->control('hikazei_kubun');
            echo $this->Form->control('hikazei_kubun_mei');
            echo $this->Form->control('uriage_tanka_settei_kubun');
            echo $this->Form->control('uriage_tanka_settei_kubun_mei');
            echo $this->Form->control('shiiretanka_settei_kubun');
            echo $this->Form->control('shiiretanka_settei_kubun_mei');
            echo $this->Form->control('shouhi_zeiritsu_kubun');
            echo $this->Form->control('kyu_zeiritsu');
            echo $this->Form->control('shin_zeiritsu');
            echo $this->Form->control('zeiritsu_jisshi_nengappi');
            echo $this->Form->control('ekisei_zaiko_suuryou');
            echo $this->Form->control('kishu_zan_suuryou');
            echo $this->Form->control('kishu_zan_kingaku');
            echo $this->Form->control('masuta_kensaku_hyouji_kubun');
            echo $this->Form->control('masuta_kensaku_hyouji_kubun_mei');
            echo $this->Form->control('nyuryoku_patan_uriage_no');
            echo $this->Form->control('nyuryoku_patan_uriage_mei');
            echo $this->Form->control('nyuryoku_patan_shiire_no');
            echo $this->Form->control('nyuryoku_patan_shiire_mei');
            echo $this->Form->control('naiyou');
            echo $this->Form->control('keika_sochi_shiteibi', ['empty' => true]);
            echo $this->Form->control('deleted', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
