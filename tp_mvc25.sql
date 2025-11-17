-- buat database
CREATE DATABASE IF NOT EXISTS tp_mvc25;
USE tp_mvc25;

-- buat tabel departments
CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

-- buat tabel lecturers
CREATE TABLE lecturers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nidn VARCHAR(50) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    join_date DATE NOT NULL,
    department_id INT,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

-- buat tabel schedules
CREATE TABLE schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lecturer_id INT NOT NULL,
    day VARCHAR(20) NOT NULL,
    time_start TIME NOT NULL,
    time_end TIME NOT NULL,
    FOREIGN KEY (lecturer_id) REFERENCES lecturers(id)
);

-- INSERT 5 DATA KE TABLE departments
INSERT INTO departments (department_name, location, email) VALUES
('Teknik Informatika', 'Gedung A', 'informatika@kampus.ac.id'),
('Sistem Informasi', 'Gedung B', 'sistem.informasi@kampus.ac.id'),
('Pendidikan Teknologi', 'Gedung C', 'pendidikan.teknologi@kampus.ac.id'),
('Teknik Elektro', 'Gedung D', 'teknik.elektro@kampus.ac.id'),
('Manajemen', 'Gedung E', 'manajemen@kampus.ac.id');

-- INSERT 5 DATA KE TABLE lecturers
INSERT INTO lecturers (name, nidn, phone, join_date, department_id) VALUES
('Ahmad Fauzi', '12345678', '081234567890', '2020-01-10', 1),
('Budi Santoso', '87654321', '082233445566', '2019-05-22', 2),
('Citra Lestari', '11223344', '083344556677', '2021-03-15', 3),
('Dedi Kurniawan', '44332211', '084455667788', '2018-11-01', 4),
('Eka Putri', '55667788', '085566778899', '2022-09-30', 5);

-- INSERT 5 DATA KE TABLE schedules
INSERT INTO schedules (lecturer_id, day, time_start, time_end) VALUES
(1, 'Senin',  '08:00', '10:00'),
(2, 'Selasa', '09:00', '11:00'),
(3, 'Rabu',   '10:00', '12:00'),
(4, 'Kamis',  '13:00', '15:00'),
(5, 'Jumat',  '14:00', '16:00');