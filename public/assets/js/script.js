// /*
//  * Atrana
//  */



// /*
//  * this is the javascipt for the Atrana template.
//  * if you want to change, please create a new javascript, 
//  * because if one is missing in the original Atrana javascript it will fall apart
//  */


// //preloader
// $(document).ready(function () {
// 	setInterval(function () {
// 		$(".loader").hide();
// 		$(".loader-overlay").hide();
// 	}, 700);

// 	//sidebar toggle
// 	$("#sidebar-toggle, .sidebar-overlay").click(function () {
// 		$(".sidebar").toggleClass("sidebar-show");
// 		$(".sidebar-overlay").toggleClass("d-block");
// 	});
// });


// // sidebar menu dropdown
// const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');
// const sidebar = document.getElementById('sidebar');

// allDropdown.forEach(item=> {
// 	const a = item.parentElement.querySelector('a:first-child');
// 	a.addEventListener('click', function (e) {
// 		e.preventDefault();

// 		if(!this.classList.contains('active')) {
// 			allDropdown.forEach(i=> {
// 				const aLink = i.parentElement.querySelector('a:first-child');

// 				aLink.classList.remove('active');
// 				i.classList.remove('show');
// 			})
// 		}

// 		this.classList.toggle('active');
// 		item.classList.toggle('show');
// 	})
// })
 
// document.getElementById('basic').addEventListener('click', () => {
//     Toastify({
//         text: "This is a toast",
//         duration: 3000
//     }).showToast();
// })
// document.getElementById('background').addEventListener('click', () => {
//     Toastify({
//         text: "This is a toast",
//         duration: 3000,
//         backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
//     }).showToast();
// })
// document.getElementById('close').addEventListener('click', () => {
//     Toastify({
//         text: "Click close button",
//         duration: 3000,
//         close:true,
//         backgroundColor: "#4fbe87",
//     }).showToast();
// })
// document.getElementById('top-left').addEventListener('click', () => {
//     Toastify({
//         text: "This is toast in top left",
//         duration: 3000,
//         close:true,
//         gravity:"top",  
//         position: "left",
//         backgroundColor: "#4fbe87",
//     }).showToast();
// })
// document.getElementById('top-center').addEventListener('click', () => {
//     Toastify({
//         text: "This is toast in top center",
//         duration: 3000,
//         close:true,
//         gravity:"top",
//         position: "center",
//         backgroundColor: "#081A51",
//     }).showToast();
// })
// document.getElementById('top-right').addEventListener('click', () => {
//     Toastify({
//         text: "This is toast in top right",
//         duration: 3000,
//         close:true,
//         gravity:"top",
//         position: "right",
//         backgroundColor: "#081A51",
//     }).showToast();
// })
// document.getElementById('bottom-right').addEventListener('click', () => {
//     Toastify({
//         text: "This is toast in bottom right",
//         duration: 3000,
//         close:true,
//         gravity:"bottom",
//         position: "right",
//         backgroundColor: "#081A51",
//     }).showToast();
// })
// document.getElementById('bottom-center').addEventListener('click', () => {
//     Toastify({
//         text: "This is toast in bottom center",
//         duration: 3000,
//         close:true,
//         gravity:"bottom",
//         position: "center",
//         backgroundColor: "#081A51",
//     }).showToast();
// })
// document.getElementById('bottom-left').addEventListener('click', () => {
//     Toastify({
//         text: "This is toast in bottom left",
//         duration: 3000,
//         close:true,
//         gravity:"bottom",
//         position: "left",
//         backgroundColor: "#4fbe87",
//     }).showToast();
// })
 


//   /** Chartjs Pages **/
  
// var chartColors = {
//   red: 'rgb(255, 99, 132)',
//   orange: 'rgb(255, 159, 64)',
//   yellow: 'rgb(255, 205, 86)',
//   green: 'rgb(75, 192, 192)',
//   info: '#41B1F9',
//   blue: '#3245D1',
//   purple: 'rgb(153, 102, 255)',
//   grey: '#EBEFF6'
// };

