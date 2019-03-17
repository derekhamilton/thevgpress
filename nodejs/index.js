var socket = require('socket.io');
var express = require('express');
var http = require('http');
var redis = require('redis');
var redisClient = redis.createClient();

var app = express();
var server = http.createServer(app);

var io = socket.listen( server );

var mysql      = require('mysql');
var connection = mysql.createConnection({
    host     : 'localhost',
    user     : 'root',
    password : 'root',
    database : 'thevgpress'
});

io.sockets.on('connection', function(client)
{
    // when a message is sent to a user
    client.on('message', function(data)
    {
        // get the sender user ID from Redis
        redisClient.hget('user-ids', data.session, function(error, userId)
        {
            console.log("USER ID: "+userId);
            console.log('Message sent ' + userId + ":" + data.message + ":" + data.receiverId);
            connection.query('INSERT INTO messages (user_id_sender, user_id_receiver, message, created_at, updated_at) VALUES (?, ?, ?, ?, ?)', [userId, data.receiverId, data.message, new Date(), new Date()], function(err, result)
            {
                console.log(err);
            });

            connection.query('SELECT username FROM users WHERE id = ?', [userId], function(err, rows)
            {
                // relay message to the target user
                console.log(err);
                io.sockets.in(data.receiverId).emit('message', { userId: userId, username: rows[0].username, message: data.message });
            });
        });
    });

    // when a user's chat is opened, open their channel
    client.on('joinChat', function(data)
    {
        redisClient.hget('user-ids', data.session, function(error, userId)
        {
            client.join(userId);
        });
    });
});

server.listen( 3000 );
