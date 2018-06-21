import {configCommon, swal} from './common';
var Aleart = {
    init(){
        this.runAleart();
        this.runAleart();
    },
    runAleart(){
        console.log(123);
        configCommon();
        var $this = this;
        this.showAlert();
    },
    deleteAlert(){
        console.log('delete');
    },
    showAlert(){

    }
}

$(function () {
    Aleart.init();
});