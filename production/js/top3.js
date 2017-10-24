$(document).ready(function(){
	$.ajax({
		url: "http://localhost/garuda/top3.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var tipe = [];
			var percentage = [];

			for(var i in data) {
				tipe.push(data[i].tipe);
				percentage.push(data[i].percentage);
			}
			var options = {
			scales: {
					yAxes: [{
							ticks: {
									min:0,
									max:6,
									scaleSteps:1
							}
					}]
			}
			};
			var chartdata = {
				labels: tipe,
				datasets : [
					{
						label: 'Player Score',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: percentage
					}
				]
			};

			var ctx = $("#mycanvastop3");

			var barGraph = new Chart(ctx, {
				type: 'line',
				options:options,
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
