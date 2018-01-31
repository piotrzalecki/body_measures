


$(document).ready(function(){


  $("svg").click(function(){
      $(".man").toggle();
      $(".woman").toggle();


  });

$(".close_window").click(function(){
  $("form.login").fadeOut(0, function(){
    $("a.login").fadeIn();
  });

});


function b_m_h(input_name,svg_path){
  var focused = false;

  $(input_name).focus(function(){
      $(svg_path).css("visibility","visible");
      focused = true;
    })
   .blur(function(){
       $(svg_path).css("visibility","hidden");
       focused = false;
   });

   $(input_name).mouseenter(function(){
      $(svg_path).css("visibility","visible");
   })
   .mouseleave(function(){
      if (!focused){
        $(svg_path).css("visibility","hidden");
    }
    });
}

var input_fields = ["input[name='hips']","input[name='chest']","input[name='belly']","input[name='forearm']","input[name='waist']","input[name='biceps']","input[name='thigh']","input[name='neck']","input[name='calf']"];
var w_paths = ["#w_hips","#w_chest","#w_belly","#w_forearm","#w_waist","#w_biceps","#w_thigh","#w_neck","#w_calf"];
var m_paths = ["#m_hips","#m_chest","#m_belly","#m_forearm","#m_waist","#m_biceps","#m_thigh","#m_neck","#m_calf"];

for (i = 0; i < 9; i++){
$(w_paths[i]).css("visibility","hidden");
$(m_paths[i]).css("visibility","hidden");

}



for (i = 0; i < 9; i++){
  b_m_h(input_fields[i],w_paths[i]);
  b_m_h(input_fields[i],m_paths[i]);

}

$(".main_table").delegate("tr", "click", function(event){



      $(this).children(".table_icons").toggle();


});

$(".main_table").mouseleave(function(){
  var timer = setTimeout(function(){
  $(".table_icons").hide();
}, 5000);

});
// $("a.delete").

$("a.login").click(function(){

  $("a.login").fadeOut(0, function(){
    $("form.login").fadeIn();
  });

});


$("#date").datepicker({
  dateFormat: 'yy-mm-dd'
});



$("#forgotten").validate({
  rules: {
      email:{
        required: true,
        email:true
      },
  },
  messages: {

      email:{
        required: "Type your email",
        email: "Please enter a valid email address",
      }

  }
});


$("#resetPassword").validate({
  rules: {

    password_1: {
      required: true,
      minlength: 5,

    },
    password: {
      required: true,
      minlength: 5,
      equalTo: "#password_1"
    },


  },
  messages: {


    password_1: {
      required: "Please provide a password",
      minlength: "Your password must be at least 5 characters long"
    },
    password: {
      required: "Please provide a password",
      minlength: "Your password must be at least 5 characters long",
      equalTo: "Please enter the same password as above"
    },



  }
});





$("#registerform").validate({
  rules: {

    username: {
      required: true,
      minlength: 5
    },
    password_1: {
      required: true,
      minlength: 5
    },
    password: {
      required: true,
      minlength: 5,
      equalTo: "#password_1"
    },
    email: {
      required: true,
      email: true
    }

  },
  messages: {

    username: {
      required: "Please enter a username",
      minlength: "Your username must consist of at least 5 characters"
    },
    password_1: {
      required: "Please provide a password",
      minlength: "Your password must be at least 5 characters long"
    },
    password: {
      required: "Please provide a password",
      minlength: "Your password must be at least 5 characters long",
      equalTo: "Please enter the same password as above"
    },
    email: "Please enter a valid email address",


  }
});


$("#settingsForm").validate({
  rules: {


    password_1: {
      required: function(element){
                  return $("#password_1").val()!="";
                },
      minlength: 5
    },
    password: {
      required: function(element){
                  return $("#password_1").val()!="";
                },
      minlength: 5,
      equalTo: "#password_1"
    },

    email: {
      required: function(element){
                  return $("#email").val()!="";
                },
      email: true
    }





  },
  messages: {


    password_1: {
      required: "Please provide a password",
      minlength: "Your password must be at least 5 characters long"
    },
    password: {
      required: "Please provide a password",
      minlength: "Your password must be at least 5 characters long",
      equalTo: "Please enter the same password as above"
    },
    email: "Please enter a valid email address",


  }
});




$("#addMeasureForm").validate({
  rules: {


    weight: {
      number: true
    },
    hips: {
      number: true
    },
    belly: {
      number: true
    },
    waist: {
      number: true
    },
    thigh: {
      number: true
    },
    calf: {
      number: true
    },
    chest: {
      number: true
    },
    forearm: {
      number: true
    },
    biceps: {
      number: true
    },
    neck: {
      number: true
    },
    date:{
      required: true,
      dateISO: true
    }





  },
  messages: {

    date:{
      required: "This field is required.",
      dateISO: "Date hav to be in format YYYY-MM-DD (egzemple: 2017-12-01)",
    },
    weight: {
      number: "This field may contain numbers only.",
    },
    hips: {
      number: "This field may contain numbers only.",
    },
    belly: {
      number: "This field may contain numbers only.",
    },
    waist: {
      number: "This field may contain numbers only.",
    },
    thigh: {
      number: "This field may contain numbers only.",
    },
    calf: {
      number: "This field may contain numbers only.",
    },
    chest: {
      number: "This field may contain numbers only.",
    },
    forearm: {
      number: "This field may contain numbers only.",
    },

    biceps: {
      number: "This field may contain numbers only.",
    },
    neck: {
      number: "This field may contain numbers only.",
    },


  }
});
// !!!!!!!!!!!!!!!!!!
// SCROOL ANIMATIONS
// !!!!!!!!!!!!!!!!!!

var controller = new ScrollMagic.Controller();



var scene1 = new ScrollMagic.Scene({
    triggerElement:'#slide2',
    // duration:'50%'
})
    .setClassToggle('#slide2','fade-in')
    // .addIndicators()
    .addTo(controller);

var scene2 = new ScrollMagic.Scene({
    triggerElement:'#slide3',
    // duration:'50%'
})
    .setClassToggle('#slide3','fade-in')
    // .addIndicators()
    .addTo(controller);

var scene3 = new ScrollMagic.Scene({
    triggerElement:'#slide4',
    // duration:'50%'
})
    .setClassToggle('#slide4','fade-in')
    // .addIndicators()
    .addTo(controller);

var scene4 = new ScrollMagic.Scene({
    triggerElement:'#slide5',
    // duration:'50%'
})
    .setClassToggle('#slide5','fade-in')
    // .addIndicators()
    .addTo(controller);



});

//////////////////////////////////////////////
$("#charts_settings").click(function(){
    console.log("clicked");
  $(".charts_settings").toggle(500);

});
