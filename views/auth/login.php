<!DOCTYPE html>
<html>
<head>
    <title>Giriş Yap</title>
    <style>
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Giriş Yap</h1>
    
    <?php if (isset($error)): ?>
        <div class="error-message">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="/login">
        <div>
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" required>
        </div><br>
        
        <div>
            <label for="password">Şifre: <span style="margin-left: 7ch;"</span>
            </label>
            <input type="password" id="password" name="password" required>
        </div><br>
        
        <button type="submit">Giriş Yap</button>
    </form>
    
    <p><a href="/">Ana Sayfa</a></p>
</body>
</html> 