define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'yyzn_orders/index' + location.search,
                    add_url: 'yyzn_orders/add',
                    edit_url: 'yyzn_orders/edit',
                    // del_url: 'work/del',
                    // multi_url: 'work/multi',
                    table: 'yyzn_orders',
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
                        // {field: 'id', title: __('Id'),operate:false},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'aid', title: __('A_tite'),searchList: {"1":__('A_tite 1'),"2":__('A_tite 2'),"3":__('A_tite 3'),"4":__('A_tite 4'),"5":__('A_tite 5'),"6":__('A_tite 6'),"7":__('A_tite 7')}, formatter: Table.api.formatter.normal},
                        {field: 'pay_type', title: __('Pay_type'),searchList: {"0":__('Pay_type 0'),"1":__('Pay_type 1'),"2":__('Pay_type 2'),"3":__('Pay_type 3'),"4":__('Pay_type 4'),"5":__('Pay_type 5'),"7":__('Pay_type 7'),"6":__('Pay_type 6')}, formatter: Table.api.formatter.normal},
                        {field: 'total_price', title: __('Total_price')},
                        {field: 'num', title: __('Num')},
                        {field: 'num_type', title: __('Num_type'),searchList: {"0":__('Num_type 0'),"1":__('Num_type 1'),"2":__('Num_type 2')}, formatter: Table.api.formatter.normal},
                        {field: 'is_code', title: __('Is_code'),searchList: {"0":__('Is_code 0'),"1":__('Is_code 1')}, formatter: Table.api.formatter.normal},
                        {field: 'code_price', title: __('Code_price'),operate:false},
                        {field: 'wx_id', title: __('Wx_id')},
                        {field: 'wechat_name', title: __('Wechat_name'),operate:false},
                        // {field: 'fk_id', title: __('Fk_id'),operate:false},
                        {field: 'user_name', title: __('User_name'),operate:false},
                        {field: 'admin_text', title: __('Admin_text'),operate:false},

                        // {field: 'wx_id_text', title: __('Wechat_name')},
                        // {field: 'wechat_type', title: __('Wechat_type'), searchList: {"1":__('Wechat_type 1'),"2":__('Wechat_type 2'),"3":__('Wechat_type 3')}, formatter: Table.api.formatter.normal},
                        // {field: 'industry_type', title: __('Industry_type'), searchList: {"1":__('Industry_type 1'),"2":__('Industry_type 2'),"3":__('Industry_type 3'),"4":__('Industry_type 4'),"5":__('Industry_type 5'),"6":__('Industry_type 6'),"7":__('Industry_type 7'),"8":__('Industry_type 8'),"9":__('Industry_type 9'),"10":__('Industry_type 10'),"11":__('Industry_type 11'),"12":__('Industry_type 12')}, formatter: Table.api.formatter.normal},
                        // {field: 'project', title: __('Project'), searchList: {"1":__('Project 1'),"2":__('Project 2'),"3":__('Project 3'),"98":__('Project 98'),"99":__('Project 99')}, formatter: Table.api.formatter.normal},
                        // {field: 'admin_id', title: __('Admin_id')},
                        // {field: 'admin_text', title: __('Admin_text'),operate:false},
                        // {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        // {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        // {field: 'level', title: __('Level'), searchList: {"5":__('Level 5'),"4":__('Level 4'),"3":__('Level 3'),"2":__('Level 2'),"1":__('Level 1')}, formatter: Table.api.formatter.normal},
                        // {field: 'frist_time', title: __('Frist_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        // {field: 'callback_time', title: __('Callback_time'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {
                            field: 'operate', 
                            title: __('Operate'), 
                            table: table, 
                           
                            events: Table.api.events.operate, 
                            formatter: Table.api.formatter.operate
                        }
                    ]
                ],
                responseHandler: function (res) {
                    console.log(res.count)
                    $("#total_price").html("￥"+res.total_price);
                    return res;

                    
                }
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
        setok: function () {
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