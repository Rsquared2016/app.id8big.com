<?php
	//TODO: Falta traducir al ingles.
	$english = array(
	/*	Admin	*/
		'keetup_categories:admin:title' => 'Categories & Sub-Categories',
		 'admin:administer_utilities:keetup_categories' => 'Categories & Sub-Categories',
		'keetup_categories:admin' => 'Categories & Sub-Categories Admin',
		'keetup_categories:admin:list' => 'Listing Categories & Sub-Categories',
		'keetup_categories:admin:categories' => 'Add Categories & Sub-Categories',
		'keetup_categories:admin:preview' => 'Preview',

		'keetup_categories:category:title' => 'Category',
		'keetup_categories:category:title:tip' => 'Add the category name.',
		'keetup_categories:category:sub_categories:title' => 'Add the new sub category',
		'keetup_categories:category:sub_categories' => 'Sub-categories',
		'keetup_categories:category:sub_category' => 'Sub-Categories',
		'keetup_categories:category:sub_categories:tip' => 'You have to put the category name and then click on Submit.',

		'keetup_categories:test:category' => 'Category input Test',

	/*Titles and Subtitles*/
		 'keetup_categories:category:label'  =>  "Categories and Sub-Categories of Services" ,
		 'profile:keetup_categories'  =>  "Types of services" ,
		 'keetup_categories:searchcategories' => 'Search Categories and Sub-Categories of Services',
		 'keetup_categories:searchcategories:title' => '%s with category %s',
		 'keetup_categories:searchsubcategories:title' => ' and subcategory %s',
		 'keetup_categories:category'  =>  "Category" , 
		 'keetup_categories:category_your'  =>  "Categorize your %s" , 
		 'keetup_categories:categoryselected'  =>  "You have been selected that category: " ,
		 'keetup_categories:selectcategory' => 'Select a category',
		'keetup_categories:selectsubcategory' => 'Select a subcategory',
		'keetup_categories:subcategory:title' => 'Subcategory',
		'keetup_categories:add:multi' => 'Add other category',
		'keetup_categories:subcategories:other:text' => 'Other',
		'keetup_categories:subcategories:other:text:error:saving' => 'There was an error saving the new Stream, please try again.',

	/*Sucess*/
		'keetup_categories:category:saved' => 'Your Category and Sub-Category was saved successfully.',
		'keetup_categories:category:deleted' => 'The Category and Sub-Category was deleted successfully.',

	/*Errors*/
		'keetup_categories:category:required:fields' => 'You have to fill Category and Sub-Category.',
		'keetup_categories:category:error:saving' => 'There were a problem during saving the Category, please try again.',
		'keetup_categories:category:error:deleting' => 'There were a problem during deleting the Category, please try again.',
		'keetup_categories:subcategory:error:saving' => 'There were a problem during saving the Sub-Category, please try again.',
		'keetup_categories:deleteconfirm:category' => 'Are you sure that you want to delete the Category with the Sub-categories.',
		'keetup_categories:deleteconfirm:subcategory:js' => 'Are you sure that you want to delete the Category and the associated data to this.',

		'keetup_categories:category:no:categories' => 'There are no Categories and Sub-Categories at the moment.',	
		
		'keetup_categories:category:group' => 'Context',
		'keetup_categories:category_group:context:default' => 'Default Category',
		'keetup_categories:category:group:tip' => 'The context of the category, where you want to show this section',
		
		'keetup_categories:admin:filter_by' => 'Filter By',
		'keetup_categories:admin:filter_by:all_categories' => 'All Categories',
		'ktform:filter:label:kt_category' => 'Category',
		'ktform:filter:label:kt_subcategory' => 'Subcategory',
		'ktform:listing:top:titles:category_id' => 'Category',
		
		'keetup_categories:category_group:context:ktfile' => 'File',
		'keetup_categories:category_group:context:meetups' => 'Meetups',
		'keetup_categories:category_group:context:blog' => 'Blogs',
		'keetup_categories:category_group:context:pages' => 'Pages',
		'keetup_categories:category_group:context:oboard' => 'OBoard',
		'keetup_categories:category_group:context:university' => 'University',
		
		
		'keetup_categories:follow:btn:text' => 'Follow',
		'keetup_categories:unfollow:btn:text' => 'Unfollow',
		/**
		 * Errors
		 */
		'keetup_categories:follow:error:select' => 'There was an error, please select a %s',
		'keetup_categories:follow:type:category' => 'Category',
		'keetup_categories:follow:type:subcategory' => 'Subcategory',
		'keetup_categories:follow:error:invalid' => 'Invalid %s entity',
		'keetup_categories:follow:error:adding:rel' => 'There was an error following the %s',
		'keetup_categories:unfollow:error:removing:rel' => 'There was an error unfollowing the %s',
		'keetup_categories:follow:error:already:following' => 'You are already following the %s',
		
		/**
		 * Success
		 */
		'keetup_categories:follow:success' => 'You are following the %s',
		'keetup_categories:unfollow:success' => 'You are not following anymore the %s',
		
		'keetup_categories:page_owner:category:follow' => 'Follow Categories',
		'keetup_categories:page_owner:category:following' => "Categories I'm Following",
		'keetup_categories:page_owner:subcategory:follow' => 'Follow Subcategory',
		'kt_form:opportunities:label:category' => 'Category',
		
		'ktform:entities:kt_category:listing:empty_results' => 'You are not following any Category',
		 
		
	);
					
	add_translation("en",$english);
?>