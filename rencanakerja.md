# 📋 RENCANA KERJA - HEALTHMONITOR

**Sistem Monitoring Tekanan Darah dengan Multi-Role (Pasien/Nakes/Admin)**

---

## **PHASE 1: PROJECT SETUP & FOUNDATION**

### **Modul 1: Laravel Project Setup**
- [x] Instalasi Laravel baru dengan nama `healthmonitor`
- [x] Konfigurasi database (MySQL)
- [x] Setup environment variables
- [ ] Install dependencies (Chart.js untuk grafik)
- [ ] Setup basic authentication (tanpa registration/reset password)

### **Modul 2: Database Design & Migration**
- [x] **Tabel `users`** (extend default Laravel)
  - id, name, email, email_verified_at, role (pasien/nakes/admin), gender, birth_date, height, created_at, updated_at
- [x] **Tabel `blood_pressure_records`**
  - id, user_id, patient_id (untuk nakes monitoring), date, time, systolic, diastolic, weight, created_at, updated_at
- [x] **Tabel `blood_pressure_categories`**
  - id, category, systolic_min, systolic_max, diastolic_min, diastolic_max
- [x] **Tabel `bmi_categories`**
  - id, category, min_value, max_value
- [x] **Tabel `patient_nakes_assignments`** (untuk future use)
  - id, patient_id, nakes_id, assigned_at, created_at, updated_at

### **Modul 2.1: Models & Relationships** ✅ SELESAI
[x] Model User dengan relasi dan helper methods
[x] Model BloodPressureRecord dengan relasi dan calculations
[x] Model BloodPressureCategory dengan helper methods
[x] Model BmiCategory dengan helper methods
[x] Model PatientNakesAssignment dengan relasi

### **Modul 2.2: Database Seeding** ✅ SELESAI
[x] Seeder untuk blood_pressure_categories (6 kategori)
[x] Seeder untuk bmi_categories (6 kategori)
[x] Data kategori sudah terisi di database

## **PHASE 2: AUTHENTICATION & USER MANAGEMENT**

## **Modul 3: Google OAuth Authentication System** ✅ SELESAI
[x] Custom authentication dengan Google OAuth2 ✅ SELESAI
[x] Google OAuth2 integration ✅ SELESAI
[x] Role-based middleware (pasien/nakes/admin) ✅ SELESAI
[x] Google avatar extraction ✅ SELESAI
[x] Auto user creation untuk user baru ✅ SELESAI
[x] Session management ✅ SELESAI
[x] CustomAuthController dengan Google OAuth ✅ SELESAI
[x] RoleMiddleware untuk role-based access ✅ SELESAI
[x] ProfileCompletionMiddleware ✅ SELESAI

## **Modul 3.1: Database Updates** ✅ SELESAI
[x] Migration untuk menambah kolom avatar ✅ SELESAI
[x] Migration untuk modify password column (nullable) ✅ SELESAI
[x] Update Model User dengan fillable avatar ✅ SELESAI

## **Modul 3.2: Routes & Views** ✅ SELESAI
[x] Routes untuk Google OAuth authentication ✅ SELESAI
[x] Routes untuk profile setup ✅ SELESAI
[x] View login dengan Google OAuth button ✅ SELESAI
[x] View profile setup dengan responsive design ✅ SELESAI

## **Modul 4: User Profile Setup (First Login)** ✅ SELESAI
[x] Middleware untuk check profile completion ✅ SELESAI
[x] Form: gender dropdown, birth_date (input date), height ✅ SELESAI
[x] Auto-calculate age (tahun, bulan, hari) ✅ SELESAI
[x] Role assignment logic (default pasien) ✅ SELESAI
[x] Redirect logic setelah profile setup ✅ SELESAI
[x] ProfileController untuk handle profile setup ✅ SELESAI
[x] View profile setup dengan responsive design ✅ SELESAI

---

## **PHASE 3: CORE FUNCTIONALITY - PASIENT**

