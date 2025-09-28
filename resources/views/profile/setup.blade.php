<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Profile - HealthMonitor</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .setup-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            max-width: 500px;
            width: 90%;
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 1rem;
            text-align: center;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 1rem;
        }
        .btn:hover {
            background: #5a6fd8;
        }
        .description {
            color: #666;
            margin-bottom: 2rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="setup-container">
        <div class="logo">🏥 HealthMonitor</div>
        <p class="description">
            Lengkapi profil Anda untuk memulai monitoring tekanan darah
        </p>
        
        <form method="POST" action="{{ route('profile.setup.store') }}">
            @csrf
            <div class="form-group">
                <label for="gender">Jenis Kelamin</label>
                <select name="gender" id="gender" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="birth_date">Tanggal Lahir</label>
                <input type="date" name="birth_date" id="birth_date" required>
            </div>
            
            <div class="form-group">
                <label for="height">Tinggi Badan (cm)</label>
                <input type="number" name="height" id="height" min="100" max="250" required>
            </div>
            
            <button type="submit" class="btn">Simpan Profil</button>
        </form>
    </div>
</body>
</html>