<div id="memo-box-two"><!--memo-box-two-->

<div class="memo-head"><!--memo-head-->

<img src="<?php echo Yii::app()->params['cssUrl']; ?>/images/basic-search.jpg">


</div><!--memo-head--><!--memo-sub-->




<?php $searchForm=$this->beginWidget('CActiveForm', array(
	'id'=>'users-search-searchForm',
	'enableAjaxValidation'=>false,
)); ?>	


	<?php echo $searchForm->errorSummary($searchModel); ?>

		
<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php echo $searchForm->labelEx($searchModel,'bride',array('class'=>'txt_rg_index')); ?>
</div>
	<div class="memo-sub_right_small"><!--memo-sub_right_small-->		
		<?php echo $searchForm->checkBox($searchModel,'bride', array('value'=>1, 'uncheckValue'=>0),array('class'=>'radio-new')); ?>Bride
		<?php echo $searchForm->checkBox($searchModel,'groom', array('value'=>1, 'uncheckValue'=>0),array('class'=>'radio-new_size')); ?>Groom
		<?php echo $searchForm->error($searchModel,'name'); ?>
	</div>
	
<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php echo $searchForm->labelEx($searchModel,'startAge',array('class'=>'txt_rg_index')); ?>
</div>
<div class="memo-sub_right_small"><!--memo-sub_right_small-->		
		<?php echo CHtml::dropDownList('startAge',null,Utilities::getRegDays(),array('class'=>'index_year_memo_1')); ?>
		<span class="txt_rg">To&nbsp;&nbsp;</span>
    	<?php echo CHtml::dropDownList('endAge',null,  Utilities::getRegYears(),array('class'=>'index_year_memo_1')); ?>
</div>
	
<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php echo $searchForm->labelEx($searchModel,'religion',array('class'=>'txt_rg_index')); ?>
</div>
<div class="memo-sub_right_small"><!--memo-sub_right_small-->
		<?php $records = Religion::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'religionId', 'name');
		echo CHtml::dropDownList('religion',null,$list,array('empty' => 'Religion'),array('class'=>'index_254_memo')); ?>
		<?php echo $searchForm->error($searchModel,'religion'); ?>
	</div>
		
<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php echo $searchForm->labelEx($searchModel,'motherTounge',array('class'=>'txt_rg_index')); ?>
</div>
<div class="memo-sub_right_small"><!--memo-sub_right_small-->
	<?php $records = Languages::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'languageId', 'name');
		echo CHtml::dropDownList('motherTounge',null,$list,array('empty' => 'Mother Tounge'),array('class'=>'index_254_memo')); ?>
		<?php echo $searchForm->error($searchModel,'motherTounge'); ?>
	</div>
	
<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php echo $searchForm->labelEx($searchModel,'caste',array('class'=>'txt_rg_index')); ?>
</div>
<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php $records = Caste::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'casteId', 'name');
		echo CHtml::dropDownList('caste',null,$list,array('empty' => 'Caste'),array('class'=>'index_254_memo')); ?>
		<?php echo $searchForm->error($searchModel,'caste'); ?>
	</div>	

<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php echo $searchForm->labelEx($searchModel,'state',array('class'=>'txt_rg_index')); ?>
</div>
<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php $records = States::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'stateId', 'name');
		echo CHtml::dropDownList('state',null,$list,array('empty' => 'State'),array('class'=>'index_254_memo')); ?>
		<?php echo $searchForm->error($searchModel,'state'); ?>
	</div>
	
<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php echo $searchForm->labelEx($searchModel,'district',array('class'=>'txt_rg_index')); ?>
</div>
<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php $records = Districts::model()->findAll("active = 1");
		$list = CHtml::listData($records, 'districtId', 'name');
		echo CHtml::dropDownList('state',null,$list,array('empty' => 'State'),array('class'=>'index_254_memo')); ?>
		<?php echo $searchForm->error($searchModel,'district'); ?>
	</div>
	
	
<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php echo $searchForm->labelEx($searchModel,'heightStart',array('class'=>'txt_rg_index')); ?>
</div>

<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php echo CHtml::dropDownList('heightStart',null,Utilities::getRegDays(),array('class'=>'index_254_memo')); ?>
		<?php echo $searchForm->error($searchModel,'name'); ?>
	</div>

<div class="memo-sub_left_small"><!--memo-sub_left_small-->
	
	<p class="txt_rg_index"></p>
	</div><!--/memo-sub_left-->

		<div class="memo-sub_right_small"><!--memo-sub_right_small-->

<p class="txt_rg_index">To</p>
	  </div><!--/memo-sub_right-->

<div class="memo-sub_left_small"><!--memo-sub_left_small-->
	
	<p class="txt_rg_index"></p>
	</div><!--/memo-sub_left-->

		<div class="memo-sub_right_small"><!--memo-sub_right_small-->

	<?php echo CHtml::dropDownList('heightLimit',null,Utilities::getRegDays(),array('class'=>'index_254_memo')); ?>	
	</div>
	
<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php echo $searchForm->labelEx($searchModel,'bodyType',array('class'=>'txt_rg_index')); ?>
</div>
<div class="memo-sub_right_small"><!--memo-sub_right_small-->
		<?php echo CHtml::dropDownList('bodyType',null,Utilities::getRegDays(),array('class'=>'index_254_memo')); ?>
		<?php echo $searchForm->error($searchModel,'name'); ?>
	</div>		
		
	<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<p class="txt_rg_index"></p>

	</div><!--/memo-sub_left-->
		<div class="memo-sub_right_small"><!--memo-sub_right_small-->
		<?php echo CHtml::dropDownList('bodyColor',null,Utilities::getRegDays(),array('class'=>'index_254_memo')); ?>
	</div>
	
	<div class="memo-sub_left_small"><!--memo-sub_left_small-->
		<?php echo $searchForm->labelEx($searchModel,'photo',array('class'=>'txt_rg_index')); ?>
	</div>
	<div class="memo-sub_right_small"><!--memo-sub_right_small-->	
		<?php echo $searchForm->checkBox($searchModel,'photo', array('value'=>1, 'uncheckValue'=>0),array('class'=>'mrgn_top_3')); ?>
		<?php echo $searchForm->error($searchModel,'photo'); ?>
	</div>


	<div class="memo-sub_left_small"><!--memo-sub_left_small-->
	
	
	</div><!--/memo-sub_left-->

	<div class="memo-sub_right_btn2"><!--memo-sub_right_small-->
        
        <div class="right">

		<?php echo CHtml::submitButton('Search',array('class'=>'reset_sub')); ?>
		
		<?php echo CHtml::resetButton('Reset',array('class'=>'reset_sub')); ?>
	</div>
	</div>
	<p class="space-0px">&nbsp;</p>

<?php $this->endWidget(); ?>

</div>