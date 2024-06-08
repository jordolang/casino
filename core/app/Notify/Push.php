<?php

namespace App\Notify;

use App\Lib\CurlRequest;
use App\Notify\NotifyProcess;
use App\Notify\Notifiable;

class Push extends NotifyProcess implements Notifiable{

    /**
    * Device Id of receiver
    *
    * @var array
    */
	public $deviceId;

    public $redirectUrl;

    public $pushImage;


    /**
    * Assign value to properties
    *
    * @return void
    */
	public function __construct(){
		$this->statusField = 'push_status';
		$this->body = 'push_body';
		$this->globalTemplate = 'push_template';
		$this->notifyConfig = 'firebase_config';
	}


    public function redirectForApp($getTemplateName){

        $screens = [

        ];

        foreach($screens as $screen => $array){
            if(in_array($getTemplateName ,$array)){
                return $screen;
            }
        }

        return 'HOME';
    }


    /**
    * Send notification
    *
    * @return void|bool
    */
	public function send(){
		//get message from parent
		$message = $this->getMessage();
        if (gs('pn') && $message) {
            try{
                $data = [
                    'registration_ids'=>$this->deviceId,
                    'notification'=>[
                        'title'=> $this->getTitle(),
                        'body'=> $message,
                        'icon'=> siteFavicon(),
                        'click_action'=>$this->redirectUrl,
                        'image'=>asset(getFilePath('push')).'/'.$this->pushImage,
                        'priority'=> 'high'
                    ],
                    'data'=>[
                        'for_app'=>$this->redirectForApp($this->templateName)
                    ]
                ];

                $dataString = json_encode($data);

                $headers = [
                    'Authorization:key=' . gs('firebase_config')->serverKey,
                    'Content-Type: application/json',
                    'priority:high'
                ];

                CurlRequest::curlPostContent('https://fcm.googleapis.com/fcm/send',$dataString,$headers);
                $this->createLog('push');
            }catch(\Exception $e){
                $this->createErrorLog($e->getMessage());
                session()->flash('firebase_error',$e->getMessage());
            }
        }

    }



    /**
    * Configure some properties
    *
    * @return void
    */
	public function prevConfiguration(){
		if ($this->user) {
            $this->deviceId = $this->user->deviceTokens()->pluck('token')->toArray();
			$this->receiverName = $this->user->fullname;
		}
		$this->toAddress = $this->deviceId;
	}

    private function getTitle(){
        return $this->replaceTemplateShortCode($this->template->push_title ?? gs('push_title'));
    }
}
