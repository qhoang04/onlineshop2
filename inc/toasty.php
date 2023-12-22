
<head>
	<title>How to use Toastr</title>
	<!-- jQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Toastr -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	<div>
        <form action="" method="post">
            <button id="btntoast" name="btntoast">show toast</button>
            <button name="showalert">show alert</button>
        </form>
	</div>
    <?php 
    echo '<script>
    swal({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success",
        button: "Aww yiss!",
      });</script>';
        if(isset($_POST['showalert'])) {
            echo ('<script>window.location.href="toasty.php?status=showalert";</script>');
        };
        if(isset($_GET['status']) && $_GET['status'] == 'showalert') {
            echo '<script>
                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                        } else {
                        swal("Your imaginary file is safe!");
                        }
                    });
            </script>';
        }
    ?>
    <?php 
        if(isset($_POST['btntoast'])) {
            echo '
                <script>
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
                        toastr["success"]("Thêm vào giỏ hàng thành công!")
                </script>
            ';
        }
    ?>

	<script type="text/javascript">
        // $('#btntoast').on('click',function(){
        //     toastr.options = {
        //     "closeButton": true,
        //     "debug": false,
        //     "newestOnTop": false,
        //     "progressBar": true,
        //     "positionClass": "toast-top-right",
        //     "preventDuplicates": false,
        //     "onclick": null,
        //     "showDuration": "300",
        //     "hideDuration": "1000",
        //     "timeOut": "5000",
        //     "extendedTimeOut": "1000",
        //     "showEasing": "swing",
        //     "hideEasing": "linear",
        //     "showMethod": "fadeIn",
        //     "hideMethod": "fadeOut"
        //     }
        //     toastr["success"]("Thêm vào giỏ hàng thành công!")
        // })


	// 	$(document).ready(function() {
    //         toastr.options = {
    //         "closeButton": true,
    //         "debug": false,
    //         "newestOnTop": false,
    //         "progressBar": true,
    //         "positionClass": "toast-top-right",
    //         "preventDuplicates": false,
    //         "onclick": null,
    //         "showDuration": "300",
    //         "hideDuration": "1000",
    //         "timeOut": "5000",
    //         "extendedTimeOut": "1000",
    //         "showEasing": "swing",
    //         "hideEasing": "linear",
    //         "showMethod": "fadeIn",
    //         "hideMethod": "fadeOut"
    //         }
	// 	});

	// // Toast Type
	// 	$('#success').click(function(event) {
	// 		toastr.success('Thêm vào giỏ hàng thành công');
	// 	});
	// 	$('#info').click(function(event) {
	// 		toastr.info('You clicked Info toast')
	// 	});
	// 	$('#error').click(function(event) {
	// 		toastr.error('You clicked Error Toast')
	// 	});
	// 	$('#warning').click(function(event) {
	// 		toastr.warning('You clicked Warning Toast')
	// 	});
	</script>
</body>
