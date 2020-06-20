<?php

use Cake\Routing\Router;

?>
<div class="page page_register custom_master" id="detail">
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
        <h1 class="title">顧客詳細</h1>
        <div class="date_schedule clearfix">
            <span>最終更新日</span>
            <input type="text" class="date year" placeholder="<?= date('Y') ?>">
            <span>／</span>
            <input type="text" class="date month" placeholder="<?= date('m') ?>">
            <span>／</span>
            <input type="text" class="date day" placeholder="<?= date('d') ?>">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="content">
        <div class="info">
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">会員番号</div>
                    <div class="col-xl-3"><input type="text" class="input" placeholder="90901"></div>
                    <div class="col-xl-2">会員種類</div>
                    <div class="col-xl-3"><input type="text" class="input w_29" placeholder="00"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">検索対象</div>
                    <div class="col-xl-10">
                        <label for=""><input type="radio" name="raido1"> 申込者</label>
                        <label for=""><input type="radio" name="raido1"> 得意先</label>
                        <label for=""><input type="radio" name="raido2"> 需要先</label>
                        <label for=""><input type="radio" name="raido2"> その他</label>
                    </div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">会員種別</div>
                    <div class="col-xl-8">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
                                <option value="">01 一般会員</option>
                                <option value="">02 くらし安心会員</option>
                                <option value="">03 くらし楽とく会員</option>
                                <option value="">04 暮らしサポートセット会員</option>
                                <option value="">05 非会員</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">氏名</div>
                    <div class="col-xl-8"><input type="text" class="input" placeholder="テスト"></div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">担当者名</div>
                    <div class="col-xl-8">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
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
                    <div class="col-xl-2">カナ</div>
                    <div class="col-xl-8"><input type="text" class="input" placeholder="テスト"></div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">支払区分</div>
                    <div class="col-xl-8">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
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
                    <div class="col-xl-3"><input type="text" class="input" placeholder="460-0001"></div>
                    <div class="col-xl-2">都道府県</div>
                    <div class="col-xl-3">
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
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4">源泉</div>
                    <div class="col-xl-8">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
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
                    <div class="col-xl-2">市区町村番地</div>
                    <div class="col-xl-8"><input type="text" class="input" placeholder="名古屋市中区三の丸０－０－０"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">ビル名等</div>
                    <div class="col-xl-8"><input type="text" class="input"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">電話番号</div>
                    <div class="col-xl-2"><input type="text" class="input" placeholder="052-000-0000"></div>
                    <div class="col-xl-2">携帯電話</div>
                    <div class="col-xl-2"><input type="text" class="input" placeholder="090-111-1111"></div>
                    <div class="col-xl-2">FAX番号</div>
                    <div class="col-xl-2"><input type="text" class="input"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <div class="col-xl-2">ﾒｰﾙｱﾄﾞﾚｽ</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-8">
                    <a href="" class="plus">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M12.071 6.5c-.251 0-.469.092-.653.276-.184.184-.276.401-.276.653v3.714h-3.714c-.251 0-.469.092-.653.276-.184.184-.276.401-.276.653v1.857c0 .251.092.469.276.653.184.184.401.276.653.276h3.714v3.714c0 .251.092.469.276.653.184.184.401.276.653.276h1.857c.251 0 .469-.092.653-.276.184-.184.276-.401.276-.653v-3.714h3.714c.251 0 .469-.092.653-.276.184-.184.276-.401.276-.653v-1.857c0-.251-.092-.469-.276-.653-.184-.184-.401-.276-.653-.276h-3.714v-3.714c0-.251-.092-.469-.276-.653-.184-.184-.401-.276-.653-.276h-1.857zm.929-4.643c2.022 0 3.886.498 5.593 1.494 1.707.996 3.059 2.348 4.055 4.055.996 1.707 1.494 3.572 1.494 5.593 0 2.022-.498 3.886-1.494 5.593-.996 1.707-2.348 3.059-4.055 4.055-1.707.996-3.572 1.494-5.593 1.494-2.022 0-3.886-.498-5.593-1.494-1.707-.996-3.059-2.348-4.055-4.055-.996-1.707-1.494-3.572-1.494-5.593 0-2.022.498-3.886 1.494-5.593.996-1.707 2.348-3.059 4.055-4.055 1.707-.996 3.572-1.494 5.593-1.494z" style="opacity: 1;"></path>
                            </g>
                        </svg>
                        詳細表示
                    </a>
                </div>
            </div>

        </div>
        <div class="btn-search">
            <a href="" class="abt search float-right">編集</a>
            <a href="<?= Router::url('/pages/customer_search '); ?>" class="abt cancel float-right">キャンセル</a>
        </div>
    </div>
</div>
