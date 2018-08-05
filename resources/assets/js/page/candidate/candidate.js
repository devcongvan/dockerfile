var Candidate={

    init:function () {
        this.configSelect2();
    },

    configSelect2: function () {

        $('.RanDom').select2({
            placeholder: "Chọn tỉnh thành",
            ajax: {
                url: 'location/ajax/select2Search',
                dataType: 'json',
                data: function (params) {
                    // console.log(params);
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    // console.log(data);
                    return {
                        results: data
                    };
                },
                cache: true
            },
            language: {
                noResults: function (params) {
                    return "Không tìm thấy";
                },
                searching: function () {
                    return "Đang tìm kiếm tỉnh thành";
                }
            },

        });

        $('#city_want_to_work').on("select2:select", function (e) {

            var id = $(this).val();
            var url = $(this).data('url');
            var $district = $('#district_want_to_work');

            $('#district_want_to_work').val(null).trigger('change');

            // $('select[name="city[]"]').find('option').attr('selected',false);

            $district.closest('.candidateBox-row').removeClass('hide').addClass('show');

            $district.data('parent-id', id);

            $.ajax({
                url: url+'?loc_parent_id=' + id,
                type: 'GET',
                dataType: 'JSON',
                // data: {param1: 'value1'},
            })
                .done(function (reponse) {
                    var html = '';
                    $.each(reponse, function (key, item) {
                        var option = '<option value="' + item.id + '|' + item.text + '" >' + item.text + '</option>';
                        html += option;
                    });
                    $district.html(html);

                })
                .fail(function (error) {

                });

        });

        function districtSelect2(url, id) {
            $('#district_want_to_work').select2({
                placeholder: "Chọn quận/huyện bạn muốn làm việc",
                ajax: {
                    url: url,
                    dataType: 'json',
                    data: function (params) {
                        return {
                            loc_name: $.trim(params.term),
                            loc_parent_id: id
                        };
                    },
                    processResults: function (data) {

                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                language: {
                    noResults: function (params) {
                        return "Không tìm thấy";
                    },
                    searching: function () {
                        return "Đang tìm kiếm tỉnh thành";
                    }
                }
            }).on('change',function () {
                alert();
            })
        }

        $('.career').select2({
            placeholder: 'Chọn một ngành nghề',
        });

        $('.skill').select2({
            placeholder: 'Chọn một kỹ năng',
            // maximumSelectionLength: 3,
            language: {
                maximumSelected: function (e) {
                    $('body').on('click', function () {
                        $('body')
                    })
                    return 'Chỉ được chọn ' + e.maximum + ' ngành nghề';
                },
                noResults: function (params) {
                    return "Không tìm thấy";
                },
                searching: function () {
                    return "Đang tìm kiếm kỹ năng";
                }
            },
            ajax: {
                url: $('.skill').data('url'),
                dataType: 'json',
                data: function (params) {
                    console.log($('.skill').data('url'));
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {

                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('.source').select2({
            placeholder: 'Chọn một nguồn',
            // maximumSelectionLength: 3,
            language: {

                maximumSelected: function (e) {
                    return 'Chỉ được chọn ' + e.maximum + ' ngành nghề';
                },
                noResults: function (params) {
                    return "Không tìm thấy";
                },
                searching: function () {
                    return "Đang tìm kiếm nguồn";
                }
            },
            ajax: {
                url: 'source/ajax/select2Search',
                dataType: 'json',
                data: function (params) {

                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {

                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $('.select3').select2({
            placeholder: ''
        });
    },

};

$(function () {
   Candidate.init();
});

import './candidate.search';

import './candidate.list';

import './candidate.diary';

import './candidate.add';


