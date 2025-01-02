<?php include_once "db.php";


//將表單提交中 $_POST['subject'] 的值（即用戶輸入的內容）儲存到資料表中的 text 欄位

$Que->save(['text'=>$_POST['subject'],'main_id'=>0,'vote'=>0]);

$subject_id=q("select id from que where text='{$_POST['subject']}'")[0][0];




//這段代碼會遍歷提交的選項（$_POST['options']），並將每一個選項儲存到資料庫中
// $_POST['options'] 是一個包含所有選項的陣列。這個陣列來自於用戶在前端表單中輸入的所有選項。假設用戶在表單中輸入了多個選項並點擊了「更多」按鈕，這些選項的值就會被儲存在 $_POST['options'] 這個陣列中。
// Foreach 是 PHP 中的迴圈語句，它會遍歷陣列中的每一個元素，並將每一個元素賦值給變數 $opt，讓你可以逐個處理每個選項。
// 在這裡，$opt 就是陣列中的每個選項。第一次迴圈時，$opt 會是「選項 1」，第二次是「選項 2」，以此類推。
// 

foreach($_POST['options'] as $opt){
    $Que->save([               //是一個用來將資料儲存到資料庫的函數。這個函數會將一組資料（這裡是一個關聯陣列）傳遞給資料庫。在這裡，傳遞的資料是 ['text' => $opt, 'main_id' => $subject_id, 'vote' => 0]，這是一個關聯陣列，包含三個欄位：
        'text'=>$opt,          //將 $opt 的值（即當前迴圈中的選項）儲存到資料庫中的 text 欄位。$opt 是用戶輸入的選項名稱
        'main_id'=>$subject_id,  //將問卷的 ID（$subject_id）儲存到資料庫中的 main_id 欄位。這樣可以將這些選項與對應的問卷關聯起來，讓選項知道它是屬於哪一個問卷的。
        'vote'=>0             //將 0 儲存到 vote 欄位，通常用來初始化投票數，這裡的 0 表示投票數是從零開始的。
    ]);


}

?>