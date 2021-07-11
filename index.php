<?php
  include_once "Question.php";
  $table = 'test';
  $conn = mysqli_connect('localhost','hieus207','hieuhieu01','thiblx');
  mysqli_set_charset($conn, 'UTF8');
//  mysql_query("SET character_set_results=utf8");
  if(!$conn)
  {
  die('khong ket noi dc');
  }

//************************ TRUY VAN QUESTION -----------------------------------------------*/


  function getQS($id){
    global $conn;
    $table="question";
    $sql="SELECT * FROM $table WHERE Idquestion=$id";
    $rs=mysqli_query($conn,$sql);
    $result=mysqli_fetch_all($rs,MYSQLI_ASSOC);
    return $result;
  }

  function getAllQS(){
    global $conn;
    $table="question";
    $sql="SELECT * FROM $table";
    $rs=mysqli_query($conn,$sql);
    $result=mysqli_fetch_all($rs,MYSQLI_ASSOC);
    return $result;
  }
  
  function createQS($QForm,$QContent,$QDa1,$QDa2,$QDa3,$QDa4,$QDadung){
    global $conn;
    $table="question";
    $sql="INSERT INTO `question` (`Idquestion`, `Questionform`, `Content`, `Image`, `Da1`, `Da2`, `Da3`, `Da4`, `Dadung`) VALUES (NULL,'$QForm','$QContent','','$QDa1','$QDa2','$QDa3','$QDa4','$QDadung')";
    // echo $sql;
    try{
      mysqli_query($conn,$sql);
      return true;
    }catch(Exception $e){
      return false;
    }
  }

  function deleteQS($id){
    global $conn;
    $table="question";
    $sql="DELETE FROM `test` WHERE `Listquestion`=$id";
    $sql2="DELETE FROM `$table` WHERE `Idquestion`=$id";
    // echo $sql;
    try{
      mysqli_query($conn,$sql);
      mysqli_query($conn,$sql2);
      return true;
    }catch(Exception $e){
      return false;
    }
  }
  
  function deleteQSinTest($TestID,$QuesID){
     global $conn;
    $table="question";
    $sql="DELETE FROM `test` WHERE `Listquestion`=$QuesID AND `Idtest`=$TestID";
    // echo $sql;
    try{
      mysqli_query($conn,$sql);
      return true;
    }catch(Exception $e){
      return false;
    }
  }
  function updateQS($id,$Qform,$QContent,$QDa1,$QDa2,$QDa3,$QDa4,$QDadung){
    global $conn;
    $table="question";
    $sql="UPDATE `$table` SET `Questionform`= '$Qform' ,`Content`='$QContent',`Da1`='$QDa1',`Da2`='$QDa2',`Da3`='$QDa3',`Da4`='$QDa4',`Dadung`='$QDadung' WHERE `Idquestion`=$id";
    // echo $sql;
    try{
      mysqli_query($conn,$sql);
      return true;
    }catch(Exception $e){
      return false;
    }
  }
  
  //************************ TRUY VAN TEST ************************************************/
  function addQStoTest($TestId,$QuesId){
    global $conn;
    $table="test";
    $sql="INSERT INTO `test` (`Idtest`, `Listquestion`, `Time`) VALUES ('$TestId', '$QuesId', NULL)";
    // echo $sql;
    try{
      mysqli_query($conn,$sql);
      return true;
    }catch(Exception $e){
      return false;
    }
  }


  function createTest($QuesID){
    global $conn;
    $table="test";
    $sql="INSERT INTO `test` (`Idtest`, `Listquestion`, `Time`) VALUES (NULL, '$QuesID', NULL)";
    // echo $sql;
    try{
      mysqli_query($conn,$sql);
      return true;
    }catch(Exception $e){
      return false;
    }
  }
  
  function delTest($TestID){
    global $conn;
    $table="test";
    $sql="DELETE FROM `test` WHERE `Idtest`=$TestID";
    // echo $sql;
    try{
      mysqli_query($conn,$sql);
      return true;
    }catch(Exception $e){
      return false;
    } 
  }
  function getTest($id=""){
    global $conn;
    global $table;
    $add="";
    if($id!=""&&$id!=-1) $add=" WHERE Idtest=$id"; 
    if($id==-1) $add=" ORDER BY RAND () LIMIT 20";
    $sql="SELECT * FROM $table".$add;
    $rs=mysqli_query($conn,$sql);
    $result=mysqli_fetch_all($rs,MYSQLI_ASSOC);
    //echo $sql;
   // print_r($result);
    return $result;
  }

  function getAllTest(){
    global $conn;
    global $table; 
    $sql="SELECT DISTINCT Idtest FROM $table";
    $rs=mysqli_query($conn,$sql);
    $result=mysqli_fetch_all($rs,MYSQLI_ASSOC);
    return $result;
  }
  //**************************************************TRUY VAN USER*********************************** */
  function login($usn,$pass){
    global $conn;
    $table="users";
    $sql="SELECT * FROM $table WHERE Username='".$usn."' AND Password='".$pass."' AND Active=1";
    $rs=mysqli_query($conn,$sql);
    $result=mysqli_fetch_all($rs,MYSQLI_ASSOC);
    return $result;
  }


  function getUser($usn){
    global $conn;
    $table="users";
    $sql="SELECT * FROM $table WHERE Username='".$usn."'";
    $rs=mysqli_query($conn,$sql);
    $result=mysqli_fetch_all($rs,MYSQLI_ASSOC);
    return $result;
  }
  function createUser($usn,$passwd,$name,$Recover){
    global $conn;
    $table="users";
    $sql="INSERT INTO $table (`Iduser`, `Username`, `Password`, `Name`, `Permission`,`Recover`) VALUES (NULL, '".$usn."', '".$passwd."', '".$name."', '','".$Recover."')";
    // echo $sql;
    mysqli_query($conn,$sql);
  }

  function getAllUser(){
    global $conn;
    $table="users";
    $sql="SELECT * FROM $table";
    $rs=mysqli_query($conn,$sql);
    $result=mysqli_fetch_all($rs,MYSQLI_ASSOC);
    return $result;
  }

  // function updateUser($iduser,$username,$name,$permission,$active,$recover){
  //   global $conn;
  //   $table="users";
  //   $sql="UPDATE `$table` SET `Username`= '$username' ,`Name`='$name',`Permission`='$permission',`Active`='$active',`Recover`='$recover' WHERE `Iduser`= '$iduser'";
  //   // echo $sql;
  //   try{
  //     mysqli_query($conn,$sql);
  //     return true;
  //   }catch(Exception $e){
  //     return false;
  //   }
  // }

  function deleteUser($Iduser){
    global $conn;
    $table="users";
    $sql="DELETE FROM `users` WHERE `Iduser`=$Iduser";
   // echo $sql;
    try{
      mysqli_query($conn,$sql);
      // return true;
      return $sql;
    }catch(Exception $e){
      return false;
    } 
  }
 // --------------------------------------------------------------------XU LY REQUEST------------------------------------------------------------------------------- 
