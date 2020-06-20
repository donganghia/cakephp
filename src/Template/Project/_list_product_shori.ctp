<?php

use Cake\Routing\Router;
use App\Model\Table\MProductTable;
?>
<style type="text/css">
    .x_content input[type="text"] {
        text-align: right;
    }

    #popup-products {
        min-width: 50px;
    }

    .column-title {
        text-align: center;
    }
</style>
<script type="application/javascript">
    var defaultSuuryou = 1;

    $(document).ready(function () {

    });

</script>
<br>
<div class="form-group row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>商品リスト　
                    <?= $button ? $this->Form->button(__('選択'), [
                        'class' => 'btn btn-success btn-sm',
                        'type' => 'button',
                        'id' => 'popup-products']) : '&nbsp;' ?>
                </h4>
                <hr>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light">
                        <tr class="headings">
                            <th class="column-title" width="3%">#</th>
                            <th class="column-title" width="10%">商品ｺｰﾄﾞ</th>
                            <th class="column-title" width="20%">商品名</th>
                            <th class="column-title" width="22%">内容</th>
                            <th class="column-title" width="5%">単位</th>
                            <th class="column-title" width="8%">数量</th>
                            <th class="column-title">単価</th>
                            <th class="column-title">金額</th>
                        </tr>
                        </thead>
                        <tbody id="body-list-products">
                        <?php $readOnly = $button ? '' : 'readonly="readonly"' ; ?>
                        <?php if (isset($orderDetails) && !empty($orderDetails)) {
                            foreach ($orderDetails as $key => $orderDetail) {
                                $product = $orderDetail->_matchingData['MProduct'];
                                $supplier = $orderDetail->_matchingData['MSupplier'];
                                ?>
                                <tr>
                                    <td class="text-right" <?= $orderDetail->id ?>><?= ($key+1) ?></td>
                                    <td>
                                        <input type="hidden" class="supplier_name" value="<?= $supplier->mei_1;?>" />
                                        <input class="form-control" type="hidden" name="order_detail[supplier_id][]"
                                                        value="<?= $orderDetail->m_supplier_id;?>" ><?= $orderDetail->koudo;?>
                                    </td>
                                    <td><?= $orderDetail->mei;?></td>
                                    <td><?= $product->naiyou;?></td>
                                    <td><?= $orderDetail->tani ? MProductTable::TANI_VALUE[$orderDetail->tani] : '';?></td>
                                    <td class="text-right"><?= $orderDetail->suuryou ?></td>
                                    <td class="text-right"><?= $this->VHtml->convertNumberToMoney($orderDetail->hatchuu_tanka) ?></td>
                                    <td class="text-right"><?= $this->VHtml->convertNumberToMoney($orderDetail->hatchuu_kingaku) ?></td>
                                </tr>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>