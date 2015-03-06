<?php

/**
 * circles
 *
 * @author German Scarel
 * @link http://community.elgg.org/pg/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */

/**
 * Return default results for searches on users.
 *
 * @param unknown_type $params
 * @return unknown_type
 */
function circles_search_friends($options = array()) {
	
	// Get dbprefix
	$dbprefix = elgg_get_config('dbprefix');

	$default = array(
		'limit' => 18,
		'offset' => 0,
	);
	if (!is_array($options)) {
		$options = array();
	}
	$options = array_merge($default, $options);

	if (!isset($options['query'])) {
		$options['query'] = '';
	}
	$options['query'] = sanitise_string($options['query']);

	// Add joins
	$options['joins'] = array();
	$options['joins'][] = "JOIN {$dbprefix}users_entity ue ON e.guid = ue.guid";
	$options['joins'][] = "JOIN {$dbprefix}entity_relationships er ON e.guid = er.guid_two";

	// Add wheres
	$options['wheres'] = array();
	$fields = array('username', 'name');
	$where = circles_search_get_where_sql('ue', $fields, $options, FALSE);
	$options['wheres'][] = $where;
	$options['wheres'][] = "er.guid_one = " . elgg_get_logged_in_user_guid();
	$options['wheres'][] = "er.relationship = 'friend'";

	// override subtype -- All users should be returned regardless of subtype.
	$options['subtype'] = ELGG_ENTITIES_ANY_VALUE;

	$options['count'] = TRUE;
	$count = elgg_get_entities($options);

	// no need to continue if nothing here.
	if (!$count) {
		return false;
	}

	$options['count'] = FALSE;
	
	$entities = elgg_get_entities($options);

	return $entities;
	
}

/**
 * Returns a where clause for a search query.
 *
 * @param str $table Prefix for table to search on
 * @param array $fields Fields to match against
 * @param array $params Original search params
 * @return str
 */
function circles_search_get_where_sql($table, $fields, $params, $use_fulltext = TRUE) {
	
	// Get dbprefix
	$dbprefix = elgg_get_config('dbprefix');

	$query = $params['query'];

	// add the table prefix to the fields
	foreach ($fields as $i => $field) {
		if ($table) {
			$fields[$i] = "$table.$field";
		}
	}

	$where = '';

	// if the query contains spaces, these are replaced by +
	if (!strpos($query, ' ')) {
		$likes = array();
		$query = sanitise_string($query);
		foreach ($fields as $field) {
			$likes[] = "$field LIKE '%$query%'";
		}
		$likes_str = implode(' OR ', $likes);
		$where = "($likes_str)";
	} else {
		// if we're not using full text, rewrite the query for bool mode.
		// exploiting a feature(ish) of bool mode where +-word is the same as -word
		if (!$use_fulltext) {
			$query = '+' . str_replace(' ', ' +', $query);
		}

		// if using advanced, boolean operators, or paired "s, switch into boolean mode
		$booleans_used = preg_match("/([\-\+~])([\w]+)/i", $query);
		$advanced_search = (isset($params['advanced_search']) && $params['advanced_search']);
		$quotes_used = (elgg_substr_count($query, '"') >= 2);

		if (!$use_fulltext || $booleans_used || $advanced_search || $quotes_used) {
			$options = 'IN BOOLEAN MODE';
		} else {
			// natural language mode is default and this keyword isn't supported in < 5.1
			//$options = 'IN NATURAL LANGUAGE MODE';
			$options = '';
		}

		$query = sanitise_string($query);

		$fields_str = implode(',', $fields);
		$where = "(MATCH ($fields_str) AGAINST ('$query' $options))";
	}

	return $where;
	
}