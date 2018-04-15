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

  $("#main_image_dropdownlist").ddslick({
    data: ddData,
    width: 300,
    imagePosition: "left",
    selectText: "Select your favorite social network",
    onSelected: function(data) {
      console.log(data);
      //   $hidden.val(data);
    }
  });
});
