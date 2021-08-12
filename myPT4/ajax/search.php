<?php
header("Content-Type: application/json;Charset=UTF-8");
require '../database.php';

$Json = array();

if (isset($_GET['search'])) {
    $field = ['FLD_PRODUCT_NAME', 'FLD_PRICE' , 'FLD_TYPE'];
    $search = htmlspecialchars($_GET['search']);
    $data = explode(" ", $search);

    // 0 - name
    // 1 - price
    // 2 - type

    $name = (isset($data[0]) ? $data[0] : '');
    $price = (isset($data[1]) ? $data[1] : '');
    $type = (isset($data[2]) ? $data[2] : '');

    try {
        /* if(count($data)==1){
            $stmt = $conn->prepare("SELECT * FROM `tbl_products_a174863_pt2` WHERE FLD_PRODUCT_NAME LIKE ? OR FLD_PRICE LIKE ? OR FLD_TYPE LIKE ?");
            $stmt->execute(["%{$search}%","%{$search}%", "%{$search}%"]);
        } elseif(count($data)==3){
            $stmt = $conn->prepare("SELECT * FROM `tbl_products_a174863_pt2` WHERE FLD_PRODUCT_NAME LIKE ? AND FLD_PRICE LIKE ? AND FLD_TYPE LIKE ?");
            $stmt->execute(["%{$name}%","%{$price}%", "%{$type}%"]);
        } */
        $queries = array();
        foreach($data as $dat){
            $queries[] = "SELECT * FROM `tbl_products_a174863_pt2` WHERE {$field[0]} LIKE '%{$dat}%' OR {$field[1]} LIKE '%{$dat}%' OR {$field[2]} LIKE '%{$dat}%'";
        }
        $sql = implode(' UNION ',$queries);
        $stmt = $conn->prepare($sql);

        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $Json = array('status' => 200, 'data' => $res);
    } catch (PDOException $e) {
        $Json = array('status' => 400, 'data' => $e->getMessage());
    }

}

if (isset($Json))
    echo json_encode($Json);
