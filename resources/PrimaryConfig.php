<?php

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