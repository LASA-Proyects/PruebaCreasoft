@extends('layout/vista')

@section('tituloPagina', 'Login')

@section('contenido')
    <div class="login-container">
        <h1>Login</h1>
        <form id="loginForm" class="form-responsive">
            <div class="mb-3">
                <input type="email" id="email" name="email" class="form-control" placeholder="Correo Electrónico" required>
            </div>
            <div class="mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" style="background-color: #D5006D; color: white;">Iniciar Sesión</button>
        </form>
    </div>
@endsection

<script src="{{ asset('js/users.js') }}"></script>

<style>
    .login-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #f8f9fa;
        padding: 20px;
    }

    .form-responsive {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    .form-control {
        border-radius: 5px;
    }

    .btn-primary {
        border-radius: 5px;
    }
</style>