// var config1 = {
//   type: "line",
//   data: {
//       labels: ["January", "February", "March", "April", "May", "June", "July"],
//       datasets: [
//           {
//               label: "Balance",
//               backgroundColor: "#fff",
//               borderColor: "#fff",
//               data: [20, 40, 20, 70, 10, 50, 20],
//               fill: false,
//               pointBorderWidth: 100,
//               pointBorderColor: "transparent",
//               pointRadius: 3,
//               pointBackgroundColor: "transparent",
//               pointHoverBackgroundColor: "rgba(63,82,227,1)",
//           },
//       ],
//   },
//   options: {
//       responsive: true,
//       maintainAspectRatio: false,
//       layout: {
//           padding: {
//               left: -10,
//               top: 10,
//           },
//       },
//       legend: {
//           display: false,
//       },
//       title: {
//           display: false,
//       },
//       tooltips: {
//           mode: "index",
//           intersect: false,
//       },
//       hover: {
//           mode: "nearest",
//           intersect: true,
//       },
//       scales: {
//           xAxes: [
//               {
//                   gridLines: {
//                       drawBorder: false,
//                       display: false,
//                   },
//                   ticks: {
//                       display: false,
//                   },
//               },
//           ],
//           yAxes: [
//               {
//                   gridLines: {
//                       display: false,
//                       drawBorder: false,
//                   },
//                   ticks: {
//                       display: false,
//                   },
//               },
//           ],
//       },
//   },
// };
// var config2 = {
//   type: "line",
//   data: {
//       labels: ["January", "February", "March", "April", "May", "June", "July"],
//       datasets: [
//           {
//               label: "Revenue",
//               backgroundColor: "#fff",
//               borderColor: "#fff",
//               data: [20, 800, 300, 400, 10, 50, 20],
//               fill: false,
//               pointBorderWidth: 100,
//               pointBorderColor: "transparent",
//               pointRadius: 3,
//               pointBackgroundColor: "transparent",
//               pointHoverBackgroundColor: "rgba(63,82,227,1)",
//           },
//       ],
//   },
//   options: {
//       responsive: true,
//       maintainAspectRatio: false,
//       layout: {
//           padding: {
//               left: -10,
//               top: 10,
//           },
//       },
//       legend: {
//           display: false,
//       },
//       title: {
//           display: false,
//       },
//       tooltips: {
//           mode: "index",
//           intersect: false,
//       },
//       hover: {
//           mode: "nearest",
//           intersect: true,
//       },
//       scales: {
//           xAxes: [
//               {
//                   gridLines: {
//                       drawBorder: false,
//                       display: false,
//                   },
//                   ticks: {
//                       display: false,
//                   },
//               },
//           ],
//           yAxes: [
//               {
//                   gridLines: {
//                       display: false,
//                       drawBorder: false,
//                   },
//                   ticks: {
//                       display: false,
//                   },
//               },
//           ],
//       },
//   },
// };
// var config3 = {
//   type: "line",
//   data: {
//       labels: ["January", "February", "March", "April", "May", "June", "July"],
//       datasets: [
//           {
//               label: "Orders",
//               backgroundColor: "#fff",
//               borderColor: "#fff",
//               data: [20, 40, 20, 200, 10, 540, 723],
//               fill: false,
//               pointBorderWidth: 100,
//               pointBorderColor: "transparent",
//               pointRadius: 3,
//               pointBackgroundColor: "transparent",
//               pointHoverBackgroundColor: "rgba(63,82,227,1)",
//           },
//       ],
//   },
//   options: {
//       responsive: true,
//       maintainAspectRatio: false,
//       layout: {
//           padding: {
//               left: -10,
//               top: 10,
//           },
//       },
//       legend: {
//           display: false,
//       },
//       title: {
//           display: false,
//           text: "Chart.js Line Chart",
//       },
//       tooltips: {
//           mode: "index",
//           intersect: false,
//       },
//       hover: {
//           mode: "nearest",
//           intersect: true,
//       },
//       scales: {
//           xAxes: [
//               {
//                   gridLines: {
//                       drawBorder: false,
//                       display: false,
//                   },
//                   ticks: {
//                       display: false,
//                   },
//               },
//           ],
//           yAxes: [
//               {
//                   gridLines: {
//                       display: false,
//                       drawBorder: false,
//                   },
//                   ticks: {
//                       display: false,
//                   },
//               },
//           ],
//       },
//   },
// };
// var config4 = {
//   type: "line",
//   data: {
//       labels: ["January", "February", "March", "April", "May", "June", "July"],
//       datasets: [
//           {
//               label: "My First dataset",
//               backgroundColor: "#fff",
//               borderColor: "#fff",
//               data: [20, 40, 20, 70, 10, 5, 23],
//               fill: false,
//               pointBorderWidth: 100,
//               pointBorderColor: "transparent",
//               pointRadius: 3,
//               pointBackgroundColor: "transparent",
//               pointHoverBackgroundColor: "rgba(63,82,227,1)",
//           },
//       ],
//   },
//   options: {
//       responsive: true,
//       maintainAspectRatio: false,
//       layout: {
//           padding: {
//               left: -10,
//               top: 10,
//           },
//       },
//       legend: {
//           display: false,
//       },
//       title: {
//           display: false,
//           text: "Chart.js Line Chart",
//       },
//       tooltips: {
//           mode: "index",
//           intersect: false,
//       },
//       hover: {
//           mode: "nearest",
//           intersect: true,
//       },
//       scales: {
//           xAxes: [
//               {
//                   gridLines: {
//                       drawBorder: false,
//                       display: false,
//                   },
//                   ticks: {
//                       display: false,
//                   },
//               },
//           ],
//           yAxes: [
//               {
//                   gridLines: {
//                       display: false,
//                       drawBorder: false,
//                   },
//                   ticks: {
//                       display: false,
//                   },
//               },
//           ],
//       },
//   },
// };


