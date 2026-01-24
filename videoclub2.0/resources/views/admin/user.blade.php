@extends('layouts.master')
@section('content')

<style>
    /* Mensajes de alerta */
    .alert-message {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        animation: slideDown 0.3s ease-out;
    }
    
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Encabezado de la página */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .page-title {
        font-size: 24px;
        color: #333;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .page-title i {
        color: #4a6ee0;
    }
    
    /* Botones de acción */
    .btn {
        padding: 10px 20px;
        border-radius: 6px;
        border: none;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .btn-primary {
        background-color: #4a6ee0;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #3a5ed0;
        transform: translateY(-2px);
        text-decoration: none;
        color: white;
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 14px;
    }
    
    /* Contenedor de tabla */
    .table-container {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        overflow-x: auto;
    }
    
    /* Estilos de tabla */
    .users-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }
    
    .users-table thead {
        background-color: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
    }
    
    .users-table th {
        padding: 18px 16px;
        text-align: left;
        font-weight: 600;
        color: #495057;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }
    
    .users-table td {
        padding: 16px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }
    
    .users-table tbody tr {
        transition: background-color 0.2s ease;
    }
    
    .users-table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    /* Celda de usuario */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #4a6ee0;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 16px;
    }
    
    .user-info {
        display: flex;
        flex-direction: column;
    }
    
    .user-name {
        font-weight: 600;
        color: #333;
    }
    
    .user-email {
        font-size: 14px;
        color: #6c757d;
    }
    
    /* Badges de estado */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    
    .status-active {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }
    
    .status-inactive {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .status-pending {
        background-color: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }
    
    /* Acciones */
    .actions {
        display: flex;
        gap: 8px;
    }
    
    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        color: #495057;
        border: 1px solid #dee2e6;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
    }
    
    .action-btn.edit:hover {
        background-color: #e3f2fd;
        color: #007bff;
        border-color: #007bff;
    }
    
    .action-btn.delete:hover {
        background-color: #fde8e8;
        color: #dc3545;
        border-color: #dc3545;
    }
    
    /* Estado vacío */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 64px;
        color: #dee2e6;
        margin-bottom: 20px;
    }
    
    .empty-state p {
        font-size: 18px;
        margin: 0;
    }
    
    /* Paginación */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 20px 0;
        margin: 0;
    }
    
    .pagination li {
        margin: 0 5px;
    }
    
    .pagination a,
    .pagination span {
        display: inline-block;
        padding: 8px 16px;
        border-radius: 6px;
        background-color: white;
        color: #4a6ee0;
        border: 1px solid #dee2e6;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .pagination a:hover {
        background-color: #4a6ee0;
        color: white;
        border-color: #4a6ee0;
    }
    
    .pagination .active span {
        background-color: #4a6ee0;
        color: white;
        border-color: #4a6ee0;
    }
    
    /* Barra de búsqueda y filtros */
    .users-filters {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .search-box {
        position: relative;
        width: 300px;
    }
    
    .search-box input {
        width: 100%;
        padding: 12px 20px 12px 45px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    
    .search-box input:focus {
        outline: none;
        border-color: #4a6ee0;
        box-shadow: 0 0 0 3px rgba(74, 110, 224, 0.1);
    }
    
    .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        
        .search-box {
            width: 100%;
        }
        
        .users-filters {
            flex-direction: column;
            align-items: stretch;
        }
    }
</style>

<!-- Mensajes de éxito o error -->
@if(session('success'))
<div id="success-message" class="alert-message alert-success">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
<script>
    setTimeout(function() {
        document.querySelector('#success-message').style.display = 'none';
    }, 3000);
</script>
@endif

@if(session('error'))
<div id="error-message" class="alert-message alert-error">
    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
</div>
<script>
    setTimeout(function() {
        document.querySelector('#error-message').style.display = 'none';
    }, 3000);
</script>
@endif

<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-users"></i>
        Gestión de Usuarios
    </h1>
    
    <a href="" class="btn btn-primary">
        <i class="fas fa-user-plus"></i>
        Nuevo Usuario
    </a>
</div>

<!-- Filtros y búsqueda -->
<div class="users-filters">
    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" id="search-input" placeholder="Buscar por nombre, email...">
    </div>
    
    <div>
        <button class="btn btn-sm" id="filter-active">
            <i class="fas fa-user-check"></i> Activos
        </button>
        <button class="btn btn-sm" id="filter-all">
            <i class="fas fa-users"></i> Todos
        </button>
    </div>
</div>

<!-- Tabla de usuarios -->
<div class="table-container">
    @if($users->isEmpty())
        <div class="empty-state">
            <i class="fas fa-users-slash"></i>
            <p>No hay usuarios registrados</p>
            <p class="mt-3">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i>
                    Crear Primer Usuario
                </a>
            </p>
        </div>
    @else
        <table class="users-table">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div class="user-cell">
                            <div class="user-avatar">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div class="user-info">
                                <span class="user-name">{{ $user->name }}</span>
                                <span class="user-id">ID: {{ $user->id }}</span>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role == 'admin')
                            <span class="badge bg-primary">Administrador</span>
                        @elseif($user->role == 'editor')
                            <span class="badge bg-info">Editor</span>
                        @else
                            <span class="badge bg-secondary">Usuario</span>
                        @endif
                    </td>
                    <td>
                        @if($user->status == 'active')
                            <span class="status-badge status-active">
                                <i class="fas fa-circle"></i> Activo
                            </span>
                        @elseif($user->status == 'inactive')
                            <span class="status-badge status-inactive">
                                <i class="fas fa-circle"></i> Inactivo
                            </span>
                        @else
                            <span class="status-badge status-pending">
                                <i class="fas fa-circle"></i> Pendiente
                            </span>
                        @endif
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                    </td>
                    <td>
                        <!--
                        <div class="actions">
                            <a href="" class="action-btn" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="" class="action-btn edit" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>


<script>
// Búsqueda en tiempo real
document.getElementById('search-input').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('.users-table tbody tr');
    
    rows.forEach(row => {
        const name = row.querySelector('.user-name').textContent.toLowerCase();
        const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
        
        if (name.includes(searchTerm) || email.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Filtros de estado
document.getElementById('filter-active')?.addEventListener('click', function() {
    filterByStatus('active');
});

document.getElementById('filter-all')?.addEventListener('click', function() {
    filterByStatus('all');
});

function filterByStatus(status) {
    const rows = document.querySelectorAll('.users-table tbody tr');
    
    rows.forEach(row => {
        const statusBadge = row.querySelector('.status-badge');
        if (!statusBadge) return;
        
        const hasActive = statusBadge.classList.contains('status-active');
        
        if (status === 'all') {
            row.style.display = '';
        } else if (status === 'active') {
            row.style.display = hasActive ? '' : 'none';
        }
    });
}
</script>

@stop