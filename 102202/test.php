<?PHP

if(!empty($_SESSION['view'])){
   if($Total->count(['date'->date("Y-m-d")])>0){
     
    $total=$Total->find(['date'->date("Y-m-d")]);
    $total('total')++;
    $Total->save(['date'->date("Y-m-d")]);
   
   }else{

    $Total->save(['date'->date("Y-m-d"),'total'=>1]);
   }

   $_SESSION['view']=1;

}

?>


如果 物件去數今天的日期數量