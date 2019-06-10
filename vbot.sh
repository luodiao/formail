#!/bin/sh
#
#author luodiao
#
#项目的绝对路径
dir=$1

#用户id
userid=$2

#端口号
port=$3

cd $dir
nohup php think Vbot $userid $port 1>vbot.log 2>vbot_error.log &

