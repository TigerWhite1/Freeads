$( document ).ready(function() {

	$.ajaxSetup({
		headers:
		{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	});
	$.post('admin/json', function (json) {
		json = $.parseJSON(json);
		var buyerData = {
			labels : ['multimedia', 'vehicules', 'vacances', 'loisirs', 'maison', 'emploi'],
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