<?php
/* Copyright (c) ASC All Rights Reserved.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ［変更履歴］
 * 2018.11.28 Hieunld：新規作成
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace App\Controller;

use App\Libs\Utility;
use Cake\Core\Configure;

class AuthController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout']);

        if(self::$strRoute === 'auth.login') {
            $this->loadComponent('Recaptcha.Recaptcha', [
                'enable' => true,
                'sitekey' => Configure::read('Captcha')['site_key'],
                'secret' => Configure::read('Captcha')['secret'],
                'type' => 'image',
                'theme' => 'light',
                'lang' => 'ja',
                'size' => 'normal'
            ]);
        }
    }

    /**
     * ログインアクション
     *
     * @return \Cake\Network\Response|null
     */
    public function login()
    {
        $request = $this->request;
        $objEntity = (object)[
            'username' => ''
        ];

        // ポストデータがある？
        if ($request->is('post')) {
            // ログイン処理
            if ($this->Recaptcha->verify()) {
                $aryUser = $this->Auth->identify();
                if ($aryUser) {
                    // ユーザー情報をセクションに保存
                    unset($aryUser['created']);
                    unset($aryUser['modified']);
                    unset($aryUser['deleted']);
                    unset($aryUser['last_login']);
                    $this->Auth->setUser($aryUser);
                    // ログイン日時更新
                    $this->MUser->updateAll(['last_login' => Utility::dbDate()], ['id' => $aryUser['id']]);
                    //save log
                    $this->saveLogLogin($aryUser);
                    // 表示ページへ遷移
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    // ログイン認証失敗
                    $this->errorFlash([__('ユーザー名かパスワードが間違っています。')]);
                }
            } else {
                $this->errorFlash([__('「ロボットではありません」をチェックしてください。')]);
            }
            $objEntity->username = $request->getData('username');
        }

        $this->set('objEntity', $objEntity);
    }

    /**
     * ログ
     *
     * @param $aryUser
     * @return \App\Model\Entity\LogLogin|bool
     */
    private function saveLogLogin($aryUser)
    {
        $mUser = $this->MUser->find()->where(['id' => $aryUser['id'], 'deleted is' => null])->first();
        $mSupplier = $mUser->m_supplier_id
            ? $this->MSupplier->find()->where(['id' => $mUser->m_supplier_id, 'deleted is' => null])->first()
            : null;
        $mSystem = $this->LogLogin->newEntity();
        $mSystem = $this->LogLogin->patchEntity($mSystem,
            [
                'm_user_id' => $mUser->id,
                'm_supplier_name' => $mSupplier ? $mSupplier->mei_1 : null,
                'm_user_username' => $mUser->username,
                'm_user_name' => $mUser->name,
                'm_user_created' => $mUser->created,
                'ip_address' => $this->request->clientIp(),
                'user_agent' => $_SERVER['HTTP_USER_AGENT']
            ]);
        return $this->LogLogin->save($mSystem);
    }

    /**
     * ログアウトアクション
     *
     * @return \Cake\Network\Response|null
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
