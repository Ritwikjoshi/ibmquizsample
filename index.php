<!DOCTYPE html>
<html lang="en">
<head>
     <title>IBM Cloudant Sample</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <link rel="stylesheet" href="src/css/bootstrap.css">
     <link rel="stylesheet" href="src/css/customcss.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
     <script src="src/js/jquery.js"></script>
     <script type="text/JavaScript" src='src/js/customjs.js'></script>
     <script type="text/javascript">
          function checknumberoffiles() 
          {
             var numberoffiles = document.getElementById('file').files.length;
             var sizeoffiles = 0;
             for (var i = 0; i < numberoffiles; i++)
             {
               sizeoffiles = sizeoffiles + document.getElementById('file').files[i].size;
             };

             if(sizeoffiles > 134217728)
             {
                alert("!File Upload Limit Exceeded\n You can upload maximum of 134Megabytes of data in one time");
                document.getElementById('file').value = "";
             }
             if (numberoffiles > 20)
              {
                alert("!File Upload Limit Exceeded\n You can upload maximum of 20 file in one time");
                document.getElementById('file').value = "";
              }

          }
     </script>

</head>
<body>
 
<nav class="navbar navbar-collapse navbar-expand-sm bg-light navbar-light">
<a class="navbar-brand" href="#" style="color:#166fff">IBM Cloudant Sample</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="collapsibleNavbar">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link active" href="/index.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/index.php">Admin</a>
    </li>
  </ul>
</div>
</nav>  

  <div class="container">
    <!--<form method="POST" action="https://test-food.eu-gb.mybluemix.net/upload" enctype="multipart/form-data">-->
    <form method="POST" action="/IBM/ibmsample/uploaddata.php" enctype="multipart/form-data">
          <h4 class="card-title"></h4>
            <div id="teaminformation" class="container card shadow-lg p-3 mb-5 bg-white rounded" style="margin: 0 auto;padding: 5%;">
                <h4 class="card-title"></h4>
                <div><h4 style="text-align:center;">File Upload Menu</h4></div>
                <div class="form-group">
                     <label class="control-label" for="username">User Name:</label>
                     <div class="">
                          <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                     </div>
                </div>
                <div class="form-group">
                     <label class="control-label" for="submissionfiles">Upload the submission files:</label>
                     <div class="">
                          <input type="file" class="form-control" id="file" name="file[]" placeholder="submissionfiles" onchange="checknumberoffiles();" required multiple>
                     </div>
                </div>
                <div class="card-footer btn-group-justified d-flex justify-content-center">
                  <button type="submit" class="btn btn-success col-sm-2"><i class="fa fa-bookmark"></i> Submit</button>
                </div> 
            </div>     
     <!--</div>-->
     </form>

  </div>
</body>
</html>
