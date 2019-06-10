<?php
use   Hanson\Vbot\Foundation\Vbot;
use   Illuminate\Support\Collection;
use   Hanson\Vbot\Message\Image;


class Send{
  public function sendtext($username, $msg){
      Hanson\Vbot\Message\Text::send($username,$msg);
  }
  public function sendimages($username,$path){
      Image::send($username,$path);
  }
  public function vbot_user($name){
    return vbot($name);
  }

}