// var ctxBar = document.getElementById("bar").getContext("2d");
// var myBar = new Chart(ctxBar, {
//   type: 'bar',
//   data: {
//       labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
//       datasets: [{
//           label: 'Students',
//           backgroundColor: [chartColors.grey, chartColors.grey, chartColors.grey, chartColors.grey, chartColors.info, chartColors.blue, chartColors.grey],
//           data: [
//               5,
//               10,
//               30,
//               40,
//               35,
//               55,
//               15,
//           ]
//       }]
//   },
//   options: {
//       responsive: true,
//       barRoundness: 1,
//       title: {
//           display: true,
//           text: "Students in 2020"
//       },
//       legend: {
//           display: false
//       },
//       scales: {
//           yAxes: [{
//               ticks: {
//                   beginAtZero: true,
//                   suggestedMax: 40 + 20,
//                   padding: 10,
//               },
//               gridLines: {
//                   drawBorder: false,
//               }
//           }],
//           xAxes: [{
//               gridLines: {
//                   display: false,
//                   drawBorder: false
//               }
//           }]
//       }
//   }
// });
// var line = document.getElementById("line").getContext("2d");
// var gradient = line.createLinearGradient(0, 0, 0, 400);
// gradient.addColorStop(0, 'rgba(50, 69, 209,1)');
// gradient.addColorStop(1, 'rgba(265, 177, 249,0)');

// var gradient2 = line.createLinearGradient(0, 0, 0, 400);
// gradient2.addColorStop(0, 'rgba(255, 91, 92,1)');
// gradient2.addColorStop(1, 'rgba(265, 177, 249,0)');

