@extends("layouts.global")

@section("title") Daftar Berita @endsection
@section("content")

<h1 class="p-0">Daftar Berita</h1>

@if(session('success'))
<div class="alert alert-success mt-3">
    {{session('success')}}
</div>
@endif

<div class="row mb-3">
    <div class="col-md-12 text-right">
        <a href="{{route('informations.create')}}" class="btn btn-primary">Tambah berita</a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="{{route('informations.index')}}">
            <div class="input-group mb-3">
                <input value="{{Request::get('keyword')}}" name="keyword" class="form-control col-md-10" type="text"
                    placeholder="Cari judul berita..." />
                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-primary btn-sm">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive mt-3">
            <table id="basic-datatables" class="table table-bordered">
                <thead>
                    <tr>
                        <th><b>#</b></th>
                        <th><b>Judul</b></th>
                        <th><b>Deskripsi</b></th>
                        <th><b>Tanggal</b></th>
                        <th><b>Gambar</b></th>
                        <th><b>Action</b></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($informations as $information)
                    <tr>
                        <td>{{$nomor++}}</td>
                        <td>{{$information->title}}</td>
                        <td>{!! $information->desc !!}</td>
                        <td>{{$information->date}}</td>
                        <td>
                            @if($information->image)
                            <img src="{{asset('storage/'.$information->image)}}" width="70px" />
                            @else
                            N/A
                            @endif
                        </td>


                        <td>
                            <a class="btn btn-info text-white btn-sm"
                                href="{{route('informations.edit', [$information->id])}}">Edit</a>


                            <form onsubmit="return confirm('Apa anda yakin untuk menghapus data ini?')" class="d-inline"
                                action="{{route('informations.destroy', [$information->id ])}}" method="POST">
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
                            {{$informations->appends(Request::all())->links()}}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
