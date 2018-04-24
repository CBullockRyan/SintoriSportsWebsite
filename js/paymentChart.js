$(document).ready(function(){
	$.ajax({
		url: "http://localhost/SintoriSportsWebsite/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var datePaid = [];
			var amount = [];

			for(var i in data) {
				datePaid.push(data[i].datePaid);
				amount.push(data[i].amount);
			}

			var chartdata = {
				labels: date,
				datasets : [
					{
						label: 'Amount Paid',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: amount
					}
				]
			};

			var ctx = $("#paymentChart");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
