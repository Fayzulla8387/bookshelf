@extends('backend.layouts.app')
@section('admin')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Publishers</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal">Add Author</a>

    </div>

@include('backend.layouts.partilas.messages')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Publishers</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.publisher.store')}}">
                        @csrf
                       <div class="row">
                           <div class="col-md-6">
                               <label for="name">Publisher Name</label>
                               <input type="text" name="name" class="form-control" id="name" placeholder="Name">

                           </div>
                           <div class="col-md-6">
                               <label for="name">Publisher Link</label>
                               <input type="text" name="link" class="form-control" id="name" placeholder="Link">

                           </div>
                           <div class="col-md-6">
                               <label for="name">Publisher Address</label>
                               <input type="text" name="address" class="form-control" id="name" placeholder="Address">

                           </div>
                           <div class="col-md-6">
                               <label for="name">Publisher Outlet</label>
                               <input type="text" name="outlet" class="form-control" id="name" placeholder="Outlwt">

                           </div>
                           <div class="col-md-12">
                               <label for="description">Description</label>
                               <textarea  type="text" name="description" class="form-control" id="description" cols="150" rows="10"></textarea>

                           </div>
                           <div class="mt-4 col-md-6">
                               <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                               <button type="submit" class="btn btn-primary">Save changes</button>
                           </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Content Row -->
    <div class="row">
        <!-- Illustrations -->
      <div class="col-sm-12">
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Author List</h6>
              </div>
              <div class="card-body">
<table class="table table-hover" id="dataTable">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>Link</th>
        <th>Address</th>
        <th>Outlet</th>
        <th>Manage</th>
        <th>Amallar</th>
    </tr>
    </thead>
    <tbody>
@foreach($publishers as $publisher)
    <tr>
        <td>{{$publisher['id']}}</td>
        <td>{{$publisher['name']}}</td>
        <td>{{$publisher['link']}}</td>
        <td>{{$publisher['address']}}</td>
        <td>{{$publisher['outlet']}}</td>
        <td>{{$publisher['description']}}</td>
        <td><a href="#editModal{{$publisher->id}}" class="btn btn-success" data-toggle="modal"><i class="fa fa-edit"></i>edit</a>
            <a href="#deleteModal{{$publisher->id}}"  class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash"></i>edit</a></td>
    </tr>

    <div class="modal fade w-100" id="editModal{{$publisher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Publishers</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.publisher.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Publisher Name</label>
                                <input type="text" name="name" class="form-control" value="{{$publisher->name}}" id="name" placeholder="Name">

                            </div>
                            <div class="col-md-6">
                                <label for="name">Publisher Link</label>
                                <input type="text" name="link" class="form-control" id="name" value="{{$publisher->link}}" placeholder="Link">

                            </div>
                            <div class="col-md-6">
                                <label for="name">Publisher Address</label>
                                <input type="text" name="address" class="form-control" value="{{$publisher->address}}" id="name" placeholder="Address">

                            </div>
                            <div class="col-md-6">
                                <label for="name">Publisher Outlet</label>
                                <input type="text" name="outlet" class="form-control" value="{{$publisher->outlet}}" id="name" placeholder="Outlwt">

                            </div>
                            <div class="col-md-12">
                                <label for="description">Description</label>
                                <textarea  type="text" name="description" class="form-control"  id="description" cols="150" rows="10">{{$publisher->description}}</textarea>

                            </div>
                            <div class="mt-4 col-md-6">
                                <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="deleteModal{{$publisher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Author</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.publisher.delete',$publisher->id)}}">
                        @csrf
                        @method('DELETE')
                    <div>
                        {{$publisher->name}}
                        <br>
                        {{$publisher->link}} <p class="text-danger">larni o'chirishga ishonchiz komilmi</p>
                    </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endforeach
    </tbody>
</table>

          </div>
      </div>

    </div>
@endsection