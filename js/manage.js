// Cambia la visibilidad de las actividades en el calendario según el estado del checkbox
function filterActivities(activity){
	
	if($('#chk_' + activity)[0].checked){
		var boxes = $('.box_'+ activity);
		for (var i = 0; i <= boxes.length - 1; i++) {
			boxes[i].style.visibility = "visible";
		}
	} else {
		var boxes = $('.box_'+ activity);
		for (var i = 0; i <= boxes.length - 1; i++) {
			boxes[i].style.visibility = "hidden";
		}
	}
}