<?php
// Bắt đầu hoặc sử dụng phiên đã tồn tại
session_start();


if(isset($_SESSION['PJ2_loggedin']) && $_SESSION['PJ2_loggedin'] === true) {
    header("location: index.php");
    exit;
}
include "dbConnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Xử lý dữ liệu đăng nhập ở đây (ví dụ: kiểm tra tên đăng nhập và mật khẩu)
    
    $data_ar = login($_POST['username'], $_POST['password']);

    if ($data_ar !== false) {

        $data = json_decode($data_ar,true);
        if($data['is_success'] == 1) {
            // Đăng nhập thành công, thiết lập session và chuyển hướng người dùng
            $_SESSION['PJ2_loggedin'] = true;
            $_SESSION['PJ2_name'] = $data['name'];
            $_SESSION['PJ2_username'] = $data['username'];
            $_SESSION['PJ2_role'] = $data['role'];
            header("location: index.php");
            exit;
        } else {
            // Đăng nhập không thành công
            $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
        }
    } else {
        $error = "Có lỗi khi kết nối CSDL. Thử lại sau.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .login-container {
            margin-top: 5%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center login-container">
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                         <div class="row">
                            <div class="col-12 text-center">
                                <img src="/PJ2/logo.gif" alt="Logo" width="300">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <h5 class="mt-2">Đăng nhập</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php } ?>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group">
                                <label for="username">Tên đăng nhập:</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-eye" id="togglePassword"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // Toggle giữa "password" và "text"
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // Thay đổi biểu tượng của toggle
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>
</html>
