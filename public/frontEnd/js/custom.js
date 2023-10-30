
/*$(function () {

    $('#description').mentionsInput({
        onDataRequest:function (mode, query, callback) {
            $.get('/users/list', function(responseData) {
                console.log('ddd',responseData);
                // responseData = _.filter(responseData, function(item) { return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 });
                // callback.call(this, responseData);
            });
        }

    });

});*/

    $('#description').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            // ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

