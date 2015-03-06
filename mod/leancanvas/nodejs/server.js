//Heroku default port integration.
var APP_PORT = parseInt(process.env.PORT) || 8080;
//Socket IO
var io = require('socket.io').listen(APP_PORT);

io.configure(function() {
	io.set('log level', 1);

	//Heroku configurations
	if (typeof(process) !== 'undefined') {
		if (typeof(process.env) !== 'undefined') {
			if (APP_PORT === process.env.PORT) {
				io.set("transports", ["xhr-polling"]);
				io.set("polling duration", 5);
			}
		}
	}
});

// Lean canvas
var leancanvas = {};

leancanvas.log = leancanvas.log || {};
leancanvas.blocked = new Array();

leancanvas.log.success = function(msg) {
//	var color = '\033[34m';
	var color = '\033[01;32m'; //01;32
	var reset = '\033[0m';
	console.log(color + msg + reset);
};

leancanvas.log.error = function(msg) {
	var color = '\033[31m';
	var reset = '\033[0m';
	console.log(color + msg + reset);
};

leancanvas.log.info = function(msg) {
	var color = '\033[0;36m';
	var reset = '\033[0m';
	console.log(color + msg + reset);
};

leancanvas.online_users = leancanvas.online_users || {};

leancanvas.online_users.get_count = function(leancanvas_guid) {
	var clients = io.sockets.clients(leancanvas_guid);
	return clients.length;
};

leancanvas.online_users.get_html = function(leancanvas_guid) {
	var clients = io.sockets.clients(leancanvas_guid);
	var html = '';
	for (var i = 0; i < clients.length; i++) {
		html += clients[i].online_user_html;
	}
	return html;
};


leancanvas.construct_blocked_sections = function(canvas_id) {

	if (typeof(canvas_id) === 'undefined') {
		return false;
	}

	if (!canvas_id) {
		return false;
	}

	leancanvas.blocked[canvas_id] = leancanvas.blocked[canvas_id] || new Array();

	if (leancanvas.blocked[canvas_id].length === 0) {
		leancanvas.blocked[canvas_id].push({1: 0});
		leancanvas.blocked[canvas_id].push({2: 0});
		leancanvas.blocked[canvas_id].push({3: 0});
		leancanvas.blocked[canvas_id].push({4: 0});
		leancanvas.blocked[canvas_id].push({5: 0});
		leancanvas.blocked[canvas_id].push({6: 0});
		leancanvas.blocked[canvas_id].push({7: 0});
		leancanvas.blocked[canvas_id].push({8: 0});
		leancanvas.blocked[canvas_id].push({9: 0});
		leancanvas.blocked[canvas_id].push({10: 0});
		leancanvas.blocked[canvas_id].push({11: 0});
		leancanvas.blocked[canvas_id].push({12: 0});
	}

	return leancanvas.blocked[canvas_id];
};

leancanvas.destroy_blocked_sections = function(canvas_id) {
	if (typeof(canvas_id) === 'undefined') {
		return false;
	}

	if (!canvas_id) {
		return false;
	}

	if (typeof(leancanvas.blocked[canvas_id]) === 'undefined') {
		return false;
	}

	delete leancanvas.blocked[canvas_id];
	return true;
};

leancanvas.add_blocked_section = function(canvas_id, section_id, user_guid) {

	var sections = leancanvas.blocked[canvas_id];

	for (var section_key in sections) {
		if (section_id in sections[section_key]) {
			sections[section_key][section_id] = user_guid;
		}
	}

	leancanvas.blocked[canvas_id] = sections;

	return sections;
};

leancanvas._clean_section_for_user = function(canvas_id, section_id, user_guid) {

	var sections = leancanvas.blocked[canvas_id];

	for (var section_key in sections) {
		if (section_id in sections[section_key]) {

			if (sections[section_key][section_id] === user_guid) {
				sections[section_key][section_id] = 0;
			}
		}
	}

	leancanvas.blocked[canvas_id] = sections;

	return sections;
};

leancanvas.clean_section_for_user = function(canvas_id, user_guid) {
	leancanvas._clean_section_for_user(canvas_id, 1, user_guid);
	leancanvas._clean_section_for_user(canvas_id, 2, user_guid);
	leancanvas._clean_section_for_user(canvas_id, 3, user_guid);
	leancanvas._clean_section_for_user(canvas_id, 4, user_guid);
	leancanvas._clean_section_for_user(canvas_id, 5, user_guid);
	leancanvas._clean_section_for_user(canvas_id, 6, user_guid);
	leancanvas._clean_section_for_user(canvas_id, 7, user_guid);
	leancanvas._clean_section_for_user(canvas_id, 8, user_guid);
	leancanvas._clean_section_for_user(canvas_id, 9, user_guid);
	leancanvas._clean_section_for_user(canvas_id, 10, user_guid);
	leancanvas._clean_section_for_user(canvas_id, 11, user_guid);
	leancanvas._clean_section_for_user(canvas_id, 12, user_guid);
	
	return leancanvas.blocked[canvas_id];
};

