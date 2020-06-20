<?php

use Cake\Routing\Router;

?>
<div class="page page_register register_master" id="master">
    <div class="navi">
        <div class="go_back">
            <a href="<?= Router::url('/pages/master_maintenance'); ?>">
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
        <h1 class="title">仕入先マスタ保守登録</h1>
    </div>
    <div class="content">
        <div class="info">
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">
                        仕入先コード
                    </div>
                    <div class="col-xl-3">
                        <input type="text" class="input">
                    </div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">最終更新日</div>
                    <div class="col-xl-8">
                        <input type="text" class="date year" placeholder="<?= date('Y') ?>">
                        <span>／</span>
                        <input type="text" class="date month" placeholder="<?= date('m') ?>">
                        <span>／</span>
                        <input type="text" class="date day" placeholder="<?= date('d') ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">
                        <span>仕入先名1</span>
                    </div>
                    <div class="col-xl-8">
                        <input type="text" class="input">
                    </div>
                    <div class="col-xl-2">
                        <a href="" class="abt search">仕入先検索</a>
                    </div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">カテゴリー</div>
                    <div class="col-xl-8">
                        <label class="select w_100">
                            <select name="" class="input" id="">
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
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">仕入先名2</div>
                    <div class="col-xl-8"><input type="text" class="input"></div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">支払先区分</div>
                    <div class="col-xl-8">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value="">0 通常</option>
                                <option value="">1 その他</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">略称</div>
                    <div class="col-xl-8"><input type="text" class="input"></div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">担当者名</div>
                    <div class="col-xl-8">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value="">999999 代表</option>
                                <option value="">1 中野</option>
                                <option value="">3 瀬戸</option>
                                <option value="">6 兼山</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">索引</div>
                    <div class="col-xl-8"><input type="text" class="input"></div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">単価設定区分</div>
                    <div class="col-xl-8">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value="">0 商品設定</option>
                                <option value="">1 税抜き</option>
                                <option value="">2 税込</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">郵便番号</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
                    <div class="col-xl-2">都道府県</div>
                    <div class="col-xl-3">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value="">愛知県</option>
                                <option value="">東京都</option>
                                <option value="">大阪府</option>
                                <option value="">京都府</option>
                                <option value="">広島県</option>
                                <option value="">福岡県</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">市区町村番地</div>
                    <div class="col-xl-8"><input type="text" class="input"></div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-5">相手先担当者名</div>
                    <div class="col-xl-7"><input type="text" class="input"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">ビル名等</div>
                    <div class="col-xl-8"><input type="text" class="input"></div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-5">担当者ﾒｰﾙｱﾄﾞﾚｽ</div>
                    <div class="col-xl-7"><input type="text" class="input"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">TEL番号</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
                    <div class="col-xl-2">FAX番号</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">通知送信設定</div>
                    <div class="col-xl-8">
                        <label for="checkbox1"><input type="checkbox" id="checkbox1"> 送信する</label>
                        <label for="checkbox2"><input type="checkbox" id="checkbox2"> 送信しない</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-control">
            <div class="title">検索結果一覧</div>
            <table>
                <thead>
                <tr>
                    <th>仕入先コード</th>
                    <th>仕入先名1</th>
                    <th>仕入先名2</th>
                    <th>略称</th>
                    <th>郵便番号</th>
                    <th>都道府県名</th>
                    <th>市区町村番地</th>
                    <th>分類名</th>
                    <th>カテゴリー</th>
                    <th>ビル名等</th>
                </tr>
                </thead>
                <tbody>
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
                </tr>
                </tbody>
            </table>
        </div>
        <div class="attack">
            <div class="row">
                <div class="col-xl-2">特記・備考</div>
                <div class="col-xl-7">
                    <textarea name="" id="" cols="30" rows="3" class="input"></textarea>
                </div>
            </div>
        </div>
        <div class="attack">
            <div class="row">
                <div class="col-xl-1">添付</div>
                <div class="col-xl-5">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none"
                         viewBox="0 0 26 26">
                        <g>
                            <title></title>
                            <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0"
                                  fill="transparent"></rect>
                            <path stroke-width="0"
                                  d="M8.343 1.915c1.528 0 2.849.547 3.961 1.64l8.778 8.792c.097.097.145.203.145.319 0 .155-.148.38-.443.675-.295.295-.52.443-.675.443-.126 0-.237-.048-.334-.145l-8.792-8.807c-.764-.745-1.64-1.117-2.626-1.117-1.025 0-1.891.363-2.597 1.088-.706.725-1.059 1.601-1.059 2.626 0 1.016.368 1.891 1.103 2.626l11.259 11.273c.609.609 1.311.914 2.104.914.619 0 1.132-.203 1.538-.609.406-.406.609-.919.609-1.538 0-.793-.305-1.494-.914-2.104l-8.43-8.43c-.251-.232-.542-.348-.871-.348-.281 0-.513.092-.696.276-.184.184-.276.416-.276.696 0 .31.121.595.363.856l5.949 5.949c.097.097.145.203.145.319 0 .155-.15.382-.45.682-.3.3-.527.45-.682.45-.116 0-.222-.048-.319-.145l-5.949-5.949c-.609-.59-.914-1.311-.914-2.162 0-.793.276-1.465.827-2.017.551-.551 1.224-.827 2.017-.827.851 0 1.572.305 2.162.914l8.43 8.43c.967.948 1.451 2.084 1.451 3.41 0 1.132-.382 2.08-1.146 2.844-.764.764-1.712 1.146-2.844 1.146-1.306 0-2.442-.484-3.41-1.451l-11.273-11.259c-1.093-1.112-1.64-2.423-1.64-3.932 0-1.538.532-2.844 1.596-3.917 1.064-1.074 2.365-1.61 3.903-1.61z"
                                  style="opacity: 1;"></path>
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
