<?php
?>
	.cThis {
		clear: both;
		font-size: 0;
		height: 0;
		line-height: 0;
	}

	/* Form */
	#keetup_categories_form {
		padding: 15px 0px;
		width: 550px; 
	}
	#keetup_categories_form label,
	#keetup_categories_form .label {
		clear: both;
		float: left;
		padding:5px 0;
		/*width:546px;*/
	}
	#keetup_categories_form label span.lft,
	#keetup_categories_form .label span.lft {
		display: block; 
		float: left;
		line-height:25px;
		/*text-align: right;*/
		padding:0 5px 0 0;
		width:130px;
	}
	#keetup_categories_form label span.rgt,
	#keetup_categories_form .label span.rgt {
		display: block;
		float: right;
		width: 400px;
	}
	#keetup_categories_form label span.date,
	#keetup_categories_form .label span.date {
		line-height:25px;
	}
	#keetup_categories_form label input,
	#keetup_categories_form .label input,	 
	#keetup_categories_form label textarea,
	#keetup_categories_form .label textarea {
		width: 388px;
	}
	#keetup_categories_form label input[type="checkbox"] {
		width: 20px;
	}
	
	
	#keetup_categories_form small {
		display: block;
		font-weight: normal;
		color: #999;
		padding:4px 0 0;
		font-style: italic;
	}
	#keetup_categories_form div.buttons {
		padding-right: 6px;
		text-align: right;
	}
	
	.hidden {
		display: none;
	}
	
	#keetup_categories_vf_container{
		margin: 10px 0 20px;
	}
	
	#keetup_categories_vf_container #keetup_categories_vf_preview_container {
		margin: 10px 0 20px;
	}
	
	#keetup_categories_vf_preview_container ul {
		list-style-type: none;
		padding: 0 0 0 10px;
	}
	
	#keetup_categories_vf_preview_container ul li {
		overflow: hidden;
		margin: 10px 0;
		background: #EFEFEF;
		padding: 3px 0 1px;
	}
	
	#keetup_categories_vf_preview_container ul li.selected {
		background: #BFBFBF; 
	}
	
	#keetup_categories_vf_preview_container ul li span {
		margin: 5px 10px;
		padding: 0 15px 0 0;
		float: left;
	}
	
	#keetup_categories_vf_preview_container ul li span {
		
	}
	
	#keetup_categories_vf_preview_container ul li .submit_button {
		float: right;
		margin: 0 10px;
	}	
	
	/*Listing*/
	.ktCategoriesWrapper {
	    border-top: 1px solid #d5d9e0;
	    padding: 10px 0 0 0;
	}
	.ktCategoriesWrapper h3 {
	    color: #026f9c;
	    padding: 0 0 10px 3px;
	    margin: 0 0 9px 0;
	    font-size: 12px;
	    font-weight: bold;
	    line-height: 14px;
	    border-bottom: 1px solid #d5d9e0;
	}
	.ktCategoriesWrapper .listItem {
	    border-bottom: 1px solid #d5d9e0;
	    padding: 0 0 10px 6px;
	    margin: 0 0 10px 0;
	}
	.ktCategoriesWrapper .listItem {
	    padding-bottom: 5px; /* IE7 */
	}
	.ktCategoriesWrapper .listItem .inner {
	    width: 72%;
	    float: left;
	}
	.ktCategoriesWrapper .listItem .title {
	    font-size: 12px;
	    line-height: 16px;
	    color: #13364f;
	    margin: 0 0 2px 0;
	}
	.ktCategoriesWrapper .listItem .title a {
	    text-decoration: underline;
	}
	.ktCategoriesWrapper .listItem .title a:hover {
	    text-decoration: none;
	}
	.ktCategoriesWrapper .listItem .txt {
	    font-size: 11px;
	    line-height: 13px;
	    color: #7691a6;
	    margin: 0 0 4px 0;
	}
	.ktCategoriesWrapper .listItem .txt2 {
	    font-size: 11px;
	    font-style: italic;
	    line-height: 13px;
	    color: #32677d;
	    margin: 0 0 8px 0;
	}
	.ktCategoriesWrapper .listItem ul.options,
	.contStHlpSettings ul.options,
	.listAnswerQuestions ul.options {
	    margin: 11px 0 0 0;
	    padding: 0;
	    list-style: none;
	    text-align: right;
	    overflow: hidden;
	    float: right;
	    height: 14px;
	}
	.listAnswerQuestions ul.options {
	    margin-top: 7px;
	}
	.ktCategoriesWrapper .listItem ul.options li,
	.contStHlpSettings ul.options li,
	.listAnswerQuestions  ul.options li {
	    display: block;
	    font-size: 11px;
	    float: left;
	}
	.ktCategoriesWrapper .listItem ul.options li a,
	.contStHlpSettings ul.options li a,
	.listAnswerQuestions ul.options li a {
	    color: #7691a6;
	    font-size: 11px;
	    display: block;
	    text-decoration: none;
	}
	.ktCategoriesWrapper .listItem ul.options li a:hover,
	.contStHlpSettings ul.options li a:hover,
	.listAnswerQuestions ul.options li a:hover {
	    text-decoration: underline;
	}
	.ktCategoriesWrapper .listItem ul.options li.one,
	.contStHlpSettings ul.options li.one,
	.listAnswerQuestions ul.options li.one {
	    margin: 0 8px 0 0;
	}
	.ktCategoriesWrapper .listItem ul.options li.two,
	.contStHlpSettings ul.options li.two,
	.listAnswerQuestions ul.options li.two {
	    background: url(<?php echo $vars['url']; ?>mod/keetup_categories/graphics/ico-delete.png) 0 0 no-repeat;
	    width: 12px;
	    height: 12px;
	    margin: 2px 0 0 0;
	}
	.ktCategoriesWrapper .listItem ul.options li.two a,
	.contStHlpSettings ul.options li.two a,
	.listAnswerQuestions ul.options li.two a {
	    width: 12px;
	    height: 12px;
	}	