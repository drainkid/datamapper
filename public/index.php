<?php
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Controller;
use App\Database;
use App\Model;
use App\FoodRep;

require_once dirname(__DIR__) . '/vendor/autoload.php';



$loader = new FilesystemLoader(dirname(__DIR__) . '/templates');
$twig = new Environment($loader);
$control = new Controller($twig);


$rep = new FoodRep;


$control -> dop_form();
$control->Show($rep->RepGetAll());
$control -> dop_form2();

$id = $_GET['id'];
$name = $_GET['name'];
$tale = $_GET['tale'];
$price = $_GET['price'];
$action = $_GET['add'];





$Id = $_POST['id'];
if ($Id != '') {
    $control->Poisk($rep->RepPoiskId($Id));
}


$Pr = $_POST['price'];
if ($Pr != '') {
    $control->Poisk($rep->RepPoiskPrice($Pr));
}

//Удаление и добавление записи через одно место
if ($id != '' && $name != '' && $tale != '' && $price != ''
)
{

    if (isset($_GET['add'])){
        $rep->RepAdd($id,$name,$tale,$price);}

    if (isset($_GET['delete'])){
        $rep->RepDelete($id);
    }
    header('Refresh: 0; url=index.php');
}

