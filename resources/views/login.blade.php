<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- Tu CSS -->
    <link rel="stylesheet" href="{{ asset('assets/login.css') }}">
</head>

<body>

    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">

                        <h6 class="mb-0 pb-3"><span>Inicio Sesion </span><span>Registrarse</span></h6>

                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>

                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">

                                <!-- 🔐 LOGIN -->
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">

                                            <h4 class="mb-4 pb-3">Inicio Sesion</h4>
                                            @if ($errors->has('login'))
                                            <div id="errorLogin" class="alert alert-danger text-center rounded-pill">
                                                {{ $errors->first('login') }}
                                            </div>
                                            @endif
                                            <form method="POST" action="/login">
                                                @csrf

                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-style" placeholder="Correo" id="login-email" autocomplete="off" required>
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>

                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style" placeholder="Contraseña" id="login-pass" autocomplete="off" required>
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>

                                                <button type="submit" class="btn mt-4">Iniciar sesión</button>
                                            </form>

                                            <p class="mb-0 mt-4 text-center">
                                                <a href="#" class="link">¿Olvidaste tu contraseña?</a>
                                            </p>

                                        </div>
                                    </div>
                                </div>

                                <!-- 📝 REGISTER -->
                                <div class="card-back">
                                    <div class="center-wrap">
                                        <div class="section text-center">

                                            <h4 class="mb-4 pb-3">Registrarse</h4>
                                            @if(session('success'))
                                            <div id="alerta" class="alert alert-success text-center">
                                                {{ session('success') }}
                                            </div>
                                            @endif
                                            <form method="POST" action="/register">
                                                @csrf

                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-style" placeholder="Nombre" id="logname" autocomplete="off" required>
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>

                                                <div class="form-group mt-2">
                                                    <input type="email" name="email" class="form-style" placeholder="Correo" id="signup-email" autocomplete="off" required>
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>

                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style" placeholder="Contraseña (6 caracteres)" id="signup-pass" autocomplete="off" required>
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password_confirmation" class="form-style" placeholder="Confirmar contraseña" autocomplete="off" required>
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <button type="submit" class="btn mt-4">Registrarse</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            let alerta = document.getElementById('alerta');
            if (alerta) {
                alerta.style.transition = "opacity 0.5s";
                alerta.style.opacity = "0";
                setTimeout(() => alerta.remove(), 500);
            }
        }, 2000);
    </script>
    <script>
        setTimeout(() => {
            let error = document.getElementById('errorLogin');
            if (error) {
                error.style.transition = "opacity 0.5s";
                error.style.opacity = "0";
                setTimeout(() => error.remove(), 500);
            }
        }, 2000);
    </script>
</body>

</html>