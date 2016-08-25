<?php 
	$folder=explode("/",$_SERVER['SCRIPT_NAME']); 
	$pageName =  $folder[sizeof($folder)-1];
	$pageName = str_replace(".php", "", $pageName);
  
  $dept = "";
  $intJ = 0;  
  $count = array("One", "Two", "Three", "Four", "Five", "Six");
  $secName = array("", "Sec2", "Sec3", "Sec4", "Sec5", "Sec6");    
  switch($pageName)
  {
    case "index":
      $array = array("home1", "home2", "home3", "home4", "home5", "home6");
      break;
    case "it":
      $array = array("IT Home", "Software", "Documentation", "Tech Support", "Resources", "Inventory");
      break;
    case "projects":
      $array = array("proj1", "proj2", "proj3", "proj4", "proj5", "proj6");
      break;
    case "solutions":
      $array = array("sol1", "sol2", "sol3", "sol4", "sol5", "sol6");
      break;
    case "research":
      $array = array("res1", "res2", "res3", "res4", "res5", "res6");
      break;
    case "contacts":
      $array = array("con1", "con2", "con3", "con4", "con5", "con6");
      break;
    default:
      $array = array("home1", "home2", "home3", "home4", "home5", "home6");
      break;    
  }
?>   
    			<div id='tab_navigation'>
               <ul>
                  <?php
                    foreach ($array as $aTab)
                    {
                      if ($intJ == 0)
                      {
                        echo "<li class='tabActive'><a href='#' id='".$pageName.$count[$intJ]."' class='tab active' onclick='tabChanger(&#34;".$pageName."&#34;, &#34;".$pageName.$secName[$intJ]."&#34;);'>".$array[$intJ]."</a></li>"; 
                      }
                      else
                      {
                        echo "<li class='tabInactive'><a href='#' id='".$pageName.$count[$intJ]."' class='tab inactive' onclick='tabChanger(&#34;".$pageName."&#34;, &#34;".$pageName.$secName[$intJ]."&#34;);'>".$array[$intJ]."</a></li>";
                      }
                      $intJ++;                                                                                        
                    }                     
                  ?>
               </ul>                              
          </div>  