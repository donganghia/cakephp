<?= $this->Form->create($mProduct) ?>
<div class="form-data">
    <div class="row">
        <div class="col-xl-2">
            商品コード
        </div>
        <div class="col-xl-2">
            <input type="text" class="input" placeholder="A0000001">
        </div>
        <div class="col-xl-2">
            枝番コード
        </div>
        <div class="col-xl-2">
            <input type="text" class="input" placeholder="">
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2">
            商品名
        </div>
        <div class="col-xl-6">
            <input type="text" class="input" placeholder="キッチン">
        </div>
        <div class="col-xl-2">
            <a href="" class="abt search">商品検索</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2">
            商品名索引
        </div>
        <div class="col-xl-6">
            <input type="text" class="input" placeholder="ｷｯﾁﾝ">
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2">
            単位
        </div>
        <div class="col-xl-2">
            <label class="select w_100">
                <select name="" class="input" id="">
                    <option value=""></option>
                    <option value="">式</option>
                    <option value="">個</option>
                </select>
            </label>
        </div>
        <div class="col-xl-2">
            標準売上単価
        </div>
        <div class="col-xl-2">
            <input type="text" class="input text-right" placeholder="20300">
        </div>
        <div class="col-xl-2">
            非課税区分
        </div>
        <div class="col-xl-2">
            <label class="select w_100">
                <select name="" class="input" id="">
                    <option value=""></option>
                    <option value="">0 課税</option>
                    <option value="">1 非課税</option>
                </select>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2">セット区分</div>
        <div class="col-xl-2">
            <label class="select w_100">
                <select name="" class="input" id="">
                    <option value=""></option>
                    <option value="">0 通常</option>
                    <option value="">1 Aセット</option>
                    <option value="">2 Bセット</option>
                </select>
            </label>
        </div>
        <div class="col-xl-2">分類名</div>
        <div class="col-xl-2">
            <label class="select w_100">
                <select name="" class="input" id="">
                    <option value=""></option>
                    <option value="">1 サービス</option>
                    <option value="">2 物販</option>
                </select>
            </label>
        </div>
        <div class="col-xl-2">売上単価設定</div>
        <div class="col-xl-2">
            <label class="select w_100">
                <select name="" class="input" id="">
                    <option value=""></option>
                    <option value="">0 税抜き</option>
                    <option value="">1 税有り</option>
                </select>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2">自振区分</div>
        <div class="col-xl-2">
            <label class="select w_100">
                <select name="" class="input" id="">
                    <option value=""></option>
                    <option value="">0 対象外</option>
                </select>
            </label>
        </div>
        <div class="col-xl-2">カテゴリー</div>
        <div class="col-xl-2">
            <label class="select w_100">
                <select name="" class="input" id="">
                    <option value=""></option>
                    <option value="">001 ﾊｳｽｸﾘｰﾆﾝｸﾞ</option>
                    <option value="">002 家事・生活サポート</option>
                    <option value="">003 パソコンサポート</option>
                    <option value="">004 庭木お手入れサポート</option>
                    <option value="">005 ﾘﾌｫｰﾑなどの工事(家庭)</option>
                    <option value="">006 物品販売</option>
                    <option value="">007 業務用クリーニング</option>
                    <option value="">008 家電製品修理</option>
                    <option value="">009 電気の駆け付け</option>
                </select>
            </label>
        </div>
        <div class="col-xl-2">仕入単価設定</div>
        <div class="col-xl-2">
            <label class="select w_100">
                <select name="" class="input" id="">
                    <option value=""></option>
                    <option value="">0 税抜き</option>
                    <option value="">1 税有り</option>
                </select>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2">在庫管理区分</div>
        <div class="col-xl-2">
            <label class="select w_100">
                <select name="" class="input" id="">
                    <option value=""></option>
                    <option value="">0 行う</option>
                    <option value="">1 行わない</option>
                </select>
            </label>
        </div>
        <div class="col-xl-2">販売区分</div>
        <div class="col-xl-2">
            <label class="select w_100">
                <select name="" class="input" id="">
                    <option value=""></option>
                    <option value="">0 一般販売</option>
                    <option value="">1 B2B2bC販売</option>
                    <option value="">2 ｷｬﾝﾍﾟｰﾝ販売</option>
                    <option value="">3 その他販売</option>
                </select>
            </label>
        </div>
        <div class="col-xl-2">消費税率</div>
        <div class="col-xl-2">
            <input type="text" class="input w_33" placeholder="8">
            <span>%</span>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2">期首在庫数量</div>
        <div class="col-xl-2">
            <input type="text" class="input text-right" placeholder="0">
        </div>
        <div class="col-xl-2">仕入先数</div>
        <div class="col-xl-2">
            <label class="select w_100">
                <select name="" class="input" id="">
                    <option value=""></option>
                    <option value="">0 単一</option>
                    <option value="">1 複数</option>
                </select>
            </label>
        </div>
        <div class="col-xl-2">税率適用日</div>
        <div class="col-xl-2">
            <input type="text" class="date year w_42" placeholder="2014">
            <span>／</span>
            <input type="text" class="date month w_29" placeholder="04">
            <span>／</span>
            <input type="text" class="date day w_29" placeholder="01">
        </div>
    </div>
    <div class="row">
        <div class="col-xl-2">現在庫数量</div>
        <div class="col-xl-2">
            <input type="text" class="input text-right" placeholder="0">
        </div>
        <div class="col-xl-2">仕入先設定</div>
        <div class="col-xl-2">
            <select name="" class="input" id="" multiple>
                <option value="">A000001 ANY</option>
                <option value="">A000002 A-one</option>
                <option value="">A000003 ﾅｯｸ</option>
                <option value="">A000004 アート</option>
            </select>
        </div>
    </div>
</div>