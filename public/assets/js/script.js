// /*
//  * Atrana
//  */



// /*
//  * this is the javascipt for the Atrana template.
//  * if you want to change, please create a new javascript, 
//  * because if one is missing in the original Atrana javascript it will fall apart
//  */


// preloader
$(document).ready(function () {
	setInterval(function () {
		$(".loader").hide();
		$(".loader-overlay").hide();
	}, 700);
// Dashboard
    $('#fine').html(massPopChart.data.datasets[0].data[0]);
    $('#itg').html(massPopChart.data.datasets[0].data[1]);
    $('#bic').html(massPopChart.data.datasets[0].data[2]);
    $('#total').html(massPopChart.data.datasets[0].data[0] + massPopChart.data.datasets[0].data[1] +massPopChart.data.datasets[0].data[2] )
// poscode
    $('#posCode').keydown(function () {
        $('#posCode').val().replace(" ","");
        alert( $('#posCode').val());
    })

    // 

   

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

    //   
    $(window).on("load resize ", function() {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({'padding-right':scrollWidth});
      }).resize();
});

$(".fa-chevron-left").click(function() {
    $(".nav11").toggleClass("close11");
    $(".fa-chevron-left").toggleClass("rotate")
});
// ======================
let arrow  = document.querySelectorAll(".arrow");
let nav = document.querySelector(".nav11");

for (let i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
       
        let arrowParent = e.target.parentElement.parentElement;
        console.log(arrowParent)
        arrowParent.classList.toggle("show");
    });
}



document.getElementById("FileAttachment").onchange = function () {
    document.getElementById("fileuploadurl").value = this.value.replace(/C:\\fakepath\\/i, '');
};

let mychart =document.getElementById('myChart');
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
    options: { plugins: { legend: { display: false },  responsive: true,} }
    });
    

