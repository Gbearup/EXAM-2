<?PHP
session_start();

class DB{
    protected $dsn="mysql:host=localhost; charset=utf8; dbname=db13";
    protected $pdo;
    protected $table;

    function __construct($table){
        $this->table=$table;
        $this->pdo=new pdo($this->dsn,'root','');
    }



function all(...$arg){
    $sql="SELECT * FROM $this->table";
    if(!empty($arg[0])){
       if(is_array($arg[0])){
        $where=$this->a2s($arg[0]);
        $sql=$sql . "WHERE" . join("&&", $where);
       }else{
        $sql.=$arg[0];
       }
       }

    if(!empty($arg[1])){
        $sql=$sql.$arg[1];
    }

    return $this->fetchAll($sql);
}



}
?>