<?= $this->Form->create($mSystem, ['autocomplete' => 'off', 'id' => 'form-add-edit-data']) ?>
<div class="content">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label" for="shouhin_koudo">
            内容<span class="required">*</span>
        </label>
        <div class="col-sm-9">
            <?= $this->Form->text('name', [
                'value' => isset($mSystem->name) ? $mSystem->name : null,
                'id'    => 'name',
                'class' => "form-control",
                'placeholder' => 'A0000001'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label" for="description">
            説明
        </label>
        <div class="col-sm-9">
            <?= $this->Form->textArea('description', [
                'value' => isset($mSystem->description) ? $mSystem->description : null,
                'id'    => 'description',
                'class' => "form-control",
                'cols' => 30,
                'rows' => 3,
            ]); ?>
            <?= $this->Form->hidden('type_name', ['value' => $mSystem->type_name]); ?>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
