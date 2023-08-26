<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Makanan Khas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">GAMBAR</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>

                             <div class="form-group">
                                <label class="font-weight-bold">NAMA MAKANAN</label>
                                <input type="text" class="form-control @error('namamakanan') is-invalid @enderror" name="namamakanan" value="{{ old('namamakanan', $menu->namamakanan) }}" placeholder="Masukkan Nama Makanan">
                            
                                <!-- error message untuk title -->
                                @error('namamakanan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">KHAS DAERAH</label>
                                <textarea class="form-control @error('khasdaerah') is-invalid @enderror" name="khasdaerah" rows="5" placeholder="Masukkan Tutorial Memasak">{{ old('khasdaerah', $menu->khasdaerah) }}</textarea>
                            
                                <!-- error message untuk content -->
                                @error('khasdaerah')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-outline-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-outline-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'khasdaerah' );
</script>
</body>
</html>