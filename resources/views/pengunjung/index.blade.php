@extends('layouts.dashboard-app')

@push('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ url('/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ url('/plugins/toastr/toastr.min.css') }}">
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
            <div class="offset-md-10 col-md-2">
              @if ($acara_id != "" && $acara_id != 0)
                  <div class="d-flex justify-content-end mb-4">
                      <button type="button" title="Tambah Data" class="btn btn-primary mr-2" data-toggle="modal" data-target="#modal-tambah-data">
                          <i class="fas fa-plus"></i>
                      </button>
                      <button type="button" title="Export Excell" onclick="window.location.href='{{ route('export.pengunjung',['acara_id'=>$acara_id]) }}'" id="exportButton" class="btn btn-success mr-2">
                        <i class="fas fa-file-excel"></i>
                      </button>
                      <button type="button" onclick="window.location.href=''" id="exportButton" class="btn btn-secondary">
                        <i class="fas fa-print"></i>
                      </button>
                  </div>
              @endif
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
                  <form action="" method="POST" id="form-tambah">
                    @csrf
                    <div class="form-group">
                      <label for="nama">Nama:</label>
                      <input type="text" name="nama" id="nama" class="form-control">
                      <div class="text-danger" id="error-text-nama"></div>
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat:</label>
                      <input type="text" name="alamat" id="alamat" class="form-control">
                      <div class="text-danger" id="error-text-alamat"></div>
                    </div>
                    <div class="form-group">
                      <label for="notelp">No Telepon:</label>
                      <input type="tel" name="notelp" id="notelp" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="uang">Uang:</label>
                      <input type="number" name="uang" id="uang" class="form-control">
                      <div class="text-danger" id="error-text-uang"></div>
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
        
           {{-- @livewire('pengunjung',['acara_id'=>$acara_id]) --}}
          
           {{-- @livewire('TabelPengunjung',['acara_id'=>$acara_id]) --}}
           <table id="pengunjung_table" class="table table-bordered table-striped" style="width: 100%">
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
              <tr></tr>
            </tbody>    
          </table>            

          </div>


    

          <!-- Modal Konfirmasi Hapus -->
        <div class="modal fade" id="modal-delete-confirm" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="deleteConfirmLabel">Konfirmasi Hapus</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      Apakah Anda yakin ingin menghapus <strong id="data-name"></strong> ?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="confirm-delete">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  </div>
              </div>
          </div>
        </div>

          
          <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Pengunjung</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body text-left">
                  <form method="POST" id="form-edit">
                    @csrf
                    @method('PUT')
                    <input class="d-none" id="edit-acara-id" >
                    <input class="d-none" id="edit-id" >
                    <div class="form-group">
                      <label for="nama">Nama:</label>
                      <input type="text" name="nama" id="edit-nama" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="alamat">Alamat:</label>
                      <input type="text" name="alamat" id="edit-alamat" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="notelp">No Telepon:</label>
                      <input type="text" name="notelp" id="edit-notelp" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="uang">Uang:</label>
                      <input type="number" name="uang" id="edit-uang" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="status">Status:</label>
                      <select name="status" id="edit-status" class="form-control">
                        <option value="0">Belum Lunas</option>
                        <option value="1">Lunas</option>
                      </select>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" >Save changes</button>
                    </div>
                    </form>
                </div>
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
<script src="{{ url('/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ url('/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ url('/plugins/toastr/toastr.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ url('/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Page specific script -->
<script>

  $(function () {

        let token = document.querySelector('meta[name="api-token"]').getAttribute('content');

        let table = $('#pengunjung_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('pengunjung.index.json',['id'=>$acara_id == null ? 0 : $acara_id]) }}",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            },
            error: function (xhr, error, thrown) {
                console.error("AJAX Error:", xhr.responseText);
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama', name: 'nama'},
            {data: 'alamat', name: 'alamat'},
            {data: 'no_telp', name: 'no_telp'},
            {data: 'uang', name: 'uang'},
            {
                data: 'status', name: 'status',
                render: function (data, type, row) {
                    if (data == '1') {
                        return 'Lunas';
                    } else if (data == '0') {
                        return 'Belum Lunas';
                    } else {
                        return '';
                    }
                }
            },
            {
                data: 'action', name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    var btn_edit = `<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit" data-id="${row.id}" id="btn-edit"><i class="fas fa-pencil-alt"></i></button>`;
                    var btn_destroy = `<button class="btn btn-danger ml-1" id="btn-delete" data-id="${row.id}" data-nama="${row.nama}"><i class="fas fa-trash-alt"></i></button>`;

                    return btn_edit + btn_destroy;
                }
            }
        ],
        rowId: 'id'
    });
     
        $('#pengunjung_table').on('draw.dt', function() {
    
        const editButtons = document.querySelectorAll('#btn-edit');
        const deleteButtons = document.querySelectorAll('#btn-delete');
        
        editButtons.forEach(function(button, index) {
            $(button).on('click', function() {
              let id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('pengunjung.edit',['id'=>'__id__']) }}".replace('__id__',id),
                type: 'GET',
                headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
                },
                success: function(data) {
    
                    $('#edit-acara-id').val({{ $acara_id }});
                    $('#edit-id').val(data.id);
                    $('#edit-nama').val(data.nama);
                    $('#edit-alamat').val(data.alamat);
                    $('#edit-notelp').val(data.no_telp);
                    $('#edit-uang').val(data.uang);
                    $('#edit-status').val(data.status);
                }
            });
            });
        });
    
        deleteButtons.forEach(function(button,index){
          $(button).on('click', function(){
            let id = $(this).data('id'); // Ambil ID dari data-id pada tombol
            let nama = $(this).data('nama'); // Ambil nama dari tombol hapus (pastikan Anda menyertakan data-nama di tombol)

            // Simpan ID ke dalam tombol konfirmasi di modal
            $('#data-name').text(nama); 
            $('#confirm-delete').data('id', id);

            // Tampilkan modal konfirmasi
            $('#modal-delete-confirm').modal('show');

          });
        });
    
        });
    

        
        $('#confirm-delete').on('click', function() {
          let id = $(this).data('id'); // Ambil ID dari tombol konfirmasi

          $.ajax({
              url: "{{ route('pengunjung.delete.json',['id'=>'__id__']) }}".replace('__id__',id),
              type: "DELETE",
              headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
              },
              success: function(data){ 
                $('#modal-delete-confirm').modal('hide');
                $('#pengunjung_table').DataTable().row('id').remove().draw();
                toastr.success(`Berhasil menghapus ${data.nama} !.`);
              },
              error: function(xhr){
                alert('Terjadi kesalahan: ' + xhr.responseText);
              }
            })

        })
        
    
    
        $('#form-tambah').on('submit',function(e){
          e.preventDefault();
    
          $.ajax({
        url: "{{ route('pengunjung.store.json') }}",
        type: 'POST',
        headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            },
        data: {
            _token: "{{ csrf_token() }}",
            nama: $('#nama').val(),
            alamat: $('#alamat').val(),
            notelp: $('#notelp').val(),
            uang: $('#uang').val(),
            status: $('#status').val(),
            acara_id: {{ $acara_id ?? 0 }}
        },
        success: function(response) {
            $('#pengunjung_table').DataTable().ajax.reload();
            $('#form-tambah')[0].reset();
        },
        error: function(xhr,status,error) {
            if (xhr.status == 422) {
              const errors = xhr.responseJSON.errors;
  
              $('#error-text-nama').text(errors.nama[0]);
              $('#error-text-alamat').text(errors.alamat[0]);
              $('#error-text-uang').text(errors.uang[0]);              
            }else{
              alert('Terjadi kesalahan saat menyimpan data : '+error);
            }

        }
        });

        
      });
      
      $('#modal-tambah-data').on('hidden.bs.modal', function () {
          $(this).find('input').val('');
          $('.text-danger').text('');   
      });

      $('#modal-edit').on('hidden.bs.modal', function () {
          $(this).find('input').val('');
          $('.text-danger').text('');   
      });
    
       
        $('#form-edit').on('submit',function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('pengunjung.update.json') }}",
            type: 'PUT',
            headers: {
                "Authorization": "Bearer " + token,
                "Accept": "application/json"
            },
            data: {
              _token: "{{ csrf_token() }}",
              id: $('#edit-id').val(),
              acara_id: $('#edit-acara-id').val(),
              nama: $('#edit-nama').val(),
              alamat: $('#edit-alamat').val(),
              notelp: $('#edit-notelp').val(),
              uang: $('#edit-uang').val(),
              status: $('#edit-status').val()
            },
            success: function(response){
              $('#pengunjung_table').DataTable().ajax.reload();
              $('#form-edit')[0].reset();
              $('#modal-edit').modal('hide');
            },
            error: function(xhr) {
            alert('Terjadi kesalahan: ' + xhr.responseText);
            }
        });
        });

    //Initialize Select2 Elements
    $(document).ready(function() {
    $('.select2').select2();
    }); 

  });
</script>
@endpush