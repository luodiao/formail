define(['jquery', 'bootstrap', 'backend', 'addtabs', 'table', 'echarts', 'echarts-theme', 'template','form'], function ($, undefined, Backend, Datatable, Table, Echarts, undefined, Template) {

    var Controller = {
        index: function () {
            require(['bootstrap-datetimepicker'], function () {
                var options = {
                    format: 'YYYY-MM-DD HH:mm:ss',
                    icons: {
                        time: 'fa fa-clock-o',
                        date: 'fa fa-calendar',
                        up: 'fa fa-chevron-up',
                        down: 'fa fa-chevron-down',
                        previous: 'fa fa-chevron-left',
                        next: 'fa fa-chevron-right',
                        today: 'fa fa-history',
                        clear: 'fa fa-trash',
                        close: 'fa fa-remove'
                    },
                    showTodayButton: true,
                    showClose: true
                };
                $('.datetimepicker').parent().css('position', 'relative');
                $('.datetimepicker').datetimepicker(options);
            });
            $('#sen_yj').click(function(){
                var s = $("#start_ed").val();
                var e = $("#end_ed").val();
                var data = {
                    s:s,
                    e:e
                }
                var url = '/admin/Dashboard/getgd'
                $.ajax({
                      type: 'POST',
                      url: url,
                      data: data,
                      success: function(res){
                        if(res.code === 1){
                            $("#zq_count_cy").html(res.msg.zq_count_cy);
                            $("#zq_count_ff").html(res.msg.zq_count_ff);
                            $("#bfb").html(res.msg.bfb + "%");
                        }else{
                            Toastr.error(res.msg)
                        }
                      },
                });
            });
        },
         api: {
            bindevent: function () {
                alert(222)
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };

    return Controller;
});
