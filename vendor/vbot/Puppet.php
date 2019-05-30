<?php
use   Hanson\Vbot\Foundation\Vbot;
use   Illuminate\Support\Collection;
use   Hanson\Vbot\Message\Image;

require_once __DIR__.'/vendor/autoload.php';

class Puppet extends Vbot{
  public function sendtext($username, $msg){
      Hanson\Vbot\Message\Text::send($username,$msg);
  }
  public function sendimages($username,$path){
      Image::send($username,$path);
  }
  public function vbot_user($name){
    return vbot($name);
  }

  public function lalala(){
    echo 1111;exit;
  }

}
