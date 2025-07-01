 <!-- or your admin master layout -->
 @extends('admin.layout')
 @section('content')
 <div class="container mt-4">
     <h2>Contact Messages</h2>
 
     @if($contacts->isEmpty())
         <p>No messages yet.</p>
     @else
         <table class="table table-bordered table-striped">
             <thead>
                 <tr>
                     <th>#</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Message</th>
                     <th>Received At</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach($contacts as $key => $contact)
                 <tr>
                     <td>{{ $key + 1 }}</td>
                     <td>{{ $contact->name }}</td>
                     <td>{{ $contact->email }}</td>
                     <td>{{ $contact->message }}</td>
                     <td>{{ $contact->created_at->format('d M, Y h:i A') }}</td>
                 </tr>
                 @endforeach
             </tbody>
         </table>
     @endif
 </div>
 @endsection
 