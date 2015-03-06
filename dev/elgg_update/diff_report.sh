#!/bin/bash

#Params
#$1 Elgg base version to compare
#$2 Elgg project to campare

#Report Filename
report_filename="diff_report.txt"

if [ $# != 2 ]; then
	echo "Debes ingresar param1[Elgg base] param2[Elgg project]"
	exit
fi

#Titulo
echo "Comparacion entre $1 y $2" > $report_filename
echo "" >> $report_filename

#Report 1
echo "Que archivos fueron modificados en $2 fuera de mod." >> $report_filename
diff -qrB -x mod $1 $2 | sort | grep differ | grep -v "\.DS_Store\|\.project\|\.settings\|\.svn" >> $report_filename
#Saltos de linea. :S
echo "" >> $report_filename
echo "" >> $report_filename


#Report 2
echo "Que archivos fueron modificados en $2 dentro de mod." >> $report_filename
diff -qrB $1/mod $2/mod | sort | grep differ | grep -v "\.DS_Store\|\.project\|\.settings\|\.svn" >> $report_filename
#Saltos de linea. :S
echo "" >> $report_filename
echo "" >> $report_filename


#Report 3
echo "Que plugins de 3ros hay en $2 . (Para detectar posibles problemas)" >> $report_filename
diff -qrB $1/mod $2/mod | sort | grep "Only in $2" | grep -v "\.DS_Store\|\.project\|\.settings\|\.svn" >> $report_filename
#Saltos de linea. :S
echo "" >> $report_filename
echo "" >> $report_filename



#Report 4
echo "Diferenecias entre htaccess_dist de $1 y .htaccess de en $2." >> $report_filename
diff  $1/htaccess_dist $2/.htaccess >> $report_filename
#Saltos de linea. :S
echo "" >> $report_filename
echo "" >> $report_filename


echo "Puedes visualizar el reporte en $report_filename"
