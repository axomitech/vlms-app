@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">LETTER DIARIZE</div>

            <div class="card-body border">
               
                <div class="row">
                    <div class="col-md-7" style="border: 1px solid blue;">
                        <form id="letter-form">

                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Letter Details</a>
                                </li>
                                <li class="nav-item disabled">
                                  <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Sender Details</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="text text-center text-primary mt-3">Letter Details<hr></h5>
                                            <button type="button" class="btn btn-default btn-sm offset-10" data-toggle="modal" data-target="#fileModal" id="view-letter-btn">
                                                View Letter
                                              </button>
                                              <br>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">Letter Category<span class="text text-danger fw-bold">*</span></label>
                                            <select class="form-control" name="category" id="category">
                                                <option value="">Select Category</option>
                                                @foreach ($letterCategories as $value)
            
                                                <option value="{{$value['id']}}">{{$value['category_name']}}</option>
                                                    
                                                @endforeach
                                            </select>
                                            <label class="text text-danger category fw-bold"></label>
            
                                        </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-bold">Priority<span class="text text-danger fw-bold">*</span></label>
                                                <select class="form-control" name="priority" id="priority">
                                                    <option value="">Select Priority</option>
                                                    @foreach ($priorities as $value)
                
                                                    <option value="{{$value['id']}}">{{$value['priority_name']}}</option>
                                                        
                                                    @endforeach
                                                </select>
                                                <label class="text text-danger priority fw-bold"></label>
                
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-bold">Letter<span class="text text-danger fw-bold">*</span></label>
                                                <input type="file" name="letter" id="letter" class="form-control">
                                                <label class="text text-danger letter fw-bold"></label>
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">Letter No.<span class="text text-danger fw-bold">*</span></label>
                                                <input type="text" name="letter_no" id="letter_no" class="form-control">
                                                <label class="text text-danger letter_no fw-bold"></label>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">Letter Date<span class="text text-danger fw-bold">*</span></label>
                                                <input type="date" name="letter_date" id="letter_date" class="form-control">
                                                <label class="text text-danger letter_date fw-bold"></label>
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Received Date<span class="text text-danger fw-bold">*</span></label>
                                            <input type="date" name="received_date" id="received_date" class="form-control">
                                            <label class="text text-danger received_date fw-bold"></label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Diary Date<span class="text text-danger fw-bold">*</span></label>
                                            <input type="date" name="diary_date" id="diary_date" class="form-control">
                                            <label class="text text-danger diary_date fw-bold"></label>
                                        </div>    
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Subject<span class="text text-danger fw-bold">*</span></label>
                                            <textarea class="form-control" name="subject" id="subject"></textarea>
                                            <label class="text text-danger subject fw-bold"></label>
                                        </div>    
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-warning" data-target="#custom-tabs-one-home" id="btn-next">NEXT</button>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="text text-center text-primary mt-3">Sender Details<hr></h5>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Sender Name<span class="text text-danger fw-bold">*</span></label>
                                            <input type="text" name="sender_name" id="sender_name" class="form-control">
                                            <label class="text text-danger sender_name fw-bold"></label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Designation<span class="text text-danger fw-bold">*</span></label>
                                            <input type="text" name="sender_designation" id="sender_designation" class="form-control">
                                            <label class="text text-danger sender_designation fw-bold"></label>
                                        </div>    
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Sender Mobile<span class="text text-danger fw-bold">*</span></label>
                                            <input type="text" name="sender_mobile" id="sender_mobile" class="form-control">
                                            <label class="text text-danger sender_mobile fw-bold"></label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Sender Email<span class="text text-danger fw-bold">*</span></label>
                                            <input type="text" name="sender_email" id="sender_email" class="form-control">
                                            <label class="text text-danger sender_email fw-bold"></label>
                                        </div>    
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Organization<span class="text text-danger fw-bold">*</span></label>
                                            <textarea class="form-control" name="organization" id="organization"></textarea>
                                            <label class="text text-danger organization fw-bold"></label>
                                        </div>    
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Address<span class="text text-danger fw-bold">*</span></label>
                                            <textarea class="form-control" name="address" id=address"></textarea>
                                            <label class="text text-danger address fw-bold"></label>
                                        </div>    
                                    </div>
                                    <div class="form-group row">
                                       <div class="col-md-6">
                                        <button type="button" class="btn btn-warning" data-target="#custom-tabs-one-home" id="btn-prev">PREVIOUS</button>
                                        &nbsp;
                                        <button type="button" class="btn btn-primary save-btn" data-url="{{ route('store_letter') }}" data-form="#letter-form" data-message="That you want to diarize this letter!" id="save-letter-btn">DIARIZE</button>
                                        </div>
                                    </div>
                                </div>
        
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5" style="border: 1px solid blue;">
                        <div class="fileContent"><h5 class="text text-warning mt-5 offset-2">Please upload the letter for viewing.</h5></div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="fileModalLabel">File Preview</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        </div>
        <div class="modal-body">
          <div class="fileContent"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@section('scripts')
    <script src="{{asset('js/custom/common.js')}}"></script>
    <script>
        $(document).on('click','#btn-next',function(e){
            var next = $('#custom-tabs-one-tab li.active').next()
            next.length?
            next.find('a').click():
            $('#custom-tabs-one-tab li a')[1].click();
        });

        $(document).on('click','#btn-prev',function(e){
            var next = $('#custom-tabs-one-tab li.active').next()
            next.length?
            next.find('a').click():
            $('#custom-tabs-one-tab li a')[0].click();
        });

        $(document).ready(function() {
            const $pdfUploadInput = $('#letter');
            const $pdfViewer = $('.fileContent');
            const $displayButton = $('#display-file-btn');
            const $removeBtn = $('#remove-btn');

            $pdfUploadInput.on('change', function() {
                const file = this.files[0];
                if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const pdfData = e.target.result;
                    const $pdfObject = $('<object></object>')
                    .attr('data', pdfData)
                    .attr('type', 'application/pdf')
                    .attr('width', '100%')
                    .attr('height', '500px');
                    $pdfViewer.empty().append($pdfObject);
                };
                reader.readAsDataURL(file);
                $removeBtn.show();
                } else {
                $pdfViewer.text('No file selected');
                }
            });
            $(document).on('click','#view-letter-btn',function(){
                if($('#letter').val() == ""){
                    
                $('.fileContent').html('<h5 class="text text-danger">No file selected</h5>');

                }

            });
        });

    </script>
@endsection
@endsection
