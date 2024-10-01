@extends('layouts.dashboard-app')

@push('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <style>
    .select2-container .select2-selection {
    width: 100%;
    height: 35px !important;
    line-height: 60px; /* Ini untuk menyesuaikan teks vertikal di tengah */
    }

    .select2-selection__arrow {
      margin-top: 5px;
    } 
  </style>
@endpush
  
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Pengunjung</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengunjung</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Pengunjung</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col col-md-3">
              <form action="{{ route('tampilkan.pengunjung') }}" style="height: 50px" method="GET">
                <div class="form-group m-0">
                  <select name="_acara" id="acara" class="form-control select2" onchange="this.form.submit()">
                    <option value="" {{ $acara_id == null ? 'selected' : '' }}>Pilih Acara</option>
                    @foreach ($acara as $item)
                        <option value="{{ $item->id }}" {{ $acara_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </form>
            </div>
            <div class="offset-md-8">
              <div class="col col-md-1">
                <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#modal-tambah-data"> <i class="fas fa-plus"></i> </button>
            </div>
          </div>
            
           <div class="modal fade" id="modal-tambah-data">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Tambah Pengunjung</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('pengunjung.store') }}" method="POST">
                    @csrf
                    <input type="text" style="display: none" value="{{ $acara_id }}" name="acara_id">
                    <div class="form-group">
                      <label for="nama">Nama:</label>
                      <input type="text" name="nama" id="nama" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat:</label>
                      <input type="text" name="alamat" id="alamat" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="notelp">No Telepon:</label>
                      <input type="number" name="notelp" id="notelp" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="uang">Uang:</label>
                      <input type="number" name="uang" id="uang" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="status">Status:</label>
                      <select name="status" id="status" class="form-control">
                        <option value="0">Belum Lunas</option>
                        <option value="1">Lunas</option>
                      </select>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
              </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
      

          </div>

          <table id="pengunjung_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>No Telepon</th>
                  <th>Uang</th>
                  <th>Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($pengunjung as $key => $item)
                  <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>{{ rupiah($item->uang) }}</td>
                    <td>{{ $item->status == 0 ? 'Belum Lunas' : 'Lunas' }}</td>
                    <td class="text-center">
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-data-{{ $item->id }}"><i class="fas fa-pencil-alt"></i></button>
                      <a href="{{ route('pengunjung.delete',['id'=>$item->id]) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    <div class="modal fade" id="modal-edit-data-{{ $item->id }}">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Pengunjung</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('pengunjung.update',['id'=>$item->id]) }}" method="POST">
                              @csrf
                              <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ $item->nama }}">
                              </div>
                              <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $item->alamat }}">
                              </div>
                              <div class="form-group">
                                <label for="notelp">No Telepon:</label>
                                <input type="number" name="notelp" id="notelp" class="form-control" value="{{ $item->notelp }}">
                              </div>
                              <div class="form-group">
                                <label for="uang">Uang:</label>
                                <input type="number" name="uang" id="uang" class="form-control" value="{{ $item->uang }}">
                              </div>
                              <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control">
                                  <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Belum Lunas</option>
                                  <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Lunas</option>
                                </select>
                              </div>
                              <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                            </form>
                        </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

                  </tr>                        
                  @endforeach
                </tbody>
              </table>            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@push('js')
    <!-- DataTables  & Plugins -->
<script src="{{ url('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ url('/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#pengunjung_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#pengunjung_table_wrapper .col-md-6:eq(0)');

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>
@endpush