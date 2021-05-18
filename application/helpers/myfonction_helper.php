<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function test_inputValide($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
  // $data = mysqli_real_escape_string($data);
   return $data;
}



function validation($postArray)
{
  $data = [];
  foreach($postArray as $key => $value)
  {
    if($key!="location"/* && $key!="warehouse"*/)
    {
      $data[$key] = trim(stripslashes(htmlspecialchars($value)));
    }
  }

  $data['date_add'] = $data['codeIdentification'] = time();
  
  return $data;
}

function convert_strings($data)
{
    $result =   array();
    foreach($data as $row){
        $result[] =  strtolower(mb_convert_encoding($row, '', 'UTF-8'));
    }
    return $result;
}


function echo_checked($element)
{
  if($element==1)
  {
    echo "checked";
  }
}


function echo_selected($id1, $id2)
{
  $selected = '';
  if($id1 == $id2)
  {
    $selected = 'selected';
  }

  return $selected;
}


function isset_value($name)
{
  if(isset($_POST[$name]))
  {
    echo $_POST[$name];
  }
}


function sessionExiste($session_name)
{
  if(isset($_SESSION['data'][$session_name]))
  {
    return $_SESSION['data'][$session_name];
  }
}

function valueElement($name)
{
  if(isset($_SESSION['data'][$name]))
  {
    return $_SESSION['data'][$name];

  }elseif(isset($_POST[$name]))
  {
    return $_POST[$name];
  }else
  {
    return "";
  }
}




function contactArranger($data){

  $contactArray = [];
       
    if(stripos($data, '/'))
    {
      $contacts = explode('/', $data);
      foreach ($contacts as $contact) {
        array_push($contactArray, $contact);
      }
    }elseif(stripos($data, ' '))
    {
      array_push($contactArray, str_replace(' ', '', $data));
    }elseif(strlen($data)== 11 and stripos($data, '-'))
    {
      $contacts = explode('-', $data);
      $numero = '';
      foreach ($contacts as $contact) {
        $numero = $numero.$contact;
      }
      array_push($contactArray, $numero);

    }else
    {
      array_push($contactArray, $data);
    }

    return $contactArray;
}


function formtageDate($data){

    if(stripos($data, '/'))
    {
      $date = explode('/', $data);
      $data = $date[2].'-'.$date[1].'-'.$date[0];
    }

    return $data;
}


function formtageDate2($data){

    if(stripos($data, '-'))
    {
      $date = explode('-', $data);
      $data = $date[2].'/'.$date[1].'/'.$date[0];
    }

    return $data;
}

function formtageDate3($data){

    if(stripos($data, ' '))
    {
      $date = explode(' ', $data);
      $data = $date[2].'-'.$date[1].'-'.$date[0];  
      
    }

    return $data;
}

function jourSemaine()
{
   $jours = array("Dimanche", "Lundi", "Mardi",
                  "Mercredi", "Jeudi", "Vendredi",
                  "Samedi");
   return $jours[date("w")];
}

function existeAddArray($elemnt, $data)
{
  
}