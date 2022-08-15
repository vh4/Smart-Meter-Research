
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<!-- Js Chart for Verify data -->
<script>
//verify and not verify
var total_alat_jadi_yang_sudah_ada_user = '<?php echo $total_alat_jadi_yang_sudah_ada_user ?>'
var total_alat_jadi_yang_belum_ada_user = '<?php echo $total_alat_jadi_yang_belum_ada_user ?>'
// chart js
var xValues = ["Ada", "Belum"];
var yValues = [total_alat_jadi_yang_sudah_ada_user, total_alat_jadi_yang_belum_ada_user];
var barColors = [
    'rgb(255, 99, 132)',
    'rgb(54, 162, 235)',
];
new Chart("myChart", {
    type: "doughnut",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: barColors,
            data: yValues
        }]
    },
    options: {
        title: {
            display: true,
            text: "Chart of the number of tools that have been used by users or not"
        },
        responsive: true,
        legend: {
            position: 'right',
            labels: {
                fontColor: "black",
                padding: 20,
            }
        }
    }
});
// mobile table data js
$(document).ready(function() {

    var table = $('#mobile').DataTable({
            responsive: true
        })
        .responsive.recalc();
});
</script>
<!-- End Js Chart for Verify data -->


<!--  Chart for Grafik data prediksi -->
<script>
$(document).ready(function() {

var table = $('#datatabel').DataTable({
        responsive: true,
        pageLength: 5,

    })
    .columns.adjust()
    .responsive.recalc();
});

// $hasil[0] => [[]] menjadi []

var serialnumbergrafik = '<?php echo $serialnumber ?>'

var minggu = document.getElementById('minggu')

function ajaxJquryURL(values, title){

    $.ajax({
    url:"http://127.0.0.1:8000/api/realtime/data/grafik/" + serialnumbergrafik + "/" + values,
    method:"GET",
    dataType:"json",
    success: (hasil) => {
        if(title == "actual"){
            actual = JSON.parse(hasil.data_actual[0]) //json parse dari string menjadi array
            grafikHighchart(actual)
        }else if(title == "prediction"){
            actual = JSON.parse(hasil.data_actual[0]) //json parse dari string menjadi array
            lstm = JSON.parse(hasil.data_prediksi[0]) //json parse dari string menjadi array
            grafikHighchart(actual, lstm)
        }

    }

})

}

ajaxJquryURL(24, title="actual")
$("#week").on('click', ()=>{
    ajaxJquryURL(168, title="actual")
})

$("#day").on('click', ()=>{
    ajaxJquryURL(24, title="actual")
})

$("#all").on('click', ()=>{
    ajaxJquryURL(1000000000, title="actual")
})

$("#prediction").on('click', ()=>{
    ajaxJquryURL(4, title="prediction")
})


function grafikHighchart(actual, lstm=null){
    Highcharts.chart('container', {
            chart: {
                zoomType: 'x',
                type: 'areaspline',
                //inverted: true

            },

            title: {
                text: null
            },
            subtitle: {
                text: 'click and drag in a specific area to zoom in',
                verticalAlign: 'bottom',
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: '',
                }
            },
            legend: {
                enabled: false,
            },
            colors: ['white', "white"],
            plotOptions: {
                areaspline: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 5,
                    states: {
                        hover: {
                            lineWidth:5
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                name: "prediction",
                color:"#bfdbfe",
                data: lstm
            }, {
                name: "",
                color:"#bfdbfe",
                data: actual
            }],
        });
}

function RealtimDataListrik() {
var serialnumber = '<?php echo $serialnumber ?>'

var days = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

$.ajax({
    url: 'http://127.0.0.1:8000/api/realtime/data/' + serialnumber,
    dataType: 'json',
    success: function(data) {
        //mengambil data perkiraan sisa pulsa habis akan habis
        $('#realtime_perkiraan_pulsa_habis').text(data.perkiraan_pulsa_habis)
        $('#rata_rata_perhari').html('-')

        //deskripsi notifikasi pada perkiraan pulsa listrik akan habis. jika masih minggu, maka tidak ditampilkan
        $('#notifikasi_pulsa_akan_habis').html(data.notif_electricity_will_run_out_in)


        //deskripsi pada rata-rata pemakaian. mengambil data pemakaian hari ini berfungsi untuk perbandingan rata2 dengan pemakaian hari ini
        $('#pemakaian_hari_ini').html("Today electricity usage " +  data.pemakaian_hari_ini + " kWh")

        //deskripsi mengambil data pemakaian sebelumnya
        $("#batas_waktu_prediksi").html("Previous day's electricity usage " + data.pemakaian_hari_sebelumnya)


        //deskripsi update terakhir sisa pulsa listrik
        var d_pulsa = new Date(data.waktu_terakhir_update_sisa_pulsa);
        d_pulsa = days[d_pulsa.getDay()] + ', ' + d_pulsa.getDay() +  ' ' + months[d_pulsa.getMonth()] + ' ' + d_pulsa.getHours() + ':' + d_pulsa.getMinutes();
        $("#update_terakhir_sisa_pulsa").html('Last updated at ' + d_pulsa)



        //menampilkan data sisa pulsa listrik sekarang
        if(data.data_listrik.sisa_pulsa !== null){
            $('#realtime_sisa_pulsa').html(`<i class="las la-bolt"></i>` + data.data_listrik.sisa_pulsa + ' kWh')
        }

        //menampilkan data prediksi satu hari kedepan
        if(data.prediksi_satu_hari_kedepan !== "0.00"){
            $('#prediksi_satu_hari_kedepan').html(`<i class="las la-bolt"></i>` + data.prediksi_satu_hari_kedepan + ' kWh')
        }

        //menampilkan data rata-rata
        if(data.rata_rata !== "0.00"){
            $('#rata_rata_perhari').html(`<i class="las la-bolt"></i>` + data.rata_rata + ' kWh')
        }

        //trigger untuk notifikasi token.
        if(data.data_token.trigger == 1){
            $('#notifikasi-token').html(`<img src="/img/loading.gif" width="50px" alt="">`)
        }
        if(data.data_token.trigger == 2){
            $('#notifikasi-token').html(`<a href="/notifikasi/reset/` + serialnumber + `" class="flex space-x-2 text-red-500"><i class="las la-times-circle text-red-400 text-2xl items-center"></i><p class="hidden md:block text-red-400">Failure, click for refresh data</p></a>`)
        }
        if(data.data_token.trigger == 3){
            $('#notifikasi-token').html(`<a href="/notifikasi/reset/` + serialnumber + `" class="flex space-x-2 text-green-500"><i class="las la-check-circle text-green-400 text-2xl items-center"></i><p class="hidden md:block text-green-400">Successfully, click for refresh data</p></a>`)
        }
        if(data.data_token.trigger == 0){
            $('#notifikasi-token').html(``)
        }
    },
});
}

setInterval(RealtimDataListrik, 3000);
</script>
<!--  End Chart for Grafik data prediksi -->
<!--  End toggle for hidden show data-->
