<?php
namespace App;
use PDO;
use App\Model;
//modelka
class Database
{
    private $id;
    private $name;
    private $tale;
    private $price;
    private $connection;

    public function __construct(){
        $this->connection = new PDO
        ('mysql:host=localhost;dbname=huy;charset=utf8', 'newuser', 'password');
    }

    public function show(){
        $sql = 'SELECT * from food';
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $mod = [];
        foreach ($results as $result) {
            array_push($mod, new Model($result['id'], $result['name'], $result['tale'], $result['price']));
        }
        return $mod;
    }


    public function save($id,$name,$tale,$price){
        $data = array( 'id'=>$id, 'name' => $name, 'tale'=>$tale,
            'price'=>$price);
        $query = $this->connection->prepare("insert into food (id, name, tale, price) 
        values (:id, :name, :tale, :price)");
        $query->execute($data);
    }



    public function poisk($ID){
        $sql = "SELECT * FROM food WHERE id=$ID";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $this->connection->query($sql);
        $test = $stmt->fetch();
        if ($test)
        {return $result;}

        else{echo ("<b>Объект не найден</b>");}
    }

    public function poiskPrice($price){
        $sql = "SELECT * FROM food WHERE price = $price";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $this->connection->query($sql);
        $test = $stmt->fetch();
        if ($test)
        {return $result;}

        else{echo ("<b>Нифига нету</b>");}
    }


    public function del($delID)
    {
        $sql = "DELETE FROM food WHERE id=$delID";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

    }


}