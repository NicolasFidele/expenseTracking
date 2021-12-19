function reg_validate(){
	//validate password and confirm password in register.php
	var pass = document.getElementById("password").value;
	var confirmpass = document.getElementById("confirmpassword").value;
	if(pass==""){
		alert("Please enter a password."); 
		return false;
	}
	if(pass.length < 6){
		alert("Password is too short."); 
		return false;
	}
	if (pass != confirmpass){
		alert("Passwords do not match. Please try again!");
		return false;
	}
}
//validate income form (adding new income)
function dashboard1(){
	var itemname = document.getElementById("incomeName").value;
	var amount = document.getElementById("incomeAmount").value;
	var category = document.getElementsByName("options1");
	if(itemname==""){
		alert("Please enter an item."); 
		return false;
	}
	if(amount==""){
		alert("Please enter an amount."); 
		return false;
	}
	for (var i = 0; i < category.length; i++) {   
		if (category[i].checked) { // Checked property to check radio Button check or not    
		return true;  
		}  
	}
	alert("Please choose a category."); 
	return false;
}
//validate expense form (adding new expenses)
function dashboard(){
	var itemname = document.getElementById("expenseName").value;
	var amount = document.getElementById("expenseAmount").value;
	var category = document.getElementsByName("options");
	if(itemname==""){
		alert("Please enter an item."); 
		return false;
	}
	//return true;
	if(amount==""){
		alert("Please enter an amount."); 
		return false;
	}
	for (var i = 0; i < category.length; i++) {   
		if (category[i].checked) { // Checked property to check radio Button check or not    
		return true;  
		}  
	}
	alert("Please choose a category."); 
	return false;
}
// Inside Summary modal when user chooses category to display
function summary(){
	var category = document.getElementById("category").value;
	var fromdate1 = document.getElementById("fromdate1").value;
	var todate1 = document.getElementById("todate1").value;
	if(category=="0"){
		alert("Please choose a category."); 
		return false;
	}
	if(fromdate1=="" || todate1 == ""){
		alert("Date Missing."); 
		return false;
	}
	if (todate1 < fromdate1) {    //display error if from date is smaller than to date
		alert("Date Wrong. Please try again ");    
		return false;
	}
}
// Inside Summary modal when user chooses category by Month
function summaryByMonth(){
	var month = document.getElementById("month").value;
	if(month=="0"){
		alert("Please choose a Month."); 
		return false;
	}
}
// Inside Summary modal when user chooses FROM and TO date
function modalDateSummary(){
	var fromdate = document.getElementById("fromdate").value;
	var todate = document.getElementById("todate").value;
	if(fromdate=="" || todate == ""){ //if any date missing
		alert("Date Missing."); 
		return false;
	}
	if (todate < fromdate) { //display error message if to date is less than from date
		alert("Date Wrong. Please try again ");    
		return false;
	}
}
//Inside editRecords if field left empty
function editRecords(){
	var category = document.getElementById("category1").value;
	var item = document.getElementById("item").value;
	var amount = document.getElementById("amount").value;
	if(item==""){
		alert("Item Name missing!"); 
		return false;
	}
	if(amount==""){
		alert("Amount missing!"); 
		return false;
	}
	if(category=="0"){
		alert("Please choose a category."); 
		return false;
	}
}
//increase image of logo when mouse pass over it (jquery)
var image = document.getElementById("image");
image.addEventListener("mouseover", function(){
	this.style = "box-shadow: 2px 2px 2px grey";
	this.width = "45"
	this.height = "35"
	image.addEventListener("mouseout", function(){
		this.width = "38"
		this.height = "30"
	}); 
}); 
//change color of buttons when mouse hovers over
$(document).ready(function(){
	$("button").hover(function(){
	$(this).css("background-color", "rgb(6, 181, 240)");
	},
	function(){
		$(this).css("background-color", "");
	}); 
});
//Confirm delete
function checkdelete(){
	return confirm('DELETING RECORD! Are you sure?');
}
function goback(){
	var x = document.referrer;
	window.location.replace(x);
}