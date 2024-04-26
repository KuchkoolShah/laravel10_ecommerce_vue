	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
	<script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<script src="{{asset('assets/plugins/chartjs/js/Chart.min.js')}}"></script>
	<script src="{{asset('assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
	<script src="{{asset('assets/js/index.js')}}"></script>
	<!--app JS-->
	<script src="{{asset('assets/js/app.js')}}"></script>
	<script src="{{asset('snackbar/dist/js-snackbar.js')}}"></script>
	<script src="{{asset('snackbar/dist/js-snackbar.min.js')}}"></script>
	<script src="{{asset('snackbar/src/js-snackbar.js')}}"></script>

	<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>

	<script>
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bx-hide");
            $('#show_hide_password i').removeClass("bx-show");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bx-hide");
            $('#show_hide_password i').addClass("bx-show");
        }
    });
});
	</script>
	<script>
$(document).ready(function() {
    $('#example').DataTable();
});
	</script>
	<script>
$(document).ready(function() {
    var table = $('#example2').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'print']
    });

    table.buttons().container()
        .appendTo('#example2_wrapper .col-md-6:eq(0)');
});
	</script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css"
	    integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA=="
	    crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
	    integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
	    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script>
$(document).ready(function(f) {
    $('#formSubmit').on('submit', (function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var html =
            '<button class="btn btn-primary" type="button" disabled=""> <span class="spinner-border spinner-border-sm" arole="status" aria-hidden="true"></span><span class="visually-hidden">Loading...</span></button>';
        var html1 = '<input type="submit" id="submitButton"  class="btn btn-primary px-4">';
        $('#submitButton').html(html);
        console.log('hi', formData);
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            //url:'admin/profile',
            cache: false,
            data: formData,
            contentType: false,
            processData: false,
            success: function(result) {
                if (result.status == 'Success') {
                    if (result.data.reload == undefined) {
                        window.location.href = window.location.href;
                    }
                    showAlert(result.status, result.message);
                    $('#submitButton').html(html1);
                    console.log('success');
                } else {

                    showAlert(result.status, result.message);
                    $('#submitButton').html(html1);
                }
            },
            error: function(result) {

                showAlert(result.responseJSON.status, result.responseJSON.message);
                $('#submitButton').html(html1);


            }
        });


    }));
});

function showAlert(status, message) {
    SnackBar({
        status: status,
        message: message,
        position: "bottom-right"
    });

}

function deleteData(id, table) {
    let text = "Are you sure want to delete";
    if (confirm(text) == true) {
		$.ajax({
        type: "GET",
        url: "{{url('admin/deleteData')}}/" + id + "/" + table + "",
        //url:'admin/profile',
        cache: false,
        data: '',
        contentType: false,
        processData: false,
        success: function(result) {
            if (result.status == 'Success') {

                showAlert(result.status, result.message);
                if (result.data.reload == undefined) {
                    window.location.href = window.location.href;
                }
                console.log('success');
            } else {

                showAlert(result.status, result.message);

            }
        },
        error: function(result) {

            showAlert(result.responseJSON.status, result.responseJSON.message);
            $('#submitButton').html(html1);


        }
    });
    } else {
      
    }

}
	</script>