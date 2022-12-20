@extends('include.layout')


@section('style')
<link rel="stylesheet" href="{{asset('richtext/src/richtext.min.css')}}">
<link rel="stylesheet" href="{{asset('jquery-toast-plugin-master/dist/jquery.toast.min.css')}}">
@endsection

@section('content')
  <div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="az-dashboard-one-title">
            <div>
              <h2 class="az-dashboard-title">Hi, welcome back!</h2>
              <!-- <p class="az-dashboard-text">Dont forget to scann the QR code to record your time</p> -->
            </div>

            <div class = "az-content-header-center" style="width: 50%; height: 80px;display: flex;justify-content: center;align-items: center;">
              <img src="{{asset('typing_indicator.gif')}}" style="width: 200px;height: 100px;display: none" id = "typing_indicator">
            </div>


            <div class="az-content-header-right">
              <div class="media">
                <div class="media-body">
                  <label>Date</label>
                  <h6 id = "date">AAA 00, 0000</h6>
                </div><!-- media-body -->
              </div><!-- media -->
              <div class="media">
                <div class="media-body">
                  <label>Time</label>
                  <h6 id = "time">00:00:00 00</h6>
                </div><!-- media-body -->
              </div><!-- media -->
              <!-- <a href="" class="btn btn-purple">Refresh</a> -->
            </div>
          </div><!-- az-dashboard-one-title -->

          <div class="az-dashboard-nav"> 
            @include('include.content_navbar')

            <nav class="nav">
              <a class="nav-link" href="#" id="button-save" ><i class="far fa-save"></i>Save</a>
              <a class="nav-link" href="#"><i class="fas fa-ellipsis-h"></i></a>
            </nav>
          </div>

       

      

          <div class="row row-sm mg-b-20 mg-lg-b-0">
            <div class="col-lg-12 col-xl-12">
              <div class="row row-sm">
                <div class="col-md-6 col-lg-12 mg-b-20 mg-md-b-0 mg-lg-b-20">
                  <div class="">


                    <!-- <div id="toolbar" class="dgxl-app">
                      <div>
                        <input type="file" id="csv-file" name="files-csv" class="custom-file-input" accept=".csv"><label for="csv-file">Browse…</label>
                      </div>
                      <div>
                        <button class="button" id="button-save">Save</button>
                      </div>
                    </div> -->
                    <div style="height: 20px;background: grey"></div>
                      <textarea id = "content" style="width: 100%;height: 560px;padding: 20px">{{$data}}</textarea>

                  </div><!-- card-dashboard-five -->
                </div><!-- col -->
              </div><!-- row -->
            </div><!-- col-lg-3 -->
          </div><!-- row -->

          <b><i>JSON data link</i></b>: <a href="{{route('vmix_data_source.get_source_text')}}?table=four_source_tbl" target="_blank">{{route('vmix_data_source.get_source_text')}}</a>
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
@endsection


@section("script")

<!-- <script src="https://code.datagridxl.com/datagridxl.js"></script> -->
<!-- Papa Parse (to import and parse CSV files) -->
<!-- <script src="/site_files/libs/papaparse/papaparse.min.js"></script> -->
<script type="text/javascript" src="{{asset('jquery-toast-plugin-master/dist/jquery.toast.min.js')}}"></script>
<script>

$("a#button-save").on('click', function(){
  $.ajax({
    url: "{{route('system.button.save_four')}}",
    type: "POST",
    data: {
      _token: generate_token(),
      data: $("textarea#content").val()
    },
    success: function(e){
      $.toast({
        heading: 'Success',
        text: "Document Saved",
        position: 'bottom-center',
        stack: false,
        hideAfter: 2000,
        icon: 'success'
      });
      conn.send(JSON.stringify({data: {tag: "four", message: $("textarea#content").val()} }));
    },
    error: function(e){
      // console.log(e);
    }
  });
});

var conn = new WebSocket('ws://172.16.10.38:8090');

conn.onopen = function(e) {
    // console.log("Connection established!");
};


conn.onmessage = function(e) {
  try{
    var message = JSON.parse(e.data).msg;
    var tag = message.tag;
    var data = message.message;
    if(tag ==  "four"){
      $("textarea#content").val(data)
    }

    if(tag ==  "four_typing"){
      $('img#typing_indicator').show();
    }



  }catch(err){
    // console.log(err);
  }
};
  
function generate_token(){
  return "{{csrf_token()}}";
}


$("textarea#content").on("keydown", function(){
  conn.send(JSON.stringify({data: {cell_position: null,tag: "four_typing"} }));
});


setInterval(function(){
  $('img#typing_indicator').hide();
},1500);


</script>
@endsection



