<?php

use Cake\Routing\Router;
use App\Model\Table\OrderDetailTable;
use App\Model\Table\MProductTable;
use App\Model\Table\MSystemTable;
use App\Libs\Crypt;
?>
<style type="text/css">
    .x_content input[type="text"] {
        text-align: right;
    }
    .column-title {
        text-align: center;
    }
</style>
<script type="application/javascript">
    $(document).ready(function () {
        if($('#body-list-products tr').length > 1) { $("#tr-dataTables-empty").hide();}

        $('#order_m_system_joutaikubun_id').change(function () {
            if($(this).val() == "<?=OrderDetailTable::JOUTAI_KUBUN_BUNKATSU_KEIJOU?>") {
                $("input[name='order_detail_keijou']").each(function () {
                    $(this).show();
                });
            } else {
                $("input[name='order_detail_keijou']").each(function () {
                    $(this).hide();
                });
            }
        });
    });

    function showPopupComment(project_id, order_id, m_supplier_id) {
        ajaxDataForm({project_id: project_id, order_id: order_id, m_supplier_id: m_supplier_id},
            '<?= Router::url(['controller' => 'Comment', 'action' => 'popup']) ?>',
            function (res) {
                $("body").append(res);
            });
    }

    // popup comment response
    function saveCommentCallback(res) {
        if(res.success) {
            //m_supplier_id
            var m_supplier_id = res.result.m_supplier_id;
            var last_comment_date = res.result.last_comment_date;

            if(m_supplier_id && last_comment_date) {
                $('#shouhin-ichiran-' + m_supplier_id + ' .last_comment_date').text(res.result.last_comment_date);
            }
        }
    }
