<?php
// コードベースのファイルのオートロード
spl_autoload_extensions(".php"); 
spl_autoload_register(function ($class) {
    // 名前空間を基にファイルパスを作成
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';
//require_once 'Models/Users/User.php';
//require_once 'Helpers/RandomGenerator.php';


// 変数の初期化
$employees = [];
$restaurantLocations = [];
$restaurantChains = [];

// クエリ文字列からパラメータを取得
$min = 5;
$max = $_POST['employeeCount'] ?? 5;
$locationCount = $_POST['locationCount'] ?? 2;
$format = $_POST['format'] ?? 'html';

// パラメータが整数であることを確認
$max = (int)$max;
$locationCount = (int)$locationCount;

// ユーザーの生成
try {
    $employees = Helpers\RandomGenerator::employees($min, $max);
    $restaurantLocations = Helpers\RandomGenerator::restaurantLocations($min, $max, $locationCount);
    $restaurantChains = Helpers\RandomGenerator::restaurantChains($min, $max, $locationCount);
} catch (Exception $e) {
    error_log("Error generating employees: " . $e->getMessage());
    die("Error generating employees. Please try again.");
}

if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="users.md"');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toMarkdown();
    }
    exit; // スクリプト終了

} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="users.json"');
    $chainsArray = array_map(fn($restaurantChain) => $restaurantChain->toArray(), $restaurantChains);
    echo json_encode($chainsArray);
    exit; // スクリプト終了

} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="users.txt"');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toString();
    }
    exit; // スクリプト終了

} else {
    // HTMLをデフォルトに
    header('Content-Type: text/html');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profiles</title>
    <!-- Bootstrap 5のCSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <h2 class="mt-5 text-center">Restaurant-Chain-Mockup</h2>
    <?php foreach ($restaurantChains as $restaurantChain): ?>
    <div class="user-card">
        <?php echo $restaurantChain->toHTML(); ?>
        <!-- <hr class="mt-5" style="border: none; height: 2px; background-color: #ff7e5f; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);"> -->
    </div>
    <?php endforeach; ?>

    <!-- Bootstrap 5のJavaScriptと依存するPopper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>