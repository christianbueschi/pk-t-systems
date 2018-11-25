(function() {


    $(document).ready(function() {


        var $filter = $('.js-filter-button');
        var $categories = $('.js-filter-categories');

        $filter.on('click', function() {
            $categories.slideToggle(200);
            $filter.toggleClass('is-open');
        })

    })

})();