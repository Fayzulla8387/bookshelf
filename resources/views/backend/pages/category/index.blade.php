@extends('backend.layouts.app')
@section('admin')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Categories</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal">Add Author</a>

    </div>

@include('backend.layouts.partilas.messages')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.categories.store')}}">
                        @csrf
                       <div class="row">
                               <div class="col-md-6">
                                   <label for="name">Category Name</label>
                                   <input type="text" name="name" class="form-control" id="name" placeholder="Name">


                               </div>


                               <div class="col-md-6">
                                   <label for="slug">Category URl link</label>
                                   <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">


                               </div>

                                   <div class="col-md-12">
                                       <label for="parent_id"> Parent Category</label>
                                       <br>
                                       <select name="parent_id" id="parent_id" class="form-control">
                                           @foreach($parents as $parent)
                                               <option value="{{$parent->id}}">{{$parent['name']}}</option>

                                           @endforeach
                                       </select>

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
                  <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
              </div>
              <div class="card-body">
<table class="table table-hover" id="dataTable">
    <thead>
    <tr>
        <th>Sl</th>
        <th>Name</th>
        <th>URl</th>
        <th>Parent Category</th>

        <th>Description</th>

        <th>Amallar</th>
    </tr>
    </thead>
    <tbody>
@foreach($categories as $category)
    <tr>
        <td>{{$category['id']}}</td>
        <td>{{$category['name']}}</td>
        <td><a href="{{route('admin.categories.show',$category->slug)}}">{{route('admin.categories.show',$category->slug)}}</a></td>
        <td>{{$category['parent_id']}}</td>


        <td>{{$category['description']}}</td>
        <td><a href="#editModal{{$category->id}}" class="btn btn-success" data-toggle="modal"><i class="fa fa-edit"></i>edit</a>
            <a href="#deleteModal{{$category->id}}"  class="btn btn-danger" data-toggle="modal"><i class="fa fa-trash"></i>edit</a></td>
    </tr>

    <div class="modal fade" id="editModal   {{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.categories.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Category Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name">


                            </div>


                            <div class="col-md-6">
                                <label for="slug">Category URl link</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug">


                            </div>

                            <div class="col-md-12">
                                <label for="parent_id"> Parent Category</label>
                                <br>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    @foreach($parents as $parent)
                                        <option value="{{$parent->id}}">{{$parent['name']}}</option>

                                    @endforeach
                                </select>

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



    <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.categories.delete',$category->id)}}">
                        @csrf
                        @method('DELETE')
                    <div>
                        {{$category->name}}
                        <br>
                    <p class="text-danger">larni o'chirishga ishonchiz komilmi</p>
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