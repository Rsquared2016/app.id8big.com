<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
.sync-files-gcalendar {
	padding: 20px 0;
}
.sync-files-gcalendar.ajax-loading {
	background: url(<?php echo $vars['url']; ?>/mod/gcalendar/graphics/ajax-loader.gif) no-repeat 100% 20px;
}
.elgg-form-gcalendar-import {
    padding: 10px;
    width: 500px;
}
.import-gcalendar-wrapper h2 {
    border-bottom: 1px solid #DFDFDF;
    margin-top: 7px;
    margin-bottom: 0;
}
/* List Calendars Google */
.import-gcalendar-wrapper .loading-wrapper {
    background-color: transparent;
}
.import-gcalendar-wrapper p.list-gcalendar-note {
    padding: 15px 0 0 0;
    margin-bottom: 5px;
}
table.list-gcalendar-google {
    width: 100%;
}
table.list-gcalendar-google tr {
    line-height: 40px;
    border-bottom: 1px solid #DFDFDF;
}
table.list-gcalendar-google thead tr th {
    text-align: left;
}
table.list-gcalendar-google tr th.name-item,
table.list-gcalendar-google tr td.name-item {
    width: 100%;
}
table.list-gcalendar-google tbody tr {
    cursor: pointer;
}
.list-gcalendar-items {
    overflow-x: hidden;
    overflow-y: auto;
    max-height: 300px;
}
table.list-gcalendar-google tr th,
table.list-gcalendar-google tr td {
    padding: 0;
}
table.list-gcalendar-google tbody tr:hover {
    background-color: #FFF;
}
.gcalendars-ul {
    margin-top: 10px;
}
.gcalendars-ul li label {
    line-height: 20px;
    cursor: pointer;
}
.gcalendars-ul li label.ajax-loading {
    background: url(<?php echo $vars['url']; ?>/mod/gcalendar/graphics/ajax-loader-bar.gif) no-repeat 0 50%;
}
.gcalendars-ul li label {
    float: left;
    padding: 0 6px 0 0;
    width: 83%;
}