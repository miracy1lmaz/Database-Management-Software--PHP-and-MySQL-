<?php
session_start();
// LOG INFO 
$validUsername = "";   
$validPassword = "";

if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] == $validUsername && $_POST['password'] == $validPassword) {



        $_SESSION['username'] = $_POST['username'];
        header("Location: admin_paneli.php");
        exit;
    } else {



        $error = "Kullanıcı adı veya şifre hatalı.";
    }
}
?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 400px;
            margin-top: 100px;
        }
        .form-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        }
        .form-container h1 {
            text-align: center;
            color: #007bff;
        }
        .form-container .form-control {
            border-radius: 0;
        }
        .form-container button {
            border-radius: 0;
            transition: background-color 0.3s ease;
        }
        .form-container button:hover {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Giriş Yap</h1>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="" method="POST" class="mt-3">
                <div class="mb-3">
                    <label for="username" class="form-label">Kullanıcı Adı</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Şifre</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
            </form>
        </div>
    </div>
</body>
</html>
