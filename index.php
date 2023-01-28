<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="resources/library/bootstrap4/css/bootstrap.min.css">
  <title>Course Image Generator</title>
  <link rel="icon" type="image/x-icon" href="img/logo.ico">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<br>
<br>
<h1>Course Shell Image Generator</h1>

<hr>

  <div class="row">
    <div class="col-md-6 p-5" style="background:#0a3d62;">
      <h2 class="text-center">PRIMARY IMAGES</h2>
          <br>
          <br>
          <form action="uploadprimary.php" method="post" enctype="multipart/form-data">
            
       <!---Code to add the academcic year, span 6 years ------>
          <div class="form-group">
          <label>Academic Year</label>
          <select class="form-control" name="academic_year">
            <?php 
            $firstYear = (int)date('Y') - 1;
                  $lastYear = $firstYear + 5;
                  for($i=$firstYear;$i<=$lastYear;$i++)
                  {
                    $x = (int)$i + 1;
                      echo '<option>'.$i.'-'.$x.'</option>';
                  } 
            ?>
          </select>
          </div>


        <div class="form-group">
        <label for="sel1">Select Term:</label>
        <select class="form-control" name="term">
          <option value="Term I">Term I</option>
          <option value="Term II">Term II</option>
          <option value="Term III">Term III</option>
        </select>
      </div>

      <div class="form-group">
      <div class="file-drop-area">
        <span class="choose-file-button">Choose files</span>
        <span class="file-message" id="txt">or drag and drop file here</span>
        <input class="file-input" type="file" name="file">
      </div>
      </div> 

      <div class="form-group">
      <div class="text-center">
        <input type="submit" name="submit" value="Upload" class="btn btn-info btn-lg">
      </div>
      </div>

      </form>
    </div>



    <div class="col-md-6 p-5 bg-dark">
        <h2 class="text-center">SECONDARY IMAGES</h2>
            <br>
            <br>
        <form action="uploadsecondary.php" method="post" enctype="multipart/form-data">


          <div class="form-group">
          <label>Academic Year</label>
          <select class="form-control" name="academic_year">
            <?php 
            $firstYear = (int)date('Y') - 1;
                  $lastYear = $firstYear + 5;
                  for($i=$firstYear;$i<=$lastYear;$i++)
                  
                  {
                    $x = (int)$i + 1;
                      echo '<option>'.$i.'-'.$x.'</option>';
                  } 
            ?>
          </select>
          </div>

          <div class="form-group">
          <label>Select Term:</label>
          <select class="form-control" name="term">
          <option value="Term I">Term I</option>
          <option value="Term II">Term II</option>
          <option value="Term III">Term III</option>
          </select>
        </div>

        <div class="form-group">
        <div class="file-drop-area">
          <span class="choose-file-button">Choose files</span>
          <span class="file-message" id="txt">or drag and drop file here</span>
          <input class="file-input" type="file" multiple name="file">
        </div>
        </div> 

        <div class="form-group">
          <div class="text-center">
          <input type="submit" name="submit" value="Upload" class="btn btn-success btn-lg">
          </div>
        </div>

      </form>
      </div>
    </div>

</div>

<br>
<em>Education Technology Unit</em>

<script src="js/java.js"></script>

</body>
</html>