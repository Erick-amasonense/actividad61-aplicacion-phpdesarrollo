<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary">
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card p-4 shadow">
            <h2 class="text-center">Crear Cuenta</h2>
            <form action="registro_action.php" method="POST">
                <div class="mb-3">
                    <label>Usuario</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Correo</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Registrarse</button>
            </form>
            <p class="mt-3 text-center"><a href="login.php">¿Ya tienes cuenta? Entra aquí</a></p>
        </div>
    </div>
</body>
</html>
