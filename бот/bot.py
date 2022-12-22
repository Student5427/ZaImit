import telebot
import pyodbc
import datetime
import datetime
from datetime import date
# import sqlite3
from telebot import types
# Создаем экземпляр бота
bot = telebot.TeleBot('5678481348:AAFQVdgC2ko0owkeJ80E3h3-6sqktM7alz8')
db = pyodbc.connect(driver='{MySQL ODBC 8.0 ANSI Driver}',
                      server='localhost',
                      database='zaimit_microloan',
                      user='root',
                      password='_OldMan325_')

print(db)
# Функция, обрабатывающая команду /start
@bot.message_handler(commands=["start"])
def start(message):
    chat_id = message.chat.id
    first_name = message.chat.first_name
    markup = types.ReplyKeyboardMarkup(resize_keyboard=True)
    bot.send_message(chat_id, f"Здравствуйте, {first_name}! Пожалуйста, введите ваш номер телефона, начиная с 8", reply_markup=markup)
@bot.message_handler(content_types=["text"])
def handle_text(message):
    chat_id = message.chat.id
    # connect = sqlite3.connect('Skurtenko$a0740957_TPPO')
    cursor = db.cursor()
    if message.chat.type == "private":
        global pass_id
        pass_id = message.text
        cursor.execute(f"SELECT client_number FROM tblClient WHERE client_number = {pass_id}")
        global newuserflag
        newuserflag = 0
        data = cursor.fetchone()
        db.commit()
        if data is None:
            bot.send_message(chat_id, 'Вы еще не были зарегистрированы у нас. Пожалуйста, введите свое ФИО')
            bot.register_next_step_handler(message, newusername)
        else:
            chat_id = message.chat.id
            markup = types.ReplyKeyboardMarkup(resize_keyboard=True)
            k1 = types.KeyboardButton(text= "Записаться в филиал")
            k2 = types.KeyboardButton(text="Оплатить")
            k3 = types.KeyboardButton(text="Посмотреть историю выплат")
            markup.add(k1, k2, k3)
            bot.send_message(chat_id, "Пожалуйста, выберите интересующую вас операцию", reply_markup=markup)
            bot.register_next_step_handler(message, handle_text2)

def newusername(message):
    newuserflag = 1
    chat_id = message.chat.id
    cursor = db.cursor()
    fullname = message.text
    fullname = fullname.split()
    name = fullname[1]
    surname = fullname[0]
    secondname = fullname[2]
    print(name, surname, secondname)
    cursor.execute(f"INSERT INTO tblRegist(regist_name, regist_surname, regist_secondname, regist_number) values ('{name}','{surname}','{secondname}',{pass_id})")
    markup = types.ReplyKeyboardMarkup(resize_keyboard=True)
    k1 = types.KeyboardButton(text= "Записаться в филиал")
    markup.add(k1)
    bot.send_message(chat_id, "Пожалуйста, выберите интересующую вас операцию", reply_markup=markup)
    bot.register_next_step_handler(message, handle_text2)

def handle_text2(message):
    chat_id = message.chat.id
    if message.text == "Записаться в филиал":
        current_date = date.today()
        markup = types.ReplyKeyboardMarkup(resize_keyboard=True)
        cursor = db.cursor()
        count = 0
        for i in range(7):
            incr = current_date + datetime.timedelta(days=i+1)
            cursor.execute(f"SELECT infreg_date FROM tblInfReg WHERE infreg_date ='{incr}' AND infreg_emp = 0")
            newdate = cursor.fetchone()
            if newdate is None:
                continue
            else:
                finaldate = newdate[0]
                markup.add(types.KeyboardButton(text = f"{finaldate}"))
                count = count+1
        if count == 0:
            bot.send_message(chat_id, "К сожалению, в ближайшую неделю нет свободных записей", reply_markup = markup)
            bot.register_next_step_handler(message, handle_text2)
        else:
            bot.send_message(chat_id, "Выберите удобный для вас день:", reply_markup = markup)
            bot.register_next_step_handler(message, handle_text3)
    elif message.text == "Оплатить":
        bot.send_message(message.chat.id, "Используйте QR-код для оплаты")
        qr = open(r"qrcode.jpg", 'rb')
        bot.send_photo(message.chat.id, photo = qr)
        bot.register_next_step_handler(message, handle_text2)
    elif message.text == "Посмотреть историю выплат":
        bot.send_message(message.chat.id, "Ваша история выплат:")
        bot.send_document(message.chat.id, "https://www.xeroxscanners.com/downloads/Manuals/XMS/PDF_Converter_Pro_Quick_Reference_Guide.RU.pdf")
        bot.register_next_step_handler(message, handle_text2)
def handle_text3(message):
    global c_date
    c_date = message.text
    cursor = db.cursor()
    cursor.execute(f"SELECT infreg_time FROM tblInfReg WHERE infreg_date = '{c_date}' AND infreg_emp	= 0")
    time = cursor.fetchall()
    markup = types.ReplyKeyboardMarkup(resize_keyboard=True)
    if time is None:
        bot.send_message(message.chat.id, "К сожалению, на эту дату нет свободных записей", reply_markup = markup)
        bot.register_next_step_handler(message, handle_text2)
    else:           
        for x in time:
            x = x[0]
            markup.add(types.KeyboardButton(text =f"{x}"))
        bot.send_message(message.chat.id, "Пожалуйста, выберите удобное для вас время", reply_markup = markup)
        bot.register_next_step_handler(message, handle_text4)
def handle_text4(message):
    c_time = message.text
    cursor = db.cursor()
    cursor.execute(f"UPDATE tblInfReg SET infreg_emp = 1 WHERE infreg_date = '{c_date}' AND infreg_time = '{c_time}'")
    if newuserflag == 0:
        cursor.execute(f"INSERT INTO tblRegist(regist_name, regist_surname, regist_secondname, regist_number) SELECT client_name, client_surname, client_secondname, client_number FROM tblClient WHERE client_number = {pass_id}")
    cursor.execute(f"UPDATE tblRegist SET regist_date ='{c_date}', regist_time = '{c_time}' WHERE regist_number = {pass_id} ") 
    cursor.commit()      
    bot.send_message(message.chat.id, "Вы успешно записались в филиал! Если хотите продолжить работу, заново введите свой номер телефона", reply_markup=types.ReplyKeyboardRemove())
    bot.register_next_step_handler(message, handle_text)
# Запускаем бота
bot.polling(none_stop=True, interval=0)