@extends('layout/vista')

@section('tituloPagina', 'Página de Laravel')

@section('contenido')
    <div class="admin-panel-link">
        <a href="/login" class="btn btn-panel">
            <i class="fas fa-user-cog"></i> Ingresar a Panel Administrativo
        </a>
    </div>

    <div class="container-carousel">
        <div class="carruseles" id="slider">
            <section class="slider-section with-gradient" style="background-image: url('{{ asset('images/fondo1.jpg') }}'); background-size: cover; background-position: center; position: relative;">
                <div class="form-container">
                    <form id="myForm" class="form-responsive">
                        <h2 class="text-left" style="font-weight: bold; font-style: italic; font-size: 1.8rem;">
                            <span style="color: #D5006D; font-weight: normal; font-style: italic;">!</span>
                            NUEVAS PROMOS ESTE 2023
                            <span style="color: #D5006D; font-weight: normal; font-style: italic;">!</span>
                        </h2>
                        <h5 style="font-size: 0.9rem; margin-bottom: 0.5px;">Tenemos nuevos planes para ti.</h5>
                        <h5 style="font-weight: bold; font-size: 0.9rem; margin-bottom: 15px;">Fibra Óptica para tu hogar:</h5>
                        <div class="mb-3">
                            <input type="number" id="celular" name="celular" class="form-control text-center" placeholder="Ingresa tu celular" required>
                        </div>
                        <div class="mb-3">
                            <input type="number" id="dni" name="dni" class="form-control text-center" placeholder="DNI" required>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" required>
                            <label class="form-check-label">Acepto las <a href="#" style="color: blue; text-decoration: underline;">Políticas de Privacidad</a></label>
                        </div>
                        <button type="submit" class="btn btn-a w-100" style="background-color: #D5006D; color: white;">LLÁMAME</button>
                    </form>
                </div>
                <div class="image-container">
                    <img src="{{ asset('images/fondo2.png') }}" alt="Imagen" class="side-image with-gradient">
                </div>
            </section>
            <section class="slider-section" style="background-color: #add8e6;"></section>
            <section class="slider-section" style="background-color: #90ee90;"></section>
        </div>
        <div class="btn-left">
            <i class="fas fa-chevron-left"></i>
        </div>
        <div class="btn-right">
            <i class="fas fa-chevron-right"></i>
        </div>
    </div>

    <script>
        document.getElementById('myForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const url = "/api/clients";
            const data = {
                phone: document.getElementById('celular').value,
                dni: document.getElementById('dni').value
            };

            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.setRequestHeader("Content-Type", "application/json");
            http.setRequestHeader("Accept", "application/json");
            http.send(JSON.stringify(data));

            http.onreadystatechange = function() {
                if (this.readyState == 4) {
                    const res = JSON.parse(this.responseText);
                    if (this.status == 200 || this.status == 201) {
                        alert("Cliente Registrado con Éxito");
                        document.getElementById('myForm').reset();
                    } else {
                        let mensajeError = res.message + "\n";
                        if (res.errors) {
                            Object.keys(res.errors).forEach(function(key) {
                                mensajeError += key + ": " + res.errors[key].join(', ') + "\n";
                            });
                        }
                        alert(mensajeError);
                    }
                }
            };
        });
    </script>

    <style>
        .admin-panel-link {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
        }

        .btn-panel {
            background-color: #D5006D;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-weight: bold;
        }

        .btn-panel i {
            margin-right: 10px;
        }

        .btn-panel:hover {
            background-color: #C20060;
        }

        .slider-section {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 0 10px;
        }

        .form-container {
            width: 80%;
            max-width: 300px;
            z-index: 1;
        }

        .form-responsive {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .form-control {
            border-radius: 20px;
            width: 100%;
        }

        .btn-a {
            border-radius: 20px;
        }

        .image-container {
            width: 50%;
            display: flex;
            justify-content: center;
        }

        .side-image {
            max-width: 100%;
            border-radius: 10px;
        }

        .with-gradient {
            position: relative;
        }

        .with-gradient::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to left, rgba(253, 177, 151, 1), rgba(255, 255, 255, 0));
            z-index: 1;
        }

        .slider-section .form-container,
        .slider-section .image-container {
            position: relative;
            z-index: 2;
        }

        .side-image {
            position: relative;
            z-index: 2;
        }

        @media (max-width: 768px) {
            .admin-panel-link {
                top: 10px;
                right: 10px;
            }

            .container-carousel {
                height: 150px;
            }
            .form-container {
                max-width: 300px;
            }
            .image-container {
                width: 30%;
            }
        }

        @media (max-width: 480px) {
            .admin-panel-link {
                top: 5px;
                right: 5px;
                font-size: 12px;
            }

            .container-carousel {
                height: 120px;
            }
            .form-container {
                max-width: 250px;
            }
            .image-container {
                width: 25%;
            }
        }
    </style>
@endsection