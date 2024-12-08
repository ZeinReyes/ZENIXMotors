$(document).ready(function() {
    $("#current_password").keyup(function() {
        var current_password = $("#current_password").val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/admin/check-current-password",
            data: {current_password: current_password}, 
            success: function(response) {
                if(response == "false") {
                    $("#verifyCurrentPassword").html("Current Password is Incorrect!");
                } else if(response == "true"){
                    $("#verifyCurrentPassword").html("Verified");
                }
            }, error: function() {
                alert("Error");
            }
        });
    });

    $(document).on("click", ".updateCMSPageStatus", function() {
        var status = $(this).children("i").attr("status");
        var page_id = $(this).attr("page_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-cms-pages-status',
            data: {status: status, page_id: page_id},
            success:function(response) {
                if(response['status'] == 0) {
                    $("#page-"+page_id).html("<i class='fas fas-toggle-off' style='color:grey' status='Inactive'></i>");
                } else if(response['status'] == 1){
                    $("#page-"+page_id).html("<i class='fas fas-toggle-on' status='Active'></i>");
                }

            }, error: function() {
                alert("Error");
            }
        });
    });

    $(document).on("click", ".confirmDelete", function() {
        console.log("Click event triggered");
        var record = $(this).attr('record');
        var recordid = $(this).attr('recordid');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.isConfirmed) {
                Swal.fire(
                    'Deleted',
                    'The CMS page has been deleted',
                    'success'
                )
                window.location.href = "/admin/delete-"+record+"/"+recordid;
            }
        })
    });


    $(document).on("click", ".updateCategoryStatus", function() {
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-category-status',
            data: {status: status, category_id: category_id},
            success:function(response) {
                if(response['status'] == 0) {
                    $("#category-"+category_id).html("<i class='fas fas-toggle-off' style='color:grey' status='Inactive'></i>");
                } else if(response['status'] == 1){
                    $("#category-"+category_id).html("<i class='fas fas-toggle-on' status='Active'></i>");
                }
            }, error: function() {
                alert("Error");
            }
        });
    });

    $(document).on("click", ".updateMotorcyclesStatus", function() {
        var status = $(this).children("i").attr("status");
        var id = $(this).attr("motorcycles_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-motorcycles-status',
            data: {status: status, id: id},
            success:function(response) {
                if(response['status'] == 0) {
                    $("#category-"+id).html("<i class='fas fas-toggle-off' style='color:grey' status='Inactive'></i>");
                } else if(response['status'] == 1){
                    $("#category-"+id).html("<i class='fas fas-toggle-on' status='Active'></i>");
                }
            }, error: function() {
                alert("Error");
            }
        });
    });

    $(document).on("click", ".updateAccessoriesStatus", function() {
        var status = $(this).children("i").attr("status");
        var id = $(this).attr("accessories_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-accessories-status',
            data: {status: status, id: id},
            success:function(response) {
                if(response['status'] == 0) {
                    $("#category-"+id).html("<i class='fas fas-toggle-off' style='color:grey' status='Inactive'></i>");
                } else if(response['status'] == 1){
                    $("#category-"+id).html("<i class='fas fas-toggle-on' status='Active'></i>");
                }
            }, error: function() {
                alert("Error");
            }
        });
    });
});