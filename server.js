const express = require('express');
const path = require('path');
const app = express();

// Set folder 'public' sebagai folder statis
app.use(express.static(path.join(__dirname, 'public')));

// Route utama, tampilkan index.html
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

// Jalankan server di port 3000
const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Server running at http://localhost:${PORT}`);
});
