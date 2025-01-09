<?php
function dd($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

$data=[
    [
        'id' => 1,
        'name' => '台北',
        'mobile' => '0911-111-111',
        'address' => '台北市中正路1號'
    ],
    
    [
        'id' => 2,
        'name' => '台中',
        'mobile' => '0922-222-222',
        'address' => '台中市中正路2號'
    ],

    [
        'id' => 3,
        'name' => '高雄',
        'mobile' => '0933-333-333',
        'address' => '高雄市中正路3號'
    ]
    
    ];

    dd($data);

?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>資料表格</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">資料表格</h2>

<!-- 開始生成表格 -->
<table>
    <tr>
        <th>ID</th>
        <th>name</th>
        <th>mobile</th>
        <th>address</th>
    </tr>

    <?php
    // 使用迴圈顯示資料
    foreach ($data as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['mobile']) . "</td>";
        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>