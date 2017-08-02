$(document).ready(function(){
	$("#slider").cycle({
				fx:   'zoom',
				sync: false,
			    delay:  -100,
			    next: "#right",	// id right que avançará o slid
			    prev: "#left",	// id right que voltará o slid
			    pager: '#pagination',	//id dentro da pagina que receberá a navegação
		    	pagerAnchorBuilder: paginate
	});	
})


function paginate(ind, el) {
	return '<a href="#">0</a>';
	// and so on
}
