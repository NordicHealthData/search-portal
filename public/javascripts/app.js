
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
  
  $(".subjectul").hide();
  
  $(".subject").click(function(){
      var display = $(this).siblings("ul").css("display");
      
      if(display == "block"){
          $(this).siblings("ul").slideUp(); 
      }else{
         $(this).siblings("ul").slideDown(); 
      }
  });
  //Sidebar dropdownmenu
  $(".keywordul").hide();
  
  $(".keyword").click(function(){
      var display = $(this).siblings("ul").css("display");
      
      if(display == "block"){
          $(this).siblings("ul").slideUp(); 
      }else{
         $(this).siblings("ul").slideDown(); 
      }
  });
  
  //collapse long text
  $(".abstract").readmore();
});

