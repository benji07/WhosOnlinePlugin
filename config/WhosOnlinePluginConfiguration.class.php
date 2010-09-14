<?php


class WhosOnlinePluginConfiguration extends sfPluginConfiguration
{
  
  public function initialize()
  {
    $this->dispatcher->connect('user.change_authentication', array('WhosOnlineSessionTable', 'refreshSession'));
  }
}