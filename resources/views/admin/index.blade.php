<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
        
      </head>

  <body>
  @include('admin.header')

@include('admin.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          @include('admin.body')  
        
        @include('admin.footer')
      </div>
    </div>
      </div>
    <!-- JavaScript files-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}
    "></script>
    <script src="{{asset('vendor/popper.js/umd/popper.min.js')}}
   "> </script>
    <script src="{{asset('/admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('/admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('/admincss/js/front.js')}}"></script>
    <script>
  document.addEventListener("DOMContentLoaded", function () {
  // Bar Chart 1 - Visitors
  const bar1 = new Chart(document.getElementById('barChartExample1'), {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
      datasets: [{
        label: 'Visitors',
        data: [120, 190, 30, 50, 20],
        backgroundColor: 'rgba(75, 192, 192, 0.6)'
      }]
    }
  });

  // Bar Chart 2 - Sales
  const bar2 = new Chart(document.getElementById('barChartExample2'), {
    type: 'bar',
    data: {
      labels: ['Product A', 'Product B', 'Product C'],
      datasets: [{
        label: 'Sales',
        data: [50, 75, 60],
        backgroundColor: 'rgba(153, 102, 255, 0.6)'
      }]
    }
  });

  // Combined Line Chart - Visitors + Sales
  const line = new Chart(document.getElementById('lineChart1'), {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
      datasets: [
        {
          label: 'Visitors',
          data: [120, 190, 30, 50, 20],
          borderColor: 'rgba(75, 192, 192, 1)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          tension: 0.3
        },
        {
          label: 'Sales',
          data: [50, 75, 60, 90, 100], // Match Jan-May range
          borderColor: 'rgba(153, 102, 255, 1)',
          backgroundColor: 'rgba(153, 102, 255, 0.2)',
          tension: 0.3
        }
      ]
    }
  });
});

    </script>
    
  </body>
</html>