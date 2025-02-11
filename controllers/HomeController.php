<?php

class HomeController
{

  public function __construct() {}

  public function index()
  {

    loadView('users/home');
  }
}
