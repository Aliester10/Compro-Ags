<footer class="footer">
    <div class="container-fluid d-flex justify-content-between">
      <nav class="pull-left">
        <ul class="nav">
{{--           <li class="nav-item">
            <a class="nav-link" href="http://www.themekita.com">
              ThemeKita
            </a>
          </li> --}}
          {{-- <li class="nav-item">
            <a class="nav-link" href="#"> Help </a>
          </li> --}}
          {{-- <li class="nav-item">
            <a class="nav-link" href="#"> Licenses </a>
          </li> --}}
        </ul>
      </nav>
      <div class="copyright">
        2024, dibuat dengan <i class="fa fa-heart heart text-danger"></i> 
      </div>
      <div>
{{--         Distributed by
        <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
 --}}      </div>
    </div>
  </footer>
</div>
<!-- Custom template | don't include it in your project! -->
<div class="custom-template">
    <div class="title">Settings</div>
    <div class="custom-content">
      <div class="switcher">
        <div class="switch-block">
          <h4>Logo Header</h4>
          <div class="btnSwitch">
            <button
              type="button"
              class="selected changeLogoHeaderColor"
              data-color="dark"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="blue"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="purple"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="light-blue"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="green"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="orange"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="red"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="white"
            ></button>
            <br />
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="dark2"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="blue2"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="purple2"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="light-blue2"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="green2"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="orange2"
            ></button>
            <button
              type="button"
              class="changeLogoHeaderColor"
              data-color="red2"
            ></button>
          </div>
        </div>
        <div class="switch-block">
          <h4>Navbar Header</h4>
          <div class="btnSwitch">
            <button
              type="button"
              class="changeTopBarColor"
              data-color="dark"
            ></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="blue"
            ></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="purple"
            ></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="light-blue"
            ></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="green"
            ></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="orange"
            ></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="red"
            ></button>
            <button
              type="button"
              class="selected changeTopBarColor"
              data-color="white"
            ></button>
            <br />
            <button
              type="button"
              class="changeTopBarColor"
              data-color="dark2"
            ></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="blue2"
            ></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="purple2"
            ></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="light-blue2"
            ></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="green2"
            ></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="orange2"
            ></button>
            <button
              type="button"
              class="changeTopBarColor"
              data-color="red2"
            ></button>
          </div>
        </div>
        <div class="switch-block">
          <h4>Sidebar</h4>
          <div class="btnSwitch">
            <button
              type="button"
              class="changeSideBarColor"
              data-color="white"
            ></button>
            <button
              type="button"
              class="selected changeSideBarColor"
              data-color="dark"
            ></button>
            <button
              type="button"
              class="changeSideBarColor"
              data-color="dark2"
            ></button>
          </div>
        </div>
      </div>
    </div>
    <div class="custom-toggle">
      <i class="fa fa-cog"></i> <!-- Font Awesome icon for settings -->
    </div>
    
  </div>
  <!-- End Custom template -->
</div>
<!--   Core JS Files   -->

{{-- //script produk admin --}}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script src="{{asset('assets/js/admin/core/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/js/admin/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/admin/core/bootstrap.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('assets/js/admin/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

<!-- Chart JS -->
<script src="{{asset('assets/js/admin/plugin/chart.js/chart.min.js')}}"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('assets/js/admin/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Chart Circle -->
<script src="{{asset('assets/js/admin/plugin/chart-circle/circles.min.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('assets/js/admin/plugin/datatables/datatables.min.js')}}"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('assets/js/admin/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<!-- jQuery Vector Maps -->
<script src="{{asset('assets/js/admin/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
<script src="{{asset('assets/js/admin/plugin/jsvectormap/world.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('assets/js/admin/plugin/sweetalert/sweetalert.min.js')}}"></script>

<!-- Kaiadmin JS -->
<script src="{{asset('assets/js/admin/kaiadmin.min.js')}}"></script>

<!-- Kaiadmin DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/js/admin/setting-demo.js')}}"></script>
{{-- <script src="{{asset('assets/js/admin/demo.js')}}"></script>
 --}}



<script>
  $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#177dff",
    fillColor: "rgba(23, 125, 255, 0.14)",
  });

  $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#f3545d",
    fillColor: "rgba(243, 84, 93, .14)",
  });

  $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#ffa534",
    fillColor: "rgba(255, 165, 52, .14)",
  });
</script>
</body>
</html>
