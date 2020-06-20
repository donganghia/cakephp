<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MUser $mUser
 */
use Cake\Routing\Router;
use App\Model\Table\MSystemTable;
use App\Model\Table\ProjectTable;
use App\Model\Table\OrdersTable;
use App\Model\Table\OrderDetailTable;
use App\Libs\Crypt;
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

    .fa-comments-o {
        cursor: pointer;
    }

    .print-view {
        text-align: right;
        width: 100%;
        margin-top: 0.5rem;
    }
</style>
<script type="application/javascript">
    var defaultSuuryou = 1;

    $(function () {
        $('#popup-products').click(function () {
            ajaxDataForm(
                {'type': 1}, "<?= Router::url(['controller' => 'MProduct', 'action' => 'popup']) ?>",
                function (data) {
                    popupDataForm('商品リスト選択', data, function () {
                        //...callBackFunc

                        var num = 0;
                        var arySupplier = [];
                        var arySupplierCheck = [];
                        $("input[name='id[]']:checked").each(function () {
                            var row = [];
                            var strSupplierName = '';
                            var strSupplierId = '';
                            var trHtml = '';
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
                                    strSupplierId = $(this).children().val();

                                    if($.inArray(strSupplierId, arySupplierCheck) === -1) {
                                        arySupplier.push({id: $(this).children().val(), name: $(this).text()});
                                        arySupplierCheck.push(strSupplierId);

                                        // create table
                                        if($('.x_content #shouhin-ichiran-' + strSupplierId).length <= 0) {
                                            var strTableTemplate = getTableTemplate(strSupplierId, strSupplierName);
                                            $('.x_content').append(strTableTemplate);
                                            initTimePicker('.timepicker');
                                        }
                                    }
                                    row.push(strSupplierId);
                                }
                            });
                            //append data
                            trHtml += '<tr>';
                            $.each(row, function (index, value) {
                                switch (index) {
                                    case 0 :
                                        var func = "'"+strSupplierId+"'";
                                        trHtml += '<td class="text-center c_pointer" onclick="delTableRow(this, '+func+');" >' +
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
                            var tableSelected = '.x_content #shouhin-ichiran-' + strSupplierId + ' table';
                            if($(tableSelected).length > 0 && trHtml) {
                                $(tableSelected + ' .tr-dataTables-empty:visible').hide();
                                $(tableSelected).append(trHtml);
                                initDatePicker('.datepicker');
                                $('.dataTables_empty').hide();
                            }
                        });
                    });
                }
            );
        });
    });

    function delTableRow(e, supplierId) {
        var tableId = 'shouhin-ichiran-' + supplierId;
        $(e).parent().remove();
        if($('#' + tableId + ' tbody tr').length <= 0) {
            $('#' + tableId).remove();
            $('.dataTables_empty').show();
            <?php if(isset($order->id)): ?>
            var orderComment = '<input type="hidden" name="supplier_delete_id[]" value="'+supplierId+'"></td>';
            $('#frm_add_edit_project').append(orderComment);
            <?php endif; ?>
        } else {
            $('.dataTables_empty').hide();
        }
    }


    function getTableTemplate(supplierId, strSupplierName) {
        var html = $('#shouhin-ichiran-template').html();

        var mapObj = {
            SUPPLIER_ID: supplierId,
            SUPPLIER_NAME: strSupplierName,
            ' disabled="disabled"': '',
            ' disabled': ''
        };
        return html.replace(/SUPPLIER_ID|SUPPLIER_NAME| disabled="disabled"| disabled/gi, function(matched){
            return mapObj[matched];
        });
    }

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

    // A || B || C
    function showHatchyuu(type) {
        $('body #'+type+' .print-area').printThis({
            removeInline: true,
            debug: false,
            printDelay: (0.2*1000),
            loadCSS: '<?= Router::url('/css/project/hatchuusho.css'); ?>'
        });
    }
