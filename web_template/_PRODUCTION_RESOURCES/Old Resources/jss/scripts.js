$(document).ready(function(){
	pageScripts();
    
});

function pageScripts()
{
	$('#coin-slider').coinslider({width: 960, height: 186, navigation: false, delay: 5000, effect: 'straight', spw: 1, sph:1, links: false, hoverPause: false });
  
  $('a.tab').click(function()
  {
    $('a.active').removeClass('active').addClass('inactive');
    $(this).removeClass('inactive').addClass('active');
    $('li.tabActive').removeClass('tabActive').addClass('tabInactive');
    $(this).parent().addClass('tabActive').removeClass('tabInactive');
  });
}

function currentYear()
{
	var theDate=new Date()
	return(theDate.getFullYear())
}