
//Postcode Anywhere Javascript Popup Service
//Version 3.0 (SlipStream engine enabled)
//Automatically generated on 04/11/2014 14:15:34 from WEB-1-1
//(c) 2001-2014 Postcode Anywhere (Europe) Ltd

if (self.location.protocol=='https:')
	{
		var pcaBaseUrlJN93 = 'https://services.postcodeanywhere.co.uk/popups';
	}
else
	{
		var pcaBaseUrlJN93 = 'http://services.postcodeanywhere.co.uk/popups';
	}
var pcaLicenseKeyJN93 = 'JN93-JP54-XW12-BB19';
var pcaAccountCodeJN93 = 'INDIV65018';
var pcaMachineIdJN93 = '';
var pcaPopupServiceJN93 = pcaBaseUrlJN93 + '/popup.aspx'; 
var pcaSetupServiceJN93 = pcaBaseUrlJN93 + '/setup.aspx'; 
var pcaInlineServiceJN93 = pcaBaseUrlJN93 + '/inline.aspx'; 
var pcaReturnUrlJN93 = self.location;
var pcaTokenJN93 = 'JN93';
var pcaPopupJN93 = window.opener;
var pcaNextStepJN93 = '';



function pcaButtonsJN93() 
	{
		
					document.write(" <input type=hidden id=pcaButtonJN93 onclick='pcaStartPopupJN93()' value='Click to find'  text='Click to automatically complete your address'>");
				
	}; 

function pcaSetupJN93() 
	{ 
		if (document.forms.length == 0)
			{
				alert("Your must have at least one HTML FORM tag on your page before you can set up Postcode Anywhere.");
			}
		else
			{
				pcaOpenSetupPopupJN93(pcaSetupServiceJN93+'?account_code='+escape(pcaAccountCodeJN93)+'&license_key='+escape(pcaLicenseKeyJN93)+'&token='+escape(pcaTokenJN93)+'&machineId='+escape(pcaMachineIdJN93)+pcaFormFieldsJN93()+'&return_to='+escape(pcaReturnUrlJN93));
			};
	}; 
	
function pcaGetFieldJN93(what) 
	{ 
		var intFieldCounter=0;
		
		for (intFormCounter=0; intFormCounter <= document.forms.length-1 ; intFormCounter++) 
			{ 
				for (elementCounter=0; elementCounter <= document.forms[intFormCounter].length-1 ; elementCounter++) 
					{ 
						if (document.forms[intFormCounter].elements[elementCounter].name==what)
							{
								return document.forms[intFormCounter].elements[elementCounter].value;
							}; 
					}; 
			};
	}; 		
	
function pcaOpenPopupJN93(what) 
	{ 
		var objWindow; 
		var strOptions; 
	
		objWindow='PCA'; 
		strOptions='toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=0,resizable=1,width=690,height=470'; 
		window.open(what, objWindow, strOptions); 
	}; 
	
function pcaOpenSetupPopupJN93(what) 
	{ 
		var objWindow; 
		var strOptions; 
	
		objWindow='PCA'; 
		strOptions='toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=0,resizable=1,width=580,height=550'; 
		window.open(what, objWindow, strOptions); 
	}; 
	
function pcaFormFieldsJN93()
	{
		var strFieldList = ""; 
		var intFieldCounter=0;
		
		for (intFormCounter=0; intFormCounter <= document.forms.length-1 ; intFormCounter++) 
			{ 
				for (elementCounter=0; elementCounter <= document.forms[intFormCounter].length-1 ; elementCounter++) 
					{ 
						strFieldList = strFieldList + "&field" + intFieldCounter + "=" + escape(document.forms[intFormCounter].elements[elementCounter].name); 
						intFieldCounter++;
					}; 
			};
		return (strFieldList);
	}
	


//Standard service component

function pcaStartPopupJN93() 
	{ 
		
	            pcaOpenPopupJN93(pcaPopupServiceJN93+'?account_code='+escape(pcaAccountCodeJN93)+'&license_key='+escape(pcaLicenseKeyJN93)+'&token='+escape(pcaTokenJN93)+'&machine_id='+escape(pcaMachineIdJN93)+'&postcode='+escape(pcaGetFieldJN93("temp_post_code"))+'&return_to='+escape(pcaReturnUrlJN93));
		    
	}; 

function pcaQueryStringJN93(what) 
	{ 
		var strBegin; 
		var strEnd; 
		var objRegEx =/\+/g; 
		
		if (self.location.search.length>1) 
			{ 
				strBegin=self.location.search.indexOf(what + "=")+what.length+1; 
				strEnd=self.location.search.indexOf("&",strBegin); 
				if (strEnd==(-1)) strEnd=self.location.search.length; 
					return unescape(String(self.location.search.substring(strBegin,strEnd )).replace(objRegEx, " ")); 
			} 
		else if (self.location.hash.length>1) 
			{ 
				strBegin=self.location.hash.indexOf(what + "=") +what.length+1; 
				strEnd=self.location.hash.indexOf("&",strBegin); 
				if(strEnd==(-1)) strEnd=self.location.hash.length; 
					return unescape(String(self.location.hash.substring(strBegin,strEnd )).replace(objRegEx, " ")); 
			}
		else 
			return(''); 
	};	
	
if (typeof(pcaPopupJN93) != 'undefined')
	{
	if (pcaQueryStringJN93('token').toUpperCase() == 'JN93') 
		{
			
			pcaSetFieldJN93("student_address_address_line_1", pcaQueryStringJN93('PAF-LINE-1-2-CO'));
			
			pcaSetFieldJN93("student_address_address_line_2", pcaQueryStringJN93('PAF-LINE-2-2-CO'));
			
			pcaSetFieldJN93("student_address_city", pcaQueryStringJN93('PAF-TOWN'));
			
			pcaSetFieldJN93("student_address_country", pcaQueryStringJN93('PAF-COUNTRY'));
			
			pcaSetFieldJN93("student_address_postal_zip_code", pcaQueryStringJN93('PAF-POSTCODE'));
			
			pcaSetFieldJN93("student_address_state_province_region", pcaQueryStringJN93('PAF-COUNTY'));
			
			window.close();
		}; 	
	}

function pcaSetFieldJN93(what, newValue) 
	{ 
		var intFieldCounter=0;
		
		for (intFormCounter=0; intFormCounter <= pcaPopupJN93.document.forms.length-1 ; intFormCounter++) 
			{ 
				for (elementCounter=0; elementCounter <= pcaPopupJN93.document.forms[intFormCounter].length-1 ; elementCounter++) 
					{ 
						if (pcaPopupJN93.document.forms[intFormCounter].elements[elementCounter].name==what)
							{
								pcaPopupJN93.document.forms[intFormCounter].elements[elementCounter].value = newValue;
							} 
					}; 
			};
	}; 		


	
pcaButtonsJN93();