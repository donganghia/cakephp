<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\ProjectTable;
use App\Model\Table\MUserTable;
use App\Libs\Utility;
use App\Libs\Crypt;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use App\Model\Entity\MUser;
use Cake\Http\Exception\ForbiddenException;
use App\Libs\Message;

class CommentController extends AppController
{

    public function initialize()
    {
        parent::initialize();
    }

    
    /**
     * index page
     *
     * @return View
     */
    public function index()
    {  
        $login_user = self::$aryLoginUser;
        $this->set("login_user", $login_user);
    }

    /**
     * ajax search comment
     *
     * @return json
     */
    public function searchComment()
    {
        $this->autoRender = false;
        $query = $this->getCommentQuery();

        $order_comments = $this->paginate($query);

        // pr($order_comments);die;

        $aryResult = [];
        foreach ($order_comments as $key => $order_comment) {
            $aryResult[$key]["anken_koudo"] = null;
            $aryResult[$key]["customer_name"] = null;
            $aryResult[$key]["last_modified_name"] = null;
            $aryResult[$key]["m_supplier_name"] = null;

            $actionEdit = 'kakuteiHenshuu';            

            if($order_comment->project) {
                $project = $order_comment->project;    
                $aryResult[$key]["anken_koudo"] = $project->bangou;                
                if($project->m_customer) {
                    $customer = $project->m_customer;
                    $aryResult[$key]["customer_name"] = $customer->tokui_saki_kana;
                }

                if($project->type == ProjectTable::YOTEI_TYPE) {
                    $actionEdit = 'yoteiHenshuu';
                }
            }

            $order_id = Crypt::encrypAES($order_comment->order_id);
            $urlEdit = Router::url([
                'controller' => 'Project',
                'action' => $actionEdit,
                $order_id,
            ]);           
            $aryResult[$key]["url_edit"] = $urlEdit;

            $aryResult[$key]["id"] = Crypt::encrypAES($order_comment->id);
            $aryResult[$key]["juchuu_bangou"] = $order_comment->juchuu_bangou;         
            
            if($order_comment->last_user) {
                $aryResult[$key]["last_modified_name"] = $order_comment->last_user->name;
            }

            if($order_comment->m_supplier) {
                $aryResult[$key]["m_supplier_name"] = $order_comment->m_supplier->mei_1;
            }

            $aryResult[$key]["last_comment_date"] = Utility::dateFull($order_comment->last_comment_date);
            $aryResult[$key]["modified"] = Utility::dateFull($order_comment->modified);     
        }

        $this->datatableResponse($query, $aryResult);
    }

    /**
     * get query search comment
     *
     * @return Cake\ORM\Query
     */
    private function getCommentQuery()
    {
        $this->paginate = $this->getPaginateConfig();
        if(!isset($order["OrderComment.last_comment_date"])) {
            $order["OrderComment.last_comment_date"] = "desc";
        }
        $this->paginate["order"] = $order;

        $login_user = self::$aryLoginUser;

        // Check user type
        if ($login_user["type"] == MUserTable::TYPE_E_KURASHI) {
            // e-kurashi
            // $this->paginate['conditions']["OrderComment.order_user_created"] = $login_user["id"];
        } else if ($login_user["type"] == MUserTable::TYPE_PARTNER) {
            // supplier
            $this->paginate['conditions']["OrderComment.m_supplier_id"] = $login_user["m_supplier_id"];
        } else {
            // empty
            $this->paginate['conditions']["1"] = 2;
        }

        $query = $this->OrderComment->find()
                ->contain(["Project", "Project.MCustomer", "LastUser", "MSupplier"])
                ->where(["OrderComment.deleted is null"]);
                // ->order($this->getQueryOrder());

        return $query;
    }

    
    /**
     * comment popup
     *
     * @return Html
     */
    public function popup() {
        $login_user = self::$aryLoginUser;        
        $data = $this->request->getData();

        $order_comment_encrypted = isset($data["id"])? $data["id"] : "";
        $order_comment_id = Crypt::decryptAES($order_comment_encrypted);
        // get order_comment by id
        $order_comment = $this->OrderComment->find()->where(["OrderComment.id" => $order_comment_id])->first();
        if(!$order_comment) {
            $order_encrypted = isset($data["order_id"])? $data["order_id"] : "";
            $project_encrypted = isset($data["project_id"])? $data["project_id"] : "";
            $m_supplier_encrypted = isset($data["m_supplier_id"])? $data["m_supplier_id"] : "";
            $order_id = Crypt::decryptAES($order_encrypted);
            $project_id = Crypt::decryptAES($project_encrypted);
            $m_supplier_id = Crypt::decryptAES($m_supplier_encrypted);
            $order_comment = $this->getOrderComment($project_id, $order_id, $m_supplier_id);
        }
               
        $order_comment_details = [];        
        if($order_comment) {
            if($this->checkPermission($order_comment, $login_user)) {
                $order_encrypted = Crypt::encrypAES($order_comment->order_id);
                $project_encrypted = Crypt::encrypAES($order_comment->project_id);
                $m_supplier_encrypted = Crypt::encrypAES($order_comment->m_supplier_id);

                $order_comment_details = $this->OrderCommentDetail->find()
                ->where(['OrderCommentDetail.order_comment_id' => $order_comment->id])
                ->contain(["MUser"])
                ->toArray();
            }
            else {
                echo "<script>popupAlert('".sprintf(Message::PERMISSION_DENIED)."')</script>";
                die;
            }
        }

        $this->set("order_comment_details", $order_comment_details);
        $this->set("login_user", $login_user);
        $this->set("project_encrypted", $project_encrypted);
        $this->set("order_encrypted", $order_encrypted);
        $this->set("m_supplier_encrypted", $m_supplier_encrypted);
        $this->set("modal_id", "modalComment_{$order_encrypted}_{$m_supplier_encrypted}");

        echo $this->render('popup');
        die;
    }

