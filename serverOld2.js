import express from "express";
import multer from "multer";
import fs from "fs";
import path from "path";

const app = express();
const __dirname = path.resolve();
const DATASET_FOLDER = path.join(__dirname, "public", "dataset");

// Pastikan folder dataset ada
if (!fs.existsSync(DATASET_FOLDER)) {
  fs.mkdirSync(DATASET_FOLDER, { recursive: true });
}

// Konfigurasi Multer untuk simpan file
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, DATASET_FOLDER);
  },
  filename: (req, file, cb) => {
    cb(null, Date.now() + ".jpg");
  },
});
const upload = multer({ storage });

// Endpoint untuk simpan dataset
app.post("/save-dataset", upload.single("image"), (req, res) => {
  res.json({ status: "ok", file: req.file.filename });
});

// Serve file statis
app.use(express.static("public"));

// Jalankan server
const PORT = 3000;
app.listen(PORT, () => console.log(`✅ Server jalan di http://localhost:${PORT}`));
