@extends('admin.layout')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                            href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                            link</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row row-cols-auto g-3">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-outline-primary px-5 mb-2" data-bs-toggle="modal"
                            data-bs-target="#exampleExtraLargeModal" onclick="savaData('0','','')">Add
                            Category</button>

                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                    </div>

                </div>

                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data->count() > 0)
                            @foreach($data as $categoryAttribute)
                            <tr>
                                <td>{{$categoryAttribute->id}}</td>
                                <td>{{$categoryAttribute->category->name}}</td>
                                <td>{{$categoryAttribute->attribute->name}}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary px-5 mb-2"
                                        data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal"
                                        onclick="savaData('$categoryAttribute->id}','{{$categoryAttribute->category_id}}','{{$categoryAttribute->attribute_id}}')">Update</button>
                                        <button type="button" class="btn btn-outline-danger px-5 mb-2"
                                       
                                        onclick="deleteData('{{$categoryAttribute->id}}' ,'category_attribute' )">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class=" text-center">No record Found..</td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="row row-cols-auto g-3">
            <div class="col">

                <div class="modal fade" id="exampleExtraLargeModal">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form id="formSubmit" action="{{url('admin/category_attribute/update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Category Attribute</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="border p-4 rounded">
                                         
                                            <div class="row mb-3">
                                                <label for="inputEnterYourName"
                                                    class="col-sm-3 col-form-label">Attribute</label>
                                                <div class="col-sm-9">
                                                    <select name="attribute_id" id="attribute_id" class="form-control ">
                                                        <option value="">Select Attribute</option>
                                                        @if($attribute->count() > 0)
                                                        @foreach($attribute as $attributes)
                                                        <option value="{{$attributes->id}}">
                                                            {{$attributes->name}}-({{$attributes->slug}})
                                                        </option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputEnterYourName"
                                                    class="col-sm-3 col-form-label">Parent Category</label>
                                                <div class="col-sm-9">
                                                <input type="hidden"  class="form-control" id="enter_id" name="id"
                                                        placeholder="Email Address">
                                                    <select name="category_id" id="category_id" class="form-control ">
                                                        <option value="">Parent Category</option>
                                                        @if($category->count() > 0)
                                                        @foreach($category as $categorys)
                                                        <option value="{{$categorys->id}}">
                                                            {{$categorys->name}}
                                                        </option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="submitButton" class="btn btn-primary">Save
                                        changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>

function savaData(id,attribute_id, parent_category_id) {

    $('#attribute_id').val(attribute_id);
    $('#category_id').val(catetgory_id);
    $('#enter_id').val(id);

}
</script>
@endsection