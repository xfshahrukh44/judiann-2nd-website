// const express = require("express");
// const app = express();
// const {Server} = require('socket.io')
// for ssl
const fs = require('fs');
var path = require('path');
const privateKey  = fs.readFileSync(path.join(__dirname, 'ssl/key.txt'), 'utf8');
const certificate = fs.readFileSync(path.join(__dirname, 'ssl/crt.txt'), 'utf8');
// const privateKey  = fs.readFileSync('f:/laragon/etc/ssl/laragon.key', 'utf8');
// const certificate = fs.readFileSync('f:/laragon/etc/ssl/laragon.crt', 'utf8');
const credentials = {key: privateKey, cert: certificate};
// const {v4: uuid4} = require("uuid");

// const server = require("http").createServer(app);
// const server = require("https").createServer(credentials, app);

// app.set("view engine", "ejs");

/*const io = new Server(server, {
    cors: {
        origin: "https://localhost"
    }
});*/

const {PeerServer} = require("peer");
const peerServer = PeerServer({
    host: '0.0.0.0',
    port: 3002,
    path: '/peerjs',
    ssl: credentials
});

peerServer.on('connection', (client) => {
    console.log("client connected", client.id)
})
peerServer.on('disconnect', (client) => {
    console.log("client disconnect", client.id)
})

// app.use("/peerjs", peerServer);

// app.use(express.static("public"));
//
// app.get("/", (req, res) => {
//     res.redirect(`/${uuid4()}`);
// });
//
// app.get("/:room", (req, res) => {
//     res.render("room", {roomId: req.params.room});
// });


/*io.on("connection", (socket) => {
    socket.on("join-room", (roomId, userId) => {
        console.log("socket connected", socket.id, userId, roomId)

        socket.join(roomId);
        socket.to(roomId).emit("user-connected", userId)

        socket.on('disconnect', () => {
            io.to(roomId).emit('user-disconnected', userId)
        })
    });

});*/

// server.listen(3030, '0.0.0.0');
