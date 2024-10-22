@extends('layout/vista')

@section('tituloPagina', 'Panel Administrativo')

@section('contenido')
    <div class="container">
        <div class="header">
            <h1>Panel Administrativo (Clientes)</h1>
            <button id="logoutBtn" class="btn btn-danger">Cerrar Sesión</button>
        </div>
        
        <div class="table-container">
            <table id="tblUsuarios" class="display responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Número de Celular</th>
                        <th>DNI</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script src="{{ asset('js/users.js') }}"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<style>
    .container {
        padding: 20px;
        background-color: #f8f9fa;
        min-height: 90vh;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 24px;
        color: #333;
    }

    .btn {
        background-color: #D5006D;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #B0004D;
    }

    .table-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #D5006D;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    @media (max-width: 768px) {
        .header {
            flex-direction: column;
            align-items: flex-start;
        }

        #logoutBtn {
            margin-top: 10px;
            width: 100%;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tblUsuarios = $("#tblUsuarios").DataTable({
            ajax: {
                url: "/api/clients/",
                dataSrc: '',
                contentType: "application/json; charset=utf-8"
            },
            columns: [
                { data: 'id' },
                { data: 'phone' },
                { data: 'dni' }
            ],
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    text: 'Copiar',
                    className: 'btn btn-info'
                },
                {
                    extend: 'csv',
                    text: 'Exportar CSV',
                    className: 'btn btn-success'
                },
                {
                    extend: 'excel',
                    text: 'Exportar Excel',
                    className: 'btn btn-warning'
                },
                {
                    extend: 'pdf',
                    text: 'Exportar PDF',
                    className: 'btn btn-danger'
                },
                {
                    extend: 'print',
                    text: 'Imprimir',
                    className: 'btn btn-primary'
                }
            ]
        });

        document.getElementById('logoutBtn').addEventListener('click', function() {
            window.location.href = "http://localhost:8000/";
        });
    });
</script>