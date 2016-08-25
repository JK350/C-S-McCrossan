$(document).ready(function() {
  getContents(); 
});



function getContents()
{
  $('#listPeople').click(function()
  {
    $.get('includes/personList.php', function(data)
    {
      $('#pageContent').html(data);
    });
    return false;
  });
  
  $('#listAssetNumber').click(function()
  {
    $.get('includes/assetList.php', function(data)
    {
      $('#pageContent').html(data);
    });
    return false;
  });
  
  $('#listLocation').click(function()
  {
    $.get('includes/locationList.php', function(data)
    {
      $('#pageContent').html(data);
    });
    return false;
  });

  $('.delete').click(function()
  {
    if (confirm("Are you sure you want to delete this?"))
    {
      return true;
    }
    else
    {
      return false;
    }
  });

}
/*-------------------------------Person Scripts-------------------------------*/

function getPersonSuggestions(value) 
{
	if(value != "") 
  {
		$.post("includes/personSearch.php", {userPart:value}, function(data)
    {
        $("#pageContent").html(data);
		});
	}
  else
  {
    removePersonSuggestions();
  }
}
  
function removePersonSuggestions()
{
  $("#pageContent").html("");
}
  
function addPersonText(value)
{
  $("#personSearch").val(value);
}

/*-------------------------------Assets Scripts-------------------------------*/

function getAssetSuggestions(value) 
{
	if(value != "") 
  {
		$.post("includes/assetSearch.php", {userPart:value}, function(data)
    {
        $("#pageContent").html(data);
		});
	}
  else
  {
    removeAssetSuggestions();
  }
}
  
function removeAssetSuggestions()
{
  $("#pageContent").html("");
}
  
function addAssetText(value)
{
  $("#assetSearch").val(value);
}

/*------------------------------Location Scripts------------------------------*/

function getLocationSuggestions(value) 
{
	if(value != "") 
  {
		$.post("includes/locationSearch.php", {userPart:value}, function(data)
    {
        $("#pageContent").html(data);
		});
	}
  else
  {
    removeLocationSuggestions();
  }
}
  
function removeLocationSuggestions()
{
  $("#pageContent").html("");
}
  
function addLocationText(value)
{
  $("#locationSearch").val(value);
}

/*--------------------------------Edit Scripts--------------------------------*/

function listClear()
{
  $('#pageContent').html("");
}

function checkDelete()
{
  if (confirm("Are you sure you want to permanently delete this?"))
  {
  return true;
  }
  else
  {
  return false;
  }
}

function tonerPrinterFunctions(mode, toner_id, printer_id)
{
  $.ajax({
    type: "GET",
    url: "includes/AJAX/toner_functions_xml.php?mode="+mode+"&printer_id="+printer_id+"&toner_id="+toner_id+"&d="+dateFinder(),
    dataType: "xml",
    success: parseXML
  });

  function parseXML(xml)
  {
    $(xml).find("queryResults").each(function()
    {
      var thisResult = $(this).find("result").text();
      var thisMessage = $(this).find("messages").text();
      if(thisResult == "Success")
      {
        refillTonerPrinterInfo();
      }
      else
      {                
        alert(thisMessage);
      }
      
    });
  }
}

function refillTonerPrinterInfo()
{
  var toner_id = $('#toner_id').val();
  $.post('includes/edit_toner/printerList.php', {toner_id: toner_id}, function(data)
  {
    $('#printerArea').html(data);
  });   
}

function printerTonerFunctions(mode, printer_id, toner_id, toner_desc, toner_model, stock_num, toner_price)
{
  $.ajax({
    type: "GET",
    url: "includes/AJAX/printer_toner_functions_xml.php?mode="+mode+"&printer_id="+printer_id+"&toner_id="+toner_id+"&toner_desc="+toner_desc+"&toner_model="+toner_model+"&stock_num="+stock_num+"&toner_price="+toner_price+"&d="+dateFinder(),
    dataType: "xml",
    success: parseXML
  });
  
  function parseXML(xml)
  {
    $(xml).find("queryResults").each(function()
    {
      var thisResult = $(this).find("result").text();
      var thisMessage = $(this).find("messages").text();
      if(thisResult == "Success")
      {
        refillPrinterTonerInfo(printer_id);
      }
      else
      {                
        alert(thisMessage);
      }
      
    });
  }  
}

