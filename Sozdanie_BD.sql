CREATE DATABASE if not exists zaimit_microloan;
use zaimit_microloan;

/*Ñîçäàíèå òàáëèö*/
create table tblClient
(
id_client				int				not null	auto_increment primary key,
client_name				char(50)	not null,
client_surname			char(50)	not null,
client_secondname		char(50),
client_birthday			date			not null,
client_passport			char(11)		not null,
client_adress			char(100)	not null,
client_work				char(100)	not null,
client_salary			int				not null,
client_number			char(11)		not null
);
create table tblWorker
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
create table tblLoan
(
id_loan				int				not null	auto_increment primary key,
id_client			int				not null	references tblClient(id_client)		on update cascade on delete no action,
id_worker			int				not null	references tblWorker(id_worker)		on update cascade on delete no action,
loan_sum			decimal(10,2)	not null,
loan_percent		decimal(4,2)	not null,
loan_start			date			not null,
loan_end			date			not null,
loan_date_pay		int 			not null,
loan_sum_pay		decimal(10,2)	not null
);
create table tblDebt
(
id_debt			int				not null	auto_increment primary key,
id_loan			int				not null	references tblLoan(id_loan)		on update cascade on delete no action,
debt_days		int				not null,
debt_penny		decimal(10,2)	not null,
debt_sum		decimal(10,2)	not null
);
create table tblPay 
(
id_pay		int				not null	auto_increment primary key,
id_loan		int				not null	references tblLoan(id_loan)		on update cascade on delete no action,
pay_date	date			not null,
pay_sum		decimal(10,2)	not null
);
create table tblAuth 
(
id_auth		int				not null	auto_increment primary key,
id_worker	int				not null	references tblWorker(id_worker)		on update cascade on delete no action,
auth_login	char(50)	not null,
auth_pass	char(50)	not null
);
create table tblRegist 
(
id_regist			int				not null	auto_increment primary key,
regist_name			char(50)	not null,
regist_surname		char(50)	not null,
regist_secondname	char(50),
regist_number		char(11)		not null,
regist_date			date,
regist_time			time
);
create table tblInfReg 
(
infreg_date		date				not null,
infreg_time		time				not null,
infreg_emp		boolean				not null,
primary key(infreg_date,infreg_time)
);

/*Äîáàâëÿåì àäìèíà*/
Insert tblWorker(worker_name, worker_surname, worker_birthday, worker_passport, worker_date, worker_countm, is_admin)
values ('Admin', 'Admin', '2000-01-01', '-', '2000-01-01', 0, 1);

Insert tblAuth(id_worker, auth_login, auth_pass)
values (1, 'admin', 'admin');


/*Òðèããåð: ïðè äîáàâëåíèè çàïèñè ìåíÿåò ôëàã íà çàíÿòîñòü â ðàñïèñàíèè*/
CREATE TRIGGER trgNewRegistI
AFTER INSERT ON tblRegist
FOR EACH ROW
UPDATE tblInfReg
SET tblInfReg.infreg_emp = 1
WHERE (tblInfReg.infreg_date = NEW.regist_date) AND (tblInfReg.infreg_time = NEW.regist_time);

CREATE TRIGGER trgNewRegistU
AFTER UPDATE ON tblRegist
FOR EACH ROW
UPDATE tblInfReg
SET tblInfReg.infreg_emp = 1
WHERE (tblInfReg.infreg_date = NEW.regist_date) AND (tblInfReg.infreg_time = NEW.regist_time);

/*Òðèããåð: ïðè óäàëåíèè çàïèñè ìåíÿåò ôëàã íà íåçàíÿòîñòü â ðàñïèñàíèè*/
CREATE TRIGGER trgDelRegist
AFTER DELETE ON tblRegist
FOR EACH ROW
UPDATE tblInfReg
SET tblInfReg.infreg_emp = 0
WHERE (tblInfReg.infreg_date = OLD.regist_date) AND (tblInfReg.infreg_time = OLD.regist_time);

