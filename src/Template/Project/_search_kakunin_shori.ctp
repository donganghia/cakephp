<div class="search-form card content">
    <div class="card-body">
        <?= $this->Form->create(null, ['id' => 'form-search', 'autocomplete' => 'off']) ?>
        <div class="form-group row">
            <label for="koudo" class="col-sm-1 col-form-label text-right">案件番号</label>
            <div class="col-sm-3">
                <?= $this->Form->text('bangou', [
                    'value' => isset($params['bangou']) ? $params['bangou'] : null,
                    'class' => "form-control",
                    'id' => 'koudo',
                ]); ?>
            </div>
            <label for="mei_1" class="col-sm-1 col-form-label text-right">受注番号</label>
            <div class="col-sm-3">
                <?= $this->Form->text('juchuu_bangou', [
                    'value' => isset($params['juchuu_bangou']) ? $params['juchuu_bangou'] : null,
                    'class' => "form-control"
                ]); ?>
            </div>
            <label for="moushisha_moushimei_kanji" class="col-sm-1 col-form-label text-right">顧客名</label>
            <div class="col-sm-3">
                <?= $this->Form->text('e_moushisha_mei', [
                    'value' => isset($params['e_moushisha_mei']) ? $params['e_moushisha_mei'] : null,
                    'class' => "form-control"
                ]); ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="ryakushou" class="col-sm-1 col-form-label text-right">作業予定日</label>
            <div class="col-sm-3">
                <?= $this->Form->text('nouki_kaishibi', [
                    'value' => isset($params['nouki_kaishibi']) ? $params['nouki_kaishibi'] : null,
                    'class' => "form-control datepicker"
                ]); ?>
            </div>
        </div>
        <div class="text-center">
            <button id="btn-search" class="btn btn-primary" type="button">検索</button>
        </div>
    <?= $this->Form->end() ?>
    </div>
</div>
