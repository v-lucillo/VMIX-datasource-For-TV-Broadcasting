    <script src="{{asset('admin/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/lib/ionicons/ionicons.js')}}"></script>
    <script src="{{asset('admin/lib/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{asset('admin/lib/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('admin/lib/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin/lib/peity/jquery.peity.min.js')}}"></script>

    <!-- Datatables -->
    <script src="{{asset('admin/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{asset('admin/js/azia.js')}}"></script>
    <script src="{{asset('admin/js/chart.flot.sampledata.js')}}"></script>
    <script src="{{asset('admin/js/dashboard.sampledata.js')}}"></script>
    <script type="text/javascript" src="{{asset('moment-develop/moment.js')}}"></script>
    <script src="{{asset('admin/lib/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

    <script type="text/javascript" src="{{asset('datagrid/data_grid.js')}}"></script>
    <script>
      setInterval(function(){
        var current_time = moment().format("hh:mm:ss A")
        var current_date  = moment().format('MMMM DD, YYYY')
        $('h6#time').empty().append(current_time)
        $('h6#date').empty().append(current_date)
      },1000);


      
      // $('div#az-header').find('ul li')["{{session('active_page')}}"].attr('class', 'nav-item active show');
      
 
      var active_page_sub = "{{session('active_page_sub')}}";
      var active_tab = "{{session('active_tab')}}";
      console.log(active_tab);
      
      $($('div.az-dashboard-nav').find('nav#file a')[parseInt(active_page_sub)]).attr('class', 'nav-link active');

      $($(('nav#excel_tab a')) [parseInt(active_tab)]).attr('id', 'active_tab');

      console.log( $(('nav#excel_tab a')) );
      console.log($(('nav#excel_tab a')) [parseInt(active_tab)]);
    </script>

