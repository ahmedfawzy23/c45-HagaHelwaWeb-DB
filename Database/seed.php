<?php

require_once __DIR__ . '/../includes/db_connection.php';

// $categories = [
//     ['name_ar' => 'صيفي', 'name_en' => 'Summer'],
//     ['name_ar' => 'شتوي', 'name_en' => 'Winter'],
//     ['name_ar' => 'شبابي', 'name_en' => 'Youth'],
//     ['name_ar' => 'أطفال', 'name_en' => 'Kids'],
// ];
// $cat_ids=[];
// foreach ($categories as $category) {
//     mysqli_query($conn,
//     "INSERT INTO categories (name_ar, name_en) VALUES ('{$category['name_ar']}',
//     '{$category['name_en']}')");
//     $cat_ids[] = mysqli_insert_id($conn);
// }


$products = [
    ['image' => 'f1.jpg', 'stock' => 10, 'name_ar' => 'تيشيرت قطن', 'name_en' => 'Cotton T-Shirt', 'price' => 100, 'description_ar' => 'تيشيرت قطن مريح', 'description_en' => 'Comfortable cotton t-shirt', 'categories_id' => rand(9, 16)],
    ['image' => 'f2.jpg', 'stock' => 10, 'name_ar' => 'هودي', 'name_en' => 'Hoodie', 'price' => 200, 'description_ar' => 'هودي مريح', 'description_en' => 'Warm hoodie', 'categories_id' => rand(9, 16)],
    ['image' => 'f3.jpg', 'stock' => 10, 'name_ar' => 'شورت', 'name_en' => 'Short', 'price' => 300, 'description_ar' => 'شورت مريح', 'description_en' => 'Casual shorts', 'categories_id' => rand(9, 16)],
    ['image' => 'f4.jpg', 'stock' => 10, 'name_ar' => 'بنطلون جينز', 'name_en' => 'Jeans', 'price' => 400, 'description_ar' => 'بنطلون جينز مريح', 'description_en' => 'Stylish jeans', 'categories_id' => rand(9, 16)],
    ['image' => 'f1.jpg', 'stock' => 10, 'name_ar' => 'تيشيرت قطن', 'name_en' => 'Cotton T-Shirt', 'price' => 100, 'description_ar' => 'تيشيرت قطن مريح', 'description_en' => 'Comfortable cotton t-shirt', 'categories_id' => rand(9, 16)],
    ['image' => 'f2.jpg', 'stock' => 10, 'name_ar' => 'هودي', 'name_en' => 'Hoodie', 'price' => 200, 'description_ar' => 'هودي مريح', 'description_en' => 'Warm hoodie', 'categories_id' => rand(9, 16)],
    ['image' => 'f3.jpg', 'stock' => 10, 'name_ar' => 'شورت', 'name_en' => 'Short', 'price' => 300, 'description_ar' => 'شورت مريح', 'description_en' => 'Casual shorts', 'categories_id' => rand(9, 16)],
    ['image' => 'f4.jpg', 'stock' => 10, 'name_ar' => 'بنطلون جينز', 'name_en' => 'Jeans', 'price' => 400, 'description_ar' => 'بنطلون جينز مريح', 'description_en' => 'Stylish jeans', 'categories_id' => rand(9, 16)],
    ['image' => 'f1.jpg', 'stock' => 10, 'name_ar' => 'تيشيرت قطن', 'name_en' => 'Cotton T-Shirt', 'price' => 100, 'description_ar' => 'تيشيرت قطن مريح', 'description_en' => 'Comfortable cotton t-shirt', 'categories_id' => rand(9, 16)],
    ['image' => 'f2.jpg', 'stock' => 10, 'name_ar' => 'هودي', 'name_en' => 'Hoodie', 'price' => 200, 'description_ar' => 'هودي مريح', 'description_en' => 'Warm hoodie', 'categories_id' => rand(9, 16)],
    ['image' => 'f3.jpg', 'stock' => 10, 'name_ar' => 'شورت', 'name_en' => 'Short', 'price' => 300, 'description_ar' => 'شورت مريح', 'description_en' => 'Casual shorts', 'categories_id' => rand(9, 16)],
    ['image' => 'f4.jpg', 'stock' => 10, 'name_ar' => 'بنطلون جينز', 'name_en' => 'Jeans', 'price' => 400, 'description_ar' => 'بنطلون جينز مريح', 'description_en' => 'Stylish jeans', 'categories_id' => rand(9, 16)],
    ['image' => 'f1.jpg', 'stock' => 10, 'name_ar' => 'تيشيرت قطن', 'name_en' => 'Cotton T-Shirt', 'price' => 100, 'description_ar' => 'تيشيرت قطن مريح', 'description_en' => 'Comfortable cotton t-shirt', 'categories_id' => rand(9, 16)],
    ['image' => 'f2.jpg', 'stock' => 10, 'name_ar' => 'هودي', 'name_en' => 'Hoodie', 'price' => 200, 'description_ar' => 'هودي مريح', 'description_en' => 'Warm hoodie', 'categories_id' => rand(9, 16)],
    ['image' => 'f3.jpg', 'stock' => 10, 'name_ar' => 'شورت', 'name_en' => 'Short', 'price' => 300, 'description_ar' => 'شورت مريح', 'description_en' => 'Casual shorts', 'categories_id' => rand(9, 16)],
    ['image' => 'f4.jpg', 'stock' => 10, 'name_ar' => 'بنطلون جينز', 'name_en' => 'Jeans', 'price' => 400, 'description_ar' => 'بنطلون جينز مريح', 'description_en' => 'Stylish jeans', 'categories_id' => rand(9, 16)],
    ['image' => 'f1.jpg', 'stock' => 10, 'name_ar' => 'تيشيرت قطن', 'name_en' => 'Cotton T-Shirt', 'price' => 100, 'description_ar' => 'تيشيرت قطن مريح', 'description_en' => 'Comfortable cotton t-shirt', 'categories_id' => rand(9, 16)],
    ['image' => 'f2.jpg', 'stock' => 10, 'name_ar' => 'هودي', 'name_en' => 'Hoodie', 'price' => 200, 'description_ar' => 'هودي مريح', 'description_en' => 'Warm hoodie', 'categories_id' => rand(9, 16)],
    ['image' => 'f3.jpg', 'stock' => 10, 'name_ar' => 'شورت', 'name_en' => 'Short', 'price' => 300, 'description_ar' => 'شورت مريح', 'description_en' => 'Casual shorts', 'categories_id' => rand(9, 16)],
    ['image' => 'f4.jpg', 'stock' => 10, 'name_ar' => 'بنطلون جينز', 'name_en' => 'Jeans', 'price' => 400, 'description_ar' => 'بنطلون جينز مريح', 'description_en' => 'Stylish jeans', 'categories_id' => rand(9, 16)],
];