function refillPrinterTonerInfo(printer_id)
{
  $.post('includes/info_asset/tonerList.php', {printer_id: printer_id}, function(data)
  {
    $('#tonerArea').html(data);
  });
}

function computerSoftwareFunctions(mode, comp_id, software_id, software_name, software_type, version, num_licenses, license_num, software_price, software_notes)
{
  $.ajax({
    type: "GET",
    url: "includes/AJAX/computer_software_functions_xml.php?mode="+mode+"&comp_id="+comp_id+"&software_id="+software_id+"&software_name="+software_name+"&software_type="+software_type+"&version="+version+"&num_licenses="+num_licenses+"&license_num="+license_num+"&software_price="+software_price+"&software_notes="+software_notes+"&d="+dateFinder(),
    dataType: "xml",
    success: parseXML
  });
  
  function parseXML(xml)
  {
    $(xml).find("queryResults").each(function()
    {
      var thisResult = $(this).find("result").text();
      var thisMessage = $(this).find("messages").text();
      if(thisResult == "Success")
      {
        refillComputerSoftwareInfo(comp_id);
      }
      else
      {                
        alert(thisMessage);
      }
      
    });
  }  
}

function refillComputerSoftwareInfo(comp_id)
{
  $.post('includes/edit_asset/softwareList.php', {comp_id: comp_id}, function(data)
  {
    $('#softwareArea').html(data);
  });
}

function employeeAssetFunctions(mode, emp_id, asset_id, emp_name)
{
  $.ajax({
    type: "GET",
    url: "includes/AJAX/employee_asset_functions_xml.php?mode="+mode+"&emp_id="+emp_id+"&asset_id="+asset_id+"&d="+dateFinder(),
    dataType: "xml",
    success: parseXML
  });
  
  function parseXML(xml)
  {
    $(xml).find("queryResults").each(function()
    {
      var thisResult = $(this).find("result").text();
      var thisMessage = $(this).find("messages").text();
      if(thisResult == "Success")
      {
        refillEmployeeAssetInfo(emp_id, emp_name);
      }
      else
      {                
        alert(thisMessage);
      }
      
    });
  }  
}

function refillEmployeeAssetInfo(emp_id, emp_name)
{
  $.post('includes/info_employee/assetList.php', {emp_id: emp_id, emp_name: emp_name}, function(data)
  {
    document.getElementById('listMain').innerHTML = data;
  });
}

function softwareComputerFunctions(mode, software_id, comp_id)
{
  $.ajax({
    type: "GET",
    url: "includes/AJAX/software_computer_functions_xml.php?mode="+mode+"&software_id="+software_id+"&comp_id="+comp_id+"&d="+dateFinder(),
    dataType: "xml",
    success: parseXML
  });
  
  function parseXML(xml)
  {
    $(xml).find("queryResults").each(function()
    {
      var thisResult = $(this).find("result").text();
      var thisMessage = $(this).find("messages").text();
      if(thisResult == "Success")
      {
        refillSoftwareComputerInfo(software_id);
      }
      else
      {                
        alert(thisMessage);
      }
      
    });
  }  
}

function refillSoftwareComputerInfo(software_id)
{
  $.post('includes/edit_software/computerList.php', {software_id: software_id}, function(data)
  {
    document.getElementById('softwareLocalList').innerHTML = data;
  });
}

function locationAssetFunctions(mode, loc_id, asset_id)
{
  $.ajax({
    type: "GET",
    url: "includes/AJAX/location_asset_functions_xml.php?mode="+mode+"&loc_id="+loc_id+"&asset_id="+asset_id+"&d="+dateFinder(),
    dataType: "xml",
    success: parseXML
  });
  
  function parseXML(xml)
  {
    $(xml).find("queryResults").each(function()
    {
      var thisResult = $(this).find("result").text();
      var thisMessage = $(this).find("messages").text();
      if(thisResult == "Success")
      {
        refillLocationAssetInfo(loc_id);
      }
      else
      {                
        alert(thisMessage);
      }
      
    });
  }  
}

function refillLocationAssetInfo(loc_id)
{
  $.post('includes/info_location/assetList.php', {loc_id: loc_id}, function(data)
  {
    $('#listMain').html(data);
  });
}

function dateFinder()
{
  var d = new Date();
  return Date.UTC(d.getFullYear(),d.getMonth(),d.getDay(),d.getHours(),d.getMinutes(),d.getSeconds(),d.getMilliseconds())
}
