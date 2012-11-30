<?php

/**
 * editmember actions.
 *
 * @package    OpenPNE
 * @subpackage editmember
 * @author     Your name here
 */
class editMemberActions extends opEditMemberAction
{
 /**
  * Executes index action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }

  public function executeSearch(sfWebRequest $request)
  {
/*
    $this->forwardIf($request->isSmartphone(), 'member', 'smtEditProfile');
    return parent::executeEditProfile($request);
*/
    $params = $request->getParameter('member', array());
// 入力されたメンバーidをログ出力中
    sfContext::getInstance()->getLogger()->info('★★★★★★[['.$params['id'].']]');

    $this->form = new opMemberSearchForm(array(), array('use_id' => true, 'is_check_public_flag' => false));
    //$this->form->getWidgetSchema()->setLabel('name', 'Nickname');
    $this->form->bind($params);

    $this->pager = new sfDoctrinePager('Member', 20);
    if ($params)
    {
      $this->pager->setQuery($this->form->getQuery());
    }
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();

    $this->profiles = Doctrine::getTable('Profile')->retrievesAll();

    return sfView::SUCCESS;
  }


  public function executeRegist(sfWebRequest $request)
  {
    $params = $request->getParameter('member', array());
// 入力されたメンバーidをログ出力中
    sfContext::getInstance()->getLogger()->info('★★★★★★[['.$params['id'].']]');

    return sfView::SUCCESS;
  }
}
