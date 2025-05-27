<?php
require_once "../config/session.php";
require "./model/Cart.php";

function showCartItems()
{

    $userId = $_SESSION['user_id'] ?? null;

    if (!$userId) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit;
    }
    require '../config/db.php';
    $cart = new Cart($conn, $userId);
    $items = $cart->getUserItems();

    if (empty($items)) {
        http_response_code(404);
        echo 'No items found in cart';
        return [];
    }

    return $items;
    $conn = null;
}
