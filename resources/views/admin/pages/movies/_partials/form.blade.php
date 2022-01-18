@include('admin.includes.alerts')
@csrf
    <div class="form-goup">
        <input type="text" class="form-control" name="name" placeholder="Nome " value="{{ $movie->name ?? old('name')}}">
    </div>
    <div class="form-goup">
        <input type="text" class="form-control" name="sinopse" placeholder="Sinopse " value="{{ $movie->sinopse ?? old('sinopse')}}">
    </div>
    <div class="form-goup">
        <input type="file" class="form-control" name="image" id="image" multiple>
    </div>

    <button type="submit" class="btn btn-outline-success" >Enviar</button>