</div>
</body>
<script type="text/javascript">
    $('.tasks').hide();
    $('#submitButton').click(function(e){
        e.preventDefault();
        var group_id = $('#group_id')[0].value;
        var esvPeriod = $('#esvPeriod')[0].value;
        var dateStart = $('#dateStart')[0].value;
        var dateFinish = $('#dateFinish')[0].value;
        var language = $('#language')[0].value;
        var jsonData = {
            group_id: group_id,
            esvPeriod: esvPeriod,
            dateStart: dateStart,
            dateFinish: dateFinish,
            language: language
        };
        var formData = JSON.stringify(jsonData);
        $.ajax({
            url: "todo",
            type: "post",
            data: {formData: formData}
        })
        .done(function (response) {
            var isSuccessful = response['success'];
            if (!isSuccessful) {
                var data = response['errors'];
                $('.error').remove();
                $.each(data, function(key, value){
                    $('.errorList').append('<li class="error">'+value+'</li>');
                })
            }
            else {
                console.log(response);
                $('.error').remove();
                $('.tasks').show();
                $('.text').remove();
                $('.task1').append("<li class='text'>"+response['result'][0]+"</li>");
                $.each(response['result'][1], function(index, value){
                    $('.task2').append("<li class='text'>"+value+"</li>");
                });
                $.each(response['result'][2], function(index, value){
                    $('.task3').append("<li class='text'>"+value+"</li>");
                });
            }
        })
        .fail(function (response) {
        })
        .always(function (response) {
        })
    });
</script>
</html>