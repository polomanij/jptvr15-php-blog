$(function() {
	//Header toggle menu
	$('.header-menu-toggle').on('click', function() {
		$('.header-menu ul').slideToggle(300, function() {
			if($(this).css('display') === 'none') {
				$(this).removeAttr('style');
			}
		});
	});
	//Header toggle menu END
})