leancanvas.remove_blocked_section = function(canvas_id, section_id) {
	return leancanvas.add_blocked_section(canvas_id, section_id, 0);
};

io.sockets.on('connection', function(socket) {

	// New Online User
	socket.on('new.online.user', function(data) {

		var canvas_id = data.leancanvas_guid;

		var blocked_sections = leancanvas.construct_blocked_sections(canvas_id);

		// Save data into socket
		socket.user_guid = data.user_guid;
		socket.leancanvas_guid = canvas_id;
		socket.online_user_html = data.online_user_html;

		// Join to room 'leancanvas_guid'
		socket.join(canvas_id);

		// Notify to all users
		var info = {
			count_online_users: leancanvas.online_users.get_count(data.leancanvas_guid),
//			user_guid: data.user_guid,
//			leancanvas_guid: data.leancanvas_guid,
//			online_user_html: data.online_user_html,
			online_users_lightbox: leancanvas.online_users.get_html(data.leancanvas_guid)
		};

		leancanvas.log.success(">>>> USER " + socket.user_guid + " CONNECTED TO " + canvas_id);

		io.sockets.in(canvas_id).emit('update.online.users', info);

		io.sockets.in(canvas_id).emit('block_section.start', blocked_sections);

	});

	socket.on('leancanvas.block_section', function(data) {
		var section_id = data.section_id;
		var canvas_id = socket.leancanvas_guid;
		var user_guid = socket.user_guid;

		leancanvas.log.info("#### USER " + user_guid + " BLOCKED SECTION: " + section_id + " ON BOARD " + canvas_id);

		//Add blocked sections to the board
		var blocked_sections = leancanvas.add_blocked_section(canvas_id, section_id, user_guid);

		socket.broadcast.to(canvas_id).emit('block_section.start', blocked_sections);
	});

	socket.on('leancanvas.unblock_section', function(data) {
		var section_id = data.section_id;
		var canvas_id = socket.leancanvas_guid;
		var user_guid = socket.user_guid;

		leancanvas.log.info("@@@@ USER " + user_guid + " UNBLOCKED SECTION: " + section_id + " ON BOARD " + canvas_id);

		//Remove blocked sections to the board
		var blocked_sections = leancanvas.remove_blocked_section(canvas_id, section_id);

		socket.broadcast.to(canvas_id).emit('block_section.stop', blocked_sections);
	});

	socket.on('leancanvas.update_item', function(data) {
		leancanvas.log.info("^^^^ USER " + socket.user_guid + " UPDATED BOARD " + socket.leancanvas_guid);
		socket.broadcast.to(socket.leancanvas_guid).emit('item.update', data);
	});

	socket.on('leancanvas.add_item', function(data) {
		leancanvas.log.info("++++ USER " + socket.user_guid + " ADDED ITEM ON BOARD " + socket.leancanvas_guid);
		socket.broadcast.to(socket.leancanvas_guid).emit('item.add', data);
	});

	socket.on('leancanvas.delete_item', function(data) {
		leancanvas.log.info("!!!! USER " + socket.user_guid + " REMOVED ITEM ON BOARD " + socket.leancanvas_guid);
		socket.broadcast.to(socket.leancanvas_guid).emit('item.delete', data);
	});


	// Disconnect
	socket.on('disconnect', function() {

		var canvas_id = socket.leancanvas_guid;
		var user_guid = socket.user_guid;

		leancanvas.log.error(">>>> USER " + socket.user_guid + " DISCONNECTED TO " + socket.leancanvas_guid);
		// Leave to room 'leancanvas_guid'
		socket.leave(socket.leancanvas_guid);

		var info = {
			count_online_users: leancanvas.online_users.get_count(socket.leancanvas_guid),
//			user_guid: data.user_guid,
//			leancanvas_guid: data.leancanvas_guid,
//			online_user_html: data.online_user_html,
			online_users_lightbox: leancanvas.online_users.get_html(socket.leancanvas_guid)
		};

		var blocked_sections = leancanvas.clean_section_for_user(canvas_id, user_guid);

		io.sockets.in(socket.leancanvas_guid).emit('update.online.users', info);
		io.sockets.in(canvas_id).emit('block_section.stop', blocked_sections);
		if (leancanvas.online_users.get_count(canvas_id) === 0) {
			leancanvas.destroy_blocked_sections(canvas_id);
			leancanvas.log.error(">>>>>>> cleared: "+canvas_id+"<<<<<<<<");
		}

	});

});