// var myline = new Chart(line, {
//   type: 'line',
//   data: {
//       labels: ['16-07-2018', '17-07-2018', '18-07-2018', '19-07-2018', '20-07-2018', '21-07-2018', '22-07-2018', '23-07-2018', '24-07-2018', '25-07-2018'],
//       datasets: [{
//           label: 'Balance',
//           data: [50, 25, 61, 50, 72, 52, 60, 41, 30, 45],
//           backgroundColor: "rgba(50, 69, 209,.6)",
//           borderWidth: 3,
//           borderColor: 'rgba(63,82,227,1)',
//           pointBorderWidth: 0,
//           pointBorderColor: 'transparent',
//           pointRadius: 3,
//           pointBackgroundColor: 'transparent',
//           pointHoverBackgroundColor: 'rgba(63,82,227,1)',
//       }, {
//           label: 'Balance',
//           data: [20, 35, 45, 75, 37, 86, 45, 65, 25, 53],
//           backgroundColor: "rgba(253, 183, 90,.6)",
//           borderWidth: 3,
//               borderColor: 'rgba(253, 183, 90,.6)',
//           pointBorderWidth: 0,
//           pointBorderColor: 'transparent',
//           pointRadius: 3,
//           pointBackgroundColor: 'transparent',
//           pointHoverBackgroundColor: 'rgba(63,82,227,1)',
//       }]
//   },
//   options: {
//       responsive: true,
//       layout: {
//           padding: {
//               top: 10,
//           },
//       },
//       tooltips: {
//           intersect: false,
//           titleFontFamily: 'Helvetica',
//           titleMarginBottom: 10,
//           xPadding: 10,
//           yPadding: 10,
//           cornerRadius: 3,
//       },
//       legend: {
//           display: true,
//       },
//       scales: {
//           yAxes: [
//               {
//                   gridLines: {
//                       display: true,
//                       drawBorder: true,
//                   },
//                   ticks: {
//                       display: true,
//                   },
//               },
//           ],
//           xAxes: [
//               {
//                   gridLines: {
//                       drawBorder: false,
//                       display: false,
//                   },
//                   ticks: {
//                       display: false,
//                   },
//               },
//           ],
//       },
//   }
// });
//  ------------------------------

let arrow  = document.querySelectorAll(".arrow");
let nav = document.querySelector(".nav11");

for (let i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
       
        let arrowParent = e.target.parentElement.parentElement;
        console.log(arrowParent)
        arrowParent.classList.toggle("show");
    });
}

//------------jQuery
$(document).ready(function(){

    $(".fa-chevron-left").click(function() {
        $(".nav11").toggleClass("close11");
        $(".fa-chevron-left").toggleClass("rotate")
    });

    if ($(window).width() <=700) {
        $(".nav11").addClass("close11");
    }else{
        $(".nav11").removeClass("close11");
    }

    VirtualSelect.init({
        ele: '#example-select',
        options: myOptions,
        search: true,
        searchGroup: false, // Include group title for searching
        searchByStartsWith: false, // Search options by startsWith() method
      });
    
});

// Query-----
$(window).on("load resize ", function() {
    var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
  }).resize();
  //kindo select 




//  charts 





let mychart =document.getElementById('myChart').getContext('2d');


let massPopChart=new Chart(mychart,{
    type:'bar',
    data:{
        labels:['ITG','FINE','BIC'],
        datasets:[{
            label:'اجمالي مبيعات اليوم',
            data:[
                617594,
                317300,
                517120
            ],
            backgroundColor:[
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            borderWidth:1,
            borderColor:'#777',
            hoverBorderWidth:3,
            hoverBorderColor:'#000',
        },
    ]
    },
    options:{
      legend: {
        display: false
      }
    }
    });

    // let fine1 = document.getElementById('fine');
    // let itg2 = document.getElementById('itg');
    // let bic3 = document.getElementById('bic');
    // let total4 = document.getElementById('total');
    // fine1= massPopChart.data.datasets.data[0];
    
$(document).ready(function () {
    $('#fine').html(massPopChart.data.datasets[0].data[0]);
    $('#itg').html(massPopChart.data.datasets[0].data[1]);
    $('#bic').html(massPopChart.data.datasets[0].data[2]);
    $('#total').html(massPopChart.data.datasets[0].data[0] + massPopChart.data.datasets[0].data[1] +massPopChart.data.datasets[0].data[2] )
})
    