<?php





session_start();
use App\models\Product;

require_once $_SERVER["DOCUMENT_ROOT"] . "/bootstrap.php";
$stream = file_get_contents("php://input");
if($stream != null){
        //декодируем полученые данные

            $data = json_decode($stream)->data;
            // $user_id = $_SESSION["user"]["id"];
            $action = json_decode($stream)->action;
            // var_dump($data);
            // var_dump($stream);
                $recipe = match($action){
                    "filter"=>Product::filter($data->brand,$data->category,$data->size,$data->types,$data->color),
                    'filterNewTowar'=>Product::getFiltersNews($data)
                };

            echo json_encode([
                "productInBasket"=>$recipe,
            ], JSON_UNESCAPED_UNICODE);


}