<?php
/*
 * Custom CSS
 */
?>
/* timezone select */
.timezoneSelectable {
	margin: 15px 0 0 0;
}
/* profile widget */
.widgetBlock.blockEvents .eventItem {
	border-bottom: 1px solid <?php echo $vars['css']['base-border-color']; ?>;
	padding: 9px 12px;
	position: relative;
	width: 260px;
}
.widgetBlock.blockEvents .eventIcon {
	margin: 0 15px 0 0;
}
.widgetBlock.blockEvents .eventIcon,
.widgetBlock.blockEvents .eventIcon a,
.widgetBlock.blockEvents .eventIcon img {
	width: 40px;
	height: 40px;
}
.widgetBlock.blockEvents .eventInfo {
	width: 205px;
	font-size: 11px;
	line-height: 13px;
	margin: 1px 0 0 0;
}
.widgetBlock.blockEvents .eventInfo a.aTitle {
	font-size: 12px;
	line-height: 14px;
	display: block;
}
.widgetBlock.blockEvents .eventInfo p {
	font-size: 11px;
	line-height: 13px;
}
.widgetBlock.blockEvents .eventIcon,
.widgetBlock.blockEvents .eventInfo {
	position: relative;
	z-index: 1;
}
/* for closed events (does this work?) */
.eventState,
.eventState.es {
	position: absolute;
	z-index: 12;
	/*right: -13px;*/
    top: -7px;
	left: -5px;
	width: 61px;
	height: 61px;
}
.eventState.en {
	top: -10px;
	left: -8px;
}
.eventsBox .elgg-item .elgg-image .eventState,
.eventsBox .elgg-item .elgg-image .eventState.es{
	left: -1px;
}
.eventsBox .elgg-item .elgg-image .eventState.en {
	left: -3px;
}
/*.eventWrapper .elgg-item .eventState {
    right: -5px;
    top: -13px;
    z-index: 1;
}*/
.eventsBox .elgg-item .elgg-image,
.eventWrapper .elgg-item .elgg-image,
.elgg-widget-instance-event .elgg-item .elgg-image {
	position: relative;
}
/*.ktFormContInner .eventState {
    right: -2px;
    top: -15px;
    z-index: 12;
}*/
.ktFormContEvent .ktFormContIcon {
	position: relative;
}
.ktFormContEvent .ktFormContIcon .eventState.es {
	top: 0;
	left: 0;
}
.ktFormContEvent .ktFormContIcon .eventState.en {
	top: -4px;
	left: -2px;
}
.eventState.eventStateClosed,
.eventState.eventStateClosed.en {
	background: url(<?php echo $vars['url']; ?>mod/events/graphics/img-event-cancel.png) 0 0 no-repeat;
}
.eventState.eventStateClosed.es {
	background: url(<?php echo $vars['url']; ?>mod/events/graphics/img-event-cancel-es.png) 0 0 no-repeat;
}
/* edit form */
.ktFormWrapperGroup.bADateGroup.inline .ktFormWrapper .frmField,
.ktFormWrapperGroup.bEDateGroup.inline  .ktFormWrapper .frmField {	/* make select unfloated */
    float: none;
    width: auto;
}
.ktFormWrapper .elgg-input-date[type="text"] {	/* add a nice calendar icon */
    background-image: url(<?php echo $vars['url']; ?>mod/events/graphics/img-calendar.png);
    background-position:  97% 50%;
    background-repeat: no-repeat;
}
/* invite users */
.ui-autocomplete-events {
	max-width: 403px;
}
#formEventsInvite .cThis {
	display: none;
}
#formEventsInvite label {
	float: left;
	/*width: 78px;*/
	text-align: left;
	margin: 7px 15px 10px 0;
}
#formEventsInvite.elgg-form fieldset > div {
	max-width: none;
}
#formEventsInvite .sentToSearchWrapper {
	float: left;
	width: 405px;
	margin: 0 15px 0 0;
}
#formEventsInvite .sentToSearchWrapper input[type="text"] {
	margin: 0;
}
#formEventsInvite input[type="submit"] {
	float: left;
	margin: 2px 0 0 0;
}
/* guests listing on event's profile */
.guestsEventListing {
	min-height: 44px;
	padding: 8px;
}
.guestsEventListing .itemGuest {
	margin-right: 5px;
}
.ktFormContEvent .elgg-tabs {
	margin-bottom: 10px;
}
/* calendar section */
.elgg-main .attendYesNo ul {
	list-style: none;
}

.ktFormButtonsCont .elgg-button-assist {
	
}
.eventsBox .elgg-list .elgg-body h3 {
	border-bottom: none;
}
#user_timezone_group {
    margin-bottom: 10px;
}
.elgg-form-usersettings-save #user_timezone {
    margin-left: 27.3237%;
}