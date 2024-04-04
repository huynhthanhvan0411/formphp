<?php
// Khai báo biến để lưu thông báo lỗi
$errors = [];
//define  
$name = "";
$age = "";
$address = "";
$phone = "";
$employment = "";
$email = "";
$password = "";
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
    $password =    $_REQUEST['password'];

    // Kiểm tra tính hợp lệ của tên
    if (empty($name)) {
        $errors['name'] = "Name is required";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors['name'] = "Only letters and white space allowed";
    }

    // Kiểm tra tính hợp lệ của số điện thoại
    if (empty($phone)) {
        $errors['phone'] = "Phone is required";
    } elseif (!preg_match("/^(038|035)[0-9]{5,7}$/", $phone)) {
        $errors['phone'] = "Invalid phone number format";
    }

    // Kiểm tra tính hợp lệ của email
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    // Kiểm tra tính hợp lệ của mật khẩu
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 8 ||
        !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/", $password)) {
        $errors['password'] = "Password at least 8 character ";
    }

    // Nếu không có lỗi, hiển thị thông tin đã nhập
    if (empty($errors)) {
        // Ẩn form và hiển thị thông tin đã nhập
        $submitted = true;
    }
}
?>

<html>

<head>
    <title>Register</title>
</head>

<body>
    <h1>Đăng kí tài khoản</h1>
    <?php if (isset($submitted) && $submitted) : ?>
    <h2>Thông tin đã nhập:</h2>
    <p><strong>Name:</strong> <?php echo $name; ?></p>
    <p><strong>Age:</strong> <?php echo $age; ?></p>
    <p><strong>Address:</strong> <?php echo $address; ?></p>
    <p><strong>Phone:</strong> <?php echo $phone; ?></p>
    <p><strong>Employment:</strong> <?php echo $employment; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Password:</strong> ***</p>
    <?php else : ?>
    <form method="post" action="">
        <div class="mb-3">
            <label for="name">Name</label><br>
            <input type="text" name="name" id="name" required value="<?php echo $name; ?>">
            <?php if (isset($errors['name'])) echo "<span style='color: red;'>" . $errors['name'] . "</span>"; ?>
        </div>
        <div class="mb-3">
            <label for="age">Age</label><br>
            <input type="number" name="age" id="age" value="<?php echo $age; ?>">
        </div>
        <div class="mb-3">
            <label for="address">Address</label><br>
            <input type="text" autocomplete="off" name="address" id="address" value="<?php echo $address; ?>">
        </div>
        <div class="mb-3">
            <label for="phone">Phone</label><br>
            <input type="tel" name="phone" id="phone" required value="<?php echo $phone; ?>">
            <?php if (isset($errors['phone'])) echo "<span style='color: red;'>" . $errors['phone'] . "</span>"; ?>
        </div>
        <div class="mb-3">
            <label for="employment">Employment</label><br>
            <input type="text" name="employment" id="employment" required value="<?php echo $employment; ?>">
        </div>
        <div class="mb-3">
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" autocomplete="off" required value="<?php echo $email; ?>">
            <?php if (isset($errors['email'])) echo "<span style='color: red;'>" . $errors['email'] . "</span>"; ?>
        </div>
        <div class="mb-3">
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" autocomplete="off" required
                value="<?php echo $password; ?>">
            <?php if (isset($errors['password'])) echo "<span style='color: red;'>" . $errors['password'] . "</span>"; ?>
        </div>

        <button type="submit">Submit</button>
    </form>
    <?php endif; ?>
</body>

</html>