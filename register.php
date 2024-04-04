<?php
// Khai báo các biến và khởi tạo giá trị rỗng
$name = $age = $address = $phone = $employment = $email = $password = "";
$nameErr = $phoneErr = $emailErr = $passwordErr = $ageErr ="";
$submitted = false;

// Kiểm tra xem có dữ liệu được gửi đi không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị từ form
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $address = $_REQUEST['address'];
    $phone = $_REQUEST['phone'];
    $employment = $_REQUEST['employment'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    // Kiểm tra tính hợp lệ của tên
    if (empty($name)) {
        $nameErr = "Name is required";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
    }

    // Kiểm tra tính hợp lệ của số điện thoại
    if (empty($phone)) {
        $phoneErr = "Phone is required";
    } elseif (!preg_match("/^(038|035)[0-9]{5,7}$/", $phone)) {
        $phoneErr = "Invalid phone number format, start must be 038 or 035 and at least 8 characters long";
    }

    // Kiểm tra tính hợp lệ của email
    if (empty($email)) {
        $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    // Kiểm tra tính hợp lệ của mật khẩu
    if (empty($password)) {
        $passwordErr = "Password is required";
    } elseif (strlen($password) < 8 ||
        !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/", $password)) {
        $passwordErr = "Password at least 8 character ";
    }
    // Kiểm tra tuổi chỉ là số và có 2-3 chữ số
    if (!preg_match("/^[0-9]{2,3}$/", $age)) {
        $ageErr = "Age must be a number between 2 and 3";
    }

    // Kiểm tra nếu không có lỗi thì đánh dấu đã gửi thành công
    if (empty($nameErr) && empty($phoneErr) && empty($emailErr) && empty($passwordErr)) {
        $submitted = true;
    }
}
?>

<html>

<head>
    <title>Register</title>
</head>

<body>
    <style>
    .error {
        color: #FF0000;
    }
    </style>
    <h1>Đăng kí tài khoản</h1>
    <?php if ($submitted) : ?>
    <h2>Thông tin đã nhập:</h2>
    <p><strong>Name:</strong> <?php echo $name; ?></p>
    <p><strong>Age:</strong> <?php echo $age; ?></p>
    <p><strong>Address:</strong> <?php echo $address; ?></p>
    <p><strong>Phone:</strong> <?php echo $phone; ?></p>
    <p><strong>Employment:</strong> <?php echo $employment; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Password:</strong> ***</p>
    <?php else : ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="mb-3">
            <label for="name">Name</label><br>
            <input type="text" name="name" id="name" required value="<?php echo $name; ?>">
            <span class="error"> <?php echo $nameErr; ?></span>
        </div>
        <div class="mb-3">
            <label for="age">Age</label><br>
            <input type="number" name="age" id="age" value="<?php echo $age; ?>">
            <span class="error"> <?php echo $ageErr; ?></span>
        </div>
        <div class="mb-3">
            <label for="address">Address</label><br>
            <input type="text" autocomplete="off" name="address" id="address" value="<?php echo $address; ?>">
        </div>
        <div class="mb-3">
            <label for="phone">Phone</label><br>
            <input type="tel" name="phone" id="phone" required value="<?php echo $phone; ?>">
            <span class="error"> <?php echo $phoneErr; ?></span>
        </div>
        <div class="mb-3">
            <label for="employment">Employment</label><br>
            <input type="text" name="employment" id="employment" required value="<?php echo $employment; ?>">
        </div>
        <div class="mb-3">
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" autocomplete="off" required value="<?php echo $email; ?>">
            <span class="error"> <?php echo $emailErr; ?></span>
        </div>
        <div class="mb-3">
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" autocomplete="off" required
                value="<?php echo $password; ?>">
            <span class="error"><?php echo $passwordErr; ?></span>
        </div>

        <button type="submit">Submit</button>
    </form>
    <?php endif; ?>
</body>

</html>