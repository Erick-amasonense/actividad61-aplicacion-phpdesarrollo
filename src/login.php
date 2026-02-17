<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container mt-5" style="max-width: 400px;">
        <div class="card p-4 shadow">
            <h2 class="text-center">Iniciar Sesión</h2>
            <form action="login_action.php" method="POST">
                <div class="mb-3">
                    <label>Usuario</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
            <p class="mt-3 text-center"><a href="registro.php">No tengo cuenta</a></p>
        </div>
    </div>
</body>
</html>
