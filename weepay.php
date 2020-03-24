<?php
$posts = [
    'Auth' => [
        'bayiId' => 'xxxxx',
        'apiKey' => 'xxxxxxxx-xxxx-x',
        'secretKey' => 'xxxxxxxx-xxxx-xxxx-x'
    ],
    'Data' => [
        'orderId' => 1,
        'currency' => 'TL',
        'locale' => 'tr',
        'ipAddress' => $_SERVER['REMOTE_ADDR'],
        'paidPrice' => 1,
        'cardHolderName' => 'Buğra Özkan',
        'cardNumber' => '1111111111111111',
        'expireMonth' => '00',
        'expireYear' => '00',
        'cvcNumber' => '000',
        'installmentNumber' => 1,
        'description' => 'Test Ürün Açıklaması',
        'callBackUrl' => 'https://bugraozkan.com.tr/payment.php'
    ],
    'Customer' => [
        'customerId' => 1,
        'customerName' => 'Buğra',
        'customerSurname' => 'Özkan',
        'gsmNumber' => '5444922985',
        'email' => 'contact@bugraozkan.com.tr',
        'identityNumber' => '11111111111',
        'city' => 'istanbul',
        'country' => 'turkey',
    ],
    'BillingAddress' => [
        'contactName' => 'Buğra Özkan',
        'address' => 'Esenyalı Mahallesi İmamı Azam Caddesi Soybaşı Sokak',
        'city' => 'istanbul',
        'country' => 'turkey',
        'zipCode' => 34903
    ],
    'ShippingAddress' => [
        'contactName' => 'Buğra Özkan',
        'address' => 'Esenyalı Mahallesi İmamı Azam Caddesi Soybaşı Sokak',
        'city' => 'istanbul',
        'country' => 'turkey',
        'zipCode' => 34903
    ],
    'Products' => [
        'product' => [
            'productId' => 1,
            'name' => 'Test Ürün',
            'productPrice' => 1,
            'itemType' => 'VIRTUAL'    
        ]
    ]
];

$encode = json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

$ch = curl_init('https://api.weepay.co/Payment/PaymentRequestThreeD');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $encode);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($encode)
    ]
);
$result = curl_exec($ch);

$decode = json_decode($result, true);

if (isset($decode['threeDSecureUrl'])) {

    header('Location: ' . $decode['threeDSecureUrl']);

} else {

    echo $decode['message'];

}
?>
