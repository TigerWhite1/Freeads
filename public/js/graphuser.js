$( document ).ready(function() {
	$(".id").submit(function(event) {
		event.preventDefault();
		
		$.ajaxSetup({
			headers:
			{ 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		});
		$.post('jsonuser',{ id: $('#id').val()}, function (json) {
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
			new Chart(buyers ).Bar(buyerData, {responsive : true});
		});

	});
});