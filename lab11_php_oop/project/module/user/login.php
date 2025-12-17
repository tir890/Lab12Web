<?php
// Pastikan tidak ada kode HTML atau spasi sebelum tag PHP
if (isset($_POST['submit'])) {
    $db = new Database();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '{$username}'";
    $result = $db->query($sql);
    $data = $result->fetch_assoc();

    if ($data && password_verify($password, $data['password'])) {
        $_SESSION['is_login'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama'] = $data['nama'];
        header('Location: ../artikel/list');
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<div style="width:300px; margin: 50px auto; padding: 20px; border: 1px solid #ddd;">
    <h3 style="text-align:center;">Login System</h3>
    <?php if(isset($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
    
    <form method="post">
        <label>Username</label><br>
        <input type="text" name="username" style="width:100%; margin-bottom:10px;" required><br>
        
        <label>Password</label><br>
        <input type="password" name="password" style="width:100%; margin-bottom:10px;" required><br>
        
        <button type="submit" name="submit" style="width:100%; cursor:pointer;">Login</button>
    </form>
</div>