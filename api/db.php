<?php

session_start();

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db13";
    protected $pdo;
    protected $table;
    static public $type=[
        1=>'健康新知',
        2=>'菸害防制',
        3=>'癌症防治',
        4=>'慢性病防治',
    ];

    function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }

    /**
     * 撈出全部資料
     * 1. 整張資料表
     * 2. 有條件
     * 3. 其他SQL功能
     */
    function all(...$arg){
        $sql="SELECT * FROM $this->table ";
        if(!empty($arg[0])){
            if(is_array($arg[0])){

                $where=$this->a2s($arg[0]);
                $sql=$sql . " WHERE ". join(" && ",$where);
            }else{
                //$sql=$sql.$arg[0];
                $sql .= $arg[0];

            }
        }

        if(!empty($arg[1])){
            $sql=$sql . $arg[1];
        }

        return $this->fetchAll($sql);
    }

    function find($id){
        $sql="SELECT * FROM $this->table ";

        if(is_array($id)){
            $where=$this->a2s($id);
            $sql=$sql . " WHERE ". join(" && ",$where);
        }else{
            $sql .= " WHERE `id`='$id' ";
        }
        return $this->fetchOne($sql);
    }

    function save($array){

        if(isset($array['id'])){
            //update
            //update table set `欄位1`='值1',`欄位2`='值2' where `id`='值' 
            $id=$array['id'];
            unset($array['id']);
            $set=$this->a2s($array);
            $sql ="UPDATE $this->table SET ".join(',',$set)." where `id`='$id'";
                
        }else{
            //insert
            $cols=array_keys($array);
            $sql="INSERT INTO $this->table (`".join("`,`",$cols)."`) VALUES('".join("','",$array)."')";
        }
        
        //echo $sql;
        return $this->pdo->exec($sql);
    }
    
    function del($id){
        $sql="DELETE FROM $this->table ";

        if(is_array($id)){
            $where=$this->a2s($id);
            $sql=$sql . " WHERE ". join(" && ",$where);
        }else{
            $sql .= " WHERE `id`='$id' ";
        }

        //echo $sql;  
        return $this->pdo->exec($sql);
    }

    
    /**
     * 把陣列轉成條件字串陣列
     */
    function a2s($array){
        $tmp=[];
        foreach($array as $key => $value){
            $tmp[]="`$key`='$value'";
        }
        return $tmp;
    }

    function max($col,$where=[]){
        return $this->math('max',$col,$where);
    }
    function sum($col,$where=[]){
        return $this->math('sum',$col,$where);
    }
    function min($col,$where=[]){
        return $this->math('min',$col,$where);
    }
    function avg($col,$where=[]){
        return $this->avg('avg',$col,$where);
    }
    function count($where=[]){
        return $this->math('count','*',$where);
    }

    /**
     * 取得單筆資料
     */
    protected function fetchOne($sql){
        //echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * 取得多筆資料
     */
    protected function fetchAll($sql){
        //echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * 方便使用各個聚合函式
     */
    
     protected function math($math,$col='id',$where=[]){
        $sql="SELECT $math($col) FROM $this->table";

        if(!empty($where)){
            $tmp=$this->a2s($where);
            $sql=$sql . " WHERE " . join(" && ", $tmp);
        }

        return $this->pdo->query($sql)->fetchColumn();
    }

}

function q($sql){
    $pdo=new PDO("mysql:host=localhost;charset=utf8;dbname=db13",'root','');
    return $pdo->query($sql)->fetchAll();
}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url){
    header("location:".$url);
}

$Total=new DB('total');
$User=new DB('users');
$News=new DB('news');
$Que=new DB('que');
$Log=new DB('log');




if(!isset($_SESSION['view'])){
    if($Total->count(['date'=>date("Y-m-d")])>0){          //查詢資料庫中，是否已經存在今天（date("Y-m-d") 代表今天的日期）的瀏覽記錄
                                                           //$Total->count() 是用來查詢資料庫中符合條件的資料數量，這裡的條件是 date 等於今天的日期。如果有該日期的紀錄（即數量大於 0），則進入這個條件
        $total=$Total->find(['date'=>date("Y-m-d")]);      //如果資料庫中有今天的瀏覽紀錄，則使用 find() 方法從資料庫中查詢出這條記錄。$Total->find() 返回今天的記錄資料。
        $total['total']++;                                 //將今天的 total（瀏覽次數）加 1，表示今天的瀏覽次數增加了一次。
        $Total->save($total);                              //將更新後的 total 資料保存回資料庫。它會更新今天的瀏覽次數
    }else{
        $Total->save(['date'=>date("Y-m-d"),'total'=>1]);  //如果資料庫中沒有今天的瀏覽記錄（count 返回 0），則進入 else 區塊，並插入一條新的紀錄，表示今天是第一次瀏覽。
    }                                                      //這條紀錄會設置 date 為今天的日期，total 設為 1（即今天的瀏覽次數為 1）。
    $_SESSION['view']=1;                                   //最後，這行代碼將 $_SESSION['view'] 設為 1，這樣在同一會話中就不會再次進行這段程式碼的執行（避免重複記錄同一天的瀏覽次數）。
}


// 總結：
// 這段程式碼的作用是：

// 檢查用戶的會話中是否已經記錄過今天的瀏覽。
// 如果沒有，則查詢資料庫，看看是否已有今天的瀏覽紀錄。
// 如果有，則將今天的瀏覽次數加 1，並保存回資料庫。
// 如果沒有，則插入一條新記錄，表示今天的瀏覽次數為 1。
// 最後，設置 $_SESSION['view']，防止在同一會話中重複記錄。
// 這樣做的目的是統計每天的訪問次數，並確保每個用戶在同一會話中不會重複計算。