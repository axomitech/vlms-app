@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">LETTER ACTIONS</div>

            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                    <h5 class="text text-justify text-primary">Letter No: {{$letterNo}}</h5>
                    <h5 class="text text-justify text-primary">Letter Subject: {{$letterSubject}}</h5>
                    <h5 class="text text-justify text-primary">Sender: {{$senderName}}</h5>
                    <h5 class="text text-justify text-primary">Sender: {{$organization}}</h5>
                  </div>
                  <div class="col-md-6">
                    <button type="button" class="btn btn-default offset-5">FORWARD</button>&emsp;
                    <button type="button" class="btn btn-default">VIEW LETTER</button>
                  </div>
               </div>
               <br>
               <table class="table table-responsive-lg table-bordered" id="letter-table">
                    <thead>
                        <tr>
                            <th>Sl No.</th><th>Description</th><th>Priority</th><th>Registered Date</th><th>Note</th><th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($actions as $value)
                            <tr>
                                <td>{{$i}}</td><td>{{$value['action_description']}}</td><td>{{$value['priority_name']}}</td><td>{{\Carbon\Carbon::parse($value['action_date'])->format('d/m/Y')}}</td><td>{{$notes[$i-1]}}</td><td><a data-toggle="modal" data-target="#actionModal" href="#" data-letter="{{$value['letter_id']}}" data-subject="{{$value['action_description']}}" class="action-link" data-action="{{$value['action_id']}}"><i class="fas fa-pen"></i></a>&emsp;<a href="" class="note-link" data-action="{{$value['action_id']}}" data-toggle="modal" data-target="#noteModal" data-action_text="{{$value['action_description']}}"><i class="fas fa-eye"></i><a></td>
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
<!-- Modal -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="actionModalLabel">File Preview</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        </div>
        <div class="modal-body">
          <form id="note-form">
           <div class="row">
            <div class="col-md-12">
              <label>Add Note</label>
              <input type="hidden" name="letter_action" id="letter_action">
              <textarea class="form-control" name="note" rows="5"></textarea>
              <label class="text text-danger note"></label>
            </div>
           </div>
           <div class="form-group row">
            <button type="button" class="btn btn-primary save-btn" data-url="{{ route('store_note') }}" data-form="#note-form" data-message="That you want to direct a note to this action!" id="save-note-btn">SAVE</button>
          </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="noteModalLabel">File Preview</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table table-responsive-lg table-bordered">
                <thead>
                  <tr><th>Notes</th></tr>
                </thead>
                <tbody id="note-body">

                </tbody>
              </table>
            </div>
           </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@section('scripts')
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
    
  });

  $(document).on('click','.action-link',function(){
    $('.modal-title').text($(this).data('subject'));
    $('#letter_action').val($(this).data('action'));
  });

  $(document).on('click','.note-link',function(e){
      e.preventDefault();
      $('.modal-title').text($(this).data('action_text'));
      var action = $(this).data('action');
      $.get("{{route('action_notes')}}",{
        'action':action
      },function(j){
        var tr = "";
        for(var i = 1; i < j.length; i++){
          tr += "<tr><td>"+j[i].note+"</td></tr>";
        }
        $('#note-body').html(tr);
      });

  })
</script>
@endsection
@endsection
