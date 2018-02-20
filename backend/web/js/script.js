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

jQuery(function($){
  $('#main_image_dropdownlist').ddslick({
        // width: 350,
    });
});
