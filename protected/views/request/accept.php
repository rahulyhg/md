<?php
/*
*
* $Id$
--------------------------------------------------------------------------------------------------------------------------
* Information contained in this file is the intellectual property of Ladbrokes Plc
* Copyright © 2012 MarryDorr. All Rights Reserved.
* ---------------------------------------------------------------------------------------------------------------------------
*
* @author  Dileep Gopalan
* @title accept.php
* @description <Description of this class>
*  @filesource <URL>
*  @version <Revision>
*/
?>
      <?php $this->widget('application.widgets.menu.Leftmenu'); ?>
       <section class="data-contnr2">
        <h1 class="mB10">Requests</h1>
        <div class="interstTab">
			<div class="edit-option">
				<div class="check">
					<input type="checkbox" />
					<span>Sellect All</span>
				</div>
				<div class="check">
					<span><a href="#">Delete</a></span>
				</div>
			</div>
			<ul class="tab-head">
				<li id="tab1">
					<a id="tab1" href="#" class="select">Recieved</a>
				</li>
				<li id="tab2"> 
					<a id="tab2" href="#" >Sent</a>
				</li>
				<li id="tab3">
					<a id="tab3" href="#" >Accepted</a>
				</li>
				<li id="tab4">
					<a id="tab4" href="#" >Declined</a>
				</li>
			</ul>
			<!-- received starts here -->
			<ul id="tab1_data" class="tab-data" style="display: block;">
				<li>
					<div class="optns">
						<div class="option_cont">
							Filter
							<a href="#">My album</a> |
							<a href="#">Family Album</a> |
							<a href="#">Documents</a> |
							<a href="#">Reference</a> |
							<a href="#">Astro</a> |
							<a href="#">Contact</a>
						</div>
					</div>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/nayana.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You recieved request on 15th Augest 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">A request for viewing your Album</div>
					<a href="#" class="type6 accept">Accept</a>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/anu.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You recieved request on 15th Augest 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">A request for viewing your Documents</div>
					<a href="#" class="type6 accept">Accept</a>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/priya.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You recieved request on 15th Augest 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">A request for viewing your Contact</div>
					<a href="#" class="type6 accept">Accept</a>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/athira.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You recieved request on 15th Augest 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">A request for viewing your Album</div>
					<a href="#" class="type6 accept">Accept</a>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/priya.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You recieved request on 15th Augest 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">A request for viewing your Album</div>
					<a href="#" class="type6 accept">Accept</a>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<img src="./images/user/interest_default.png" alt="" />
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You recieved request on 15th Augest 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">A request for viewing your Album</div>
					<a href="#" class="type6 accept">Accept</a>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/nayana.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You recieved request on 15th Augest 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">A request for viewing your Documents</div>
					<a href="#" class="type6 accept">Accept</a>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/priya.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You recieved request on 15th Augest 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">A request for viewing your Album</div>
					<a href="#" class="type6 accept">Accept</a>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<img src="./images/user/interest_default.png" alt="" />
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You recieved request on 15th Augest 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">A request for viewing your Contact</div>
					<a href="#" class="type6 accept">Accept</a>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<img src="./images/user/interest_default.png" alt="" />
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You recieved request on 15th Augest 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">A request for viewing your Album</div>
					<a href="#" class="type6 accept">Accept</a>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/athira.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You recieved request on 15th Augest 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">A request for viewing your Album</div>
					<a href="#" class="type6 accept">Accept</a>
					<a href="#" class="type6 decline">Decline</a>
				</li>
			</ul>
			<!-- received end here -->
			<!-- sent starts here -->
			<ul id="tab2_data" class="tab-data" style="display: none;">
				<li>
					<div class="optns">
						<div class="option_cont">
							Filter
							<a href="#">My album</a> |
							<a href="#">Family Album</a> |
							<a href="#">Documents</a> |
							<a href="#">Reference</a> |
							<a href="#">Astro</a> |
							<a href="#">Contact</a> 
						</div>
					</div>
					<div class="optns">
						<div class="option_cont">
							<a class="color" href="#">By You</a> |
							<a class="color" href="#">Sent to You</a> 
						</div>
					</div>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/anu.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent request on 12th Jan. 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">Sent a request for viewing her album</div>
					<a href="#" class="type6 decline">Cancel</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/priya.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent request on 12th Jan. 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">Sent a request for viewing her contacts</div>
					<a href="#" class="type6 decline">Cancel</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/nayana.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent request on 12th Jan. 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">Sent a request for viewing her family album</div>
					<a href="#" class="type6 decline">Cancel</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/athira.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent request on 12th Jan. 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">Sent a request for viewing her reference</div>
					<a href="#" class="type6 decline">Cancel</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/anu.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent request on 12th Jan. 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">Sent a request for viewing her astro details</div>
					<a href="#" class="type6 decline">Cancel</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/priya.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent request on 12th Jan. 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">Sent a request for viewing her contacts</div>
					<a href="#" class="type6 decline">Cancel</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/nayana.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent request on 12th Jan. 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">Sent a request for viewing her family album</div>
					<a href="#" class="type6 decline">Cancel</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/athira.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent request on 12th Jan. 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">Sent a request for viewing her reference</div>
					<a href="#" class="type6 decline">Cancel</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/anu.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent request on 12th Jan. 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">Sent a request for viewing her astro details</div>
					<a href="#" class="type6 decline">Cancel</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/priya.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent request on 12th Jan. 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">Sent a request for viewing her contacts</div>
					<a href="#" class="type6 decline">Cancel</a>
				</li>
			</ul>
			<!-- sent end here -->
			<!-- accepted starts here -->
			<ul id="tab3_data" class="tab-data" style="display: none;">
				<li>
					<div class="optns">
						<div class="option_cont">
							Filter
							<a href="#">My album</a> |
							<a href="#">Family Album</a> |
							<a href="#">Documents</a> |
							<a href="#">Reference</a> |
							<a href="#">Astro</a> |
							<a href="#">Contact</a> 
						</div>
					</div>
					<div class="optns">
						<div class="option_cont">
							<a class="color" href="#">By You</a> |
							<a class="color" href="#">Sent to You</a> 
						</div>
					</div>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/priya.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an album request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You accepted her album request on 09/07/12</div>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/athira.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an family album request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You accepted her family album request on 09/07/12</div>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/priya.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an document request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You accepted her document request on 09/07/12</div>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/anu.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent an album request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">She accepted your album request on 09/07/12</div>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/nayana.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an reference request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You accepted her reference request on 09/07/12</div>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/athira.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an family album request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You accepted her family album request on 09/07/12</div>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/priya.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an document request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You accepted her document request on 09/07/12</div>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/anu.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent an album request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">She accepted your album request on 09/07/12</div>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/nayana.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an reference request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You accepted her reference request on 09/07/12</div>
					<a href="#" class="type6 decline">Decline</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/athira.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent a family album request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">She accepted your family album request on 09/07/12</div>
				</li>
			</ul>
			<!-- accepted end here -->
			<!-- declined starts here -->
			<ul id="tab4_data" class="tab-data" style="display: none;">
				<li>
					<div class="optns">
						<div class="option_cont">
							Filter
							<a href="#">My album</a> |
							<a href="#">Family Album</a> |
							<a href="#">Documents</a> |
							<a href="#">Reference</a> |
							<a href="#">Astro</a> |
							<a href="#">Contact</a> 
						</div>
					</div>
					<div class="optns">
						<div class="option_cont">
							<a class="color" href="#">By You</a> |
							<a class="color" href="#">Sent to You</a> 
						</div>
					</div>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/anu.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an album request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You declined her album request on 09/07/12</div>
					<a href="#" class="type6 decline">Accept</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/athira.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent a family album request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">She declined your family album request on 09/07/12</div>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/priya.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an document request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You declined her document request on 09/07/12</div>
					<a href="#" class="type6 decline">Accept</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/anu.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent an album request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">She declined your album request on 09/07/12</div>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/nayana.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an reference request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You declined her reference request on 09/07/12</div>
					<a href="#" class="type6 decline">Accept</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/athira.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an family album request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You declined her family album request on 09/07/12</div>
					<a href="#" class="type6 decline">Accept</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/priya.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an document request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You declined her document request on 09/07/12</div>
					<a href="#" class="type6 decline">Accept</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/anu.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent an album request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">She declined your album request on 09/07/12</div>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/nayana.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(She sent an reference request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">You declined her reference request on 09/07/12</div>
					<a href="#" class="type6 decline">Accept</a>
				</li>
				<li>
					<input type="checkbox" />
					<a href="#"><img src="./images/user/athira.jpg" alt="" /></a>
					<div class="int_head">
						<a href="#" >Biju George</a>
						<span>(You sent a family album request on 07th July 2012)</span>
					</div> 
					<div class="pDetails">Chrishtian, R.c., 29 Years - 5' 4'', 167 cm</div>
					<div class="pDetails">Ankamaly, Kerala, India</div>
					<div class="pAction">She declined your family album request on 09/07/12</div>
				</li>
			</ul>
			<!-- declined end here -->
		</div>
		<div class="interstTab">
			<div class="edit-option">
				<div class="check">
					<input type="checkbox" />
					<span>Sellect All</span>
				</div>
				<div class="check">
					<span><a href="#">Delete</a></span>
				</div>
			</div>
		</div>
    </section>
      <?php $this->widget('application.widgets.menu.Rightmenu'); ?>
  