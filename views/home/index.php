<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
    <h1>Cihat Cetin</h1>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Giriş yapmış durumdasınız.</p>
        <p><a href="/user/<?php echo $_SESSION['user_id']; ?>">Profilim</a></p>
        <p><a href="/logout">Çıkış Yap</a></p><br>
    <?php else: ?>
        <p><a href="/login">Giriş Yap</a></p>
    <?php endif; ?>
</body>
</html> 