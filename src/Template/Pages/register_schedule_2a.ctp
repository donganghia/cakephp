<?php

use Cake\Routing\Router;

?>
<div class="page page_register register_schedule_2a" id="register">
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
        <h1 class="title">予定データ登録</h1>
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
                    <div class="title">処理状況</div>
                    <label for="radio1"><input type="radio" value="依頼受" name="processing" id="radio1" checked> 依頼受</label>
                    <label for="radio2"><input type="radio" value="見積中" name="processing" id="radio2"> 見積中</label>
                    <label for="radio3"><input type="radio" value="見積提出済" name="processing" id="radio3"> 見積提出済</label>
                    <label for="radio4"><input type="radio" value="その他" name="processing" id="radio4"> その他</label>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-9">
                    <div class="col-xl-2">
                        案件No.
                    </div>
                    <div class="col-xl-3">
                        <input type="text" class="input" placeholder="EK20181036">
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
                        <input type="text" class="input" placeholder="テスト">
                    </div>
                    <div class="col-xl-4">
                        <input type="text" class="input" placeholder="〒460-0001　愛知県　">
                    </div>
                    <div class="col-xl-3">
                        <a href="<?= Router::url('/pages/customer_search'); ?>" class="abt search">得意先検索</a>
                    </div>
                </div>
                <div class="col-xl-3">
                    <lable>納期</lable>
                    <input type="text" class="date year" placeholder="<?= date('Y') ?>">
                    <span>／</span>
                    <input type="text" class="date month" placeholder="<?= date('m') ?>">
                    <span>／</span>
                    <input type="text" class="date day" placeholder="<?= date('d') ?>">
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-9">
                    <div class="col-xl-2"></div>
                    <div class="col-xl-3"></div>
                    <div class="col-xl-4">
                        <input type="text" class="input" placeholder="名古屋市中区三の丸０－０－０">
                    </div>
                    <div class="col-xl-3">
                        <a href="" class="abt search">得意先検索</a>
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
                    <div class="col-xl-3"><input type="text" class="input" placeholder="テスト"></div>
                    <div class="col-xl-4"><input type="text" class="input" placeholder="〒460-0001 愛知県名古屋市中区三の丸０－０－０"></div>
                    <div class="col-xl-3">
                        <label for=""><input type="checkbox" checked> 申込者と同一</label>
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
        <div class="title">商品リスト</div>
        <div class="table-control">
            <table>
                <thead>
                <tr>
                    <th style="width: 50px;">操作</th>
                    <th style="width: 50px;">項番</th>
                    <th style="width: 100px;">商品コード</th>
                    <th style="width: 220px;">商品名</th>
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
                                <path stroke-width="0" d="M 18.04 4.04 L 18.04 3.6113 C 18.04 1.6201 16.4521 0 14.5 0 L 11.5 0 C 9.5479 0 7.96 1.6201 7.96 3.6113 L 7.96 4.04 L 4 4.04 C 3.4487 4.04 3 4.4888 3 5.04 L 3 6.04 L 2 6.04 L 2 8.04 L 4 8.04 L 4 23.04 C 4 24.6943 5.3457 26.04 7 26.04 L 19 26.04 C 20.6543 26.04 22 24.6943 22 23.04 L 22 8.04 L 24 8.04 L 24 6.04 L 23 6.04 L 23 5.04 C 23 4.4888 22.5513 4.04 22 4.04 L 18.04 4.04 ZM 14.5 8.0801 C 14.6793 8.0801 14.8578 8.0664 15.03 8.04 L 20 8.04 L 20 23.04 C 20 23.5913 19.5513 24.04 19 24.04 L 7 24.04 C 6.4487 24.04 6 23.5913 6 23.04 L 6 8.04 L 10.97 8.04 C 11.1422 8.0664 11.3207 8.0801 11.5 8.0801 L 14.5 8.0801 ZM 11.5 2.0801 L 14.5 2.0801 C 15.3052 2.0801 15.96 2.7671 15.96 3.6113 L 15.96 4.04 L 10.04 4.04 L 10.04 3.6113 C 10.04 2.7671 10.6948 2.0801 11.5 2.0801 ZM 10 22.04 L 10 10.04 L 8 10.04 L 8 22.04 L 10 22.04 ZM 14 22.04 L 14 10.04 L 12 10.04 L 12 22.04 L 14 22.04 ZM 18 22.04 L 18 10.04 L 16 10.04 L 16 22.04 L 18 22.04 Z" style="stroke: rgb(192, 80, 77); fill: rgb(192, 80, 77); opacity: 1;"></path>
                            </g>
                        </svg>
                    </td>
                    <td>01</td>
                    <td>A0000017</td>
                    <td>エアコン　自動掃除機能有り</td>
                    <td></td>
                    <td>式</td>
                    <td>1</td>
                    <td>14,000</td>
                    <td>14,000</td>
                    <td>16,000</td>
                    <td>16,000</td>
                </tr>
                <tr>
                    <td class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M 18.04 4.04 L 18.04 3.6113 C 18.04 1.6201 16.4521 0 14.5 0 L 11.5 0 C 9.5479 0 7.96 1.6201 7.96 3.6113 L 7.96 4.04 L 4 4.04 C 3.4487 4.04 3 4.4888 3 5.04 L 3 6.04 L 2 6.04 L 2 8.04 L 4 8.04 L 4 23.04 C 4 24.6943 5.3457 26.04 7 26.04 L 19 26.04 C 20.6543 26.04 22 24.6943 22 23.04 L 22 8.04 L 24 8.04 L 24 6.04 L 23 6.04 L 23 5.04 C 23 4.4888 22.5513 4.04 22 4.04 L 18.04 4.04 ZM 14.5 8.0801 C 14.6793 8.0801 14.8578 8.0664 15.03 8.04 L 20 8.04 L 20 23.04 C 20 23.5913 19.5513 24.04 19 24.04 L 7 24.04 C 6.4487 24.04 6 23.5913 6 23.04 L 6 8.04 L 10.97 8.04 C 11.1422 8.0664 11.3207 8.0801 11.5 8.0801 L 14.5 8.0801 ZM 11.5 2.0801 L 14.5 2.0801 C 15.3052 2.0801 15.96 2.7671 15.96 3.6113 L 15.96 4.04 L 10.04 4.04 L 10.04 3.6113 C 10.04 2.7671 10.6948 2.0801 11.5 2.0801 ZM 10 22.04 L 10 10.04 L 8 10.04 L 8 22.04 L 10 22.04 ZM 14 22.04 L 14 10.04 L 12 10.04 L 12 22.04 L 14 22.04 ZM 18 22.04 L 18 10.04 L 16 10.04 L 16 22.04 L 18 22.04 Z" style="stroke: rgb(192, 80, 77); fill: rgb(192, 80, 77); opacity: 1;"></path>
                            </g>
                        </svg>
                    </td>
                    <td>02</td>
                    <td>A0000018</td>
                    <td>エアコン　自動掃除機能無し</td>
                    <td></td>
                    <td>式</td>
                    <td>1</td>
                    <td>9,000</td>
                    <td>9,000</td>
                    <td>12,000</td>
                    <td>12,000</td>
                </tr>
                <tr>
                    <td class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M 18.04 4.04 L 18.04 3.6113 C 18.04 1.6201 16.4521 0 14.5 0 L 11.5 0 C 9.5479 0 7.96 1.6201 7.96 3.6113 L 7.96 4.04 L 4 4.04 C 3.4487 4.04 3 4.4888 3 5.04 L 3 6.04 L 2 6.04 L 2 8.04 L 4 8.04 L 4 23.04 C 4 24.6943 5.3457 26.04 7 26.04 L 19 26.04 C 20.6543 26.04 22 24.6943 22 23.04 L 22 8.04 L 24 8.04 L 24 6.04 L 23 6.04 L 23 5.04 C 23 4.4888 22.5513 4.04 22 4.04 L 18.04 4.04 ZM 14.5 8.0801 C 14.6793 8.0801 14.8578 8.0664 15.03 8.04 L 20 8.04 L 20 23.04 C 20 23.5913 19.5513 24.04 19 24.04 L 7 24.04 C 6.4487 24.04 6 23.5913 6 23.04 L 6 8.04 L 10.97 8.04 C 11.1422 8.0664 11.3207 8.0801 11.5 8.0801 L 14.5 8.0801 ZM 11.5 2.0801 L 14.5 2.0801 C 15.3052 2.0801 15.96 2.7671 15.96 3.6113 L 15.96 4.04 L 10.04 4.04 L 10.04 3.6113 C 10.04 2.7671 10.6948 2.0801 11.5 2.0801 ZM 10 22.04 L 10 10.04 L 8 10.04 L 8 22.04 L 10 22.04 ZM 14 22.04 L 14 10.04 L 12 10.04 L 12 22.04 L 14 22.04 ZM 18 22.04 L 18 10.04 L 16 10.04 L 16 22.04 L 18 22.04 Z" style="stroke: rgb(192, 80, 77); fill: rgb(192, 80, 77); opacity: 1;"></path>
                            </g>
                        </svg>
                    </td>
                    <td>03</td>
                    <td>A0000019</td>
                    <td>エアコン　ロボ有り2台目</td>
                    <td></td>
                    <td>式</td>
                    <td>1</td>
                    <td>14,000</td>
                    <td>14,000</td>
                    <td>16,000</td>
                    <td>16,000</td>
                </tr>
                <tr>
                    <td class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M 18.04 4.04 L 18.04 3.6113 C 18.04 1.6201 16.4521 0 14.5 0 L 11.5 0 C 9.5479 0 7.96 1.6201 7.96 3.6113 L 7.96 4.04 L 4 4.04 C 3.4487 4.04 3 4.4888 3 5.04 L 3 6.04 L 2 6.04 L 2 8.04 L 4 8.04 L 4 23.04 C 4 24.6943 5.3457 26.04 7 26.04 L 19 26.04 C 20.6543 26.04 22 24.6943 22 23.04 L 22 8.04 L 24 8.04 L 24 6.04 L 23 6.04 L 23 5.04 C 23 4.4888 22.5513 4.04 22 4.04 L 18.04 4.04 ZM 14.5 8.0801 C 14.6793 8.0801 14.8578 8.0664 15.03 8.04 L 20 8.04 L 20 23.04 C 20 23.5913 19.5513 24.04 19 24.04 L 7 24.04 C 6.4487 24.04 6 23.5913 6 23.04 L 6 8.04 L 10.97 8.04 C 11.1422 8.0664 11.3207 8.0801 11.5 8.0801 L 14.5 8.0801 ZM 11.5 2.0801 L 14.5 2.0801 C 15.3052 2.0801 15.96 2.7671 15.96 3.6113 L 15.96 4.04 L 10.04 4.04 L 10.04 3.6113 C 10.04 2.7671 10.6948 2.0801 11.5 2.0801 ZM 10 22.04 L 10 10.04 L 8 10.04 L 8 22.04 L 10 22.04 ZM 14 22.04 L 14 10.04 L 12 10.04 L 12 22.04 L 14 22.04 ZM 18 22.04 L 18 10.04 L 16 10.04 L 16 22.04 L 18 22.04 Z" style="stroke: rgb(192, 80, 77); fill: rgb(192, 80, 77); opacity: 1;"></path>
                            </g>
                        </svg>
                    </td>
                    <td>04</td>
                    <td>A0000020</td>
                    <td>エアコン　ロボ有り2台目</td>
                    <td></td>
                    <td>式</td>
                    <td>1</td>
                    <td>9,000</td>
                    <td>9,000</td>
                    <td>12,000</td>
                    <td>12,000</td>
                </tr>
                <tr>
                    <td class="text-center"><a href="" class="abt">追加</a></td>
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
                            <input type="text" class="input" placeholder="46,000">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">消費税</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input" placeholder="3,680">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">発注合計</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input" placeholder="49,680">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2">受注金額</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input"placeholder="56,000">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">消費税</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input" placeholder="4,480">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2">受注合計</div>
                        <div class="col-xl-2 col-lg-2 col-md-2">
                            <input type="text" class="input" placeholder="60,480">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="attack">
            <div class="row">
                <div class="col-xl-1">備考</div>
                <div class="col-xl-5">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                        <g>
                            <title></title>
                            <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                            <path stroke-width="0" d="M8.343 1.915c1.528 0 2.849.547 3.961 1.64l8.778 8.792c.097.097.145.203.145.319 0 .155-.148.38-.443.675-.295.295-.52.443-.675.443-.126 0-.237-.048-.334-.145l-8.792-8.807c-.764-.745-1.64-1.117-2.626-1.117-1.025 0-1.891.363-2.597 1.088-.706.725-1.059 1.601-1.059 2.626 0 1.016.368 1.891 1.103 2.626l11.259 11.273c.609.609 1.311.914 2.104.914.619 0 1.132-.203 1.538-.609.406-.406.609-.919.609-1.538 0-.793-.305-1.494-.914-2.104l-8.43-8.43c-.251-.232-.542-.348-.871-.348-.281 0-.513.092-.696.276-.184.184-.276.416-.276.696 0 .31.121.595.363.856l5.949 5.949c.097.097.145.203.145.319 0 .155-.15.382-.45.682-.3.3-.527.45-.682.45-.116 0-.222-.048-.319-.145l-5.949-5.949c-.609-.59-.914-1.311-.914-2.162 0-.793.276-1.465.827-2.017.551-.551 1.224-.827 2.017-.827.851 0 1.572.305 2.162.914l8.43 8.43c.967.948 1.451 2.084 1.451 3.41 0 1.132-.382 2.08-1.146 2.844-.764.764-1.712 1.146-2.844 1.146-1.306 0-2.442-.484-3.41-1.451l-11.273-11.259c-1.093-1.112-1.64-2.423-1.64-3.932 0-1.538.532-2.844 1.596-3.917 1.064-1.074 2.365-1.61 3.903-1.61z" style="opacity: 1;"></path>
                        </g>
                    </svg>
                </div>
                <div class="col-xl-6">
                    <a href="" class="abt register">登録</a>
                    <a href="" class="abt cancel">キャンセル</a>
                </div>
            </div>
        </div>
    </div>
</div>
