$(document).ready(function() {
        $('#operator_id').select2({
            placeholder: "Seleziona un operatore",
            allowClear: true,
            ajax: {
                url: '/admin/search-operators', // Update with your URL
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // Search term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(function(operator) {
                            return {
                                id: operator.id,
                                text: operator.name
                            };
                        })
                    };
                },
                cache: true
            },
            minimumInputLength: 1 // Start searching after 1 character
        });
    });