foreach ($products as $product) {
    mysqli_query(
        $conn,
        "INSERT INTO products (image,stock,name_ar,name_en,price,description_ar,description_en,categories_id)
        VALUES ('{$product['image']}',
    '{$product['stock']}',
    '{$product['name_ar']}',
    '{$product['name_en']}',
    '{$product['price']}',
    '{$product['description_ar']}',
    '{$product['description_en']}',
    '{$product['categories_id']}')"
    );
}
// $adminPass = password_hash('admin', PASSWORD_DEFAULT);
// $userPass = password_hash('123456', PASSWORD_DEFAULT);

// $users = [
//     ['username' => 'Admin', 'email' => 'admin@shop.com', 'password' => $adminPass, 'role' => 'admin', 'phone' => '01000000000'],
//     ['username' => 'Ahmed', 'email' => 'ahmed@shop.com', 'password' => $userPass, 'role' => 'admin', 'phone' => '01000000001'],
// ];

// foreach ($users as $user) {
//     mysqli_query(
//         $conn,
//         "INSERT INTO users (username,email,password,role,phone)
//         VALUES ('{$user['username']}',
//     '{$user['email']}',
//     '{$user['password']}',
//     '{$user['role']}',
//     '{$user['phone']}')"
//     );
// }

echo "Data Inserted Successfully";
