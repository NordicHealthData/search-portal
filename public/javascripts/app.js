
/*
-------------------------------------------------------------------------------
Nordic Health Data Portal JavaScript
---------------------------------------------------------------------------- */

$(document).ready(function() {
  // Initialize the Foundation
  $(document).foundation();

  // Initialize the Twitter Bootstrap Typeahead
  $(".search").typeahead({
    ajax: {
      dataType: "JSON",
      displayField: "text",
      method: "get",
      timeout: 300,
      triggerLength: 3,
      url: $("input.search").attr("data-suggesturl"),
      valueField: "freq",
      preDispatch: function(query) {
        return {
          text: query,
        };
      },

      preProcess: function(data) {
        if (data.success === false || data.mysuggest[0].options.length < 1) {
          return false;
        } else {
          return data.mysuggest[0].options;
        }
      },
    },
  });
  //hide searchfilters
  $(".filter ul").hide();
  
  $(".filter h2").click(function (){      
      var display = $(this).siblings("ul").css("display");
      
      if(display == "block"){
          $(this).siblings("ul").slideUp(); 
      }else{
         $(this).siblings("ul").slideDown(); 
      }
  });
  
  $(".sidebar ul").hide();
  
  $(".subject").on("mouseenter", function (){
      $(this).siblings(".subjectul").slideDown("slow");
  });
  
  $("#subject").on("mouseleave", function (){
     $(".subjectul").slideUp("slow"); 
  });
  
  $(".keyword").on('mouseenter', function (){
      $(this).siblings(".keywordul").slideDown("slow");
  });
  
  $("#keyword").on("mouseleave", function (){
      $(".keywordul").slideUp("slow");
  });
  //collapse long text
  $(".abstract").readmore();
});

