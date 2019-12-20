<?php

//公共函数文件

  //用户id
  function getUserId(){
     $user= session('user');
     return $user;
  }
