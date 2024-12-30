<?php include_once "db.php";

unset($_POST['pw2']);
echo $User->save($_POST);



// 本來輸入的資料
// acc:$("#acc").val(),  
// pw:$("#pw").val(),    
// pw2:$("#pw2").val(),    
// email:$("#email").val(),









?>


