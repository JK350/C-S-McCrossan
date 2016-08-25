function updateItem()
{
  var str1 = document.getElementById('equip_make').value;
  var str2 = document.getElementById('equip_model').value;
  document.getElementById('item').value = str1+" "+str2;
}

function updateContact()
{
  switch (document.getElementById('contact_info').value)
  {
    case "Bruce Jonason":
      document.getElementById('contact_name').value='Bruce Jonason';
      document.getElementById('contact_phone').value='763-425-4167';
      document.getElementById('contact_email').value='equipmentsales@mccrossan.com';
      break;
    case "Joe McCrossan":
      document.getElementById('contact_name').value='Joe McCrossan';
      document.getElementById('contact_phone').value='623-936-1486';
      document.getElementById('contact_email').value='csmaz@qwestoffice.net';
      break;
    case "Equipment Sales":
      document.getElementById('contact_name').value='Equipment Sales';
      document.getElementById('contact_phone').value='763-425-4167';
      document.getElementById('contact_email').value='equipmentsales@mccrossan.com';
      break;
  }
}

function checkDelete()
{
  if (confirm("Are you sure you want to permanently delete this equipment item? Remember you can inactivate those that you don't want to show on the website."))
  {
  return true;
  }
  else
  {
  return false;
  } 
}