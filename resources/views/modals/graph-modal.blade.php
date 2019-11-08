<div style="" class="modal fade in" id="graph-modal" tabindex="-1" role="dialog" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div  class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div style="margin-top: -4.5%;" class="modal-body modal-body-sub_agile">
                <div class="modal_body_left modal_body_left1">
                    
                    <div class="container">
                        <div class="row my-3">
                            <div class="col">
                                <h4 id="store_name"></h4>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <canvas id="chLine" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        $('document').ready(function(){
                            $.ajaxSetup({
                            headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $('.store').on('click', function(){
                                $prod_id = $('#prod_id').val();
                                $store_id = $(this).attr("id");
                                $prod_name = $('#product_name').text();
                                $store_name = "Price changes of '"
                                                +$prod_name+"' in "
                                                +$(this).text();

                                $.ajax({
                                    url: "/graph_data/graph/" + $prod_id + "/" + $store_id,
                                    method: "get",
                                    success:function(data)
                                    {
                                        var data_dates = data.dates;
                                        var monthNames = [
                                                "January", "February", "March",
                                                "April", "May", "June", "July",
                                                "August", "September", "October",
                                                "November", "December"
                                            ];
                                        var data_date   = new Date(data_dates);
                                        var dates       = [];
                                        var day         = data_date.getDate();
                                        var month       = data_date.getMonth();
                                        var year        = data_date.getFullYear();
                                        var dates = day + ' ' + monthNames[month] + ' ' + year;

                                        $('#store_name').text($store_name);

                                        var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

                                        /* large line chart */
                                        var chLine = document.getElementById("chLine");
                                       
                                        var chartData = {
                                            labels: data.dates,
                                            datasets: [{
                                                data: data.prices,
                                                backgroundColor: 'transparent',
                                                borderColor: colors[0],
                                                borderWidth: 2,
                                                pointBackgroundColor: colors[1]
                                            }]
                                        };

                                        if (chLine) {
                                            new Chart(chLine, {
                                            type: 'line',
                                            data: chartData,
                                            options: {
                                                scales: {
                                                yAxes: [{
                                                    ticks: {
                                                    beginAtZero: false
                                                    }
                                                }]
                                                },
                                                legend: {
                                                display: false
                                                }
                                            }
                                            });
                                        }
                                    }
                                });
                            });
                    
                        });
                    
                    </script>
                    {{-- {!! $chart->render() !!} --}}
                </div>
            </div>
        </div>
        <!-- //Modal content-->
    </div>
</div>
<script src="/js/import/jquery-library.js"></script>
<script src="/css/wsis/js/jquery-3.3.1.min.js"></script>
<script src="/js/import/sweetalert.min.js"></script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

<!-- toaster notification -->
{{-- <script type="text/javascript" src="/js/import/toastr.min.js"></script> --}}
<!-- toaster notification -->
{{-- <link rel="stylesheet" type="text/css" href="/js/import/toastr.min.css"/> --}}


<script>
    
</script>