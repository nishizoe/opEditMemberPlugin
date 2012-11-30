<?php

class opMemberSearchForm extends BaseForm
{
  public function __construct($defaults = array(), $options = array())
  {
    parent::__construct($defaults, $options, false);
  }

  public function configure()
  {
    $widgets = array();
    $validators = array();

    $widgets += array('id' => new sfWidgetFormInputText());
    // todo:nullチェックしてくれない。
    $validators += array('id' => new sfValidatorString(array('required' => true)));

    $this->setWidgets($widgets);
    $this->setValidators($validators);
  }

  protected function addIdColumnQuery(Doctrine_Query $query, $value)
  {
    if (!empty($value))
    {
      $query->andWhere('id = ?', $value);
    }
  }

  public function getQuery()
  {
    $isWhere = false;
    $ids = null;
    $q = Doctrine::getTable('Member')->createQuery();
    $this->addIdColumnQuery($q, $this->getValue('id'));
    $profileValues = array();
    $ids = Doctrine::getTable('MemberProfile')->searchMemberIds($profileValues, $ids, $this->getOption('is_check_public_flag', true));
    return $q;
  }
}
