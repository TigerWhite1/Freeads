$( document ).ready(function() {
	$(".id").submit(function(event) {
		event.preventDefault();
		console.log($('.test').val());
		
		$.ajaxSetup({
			headers:
			{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		});
		console.log($('#id').val());
		$.post('jsonhours',{ date: $('.test').val(), genre: $('.genre').val()}, function (json) {
			json = $.parseJSON(json);
			var buyerData = {
				labels : [	"00",
    "01",
    "02",
    "03",
    "04",
    "05",
    "06",
    "07",
    "08",
    "09",
    "10",
    "11",
    "12",
    "13",
    "14",
    "15",
    "16",
    "17",
    "18",
    "19",
    "20",
    "21",
    "22",
    "23"],
				datasets : [
				{
					fillColor : "rgba(172,194,132,0.4)",
					strokeColor : "#ACC26D",
					pointColor : "#fff",
					pointStrokeColor : "#9DB86D",
					data : json.Count
				}
				]
			}
		var buyers = $('#buyers')[0].getContext('2d');
		new Chart(buyers).Line(buyerData, {responsive : true});
		});

	});
});
