define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'work_ok/index' + location.search,
                    add_url: 'work_ok/add',
                    edit_url: 'work_ok/edit',
                    del_url: 'work_ok/del',
                    multi_url: 'work_ok/multi',
                    table: 'work_ok',
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
                        {field: 'id', title: __('Id'),operate:false},
                        {field: 'wechat_nickname', title: __('Wechat_nickname')},
                        {field: 'mobile', title: __('Mobile')},
                        {field: 'wechat_name', title: __('Wechat_name')},
                        {field: 'wechat_type', title: __('Wechat_type'), searchList: {"1":__('Wechat_type 1'),"2":__('Wechat_type 2'),"3":__('Wechat_type 3')}, formatter: Table.api.formatter.normal},
                        {field: 'industry_type', title: __('Industry_type'), searchList: {"1":__('Industry_type 1'),"2":__('Industry_type 2')}, formatter: Table.api.formatter.normal},
                        {field: 'project', title: __('Project'), searchList: {"1":__('Project 1'),"2":__('Project 2'),"3":__('Project 3'),"98":__('Project 98'),"99":__('Project 99')}, formatter: Table.api.formatter.normal},
                        {field: 'price', title: __('Price'), operate:'BETWEEN'},
                        {field: 'admin_id', title: __('Admin_id')},
                        {field: 'admin_text', title: __('Admin_text'),operate:false},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'length', title: __('Length'),operate:false},
                        {field: 'cashback_price', title: __('Cashback_price'), operate:'BETWEEN'},
                        {field: 'income_price', title: __('Income_price'), operate:'BETWEEN'},
                        {field: 'open_time', title: __('Open_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'end_time', title: __('End_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'number', title: __('Number')},
                        {field: 'status', title: __('Status'), searchList: {"1":__('Status 1'),"2":__('Status 2'),"3":__('Status 3')}, formatter: Table.api.formatter.status},
                        {field: 'work_id', title: __('Work_id')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        yeji:function(){
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'work_ok/yeji' + location.search,
                    table: 'work_ok',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                search:false,
                commonSearch: true,
                columns: [
                    [
                        {field: 'id', title: __('Id'),operate:false},
                        {field: 'wechat_nickname', title: __('Wechat_nickname'),operate:false},
                        {field: 'mobile', title: __('Mobile'),operate:false},
                        {field: 'wechat_name', title: __('Wechat_name')},
                        {field: 'wechat_type', title: __('Wechat_type'), searchList: {"1":__('Wechat_type 1'),"2":__('Wechat_type 2'),"3":__('Wechat_type 3')}, formatter: Table.api.formatter.normal},
                        {field: 'industry_type', title: __('Industry_type'),operate:false, searchList: {"1":__('Industry_type 1'),"2":__('Industry_type 2')}, formatter: Table.api.formatter.normal},
                        {field: 'project', title: __('Project'), searchList: {"1":__('Project 1'),"2":__('Project 2'),"3":__('Project 3'),"98":__('Project 98'),"99":__('Project 99')}, formatter: Table.api.formatter.normal},
                        {field: 'price', title: __('Price'), operate:'BETWEEN',operate:false},
                        {field: 'length', title: __('Length'),operate:false},
                        {field: 'admin_id', title: __('Admin_id')},
                        {field: 'admin_text', title: __('Admin_text'),operate:false},
                        {field: 'open_time', title: __('Open_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'end_time', title: __('End_time'),operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                    ]
                ],
                responseHandler: function (res) {
                    console.log(res.count)
                    $("#yeji_w").html("￥"+res.count.w);
                    $("#yeji_m").html("￥"+res.count.m);
                    $("#yeji_j").html("￥"+res.count.j);
                    $("#ok_cj").html(res.count.ok_cj);
                    $("#no_cj").html(res.count.no_cj);
                    $("#cj_bfl").html(res.count.cj_bfl+"%");
                    return res;
                }
                // data:function(res){
                //     console.log(res)
                // }
            });
            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        yejiing:function(){
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'work_ok/yejiing' + location.search,
                    table: 'work_ok',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                search:false,
                commonSearch: true,
                columns: [
                    [
                        {field: 'id', title: __('Id'),operate:false},
                        {field: 'wechat_nickname', title: __('Wechat_nickname'),operate:false},
                        {field: 'mobile', title: __('Mobile'),operate:false},
                        {field: 'wechat_name', title: __('Wechat_name')},
                        {field: 'wechat_type', title: __('Wechat_type'), searchList: {"1":__('Wechat_type 1'),"2":__('Wechat_type 2'),"3":__('Wechat_type 3')}, formatter: Table.api.formatter.normal},
                        {field: 'industry_type', title: __('Industry_type'),operate:false, searchList: {"1":__('Industry_type 1'),"2":__('Industry_type 2')}, formatter: Table.api.formatter.normal},
                        {field: 'project', title: __('Project'), searchList: {"1":__('Project 1'),"2":__('Project 2'),"3":__('Project 3'),"98":__('Project 98'),"99":__('Project 99')}, formatter: Table.api.formatter.normal},
                        {field: 'price', title: __('Price'), operate:'BETWEEN',operate:false},
                        {field: 'length', title: __('Length'),operate:false},
                        {field: 'admin_text', title: __('Admin_text'),operate:false},
                        {field: 'open_time', title: __('Open_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'end_time', title: __('End_time'),operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                    ]
                ]
                // data:function(res){
                //     console.log(res)
                // }
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
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});