/*Òðèããåð: ïðè äîáàâëåíèè íîâîãî ìèêðîçàéìà ìåíÿåòñÿ êîëè÷åñòâî
îôîðìëåííûõ ìèêðîçàéìîâ ó ñîîòâåòñâóþùåãî ñîòðóäíèêà*/
CREATE TRIGGER trgNewLoanI
AFTER INSERT ON tblLoan
FOR EACH ROW
UPDATE tblWorker
SET tblWorker.worker_countm = (SELECT COUNT(tblLoan.id_loan) FROM tblLoan WHERE tblLoan.id_worker = NEW.id_worker)
WHERE tblWorker.id_worker = NEW.id_worker;

CREATE TRIGGER trgNewLoanU
AFTER UPDATE ON tblLoan
FOR EACH ROW
UPDATE tblWorker
SET tblWorker.worker_countm = (SELECT COUNT(tblLoan.id_loan) FROM tblLoan WHERE tblLoan.id_worker = NEW.id_worker)
WHERE tblWorker.id_worker = NEW.id_worker;

/*Òðèããåð: ïðè äîáàâëåíèè âûïëàòû ìåíÿåòñÿ ñóììà âûïëàò â ìèêðîçàéìå*/
CREATE TRIGGER trgNewPayI
AFTER INSERT ON tblPay
FOR EACH ROW
UPDATE tblLoan
SET tblLoan.loan_sum_pay = (SELECT SUM(tblPay.pay_sum) FROM tblPay WHERE tblPay.id_loan = NEW.id_loan)
WHERE tblLoan.id_loan = NEW.id_loan;

CREATE TRIGGER trgNewPayU
AFTER UPDATE ON tblPay
FOR EACH ROW
UPDATE tblLoan
SET tblLoan.loan_sum_pay = (SELECT SUM(tblPay.pay_sum) FROM tblPay WHERE tblPay.id_loan = NEW.id_loan)
WHERE tblLoan.id_loan = NEW.id_loan;

insert tblClient (client_name, client_surname, client_secondname, client_birthday, client_passport, client_adress, client_work, client_salary, client_number)
values ('Забава', 'Катионова', 'Казимировна', '1974-12-13', 1111111111, 'ул. Мира', 'Магнит', 17000, 89111111111),
	   ('Георгина', 'Лазба', 'Изосимовна', '1981-12-13', 2222222222, 'пер. Пира', 'Лукойл', 222222, 89222222222),
	   ('Кикилия', 'Сарамутина', 'Гурьевна', '1983-12-13', 3333333333, 'наб. Лира', 'Пятерочка', 400000, 89333333333),
	   ('Алипий', 'Ин', 'Адольфович', '2001-12-13', 4444444444, 'ул. Гира', 'РЖД', 1110000, 89444444444);

insert tblWorker (worker_name, worker_surname, worker_secondname, worker_birthday, worker_passport, worker_date, worker_countm, is_admin)
values ('Вукол', 'Живкин', 'Теодорович', '2002-12-13', 5555555555, '2022-09-01', 0, 0),
	   ('Муза', 'Тспаева', 'Мамонтовна', '2003-12-13', 6666666666, '2022-09-01', 0, 0),
	   ('Рогнеда', 'Кеглина', 'Лазарьевна', '1991-12-13', 7777777777, '2022-09-01', 0, 0),
	   ('Зотик', 'Майдыков', 'Спиридонович', '1965-12-13', 8888888888, '2022-09-01', 0, 0);

insert tblLoan (id_client, id_worker, loan_sum, loan_percent, loan_start, loan_end, loan_date_pay, loan_sum_pay)
values (1, 2, 20000, 4, '2022-10-10', '2022-11-10', 09, 0),
       (2, 2, 10000, 5, '2022-10-25', '2022-12-31', 25, 0),
       (3, 3, 15000, 3, '2022-10-27', '2022-11-03', 02, 0);


insert tblDebt (id_loan, debt_days, debt_penny, debt_sum)
values (1, 30, 6, 80000);