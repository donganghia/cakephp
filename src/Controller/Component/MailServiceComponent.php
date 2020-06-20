<?php
namespace App\Controller\Component;

use App\Libs\Constant;
use App\Libs\Message;
use Cake\Controller\Component;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Mailer\Email;


class MailServiceComponent extends Component {

    static $SPAM_MAIL = [];
    static $BCC_MAIL = [];

    /* @var Controller */
    public $controller;

    public function initialize(array $config) {
        parent::initialize($config);

        //Accessing a Component’s Controller
        $this->controller = $this->_registry->getController();
    }

    public function sendMail($data) {
        $intTimeCheck = 60; //second
        $intLastContact = Configure::read('Session.lastContact');
        if(!$intLastContact) {
            $intLastContact = 0;
        }

        $email    = $data['to'];
        $mailBody = $data['body'];
        $subject  = $data['subject'];
        $bcc      = isset($data['bcc']) ? $data['bcc'] : '';
        $reply    = isset($data['reply']) ? $data['reply'] : '';
        $template = isset($data['template']) ? $data['template'] : '';
        $view     = isset($data['view']) ? $data['view'] : [];
        $format   = isset($data['format']) ? $data['format'] : 'html';

        $intNow = time();

        $aryResult['status'] = false;

        if(in_array($email, self::$SPAM_MAIL)) {
            $this->controller->getRequest()->getSession()->write('Mail.lastContact', $intNow);
            $aryResult['status'] = true;
        } else if($intNow - $intLastContact > $intTimeCheck) {
            $this->controller->getRequest()->getSession()->write('Mail.lastContact', $intNow);
            $objEmail = new Email('default');
            $strUserNameEmail = current($objEmail->getFrom());
            $strReplyEmail = $strUserNameEmail;

            $objEmail
                ->setTo($email)
                ->setSubject($subject);

            if($bcc)
                $objEmail->setBcc($bcc);

            if($reply)
                $objEmail->setReplyTo($strReplyEmail);

            if($format)
                $objEmail->setEmailFormat($format);

            if($template)
                $objEmail->setTemplate($template);

            if($view)
                $objEmail->setViewVars($view);

            $objEmail->send();
            $aryResult['status'] = true;
        } else {
            $message = $intTimeCheck + $intLastContact - $intNow;
            $aryResult['msg'] = html_entity_decode(sprintf(Message::SEND_MAIL_ERROR, $message));
        }

        return $aryResult;
    }
}