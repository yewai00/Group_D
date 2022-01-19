@extends('Admin.layouts.app')

@section('content')
  <section class="rider-section">
    <div class="rider-card-header clearfix">
      <h4 class="rider-header">Manage <span>Riders</span></h4>
      <a href="{{ route('riders.create') }}" class="btn add-btn add-rider">Add New Rider</a>
    </div><!-- ./rider-card-header -->
    @if(Session('success'))
      <div class="alert-success">
        <strong class="alert-text">{{ Session('success') }}</strong>
      </div>
    @endif
    <div class="card-body">
      <div class="rider-func clearfix">
        <form action="{{ route('riders.search') }}" method="get" class="l-rider-func">
          <input type="text" name="riders" id="riders" placeholder="Search">
          <input type="submit" value="Search" class="btn edit-btn">
        </form>
        <div class="r-rider-func">
          <a href="" class="btn add-btn">Download</a>
          <a href="" class="btn add-btn">Upload</a>
        </div>
      </div>
      <table>
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th class="w-20">Address</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($riders as $rider)
            <tr>
              <td>{{ $rider->id }}</td>
              <td>{{ $rider->name }}</td>
              <td>{{ $rider->phone }}</td>
              <td>{{ $rider->email }}</td>
              <td>{{ $rider->address }}</td>
              <td>{{ $rider->status }}</td>
              <td>{{ \Carbon\Carbon::parse($rider->created_at)->format('Y-m-d') }}</td>
              <td>
              <button >
                <a href="{{ url('admin/riders/'.$rider->id.'/edit') }}" class="btn edit-btn">Edit</a>
              </button>
              <form action="{{ url('admin/riders/'.$rider->id) }}" onsubmit="return confirm('Are you sure to delete?');" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button class="btn delete-btn" type="submit">Delete</button>
              </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
     </div><!-- ./card-body -->
  </section>
@endsection