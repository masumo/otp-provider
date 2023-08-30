<?php

namespace App\Livewire;

use Livewire\Component;
use Webklex\IMAP\Facades\Client; 

class Yparser extends Component
{
    public $message = "belum konek";

    public function parse(){
        $client = Client::account("default");  
        $client->connect();  
        /*
        if($client->isConnected()) { 
            $this->message = "udah konek"; 
        } 
        */
        
        $oFolder = $client->getFolder('Inbox');
        //$status = $oFolder->getStatus();
        //$this->message = (string)$status;
        $emails = $oFolder->query()->unseen()->text('Steam Account')->markAsRead()->get();
        foreach($emails as $email){
            $body = $email->getTextBody();
            $this->message = $body;
        }     
        
        
		return 0;

    }

    public function render()
    {
        $this->parse();
        return view('livewire.yparser');
    }
}
