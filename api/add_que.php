<?php include_once "db.php";


//將表單提交中 $_POST['subject'] 的值（即用戶輸入的內容）儲存到資料表中的 text 欄位

$Que->save(['text'=>$_POST['subject'],'main_id'=>0,'vote'=>0]);

$subject_id=q("select id from que where text='{$_POST['subject']}'")[0][0];






foreach($_POST['options'] as $opt){
    $Que->save([
        'text'=>$opt,
        'main_id'=>$subject_id,
        'vote'=>0
    ]);


}

?>