### **Modul 5: Dashboard Pasien Controller & View**
- [ ] Dashboard route & controller untuk pasien
- [ ] Fetch pasien's blood pressure records
- [ ] Data preparation untuk charts dan tables
- [ ] Mobile-first responsive design
- [ ] Email avatar display dengan anonymous fallback

### **Modul 6: Blood Pressure CRUD (Pasien)**
- [ ] **Create**: Form tambah data baru
- [ ] **Read**: Tampilkan data di dashboard
- [ ] **Update**: Edit data existing (modal/form)
- [ ] **Delete**: Hapus data dengan confirmation
- [ ] Input validation & error handling

### **Modul 7: Data Visualization (Pasien)**
- [ ] Chart.js integration
- [ ] Line chart untuk riwayat tekanan darah
- [ ] Real-time data updates
- [ ] Responsive chart design
- [ ] Age calculation display (tahun, bulan, hari)

---

## **PHASE 4: BUSINESS LOGIC & ENHANCEMENTS**

### **Modul 8: Classification Logic**
- [ ] Function untuk kategori tekanan darah
- [ ] Function untuk kategori BMI
- [ ] Auto-categorization saat input data
- [ ] Display kategori di dashboard
- [ ] Age calculation helper

### **Modul 9: Mobile Optimization & UX**
- [ ] Touch-friendly buttons
- [ ] Large fonts untuk readability
- [ ] Simple navigation
- [ ] Accessibility improvements
- [ ] Senior-friendly interface

---

## **PHASE 5: FUTURE EXTENSION PREPARATION**

### **Modul 10: Multi-Role Foundation**
- [ ] Role-based routing preparation
- [ ] Nakes dashboard structure (basic)
- [ ] Patient assignment system (database ready)
- [ ] Admin panel structure (basic)
- [ ] Testing & deployment prep

---

## **📊 FITUR UTAMA PER MODUL:**

### **Authentication Features:**
- ✅ Email-only login (no password)
- ✅ Role-based access (pasien/nakes/admin)
- ✅ Email avatar extraction + anonymous fallback
- ✅ No registration/reset password

### **User Profile Features:**
- ✅ First-time setup: gender, birth_date (date input), height
- ✅ Auto-calculate age (tahun, bulan, hari)
- ✅ Role assignment
- ✅ Profile completion tracking

### **Dashboard Features (Pasien):**
- ✅ Chart riwayat sistolik/diastolik
- ✅ Tabel data dengan edit/delete icons
- ✅ Tombol "Tambah Data Baru"
- ✅ Keterangan kategori tekanan darah & BMI
- ✅ Email avatar display

### **Data Management:**
- ✅ Form input: tanggal, jam, sistolik, diastolik, berat badan
- ✅ Edit data existing
- ✅ Delete dengan confirmation
- ✅ Auto-calculate kategori

### **Future-Ready Features:**
- ✅ Multi-role system foundation
- ✅ Patient-Nakes assignment system
- ✅ Scalable database structure

### **Mobile-First Design:**
- ✅ Responsive layout
- ✅ Large touch targets
- ✅ Simple navigation
- ✅ Senior-friendly UI

---

## **📈 ESTIMATED TIMELINE:**
- **Total Sesi**: 10 sesi pembelajaran
- **Durasi per sesi**: 1-2 jam
- **Total waktu**: 15-20 jam

---

## **🔮 FUTURE EXTENSIONS (Setelah Phase 5):**
- Nakes dashboard untuk monitoring multiple patients
- Admin panel untuk user management
- Patient assignment system
- Advanced reporting & analytics

---

## **📝 NOTES:**
- Database categories akan diisi manual (tidak ada CRUD)
- Fokus pada mobile-first design untuk user senior
- Sistem multi-role siap untuk extension ke depannya
- Age calculation menggunakan date birth dengan format tahun, bulan, hari

---

**Last Updated**: [Update saat progress]
**Current Phase**: Phase 1 - Project Setup & Foundation
**Next Step**: Database Configuration & Migration Setup
