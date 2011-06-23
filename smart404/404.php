<?php


//function to print out the begnning part of the url
function pageURL() 
{
  $pageURL = 'http://';
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  } 
  else {
    $pageURL .= $_SERVER["SERVER_NAME"];
  }

  return $pageURL;
}

//this function checks whether there is a file of the same name & extension in the array Data
function checkInData(){
 global $data, $file, $dirpath, $endsplit;
     foreach($data as $newext){
        $file =  '/' . $dirpath . $endsplit['0'] . '.' . $newext;
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . $file)){
         print "<font size='20px'> SUCCESS FOR $file</font>";
            header("Location: $file"); exit;
        }
    } 
}

//this function checks whether there is a file of the same name & extension in the array Img
function checkInImg(){
 global $img, $file, $dirpath, $endsplit;
     foreach($img as $newext){
        $file =  '/' . $dirpath . $endsplit['0'] . '.' . $newext;
        /* Was for debugging purposes only 
        print "<br /><b>Full: </b>" . $_SERVER['DOCUMENT_ROOT'] . $file . '<br />';
        print "<b>File: </b>" . $file;
        */
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . $file)){
         print "<font size='20px'> SUCCESS FOR $file</font>";
            header("Location: $file"); exit;
        }
    } 
}

//this function checks whether there is a file of the same name & extension in the array Audio
function checkInAudio(){
 global $audio, $file, $dirpath, $endsplit;
     foreach($audio as $newext){
        $file =  '/' . $dirpath . $endsplit['0'] . '.' . $newext;
        /* Was for debugging purposes only 
        print "<br /><b>Full: </b>" . $_SERVER['DOCUMENT_ROOT'] . $file . '<br />';
        print "<b>File: </b>" . $file;
        */
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . $file)){
         print "<font size='20px'> SUCCESS FOR $file</font>";
            header("Location: $file"); exit;
        }
    } 
}

//this function checks whether there is a file of the same name & extension in the array Video
function checkInVideo(){
 global $video, $file, $dirpath, $endsplit;
     foreach($video as $newext){
        $file =  '/' . $dirpath . $endsplit['0'] . '.' . $newext;
        /* Was for debugging purposes only 
        print "<br /><b>Full: </b>" . $_SERVER['DOCUMENT_ROOT'] . $file . '<br />';
        print "<b>File: </b>" . $file;
        */
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . $file)){
         print "<font size='20px'> SUCCESS FOR $file</font>";
            header("Location: $file"); exit;
        }
    } 
}

//this function checks whether there is a file of the same name & extension in the array Comp(Compressed)
function checkInComp(){
 global $comp, $file, $dirpath, $endsplit;
     foreach($comp as $newext){
        $file =  '/' . $dirpath . $endsplit['0'] . '.' . $newext;
        /* Was for debugging purposes only 
        print "<br /><b>Full: </b>" . $_SERVER['DOCUMENT_ROOT'] . $file . '<br />';
        print "<b>File: </b>" . $file;
        */
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . $file)){
         print "<font size='20px'> SUCCESS FOR $file</font>";
            header("Location: $file"); exit;
        }
    } 
}

//arrays of common datatypes
$img = array('bmp', 'gif', 'jpg', 'jpeg', 'png', 'tif');
$data = array('asp', 'cer', 'csr', 'css', 'htm', 'html', 'js', 'jsp', 'php', 'rss', 'xhtml');
$audio = array('aac', 'aif', 'iff', 'mp3', 'mpa', 'ra', 'wav', 'wma');
$video = array('3g2', '3gp', 'asf', 'asx', 'avi', 'flv', 'mov', 'mp4', 'mpg', 'rm', 'swf', 'vob', 'wmv');
$comp = array('7z', 'deb', 'gz', 'pkg', 'rar', 'sit', 'sitx', 'tar.gz', 'zip', 'zipx');

$url = $_SERVER['REQUEST_URI'];
$urlarray=explode('/', $url);
$dirs = $urlarray;
array_pop($dirs);

//$dirs now contains all the directories for the path
$dirpath ='';
foreach($dirs as $value){
    $dirpath .= $value . '/';
}
$dirpath = substr($dirpath, 1);
//$dirpath contains the directory listing for the url

$last = count($urlarray);
$last = $last - 1;
$secondlast = $last -1;
$end = $urlarray[$last];
$endsplit=explode('.', $end);
//endsplit['0'] is the file name, endsplit ['1'] is the extension

if(!isset($endsplit['1'])){
    $endsplit['1'] = 'html';    
}
$ext = $endsplit['1'];

$oldurl = pageurl();


//these if,elseif and else order them and make it more likely to get it right. Eg if you had test.wav and test.php. If someone searched for test.mp3, they would probably want test.wav not test.mp3
if(in_array($ext, $data)){
checkInData();
checkInImg();
checkInAudio();
checkInVideo();
checkInComp();
}

elseif(in_array($ext, $img)){
checkInImg();
checkInData();
checkInAudio();
checkInVideo();
checkInComp();
}

elseif(in_array($ext, $audio)){
checkInAudio();
checkInVideo();
checkInImg();
checkInData();
checkInComp();
}
elseif(in_array($ext, $video)){
checkInVideo();
checkInAudio();
checkInImg();
checkInData();
checkInComp();
}
elseif(in_array($ext, $comp)){
checkInComp();
checkInData();
checkInVideo();
checkInAudio();
checkInImg();
}
else{
checkInData();
checkInImg();
checkInAudio();
checkInVideo();
checkInComp();
}

print '<h1 style="margin:0; padding:0;">404 - Not found.</h1><br style="height:5px;" /> <h2 style="margin:0; padding:0;>If you clicked a valid link, please notify the webmater</h2>';

?>