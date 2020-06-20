<?php 
use App\Model\Table\MCustomerHistoryTable;

?>

<input type="hidden" class="hide" name="m_customer_history[id]" >
<input type="hidden" class="hide" name="m_customer_history[shubetsu]" >

<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label text-right">履歴連番<span class="text-danger">*</span></label>
    <div class="col-sm-2">
        <input type="text" name="m_customer_history[rireki_renban]" class="form-control" maxlength="200" required>
    </div>

    <label for="" class="col-sm-2 col-form-label text-right">SMILENo.(案件管理No)</label>
    <div class="col-sm-2">
        <input type="text" name="m_customer_history[smile_no]" class="form-control" maxlength="200">
    </div>

    <label for="" class="col-sm-1 col-form-label text-right ">HistoryID</label>
    <div class="col-sm-1 ">
        <input type="text" name="m_customer_history[history_id]" class="form-control" maxlength="200">
    </div>

    <label for="" class="col-sm-1 col-form-label text-right ">SynergyID</label>
    <div class="col-sm-1 ">
        <input type="text" name="m_customer_history[synergy_id]" class="form-control" maxlength="200">
    </div>
</div>

<div class="form-group row ">
    <label for="" class="col-sm-2 col-form-label text-right">日付</label>
    <div class="col-sm-2">
        <input type="text" name="m_customer_history[hidzuke]" class="form-control datepicker">
    </div>
</div>

<div class="form-group row ">
    <label for="" class="col-sm-2 col-form-label text-right">受付番号</label>
    <div class="col-sm-1">
        <input type="text" name="m_customer_history[uketsuke_bangou]" class="form-control">
    </div>
    <label for="" class="col-sm-2 col-form-label text-right">管理番号</label>
    <div class="col-sm-1">
        <input type="text" name="m_customer_history[kanri_bangou]" class="form-control">
    </div>
</div>

<div class="form-group row ">
    <label for="" class="col-sm-2 col-form-label text-right">氏名</label>
    <div class="col-sm-2">
        <input type="text" name="m_customer_history[shimei]" class="form-control">
    </div>
</div>

<div class="form-group row ">
    <label for="" class="col-sm-2 col-form-label text-right">タイトル</label>
    <div class="col-sm-2">
        <select name="m_customer_history[taitoru]" class="form-control">
            <option value="">-</option>
            <?php foreach(MCustomerHistoryTable::TAITORU_1_VALUES as $key => $item) { ?>
                <option value=<?= $key ?>><?= $key . ' ' . $item ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group row ">
    <label for="" class="col-sm-2 col-form-label text-right">依頼内容</label>
    <div class="col-sm-10">
        <textarea name="m_customer_history[irai_naiyou]" class="form-control text-area-small"></textarea>
    </div>
</div>

<div class="form-group row ">
    <label for="" class="col-sm-2 col-form-label text-right">対応内容</label>
    <div class="col-sm-10">
        <textarea name="m_customer_history[taiou_naiyou]" class="form-control text-area-big"></textarea>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label text-right">クレーム</label>
    <div class="col-sm-10 chk-custom">
        <input id="chkKureemu1" type="checkbox" class="" name="m_customer_history[kureemu]" value="1">
        <label for="chkKureemu1">クレーム</label>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label text-right">対応業者</label>
    <div class="col-sm-2">
        <select name="m_customer_history[taiou_gyousha]" class="form-control">
            <option value="">-</option>
            <?php foreach(MCustomerHistoryTable::TAIOU_GYOUSHA_VALUES as $key => $item) { ?>
                <option value=<?= $key ?>><?= $key . ' ' . $item ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label text-right">担当者名</label>
    <div class="col-sm-2">
        <select name="m_customer_history[tantoushamei]" class="form-control">
            <option value="">-</option>
            <?php foreach(MCustomerHistoryTable::TANTOUSHAMEI_VALUES as $key => $item) { ?>
                <option value=<?= $key ?>><?= $key . ' ' . $item ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="" class="col-sm-2 col-form-label text-right">備考</label>
    <div class="col-sm-10">
        <textarea name="m_customer_history[bikou]" class="form-control text-area-small"></textarea>
    </div>
</div>