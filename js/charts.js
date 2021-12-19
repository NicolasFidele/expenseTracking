// bar chart for summary by category
//fetch output
$.ajax({
	// link to php code to extract data
	url: "chartCategory.php", 
	method: "POST",
	dataType:"JSON",
	success: function(data) { //if success
		//create variables to store array of data extracted from db
		var date = [];
		var amount = [];
		var color = [];
		//push data from chart*.php files into the arrays
		for(var i in data){
			date.push(data[i].transaction_date);
			amount.push(data[i].totalamount);
			color.push(data[i].color);          
		}   
		//contents of the chart
		var chartdata = {
			labels: date,
			datasets: [
				{
					label : 'Total by Date',
					backgroundColor:color,
					color:'#fff',
					maxBarThickness: 80,
					minBarLength: 15,
					data: amount,
					datalabels: {
						color: 'blue',
						anchor: 'end',
						align: 'top',
						font: {
							weight: 'bold'
						}
					}
			}
			]
		};
		var ctx = $('#mycanvas'); //canvas id in summaryByCategory
		var barGraph = new Chart(ctx,  {
			type: 'bar',
			data: chartdata,
			plugins:[ChartDataLabels]
		});
	},
	//if failed
	error: function(data) { 
			console.log(data);
	}
});

//chart for summary by date - Expenses
$.ajax({
	url: "chartExpenses.php",
	method: "POST",
	dataType:"JSON",
	success: function(data) { //if success
		
		var category = [];
		var amount = [];
		var color = [];

		for(var i in data){
			category.push(data[i].category);
			amount.push(data[i].totalamount);
			color.push(data[i].color);          
		}   
		var chartdata = {
			labels: category,
			datasets: [
				{
					label : 'Total by Category',
					backgroundColor:color,
					color:'#fff',
					data: amount,
					datalabels: {
						color: 'white',
						anchor: 'end',
						align: 'start',
						offset: '10'
					}
				}
			]
		};
		var ctx = $('#dateChartCanvas'); //canvas id in summaryByDate
		var doughNut = new Chart(ctx,  {
			type: 'pie',
			data: chartdata,
			plugins:[ChartDataLabels],
		});
	},
	error: function(data) {
		console.log(data);
	}
});

//chart for summary by date - Income
$.ajax({
	url: "chartIncome.php",
	method: "POST",
	dataType:"JSON",
	success: function(data) { //if success
		console.log(data);
		var category = [];
		var amount = [];
		var color = [];
		for(var i in data){
				category.push(data[i].category);
				amount.push(data[i].totalamount);
				color.push(data[i].color);          
		}   
		var chartdata = {
			labels: category,
			datasets: [
				{
					label : 'Total by Category',
					backgroundColor:color,
					color:'#fff',
					data: amount,
					datalabels: {
						color: 'white',
						anchor: 'end',
						align: 'start',
						offset: '10'
					}
				}
			]
		};
		var ctx = $('#dateChartCanvas2'); //canvas id in summaryByCDate
		var doughNut = new Chart(ctx,  {
			type: 'pie',
			data: chartdata,
			plugins:[ChartDataLabels]
		});
    },
    error: function(data) { //if failed
			console.log(data);
    }
});

//display chart on dashboard - EXPENSES
$.ajax({
	url: "chartIndexExpenses.php",
	method: "GET",
	dataType:"JSON",
	success: function(data) { //if success
		console.log(data);
		var category = [];
		var amount = [];
		var color = [];
		for(var i in data){
			category.push(data[i].category);
			amount.push(data[i].totalamount);
			color.push(data[i].color);          
		}   
		var chartdata = {
			labels: category,
			datasets: [
				{
					label : 'Expenses for Actual Month',
					backgroundColor:color,
					color:'#fff',
					maxBarThickness: 80,
					minBarLength: 15,
					data: amount,
					datalabels: {
						color: 'white',
						anchor: 'end',
						align: 'bottom',
						font: {
							weight: 'bold'
						}
					}
				}
			]
		};
		var ctx = $('#indexCanvas'); //canvas id in dashboard
		var barGraph = new Chart(ctx,  {
			type: 'bar',
			data: chartdata,
			plugins:[ChartDataLabels]
		});
  },
	error: function(data) { //if failed
			console.log(data);
	}
});

//display chart on dashboard - INCOME
$.ajax({
	url: "chartIndexIncome.php",
	method: "GET",
	dataType:"JSON",
	success: function(data) { //if success
		console.log(data);
		var category = [];
		var amount = [];
		var color = [];

		for(var i in data){
			category.push(data[i].category);
			amount.push(data[i].totalamount);
			color.push(data[i].color);          
		}   
		var chartdata = {
			labels: category,
			datasets: [
				{
					label : 'Income for Actual Month',
					backgroundColor:color,
					color:'#fff',
					maxBarThickness: 80,
					minBarLength: 15,
					data: amount,
					datalabels: {
						color: 'white',
						anchor: 'end',
						align: 'bottom',
						font: {
							weight: 'bold'
						}
					}
				}
			]
    };
		var ctx = $('#indexCanvas2'); //canvas id in dashboard
		var barGraph = new Chart(ctx,  {
				type: 'bar',
				data: chartdata,
				plugins:[ChartDataLabels]
		});
  },
	error: function(data) { 
			console.log(data);
	}
});
//display chart for Summary by Month - EXPENSES
$.ajax({
	url: "chartMonthExpenses.php",
	method: "GET",
	dataType:"JSON",
	success: function(data) { //if success
		console.log(data);
		var category = [];
		var amount = [];
		var color = [];
		for(var i in data){
				category.push(data[i].category);
				amount.push(data[i].totalamount);
				color.push(data[i].color);          
		}   
		var chartdata = {
			labels: category,
			datasets: [
				{
					label : 'Expenses',
					backgroundColor:color,
					color:'#fff',
					maxBarThickness: 80,
					minBarLength: 15,
					data: amount,
					datalabels: {
						color: 'white',
						anchor: 'end',
						align: 'start',
						offset: '10'
					}
				}
			]
		};
		var ctx = $('#monthChartCanvas'); //canvas id in dashboard
		var pieGraph = new Chart(ctx,  {
			type: 'pie',
			data: chartdata,
			plugins:[ChartDataLabels]
		});
	},
	error: function(data) { //if failed
		console.log(data);
	}
});
//display chart for Summary by Month - INCOME
$.ajax({
	url: "chartMonthIncome.php",
	method: "GET",
	dataType:"JSON",
	success: function(data) { //if success
		console.log(data);
		var category = [];
		var amount = [];
		var color = [];
		for(var i in data){
				category.push(data[i].category);
				amount.push(data[i].totalamount);
				color.push(data[i].color);          
		}   
		var chartdata = {
			labels: category,
			datasets: [
				{
					label : 'Income',
					backgroundColor:color,
					color:'#fff',
					maxBarThickness: 80,
					minBarLength: 15,
					data: amount,
					datalabels: {
						color: 'white',
						anchor: 'end',
						align: 'start',
						offset: '10'
					}
				}
			]
		};
		var ctx = $('#monthChartCanvas2'); //canvas id in dashboard
		var pieGraph = new Chart(ctx,  {
				type: 'pie',
				data: chartdata,
				plugins:[ChartDataLabels]
		});
	},
	error: function(data) { //if failed
			console.log(data);
	}
});