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
        $('#popup-products').click(function () {
            ajaxDataForm(
                {'type': 1},
                "<?= Router::url(['controller' => 'MProduct', 'action' => 'popup']) ?>",
                function (data) {
                    popupDataForm(
                        '商品リスト選択',
                        data,
                        function () {
                            //...callBackFunc
                            var trHtml = '';
                            var num = 0;
                            $("input[name='id[]']:checked").each(function () {
                                var row = [];
                                var strSupplierName = '';
                                num++;
                                $(this).parent().parent().children().each(function (index) {
                                    if (index > 1)
                                        row.push($(this).text());
                                    else if(index == 0) {
                                        row.push($(this).children().val());
                                    }
                                    // = 1
                                    else {
                                        strSupplierName = $(this).text();
                                        row.push($(this).children().val());
                                    }
                                });

                                //append data
                                trHtml += '<tr>';
                                $.each(row, function (index, value) {
                                    switch (index) {
                                        case 0 :
                                            trHtml += '<td class="text-center c_pointer" onclick="delTableRow(this);" >' +
                                                '<i class="fa fa-trash fa-lg text-danger" ></i>' +
                                                '<input type="hidden" class="detail_product_id" name="order_detail[product_id][]" value="' + value + '" />';
                                            break;
                                        case 1 :
                                            trHtml += '<input type="hidden" class="supplier_name" value="' + strSupplierName + '" />';
                                            trHtml += '<input type="hidden" name="order_detail[supplier_id][]" value="' + value + '" /> </td>' ;
                                            break;
                                        case 2 :
                                            trHtml += rowTemplate('text', 'koudo', '');break;
                                        case 3 :
                                            trHtml += rowTemplate('text', 'mei', '');break;
                                        case 4 :
                                            trHtml += '<td>' + value + '</td>';
                                            break;
                                        case 5 :
                                            trHtml += rowTemplate('hidden', 'tani', value);break;
                                        case 6 :
                                            trHtml += rowTemplate('text', 'suuryou', defaultSuuryou);break;
                                        case 7 :
                                            trHtml += rowTemplate('text', 'hatchuu_tanka', value);break;
                                        case 8 :
                                            trHtml += rowTemplate('text', 'hatchuu_kingaku', value);break;
                                        case 9 :
                                            trHtml += rowTemplate('text', 'juchuu_tanka', value);break;
                                        case 10 :
                                            trHtml += rowTemplate('text', 'juchuu_kingaku', value);break;
                                    }
                                });
                                trHtml += '</tr>';
                            });

                            if(trHtml != "") { $("#tr-dataTables-empty").hide();}
                            $('#body-list-products').append(trHtml);
                        }
                    );
                }
            );
        });
        if($('#body-list-products tr').length > 1) { $("#tr-dataTables-empty").hide();}
    });

    function delTableRow(e) {
        $(e).parent().remove();
        //empty case
        if($('#body-list-products tr').length == 1) { $("#tr-dataTables-empty").show();}
    }
</script>
<br>
<div class="form-group row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>商品リスト <span class="text-danger">*</span>　
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
                            <th class="column-title" width="4%">#</th>
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
                        <tbody id="body-list-products">
                        <tr align="center" id="tr-dataTables-empty">
                            <td class="dataTables_empty" colspan="11">条件に一致するデータが見つかりません。</td>
                        </tr>
                        <?php $readOnly = $button ? '' : 'readonly="readonly"' ; ?>
                        <?php if (isset($orderDetails) && !empty($orderDetails)) {
                            foreach ($orderDetails as $orderDetail) {
                                $product = $orderDetail->_matchingData['MProduct'];
                                $supplier = $orderDetail->_matchingData['MSupplier'];
                                ?>
                                <tr>
                                    <?php if($button) { ?>
                                        <td class="c_pointer text-center" onclick="delTableRow(this);">
                                            <i class="fa fa-trash fa-lg text-danger"></i>
                                            <input type="hidden" class="detail_product_id" name="order_detail[product_id][]" value="<?= $product->id;?>"></td>
                                    <?php } else { ?>
                                        <td>&nbsp;</td>
                                    <?php }  ?>
                                    <td>
                                        <input type="hidden" class="supplier_name" value="<?= $supplier->mei_1;?>" />
                                        <input class="form-control" type="hidden" name="order_detail[supplier_id][]" maxlength="5"
                                                        value="<?= $orderDetail->m_supplier_id;?>" >
                                        <input class="form-control" type="text" name="order_detail[koudo][]"
                                               value="<?= $orderDetail->koudo ?>">
                                    </td>
                                    <td><input class="form-control" type="text" name="order_detail[mei][]"
                                               value="<?= $orderDetail->mei ?>"></td>
                                    <td><?= $product->naiyou;?></td>
                                    <td><input class="form-control" type="hidden" name="order_detail[tani][]"
                                               value="<?= $orderDetail->tani ? MProductTable::TANI_VALUE[$orderDetail->tani] : null;?>" >
                                        <?= $orderDetail->tani ? MProductTable::TANI_VALUE[$orderDetail->tani] : '';?>
                                    </td>
                                    <td><input <?= $readOnly ?> class="form-control" type="text" name="order_detail[suuryou][]" maxlength="5"
                                               oninput="validInt(this)"
                                               value="<?= $orderDetail->suuryou ?>">
                                    </td>
                                    <td><input <?= $readOnly ?> class="form-control" type="text" name="order_detail[hatchuu_tanka][]"
                                               oninput="validMoney(this)"
                                               value="<?= $this->VHtml->convertNumberToMoney($orderDetail->hatchuu_tanka) ?>">
                                    </td>
                                    <td><input <?= $readOnly ?> class="form-control" type="text" name="order_detail[hatchuu_kingaku][]"
                                                oninput="validMoney(this)"
                                                value="<?= $this->VHtml->convertNumberToMoney($orderDetail->hatchuu_kingaku) ?>">
                                    </td>
                                    <td><input <?= $readOnly ?> class="form-control" type="text" name="order_detail[juchuu_tanka][]"
                                                oninput="validMoney(this)"
                                                value="<?= $this->VHtml->convertNumberToMoney($orderDetail->juchuu_tanka) ?>">
                                    </td>
                                    <td><input <?= $readOnly ?> class="form-control" type="text" name="order_detail[juchuu_kingaku][]"
                                                oninput="validMoney(this)"
                                                value="<?= $this->VHtml->convertNumberToMoney($orderDetail->juchuu_kingaku) ?>"></td>
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