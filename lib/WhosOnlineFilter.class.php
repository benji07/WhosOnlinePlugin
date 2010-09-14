<?php


class WhosOnlineFilter extends sfFilter
{
  
  public function execute($filterChain)
  {
    if($this->isFirstCall())
    {
      
      $time = sfConfig::get('app_whos_online_time',10);
      
      Doctrine_Query::create()->
        delete('WhosOnlineSession')->
        where('created_at < ?', date('Y-m-d H:i:s', strtotime('- '.$time.' min')))->
        orWhere('session_id = ?', session_id())->
        execute();
    
      $s = new WhosOnlineSession();
      $s->user_id = $this->getContext()->getUser()->getUserId();
      $s->session_id = session_id();
      $s->save();
    }
    
    $filterChain->execute();
  }
}