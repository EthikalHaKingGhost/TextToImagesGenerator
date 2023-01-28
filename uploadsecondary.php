<?php
require_once("resources/library/vendor/autoload.php"); //call GD Library

use GDText\Box;
use GDText\Color;


if (isset($_POST['submit']))
{
    $year = $_POST["academic_year"]; 
    $term = $_POST["term"];
    
    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            // Skip the first line
            fgetcsv($csvFile);
            // Parse data from CSV file line by line

            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
            {
                // Get row data and post data from forms
                $school = $getData[0];
                $coursename = $getData[1];
                $teacher = $getData[2];
                $class = $getData[3];
                $level = $getData[4];              

            if(file_exists("resources/templates/secondary/".$coursename.".JPG")){
                  $im = imagecreatefromjpeg("resources/templates/secondary/".$coursename.".JPG");
                  $imb = imagecreatefromjpeg("resources/templates/secondary/banners/".$coursename."_b.JPG");
                                                  
   
    $font = "C:\Windows\Fonts\calibrib.ttf";
    $fontColor = imagecolorallocate($im, 255, 255, 255);
    $BannerTxt2 = "Teacher: ".$teacher;
    $Text1 = $year." | ".$term; //"2022-2023 | Term I"
    $Text2 = "Teacher: ".$teacher." | ".$level; //"Teacher: Dale Marie Clarke|Form 1"
    
    //term Text on subject banner
    $textbox = new Box($imb);
    $textbox->setFontSize(24);
    $textbox->setFontFace($font);
    $textbox->setFontColor(new Color(255, 255, 255)); // white
    $textbox->setTextShadow(new Color(0, 0, 0, 90), 2, 2);
    $textbox->setBox( 8, 169, 315, 24);
    $textbox->setTextAlign('left', 'top');
    $textbox->draw($Text1);
    
    
    //Teacher Text on subject banner === REMOVED
    $textbox = new Box($imb);
    $textbox->setFontSize(24);
    $textbox->setFontFace($font);
    $textbox->setFontColor(new Color(255, 255, 255)); // white
    $textbox->setTextShadow(new Color(0, 0, 0, 90), 2, 2);
    $textbox->setBox(
        -9,  // distance from left edge
        169,  // distance from top edge
        1104, // textbox width
        24  // textbox height
    );
    $textbox->setTextAlign('right', 'top');
    $textbox->draw($BannerTxt2);

    
    //Teacher text on image
    $textbox = new Box($im);
    $textbox->setFontSize(48);
    $textbox->setFontFace($font);
    $textbox->setFontColor(new Color(255, 255, 255)); // white
    $textbox->setTextShadow(new Color(0, 0, 0, 90), 2, 2);
    $textbox->setBox(
        -12,  // distance from left edge
        378,  // distance from top edge
        1280, // textbox width
        48  // textbox height
    );
    // text will be aligned inside textbox to right horizontally and to top vertically
    $textbox->setTextAlign('right', 'top');
    $textbox->draw($Text2);
        
    //term Texton image
    $textbox = new Box($im);
    $textbox->setFontSize(37);
    $textbox->setFontFace($font);
    $textbox->setFontColor(new Color(255, 255, 255)); // white
    $textbox->setTextShadow(new Color(0, 0, 0, 90), 2, 2);
    $textbox->setBox( -12, 432, 1280, 38);
    $textbox->setTextAlign('right', 'top');
    $textbox->draw($Text1);

    $word = ":";
    if(strpos($level, $word) !== false){
     $replevel = str_replace(":","-",$level);
    }else{
      $replevel = $level;
    }
  
    //check each folder path for existing folder created
    if(!file_exists("Uploads/".$year)){
        $path = "Uploads/".$year;
        mkdir($path, 0775, true);
    }
    
    if(!file_exists("Uploads/".$year."/secondary")){
        $path = "Uploads/".$year."/secondary";
        mkdir($path, 0775, true);
      }

    if(!file_exists("Uploads/".$year."/secondary/".$school)){
        $path = "Uploads/".$year."/secondary/".$school;
        mkdir($path, 0775, true);
      }

    if(!file_exists("Uploads/".$year."/secondary/".$school."/".$class)){
        $path = "Uploads/".$year."/secondary/".$school."/".$class;
        mkdir($path, 0775, true);
      }

      if(!file_exists("Uploads/".$year."/secondary/".$school."/".$class."/".$coursename)){
        $path = "Uploads/".$year."/secondary/".$school."/".$class."/".$coursename;
        mkdir($path, 0775, true);
      }

    if(!file_exists("Uploads/".$year."/secondary/".$school."/".$class."/".$coursename."/Course Templates")){
        $path = "Uploads/".$year."/secondary/".$school."/".$class."/".$coursename."/Course Templates";
        mkdir($path, 0775, true);
      }


    if(!file_exists("Uploads/".$year."/secondary/".$school."/".$class."/".$coursename."/Course Templates/".$teacher."-".$replevel.".jpg")){
        $file = $teacher."-".$replevel.".jpg";
        $path = "Uploads/".$year."/secondary/".$school."/".$class."/".$coursename."/Course Templates";
        imagejpeg( $im, $path."/".$file, 100 );
      }

    if(!file_exists("Uploads/".$year."/secondary/".$school."/".$class."/".$coursename."/Subject Banners")){
        $path = "Uploads/".$year."/secondary/".$school."/".$class."/".$coursename."/Subject Banners";
        mkdir($path, 0775, true);
      }

    if(!file_exists("Uploads/".$year."/secondary/".$school."/".$class."/".$coursename."/Subject Banners/".$teacher."-".$class."-ban.jpg")){
        $fileb = $teacher."-".$class."-ban.jpg";
        $path = "Uploads/".$year."/secondary/".$school."/".$class."/".$coursename."/Subject Banners";
        imagejpeg( $imb, $path."/".$fileb, 100 );
      }
    }  
  }   
  
      header("Location: resources/templates/success.php?year=$year&school=secondary");
        fclose($csvFile);  // Close opened CSV file

        } else {

          header("Location: resources/templates/failed.php");

      }
                    
}      
                


