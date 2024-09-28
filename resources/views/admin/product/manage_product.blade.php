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
                            data-bs-target="#exampleExtraLargeModal" onclick="savaData('0','')"> Add Tax</button>

                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                    </div>

                </div>
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <h6 class="mb-0 text-uppercase">Horizontal Form</h6>
                        <hr>
                        <div class="card border-top border-0 border-4 border-info">
                        <form id="formSubmit" action="{{url('admin/product/store')}}" enctype="multipart/form-data">
                        @csrf
                                <div class="card-body">

                                    <div class="border p-4 rounded">
                                        <div class="card-title d-flex align-items-center">
                                            <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                            </div>
                                            <h5 class="mb-0 text-info">Product</h5>
                                        </div>
                                        <hr>
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-sm-3 col-form-label">Product
                                                Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" id="inputEnterYourName"
                                                    placeholder="Enter Product Name">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Slug</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="slug" class="form-control" id="inputPhoneNo2"
                                                    placeholder="Slug">
                                                    <input type="hidden" name="id" class="form-control" value="{{$id}}" id="inputPhoneNo2"
                                                    placeholder="Slug">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-sm-3 col-form-label">Product
                                                Keywords</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="keyword" id="inputEnterYourName"
                                                    placeholder="Enter Product keywords">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-sm-3 col-form-label">Product
                                                Item code</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="item_code" id="inputEnterYourName"
                                                    placeholder="Enter Product Item code">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-sm-3 col-form-label">Product
                                                Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" name="image" id="inputEnterYourName"
                                                    placeholder="Enter Product Name">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputChoosePassword2"
                                                class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea name="mytextarea">Hello, World!</textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputAddress4" class="col-sm-3 col-form-label">Category</label>
                                            <div class="col-sm-9">
                                                <select name="category_id" id="category" class="form-control">
                                                    <option value="">Select Category</option>
                                                    @if($category->count() > 0)
                                                    @foreach($category as $categorys)
                                                    <option value="{{$categorys->id}}">
                                                        {{$categorys->name}}-({{$categorys->slug}})
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputAddress4" class="col-sm-3 col-form-label">Attribute
                                            </label>
                                            <div class="col-sm-9">
                                                <div class="row mb-3">

                                                    <div class="col-sm-9">
                                                        <span id="multiAttr"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputAddress4" class="col-sm-3 col-form-label">Brand</label>
                                            <div class="col-sm-9">
                                                <select name="brand_id" id="category" class="form-control">
                                                    <option value="">Select Brand</option>
                                                    @if($brand->count() > 0)
                                                    @foreach($brand as $brands)
                                                    <option value="{{$brands->id}}">
                                                        {{$brands->text}}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputAddress4" class="col-sm-3 col-form-label">Tax</label>
                                            <div class="col-sm-9">
                                                <select name="tax_id" id="attributes_id"
                                                    class="form-control ">
                                                    <option value="">Select Tax</option>
                                                    @if($tax->count() > 0)
                                                    @foreach($tax as $taxs)
                                                    <option value="{{$taxs->id}}">
                                                        {{$taxs->text}}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputEnterYourName" class="col-sm-3 col-form-label">Product
                                                Attribute</label>
                                            <div class=" col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <button type="button" id="addAttributeButton"
                                                            class="btn btn-primary my-2 ">Add Attribute</button>
                                                    </div>
                                                    <div class="row" id="addAttr">
                                                        <div class="col-sm-4">
                                                            <select name="color_id[]" id="color_id" class="form-control ">

                                                                @if($color->count() > 0)
                                                                @foreach($color as $colors)
                                                                <option class="box-color"
                                                                    style="background-color:{{$colors->value}}"
                                                                    value="{{$colors->id}}">
                                                                    {{$colors->text}}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select name="size_id[]" id="size_id" class="form-control ">

                                                                @if($size->count() > 0)
                                                                @foreach($size as $size)
                                                                <option value="{{$size->id}}">
                                                                    {{$size->text}}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-12 my-2">
                                                            <input type="text" class="form-control"
                                                                id="inputEnterYourName" placeholder="Enter Sku" name="sku[]">
                                                        </div>
                                                        <div class="col-sm-12 my-2">
                                                            <input type="text" class="form-control"
                                                                id="inputEnterYourName" placeholder="Enter MRP" name="mrp[]">
                                                        </div>
                                                        <div class="col-sm-12 my-2">
                                                            <input type="text" class="form-control"
                                                                id="inputEnterYourName" placeholder="Enter Price" name="price[]">
                                                        </div>
                                                        <div class="col-sm-12 my-2">
                                                            <input type="text" class="form-control"
                                                                id="inputEnterYourName" placeholder="Enter Length" name="length[]">
                                                        </div>
                                                        <div class="col-sm-12 my-2">
                                                            <input type="text" class="form-control"
                                                                id="inputEnterYourName" placeholder="Enter Breadth" name="breath[]">
                                                        </div>
                                                        <div class="col-sm-12 my-2">
                                                            <input type="text" class="form-control"
                                                                id="inputEnterYourName" placeholder="Enter Height" name="height[]">
                                                        </div>
                                                        <div class="col-sm-12 my-2">
                                                            <input type="text" class="form-control"
                                                                id="inputEnterYourName" placeholder="Enter weight" name="weigth[]">
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="inputEnterYourName"
                                                                class="col-sm-3 col-form-label">Product
                                                                Image</label>
                                                                @php $count =1;
                                                                $imageCounter =rand(111,999); @endphp
                                                            <div class=" col-sm-9">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                    <input type="hidden" name="imageValue[]" value="imageValue_{{$count}}">
                                                                        <button type="button"
                                                                            class="btn btn-primary my-2 " id="addAttrImages"
                                                                            onclick="addImages1('attrImage_{{$count}}','')">Add Images</button>
                                                                    </div>
                                                                   
                                                                    
                                                                            <div class="col-sm-8" id="attrImage_{{$count}}">
                                                                            <div id="attrImage_{{$imageCounter}}">
                                                                   
                                                                        <input type="file" class="form-control"
                                                                            id="inputEnterYourName"
                                                                            placeholder="Enter Product Name" name="attr_image_{{$count}}[]">
                                                                    </div>
                                                                 </div>
                                                                    <div class="col-sm-8">
                                                                        @if($count!==1)
                                                                    <button type="submit"
                                                                            class="btn btn-primary my-2 "
                                                                            name="submit" id="addAttrImages">Images Remove</button>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputAddress4" class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck4">
                                                    <label class="form-check-label" for="gridCheck4">Check me
                                                        out</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-info px-5">Add To Product</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function savaData(id, tax) {
    $('#enter_tax').val(tax);
    $('#enter_id').val(id);

}
</script>
<script>
  

