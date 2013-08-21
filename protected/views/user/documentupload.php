<div class="subContent">
			<section class="subHead">
				<h1 class="width100">Upload Documents</h1>
			</section>
			<section class="subContnr">
				<ul class="accOverview pmB10">
					<li class="mT15 mB0">
					<form action="<?php echo Utilities::createAbsoluteUrl('user','documentupload'); ?>" method="post" enctype="multipart/form-data"  id="frmDocuments">
					<input type="hidden" name="documentCount" id="documentCount"  value="2" />
					<input type="hidden" name="totalCount" id="totalCount" value="<?php echo !empty($documents)? count($documents)+1:1;?>" />
					<input type="hidden" name="updateDocument" id="updateDocument"  value="" />						
					<?php if(count($documents) < 5){?>
						<div class="urOnly">Upload Your Docs Only in any Image format</div>
						<div class="uploadCn">
							<input type="file" name="profileDocument_1" id="profileDocument_1" />
						 <select class="select_small_140" id="documentType_1" name="documentType_1" class="wid200">
						 <option value="0">Select Document Type</option>
						 <option value="1">Passport</option>
						 <option value="2">Voters ID</option>
						 <option value="3">PAN Card</option>
						 <option value="4">ADHAR Card</option>
						 <option value="5">Ration Card</option>
						 <option value="6">University Certificate</option>
						 <option value="7">SSLC Book</option>
						 <option value="8">Bank Pass Book</option>
						 <option value="9">Driving Licence</option>
						 <option value="10">Birth Certificate</option>
						 </select>
						</div>
						<div id="documentContainer" style="margin-bottom:10px;"></div>
						<div class="uploadCn mT5">
							<a href="#" class="type3" name="moredocuments" id="moredocuments"  onClick="addMoreDocuments();">Add More</a>
							<input type="button" name="uploaddocuments" id="uploaddocuments" class="type3" value="Upload" onclick="uploadDocuments();" />
						</div>
						<?php }?>
						<?php if(!empty($documents)):?>
						<h5 class="width100 mT30">Please mouse hover on a document to delete or cancel.</h5>
						<?php endif; ?>
					
					</li>
					<?php if(!empty($documents)):?>
					<li >
						<div class="upUrF">
						<?php foreach($documents as $document):?>
							<div class="upCn">
								<div class="delt">
									<a href="<?php echo Yii::app()->params['homeUrl']?>/user/documentupload/r/deletedocument/dId/<?php echo $document->documentId?>/uId/<?php echo $user->userId?>" title="click to delete this picture">Delete</a>
								</div>
								<img src="<?php echo Utilities::getDocumentImage($user->marryId,$document->documentName); ?>" alt="" width="135" height="70" />
								<div class="name"><?php echo Utilities::getDocumentType($document->documentType)?></div>
							</div>
						<?php endforeach;?>
						</div>
					</li>
					<?php endif; ?>
					<!-- 
					<li class="mT25">
						<div class="whoCan">Who can view Documents</div>
						<div class="check ">
						<input type="checkbox" name="documentview" id="documentview" value="subscribers" <?php  if($documentsettings->privacy == 'subscribers'){ ?> checked="checked" <?php } ?>> <span>Subscribers</span>
						</div>
						<div class="check ">
							<input type="checkbox" name="documentview" id="documentview" value="request" <?php  if($documentsettings->privacy == 'request'){ ?> checked="checked" <?php } ?>> <span>By request</span>
						</div>
					</li>
					 -->
					<li>
						<input type="button" name="cancelDocument" id="cancelDocument" value="Cancel" class="type2b mL5" onclick="javascript:closeOverlay('<?php echo Utilities::createAbsoluteUrl('ajax','documentclear')?>');" />
						<input type="button" name="submitDoc" id="submitDoc" value="Submit" class="type2b mL5" onclick="submitDocuments();" />
					</li>
					</form>
				</ul>
			</section>