(function () {


    $(document).ready(function () {

        // Create Link Wrapper for FancyBox

        var $images = $('.o-content img');

        $images.each(function (index, image) {
            var $image = $(image);
            var href = $image.attr('src');
            var caption = $image.attr('alt');

            if($image.parent().attr('target') !== '_blank') {
                $image.wrap('<a data-fancybox="group" data-caption="' + caption +'" href="' + href + '">');
            }
        });


        $('[data-fancybox]').fancybox({
            buttons: [
                'close'
            ]
        });

    })


})();
