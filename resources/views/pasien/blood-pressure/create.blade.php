<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Tekanan Darah - HealthMonitor</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            color: #333;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .back-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        
        .container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .form-container {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .form-title {
            color: #667eea;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }
        
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        input:focus, select:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background: #218838;
        }
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .button-group .btn {
            flex: 1;
        }
        
        .error {
            color: #dc3545;
            font-size: 14px;
            margin-top: 0.25rem;
        }
        
        .success {
            background: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        
        @media (max-width: 768px) {
            .container {
                margin: 1rem auto;
            }
            
            .form-container {
                padding: 1.5rem;
            }
            
            .button-group {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .button-group .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">🏥 HealthMonitor</div>
        <a href="{{ route('pasien.dashboard') }}" class="back-btn">← Kembali ke Dashboard</a>
    </div>

    <div class="container">
        <div class="form-container">
            <h2 class="form-title">➕ Tambah Data Tekanan Darah</h2>
            
            @if(session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif
            
            <form method="POST" action="{{ route('pasien.blood-pressure.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="date">Tanggal</label>
                    <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required>
                    @error('date')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="time">Waktu</label>
                    <input type="time" name="time" id="time" value="{{ old('time', date('H:i')) }}" required>
                    @error('time')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="systolic">Tekanan Sistolik (mmHg)</label>
                    <input type="number" name="systolic" id="systolic" min="60" max="300" value="{{ old('systolic') }}" required>
                    @error('systolic')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="diastolic">Tekanan Diastolik (mmHg)</label>
                    <input type="number" name="diastolic" id="diastolic" min="40" max="200" value="{{ old('diastolic') }}" required>
                    @error('diastolic')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="weight">Berat Badan (kg) - Opsional</label>
                    <input type="number" name="weight" id="weight" min="20" max="300" step="0.1" value="{{ old('weight') }}">
                    @error('weight')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="button-group">
                    <a href="{{ route('pasien.dashboard') }}" class="btn btn-secondary">❌ Batal</a>
                    <button type="submit" class="btn">💾 Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>