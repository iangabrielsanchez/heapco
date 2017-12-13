var baseURL = location.protocol + "//" + location.hostname + ":" + location.port


$(document).ready(function () {

    // $.ajax({
    //     url: baseURL+"/",
    //     data: {
    //         format: 'json'
    //     },
    //     error: function () {
    //         $('#info').html('<p>An error has occurred</p>');
    //     },
    //     dataType: 'jsonp',
    //     success: function (data) {
    //         var $title = $('<h1>').text(data.talks[0].talk_title);
    //         var $description = $('<p>').text(data.talks[0].talk_description);
    //         $('#info')
    //             .append($title)
    //             .append($description);
    //     },
    //     type: 'GET'
    // });

    // $('#example').DataTable({
    //     "ajax": "data/arrays.txt"
    // });
});