</script>
<br>
<div class="form-group row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>商品リスト <span class="text-danger">*</span>　
                    <?= $this->Form->button(__('選択'), [
                        'class' => 'btn btn-success btn-sm',
                        'type' => 'button',
                        'id' => 'popup-products']) ?>
                </h4>
                <hr>
            </div>
            <div class="x_content">
                <?php if(empty($orderDetails)): ?>
                    <div class="dataTables_empty text-center">条件に一致するデータが見つかりません。<hr></div>
                <?php endif; ?>

                <?php $arySupplierAllId = [];?>
                <?php $arySupplierId = [];?>
                <?php if (!empty($orderDetails)): ?>
                <?php foreach ($orderDetails as $orderDetailKey => $orderDetail): ?>
                <?php
                $product = $orderDetail->_matchingData['MProduct'];
                $supplier = $orderDetail->_matchingData['MSupplier'];
                $intSupplierId = $supplier->id ?: OrderDetailTable::EKURASHI_KAISHA_ID;

                $strSupplierMei = $intSupplierId ? $supplier->mei_1 : OrderDetailTable::EKURASHI_KAISHA_MEI;
                $intKategori = $product->m_system_shouhin_kategori_id;
                $intTani = $orderDetail->tani;
                $intSuuryou = $orderDetail->suuryou;
                $kategori = isset($mstSystem[MSystemTable::SYSTEM_KATEGORI_ID][$intKategori]) ? $mstSystem[MSystemTable::SYSTEM_KATEGORI_ID][$intKategori] : '';
                $tani = isset(MProductTable::TANI_VALUE[$intTani]) ? MProductTable::TANI_VALUE[$intTani] : '';
                $hatchuuTanka = $this->VHtml->convertNumberToMoney($orderDetail->hatchuu_tanka);
                $hatchuuKingaku = $this->VHtml->convertNumberToMoney($orderDetail->hatchuu_kingaku);
                $juchuuTanka = $this->VHtml->convertNumberToMoney($orderDetail->juchuu_tanka);
                $juchuuKingaku = $this->VHtml->convertNumberToMoney($orderDetail->juchuu_kingaku);

                $arySupplierAllId[$intSupplierId][] = [
                    'supplier_mei' => $strSupplierMei,
                    'supplier_denwa' => $supplier->denwa,
                    'supplier_fax' => $supplier->fax,
                    'product_mei' => $product->mei,
                    'product_naiyou' => $product->naiyou,
                    'product_kategori' => $kategori,
                    'product_suuryou' => $intSuuryou,
                    'product_tani' => $tani,
                    'hatchuu_tanka' => $orderDetail->hatchuu_tanka,
                    'hatchuu_kingaku' => $orderDetail->hatchuu_kingaku,
                    'juchuu_tanka' => $orderDetail->juchuu_tanka,
                    'juchuu_kingaku' => $orderDetail->juchuu_kingaku,
                ];
                ?>

                <?php if(in_array($intSupplierId, $arySupplierId)) : ?>
                    <tr>
                        <td class="c_pointer text-center" onclick="delTableRow(this, '<?= $intSupplierId ?>');">
                            <i class="fa fa-trash fa-lg text-danger"></i>
                            <input type="hidden" class="detail_product_id" name="order_detail[product_id][]" value="<?= $product->id ?>"></td>
                        <td>
                            <input type="hidden" class="supplier_name" value="<?= $strSupplierMei ?>" />
                            <input class="form-control" type="hidden" name="order_detail[supplier_id][]"
                                   value="<?= $intSupplierId ?>" >
                            <input class="form-control" type="text" name="order_detail[koudo][]"
                                   value="<?= $orderDetail->koudo ?>">
                        </td>
                        <td> <input class="form-control" type="text" name="order_detail[mei][]"
                                    value="<?= $orderDetail->mei ?>"></td>
                        <td><?= $product->naiyou ?></td>
                        <td><input class="form-control" type="hidden" name="order_detail[tani][]" value="<?= $tani ?>"><?= $tani ?></td>
                        <td><input class="form-control" type="text" name="order_detail[suuryou][]" maxlength="5"
                                   oninput="validInt(this)"
                                   value="<?= $intSuuryou ?>">
                        </td>
                        <td><input class="form-control" type="text" name="order_detail[hatchuu_tanka][]"
                                   oninput="validMoney(this)"
                                   value="<?= $hatchuuTanka ?>">
                        </td>
                        <td><input class="form-control" type="text" name="order_detail[hatchuu_kingaku][]"
                                   oninput="validMoney(this)"
                                   value="<?= $hatchuuKingaku ?>">
                        </td>
                        <td><input class="form-control" type="text" name="order_detail[juchuu_tanka][]"
                                   oninput="validMoney(this)"
                                   value="<?= $juchuuTanka ?>">
                        </td>
                        <td><input class="form-control" type="text" name="order_detail[juchuu_kingaku][]"
                                   oninput="validMoney(this)"
                                   value="<?= $juchuuKingaku ?>"></td>
                    </tr>
                <?php else : ?>
                <?php $arySupplierId = [$intSupplierId]; ?>
                <?php if($orderDetailKey !== 0): ?>
                </tbody></table></div>
            <?php endif; ?>

            <div id="shouhin-ichiran-<?= $intSupplierId ?>">
                <h5><span class="shiiresaki-mei">委託先：<?= $strSupplierMei ?></span></h5>

                <div class="form-group row">
                    <label for="nouki_shuuryoubi" class="col-sm-1 col-form-label text-right">納期</label>
                    <div class="col-sm-2">
                        <?= $this->Form->text('order_detail[nouki_shuuryoubi]['.$intSupplierId.']', [
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
                    <tbody>
                    <tr>
                        <td class="c_pointer text-center" onclick="delTableRow(this, '<?= $intSupplierId ?>');">
                            <i class="fa fa-trash fa-lg text-danger"></i>
                            <input type="hidden" class="detail_product_id" name="order_detail[product_id][]" value="<?= $product->id ?>"></td>
                        <td>
                            <input type="hidden" class="supplier_name" value="<?= $strSupplierMei ?>" />
                            <input class="form-control" type="hidden" name="order_detail[supplier_id][]"
                                   value="<?= $intSupplierId ?>" >
                            <input class="form-control" type="text" name="order_detail[koudo][]" maxlength="5"
                                   value="<?= $orderDetail->koudo ?>">
                        </td>
                        <td>
                            <input class="form-control" type="text" name="order_detail[mei][]" maxlength="5"
                                   value="<?= $orderDetail->mei ?>">
                        </td>
                        <td><?= $product->naiyou ?></td>
                        <td><input class="form-control" type="hidden" name="order_detail[tani][]" value="<?= $tani ?>"><?= $tani ?></td>
                        <td><input class="form-control" type="text" name="order_detail[suuryou][]" maxlength="5"
                                   oninput="validInt(this)"
                                   value="<?= $intSuuryou ?>">
                        </td>
                        <td><input class="form-control" type="text" name="order_detail[hatchuu_tanka][]"
                                   oninput="validMoney(this)"
                                   value="<?= $hatchuuTanka ?>">
                        </td>
                        <td><input class="form-control" type="text" name="order_detail[hatchuu_kingaku][]"
                                   oninput="validMoney(this)"
                                   value="<?= $hatchuuKingaku ?>">
                        </td>
                        <td><input class="form-control" type="text" name="order_detail[juchuu_tanka][]"
                                   oninput="validMoney(this)"
                                   value="<?= $juchuuTanka ?>">
                        </td>
                        <td><input class="form-control" type="text" name="order_detail[juchuu_kingaku][]"
                                   oninput="validMoney(this)"
                                   value="<?= $juchuuKingaku ?>"></td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody></table></div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>

<div id="shouhin-ichiran-template" class="hidden">
    <div id="shouhin-ichiran-SUPPLIER_ID">
        <h5><span class="shiiresaki-mei">委託先：SUPPLIER_NAME</span></h5>

        <div class="form-group row">
            <label for="nouki_shuuryoubi" class="col-sm-1 col-form-label text-right">納期</label>
            <div class="col-sm-2" >
                <?= $this->Form->text('order_detail[nouki_shuuryoubi][SUPPLIER_ID]', [
                    'class' => 'form-control datepicker',
                    'placeholder' => '終了　（西暦）年/月/日',
                    'disabled' => 'disabled'
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-1 col-form-label text-right">訪問時間</label>

            <div class="col-sm-1">
                <?= $this->Form->select('order_detail[m_system_houmon_jikan_id][SUPPLIER_ID]',
                    isset($mstSystem[MSystemTable::SYSTEM_HOUMON_JIKAN]) ?
                        $this->VHtml->selectNull($mstSystem[MSystemTable::SYSTEM_HOUMON_JIKAN]) : [], [
                        'class' => 'form-control',
                        'disabled' => 'disabled'
                    ]); ?>
            </div>
            <div class="col-sm-1">
                <?= $this->Form->text('order_detail[houmon_jikan_kaishi][SUPPLIER_ID]', [
                    'class' => 'form-control text-right timepicker',
                    'disabled' => 'disabled'
                ]); ?>
            </div>
        </div>

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
            <tbody></tbody>
        </table>
    </div>
</div>

<div id="print-body" class="hide">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a id="aria-1" class="nav-link active" data-toggle="tab" href="#T1" role="tab" aria-controls="#T1" aria-selected="true" data-value="active">
                発注書A
            </a>
        </li>
        <li class="nav-item">
            <a id="aria-2" class="nav-link" data-toggle="tab" href="#T2" role="tab" aria-controls="#T2" data-value="">
                内容確認書B
            </a>
        </li>
        <li class="nav-item">
            <a id="aria-2" class="nav-link" data-toggle="tab" href="#T3" role="tab" aria-controls="#T3" data-value="">
                内容確認書C
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="T1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="aria-1">
            <div class="print-view"><button onclick="showHatchyuu('T1')">印　刷</button></div>
            <div class="print-area">
                <?php $defaultZeiritsu = (isset($project->zeiritsu) ? $project->zeiritsu : $intDefaultTax) * 0.01; ?>
                <?php foreach ($arySupplierAllId as $supplierAllItem): ?>
                    <table>
                        <tr>
                            <td width="24%"><?= $supplierAllItem[0]['supplier_mei'] ?></td>
                            <td width="10%"></td>
                            <td align="right"><?= $this->VHtml->toDayYYYYMMDD() ?></td>
                        </tr>
                        <tr>
                            <td>訪 問 修 理 受 付 セ ン タ ー</td>
                            <td align="center">御 中</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>TEL： <?= $supplierAllItem[0]['supplier_denwa'] ?></td>
                            <td colspan="2">FAX： <?= $supplierAllItem[0]['supplier_fax'] ?></td>
                        </tr>
                    </table>
                    <div class="padding"></div>
                    <div class="report-title">『 暮 ら し サ ー ビ ス 』 発 注 書 Ａ</div>
                    <table class="report-content">
                        <tr>
                            <td align="center" width="18%">カ テ ゴ リ ー</td>
                            <td align="center">商 品 名 ／ 内 容</td>
                            <td align="center" width="8%">数 量</td>
                            <td align="center" width="6%">単 位</td>
                            <td align="center" width="13%">単 価</td>
                            <td align="center" width="13%">金 額</td>
                        </tr>

                        <?php $totalHatchuuKingaku = 0; ?>
                        <?php foreach ($supplierAllItem as $detailValue): ?>
                            <tr>
                                <td>
                                    <?= $detailValue['product_kategori'] ?>
                                </td>
                                <td>
                                    <?= $detailValue['product_mei'] ?>／<?= $detailValue['product_naiyou'] ?>
                                </td>
                                <td align="right">
                                    <?= number_format($detailValue['product_suuryou']) ?></td>
                                <td align="center"><?= $detailValue['product_tani'] ?></td>
                                <td align="right">
                                    <span class="money"><?= $this->VHtml->convertNumberToMoney($detailValue['hatchuu_tanka']*$defaultZeiritsu) ?></span>
                                    <span class="unmoney"><?= $this->VHtml->hideNumberToMoney($detailValue['hatchuu_tanka']*$defaultZeiritsu) ?></span>
                                </td>
                                <?php $hatchuuKingaku = $detailValue['hatchuu_kingaku']*$defaultZeiritsu; ?>
                                <td align="right">
                                    <span class="money"><?= $this->VHtml->convertNumberToMoney($hatchuuKingaku) ?></span>
                                    <span class="unmoney"><?= $this->VHtml->hideNumberToMoney($hatchuuKingaku) ?></span>
                                </td>
                                <?php $totalHatchuuKingaku += $hatchuuKingaku; ?>
                            </tr>
                        <?php endforeach; ?>

                        <?php if(count($supplierAllItem) < 10): ?>
                            <?php $i = 10 - count($supplierAllItem) ?>
                            <?php for ($i=0; $i<=10; $i++): ?>
                                <tr><td>　</td><td>　</td><td>　</td><td>　</td><td>　</td><td>　</td></tr>
                            <?php endfor; ?>
                        <?php endif; ?>

                        <tr>
                            <td colspan="3" class="none-border"></td>
                            <td align="center" colspan="2">合 計 金 額 (税 込)</td>
                            <td align="right">
                                <span class="money"><?= $this->VHtml->convertNumberToMoney($totalHatchuuKingaku) ?></span>
                                <span class="unmoney"><?= $this->VHtml->hideNumberToMoney($totalHatchuuKingaku) ?></span>
                            </td>
                        </tr>
                    </table>
                    <br>　■ お 客 様 情 報 記 入 欄
                    <table class="report-border">
                        <tr>
                            <td width="12%">フ リ ガ ナ</td>
                            <td colspan="2">テ ス ト</td>
                            <td width="5%"></td>
                            <td width="14%">電 話 番 号</td>
                            <td width="30%">052-000-0000</td>
                        </tr>
                        <tr>
                            <td>お 名 前</td>
                            <td colspan="2"></td>
                            <td width="5%"></td>
                            <td>携 帯 電 話 番 号 </td>
                            <td>052-111-1111</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>テ ス ト</td>
                            <td colspan="4">様</td>
                        </tr>
                    </table>
                    <table class="report-border none-top">
                        <tr>
                            <td width="12%">住 所 〒</td>
                            <td colspan="6">460-0001</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="6">愛 知 県 名 古 屋 市 中 区 三 の 丸 ０ － ０ － ０</td>
                        </tr>
                    </table>
                    <table class="report-border none-top">
                        <tr>
                            <td width="12%">訪 問 時 間 帯</td>
                            <td colspan="2">① 便</td>
                            <td width="15%">納 期 日 /工 事 日</td>
                            <td>2018/06/01</td>
                        </tr>
                    </table>
                    <table class="report-border none-top">
                        <tr><td><br>※ 連 絡 事 項<br><br><br><br><br><br></td></tr>
                    </table>
                    <br>
                    ※１　作業日については担当者よりお電話でご都合をお伺いしたあと、作業実施日を決定させていただきます。<br>
                    ※２　お支払については、現金でのお支払いはお受けできません。<br>
                    　　　作業終了後に請求書を発行させていただきますので、ご希望のお支払い方法にてお支払いをお願いいたします。<br>
                    ※３　作業中、万一お客様が一時外出される場合は、トラブルを避けるため貴重品等の管理を十分にお願いいたします。<br>
                    ※４　作業内容により、ご自宅の電気・水道をお借りする場合があります。<br>
                    ※５　作業前に商品の状況や設置場所の確認により作業をお断りさせて頂く場合がございます。
                    ■発注者<br>
                    ｅ－暮らし株式会社<br>
                    〒464-0075<br>
                    名古屋市千種区内山3丁目30番9号<br>
                    TEL:052-744-0271<br>
                    FAX:052-744-0274<br><br><br>
                    <table class="report-content">
                        <tr>
                            <td width="12%" class="none-right">ek管理番号</td>
                            <td align="right" width="12%" class="none-left">787</td>
                            <td colspan="4" class="none-all"></td>
                        </tr>
                        <tr>
                            <td align="center">実施sc</td>
                            <td></td>
                            <td align="center" width="12%">ed管理番号</td>
                            <td></td>
                            <td align="center" width="12%">担当</td>
                            <td></td>
                        </tr>
                    </table>
                    <div class="page-break"></div>
                <?php endforeach; ?>

            </div>
        </div>

        <div id="T2" class="tab-pane fade" role="tabpanel" aria-labelledby="aria-2">
            <div class="print-view"><button onclick="showHatchyuu('T2')">印　刷</button></div>
            <div class="print-area">CONTENT2</div>
        </div>
        <div id="T3" class="tab-pane fade" role="tabpanel" aria-labelledby="aria-3">
            <div class="print-view"><button onclick="showHatchyuu('T3')">印　刷</button></div>
            <div class="print-area">CONTENT3</div>
        </div>
    </div>
</div>
