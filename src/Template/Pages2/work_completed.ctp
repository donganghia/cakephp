<?php
use Cake\Routing\Router;
?>
<div class="page page_register account_processing" id="account">
    <div class="navi">
        <div class="go_back">
            <a href="<?= Router::url( '/pages2/done'); ?>">
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
        <h1 class="title">作業完了登録</h1>
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
                <input type="text" class="w_143" value="787">
            </div>
            <div class="order_user">
                <span>e-暮らし担当</span>
                <input type="text" class="w_139">
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="content">
        <div class="info">
            <div class="row">
                <div class="situation col-sm-5 col-lg-5">
                    <div class="title">完了種別</div>
                    <label for="radio1"><input type="radio" value="変更無し" name="processing" id="radio1" checked> 変更無し</label>
                    <label for="radio2"><input type="radio" value="変更有り" name="processing" id="radio2"> 変更有り</label>
                    <label for="radio3"><input type="radio" value="その他" name="processing" id="radio3"> その他</label>
                    <label for="radio4"><input type="radio" value="確認TEL連絡要" name="processing" id="radio4"> 確認TEL連絡要</label>
                </div>

            </div>
            <div class="row">
                <div class="row col-xl-7">
                    <div class="col-xl-3">案件No.</div>
                    <div class="col-xl-3"><input type="text" class="input" placeholder="EK20181036"></div>
                    <div class="col-xl-3 color_red">※連絡事項記載有り</div>
                    <div class="col-xl-3 color_red">※添付資料有り</div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4 color_red">訪問時間帯</div>
                    <div class="col-xl-3"><input type="text" class="input text-right" placeholder="①便"></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-7">
                    <div class="col-xl-3">お客様氏名</div>
                    <div class="col-xl-5"><input type="text" class="input" placeholder="テスト"></div>
                    <div class="col-xl-2">様</div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4 color_red">作業期間</div>
                    <div class="col-xl-3"><input type="text" class="input text-right" placeholder="1"></div>
                    <div class="col-xl-1">日</div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-7">
                    <div class="col-xl-3">フリガナ</div>
                    <div class="col-xl-5"><input type="text" class="input " placeholder="テスト"></div>
                    <div class="col-xl-2">様</div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-8 color_red">納期日／工事日</div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-7">
                    <div class="col-xl-3">郵便番号</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
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
                    <div class="col-xl-4 text-right color_red">開始日</div>
                    <div class="col-xl-8">
                        <input type="text" class="date year text-right" placeholder="<?= date('Y') ?>">
                        <span>／</span>
                        <input type="text" class="date month text-right" placeholder="<?= date('m') ?>">
                        <span>／</span>
                        <input type="text" class="date day text-right" placeholder="<?= date('d') ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-7">
                    <div class="col-xl-3">市区町村番地</div>
                    <div class="col-xl-8"><input type="text" class="input"></div>
                </div>
                <div class="row col-xl-4">
                    <div class="col-xl-4 text-right color_red">終了日</div>
                    <div class="col-xl-8">
                        <input type="text" class="date year text-right" placeholder="<?= date('Y') ?>">
                        <span>／</span>
                        <input type="text" class="date month text-right" placeholder="<?= date('m') ?>">
                        <span>／</span>
                        <input type="text" class="date day text-right" placeholder="<?= date('d') ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-7">
                    <div class="col-xl-3">ビル名等</div>
                    <div class="col-xl-8"><input type="text" class="input"></div>
                </div>
                <div class="row col-xl-5">
                    <div class="col-xl-4 color_red">お客様確認項目</div>
                    <div class="col-xl-8 padding-0"><label for="" class="text_checkbox"><input type="checkbox"> 作業完了後、立ち会いを行いました</label></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-7">
                    <div class="col-xl-3">TEL番号</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
                    <div class="col-xl-3">携帯電話番号</div>
                    <div class="col-xl-3"><input type="text" class="input"></div>
                </div>
                <div class="row col-xl-5">
                    <div class="col-xl-4"></div>
                    <div class="col-xl-8 padding-0"><label for="" class="text_checkbox"><input type="checkbox"> 依頼したサービスが完了又は商品を受領しました。</label></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-7"></div>
                <div class="row col-xl-5">
                    <div class="col-xl-4"></div>
                    <div class="col-xl-8 padding-0"><label for="" class="text_checkbox"><input type="checkbox"> 日付け・署名・押印受領</label></div>
                </div>
            </div>
            <div class="row">
                <div class="row col-xl-7"></div>
                <div class="row col-xl-5">
                    <div class="col-xl-4 color_red">変更対応有無</div>
                    <div class="col-xl-5">
                        <label class="select w_100">
                            <select name="" class="input" id="">
                                <option value=""></option>
                                <option value="">0 変更無し</option>
                                <option value="">1 金額変更有り</option>
                            </select>
                        </label>
                    </div>
                    <div class="col-xl-3 color_red">
                        <!-- TO DO-->
                        <!--【金額変更】作業完了3 1 có pen-->
                        <!-- 金額変更】作業完了4 có cả 2 -->
                        <!-- 作業完了2 + 作業完了3  ko có cả 2 -->
                        <svg class="pen" xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                            <g>
                                <title></title>
                                <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                <path stroke-width="0" d="M 24.0601 8.5479 L 25.0742 7.522 C 25.9766 6.6196 25.9688 5.1484 25.0562 4.2354 L 21.7524 0.9321 C 20.8398 0.0195 19.3691 0.0117 18.4668 0.9141 L 17.4526 1.9399 L 24.0601 8.5479 ZM 21.6655 11.229 L 23.2432 9.75 L 16.3486 2.855 L 14.771 4.3345 L 21.6655 11.229 ZM 5.1748 18.8315 L 6.7725 19.1904 L 7.002 20.6582 L 17.9961 9.6733 L 16.1694 7.8462 L 5.1748 18.8315 ZM 1.0879 25.8872 C 1.1797 25.8872 1.272 25.874 1.3623 25.8477 L 9.5459 23.3491 L 20.6689 12.3242 L 19.2021 10.8574 L 8.255 21.79 L 3.83 23.09 L 2.91 22.17 L 4.265 17.55 L 15.085 6.7393 L 13.7744 5.4292 L 2.6519 16.4541 L 0.1523 24.6377 C 0.0518 24.9795 0.1465 25.3496 0.3984 25.6016 C 0.584 25.7871 0.833 25.8872 1.0879 25.8872 Z" style="stroke: rgb(192, 80, 77); fill: rgb(192, 80, 77); opacity: 1;"></path>
                            </g>
                        </svg>

                        修正済
                    </div>
                </div>
            </div>
        </div>
        <div class="table-control">
            <table>
                <thead>
                <tr>
                    <th style="width: 50px;">項番</th>
                    <th style="width: 100px;">カテゴリー</th>
                    <th style="width: 241px;">サービス品</th>
                    <th style="width: 166px;">内容</th>
                    <th style="width: 48px;">数量</th>
                    <th style="width: 50px;">単位</th>
                    <th style="width: 120px;">単価</th>
                    <th style="width: 108px;">金額</th>
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
                    <td>14,817</td>
                    <td>14,817</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>ﾊｳｽｸﾘｰﾆﾝｸﾞ</td>
                    <td>エアコン　ロボ有り2台目</td>
                    <td></td>
                    <td>1</td>
                    <td>台</td>
                    <td>13,737</td>
                    <td>13,737</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>ﾊｳｽｸﾘｰﾆﾝｸﾞ</td>
                    <td>エアコン　自動掃除機能無し</td>
                    <td></td>
                    <td>1</td>
                    <td>台</td>
                    <td>10,173</td>
                    <td>10,173</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>ﾊｳｽｸﾘｰﾆﾝｸﾞ</td>
                    <td>エアコン　ロボ無し2台目</td>
                    <td></td>
                    <td>1</td>
                    <td>台</td>
                    <td>9,093</td>
                    <td>9,093</td>
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
                <div class="col-xl-6">
                    <textarea name="" id="" cols="30" rows="5" class="input">お客様からのご要望</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <label for="" class="float-right color_red"><input type="checkbox"> 内容確認済み</label>
                </div>
                <div class="col-xl-6">
                    <label for="" class="float-right color_red"><input type="checkbox"> 内容確認済み</label>
                </div>
            </div>
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
                <div class="col-xl-4">
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2 ">
                            <svg class="icon-file" xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                                <g>
                                    <title></title>
                                    <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                    <path stroke-width="0" d="M15.438 5.23v2.082h2.082l-2.082-2.082zm-9.75-1.168v17.875h13v-13h-4.8759999999999994v-4.8759999999999994h-8.125zm-1.625-1.625h10.893l.254.229 4.875 4.875.229.254v15.768h-16.251v-21.125999999999998z"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10 t_pdf">ああああああああ.pdf</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6"></div>
                        <div class="col-xl-6">
                            <label for="" class="float-right color_red"><input type="checkbox"> 内容確認済み</label>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2">証拠書添付
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                        <g>
                            <title></title>
                            <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                            <path stroke-width="0" d="M8.343 1.915c1.528 0 2.849.547 3.961 1.64l8.778 8.792c.097.097.145.203.145.319 0 .155-.148.38-.443.675-.295.295-.52.443-.675.443-.126 0-.237-.048-.334-.145l-8.792-8.807c-.764-.745-1.64-1.117-2.626-1.117-1.025 0-1.891.363-2.597 1.088-.706.725-1.059 1.601-1.059 2.626 0 1.016.368 1.891 1.103 2.626l11.259 11.273c.609.609 1.311.914 2.104.914.619 0 1.132-.203 1.538-.609.406-.406.609-.919.609-1.538 0-.793-.305-1.494-.914-2.104l-8.43-8.43c-.251-.232-.542-.348-.871-.348-.281 0-.513.092-.696.276-.184.184-.276.416-.276.696 0 .31.121.595.363.856l5.949 5.949c.097.097.145.203.145.319 0 .155-.15.382-.45.682-.3.3-.527.45-.682.45-.116 0-.222-.048-.319-.145l-5.949-5.949c-.609-.59-.914-1.311-.914-2.162 0-.793.276-1.465.827-2.017.551-.551 1.224-.827 2.017-.827.851 0 1.572.305 2.162.914l8.43 8.43c.967.948 1.451 2.084 1.451 3.41 0 1.132-.382 2.08-1.146 2.844-.764.764-1.712 1.146-2.844 1.146-1.306 0-2.442-.484-3.41-1.451l-11.273-11.259c-1.093-1.112-1.64-2.423-1.64-3.932 0-1.538.532-2.844 1.596-3.917 1.064-1.074 2.365-1.61 3.903-1.61z" style="opacity: 1;"></path>
                        </g>
                    </svg>
                </div>
                <div class="col-xl-4">
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2 ">
                            <svg class="icon-file" xmlns="http://www.w3.org/2000/svg" version="1.1" preserveAspectRatio="none" viewBox="0 0 26 26">
                                <g>
                                    <title></title>
                                    <rect x="0" y="0" width="26" height="26" stroke="transparent" stroke-width="0" fill="transparent"></rect>
                                    <path stroke-width="0" d="M15.438 5.23v2.082h2.082l-2.082-2.082zm-9.75-1.168v17.875h13v-13h-4.8759999999999994v-4.8759999999999994h-8.125zm-1.625-1.625h10.893l.254.229 4.875 4.875.229.254v15.768h-16.251v-21.125999999999998z"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 t_pdf">ああああああああ.pdf</div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6"></div>
                        <div class="col-xl-6">
                            <label for="" class="float-right color_red"><input type="checkbox"> 内容確認済み</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row padding-top-30">
                <div class="col-xl-6"></div>
                <div class="col-xl-6">
                    <a href="<?= Router::url( '/pages2/confirm'); ?>" class="abt register">完了登録</a>
                    <a href="<?= Router::url( '/pages2/confirm1'); ?>" class="abt cancel">キャンセル</a>
                </div>
            </div>
        </div>
    </div>
</div>
