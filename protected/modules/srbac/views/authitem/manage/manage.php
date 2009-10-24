<?php if(!$full){
    $this->renderPartial("frontpage", array('images'=>$images));
?>
<div id="wizardButton" style="text-align:left" class="controlPanel marginBottom">
  <?php echo CHtml::ajaxLink(
                CHtml::image($this->module->imagesPath.'/admin.png',
                    $this->module->tr->translate('srbac','Manage AuthItem'),
                    array('class'=>'icon',
                      'title'=>$this->module->tr->translate('srbac','Manage AuthItem'),
                      'border'=>0
                      )
                ),
                array('manage','full'=>true),
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
                    'name'=>'buttonManage',
                    'onclick'=>"$(this).css('font-weight', 'bold');$(this).siblings().css('font-weight', 'normal');",
                )
            );
  ?>
<?php echo CHtml::ajaxLink(
                CHtml::image($this->module->imagesPath.'/wizard.png',
                $this->module->tr->translate('srbac','Autocreate Auth Items'),
                array('class'=>'icon',
                  'title'=>$this->module->tr->translate('srbac','Autocreate Auth Items'),
                  'border'=>0
                  )
                ),
                array('auto'),
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
                    'name'=>'buttonAuto',
                    'onclick'=>"$(this).css('font-weight', 'bold');$(this).siblings().css('font-weight', 'normal');",
                )
            );
  ?>
</div>
<br />
<?php } ?>
<div id="wizard">
  <table class="srbacDataGrid" align="center">
    <tr>
      <th width="50%"><?php echo $this->module->tr->translate('srbac','Auth items')?></th>
      <th><?php echo $this->module->tr->translate('srbac','Actions')?></th>
    </tr>
    <tr>
      <td valign="top" align="center">
        <div id="list">
            <?php echo $this->renderPartial('manage/list', array(
                    'models'=>$models,
                    'pages'=>$pages,
                    'sort'=>$sort,
                    'images'=>$images
                    )); ?>
        </div>
      </td>
      <td valign="top">
        <div id="preview">

        </div>
      </td>
    </tr>
  </table>
</div>