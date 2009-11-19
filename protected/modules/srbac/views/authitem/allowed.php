<?php
/**
 * allowed.php
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @link http://code.google.com/p/srbac/
 */

/**
 * The view for the editing of the alwaysAllowed list
 *
 * @author Spyros Soldatos <spyros@valor.gr>
 * @package srbac.views.authitem
 * @since 1.1.0
 */
?>
<?php

//CVarDumper::dump($controllers, 3, true);
foreach ($controllers as $n=>$controller) {
  $title = $controller["title"];
  $data = array();
  foreach ($controller["actions"] as $key=>$val) {
    $data[$val] = $val;
  }
  if(sizeof($data) > 0) {
    $select = $controller["allowed"];
    // It seems that this tabview conflicts with assign tabview so I raise the tab number by 3
    //$cont[$n+3]["title"] = str_replace("Controller", "", $title);
    //$cont[$n+3]["content"] = CHtml::checkBoxList($title, $select, $data);


    $cont["tab_".$n] = array(
              "title"=>str_replace("Controller", "", $title),
              "content"=>CHtml::checkBoxList($title, $select, $data));
  }
}
?>
<?php echo CHtml::form();?>
<div class="vertTab">
  <?php
  $this->widget('system.web.widgets.CTabView',
      array(
      'tabs'=>$cont,
      'cssFile'=>$this->module->css,
  ));
  ?>
</div>
<div class="action">
  <?php echo CHtml::ajaxSubmitButton(Helper::translate("srbac", "Save"),
  array('saveAllowed'),
  array(
  'type'=>'POST',
  'update'=>'#wizard',
  'beforeSend' => 'function(){
    $("#wizard").addClass("srbacLoading");
    }',
  'complete' => 'function(){
    $("#wizard").removeClass("srbacLoading");
    }',
  ),
  array(
  'name'=>'buttonSave',
  )
  )
  ?>
</div>
<?php echo CHtml::endForm();?>
<!--Adjust tabview height--->
<script type="text/javascript">
  $(".view").height($(".tabs").height()-16);
</script>
