<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Customers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
		
	<br/>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('customers.create') }}" class="btn btn-md btn-success mb-3">TAMBAH</a>

                        <form method="GET">
                            <div class="input-group mb-3">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request()->get('search') }}" 
                                class="form-control" 
                                placeholder="Search..." 
                                aria-label="Search" 
                                aria-describedby="button-addon2">
                            <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
                            </div>
                        </form>

                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Cutomer Name</th>
                                <th scope="col">Phome</th>
                                <th scope="col">City</th>
                                <th scope="col">State</th>
                                <th scope="col">Postal Code</th>
                                <th scope="col">Country</th>
                                <th scope="col"><center>Action</center></th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($customers as $Customers)
                                <tr>
                                    <td>{{ $Customers->id }}</td>
                                    <td>{{ $Customers->customername }}</td>
                                    <td>{{ $Customers->phone }}</td>
                                    <td>{{ $Customers->city }}</td>
                                    <td>{{ $Customers->state }}</td>
                                    <td>{{ $Customers->postalcode }}</td>
                                    <td>{{ $Customers->country }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('customers.destroy', $Customers->id) }}" method="POST">
                                            <a href="{{ route('customers.show', $Customers->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                            <a href="{{ route('customers.edit', $Customers->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data not Exist.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          <center>{{ $customers->links() }}</center>
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