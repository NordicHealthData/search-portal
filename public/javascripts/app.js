/*
-------------------------------------------------------------------------------
Nordic Health Data Portal JavaScript
---------------------------------------------------------------------------- */

$(document).ready(function() {
  // Initialize the Foundation
  $(document).foundation();
  $('#q').typeahead({
    ajax: {
      url: 'suggest',
      timeout: 300,
      displayField: "text",
      valueField: "freq",
      triggerLength: 3,
      method: "get",
      dataType: "JSON",
      preDispatch: function (query) {
        return {
          text: query
        }
      },
      preProcess: function (data) {
        if (data.success === false || data.mysuggest[0].options.length < 1) {
          return false;
        } else {
          return data.mysuggest[0].options;
        }
      }
    }
  });
});
