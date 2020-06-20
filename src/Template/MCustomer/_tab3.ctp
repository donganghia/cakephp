<?php
use App\Model\Table\MCustomerTable;
?>
<div class="col-md-12">
    <div class="form-group row">
        <label for="e_doukyo_hitokazoku" class="col-sm-2 col-form-label text-right">同居人と家族の有無</label>
        <div class="col-sm-2">
            <?= $this->Form->select('e_doukyo_hitokazoku', $this->VHtml->selectNull(MCustomerTable::DOUKYO_HITOKAZAKU), [
                'class' => 'form-control'
            ]); ?>
        </div>
    </div>
</div>
<?php for ($i=1;$i<=6;$i++): ?>
    <div class="col-md-12">
        <div class="form-group row">
            <label for="doukyo_kazoku1_shimei" class="col-sm-2 col-form-label text-right">（<?= $i ?>）同居家族氏名</label>
            <div class="col-sm-4">
                <?= $this->Form->text('doukyo_kazoku'.$i.'_shimei', [
                    'class' => 'form-control',
                    'maxLength' => 200
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group row">
            <label for="doukyo_kazoku1_furigana" class="col-sm-2 col-form-label text-right">（<?= $i ?>）同居家族カナ</label>
            <div class="col-sm-4">
                <?= $this->Form->text('doukyo_kazoku'.$i.'_furigana', [
                    'class' => 'form-control',
                    'maxLength' => 200
                ]); ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group row">
            <label for="doukyo_kazoku1_furigana" class="col-sm-2 col-form-label text-right">（<?= $i ?>）同居家族生年月日</label>
            <div class="col-sm-2">
                <?= $this->Form->text('doukyo_kazoku'.$i.'_furigana', [
                    'class' => 'form-control datepicker'
                ]); ?>
            </div>
        </div>
    </div>
<?php endfor;?>