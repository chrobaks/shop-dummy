const App = (($, ShopCart) => {

    const $app = $('#app');

    setEvents = () => 
    {
        // footer height
        $('div.app-content', $app).css('margin-bottom', $('div.app-footer .d-flex', $app).css('height'));

        
        $('form[name=formArticleNew] select[name=cat_id]').on('change', function(event) {

            const id = $(this).val();
            const display = ( id*1 === 0) ? 'show' : 'hide';
            
            $('form[name=formArticleNew]').find('div.row-cat-name')[display]();
            
        });

        $('form.formAjax').on('submit', function(event) {
            setAjax($( this ).attr('action'), $( this ).serializeArray());
            event.preventDefault();
            return false;
        });

        $('#shopCartModal button.btn-shop').on('click', function() {
            const act = $(this).attr('data-act');
            const url = AppConfig.url + '?' + act;
            const actMeth = act.split('=');
            let data = [];
            if (actMeth.length && actMeth.length === 2) {
                if (actMeth[1] === 'updateShopCart') {
                    data = {"shopCart" : ShopCart.getShopCart()};
                }

                if (actMeth[0] === 'rq') {
                    ShopCart.setShopCartMsg({'msg' : ''});
                    setAjax(url, data);
                } else {
                    document.location.href = url;
                }
            }
        });
    }

    setAjax = (url, data) => 
    {
        $.ajax({
            method: "POST",
            url: url,
            data: data,
            dataType: 'json'
        })
        .done(function( response ) 
        {
            if (response && response.hasOwnProperty('callBack')) {

                const callBack = 'set' + response.callBack[0].toUpperCase() + response.callBack.slice(1);
                
                if (ShopCart.hasOwnProperty(callBack)) {
                    ShopCart[callBack](response);
                }
            }
        });
    }

    return {
        setEvents : setEvents,
    };

})(jQuery, ShopCart);