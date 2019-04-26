jQuery(function($) {
  "use strict";

  var parallax = document.getElementById("parallax");
  var parallaxInstance = new Parallax(parallax);
  console.log(parallaxInstance);
});

// var app = new Vue({
//   el: "#parallax",
//   data: function() {
//     return {
//       $parallaxContainer: document.getElementById("parallax"),
//       // $container,
//       $layers: false,
//       centerX: 0,
//       centerY: 0,
//       initialX: 0,
//       initialY: 0,
//       scrollY: 0,
//       divider: 0,
//       positionX: 0,
//       positionY: 0,
//       bottomPosition: 0,
//       transformString: ""
//       // path: "../../assets/img/parallax",
//       // ext: "png",
//       // layers: [100, 100, 90, 80, 70, 60, 15, 10]
//     };
//   },
//   methods: {
//     moveLayers: function(event) {
//       var $vm = this;
//       var isScroll = false;

//       if (isScroll) {
//         this.scrollY = window.pageYOffset || document.documentElement.scrollTop;
//       }

//       this.initialX = isScroll ? this.centerX : this.centerX - event.pageX;
//       this.initialY = isScroll
//         ? this.centerY - this.scrollY
//         : this.centerY - event.pageY;

//       if (this.$layers) {
//         [].slice.call(this.$layers).forEach(function($layer, index) {
//           if (isScroll) {
//             $vm.divider = (index + 1) / 90;
//           } else {
//             $vm.divider = ((index + 1) * $layer.dataset.depth) / 10000;
//           }

//           console.log($layer.dataset.depth);

//           $vm.positionY = $vm.initialY * $vm.divider;
//           $vm.bottomPosition = (window.innerHeight / 2) * $vm.divider;

//           if (isScroll) {
//             $vm.transformString = `translateY(${$vm.positionY}px)`;
//           } else {
//             $vm.positionX = $vm.initialX * $vm.divider;
//             $vm.transformString = `translate(${$vm.positionX}px, ${
//               $vm.positionY
//             }px)`;
//           }

//           $layer.style.transform = $vm.transformString;
//           $layer.firstElementChild.style.bottom = `-${$vm.bottomPosition}px`;
//         });
//       }
//     }
//   },
//   mounted: function() {
//     var $vm = this;

//     $(document).ready(function() {
//       var isScroll = false;

//       $vm.$parallaxContainer = document.getElementById("parallax");

//       $vm.centerX = window.innerWidth / 2;
//       $vm.centerY = window.innerHeight / 2;

//       if ($vm.$parallaxContainer) {
//         // if ($vm.$parallaxContainer.classList.contains("parallax-scroll")) {
//         //   isScroll = true;
//         // }

//         // $container = $vm.$parallaxContainer.firstElementChild
//         $vm.$layers = $vm.$parallaxContainer.children;

//         if (isScroll) {
//           window.addEventListener("scroll", $vm.moveLayers);
//           window.dispatchEvent(new Event("scroll"));
//         } else {
//           window.addEventListener("mousemove", $vm.moveLayers);
//         }
//       }
//     });
//   }
// });
