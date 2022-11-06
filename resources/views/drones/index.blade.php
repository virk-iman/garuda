@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')
<!--
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@else
    <div class="alert alert-danger" role="alert">
    {{ session('failed') }}
</div>
@endif
-->
<div class="row">
<div class="col-sm-12">
    <h3 align="center">Drones</h3>    
  <table class="table" id="users-table">
    <thead>
        <tr>
          <td>ID</td>
          <td>District</td>
          <td>Police Station</td>
          <td>BOP</td>
          <td>Location</td>
          <td>Time Seen</td>
          <td>Edit</td>
        </tr>
    </thead>
   <tbody>
   </tbody>
  </table>
<div>
</div>
@endsection

@section('scripts')

        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js" defer></script>
        <script>

$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('datatables.category')}}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'district', name: 'district' },
            { data: 'ps', name: 'ps' },
            { data: 'bop', name: 'bop' },
            { data: 'location', name: 'location' },
            { data: 'time_seen', name: 'time_seen' },
            {data: 'edit', name: 'edit', orderable: false, searchable: false},
        ],
        order: [ [5, 'desc'] ]
    });
});
</script>
        <!-- DataTables -->
        
    
@endsection

