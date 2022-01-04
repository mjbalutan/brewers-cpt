(function($){
    const BrewersCpt = {

        items: [],

        bindEvents: function () {

        },

        fetchData: function(dataUrl = null, successCallback)
        {
            var self = this;

            $.getJSON(
                dataUrl,
                function(data)
                {
                    for (d in data) {
                        self.items.push(data[d]);
                    }

                    successCallback();
                }
            );
        },

        sendData: function(data = null)
        {
            var self = this;

            $.ajax({
                'url': bcptAjax.ajaxurl,
                'method': 'POST',
                'dataType': 'json',
                'data': {
                    'action': 'createPost',
                    'data': data,
                },
                success: function(response){
                    console.log(response);
                }
            });
        },

        buildTemplate: function(data)
        {
            return (
                console.log(data)
            )
        },

        render: function()
        {

        }
    }

    const ImportBtn = $('#bcpt_import_btn');

    ImportBtn.on('click', function (e) {

        e.preventDefault();

        var pageNumber = ImportBtn.data('page');
        var resultsLimit = ImportBtn.data('limit');

        BrewersCpt.fetchData(
            'https://api.openbrewerydb.org/breweries?per_page=' + resultsLimit + '&page=' + pageNumber,
            function () {
                BrewersCpt.sendData(BrewersCpt.items);
            }
        );
    });

    BrewersCpt.render();

})(jQuery);
