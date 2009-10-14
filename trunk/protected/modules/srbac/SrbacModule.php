<?php

class SrbacModule extends CWebModule {

  /* @var $userid String The primary column of the users table*/
  public $userid = "userid";
  /* @var $username String The username column of the users table*/
  public $username = "username";
  /* @var $userclass String The name of the users Class*/
  public $userclass = "User";
 /* @var $debug If srbac is in debug mode */
  public $debug;
  /* @var $pagesize int The number of items displayed in each page*/
  public $pageSize = 15;
  /* @var $superUser String The name of the superuser */
  public $superUser = "Authorizer";
  /* @var $css string The css to use */
  public $css;
  /* @var $layout string the layout to use */
  public $layout ;
  /* @var $notAuthorizedView String The view to render when unathorized access*/
  public $notAuthorizedView;
  /* @var $alwaysAllowed array The actions that are always allowed*/
  public $alwaysAllowed = array();
  /* @var $userActions Array Operations assigned to users by default*/
  public $userActions = array();
  


  /**
   * this method is called when the module is being created you may place code
   * here to customize the module or the application
   */
  public function init() {

  // import the module-level models and components
    $this->setImport(array(
        'srbac.models.*',
        'srbac.components.*',
        'srbac.controllers.SBaseController'
    ));
    //Publish css
    $resources = dirname(__FILE__).DIRECTORY_SEPARATOR.'css';
    if($this->css == "") {
      $this->css =  "srbac.css";
    }
    $url = Yii::app()->assetManager->publish($resources);
    Yii::app()->clientScript->registerCssFile($url."/".$this->css);
    //Create the translation component
    $this->setComponents(
        array(
        'tr'=>array(
        'class'=>'CPhpMessageSource',
        'basePath'=> dirname(__FILE__).DIRECTORY_SEPARATOR.'messages',
        'onMissingTranslation'=>"Helper::markWords"
        ),
        )
    );
    
  }

  public function isInstalled() {
    try {
      AuthItem::model()->findAll();
      return true;
    } catch (CDbException  $exc ) {
      return false;
    }
  }
  /**
   * Gets the user's class
   * @return userclass
   */
  public function getUserModel() {
    return new $this->userclass;
  }
  /**
   * this method is called before any module controller action is performed
   *  you may place customized code here
   * @param CController $controller
   * @param CAction $action
   * @return boolean
   */
  public function beforeControllerAction($controller, $action) {
    if(parent::beforeControllerAction($controller, $action)) {
      $controller->layout = $this->layout;
      return true;
    }
    else
      return false;
  }
}
