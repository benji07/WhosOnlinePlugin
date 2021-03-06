<?php

/**
 * PluginWhosOnlineSessionTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginWhosOnlineSessionTable extends Doctrine_Table
{
  /**
   * Returns an instance of this class.
   *
   * @return object PluginWhosOnlineSessionTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('WhosOnlineSession');
  }
  
  public static function refreshSession(sfEvent $event)
  {
    $session_id = session_id();
    Doctrine::getTable('Session')->createQuery('s')->
      where('s.session_id = ?', session_id())->
      delete()->
      execute();
  }
  
  public static function countOnlineUser()
  {
    return self::getInstance()->createQuery()->count();
  }
  
  public static function getOnlineUserIds()
  {
    $ids = self::getInstance()->createQuery()->
              select('user_id')->
              distinct(true)->
              where('user_id IS NOT NULL')->
              execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
    
    if(!is_array($ids))
    {
      $ids = array($ids);
    }
    
    return $ids;
  }
}