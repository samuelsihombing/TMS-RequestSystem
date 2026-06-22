# TMS Business Unit Request Management System

Sistem manajemen pengajuan antar unit bisnis yang dibangun menggunakan **Yii2 Framework** (Advanced Template).

## Fitur Utama

- ✅ Manajemen request antar business unit (Copper Rod, Aluminum Rod, QC, Warehouse, IT)
- ✅ Workflow approval: Pending → Approved/Rejected → Completed
- ✅ RBAC (Role-Based Access Control) dengan 3 role: Staff, Supervisor, Admin
- ✅ Histori audit trail setiap perubahan status
- ✅ Dashboard ringkasan request
- ✅ Master data Business Unit & Request Type
- ✅ Custom UI tema green tea minimalis

## Role & Permission

| Role | Permission | Akses |
|---|---|---|
| Staff | createRequest | Buat & lihat request |
| Supervisor | approveRequest | Approve/Reject/Complete request |
| Admin | manageMasterData | Kelola semua data + master data |

## Tech Stack

- **Framework**: Yii2 PHP Framework (Advanced Template)
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Font Awesome 6, SweetAlert2
- **Auth**: Yii2 RBAC dengan DbManager

## Struktur Project