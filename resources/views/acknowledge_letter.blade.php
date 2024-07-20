@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        Ackwoledgement Letter Generation
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn" style="background-color: #24a0ed;color: white;" data-target="#custom-tabs-one-home" id="btn-save">Save</button>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn" style="background-color: #173f5f;color: white;" id="btn-pdf"><a href="{{ route('pdf_genarator', ['id' => $letter_id]) }}">Download PDF</a></button>
                    </div>
                    <div class="col-md-4">
                        <label class="text text-dark">Last Saved: <span class='saved_span'>{{ $last_saved}}</span></label>
                    </div>
                </div>
            </div>

            <div class="card-body">
               
                <div class="row">
                    <div class="col-md-8 ">
                        <form id="letter-form">
                            @csrf <!-- CSRF token for Laravel -->
                            <!-- hdhadh -->
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea class="form-control" name="ack_letter_text" id="ack_letter_text">{{ $default_ack }}</textarea>
                                    <label class="text text-danger subject fw-bold"></label>
                                </div>
                                <div class="col-md-12">
                                <input type="hidden" class="form-control" name="letter_id" id="letter_id" aria-describedby="emailHelp" value="{{ $letter_id}}">
                                </div>
                            </div>
                            <!-- hdhadh -->
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><u>Received Letter Details</u></h5>
                                        <p class="card-text">Diarize No.: {{ $diarize_no}}</p>
                                        <p class="card-text">Letter No.:  {{ $letter_no}}</p>
                                        <p class="card-text">Letter Subject: {{ $letter_subject}}</p>
                                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#fileModal" id="view_letter">View Letter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
          <h5 class="modal-title" id="fileModalLabel">Letter</h5>
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
    <script type="text/javascript" src="{{ asset('tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#ack_letter_text',  // change this value according to the HTML
            plugins: 'fullscreen code',
            toolbar: 'undo redo | fontfamily fontsize | bold italic underline| fullscreen print | alignleft aligncenter alignright alignjustify | outdent indent | code',
            height: 600,
            font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
            });
  </script>
  <!-- <script>{{ $default_ack }}
    // Add event listener to listen for changes in the text field
    document.getElementById('myTextField').addEventListener('input', function(event) {
        console.log('Text field value changed:', event.target.value);
        // You can perform any actions based on the changed value here
    });
</script> -->
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

<script>
        $(document).ready(function() {


            $('#btn-save').click(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Serialize form data
                // tinymce.activeEditor.setContent("<p>Hello world!</p>");
                var letter_id = $('#letter_id').val();
                var ack_letter_text = tinymce.get("ack_letter_text").getContent();
                // var formData = $('#letter-form').serialize();
                var formData = {
                    letter_id: letter_id,
                    ack_letter_text: ack_letter_text,
                    _token: '{{ csrf_token() }}' // Include CSRF token if using Laravel
                };
                // alert(formData);
                // Ajax request
                $.ajax({
                    type: 'POST',
                    url: '{{ route('submit.ackLetter') }}', // Replace with your server-side script URL
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Handle success response
                        // var data = JSON.parse(response);
                        alert("Letter saved successfully!");
                        $('.saved_span').text(response.last_saved);
                        // Optionally, display a success message or redirect
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error:', error);
                    }
                });
            });
            $('#btn-pdf1').click(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Serialize form data
                // tinymce.activeEditor.setContent("<p>Hello world!</p>");
                var letter_id = $('#letter_id').val();
                var ack_letter_text = tinymce.get("ack_letter_text").getContent();
                // var formData = $('#letter-form').serialize();
                var formData = {
                    letter_id: letter_id,
                    ack_letter_text: ack_letter_text,
                    _token: '{{ csrf_token() }}' // Include CSRF token if using Laravel
                };
                alert(formData);
                // Ajax request
                $.ajax({
                    type: 'POST',
                    url: '{{ route('dashboard') }}', // Replace with your server-side script URL
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Handle success response
                        // var data = JSON.parse(response);
                        alert("Letter PDF successfully!");
                        // $('.saved_span').text(response.last_saved);
                        // Optionally, display a success message or redirect
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>

@endsection
@endsection