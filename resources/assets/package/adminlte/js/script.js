$(document).ready(function() {
    // scroll candidate cv
    // new SimpleBar($('.candidate-cv')[0]);
    // end scroll candidate cv

    // show detail candidate

    $('.candidate-item-main-name').click(function() {
      var name=$(this);

      if (name.attr('toggle')=='false') {
        name.attr('toggle','true');
      }
      
      $('.candidate-main').removeClass('col-xs-9 col-sm-9 col-md-9 col-lg-9');
      $('.candidate-main').addClass('col-xs-6 col-sm-6 col-md-6 col-lg-6');
      $('.candidate-sidebar').addClass('hide');
      $('.candidate-info').slideDown();
      $('.candidate-item').removeClass('selected');
      $(this).parent().parent().parent().parent().addClass('selected');

    });

    var candidate_info=$('.candidate-sidebar').offset().top;

    $(window).scroll(function() {

      if ($('.selected').find('.candidate-item-main-name').attr('toggle')=='true') {
        console.log($(this).attr('toggle'));
        var candidate_item_width=$('.candidate-main').outerWidth();

        var candidate_item_left=$('.candidate-main').offset().left;

        // var padding_left=$('.candidate-main').css('padding-right');

        // console.log(padding_left);

        var width=$('.selected').outerWidth()+"px";

        // $('.candidate-info').animate({width:width});
        $('.candidate-info').width(width);

        if ($(this).scrollTop()>candidate_info) {
          $('.candidate-info').addClass('fixed');
          $('.candidate-info').css('left',candidate_item_width+candidate_item_left+'px');
        }else{
          // $('.candidate-info').css('left',candidate_item_width+candidate_item_left+'px');
          $('.candidate-info').css('left',0);
          $('.candidate-info').removeClass('fixed');
          $('.candidate-info').addClass('show');
          // $('.candidate-info').css('position','static');
        }
      }

    });

    $('.candidate-info').find('.close').click(function() {
      if ($('.selected').find('.candidate-item-main-name').attr('toggle')=='true') {
        $('.selected').find('.candidate-item-main-name').attr('toggle','false');
      }

      $('.candidate-info').removeClass('fixed');
      $('.candidate-info').removeClass('show');
      $('.candidate-info').fadeOut();
      $('.candidate-sidebar').removeClass('hide');
      $('.candidate-main').removeClass('col-xs-6 col-sm-6 col-md-6 col-lg-6');
      $('.candidate-main').addClass('col-xs-9 col-sm-9 col-md-9 col-lg-9');
      $('.candidate-item').removeClass('selected');
    });
    
    // end show info candidate

    // begin scroll nav => plugin
    var main_sidebar=$('.main-sidebar').offset().top;

    console.log(main_sidebar);

    $(window).scroll(function() {
      if ($(this).scrollTop()>main_sidebar) {
        $('.main-sidebar').addClass('fixed');
      }else{
        $('.main-sidebar').removeClass('fixed');
      }
    });
      // end scroll nav

    // collapse navbar
    $('#collapse-navbar').click(function() {

      if ($(this).data('toggle')==true) {
        $(this).removeClass('rotate');
        $(this).data('toggle',false);
      }else{
        $(this).addClass('rotate');
        $(this).data('toggle',true);
      }


      var candidate_item_width=$('.selected').width();
      console.log(candidate_item_width);
      // $('.candidate-info').width(candidate_item_width);
    })

    // drop down menu
    $(document).click(function(event) {
      if (!$(event.target).closest("#btn-open-dropdown").length) {
        $('.dropdown-menu').removeClass('show');
        $('#btn-open-dropdown').attr('aria-expanded',true);
      }
    });

    $('#btn-open-dropdown').click(function() {
      if ($(this).attr('aria-expanded')=="true") {
        $('.dropdown-menu').addClass('show');
        $(this).attr('aria-expanded',false);
      }else{
        $('.dropdown-menu').removeClass('show');
        $(this).attr('aria-expanded',true);
      }
    })
    // end drop down menu

    // begin upload image => plugin
    $('.candidate-upimage').click(function() {
      $('#file').trigger('click');
    })

    $('#file').change(function() {
      if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#after_image').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
        $('.candidate-upimage').hide();
        $('.avatar').show();
      }
    })

    // end upload image

    // begin scroll nav => plugin
    var navprofile_top=$('.navprofile').offset().top;

    $(window).scroll(function() {
      var candidate_sideleft_width=$('.candidate-sideleft').width();
      if ($(this).scrollTop()>navprofile_top) {
        $('.navprofile').addClass('fixed');
        $('.navprofile').css('width',candidate_sideleft_width+'px');
      }else{
        $('.navprofile').removeClass('fixed');
      }
    });
    // end scroll nav

    // start scroll active => plugin
    $('.navprofile-item a').click(function() {
      var hi=$(this);
      $('.navprofile-item a').removeClass('active');
      hi.addClass('active');
      $('html, body').animate({
        scrollTop: $(hi.attr('href')).offset().top
      }, 1000);
    });
    var lastId;
    var menuItems = $('.navprofile-item a');
    var scrollItems = $('.navprofile-item a').map(function(){
      var item = $($(this).attr("href"));
      if (item.length) { return item; }
    });

    // Bind to scroll
    $(window).scroll(function() {
      // Get container scroll position
       var fromTop = $(this).scrollTop()+100;

      // Get id of current scroll item
     var cur = scrollItems.map(function(){
       if ($(this).offset().top < fromTop)
         return this;
     });


     // Get the id of the current element
     cur = cur[cur.length-1];
     var id = cur && cur.length ? cur[0].id : "";
     
     if (lastId !== id) {
         lastId = id;
         // Set/remove active class
         menuItems
           .removeClass("active")
           .filter("[href='#"+id+"']").addClass("active");
     }
    });
    // end scroll active

    // begin rating
     /* 1. Visualizing things on Hover - See next part for action on click */
    $(document).on('mouseover','.rateskill-item', function(){
      var onStar = $(this).data('value'); // The star currently mouse on

      // console.log(onStar);
     
      // Now highlight all the stars that's not after the current hovered star
      $(this).parent().children('.rateskill-item').each(function(e){

        if (e < onStar) {
          $(this).addClass('rateskill-check');
        }
        else {
            $(this).removeClass('rateskill-check');
        }
      });
    }).on('mouseout', function(){
      $(this).parent().children('.rateskill-item').each(function(e){
        // $(this).removeClass('rateskill-check');
      });
    });
    // end rating

    // add row

    $('.card').each(function(index, el) {
      var card=$(this);

      card.find('.btn').click(function() {
        var candidateBox=card.find('.candidateBox:last');
        var dashed=card.find('.dashed:last');
        card.find('.card-body').append(dashed.clone(),candidateBox.clone());
        kynang_action();
        datepicker_action();
      });

    });

    $(document).on('click', '.remove-item',function() {
      $(this).parent().remove();
      $(this).parent().parent().children('.dashed:last').remove();
    })
    // end add row

    // input number => plugin
    $(".input-number").keydown(function (e) {
      // Allow: backspace, delete, tab, escape, enter and .
      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
           // Allow: Ctrl+A, Command+A
          (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
           // Allow: home, end, left, right, down, up
          (e.keyCode >= 35 && e.keyCode <= 40)) {
               // let it happen, don't do anything
               return;
      }
      // Ensure that it is a number and stop the keypress
      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
          e.preventDefault();
      }
    });

    // end input number

    // on off auto
    $('#switch_auto').on('change', function() {
      if ($(this).prop('checked')) {
        $('#btn-apply').show();
      }else {
        $('#btn-apply').hide();
      }
    })
    // end on off auto

    // bootstrap slider
    $("#age").bootstrapSlider({ id: "slider12c", min: 0, max: 100, range: true,step:1, value: [60, 90], 
      formatter:function(value) {
        if (value[0]==0) {
          return 'Không chọn';
        }else{
          return value[0]+' tuổi đến '+value[1]+' tuổi';
        }
      }
    });

    $("#salary").bootstrapSlider({ id: "slider12c", min: 0, max: 100, range: true,step:1, value: [0, 10], 
      formatter:function(value) {
        if (value[0]==0) {
          return 'Không chọn';
        }else{
          return value[0]+' triệu đến '+value[1]+' triệu';
        }
      }
    });
    // end bootstrap slider

    // autocomplete
    var arrChucdanh = [
      "Lập trình viên PHP",
      "Lập trình viên AppleScript",
      "Lập trình viên Asp",
      "Lập trình viên BASIC",
      "Lập trình viên C",
      "Lập trình viên C++",
      "Lập trình viên Clojure",
      "Lập trình viên COBOL",
      "Lập trình viên ColdFusion",
      "Lập trình viên Erlang",
      "Lập trình viên Fortran",
      "Lập trình viên Groovy",
      "Lập trình viên Haskell",
      "Lập trình viên Java",
      "Lập trình viên JavaScript",
      "Lập trình viên Lisp",
      "Lập trình viên Perl",
      "Lập trình viên Python",
      "Lập trình viên Ruby",
      "Lập trình viên Scala",
      "Lập trình viên Scheme"
    ];
    
    $('#vitricongviec').autoComplete({
      minChars: 0,
      source: function(term, suggest){
        term = term.toLowerCase();
        var choices = arrChucdanh;
        var matches = [];
        for (i=0; i<choices.length; i++)
            if (~choices[i].toLowerCase().indexOf(term)) matches.push(choices[i]);
        suggest(matches);
      }
    });

    var arrKynang=[
      "PHP",
      "HTML",
      "CSS",
      "MYSQL",
      "ASP",
      "Photoshop"
    ];

    $('input[name="kynang"]').autoComplete({
      minChars: 0,
      source: function(term, suggest){
        term = term.toLowerCase();
        var choices = arrKynang;
        var matches = [];
        for (i=0; i<choices.length; i++)
            if (~choices[i].toLowerCase().indexOf(term)) matches.push(choices[i]);
        suggest(matches);
      }
    });

    var arrAge=["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"];
    $('input[name="age_at"],input[name="age_begin"],input[name="age_end"]').autoComplete({
      minChars: 0,
      source: function(term, suggest){
        term = term.toLowerCase();
        var choices = arrAge;
        var matches = [];
        for (i=0; i<choices.length; i++)
            if (~choices[i].toLowerCase().indexOf(term)) matches.push(choices[i]);
        suggest(matches);
      }
    });

    var arrChucdanh = [
      "Lập trình viên PHP",
      "Lập trình viên AppleScript",
      "Lập trình viên Asp",
      "Lập trình viên BASIC",
      "Lập trình viên C",
      "Lập trình viên C++",
      "Lập trình viên Clojure",
      "Lập trình viên COBOL",
      "Lập trình viên ColdFusion",
      "Lập trình viên Erlang",
      "Lập trình viên Fortran",
      "Lập trình viên Groovy",
      "Lập trình viên Haskell",
      "Lập trình viên Java",
      "Lập trình viên JavaScript",
      "Lập trình viên Lisp",
      "Lập trình viên Perl",
      "Lập trình viên Python",
      "Lập trình viên Ruby",
      "Lập trình viên Scala",
      "Lập trình viên Scheme"
    ];

    var arrKynang=[
      "PHP",
      "HTML",
      "CSS",
      "MYSQL",
      "ASP",
      "Photoshop"
    ];
    
    $('#chucdanh').autoComplete({
      minChars: 0,
      source: function(term, suggest){
        term = term.toLowerCase();
        var choices = arrChucdanh;
        var matches = [];
        for (i=0; i<choices.length; i++)
            if (~choices[i].toLowerCase().indexOf(term)) matches.push(choices[i]);
        suggest(matches);
      }
    });
    kynang_action();
    function kynang_action() {
      $('input[name="kynang"]').autoComplete({
        minChars: 0,
        source: function(term, suggest){
          term = term.toLowerCase();
          var choices = arrKynang;
          var matches = [];
          for (i=0; i<choices.length; i++)
              if (~choices[i].toLowerCase().indexOf(term)) matches.push(choices[i]);
          suggest(matches);
        }
      });
    }
    // end autocomplete

    // select2
    $('.select2').select2();

    $('#career').select2({
        placeholder: 'Chọn một ngành nghề',
        maximumSelectionLength: 2,
        language: {
        // You can find all of the options in the language files provided in the
        // build. They all must be functions that return the string that should be
        // displayed.
        maximumSelected: function (e) {
            return 'Chỉ được chọn '+e.maximum+' ngành nghề';
        }
    }
      })

      // end select2
    // end select2

    // datepicker
      datepicker_action();
      function datepicker_action() {
        $('.datepicker').datepicker({
          format:'dd/mm/yyyy',
          todayHighlight: true,
        });
      }
      // end datepicker
  });