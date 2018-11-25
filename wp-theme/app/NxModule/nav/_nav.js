(function() {

    var $item= $('.js-nav-item');
    var $toggle = $('.js-toggle-subnav');
    var $sub = $('.js-nav-sublist');

    var toggleClass = 'is-open';

    var $currentItem = $({});

    var onClickNav = function(ev) {
        ev.preventDefault();
        var $clickedItem = $(ev.currentTarget).closest($item);
        handleItem($clickedItem);
    };

    var handleItem = function($clickedItem) {

        if($clickedItem.is($currentItem)) {
            closeItem($clickedItem);
            $currentItem = $({});

        } else {
            closeItem($currentItem);
            openItem($clickedItem);
            $currentItem = $clickedItem;
        }
    };

    var openItem = function($item) {
        $item.addClass(toggleClass);
        $item.find($sub).slideDown();
    };

    var closeItem = function($item) {
        $item.removeClass(toggleClass);
        $item.find($sub).slideUp();
    };

    $toggle.on('click', onClickNav);

})();