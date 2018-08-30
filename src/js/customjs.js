function uploadValidation(fileInput)
          {
              //var fileInput = document.getElementById('studentsphotograph');
              var filePath = fileInput.value;
              var allowedExtensions = /(\.doc|\.json|\.ppt|\.pptx)$/i;
              if(!allowedExtensions.exec(filePath)){
                  alert('Please upload file having extensions .doc/.json/.ppt/.pptx only.');
                  fileInput.value = '';
                  return false;
              }else{
                  //Image preview
                  if (fileInput.files && fileInput.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function(e) {
                          document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
                      };
                      reader.readAsDataURL(fileInput.files[0]);
                  }
              }
          }

         
function movetodiv(presentdiv,divtogo)
{
    var presentdiv = document.getElementById(presentdiv);
    var divtogo = document.getElementById(divtogo);
    
    presentdiv.style.display = "none";
    divtogo.style.display = "block";

    $('html, body').animate({ scrollTop: 0 }, 'slow');
    
}
function postdata()
{
  var quiztitle = document.getElementById("quiztitle").value;
  var numberofquestions = document.getElementById("numberofquestions").value;
  var marksperquestion = document.getElementById("marksperquestion").value;
  var totaltimeforquiz = document.getElementById("totaltimeforquiz").value;

  if (quiztitle== ""|numberofquestions== ""|marksperquestion== ""|totaltimeforquiz == "") {
      alert("All details must be filled out");
      return false;
  }
  else
  {
  window.location.href = "index.php?quiztitle="+quiztitle+"&numberofquestions="+numberofquestions+"&marksperquestion="+marksperquestion+"&totaltimeforquiz="+totaltimeforquiz;
  }
}

function submitform()
{
  document.getElementById("quizform").submit();
}

function deletequiz(id,rev)
{
  var url = "https://0394f385-5643-40db-b1aa-94749be22786-bluemix:359ceb21f168b585b78d9386e2220d7bb49cfe6cc55399704532996ee267be2a@0394f385-5643-40db-b1aa-94749be22786-bluemix.cloudant.com/quizzes/"+id+"?rev="+rev;
  var xhr = new XMLHttpRequest();
  xhr.open("DELETE", url, true);
  xhr.setRequestHeader("Access-Control-Allow-Origin","*");
  xhr.setRequestHeader("Access-Control-Allow-Methods","DELETE");
  xhr.setRequestHeader( "Content-Type", "application/json" );
  xhr.onload = function () {
    var users = JSON.parse(xhr.responseText);
    if (xhr.readyState == 4 && xhr.status == "200") {
      console.table(users);
    } else {
      console.error(users);
    }
  }
  xhr.send(null);
  alert("Quiz Deleted Successfully");

}