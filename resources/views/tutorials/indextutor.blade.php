<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Makanan Khas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Menu Makanan Khas Jatim</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link " href="/menus">Menu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="/tutorials">Tutorial</a>
      </li>
    </ul>
                        <a href="/tutoradd" class="btn btn-md btn-outline-success mb-3">TAMBAH MENU</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                  <!-- <td class="text-center"> -->
                                <th scope="col">NAMA MAKANAN</th>
                                <th scope="col">TUTORIAL MEMASAK</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($tutorials as $tutorial)
                                <tr>
                                <td>{{ $tutorial->menu->namamakanan}}</td>
                                <td>{!!$tutorial->tutorialmemasak!!}</td>  
                                <!-- <td>{{ $tutorial->aksi}}</td> -->
                                <!-- <td class="text-center"></td>    
                                    <td>{{ $tutorial->namamakanan }}</td>
                                    <td>{!! $tutorial->tutorialmemasak !!}</td> -->
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('tutorials.destroy', $tutorial->id) }}" method="POST">
                                            <a href="{{ route('tutorials.show', $tutorial->id) }}" class="btn btn-sm btn-outline-dark">SHOW</a>
                                            <a href="{{ route('tutorials.edit', $tutorial->id) }}" class="btn btn-sm btn-outline-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Menu Makanan belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $tutorials->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>

</body>
</html>