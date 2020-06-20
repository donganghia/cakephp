<?php
namespace App\Controller;

use App\Libs\Crypt;
use App\Libs\Message;
use App\Libs\Utility;
use App\Model\Table\MCustomerTable;
use App\Model\Table\MSystemTable;
use Cake\I18n\Time;

/**
 * MCustomer Controller
 *
 * @property \App\Model\Table\MCustomerTable $MCustomer
 *
 * @method \App\Model\Entity\MCustomer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MCustomerController extends AppController
{

    /**
     * Type: action
     * Method: post|get
     */
    public function index()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;

            $this->paginate = $this->getPaginateConfig(); //limit && page
            $this->paginate['order'] = $this->getQueryOrder(12);//order

            //get all param search
            $pArySearch = $this->getQuerySearch();
            $aryKaiinshuirui = $this->getMstSystem(['MSystem.type_name' => MSystemTable::SYSTEM_KAIIN_SHURUI]);
            $aryKaiinshuirui = $aryKaiinshuirui[MSystemTable::SYSTEM_KAIIN_SHURUI];
            //search
            if($pArySearch) {
                $arySearchLike = [
                    'kanri_bangou', 'kaiin_bangou', 'smile_bangou', 'kanri_bangou', 'synergry_id',
                    'okyaku_sama_bangou', 'nittei', 'moushisha_kinkyou_renrakusen_denwabangou', 'keitai_meiru',
                    'doukyo_kazoku1_shimei', 'eigyou_tantou', 'sanyou_houmuzu_seiban', 'kouza_furikae_kubun',
                    'kinyuukkan_meishou', 'kinyuukkan_koudo', 'honshiten_shutchoujo_koudo', 'yuucho_ginkou_tsuochou_kigou',

                ];
                foreach ($arySearchLike as $searchKey) {
                    if($strValue = $this->validAryKey($pArySearch, $searchKey)) {
                        $this->paginate['conditions']["MCustomer.$searchKey LIKE"] = "%$strValue%";
                    }
                }

                $arySearchEqual = [
                    'm_system_kihonsyubetu_id', 'm_system_kaiinshurui_id', 'm_system_kaiinenji_id',
                    'm_system_tantousha_id', 'm_mediation_gensen_id', 'seibetsu',
                    'm_system_kyojuueria_id', 'm_system_sabisukubun_id', 'm_system_shonendo_nenkaihi_id',
                    'm_system_kaihikubun_id', 'm_system_juotakumeika_id', 'm_system_manshonmei_id', 'm_system_shiten_id',
                    'sabisu_manki_tsuki', 'shoudakusho_henshin', 'shingaisha_shoudakusho_soufu', 'shoudakusho_juryou_joukyou',
                ];
                foreach ($arySearchEqual as $searchKey) {
                    if($strValue = $this->validAryKey($pArySearch, $searchKey)) {
                        $this->paginate['conditions']["MCustomer.$searchKey"] = $strValue;
                    }
                }

                if($valueChintai = $this->validAryKey($pArySearch, 'chintai')) {
                    $this->paginate['conditions']['MCustomer.chintai'] = true;
                }

                if($value_shokai_touroku_taimu_sutanpu = $this->validAryKey($pArySearch, 'shokai_touroku_taimu_sutanpu')) {
                    $date = new Time($value_shokai_touroku_taimu_sutanpu);
                    $this->paginate['conditions']['MCustomer.shokai_touroku_taimu_sutanpu <='] = $date;
                }

                if($value_kuuringuofu_tsuuchi = $this->validAryKey($pArySearch, 'kuuringuofu_tsuuchi')) {
                    $flag = $value_kuuringuofu_tsuuchi == 1;
                    $this->paginate['conditions']['MCustomer.kuuringuofu_tsuuchi'] = $flag;
                }

                $aryDate = [
                    'shuhensaishin_sekou_yoteibi', 'fukakachi_sabisukaishi_yoteibi',
                    'e_moushisha_seinengappi', 'hikiwatashi_nengappi', 
                ];

                foreach($aryDate as $searchKey) {
                    if($strValue = $this->validAryKey($pArySearch, $searchKey)) {
                        $date = new Time($strValue);
                        $this->paginate['conditions']["MCustomer.$searchKey"] = $date;
                    }
                }     
                
                if($value_hizukekoumoku = $this->validAryKey($pArySearch, 'hizukekoumoku')) {
                    if(isset(MCustomerTable::HIZUKEKOUMOUKU_FIELDS[$value_hizukekoumoku])) {
                        $searchKey = MCustomerTable::HIZUKEKOUMOUKU_FIELDS[$value_hizukekoumoku];

                        if($value_hizukekoumoku_start = $this->validAryKey($pArySearch, 'hizukekoumoku_start')) {   
                            $date = new Time($value_hizukekoumoku_start);
                            $this->paginate['conditions']["MCustomer.$searchKey >="] = $date;
                        }

                        if($value_hizukekoumoku_end = $this->validAryKey($pArySearch, 'hizukekoumoku_end')) {    
                            $date = new Time($value_hizukekoumoku_end);
                            $date->modify("+1 days");
                            $this->paginate['conditions']["MCustomer.$searchKey <"] = $date;
                        }
                    }
                }
                
                //search special
                $this->specialSearch($pArySearch);
            }

            $aryField = [
                'id',
                'm_system_kaiinshurui_id',
                'moushisha_moushimei_kanji',
                'moushisha_moushimei_kana',
                'tokui_saki_ryakushou',
                'e_moushisha_youbinbangou',
                'e_moushisha_juusho_todoufuken',
                'e_moushisha_juusho_shikuchousonikou',
                'denwa',
                'keitai_bangou',
                'fakkusu_bangou',
                'meirumegajin_meiru',
                'created'
            ];
            $query = $this->MCustomer->find()
                ->select($aryField)
                ->where(['MCustomer.deleted is' => null]);
            $mCustomer = $this->paginate($query);

            $aryResult = [];
            foreach ($mCustomer as $key => $mCustomerItem) {
                $aryResult[$key][] = $this->tableActionField($mCustomerItem->id, ['controller'=> 'MCustomer', 'action'=> 'edit'], ['controller'=> 'MCustomer', 'action'=> 'delete']);
                $aryResult[$key][] = isset($aryKaiinshuirui[$mCustomerItem->m_system_kaiinshurui_id]) ?
                    $aryKaiinshuirui[$mCustomerItem->m_system_kaiinshurui_id] : null;
                $aryResult[$key][] = $mCustomerItem->moushisha_moushimei_kanji;
                $aryResult[$key][] = $mCustomerItem->moushisha_moushimei_kana;
                $aryResult[$key][] = $mCustomerItem->tokui_saki_ryakushou;
                $aryResult[$key][] = $mCustomerItem->e_moushisha_youbinbangou;
                $aryResult[$key][] = $mCustomerItem->e_moushisha_juusho_todoufuken;
                $aryResult[$key][] = $mCustomerItem->e_moushisha_juusho_shikuchousonikou;
                $aryResult[$key][] = $mCustomerItem->denwa;
                $aryResult[$key][] = $mCustomerItem->keitai_bangou;
                $aryResult[$key][] = $mCustomerItem->fakkusu_bangou;
                $aryResult[$key][] = $mCustomerItem->meirumegajin_meiru;
                $aryResult[$key][] = $mCustomerItem->created;
            }

            $this->datatableResponse($query, $aryResult);
        } else {
            $aryMediation = $this->MstService->getGensen();

            $aryMSystem = $this->getMstSystem(['MSystem.type_name IN' => [
                MSystemTable::SYSTEM_TANTOUSHA, MSystemTable::SYSTEM_KAIIN_SHURUI,
                MSystemTable::SYSTEM_BUKKEN_KUBUN, MSystemTable::SYSTEM_KYOJUU_ARIA,
                MSystemTable::SYSTEM_SAABUSU_KUBUN, MSystemTable::SYSTEM_SHONENDO_NENKAIHI,
                MSystemTable::SYSTEM_KAIHI_KUBUN, MSystemTable::SYSTEM_JUUTAKU_MEEKAA,
                MSystemTable::SYSTEM_MANSHON_MEI, MSystemTable::SYSTEM_SHITEN,
                MSystemTable::SYSTEM_KIHON_SHUBETSU, MSystemTable::SYSTEM_KAIIN_NENJI
            ]]);

            $this->set(compact('aryMediation', 'aryMSystem'));
        }
    }

    /**
     * Type: action
     * Method: post|get
     */
    public function add()
    {
        $mCustomer = $this->MCustomer->newEntity();
        if ($this->request->is('post')) {
            $aryData = $this->request->getData();
            $aryData['e_touroku_chekku_ran'] = $this->request->getData('e_touroku_chekku_ran.'.MCustomerTable::TAB_NAKADEN_JOUHOU);
            $aryData['e_chekku_rankinyuushaid_mei'] = $this->request->getData('e_chekku_rankinyuushaid_mei.'.MCustomerTable::TAB_NAKADEN_JOUHOU);
            $aryData['e_chekku_kinyou_jikan'] = $this->request->getData('e_chekku_kinyou_jikan.'.MCustomerTable::TAB_NAKADEN_JOUHOU);
            $aryData['kigyou_dantai_koudo'] = $this->request->getData('kigyou_dantai_koudo.'.MCustomerTable::TAB_NAKADEN_JOUHOU);
            $aryData['nikkunemu'] = $this->request->getData('nikkunemu.'.MCustomerTable::TAB_NAKADEN_JOUHOU);
            $aryData['pasuwado'] = $this->request->getData('pasuwado.'.MCustomerTable::TAB_NAKADEN_JOUHOU);

            $mCustomer = $this->MCustomer->patchEntity($mCustomer, $aryData);
            if($mCustomer->getErrors()) {
                $this->errorFlash($mCustomer->getErrors());
            } else {
                if ($this->MCustomer->save($mCustomer)) {
                    $this->MCustomer->updateAll(['kanri_bangou' => $mCustomer->id], ['id' => $mCustomer->id]);
                    $this->successAlertFlash(Message::M_CUSTOMER_EDIT_DONE);

                    return $this->redirect(['action' => 'index']);
                }
            }
        }

        $aryMediation = $this->MstService->getGensen();

        $aryMSystem = $this->getMstSystem(['MSystem.type_name IN' => [
            MSystemTable::SYSTEM_TANTOUSHA, MSystemTable::SYSTEM_KAIIN_SHURUI,
            MSystemTable::SYSTEM_BUKKEN_KUBUN, MSystemTable::SYSTEM_KYOJUU_ARIA,
            MSystemTable::SYSTEM_SAABUSU_KUBUN, MSystemTable::SYSTEM_SHONENDO_NENKAIHI,
            MSystemTable::SYSTEM_KAIHI_KUBUN, MSystemTable::SYSTEM_JUUTAKU_MEEKAA,
            MSystemTable::SYSTEM_MANSHON_MEI, MSystemTable::SYSTEM_SHITEN,
            MSystemTable::SYSTEM_KIHON_SHUBETSU, MSystemTable::SYSTEM_KAIIN_NENJI
        ]]);

        $this->set(compact('mCustomer', 'aryMediation', 'aryMSystem'));
    }

    /**
     * Type: action
     * Method: post|get
     *
     * @param null $id
     * @return \Cake\Http\Response|null
     */
    public function edit($id = null)
    {
        $id = Crypt::decryptAES($id);
        $isKaiin = false;
        $mCustomer = $this->MCustomer->find()->where(['id' => $id, 'deleted is' => null])->first();
        if(!$mCustomer) {
            $this->errorFlash(Utility::validMsg(Message::FIELD_NOT_FOUND, ['顧客']));
            return $this->redirect(['action' => 'index']);
        }

        $aryMCustomer = $this->MCustomer->find()
            ->select(['id', 'kanri_bangou', 'kaiin_bangou', 'moushisha_moushimei_kanji'])
            ->where(['kanri_bangou' => $mCustomer->kanri_bangou, 'deleted is' => null])
            ->orderDesc('created')
            ->toArray();

        $aryKaiinBangou = [];
        foreach ($aryMCustomer as $aryMCustomerItem) {
            $aryKaiinBangou[Crypt::encrypAES($aryMCustomerItem['id'])] = "{$aryMCustomerItem['kaiin_bangou']}-{$aryMCustomerItem['moushisha_moushimei_kanji']}";
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $aryData = $this->request->getData();
            $aryData['e_touroku_chekku_ran'] = $this->request->getData('e_touroku_chekku_ran.'.MCustomerTable::TAB_NAKADEN_JOUHOU);
            $aryData['e_chekku_rankinyuushaid_mei'] = $this->request->getData('e_chekku_rankinyuushaid_mei.'.MCustomerTable::TAB_NAKADEN_JOUHOU);
            $aryData['e_chekku_kinyou_jikan'] = $this->request->getData('e_chekku_kinyou_jikan.'.MCustomerTable::TAB_NAKADEN_JOUHOU);
            $aryData['kigyou_dantai_koudo'] = $this->request->getData('kigyou_dantai_koudo.'.MCustomerTable::TAB_NAKADEN_JOUHOU);
            $aryData['nikkunemu'] = $this->request->getData('nikkunemu.'.MCustomerTable::TAB_NAKADEN_JOUHOU);
            $aryData['pasuwado'] = $this->request->getData('pasuwado.'.MCustomerTable::TAB_NAKADEN_JOUHOU);

            // normal edit
            if(isset($aryData['select_id']) && ($aryData['select_id'])) {
                unset($aryData['select_id']);
            }
            //create new customer by kanri_bangou
            else {
                $kanriBangou = $mCustomer->kanri_bangou;
                $mCustomer = $this->MUser->newEntity();
                $mCustomer->kanri_bangou = $kanriBangou;
                $mCustomer->kaiin_bangou = count($aryMCustomer)+1;
                $isKaiin = true;
            }

            $mCustomer = $this->MCustomer->patchEntity($mCustomer, $aryData);
            if($mCustomer->getErrors()) {
                $this->errorFlash($mCustomer->getErrors());
            } else {
                if ($this->MCustomer->save($mCustomer)) {
                    $flag = true;
                    // save m_customer_history
                    if(isset($aryData["m_customer_history"])) {
                        $m_customer_history = $aryData["m_customer_history"];

                        $m_customer_history_entity = null;
                        if(isset($m_customer_history["id"]) && $m_customer_history["id"]) {
                            $m_customer_history_entity = $this->MCustomerHistory->find()
                            ->where(['id' => $m_customer_history["id"], 'deleted is' => null, "m_customer_id" => $mCustomer->id])->first();
                        }
                        
                        if(!$m_customer_history_entity) {
                            $m_customer_history_entity = $this->MCustomerHistory->newEntity();
                            $m_customer_history_entity->m_customer_id = $mCustomer->id;
                        }

                        $this->MCustomerHistory->patchEntity($m_customer_history_entity, $m_customer_history);

                        if($m_customer_history_entity->getErrors()) {
                            $this->errorFlash($m_customer_history_entity->getErrors());
                            $flag = false;
                        }
                        else {
                            $this->MCustomerHistory->save($m_customer_history_entity);
                        }
                    }

                    if($flag) {
                        $this->successAlertFlash(Message::M_CUSTOMER_EDIT_DONE);
                        return $this->redirect(['action' => 'index']);
                    }
                }
            }
        }

        $aryMediation = $this->MstService->getGensen();

        $aryMSystem = $this->getMstSystem(['MSystem.type_name IN' => [
            MSystemTable::SYSTEM_TANTOUSHA, MSystemTable::SYSTEM_KAIIN_SHURUI,
            MSystemTable::SYSTEM_BUKKEN_KUBUN, MSystemTable::SYSTEM_KYOJUU_ARIA,
            MSystemTable::SYSTEM_SAABUSU_KUBUN, MSystemTable::SYSTEM_SHONENDO_NENKAIHI,
            MSystemTable::SYSTEM_KAIHI_KUBUN, MSystemTable::SYSTEM_JUUTAKU_MEEKAA,
            MSystemTable::SYSTEM_MANSHON_MEI, MSystemTable::SYSTEM_SHITEN,
            MSystemTable::SYSTEM_KIHON_SHUBETSU, MSystemTable::SYSTEM_KAIIN_NENJI
        ]]);

        $selectedId = Crypt::encrypAES($id);

        $this->set(compact('isKaiin', 'selectedId', 'mCustomer', 'aryMediation', 'aryMSystem', 'aryKaiinBangou'));
    }

    /**
     * Type: action
     * Method: post|delete
     * @param null $id
     * @return \Cake\Http\Response|null
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['get']);
        $id = Crypt::decryptAES($id);
        $mCustomer = $this->MCustomer->find()->where(['id' => $id, 'deleted is' => null])->first();

        if(!$mCustomer) {
            $this->errorFlash(Utility::validMsg(Message::FIELD_NOT_FOUND, ['顧客']));
            return $this->redirect(['action' => 'index']);
        }

        $update = $this->MCustomer->updateAll(['deleted' => Utility::dbDate()], ['id' => $mCustomer->id]);
        if ($update) {
            $this->successFlash(Message::DELETED);
        } else {
            $this->errorFlash(Message::UNDELETED);
        }

        return $this->redirect(['action' => 'index']);
    }

    public function simple() {}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function popup()
    {
        if ($this->request->is('ajax')) {
            $type = $this->request->getData('type');

            if($type == 1) {
                $aryMediation = $this->MstService->getGensen();

                $aryMSystem = $this->getMstSystem(['MSystem.type_name IN' => [
                    MSystemTable::SYSTEM_TANTOUSHA, MSystemTable::SYSTEM_KAIIN_SHURUI,
                    MSystemTable::SYSTEM_BUKKEN_KUBUN, MSystemTable::SYSTEM_KYOJUU_ARIA,
                    MSystemTable::SYSTEM_SAABUSU_KUBUN, MSystemTable::SYSTEM_SHONENDO_NENKAIHI,
                    MSystemTable::SYSTEM_KAIHI_KUBUN, MSystemTable::SYSTEM_JUUTAKU_MEEKAA,
                    MSystemTable::SYSTEM_MANSHON_MEI, MSystemTable::SYSTEM_SHITEN,
                    MSystemTable::SYSTEM_KIHON_SHUBETSU, MSystemTable::SYSTEM_KAIIN_NENJI
                ]]);

                $this->set(compact('aryMediation', 'aryMSystem'));
                echo $this->render('popup'); die;
            } else {
                $this->autoRender = false;

                $this->paginate = $this->getPaginateConfig(); //limit && page
                $this->paginate['order'] = $this->getQueryOrder();//order

                //get all param search
                $pArySearch = $this->getQuerySearch();
                $aryKaiinshuirui = $this->getMstSystem(['MSystem.type_name' => MSystemTable::SYSTEM_KAIIN_SHURUI]);
                $aryKaiinshuirui = $aryKaiinshuirui[MSystemTable::SYSTEM_KAIIN_SHURUI];

                //search
                if($pArySearch) {
                    $arySearchLike = ['kanri_bangou'];
                    foreach ($arySearchLike as $searchKey) {
                        if($strValue = $this->validAryKey($pArySearch, $searchKey)) {
                            $this->paginate['conditions']["MCustomer.$searchKey LIKE"] = "%$strValue%";
                        }
                    }

                    $arySearchEqual = [
                        'm_system_kaiinshurui_id', 'm_system_sabisukubun_id',
                        'm_system_tantousha_id', 'm_mediation_gensen_id'
                    ];
                    foreach ($arySearchEqual as $searchKey) {
                        if($strValue = $this->validAryKey($pArySearch, $searchKey)) {
                            $this->paginate['conditions']["MCustomer.$searchKey"] = $strValue;
                        }
                    }

                    //search special
                    $this->specialSearch($pArySearch);
                }

                $aryField = [
                    'id',
                    'm_system_kaiinshurui_id',
                    'moushisha_moushimei_kanji',
                    'moushisha_moushimei_kana',
                    'tokui_saki_ryakushou',
                    'e_moushisha_youbinbangou',
                    'e_moushisha_juusho_todoufuken',
                    'e_moushisha_juusho_shikuchousonikou',
                    'denwa',
                    'keitai_bangou',
                    'fakkusu_bangou',
                    'meirumegajin_meiru',
                    'created'
                ];
                $query = $this->MCustomer->find()
                    ->select($aryField)
                    ->where(['MCustomer.deleted is' => null]);
                $mCustomer = $this->paginate($query);

                $aryResult = [];
                foreach ($mCustomer as $key => $mCustomerItem) {
                    $aryResult[$key][] = $this->tableRadioField($mCustomerItem);
                    $aryResult[$key][] = isset($aryKaiinshuirui[$mCustomerItem->m_system_kaiinshurui_id])
                        ? $aryKaiinshuirui[$mCustomerItem->m_system_kaiinshurui_id] : '';
                    $aryResult[$key][] = $mCustomerItem-> moushisha_moushimei_kanji;
                    $aryResult[$key][] = $mCustomerItem->moushisha_moushimei_kana;
                    $aryResult[$key][] = $mCustomerItem->tokui_saki_ryakushou;
                    $aryResult[$key][] = $mCustomerItem->e_moushisha_youbinbangou;
                    $aryResult[$key][] = $mCustomerItem->e_moushisha_juusho_todoufuken;
                    $aryResult[$key][] = $mCustomerItem->e_moushisha_juusho_shikuchousonikou;
                    $aryResult[$key][] = $mCustomerItem->denwa;
                    $aryResult[$key][] = $mCustomerItem->keitai_bangou;
                    $aryResult[$key][] = $mCustomerItem->fakkusu_bangou;
                    $aryResult[$key][] = $mCustomerItem->meirumegajin_meiru;
                    $aryResult[$key][] = $mCustomerItem->created;
                }

                $this->datatableResponse($query, $aryResult);
            }
        }
    }

    /**
     * @param $pArySearch
     */
     private function specialSearch($pArySearch) {
        if($aryKensakuTaishou = $this->validAryKey($pArySearch, 'kensaku_taishou')) {
            $strName = $this->validAryKey($pArySearch, 'name');
            $strKana = $this->validAryKey($pArySearch, 'kana');
            $strYuubenbangou = $this->validAryKey($pArySearch, 'yuubenbangou');
            $strTodoufuken = $this->validAryKey($pArySearch, 'todoufuken');
            $strShikuChousonBanchi = $this->validAryKey($pArySearch, 'shiku_chouson_banchi');
            $strBiruMeiTou = $this->validAryKey($pArySearch, 'biru_mei_tou');
            $strDenwa = $this->validAryKey($pArySearch, 'denwa');
            $strKeitaiBangou = $this->validAryKey($pArySearch, 'keitai_bangou');
            $strFakkusuBangou = $this->validAryKey($pArySearch, 'fakkusu_bangou');
            $strMail = $this->validAryKey($pArySearch, 'mail');

            $arySpecialCondition = ['MCustomer.deleted is' => null];

            //申込者
            if(in_array(MCustomerTable::KENSAKU_TAISHOU_MOUSHIKOMI_SHA, $aryKensakuTaishou)) {
                $aryField = [
                    'moushisha_moushimei_kanji' => $strName,
                    'moushisha_moushimei_kana' => $strKana,
                    'e_moushisha_youbinbangou' => $strYuubenbangou,
                    'e_moushisha_juusho_todoufuken' => $strTodoufuken,
                    'e_moushisha_juusho_shikuchousonikou' => $strShikuChousonBanchi,
                    'e_moushisha_juusho_manshon_mei' => $strBiruMeiTou,
                    'denwa' => $strDenwa,
                    'keitai_bangou' => $strKeitaiBangou,
                    'fakkusu_bangou' => $strFakkusuBangou,
                    'meirumegajin_meiru' => $strMail,
                ];
                foreach ($aryField as $key => $value) {
                    if($value) $arySpecialCondition['OR'][0]['AND']["MCustomer.$key LIKE"] = "%$value%";
                }
            }

            //サービス希望住所
            if(in_array(MCustomerTable::KENSAKU_TAISHOU_SAABISU_KIBOU, $aryKensakuTaishou)) {
                $aryField = [
                    'e_sabisu_kibou_youbinbangou' => $strYuubenbangou,
                    'e_sabisu_kibou_juusho_todoufuken' => $strTodoufuken,
                    'e_sabisu_kibou_juusho_shikuchousonikou' => $strShikuChousonBanchi,
                    'e_sabisu_kibou_juusho_manshon_mei' => $strBiruMeiTou
                ];
                foreach ($aryField as $key => $value) {
                    if($value) $arySpecialCondition['OR'][1]['AND']["MCustomer.$key LIKE"] = "%$value%";
                }
            }

            //需要場所
            if(in_array(MCustomerTable::KENSAKU_TAISHOU_JUYOUBASHO, $aryKensakuTaishou)) {
                $aryField = [
                    'juyoubasho_youbinbangou' => $strYuubenbangou,
                    'juyoubasho_todoufukenmei' => $strTodoufuken,
                    'juyoubasho_tatemono_banchi' => $strShikuChousonBanchi,
                    'juyoubasho_tatemono_mei' => $strBiruMeiTou
                ];
                foreach ($aryField as $key => $value) {
                    if($value) $arySpecialCondition['OR'][2]['AND']["MCustomer.$key LIKE"] = "%$value%";
                }
            }

            //契約者
            if(in_array(MCustomerTable::KENSAKU_TAISHOU_KEIYAKU_SHA, $aryKensakuTaishou)) {
                $aryField = [
                    'gokeiyaku_meigi_kanji' => $strName,
                    'gokeiyaku_meigi_kana' => $strKana,
                ];
                foreach ($aryField as $key => $value) {
                    if($value) $arySpecialCondition['OR'][3]['AND']["MCustomer.$key LIKE"] = "%$value%";
                }
            }

            //家族
            if(in_array(MCustomerTable::KENSAKU_TAISHOU_KAZOKU, $aryKensakuTaishou)) {
                $aryField1 = ['doukyo_kazoku1_shimei' => $strName, 'doukyo_kazoku1_furigana' => $strKana];
                $aryField2 = ['doukyo_kazoku2_shimei' => $strName, 'doukyo_kazoku2_furigana' => $strKana];
                $aryField3 = ['doukyo_kazoku3_shimei' => $strName, 'doukyo_kazoku3_furigana' => $strKana];
                $aryField4 = ['doukyo_kazoku4_shimei' => $strName, 'doukyo_kazoku4_furigana' => $strKana];
                $aryField5 = ['doukyo_kazoku5_shimei' => $strName, 'doukyo_kazoku5_furigana' => $strKana];
                $aryField6 = ['doukyo_kazoku6_shimei' => $strName, 'doukyo_kazoku6_furigana' => $strKana];

                foreach ($aryField1 as $key => $value) {
                    if($value) $arySpecialCondition['OR'][4]['AND']["MCustomer.$key LIKE"] = "%$value%";
                }
                foreach ($aryField2 as $key => $value) {
                    if($value) $arySpecialCondition['OR'][5]['AND']["MCustomer.$key LIKE"] = "%$value%";
                }
                foreach ($aryField3 as $key => $value) {
                    if($value) $arySpecialCondition['OR'][6]['AND']["MCustomer.$key LIKE"] = "%$value%";
                }
                foreach ($aryField4 as $key => $value) {
                    if($value) $arySpecialCondition['OR'][7]['AND']["MCustomer.$key LIKE"] = "%$value%";
                }
                foreach ($aryField5 as $key => $value) {
                    if($value) $arySpecialCondition['OR'][8]['AND']["MCustomer.$key LIKE"] = "%$value%";
                }
                foreach ($aryField6 as $key => $value) {
                    if($value) $arySpecialCondition['OR'][9]['AND']["MCustomer.$key LIKE"] = "%$value%";
                }
            }
            if(count($arySpecialCondition) > 1) {
                $arySpecialResult = $this->MCustomer->find('list', [
                    'conditions' => $arySpecialCondition
                ])->select(['id'])->toArray();
                if(count($arySpecialResult)) {
                    $this->paginate['conditions']['MCustomer.id IN'] = $arySpecialResult;
                } else {
                    $this->paginate['conditions']['MCustomer.id'] = 0;
                }
            }
        }
    }

    public function searchHistory($id = null) {
        $this->autoRender = false;
        $this->paginate = $this->getPaginateConfig();
        $history_type = $this->request->getQuery("history_type");

        $order = $this->getQueryOrder();
        if(!isset($order["MCustomerHistory.modified"])) {
            $order["MCustomerHistory.modified"] = "desc";
        }
        $this->paginate["order"] = $order;

        $query = $this->MCustomerHistory->find()
                ->where([
                    "MCustomerHistory.deleted is null", 
                    "MCustomerHistory.m_customer_id" => $id,
                    "MCustomerHistory.shubetsu" => $history_type,
                ]);

        $m_customer_histories = $this->paginate($query);

        foreach ($m_customer_histories as $m_customer_history) {
            $m_customer_history->hidzuke = Utility::dateShort($m_customer_history->hidzuke);
            $m_customer_history->sabisu_jisshibi = Utility::dateShort($m_customer_history->sabisu_jisshibi);
            $m_customer_history->uketsukebi = Utility::dateShort($m_customer_history->uketsukebi);
        }
        $this->datatableResponse($query, $m_customer_histories);
    }
}