// LAY INFO TEST
if(isset($_GET['action'])&&$_GET['action']=="getTest"){
  $listqs=array();
  $Tests=getTest($_GET['idtest']); 
  $idTest="";
  $time="";
  foreach($Tests as $test ){
    $idTest = $test['Idtest'];
    array_push($listqs,$test['Listquestion']);
    $time = $test['Time'];
  }
  // print_r($Tests);
  $listQS = [];
  
  foreach($listqs as $qs){
    $ques=getQS($qs);
    $question=$ques[0];
    $rs=new Question($question['Idquestion'],$question['Questionform'],$question['Content'],$question['Image'],$question['Da1'],$question['Da2'],$question['Da3'],$question['Da4'],$question['Dadung']);
  //   print_r($question[0]);
    
    array_push($listQS,$rs);
  //   break;
  }
  // print_r($listQS);
  $array1 = array(
      'Idtest' => $idTest,
      'Time' => $time,
      'Listquestion' => $listQS
  );
  echo (json_encode($array1)); 
}
// --------------LAY TEST RANDOM----------------------------------------
if(isset($_GET['action'])&&$_GET['action']=="getTestRand"){
  $listqs=array();
  $Tests=getTest(-1); 
  $idTest="";
  $time="";
  foreach($Tests as $test ){
    $idTest = $test['Idtest'];
    array_push($listqs,$test['Listquestion']);
    $time = $test['Time'];
  }
 // print_r($listqs);
  $listQS = [];
  
  foreach($listqs as $qs){
    $ques=getQS($qs);
    $question=$ques[0];
    $rs=new Question($question['Idquestion'],$question['Questionform'],$question['Content'],$question['Image'],$question['Da1'],$question['Da2'],$question['Da3'],$question['Da4'],$question['Dadung']);
//     print_r($question[0]);
    
    array_push($listQS,$rs);
  //   break;
  }
//  print_r($listQS);
//  echo "print xong";
  $array1 = array(
      'Idtest' => $idTest,
      'Time' => $time,
      'Listquestion' => $listQS
  );
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
}
// LAY ID ALL TEST
  if(isset($_GET['action'])&&$_GET['action']=="getAllTest"){
    // $listqs=array();
    $Tests=getAllTest(); 
    $idTest="";
    // $time=""; 
    $array1 = array(
      'allTest' => $Tests
  );
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 

}
//----------------------------------------------- QUESTION-------------------------------------------------------------//
if(isset($_GET['action'])&&$_GET['action']=='getAllQS'){
  $questions=getAllQS();
  $array1 = array(
    'allQS' => $questions
  );
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
}
  
