	// townValidation: custom[alphanumericOnly]
				function validateTown(field, rules, i, options) {
					var pattern = new RegExp(options.allrules.alphanumericOnly.regex);
					if(field.val().length) {
						 if(!pattern.test(field.val())){
							return options.allrules.alphanumericOnly.alertText;
						}
					}
				}
				
				
				// PostCodeValidation : minSize[6], maxSize[20], custom[alphanumericOnly]
				function validatePostCode(field, rules, i, options) {
					var pattern = new RegExp(options.allrules.alphanumericOnly.regex);
					if(field.val().length) {
						if(field.val().length < 6) {
							return options.allrules.minSize.alertText+'6 characters';
						} else if(!pattern.test(field.val())){
							return options.allrules.alphanumericOnly.alertText;
						}
					}
				}
				
				
				
				
				function validateCountryCode(field, rules, i, options) {
					var pattern = new RegExp(options.allrules.contryCode.regex);
					if(field.val().length) {
						if(!pattern.test(field.val())){
							return options.allrules.contryCode.alertText;
						}
					} 
				}
				
				//Name Validation : minSize[2], maxSize[30], custom[alphabetsOnly]
				function validateName(field, rules, i, options) {
				
					var pattern = new RegExp(options.allrules.alphabetsOnly.regex);
					if(field.val().length) {
						if(field.val().length < 2) {
							return options.allrules.minSize.alertText+'2 characters';
						} else if(!pattern.test(field.val())){
							return options.allrules.alphabetsOnly.alertText;
						}
					}
				}
				function checkAge(options) {
					if($('#day').val() != '00' && $('#month').val() != '00' && $('#year').val() != '0000') {
						var selectedDate = new Date($('#year').val(),$('#month').val(),$('#day').val());
						var oneYear = 365*1000*60*60*24;
						var validAge = 18;
						var currentDate = new Date();
						var diffYears = Math.round((currentDate.getTime()-selectedDate.getTime())/(oneYear));
						if(diffYears < validAge) {
							return options.allrules.dateValidate.alertText;
						} else if(validAge == diffYears) {
							var currMonth = parseInt(currentDate.getMonth());
							if(parseInt($('#month').val()) > parseInt(currMonth)) {
								return options.allrules.dateValidate.alertText;
							} else if(parseInt($('#month').val()) == parseInt(currMonth)) { 
								var currDay = currentDate.getDate();
								if(parseInt($('#day').val()) > parseInt(currDay)) {
									return options.allrules.dateValidate.alertText;
								}
							}
						}			
									
					} 
				}
				
				function checkDay(options)
                {
				
                var year = $('#year').val();
                var day = parseInt($('#day').val());
                
				  if($('#day').val() != '00' && $('#month').val() == '02' && $('#year').val() != '0000') {
                       
                      var isleap = (year % 4 == 0 && (year % 100 != 0 || year % 400 == 0));
					 
                      if (day > 29 || (day==29 && !isleap)) {
					  
                            return true;
                             
                       }
                }
				
				 if($('#day').val() != '00' && (($('#month').val() == '04')||($('#month').val() == '06') || ($('#month').val() == '09')|| ($('#month').val() == '11')) && $('#year').val() != '0000') {
                       
                       if (day > 30) {
					  
                            return true;
                             
                       }
                }
                
                
                
                 return false;
                }

				
				
				function validatePhone(field, rules, i, options) {
					if(field.val().length) {
						var pattern = new RegExp(options.allrules.phone.regex);
						if(field.val().length < 7) {
							return options.allrules.minSize.alertText+'7 characters';
						} else if(!pattern.test(field.val())){
							return options.allrules.phone.alertText;
						}
					}
				}
				/**
				 *
				 * @param {jqObject} the field where the validation applies
				 * @param {Array[String]} validation rules for this field
				 * @param {int} rule index
				 * @param {Map} form options
				 * @return an error string if validation failed
				 */
				function checkDayValidation(field, rules, i, options) {
					var flag;
				     if (field.val() == '00') {
						return options.allrules.dateValidate.alertText;
					}
				     flag = checkDay(options);
						if(flag==true){
						return options.allrules.dateValidate.alertText;
						}
					return checkAge(options);
				}
				 /**
				 *
				 * @param {jqObject} the field where the validation applies
				 * @param {Array[String]} validation rules for this field
				 * @param {int} rule index
				 * @param {Map} form options
				 * @return an error string if validation failed
				 */
				function checkMonthValidation(field, rules, i, options) {
				var flag;
		            if (field.val() == '00') {
						return options.allrules.dateValidate.alertText;
					}
		            flag = checkDay(options);
						if(flag==true){
						return options.allrules.dateValidate.alertText;
						}
		            return checkAge(options);
				}	
				 /**
				 *
				 * @param {jqObject} the field where the validation applies
				 * @param {Array[String]} validation rules for this field
				 * @param {int} rule index
				 * @param {Map} form options
				 * @return an error string if validation failed
				 */
				function checkYearValidation(field, rules, i, options) {
				var flag;
		            if (field.val() == '0000') {
						return options.allrules.dateValidate.alertText;
					}
						flag = checkDay(options);
						if(flag==true){
						return options.allrules.dateValidate.alertText;
						}
		            return checkAge(options);
					//if(currentYear - field.val() 
				}	
				 
				 
				 function checkSecretQuestion(field, rules, i, options){
					 if (field.val() == '00') {
							return options.allrules.secretQuestionValidate.alertText;
						}
					 
					 
				 }
				/**
				 *
				 * @param {jqObject} the field where the validation applies
				 * @param {Array[String]} validation rules for this field
				 * @param {int} rule index
				 * @param {Map} form options
				 * @return an error string if validation failed
				 */
				function checkEmailValidation(field, rules, i, options) {
					var pattern = new RegExp(options.allrules.email.regex);
		            if (field.val().length && !pattern.test(field.val())) {
						return options.allrules.email.alertText;
					}
						
						
					
				}
				//username , password validation: minSize[6], maxSize[32], custom[alphabetsUnderscoreOnly]
				function comparePasswordUsername(field, rules, i, options) {
				
					var pattern = new RegExp(options.allrules.alphabetsUnderscoreOnly.regex);
					if(field.val().length) {
						if(field.val().length < 6) {
							return options.allrules.minSize.alertText+'6 characters';
						} else if(!pattern.test(field.val())){
							return options.allrules.alphabetsUnderscoreOnly.alertText;
						} else 	if($('#password').val() == $('#username').val()) {
							return options.allrules.userpwdmatch.alertText;
						}
					}
					
				}
				
				
				function validateUserName(field, rules, i, options) {
				
					var pattern = new RegExp(options.allrules.alphabetsUnderscoreOnly.regex);
					if(field.val().length) {
						if(field.val().length < 6) {
							return options.allrules.minSize.alertText+'6 characters';
						} else if(!pattern.test(field.val())){
							return options.allrules.alphabetsUnderscoreOnly.alertText;
						} else 	if($('#password').val() == $('#username').val()) {
							return options.allrules.userpwdmatch.alertText;
						}
						var success = "true";
					}
					if(success=="true"){
						var result = checkUserName();
						
						if(result==true){
						jQuery('#username').validationEngine('hidePrompt');
						
					}else{
						return result;
					}
				}
			}	
				function equalsPassword(field, rules, i, options) {
					if(field.val().length && field.val() != $('#password').val()) {
						return options.allrules.equals.alertText;
					}
				}
				
				function updateGender() {
					if($(this).val() == 'Ms' || $(this).val() == 'Miss' || $(this).val() == 'Mrs') {
						$('input:radio[id=gender]')[1].checked = true;
					} else {
						$('input:radio[id=gender]')[0].checked = true;
					}
				}
				function displayFindAddress() {
					
					if($(this).val() != 'GBR') {
						$('#faContainer').css('display','none');
						$("#postcode").attr('maxlength', 20);
					} else {
						$('#faContainer').css('display','block');
						$("#postcode").attr('maxlength', 6);

					}
				}
				
				function validateLimit(field, rules, i, options) {
					if ( parseInt(field.val()) < 5) {
						return false;
					}
				}
				
				
				function validateAmount(field, rules, i, options) {
					var pattern = new RegExp(options.allrules.validateAmt.regex);
					if (field.val().length) {
						if (!pattern.test(field.val())) {
							return options.allrules.validateAmt.alertText;
						}else{
							if(!validateLimit(field,rules,i,options))
							return options.allrules.requiredDepositlimit.alertText;
						}
					}
				}
				
				
	