<div class="col-md-12">
    <div class="form-group row">
        <label for="doukyo_kazoku1_furigana" class="col-sm-2 col-form-label text-right"># 管理番号</label>
        <div class="col-sm-2">
            <?= $this->Form->text('kanri_bangou2', [
                'class' => 'form-control',
                'maxLength' => 20
            ]); ?>
        </div>
        <label class="col-sm-2"></label>
        <label for="e_touroku_chekku_ran" class="col-sm-2 col-form-label text-right">e-暮らし登録ﾁｪｯｸ欄(1)</label>
        <div class="col-sm-3">
            <?= $this->Form->text('e_touroku_chekku_ran', [
                'name' => 'e_touroku_chekku_ran[4]',
                'class' => 'form-control e_touroku_chekku_ran',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="web_moushikomi_uketsuke_bangou" class="col-sm-2 col-form-label text-right">Web申込受付番号</label>
        <div class="col-sm-2">
            <?= $this->Form->text('web_moushikomi_uketsuke_bangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label class="col-sm-2"></label>
        <label for="e_chekku_rankinyuushaid_mei" class="col-sm-2 col-form-label text-right">e-暮らしﾁｪｯｸ欄記入者ID名</label>
        <div class="col-sm-3">
            <?= $this->Form->text('e_chekku_rankinyuushaid_mei', [
                'name' => 'e_chekku_rankinyuushaid_mei[4]',
                'class' => 'form-control e_chekku_rankinyuushaid_mei',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="shokai_touroku_taimu_sutanpu" class="col-sm-2 col-form-label text-right">初回登録ﾀｲﾑｽﾀﾝﾌﾟ</label>
        <div class="col-sm-3">
            <?= $this->Form->text('shokai_touroku_taimu_sutanpu', [
                'class' => 'form-control datetimepicker'
            ]); ?>
        </div>
        <label class="col-sm-1"></label>
        <label for="e_chekku_kinyou_jikan" class="col-sm-2 col-form-label text-right">e-暮らしﾁｪｯｸ記入時間</label>
        <div class="col-sm-3">
            <?= $this->Form->text('e_chekku_kinyou_jikan', [
                'class' => 'form-control e_chekku_kinyou_jikan',
                'name' => 'e_chekku_kinyou_jikan[4]',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="okyaku_sama_bangou" class="col-sm-2 col-form-label text-right">お客様番号</label>
        <div class="col-sm-2">
            <?= $this->Form->text('okyaku_sama_bangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label class="col-sm-2"></label>
        <label for="kigyou_dantai_koudo" class="col-sm-2 col-form-label text-right">企業・団体コード</label>
        <div class="col-sm-3">
            <?= $this->Form->text('kigyou_dantai_koudo', [
                'name' => 'kigyou_dantai_koudo[4]',
                'class' => 'form-control kigyou_dantai_koudo',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="nittei" class="col-sm-2 col-form-label text-right">日程</label>
        <div class="col-sm-2">
            <?= $this->Form->text('nittei', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label class="col-sm-2"></label>
        <label for="nikkunemu" class="col-sm-2 col-form-label text-right">ニックネーム</label>
        <div class="col-sm-3">
            <?= $this->Form->text('nikkunemu', [
                'name' => 'nikkunemu[4]',
                'class' => 'form-control nikkunemu',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="shuhensaishin_sekou_yoteibi" class="col-sm-2 col-form-label text-right">種変再新施工予定日</label>
        <div class="col-sm-2">
            <?= $this->Form->text('shuhensaishin_sekou_yoteibi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
        <label class="col-sm-2"></label>
        <label for="pasuwado" class="col-sm-2 col-form-label text-right">パスワード</label>
        <div class="col-sm-3">
            <?= $this->Form->password('pasuwado', [
                'name' => 'pasuwado[4]',
                'class' => 'form-control pasuwado',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="fukakachi_sabisukaishi_yoteibi" class="col-sm-2 col-form-label text-right">付加価値ｻｰﾋﾞｽ開始予定日</label>
        <div class="col-sm-2">
            <?= $this->Form->text('fukakachi_sabisukaishi_yoteibi', [
                'class' => 'form-control datepicker'
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="henkou_gokeiyaku_shubetsu_koudo" class="col-sm-2 col-form-label text-right">変更後契約種別ｺｰﾄﾞ</label>
        <div class="col-sm-3">
            <?= $this->Form->text('henkou_gokeiyaku_shubetsu_koudo', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label class="col-sm-1"></label>
        <label for="henkou_gojukyu_keiyaku_opushon_koudo" class="col-sm-2 col-form-label text-right">変更後受給契約ｵﾌﾟｼｮﾝｺｰﾄﾞ</label>
        <div class="col-sm-3">
            <?= $this->Form->text('henkou_gojukyu_keiyaku_opushon_koudo', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="moushikomi_shubetsu_kubun" class="col-sm-2 col-form-label text-right">申込種別区分</label>
        <div class="col-sm-3">
            <?= $this->Form->text('moushikomi_shubetsu_kubun', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label class="col-sm-1"></label>
        <label for="saishin_kubun" class="col-sm-2 col-form-label text-right">再新区分</label>
        <div class="col-sm-3">
            <?= $this->Form->text('saishin_kubun', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="gokeiyaku_meigi_kanji" class="col-sm-2 col-form-label text-right">ご契約名義</label>
        <div class="col-sm-3">
            <?= $this->Form->text('gokeiyaku_meigi_kanji', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label class="col-sm-1"></label>
        <label for="gokeiyaku_meigi_kana" class="col-sm-2 col-form-label text-right">ご契約名義カナ</label>
        <div class="col-sm-3">
            <?= $this->Form->text('gokeiyaku_meigi_kana', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="juyoubasho_youbinbangou" class="col-sm-2 col-form-label text-right">需要場所郵便番号</label>
        <div class="col-sm-3">
            <?= $this->Form->text('juyoubasho_youbinbangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="juyoubasho_todoufukenmei" class="col-sm-2 col-form-label text-right">需要場所都道府県名</label>
        <div class="col-sm-3">
            <?= $this->Form->text('juyoubasho_todoufukenmei', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="juyoubasho_shikuchousonmei" class="col-sm-2 col-form-label text-right">需要場所市区町村名</label>
        <div class="col-sm-3">
            <?= $this->Form->text('juyoubasho_shikuchousonmei', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="juyoubasho_tatemono_banchi" class="col-sm-2 col-form-label text-right">需要場所番地</label>
        <div class="col-sm-3">
            <?= $this->Form->text('juyoubasho_tatemono_banchi', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="juyoubasho_tatemono_mei" class="col-sm-2 col-form-label text-right">需要場所建物名</label>
        <div class="col-sm-3">
            <?= $this->Form->text('juyoubasho_tatemono_mei', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="juyoubasho_tougousuu" class="col-sm-2 col-form-label text-right">需要場所棟号名</label>
        <div class="col-sm-3">
            <?= $this->Form->text('juyoubasho_tougousuu', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
    <div class="form-group row">
        <label for="juyoubasho_denwabangou_shurui" class="col-sm-2 col-form-label text-right">需要場所電話番号種類</label>
        <div class="col-sm-3">
            <?= $this->Form->text('juyoubasho_denwabangou_shurui', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
        <label class="col-sm-1"></label>
        <label for="juyoubasho_denwabangou" class="col-sm-2 col-form-label text-right">需要場所電話番号</label>
        <div class="col-sm-3">
            <?= $this->Form->text('juyoubasho_denwabangou', [
                'class' => 'form-control',
                'maxLength' => 200
            ]); ?>
        </div>
    </div>
</div>