($.fn.toggleAttr = function (e, a, t) {
    return this.each(function () {
        var l = $(this);
        l.attr(e) == a ? l.attr(e, t) : l.attr(e, a);
    });
}),
(function ($) {
    //"use strict";
    (ADM.data = { csrf: $('meta[name="csrf-token"]').attr("content"), appUrl: $('meta[name="app-url"]').attr("content"), fileBaseUrl: $('meta[name="file-base-url"]').attr("content") }),
    (ADM.plugins = {
        notification: function (e = "dark", a = "") {
            $.notify(
                { message: a },
                {
                    showProgressbar: !0,
                    delay: 2500,
                    mouse_over: "pause",
                    placement: { from: "bottom", align: "right" },
                    animate: { enter: "animated fadeInUp", exit: "animated fadeOutDown" },
                    type: e,
                    template:
                    '<div data-notify="container" class="alert alert-{0}" role="alert"><span data-notify="message">{2}</span><div style="height:5px;" class="progress" data-notify="progressbar"><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div></div>',
                }
            );
        },
    }),
    setInterval(function () {
        ADM.extra.refreshToken();
    }, 36e5);
})(jQuery);