</script>
<br>
<div class="form-group row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>商品リスト</h4>
                <hr>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                <?php
                    $aryOrderDetail = [];
                    $mstSupplier = [];
                    $countJuchuuKingaku = 0;
                    if (isset($orderDetails) && !empty($orderDetails)) {
                        foreach ($orderDetails as $_orderDetail) {
                            $supplier = $_orderDetail->_matchingData['MSupplier'];
                            $supplierId = isset($supplier->id) ? $supplier->id : OrderDetailTable::EKURASHI_KAISHA_ID;
                            $mei = isset($supplier->mei_1) ? $supplier->mei_1 : OrderDetailTable::EKURASHI_KAISHA_MEI;
                            $mstSupplier[$supplierId] = $mei;
                            $aryOrderDetail[$supplierId][] = $_orderDetail;
                        }

                        foreach ($aryOrderDetail as $intSupplierId => $_orderDetails) {
                            $orderDetail = $_orderDetails[0]; ?>
                            <div id="shouhin-ichiran-<?= $supplierId ?>">
                                <h5><span class="shiiresaki-mei">委託先：<?= $mstSupplier[$intSupplierId] ?></span></h5>

                                <div class="form-group row">
                                    <label for="nouki_shuuryoubi" class="col-sm-1 col-form-label text-right">納期</label>
                                    <div class="col-sm-2">
                                        <?= $this->Form->text('order_detail[nouki_shuuryoubi]['.$supplierId.']', [
                                            'value' => isset($orderDetail->nouki_shuuryoubi) ? $this->VHtml->dateToYYYYMMDD($orderDetail->nouki_shuuryoubi) : '',
                                            'class' => 'form-control datepicker',
                                            'placeholder' => '終了　（西暦）年/月/日'
                                        ]); ?>
                                    </div>
                                    <div class="col-sm-2 text-right">
                                        <?php
                                        $sub = '';
                                        if($orderDetail->m_system_joutaikubun_id === OrderDetailTable::JOUTAI_KUBUN_HATCHUU_SUMI &&
                                            $orderDetail->status ===  OrderDetailTable::STATUS_RETURN ) {
                                            $sub = OrderDetailTable::SUB_HATCHU_SUMI_MODOSHI;
                                        }

                                        if($orderDetail->m_system_joutaikubun_id === OrderDetailTable::JOUTAI_KUBUN_BUNKATSU_KEIJOU &&
                                            $orderDetail->keijou ==  OrderDetailTable::KEIJOU_IS_CHECKED ) {
                                            $sub = OrderDetailTable::SUB_KEIJOU_SUMI;
                                        }

                                        if(isset($orderDetail->m_system_joutaikubun_id)
                                            && isset($mstSystem[MSystemTable::SYSTEM_JOUTAI_KUBUN][$orderDetail->m_system_joutaikubun_id])) {
                                            echo '状態：'.$mstSystem[MSystemTable::SYSTEM_JOUTAI_KUBUN][$orderDetail->m_system_joutaikubun_id].$sub;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-1 col-form-label text-right">訪問時間</label>

                                    <div class="col-sm-1">
                                        <?= $this->Form->select('order_detail[m_system_houmon_jikan_id]['.$intSupplierId.']',
                                            isset($mstSystem[MSystemTable::SYSTEM_HOUMON_JIKAN]) ?
                                                $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_HOUMON_JIKAN]) : [], [
                                                'value' => isset($orderDetail->m_system_houmon_jikan_id) ? $orderDetail->m_system_houmon_jikan_id : '',
                                                'class' => 'form-control'
                                            ]); ?>
                                    </div>
                                    <div class="col-sm-1">
                                        <?= $this->Form->text('order_detail[houmon_jikan_kaishi]['.$intSupplierId.']', [
                                            'value' => isset($orderDetail->houmon_jikan_kaishi) ? $orderDetail->houmon_jikan_kaishi : '',
                                            'class' => 'form-control text-right timepicker']); ?>
                                    </div>
                                    <?php if(isset($order->id)): ?>
                                        <label class="col-sm-2 col-form-label text-right">
                                            連絡コメント追加
                                        </label>
                                        <label class="col-sm-2 text-danger">
                                            <i class="fa fa-2x fa-comments-o" onclick="showPopupComment('<?= Crypt::encrypAES($project->id) ?>', '<?= Crypt::encrypAES($order->id) ?>', '<?= Crypt::encrypAES($intSupplierId) ?>')"></i>
                                            　<span class="last_comment_date"><?= isset($aryOrderComment[$intSupplierId]) ? $this->VHtml->dateToYMDhi($aryOrderComment[$intSupplierId]) : '' ?></span>
                                        </label>
                                    <?php endif ?>
                                </div>

                                <table class="table table-bordered table-sm">
                                    <thead class="thead-light">
                                    <tr class="headings">
                                        <th class="column-title" width="4%">項番</th>
                                        <th class="column-title" width="7%">商品ｺｰﾄﾞ</th>
                                        <th class="column-title" width="10%">商品名</th>
                                        <th class="column-title" width="10%">内容</th>
                                        <th class="column-title" width="5%">単位</th>
                                        <th class="column-title" width="8%">数量</th>
                                        <th class="column-title" width="12%">発注単価</th>
                                        <th class="column-title" width="12%">発注金額</th>
                                        <th class="column-title">受注単価</th>
                                        <th class="column-title">受注金額</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($_orderDetails as $orderDetail) {
                                            $product = $orderDetail->_matchingData['MProduct'];
                                            $supplier = $orderDetail->_matchingData['MSupplier'];
                                            ?>
                                            <tr>
                                                <?php
                                                    $display = $order->m_system_joutaikubun_id === OrderDetailTable::JOUTAI_KUBUN_BUNKATSU_KEIJOU ?
                                                        ( $orderDetail->keijou === 1 ? 'disabled=""' : '') : 'style="display: none;"' ;
                                                ?>
                                                <td class="c_pointer text-center">
                                                    <input <?=$display?> type="checkbox" name="order_detail_keijou" <?= $orderDetail->keijou === 1 ? "checked=''" : ""; ?>" value="<?= $orderDetail->keijou; ?>" id="id-<?= $orderDetail->id; ?>">
                                                    <?= $this->Form->hidden('order_detail_id', ['value' => $orderDetail->id]); ?>
                                                </td>
                                                <td><?= $orderDetail->koudo;?></td>
                                                <td><?= $orderDetail->mei;?></td>
                                                <td><?= $product->naiyou;?></td>
                                                <td><?= $orderDetail->tani ? MProductTable::TANI_VALUE[$orderDetail->tani] : '';?></td>
                                                <td ><?= $product->suuryou;?></td>
                                                <td class="text-right"><?= $this->VHtml->convertNumberToMoney($orderDetail->hatchuu_tanka) ?></td>
                                                <td class="text-right"><?= $this->VHtml->convertNumberToMoney($orderDetail->hatchuu_kingaku) ?></td>
                                                <td class="text-right"><?= $this->VHtml->convertNumberToMoney($orderDetail->juchuu_tanka) ?></td>
                                                <td class="text-right">
                                                    <?= $this->VHtml->convertNumberToMoney($orderDetail->juchuu_kingaku) ?>
                                                    <input type="hidden" name="order_detail[juchuu_kingaku][]" value="<?= $orderDetail->juchuu_kingaku;?>" >
                                                </td>
                                            </tr>
                                    <?php
                                        $countJuchuuKingaku += $orderDetail->juchuu_kingaku;
                                        $checked = [];
                                        $uncheck = [];
                                        if($orderDetail->keijou === 1)
                                            $checked[] = $orderDetail->id;
                                        else
                                            $uncheck[] = $orderDetail->id;
                                    ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                <?php   }
                    }  ?>
                        <?= $this->Form->hidden('order[uriage_zumi_goukei]', ['value' => $countJuchuuKingaku, 'id' => 'order_uriage_zumi_goukei']); ?>
                        <?= $this->Form->hidden('project[uriage_zumi_goukei]', ['value' => $countJuchuuKingaku, 'id' => 'project_uriage_zumi_goukei']); ?>
                        <?= $this->Form->hidden('order_detail[list_id_is_checked]', ['value' => !empty($checked) ? implode(",", $checked) : null, 'id' => 'order_detail_list_id_is_checked']); ?>
                        <?= $this->Form->hidden('order_detail[list_id_is_uncheck]', ['value' => !empty($uncheck) ? implode(",", $uncheck) : null, 'id' => 'order_detail_list_id_is_uncheck']); ?>
                </div>
            </div>
        </div>
    </div>
</div>