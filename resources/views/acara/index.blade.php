@extends('layouts.dashboard-app')

@push('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ url('/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ url('/plugins/toastr/toastr.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Acara</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Acara</li>
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
          <h3 class="card-title">Daftar Acara</h3>
        </div>
        <div class="card-body">

            <div class="offset-md-11">

                <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#modal-tambah-data"> <i class="fas fa-plus"></i> </button>
                 
                <div class="modal fade" id="modal-tambah-data">
                 <div class="modal-dialog">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h4 class="modal-title">Tambah Acara</h4>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                       <form action="" method="POST" id="form-tambah">
                         @csrf
                         <div class="form-group">
                           <label for="nama">Nama Acara:</label>
                           <input type="text" id="nama" class="form-control">
                           <div class="text-danger" id="error-nama"></div>
                         </div>
                         <div class="form-group">
                           <label for="tanggal">Tanggal:</label>
                           <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" id="tanggal" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                            </div>
                          </div>
                          <div class="text-danger" id="error-tanggal"></div>
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
     

            <table id="acara_table" class="table table-bordered table-striped" style="width: 100%">
                <thead>
                    <th>No.</th>
                    <th>Nama Acara</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </thead>
                <tbody>
                  <tr></tr>
                </tbody>
            </table>


            <div class="modal fade" id="modal-edit">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Acara</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="POST" id="form-edit">
                      @csrf
                      @method('PUT')
                      <input type="text" class="d-none" id="edit-id">
                      <div class="form-group">
                        <label for="nama">Nama Acara:</label>
                        <input type="text" id="edit-nama" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <div class="input-group date" id="reservationdate_2" data-target-input="nearest">
                          <input type="text" id="edit-tanggal" class="form-control datetimepicker-input" data-target="#reservationdate_2">
                          <div class="input-group-append" data-target="#reservationdate_2" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
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
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button type="button" class="btn btn-danger" id="confirm-delete">Hapus</button>
                  </div>
              </div>
          </div>
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
<script src="{{ url('/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Page specific script -->
<!-- InputMask -->
<script src="{{ url('/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ url('/plugins/toastr/toastr.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ url('/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>

    $('#modal-tambah-data').on('hidden.bs.modal', function () {
        $(this).find('input').val('');
        $('.text-danger').text('');   
    });

    $('#modal-edit').on('hidden.bs.modal', function () {
        $(this).find('input').val('');
        $('.text-danger').text('');   
    });

    let table = $('#acara_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('acara.index.json') }}",
      columns: [
        {data: "DT_RowIndex",name: "DT_RowIndex"},
        {data: "nama",name: "nama"},
        {data: "tanggal",name: "tanggal"},
        {data: 'action', name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    var btn_edit = `<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit" data-id="${row.id}" id="btn-edit"><i class="fas fa-pencil-alt"></i></button>`;
                    var btn_destroy = `<button class="btn btn-danger ml-1" id="btn-delete" data-id="${row.id}" data-nama="${row.nama}"><i class="fas fa-trash-alt"></i></button>`;
    
                    return btn_edit + btn_destroy;
                }
            }
      ]
    })

    $('#acara_table').on('draw.dt', function() {
    
    const editButtons = document.querySelectorAll('#btn-edit');
    const deleteButtons = document.querySelectorAll('#btn-delete');
    
    editButtons.forEach(function(button, index) {

        // Reset Date Range Picker to avoid multiple instances
        if ($('#edit-tanggal').data('daterangepicker')) {
            $('#edit-tanggal').data('daterangepicker').remove(); // Destroy instance if exists
        }

        $(button).on('click', function() {
          let id = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('acara.edit',['id'=>'__id__']) }}".replace('__id__',id),
            type: 'GET',
            success: function(data) {
                 // Parsing the date from the response (assuming data.tanggal is in 'YYYY-MM-DD' format)
                let originalDate = new Date(data.tanggal);

                // Extract day, month, and year
                let day = originalDate.getDate();
                let month = originalDate.getMonth() + 1; // Months are 0-based
                let year = originalDate.getFullYear(); // Get last two digits of the year

                // Add leading zeros to day and month if necessary
                day = day < 10 ? '0' + day : day;
                month = month < 10 ? '0' + month : month;

                // Format date as 'dd/mm/yy'
                let formattedDate = `${day}/${month}/${year}`;

                // Set the values to the form inputs

                $('#edit-id').val(data.id);
                $('#edit-nama').val(data.nama);
                $('#edit-tanggal').val(formattedDate);
 
                // Destroy existing datetimepicker instance if it exists
                if ($.fn.datetimepicker) {
                    $('#reservationdate_2').datetimepicker('destroy'); // Hancurkan instance yang ada
                }

                // Inisialisasi datetimepicker setelah mengatur tanggal
                $('#reservationdate_2').datetimepicker({
                    format: 'DD/MM/YYYY'
                });
            }
        });
        });
    });

    deleteButtons.forEach(function(button,index){
      $(button).on('click', function(){
        let id = $(this).data('id'); // Ambil ID dari data-id pada tombol
        let nama = $(this).data('nama'); // Ambil Nama dari data-nama pada tombol
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
              url: "{{ route('acara.delete.json',['id'=>'__id__']) }}".replace('__id__',id),
              type: "DELETE",
              success: function(data){ 
                $('#modal-delete-confirm').modal('hide');
                $('#acara_table').DataTable().row('id').remove().draw();
                toastr.success(`Berhasil menghapus ${data.nama} !.`);
              },
              error: function(xhr){
                alert('Terjadi kesalahan: ' + xhr.responseText);
              }
            })

        })

        $('#form-edit').on('submit',function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('acara.update.json') }}",
            type: 'PUT',
            data: {
              _token: "{{ csrf_token() }}",
              id: $('#edit-id').val(),
              nama: $('#edit-nama').val(),
              tanggal: $('#edit-tanggal').val(),
            },
            success: function(response){
              $('#acara_table').DataTable().ajax.reload();
              $('#form-edit')[0].reset();
              $('#modal-edit').modal('hide');
            },
            error: function(xhr) {
            alert('Terjadi kesalahan: ' + xhr.responseText);
            }
        });
        });


        $('#form-tambah').on('submit',function(e){
          e.preventDefault();
          $.ajax({
            url: "{{ route('acara.store.json') }}",
            type: "POST",
            data: {
              _token : "{{ csrf_token() }}",
              nama: $('#nama').val(),
              tanggal: $('#tanggal').val()
            },
            success: function(response){
              $('#acara_table').DataTable().ajax.reload();
              $('#form-tambah')[0].reset();
              $('#modal-tambah-data').modal('hide');
            },
            error: function(xhr,status,error){
              if(xhr.status==422){
                let errors = xhr.responseJSON.errors;
  
                $('#error-nama').text(errors.nama[0]);
                $('#error-tanggal').text(errors.tanggal[0]);
              } else {
                alert('terjadi kesalahan saat menyimpan data : ' + errors);
              }
            }
          })
        });

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    
   //Date picker
   $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date picker
   $('#reservationdate_2').datetimepicker({
        format: 'L'
    });
</script>
@endpush