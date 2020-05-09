<?php


namespace App\Domain;

use App\ProductPriceType;
use Exception;
use App\LoginHistory\LoginHistory;
use App\Order\Order;
use App\Product\Product;

class GetClientOrdersQuery
{
    public static function getAuthenticatedClientOrders(string $token, string $priceType = null): array
    {
        $priceType = !$priceType ? ProductPriceType::EURO : $priceType;

        try {
            $clientId = self::getClientId($token);
            $orders = self::getOrdersHistoryForClient($clientId);
            if(!$orders || count($orders) === 0){
                return [];
            }
            $orderIds = [];
            $ordersQuantity = [];

            foreach ($orders as $order){
                array_push($orderIds, $order->product_id);
                $ordersQuantity[$order->product_id]['quantity'] = $order->quantity;
            }

            $orderProducts = self::getOrderProducts($orderIds);
            $ordersList = [];
            foreach ($orderProducts as $product) {
                $singleOrder['id'] = $product->id;
                $singleOrder['quantity'] = $ordersQuantity[$product->id]['quantity'];
                $singleOrder['product_name'] = $product->product_name;
                $singleOrder['product_type'] = $product->product_type;

                $priceType === ProductPriceType::EURO ?
                    $singleOrder['price'] = $product->price_euro :
                    $singleOrder['price'] = $product->price_dollar;

                if (isset($product->description)) {
                    $singleOrder['description'] = $product->description;
                }
                if (isset($product->photo)) {
                    $singleOrder['photo'] = $product->photo;
                }
                array_push($ordersList, $singleOrder);
            }
            return $ordersList;

        } catch (Exception $e) {
            throw new Exception('There was a problem getting orders');
        }
    }

    protected static function getClientId(string $token):int
    {
        $data = LoginHistory::where('token', $token)
            ->select('client_id')
            ->first();

        return $data->client_id;
    }

    protected static function getOrdersHistoryForClient(int $clientId): array
    {
        try {
            $data = Order::where('client_id', $clientId)
                    ->pluck('products')
                    ->first();

            $productOrders = $data ? json_decode($data) : null;
            return $productOrders ? $productOrders : [];

        } catch (Exception $e) {
            throw new Exception('There was a problem getting order history');
        }
    }

    private static function getOrderProducts(array $orderIds): array
    {
        $data = Product::whereIn('id', $orderIds)->get();
        $orderProducts = json_decode($data);
        return $orderProducts ? $orderProducts : [];
    }
}
