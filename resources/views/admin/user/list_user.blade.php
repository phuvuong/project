@extends('admin_layout')
@section('admin_content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Category List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Show Category</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
                @php
                    $error = Session::get('error');
                    if($error){
                        echo  '<div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h5><i class="icon fas fa-ban"></i> Alert!</h5>'
                          .$error.
                        '</div>';
                    }
                @endphp
                @php
                $message = Session::get('message');
                if($message){
                    echo '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i> Alert!</h5>'
                      .$message.
                    '</div>';
                    Session::put('message',null);
                }
                @endphp
                
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Tên user</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Password</th>
                    <th>Author</th>
                    <th>Admin</th>
                    <th>User</th>
                    <th style="width:30px;"></th>
                    <th style="width:150px;"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($admin as $key => $user)
                    <form action="{{url('/assign-roles')}}" method="POST">
                        @csrf
                        <tr>
                         
                          <td>{{ $user->admin_name }}</td>
                          <td>{{ $user->admin_email }} 
                            <input type="hidden" name="admin_email" value="{{ $user->admin_email }}"></td>
                            <input type="hidden" name="admin_id" value="{{ $user->admin_id }}"></td>
                          <td>{{ $user->admin_phone }}</td>
                          <td>{{ $user->admin_password }}</td>
                         
                          <td><input type="checkbox" name="author_role" {{$user->hasRole('author') ? 'checked' : ''}}></td>
                          <td><input type="checkbox" name="admin_role"  {{$user->hasRole('admin') ? 'checked' : ''}}></td>
                          <td><input type="checkbox" name="user_role"  {{$user->hasRole('user') ? 'checked' : ''}}></td>
                            
                        <td>
                            
                           <input type="submit" value="Assign roles" class="btn btn-sm btn-success toastrDefaultSuccess">
                          
                        </td> 
                          <td>
                            <a href="{{ url('/delete-user-roles/'.$user->admin_id) }}" class="btn btn-sm btn-danger cente">Delete User</a>
                          </td>
                        </tr>
                      </form>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                   <td>{!!$admin->links()!!}</td> 
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection