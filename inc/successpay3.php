<!--   -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<body>
    <div>
        <form action="" method="post">
            <button id="btntoast" name="btntoast">show toast</button>
            <button name="showalert">show alert</button>
        </form>
	</div>
</body>
<?php 
    echo '<script>
    swal({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success",
        button: "Aww yiss!",
      });</script>';
?>