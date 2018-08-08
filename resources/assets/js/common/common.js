import toastr from "toastr/build/toastr.min";

export var Common={

    init:function () {
        this.configDatepicker();
        this.alertConfig();
        this.scrollSidebar();
        this.collapseNavbar();
        this.dropdownMenu();
        this.configAutocomplete();
        this.runAlert();
    },

    configAutocomplete: function () {
        $.ui.autocomplete.prototype._renderItem = function (ul, item) {
            var re = new RegExp("^" + this.term, "i");
            var t = item.label.replace(re, "<span style='font-weight:bold;color:Blue;'>" + this.term + "</span>");
            return $("<li></li>")
                .data("item.autocomplete", item)
                .append("<a>" + t + "</a>")
                .appendTo(ul);
        };

        $("#chucdanh").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "source/ajax/select2Search",
                    dataType: "json",
                    data: request,
                    success: function (data) {
                        // console.log(data);

                        var regex = new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + request.term.replace(/([\^\$\(\)\[\]\{\}\*\.\+\?\|\\])/gi, "\\$1") + ")(?![^<>]*>)(?![^&;]+;)", "gi");
                        response($.map(data, function (item) {
                            return {
                                label: item.so_name.toString().split('|')[0].replace(regex, "<b>$1</b>"),
                                val: item.id.toString().split('|')[1]
                            }
                        }));

                    }
                });
            },

        });
    },

    configDatepicker: function () {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            defaultViewDate: new Date()
        });
    },

    runAlert: function () {
        if (typeof TYPE_MESSAGE != 'undefined' && typeof MESSAGE != 'undefined') {
            switch (TYPE_MESSAGE) {
                case 'success':
                    toastr.success(MESSAGE);
                    break;
                case 'error':
                    toastr.error(MESSAGE);
                    break;
                case 'warning':
                    toastr.warning(MESSAGE);
                    break;
                case 'info':
                    toastr.info(MESSAGE);
                    break;
            }
        }
    },

    alertConfig: function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    },

    displayAlert: function (message, type = 'success') {
        toastr[type](message);
    },

    scrollSidebar: function () {
        var main_sidebar = $('.main-sidebar');
        var main_sidebar_top = 0;
        if (main_sidebar.length) {
            var main_sidebar_top = main_sidebar.offset().top;
        }


        $(window).scroll(function () {
            if ($(this).scrollTop() > main_sidebar_top) {
                $('.main-sidebar').addClass('fixed');
            } else {
                $('.main-sidebar').removeClass('fixed');
            }
        });
    },

    collapseNavbar: function () {
        $('#collapse-navbar').click(function () {
            if ($(this).data('toggle') == true) {
                $(this).removeClass('rotate');
                $(this).data('toggle', false);
            } else {
                $(this).addClass('rotate');
                $(this).data('toggle', true);
            }
        });
    },

    dropdownMenu: function () {
        $(document).click(function (event) {
            if (!$(event.target).closest("#btn-open-dropdown").length) {
                $('.dropdown-menu').removeClass('show');
                $('#btn-open-dropdown').attr('aria-expanded', true);
            }
        });

        $('#btn-open-dropdown').click(function () {
            if ($(this).attr('aria-expanded') == "true") {
                $('.dropdown-menu').addClass('show');
                $(this).attr('aria-expanded', false);
            } else {
                $('.dropdown-menu').removeClass('show');
                $(this).attr('aria-expanded', true);
            }
        })
    },
};

$(function () {
    Common.init();
});