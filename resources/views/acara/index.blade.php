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
                       <form action="{{ route('acara.store') }}" method="POST">
                         @csrf
                         <div class="form-group">
                           <label for="nama">Nama Acara:</label>
                           <input type="text" name="nama" id="nama" class="form-control">
                         </div>
                         <div class="form-group">
                           <label for="tanggal">Tanggal:</label>
                           <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" name="tanggal" id="tanggal" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </div>
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
           
     
               </div>
     

            <table id="acara_table" class="table table-bordered table-striped">
                <thead>
                    <th>No.</th>
                    <th>Nama Acara</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($acara as $key => $item)
                    <tr>
                      <td>{{ $key+1 }}</td>
                    <td>{{ $item->nama }}</td>
                    @php
                    $date_convert = strtotime($item->tanggal);

                    $converted_date = date('d/m/Y',$date_convert);
                    $common_date = dateid('l,j F Y',$date_convert);
                    @endphp
                    <td>{{ $common_date }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-data-{{ $item->id }}"><i class="fas fa-pencil-alt"></i></button>
                        <a href="{{ route('acara.delete',['id'=>$item->id]) }}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    </td>   
                    
                    <div class="modal fade" id="modal-edit-data-{{ $item->id }}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Edit Acara</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{ route('acara.update',['id'=>$item->id]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                  <label for="nama">Nama Acara:</label>
                                  <input type="text" name="nama" id="nama" class="form-control" value="{{ $item->nama }}">
                                </div>
                                <div class="form-group">

                                 

                                  <label for="tanggal">Tanggal:</label>
                                  <div class="input-group date" id="reservationdate_{{ $item->id }}" data-target-input="nearest">
                                    <input type="text" name="tanggal" id="tanggal" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ $converted_date }}">
                                    <div class="input-group-append" data-target="#reservationdate_{{ $item->id }}" data-toggle="datetimepicker">
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
<!-- Page specific script -->
<!-- InputMask -->
<script src="{{ url('/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ url('/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<script>

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    
   //Date picker
   $('#reservationdate').datetimepicker({
        format: 'L'
    });

   //Date picker
  //  $('#reservationdate2').datetimepicker({
  //       format: 'L'
  //   });

    $(document).ready(function() {
      $('[id^=reservationdate_]').each(function() {
        $(this).datetimepicker({
          format: 'L', // konfigurasi yang diperlukan
        });
      });
    });


  $(function () {
    $("#acara_table").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false
    });
  });
</script>
@endpush