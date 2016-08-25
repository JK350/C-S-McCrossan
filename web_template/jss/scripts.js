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
    
    var idString = this.id;
    sectionNavChanger(idString);
  });
}    

function currentYear()
{
	var theDate=new Date();
	return(theDate.getFullYear());
}

function subNavChanger(content)
{
   var thisValue = 'content'+content;
   $('#main_right').load(thisValue+'.php #divChanger');
}

function tabChanger(page, file)
{ 
  var ext = '.html?d=';
  if (file == 'itSec6')
  {
    ext = '.php?d=';
  }
  $('#main_right').load('CONTENTS/CONTENTPAGES/'+page+'/'+file+ext+dateFinder()+' #divChanger');
}                                               

function sectionNavChanger(section)
{
  section = section+"Nav";
  $('.showing').removeClass('showing').addClass('hidden');
  $('#'+section).removeClass('hidden').addClass('showing');   
}

function subNavContentChanger(page, file, content)
{
  var ext = '.html?d=';
  if (file == 'itSixNav')
  {
    ext = '.php?d=';
  }
  $('#main_right').load('CONTENTS/CONTENTPAGES/'+page+'/'+file+'/'+content+ext+dateFinder()+' #divChanger');
} 

function dateFinder()
{
  var d = new Date();
  return Date.UTC(d.getFullYear(),d.getMonth(),d.getDay(),d.getHours(),d.getMinutes(),d.getSeconds(),d.getMilliseconds())
}

 