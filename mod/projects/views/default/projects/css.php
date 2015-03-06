<?php
/**
 * Elgg Projects css
 *
 * @package projects
 */

?>
.projects-profile > .elgg-image {
	margin-right: 10px;
}
.projects-profile img {
	width: 100%;
	height: auto;
}
.projects-stats {
	background: #eeeeee;
	padding: 5px;
	margin-top: 10px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}
.projects-stats p,
.elgg-main .projects-stats ul {
    margin: 0;
}
.projects-profile-fields .odd,
.projects-profile-fields .even {
	background: #f4f4f4;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	padding: 2px 4px;
	margin-bottom: 7px;
}
.projects-profile-fields .elgg-output {
	margin: 0;
}
#projects-tools > li {
	width: 48%;
	min-height: 200px;
	margin-bottom: 40px;
}
#projects-tools > li:nth-child(odd) {
	margin-right: 4%;
}
.projects-widget-viewall {
	float: right;
	font-size: 85%;
}
.projects-latest-reply {
	float: right;
}
.elgg-menu-projects-my-status li a {
	display: block;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	background-color: white;
	margin: 3px 0 5px 0;
	padding: 2px 4px 2px 8px;
}
.elgg-menu-projects-my-status li a:hover {
	background-color: #0054A7;
	color: white;
	text-decoration: none;
}
.elgg-menu-projects-my-status li.elgg-state-selected > a {
	background-color: #4690D6;
	color: white;
}
.projectLabel span.required {
	margin: 0 0 0 5px;
}
/* project gallery */
.project-gallery-item {
    text-align: center;
    width: 145px;
}
.project-gallery-item h3 {
    height: 29px;
}
.bodyProjects .elgg-main.elgg-body.flN ul.elgg-gallery {
    overflow: visible;
    margin: 0;
}
.bodyProjects .elgg-main.elgg-body.flN ul.elgg-gallery:after {
    clear: both;
    content: "";
    display: table;
    height: 0;
    visibility: hidden;
}
.bodyProjects .elgg-main.elgg-body.flN ul.elgg-gallery:before {
    content: "";
    display: table;
}
.bodyProjects .elgg-main.elgg-body.flN ul.elgg-gallery li.elgg-item,
.bodyProjects .elgg-main.elgg-body.flN .project-gallery-item {
	overflow: hidden;
	float: left;
    margin-right: 12px !important;
    margin-bottom: 12px !important;
    width: 150px;
    height: 215px;
    padding: 0;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
}
.bodyProjects .elgg-main.elgg-body.flN ul.elgg-gallery li.elgg-item:nth-child(4n),
.bodyProjects .elgg-main.elgg-body.flN .project-gallery-item:nth-child(4n) {
    margin-right: 0!important;
}
.bodyProjects .elgg-main.elgg-body.flN .project-gallery-item {
	text-align: left;
	width: 100%;
}
li.elgg-item .project-gallery-item {
    width: auto;
}
.bodyProjects .elgg-main.elgg-body.flN .project-gallery-item h3 {
	font-size: 12px;
	line-height: 15px;
	height: 15px;
	font-weight: bold;
	text-overflow: ellipsis;
	-o-text-overflow: ellipsis;
	-webkit-text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden;
	margin: 0 0 10px;
}
.bodyProjects .elgg-main.elgg-body.flN .project-gallery-item > a {
	display: block;
	text-align: center;
	height: 145px;
    width: 100%;
	margin: 0 0 5px;
	overflow: hidden;
}
.bodyProjects .elgg-main.elgg-body.flN .project-gallery-item > a,
.bodyProjects .elgg-main.elgg-body.flN .elgg-item .project-gallery-item > a img {
	max-height: 100%;
	max-width: 100%;
}
.bodyProjects .elgg-main.elgg-body.flN .elgg-item .project-gallery-item > a img {
	width: 100%;
	height: auto;
	display: block;
}
.bodyProjects .elgg-main.elgg-body.flN .projectGalleryTitle,
.bodyProjects .elgg-main.elgg-body.flN .projectGalleryMoreInfo {
    margin: 0 12px 5px;
}
.bodyProjects .elgg-main.elgg-body.flN .projectGalleryTitle {
    padding: 0 0 8px;
	height: 26px;
    overflow: hidden;
    border-bottom: 1px solid #C7C7C7;
}
.bodyProjects .elgg-main.elgg-body.flN .projectGalleryTitle a {
    font-size: 12px;
	line-height: 1.2;
    display: block;
}
.bodyProjects .elgg-main.elgg-body.flN .projectGalleryMoreInfo {
    margin-bottom: 0;
    overflow: hidden;
}
.bodyProjects .elgg-main.elgg-body.flN .projectGalleryMoreInfo > span {
    float: left;
    margin: 0;
}
.bodyProjects .elgg-main.elgg-body.flN .projectGalleryMoreInfo > span,
.bodyProjects .elgg-main.elgg-body.flN .projectGalleryMoreInfo > span > a {
    font-size: 11px;
    line-height: 22px;
    display: block;
    height: 20px;
    text-decoration: none;
    color: #555;
    overflow: hidden;
    width: 42px;
    text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
    -webkit-text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
.bodyProjects .elgg-main.elgg-body.flN .projectGalleryMoreInfo > span > a > span {
    display: block;
    float: left;
    height: 20px;
    margin: 0 3px 0 0;
    width: 18px;
}
.bodyProjects .elgg-main.elgg-body.flN .projectGalleryMoreInfo > span.favCounter {
    float: right;
    margin: 0;
}
.projectGalleryMoreInfo span.discussionCounter .elgg-icon {
    background: url('<?php echo PROJECTS_GRAPHICS; ?>ico-proj-1.png') 0 50% no-repeat;
}
.projectGalleryMoreInfo span.membersCounter .elgg-icon {
    background: url('<?php echo PROJECTS_GRAPHICS; ?>ico-proj-2.png') 0 50% no-repeat;
}
.projectGalleryMoreInfo span.favCounter .elgg-icon {
    background: url('<?php echo PROJECTS_GRAPHICS; ?>ico-proj-3.png') 0 3px no-repeat;
}
.bodyProjects .elgg-form-projects-invite {
	min-height: 700px;
}
.bodyProjects .elgg-main.elgg-body.flN .elgg-item .isMarkedAsFavorite {
    display: none;
}
/* projects' profile */
.project-profile-layout .project-profile-left-col {
	float: left;
	width: 65%;
}
.project-profile-layout .project-profile-right-col {
	float: right;
	margin-left: 10px;
	width: 33%;
}
.projects-profile-box {
	border: 1px solid #d0d0d0;
	margin-bottom: 10px;
}
.projects-profile-box h3 {
	border-bottom: 1px solid #d0d0d0;
}
.projects-profile-box.projects-profile,
.projects-profile-box h3,
.projects-profile-box .elgg-module {
	padding: 10px;
}
.projects-profile-box .elgg-module {
	border: none;
}
.bodyProject_profile .elgg-main ul {
	list-style: none;
}
.bodyProject_profile .elgg-head {
	border-bottom: 1px solid #d0d0d0 !important;
	line-height: 30px;
	padding-bottom: 10px !important;
	margin-bottom: 20px !important;
}
.bodyProject_profile .elgg-head .join-requests {
	float: right;
	margin-right: 5px;
}
/* Project Objetives */
.projects-project-objectives ul.projectsObjectivesList li {
	line-height: 25px;
}
.projects-project-objectives ul.projectsObjectivesList li span {
	margin: 0 5px 0 0;
}
/* Buttons socials */
ul.projectsSocialButtons li {
	display: inline-block;
}
ul.projectsSocialButtons li a {
	display: block;
	height: 32px;
	width: 32px;
}
ul.projectsSocialButtons li a.btnFacebook {
	background: url('<?php echo PROJECTS_GRAPHICS; ?>facebook.png');
}
ul.projectsSocialButtons li a.btnTwitter {
	background: url('<?php echo PROJECTS_GRAPHICS; ?>twitter.png');
}
ul.projectsSocialButtons li a.btnLinkedin {
	background: url('<?php echo PROJECTS_GRAPHICS; ?>linkedin.png');
}
/* Welcome Message */
.projectsWelcomeMessageContent {
	padding: 20px;
	max-height: 300px;
	max-width: 600px;
}
.welcomeMessageWrapper span.label {
	display: block;
	margin-bottom: 10px;
}
.welcomeMessageWrapper .preview-welcome-message {
	float: right;
}
.welcomeMessageWrapper p.note {
	display: block;
	margin-top: 10px;
}
.bodyProject_discussion .discussionsNone {
	margin: 10px 0 0 10px;
}
.bodyProject_invite .ui-autocomplete {
	width: 819px !important;
}
/* empty section */
.emptySection h2 {
    text-align: center;
    color: #b5b5b5;
    font-size: 16px;
    font-weight: bold;
    line-height: 1.4;
}
.emptySection {
    padding: 20px 0 0 0;
    margin: 0 0 20px;
}
.emptySection .helpEmptySection {
	height: 350px;
	background: #eee;
}
.emptySection .helpEmptySection h4 {
    line-height: 350px;
    text-align: center;
    color: #b5b5b5;
    font-size: 24px;
    font-weight: bold;
    text-shadow: 0 2px 1px rgba(255, 255, 255, 0.6);
}
/* Nueva posicion del menu del proyecto*/
.bodyProject ul.elgg-menu-project-profile-menu {
    margin-left: 120px !important;
    top: 15px;
}
.bodyProject .elgg-layout .sideBarsContainer {
    top: -30px;
}
.bodyProject .elgg-layout .sideBarsContainer.sideBarsWidget {
    top: 20px;
}