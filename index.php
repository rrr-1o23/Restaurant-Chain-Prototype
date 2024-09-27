<?php
// コードベースのファイルのオートロード
spl_autoload_extensions(".php"); 
spl_autoload_register();

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';
#require_once 'Models/Users/User.php';
#require_once 'Helpers/RandomGenerator.php';


// クエリ文字列からパラメータを取得
$min = $_GET['min'] ?? 5;
$max = $_GET['max'] ?? 5;

// パラメータが整数であることを確認
$min = (int)$min;
$max = (int)$max;

// ユーザーの生成
$employees = Helpers\RandomGenerator::employees($min, $max);
$restaurantLocations = Helpers\RandomGenerator::restaurantLocations($min, $max);
$restaurantChains = Helpers\RandomGenerator::restaurantChains($min, $max);
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