<div class="page page_register register_confirm" id="account">
    <div class="navi">
        <div class="go_back">
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                    <g>
                        <title></title>
                        <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0"
                              fill="transparent"></rect>
                        <path stroke-width="0"
                              d="M8.357.929c.251 0 .469.092.653.276.184.184.276.401.276.653v3.714h3.25c6.897 0 11.128 1.949 12.695 5.847.513 1.296.769 2.907.769 4.831 0 1.606-.614 3.787-1.843 6.544l-.152.348-.196.435c-.058.126-.121.232-.189.319-.116.164-.251.247-.406.247-.145 0-.259-.048-.341-.145-.082-.097-.123-.218-.123-.363l.036-.384.036-.341c.048-.658.073-1.253.073-1.785 0-.977-.085-1.852-.254-2.626-.169-.774-.404-1.444-.704-2.009-.3-.566-.687-1.054-1.161-1.465-.474-.411-.984-.747-1.531-1.008-.547-.261-1.19-.467-1.93-.617-.74-.15-1.485-.254-2.234-.312-.75-.058-1.598-.087-2.546-.087h-3.25v3.714c0 .251-.092.469-.276.653-.184.184-.401.276-.653.276-.251 0-.469-.092-.653-.276l-7.429-7.429c-.184-.184-.276-.401-.276-.653 0-.251.092-.469.276-.653l7.429-7.429c.184-.184.401-.276.653-.276z"></path>
                    </g>
                </svg>
                <span>戻る</span>
            </a>

        </div>
        <h1 class="title">案件確認処理</h1>
        <div class="date_schedule clearfix">
            <div class="date_order">
                <span>発注日</span>
                <input type="text" class="date year" placeholder="<?= date('Y') ?>">
                <span>／</span>
                <input type="text" class="date month" placeholder="<?= date('m') ?>">
                <span>／</span>
                <input type="text" class="date day" placeholder="<?= date('d') ?>">
            </div>
            <div class="order_no">
                <span>オーダーNo.</span>
                <input type="text" class="w_143 text-right" value="1036">
            </div>
            <div class="order_user">
                <span>e-暮らし担当</span>
                <input type="text" class="w_139 text-right" placeholder="兼山">
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="content">
        <div class="info">
            <div class="row">
                <div class="situation col-sm-8 col-lg-8">
                    <div class="title">確認種別</div>
                    <label for="radio1"><input type="radio" value="確認登録のみ" name="type" id="radio1" > 確認登録のみ</label>
                    <label for="radio2"><input type="radio" value="作業予定日返信要" name="type" id="radio2" > 作業予定日返信要</label>
                    <label for="radio3"><input type="radio" value="その他条件確認要" name="type" id="radio3"> その他条件確認要</label>
                    <label for="radio4"><input type="radio" value="確認TEL連絡要" name="type" id="radio4"> 確認TEL連絡要</label>
                    <label for="radio5"><input type="radio" value="戻し条件" name="type" id="radio5" checked> 戻し条件</label>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-1">案件No.</div>
                <div class="col-xl-1"><input type="text" class="input" placeholder="EK20181036"></div>
                <div class="col-xl-2 color_red">※連絡事項記載有り</div>
                <div class="col-xl-2 color_red">※添付資料有り</div>
                <div class="col-xl-2 color_red"><input type="text" class="input" placeholder="理由"></div>
            </div>
            <div class="row">
                <div class="col-xl-1">お客様氏名</div>
                <div class="col-xl-3"><input type="text" class="input" placeholder="山本商店"></div>
                <div class="col-xl-2">様</div>
                <div class="col-xl-1 color_red">訪問時間帯</div>
                <div class="col-xl-1"><input type="text" class="input text-right" placeholder="①便"></div>
                <div class="col-xl-1 color_red">時間</div>
                <div class="col-xl-1"><input type="text" class="input"></div>
            </div>
            <div class="row">
                <div class="col-xl-1">フリガナ</div>
                <div class="col-xl-3"><input type="text" class="input " placeholder=""></div>
                <div class="col-xl-2">様</div>
                <div class="col-xl-1 color_red">作業期間</div>
                <div class="col-xl-1"><input type="text" class="input text-right" placeholder="1"></div>
                <div class="col-xl-1">日</div>
            </div>
            <div class="row">
                <div class="col-xl-1">郵便番号</div>
                <div class="col-xl-2"><input type="text" class="input " placeholder=""></div>
                <div class="col-xl-1">郵便番号</div>
                <div class="col-xl-2">
                    <label class="select w_100">
                        <select name="" class="input" id="">
                            <option value=""></option>
                            <option value="">愛知県</option>
                            <option value="">東京都</option>
                            <option value="">大阪府</option>
                            <option value="">京都府</option>
                            <option value="">広島県</option>
                            <option value="">福岡県</option>
                        </select>
                    </label>
                </div>
                <div class="col-xl-2 color_red">納期日／工事日</div>
                <div class="col-xl-4">
                    <span class="color_red">開始日</span>
                    <input type="text" class="date year" placeholder="">
                    <span>／</span>
                    <input type="text" class="date month" placeholder="">
                    <span>／</span>
                    <input type="text" class="date day" placeholder="">
                </div>

            </div>

            <div class="row">
                <div class="col-xl-1 font_12">市区町村番地</div>
                <div class="col-xl-5"><input type="text" class="input"></div>
                <div class="col-xl-2 color_red"></div>
                <div class="col-xl-4">
                    <span class="color_red">終了日</span>
                    <input type="text" class="date year" placeholder="">
                    <span>／</span>
                    <input type="text" class="date month" placeholder="">
                    <span>／</span>
                    <input type="text" class="date day" placeholder="">
                </div>
            </div>
            <div class="row">
                <div class="col-xl-1">ビル名等</div>
                <div class="col-xl-5"><input type="text" class="input"></div>
                <div class="col-xl-1">お支払方法</div>
                <div class="col-xl-5">
                    <label for="radio6"><input type="radio" value="銀行振込" name="payment" id="radio6"> 銀行振込</label>
                    <label for="radio7"><input type="radio" value="作業予定日返信要" name="payment" id="radio7"> コンビニ振込</label>
                    <label for="radio8"><input type="radio" value="その他条件確認要" name="payment" id="radio8"> クレジット</label>
                    <label for="radio9"><input type="radio" value="確認TEL連絡要" name="payment" id="radio9"> 口座振替</label>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-1">TEL番号</div>
                <div class="col-xl-2"><input type="text" class="input"></div>
                <div class="col-xl-1 font_12">携帯電話番号</div>
                <div class="col-xl-2"><input type="text" class="input"></div>
                <div class="col-xl-1"></div>
                <div class="col-xl-5">
                    <label for="radio10"><input type="radio" value="代金引換" name="payment1" id="radio10"> 代金引換</label>
                    <label for="radio11"><input type="radio" value="請求書不要" name="payment1" id="radio11"> 請求書不要</label>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-1">作業地</div>
                <div class="col-xl-3"><input type="text" class="input"></div>
                <div class="col-xl-1">邸名</div>
                <div class="col-xl-2"><input type="text" class="input"></div>
            </div>
        </div>
        <div class="table-control">
            <div class="sidebar-table">
                <div class="tr-head"></div>
                <div class="tr">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                        <g>
                            <title></title>
                            <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                            <path stroke-width="0" d="M11.143 5.571c-1.789 0-3.32.636-4.592 1.908-1.272 1.272-1.908 2.803-1.908 4.592 0 1.789.636 3.32 1.908 4.592 1.272 1.272 2.803 1.908 4.592 1.908 1.789 0 3.32-.636 4.592-1.908 1.272-1.272 1.908-2.803 1.908-4.592 0-1.789-.636-3.32-1.908-4.592-1.272-1.272-2.803-1.908-4.592-1.908zm0-3.714c1.383 0 2.706.268 3.968.805s2.35 1.262 3.265 2.176c.914.914 1.64 2.002 2.176 3.265.537 1.262.805 2.585.805 3.968 0 2.128-.6 4.058-1.799 5.789l4.977 4.977c.358.358.537.793.537 1.306 0 .503-.184.938-.551 1.306-.368.368-.803.551-1.306.551-.522 0-.958-.184-1.306-.551l-4.977-4.962c-1.731 1.199-3.661 1.799-5.789 1.799-1.383 0-2.706-.268-3.968-.805s-2.35-1.262-3.265-2.176c-.914-.914-1.64-2.002-2.176-3.265-.537-1.262-.805-2.585-.805-3.968s.268-2.706.805-3.968 1.262-2.35 2.176-3.265c.914-.914 2.002-1.64 3.265-2.176 1.262-.537 2.585-.805 3.968-.805z" style="opacity: 1;"></path>
                        </g>
                    </svg>
                </div>
            </div>
            <table>
                <thead>
                <tr>
                    <th style="width: 50px;">項番</th>
                    <th style="width: 100px;">カテゴリー</th>
                    <th style="width: 241px;">サービス品</th>
                    <th style="width: 166px;">内容</th>
                    <th style="width: 50px;">数量</th>
                    <th style="width: 50px;">単位</th>
                    <th style="width: 120px;">単価</th>
                    <th style="width: 90px;">金額</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>ﾊｳｽｸﾘｰﾆﾝｸﾞ</td>
                    <td>エアコン　自動掃除機能有り</td>
                    <td></td>
                    <td>1</td>
                    <td>台</td>
                    <td>999,999</td>
                    <td>999,999</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>ﾊｳｽｸﾘｰﾆﾝｸﾞ</td>
                    <td>エアコン　ロボ有り2台目</td>
                    <td></td>
                    <td>1</td>
                    <td>台</td>
                    <td>999,999</td>
                    <td>999,999</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>ﾊｳｽｸﾘｰﾆﾝｸﾞ</td>
                    <td>エアコン　自動掃除機能無し</td>
                    <td></td>
                    <td>1</td>
                    <td>台</td>
                    <td>999,999</td>
                    <td>999,999</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>ﾊｳｽｸﾘｰﾆﾝｸﾞ</td>
                    <td>エアコン　ロボ無し2台目</td>
                    <td></td>
                    <td>1</td>
                    <td>台</td>
                    <td>999,999</td>
                    <td>999,999</td>
                </tr>


                </tbody>
            </table>
        </div>
        <div class="attack">
            <div class="row"><div class="col-xl-6">※連絡事項</div></div>
            <div class="row">
                <div class="col-xl-6">
                    <textarea name="" id="" cols="30" rows="5" class="input"></textarea>
                </div>
                <div class="col-xl-6 stock">
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2">発注金額</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input" value="999,999">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">消費税</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input" value="999,999">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">発注合計</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input" value="999,999">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8"></div>
                        <div class="col-xl-4 col-lg-4 col-md-4" >
                            <label for="" class="float-right color_red"><input type="checkbox"> 確認しました</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8"></div>
                        <div class="col-xl-4 col-lg-4 col-md-4" >
                            <a href="" class="abt return float-right">e-暮らしへ戻し</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="attack">
            <div class="row">
                <div class="col-xl-2">備考
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                        <g>
                            <title></title>
                            <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                            <path stroke-width="0" d="M8.343 1.915c1.528 0 2.849.547 3.961 1.64l8.778 8.792c.097.097.145.203.145.319 0 .155-.148.38-.443.675-.295.295-.52.443-.675.443-.126 0-.237-.048-.334-.145l-8.792-8.807c-.764-.745-1.64-1.117-2.626-1.117-1.025 0-1.891.363-2.597 1.088-.706.725-1.059 1.601-1.059 2.626 0 1.016.368 1.891 1.103 2.626l11.259 11.273c.609.609 1.311.914 2.104.914.619 0 1.132-.203 1.538-.609.406-.406.609-.919.609-1.538 0-.793-.305-1.494-.914-2.104l-8.43-8.43c-.251-.232-.542-.348-.871-.348-.281 0-.513.092-.696.276-.184.184-.276.416-.276.696 0 .31.121.595.363.856l5.949 5.949c.097.097.145.203.145.319 0 .155-.15.382-.45.682-.3.3-.527.45-.682.45-.116 0-.222-.048-.319-.145l-5.949-5.949c-.609-.59-.914-1.311-.914-2.162 0-.793.276-1.465.827-2.017.551-.551 1.224-.827 2.017-.827.851 0 1.572.305 2.162.914l8.43 8.43c.967.948 1.451 2.084 1.451 3.41 0 1.132-.382 2.08-1.146 2.844-.764.764-1.712 1.146-2.844 1.146-1.306 0-2.442-.484-3.41-1.451l-11.273-11.259c-1.093-1.112-1.64-2.423-1.64-3.932 0-1.538.532-2.844 1.596-3.917 1.064-1.074 2.365-1.61 3.903-1.61z" style="opacity: 1;"></path>
                        </g>
                    </svg>
                </div>
                <div class="col-xl-3">
                    <div class="row">
                        <svg class="icon-file" xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M15.438 5.23v2.082h2.082l-2.082-2.082zm-9.75-1.168v17.875h13v-13h-4.8759999999999994v-4.8759999999999994h-8.125zm-1.625-1.625h10.893l.254.229 4.875 4.875.229.254v15.768h-16.251v-21.125999999999998z"></path>
                            </g>
                        </svg>
                        ああああああああ.pdf
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="row">
                        <label for="" class="color_red"><input type="checkbox"> 確認しました</label>
                    </div>
                    <div class="row">
                        <label for="" class="color_red"><input type="checkbox"> 確認しました</label>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="row">
                        <svg class="margin-left-25" xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M6.5 18.571v3.714h13v-3.714h-13zm15.786-5.571c-.251 0-.469.092-.653.276-.184.184-.276.401-.276.653 0 .251.092.469.276.653.184.184.401.276.653.276.251 0 .469-.092.653-.276.184-.184.276-.401.276-.653 0-.251-.092-.469-.276-.653-.184-.184-.401-.276-.653-.276zm-15.786-9.286v9.286h13v-5.571h-2.321c-.387 0-.716-.135-.987-.406s-.406-.6-.406-.987v-2.321h-9.286zm-.464-1.857h9.75c.387 0 .812.097 1.277.29.464.193.832.426 1.103.696l2.205 2.205c.271.271.503.638.696 1.103.193.464.29.89.29 1.277v3.714h.929c.764 0 1.419.273 1.966.82.547.547.82 1.202.82 1.966v6.036c0 .126-.046.235-.138.326-.092.092-.201.138-.326.138h-3.25v2.321c0 .387-.135.716-.406.987s-.6.406-.987.406h-13.929c-.387 0-.716-.135-.987-.406s-.406-.6-.406-.987v-2.321h-3.25c-.126 0-.235-.046-.326-.138-.092-.092-.138-.201-.138-.326v-6.036c0-.764.273-1.419.82-1.966.547-.547 1.202-.82 1.966-.82h.929v-7.893c0-.387.135-.716.406-.987s.6-.406.987-.406z" style="opacity: 1;"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="row">
                        <label for="" class="color_red"><input type="checkbox"> 印刷しました</label>
                    </div>
                </div>
                <div class="col-xl-3">
                    <a href="" class="abt register">確認登録</a>
                    <a href="" class="abt cancel">キャンセル</a>
                </div>
            </div>

        </div>
    </div>
</div>
