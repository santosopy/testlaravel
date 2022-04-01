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
})