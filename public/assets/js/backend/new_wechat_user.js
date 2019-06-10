define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'new_wechat_user/index' + location.search,
                    add_url: 'new_wechat_user/add',
                    edit_url: 'new_wechat_user/edit',
                    del_url: 'new_wechat_user/del',
                    multi_url: 'new_wechat_user/multi',
                    table: 'new_wechat_user',
                    runwechat_url: 'new_wechat_user/add',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'uuid', title: __('Uuid')},
                        {field: 'nickname', title: __('Nickname')},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'port', title: __('Port')},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2'),"3":__('Status 3')}, formatter: Table.api.formatter.status},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'uin', title: __('Uin')},
                        {field: 'username', title: __('Username')},
                        {field: 'qrcodetime', title: __('Qrcodetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'status', title: "运行状态", operate:'RANGE', addclass:'datetimerange', formatter: function(value,row,index){
                            if(value == "0") {  
                                var a = '<span style="color:#00ff00">-</span>';  
                            }else if(value == "1"){  
                                var a = '<a href="javascript:;" class="btn btn-xs btn-success qrcode" tag-id="'+row.id+'">开始扫码</span>';
                            }else if(value == "2") {  
                                var a = '<span style="color:#FF0000">-</span>';  
                            }else{  
                                var a = '<a href="javascript:;" class="btn btn-xs btn-success re-vbot" tag-id="'+row.id+'">重新执行</span>';
                            }  
                            return a;
                        }},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        runwechat: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});

//获取二维码
$(document).on('click','.qrcode',function(){
    var id = $(this).attr('tag-id');

    Fast.api.open("/admin/new_wechat_user/checkeservice?id="+id, "扫一扫", {
        callback:function(value){
            //在这里可以接收弹出层中使用`Fast.api.close(data)`进行回传数据
        }
    });
});


//重新启动
$(document).on('click','.re-vbot',function(){
    var id = $(this).attr('tag-id');
    Fast.api.ajax({
       url:'new_wechat_user/revbox',
       data:{id:id}
    }, function(data, ret){
       //成功的回调
       $(".btn-refresh").trigger("click");
       return false;
    }, function(data, ret){
       //失败的回调
       $(".btn-refresh").trigger("click");
       return false;
    });
});


//设置定时刷新 
setInterval(function() {
    $(".btn-refresh").trigger("click");
}, 8000);
