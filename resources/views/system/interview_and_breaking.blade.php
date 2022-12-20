@extends('include.layout')


@section('style')
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

            @include('include.excel_tab')

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

                    <div id="grid" style="height: 600px"></div>



                  </div><!-- card-dashboard-five -->
                </div><!-- col -->
              </div><!-- row -->
            </div><!-- col-lg-3 -->
          </div><!-- row -->

          <b><i>JSON data link</i></b>: <a href="{{route('vmix_data_source.get_source_excel')}}?table=interview_and_breaking_source_tbl" target="_blank">{{route('vmix_data_source.get_source_excel')}}</a>
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
  $(document).ready(function(){

    var grid;
    $.ajax({
      url: "{{route('system.interview_and_breaking_source_tbl')}}",
      async: false,
      success: function(e){
        var data_cell = e.source;
        console.log(data_cell);
        grid = new DataGridXL("grid", {
            data: data_cell,
          });

        arrange_cell();
      },
      error: function(e){
        console.log(e);
      }
    });

    var conn = new WebSocket('ws://172.16.10.38:8090');

    conn.onopen = function(e) {
        // console.log("Connection established!");
    };


    // var eventHandler = function(e){
    //   conn.send(JSON.stringify({data: {cell_position: e,tag: "exl_1"} }));
    // };

    // grid.events.on("cellvaluechange", eventHandler);



    conn.onmessage = function(e) {
      // console.log("Hello");
      // console.log(e.data);
      try{
        var data = JSON.parse(e.data);
        var cell_change = data.msg.cell_position;
        // console.log(cell_change);
        var tag = data.msg.tag;


        if(tag == "interview_and_breaking"){
          grid.setData(cell_change);
        }
		
		
		arrange_cell();
        if(tag == "interview_and_breaking_typing"){
          $('img#typing_indicator').show();
        }



        grid.events.off("cellvaluechange",eventHandler);
        on();
      }catch(e){
        // console.log(e);
      }

    };


    function on(){
      setTimeout(function(){
          grid.events.on("cellvaluechange",eventHandler);
      },500);
    }

    // grid.events.on("cellcursorpositionchange", function(e){
    //   cell_position = e.cellCursorPosition;
    // });

    $("a#button-save").on('click', function(){
      var data = grid.getData();
      $.ajax({
        url: "{{route('system.button.save_interview_and_breaking')}}",
        type: "POST",
        data: {
          _token: generate_token(),
          data: data
        },
        success: function(e){
          // console.log(e);
          conn.send(JSON.stringify({data: {cell_position: data,tag: "interview_and_breaking"} }));
          $.toast({
                heading: 'Success',
                text: "Document Saved",
                position: 'bottom-center',
                stack: false,
                hideAfter: 2000,
                icon: 'success'
            });
        },
        error: function(e){
          // console.log(e);
        }
      });

    });
      
      
    function generate_token(){
      return "{{csrf_token()}}";
    }



    $("div#grid").on("keydown", function(){
      conn.send(JSON.stringify({data: {cell_position: null,tag: "interview_and_breaking_typing"} }));
    });


    setInterval(function(){
      $('img#typing_indicator').hide();
    },1500);
	
	
	function arrange_cell(){
		for(var i =  1; i <= 10; i++){
          grid.resizeColsToFit([0,i]);
        }
	}
  });
</script>
@endsection



