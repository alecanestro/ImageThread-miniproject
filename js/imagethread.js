var files;

function prepareUpload(event)
{
    files = event.target.files;
    console.log(files);
}
function submitForm(event, data)
{

    var formData = $('#imageFileForm').serialize();

    $.each(data.files, function (key, value)
    {
        formData = formData + '&filename=' + value;
    });

    $.ajax({
        url: $('#imageFileForm').attr('action'),
        type: 'POST',
        data: formData,
        cache: false,
        dataType: 'json',
        success: function (data, textStatus, jqXHR)
        {
            if (typeof data.error === 'undefined')
            {
                console.log('SUCCESS: ' + data.success);
            }
            else
            {
                console.log('ERRORS: ' + data.error);
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log('ERRORS: ' + textStatus);
        },
        complete: function ()
        {
            setTimeout(function () {
                $.ajax({
                    url: 'images.php',
                    type: 'POST',
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data, textStatus, jqXHR)
                    {
                        if (typeof data.error === 'undefined')
                        {
                            $("#image-post-box-content").html(data.recent);
                            $("#posts-box").html(data.posts);
                            $("#image-post-box-loading").hide();
                            $("#image-post-box-content").show();
                        }
                        else
                        {
                            console.log('ERRORS1: ' + data.error);
                            location.reload();
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        console.log('ERRORS2: ' + textStatus);
                        location.reload();
                    }
                });
            }, 2000);

        }
    });
}
$('form').on('submit', uploadFiles);

function uploadFiles(event)
{
    event.stopPropagation();
    event.preventDefault();

    $("#image-post-box-loading").show();
    $("#image-post-box-content").hide();

    var data = new FormData();
    $.each(files, function (key, value)
    {
        data.append(key, value);
    });

    $.ajax({
        url: $('#imageFileForm').attr('action') + '?files',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR)
        {
            if (typeof data.error === 'undefined')
            {
                submitForm(event, data);
            }
            else
            {
                console.log('ERRORS1: ' + data.error);
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log('ERRORS2: ' + textStatus);
            $("#image-post-box-loading").hide();
            $("#image-post-box-content").show();
        }
    });
}
function sendImage() {
    if (checkSize(20971520)) {
        prepareUpload(event);
        uploadFiles(event);
    }
}

function checkSize(max_img_size) {
    var input = $('#imageFile');
    console.log(input);
    if (input.files && input.files.length == 1)
    {
        if (input.files[0].size > max_img_size)
        {
            alert("The file must be less than " + (max_img_size / 1024 / 1024) + "MB");
            return false;
        }
    }

    return true;
}

setInterval(updatePostViews, 15000);

function updatePostViews() {
    $.ajax({
        url: 'count.php',
        type: 'POST',
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR)
        {
            if (typeof data.error === 'undefined')
            {
                $("#top-bar-post").children('span').html(data.posts);
                $("#top-bar-views").children('span').html(data.views);
            }
            else
            {
                console.log('ERRORS1: ' + data.error);
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log('ERRORS2: ' + textStatus);
        }
    });
}
function exportCSV() {
    location.href = 'export_csv.php';
}