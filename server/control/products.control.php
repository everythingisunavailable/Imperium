<?php
require 'model/Product.php';

function getSpecificProduct($id) {
    $queryResult = $pro->getProductById($filters['productId']);
    return $queryResult;
}

function getHomeProducts($filters) {
    require '../config/db.php';
    $pro = new Product($conn);

    //Best selling products
    $sellingCount = 5;
    if ($filters && array_key_exists('bestSelling', $filters)) $sellingCount = $filters['bestSelling'];
    $filtersQuery = " ORDER BY orders DESC LIMIT ".$sellingCount;
    $queryResultSelling = $pro->getProductsByFilters($filtersQuery);

    //New products
    $newCount = 5;
    if ($filters && array_key_exists('newProducts', $filters)) $newCount = $filters['newProducts'];
    $filtersQuery = " ORDER BY created_at DESC LIMIT ".$newCount;
    $queryResultNew = $pro->getProductsByFilters($filtersQuery);

    return [
        'bestSelling' => $queryResultSelling,
        'newProducts' => $queryResultNew
    ];
}

function getProducts($filters) {
    require '../config/db.php';
    $pro = new Product($conn);

    $filtersQuery = "";

    //Category filter
    if ($filters && array_key_exists('category', $filters)) $filtersQuery = addFilter($filtersQuery, "category = " . "'".$filters['category']."'");

    //Price filter
    if ($filters && array_key_exists('minPrice', $filters)) $filtersQuery = addFilter($filtersQuery, "price >= ".$filters['minPrice']);
    if ($filters && array_key_exists('maxPrice', $filters)) $filtersQuery = addFilter($filtersQuery, "price <= ".$filters['maxPrice']);

    //Sorting and ordering
    if ($filters && array_key_exists('sort', $filters)) {
        $sort = 'created_at';
        switch ($filters['sort']) {
            case 'date':
                $sort = 'created_at';
                break;
            case 'price':
                $sort = 'price';
                break;
            case 'popularity':
                $sort = 'orders';
                break;
            case 'rating':
                $sort = 'rating';
        }
        $order = " DESC";
        if (array_key_exists('order', $filters) && $filters['order'] == "Ascending") $order = " ASC";
        $filtersQuery = $filtersQuery . " ORDER BY " .$sort .$order;
    }

    //Page product limit
    $limit = 50;
    $offset = 0;
    if ($filters && array_key_exists('page', $filters)) $offset = 50 * ($filters['page'] - 1);
    $filtersQuery = $filtersQuery . " LIMIT " .$limit. " OFFSET " .$offset;
    
    //Running query
    $queryResult = $pro->getProductsByFilters($filtersQuery);
    if (!$queryResult) {
        return null;
    } else {
        return $queryResult;
    }
    
    $conn = null;
}

function addFilter($filtersQuery, $filter) {
    if (strlen($filtersQuery) > 0) return $filtersQuery . " && " . $filter;
    return $filtersQuery . " WHERE " . $filter;
}