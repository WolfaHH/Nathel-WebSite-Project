<?php

//require('.php');

class Controller
{

 

  public function home()
  {
    require('home.php');
  }

  public function mappools()
  {
    require('mappools.php');
  }

  public function error(){
    require('404.php');
  }
}


