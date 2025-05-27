<?php
include 'helper.control.php';
require '../model/Product.php';

function getSpecificProduct($id) {
    $queryResult = $pro->getProductById($filters['productId']);
    return $queryResult;
}

function getHomeProducts($filters) {
    require '../../config/db.php';
    $pro = new Product($conn);

    //Best selling products
    $sellingCount = 5;
    if (array_key_exists('bestSelling', $filters)) $sellingCount = $filters['bestSelling'];
    $filtersQuery = " ORDER BY orders DESC LIMIT ".$sellingCount;
    $queryResultSelling = $pro->getProductsByFilters($filtersQuery);

    //New products
    $newCount = 5;
    if (array_key_exists('newProducts', $filters)) $newCount = $filters['newProducts'];
    $filtersQuery = " ORDER BY created_at DESC LIMIT ".$newCount;
    $queryResultNew = $pro->getProductsByFilters($filtersQuery);

    return [
        'bestSelling' => $queryResultSelling,
        'newProducts' => $queryResultNew
    ];
}

function getProducts($filters) {
    require '../../config/db.php';
    $pro = new Product($conn);

    $filtersQuery = "";

    //Category filter
    if (array_key_exists('category', $filters)) $filtersQuery = addFilter($filtersQuery, "category = ".$filters['category']);

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
    if (!$result) {
        echo json_encode(['products' => 'No results found.']);
        return null;
    } else {
        return $result;
    }
    
    $conn = null;
}

function addFilter($filtersQuery, $filter) {
    if (strlen($filtersQuery) > 0) return $filtersQuery . " && " . $filter;
    return $filtersQuery . " WHERE " . $filter;
}