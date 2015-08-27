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
      url: "/suggest",
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
});
