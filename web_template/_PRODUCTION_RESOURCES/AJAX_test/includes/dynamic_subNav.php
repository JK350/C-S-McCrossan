<?php

  $intI = 0;
  $array = array("OneNav", "TwoNav", "ThreeNav", "FourNav", "FiveNav", "SixNav"); 
  switch($pageName)
  {
    case "index":
      $menuOne = array("IT Help Docs", "Index One Menu Two", "Index One Menu Three", "Index One Menu Four", "Index One Menu Five", "Index One Menu Six");
      $menuTwo = array("Index Two Menu One", "Index Two Menu Two", "Index Two Menu Three", "Index Two Menu Four", "Index Two Menu Five", "Index Two Menu Six");
      $menuThree = array("Index Three Menu One", "Index Three Menu Two", "Index Three Menu Three", "Index Three Menu Four", "Index Three Menu Five", "Index Three Menu Six");
      $menuFour = array("Index Four Menu One", "Index Four Menu Two", "Index Four Menu Three", "Index Four Menu Four", "Index Four Menu Five", "Index Four Menu Six");
      $menuFive = array("Index Five Menu One", "Index Five Menu Two", "Index Five Menu Three", "Index Five Menu Four", "Index Five Menu Five", "Index Five Menu Six");
      $menuSix = array("Index Six Menu One", "Index Six Menu Two", "Index Six Menu Three", "Index Six Menu Four", "Index Six Menu Five", "Index Six Menu Six");
      break;
    case "human_resources":
      $menuOne = array("Important Papers", "Non-Important Papers", "Services One Menu Three", "Services One Menu Four", "Services One Menu Five", "Services One Menu Six");
      $menuTwo = array("Payroll", "Services Two Menu Two", "Services Two Menu Three", "Services Two Menu Four", "Services Two Menu Five", "Services Two Menu Six");
      $menuThree = array("Employee Roster", "Employee Phonebook", "Services Three Menu Three", "Services Three Menu Four", "Services Three Menu Five", "Services Three Menu Six");
      $menuFour = array("Newsletters", "Employee surveys", "Services Four Menu Three", "Services Four Menu Four", "Services Four Menu Five", "Services Four Menu Six");
      $menuFive = array("HR Five Menu One", "HR Five Menu Two", "Services Five Menu Three", "Services Five Menu Four", "Services Five Menu Five", "Services Five Menu Six");
      $menuSix = array("HR Six Menu One", "HR Six Menu Two", "Services Six Menu Three", "Services Six Menu Four", "Services Six Menu Five", "Services Six Menu Six");
      break;
    case "projects":
      $menuOne = array("Projects One Menu One", "Projects One Menu Two", "Projects One Menu Three", "Projects One Menu Four", "Projects One Menu Five", "Projects One Menu Six");
      $menuTwo = array("Projects Two Menu One", "Projects Two Menu Two", "Projects Two Menu Three", "Projects Two Menu Four", "Projects Two Menu Five", "Projects Two Menu Six");
      $menuThree = array("Projects Three Menu One", "Projects Three Menu Two", "Projects Three Menu Three", "Projects Three Menu Four", "Projects Three Menu Five", "Projects Three Menu Six");
      $menuFour = array("Projects Four Menu One", "Projects Four Menu Two", "Projects Four Menu Three", "Projects Four Menu Four", "Projects Four Menu Five", "Projects Four Menu Six");
      $menuFive = array("Projects Five Menu One", "Projects Five Menu Two", "Projects Five Menu Three", "Projects Five Menu Four", "Projects Five Menu Five", "Projects Five Menu Six");
      $menuSix = array("Projects Six Menu One", "Projects Six Menu Two", "Projects Six Menu Three", "Projects Six Menu Four", "Projects Six Menu Five", "Projects Six Menu Six");
      break;
    case "solutions":
      $menuOne = array("Solutions One Menu One", "Solutions One Menu Two", "Solutions One Menu Three", "Solutions One Menu Four", "Solutions One Menu Five", "Solutions One Menu Six");
      $menuTwo = array("Solutions Two Menu One", "Solutions Two Menu Two", "Solutions Two Menu Three", "Solutions Two Menu Four", "Solutions Two Menu Five", "Solutions Two Menu Six");
      $menuThree = array("Solutions Three Menu One", "Solutions Three Menu Two", "Solutions Three Menu Three", "Solutions Three Menu Four", "Solutions Three Menu Five", "Solutions Three Menu Six");
      $menuFour = array("Solutions Four Menu One", "Solutions Four Menu Two", "Solutions Four Menu Three", "Solutions Four Menu Four", "Solutions Four Menu Five", "Solutions Four Menu Six");
      $menuFive = array("Solutions Five Menu One", "Solutions Five Menu Two", "Solutions Five Menu Three", "Solutions Five Menu Four", "Solutions Five Menu Five", "Solutions Five Menu Six");
      $menuSix = array("Solutions Six Menu One", "Solutions Six Menu Two", "Solutions Six Menu Three", "Solutions Six Menu Four", "Solutions Six Menu Five", "Solutions Six Menu Six");
      break;
    case "research":
      $menuOne = array("Research One Menu One", "Research One Menu Two", "Research One Menu Three", "Research One Menu Four", "Research One Menu Five", "Research One Menu Six");
      $menuTwo = array("Research Two Menu One", "Research Two Menu Two", "Research Two Menu Three", "Research Two Menu Four", "Research Two Menu Five", "Research Two Menu Six");
      $menuThree = array("Research Three Menu One", "Research Three Menu Two", "Research Three Menu Three", "Research Three Menu Four", "Research Three Menu Five", "Research Three Menu Six");
      $menuFour = array("Research Four Menu One", "Research Four Menu Two", "Research Four Menu Three", "Research Four Menu Four", "Research Four Menu Five", "Research Four Menu Six");
      $menuFive = array("Research Five Menu One", "Research Five Menu Two", "Research Five Menu Three", "Research Five Menu Four", "Research Five Menu Five", "Research Five Menu Six");
      $menuSix = array("Research Six Menu One", "Research Six Menu Two", "Research Six Menu Three", "Research Six Menu Four", "Research Six Menu Five", "Research Six Menu Six");
      break;
    case "contacts":
      $menuOne = array("Contacts One Menu One", "Contacts One Menu Two", "Contacts One Menu Three", "Contacts One Menu Four", "Contacts One Menu Five", "Contacts One Menu Six");
      $menuTwo = array("Contacts Two Menu One", "Contacts Two Menu Two", "Contacts Two Menu Three", "Contacts Two Menu Four", "Contacts Two Menu Five", "Contacts Two Menu Six");
      $menuThree = array("Contacts Three Menu One", "Contacts Three Menu Two", "Contacts Three Menu Three", "Contacts Three Menu Four", "Contacts Three Menu Five", "Contacts Three Menu Six");
      $menuFour = array("Contacts Four Menu One", "Contacts Four Menu Two", "Contacts Four Menu Three", "Contacts Four Menu Four", "Contacts Four Menu Five", "Contacts Four Menu Six");
      $menuFive = array("Contacts Five Menu One", "Contacts Five Menu Two", "Contacts Five Menu Three", "Contacts Five Menu Four", "Contacts Five Menu Five", "Contacts Five Menu Six");
      $menuSix = array("Contacts Six Menu One", "Contacts Six Menu Two", "Contacts Six Menu Three", "Contacts Six Menu Four", "Contacts Six Menu Five", "Contacts Six Menu Six");
      break;
    default:
      $menuOne = array("Index One Menu One", "Index One Menu Two", "Index One Menu Three", "Index One Menu Four", "Index One Menu Five", "Index One Menu Six");
      $menuTwo = array("Index Two Menu One", "Index Two Menu Two", "Index Two Menu Three", "Index Two Menu Four", "Index Two Menu Five", "Index Two Menu Six");
      $menuThree = array("Index Three Menu One", "Index Three Menu Two", "Index Three Menu Three", "Index Three Menu Four", "Index Three Menu Five", "Index Three Menu Six");
      $menuFour = array("Index Four Menu One", "Index Four Menu Two", "Index Four Menu Three", "Index Four Menu Four", "Index Four Menu Five", "Index Four Menu Six");
      $menuFive = array("Index Five Menu One", "Index Five Menu Two", "Index Five Menu Three", "Index Five Menu Four", "Index Five Menu Five", "Index Five Menu Six");
      $menuSix = array("Index Six Menu One", "Index Six Menu Two", "Index Six Menu Three", "Index Six Menu Four", "Index Six Menu Five", "Index Six Menu Six");
      break;    
  }
    
  $menu = array($menuOne, $menuTwo, $menuThree, $menuFour, $menuFive, $menuSix);

?> 
            
            <?php 
              foreach ($menu as $menuNum)
              { 
                echo "<div id='".$pageName.$array[$intI]."' class='hidden'><ul>";
                  foreach ($menuNum as $menuNumText)
                  { 
                    $folderString = $pageName.$array[$intI];
                    $pageString = explode(" ", $menuNumText);
                    $contentTitle = "";
                    foreach ($pageString as $pageTitle) {
                      $contentTitle = $contentTitle.$pageTitle;	
                    }                                                                                                    
                    echo "<li><a href='#' class='purple tabSubNav' onclick='subNavContentChanger(&#34;".$pageName."&#34;, &#34;".$folderString."&#34;, &#34;".$contentTitle."&#34;);'>".$menuNumText."</a></li>";
                  }  
                echo "</ul></div>";
                $intI++;
              }
            ?>