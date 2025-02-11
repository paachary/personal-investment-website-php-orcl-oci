<?php

class Authorize
{

  public function isAuthenticated()
  {
    return Session::has('user');
  }

  public function handleRquest($role)
  {
    if ($role === 'guest' && $this->isAuthenticated()) {
      return redirect("/");
    } elseif ($role === 'auth' && !$this->isAuthenticated()) {
      return redirect("/auth/login");
    }
  }
}
