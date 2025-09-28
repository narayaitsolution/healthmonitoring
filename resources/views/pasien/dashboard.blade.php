<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HealthMonitor</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
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
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
        }
        
        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0.5rem;
        }
        
        
        
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 0 0.5rem 2rem 0.5rem;
            position: relative;
            height: 400px;
        }
        
        .chart-container canvas {
            max-height: 350px !important;
        }
        
        .status-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin: 0 0.5rem 2rem 0.5rem;
        }
        
        .status-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
        }
        
        .status-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        
        .status-content {
            flex: 1;
        }
        
        .status-content h4 {
            margin: 0 0 0.5rem 0;
            color: #333;
            font-size: 1.1rem;
        }
        
        .percentage {
            font-size: 2rem;
            font-weight: bold;
            margin: 0.5rem 0;
            transition: color 0.3s ease;
        }
        
        .status-text {
            font-size: 0.9rem;
            opacity: 0.8;
            font-weight: 500;
        }
        
        /* Blood Pressure Color variations based on database categories */
        
        /* Hipotensi - Ungu pastel (semakin kecil semakin gelap ungu) */
        .status-card.hipotensi { 
            background: linear-gradient(135deg, #e8d5f2 0%, #c4a3d6 100%); 
        }
        .status-card.hipotensi .percentage { color: #6a4c93; }
        
        /* Normal - Hijau pastel ke kuning pastel */
        .status-card.normal { 
            background: linear-gradient(135deg, #d4edda 0%, #fff3cd 100%); 
        }
        .status-card.normal .percentage { color: #155724; }
        
        /* Pre-hipertensi - Kuning pastel ke oranye pastel */
        .status-card.prehipertensi { 
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%); 
        }
        .status-card.prehipertensi .percentage { color: #856404; }
        
        /* Hipertensi Stage 1 - Oranye pastel ke merah pastel */
        .status-card.hipertensi_stage_1 { 
            background: linear-gradient(135deg, #ffeaa7 0%, #f8d7da 100%); 
        }
        .status-card.hipertensi_stage_1 .percentage { color: #721c24; }
        
        /* Hipertensi Stage 2 - Merah pastel ke merah tua */
        .status-card.hipertensi_stage_2 { 
            background: linear-gradient(135deg, #f8d7da 0%, #dc3545 100%); 
        }
        .status-card.hipertensi_stage_2 .percentage { color: #ffffff; }
        .status-card.hipertensi_stage_2 .status-content h4,
        .status-card.hipertensi_stage_2 .status-text { color: #ffffff; }
        
        /* Hipertensi Krisis - Merah tua ke hitam */
        .status-card.hipertensi_krisis { 
            background: linear-gradient(135deg, #dc3545 0%, #343a40 100%); 
        }
        .status-card.hipertensi_krisis .percentage { color: #ffffff; }
        .status-card.hipertensi_krisis .status-content h4,
        .status-card.hipertensi_krisis .status-text { color: #ffffff; }
        
        /* BMI Color variations based on database categories */
        
        /* Underweight - Ungu pastel (semakin kecil semakin gelap ungu) */
        .status-card.bmi-underweight { 
            background: linear-gradient(135deg, #e6e6fa 0%, #d8bfd8 50%, #9370db 100%); 
        }
        .status-card.bmi-underweight .percentage { color: #4b0082; }
        
        /* Normal - Hijau pastel ke kuning pastel */
        .status-card.bmi-normal { 
            background: linear-gradient(135deg, #e8f5e8 0%, #d4edda 50%, #fff3cd 100%); 
        }
        .status-card.bmi-normal .percentage { color: #155724; }
        
        /* Overweight - Kuning pastel ke oranye pastel */
        .status-card.bmi-overweight { 
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 50%, #ffd93d 100%); 
        }
        .status-card.bmi-overweight .percentage { color: #856404; }
        
        /* Obesitas I - Oranye pastel ke merah pastel */
        .status-card.bmi-obesitas_i { 
            background: linear-gradient(135deg, #ffd93d 0%, #ffb347 50%, #ff8c00 100%); 
        }
        .status-card.bmi-obesitas_i .percentage { color: #cc5500; }
        
        /* Obesitas II - Merah pastel ke merah tua */
        .status-card.bmi-obesitas_ii { 
            background: linear-gradient(135deg, #ff8c00 0%, #ff6b6b 50%, #dc143c 100%); 
        }
        .status-card.bmi-obesitas_ii .percentage { color: #8b0000; }
        
        /* Obesitas III - Merah tua ke hitam */
        .status-card.bmi-obesitas_iii { 
            background: linear-gradient(135deg, #dc143c 0%, #8b0000 50%, #2f1b14 100%); 
        }
        .status-card.bmi-obesitas_iii .percentage { color: #ffffff; }
        .status-card.bmi-obesitas_iii .status-content h4,
        .status-card.bmi-obesitas_iii .status-text { color: #ffffff; }
        
        .data-table {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin: 0 0.5rem;
        }
        
        .btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
        }
        
        .btn:hover {
            background: #5a6fd8;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        th {
            background: #f8f9fa;
            font-weight: bold;
        }
        
        .action-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 5px;
        }
        
        .action-btn.delete {
            background: #dc3545;
        }
        
        
        
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 1rem;
            }
            
            .container {
                padding: 0.25rem;
            }
            
            .chart-container {
                margin: 0 0.25rem 1rem 0.25rem;
                padding: 1rem;
                height: 300px;
            }
            
            .chart-container canvas {
                max-height: 250px !important;
            }
            
            .status-cards {
                grid-template-columns: 1fr;
                margin: 0 0.25rem 1rem 0.25rem;
                gap: 0.5rem;
            }
            
            .status-card {
                padding: 1rem;
            }
            
            .status-icon {
                font-size: 2rem;
            }
            
            .percentage {
                font-size: 1.5rem;
            }
            
            .data-table {
                margin: 0 0.25rem;
                padding: 0.5rem;
            }
            
            .btn {
                padding: 8px 12px;
                font-size: 14px;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 0.1rem;
            }
            
            .data-table {
                margin: 0 0.1rem;
                padding: 0.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="header">
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 1rem; margin: 1rem; border-radius: 5px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif
        <div class="logo">🏥 HealthMonitor</div>
        <div class="user-info">
            @if($user->avatar)
                <img src="{{ $user->avatar }}" alt="Avatar" class="avatar">
            @else
                <div class="avatar" style="background: #667eea; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif
            <div>
                <div>{{ $user->name }}</div>
                <div style="font-size: 0.8rem; opacity: 0.8;">{{ $user->email }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="container">

        <!-- Chart -->
        <div class="chart-container">
            <h3>📈 Grafik Riwayat Tekanan Darah</h3>
            @if($bloodPressureRecords->count() > 0)
                <canvas id="bloodPressureChart" width="400" height="200"></canvas>
            @else
                <p>Belum ada data untuk ditampilkan dalam grafik</p>
            @endif
        </div>

        <!-- Health Status Cards -->
        <div class="status-cards">
            <div class="status-card" id="bloodPressureCard">
                <div class="status-icon">🩺</div>
                <div class="status-content">
                    <h4>Tekanan Darah</h4>
                    <div class="percentage" id="bloodPressurePercentage">0%</div>
                    <div class="status-text" id="bloodPressureStatus">Normal</div>
                </div>
            </div>
            
            <div class="status-card" id="bmiCard">
                <div class="status-icon">⚖️</div>
                <div class="status-content">
                    <h4>BMI</h4>
                    <div class="percentage" id="bmiPercentage">0%</div>
                    <div class="status-text" id="bmiStatus">Normal</div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="data-table">
            <h3>⊞ Riwayat Kesehatan</h3>
            <a href="{{ route('pasien.blood-pressure.create') }}" class="btn">➕ Tambah Data Baru</a>
            
            @if($bloodPressureRecords->count() > 0)
                <table id="healthRecordsTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Sistolik</th>
                            <th>Diastolik</th>
                            <th>Berat Badan</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bloodPressureRecords as $record)
                            <tr>
                                <td>{{ $record->date->format('d/m/Y') }}</td>
                                <td>{{ $record->time->format('H:i') }}</td>
                                <td>{{ $record->systolic }} mmHg</td>
                                <td>{{ $record->diastolic }} mmHg</td>
                                <td>{{ $record->weight ? $record->weight . ' kg' : '-' }}</td>
                                <td>{{ $record->blood_pressure_category }}</td>
                                <td>
                                    <a href="{{ route('pasien.blood-pressure.edit', $record->id) }}" class="action-btn">✏️ Edit</a>
                                    <form method="POST" action="{{ route('pasien.blood-pressure.destroy', $record->id) }}" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete">🗑️ Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    @if($bloodPressureRecords->count() > 0)
    <script>
        $(document).ready(function() {
            // Initialize DataTable with responsive extension
            $('#healthRecordsTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
                },
                pageLength: 10,
                order: [[0, 'desc']], // Sort by date descending
                columnDefs: [
                    {
                        targets: [4, 5], // Berat Badan and Kategori columns
                        className: 'none' // Hide on mobile by default
                    }
                ]
            });
            
            // Initialize Chart.js with responsive data
            initializeChart();
            
            // Initialize status cards
            initializeStatusCards();
        });
        
        function initializeChart() {
        const ctx = document.getElementById('bloodPressureChart').getContext('2d');
            
            // Get screen width to determine data limit
            const isMobile = window.innerWidth <= 768;
            const dataLimit = isMobile ? 10 : 20;
            
            // Prepare chart data with limit
            const chartLabels = @json($chartData['labels']).slice(0, dataLimit);
            const chartSystolic = @json($chartData['systolic']).slice(0, dataLimit);
            const chartDiastolic = @json($chartData['diastolic']).slice(0, dataLimit);
            
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                    labels: chartLabels,
                datasets: [{
                    label: 'Sistolik',
                        data: chartSystolic,
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        tension: 0.1,
                        pointRadius: 4,
                        pointHoverRadius: 6
                }, {
                    label: 'Diastolik',
                        data: chartDiastolic,
                    borderColor: '#764ba2',
                    backgroundColor: 'rgba(118, 75, 162, 0.1)',
                        tension: 0.1,
                        pointRadius: 4,
                        pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Tanggal'
                            }
                        },
                    y: {
                        beginAtZero: false,
                        min: 60,
                            max: 200,
                            title: {
                                display: true,
                                text: 'Tekanan Darah (mmHg)'
                            }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: 'white',
                            bodyColor: 'white',
                            borderColor: '#667eea',
                            borderWidth: 1
                        }
                    }
                }
            });
            
            // Handle window resize to update chart data
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    chart.destroy();
                    initializeChart();
                }, 250);
            });
        }
        
        function initializeStatusCards() {
            // Get latest blood pressure record
            const latestRecord = @json($latestRecord);
            const user = @json($user);
            const bmiCategories = @json($bmiCategories);
            const bloodPressureCategories = @json($bloodPressureCategories);
            
            if (latestRecord) {
                // Calculate Blood Pressure percentage
                calculateBloodPressureStatus(latestRecord, bloodPressureCategories);
                
                // Calculate BMI percentage if weight is available
                if (latestRecord.weight && user.height) {
                    calculateBMIStatus(latestRecord.weight, user.height, user.age, user.gender, bmiCategories);
                }
            }
        }
        
        function calculateBloodPressureStatus(record, bloodPressureCategories) {
            // Use data from backend calculation
            const bloodPressureData = @json($bloodPressureData ?? ['percentage' => 0, 'category' => 'No Data', 'category_class' => 'normal']);
            
            updateBloodPressureCard(
                'bloodPressureCard', 
                'bloodPressurePercentage', 
                'bloodPressureStatus', 
                bloodPressureData.percentage, 
                bloodPressureData.category_class, 
                bloodPressureData.category
            );
        }
        
        function calculateBMIStatus(weight, height, age, gender, bmiCategories) {
            // Calculate BMI
            const heightInMeters = height / 100;
            const bmi = weight / (heightInMeters * heightInMeters);
            
            // Find BMI category from database
            let category = null;
            let percentage = 0;
            let status = '';
            
            for (let i = 0; i < bmiCategories.length; i++) {
                const cat = bmiCategories[i];
                if (bmi >= cat.min_value && bmi <= cat.max_value) {
                    category = cat.category.toLowerCase().replace(/\s+/g, '_');
                    status = cat.category;
                    
                    // Calculate percentage within category range
                    const range = cat.max_value - cat.min_value;
                    const position = bmi - cat.min_value;
                    percentage = (position / range) * 100;
                    
                    // Adjust percentage based on category severity
                    switch (cat.category) {
                        case 'Underweight':
                            percentage = (bmi / cat.max_value) * 100; // 0-100% within underweight range
                            break;
                        case 'Normal':
                            percentage = ((bmi - cat.min_value) / (cat.max_value - cat.min_value)) * 100; // 0-100% within normal range
                            break;
                        case 'Overweight':
                            percentage = ((bmi - cat.min_value) / (cat.max_value - cat.min_value)) * 100; // 0-100% within overweight range
                            break;
                        case 'Obesitas I':
                            percentage = ((bmi - cat.min_value) / (cat.max_value - cat.min_value)) * 100; // 0-100% within obesitas I range
                            break;
                        case 'Obesitas II':
                            percentage = ((bmi - cat.min_value) / (cat.max_value - cat.min_value)) * 100; // 0-100% within obesitas II range
                            break;
                        case 'Obesitas III':
                            percentage = Math.min(((bmi - cat.min_value) / 10) * 100, 100); // 0-100% within obesitas III range
                            break;
                    }
                    break;
                }
            }
            
            if (category) {
                updateBMICard('bmiCard', 'bmiPercentage', 'bmiStatus', percentage, category, status);
            }
        }
        
        function updateBloodPressureCard(cardId, percentageId, statusId, percentage, category, status) {
            const card = document.getElementById(cardId);
            const percentageElement = document.getElementById(percentageId);
            const statusElement = document.getElementById(statusId);
            
            // Update percentage
            percentageElement.textContent = Math.round(percentage) + '%';
            
            // Remove existing color classes
            card.classList.remove('hipotensi', 'normal', 'prehipertensi', 'hipertensi_stage_1', 'hipertensi_stage_2', 'hipertensi_krisis');
            
            // Add new color class based on category
            card.classList.add(category);
            
            // Update status text
            statusElement.textContent = status;
        }
        
        function updateBMICard(cardId, percentageId, statusId, percentage, category, status) {
            const card = document.getElementById(cardId);
            const percentageElement = document.getElementById(percentageId);
            const statusElement = document.getElementById(statusId);
            
            if (card && percentageElement && statusElement) {
                // Remove existing color classes
                card.className = card.className.replace(/bmi-\w+/g, '');
                
                // Apply category-specific color class
                card.classList.add('bmi-' + category);
                
                // Update percentage and status
                percentageElement.textContent = Math.round(percentage) + '%';
                statusElement.textContent = status;
            }
        }
        
        function updateStatusCard(cardId, percentageId, statusId, percentage, type) {
            const card = document.getElementById(cardId);
            const percentageElement = document.getElementById(percentageId);
            const statusElement = document.getElementById(statusId);
            
            // Update percentage
            percentageElement.textContent = Math.round(percentage) + '%';
            
            // Determine color class based on percentage
            let colorClass = 'low';
            if (percentage > 100) {
                colorClass = 'high';
            } else if (percentage > 80) {
                colorClass = 'medium';
            }
            
            // Remove existing color classes
            card.classList.remove('low', 'medium', 'high');
            // Add new color class
            card.classList.add(colorClass);
            
            // Update status text
            if (type === 'Tekanan Darah') {
                if (percentage <= 100) {
                    statusElement.textContent = 'Normal';
                } else if (percentage <= 120) {
                    statusElement.textContent = 'Tinggi';
                } else {
                    statusElement.textContent = 'Sangat Tinggi';
                }
            } else if (type === 'BMI') {
                if (percentage <= 50) {
                    statusElement.textContent = 'Kurang';
                } else if (percentage <= 80) {
                    statusElement.textContent = 'Normal';
                } else if (percentage <= 110) {
                    statusElement.textContent = 'Berlebih';
                } else {
                    statusElement.textContent = 'Obesitas';
                }
            }
        }
    </script>
    @endif
</body>
</html>