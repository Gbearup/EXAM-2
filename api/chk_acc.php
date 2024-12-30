<?php include_once "db.php";

// $acc=$_GET['acc'];

// echo $res=$User->count(['acc'=>$acc]);

// 凶狠的寫法 就一條 

echo $User->count($_GET);


// if($res>0){
//     ecoh 1;
// }else{
//     echo 0;
// }

?>