use zaimit_microloan;

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

insert tblPay (id_loan, pay_date, pay_sum)
values (2, '2022-11-25', 11000), (3, '2022-11-02', 17250);

insert tblAuth (id_worker, auth_login, auth_pass)
values (2, 'worker1', 'worker1'),
	   (3, 'worker2', 'worker2'),
	   (4, 'worker3', 'worker3'),
	   (5, 'worker4', 'worker4');


insert tblInfReg (infreg_date, infreg_time, infreg_emp)
values ('2023-01-01', '10:00', 0),
	   ('2023-01-01', '11:00', 0),
	   ('2023-01-02', '10:00', 0),
	   ('2023-01-02', '11:00', 0);

insert tblRegist (regist_name, regist_surname, regist_secondname, regist_number, regist_date, regist_time)
values ('Борис', 'Орлов', 'Сергеевич', 89999999999, '2023-01-01', '11:00'),
       ('Федор', 'Федоров', 'Федорович', 89000000000, '2023-01-02', '10:00');