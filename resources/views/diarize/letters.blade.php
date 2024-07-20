@extends('layouts.app')

@section('content')
<div class="row">
 <div class="col-md-12">
    <div class="collapse" id="collapseExample">
      <a class="offset-11 btn btn-outline-danger mb-1" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        CLOSE
      </a>
      <div class="card card-body">
        <embed src="" style="height: 30rem;" 
        type="application/pdf" id="letter-view">
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">LETTER DIARIZE</div>

            <div class="card-body">
               
               <table class="table table-responsive-lg table-bordered" id="letter-table">
                    <thead>
                        <tr>
                            <th>Sl No.</th><th>Letter No.</th><th>Subject</th><th>Sender</th><th>Letter</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($letters as $value)
                            <tr>
                                <td>{{$i}}</td><td>{{$value['letter_no']}}</td><td>{{$value['subject']}}</td><td>{{$value['sender_name']}}</td><td><a class="file-btn" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" target="__blank" data-letter_path="{{config('constants.options.storage_url')}}{{$value['letter_path']}}"><i class="fas fa-file-pdf"></i></a>
                                 @if (session('role') == 2)
                                  &nbsp;
                                  <a href="{{route('action_lists',[encrypt($value['letter_id'])])}}" class="action-link"><i class="fas fa-pen"></i></a>
                                 @endif
                                 @if (session('role') == 3)
                                  &nbsp;
                                  <a href="{{route('actions',[encrypt($value['letter_id'])])}}" class="action-link"><i class="fas fa-pen"></i></a>
                                 @endif
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
               </table>
                
            </div>
        </div>
    </div>
</div>

@section('scripts')

<script>
  $(document).on('click','.file-btn',function(){
     $('#letter-view').attr('src',$(this).data('letter_path'));
  });
</script>

    <!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{asset('js/custom/common.js')}}"></script>
    <script>
       $(function () {
    $("#letter-table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [ "excel", "pdf", "print"]
    }).buttons().container().appendTo('#letter-table_wrapper .col-md-6:eq(0)');
    $(".buttons-html5").addClass("btn btn-outline-info ml-1");
    $(".buttons-html5").removeClass('btn-secondary');
    $(".buttons-print").addClass("btn btn-outline-info ml-1");
    $(".buttons-print").removeClass('btn-secondary');
  });

    </script>
@endsection
@endsection
