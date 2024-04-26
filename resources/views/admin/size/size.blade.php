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
                            data-bs-target="#exampleExtraLargeModal" onclick="savaData('0','')"> Add Size</button>

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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($size->count() > 0)
                            @foreach($size as $siz)
                            <tr>
                                <td>{{$siz->id}}</td>
                                <td>{{$siz->text}}</td>

                                <td>
                                    <button type="button" class="btn btn-outline-primary px-5 mb-2"
                                        data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal"
                                        onclick="savaData('{{$siz->id}}','{{$siz->text}}' )">Update</button>
                                    <button type="button" class="btn btn-outline-danger px-5 mb-2"
                                        onclick="deleteData('{{$siz->id}}' ,'sizes' )">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3" class=" text-center">No record Found..</td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Text</th>
                              
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
                            <form id="formSubmit" action="{{url('admin/manage_sizeUpdate')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Size</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="border p-4 rounded">
                                            <div class="card-title d-flex align-items-center">
                                                <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                                </div>
                                                <h5 class="mb-0 text-info">Size</h5>
                                            </div>
                                            <hr />
                                            <div class="row mb-3">
                                                <label for="inputEnterYourName"
                                                    class="col-sm-3 col-form-label">Text</label>
                                                <div class="col-sm-9">
                                                <input type="hidden"  class="form-control" id="enter_id" name="id"
                                                        placeholder="Email Address">
                                                    <input type="text" class="form-control" name="text" id="enter_text"
                                                        placeholder="Enter Your Name">
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
function savaData(id, text) {
    $('#enter_text').val(text);  
    $('#enter_id').val(id);

}
</script>
@endsection