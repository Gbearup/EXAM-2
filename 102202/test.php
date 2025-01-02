<?PHP
session_start();

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db13";
    protected $pdo;
    protected $table;

    function __construct($table){
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }
}

?>