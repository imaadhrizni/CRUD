var createRequestModel = function () {
    var that = mixinPubSub(),
        url,
        paginatorModel,
        orderModel,
        filterModel,
        ajax = function (fig) {
            fig = fig || {};
            // console.log('url', queryjs.set(url, { page: fig.page || 1 }));
            $.ajax({
                // url: url + '/page/' + (fig.page || 1),
                url: queryjs.set(url, { page: fig.page || 1 }),
                cache: false,
                method: 'GET',
                data: union(
                    (filterModel ? appendKey('filter_', filterModel.get()) : {}),
                    appendKey('order_', orderModel.get())
                ),
                dataType: 'json',
                beforeSend: partial(that.publish, fig.moduleName + ':waiting:start'),
                success: function (response) {
                    partial(that.publish, 'load')(response);
                },
                error: partial(ajaxErrorResponse, that),
                complete: partial(that.publish, fig.moduleName + ':waiting:end')
            });
        };



    that.init = function (fig) {
        url = fig.url;
        paginatorModel = fig.paginatorModel;
        filterModel = fig.filterModel;
        orderModel = fig.orderModel;
        // console.log('url', url);
    };

    that.changePage = function (pageNumber, moduleName) {

        ajax({ page: pageNumber, moduleName: moduleName });
    };

    that.search = function (moduleName) {
        if(paginatorModel.get('pageNumber') !== 1) {
            paginatorModel.set({ pageNumber: 1 });
        }
        ajax({ moduleName: moduleName });
    };

    return that;
};