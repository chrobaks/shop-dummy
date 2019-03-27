const ShopCart = (($) => {

    const $shopCart = $('#shopCartModal');
    const $container = $shopCart.find('.modal-body:eq(0)');

    getShopCart = () => 
    {

        const $articles = $shopCart.find('.col-article');
        const shopCart = [];

        $articles.each(function () {
            const id = $( this ).find('input.inpt-id').first().val();
            const amount = $( this ).find('input.inpt-amount').first().val();
            const price = $( this ).find('input.article-price').first().val();
            const item = {};
            item['id'] = id;
            item['article_count'] = amount;
            item['article_price'] = price;

            shopCart.push(item);
        });

        return shopCart
    }

    setShopCartMsg = (responseData) => 
    {
        $shopCart.find('.modal-msg').first().text(responseData.msg);
    }

    setShopOrderMsg = (responseData) => 
    {
        $('.form-msg.shopOrder').text('');

        if (responseData.hasOwnProperty('form')) {
            $('.form-msg.shopOrder', responseData.form).first().text(responseData.msg);
        }
        
        if (responseData.hasOwnProperty('orderSum')) {
            $('#order-sum').text(responseData.orderSum + '€');
        }
    }

    setShopCartDelete = (responseData) => 
    {
        $container.empty();
        $shopCart.find('.modal-msg').first().text(responseData.msg);
        $shopCart.find('button.btn-shop').attr('disabled', 'disabled');
    }

    setShopCart = (responseData) => 
    {
        
        $container.empty();

        if (responseData.orderShopCart.length) {

            let cat = '',
                sum = 0;

            $.each(responseData.orderShopCart, function( index, obj ) {
                
                sum += (obj.price * responseData.shopCountList[obj.id]);
                
                if (cat !== obj.cat_name) {
                    $container.append($('<div>', {"class" : "col-md-12 clearfix"}).html('<b>Kategorie:' + obj.cat_name + '</b>'));
                    cat = obj.cat_name;
                }
                
                setArticleRow(responseData, obj);
            });

            $container.append($('<hr>', {"class":"clearfix"}));

            setShopSum(responseData.orderSum.toString());
            
            $shopCart.find('input.inpt-amount').on('change', function () { updateShopSum($(this)); });
            $shopCart.find('button[disabled]').removeAttr('disabled');
            $shopCart.find('.modal-msg').first().text('');
        }

        setShopOrderMsg(responseData);
    } 

    setShopSum = (sum) => 
    {
        $sumName = $('<span>', {"class" : "float-left"}).html('<b class="text-green">Gesamtsumme</b>');
        $sumPrice = $('<span>', {"class" : "float-right shop-sum"}).html(sum.replace('.', ',') + '€');
        $container.append($('<div>', {"class" : "col-md-12"}).append([$sumName, $sumPrice]));
    }

    setArticleRow = (responseData, obj) => 
    {

        const tpl = $('<div>', {"class" : "col-md-12 clearfix col-article"});
        
        $inputId = $('<input>', {"type":"hidden", "class":"inpt-id", "name":"article_id_"+obj.id, "value":+obj.id});
        $inputPrice = $('<input>', {"type":"hidden", "class":"article-price", "value":+obj.price});
        $inputSum = $('<input>', {"type":"hidden", "class":"article-sum", "value":+(obj.price * responseData.shopCountList[obj.id])});
        $articleName = $('<span>', {"class" : "float-left"}).html('<b class="text-green">' + obj.article_name + '</b>');
        $articlePrice = $('<span>', {"class" : "float-right"}).html('<b>' + obj.str_price + '€</b>');
        $articleAmount = $('<span>', {"class" : "float-right"})
            .html('<input class="inpt-amount" type="number" name="article_count_'+obj.id+'" id="article_count_'+obj.id+'" min="1" value="'+responseData.shopCountList[obj.id]+'">');
        tpl.append([$inputId, $inputPrice, $inputSum, $articleName, $articleAmount, $articlePrice]);
        $container.append(tpl);
    }

    updateShopSum = (obj) => 
    {
        const $container = obj.closest('div.col-article');
        const amount = obj.val() * 1;
        const price = $container.find('input.article-price').first().val() * 1;
        const artclSum = $container.find('input.article-sum').first().val() * 1;
        let sum = $.trim($shopCart.find('.shop-sum').first().text().replace('€','')).replace(',', '.');
        sum = (((sum * 1) - (artclSum * 1)) + (price * amount)).toFixed(2);
        sum += '';
        $container.find('input.article-sum').first().val((price * amount));
        $shopCart.find('.shop-sum').first().text(sum.replace('.', ',') + '€');
    }

    return {
        setShopCart       : setShopCart,
        getShopCart       : getShopCart,
        setShopCartMsg    : setShopCartMsg,
        setShopOrderMsg   : setShopOrderMsg,
        setShopCartDelete : setShopCartDelete
    }
})(jQuery);