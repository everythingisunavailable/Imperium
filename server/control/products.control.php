<?php
//if ($_SERVER['REQUEST_METHOD'] != 'GET') die();

include 'helper.control.php';
require '../model/Product.php';

$raw_data = file_get_contents("php://input");
$data = json_decode($raw_data, true);

getProducts($data);

function getProducts($filters)
{
    require '../../config/db.php';
    $pro = new Product($conn);
    
    //If user is seeing a specific product page, we return only that product using its id
    if (array_key_exists('productId', $filters)) {
        $queryResult = $pro->getProductById($filters['productId']);
        giveResponse($queryResult);
    }

    //Best selling products
    if (array_key_exists('bestSelling', $filters)) {
        $filtersQuery = " ORDER BY orders DESC LIMIT ".$filters['bestSelling'];
        $queryResult = $pro->getProductsByFilters($filtersQuery);
        giveResponse($queryResult);
    }

    //New products
    if (array_key_exists('newProducts', $filters)) {
        $filtersQuery = " ORDER BY created_at DESC LIMIT ".$filters['newProducts'];
        $queryResult = $pro->getProductsByFilters($filtersQuery);
        giveResponse($queryResult);
    }

    $filtersQuery = "";

    //Category / Group filter
    if (array_key_exists('group', $filters)) $filtersQuery = addFilter($filtersQuery, "category_group = ".$filters['group']);
    if (array_key_exists('category', $filters)) $filtersQuery = addFilter($filtersQuery, "category_name = ".$filters['category']);

    //Price filter
    if (array_key_exists('minPrice', $filters)) $filtersQuery = addFilter($filtersQuery, "price >= ".$filters['minPrice']);
    if (array_key_exists('maxPrice', $filters)) $filtersQuery = addFilter($filtersQuery, "price <= ".$filters['maxPrice']);

    //Sorting and ordering
    if (array_key_exists('sort', $filters)) {
        $order = " DESC";
        if (array_key_exists('order', $filters) && $filters['order'] == "Ascending") $order = " ASC";
        $filtersQuery = $filtersQuery . " ORDER BY " .$filters['sort'] .$order;
    }

    //Page product limit
    $limit = 50;
    $offset = 0;
    if (array_key_exists('page', $filters)) $offset = 50 * ($filters['page'] - 1);
    $filtersQuery = $filtersQuery . " LIMIT " .$limit. " OFFSET " .$offset;
    
    //Running query
    $queryResult = $pro->getProductsByFilters($filtersQuery);
    giveResponse($queryResult);

    $conn = null;
}

function addFilter($filtersQuery, $filter) {
    if (strlen($filtersQuery) > 0) return $filtersQuery . " && " . $filter;
    return $filtersQuery . " WHERE " . $filter;
}

function giveResponse($result) {
    if (!$result) echo json_encode(['products' => 'No results found.']);
    else echo json_encode($result);
    die();
}