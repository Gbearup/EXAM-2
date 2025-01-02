<?php  include_once "db.php";

if(isset($_POST['ids'])){
    foreach($_POST['ids'] as $id){
        if(isset($_POST['del']) && in_array($id,$_POST['del'])){
            $News->del($id);
        }else{
            $row=$News->find($id);  // 取得指定id的新聞資料
            $row['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;         
            // 檢查是否有設定 $_POST['sh'] 且 $id 在 $_POST['sh'] 陣列中
            // 若是則將 $news['sh'] 設為 1，否則設為 0
            $News->save($row);  // 呼叫 News 物件的 save() 方法儲存新聞資料
        }
    }
}
    
   
?>