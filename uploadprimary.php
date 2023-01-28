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
                $teacher = $getData[1];
                $level = $getData[2];     
                $Text2b = " | ";
                $Text1b = $level."".$Text2b."".$teacher;
                $font = "C:\Windows\Fonts\calibrib.ttf"; 
                $fontSize = 24;
                $angle = 0;

                $files = glob('resources/templates/primary/*.JPG');
                foreach($files as $x) {
                    $coursename = pathinfo($x, PATHINFO_FILENAME);
                    
                $im = imagecreatefromjpeg("resources/templates/primary/".$coursename.".JPG");
                $imb = imagecreatefromjpeg("resources/templates/primary/banners/".$coursename."_b.JPG");


                $font = "C:\Windows\Fonts\calibrib.ttf"; 
                $Text2 = "Teacher: ".$teacher; //"Teacher: Dale Marie Clarke"
                $Text1 = $year." | ".$term; //"2022-2023 | Term 1"

                 
                //Teacher text on image
                $textbox = new Box($im);
                $textbox->setFontSize(47);
                $textbox->setFontFace($font);
                $textbox->setFontColor(new Color(255, 255, 255)); // white
                $textbox->setTextShadow(new Color(0, 0, 0, 90), 2, 2);
                $textbox->setBox(
                    -22,  // distance from left edge
                    375,  // distance from top edge
                    1280, // textbox width
                    48  // textbox height
                );
                // text will be aligned inside textbox to right horizontally and to top vertically
                $textbox->setTextAlign('right', 'top');
                $textbox->draw($Text2);
                
                
                //term Texton image
                $textbox = new Box($im);
                $textbox->setFontSize(40);
                $textbox->setFontFace($font);
                $textbox->setFontColor(new Color(255, 255, 255)); // white
                $textbox->setTextShadow(new Color(0, 0, 0, 90), 2, 2);
                $textbox->setBox( -21, 418, 1280, 48);
                $textbox->setTextAlign('right', 'top');
                $textbox->draw($Text1);

        //Get width of Text2b
            list($left,, $right) = imageftbbox( $fontSize, $angle, $font, $Text2b);
            $tWidthm = $right - $left;

                 //(B) ADD A SUBJECT
        If ($coursename == "Mathematics"){
            $color1 = imagecolorallocate($imb, 23, 105, 103);
            $colorm = imagecolorallocate($imb, 237, 63, 59);
            $color2 = imagecolorallocate($imb, 23, 105, 103);

        }elseif($coursename == "English"){
            $color1 = imagecolorallocate($imb, 23, 105, 103);
            $colorm = imagecolorallocate($imb, 243, 125, 121);
            $color2 = imagecolorallocate($imb, 23, 105, 103);

        }elseif($coursename == "Science"){
            $color1 = imagecolorallocate($imb, 74, 89, 94);
            $colorm = imagecolorallocate($imb, 227, 112, 33);
            $color2 = imagecolorallocate($imb, 74, 89, 94);

        }elseif($coursename == "Agricultural Science"){
            $color1 = imagecolorallocate($imb, 86, 92, 104);
            $colorm = imagecolorallocate($imb, 86, 92, 104);
            $color2 = imagecolorallocate($imb, 255, 255, 255);
            
        }elseif($coursename == "Spanish"){
            $color1 = imagecolorallocate($imb, 65, 74, 89);
            $colorm = imagecolorallocate($imb, 115, 165, 226);
            $color2 = imagecolorallocate($imb, 65, 74, 89);

        }elseif($coursename == "Social Studies"){
            $color1 = imagecolorallocate($imb, 44, 110, 107);
            $colorm = imagecolorallocate($imb, 220, 120, 58);
            $color2 = imagecolorallocate($imb, 44, 110, 107);

        }elseif($coursename == "Visual and Performing Arts"){
            $color1 = imagecolorallocate($imb, 135, 85, 123);
            $colorm = imagecolorallocate($imb, 95, 113, 59);
            $color2 = imagecolorallocate($imb, 135, 85, 123);

        }elseif($coursename == "Physical Education"){
            $color1 = imagecolorallocate($imb, 86, 92, 104);
            $colorm = imagecolorallocate($imb, 86, 92, 104);
            $color2 = imagecolorallocate($imb, 255, 255, 255);
        }else{
            $color1 = imagecolorallocate($imb, 255, 255, 255);
            $colorm = imagecolorallocate($imb, 255, 255, 255);
            $color2 = imagecolorallocate($imb, 255, 255, 255);
        }

        //(C) CALCULATE TEXT BOX POSITION
          //(C1) GET IMAGE DIMENSIONS
          $iWidth = imagesx($imb);
          $iHeight = imagesy($imb);

          //(C2) GET TEXT BOX DIMENSIONS
          $tSize = imagettfbbox($fontSize, $angle, $font, $Text1b);

          $tWidth = max([$tSize[2], $tSize[4]]) - min([$tSize[0], $tSize[6]]);
          $tHeight = max([$tSize[5], $tSize[7]]) - min([$tSize[1], $tSize[3]]);

          //Size of Text 1, width and height
          $tSize1 = imagettfbbox($fontSize, $angle, $font, $level);

          $tWidth1 = max([$tSize1[2], $tSize1[4]]) - min([$tSize1[0], $tSize1[6]]);
          $tHeight1 = max([$tSize1[5], $tSize1[7]]) - min([$tSize1[1], $tSize1[3]]);

          //size of Text 2, width and height
          $tSize2 = imagettfbbox($fontSize, $angle, $font, $teacher);

          $tWidth2 = max([$tSize2[2], $tSize2[4]]) - min([$tSize2[0], $tSize2[6]]);
          $tHeight2 = max([$tSize2[5], $tSize2[7]]) - min([$tSize2[1], $tSize2[3]]);

          //(C3) CENTER THE TEXT BLOCK
          $centerX = CEIL(($iWidth - $tWidth) / 2) + 175;
          $centerX = $centerX<0 ? 0 : $centerX;

          //$wText2 = $centerX + ($tWidth - $tWidth2);
          $wTextm = $centerX + $tWidth1;
          $wText2 = $centerX + $tWidth1 + $tWidthm;


          //imagettftext($imb, 12, 0, $xusrname, 20, $blue, $font, $string[0]); 
          imagettftext($imb, $fontSize, $angle, $centerX, 267, $color1, $font, $level);
          imagettftext($imb, $fontSize, $angle, $wTextm, 267, $colorm, $font, $Text2b); 
          imagettftext($imb, $fontSize, $angle, $wText2, 267, $color2, $font, $teacher);

                if(!file_exists("Uploads/".$year)){
                  $path = "Uploads/".$year;
                  mkdir($path, 0775, true);
                }
                
                if(!file_exists("Uploads/".$year."/primary")){
                  $path = "Uploads/".$year."/primary";
                  mkdir($path, 0775, true);
                  }

                if(!file_exists("Uploads/".$year."/primary/".$school)){
                  $path = "Uploads/".$year."/primary/".$school;
                  mkdir($path, 0775, true);
                  }
             
                if(!file_exists("Uploads/".$year."/primary/".$school."/".$level)){
                    $path = "Uploads/".$year."/primary/".$school."/".$level;
                    mkdir($path, 0775, true);
                  }
                    
                  if(!file_exists("Uploads/".$year."/primary/".$school."/".$level."/Course Templates")){
                    $path = "Uploads/".$year."/primary/".$school."/".$level."/Course Templates";
                    mkdir($path, 0775, true);
                  }
              
                  if(!file_exists("Uploads/".$year."/primary/".$school."/".$level."/Subject Banners")){
                    $path = "Uploads/".$year."/primary/".$school."/".$level."/Subject Banners";
                    mkdir($path, 0775, true);
                  }

                //Primary Course Images Storage Location
                if(!file_exists("Uploads/".$year."/primary/".$school."/".$level."/Course Templates/".$coursename."-".$teacher."-".$level.".jpg")) {
                      $file = $coursename."-".$teacher."-".$level.".jpg";
                      $path = "Uploads/".$year."/primary/".$school."/".$level."/Course Templates";
                      imagejpeg( $im, $path."/".$file, 100 );
                    }

                //Primary Banners Storage Location
                if(!file_exists("Uploads/".$year."/primary/".$school."/".$level."/Subject Banners/".$coursename."-".$teacher."-".$level."-ban.jpg")) {
                $fileb = $coursename."-".$teacher."-".$level."-ban.jpg";
                $path = "Uploads/".$year."/primary/".$school."/".$level."/Subject Banners";
                imagejpeg( $imb, $path."/".$fileb, 100 );
              }

               }       
            }    
        
            header("Location: resources/templates/success.php?year=$year&school=primary");
            fclose($csvFile); 

        } else {

              header("Location: resources/templates/failed.php");

            }

        }