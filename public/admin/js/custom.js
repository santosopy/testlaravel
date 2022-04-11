jQuery( ()=>{
    const currentPassword = $("#current_password")
    currentPassword.keyup( ()=>{
        $.ajax({
            headers:{
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "post",
            url: "/admin/check-admin-password",
            data: {
                current_password: currentPassword.val()
            },
            success: response =>{
                if( response == "true" ){
                    $("#check_password").html("<font color='green'>Current Password is correct</font>")
                }
                else{
                    $("#check_password").html("<font color='red'>Current Password is Incorrect!</font>")
                }
            },
            error: ()=>{
                console.log("bbb")
            }
        })
    })

    // update status
    $(document).on("click",".status", function(){
        const id = $(this).data("id")
        const status = $(this).data("status")
        $.ajax({
            headers:{
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "post",
            url: "/admin/update-admin-status",
            data:{
                id : id,
                status : status
            },
            success: response =>{
                location.reload()
            }
        })
    })
})