<?php

use Cake\Routing\Router;
use App\Model\Table\MProductTable;
use App\Model\Table\MSystemTable;

?>
<script type="application/javascript">
    $(document).ready(function () {
        $('#m_supplier_product_id').click(function () {
            var row = $("#m_supplier_product_id option:selected").text();
            var result = row.split(' ');
            $("#m_supplier_product_id option:not(:contains('" + result[0] + " '))").prop("disabled", true);
        });
        $('#clr_m_supplier_product_id').click(function () {
            $("#m_supplier_product_id").val([]);
            $("select option:contains(' ')").prop("disabled", false);
        });

        var data = "<?= isset($mProduct->m_supplier_product_id) ? $mProduct->m_supplier_product_id : ''; ?>"
        var dataarray = data.split(",");
        $("#m_supplier_product_id").val(dataarray);

        $('#bunrui_koudo, #m_system_shouhin_kategori_id').change(function () {
            var bunrui_koudo = $("#bunrui_koudo").val();
            var m_system_shouhin_kategori_id = $("#m_system_shouhin_kategori_id").val();

            ajaxDataForm(
                {'bunrui_koudo': bunrui_koudo, 'm_system_shouhin_kategori_id': m_system_shouhin_kategori_id},
                '<?= Router::url(['controller' => 'MProduct', 'action' => 'getListSupplierProduct']) ?>',
                function (response) {
                    //CALLBACK m_supplier_product_id
                    var result = JSON.parse(response);
                    $('#m_supplier_product_id').find('option').remove().end();
                    $.each(result.data, function( index, val ) {
                        $('#m_supplier_product_id').append('<option value="'+index+'" >' + val + '</option>');
                    });
                },
                <?= json_encode($this->request->getParam('_csrfToken')) ?>
            );
        });
    });
