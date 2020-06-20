<div class="search-form card">
    <div class="card-body">
        <?= $this->Form->create(null, ['id' => 'form-upload', 'type' => 'file', 'autocomplete' => 'off']) ?>
        <div class="form-group row" >
            <div class="col-sm-2 col-form-label" for="koudo">ファイル</div>
            <div class="col-sm-8">
                <?php
                    echo $this->Form->control('file', [
                        'type' => 'file', 'id' => 'file'
                    ]);
                //echo $this->Form->file('submittedfile');
                ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
