<div class="row" style="margin-top:40px">
    <div class="offset-md-3 col-md-6">
        <div class="card">
            <!-- Mensajes de éxito o error durante 3s -->
            @if(session('success'))
            <div id="success-message" style="color: green; padding: 10px; border: 1px solid green;">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('success-message').style.display = 'none';
                }, 3000);
            </script>
            @endif

            @if(session('error'))
            <div id="error-message" style="color: red; padding: 10px; border: 1px solid red;">
                {{ session('error') }}
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('error-message').style.display = 'none';
                }, 3000);
            </script>
            @endif
            <div class="card-header text-center">
                Modificar película
            </div>
            <div class="card-body" style="padding:30px">

                <form action="/catalog/edit/{{ $movies->id }}/update" method="POST">
                    @method('PUT')

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $movies->title }}">
                        @error('title')<span style="color: red">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="year">Año</label>
                        <input type="text" name="year" id="year" class="form-control" value="{{ $movies->year }}">
                        @error('year')<span style="color: red">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="director">Director</label>
                        <input type="text" name="director" id="director" class="form-control" value="{{ $movies->director }}">
                        @error('director')<span style="color: red">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="poster">Imagen</label>
                        <input type="text" name="poster" id="poster" class="form-control" value="{{ $movies->poster }}">
                        @error('poster')<span style="color: red">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="synopsis">Resumen</label>
                        <textarea name="synopsis" id="synopsis" class="form-control" rows="3">{{ $movies->synopsis }}</textarea>
                        @error('synopsis')<span style="color: red">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                            Modificar película
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>