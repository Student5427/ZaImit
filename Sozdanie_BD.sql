CREATE DATABASE if not exists zaimit_microloan;
use zaimit_microloan;

/*Create Table*/
create table if not exists tblClient
(
id_client				int				not null	auto_increment primary key,
client_name				char(50)		not null,
client_surname			char(50)		not null,
client_secondname		char(50),
client_birthday			date			not null,
client_passport			char(11)		not null,
client_adress			char(100)		not null,
client_work				char(100)		not null,
client_salary			int				not null,
client_number			char(11)		not null
);
create table if not exists tblWorker
(
id_worker				int				not null	auto_increment primary key,
worker_name				char(50)		not null,
worker_surname			char(50)		not null,
worker_secondname		char(50),
worker_birthday			date			not null,
worker_passport			char(11)		not null,
worker_date				date			not null,
worker_countm			int				not null,
is_admin				boolean			not null
);
create table if not exists tblLoan
(
id_loan				int				not null	auto_increment primary key,
id_client			int				not null	references tblClient(id_client)		on update cascade on delete no action,
id_worker			int				not null	references tblWorker(id_worker)		on update cascade on delete no action,
loan_sum			decimal(10,2)	not null,
loan_percent		decimal(4,2)	not null,
loan_start			date			not null,
loan_end			date			not null,
loan_sum_result		decimal(10,2)   generated always as (loan_sum + (loan_sum * loan_percent / 100 * DATEDIFF(loan_end, loan_start))) stored not null,
loan_sum_pay		decimal(10,2),
loan_status			char(15)
);
create table if not exists tblDebt
(
id_debt			int				not null	auto_increment primary key,
id_loan			int				not null	references tblLoan(id_loan)		on update cascade on delete no action,
debt_days		int				not null,
debt_penny		decimal(10,2)	not null,
debt_sum		decimal(10,2)	not null
);
create table if not exists tblPay 
(
id_pay		int				not null	auto_increment primary key,
id_loan		int				not null	references tblLoan(id_loan)		on update cascade on delete no action,
pay_date	date			not null,
pay_sum		decimal(10,2)	not null
);
create table if not exists tblAuth 
(
id_auth		int				not null	auto_increment primary key,
id_worker	int				not null	references tblWorker(id_worker)		on update cascade on delete no action,
auth_login	char(50)	not null,
auth_pass	char(50)	not null
);
create table if not exists tblRegist 
(
id_regist			int				not null	auto_increment primary key,
regist_name			char(50)	not null,
regist_surname		char(50)	not null,
regist_secondname	char(50),
regist_number		char(11)		not null,
regist_date			date,
regist_time			time
);
create table if not exists tblInfReg 
(
infreg_date		date				not null,
infreg_time		time				not null,
infreg_emp		boolean				not null,
primary key(infreg_date,infreg_time)
);

/*Admin*/
Insert tblWorker(worker_name, worker_surname, worker_birthday, worker_passport, worker_date, worker_countm, is_admin)
values ('Admin', 'Admin', '2000-01-01', '-', '2000-01-01', 0, 1);

Insert tblAuth(id_worker, auth_login, auth_pass)
values (1, 'admin', 'admin');


/*Regist*/
CREATE TRIGGER if not exists trgNewRegistI
AFTER INSERT ON tblRegist
FOR EACH ROW
UPDATE tblInfReg
SET tblInfReg.infreg_emp = 1
WHERE (tblInfReg.infreg_date = NEW.regist_date) AND (tblInfReg.infreg_time = NEW.regist_time);

CREATE TRIGGER if not exists trgNewRegistU
AFTER UPDATE ON tblRegist
FOR EACH ROW
UPDATE tblInfReg
SET tblInfReg.infreg_emp = 1
WHERE (tblInfReg.infreg_date = NEW.regist_date) AND (tblInfReg.infreg_time = NEW.regist_time);

CREATE TRIGGER if not exists trgDelRegist
AFTER DELETE ON tblRegist
FOR EACH ROW
UPDATE tblInfReg
SET tblInfReg.infreg_emp = 0
WHERE (tblInfReg.infreg_date = OLD.regist_date) AND (tblInfReg.infreg_time = OLD.regist_time);

/*Count Loan*/
CREATE TRIGGER if not exists trgNewLoanI
AFTER INSERT ON tblLoan
FOR EACH ROW
UPDATE tblWorker
SET tblWorker.worker_countm = (SELECT COUNT(tblLoan.id_loan) FROM tblLoan WHERE tblLoan.id_worker = NEW.id_worker)
WHERE tblWorker.id_worker = NEW.id_worker;

CREATE TRIGGER if not exists trgNewLoanU
AFTER UPDATE ON tblLoan
FOR EACH ROW
UPDATE tblWorker
SET tblWorker.worker_countm = (SELECT COUNT(tblLoan.id_loan) FROM tblLoan WHERE tblLoan.id_worker = NEW.id_worker)
WHERE tblWorker.id_worker = NEW.id_worker;

/*Sum Pay*/
CREATE TRIGGER if not exists trgNewPayI
AFTER INSERT ON tblPay
FOR EACH row
UPDATE tblLoan
SET tblLoan.loan_sum_pay = (SELECT SUM(tblPay.pay_sum) FROM tblPay WHERE tblPay.id_loan = NEW.id_loan)
WHERE tblLoan.id_loan = NEW.id_loan;

CREATE TRIGGER if not exists trgNewPayU
AFTER UPDATE ON tblPay
FOR EACH ROW
UPDATE tblLoan
SET tblLoan.loan_sum_pay = (SELECT SUM(tblPay.pay_sum) FROM tblPay WHERE tblPay.id_loan = NEW.id_loan)
WHERE tblLoan.id_loan = NEW.id_loan;

/*Status Loan*/
CREATE TRIGGER if not exists trgStatusU
BEFORE UPDATE ON tblLoan
FOR EACH ROW
SET NEW.loan_status = (select if(NEW.loan_sum_pay < NEW.loan_sum_result, 'Не погашен', 'Погашен'));