    /**
     * save comment detail
     *
     * @return ajax
     */
    public function saveComment() {
        $this->autoRender = false;
        $data = $this->request->getData();
        $login_user = self::$aryLoginUser;

        // validate
        $errors = [];
        
        if(!isset($data["content"]) || empty(trim($data["content"]))) {
            $errors["content"] = sprintf(Message::REQUIRED, "content");
        }

        if(!isset($data["m_supplier_id"]) || empty($data["m_supplier_id"])) {
            $errors["m_supplier_id"] = sprintf(Message::REQUIRED, "m_supplier_id");
        }
        
        if(!isset($data["order_id"]) || empty($data["order_id"])) {
            $errors["order_id"] = sprintf(Message::REQUIRED, "order_id");
        }

        if(!isset($data["project_id"]) || empty($data["project_id"])) {
            $errors["project_id"] = sprintf(Message::REQUIRED, "project_id");
        }

        if(empty($errors)) {
            // validated
            // check if existed order_comment
            $project_encrypted = $data["project_id"];
            $order_encrypted = $data["order_id"];
            $m_supplier_encrypted = $data["m_supplier_id"];

            $project_id = Crypt::decryptAES($project_encrypted);
            $order_id = Crypt::decryptAES($order_encrypted);
            $m_supplier_id = Crypt::decryptAES($m_supplier_encrypted);

            $order_comment = $this->getOrderComment($project_id, $order_id, $m_supplier_id);

            if(!$order_comment) {
                // no order_comment => check data => new order_comment                
                $project = $this->Project->find()->where(["id" => $project_id])->first();
                $order = $this->Orders->find()->where(["id" => $order_id])->first();
                $m_supplier = $this->MSupplier->find()->where(["id" => $m_supplier_id])->first();
                
                if(!$project) {
                    $errors["project"] = sprintf(Message::FIELD_NOT_FOUND, "Project");
                }
                if(!$order) {
                    $errors["order"] = sprintf(Message::FIELD_NOT_FOUND, "Order");
                }
                if(!$m_supplier) {
                    $errors["m_supplier"] = sprintf(Message::FIELD_NOT_FOUND, "MSupplier");
                    $errors[$m_supplier_id] = $m_supplier_encrypted;
                }

                if(empty($errors)) {
                    $order_comment = $this->OrderComment->newEntity([
                        "project_id" => $project_id,
                        "anken_koudo" => $project->bangou,
                        "order_id" => $order_id,
                        "juchuu_bangou" => $order->juchuu_bangou,
                        "m_supplier_id" => $m_supplier_id,
                        "last_comment_date" => Time::now(),
                        "last_user_modified" => $login_user["id"],
                        "order_user_created" => $order->user_created,
                    ]);

                    if(!$this->OrderComment->save($order_comment)) {
                        // save database error
                        $this->jsonResponse([
                            "success" => false,
                            "message" => sprintf(Message::UNSAVED),
                            "errors" => ["OrderComment"],
                        ]);
                    }
                }
            }
            
            if(empty($errors)) {
                if($this->checkPermission($order_comment, $login_user)) {
                    // create order_comment_detail
                    $order_comment_detail = $this->OrderCommentDetail->newEntity();
                    $order_comment_detail->m_user_id = $login_user["id"];
                    $order_comment_detail->order_comment_id = $order_comment->id;
                    $order_comment_detail->content = $data["content"];

                    if($this->OrderCommentDetail->save($order_comment_detail)){
                        $order_comment->last_comment_date = Time::now();
                        $order_comment->last_user_modified = $login_user["id"];

                        $this->OrderComment->save($order_comment);

                        $this->jsonResponse([
                            "success" => true,
                            "result" => [
                                'id' => $order_comment->id,
                                'm_supplier_id' => $m_supplier_id,
                                'last_comment_date' => Utility::createDate('Y/m/d H:i:s', $order_comment->last_comment_date)
                            ]
                        ]);
                    }
                    else {
                        // save database error
                        $this->jsonResponse([
                            "success" => false,
                            "message" => sprintf(Message::UNSAVED),
                            "errors" => ["OrderCommentDetail"],
                        ]);
                    }
                }
                else {
                    $this->jsonResponse([
                        "success" => false,
                        "message" => sprintf(Message::PERMISSION_DENIED),
                    ]);
                }                
            }            
        }
        
        $this->jsonResponse([
            "success" => false,
            "message" => sprintf(Message::INVALID_PARAM),
            "errors" => $errors
        ]);
    }

    /**
     * get a OrderComment
     *
     * @param  mixed $project_id
     * @param  mixed $order_id
     * @param  mixed $m_supplier_id
     *
     * @return \App\Model\Entity\OrderComment
     */
    private function getOrderComment($project_id, $order_id, $m_supplier_id) {
        $order_comment = $this->OrderComment->find()
        ->where([
            'project_id' => $project_id,
            'order_id' => $order_id,
            'm_supplier_id' => $m_supplier_id,
            'deleted is null',
        ])
        ->first();

        return $order_comment;
    }

    /**
     * check permission save comment
     *
     * @param  mixed $order_comment
     * @param  mixed $login_user
     *
     * @return Boolean
     */
    private function checkPermission($order_comment, $login_user) {
        if($login_user["type"] == MUserTable::TYPE_E_KURASHI) {
            return true; //$order_comment->order_user_created == $login_user["id"];
        }
        else if($login_user["type"] == MUserTable::TYPE_PARTNER) {
            return $login_user["m_supplier_id"] && $order_comment->m_supplier_id == $login_user["m_supplier_id"];
        }
        else return false;
    }
}
