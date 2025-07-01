<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
      .order-container {
        padding: 20px;
        margin: 20px;
      }
      .orders-table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      }
      .orders-table thead tr {
        background-color: #0f90db;
        color: #ffffff;
        text-align: center;
      }
      .orders-table th,
      .orders-table td {
        padding: 12px 15px;
        border: 1px solid #0e0404;
        text-align: center;
      }
      .orders-table tbody tr {
        border-bottom: 1px solid #dddddd;
      }
      .orders-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
      }
      .orders-table tbody tr:last-of-type {
        border-bottom: 2px solid #0f90db;
      }
      .product-image {
        width: 80px;
        height: 80px;
        object-fit: contain;
        display: block;
        margin: 0 auto;
      }
      .status {
        display: inline-block;
        border-radius: 20px;
        font-weight: 50;
        text-transform: capitalize;
      }
      .status-pending {
        background-color: #fff3cd;
        color: #856404;
      }
      .status-completed {
        background-color: #d4edda;
        color: #155724;
      }
      .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
      }
      .btn-close {
  display: block !important;
  opacity: 1 !important;
}
    </style>
  </head>

  <body>
    @if(session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible fade show mt-3 mx-3" 
         role="alert">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <script>
      // Ensure Bootstrap JS is loaded first
      document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
          var alertEl = document.getElementById('success-alert');
          if (alertEl) {
            var alert = bootstrap.Alert.getOrCreateInstance(alertEl);
            alert.close();
          }
        }, 5000);
      });
    </script>

    @include('admin.header')
    @include('admin.sidebar')
    
    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <h2 class="page-title">Customer Orders</h2>
          <div class="order-container">
            <table class="orders-table">
              <thead>
                <tr>
                  <th>Customer</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Payment Status</th>
                  <th>Status</th>
                  <th>Change Status</th>
                  <th>Print PDF</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $order)
                <tr>
                  <td>{{ $order->name }}</td>
                  <td>{{ $order->rec_address }}</td>
                  <td>{{ $order->phone }}</td>
                  <td>{{ $order->product->title }}</td>
                  <td>${{ number_format($order->product->price, 2) }}</td>
                  <td>
                    <img class="product-image" src="products/{{ $order->product->image }}" alt="{{ $order->product->title }}">
                  </td>
                  <td>{{$order->payment_status}}</td>
                  <td>
                    @if($order->status == 'progress')
                    <span style="color: rgb(169, 11, 24);">{{ $order->status }}</span>
                    @elseif($order->status == 'on the way')
                    <span style="color:skyblue;">{{ $order->status }}</span>
                    @else
                    <span style="color:rgb(89, 0, 255);">{{ $order->status }}</span>
                    @endif
                  </td>
                  <td style="white-space: nowrap;">
                    {{-- white-space: nowrap;: Prevents the buttons from wrapping to the next line. --}}
                    <a class="btn btn-primary" href="{{ url('on_the_way/'.$order->id) }}">On the way</a>
                    <a class="btn btn-success" href="{{ url('delivered/'.$order->id) }}">Delivered</a>
                  </td>
                  <td><a class="btn btn-secondary" href="{{url('print_pdf',$order->id)}}">Print Pdf</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    
    @include('admin.footer')
    
    <!-- JavaScript files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>