let imageCounter = 1990;
function addImages1(id) {
   
    const imageId = 'attrImage_' + imageCounter +'';
    const html = `
        <div class="col-sm-12 my-3" id="${imageId}">
            <input type="file" class="form-control" placeholder="Enter Product Name" name="attr_image_${imageCounter}[]">
            <button type="button" class="btn btn-danger my-2" onclick="removeImage('${imageId}')">Remove Image</button>
        </div>
    `;
    $('#' + id).append(html);
}

function removeImage(id) {
    $('#' + id).remove();
}

    let count= 111;
$("#addAttributeButton").click(function(e) {
    imageCounter++;
    var html = '';
    count++;
    var sizeData = $('#size_id').html();
    var colorData = $('#color_id').html();
    const attrImage = 'attrImage_' + count;
    html += ' <div class="col-sm-4"><select name="color" id="color_id[]" class="form-control ">' +
        colorData + '</select></div>';
    html += ' <div class="col-sm-4"> <select name="size" id="size_id[]"  class="form-control ">' +
        sizeData + '</select></div>';
        html +='<div class="col-sm-12 my-2"><input type="text" class="form-control" id="inputEnterYourName" placeholder="Enter Sku" name="sku[]"></div>';
        html+='<div class="col-sm-12 my-2"><input type="text" class="form-control" id="inputEnterYourName" placeholder="Enter MRP" name="mrp[]"></div>';
        html+='<div class="col-sm-12 my-2"><input type="text" class="form-control" id="inputEnterYourName" placeholder="Enter price" name="price[]"> </div>';
        html+=' <div class="col-sm-12 my-2"><input type="text" class="form-control" id="inputEnterYourName" placeholder="Enter Length" name="length[]"> </div>';
        html+=' <div class="col-sm-12 my-2"><input type="text" class="form-control"id="inputEnterYourName" placeholder="Enter Height" name="height[]"></div>';
        html+=' <div class="col-sm-12 my-2"><input type="text" class="form-control" id="inputEnterYourName" placeholder="Enter weight" name="weigth[]"></div>';
        html += '<div class="row mb-3"><label for="inputEnterYourName" class="col-sm-3 col-form-label">Product Image</label>' +
        '<div class="col-sm-9"><div class="row">' +
        '<div class="col-sm-12"><input type="hidden"  name="imageValue[]" value="imageValue_'+count+'"><button type="button" class="btn btn-primary my-2 " id="addAttrImages" onclick="addImages1(\''+attrImage+'\',\''+count+'\')">Add Images</button></div>' +
        '<div class="" id="attrImage_'+count+'"> <div class="col-sm-8" id="attrImage_'+imageCounter+'"><input type="file" name="attr_image_'+ count+'"[]" class="form-control" id="inputEnterYourName" placeholder="Enter Product Name"></div></div>' +
        '</div></div></div><hr/>';

    $('#addAttr').append(html);

})

</script>
<script>
$(document).ready(function() {
    $("#category").change(function() {
        var cat = $("#category").val();
        if (cat) {
            $.ajax({
                url: '/admin/getAttributes', // Replace with your actual URL
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                data: {
                    cat: cat
                },
                type: 'post',
                success: function(result) {
                    console.log(result);
                    if (result.status == 'Success') {
                        console.log(result);
                        let html =
                            '<select name="attribute_id[]" class="attribute_id" id="attribute_id" multiple>';
                        jQuery.each(result.data.data, function(key, val) {
                            jQuery.each(val.values, function(attrKey, attrVal) {
                                console.log("value"+ attrKey, attrVal);
                                html += '<option value="' + attrVal+
                                    '"/>' + val.attribute.name + '(' +
                                    attrVal+ ')</option>';
                            });
                        });
                        html += '</select>';
                        $('#multiAttr').html(html);
                        $('#attribute_id').multiSelect();

                        // console.log(result);
                    } else {

                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request error:', error);
                    alert('An error occurred. Please try again.');
                },
            });
        } else {
            console.log('No category selected');
        }
    });
});
</script>

@endsection