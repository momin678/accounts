(function ($) {
    // USE STRICT
    "use strict";
    ADM.plugins = {
        // footable tables on smaller devices look awesome.
        fooTable: function () {
            $(".ADM-table").each(function () {
                var $this = $(this);
                var empty = $this.data("empty");
                empty = !empty ? ADM.local.nothing_found : empty;
                $this.footable({
                    breakpoints: {
                        xs: 576,
                        sm: 768,
                        md: 992,
                        lg: 1200,
                        xl: 1400,
                    },
                    cascade: true,
                    on: {
                        "ready.ft.table": function (e, ft) {
                            ADM.extra.deleteConfirm();
                            ADM.plugins.bootstrapSelect("refresh");
                        },
                    },
                    empty: empty,
                });
            });
        },
    };
    ADM.plugins.fooTable();
})(jQuery);