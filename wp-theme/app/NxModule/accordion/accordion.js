(function() {

    $(document).ready(function() {

        var $accordion = $('.js-accordion');
        var $toggle = $('.js-accordion-title');
        var $item = $('.js-accordion-item');
        var $body = $('.js-accordion-body');
        var $filterInput = $('.js-accordion-filter');

        var toggleClass = 'is-open';

        var preventFireOnHashChange = false;

        var $currentItem = $({});

        var onClickNav = function(ev) {
            ev.preventDefault();
            var $clickedItem = $(ev.currentTarget).closest($item);
            preventFireOnHashChange = true;
            handleItem($clickedItem);
        };

        var handleItem = function($clickedItem) {

            if($clickedItem.is($currentItem)) {
                closeItem($clickedItem);
                $currentItem = $({});
                preventFireOnHashChange = false;

            } else {
                closeItem($currentItem);
                openItem($clickedItem);
                $currentItem = $clickedItem;
                location.hash = $clickedItem.data('anchor');
                
                setTimeout(function() {
                    preventFireOnHashChange = false;
                }, 0);
            }
        };

        var openItem = function($item) {
            $item.addClass(toggleClass);
            $item.find($body).slideDown();
        };

        var closeItem = function($item) {
            $item.removeClass(toggleClass);
            $item.find($body).slideUp();
        };

        var filter = function(ev) {

            var $el = $(ev.currentTarget);
            var filter = $el.val().toLowerCase();
            var $items = $el.closest($accordion).find($item);

            for (var i = 0; i < $items.length; i++) {
                var items= $items[i];

                if (items.innerHTML.toLowerCase().indexOf(filter) > -1) {
                    items.style.display = "";
                } else {
                    items.style.display = "none";
                }
            }
        };

        var onHashChanged = function() {
            var hash = location.hash.replace('#', '');
            var $hashItem = $('*[data-anchor="' + hash + '"]');

            if($hashItem.length > 0) {
                handleItem($hashItem);
                setTimeout(function() {
                    $('html').stop().animate({scrollTop: $hashItem[0].offsetTop - 200}, 250, 'swing', function() {});
                },400);
            }
        }

        $toggle.on('click', onClickNav);
        $filterInput.on('keyup', filter);

        if($accordion.length > 0 && location.hash.length > 0) {
            onHashChanged();
        }

        window.onhashchange = function(state) {
            !preventFireOnHashChange && onHashChanged();
        }

    });
})();