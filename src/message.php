<?php
class Message{
    private $message=array();
    private $msgcounter=0;
    private $type;

    public function __construct($type){
        $this->type=$type;
    }

    public function pushMsg($msg){
        $this->message[]=$msg;
        $this->msgcounter++;
    }

    public function getMsgCount(){
        return $this->msgcounter;
    }

    public function printMessage(){
       return array(
                'type'=>$this->type,
                'msgcounts'=>$this->msgcounter,
                'message'=>$this->message);
    }

    public function printJsonMsg(){
        echo json_encode($this->printMessage());
    }
}

/* Documentation of Use */

// $msg=new Message('err');
// $msg->pushMsg("abc");
// $msg->pushMsg("xyz");
// $msg->pushMsg("lmn");

// echo $msg->getMsgCount();
// echo $msg->printJsonMsg();
?>