if(isset($_POST['action'])&&$_POST['action']=='updateQS'){
  //
  $array1 = array(
    'status' => updateQS($_POST['QId'],$_POST['QForm'],$_POST['QContent'],$_POST['QDa1'],$_POST['QDa2'],$_POST['QDa3'],$_POST['QDa4'],$_POST['QDadung'])
  );
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
}

if(isset($_POST['action'])&&$_POST['action']=='deleteQS'){
  //
  $array1 = array(
    'status' => deleteQS($_POST['QId'])
  );
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
}

if(isset($_POST['action'])&&$_POST['action']=='createQS'){
  //
  $array1 = array(
    'status' => createQS($_POST['QForm'],$_POST['QContent'],$_POST['QDa1'],$_POST['QDa2'],$_POST['QDa3'],$_POST['QDa4'],$_POST['QDadung'])
  );
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
}

if(isset($_POST['action'])&&$_POST['action']=='deleteQSinTest'){
  //
  $array1 = array(
    'status' => deleteQSinTest($_POST['TestID'],$_POST['QuesID'])
  );
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
}

if(isset($_POST['action'])&&$_POST['action']=='addQStoTest'){
  //
  $array1 = array(
    'status' => addQStoTest($_POST['TestID'],$_POST['QuesID'])
  );
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
}

if(isset($_POST['action'])&&$_POST['action']=='createTest'){
  //
  $array1 = array(
    'status' => createTest($_POST['QuesID'])
  );
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
}

if(isset($_POST['action'])&&$_POST['action']=='delTest'){
  //
  $array1 = array(
    'status' => delTest($_POST['TestID'])
  );
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
}
// -----------------------------------------------------XU LY USER--------------------------------------------------
if(isset($_GET['action'])&&$_GET['action']=='getAllUser'){
  $users=getAllUser();
  $array1 = array(
    'allUser' => $users
  );
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
}

if(isset($_POST['action'])&&$_POST['action']=='updateUser'){
  //
  $array1 = array(
    // 'status' => updateUser($_POST['Iduser'],$_POST['Username'],$_POST['Name'],$_POST['Permission'],$_POST['Active'],$_POST['Recover'])
  );
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
}

if(isset($_POST['action'])&&$_POST['action']=='deleteUser'){
  $array1 = array(
    'status' => 'true',
    // 'message' => deleteUser($_POST['Iduser'])
  );

  //echo "co vao ham del user";
  echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
}
///----------------------------

// LOGIN
  if(isset($_POST['Username'])&&isset($_POST['Password'])&&!isset($_POST['Name'])){
    $user=login($_POST['Username'],$_POST['Password']);
    if(sizeof($user)>0){
      $array1 = array(
        'Iduser' => $user[0]['Iduser'],
        'Username' => $user[0]['Username'],
        'Name' => $user[0]['Name'],
        'Permission' => $user[0]['Permission']
      );
      echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
    }
//    echo sizeof(login($_POST['Username'],$_POST['Password']));
  }
// REGISTER
if(isset($_POST['Username'])&&isset($_POST['Password'])&&isset($_POST['Name'])){
  if(sizeof(getUser($_POST['Username']))==0){
    $Recover = substr(md5(rand()), 0, 8);
    try{
      createUser($_POST['Username'],$_POST['Password'],$_POST['Name'],$Recover);
      $array1 = array(
        'Username' => $_POST['Username'],
        'Recover'  => $Recover
      );
      echo (json_encode($array1,JSON_UNESCAPED_UNICODE)); 
    }
    catch(exception $e){
      
    }
  }  
}


//    echo sizeof(login($_POST['Username'],$_POST['Password']));
?>
