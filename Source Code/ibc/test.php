<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["file1"])){

	$target_dir = "upload/";
	$name = $_FILES['file1']['name'];
	$tmpname = $_FILES['file1']['tmp_name'];
	$string = str_replace(" ", "-", $name);
	$target_file = $target_dir . basename($string);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$file_name = pathinfo($name, PATHINFO_FILENAME);
	move_uploaded_file($tmpname, $target_file);
}

?>

<html>
 <head>
  <title>File Upload Progress Bar</title>
  <style type="text/css">
  	#bar_blank {
  border: solid 1px #000;
  height: 20px;
  width: 300px;
}

#bar_color {
  background-color: #006666;
  height: 20px;
  width: 0px;
}

#bar_blank, #hidden_iframe {
  display: none;
}
  </style>
 </head>
 <body>
  <div id="bar_blank">
   <div id="bar_color"></div>
  </div>
  <div id="status"></div>
  <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" 
   id="myForm" enctype="multipart/form-data" target="hidden_iframe">
   <input type="hidden" value="myForm"
    name="<?php echo ini_get("session.upload_progress.name"); ?>">
   <input type="file" name="file1"><br>
   <input type="submit" value="Start Upload">
  </form>
  <iframe id="hidden_iframe" name="hidden_iframe" src="about:blank"></iframe>
 </body>
</html>

<script type="text/javascript">
	function toggleBarVisibility() {
    var e = document.getElementById("bar_blank");
    e.style.display = (e.style.display == "block") ? "none" : "block";
}

function createRequestObject() {
    var http;
    if (navigator.appName == "Microsoft Internet Explorer") {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else {
        http = new XMLHttpRequest();
    }
    return http;
}

function sendRequest() {
    var http = createRequestObject();
    http.open("GET", "test2.php");
    http.onreadystatechange = function () { handleResponse(http); };
    http.send(null);
}

function handleResponse(http) {
    var response;
    if (http.readyState == 4) {
        response = http.responseText;
        document.getElementById("bar_color").style.width = response + "%";
        document.getElementById("status").innerHTML = response + "%";

        if (response < 100) {
            setTimeout("sendRequest()", 1000);
        }
        else {
            toggleBarVisibility();
            document.getElementById("status").innerHTML = "Done.";
        }
    }
}

function startUpload() {
    toggleBarVisibility();
    setTimeout("sendRequest()", 1000);
}

(function () {
    document.getElementById("myForm").onsubmit = startUpload;
})();

</script>