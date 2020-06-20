<?php

use Cake\Routing\Router;

?>
<div class="page page_register register_confirm" id="register">
    <div class="navi">
        <div class="go_back">
            <a href="<?= Router::url('/pages/menu_order'); ?>">
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
        <h1 class="title">確定データ登録</h1>
        <div class="date_schedule clearfix">
            <input type="text" class="date year" placeholder="<?= date('Y') ?>">
            <span>／</span>
            <input type="text" class="date month" placeholder="<?= date('m') ?>">
            <span>／</span>
            <input type="text" class="date day" placeholder="<?= date('d') ?>">
            <span class="t_rate">税率</span>
            <input type="text" class="rate" placeholder="8">
            <span>%</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="content">
        <div class="info">
            <div class="row">
                <div class="situation col-sm-12 col-lg-12">
                    <div class="title">登録種別</div>
                    <label for="radio1"><input type="radio" value="全確定済" name="processing" id="radio1" > 全確定済</label>
                    <label for="radio2"><input type="radio" value="予定日確認要" name="processing" id="radio2" > 予定日確認要</label>
                    <label for="radio3"><input type="radio" value="予定日確認不要" name="processing" id="radio3"> 予定日確認不要</label>
                    <label for="radio4"><input type="radio" value="その他確認要" name="processing" id="radio4"> その他確認要</label>
                    <label for="radio4"><input type="radio" value="予定データから選択" name="processing" id="radio4" checked> 予定データから選択</label>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-9">
                    <div class="col-xl-2">
                        案件No.
                    </div>
                    <div class="col-xl-3">
                        <input type="text" class="input" placeholder="">
                    </div>
                </div>
                <div class="col-xl-3">
                    <lable>取引</lable>
                    <label for="radio5"><input type="radio" value="売掛" name="transaction" id="radio5" checked> 売掛</label>
                    <label for="radio6"><input type="radio" value="現金" name="transaction" id="radio6"> 現金</label>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-9">
                    <div class="col-xl-2">
                        得意先
                    </div>
                    <div class="col-xl-3">
                        <input type="text" class="input" placeholder="">
                    </div>
                    <div class="col-xl-4">
                        <input type="text" class="input" placeholder="">
                    </div>
                    <div class="col-xl-3">
                        <a href="<?= Router::url('/pages/custom_master_detail '); ?>" class="abt search">顧客検索</a>
                    </div>
                </div>
                <div class="col-xl-3">
                    <lable>納期</lable>
                    <input type="text" class="date year" placeholder="<?= date('Y') ?>">
                    <span>／</span>
                    <input type="text" class="date month" placeholder="">
                    <span>／</span>
                    <input type="text" class="date day" placeholder="">
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-9">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-3"></div>
                    <div class="col-xl-4">
                        <input type="text" class="input">
                    </div>
                    <div class="col-xl-3">
                        <a href="" class="abt search">顧客検索</a>
                    </div>
                </div>
                <div class="col-xl-3">
                    <lable>オーダーNo.</lable>
                    <input type="text" class="order_id">
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-9">
                    <div class="col-xl-2">納品先</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
                    <div class="col-xl-4"><input type="text" class="input"></div>
                    <div class="col-xl-3">
                        <label for=""><input type="checkbox"> 申込者と同一</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-9">
                    <div class="col-xl-2">訪問時間</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
                    <div class="col-xl-2 align-middle">時間</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-12">
                    <div class="col-xl-1">支払方法</div>
                    <div class="col-xl-2">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
                                <option value="">1 銀行振込</option>
                                <option value="">2 コンビニ振込</option>
                                <option value="">3 クレジット</option>
                                <option value="">4 口座振替</option>
                                <option value="">5 代金引換</option>
                                <option value="">6 請求書不要</option>
                            </select>
                        </label>
                    </div>
                    <div class="col-xl-1 align-middle">源泉</div>
                    <div class="col-xl-2">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
                                <option value="">0001 積水ﾊｳｽﾘﾌｫｰﾑｸﾞﾙｰﾌﾟ</option>
                                <option value="">0002 日立ｺﾝｼｭｰﾏﾏｰｹﾃｨﾝｸﾞ</option>
                                <option value="">0003 中電OB関係</option>
                                <option value="">0004 販売代理店関係</option>
                                <option value="">0005 カテエネ関係</option>
                                <option value="">0006 Webサイト経由</option>
                                <option value="">0007 SHオーナー</option>
                                <option value="">0008 検針ﾁﾗｼ・検針票など</option>
                                <option value="">0009 SHグループ関係</option>
                                <option value="">0010 中部電力関係</option>
                                <option value="">0011 マスコミ関係</option>
                                <option value="">0012 積水ハウス</option>
                                <option value="">0013 大和ハウス</option>
                                <option value="">0014 JAあいち経済連</option>
                                <option value="">0015 ZTVからの受注</option>
                                <option value="">0016 中部電力グループ関係</option>
                                <option value="">0017 SH社員　紹介関係</option>
                                <option value="">0018 ドミー</option>
                            </select>
                        </label>
                    </div>
                    <div class="col-xl-1 align-middle">部門</div>
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
                    <div class="col-xl-1 align-middle">科目</div>
                    <div class="col-xl-2">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
                                <option value="">03400001 中部電力（ビジエネ）</option>
                                <option value="">03400002 中部電力（カテエネ）</option>
                                <option value="">03400003 空調クリーニング</option>
                                <option value="">03400004 オフィスクリーニング</option>
                                <option value="">03400005 三交不動産</option>
                                <option value="">03400006 ぐるなびセミナー</option>
                                <option value="">03400007 中電オートリース</option>
                                <option value="">03400008 岐阜市地球温暖化対策</option>
                                <option value="">03400009 サンヨーホームズ関係</option>
                                <option value="">03400010 中部電力（ガス関係）</option>
                                <option value="">05009999 その他</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>

        </div>
        <div class="table-control">
            <table>
                <thead>
                <tr>
                    <th style="width: 50px;">操作</th>
                    <th style="width: 50px;">項番</th>
                    <th style="width: 100px;">商品コード</th>
                    <th style="width: 196px;">商品名</th>
                    <th style="width: 174px;">内容</th>
                    <th style="width: 50px;">単位</th>
                    <th style="width: 50px;">数量</th>
                    <th style="width: 110px;">発注単価</th>
                    <th style="width: 110px;">発注金額</th>
                    <th style="width: 110px;">受注単価</th>
                    <th style="width: 110px;">受注金額</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M 10 17.9971 C 5.5825 17.9971 2.0024 14.4175 2.0024 10 C 2.0024 5.5825 5.5825 2.0029 10 2.0029 C 14.4175 2.0029 17.9976 5.5825 17.9976 10 C 17.9976 14.4175 14.4175 17.9971 10 17.9971 ZM 18.565 16.95 L 17.7 16.085 C 19.0234 14.4127 19.8125 12.2986 19.8125 10 C 19.8125 4.5801 15.4199 0.1875 10 0.1875 C 4.5801 0.1875 0.1875 4.5801 0.1875 10 C 0.1875 15.4199 4.5801 19.8125 10 19.8125 C 12.2983 19.8125 14.4125 19.023 16.085 17.7 L 16.95 18.565 C 16.5819 19.2558 16.6879 20.1317 17.2705 20.7139 L 21.8843 25.3291 C 22.5981 26.0425 23.7544 26.0425 24.4678 25.3291 L 25.3291 24.4683 C 26.042 23.7549 26.042 22.5981 25.3291 21.8848 L 20.7148 17.2695 C 20.1323 16.687 19.2561 16.5812 18.565 16.95 ZM 12.0122 14.8579 C 8.0972 14.8579 4.9229 11.6841 4.9229 7.7686 C 4.9229 7.6641 4.9336 7.563 4.9385 7.459 C 4.4219 8.2954 4.1182 9.2783 4.1182 10.3325 C 4.1182 13.3599 6.5718 15.813 9.5986 15.813 C 10.7671 15.813 11.8477 15.4443 12.7383 14.8213 C 12.4995 14.8452 12.2568 14.8579 12.0122 14.8579 Z" style="opacity: 1;"></path>
                            </g>
                        </svg>
                    </td>
                    <td>ー</td>
                    <td><input type="text" class="input"></td>
                    <td><input type="text" class="input "></td>
                    <td><input type="text" class="input"></td>
                    <td>ー</td>
                    <td>ー</td>
                    <td>ー</td>
                    <td>ー</td>
                    <td>ー</td>
                    <td>ー</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="attack">
            <div class="row">
                <div class="col-xl-1">備考</div>
                <div class="col-xl-5">
                    <textarea name="" id="" cols="30" rows="5" class="input"></textarea>
                </div>
                <div class="col-xl-6 stock">
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2">現在庫数</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2">発注金額</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">消費税</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">発注合計</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2">受注金額</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input" value="">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">消費税</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input" value="">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">受注合計</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="attack">
            <div class="row">
                <div class="col-xl-1">備考</div>
                <div class="col-xl-5">
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                                <g>
                                    <title></title>
                                    <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>

                                    <path stroke-width="0" d="M8.343 1.915c1.528 0 2.849.547 3.961 1.64l8.778 8.792c.097.097.145.203.145.319 0 .155-.148.38-.443.675-.295.295-.52.443-.675.443-.126 0-.237-.048-.334-.145l-8.792-8.807c-.764-.745-1.64-1.117-2.626-1.117-1.025 0-1.891.363-2.597 1.088-.706.725-1.059 1.601-1.059 2.626 0 1.016.368 1.891 1.103 2.626l11.259 11.273c.609.609 1.311.914 2.104.914.619 0 1.132-.203 1.538-.609.406-.406.609-.919.609-1.538 0-.793-.305-1.494-.914-2.104l-8.43-8.43c-.251-.232-.542-.348-.871-.348-.281 0-.513.092-.696.276-.184.184-.276.416-.276.696 0 .31.121.595.363.856l5.949 5.949c.097.097.145.203.145.319 0 .155-.15.382-.45.682-.3.3-.527.45-.682.45-.116 0-.222-.048-.319-.145l-5.949-5.949c-.609-.59-.914-1.311-.914-2.162 0-.793.276-1.465.827-2.017.551-.551 1.224-.827 2.017-.827.851 0 1.572.305 2.162.914l8.43 8.43c.967.948 1.451 2.084 1.451 3.41 0 1.132-.382 2.08-1.146 2.844-.764.764-1.712 1.146-2.844 1.146-1.306 0-2.442-.484-3.41-1.451l-11.273-11.259c-1.093-1.112-1.64-2.423-1.64-3.932 0-1.538.532-2.844 1.596-3.917 1.064-1.074 2.365-1.61 3.903-1.61z" style="opacity: 1;"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">

                        </div>
                    </div>

                </div>
                <div class="col-xl-6">
                    <a href="<?= Router::url('/pages/confirm'); ?>" class="abt register">登録</a>
                    <a href="" class="abt cancel">キャンセル</a>
                    <a href="" class="btn_icon save">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M 10.0391 1 L 15.9922 1 L 21 1 C 21.5498 1 22 1.4492 22 2.001 L 22 12.0005 C 22 12.5508 21.5498 13 21 13 L 4.9995 13 C 4.4492 13 4 12.5508 4 12.0005 L 4 7.0752 L 4 2.001 C 4 1.4492 4.4492 1 4.9995 1 L 10.0391 1 ZM 4.2593 25.8613 C 5.8848 25.8613 21.4795 25.8613 21.4795 25.8613 C 23.1348 25.8613 25 24.0869 25 22.4316 L 25 3.0005 C 25 1.3433 23.6563 0 21.999 0 L 16.9834 0 L 9.0479 0 L 4 0 C 2.3433 0 1 1.3433 1 3.0005 L 1 5.8613 L 1 9.9727 C 1 9.9727 1 21.7988 1 22.3408 C 1 24.7773 2.8149 25.8613 4.2593 25.8613 ZM 7 16.999 C 7 16.4492 7.4487 16 7.9995 16 L 19 16 C 19.5508 16 20 16.4492 20 16.999 L 20 23.999 C 20 24.5498 19.5508 25 19 25 L 7.9995 25 C 7.4487 25 7 24.5498 7 23.999 L 7 16.999 ZM 12 17 L 9 17 L 9 24 L 12 24 L 12 17 Z" style="opacity: 1;"></path>
                            </g>
                        </svg>
                    </a>
                    <a href="" class="btn_icon print">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M6.5 18.571v3.714h13v-3.714h-13zm15.786-5.571c-.251 0-.469.092-.653.276-.184.184-.276.401-.276.653 0 .251.092.469.276.653.184.184.401.276.653.276.251 0 .469-.092.653-.276.184-.184.276-.401.276-.653 0-.251-.092-.469-.276-.653-.184-.184-.401-.276-.653-.276zm-15.786-9.286v9.286h13v-5.571h-2.321c-.387 0-.716-.135-.987-.406s-.406-.6-.406-.987v-2.321h-9.286zm-.464-1.857h9.75c.387 0 .812.097 1.277.29.464.193.832.426 1.103.696l2.205 2.205c.271.271.503.638.696 1.103.193.464.29.89.29 1.277v3.714h.929c.764 0 1.419.273 1.966.82.547.547.82 1.202.82 1.966v6.036c0 .126-.046.235-.138.326-.092.092-.201.138-.326.138h-3.25v2.321c0 .387-.135.716-.406.987s-.6.406-.987.406h-13.929c-.387 0-.716-.135-.987-.406s-.406-.6-.406-.987v-2.321h-3.25c-.126 0-.235-.046-.326-.138-.092-.092-.138-.201-.138-.326v-6.036c0-.764.273-1.419.82-1.966.547-.547 1.202-.82 1.966-.82h.929v-7.893c0-.387.135-.716.406-.987s.6-.406.987-.406z" style="opacity: 1;"></path>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
