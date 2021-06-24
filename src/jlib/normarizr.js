// JavaScript Document
let ajaxLoading = false;
let ajaxLoadingIssue = false;
let ajaxLoadingUsers = false;
let ajaxLoadingUsersEdit = false;
let ajaxStaffDetailsView = false;
let ajaxRegisterNewUser= false;
let ajaxViewPayment=false;
let ajaxAddPaymentType=false;
let ajax_edit_payment_type=false;
let ajax_Add_Payment=false;
let ajax_edit_payment=false;
let ajaxAddProgramme=false;
let ajaxAddCertificate=false;
let ajaxAddSchool=false;
let ajaxAddCourse=false;
let ajaxEditProgramme=false;
let ajaxEditCertificate=false;
let ajaxEditCourse=false;
let ajaxEditSchools=false;
let ajaxViewCertificate=false;
let ajaxAddCertificateCourse=false;



$(document).ready(function() {

    //Create New User Pop up Window with Ajax jquery
    $(document).on('click', '.reg_user', function (e) {
        $("#loader_httpFeed").show();
        
        if (!ajaxRegisterNewUser) {

            ajaxRegisterNewUser = true;
            $.ajax({
                type: "POST",
                url: "view/users/register",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Create New User",
                        "content": msg
                    });
                    ajaxRegisterNewUser = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
        e.preventDefault();
    })

    //Add Payment type Pop up Window with Ajax jquery
    $(document).on('click', '.add_paymenttype', function (e) {
        $("#loader_httpFeed").show();
        if (!ajaxAddPaymentType) {

            ajaxAddPaymentType = true;
            $.ajax({
                type: "POST",
                url: "view/payments/add_payment_type.php",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Add Payment Title",
                        "content": msg
                    });

                    ajaxAddPaymentType = false;
                }
            });
        }
        e.preventDefault();
    })


    //Update Payment Pop up Window with Ajax jquery
    $(document).on('click', '.edit_payment', function (e) {
        $("#loader_httpFeed").show();
        
        let id = $(this).attr("id");
        let matric_no = $(this).attr("land");

        //alert(matric_no)
        if (!ajax_edit_payment) {

            ajax_edit_payment = true;
            $.ajax({
                type: "POST",
                data: {
                    'id': id
                },
                url: "view/payments/edit_payment.php",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update Payment -> ${matric_no.toUpperCase()}`,
                        "content": msg
                    });
                    ajax_edit_payment = false;
                }
            });
        }
        e.preventDefault();
    })


    //View Payment type Pop up Window with Ajax jquery
    $(document).on('click', '.view_payment_type', function (e) {
        $("#loader_httpFeed").show();
        if (!ajaxViewPayment) {

            ajaxViewPayment = true;
            $.ajax({
                type: "POST",
                url: "view/payments/view_payment_types.php",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "View Payment Types",
                        "content": msg
                    });

                    ajaxViewPayment = false;
                }
            });
        }
        e.preventDefault();
    })

    
    //Update Payment Type Pop up Window with Ajax jquery
    $(document).on('click', '.edit_payment_type', function (e) {
        $("#loader_httpFeed").show();
        let id = $(this).attr("id");

        if (!ajax_edit_payment_type) {

            ajax_edit_payment_type = true;
            $.ajax({
                type: "POST",
                data: {
                    'id': id
                },
                url: "view/payments/edit_payment_type.php",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update Payment Title`,
                        "content": msg
                    });
                    ajax_edit_payment_type = false;
                }
            });
        }
        e.preventDefault();
    })

    //Create Campus Pop up Window with Ajax jquery
    $(document).on('click', '.reg_campus', function () {
        $("#loader_httpFeed").show();
        if (!ajaxLoadingUsers) {

            ajaxLoadingUsers = true;
            $.ajax({
                type: "POST",
                url: "view/new_campus/create_campus",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Create New Campus",
                        "content": msg
                    });
                    ajaxLoadingUsers = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })

    //Update Campus Pop up Window with Ajax jquery
    $(document).on('click', '.edit_campus', function () {
        $("#loader_httpFeed").show();
        let name = $(this).attr("lang");
        let id = $(this).attr("id");


        if (!ajaxLoadingUsers) {
           
            ajaxLoadingUsers = true;
            $.ajax({
                type: "POST",
                url: "view/new_campus/update",
                data: {
                    campus_id:id
                },
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update Campus -> ${name.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingUsers = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })


    //Update User Pop up Window with Ajax jquery
    $(document).on('click', '.edit_user', function () {
        $("#loader_httpFeed").show();
        let username = $(this).attr("lang");
        let id = $(this).attr("id");


        if (!ajaxLoadingUsers) {

            ajaxLoadingUsers = true;
            $.ajax({
                type: "POST",
                url: "view/users/update_user",
                data: {
                    user_id: id
                },
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update User -> ${username.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingUsers = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })


    //Universal Delete Confirm Message box with Ajax jquery
    $(document).on('click', '.delete_row', function () {
        let _id = $(this).attr("id");
        let table = $(this).attr("lang");

        dalert.ReplaceConfirm();
        
        confirm("Are you sure you want to delete?", "Confirm Delete!", function (result) {
            if (result) {
                $.ajax({
                    url: "crud/delete",
                    method: "POST",
                    data: {
                        _id: _id,
                        table: table

                    },
                    success: function (data) {
                        dalert.alert(data, "Message",
                            {
                                messageFontColor: '#333333',
                                messageBgColor: '#ffffff',
                                tittleBgColor: '#535353',
                                tittleFontColor: '#ffffff'
                            });
                        
                    }
                });
            }
            else {
                dalert.alert("Delete Cancelled!", "Message",
                    {
                        messageFontColor: '#333333',
                        messageBgColor: '#ffffff',
                        tittleBgColor: '#535353',
                        tittleFontColor: '#ffffff'
                    });
                return false;
            }
            
        },
        {
                messageFontColor: '#333333',
                messageBgColor: '#ffffff',
                tittleBgColor: '#535353',
                tittleFontColor: '#ffffff'
            });
       
    });
   

    //User/Student Delete Confirm Message box with Ajax jquery
    $(document).on('click', '.delete_user_or_student', function () {
        
        let syscategory = $(this).attr("lang");
        let member_id = $(this).attr("title");

        //alert(member_id)
        dalert.ReplaceConfirm();

        confirm("Are you sure you want to delete the user completely from the system?", "Confirm Delete!", function (result) {
            if (result) {
                $.ajax({
                    url: "crud/delete_user",
                    method: "POST",
                    data: {
                        
                        syscategory: syscategory,
                        member_id: member_id
                    },
                    success: function (data) {
                        dalert.alert(data, "Message",
                            {
                                messageFontColor: '#333333',
                                messageBgColor: '#ffffff',
                                tittleBgColor: '#535353',
                                tittleFontColor: '#ffffff'
                            });
                        dataTable.ajax.reload('abdganiu');
                    }
                });
            }
            else {
                dalert.alert("Delete Cancelled!", "Message",
                    {
                        messageFontColor: '#333333',
                        messageBgColor: '#ffffff',
                        tittleBgColor: '#535353',
                        tittleFontColor: '#ffffff'
                    });
                return false;
            }
        },
            {
                messageFontColor: '#333333',
                messageBgColor: '#ffffff',
                tittleBgColor: '#535353',
                tittleFontColor: '#ffffff'
            });

    });


    //Add Payment Pop up Window with Ajax jquery
    $(document).on('click', '.add_payment', function () {
        $("#loader_httpFeed").show();
        let member_id = $(this).attr("id");

        if (!ajax_Add_Payment) {

            ajax_Add_Payment = true;
            $.ajax({
                type: "POST",
                data:{
                    'member_id': member_id
                },
                url: "view/payments/add_payment.php",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Add Payment",
                        "content": msg
                    });
                    ajax_Add_Payment = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })


    //Add Programme type Pop up Window with Ajax jquery
    $(document).on('click', '.add_programme', function (e) {
        $("#loader_httpFeed").show();

        if (!ajaxAddProgramme) {

            ajaxAddProgramme = true;
            $.ajax({
                type: "POST",
                url: "view/schools/add_programme.php",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Add Programme Title",
                        "content": msg
                    });
                    ajaxAddProgramme = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
        e.preventDefault();
    })

    //Add Certificate type Pop up Window with Ajax jquery
    $(document).on('click', '.add_certificate', function (e) {
        $("#loader_httpFeed").show();

        if (!ajaxAddCertificate) {

            ajaxAddCertificate = true;
            $.ajax({
                type: "POST",
                url: "view/schools/add_certificate.php",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Add Certificate Title",
                        "content": msg
                    });
                    ajaxAddCertificate = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
        e.preventDefault();
    })


    //Add Schools type Pop up Window with Ajax jquery
    $(document).on('click', '.add_school', function (e) {
        $("#loader_httpFeed").show();

        if (!ajaxAddSchool) {

            ajaxAddSchool = true;
            $.ajax({
                type: "POST",
                url: "view/course/add_schools.php",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Add School",
                        "content": msg
                    });
                    ajaxAddSchool = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
        e.preventDefault();
    })


    //Add Schools type Pop up Window with Ajax jquery
    $(document).on('click', '.add_course', function (e) {
        $("#loader_httpFeed").show();

        if (!ajaxAddCourse) {

            ajaxAddCourse = true;
            $.ajax({
                type: "POST",
                url: "view/course/add_course.php",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Add Couse",
                        "content": msg
                    });
                    ajaxAddCourse = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
        e.preventDefault();
    })

    //Update Programme Pop up Window with Ajax jquery
    $(document).on('click', '.edit_programme', function () {
        $("#loader_httpFeed").show();
        let category = $(this).attr("lang");
        let id = $(this).attr("id");


        if (!ajaxEditProgramme) {

            ajaxEditProgramme = true;
            $.ajax({
                type: "POST",
                url: "view/schools/edit_programme",
                data: {
                    id: id
                },
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update Programme -> ${category.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxEditProgramme = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })


    //Update Certificate Pop up Window with Ajax jquery
    $(document).on('click', '.edit_certificate', function () {
        $("#loader_httpFeed").show();
        let Title = $(this).attr("lang");
        let id = $(this).attr("id");


        if (!ajaxEditCertificate) {

            ajaxEditCertificate = true;
            $.ajax({
                type: "POST",
                url: "view/schools/edit_certificate",
                data: {
                    id: id
                },
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update Certificate -> ${Title.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxEditCertificate = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })
    

    //Update Course Pop up Window with Ajax jquery
    $(document).on('click', '.edit_course', function () {
        $("#loader_httpFeed").show();
        let Title = $(this).attr("lang");
        let id = $(this).attr("id");

        if (!ajaxEditCourse) {

            ajaxEditCourse = true;
            $.ajax({
                type: "POST",
                url: "view/course/edit_course.php",
                data: {
                    id: id
                },
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update Course -> ${Title.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxEditCourse = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })


    //Update School Pop up Window with Ajax jquery
    $(document).on('click', '.edit_schools', function () {
        $("#loader_httpFeed").show();
        let Title = $(this).attr("lang");
        let id = $(this).attr("id");

        if (!ajaxEditSchools) {

            ajaxEditSchools = true;
            $.ajax({
                type: "POST",
                url: "view/course/edit_schools.php",
                data: {
                    id: id
                },
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update School -> ${Title.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxEditSchools = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })


    //View Certificate Pop up Window with Ajax jquery
    $(document).on('click', '.view_certificate', function () {
        $("#loader_httpFeed").show();
        let title = $(this).attr("lang");
        let id = $(this).attr("id");
        let objectives = $(this).attr("title");


        if (!ajaxViewCertificate) {

            ajaxViewCertificate = true;
            $.ajax({
                type: "POST",
                data: {
                    'id': id,
                    'title': title,
                    'objectives': objectives
                },
                url: "view/schools/view_certificate",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `View Certificate -> ${title.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxViewCertificate = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })

    //Add Certificate Course Pop up Window with Ajax jquery
    $(document).on('click', '.AddCertificateCourse', function (e) {
        $("#loader_httpFeed").show();

        let id = $(this).attr("id");

        if (!ajaxAddCertificateCourse) {

            ajaxAddCertificateCourse = true;
            $.ajax({
                type: "POST",
                data: {
                    'id': id
                },
                url: "view/schools/AddCertificateCourse",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Add Certificate Course",
                        "content": msg
                    });
                    ajaxAddCertificateCourse = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
        e.preventDefault();
    })

});


