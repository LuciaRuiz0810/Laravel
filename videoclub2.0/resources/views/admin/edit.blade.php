<style>
    /* Contenedor principal */
    .form-container {
        margin-top: 40px;
        margin-bottom: 40px;
    }

    /* Card del formulario */
    .form-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: none;
    }

    .card-header {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 25px;
        font-size: 22px;
        font-weight: 600;
        text-align: center;
        border: none;
        letter-spacing: 0.5px;
    }

    /* Mensajes de alerta */
    .alert-message {
        padding: 15px 20px;
        border-radius: 8px;
        margin: 20px 30px;
        font-weight: 500;
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
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Body del card */
    .card-body {
        padding: 40px;
    }

    /* Grupos de formulario */
    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        display: block;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 15px;
        transition: all 0.2s ease;
        background-color: white;
        color: #495057;
    }

    .form-control:focus {
        outline: none;
        border-color: #2c3e50;
        background-color: white;
        box-shadow: 0 0 0 2px rgba(44, 62, 80, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
    }

    /* Mensajes de error de validación */
    .error-message {
        color: #dc3545;
        font-size: 13px;
        margin-top: 6px;
        display: block;
        font-weight: 500;
    }

    /* Botones */
    .btn-submit {
        background: #2c3e50;
        color: white;
        padding: 12px 50px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-submit:hover {
        background: #34495e;
        box-shadow: 0 4px 12px rgba(44, 62, 80, 0.2);
    }

    .btn-submit:active {
        transform: translateY(1px);
    }

    .btn-secondary {
        background: white;
        color: #2c3e50;
        padding: 12px 50px;
        border: 2px solid #2c3e50;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-secondary:hover {
        background: #2c3e50;
        color: white;
        text-decoration: none;
    }

    .button-group {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 35px;
        flex-wrap: wrap;
    }

    .text-center {
        text-align: center;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-body {
            padding: 25px;
        }

        .card-header {
            font-size: 18px;
            padding: 20px;
        }

        .btn-submit,
        .btn-secondary {
            width: 100%;
            padding: 12px 30px;
        }

        .button-group {
            flex-direction: column;
        }
    }

    /* Animación de entrada */
    .form-card {
        animation: fadeInUp 0.5s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="row form-container" style="margin-top:40px">
    <div class="offset-md-3 col-md-6">
        <div class="card form-card">
            <div class="card-header text-center">
                Editar Película
            </div>

            <!-- mensajes de éxito o error después de realizar la creación-->
            @if(session('success'))
            <div class="alert-message alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="alert-message alert-error">{{ session('error') }}</div>
            @endif

            <div class="card-body" style="padding:30px">

                <form action="/edit/movie/{{ $movies->id }}/new" method="POST" enctype="multipart/form-data">
                    @method('PUT')

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $movies->title }}">
                        @error('title')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="year">Año</label>
                        <input type="text" name="year" id="year" class="form-control" value="{{  $movies->year }}">
                        @error('year')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="director">Director</label>
                        <input type="text" name="director" id="director" class="form-control" value="{{ $movies->director }}">
                        @error('director')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="poster">Imagen</label>

                        <input type="file" name="poster" id="poster" class="form-control" accept="image/*">
                        @error('poster')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="synopsis">Sinopsis</label>
                        <textarea name="synopsis" id="synopsis" class="form-control" rows="3">{{ $movies->synopsis }}</textarea>
                        @error('synopsis')<span class="error-message">{{ $message }}</span>@enderror
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn-submit">
                            Guardar Cambios
                        </button>
                        <a href="{{ url('/index') }}" class="btn-secondary">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>