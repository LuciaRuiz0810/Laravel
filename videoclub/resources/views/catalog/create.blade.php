<div class="row" style="margin-top:40px">
    <div class="offset-md-3 col-md-6">
        <div class="card">
            <div class="card-header text-center">
                Añadir película
            </div>
<!-- mensajes de éxito o error después de realizar la creación-->
            @if(session('success')){
            <div style="color: green;">{{ session('success') }}</div>
            }
            @endif

            @if(session('error')){
            <div style="color: red;">{{ session('error') }}</div>
            }
            @endif
            <div class="card-body" style="padding:30px">

                <form action="/catalog/create/new" method="POST">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                        @error('title')<span style="color: red">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="year">Año</label>
                        <input type="text" name="year" id="year" class="form-control" value="{{ old('year') }}">
                        @error('year')<span style="color: red">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="director">Director</label>
                        <input type="text" name="director" id="director" class="form-control" value="{{ old('director') }}">
                        @error('director')<span style="color: red">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="poster">Imagen</label>
                        <input type="text" name="poster" id="poster" class="form-control" value="{{ old('poster') }}">
                        @error('poster')<span style="color: red">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="synopsis">Resumen</label>
                        <textarea name="synopsis" id="synopsis" class="form-control" rows="3" value="{{ old('synopsis') }}"></textarea>
                        @error('synopsis')<span style="color: red">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                            Añadir película
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>