@extends("layouts.global")

@section("title") Daftar Pengguna @endsection
@section("content")

   <h1 class="p-0">Daftar Pengguna</h1>

   @if(session('success'))
    <div class="alert alert-success mt-3">
        {{session('success')}}
    </div>
    @endif

<div class="row mb-3">
    <div class="col-md-12 text-right">
        <a href="{{route('users.create')}}" class="btn btn-primary">Tambah pengguna</a>
   </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive mt-3">
        <table id="basic-datatables" class="table table-bordered">
            <thead>
                <tr>
                    <th><b>#</b></th>
                    <th><b>Email</b></th>
                    <th><b>Nama</b></th>
                    <th><b>Role</b></th>
                    <th><b>No Hp</b></th>
                    <th><b>Status</b></th>
                    <th><b>Action</b></th>
                </tr>
            </thead>
            <tbody>
        
                @foreach($users as $user)
                <tr>
                    <td>{{$nomor++}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>
        
                    <td>
                        @foreach (json_decode($user->roles) as $l)
                        
                        &middot; {{$l}} 
                        
                        <br>
                        @endforeach
                    </td>
                    <td>{{$user->phone}}</td>
                    <td>
                        @if($user->status == "ACTIVE")
                        <span class="badge badge-success">
                            {{$user->status}}
                        </span>
                        @else
                        <span class="badge badge-danger">
                            {{$user->status}}
                        </span>
                        @endif
                    </td>

                    
                    <td>
                        <a class="btn btn-info text-white btn-sm" href="{{route('users.edit', [$user->id])}}">Edit</a>
        
                        <a href="{{route('users.show', [$user->id])}}" class="btn btn-primary btn-sm">Detail</a>
                        
                        <form onsubmit="return confirm('Apa anda yakin untuk menghapus data ini?')" class="d-inline"
                            action="{{route('users.destroy', [$user->id ])}}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
        
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan=10>
                        {{$users->appends(Request::all())->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    </div>
  </div>
@endsection