<?php
$errors=[];
//check da ton tai chua]
//define 
$username = "";
$phone = "";
$email = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_REQUEST['username'] ;
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];

    //check trong va dung dinh dang chua
//    if(empty($username) || empty($phone) || empty($email)) {
//       $errors['empty'] = "Vui long nhap thong tin";
//    }
    if(!preg_match("/^[a-zA-Z0-9]{6,20}$/", $username) ) {
       $errors['username'] = "Phải có ít nhất 1 chữ cái hoa và thường và ít nhất 6 kí tự và nhiều nhất 20 kí tự";
    }
    if(!preg_match("/^(038|035)[0-9]{5,7}$/", $phone)){
        $errors['phone'] = "Bắt đầu là 038 hoặc 035 và phải có ít nhất 8 kí tự số";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Dinh dang khong hop le";
    }
    //NEU K LOIX
    if(empty($errors)){
        // show form
        $submitted = true;
    }

}
?>
<html>

<head>
    <title>Validation</title>
</head>

<body>
    <?php if (isset($submitted) && $submitted) :
    echo "Username:". $username ."<br>";
    echo "Phone". $phone ."<br>";
    echo "Email:".$email ."<br>";
    ?>

    <?php else : ?>
    <form method="post" action="validation.php">
        <div class="mt-3">
            <label for="username" class="form-label">Username</label>
            <br>
            <input type="text" class="form-control" id="username" name="username" required
                value="<?php echo $username; ?>">
            <?php if (isset($errors['username'])) echo "<span style='color: red;'>" . $errors['username'] . "</span>"; ?>
        </div>
        <div class="mt-3">
            <label for="phone" class="form-label">Phone</label>
            <br>
            <input type="tel" class="form-control" id="phone" name="phone" required value="<?php echo $phone; ?>">
            <?php if (isset($errors['phone'])) echo "<span style='color: red;'>" . $errors['phone'] . "</span>"; ?>
        </div>
        <div class="mt-3">
            <label for="email" class="form-label">Email</label>
            <br>
            <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email; ?>">
            <?php if (isset($errors['email'])) echo "<span style='color: red;'>" . $errors['email'] . "</span>"; ?>
        </div>
        <input type="submit" value="submit">
    </form>
    <?php endif; ?>
</body>

</html>