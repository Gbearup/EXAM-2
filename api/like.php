<?php include_once "db.php";

$id=$_POST['id'];
$user=$_SESSION['user'];

$chk=$Log->count(['news'=>$id,'user'=>$user]);

if($chk>0){
    $Log->del(['news'=>$id,'user'=>$user]);
    $news['likes']--;
}else{
    $Log->save(['news'=>$id,'user'=>$user]);
    $news['likes']++;

}


$News->save($news);

// $id=$_POST['id'];  //從 POST 請求中獲取 id，它代表的是文章的 ID。這個 ID 是用戶點擊讚或收回讚時傳遞過來的，通常會從前端的按鈕中提取。
// $user=$_SESSION['user'];  //獲取當前用戶的 ID。這是通過會話 ($_SESSION) 存儲的，用戶登入後可以獲取其 ID，這樣就可以知道是誰在進行讚的操作。

// $news=$News->find($id);  //find($id) 根據 ID 查找文章的詳細信息並存入 $news 變數。

// $chk=$Log->count(['news'=>$id,'user'=>$user]);  //查詢 Log 表，看是否存在該用戶對這篇文章點過讚
//                                                 //根據條件（news 和 user）查詢資料表中的紀錄數量，並將結果存入 $chk 變數

// if($chk>0){
//     $Log->del(['news'=>$id,'user'=>$user]);      //表示用戶已經點過讚了，因此可以進行 收回讚 的操作。會刪除 Log 表中該用戶和文章的紀錄，
//     $news['likes']--;                            //並且該文章的 likes 數量減 1。
    
// }else{
//     $Log->save(['news'=>$id,'user'=>$user]);
//     $news['likes']++;

// }

// $News->save($news);      //將更新過後的 $news 資料保存回資料庫
