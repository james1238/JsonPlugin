$( document ).ready(function() {

    $("#refresh").submit(function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "GET",
            url: 'actions/jsonProcessor/refreshFeed',
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                alert('success'); // show response from the php script.
                location.reload();
            }
        });
    });

    $("#purge button").click(
        function(e){
            e.preventDefault();

            if(window.confirm("Warning. This will delete all imported data")) {

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "GET",
                url: '/actions/jsonProcessor/deleteAllData',
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    alert('Success'); // show response from the php script.
                    location.reload();
                }
            });

        }
    });

 
});