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
                            Brand</button>

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
                                <th>Text</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($brand->count() > 0)
                            @foreach($brand as $brands)
                            <tr>
                                <td>{{$brands->id}}</td>
                                <td>{{$brands->text}}</td>
                                <td> <img alt="" title="" class="img-fluid rounded" src="{{asset($brands->image) }}">
                                </td>

                                <td>
                                    <button type="button" class="btn btn-outline-primary px-5 mb-2"
                                        data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal"
                                        onclick="savaData('{{$brands->id}}','{{ $brands->text}}','{{$brands->image}}' )">Update</button>
                                        <button type="button" class="btn btn-outline-danger px-5 mb-2"
                                       
                                        onclick="deleteData('{{$brands->id}}' ,'brands' )">Delete</button>
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
                                <th>Text</th>
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
                            <form id="formSubmit" action="{{url('admin/brand/update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Home Banner</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="border p-4 rounded">
                                            <div class="card-title d-flex align-items-center">
                                                <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                                </div>
                                                <h5 class="mb-0 text-info">User</h5>
                                            </div>
                                            <hr />
                                            <div class="row mb-3">
                                                <label for="inputEnterYourName"
                                                    class="col-sm-3 col-form-label">Text</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="text" id="enter_text"
                                                        placeholder="Enter Your Name">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="inputEmailAddress2"
                                                    class="col-sm-3 col-form-label">Image</label>
                                                <div class="col-sm-9">
                                                    <input type="hidden"  class="form-control" id="enter_id" name="id"
                                                        placeholder="Email Address">
                                                    <input type="file" class="form-control" name="image" id="photo">
                                                    <div id="image_key">
                                                        <img class="img-fluid rounded mt-5" id="imgPreview"
                                                            height="200px;" width="250px;" src="">
                                                    </div>

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
function savaData(id, text,  image) {
    $('#enter_text').val(text);
    $('#enter_id').val(id);
    if (image == '') {
        var key_image = "{{URL::asset('images/upload.jpg')}}";
        $('#photo').prop('required' , false);
    } else {
        var key_image = "{{URL::asset('' )}}/" + image + "";
        $('#photo').prop('required' , false);
    }
    var html = '<img src="' + key_image + '" id="imgPreview"  class="img-fluid rounded mt-5" id="imgPreview" >';
    $('#image_key').html(html);
}
</script>
@endsection