</script>
<div class="page page_register product_master" id="product">
    <div class="navi">
        <h1 class="title"><?= $title; ?></h1>
        <div class="clearfix"></div>
    </div>
    <?= $this->element('_back', ['url' => Router::url(['controller' => 'MProduct', 'action' => 'index'])]); ?>
    <?= $this->Form->create($mProduct, ['type' => 'file']) ?>
    <div class="content">
        <div class="form-group row">
            <div class="col-sm-12">
                <?= $this->Flash->render() ?>
                <?= $this->Flash->render('success') ?>
                <?= $this->Flash->render('error') ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right" for="koudo">
                商品コード<span class="required">*</span>
            </label>
            <div class="col-sm-2">
                <?= $this->Form->text('koudo', [
                    'value' => isset($mProduct->id) ? $mProduct->koudo : null,
                    'class' => "input",
                    'class' => "form-control",
                    'placeholder' => 'A0000001'
                ]); ?>
            </div>
            <label for="edaban" class="col-sm-2 col-form-label text-right">枝番コード</label>
            <div class="col-sm-2">
                <?= $this->Form->text('edaban', [
                    'value' => isset($mProduct->edaban) ? $mProduct->edaban : null,
                    'class' => "form-control",
                    'placeholder' => '']); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">
                単位
            </label>
            <div class="col-sm-2">
                <?= $this->Form->select('tani', MProductTable::TANI_VALUE, [
                    'class' => 'form-control', 'default' => isset($mProduct->tani) ? $mProduct->tani : null
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">
                商品名
            </label>
            <div class="col-sm-6">
                <?= $this->Form->text('mei', [
                    'value' => isset($mProduct->id) ? $mProduct->mei : null,
                    'class' => "form-control",
                    'placeholder' => 'キッチン']); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">
                標準売上単価
            </label>
            <div class="col-sm-2">
                <?= $this->Form->text('hyoujun_uriage_tanka', [
                    'value' => isset($mProduct->id) ? $mProduct->hyoujun_uriage_tanka : false,
                    'class' => "form-control text-right",
                    'placeholder' => '20300']); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">
                商品名索引
            </label>
            <div class="col-sm-6">
                <?= $this->Form->text('mei_sakuin', [
                    'value' => isset($mProduct->id) ? $mProduct->mei_sakuin : null,
                    'class' => "form-control",
                    'placeholder' => 'ｷｯﾁﾝ']); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">
                非課税区分
            </label>
            <div class="col-sm-2">
                <?= $this->Form->select('hikazei_kubun', $this->VHtml->selectNull(MProductTable::HIKAZEI_KUBUN_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($mProduct->id) ? $mProduct->hikazei_kubun : null
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">セット区分</label>
            <div class="col-sm-2">
                <?= $this->Form->select('setto_hinkubun', $this->VHtml->selectNull(MProductTable::SETTO_KUBUN_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($mProduct->setto_hinkubun) ? $mProduct->setto_hinkubun : ''
                ]); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">分類名</label>
            <div class="col-sm-2">
                <?= $this->Form->select('bunrui_koudo', $this->VHtml->selectNull(MProductTable::BUNRUI_KOUDO_VALUE), [
                    'class' => 'form-control',
                    'id' => 'bunrui_koudo',
                    'default' => isset($mProduct->id) ? $mProduct->bunrui_koudo : ''
                ]); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">売上単価設定</label>
            <div class="col-sm-2">
                <?= $this->Form->select('uriage_tanka_settei_kubun', $this->VHtml->selectNull(MProductTable::URIAGE_TANKA_SETTEI_KUBUN_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($mProduct->id) ? $mProduct->uriage_tanka_settei_kubun : ''
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">自振区分</label>
            <div class="col-sm-2">
                <?= $this->Form->select('jidou_furikae_shori_taishou_kubun',
                    $this->VHtml->selectNull([0 => '対象外']), [
                    'class' => 'form-control',
                    'default' => isset($mProduct->jidou_furikae_shori_taishou_kubun) ? $mProduct->jidou_furikae_shori_taishou_kubun : ''
                ]); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">カテゴリー</label>
            <div class="col-sm-2">
                <?= $this->Form->select('m_system_shouhin_kategori_id',
                    isset($mstSystem[MSystemTable::SYSTEM_KATEGORI_ID]) ? $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_KATEGORI_ID]) : ['' => '-'],
                    [
                        'class' => 'form-control',
                        'id' => 'm_system_shouhin_kategori_id',
                        'default' => isset($mProduct->id) ? $mProduct->m_system_shouhin_kategori_id : ''
                    ]); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">仕入単価設定</label>
            <div class="col-sm-2">
                <?= $this->Form->select('shiiretanka_settei_kubun', $this->VHtml->selectNull(MProductTable::URIAGE_TANKA_SETTEI_KUBUN_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($mProduct->id) ? $mProduct->shiiretanka_settei_kubun : ''
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-right">在庫管理区分</label>
            <div class="col-sm-2">
                <?= $this->Form->select('zaiko_kanri_kubun', $this->VHtml->selectNull(MProductTable::ZAIKO_KANRI_KUBUN_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($mProduct->id) ? $mProduct->zaiko_kanri_kubun : ''
                ]); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">仕入先数</label>
            <div class="col-sm-2">
                <?= $this->Form->select('shiiresaki_kazu', $this->VHtml->selectNull(MProductTable::SHU_SHIIRESAKI_KOUDO_VALUE), [
                    'class' => 'form-control',
                    'default' => isset($mProduct->id) ? $mProduct->shiiresaki_kazu : ''
                ]); ?>
            </div>
            <label class="col-sm-2 col-form-label text-right">税率適用日</label>
            <div class="col-sm-2">
                <?= $this->Form->text('keika_sochi_shiteibi', [
                    'class' => "form-control datepicker",
                    'value' => isset($mProduct->keika_sochi_shiteibi) ? date("Y/m/d", strtotime($mProduct->keika_sochi_shiteibi)) : null,
                    'id' => "keika_sochi_shiteibi"]); ?>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-sm-8">
                <div class="form-group row" >
                    <label class="col-sm-3 col-form-label text-right">期首在庫数量</label>
                    <div class="col-sm-3">
                        <?= $this->Form->text('kishu_zan_suuryou', [
                            'value' => null,
                            'class' => "form-control text-right",
                            'placeholder' => '0']); ?>
                    </div>

                    <label class="col-sm-3 col-form-label text-right">現在庫数量</label>
                    <div class="col-sm-3">
                        <?= $this->Form->text('ekisei_zaiko_suuryou', [
                            'value' => isset($mProduct->ekisei_zaiko_suuryou) ? $mProduct->ekisei_zaiko_suuryou : null,
                            'class' => "form-control text-right",
                            'placeholder' => '0']); ?>
                    </div>
                </div>
                <div class="form-group row" >
                    <label class="col-sm-3 col-form-label text-right">特記・備考</label>
                    <div class="col-sm-9">
                        <?= $this->Form->textArea('naiyou', [
                            'value' => isset($mProduct->id) ? $mProduct->naiyou : false,
                            'class' => "form-control",
                            'cols' => 30,
                            'rows' => 5,
                            'placeholder' => '']); ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="col-sm-12 col-form-label text-right"> 仕入先設定 </label>
                        <?= $this->Form->button(__('クリア'), ['type' => 'button', 'id' => 'clr_m_supplier_product_id',
                            'class' => 'btn btn-secondary pull-right', 'style' => 'cursor: pointer']) ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        echo $this->Form->select('m_supplier_product_id', $mstSupplierProduct,
                            [
                                'class' => "form-control", 'id' => 'm_supplier_product_id',
                                'multiple' => true
                            ]
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4">&nbsp;</label>
            <div class="col-sm-6">
                <?= $this->Form->button(__('保存'), ['type' => 'submit',
                    'class' => 'btn btn-primary', 'style' => 'cursor: pointer']) ?>
                <?= $this->Form->button('キャンセル', array(
                    'type' => 'button',
                    'class' => 'btn btn-secondary',
                    'onclick' => "location.href='" . Router::url(['controller' => 'MProduct', 'action' => 'index']) . "'",
                )); ?>

            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
