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
client_pasport			char(11)		not null,
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
worker_pasport			char(11)		not null,
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
loan_date_pay		date			not null,
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
regist_date			date			not null,
regist_time			time			not null
);
create table tblInfReg 
(
infreg_date		date				not null,
infreg_time		time				not null,
infreg_emp		boolean				not null,
primary key(infreg_date,infreg_time)
);

/*Äîáàâëÿåì àäìèíà*/
Insert tblWorker(worker_name, worker_surname, worker_birthday, worker_pasport, worker_date, worker_countm, is_admin)
values ('-', '-', '01-01-2000', '-', '01-01-2000', 0, 1);

Insert tblAuth
values (1, 'admin', 'admin');



GO
CREATE TRIGGER trgNewRegist
ON tblRegist
FOR INSERT, UPDATE
AS
BEGIN
	SET NOCOUNT ON;
	DECLARE @Date date, @Time time
	SET @Date = (SELECT regist_date from INSERTED)
	Set @Time = (Select regist_time from INSERTED)
	UPDATE tblInfReg
		SET infreg_emp = 1
		WHERE (tblInfReg.infreg_date = @Date)
			   AND (tblInfReg.infreg_time = @Time)
END
GO

/*Òðèããåð: ïðè äîáàâëåíèè íîâîãî ìèêðîçàéìà ìåíÿåòñÿ êîëè÷åñòâî
îôîðìëåííûõ ìèêðîçàéìîâ ó ñîîòâåòñâóþùåãî ñîòðóäíèêà*/
GO
CREATE TRIGGER trgNewLoan
ON tblLoan
FOR INSERT, UPDATE
AS
BEGIN
	SET NOCOUNT ON;
	DECLARE @Id int, @Count int
	SET @Id = (SELECT id_worker from INSERTED)
	SET @Count = (SELECT count(id_loan) from tblLoan where id_worker=@Id)
	UPDATE tblWorker
		SET worker_countm = @Count
		WHERE (id_worker = @Id)
END
GO

/*Òðèããåð: ïðè äîáàâëåíèè âûïëàòû ìåíÿåòñÿ ñóììà âûïëàò â ìèêðîçàéìå è ñóììà äîëãà*/
GO
CREATE TRIGGER trgNewPay
ON tblPay
FOR INSERT, UPDATE
AS
BEGIN
	SET NOCOUNT ON;
	DECLARE @Id int, @Pay decimal(10, 2)
	SET @Id = (SELECT id_loan from INSERTED)
	SET @Pay = (SELECT pay_sum from inserted)
	UPDATE tblLoan
		SET loan_sum_pay = (select sum(pay_sum) from tblPay where id_loan = @id)
		WHERE (id_loan = @id)
	if (select count(id_debt) from tblDebt where id_loan = @id) > 0 
	UPDATE tblDebt
		SET dent_sum -= @Pay
		WHERE (id_loan = @id)
END
GO
