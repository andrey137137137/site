// $.ajax({
//   type: 'GET',
//   url: 'index.php?r=prediction/getModelsWithImages',
//   success: function(data) {
//     //добавляем html в нужный div
//     $('#main_image_dropdownlist').html(data);
//     //активируем плагин
//     $('#selectModels').ddslick({
//         width: 350,
//     });
//   }
// });

jQuery(function($) {
  var $hidden = $("#main_image_hidden_input");
  //Dropdown plugin data
  var ddData = [
    {
      text: "Facebook",
      value: 1,
      selected: false,
      description: "Description with Facebook",
      imageSrc: "http://i.imgur.com/XkuTj3B.png"
    },
    {
      text: "Twitter",
      value: 2,
      selected: false,
      description: "Description with Twitter",
      imageSrc: "http://i.imgur.com/8ScLNnk.png"
    },
    {
      text: "LinkedIn",
      value: 3,
      selected: true,
      description: "Description with LinkedIn",
      imageSrc: "http://i.imgur.com/aDNdibj.png"
    },
    {
      text: "Foursquare",
      value: 4,
      selected: false,
      description: "Description with Foursquare",
      imageSrc: "http://i.imgur.com/kFAk2DX.png"
    }
  ];

  $("#main_image_dropdownlist").ddslick({
    // data: ddData,
    width: 300,
    imagePosition: "left",
    selectText: "Select your favorite social network",
    onSelected: function(data) {
      // var ddData = $("#main_image_dropdownlist").data("ddslick");
      console.log(data.selectedData.value);
      // displaySelectedData("2: Getting Selected Dropdown Data", ddData);
      $hidden.val(data.selectedData.value);
    }
  });
});
