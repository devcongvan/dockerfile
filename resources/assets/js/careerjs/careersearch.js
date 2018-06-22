const URL_SEARCH_CAREERNEW='';
const URL_SEARCH_CAREERTOP='';

var CareerSearch={
    init:function () {
        this.searchOption();
    },

    searchOption:function () {
        $('#career-search-option').change(function () {
            this.form.submit();
        })
    }
}

$(function () {
    CareerSearch.init();
})